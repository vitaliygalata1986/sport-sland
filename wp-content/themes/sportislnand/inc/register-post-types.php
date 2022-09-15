<?php
add_action( 'init', '_register_types');

function _register_types(){

    register_post_type( 'houses', [
        'labels' => [
            'name'               => 'Объекты недвижимости', // основное название для типа записи
            'singular_name'      => 'Объект недвижимости', // название для одной записи этого типа
            'add_new'            => 'Добавить объект недвижимости', // для добавления новой записи
            'add_new_item'       => 'Добавить новый объект недвижимости', // заголовка у вновь создаваемой записи в админ-панели.
            'edit_item'          => 'Редактировать объект недвижимости', // для редактирования типа записи
            'new_item'           => 'Новаый объект недвижимости', // текст новой записи
            'view_item'          => 'Смотреть объект недвижимости', // для просмотра записи этого типа.
            'search_items'       => 'Искать объект недвижимости', // для поиска по этим типам записи
            'not_found'          => 'Не найдено', // если в результате поиска ничего не было найдено
            'not_found_in_trash' => 'Не найдено в объектах недвижимости', // если не было найдено в корзине
            'parent_item_colon'  => '', // для родителей (у древовидных типов)
            'menu_name'          => 'Объекты недвижимости', // название меню
        ],
        'public'              => true,
        'menu_position'       => 20,
        'menu_icon'           => 'dashicons-admin-multisite',
        'hierarchical'        => false,
        'supports'            => ['title', 'editor', 'thumbnail'],
        'has_archive' => true // для этого типа записи нужно зарегестрировать отдельный url адрес
    ]);

    register_post_type( 'services', [
        'labels' => [
            'name'               => 'Услуги', // основное название для типа записи
            'singular_name'      => 'Услуга', // название для одной записи этого типа
            'add_new'            => 'Добавить новую услугу', // для добавления новой записи
            'add_new_item'       => 'Добавить новую услугу', // заголовка у вновь создаваемой записи в админ-панели.
            'edit_item'          => 'Редактировать услугу', // для редактирования типа записи
            'new_item'           => 'Новая услуга', // текст новой записи
            'view_item'          => 'Смотреть услуги', // для просмотра записи этого типа.
            'search_items'       => 'Искать услуги', // для поиска по этим типам записи
            'not_found'          => 'Не найдено', // если в результате поиска ничего не было найдено
            'not_found_in_trash' => 'Не найдено в корзине', // если не было найдено в корзине
            'parent_item_colon'  => '', // для родителей (у древовидных типов)
            'menu_name'          => 'Услуги', // название меню
        ],
        'public'              => true,
        'menu_position'       => 20,
        'menu_icon'           => 'dashicons-smiley',
        'hierarchical'        => false,
        'supports'            => ['title', 'editor', 'thumbnail'],
        'has_archive' => true // для этого типа записи нужно зарегестрировать отдельный url адрес
    ]);

    register_post_type( 'trainers', [
        'labels' => [
            'name'               => 'Тренеры', // основное название для типа записи
            'singular_name'      => 'Тренеры', // название для одной записи этого типа
            'add_new'            => 'Добавить нового тренера', // для добавления новой записи
            'add_new_item'       => 'Добавить нового тренера', // заголовка у вновь создаваемой записи в админ-панели.
            'edit_item'          => 'Редактировать тренера', // для редактирования типа записи
            'new_item'           => 'Новый тренер', // текст новой записи
            'view_item'          => 'Смотреть тренера', // для просмотра записи этого типа.
            'search_items'       => 'Искать тренера', // для поиска по этим типам записи
            'not_found'          => 'Не найдено', // если в результате поиска ничего не было найдено
            'not_found_in_trash' => 'Не найдено в корзине', // если не было найдено в корзине
            'parent_item_colon'  => '', // для родителей (у древовидных типов)
            'menu_name'          => 'Тренеры', // название меню
        ],
        'public'              => true,
        'menu_position'       => 20,
        'menu_icon'           => 'dashicons-groups', //_si_assets_path('img/icons/arrow_black.png')
        'hierarchical'        => false,
        'supports'            => ['title', 'editor', 'thumbnail'],
        'has_archive' => true // для этого типа записи нужно зарегестрировать отдельный url адрес
    ]);

    register_post_type( 'schedule', [
        'labels' => [
            'name'               => 'Занятие', // основное название для типа записи
            'singular_name'      => 'Занятие', // название для одной записи этого типа
            'add_new'            => 'Добавить новое занятие', // для добавления новой записи
            'add_new_item'       => 'Добавить новое занятие', // заголовка у вновь создаваемой записи в админ-панели.
            'edit_item'          => 'Редактировать занятие', // для редактирования типа записи
            'new_item'           => 'Новое занятие', // текст новой записи
            'view_item'          => 'Смотреть занятие', // для просмотра записи этого типа.
            'search_items'       => 'Искать занятие', // для поиска по этим типам записи
            'not_found'          => 'Не найдено', // если в результате поиска ничего не было найдено
            'not_found_in_trash' => 'Не найдено в корзине', // если не было найдено в корзине
            'parent_item_colon'  => '', // для родителей (у древовидных типов)
            'menu_name'          => 'Занятия', // название меню
        ],
        'public'              => true,
        'menu_position'       => 20,
        'menu_icon'           => 'dashicons-universal-access-alt',
        'hierarchical'        => false,
        'supports'            => ['title', 'editor', 'thumbnail'],
        'has_archive' => true // для этого типа записи нужно зарегестрировать отдельный url адрес
    ]);

    register_post_type( 'prices', [
        'labels' => [
            'name'               => 'Прайсы', // основное название для типа записи
            'singular_name'      => 'Прайс', // название для одной записи этого типа
            'add_new'            => 'Добавить новый прайс', // для добавления новой записи
            'add_new_item'       => 'Добавить новый прайс', // заголовка у вновь создаваемой записи в админ-панели.
            'edit_item'          => 'Редактировать прайс', // для редактирования типа записи
            'new_item'           => 'Новый прайс', // текст новой записи
            'view_item'          => 'Смотреть прайс', // для просмотра записи этого типа.
            'search_items'       => 'Искать прайсы', // для поиска по этим типам записи
            'not_found'          => 'Не найдено', // если в результате поиска ничего не было найдено
            'not_found_in_trash' => 'Не найдено в корзине', // если не было найдено в корзине
            'parent_item_colon'  => '', // для родителей (у древовидных типов)
            'menu_name'          => 'Прайсы', // название меню
        ],
        'public'              => true,
        'menu_position'       => 20,
        'menu_icon'           => 'dashicons-text-page',
        'hierarchical'        => false,
        'show_in_rest'        => true,
        'supports'            => ['title', 'editor', 'thumbnail'],
        'has_archive' => true // для этого типа записи нужно зарегестрировать отдельный url адрес
    ]);

    register_post_type( 'cards', [
        'labels' => [
            'name'               => 'Карты', // основное название для типа записи
            'singular_name'      => 'Клубная карта', // название для одной записи этого типа
            'add_new'            => 'Добавить новую карту', // для добавления новой записи
            'add_new_item'       => 'Добавить новую карту', // заголовка у вновь создаваемой записи в админ-панели.
            'edit_item'          => 'Редактировать карту', // для редактирования типа записи
            'new_item'           => 'Новая карта', // текст новой записи
            'view_item'          => 'Смотреть карту', // для просмотра записи этого типа.
            'search_items'       => 'Искать карты', // для поиска по этим типам записи
            'not_found'          => 'Не найдено', // если в результате поиска ничего не было найдено
            'not_found_in_trash' => 'Не найдено в корзине', // если не было найдено в корзине
            'parent_item_colon'  => '', // для родителей (у древовидных типов)
            'menu_name'          => 'Клубные карты', // название меню
        ],
        'public'              => true,
        'menu_position'       => 20,
        'menu_icon'           => 'dashicons-tickets-alt',
        'hierarchical'        => false,
        'supports'            => ['title', 'editor', 'thumbnail'],
        'has_archive' => false // для этого типа записи отдельной странички под карты не будет
    ]);

    register_post_type( 'orders', [
        'labels' => [
            'name'               => 'Заявки', // основное название для типа записи
            'singular_name'      => 'Заявки', // название для одной записи этого типа
            'add_new'            => 'Добавить новую заявку', // для добавления новой записи
            'add_new_item'       => 'Добавить новую заявку', // заголовка у вновь создаваемой записи в админ-панели.
            'edit_item'          => 'Редактировать заявки', // для редактирования типа записи
            'new_item'           => 'Новая заявка', // текст новой записи
            'view_item'          => 'Смотреть заявки', // для просмотра записи этого типа.
            'search_items'       => 'Искать заявки', // для поиска по этим типам записи
            'not_found'          => 'Не найдено', // если в результате поиска ничего не было найдено
            'not_found_in_trash' => 'Не найдено в корзине', // если не было найдено в корзине
            'parent_item_colon'  => '', // для родителей (у древовидных типов)
            'menu_name'          => 'Заявки', // название меню
        ],
        'public'              => false, // чтобы в админке видеть эти записи, а на фронт-енде - нет
        'show_ui'             => true,
        'show_in_menu'        => true, // чтобы в админке появился этот тип записи
        'menu_position'       => 20,
        'menu_icon'           => 'dashicons-format-chat',
        'hierarchical'        => false,
        'supports'            => ['title'], // оставим, но тайтлы будем генерировать автоматически
        'has_archive' => false // для этого типа записи отдельной странички под карты не будет
    ]);

    register_taxonomy('schedule_days', ['schedule'], [
        'labels'                => [
            'name'              => 'Дни недели',
            'singular_name'     => 'День',
            'search_items'      => 'Найти день недели',
            'all_items'         => 'Все дни недели',
            'view_item '        => 'Посмотреть дни недели',
            'edit_item'         => 'Редактировать дни недели',
            'update_item'       => 'Обновить',
            'add_new_item'      => 'Добавить день недели',
            'new_item_name'     => 'Добавить день недели',
            'menu_name'         => 'Все дни недели',
        ],
        'description'           => '',
        'public'                => true, // нам нужен UI т.е. интерфейс для работы с данной таксономией
        'hierarchical'          => true
    ]);

    register_taxonomy('places', ['schedule'], [
        'labels'                => [
            'name'              => 'Залы',
            'singular_name'     => 'Залы',
            'search_items'      => 'Найти залы',
            'all_items'         => 'Все залы',
            'view_item '        => 'Посмотреть залы',
            'edit_item'         => 'Редактировать залы',
            'update_item'       => 'Обновить',
            'add_new_item'      => 'Добавить залы',
            'new_item_name'     => 'Добавить залы',
            'menu_name'         => 'Все залы',
        ],
        'description'           => '',
        'public'                => true, // нам нужен UI т.е. интерфейс для работы с данной таксономией
        'hierarchical'          => true  // залы вкладывать не будем, но очень удобно пользоваться иерархическими таксономиями в админке
    ]);

    register_taxonomy('method', ['houses'], [
        'labels'                => [
            'name'              => 'Способы реализации',
            'singular_name'     => 'Способ реализации',
            'search_items'      => 'Найти сопособы реализации',
            'all_items'         => 'Все способы реализации',
            'view_item '        => 'Посмотреть способ реализации',
            'edit_item'         => 'Редактировать способы реализации',
            'update_item'       => 'Обновить',
            'add_new_item'      => 'Добавить способ реализации',
            'new_item_name'     => 'Добавить способ реализации',
            'menu_name'         => 'Все способы реализации',
        ],
        'description'           => '',
        'public'                => true, // нам нужен UI т.е. интерфейс для работы с данной таксономией
        'hierarchical'          => true  // залы вкладывать не будем, но очень удобно пользоваться иерархическими таксономиями в админке
    ]);

    register_taxonomy('type', ['houses'], [
        'labels'                => [
            'name'              => 'Типы недвижимости',
            'singular_name'     => 'Тип недвижимости',
            'search_items'      => 'Найти тип недвижимости',
            'all_items'         => 'Все типы недвижимости',
            'view_item '        => 'Посмотреть типы недвижимости',
            'edit_item'         => 'Редактировать тип недвижимости',
            'update_item'       => 'Обновить',
            'add_new_item'      => 'Добавить тип недвижимости',
            'new_item_name'     => 'Добавить тип недвижимости',
            'menu_name'         => 'Все типы недвижимости',
        ],
        'description'           => '',
        'public'                => true, // нам нужен UI т.е. интерфейс для работы с данной таксономией
        'hierarchical'          => true  // залы вкладывать не будем, но очень удобно пользоваться иерархическими таксономиями в админке
    ]);

    register_taxonomy('status', ['houses'], [
        'labels'                => [
            'name'              => 'Статусы объекта',
            'singular_name'     => 'Статус объекта',
            'search_items'      => 'Найти статус объекта',
            'all_items'         => 'Все статусы объекта',
            'view_item '        => 'Посмотреть статусы объекта',
            'edit_item'         => 'Редактировать статус объекта',
            'update_item'       => 'Обновить',
            'add_new_item'      => 'Добавить статус объекта',
            'new_item_name'     => 'Добавить статус объекта',
            'menu_name'         => 'Все статусы объекта',
        ],
        'description'           => '',
        'public'                => true, // нам нужен UI т.е. интерфейс для работы с данной таксономией
        'hierarchical'          => true  // залы вкладывать не будем, но очень удобно пользоваться иерархическими таксономиями в админке
    ]);

}