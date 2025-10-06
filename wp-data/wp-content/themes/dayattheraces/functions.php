<?php
/**
 * Day at the Races Theme Functions
 */

// Theme Setup
function dayattheraces_setup() {
    // Add theme support
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));
    add_theme_support('custom-logo');
    
    // Register navigation menus
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'dayattheraces'),
        'footer' => __('Footer Menu', 'dayattheraces'),
    ));
}
add_action('after_setup_theme', 'dayattheraces_setup');

// Enqueue styles and scripts
function dayattheraces_scripts() {
    wp_enqueue_style('dayattheraces-style', get_stylesheet_uri(), array(), '1.0.0');
    wp_enqueue_script('dayattheraces-script', get_template_directory_uri() . '/js/main.js', array(), '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'dayattheraces_scripts');

// Register widget areas
function dayattheraces_widgets_init() {
    register_sidebar(array(
        'name'          => __('Footer Widget Area 1', 'dayattheraces'),
        'id'            => 'footer-1',
        'description'   => __('Add widgets here to appear in your footer.', 'dayattheraces'),
        'before_widget' => '<div class="footer-widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
    
    register_sidebar(array(
        'name'          => __('Footer Widget Area 2', 'dayattheraces'),
        'id'            => 'footer-2',
        'description'   => __('Add widgets here to appear in your footer.', 'dayattheraces'),
        'before_widget' => '<div class="footer-widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
    
    register_sidebar(array(
        'name'          => __('Footer Widget Area 3', 'dayattheraces'),
        'id'            => 'footer-3',
        'description'   => __('Add widgets here to appear in your footer.', 'dayattheraces'),
        'before_widget' => '<div class="footer-widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
}
add_action('widgets_init', 'dayattheraces_widgets_init');

// Custom post type for Events
function dayattheraces_register_events() {
    $labels = array(
        'name'               => 'Events',
        'singular_name'      => 'Event',
        'menu_name'          => 'Events',
        'add_new'            => 'Add New',
        'add_new_item'       => 'Add New Event',
        'edit_item'          => 'Edit Event',
        'new_item'           => 'New Event',
        'view_item'          => 'View Event',
        'search_items'       => 'Search Events',
        'not_found'          => 'No events found',
        'not_found_in_trash' => 'No events found in Trash',
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'has_archive'        => true,
        'publicly_queryable' => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'events'),
        'capability_type'    => 'post',
        'hierarchical'       => false,
        'menu_icon'          => 'dashicons-calendar-alt',
        'supports'           => array('title', 'editor', 'thumbnail', 'excerpt'),
    );

    register_post_type('event', $args);
}
add_action('init', 'dayattheraces_register_events');

// Custom post type for Partners
function dayattheraces_register_partners() {
    $labels = array(
        'name'               => 'Partners',
        'singular_name'      => 'Partner',
        'menu_name'          => 'Partners',
        'add_new'            => 'Add New',
        'add_new_item'       => 'Add New Partner',
        'edit_item'          => 'Edit Partner',
        'new_item'           => 'New Partner',
        'view_item'          => 'View Partner',
        'search_items'       => 'Search Partners',
        'not_found'          => 'No partners found',
        'not_found_in_trash' => 'No partners found in Trash',
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'has_archive'        => false,
        'publicly_queryable' => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'partners'),
        'capability_type'    => 'post',
        'hierarchical'       => false,
        'menu_icon'          => 'dashicons-groups',
        'supports'           => array('title', 'thumbnail'),
    );

    register_post_type('partner', $args);
}
add_action('init', 'dayattheraces_register_partners');

// Custom post type for Reviews
function dayattheraces_register_reviews() {
    $labels = array(
        'name'               => 'Reviews',
        'singular_name'      => 'Review',
        'menu_name'          => 'Reviews',
        'add_new'            => 'Add New',
        'add_new_item'       => 'Add New Review',
        'edit_item'          => 'Edit Review',
        'new_item'           => 'New Review',
        'view_item'          => 'View Review',
        'search_items'       => 'Search Reviews',
        'not_found'          => 'No reviews found',
        'not_found_in_trash' => 'No reviews found in Trash',
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'has_archive'        => false,
        'publicly_queryable' => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'reviews'),
        'capability_type'    => 'post',
        'hierarchical'       => false,
        'menu_icon'          => 'dashicons-star-filled',
        'supports'           => array('title', 'editor'),
    );

    register_post_type('review', $args);
}
add_action('init', 'dayattheraces_register_reviews');

// Add custom fields meta box for reviews
function dayattheraces_add_review_meta_boxes() {
    add_meta_box(
        'review_rating',
        'Review Rating',
        'dayattheraces_review_rating_callback',
        'review',
        'side',
        'default'
    );
}
add_action('add_meta_boxes', 'dayattheraces_add_review_meta_boxes');

function dayattheraces_review_rating_callback($post) {
    wp_nonce_field('dayattheraces_save_review_rating', 'dayattheraces_review_rating_nonce');
    $rating = get_post_meta($post->ID, '_review_rating', true);
    ?>
    <label for="review_rating">Rating (1-5):</label>
    <select name="review_rating" id="review_rating">
        <?php for ($i = 1; $i <= 5; $i++) : ?>
            <option value="<?php echo $i; ?>" <?php selected($rating, $i); ?>><?php echo $i; ?> Stars</option>
        <?php endfor; ?>
    </select>
    <?php
}

function dayattheraces_save_review_rating($post_id) {
    if (!isset($_POST['dayattheraces_review_rating_nonce'])) {
        return;
    }
    if (!wp_verify_nonce($_POST['dayattheraces_review_rating_nonce'], 'dayattheraces_save_review_rating')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    if (isset($_POST['review_rating'])) {
        update_post_meta($post_id, '_review_rating', sanitize_text_field($_POST['review_rating']));
    }
}
add_action('save_post', 'dayattheraces_save_review_rating');

// Add custom fields for events
function dayattheraces_add_event_meta_boxes() {
    add_meta_box(
        'event_date',
        'Event Date',
        'dayattheraces_event_date_callback',
        'event',
        'side',
        'default'
    );
}
add_action('add_meta_boxes', 'dayattheraces_add_event_meta_boxes');

function dayattheraces_event_date_callback($post) {
    wp_nonce_field('dayattheraces_save_event_date', 'dayattheraces_event_date_nonce');
    $date = get_post_meta($post->ID, '_event_date', true);
    ?>
    <label for="event_date">Event Date:</label>
    <input type="date" name="event_date" id="event_date" value="<?php echo esc_attr($date); ?>" />
    <?php
}

function dayattheraces_save_event_date($post_id) {
    if (!isset($_POST['dayattheraces_event_date_nonce'])) {
        return;
    }
    if (!wp_verify_nonce($_POST['dayattheraces_event_date_nonce'], 'dayattheraces_save_event_date')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    if (isset($_POST['event_date'])) {
        update_post_meta($post_id, '_event_date', sanitize_text_field($_POST['event_date']));
    }
}
add_action('save_post', 'dayattheraces_save_event_date');
