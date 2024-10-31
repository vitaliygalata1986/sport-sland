<?php
class Vitospanel_Admin {
    public function __construct()
    {
        // echo __METHOD__; // укажет - какой клас, какой метод отработал
        add_action('admin_enqueue_scripts', array($this, 'enqueue_scripts_styles')); // $this - от данного экземпляра класа
    }

    public function enqueue_scripts_styles()
    {
        wp_enqueue_style('vitospanel', VITOSPANEL_PLUGIN_URL . 'admin/css/vitospanel-admin.css');
        wp_enqueue_script('vitospanel', VITOSPANEL_PLUGIN_URL . 'admin/js/vitospanel-admin.js', array('jquery'));
    }
}