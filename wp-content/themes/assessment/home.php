<?php
/**
 * Template Name: Home
 *
 * @package WordPress
 * @subpackage assessment
 */
get_header();
?>
<section class="banner-section">
    <div class="banner">
        <div class="banner-img">
            <?php
            $banner_img = get_field('banner');
            $banner_text = get_field('banner_text');
            $banner_btntext = get_field('button_text');
            $banner_url = get_field('button_url');
            if ($banner_img) {
                ?>
                <img src="<?php echo the_field('banner'); ?>" class="bannerimg">
            <?php } ?>
            <div class="container">
                <div class="banner-caption">
                    <?php if ($banner_text) { ?>
                        <h1><?php echo the_field('banner_text'); ?></h1>
                    <?php } ?>
                    <div classs="banner-btn">
                        <a href="#" class="link-btn">Read More </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
$project_posts = get_field('project_posts');
if ($project_posts) { ?>
    <section class="project-section space">
        <div class="container">
            <h2 class="section-heading">Our Project...</h2>

            <div class="row">

                <?php foreach ($project_posts as $project) {
                    $permalink = get_field('project_url', $project->ID);
                    $title = get_field('project_name', $project->ID);
                    $discription = get_field('project_description', $project->ID);
                    $startdate = get_field('project_start_date', $project->ID);
                    $enddate = get_field('project_end_date', $project->ID);
                    $image = wp_get_attachment_image_src(get_post_thumbnail_id($project->ID), 'single-post-thumbnail');
                    ?>
                    <div class="col4">
                        <div class="loop-post">
                            <?php if ($image) { ?>
                                <img src="<?php echo $image[0]; ?>" alt="" class="img-responsive">
                            <?php } ?>
                            <?php if ($title) { ?>
                                <h3><a
                                        href="<?php echo esc_url($permalink); ?>"><?php echo the_field('project_name', $project->ID); ?></a>
                                </h3>
                            <?php } ?>
                            <?php if ($discription) { ?>
                                <p><?php echo wp_trim_words($discription, 10, '...'); ?></p>
                            <?php } ?>
                            <?php if ($startdate) { ?>
                                <span class="custom-data"><strong>Start Date:</strong><?php echo $startdate; ?></span>
                            <?php } ?>
                            <?php if ($enddate) { ?>
                                <span class="custom-data"><strong>End Date:</strong><?php echo $enddate; ?></span>
                            <?php } ?>
                            <?php if ($permalink) { ?>
                                <a href="<?php echo esc_url($permalink); ?>" class="read-more-btn">Read More</a>
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>
            </div>

        </div>
    </section>
<?php } ?>
<?php
$section_title = get_field('section_title');
$section_description = get_field('section_description');
$section_button_text = get_field('section_button_text');
$section_button_url = get_field('section_button_url');
$section_image = get_field('section_image');

if ($section_title) {
    ?>
    <section class="creative-concept">
        <div class="container">
            <div class="row">

                <div class="col6 concept-text">
                    <?php if ($section_title) { ?>
                        <h3 class="section-heading"><?php echo $section_title; ?></h3>
                    <?php } ?>
                    <?php if ($section_description) { ?>
                        <?php echo $section_description; ?>
                    <?php } ?>
                    <?php if ($section_button_text) { ?>
                        <a href="<?php echo $section_button_url; ?>"
                            class="link-btn marginzero"><?php echo $section_button_text; ?></a>
                    <?php } ?>
                </div>

                <div class="col6 concept-image">
                    <?php if ($section_image) { ?>
                        <img src="<?php echo $section_image; ?>" alt="">
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>
<?php } ?>
<?php
$blog_posts = get_field('blogs');
if ($blog_posts) { ?>
    <section class="project-section space">
        <div class="container">
            <h2 class="section-heading">Our Blog...</h2>

            <div class="row">

                <?php foreach ($blog_posts as $blog) {
                    $permalink = get_the_permalink($blog->ID);
                    $title = get_the_title($blog->ID);
                    $discription = $blog->post_content;
                    $image = wp_get_attachment_image_src(get_post_thumbnail_id($blog->ID), 'single-post-thumbnail');
                    ?>
                    <div class="col4">
                        <div class="loop-post blog">
                            <?php if ($image) { ?>
                                <img src="<?php echo $image[0]; ?>" alt="" class="img-responsive">
                            <?php } ?>
                            <?php if ($title) { ?>
                                <h3><a href="<?php echo esc_url($permalink); ?>"><?php echo $title; ?></a></h3>
                            <?php } ?>
                            <?php if ($discription) { ?>
                                <p><?php echo wp_trim_words($discription, 20, '...'); ?></p>
                            <?php } ?>
                            <?php if ($permalink) { ?>
                                <a href="<?php echo esc_url($permalink); ?>" class="read-more-btn">Read More</a>
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>
            </div>

        </div>
    </section>
<?php } ?>
<?php
$contact_us_heading_text = get_field('contact_us_heading_text');
$contact_us_form_shortcode = get_field('contact_us_form_shortcode');
if ($contact_us_heading_text) {
    ?>
    <section class="contact">
        <div class="container">
            <div class="row">
                <div class="col12">
                    <h3 class="section-heading"><?php echo $contact_us_heading_text; ?></h3>
                </div>
                <div class="col-sm-12 wow fadeInUp">
                    <?php echo do_shortcode($contact_us_form_shortcode); ?>
                </div>
            </div>
        </div>
    </section>
<?php } ?>
<?php
get_footer();