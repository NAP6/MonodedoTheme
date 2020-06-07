<?php

/**
 * WooCommerce Compatibility File
 *
 * @link https://woocommerce.com/
 *
 * @package MonodedoTheme
 */

/**
 * WooCommerce setup function.
 *
 * @link https://docs.woocommerce.com/document/third-party-custom-theme-compatibility/
 * @link https://github.com/woocommerce/woocommerce/wiki/Enabling-product-gallery-features-(zoom,-swipe,-lightbox)
 * @link https://github.com/woocommerce/woocommerce/wiki/Declaring-WooCommerce-support-in-themes
 *
 * @return void
 */
function monodedotheme_woocommerce_setup()
{
	add_theme_support(
		'woocommerce',
		array(
			'thumbnail_image_width' => 150,
			'single_image_width'    => 300,
			'product_grid'          => array(
				'default_rows'    => 3,
				'min_rows'        => 1,
				'default_columns' => 4,
				'min_columns'     => 1,
				'max_columns'     => 6,
			),
		)
	);
	add_theme_support('wc-product-gallery-zoom');
	add_theme_support('wc-product-gallery-lightbox');
	add_theme_support('wc-product-gallery-slider');
}
add_action('after_setup_theme', 'monodedotheme_woocommerce_setup');

/**
 * WooCommerce specific scripts & stylesheets.
 *
 * @return void
 */
function monodedotheme_woocommerce_scripts()
{
	wp_enqueue_style('monodedotheme-woocommerce-style', get_template_directory_uri() . '/woocommerce.css', array(), _S_VERSION);

	$font_path   = WC()->plugin_url() . '/assets/fonts/';
	$inline_font = '@font-face {
			font-family: "star";
			src: url("' . $font_path . 'star.eot");
			src: url("' . $font_path . 'star.eot?#iefix") format("embedded-opentype"),
				url("' . $font_path . 'star.woff") format("woff"),
				url("' . $font_path . 'star.ttf") format("truetype"),
				url("' . $font_path . 'star.svg#star") format("svg");
			font-weight: normal;
			font-style: normal;
		}';

	wp_add_inline_style('monodedotheme-woocommerce-style', $inline_font);
}
add_action('wp_enqueue_scripts', 'monodedotheme_woocommerce_scripts');

/**
 * Disable the default WooCommerce stylesheet.
 *
 * Removing the default WooCommerce stylesheet and enqueing your own will
 * protect you during WooCommerce core updates.
 *
 * @link https://docs.woocommerce.com/document/disable-the-default-stylesheet/
 */
add_filter('woocommerce_enqueue_styles', '__return_empty_array');

/**
 * Add 'woocommerce-active' class to the body tag.
 *
 * @param  array $classes CSS classes applied to the body tag.
 * @return array $classes modified to include 'woocommerce-active' class.
 */
function monodedotheme_woocommerce_active_body_class($classes)
{
	$classes[] = 'woocommerce-active';

	return $classes;
}
add_filter('body_class', 'monodedotheme_woocommerce_active_body_class');

/**
 * Related Products Args.
 *
 * @param array $args related products args.
 * @return array $args related products args.
 */
function monodedotheme_woocommerce_related_products_args($args)
{
	$defaults = array(
		'posts_per_page' => 3,
		'columns'        => 3,
	);

	$args = wp_parse_args($defaults, $args);

	return $args;
}
add_filter('woocommerce_output_related_products_args', 'monodedotheme_woocommerce_related_products_args');

/**
 * Remove default WooCommerce wrapper.
 */
remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

if (!function_exists('monodedotheme_woocommerce_wrapper_before')) {
	/**
	 * Before Content.
	 *
	 * Wraps all WooCommerce content in wrappers which match the theme markup.
	 *
	 * @return void
	 */
	function monodedotheme_woocommerce_wrapper_before()
	{
?>
		<main id="primary" class="site-main">
		<?php
	}
}
add_action('woocommerce_before_main_content', 'monodedotheme_woocommerce_wrapper_before');

if (!function_exists('monodedotheme_woocommerce_wrapper_after')) {
	/**
	 * After Content.
	 *
	 * Closes the wrapping divs.
	 *
	 * @return void
	 */
	function monodedotheme_woocommerce_wrapper_after()
	{
		?>
		</main><!-- #main -->
	<?php
	}
}
add_action('woocommerce_after_main_content', 'monodedotheme_woocommerce_wrapper_after');

/**
 * Sample implementation of the WooCommerce Mini Cart.
 *
 * You can add the WooCommerce Mini Cart to header.php like so ...
 *
	<?php
		if ( function_exists( 'monodedotheme_woocommerce_header_cart' ) ) {
			monodedotheme_woocommerce_header_cart();
		}
	?>
 */

