<?php
/**
 * Custom functions
 */
 
if ( is_user_logged_in() ) {
//include_once('functions-debug.php' );
}
/* stopping heatbeat for all pages except post,post-new */


//add_action( 'init', 'stop_heartbeat', 1 );
function stop_heartbeat() {
        global $pagenow;

        if ( $pagenow != 'post.php' && $pagenow != 'post-new.php' && !is_admin() )
        wp_deregister_script('heartbeat');
}



 
if ( !defined( 'SHOESTRAP_OPT_NAME' ) )
	define( 'SHOESTRAP_OPT_NAME', 'dreamkyiv' );
	
set_post_thumbnail_size( 620, 280, true );	
add_image_size( 'pthumb', 140, 80, true );
add_image_size( 'thumbnail', 270, 180, true );
add_image_size( 'big', 1140, 760, true );
add_image_size( 'medium', 840, 560, true );
add_image_size( 'square', 620, 415, true );
add_image_size( 'small50', 50, 50, false );

function dk_scripts() {
	wp_enqueue_style( 'dk-style', get_stylesheet_uri() );

}
add_action( 'wp_enqueue_scripts', 'dk_scripts' );



// Include some admin options.
require_once locate_template( 'lib/admin-options.php' );


/*
 * Add a less file from our child theme to the parent theme's compiler.
 * This uses the 'shoestrap_compiler' filter that exists in the shoestrap compiler
 */
//add_filter( 'shoestrap_compiler', 'shoestrap_child_styles' );
function shoestrap_child_styles( $bootstrap ) {
	return $bootstrap . '
	@import "' . get_stylesheet_directory() . '/assets/less/child.less";';
}

/*
 * Changes the output of the compiled CSS.
 */
add_filter( 'shoestrap_compiler_output', 'shoestrap_child_hijack_compiler' );
function shoestrap_child_hijack_compiler( $css ) {
	// $css = str_replace( '', '', $css );
	return $css;
}

/*
 * Enqueue the style.css file.
 *
 * It is recommended to use a less file as per the shoestrap_child_styles() function above.
 *
 * To have styles compiled and added in the main stylesheet,
 * try using the shoestrap_child_styles() function instead,
 */
// Uncomment the line below to enqueue the stylesheet
// add_action('wp_enqueue_scripts', 'shoestrap_child_load_stylesheet', 100);
function shoestrap_child_load_stylesheet() {
	wp_enqueue_style( 'shoestrap_child_css', get_stylesheet_uri(), false, null );
}

/*
 * Enqueue the stylesheet created with Grunt
 */
// Uncomment the line below to enqueue the stylesheet
// add_action('wp_enqueue_scripts', 'shoestrap_child_grunt_stylesheet', 100);
function shoestrap_child_grunt_stylesheet() {
	wp_enqueue_style( 'shoestrap_child_grunt_css', get_stylesheet_directory_uri() . '/assets/css/style.css', false, null );
}

