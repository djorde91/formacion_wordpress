<?php

namespace RebelCode\Wpra\Core\Templates\Feeds;

use Dhii\Exception\CreateInvalidArgumentExceptionCapableTrait;
use Dhii\I18n\StringTranslatingTrait;
use Dhii\Output\CreateTemplateRenderExceptionCapableTrait;
use Dhii\Output\TemplateInterface;
use Dhii\Util\Normalization\NormalizeArrayCapableTrait;
use Exception;
use InvalidArgumentException;
use Psr\Log\LoggerInterface;
use RebelCode\Wpra\Core\Data\Collections\CollectionInterface;
use RebelCode\Wpra\Core\Data\DataSetInterface;
use RebelCode\Wpra\Core\Templates\Feeds\Types\FeedTemplateTypeInterface;
use RebelCode\Wpra\Core\Util\ParseArgsWithSchemaCapableTrait;
use RebelCode\Wpra\Core\Util\SanitizeIdCommaListCapableTrait;
use stdClass;
use Traversable;

/**
 * An implementation of a standard Dhii template that, depending on context, delegates rendering to a WP RSS
 * Aggregator feeds template.
 *
 * This template is responsible for generating the feed items output for all the constructs (such as the shortcode,
 * Gutenberg block and previews). This implementation will create a standard WP RSS Aggregator feed item query iterator
 * (as an instance of {@link FeedItemsQueryIterator}) and pass it along to the delegate template as part of the context
 * under the "items" key. The iterator's constructor arguments may be included in the render context for this instance
 * to specify which items to render, as "query_sources", "query_exclude", "query_max_num", "query_page" and
 * "query_factory".
 *
 * @since 4.13
 */
class MasterFeedsTemplate implements TemplateInterface
{
    /* @since 4.13 */
    use ParseArgsWithSchemaCapableTrait;

    /* @since 4.13 */
    use SanitizeIdCommaListCapableTrait;

    /* @since 4.13 */
    use NormalizeArrayCapableTrait;

    /* @since 4.13 */
    use CreateInvalidArgumentExceptionCapableTrait;

    /* @since 4.13 */
    use CreateTemplateRenderExceptionCapableTrait;

    /* @since 4.13 */
    use StringTranslatingTrait;

    /**
     * The key from where to read template options.
     *
     * @since 4.13
     */
    const TEMPLATE_OPTIONS_KEY = 'options';

    /**
     * The key to which to write non-schema context options.
     *
     * @since 4.13
     */
    const CTX_OPTIONS_KEY = 'options';

    /**
     * The ID of the template to use by default.
     *
     * @since 4.13
     *
     * @var string
     */
    protected $default;

    /**
     * An associative array of template type instances.
     *
     * @since 4.13
     *
     * @var FeedTemplateTypeInterface[]
     */
    protected $types;

    /**
     * The collection of templates.
     *
     * @since 4.13
     *
     * @var CollectionInterface
     */
    protected $templateCollection;

    /**
     * The collection of templates.
     *
     * @since 4.13
     *
     * @var CollectionInterface
     */
    protected $feedItemCollection;

    /**
     * The collection of twig templates.
     *
     * @since 4.13
     *
     * @var DataSetInterface
     */
    protected $twigCollection;

    /**
     * The template to use for legacy-mode rendering.
     *
     * @since 4.13
     *
     * @var TemplateInterface
     */
    protected $legacyTemplate;

    /**
     * The logger instance to use for recording errors.
     *
     * @since 4.13
     *
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * Constructor.
     *
     * @since 4.13
     *
     * @param string              $default            The name of the template to use by default.
     * @param array               $templateTypes      The available template types.
     * @param CollectionInterface $templateCollection The collection of templates.
     * @param CollectionInterface $feedItemCollection The collection of feed items.
     * @param DataSetInterface    $twigCollection     The collection of twig templates.
     * @param TemplateInterface   $legacyTemplate     The template to use for legacy-mode rendering.
     * @param LoggerInterface     $logger             The logger instance to use for recording errors.
     */
    public function __construct(
        $default,
        $templateTypes,
        CollectionInterface $templateCollection,
        CollectionInterface $feedItemCollection,
        DataSetInterface $twigCollection,
        TemplateInterface $legacyTemplate,
        LoggerInterface $logger
    ) {
        $this->types = $templateTypes;
        $this->default = $default;
        $this->templateCollection = $templateCollection;
        $this->feedItemCollection = $feedItemCollection;
        $this->twigCollection = $twigCollection;
        $this->legacyTemplate = $legacyTemplate;
        $this->logger = $logger;
    }

