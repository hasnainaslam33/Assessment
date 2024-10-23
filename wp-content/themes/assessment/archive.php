<?php
/**
 * The template for displaying Archive pages
 *
 * @package WordPress
 * @subpackage assessment
 */

get_header(); ?>
<?php $image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'single-post-thumbnail'); ?>
<div class="project-content">
	<div class="template-header" style="background-image: url('<?php echo $image[0]; ?>');">
		<h1><?php post_type_archive_title(); ?></h1>
	</div>
	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">

			<?php if (have_posts()): ?>

				<?php
				// Start the loop.
				while (have_posts()):
					the_post();
					?>
					<div class="row">
						<?php
						$permalink = get_the_permalink(get_the_ID());
						$title = get_the_title(get_the_ID());
						$discription = get_the_content();
						$image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'single-post-thumbnail');
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

				</div>
			<?php else: ?>
				<p>No More posts found</p>
			<?php endif; ?>

		</div>
	</div>
	<?php get_footer(); ?>