if (!function_exists('monodedotheme_woocommerce_cart_link_fragment')) {
	/**
	 * Cart Fragments.
	 *
	 * Ensure cart contents update when products are added to the cart via AJAX.
	 *
	 * @param array $fragments Fragments to refresh via AJAX.
	 * @return array Fragments to refresh via AJAX.
	 */
	function monodedotheme_woocommerce_cart_link_fragment($fragments)
	{
		ob_start();
		monodedotheme_woocommerce_cart_link();
		$fragments['a.cart-contents'] = ob_get_clean();

		return $fragments;
	}
}
add_filter('woocommerce_add_to_cart_fragments', 'monodedotheme_woocommerce_cart_link_fragment');

if (!function_exists('monodedotheme_woocommerce_cart_link')) {
	/**
	 * Cart Link.
	 *
	 * Displayed a link to the cart including the number of items present and the cart total.
	 *
	 * @return void
	 */
	function monodedotheme_woocommerce_cart_link()
	{
	?>
		<a class="cart-contents" href="<?php echo esc_url(wc_get_cart_url()); ?>" title="<?php esc_attr_e('View your shopping cart', 'monodedotheme'); ?>">
			<?php
			$item_count_text = sprintf(
				/* translators: number of items in the mini cart. */
				_n('%d item', '%d items', WC()->cart->get_cart_contents_count(), 'monodedotheme'),
				WC()->cart->get_cart_contents_count()
			);
			?>
			<span class="amount"><?php echo wp_kses_data(WC()->cart->get_cart_subtotal()); ?></span> <span class="count"><?php echo esc_html($item_count_text); ?></span>
		</a>
	<?php
	}
}

if (!function_exists('monodedotheme_woocommerce_header_cart')) {
	/**
	 * Display Header Cart.
	 *
	 * @return void
	 */
	function monodedotheme_woocommerce_header_cart()
	{
		if (is_cart()) {
			$class = 'current-menu-item';
		} else {
			$class = '';
		}
	?>
		<ul id="site-header-cart" class="site-header-cart">
			<li class="<?php echo esc_attr($class); ?>">
				<?php monodedotheme_woocommerce_cart_link(); ?>
			</li>
			<li>
				<?php
				$instance = array(
					'title' => '',
				);

				the_widget('WC_Widget_Cart', $instance);
				?>
			</li>
		</ul>
<?php
	}
}

if (!function_exists('monodedotheme_woocommerce_menu')) {
	function monodedotheme_woocommerce_menu()
	{
		get_product_search_form();

		$taxonomies = get_terms(array(
			'taxonomy' => 'product_cat',
			'hide_empty' => false
		));

		if (!empty($taxonomies)) :
			$output = '<ul class="">';
			foreach ($taxonomies as $category) {
				if ($category->parent == 0) {
					$output .= '<li class="">';
					$output .= aux_category($category, $taxonomies);
					$output .= '</li>';
				}
			}
			$output .= '</ul>';
			echo $output;
		endif;
	}

	function aux_category($fater_cat, $taxonomies)
	{
		$aux = "";
		foreach ($taxonomies as $subcategory) {
			if ($subcategory->parent == $fater_cat->term_id) {
				$aux .= '<li >';
				$aux .= aux_category($subcategory, $taxonomies);
				$aux .= '</li>';
			}
		}

		if (strlen($aux) > 0) {

			$output = ' <a  data-toggle="collapse" aria-expanded="false" class="dropdown-toggle" href="#' . $fater_cat->name . "-" . $fater_cat->term_id . '">' . esc_attr($fater_cat->name) . '</a>';
			$output .= '<ul class="collapse list-unstyled" id="' . $fater_cat->name . "-" . $fater_cat->term_id . '">' . $aux . '</ul>';
		} else {
			$output = ' <a href="' . esc_url(get_category_link($fater_cat->term_id)) . '">' . esc_attr($fater_cat->name) . '</a>';
		}

		return $output;
	}
}




// Desactivar anchos de imágenes en temas con soporte para WooCommerce.
add_action('after_setup_theme', 'ap_modify_theme_support', 11);
function ap_modify_theme_support()
{
	$theme_support = get_theme_support('woocommerce');
	$theme_support = is_array($theme_support) ? $theme_support[0] : array();
	unset($theme_support['single_image_width'], $theme_support['thumbnail_image_width']);
	remove_theme_support('woocommerce');
	add_theme_support('woocommerce', $theme_support);
}

//Desactivar los botones de la tienda
function remove_loop_button()
{
	remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);
}
add_action('init', 'remove_loop_button');
