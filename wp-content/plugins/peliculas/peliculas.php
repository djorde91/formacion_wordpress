<?php
/**
* Plugin Name: Peliculas
*
* Description: Plugin para mostrar información de peliculas. Simplemente tienes que introducir el nombre.
* Version: 1.0
* Author: Daniel Jorde del Castillo
* 
**/

function load_all_scripts() {
	  wp_enqueue_script( 'peliculas_ajax', plugins_url( '/js/ajax-peliculas.js', __FILE__ ), array('jquery'), '1.0', true );
}
add_action( 'wp_enqueue_scripts', 'load_all_scripts' );
add_action( 'admin_enqueue_scripts', 'load_all_scripts' );


if ( ! function_exists('peliculas_custom_post') ) {

// Register Custom Post Type
function peliculas_custom_post() {

	$labels = array(
		'name'                  => _x( 'Peliculas', 'Post Type General Name', 'translate_domain' ),
		'singular_name'         => _x( 'Pelicula', 'Post Type Singular Name', 'translate_domain' ),
		'menu_name'             => __( 'Películas', 'translate_domain' ),
		'name_admin_bar'        => __( 'Películas', 'translate_domain' ),
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
		'label'                 => __( 'pelicula', 'translate_domain' ),
		'description'           => __( 'Listado de todas las películas que quiero ver', 'translate_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor' ),
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
		'supports' => array( '')
	);
	register_post_type( 'peliculas', $args );

}
add_action( 'init', 'peliculas_custom_post', 0 );

}

// Title de la pelicula es igual al campo Nombre.
function post_title_post_field( $value, $post_id, $field ) {

	if ( get_post_type( $post_id ) == 'peliculas' ) {   
		
	    $nombre = get_field('nombre', $post_id);
	    $title = $nombre;
	    $slug = sanitize_title( $title );
	    $postdata = array(
	         'ID'      => $post_id,
	         'post_title'  => $title,
	         'post_type'   => 'peliculas',
	         'post_name'   => $slug
	    );
	wp_update_post( $postdata, true );
	return $value;
	}

}

add_filter('acf/update_value/name=nombre', 'post_title_post_field', 
10, 3);

/* Filter the single_template with our custom function*/
function my_custom_template($single) {

    global $post;

    /* Checks for single template by post type */
    if ( $post->post_type == 'peliculas' ) {
    	//echo "post type peliculas";

        if ( file_exists(WP_PLUGIN_DIR.'/peliculas/templates/single-peliculas.php' ) ) {
        	
            return WP_PLUGIN_DIR.'/peliculas/templates/single-peliculas.php';
        }
    }

    return $single;

}
add_filter('single_template', 'my_custom_template');


function api_movie_info(){

		global $post;
		$post_id = $post->ID;

		$movie_name = get_post_meta($post_id,'nombre', true);
		$movie_name = preg_replace('/\s+/', '', $movie_name);

		$url = "http://www.omdbapi.com/?apikey=17265263&t=". "matilda" //$movie_name
		;
		$ch = curl_init();

		//echo $url;

		// Set query data here with the URL
		curl_setopt($ch, CURLOPT_URL, $url); 

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_TIMEOUT, 3);
		$content = trim(curl_exec($ch));

		curl_close($ch);

		//echo $content;
		$content = json_encode($content,true);
		echo $content;

		// print_r($content);

		wp_die();
	
}


add_action('wp_ajax_nopriv_api_movie_info', 'api_movie_info');
add_action('wp_ajax_api_movie_info', 'api_movie_info');

?>

