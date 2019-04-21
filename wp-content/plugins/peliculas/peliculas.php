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
	  wp_enqueue_style( 'peliculas_css', plugins_url( '/css/peliculas_css.css', __FILE__ ) );
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

if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array(
	'key' => 'group_5cabb06ec8d3e',
	'title' => 'Campos_pelis',
	'fields' => array(
		array(
			'key' => 'field_5cabb07cc9899',
			'label' => 'Nombre',
			'name' => 'peli_nombre',
			'type' => 'text',
			'instructions' => 'Escribe el nombre de una película, luego podrás rellenar más información',
			'required' => 1,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
		),
		array(
			'key' => 'field_5cb9dc30113ca',
			'label' => 'Año',
			'name' => 'peli_anyo',
			'type' => 'number',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => array(
				array(
					array(
						'field' => 'field_5cabb07cc9899',
						'operator' => '!=empty',
					),
				),
			),
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'min' => 1750,
			'max' => 2075,
			'step' => 1,
		),
		array(
			'key' => 'field_5cbb380954532',
			'label' => 'Autocompletar',
			'name' => 'peli_autocompletar',
			'type' => 'button_group',
			'instructions' => 'El autocompletar rellenará los campos con los mostrados en las sugerencias.',
			'required' => 0,
			'conditional_logic' => array(
				array(
					array(
						'field' => 'field_5cabb07cc9899',
						'operator' => '!=empty',
					),

				),
			),
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'choices' => array(
				'Click para autocompletar' => 'Click para autocompletar',
			),
			'allow_null' => 0,
			'default_value' => '',
			'layout' => 'horizontal',
			'return_format' => 'value',
		),
		array(
			'key' => 'field_5cb9fdd7c255e',
			'label' => 'Duración',
			'name' => 'peli_duracion',
			'type' => 'text',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => array(
				array(
					array(
						'field' => 'field_5cabb07cc9899',
						'operator' => '!=empty',
					),
				),
			),
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
		),
		array(
			'key' => 'field_5cba01123bcfc',
			'label' => 'Director',
			'name' => 'peli_director',
			'type' => 'text',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => array(
				array(
					array(
						'field' => 'field_5cabb07cc9899',
						'operator' => '!=empty',
					),

				),
			),
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
		),
		array(
			'key' => 'field_5cba01a6671b2',
			'label' => 'Argumento',
			'name' => 'peli_argumento',
			'type' => 'text',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => array(
				array(
					array(
						'field' => 'field_5cabb07cc9899',
						'operator' => '!=empty',
					),

				),
			),
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'peliculas',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => true,
	'description' => '',
));

endif;

// Title de la pelicula es igual al campo Nombre.
function custom_post_type_title($post_id)
{
    global $wpdb;
    if (get_post_type($post_id) == 'peliculas') {
        $name = get_post_custom_values('peli_nombre');
        $title = $name[0];
        $where = array('ID' => $post_id);
        $wpdb->update($wpdb->posts, array('post_title' => $title), $where);
    } 
}
 
add_action('save_post', 'custom_post_type_title');

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

		// global $post;
		// $post_id = $post->ID;

		// $movie_name = get_post_meta($post_id,'nombre', true);	
		$movie_name = preg_replace('/\s+/', '+', $_POST['movie_name']);

		if (isset($_POST['movie_year']) ) {
		   $url = "http://www.omdbapi.com/?apikey=17265263&t=". $movie_name. '&y=' . $_POST['movie_year'] ;
			
		}else{
		   $url = "http://www.omdbapi.com/?apikey=17265263&t=". $movie_name;
		}

		

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

