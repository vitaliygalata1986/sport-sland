<?php
if (!defined('WP_UNINSTALL_PLUGIN')) exit;

global $wpdb;
$wpdb->query("DROP TABLE IF EXISTS `{$wpdb->prefix}test`");

// p - post, pm - post meta
// post_type = 'book' - тип поста
// удаляются посты из таблицы posts
// on - по признаку: pm.post_id = p.ID
$wpdb->query( "DELETE p, pm
  FROM `{$wpdb->prefix}posts` p
 INNER
  JOIN `{$wpdb->prefix}postmeta` pm
    ON pm.post_id = p.ID
 WHERE p.post_type = 'book'" );

// Но не будет удалены черновики, и посты, для которых нет post meta
// Wordpress еще создает копию поста, так как есть автосохранение
// Сделаем еще один запрос, который после предыдущего удалить прочие данные
$wpdb->query( "DELETE FROM `{$wpdb->prefix}posts` WHERE post_type = 'book'" );