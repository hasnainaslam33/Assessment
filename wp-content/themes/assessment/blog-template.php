<?php
/*
Template Name: Blog Template
*/

get_header(); ?>
<?php $image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'single-post-thumbnail'); ?>
<div class="blog-content">
    <div class="template-header" style="background-image: url('<?php echo $image[0]; ?>');">
        <h1><?php the_title(); ?></h1>
    </div>

    <div class="container">
        <div class="blog-section space">
            <?php
            $pagination = (get_query_var('paged')) ? get_query_var('paged') : 1;
            $args = array(
                'post_type' => 'post',
                'posts_per_page' => 6,
                'paged' => $pagination
            );
            $loop_items = new WP_Query($args);

            if ($loop_items->have_posts()): ?>
                <div class="row">
                    <?php while ($loop_items->have_posts()):
                        $loop_items->the_post();
                        $permalink = get_the_permalink($loop_items->ID);
                        $title = get_the_title($loop_items->ID);
                        $discription = get_the_content();
                        $image = wp_get_attachment_image_src(get_post_thumbnail_id($loop_items->ID), 'single-post-thumbnail');
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
                    <?php endwhile; ?>

                    <!-- Pagination -->
                    <div class="pagination">
                        <?php
                        echo paginate_links(array(
                            'total' => $loop_items->max_num_pages
                        ));
                        ?>
                    </div>

                </div>
            <?php else: ?>
                <p>No blog posts found</p>
            <?php endif; ?>

            <?php wp_reset_postdata(); ?>
        </div>
    </div>
</div>
<?php get_footer(); ?>