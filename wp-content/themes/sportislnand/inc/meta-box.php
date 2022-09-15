<?php

add_action('add_meta_boxes', 'si_meta_boxes'); // add_meta_boxes - хук, который срабатывает тогда, когда WP добавляет поля для редактирования в админку
function si_meta_boxes(){

    add_meta_box(
        'si-like', // id поля в админке
        'Количество лайков: ',
        'si_meta_like_cb',
        'post'
    // '',
    // '',
    // [10,16]
    );

    $fields = [
        'si_order_date' =>'Дата заявки: ',
        'si_order_name' =>'Имя клиента: ',
        'si_order_phone' =>'Номер телефона: ',
        'si_order_choise' =>'Выбор клиента: ',
    ];

    foreach ($fields as $slug => $text){
        add_meta_box(
            $slug, // id поля в админке
            $text,
            'si_order_fields_cb',
            'orders', // для register post type orders
            'advanced', // слева, справа, снизу или сверху размещать эти поля
            'default', // приоритет
            $slug // аргументы, которые нужно передать в callback функцию si_order_fields_cb
        );
    }
}
