<?php
if (!defined('ABSPATH')) {
    exit;
}

function sportisland_activation()
{
    // die('Плагин активирован');

    // версия PHP должна быть 8 или выше
    if (PHP_MAJOR_VERSION < 8) { // вернет целое число версии
        die('For the PHP plugin to work, the version must be >=8'); // завершим работу плагина, это не даст ее активироваться
    }

    // $site = get_home_url(); // получим адрес сайта
    // wp_mail('nertis44@gmail.com', 'Плагин активирован',"Плагин активирован на сайте: {$site}");

    global $wpdb; // для работы с БД нам нужен объект $wpdb из глобального пространства имен
    // $wpdb->prefix - актуальный префикс для таблиц, которые пользователь указал при установке с _

    $query = "CREATE TABLE IF NOT EXISTS `{$wpdb->prefix}test` (
        `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
        `title` varchar(255) NOT NULL,
            PRIMARY KEY (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;";
    // выполняем запрос
    $wpdb->query($query);

    // при активации плагина будет функция регестрировать кастомный тип записи и сразу обновлять ЧПУ ссылки
    sportisland_add_post_type();
    flush_rewrite_rules(); // обновит ЧПУ ссылки единожды
}

function sportisland_deactivation()
{
    // FILE_APPEND - константа, чтобы в файл что-то дописывалось
    file_put_contents(SPORTINSLAND_DIR . 'log.txt', "Плагин деактивирован\n", FILE_APPEND); // создаем файл log.text и в него запишем Плагин деактивирован
}

function sportisland_add_admin_pages()
{
    // manage_options - права доступа
    $hook_suffix = add_menu_page(
        __('Sportisland Settings Main Page', 'sportisland'), // Текст, который будет использован в теге <title> на странице, относящейся к пункту меню.
        __('Sportisland Settings', 'sportisland'), // Название пункта меню в сайдбаре админ-панели.
        'manage_options', // Права пользователя
        'sportisland-main-settings', // Уникальное название (slug), по которому затем можно обращаться к этому меню.
        'sportisland_main_admin_page', // Название функции, которая выводит контент страницы пункта меню.
        'dashicons-welcome-learn-more', // Иконка для пункта меню
        3 // Число определяющее позицию меню
    );
    add_submenu_page('sportisland-main-settings',
        __('Sportisland Settings Main Page', 'sportisland'),
        __('Sportisland Main Settings', 'sportisland'),
        'manage_options',
        'sportisland-main-settings'
    );
    $hook_suffix_subpage = add_submenu_page('sportisland-main-settings',
        __('Sportisland Submenu Settings Page', 'sportisland'),
        __('Sportisland Submenu Settings', 'sportisland'),
        'manage_options',
        'sportisland-subpage1-settings',
        'sportisland_subpage1_settings',
    );
    // сразу после создания страниц в меню - подключим стили для них
    add_action("admin_print_scripts-{$hook_suffix}", "sportisland_scripts_admin2"); // это только для главноя страницы админке плагина
    add_action("admin_print_styles-{$hook_suffix}", "sportisland_styles_admin");// чтобы стили подклчались в хедере
    add_action("admin_print_scripts-{$hook_suffix_subpage}", "sportisland_scripts_admin2"); // это только для главноя страницы админке плагина
    add_action("admin_print_styles-{$hook_suffix_subpage}", "sportisland_styles_admin");
}

function sportisland_main_admin_page()
{
    // echo '<h1>Plugin Main Page</h1>';
    require_once SPORTINSLAND_DIR . 'templates/main-admin-page.php';
}

function sportisland_subpage1_settings()
{
    // echo '<h1>Plugin Sub Page</h1>';
    require_once SPORTINSLAND_DIR . 'templates/admin-subpage1.php';
}

function sportisland_scripts_front()
{
    // применяем константу __FILE__, чтобы путь высчитывался относительно текущего местоположения
    wp_enqueue_style('sportisland_front', plugins_url('/assets/front/sportisland-front.css', __FILE__));
    // false - будет подключаться версия WP
    // jquery - будет браться из WP
    wp_enqueue_script('sportisland_front', plugins_url('/assets/front/sportisland-front.js', __FILE__), array('jquery'), false, true);
}

function sportisland_scripts_admin($hook_suffix)
{
    // var_dump($hook_suffix);
    if (!in_array($hook_suffix, array('toplevel_page_sportisland-main-settings', 'sportisland-settings_page_sportisland-subpage1-settings'))) {
        return;
    }
    wp_enqueue_style('sportisland_admin', plugins_url('/assets/admin/sportisland-admin.css', __FILE__));
    // так как jquery в админке подключен по умолчанию, то зависимости подключать не нужно
    wp_enqueue_script('sportisland_admin', plugins_url('/assets/admin/sportisland-admin.js', __FILE__));
}

function sportisland_scripts_admin2()
{
    wp_enqueue_script('sportisland_admin', plugins_url('/assets/admin/sportisland-admin.js', __FILE__), array('jquery'), false, true);
}

function sportisland_styles_admin()
{
    wp_enqueue_style('sportisland_admin', plugins_url('/assets/admin/sportisland-admin.css', __FILE__));
}

function sportisland_load_textdomain()
{
    load_plugin_textdomain('sportisland', false, dirname(plugin_basename(__FILE__)) . '/languages/');
}


function sportisland_add_settings()
{
    // register settings - регестрируем опцию
    register_setting('sportisland_main_group', 'sportisland_main_email');
    register_setting('sportisland_main_group', 'sportisland_main_name');

    // регестрируем опцию для вывода на другой странице
    register_setting('sportisland_subpage1_group', 'sportisland_subpage1_phone');
    register_setting('sportisland_subpage1_group', 'sportisland_subpage1_message');

    // add sections
    add_settings_section(
        'sportisland_main_first_section',
        __('Main section 1', 'sportisland'),
        function () {
            echo '<p>' . __('Main section 1 description', 'sportisland') . '</p>';
        },
        'sportisland-main-settings'); // последний параметр - к какой странице привязать вывод этой секции

    // add sections
    add_settings_section(
        'sportisland_main_second_section',
        __('Main section 2', 'sportisland'),
        function () {
            echo '<p>' . __('Main section 2 description', 'sportisland') . '</p>';
        },
        'sportisland-main-settings'); // последний параметр - к какой странице привязать вывод этой секции

    // add sections
    add_settings_section(
        'sportisland_subpage1_first_section',
        __('Subpage section 1', 'sportisland'),
        function () {
            echo '<p>' . __('Subpage section 1 description', 'sportisland') . '</p>';
        },
        'sportisland-subpage1-settings'); // последний параметр - к какой странице привязать вывод этой секции

    // add sections
    add_settings_section(
        'sportisland_subpage1_second_section',
        __('Subpage section 2', 'sportisland'),
        function () {
            echo '<p>' . __('Subpage section 2 description', 'sportisland') . '</p>';
        },
        'sportisland-subpage1-settings'); // последний параметр - к какой странице привязать вывод этой секции

    // add settings field
    add_settings_field(
        'sportisland_main_email',
        __('E-mail', 'sportisland'),
        'sportisland_main_email_field',
        'sportisland-main-settings', // здесь указываем id секции
        'sportisland_main_first_section',
        array('label_for' => 'sportisland_main_email') // связь label с опцией
    );

    // add settings field
    add_settings_field(
        'sportisland_main_name',
        __('Name', 'sportisland'),
        'sportisland_main_name_field',
        'sportisland-main-settings', // здесь указываем id секции
        'sportisland_main_second_section',
        array('label_for' => 'sportisland_main_name') // связь label с опцией
    );


    // add settings field
    add_settings_field(
        'sportisland_subpage1_phone',
        __('Phone', 'sportisland'),
        'sportisland_subpage1_phone_field',
        'sportisland-subpage1-settings',
        'sportisland_subpage1_first_section',
        array('label_for' => 'sportisland_subpage1_phone') // связь label с опцией
    );

    // add settings field
    add_settings_field(
        'sportisland_subpage1_message',
        __('Message', 'sportisland'),
        'sportisland_subpage1_message_field',
        'sportisland-subpage1-settings',
        'sportisland_subpage1_second_section',
        array('label_for' => 'sportisland_subpage1_message') // связь label с опцией
    );
}

function sportisland_main_email_field()
{
    echo '<input name="sportisland_main_email" id="sportisland_main_email" type="email" value="' . esc_attr(get_option('sportisland_main_email')) . '" class="regular-text code">';
}

function sportisland_main_name_field()
{
    echo '<input name="sportisland_main_name" id="sportisland_main_name" type="name" value="' . esc_attr(get_option('sportisland_main_name')) . '" class="regular-text code">';
}

function sportisland_subpage1_phone_field()
{
    echo '<input name="sportisland_subpage1_phone" id="sportisland_subpage1_phone" type="tel" value="' . esc_attr(get_option('sportisland_subpage1_phone')) . '" class="regular-text code">';
}

function sportisland_subpage1_message_field()
{
    $value = esc_textarea(get_option('sportisland_subpage1_message'));

    // Display the textarea with the escaped value
    echo '<textarea name="sportisland_subpage1_message" id="sportisland_subpage1_message" rows="10" cols="50" class="large-text code">' . $value . '</textarea>';
}

function sportisland_add_post_type()
{
    register_taxonomy('genre', 'book', array( // может передать массивом array('book'), если планируется несколько типов записей
        'hierarchical' => true, // вложенность (рубрики могут вкладываться)
        'show_ui' => true,
        'show_admin_column' => true, // чтобы появилась колонка Genres в админке для типо записей book
        'show_in_rest' => true,
        /*
         show_in_rest - Нужно ли включать таксономию в REST API.
         Также влияет на работу блочного редактора Gutenberg:
         true - таксономия будет видна в редакторе блоков Gutenberg
         false - такса будет видна только в обычном редакторе.
         * */
        'rewrite' => array('slug' => 'books/genre'),
        'labels' => array(
            'name' => __('Genres', 'sportisland'),
            'singular_name' => __('Genre', 'sportisland'),
            'all_items' => __('All Genres', 'sportisland'),
            'edit_item' => __('Edit Genre', 'sportisland'),
            'update_item' => __('Update Genre', 'sportisland'),
            'add_new_item' => __('Add New Genre', 'sportisland'),
            'new_item_name' => __('New Genre', 'sportisland'),
            'menu_name' => __('Genres', 'sportisland'),
        ),
    ));
    register_post_type('book', array(
        'label' => __('Books', 'sportisland'),
        'public' => true,
        'supports' => array('title', 'editor', 'thumbnail'),
        'has_archive' => true, // создание родительской страницы для этих постов
        'rewrite' => array('slug' => 'books'),
        'show_in_rest' => true,
    ));
}

function sportisland_get_theme_template($template)
{
    // var_dump($template); // то, что показывает плагин show current template
    if (is_singular('book')) {
        // будем подменять шаблон
        // если есть шаблон в папке с темой - будем использовать его, иначе шаблон с папке плагина
        if (!file_exists(get_template_directory() . '/single-book.php')) { // если нет такого файла
            return SPORTINSLAND_DIR . '/templates/front/single-book.php';
        }
    }

    if (is_post_type_archive('book')) {
        if (!file_exists(get_template_directory() . '/archive-book.php')) { // архивная страница book
            return SPORTINSLAND_DIR . '/templates/front/archive-book.php';
        }
    }

    if (is_tax('genre')) {
        if (!file_exists(get_template_directory() . '/taxonomy-genre.php')) { // страница категории genre
            return SPORTINSLAND_DIR . '/templates/front/taxonomy-genre.php';
        }
    }

    return $template; // вернем тот шаблон, который будем использовать
}

function sportisland_add_plugin_links($links)
{ // функция принимает массив ссылок
    //var_dump($links);
    /*
    $new_links = array(
        '<a href="' . admin_url('admin.php?page=sportisland-main-settings') . '">' .  __('Sportisland Settings', 'sportisland') . '</a>' ,
        '<a href="' . admin_url('options-general.php') . '">' .  __('Options General', 'sportisland') . '</a>');
    */
    $new_links = array('<a href="' . admin_url('admin.php?page=sportisland-main-settings') . '">' . __('Sportisland Settings', 'sportisland') . '</a>');

    $links = array_merge($links, $new_links); // сливаем два массива. Нам нужно в массив $links добавить $new_links
    // $links = array_merge($new_links, $links); // сливаем два массива. Нам нужно в массив $links добавить $new_links
    return $links;
}

function sportisland_test_shortcode($atts)
{ // аргументом принимает массив атрибутов

    // var_dump($atts);
    $atts = shortcode_atts(array(
        'tag' => 'h3',
        'class' => 'sportisland_test',
    ), $atts); // первый - значение по умолчанию, второй - то, что мы передаем в шорткод

    // var_dump($atts);

    $tag = esc_html($atts['tag']);
    $class = esc_html($atts['class']);
    return "<{$tag} class='$class'>Hello from shortcode!<{$tag}/>";
}

function sportisland_test_shortcode_2($atts, $content)
{ // content, который передаем вторым аргументом

    $atts = shortcode_atts(array(
        'tag' => 'h5',
        'class' => 'sportisland_test2',
    ), $atts);

    $tag = esc_html($atts['tag']);
    $class = esc_html($atts['class']);
    return "<{$tag} class='$class'>{$content}<{$tag}/>";
}

function gutenberg_examples_01__register_block()
{
    register_block_type(__DIR__ . '/blocks/block1'); // функция регестрирует новый тип блока, исопльзуя мета данные, которые сохранены в файле block.json
    // Мы должые указать путь к block.json
}

function sportisland_block2()
{
    register_block_type(__DIR__ . '/blocks/block2');
}

function sportisland_block3()
{
    wp_register_script('sportisland-block3', plugins_url('blocks/block3/block.js', __FILE__), array('wp-blocks', 'wp-element', 'wp-editor')); // передаем массив зависимостей для работы нашего скрипта
    wp_register_style('sportisland-block3-editor', plugins_url('blocks/block3/editor.css', __FILE__)); // для админки
    wp_register_style('sportisland-block3-style', plugins_url('blocks/block3/style.css', __FILE__)); // для фронт части

    register_block_type('sportisland-block/block3', array( // функция будет регестрировать новый тип блока
        'editor_script' => 'sportisland-block3',
        'editor_style' => 'sportisland-block3-editor',
        'style' => 'sportisland-block3-style',
    ));
}

function sportisland_add_meta_boxes()
{
    // array - массив постов, для которых предназначен мета бокс, если рнужно для постов - то укажем post
    add_meta_box('sportisland_book_info', __('Book info', 'sportisland'), 'sportisland_book_info_cb', array('book'));
}

function sportisland_book_info_cb($post) // перерадим сюда $post - это объект поста, в нем есть различная информация
{
    wp_nonce_field('sportisland_action', 'sportisland_nonce'); // данную функцию можно вызывать без параметров, а можно что-то передать
    $book_pages = get_post_meta($post->ID, 'book_pages',true); // по id получаем поле book_pages, true - взять первое значение
    $book_cover = get_post_meta($post->ID, 'book_cover',true); // по id получаем поле book_cover

//    echo "<pre>";
//    print_r($book_pages);
//    echo "</pre>";

    ?>
    <table class="form-table">
        <tbody>

        <tr>
            <!--кол. страниц-->
            <th><label for="book_pages"><?php _e('Number of pages', 'sportisland') ?></label></th>
            <td><input type="text" id="book_pages" name="book_pages" class="regular-text" value="<?php echo esc_attr($book_pages);?>"</td>
        </tr>

        <tr>
            <!--наличие обложки-->
            <th><label for="book_cover"><?php _e('Cover?', 'sportisland') ?></label></th>
            <td><input type="checkbox" id="book_cover" name="book_cover" <?php checked('yes', $book_cover); // 1-аргумент - строка с которой нужно сравнить, 2- с чем сранивать, если эти два значения совпадут, то функция вернет checked ?></td>
        </tr>

        </tbody>
    </table>
    <?php
}

function sportisland_save_boxes($post_id)
{ // $post_id - id поста, который обновляется,
    if (!isset($_POST['sportisland_nonce']) || !wp_verify_nonce($_POST['sportisland_nonce'], 'sportisland_action')) { // если в массиве $_POST нет такого ключа или он не прошел проверку
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) { // если определена константа DOING_AUTOSAVE и она true, тоесть происходит автосохранение, то мы отсюда выйдем
        return;
    }
    if (!current_user_can('edit_post', $post_id)) { // проверяем права юзера не предпологают редактирование, то завершим работу функции
        return;
    }
    // дальше проверяем наши поля
    if (!empty($_POST['book_pages'])) { // если book_pages в массиве $_POST не пусто
        update_post_meta($post_id, 'book_pages', sanitize_text_field($_POST['book_pages'])); // обновляем в базе данных
    } else {
        delete_post_meta($post_id, 'book_pages'); // иначе если пользователь удалил с поля количество страниц (тоесть он не хочет, чтобы оно было)
    }

    if (!empty($_POST['book_cover']) && $_POST['book_cover'] == 'on') {
        update_post_meta($post_id, 'book_cover', 'yes'); // если чекбокс отмечен, то пишем yes
    } else {
        delete_post_meta($post_id, 'book_cover');
    }

}
