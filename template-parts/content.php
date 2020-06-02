<?php

/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package MonodedoTheme
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php monodedotheme_post_thumbnail(); ?>

	<header class="entry-header">
		<?php
		if (is_singular()) :
			the_title('<h1 class="entry-title text-mono-b">', '</h1>');
		else :
			the_title('<h2 class="entry-title text-mono-b"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
		endif;

		if ('post' === get_post_type()) :
		?>
			<div class="entry-meta">
				<?php
				monodedotheme_posted_on();
				monodedotheme_posted_by();
				?>
				<br>
				<?php
				$categories_list = get_the_category_list(esc_html__(', ', 'monodedotheme'));
				if ($categories_list) {
					/* translators: 1: list of categories. */
					printf('<span class="cat-links">' . esc_html__('Posted in %1$s', 'monodedotheme') . '</span>', $categories_list); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				} ?>
			</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
		if (!is_singular()) {
			the_excerpt();
		?>
			<a href="<?php the_permalink(); ?>" class="btn btn-danger bg-m-r">Mas info...</a>
		<?php
		} else {
			the_content(
				sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__('Continue reading<span class="screen-reader-text"> "%s"</span>', 'monodedotheme'),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					wp_kses_post(get_the_title())
				)
			);

			wp_link_pages(
				array(
					'before' => '<div class="page-links">' . esc_html__('Pages:', 'monodedotheme'),
					'after'  => '</div>',
				)
			);
		}
		?>
	</div><!-- .entry-content -->

	<?php if (is_singular()) { ?>
		<footer class="entry-footer">
			<?php monodedotheme_entry_footer(); ?>
		</footer><!-- .entry-footer -->
	<?php } ?>
</article><!-- #post-<?php the_ID(); ?> -->