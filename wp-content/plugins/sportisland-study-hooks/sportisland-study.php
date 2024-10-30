<?php
/*
Plugin Name: Sportisland study hooks
Plugin URI: https://github.com/vitaliygalata1986

Description: Study plugin hook
Version: 1.0
Author: Vitaliy Galata
Author URI: https://github.com/vitaliygalata1986
Test Domain: sportisland
Domain Path: /languages
*/

if (!defined('ABSPATH')) {
    exit;
}

define('SPORTINSLAND_DIR', plugin_dir_path(__FILE__));

require_once SPORTINSLAND_DIR . 'funcs.php';
//echo __FILE__; // :\OpenServer\domains\hoock\wordpress\wp-content\plugins\sportisland-study-hooks\sportisland-study.php
// echo SPORTINSLAND_DIR; // C:\OpenServer\domains\hoock\wordpress\wp-content\plugins\sportisland-study-hooks/


function sportisland_uninstall()
{ // функция удаления должна находится в основном файле
    // удалим таблицу
    global $wpdb;
    $wpdb->query("DROP TABLE IF EXISTS `{$wpdb->prefix}test`");
}

register_activation_hook(__FILE__, 'sportisland_activation');
register_deactivation_hook(__FILE__, 'sportisland_deactivation');
// register_uninstall_hook(__FILE__, 'sportisland_uninstall');

add_action('plugins_loaded', 'sportisland_load_textdomain'); // Подключает .mo файл перевода из указанной папки

add_action('admin_menu', 'sportisland_add_admin_pages');
add_action('wp_enqueue_scripts', 'sportisland_scripts_front', 20);
//add_action('admin_enqueue_scripts', 'sportisland_scripts_admin');

add_action('admin_init', 'sportisland_add_settings');

add_action( 'init', 'sportisland_add_post_type' );

add_filter('template_include', 'sportisland_get_theme_template');

add_filter('plugin_action_links_' . plugin_basename(__FILE__), 'sportisland_add_plugin_links');


add_shortcode( 'sportisland_test', 'sportisland_test_shortcode' );
add_shortcode( 'sportisland_content', 'sportisland_test_shortcode_2' );

// add_action('init', 'gutenberg_examples_01__register_block');
// add_action('init', 'sportisland_block2');

add_action('init', 'sportisland_block3');

add_action('add_meta_boxes','sportisland_add_meta_boxes');
add_action('save_post','sportisland_save_boxes'); // для сохранения значений в метабоксе
?>
