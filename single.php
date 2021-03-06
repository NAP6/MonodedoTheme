<?php

/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package MonodedoTheme
 */

get_header();
?>

<?php if (has_post_thumbnail(get_queried_object_id())) { ?>
	<img src="<?php echo get_the_post_thumbnail_url(get_queried_object_id(), "monodedotheme-full-whith");
				?>" class="img-fluid d-none d-md-block" width="100%">
<?php } ?>
<div class="container">
	<div class="row">
		<main id="primary" class="site-main col-12 col-md-9">

			<?php
			while (have_posts()) :
				the_post();
				get_template_part('template-parts/content', get_post_type());

				the_post_navigation(
					array(
						'prev_text' => '<span class="nav-subtitle">' . esc_html__('Previous:', 'monodedotheme') . '</span> <span class="nav-title">%title</span>',
						'next_text' => '<span class="nav-subtitle">' . esc_html__('Next:', 'monodedotheme') . '</span> <span class="nav-title">%title</span>',
					)
				);

				// If comments are open or we have at least one comment, load up the comment template.
				if (comments_open() || get_comments_number()) :
					comments_template();
				endif;

			endwhile; // End of the loop.
			?>

		</main><!-- #main -->
		<?php get_sidebar(); ?>

	</div><!-- .row -->
</div><!-- .container -->
<?php
get_footer();
