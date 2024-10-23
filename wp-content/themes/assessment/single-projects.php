<?php
get_header(); ?>
<?php
// Start the loop.
while (have_posts()):
    the_post();
    $permalink = get_field('project_url', get_the_ID());
    $title = get_field('project_name', get_the_ID());
    $discription = get_field('project_description', get_the_ID());
    $startdate = get_field('project_start_date', get_the_ID());
    $enddate = get_field('project_end_date', get_the_ID());
    $image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'single-post-thumbnail');
    ?>
    <div class="single-post">


        <div class="post-data">
            <div class="post-content">
                <?php if ($image) { ?>
                    <div class="post-thumbnail" style="background-image: url('<?php echo $image[0]; ?>');">
                        <h1><?php the_title(); ?></h1>
                    </div>
                <?php } ?>
                <div class="container">
                    <div class="author-details">
                        <span class="startdate">Start Date: <?php echo $startdate; ?></span>
                        <span class="enddate">End Date: <?php echo $enddate; ?></span>
                    </div>
                    <div class="post-img">
                        <img src="<?php echo $image[0]; ?>" width="100%">
                    </div>
                    <div class="detail-content">
                        <?php echo $discription; ?>
                    </div>
                </div>
            </div>

            <div class="post-comments">
                <div class="container">
                    <?php comments_template(); ?>
                </div>
            </div>

        </div>
    <?php endwhile; ?>
    <?php get_footer(); ?>