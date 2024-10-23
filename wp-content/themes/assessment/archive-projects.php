<?php
get_header(); 
$image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'single-post-thumbnail' ); ?>
<div class="project-content">
    <div class="template-header" style="background-image: url('<?php echo $image[0]; ?>');">
    <h1><?php post_type_archive_title(); ?></h1>
    </div>
    
<div class="container">
    <div class="project-section space">
    <?php
    $pagination = (get_query_var('paged')) ? get_query_var('paged') : 1;
    $args = array(
        'post_type' => 'projects', 
        'posts_per_page' => 6, 
        'paged' => $pagination 
    );
    $loop_items = new WP_Query($args);

    if ($loop_items->have_posts()) : ?>
        <div class="row">
            <?php while ($loop_items->have_posts()) : $loop_items->the_post();
             $permalink = get_field( 'project_url', $loop_items->ID );
        $title = get_field( 'project_name', $loop_items->ID );
        $discription = get_field( 'project_description', $loop_items->ID );
        $startdate = get_field( 'project_start_date', $loop_items->ID );
        $enddate = get_field( 'project_end_date', $loop_items->ID );
        $image = wp_get_attachment_image_src( get_post_thumbnail_id( $loop_items->ID ), 'single-post-thumbnail' );
        ?>
        <div class="col4">
        <div class="loop-post">
            <?php if($image){ ?>
            <img src="<?php echo $image[0]; ?>" alt="" class="img-responsive">
            <?php } ?>
            <?php if($title){ ?>
            <h3><a href="<?php echo esc_url( $permalink ); ?>"><?php echo $title; ?></a></h3>
            <?php } ?>
            <?php if($discription){ ?>
            <p><?php echo wp_trim_words( $discription, 10, '...' ); ?></p>
            <?php } ?>
            <?php if($startdate){ ?>
            <span class="custom-data"><strong>Start Date:</strong><?php echo $startdate; ?></span>
            <?php } ?>
            <?php if($enddate){ ?>
            <span class="custom-data"><strong>End Date:</strong><?php echo $enddate; ?></span>
            <?php } ?>
            <?php if($permalink ){ ?>
            <a href="<?php echo esc_url( $permalink ); ?>" class="read-more-btn">Read More</a>
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
    <?php else : ?>
        <p>No blog posts found</p>
    <?php endif; ?>

    <?php wp_reset_postdata();  ?>
</div>
</div>
</div>
<?php get_footer(); ?>
