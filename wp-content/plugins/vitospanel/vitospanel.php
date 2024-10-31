<?php

/*
Plugin Name: Vitos Post Panel
Plugin URI: https://github.com/vitaliygalata1986
Description: Плагин позволяет добавить слайд с необходимым контентом для выбранных постов
Version: 1.0
Author: Vitaliy Galata
Author URI: https://github.com/vitaliygalata1986
Text Domain: vitos
Domain Path: /languages
*/

defined('ABSPATH') or die;  //
define('VITOSPANEL_PLUGIN_DIR', plugin_dir_path(__FILE__)); // константа для физич. пути к папке плагина
// echo VITOSPANEL_PLUGIN_DIR; // C:\OpenServer\domains\hoock\wordpress\wp-content\plugins\vitospanel/

define('VITOSPANEL_PLUGIN_URL', plugin_dir_url(__FILE__)); // C:\OpenServer\domains\hoock\wordpress\wp-content\plugins\vitospanel/
// echo VITOSPANEL_PLUGIN_URL; // http://sport-island.loc/wp-content/plugins/vitospanel/


function vitos_activate(){
    require_once VITOSPANEL_PLUGIN_DIR . '/includes/class-vitospanel-activate.php';
    Vitospanel_Activate::activate(); // вызов статичного метода
}

register_activation_hook(__FILE__, 'vitos_activate'); // при активации хука будет вызвана функция vitos_activate

require_once VITOSPANEL_PLUGIN_DIR . '/includes/class-vitospanel.php';

function run_vitospanel(){
    $plugin = new Vitospanel(); // вызывается экземпляр данного класа
}
run_vitospanel();