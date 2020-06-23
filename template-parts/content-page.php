<?php

/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package MonodedoTheme
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header style="display: none;" class="entry-header">
		<?php the_title('<h1 class="entry-title">', '</h1>'); ?>
	</header><!-- .entry-header -->

	<?php if (is_account_page()) { ?>
		<div class="container">
			<div class="row  justify-content-center">
				<div class="col-md-5">
					<?php monodedotheme_post_thumbnail(); ?>
				</div>
			</div>
			<div id="acoount">
				<?php pagina(); ?>
			</div>
		</div>
	<?php } else {
		pagina();
	}
	?>

	<?php function pagina()
	{ ?>
		<div class="entry-content">
			<?php
			the_content();

			wp_link_pages(
				array(
					'before' => '<div class="page-links">' . esc_html__('Pages:', 'monodedotheme'),
					'after'  => '</div>',
				)
			);
			?>
		</div><!-- .entry-content -->
	<?php } ?>
	<?php
	if (get_edit_post_link()) : ?>
		<footer class="entry-footer">
			<?php
			edit_post_link(
				sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__('Edit <span class="screen-reader-text">%s</span>', 'monodedotheme'),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					wp_kses_post(get_the_title())
				),
				'<span class="edit-link">',
				'</span>'
			);
			?>
		</footer><!-- .entry-footer -->
	<?php endif; ?>
</article><!-- #post-<?php the_ID(); ?> -->