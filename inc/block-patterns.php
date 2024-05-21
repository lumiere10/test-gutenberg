<?php


// Register blocks for gutenberg 

function custom_gutenberg_block() {
    if (function_exists('acf_register_block')) {
        acf_register_block(array(
            'name' => 'latest-cars', 
            'title' => __('Latest Cars'), 
            'render_template' => './blocks/latest-cars.php', 
            'category' => 'formatting',
            'icon' => 'admin-generic', 
        ));
    }
}
add_action('acf/init', 'custom_gutenberg_block');

//Register shortcode [latest_cars]

function latest_cars_shortcode() {
    ob_start();
    get_template_part('blocks/latest', 'cars');
    return ob_get_clean();
}
add_shortcode('latest_cars', 'latest_cars_shortcode');