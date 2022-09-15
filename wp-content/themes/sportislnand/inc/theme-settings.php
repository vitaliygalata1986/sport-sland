<?php

add_action('after_setup_theme', 'si_setup'); // после актвиации темы, WP начнет ее настройку и срабатывает хук after_setup_theme

function si_setup()
{
    load_theme_textdomain('sport-island',get_template_directory() . '/locale'); // ярлык с помощью которого мы будем обращаться к файлу перевода
    register_nav_menu('menu-header', 'Меню в шапке');
    register_nav_menu('menu-footer', 'Меню в подвале');
    add_theme_support('custom-logo');
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_image_size('si_pic',600,240,true); // 600 ширина  (452/1140 = 40% составляет высота от ширины   600*0.4 = 240) true - жесткая обрезка
}
