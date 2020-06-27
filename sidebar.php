<?php

/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package MonodedoTheme
 */

if (!is_active_sidebar('rigth-sidebar')) {
	return;
} else {
?>
	<aside id="secondary" class="widget-area col-12 col-md-3">
		<?php dynamic_sidebar('rigth-sidebar'); ?>
	</aside><!-- #secondary -->
<?php } ?>