<?php

$args = array(
    'post_type'      => 'car',
    'posts_per_page' => 4,
);

$tax_query = array();

if (isset($_POST['filter_brand']) && !empty($_POST['filter_brand'])) {
    $tax_query[] = array(
        'taxonomy' => 'brand',
        'field'    => 'slug', 
        'terms'    => sanitize_text_field($_POST['filter_brand']),
    );
}
if (isset($_POST['filter_car_type']) && !empty($_POST['filter_car_type'])) {
    $tax_query[] = array(
        'taxonomy' => 'car_type',
        'field'    => 'slug', 
        'terms'    => sanitize_text_field($_POST['filter_car_type']),
    );
}
if (isset($_POST['filter_color']) && !empty($_POST['filter_color'])) {
    $tax_query[] = array(
        'taxonomy' => 'color',
        'field'    => 'slug', 
        'terms'    => sanitize_text_field($_POST['filter_color']),
    );
}
if (isset($_POST['filter_year']) && !empty($_POST['filter_year'])) {
    $tax_query[] = array(
        'taxonomy' => 'year',
        'field'    => 'slug', 
        'terms'    => sanitize_text_field($_POST['filter_year']),
    );
}

if (!empty($tax_query)) {
    $args['tax_query'] = array(
        'relation' => 'AND',
        $tax_query,
    );
}

if (isset($_POST['filter_price']) && !empty($_POST['filter_price'])) {
    $args['meta_query'] = array(
        array(
            'key'     => 'price_car',
            'value'   => sanitize_text_field($_POST['filter_price']),
            'compare' => '=', 
            'type'    => 'NUMERIC',
        ),
    );
}

$query = new WP_Query($args);

$brand_terms_name = array();
$car_type_terms_name = array();
$year_terms_name = array();
$color_terms_name = array();
$price_values = array();


foreach ($query->posts as $post_id) {
    $brand_terms = get_the_terms($post_id, 'brand');
    if (!empty($brand_terms) && !is_wp_error($brand_terms)) {
        foreach ($brand_terms as $term) {
            $brand_terms_name[] = $term->name;
        }
    }
    $car_type_terms = get_the_terms($post_id, 'car_type');
    if (!empty($car_type_terms) && !is_wp_error($car_type_terms)) {
        foreach ($car_type_terms as $term) {
            $car_type_terms_name[] = $term->name;
        }
    }
    $year_terms = get_the_terms($post_id, 'year');
    if (!empty($year_terms) && !is_wp_error($year_terms)) {
        foreach ($year_terms as $term) {
            $year_terms_name[] = $term->name;
        }
    }
    $color_terms = get_the_terms($post_id, 'color');
    if (!empty($color_terms) && !is_wp_error($color_terms)) {
        foreach ($color_terms as $term) {
            $color_terms_name[] = $term->name;
        }
    }
    $price = get_field('price_car', $post_id);
    if ($price) {
        $price_values[] = $price;
    }
}

$brand_terms_name = array_unique($brand_terms_name);
$car_type_terms_name = array_unique($car_type_terms_name);
$year_terms_name = array_unique($year_terms_name);
$color_terms_name = array_unique($color_terms_name);
$price_values = array_unique($price_values);
// var_dump($query);
?>
<div class="latest-cars">
    <h2>Latest Cars</h2>
    <form id="car-filter-form" method="post">
        <div class="wrapper_form">
            <label><?php echo 'Filter by Brand:'; ?>
                <select name="filter_brand" id="filter_brand">
                    <option value=""><?php echo 'Select Brand'; ?></option>
                    <?php foreach ($brand_terms_name as $brand) : ?>
                    <option value="<?php echo esc_attr($brand); ?>" <?php selected($_POST['filter_brand'], $brand); ?>>
                        <?php echo esc_html($brand); ?> </option>
                    <?php endforeach; ?>
                </select>
            </label>

            <label><?php echo 'Filter by Car Type:'; ?>
                <select name="filter_car_type" id="filter_car_type">
                    <option value=""><?php echo 'Select Car Type'; ?></option>
                    <?php foreach ($car_type_terms_name as $car_type) : ?>
                    <option value="<?php echo esc_attr($car_type); ?>"
                        <?php selected($_POST['filter_car_type'], $car_type); ?>> <?php echo esc_html($car_type); ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </label>

            <label><?php echo 'Filter by Color:'; ?>
                <select name="filter_color" id="filter_color">
                    <option value=""><?php echo 'Select Color'; ?></option>
                    <?php foreach ($color_terms_name as $color) : ?>
                    <option value="<?php echo esc_attr($color); ?>" <?php selected($_POST['filter_color'], $color); ?>>
                        <?php echo esc_html($color); ?> </option>
                    <?php endforeach; ?>
                </select>
            </label>

            <label><?php echo 'Filter by Year:'; ?>
                <select name="filter_year" id="filter_year">
                    <option value=""><?php echo 'Select Year'; ?></option>
                    <?php foreach ($year_terms_name as $year) : ?>
                    <option value="<?php echo esc_attr($year); ?>" <?php selected($_POST['filter_year'], $year); ?>>
                        <?php echo esc_html($year); ?> </option>
                    <?php endforeach; ?>
                </select>
            </label>

            <label><?php echo 'Max Price:'; ?>
                <select name="filter_price" id="filter_price">
                    <option value=""><?php echo 'Select price'; ?></option>
                    <?php foreach ($price_values as $price) : ?>
                    <option value="<?php echo esc_attr($price); ?>" <?php selected($_POST['filter_price'], $price); ?>>
                        <?php echo esc_html($price); ?> </option>
                    <?php endforeach; ?>
                </select>
            </label>
        </div>
        <div class="buttons">
            <button type="submit"><?php echo 'Apply Filters'; ?></button>
            <button type="button" class="clear_filters"><?php echo 'Clear Filters'; ?></button>
        </div>
    </form>
    <?php if ($query->have_posts()) : ?>
    <div class="car-cards">
        <?php while ($query->have_posts()) : $query->the_post(); 
        $price = get_field('price_car', get_the_ID()); ?>
        <div class="car-cards-item">
            <?php if (has_post_thumbnail()): echo the_post_thumbnail('medium'); ?>
            <?php endif; ?>
            <h3><?php echo the_title(); ?></h3>
            <p><?php echo the_excerpt(); ?></p>
            <p>Price: <?php echo esc_html($price); ?></p>
        </div>
        <?php endwhile; ?>
    </div>
    <?php else : ?>
    <p>No cars found</p>
    <?php endif; 
     wp_reset_postdata(); ?>