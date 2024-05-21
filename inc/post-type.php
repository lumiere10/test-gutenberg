<?php 

// Register Custom Post Type
function custom_post_type_cars() {
    $labels = array(
        'name' => 'Cars',
        'singular_name' => 'Car',
        'menu_name' => 'Cars',
        'add_new' => 'Add New',
        'add_new_item' => 'Add New Car',
        'edit_item' => 'Edit Car',
        'new_item' => 'New Car',
        'view_item' => 'View Car',
        'search_items' => 'Search Cars',
        'not_found' => 'No Cars found',
        'not_found_in_trash' => 'No Cars found in Trash',
        'all_items' => 'All Cars',
    );
    $args = array(
        'label' => 'Car',
        'description' => 'Post Type for Cars',
        'labels' => $labels,
        'supports' => array('title', 'editor', 'thumbnail', 'custom-fields'),
        'public' => true,
        'show_ui' => true,
        'menu_position' => 5,
        'menu_icon' => 'dashicons-car',
        'has_archive' => true,
    );
    register_post_type('car', $args);
}

add_action('init', 'custom_post_type_cars', 0);

// Register  Taxonomies
function custom_taxonomies_cars() {
    // Brand 
    $labels_brand = array(
        'name' => 'Brands',
        'singular_name' => 'Brand',
        'menu_name' => 'Brand',
    );
    $args_brand = array(
        'labels' => $labels_brand,
        'hierarchical' => true,
        'public' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'brand'),
    );
    register_taxonomy('brand', array('car'), $args_brand);

    // Type 
    $labels_car_type = array(
        'name' => 'Car Types',
        'singular_name' => 'Car Type',
        'menu_name' => 'Car Type',
    );
    $args_car_type = array(
        'labels' => $labels_car_type,
        'hierarchical' => true,
        'public' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'car-type'),
    );
    register_taxonomy('car_type', array('car'), $args_car_type);

    // Color 
    $labels_color = array(

        'name' => 'Colors',
        'singular_name' => 'Color',
        'menu_name' => 'Color',
    );
    $args_color = array(
        'labels' => $labels_color,
        'hierarchical' => true,
        'public' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'color'),
    );
    register_taxonomy('color', array('car'), $args_color);

    // Year 
    $labels_year = array(
        'name' => 'Years',
        'singular_name' => 'Year',
        'menu_name' => 'Year',
    );
    $args_year = array(
        'labels' => $labels_year,
        'hierarchical' => true,
        'public' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'year'),
    );
    register_taxonomy('year', array('car'), $args_year);
}
add_action('init', 'custom_taxonomies_cars', 0);

?>