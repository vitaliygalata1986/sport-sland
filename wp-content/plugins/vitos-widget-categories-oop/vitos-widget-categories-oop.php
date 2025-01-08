<?php
/*
Plugin Name: Vitos Categories Widget OOP
Plugin URI: https://github.com/vitaliygalata1986
Description: Categories Widget description
Version: 1.0
Author: Vitaliy Galata
Author URI: https://github.com/vitaliygalata1986
Text Domain: vitoscat
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

define('VITOSCAT_PLUGIN_DIR', plugin_dir_path(__FILE__)); // абсолютный путь - для подключения файлов
// echo VITOSCAT_PLUGIN_DIR; // C:\OpenServer\domains\hoock\wordpress\wp-content\plugins\vitos-widget-categories/

define('VITOSCAT_PLUGIN_URL', plugin_dir_url(__FILE__)); // абсолютным URL - для полключения стилей и скриптов
// echo VITOSCAT_PLUGIN_URL; // http://sport-island.loc/wp-content/plugins/vitos-widget-categories/

define('VITOSCAT_PLUGIN_NAME', dirname(plugin_basename(__FILE__)));
// echo VITOSCAT_PLUGIN_NAME; // vitos-widget-categories

require_once VITOSCAT_PLUGIN_DIR . '/includes/class-vitos-widget.php';

function run_vitoswidget()
{
    $plugin = new Vitoswidget();
}


run_vitoswidget();