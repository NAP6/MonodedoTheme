<?php

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function monodedotheme_widgets_init()
{
    register_sidebar(
        array(
            'name'          => esc_html__('Rigth_Sidebar', 'monodedotheme'),
            'id'            => 'rigth-sidebar',
            'description'   => esc_html__('Add widgets here.', 'monodedotheme'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2><hr>',
        )
    );
}
add_action('widgets_init', 'monodedotheme_widgets_init');
