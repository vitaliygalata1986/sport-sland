<?php

class Vitoswidget_Admin
{
    public function __construct()
    {
        add_action('init', [$this, 'vitoswidget_block']);
    }

    public function vitoswidget_block()
    {
        //  Проверяем, включен ли Gutenberg
        if (!function_exists('register_block_type')) {
            return;
        }
        wp_register_script('vitoswidget-block', VITOSCAT_PLUGIN_URL . 'admin/js/block.js', array('wp-blocks', 'wp-element', 'wp-editor'));
        wp_register_style('vitoswidget-block-editor', VITOSCAT_PLUGIN_URL . 'admin/css/editor.css');

        // Регистрируем блок
        register_block_type('vitoswidget-block/block', array(
            'editor_script' => 'vitoswidget-block', // admin
            'editor_style' => 'vitoswidget-block-editor', // admin
            'style' => 'vitoswidget-block-style', // front (передается, но регистрируется в Public)
            'script' => 'vitoswidget-main', // front (передается, но регистрируется в Public)
            'render_callback' => [$this, 'render_block'], // коллбек, который отдает html для нашего блока
        ));
    }

    public function render_block($block_attributes, $content)
    {
        $categories = wp_list_categories(array(
            'echo' => false,  // нам нужно не выводить рубрики, а возвращать
            'title_li' => '', // не выводить слово Рубрики
        ));
        // var_dump($categories)

        // require_once VITOSCAT_PLUGIN_DIR . 'public/templates/vitos-widget.php'; // Если всё настроено правильно, это сработает,
        //  но только если результат метода не нужно возвращать для использования в других функциях или шаблонах.

        ob_start(); // Буферизация начинает захват вывода. Это необходимо, чтобы результат require_once можно было сохранить как строку.
        require_once VITOSCAT_PLUGIN_DIR . 'public/templates/vitos-widget.php';
        return ob_get_clean(); // Содержимое буфера возвращается как результат метода, и буфер очищается.
    }
}