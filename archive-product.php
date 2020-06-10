<?php

/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */


get_header();

?>

<div class="container-fluid  bg-mono-b">
    <div class="row p-5">
        <aside class="col-lg-2">
            <div class="card-body  mono-menu-tienda">
                <?php monodedotheme_woocommerce_menu(); ?>
            </div>
        </aside>
        <main class="col-lg-10">
            <?php

            /**
             * Hook: woocommerce_before_main_content.
             *
             * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
             * @hooked woocommerce_breadcrumb - 20
             * @hooked WC_Structured_Data::generate_website_data() - 30
             */
            //do_action('woocommerce_before_main_content');

            ?>

            <div class="row">
                <?php
                if (woocommerce_product_loop()) {

                    /**
                     * Hook: woocommerce_before_shop_loop.
                     *
                     * @hooked woocommerce_output_all_notices - 10
                     * @hooked woocommerce_result_count - 20
                     * @hooked woocommerce_catalog_ordering - 30
                     */
                ?>
                    <div class="col-12">
                        <?php do_action('woocommerce_before_shop_loop'); ?>
                    </div>
                    <div class="col-12">
                        <?php
                        woocommerce_product_loop_start();

                        if (wc_get_loop_prop('total')) {
                            while (have_posts()) {
                                the_post();

                                /**
                                 * Hook: woocommerce_shop_loop.
                                 */
                                do_action('woocommerce_shop_loop');

                                wc_get_template_part('template-parts/content', 'product');
                            }
                        }

                        woocommerce_product_loop_end();
                        ?>
                    </div>
            </div>
            <nav class="card-body text-mono-w-pag">
                <?php get_template_part('template-parts/content', 'paginacion') ?>
            </nav>
        <?php
                    /**
                     * Hook: woocommerce_after_shop_loop.
                     *
                     * @hooked woocommerce_pagination - 10
                     */
                    //do_action('woocommerce_after_shop_loop');
                } else {
                    /**
                     * Hook: woocommerce_no_products_found.
                     *
                     * @hooked wc_no_products_found - 10
                     */
                    do_action('woocommerce_no_products_found');
                }

        ?>
        </main>
    </div>
</div>




<?php
get_footer();
