<?php
/*
Plugin Name: Vitos Categories Widget
Plugin URI: https://github.com/vitaliygalata1986
Description: Categories Widget description
Version: 1.0
Author: Vitaliy Galata
Author URI: https://github.com/vitaliygalata1986
Text Domain: vitocat
Domain Path: /languages
*/


/*
 1) Определяет константы плагина:
    VITOSCAT_PLUGIN_DIR — абсолютный путь к папке плагина на сервере.
    VITOSCAT_PLUGIN_URL — URL-адрес плагина.
    VITOSCAT_PLUGIN_NAME — имя папки плагина.

 2) Регистрирует блок Gutenberg:

    Функция vitoswidget_block() добавляется к хуку init.
    Проверяется наличие функции register_block_type, чтобы убедиться, что Gutenberg включен.
    Регистрируются скрипты и стили для блока:
    Скрипты для редактора (vitoswidget-block) и фронтенда (vitoswidget-main).
    Дополнительные скрипты: jquery.cookie, jquery.hoverIntent, jquery.accordion.
    Стили для редактора и фронтенда.
    Регистрируется блок с указанием скриптов, стилей и функции обратного вызова vitoswidget_block_cb для рендера.

    editor.css  Стили для блока в редакторе Gutenberg. Они определяют, как блок выглядит во время редактирования.
    style.css: Стили для блока на фронтенде. Они определяют, как блок выглядит для конечных пользователей сайта.

 3) Функция рендера блока:
    vitoswidget_block_cb возвращает простой текст HELLO FROM BACKEND.
*/

defined('ABSPATH') or die;

define('VITOSCAT_PLUGIN_DIR', plugin_dir_path(__FILE__)); // абсолютный путь
// echo VITOSCAT_PLUGIN_DIR; // C:\OpenServer\domains\hoock\wordpress\wp-content\plugins\vitos-widget-categories/

define('VITOSCAT_PLUGIN_URL', plugin_dir_url(__FILE__)); // абсолютным URL
// echo VITOSCAT_PLUGIN_URL; // http://sport-island.loc/wp-content/plugins/vitos-widget-categories/

define('VITOSCAT_PLUGIN_NAME', dirname(plugin_basename(__FILE__)));
// echo VITOSCAT_PLUGIN_NAME; // vitos-widget-categories

add_action( 'init', 'vitoswidget_block' );
function vitoswidget_block() {
    // нам нужно, чтобы у пользоваетеля был включен редактор gutenberg
    if ( ! function_exists( 'register_block_type' ) ) {
        return;
    }

    wp_register_script( 'vitoswidget-block', plugins_url( 'block/block.js', __FILE__ ), array( 'wp-blocks', 'wp-element', 'wp-editor' ) ); // admin
    wp_register_script( 'vitoswidget-cookie', plugins_url( 'block/jquery.cookie.js', __FILE__ ) ); // front
    wp_register_script( 'vitoswidget-hoverIntent', plugins_url( 'block/jquery.hoverIntent.minified.js', __FILE__ ) ); // front
    wp_register_script( 'vitoswidget-accordion', plugins_url( 'block/jquery.accordion.js', __FILE__ ) ); // front
    if ( ! is_admin() ) {
        wp_register_script( 'vitoswidget-main', plugins_url( 'block/vitoswidget-main.js', __FILE__ ), array( 'jquery', 'vitoswidget-cookie', 'vitoswidget-hoverIntent', 'vitoswidget-accordion' ) ); // только для фронта
    }
    wp_register_style( 'vitoswidget-block-editor', plugins_url( 'block/editor.css', __FILE__ ) ); // admin
    if ( ! is_admin() ) {
        wp_register_style( 'vitoswidget-block-style', plugins_url( 'block/style.css', __FILE__ ) ); // front
    }

    // подключаем стили и скрипты для редактора Gutenberg и фронта
    register_block_type( 'vitoswidget-block/block', array(
        'editor_script' => 'vitoswidget-block', // admin
        'editor_style' => 'vitoswidget-block-editor', // admin
        'style' => 'vitoswidget-block-style', // front
        'script' => 'vitoswidget-main', // front
        'render_callback' => 'vitoswidget_block_cb', // коллбек, который отдает html для нашего блока
    ) );

}

function vitoswidget_block_cb( $block_attributes, $content ) {
    // var_dump($block_attributes); // ["className"]=> string(6) "my-cat" } - передали из админки
    $className = !empty( $block_attributes['className'] ) ? esc_html( $block_attributes['className'] ) : '';
    $categories = wp_list_categories(array(
      'echo' => false,  // нам нужно не выводить рубрики, а возвращать
        'title_li' => '', // не выводить слово Рубрики
    ));
    // var_dump($categories)
    $html = '<ul class="vitoscats-categories ' . $className . '">';
    $html .= $categories;
    $html .= '</ul>';
    return $html;
}
