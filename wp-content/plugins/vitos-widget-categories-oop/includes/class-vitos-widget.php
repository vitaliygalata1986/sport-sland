<?php

class Vitoswidget
{
    public function __construct()
    {
        $this->load_dependencies();
        $this->init_hooks();
        $this->define_admin_hooks();
        $this->define_public_hooks();
    }

    private function load_dependencies()
    {
        require_once VITOSCAT_PLUGIN_DIR . 'admin/class-vitoswidget-admin.php';
        require_once VITOSCAT_PLUGIN_DIR . 'public/class-vitoswidget-public.php';
    }

    private function define_admin_hooks()
    {
        $plugin_admin = new Vitoswidget_Admin();
    }

    private function define_public_hooks()
    {
        $plugin_public = new Vitoswidget_Public();
    }

    private function init_hooks()
    {
        // hooks that will be executed when the plugin is initialized
        add_action('plugins_loaded', array($this, 'load_textdomain'));
    }

    public function load_textdomain()
    {
        load_plugin_textdomain('vitoscat', false, VITOSCAT_PLUGIN_NAME . '/languages/');
    }

}