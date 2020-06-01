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
}
?>

<aside id="secondary" class="widget-area">
	<?php dynamic_sidebar('rigth-sidebar'); ?>
</aside><!-- #secondary -->