    /**
     * {@inheritdoc}
     *
     * @since 4.13
     */
    public function render($argCtx = null)
    {
        // Parse the context
        $ctx = $this->parseContext($argCtx);
        // Retrieve the template slug from the context
        $tSlug = $ctx['template'];

        // Render using the legacy system if legacy ctx arg is given or no template was specified and the legacy
        // system should be used as a fallback
        if ($ctx['legacy'] || (empty($tSlug) && $this->fallBackToLegacySystem())) {
            return $this->legacyTemplate->render($argCtx);
        }

        // Get the template model instance
        $model = $this->getTemplateModel($tSlug);

        // Merge the model options with the non-schema ctx args
        $options = array_merge(
            $this->_normalizeArray($model[static::TEMPLATE_OPTIONS_KEY]),
            $this->_normalizeArray($ctx[static::CTX_OPTIONS_KEY])
        );
        // Include the template slug in the context
        $options['template'] = $model['slug'];

        // Get the template type instance and render it
        $tTypeInst = $this->getTemplateType($model);
        $itemsCollection = ($ctx['items'] instanceof CollectionInterface)
            ? $ctx['items']
            : $this->feedItemCollection;
        $rendered = $tTypeInst->render([
            'options' => $options,
            'items' => $itemsCollection,
        ]);

        return $this->twigCollection['feeds/container.twig']->render([
            'ctx' => base64_encode(json_encode($argCtx)),
            'slug' => $model['slug'],
            'template' => $rendered,
        ]);
    }

    /**
     * Parses the render context, normalizing it to an array and filtering it against the schema.
     *
     * @since 4.13
     *
     * @param array|stdClass|Traversable $ctx The render context.
     *
     * @return array The parsed context.
     */
    protected function parseContext($ctx)
    {
        try {
            $normCtx = $this->_normalizeArray($ctx);
        } catch (InvalidArgumentException $exception) {
            $normCtx = [];
        }

        // Parse the context, putting all non-schema data in an "options" key
        $schema = $this->getContextSchema();
        $pCtx = $this->parseArgsWithSchema($normCtx, $schema, '/', static::CTX_OPTIONS_KEY);

        return $pCtx;
    }

    /**
     * Retrieves the standard WP RSS Aggregator template context schema.
     *
     * @see   ParseArgsWithSchemaCapableTrait::parseArgsWithSchema()
     *
     * @since 4.13
     *
     * @return array
     */
    protected function getContextSchema()
    {
        return [
            'template' => [
                'default' => '',
                'filter' => FILTER_SANITIZE_STRING,
            ],
            'legacy' => [
                'default' => false,
                'filter' => FILTER_VALIDATE_BOOLEAN,
            ],
            'items' => [
                'default' => $this->feedItemCollection,
                'filter' => function ($items) {
                    if ($items instanceof CollectionInterface) {
                        return $items;
                    }

                    throw new InvalidArgumentException(__('The "items" must be a collection instance', 'wprss'));
                },
            ]
        ];
    }

    /**
     * Retrieves the template model instance for a given post slug.
     *
     * @since 4.13
     *
     * @param string $slug The slug name of the template post.
     *
     * @return DataSetInterface The model instance.
     */
    protected function getTemplateModel($slug)
    {
        // If the template slug is empty, use the default slug
        $slug = empty($slug) ? $this->default : $slug;

        try {
            // Get the template model instance
            $model = $this->templateCollection[$slug];
        } catch (Exception $exception) {
            // Fetch the default template
            $model = $this->templateCollection[$this->default];
            // Include warning in log that the template was not found
            $this->logger->warning(
                __('Template "{0}" does not exist or could not be loaded. The "{1}" template was used is instead.'),
                [$slug, $this->default]
            );
        }

        return $model;
    }

    /**
     * Retrieves the template type instance for a template model.
     *
     * @since 4.13
     *
     * @param DataSetInterface $model The template model.
     *
     * @return FeedTemplateTypeInterface The template type instance.
     */
    protected function getTemplateType(DataSetInterface $model)
    {
        $type = isset($model['type']) ? $model['type'] : '';

        return isset($this->types[$type])
            ? $this->types[$type]
            : $this->types['list'];
    }

    /**
     * Checks whether or not the master feeds template should fall back to the legacy rendering method when no
     * template is explicitly specified in the render context.
     *
     * @since 4.13
     *
     * @return bool True to fall back to the legacy rendering system, false to use the default template.
     */
    protected function fallBackToLegacySystem()
    {
        return apply_filters('wpra/templates/fallback_to_legacy_system', false);
    }
}
