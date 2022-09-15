<?php

add_filter('si_widget_text', 'do_shortcode'); // do_shortcode вставит то, что вернет функция шорткода
// do_shortcode можно передавать как функцию для фильтров

function _si_assets_path($path)
{
    return get_template_directory_uri() . '/assets/' . $path;
}

// add_filter('show_admin_bar','__return_false'); // скрыть верхнюю плашку

remove_action('wp_head','feed_links_extra', 3); // убирает ссылки на rss категорий
remove_action('wp_head','feed_links', 2); // минус ссылки на основной rss и комментарии
remove_action('wp_head','rsd_link');  // сервис Really Simple Discovery
remove_action('wp_head','wlwmanifest_link'); // Windows Live Writer
remove_action('wp_head','wp_generator');  // скрыть версию wordpress

remove_action('wp_head','start_post_rel_link',10,0);
remove_action('wp_head','index_rel_link');
remove_action('wp_head','adjacent_posts_rel_link_wp_head', 10, 0 );
remove_action('wp_head','wp_shortlink_wp_head', 10, 0 );

remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');



