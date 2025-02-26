<?php

$files = [
    'helper-functions.php',
    'register-post-types.php',
    'register-sidebar.php',
    'shortcode.php',
    'admin-slogan.php',
    'meta-box.php',
    'likes.php',
    'theme-settings.php',
    'script_styles.php',
    'form-callback.php',
    'ajax-form-registration.php',
  //  'rest_api.php'
];

$widgest = [
    'widget-text.php',
    'widget-contacts.php',
    'widget-social-links.php',
    'widget-iframe.php',
    'widget-info.php',
];


foreach ($files as $file) {
    require_once(__DIR__ . '/inc/' . $file);
}

foreach ($widgest as $w) {
    require_once(__DIR__ . '/inc/widget/' . $w);
}

require_once 'inc/filters_hook/filters_hook.php';





