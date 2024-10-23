<?php
//Style CSS Enqueue
function assessment_enqueue_styles()
{
    wp_enqueue_style('style', get_stylesheet_uri(), array(), filemtime(get_stylesheet_directory() . '/style.css'));
}
add_action('wp_enqueue_scripts', 'assessment_enqueue_styles');

//Menu reqister

register_nav_menu('primary', __('Navigation Menu', 'assessment'));

//Thumbnail Support
add_theme_support('post-thumbnails');

// Add dropdown functionality to menu items with children
function assessment_add_dropdown_attributes($atts, $item, $args)
{
    if (in_array('menu-item-has-children', $item->classes)) {
        $atts['aria-haspopup'] = "true";
        $atts['aria-expanded'] = "false";
        $atts['class'] = 'has-dropdown';
    }

    return $atts;
}
add_filter('nav_menu_link_attributes', 'assessment_add_dropdown_attributes', 10, 3);

function assessment_enqueue_dropdown_script()
{
    wp_enqueue_script('ajax-script', get_template_directory_uri() . '/js/custom.js', array('jquery'), filemtime(get_stylesheet_directory() . '/js/custom.js'), true);
    wp_localize_script('ajax-script', 'my_ajax_object', array(
        'ajax_url' => admin_url('admin-ajax.php')
    ));
}
add_action('wp_enqueue_scripts', 'assessment_enqueue_dropdown_script');

//Project Custom Post Type

function create_custom_projects_post_type()
{
    $labels = array(
        'name' => _x('Projects', 'Post type general name', 'assessment'),
        'singular_name' => _x('Project', 'Post type singular name', 'assessment'),
        'menu_name' => _x('Projects', 'Admin Menu text', 'assessment'),
        'name_admin_bar' => _x('Project', 'Add New on Toolbar', 'assessment'),
        'add_new' => __('Add New', 'assessment'),
        'add_new_item' => __('Add New Project', 'assessment'),
        'new_item' => __('New Project', 'assessment'),
        'edit_item' => __('Edit Project', 'assessment'),
        'view_item' => __('View Project', 'assessment'),
        'all_items' => __('All Projects', 'assessment'),
        'search_items' => __('Search Projects', 'assessment'),
        'parent_item_colon' => __('Parent Projects:', 'assessment'),
        'not_found' => __('No projects found.', 'assessment'),
        'not_found_in_trash' => __('No projects found in Trash.', 'assessment'),
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'projects'),
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => 5,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
        'show_in_rest' => true,
        'rest_base' => 'projects',
        'rest_controller_class' => 'WP_REST_Posts_Controller',
    );

    register_post_type('projects', $args);
}
add_action('init', 'create_custom_projects_post_type');

//API fetch data function

function customize_projects_api_response($response, $post, $request)
{
    if ($post->post_type === 'projects') {
        $post_id = $post->ID;

        $custom_data = array(
            'project_name' => get_post_meta($post_id, 'project_name', true),
            'project_url' => get_post_meta($post_id, 'project_url', true),
            'project_start_date' => get_post_meta($post_id, 'project_start_date', true),
            'project_end_date' => get_post_meta($post_id, 'project_end_date', true),
        );

        return rest_ensure_response($custom_data);
    }

    return $response;
}
add_filter('rest_prepare_projects', 'customize_projects_api_response', 10, 3);

//Filter Projects
function filter_projects_ajax()
{

    $start_date = isset($_POST['start_date']) ? sanitize_text_field($_POST['start_date']) : '';
    $end_date = isset($_POST['end_date']) ? sanitize_text_field($_POST['end_date']) : '';

    $args = array(
        'post_type' => 'projects',
        'posts_per_page' => -1,
        'meta_query' => array(
            'relation' => 'AND',
        ),
    );

    if (!empty($start_date)) {
        $args['meta_query'][] = array(
            'key' => 'project_start_date',
            'value' => $start_date,
            'compare' => '>=',
            'type' => 'DATE',
        );
    }

    if (!empty($end_date)) {
        $args['meta_query'][] = array(
            'key' => 'project_end_date',
            'value' => $end_date,
            'compare' => '<=',
            'type' => 'DATE',
        );
    }

    $loop_items = new WP_Query($args);

    if ($loop_items->have_posts()) {
        while ($loop_items->have_posts()) {
            $loop_items->the_post();
            $permalink = get_field('project_url', $loop_items->ID);
            $title = get_field('project_name', $loop_items->ID);
            $discription = get_field('project_description', $loop_items->ID);
            $startdate = get_field('project_start_date', $loop_items->ID);
            $enddate = get_field('project_end_date', $loop_items->ID);
            $image = wp_get_attachment_image_src(get_post_thumbnail_id($loop_items->ID), 'single-post-thumbnail');
            echo '<div class="col4">
        <div class="loop-post">
            <img src="' . $image[0] . '" alt="" class="img-responsive">
            <h3><a href="' . esc_url($permalink) . '">' . $title . '</a></h3>
            <p>' . wp_trim_words($discription, 10, "...") . '</p>
            <span class="custom-data"><strong>Start Date:</strong>' . $startdate . '</span>
            <span class="custom-data"><strong>End Date:</strong>' . $enddate . '</span>
            <a href="' . esc_url($permalink) . '" class="read-more-btn">Read More</a>
        </div>    
        </div>';

        }
    } else {
        echo '<p>No projects found.</p>';
    }

    wp_reset_postdata();

    die();
}
add_action('wp_ajax_filter_projects', 'filter_projects_ajax');
add_action('wp_ajax_nopriv_filter_projects', 'filter_projects_ajax');