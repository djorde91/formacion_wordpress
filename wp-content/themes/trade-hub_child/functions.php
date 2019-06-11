<?php
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );
function my_theme_enqueue_styles() {
 
    $parent_style = 'parent-style';
 
    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style ),
        wp_get_theme()->get('Version')
    );
}


if ( ! function_exists('sugerencias_custom_post') ) {

// Register Custom Post Type
function sugerencias_custom_post() {

	$labels = array(
		'name'                  => _x( 'Sugerencias', 'Post Type General Name', 'translate_domain' ),
		'singular_name'         => _x( 'Sugerencias', 'Post Type Singular Name', 'translate_domain' ),
		'menu_name'             => __( 'Sugerencias', 'translate_domain' ),
		'name_admin_bar'        => __( 'Sugerencias', 'translate_domain' ),
		'archives'              => __( 'Item Archives', 'translate_domain' ),
		'attributes'            => __( 'Item Attributes', 'translate_domain' ),
		'parent_item_colon'     => __( 'Parent Item:', 'translate_domain' ),
		'all_items'             => __( 'All Items', 'translate_domain' ),
		'add_new_item'          => __( 'Add New Item', 'translate_domain' ),
		'add_new'               => __( 'Add New', 'translate_domain' ),
		'new_item'              => __( 'New Item', 'translate_domain' ),
		'edit_item'             => __( 'Edit Item', 'translate_domain' ),
		'update_item'           => __( 'Update Item', 'translate_domain' ),
		'view_item'             => __( 'View Item', 'translate_domain' ),
		'view_items'            => __( 'View Items', 'translate_domain' ),
		'search_items'          => __( 'Search Item', 'translate_domain' ),
		'not_found'             => __( 'Not found', 'translate_domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'translate_domain' ),
		'featured_image'        => __( 'Featured Image', 'translate_domain' ),
		'set_featured_image'    => __( 'Set featured image', 'translate_domain' ),
		'remove_featured_image' => __( 'Remove featured image', 'translate_domain' ),
		'use_featured_image'    => __( 'Use as featured image', 'translate_domain' ),
		'insert_into_item'      => __( 'Insert into item', 'translate_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'translate_domain' ),
		'items_list'            => __( 'Items list', 'translate_domain' ),
		'items_list_navigation' => __( 'Items list navigation', 'translate_domain' ),
		'filter_items_list'     => __( 'Filter items list', 'translate_domain' ),
	);
	$args = array(
		'label'                 => __( 'Sugerencias', 'translate_domain' ),
		'description'           => __( 'Listado de todas las Sugerencias que quiero ver', 'translate_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'excerpt' ),
		'taxonomies'            => array( 'category', 'post_tag' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'Sugerencias', $args );

}
add_action( 'init', 'sugerencias_custom_post', 0 );

}

























