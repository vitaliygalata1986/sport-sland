<?php
add_action( 'widgets_init', 'si_register' );
function si_register(){
    register_sidebar( array(
        'name'          => 'Контакты в шапке сайта',
        'id'            => "si-header",
        'before_widget' => null,
        'after_widget'  => null,
    ) );
    register_sidebar( array(
        'name'          => 'Контакты в подвале сайта',
        'id'            => "si-footer",
        'before_widget' => null,
        'after_widget'  => null,
    ) );
    register_sidebar( array(
        'name'          => 'Сайдбар в футоре - Колонка 1',
        'id'            => "si-footer-column-1",
        'before_widget' => null,
        'after_widget'  => null,
    ) );
    register_sidebar( array(
        'name'          => 'Сайдбар в футоре - Колонка 2',
        'id'            => "si-footer-column-2",
        'before_widget' => null,
        'after_widget'  => null,
    ) );
    register_sidebar( array(
        'name'          => 'Сайдбар в футоре - Колонка 3',
        'id'            => "si-footer-column-3",
        'before_widget' => null,
        'after_widget'  => null,
    ) );
    register_sidebar( array(
        'name'          => 'Карта',
        'id'            => "si-map",
        'before_widget' => null,
        'after_widget'  => null,
    ) );
    register_sidebar( array(
        'name'          => 'Сайдбар под картой',
        'id'            => "si-after-map",
        'before_widget' => null,
        'after_widget'  => null,
    ) );
    register_widget('si_widget_text'); // ярлык si_widget_text при регистрации виджета
    register_widget('si_widget_contacts');
    register_widget('si_widget_social_links');
    register_widget('si_widget_iframe');
    register_widget('si_widget_info');
}
