<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 *
 * @package eVision themes
 * @subpackage trade-hub
 * @since trade-hub 1.0.0
 */


/**
 * trade_hub_action_after_content hook
 * @since trade-hub 1.0.0
 *
 * @hooked null
 */
do_action( 'trade_hub_action_after_content' );

/**
 * trade_hub_action_before_footer hook
 * @since trade-hub 1.0.0
 *
 * @hooked trade_hub_before_footer - 10
 */
do_action( 'trade_hub_action_before_footer' );

/**
 * trade_hub_action_widget_before_footer hook
 * @since trade-hub 1.0.0
 *
 * @hooked trade_hub_widget_before_footer - 10
 */
do_action( 'trade_hub_action_widget_before_footer' );

/**
 * trade_hub_action_footer hook
 * @since trade-hub 1.0.0
 *
 * @hooked trade_hub_footer - 10
 */
do_action( 'trade_hub_action_footer' );

/**
 * trade_hub_action_after_footer hook
 * @since trade-hub 1.0.0
 *
 * @hooked null
 */
do_action( 'trade_hub_action_after_footer' );

/**
 * trade_hub_action_after hook
 * @since trade-hub 1.0.0
 *
 * @hooked trade_hub_page_end - 10
 */
do_action( 'trade_hub_action_after' );
?>
<?php wp_footer(); ?>
</body>
</html>