// Register Custom Post Type
function add_bio() {

	$labels = array(
		'name'                => _x( 'Біографії', 'Post Type General Name', 'dreamk' ),
		'singular_name'       => _x( 'Біографія', 'Post Type Singular Name', 'dreamk' ),
		'menu_name'           => __( 'Біографії', 'dreamk' ),
		'parent_item_colon'   => __( 'Parent Item:', 'dreamk' ),
		'all_items'           => __( 'Все біографії', 'dreamk' ),
		'view_item'           => __( 'Проглянути', 'dreamk' ),
		'add_new_item'        => __( 'Додати біографію', 'dreamk' ),
		'add_new'             => __( 'Додати', 'dreamk' ),
		'edit_item'           => __( 'Редагувати', 'dreamk' ),
		'update_item'         => __( 'Оновити', 'dreamk' ),
		'search_items'        => __( 'Шукати', 'dreamk' ),
		'not_found'           => __( 'Не знайдено', 'dreamk' ),
		'not_found_in_trash'  => __( 'В кошику пусто', 'dreamk' ),
	);
	$capabilities = array(
		'edit_post'           => 'edit_bio',
		'read_post'           => 'read_bio',
		'delete_post'         => 'delete_bio',
		'delete_posts'        => 'delete_bios',
    'delete_others_posts' => 'delete_others_bios',
		'edit_posts'          => 'edit_bios',
		'edit_others_posts'   => 'edit_others_bios',
		'publish_posts'       => 'publish_bios',
		'read_private_posts'  => 'read_private_bios',
		'edit_published_posts'=> 'edit_published_bios',
	);
	$args = array(
		'label'               => __( 'bio', 'dreamk' ),
		'description'         => __( 'Биография кандидата', 'dreamk' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', 'page-attributes', 'post-formats', ),
		'taxonomies'          => array( 'category', 'post_tag' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'menu_icon'           => 'dashicons-id-alt',
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type' => 'bio', //@TODO присвоїти права на редагування юзерам з роллю candidate
		'capabilities' => $capabilities,
		'map_meta_cap' => true,
	);
	register_post_type( 'bio', $args );

}

// Hook into the 'init' action
add_action( 'init', 'add_bio', 0 );


// Register Custom Post Type
function add_team() {

	$labels = array(
		'name'                => _x( 'Команди Кандидатів', 'Post Type General Name', 'dreamk' ),
		'singular_name'       => _x( 'Команда', 'Post Type Singular Name', 'dreamk' ),
		'menu_name'           => __( 'Команди', 'dreamk' ),
		'parent_item_colon'   => __( 'Parent Item:', 'dreamk' ),
		'all_items'           => __( 'Все біографії', 'dreamk' ),
		'view_item'           => __( 'Проглянути', 'dreamk' ),
		'add_new_item'        => __( 'Додати команду', 'dreamk' ),
		'add_new'             => __( 'Додати', 'dreamk' ),
		'edit_item'           => __( 'Редагувати', 'dreamk' ),
		'update_item'         => __( 'Оновити', 'dreamk' ),
		'search_items'        => __( 'Шукати', 'dreamk' ),
		'not_found'           => __( 'Не знайдено', 'dreamk' ),
		'not_found_in_trash'  => __( 'В кошику пусто', 'dreamk' ),
	);
	$capabilities = array(
		'edit_post'           => 'edit_team',
		'read_post'           => 'read_team',
		'delete_post'         => 'delete_team',
		'delete_posts'        => 'delete_teams',
        'delete_others_posts' => 'delete_others_teams',
		'edit_posts'          => 'edit_teams',
		'edit_others_posts'   => 'edit_others_teams',
		'publish_posts'       => 'publish_teams',
		'read_private_posts'  => 'read_private_teams',
		'edit_published_posts'=> 'edit_published_teams',
	);
	$args = array(
		'label'               => __( 'team', 'dreamk' ),
		'description'         => __( 'Команда кандидата', 'dreamk' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', 'page-attributes', 'post-formats', ),
		'taxonomies'          => array( 'category', 'post_tag' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 6,
		'menu_icon'           => 'dashicons-id-alt',
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type' => 'team', //@TODO присвоїти права на редагування юзерам з роллю candidate
		'capabilities' => $capabilities,
		'map_meta_cap' => true,
	);
	register_post_type( 'team', $args );

}

// Hook into the 'init' action
add_action( 'init', 'add_facebook', 0 );

// Register Custom Post Type
function add_facebook() {

	$labels = array(
		'name'                => _x( 'Соціальні мережі', 'Post Type General Name', 'dreamk' ),
		'singular_name'       => _x( 'Пост facebook', 'Post Type Singular Name', 'dreamk' ),
		'menu_name'           => __( 'Соціальні мережі', 'dreamk' ),
		'parent_item_colon'   => __( 'Parent Item:', 'dreamk' ),
		'all_items'           => __( 'Усі пости', 'dreamk' ),
		'view_item'           => __( 'Проглянути', 'dreamk' ),
		'add_new_item'        => __( 'Додати пост', 'dreamk' ),
		'add_new'             => __( 'Додати', 'dreamk' ),
		'edit_item'           => __( 'Редагувати', 'dreamk' ),
		'update_item'         => __( 'Оновити', 'dreamk' ),
		'search_items'        => __( 'Шукати', 'dreamk' ),
		'not_found'           => __( 'Не знайдено', 'dreamk' ),
		'not_found_in_trash'  => __( 'В кошику пусто', 'dreamk' ),
	);
	$capabilities = array(
		'edit_post'           => 'edit_fb_post',
		'read_post'           => 'read_fb_post',
		'delete_post'         => 'delete_fb_post',
		'delete_posts'        => 'delete_fb_posts',
        'delete_others_posts' => 'delete_others_fb_posts',
		'edit_posts'          => 'edit_fb_posts',
		'edit_others_posts'   => 'edit_others_fb_posts',
		'publish_posts'       => 'publish_fb_posts',
		'read_private_posts'  => 'read_private_fb_posts',
		'edit_published_posts'=> 'edit_published_fb_posts',
	);
	$args = array(
		'label'               => __( 'social', 'dreamk' ),
		'description'         => __( 'Соціальні мережі', 'dreamk' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'author', 'thumbnail', 'revisions','comments' ),
		'taxonomies'          => array( 'category', 'post_tag' ),
		'hierarchical'        => true,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 6,
		'menu_icon'           => 'dashicons-id-alt',
		'can_export'          => true,
		'has_archive'         => 'social',
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type' => 'social', //@TODO присвоїти права на редагування юзерам з роллю candidate
                'rewrite' => array('slug' => 'social'),

		'capabilities' => $capabilities,
		'map_meta_cap' => true,
	);
	register_post_type( 'social', $args );

}

// Hook into the 'init' action
add_action( 'init', 'add_team', 0 );

// Register Custom Post Type
function add_promices() {

	$labels = array(
		'name'                => _x( 'Программи', '', 'dreamk' ),
		'singular_name'       => _x( 'Програма', '', 'dreamk' ),
		'menu_name'           => __( 'Программи', 'dreamk' ),
		'parent_item_colon'   => __( 'Parent Item:', 'dreamk' ),
		'all_items'           => __( 'Всі програми', 'dreamk' ),
		'view_item'           => __( 'Проглянути', 'dreamk' ),
		'add_new_item'        => __( 'Додати програму', 'dreamk' ),
		'add_new'             => __( 'Додати', 'dreamk' ),
		'edit_item'           => __( 'Редагувати', 'dreamk' ),
		'update_item'         => __( 'Оновити', 'dreamk' ),
		'search_items'        => __( 'Шукати', 'dreamk' ),
		'not_found'           => __( 'Не знайдено', 'dreamk' ),
		'not_found_in_trash'  => __( 'В кошику пусто', 'dreamk' ),
	);

	$args = array(
		'label'               => __( 'program', 'dreamk' ),
		'description'         => __( 'Програма кандидата', 'dreamk' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', 'page-attributes', 'post-formats', ),
		'taxonomies'          => array( 'category', 'post_tag' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'menu_icon'           => 'dashicons-feedback',
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type' => 'program', //@TODO присвоїти права на редагування юзерам з роллю candidate
		//'capabilities' => $capabilities,
		'map_meta_cap' => true,
	);
	register_post_type( 'program', $args );

}

// Hook into the 'init' action
add_action( 'init', 'add_promices', 0 );

// Register Custom Post Type
function add_kandidat() {

	$labels = array(
		'name'                => 'Кандидати',
		'singular_name'       => 'Кандидати',
		'menu_name'           => 'Кандидати',
		'parent_item_colon'   => __( 'Parent Item:', 'dreamk' ),
		'all_items'           => 'Всi кандидати',
		'view_item'           => __( 'Проглянути', 'dreamk' ),
		'add_new_item'        => __( 'Додати кандидата', 'dreamk' ),
		'add_new'             => __( 'Додати', 'dreamk' ),
		'edit_item'           => __( 'Редагувати', 'dreamk' ),
		'update_item'         => __( 'Оновити', 'dreamk' ),
		'search_items'        => __( 'Шукати', 'dreamk' ),
		'not_found'           => __( 'Не знайдено', 'dreamk' ),
		'not_found_in_trash'  => __( 'В кошику пусто', 'dreamk' ),
	);

	$args = array(
		'label'               => __( 'kandidat', 'dreamk' ),
		'description'         => __( 'Кандидати', 'dreamk' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', 'page-attributes', 'post-formats', ),
		'taxonomies'          => array( 'category', 'post_tag' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'menu_icon'           => 'dashicons-feedback',
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type' => 'kandidat', //@TODO присвоїти права на редагування юзерам з роллю candidate
		'capabilities' => array('assign_terms'=>'edit_kandidats'),
		'map_meta_cap' => true,
	);
	register_post_type( 'kandidat', $args );

}

// Hook into the 'init' action
add_action( 'init', 'add_kandidat', 0 );

function force_custom_post_categories() {
	global $wp_taxonomies;
	$wp_taxonomies['category']->cap->assign_terms = 'edit_kandidats';
}
add_action('init','force_custom_post_categories');


// Register Custom Post Type
function add_party() {

	$labels = array(
		'name'                => 'Партії',
		'singular_name'       => 'Партії',
		'menu_name'           => 'Партії',
		'parent_item_colon'   => __( 'Parent Item:', 'dreamk' ),
		'all_items'           => 'Всi партії',
		'view_item'           => __( 'Проглянути', 'dreamk' ),
		'add_new_item'        => __( 'Додати партію', 'dreamk' ),
		'add_new'             => __( 'Додати', 'dreamk' ),
		'edit_item'           => __( 'Редагувати', 'dreamk' ),
		'update_item'         => __( 'Оновити', 'dreamk' ),
		'search_items'        => __( 'Шукати', 'dreamk' ),
		'not_found'           => __( 'Не знайдено', 'dreamk' ),
		'not_found_in_trash'  => __( 'В кошику пусто', 'dreamk' ),
	);

	$args = array(
		'label'               => __( 'party', 'dreamk' ),
		'description'         => __( 'Партії', 'dreamk' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', 'page-attributes', 'post-formats', ),
		'taxonomies'          => array( 'category', 'post_tag' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'menu_icon'           => 'dashicons-feedback',
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type' => 'party', //@TODO присвоїти права на редагування юзерам з роллю candidate
		//'capabilities' => $capabilities,
		'map_meta_cap' => true,
	);
	register_post_type( 'party', $args );

}
// Hook into the 'init' action
add_action( 'init', 'add_party', 0 );

// Register Custom Post Type
function add_area() {

	$labels = array(
		'name'                => 'Округи',
		'singular_name'       => 'Округи',
		'menu_name'           => 'Округи',
		'parent_item_colon'   => __( 'Parent Item:', 'dreamk' ),
		'all_items'           => 'Всi округи',
		'view_item'           => __( 'Проглянути', 'dreamk' ),
		'add_new_item'        => __( 'Додати округ', 'dreamk' ),
		'add_new'             => __( 'Додати', 'dreamk' ),
		'edit_item'           => __( 'Редагувати', 'dreamk' ),
		'update_item'         => __( 'Оновити', 'dreamk' ),
		'search_items'        => __( 'Шукати', 'dreamk' ),
		'not_found'           => __( 'Не знайдено', 'dreamk' ),
		'not_found_in_trash'  => __( 'В кошику пусто', 'dreamk' ),
	);

	$args = array(
		'label'               => __( 'area', 'dreamk' ),
		'description'         => __( 'Округи', 'dreamk' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', 'page-attributes', 'post-formats', ),
		'taxonomies'          => array( 'category', 'post_tag' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'menu_icon'           => 'dashicons-feedback',
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type' => 'area', //@TODO присвоїти права на редагування юзерам з роллю candidate
		//'capabilities' => $capabilities,
		'map_meta_cap' => true,
	);
	register_post_type( 'area', $args );

}
// Hook into the 'init' action
add_action( 'init', 'add_area', 0 );

// Register Custom Post Type
function add_polling_station() {

	$labels = array(
		'name'                => 'Дільниці',
		'singular_name'       => 'Дільниці',
		'menu_name'           => 'Дільниці',
		'parent_item_colon'   => __( 'Parent Item:', 'dreamk' ),
		'all_items'           => 'Всi дільниці',
		'view_item'           => __( 'Проглянути', 'dreamk' ),
		'add_new_item'        => __( 'Додати дільницю', 'dreamk' ),
		'add_new'             => __( 'Додати', 'dreamk' ),
		'edit_item'           => __( 'Редагувати', 'dreamk' ),
		'update_item'         => __( 'Оновити', 'dreamk' ),
		'search_items'        => __( 'Шукати', 'dreamk' ),
		'not_found'           => __( 'Не знайдено', 'dreamk' ),
		'not_found_in_trash'  => __( 'В кошику пусто', 'dreamk' ),
	);

	$args = array(
		'label'               => __( 'polling_station', 'dreamk' ),
		'description'         => __( 'Дільниці', 'dreamk' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', 'page-attributes', 'post-formats', ),
		'taxonomies'          => array( 'category', 'post_tag' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'menu_icon'           => 'dashicons-feedback',
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type' => 'polling_station', //@TODO присвоїти права на редагування юзерам з роллю candidate
		//'capabilities' => $capabilities,
		'map_meta_cap' => true,
	);
	register_post_type( 'polling_station', $args );

}

// Hook into the 'init' action
add_action( 'init', 'add_polling_station', 0 );


// Register Custom Post Type
function add_rada_decision() {

	$labels = array(
		'name'                => 'Рішення Київради',
		'singular_name'       => 'Рішення Київради',
		'menu_name'           => 'Рішення Київради',
		'parent_item_colon'   => __( 'Parent Item:', 'dreamk' ),
		'all_items'           => 'Всi рішення Київради',
		'view_item'           => __( 'Проглянути', 'dreamk' ),
		'add_new_item'        => __( 'Додати рішення Київради', 'dreamk' ),
		'add_new'             => __( 'Додати', 'dreamk' ),
		'edit_item'           => __( 'Редагувати', 'dreamk' ),
		'update_item'         => __( 'Оновити', 'dreamk' ),
		'search_items'        => __( 'Шукати', 'dreamk' ),
		'not_found'           => __( 'Не знайдено', 'dreamk' ),
		'not_found_in_trash'  => __( 'В кошику пусто', 'dreamk' ),
	);

	$args = array(
		'label'               => __( 'rada_decision', 'dreamk' ),
		'description'         => __( 'Рішення Київради', 'dreamk' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', 'page-attributes', 'post-formats', ),
		'taxonomies'          => array( 'category', 'post_tag' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'menu_icon'           => 'dashicons-feedback',
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type' => 'rada_decision', //@TODO присвоїти права на редагування юзерам з роллю candidate
		'capabilities' => array('assign_terms'=>'edit_rada_decisions'),
		'map_meta_cap' => true,
	);
	register_post_type( 'rada_decision', $args );

}

// Hook into the 'init' action
add_action( 'init', 'add_rada_decision', 0 );


// Register Custom Post Type
function add_deputy_control() {

	$labels = array(
		'name'                => 'Контроль депутатів',
		'singular_name'       => 'Контроль депутата',
		'menu_name'           => 'Контроль депутатів',
		'parent_item_colon'   => __( 'Parent Item:', 'dreamk' ),
		'all_items'           => 'Всi депутати',
		'view_item'           => __( 'Проглянути', 'dreamk' ),
		'add_new_item'        => __( 'Додати депутата', 'dreamk'),
		'add_new'             => __( 'Додати', 'dreamk' ),
		'edit_item'           => __( 'Редагувати', 'dreamk' ),
		'update_item'         => __( 'Оновити', 'dreamk' ),
		'search_items'        => __( 'Шукати', 'dreamk' ),
		'not_found'           => __( 'Не знайдено', 'dreamk' ),
		'not_found_in_trash'  => __( 'В кошику пусто', 'dreamk' ),
	);

	$args = array(
		'label'               => __( 'deputy_control', 'dreamk' ),
		'description'         => __( 'Контроль депутатів', 'dreamk' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', 'page-attributes', 'post-formats', ),
		'taxonomies'          => array( 'category', 'post_tag' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'menu_icon'           => 'dashicons-feedback',
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type' => 'deputy_control', //@TODO присвоїти права на редагування юзерам з роллю candidate
		//'capabilities' => $capabilities,
		'map_meta_cap' => true,
	);
	register_post_type( 'deputy_control', $args );

}

// Hook into the 'init' action
add_action( 'init', 'add_deputy_control', 0 );


//add new user role for column authors
function lm_add_candidate_role(){
    //remove_role( 'candidate' );
    //if(!get_role('candidate')){
        add_role('candidate',
            __( 'Кандидат' ),
            array(
                'read'         => true,
                'upload_files' => true,
            )
        );
    //}
    // fixing bug http://core.trac.wordpress.org/ticket/16841#comment:2 to display user in post author dropdown
    $role = get_role( 'candidate' );
    //var_dump($role);
    $role->add_cap( 'level_0' ); 
    $role->add_cap( 'level_1' ); 
    $role->add_cap( 'level_2' ); 
    
    $role->add_cap( 'read_bio' );
    $role->add_cap( 'edit_bio' );
    $role->add_cap( 'edit_bios' );
    $role->add_cap( 'publish_bios' );
    $role->add_cap( 'read_private_bios' );
    $role->add_cap( 'edit_published_bios' );
    
    $role->add_cap( 'read_program' );
    $role->add_cap( 'edit_program' );
    $role->add_cap( 'edit_programs' );
    $role->add_cap( 'publish_programs' );
    $role->add_cap( 'read_private_programs' );
    $role->add_cap( 'edit_published_programs' );

    $role->add_cap( 'edit_team');
    $role->add_cap( 'read_team');
    $role->add_cap( 'delete_team');
    $role->add_cap( 'delete_teams');
    $role->add_cap( 'delete_others_teams');
    $role->add_cap( 'edit_teams');
    $role->add_cap( 'edit_others_teams');
    $role->add_cap( 'publish_teams');
    $role->add_cap( 'read_private_teams');
    $role->add_cap( 'edit_published_teams');    
   
//    $role = get_role( 'people_control');
//    $role->add_cap('assign_terms');
 
    $roles_array = array('author', 'editor', 'administrator');
    foreach ($roles_array as $single_role) {
      $role = get_role( $single_role );  
      //var_dump($role);
      foreach( array('bio', 'program', 'fb_post', 'team', 'kandidat', 'party', 'area', 'polling_station', 'rada_decision', 'deputy_control') as $o) {
          $role->add_cap( sprintf('read_%s', $o ) );
          $role->add_cap( sprintf('edit_%s', $o ) );
          $role->add_cap( sprintf('delete_%s', $o ) );
          $role->add_cap( sprintf('delete_%ss', $o ) );
          $role->add_cap( sprintf('delete_others_%ss', $o ) );
          $role->add_cap( sprintf('delete_private_%ss', $o ) );
          $role->add_cap( sprintf('delete_published_%ss', $o ) );
          $role->add_cap( sprintf('edit_%ss', $o ) );
          $role->add_cap( sprintf('edit_others_%ss', $o ) );
          $role->add_cap( sprintf('publish_%ss', $o ) );
          $role->add_cap( sprintf('read_private_%ss', $o ) );
          $role->add_cap( sprintf('edit_private_%ss', $o ) );
          $role->add_cap( sprintf('edit_published_%ss', $o )  );          
      }          
    }
    
}
//add_action( 'after_switch_theme', 'lm_add_candidate_role' );
add_action( 'admin_init', 'lm_add_candidate_role' );

function lm_add_custom_user_profile_fields( $user ) {
?>
	<h3><?php _e('Extra Profile Information', 'dreamk'); ?></h3>
	
	<table class="form-table">
		<tr>
			<th>
				<label for="facebook"><?php _e('Facebook', 'dreamk'); ?>
			</label></th>
			<td>
				<input type="text" name="facebook" id="facebook" value="<?php echo esc_attr( get_the_author_meta( 'facebook', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description"><?php _e('Please enter your facebook.', 'dreamk'); ?></span>
			</td>
		</tr>
		<tr>
			<th>
				<label for="twitter"><?php _e('Twitter', 'dreamk'); ?>
			</label></th>
			<td>
				<input type="text" name="twitter" id="twitter" value="<?php echo esc_attr( get_the_author_meta( 'twitter', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description"><?php _e('Please enter your twitter.', 'dreamk'); ?></span>
			</td>
		</tr>		
	</table>
<?php }

function lm_save_custom_user_profile_fields( $user_id ) {
	
	if ( !current_user_can( 'edit_user', $user_id ) )
		return FALSE;
	
	update_usermeta( $user_id, 'twitter', $_POST['twitter'] );
	update_usermeta( $user_id, 'facebook', $_POST['facebook'] );
}

add_action( 'show_user_profile', 'lm_add_custom_user_profile_fields' );
add_action( 'edit_user_profile', 'lm_add_custom_user_profile_fields' );

add_action( 'personal_options_update', 'lm_save_custom_user_profile_fields' );
add_action( 'edit_user_profile_update', 'lm_save_custom_user_profile_fields' );

function change_role_name() {
    global $wp_roles;

    if ( ! isset( $wp_roles ) )
        $wp_roles = new WP_Roles();

    $wp_roles->roles['author']['name'] = 'Експерт';
    $wp_roles->role_names['author'] = 'Експерт';           
}
add_action('init', 'change_role_name');
remove_theme_support('post-formats');


function lm_relative_posts_by_cats() {
  $orig_post = $post;
  global $post;

  $aTerms = wp_get_post_terms($post->ID, 'category');

  $is_news == false;
  $post_cats = get_the_category();
  foreach ($post_cats as $post_cat)
      if ($post_cat->term_id == 19) $is_news = true;

  if ($aTerms):
    $aRelativeTermArray = array();
    foreach($aTerms as $oTag)
        $aRelativeTermArray[] = $oTag->term_id;

    $args = array(
        'category__in' => $aRelativeTermArray,
        'post__not_in' => array($post->ID),
        'posts_per_page' => $is_news?3:2
    );

    $my_query = new WP_Query( $args );
    if( $my_query->have_posts() ): 
        if ($is_news): ?>
        <div class="row similar news-preview">
<?php while( $my_query->have_posts() ): $my_query->the_post(); ?>
            <div class="col-sm-4 news-item">
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a><br>
                <span class="el-icon-calendar icon date"><?php the_time('d.m.Y'); ?></span>
            </div>
<?php endwhile; ?>
        </div>
<?php
        else: ?>
        <div class="row similar news-preview">
<?php while( $my_query->have_posts() ): $my_query->the_post(); ?>
        <div class="col-sm-6 face-news preview front-sidebar">      
        <?php
            $post_thumbnail_id = get_post_thumbnail_id(get_the_ID());
            $post_thumbnail = wp_get_attachment_image_src($post_thumbnail_id,'thumb');
        ?>
            <div class="topnews-wrapper" style="background-image:url(<?php echo $post_thumbnail[0] ?>)">
                <div class="topnews-info">
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </div>
            </div>
        </div>
<?php endwhile; ?>
        </div>
<?php
            
        endif;
    endif;
  endif;
    $post = $orig_post;
    wp_reset_query();
}

function lm_trim_title($limit=30) {
    $title = get_the_title();
    $getlength = mb_strlen($title);
    echo mb_substr($title, 0, $limit);
    if ($getlength > $limit) echo "...";
}

// Add Formats Dropdown Menu To MCE
if ( ! function_exists( 'wpex_style_select' ) ) {
	function wpex_style_select( $buttons ) {
		array_push( $buttons, 'styleselect' );
		return $buttons;
	}
}
add_filter( 'mce_buttons', 'wpex_style_select' );


// Add new styles to the TinyMCE "formats" menu dropdown
if ( ! function_exists( 'wpex_styles_dropdown' ) ) {
	function wpex_styles_dropdown( $settings ) {

		// Create array of new styles
		$new_styles = array(
			array(
				'title'	=> __( 'DreamKyiv Styles', 'wpex' ),
				'items'	=> array(					
					array(
						'title'		=> __('Definition','wpex'),
						'selector'	=> 'p',
						'classes'	=> 'text-definition',
					),
				),
			),
		);

		// Merge old & new styles
		$settings['style_formats_merge'] = true;

		// Add new styles
		$settings['style_formats'] = json_encode( $new_styles );

		// Return New Settings
		return $settings;

	}
}
add_filter( 'tiny_mce_before_init', 'wpex_styles_dropdown' );

/* addons */

add_action('shoestrap_inside_nav_end','facebook_logo');
function facebook_logo() {
?>
    <div class="facebook-logo"><a href="https://www.facebook.com/dreamkyiv?fref=ts"><img src="<?php echo get_stylesheet_directory_uri() ?>/fb_top_logo.png"></a></div>
<?php
}

add_action('shoestrap_index_begin','set_default_post_category');

function set_default_post_category() {
    global $query_string;
    if (!is_category()&&!get_query_var('post_type'))
        query_posts( $query_string . '&category_name=novini' );
}

add_action('shoestrap_in_loop_start','publish_the_date');
function publish_the_date () {
    if(get_query_var('cat')==19) {
        if (is_new_day()) {
            the_date ('D, d F Y');
            echo '<hr>';
        }
    }
}

add_action( 'shoestrap_entry_meta_override', 'news_custom_metadata' );
function news_custom_metadata() {
}

add_action( 'shoestrap_entry_footer', 'news_custom_footer' );
function news_custom_footer() {
?>
    <span class="date"><i class="el-icon-calendar icon"></i>
    <?php echo get_the_date('j F Y') ?>
   </span>
<?php    
}


add_action('shoestrap_index_begin','check_category');
function check_category () {
    if ( get_query_var('cat') != 19 and !get_query_var('post_type')) {
        add_action('shoestrap_override_index_loop','galery_view_loop');
        echo '<div class="row">';
    }
    elseif (get_query_var('post_type') == 'social') {
        add_action('shoestrap_override_index_loop','social_view_loop');
        echo '<div class="row">';
    }
}

add_action('shoestrap_index_end','close_tag');
function close_tag () {
    if ( get_query_var('cat') != 19 and !get_query_var('post_type') or get_query_var('post_type') == 'social') {
        echo '</div>';
    }
}

function galery_view_loop () {
    ss_get_template_part('templates/content','gallery');
}

function social_view_loop () {
    ss_get_template_part('templates/content','social');
}

/*
 * Function creates post duplicate as a draft and redirects then to the edit post screen
 */
function rd_duplicate_post_as_draft(){
	global $wpdb;
	if (! ( isset( $_GET['post']) || isset( $_POST['post'])  || ( isset($_REQUEST['action']) && 'rd_duplicate_post_as_draft' == $_REQUEST['action'] ) ) ) {
		wp_die('No post to duplicate has been supplied!');
	}
 
	/*
	 * get the original post id
	 */
	$post_id = (isset($_GET['post']) ? $_GET['post'] : $_POST['post']);
	/*
	 * and all the original post data then
	 */
	$post = get_post( $post_id );
 
	/*
	 * if you don't want current user to be the new post author,
	 * then change next couple of lines to this: $new_post_author = $post->post_author;
	 */
	$current_user = wp_get_current_user();
	$new_post_author = $current_user->ID;
 
	/*
	 * if post data exists, create the post duplicate
	 */
	if (isset( $post ) && $post != null) {
 
		/*
		 * new post data array
		 */
		$args = array(
			'comment_status' => $post->comment_status,
			'ping_status'    => $post->ping_status,
			'post_author'    => $new_post_author,
			'post_content'   => $post->post_content,
			'post_excerpt'   => $post->post_excerpt,
			'post_name'      => $post->post_name,
			'post_parent'    => $post->post_parent,
			'post_password'  => $post->post_password,
			'post_status'    => 'draft',
			'post_title'     => $post->post_title,
			'post_type'      => $post->post_type,
			'to_ping'        => $post->to_ping,
			'menu_order'     => $post->menu_order
		);
 
		/*
		 * insert the post by wp_insert_post() function
		 */
		$new_post_id = wp_insert_post( $args );
 
		/*
		 * get all current post terms ad set them to the new post draft
		 */
		$taxonomies = get_object_taxonomies($post->post_type); // returns array of taxonomy names for post type, ex array("category", "post_tag");
		foreach ($taxonomies as $taxonomy) {
			$post_terms = wp_get_object_terms($post_id, $taxonomy, array('fields' => 'slugs'));
			wp_set_object_terms($new_post_id, $post_terms, $taxonomy, false);
		}
 
		/*
		 * duplicate all post meta
		 */
		$post_meta_infos = $wpdb->get_results("SELECT meta_key, meta_value FROM $wpdb->postmeta WHERE post_id=$post_id");
		if (count($post_meta_infos)!=0) {
			$sql_query = "INSERT INTO $wpdb->postmeta (post_id, meta_key, meta_value) ";
			foreach ($post_meta_infos as $meta_info) {
				$meta_key = $meta_info->meta_key;
				$meta_value = addslashes($meta_info->meta_value);
				$sql_query_sel[]= "SELECT $new_post_id, '$meta_key', '$meta_value'";
			}
			$sql_query.= implode(" UNION ALL ", $sql_query_sel);
			$wpdb->query($sql_query);
		}
 
 
		/*
		 * finally, redirect to the edit post screen for the new draft
		 */
		wp_redirect( admin_url( 'post.php?action=edit&post=' . $new_post_id ) );
		exit;
	} else {
		wp_die('Post creation failed, could not find original post: ' . $post_id);
	}
}
add_action( 'admin_action_rd_duplicate_post_as_draft', 'rd_duplicate_post_as_draft' );
 
/*
 * Add the duplicate link to action list for post_row_actions
 */
function rd_duplicate_post_link( $actions, $post ) {
	if (current_user_can('edit_posts')) {
		$actions['duplicate'] = '<a href="admin.php?action=rd_duplicate_post_as_draft&amp;post=' . $post->ID . '" title="Duplicate this item" rel="permalink">Duplicate</a>';
	}
	return $actions;
}
 
add_filter( 'post_row_actions', 'rd_duplicate_post_link', 10, 2 );

add_action('shoestrap_content_page_override','candidates_compare');
function candidates_compare () {
    global $post;
    
    if ($post->ID == 14 ) {
        ss_get_template_part('templates/content','vibory');
    }
    else {
        ss_get_template_part( 'templates/content', 'page' );
    }
}
/**
 * We will only do the following if we are on an ADMIN page
 */
if ( is_admin() ) {
 
    /** --- Add select menu to filter by custom field in admin & add filtered column to display table ---
     * Based on: @see http://wpsnipp.com/index.php/functions-php/add-select-menu-to-filter-by-custom-field-in-admin/
     * NB: Only ba_admin_posts_filter COULD run outside the manage posts page which is why it has an extra restriction inside
     * @since 1.3.0 IT - Initial version
     *  Tidied up & wrapped in is_admin test so only loaded on admin pages,
     *  Added wildcard filtering and fixed ambiguous IF code in ba_admin_posts_filter,
     *  Added sortable column code,
     *  by Julian Knight 2012-01-09
     */
        function ba_admin_posts_filter( $query ) {
            global $pagenow;
            if ( is_admin() && $pagenow=='edit.php' && isset($_GET['ADMIN_FILTER_FIELD_NAME']) && $_GET['ADMIN_FILTER_FIELD_NAME'] != '') {
                $query->query_vars['meta_key'] = $_GET['ADMIN_FILTER_FIELD_NAME'];
                // JK: Don't actually need default value - changing filter type to LIKE shows all posts with selected custom field set to anything
                //$query->query_vars['meta_value'] = '%';
                // JK: Change filter type to 'LIKE' instead of '='
                //      Doesn't work properly, partly because WP seems to filter % and * from input fields at source.
                $query->query_vars['meta_compare'] = 'LIKE';
                if (isset($_GET['ADMIN_FILTER_FIELD_VALUE']) && $_GET['ADMIN_FILTER_FIELD_VALUE'] != '') {
                    $query->query_vars['meta_value'] = $_GET['ADMIN_FILTER_FIELD_VALUE'];
                }
            }
        }
        add_filter( 'parse_query', 'ba_admin_posts_filter' );
        function ba_admin_posts_filter_restrict_manage_posts() {
            global $wpdb;
            $sql = 'SELECT DISTINCT meta_key FROM '.$wpdb->postmeta.' ORDER BY 1';
            $fields = $wpdb->get_results($sql, ARRAY_N);
            printf( '<select name="ADMIN_FILTER_FIELD_NAME" title="%s"><option value="">%s</option>', 
                    translate('Choose a custom field name. Add value to filter. Blank value shows the column and all posts with any value. Change to 1st entry in list to remove the filter.', 'baapf'),
                    translate('Filter By Custom Fields', 'baapf')
                   );
            $current = isset($_GET['ADMIN_FILTER_FIELD_NAME'])? $_GET['ADMIN_FILTER_FIELD_NAME']:'';
            $current_v = isset($_GET['ADMIN_FILTER_FIELD_VALUE'])? $_GET['ADMIN_FILTER_FIELD_VALUE']:'';
            foreach ($fields as $field) {
                if (substr($field[0],0,1) != "_"){
                printf( '<option value="%s"%s>%s</option>',
                        $field[0],
                        $field[0] == $current? ' selected="selected"':'',
                        $field[0]
                    );
                }
            }
            printf( '</select> %s<input type="TEXT" name="ADMIN_FILTER_FIELD_VALUE" value="%s" title="%s"/>', 
                    translate('Value:', 'baapf'),
                    $current_v,
                    translate('Leave blank to show all posts with the selected custom field set to SOMETHING. Does a wildcard search.', 'baapf')
                  );
        }
        add_action( 'restrict_manage_posts', 'ba_admin_posts_filter_restrict_manage_posts' );
        /* Register a custom column (based on: @see http://scribu.net/wordpress/custom-sortable-columns.html)
            and adds it to the edit-post page
            Changed to pick up the filter column specified above (if it is), if nothing selected, nothing is added
         */
        function jk_custom_column_register( $columns ) {
            if ( isset($_GET['ADMIN_FILTER_FIELD_NAME']) && $_GET['ADMIN_FILTER_FIELD_NAME'] != '') {
                $columns[$_GET['ADMIN_FILTER_FIELD_NAME']] = __( $_GET['ADMIN_FILTER_FIELD_NAME'], 'my-plugin' );
            }
            return $columns;
        }
        add_filter( 'manage_edit-post_columns', 'jk_custom_column_register' );
        // Display the column content on the manage posts page
        function jk_custom_column_display( $column_name, $post_id ) {
            if ( isset($_GET['ADMIN_FILTER_FIELD_NAME']) && $_GET['ADMIN_FILTER_FIELD_NAME'] != '') {
                if ( $_GET['ADMIN_FILTER_FIELD_NAME'] != $column_name )
                    return;
              
                $custcol = get_post_meta($post_id, $_GET['ADMIN_FILTER_FIELD_NAME'], true);
                if ( !$custcol )
                    $custcol = '<em>' . __( 'undefined', 'my-plugin' ) . '</em>';
              
                echo $custcol;
            }
        }
        add_action( 'manage_posts_custom_column', 'jk_custom_column_display', 10, 2 );
        // How should WP sort this column?
        function jk_custom_column_orderby( $vars ) {
            if ( isset($_GET['ADMIN_FILTER_FIELD_NAME']) && $_GET['ADMIN_FILTER_FIELD_NAME'] != '') {
                if ( isset( $vars['orderby'] ) && $_GET['ADMIN_FILTER_FIELD_NAME'] == $vars['orderby'] ) {
                    $vars = array_merge( $vars, array(
                        'meta_key' => $_GET['ADMIN_FILTER_FIELD_NAME'],
                        'orderby' => 'meta_value'  // 'meta_value_num' or 'meta_value'
                    ) );
                }
            }
            return $vars;
        }
        add_filter( 'request', 'jk_custom_column_orderby' );
        // Register some extra columns as sortable on the edit posts page
        function jk_column_register_sortable( $columns ) {
            if ( isset($_GET['ADMIN_FILTER_FIELD_NAME']) && $_GET['ADMIN_FILTER_FIELD_NAME'] != '') {
                $columns[$_GET['ADMIN_FILTER_FIELD_NAME']] = $_GET['ADMIN_FILTER_FIELD_NAME'];
            }
            $columns['categories'] = 'categories';   
            // $columns['tags'] = 'tags'; // doesn't work correctly as tags are multi-valued?
            return $columns;
        }
        add_filter( 'manage_edit-post_sortable_columns', 'jk_column_register_sortable' );
    /** --- End of Filter Manage Post page by custom field --- **/
     
} // ---- End of is_admin ----


function zakogo_queryvars( $qvars )
{
    $qvars[] = 'pollstation';
    return $qvars;
}
add_filter('query_vars', 'zakogo_queryvars' );

function add_zakogo_queryvars() {
    global $wp;
    $wp->add_query_var('pollstation');
}
add_filter('init', 'add_zakogo_queryvars');


function wp_remove_events_from_admin_bar() {
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu('tribe-events');
}
add_action( 'wp_before_admin_bar_render', 'wp_remove_events_from_admin_bar' ); 


#add_filter( 'show_admin_bar', '__return_false' );

function disqus_embed($disqus_shortname) {
    global $post;
    wp_enqueue_script('disqus_embed','http://'.$disqus_shortname.'.disqus.com/embed.js');
    echo '<div id="disqus_thread"></div>
    <script type="text/javascript">
        var disqus_shortname = "'.$disqus_shortname.'";
        var disqus_title = "'.$post->post_title.'";
        var disqus_url = "'.get_permalink($post->ID).'";
        var disqus_identifier = "'.$disqus_shortname.'-'.$post->ID.'";
    </script>';
}

add_action('fu_media_approved', 'zakogo_media_approved');
function zakogo_media_approved( $image_post ) {
	$repeater_field_name = 'листівки';
	$repeater_subfield_name = 'листовка';
	
	if( $image_post->post_parent ) {
if (function_exists('w3tc_pgcache_flush_post')){
			w3tc_pgcache_flush_post($image_post->post_parent);
		}
		
		$field_ref = get_field_reference( $repeater_field_name, $image_post->post_parent );
		$field = get_field_object( $field_ref, $image_post->post_parent);
		if( $field ) {		
			$r = new acf_field_repeater();	

			$added_sub_field = apply_filters(
				'acf/format_value_for_api', 
				$image_post->ID, 
				$image_post->post_parent, 
				array( 'save_format' => 'object', 'type' => 'image') 
			);
			
			// dirty trick to get object in any case, even if URL is configured
			for( $i=0; $i< count($field['sub_fields']) ; $i++ ) {
				if( $field['sub_fields'][$i]['type']=='image') {
					$field['sub_fields'][$i]['save_format'] = 'object';
				}		
			}
			
			$values = $r->format_value_for_api( count( $field['value'] ), $image_post->post_parent, $field );
			$values[] =  array( $field['sub_fields'][0]['name'] => $added_sub_field );
			$buf = array();
			foreach( $values as $v ) {
				$sub_value = array_key_exists($repeater_subfield_name, $v) ? $v[$repeater_subfield_name] : $v ;
				$buf[] = array( $field['sub_fields'][0]['key'] => $sub_value );
			}

			$field['value'] = $buf;
			
			$r->update_value( $buf,$image_post->post_parent, $field);
			update_post_meta($image_post->post_parent, $repeater_field_name, count($values));
		}
	}
}


function dreamkyiv_coauthors_edit_author_cap() {
    return 'edit_deputy_control';
}
add_filter('coauthors_edit_author_cap', 'dreamkyiv_coauthors_edit_author_cap');


// filters for deputy_control
function decisions_for_deputy_control_object_query( $args, $field, $post )
{
    // modify the order
    $args['orderby'] = 'title';
 
    return $args;
}
add_filter('acf/fields/post_object/query/name=control_voting_decision', 'decisions_for_deputy_control_object_query', 10, 3);

function kandidat_for_deputy_control_object_query( $args, $field, $post )
{
    $kandydat = get_field('control_deputy_reference');


    if( $kandydat ) {
        $kandydat_id = url_to_postid(  $kandydat );
        if( $kandydat_id ) {
            $args['p'] = $kandydat_id;
        }
    } else {
        // select all winners
        $args['meta_query'] = array(
/*
            array(
             'key' => '_победитель',
             'compare' => 'EXISTS',
             'value' => 'field_5382ff578fef7' // This is ignored, but is necessary...
            )
*/
            array(
             'key' => 'победитель',
             'compare' => '=',
             'value' => '1'
            )

       );
       $args['post_status'] = array( 'publish' ); // show only published objects
    }

    $args['post_type'] = 'kandidat';

    // modify the order
    $args['orderby'] = 'title';
 
    return $args;
}
add_filter('acf/fields/post_object/query/name=control_deputy_reference', 'kandidat_for_deputy_control_object_query', 10, 3);

function control_acf_field_admin_head()
{
?>
<script type="text/javascript">
(function($){
    jQuery(document).ready( function() {
        $('select#acf-field-control_deputy_reference').change( function() {
            $('input#title').focus().val( $( '#acf-field-control_deputy_reference option:selected').text() );
        });
        
//        if($('select#acf-field-control_deputy_reference').val()) {
        if($('input#title').val()) {
            $('select#acf-field-control_deputy_reference').attr('disabled', 'true');
            $('input#title').attr('disabled', 'true').after("<input type=hidden name='title' is='title' value='" + $('input#title').val() + "'>");
        }
        
        $('td[data-field_name="control_voting_vote"]').css('width', '140px');

	$('td[data-field_name="control_voting_decision"] select').each( function () {
	    if( $(this).val() != 'null' ) {	    
	//        $(this).attr('disabled' ,'true');
	    }
	});

	$('td[data-field_name="control_voting_decision"] select').each( function () {
            $(this).attr('title', $(this).find("option:selected").text() );
        });

	$('td[data-field_name="control_voting_vote"] select').each( function () {
            if( $(this).val() == 'null' ) {
	        $(this).parent().parent().css('background-color', 'red');
	    }
	}).change( function () {
                if( $(this).val() == 'null' ) {
                    $(this).parent().parent().css('background-color', 'red');
                } else {
                    $(this).parent().parent().css('background-color', '');
                }
        });

	$('td[data-field_name="control_voting_decision"] select option').each( function () {
		$(this).attr('title', $(this).text() );
	});
    });
})(jQuery);
</script>
<?php
}
 
add_action('acf/input/admin_head', 'control_acf_field_admin_head');


function control_create_field( $args ) {
    if( $args['_name'] == 'control_deputy_reference' )  {
        if( $args['value'] ) {
            echo "<input name='fields[" .$args['key']. "]' type=hidden value='" .$args['value']. "'>";
        }
    }
}
add_action( 'acf/create_field', 'control_create_field', 10, 1 );


function my_posts_where( $where )
{
//error_log( $where );
    $where = str_replace("meta_key = 'control_voting_%_control_voting_decision'", "meta_key LIKE 'control_voting_%_control_voting_decision'", $where);
    return $where;
} 
add_filter('posts_where', 'my_posts_where');

function get_avatar_url($author_id, $size){
    $get_avatar = get_avatar( $author_id, $size );
    preg_match("/src='(.*?)'/i", $get_avatar, $matches);
    return ( $matches[1] );
}

// Post views counter
function getPostViews($postID){
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0 View";
    }
    return $count.' Views';
}
function setPostViews($postID) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}
// Remove issues with prefetching adding extra views
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

//End post views counter


function pre_navbar_header() {
   $html ='';

   $html .='<div class="pre-nav">';
   $html .='<ul class="tmenu"><li><a href="/">Головна</a></li><li><a href="http://dreamkyiv.com/about/">Про проект</a></li><li><a href="http://dreamkyiv.com/kontakty/">Контакти</a></li></ul><div class="top-donate"><ul class="top-donate"><li><a href="https://dreamkyiv.payplug.in/">Допомогти проекту!</a></li></ul></div>';
   $html .='</div>';

   echo $html;
}
add_action( 'shoestrap_pre_top_bar', 'pre_navbar_header' );

/**

* Check if child LESS has changed and recompile if necessary.

*/

function always_compile_less () {


 // Check if the Compile LESS option is turned on

if ( shoestrap_getvariable( 'always_compile_less' ) == 1 ) {


 // Render if either the timestamp file doesn't exist, or the modified time of the less file is greater than the timestamp

if ( !file_exists(get_stylesheet_directory() . '/assets/less/last_rendered') || ( filemtime(get_stylesheet_directory() . '/assets/less/child.less') > file_get_contents(get_stylesheet_directory() . '/assets/less/last_rendered') ) ) {


 // Render

shoestrap_makecss();


 // Dump the less file's modified time into the timestamp

file_put_contents(get_stylesheet_directory() . '/assets/less/last_rendered', filemtime(get_stylesheet_directory() . '/assets/less/child.less'));


 }


 }

}

add_action( 'wp', 'always_compile_less' );