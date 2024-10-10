<?php

add_action( 'admin_enqueue_scripts', function(){
    wp_enqueue_style( 'my-wp-admin', get_template_directory_uri() .'/assets/css/wp-admin.css' );
});

add_action('wp_enqueue_scripts', 'si_scripts');

function si_scripts()
{
    wp_enqueue_script('js', _si_assets_path('js/js.js'), [], '1.0', true);
    wp_enqueue_script('custom-js', _si_assets_path('js/custom.js'), [], '1.0', true);
    wp_enqueue_style('si_style', _si_assets_path('css/styles.css'), [], '1.0', 'all');
    wp_dequeue_style('wp-block-library'); // удалим стиль WP wp-block-library-css (css он сам дописывает) нужен он для редактора Gutenberg
    /*
    if ( !is_admin() ) {
        wp_deregister_script('jquery');
        wp_register_script('jquery','//code.jquery.com/jquery-3.7.1.slim.min.js');
        wp_enqueue_script('jquery');
    }
    */
}