<?php

class Vitoswidget_Public
{
    public function __construct()
    {
        add_action('init', [$this, 'register_frontend_assets']);
    }

    public function register_frontend_assets()
    {
        // Регистрируем скрипты и стили для фронтенда

        wp_register_script('vitoswidget-cookie', VITOSCAT_PLUGIN_URL . 'public/js/jquery.cookie.js');
        wp_register_script('vitoswidget-hoverIntent', VITOSCAT_PLUGIN_URL . 'public/js/jquery.hoverIntent.minified.js');
        wp_register_script('vitoswidget-accordion', VITOSCAT_PLUGIN_URL . 'public/js/jquery.accordion.js');

        if (!is_admin()) {
            wp_register_script('vitoswidget-main', VITOSCAT_PLUGIN_URL . 'public/js/vitoswidget-main.js', array('jquery', 'vitoswidget-cookie', 'vitoswidget-hoverIntent', 'vitoswidget-accordion'));
        }

        if (!is_admin()) {
            wp_register_style('vitoswidget-block-style', VITOSCAT_PLUGIN_URL . 'public/css/style.css');
        }

    }
}