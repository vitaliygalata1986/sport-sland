<?php
/*
Plugin Name: Sportisland study
Plugin URI: https://github.com/vitaliygalata1986

Description: Study plugin
Version: 1.0
Author: Vitaliy Galata
Author URI: https://github.com/vitaliygalata1986
*/
?>


<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
    // exit('123'); // Exit if accessed directly
}

/*
add_filter('the_title', 'sportisland_change_title',10,2); // 2 - кол. аргументов, которые передаем в фильтр - это $title,$post_id

function sportisland_change_title($title,$post_id){
    // echo $title;
    // return '';
    // var_dump($post_id);
    if(!is_singular()){ // если это не отдельный пост
        return $title;
    }
    return mb_convert_case($title, MB_CASE_LOWER); // mb_convert_case - производит смену регистра символов в строке, MB_CASE_LOWER - к нижнему регистру
}
*/

define('SPORTINSLAND_DIR', plugin_dir_path(__FILE__)); // константа - путь к папке с плагином - абосолютный физический путь - без http, от корня диска до корневой папки плагина
// __FILE__ - константа, которая возвращает путь к исполняемому файлу
// echo __FILE__; // C:\OpenServer\domains\hoock\wordpress\wp-content\plugins\sportisland-study\sportisland-study.php
// echo plugin_dir_path(__FILE__); // C:\OpenServer\domains\hoock\wordpress\wp-content\plugins\sportisland-study/
// echo SPORTINSLAND_DIR; // C:\OpenServer\domains\hoock\wordpress\wp-content\plugins\sportisland-study/

// тоже самое, но без концевого /
// efine('SPORTINSLAND_DIR_2',__DIR__);
// echo SPORTINSLAND_DIR_2; // C:\OpenServer\domains\hoock\wordpress\wp-content\plugins\sportisland-study

require_once SPORTINSLAND_DIR . 'class-sportisland-study.php';

// require_once __DIR__ . '/class-sportisland-study.php';

// 1 способ
// создадим экземпляр, тоесть объект от данного класа
$sportisland_stude = new Sportisland_Study();
$sportisland_stude->convert_title();

// 2 способ - в рамках одного метода вызывать другой метод
// new Sportisland_Study();

// 3 способ - вызов статического метода
//Sportisland_Study::convert_title(); // вызов статического метода convert_title


// 4 - способ - вызов статического метода convert_title
// add_filter('the_title', array('Sportisland_Study', 'convert_title'), 10, 2);


?>
