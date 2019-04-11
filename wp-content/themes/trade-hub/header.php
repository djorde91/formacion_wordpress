<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package trade-hub
 */

/**
 * trade_hub_action_before_head hook
 * @since trade-hub 1.0.0
 *
 * @hooked trade_hub_set_global -  0
 * @hooked trade_hub_doctype -  10
 */
do_action( 'trade_hub_action_before_head' );?>



<head>

	<?php
	/**
	 * trade_hub_action_before_wp_head hook
	 * @since trade-hub 1.0.0
	 *
	 * @hooked trade_hub_before_wp_head -  10
	 */
	do_action( 'trade_hub_action_before_wp_head' );

	wp_head();

	/**
	 * trade_hub_action_after_wp_head hook
	 * @since trade-hub 1.0.0
	 *
	 * @hooked null
	 */
	do_action( 'trade_hub_action_after_wp_head' );
	?>

</head>

<body <?php body_class(); ?>>

<?php
/**
 * trade_hub_action_before hook
 * @since trade-hub 1.0.0
 *
 * @hooked trade_hub_page_start - 15
 */
do_action( 'trade_hub_action_before' );

/**
 * trade_hub_action_before_header hook
 * @since trade-hub 1.0.0
 *
 * @hooked trade_hub_skip_to_content - 10
 */
do_action( 'trade_hub_action_before_header' );

/**
 * trade_hub_action_header hook
 * @since trade-hub 1.0.0
 *
 * @hooked trade_hub_after_header - 10
 */
do_action( 'trade_hub_action_header' );

/**
 * trade_hub_action_nav_page_start hook
 * @since trade-hub 1.0.0
 *
 * @hooked page start and navigations - 10
 */
do_action( 'trade_hub_action_nav_page_start' );

/**
 * trade_hub_action_on_header hook
 * @since trade-hub 1.0.0
 *
 * @hooked page start and navigations - 10
 */
do_action( 'trade_hub_action_on_header' );

/**
 * trade_hub_action_before_content hook
 * @since trade-hub 1.0.0
 *
 * @hooked null
 */
do_action( 'trade_hub_action_before_content' );


?>

