<?php

/*
 * Register plugin helpers.
 */
require __DIR__.'/library/plate.php';

/*
 * Set theme defaults.
 */
add_action('after_setup_theme', function () {
    // Show the admin bar.
    show_admin_bar(false);

    // Add post thumbnails support.
    add_theme_support('post-thumbnails');

    // Add support for post formats.
    //add_theme_support('post-formats', ['aside', 'audio', 'gallery', 'image', 'link', 'quote', 'video']);

    // Add title tag theme support.
    add_theme_support('title-tag');

    // Add HTML5 support.
    add_theme_support('html5', [
        'caption',
        'comment-form',
        'comment-list',
        'gallery',
        'search-form',
        'widgets',
    ]);

    // Add primary WordPress menu.
    register_nav_menu('navigation', __('Primary Menu', 'wordplate'));
    register_nav_menu('navigation-sub', __('Primary Sub Menu', 'wordplate'));
});

/*
 * Enqueue and register scripts the right way.
 */
add_action('wp_enqueue_scripts', function () {
    // wp_deregister_script('jquery');

    wp_enqueue_style( 'google-fonts', '//fonts.googleapis.com/css?family=PT+Sans+Narrow|Oswald:400,700', false );
    wp_enqueue_style('wordplate', elixir('styles/app.css'));

    wp_register_script('wordplate', elixir('scripts/app.js'), array('jquery'), '', true);
    wp_enqueue_script('wordplate', 'google-fonts');
});

/*
 * Set custom title.
 */
add_filter('wp_title', function () {
    global $post;

    $name = get_bloginfo('name');
    $description = get_bloginfo('description');

    if (is_front_page() || is_home()) {
        if ($description) {
            return sprintf('%s - %s', $name, $description);
        }

        return $name;
    }

    if (is_category()) {
        return sprintf('%s - %s', trim(single_cat_title('', false)), $name);
    }

    return sprintf('%s - %s', trim($post->post_title), $name);
});

/*
 * Set custom excerpt more.
 */
add_filter('excerpt_more', function () {
    return '...';
});

/*
 * Set custom excerpt length.
 */
add_filter('excerpt_length', function () {
    return 101;
});

function menu_classes($classes, $item, $args) {
    if($args->theme_location == 'navigation') {
      $classes[] = 'nav-item';
    }
    return $classes;
  }
add_filter('nav_menu_css_class', 'menu_classes', 1, 3);

function sub_menu_classes($classes, $item, $args) {
    if($args->theme_location == 'navigation-sub') {
      $classes[] = 'navigation__sub-item';
    }
    return $classes;
  }
add_filter('nav_menu_css_class', 'sub_menu_classes', 1, 3);


// Register Custom Post Type
function custom_post_type() {

	$labels = array(
		'name'                  => _x( 'Thinking Posts', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'Thinking Post', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Thinking Posts', 'text_domain' ),
		'name_admin_bar'        => __( 'Thinking Posts', 'text_domain' ),
		'archives'              => __( 'Item Archives', 'text_domain' ),
		'attributes'            => __( 'Item Attributes', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),
		'all_items'             => __( 'All Items', 'text_domain' ),
		'add_new_item'          => __( 'Add New Item', 'text_domain' ),
		'add_new'               => __( 'Add New', 'text_domain' ),
		'new_item'              => __( 'New Item', 'text_domain' ),
		'edit_item'             => __( 'Edit Item', 'text_domain' ),
		'update_item'           => __( 'Update Item', 'text_domain' ),
		'view_item'             => __( 'View Item', 'text_domain' ),
		'view_items'            => __( 'View Items', 'text_domain' ),
		'search_items'          => __( 'Search Item', 'text_domain' ),
		'not_found'             => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Featured Image', 'text_domain' ),
		'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
		'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
		'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
		'items_list'            => __( 'Items list', 'text_domain' ),
		'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
	);
	$args = array(
		'label'                 => __( 'Thinking Post', 'text_domain' ),
		'description'           => __( 'Post Type Description', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'excerpt', 'page-attributes' ),
		'hierarchical'          => true,
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
		'show_in_rest'          => true,
	);
    register_post_type( 'Featured', $args );
    

    $labels2 = array(
		'name'                  => _x( 'Principle Posts', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'Principle Post', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Principle Posts', 'text_domain' ),
		'name_admin_bar'        => __( 'Principle Posts', 'text_domain' ),
		'archives'              => __( 'Item Archives', 'text_domain' ),
		'attributes'            => __( 'Item Attributes', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),
		'all_items'             => __( 'All Items', 'text_domain' ),
		'add_new_item'          => __( 'Add New Item', 'text_domain' ),
		'add_new'               => __( 'Add New', 'text_domain' ),
		'new_item'              => __( 'New Item', 'text_domain' ),
		'edit_item'             => __( 'Edit Item', 'text_domain' ),
		'update_item'           => __( 'Update Item', 'text_domain' ),
		'view_item'             => __( 'View Item', 'text_domain' ),
		'view_items'            => __( 'View Items', 'text_domain' ),
		'search_items'          => __( 'Search Item', 'text_domain' ),
		'not_found'             => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Featured Image', 'text_domain' ),
		'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
		'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
		'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
		'items_list'            => __( 'Items list', 'text_domain' ),
		'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
	);
	$args2 = array(
		'label'                 => __( 'Principle Post', 'text_domain' ),
		'description'           => __( 'Post Type Description', 'text_domain' ),
		'labels'                => $labels2,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'excerpt', 'page-attributes' ),
		'hierarchical'          => true,
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
		'show_in_rest'          => true,
	);
	register_post_type( 'Principles', $args2 );

}
add_action( 'init', 'custom_post_type', 0 );


