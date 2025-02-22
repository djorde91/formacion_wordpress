<?php

namespace RebelCode\Wpra\Core\Templates;

use Dhii\Exception\CreateInvalidArgumentExceptionCapableTrait;
use Dhii\I18n\StringTranslatingTrait;
use Dhii\Output\CreateTemplateRenderExceptionCapableTrait;
use Dhii\Output\TemplateInterface;
use Exception;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\SyntaxError;

/**
 * A standard template implementation that renders a Twig template.
 *
 * @since 4.13
 */
class TwigTemplate implements TemplateInterface
{
    /* @since 4.13 */
    use CreateInvalidArgumentExceptionCapableTrait;

    /* @since 4.13 */
    use CreateTemplateRenderExceptionCapableTrait;

    /* @since 4.13 */
    use StringTranslatingTrait;

    /**
     * The Twig environment.
     *
     * @since 4.13
     *
     * @var Environment
     */
    protected $env;

    /**
     * The path to the Twig file, relative from any registered templates directory.
     *
     * @since 4.13
     *
     * @var string
     */
    protected $path;

    /**
     * Constructor.
     *
     * @since 4.13
     *
     * @param Environment $env  The Twig environment instance.
     * @param string      $path The path to the Twig file, relative from any registered templates directory.
     */
    public function __construct(Environment $env, $path)
    {
        $this->env = $env;
        $this->path = $path;
    }

    /**
     * {@inheritdoc}
     *
     * @since 4.13
     */
    public function render($ctx = null)
    {
        try {
            return $this->env->load($this->path)->render($ctx);
        } catch (LoaderError $loaderEx) {
            throw $this->_createTemplateRenderException(
                __('Could not load template', WPRSS_TEXT_DOMAIN), null, $loaderEx, $this, $ctx
            );
        } catch (SyntaxError $synEx) {
            throw $this->_createTemplateRenderException(
                sprintf(
                    __('Syntax error in template at line %d: %s', WPRSS_TEXT_DOMAIN),
                    $synEx->getTemplateLine(),
                    $synEx->getMessage()
                ),
                null, $synEx, $this, $ctx
            );
        } catch (Exception $ex) {
            throw $this->_createTemplateRenderException(
                __('An error occurred while rendering the twig template', WPRSS_TEXT_DOMAIN), null, $ex, $this, $ctx
            );
        }
    }
}
