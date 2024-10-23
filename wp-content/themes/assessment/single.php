<?php
/**
 * The template for displaying all single posts
 *
 * @package WordPress
 * @subpackage assessment
 */

 get_header(); ?>
<?php
    // Start the loop.
    while ( have_posts() ) :
        the_post();
        $image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'single-post-thumbnail' );
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
         Posted on <?php the_date(); ?> by <?php the_author(); ?>
         </div>
         <div class="post-img">
            <img src="<?php echo $image[0]; ?>" width="100%">
         </div>
         <div class="detail-content">
         <?php the_content(); ?>
         </div>
         </div>
     </div>
     <div class="container">
     <div class="post-navigation">
         <div class="prev-post">
             <?php previous_post_link('%link', 'Previous Post: %title'); ?>
         </div>
         <div class="next-post">
             <?php next_post_link('%link', 'Next Post: %title'); ?>
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
 