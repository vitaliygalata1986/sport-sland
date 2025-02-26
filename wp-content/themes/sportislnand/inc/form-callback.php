<?php

add_action('admin_post_nopriv_si-modal-form', 'si_modal_form_handler'); // si-modal-form - берем из  <input type="hidden" name="action" value="si-modal-form">
add_action('admin_post_si-modal-form', 'si_modal_form_handler');

add_action('manage_posts_custom_column', 'si_status_column', 5, 2); // хук срабатывает в тот момент, когда создаются колонки 5 - приоритет 2 - сколько параметров принимает функция
add_filter('manage_posts_columns', 'si_add_col_status'); // manage_posts_columns на который повесим нашу функцию для регистрации колонок

function si_modal_form_handler()
{
    $name = $_POST['si-user-name'] ? $_POST['si-user-name'] : 'Аноним';
    $phone = $_POST['si-user-phone'] ? $_POST['si-user-phone'] : false;
    $choice = $_POST['form-post-id'] ? $_POST['form-post-id'] : 'empty'; // выбор пользователя
    if ($phone) {
        $name = wp_strip_all_tags($name); // Главное отличие функции wp_strip_all_tags() от обычной PHP-функции strip_tags() в том, что она удаляет не только теги сами по себе, но также и то, что внутри тегов <script> и <style>.
        $phone = wp_strip_all_tags($phone);
        $choice = wp_strip_all_tags($choice);

        // wp_insert_post // позволяет создать новую запись без админки, а просто с помощью кода
        // wp_slash - проверяет наличие спец. символов в строке - если они будут найдены, будут добавлены слешы для экранирования
        $id = wp_insert_post(wp_slash([
            // в массиве укажем настройки для сохранения записи
            'post_title' => 'Заявка № ',  // формируем тайтл заявки
            'post_type' => 'orders', // мы его отдельно регестрировали
            'post_status' => 'publish',
            'meta_input' => [ // сюда можем добавить все метаполя
                'si_order_name' => $name,
                'si_order_phone' => $phone,
                'si_order_choise' => $choice
            ],
        ]));
        // если функция wp_insert_post успешно записала в базу, то добавит в базу id записи, иначе 0 (если мы так настроим)
        // в нашем случае будет 0 - если запись в базу не произойдет


        if ($id !== 0) { // если данные записались успешно, то обновим поле post_title
            wp_update_post([
                'ID' => $id,
                'post_title' => 'Заявка № ' . $id,
            ]);
            // обновим данные нашего мета-поля, который мы создали через ACF
            update_field('orders_status', 'new', $id); // ярлык поля, который хотим обновить
            // wp_mail();
        }



    }


    // echo 'Все получили';
//    echo '<pre>';
//    print_r($_POST);
//    echo '</pre>';
    // сохраним данные в виде записи:
    header('Location:' . home_url()); // ответим заголовком Location и сделаем переадресацию на главную страницу
}


function si_order_fields_cb($post_obj, $slug)
{
//    echo "<pre>";
//    print_r($slug);
//    echo "</pre>";
    // var_dump($slug);
    $slug = $slug['args'];
    $data = '';
    switch ($slug) {
        case 'si_order_date':

            $data = $post_obj->post_date;
            break;
        case 'si_order_choise':
//            echo "<pre>";
//            print_r($slug);
//            echo "</pre>";
            $id = get_post_meta($post_obj->ID, $slug, true); // id той записи, которую выбрал человек, когда кликал по кнопке
            $title = get_the_title($id);
            // определим тип записи: клубная карта, услуга и т.д.

            // $type1 = get_post_type($id); // cards

            $type2 = get_post_type_object(get_post_type($id)); // или $type2 = get_post_type_object('cards')
            // get_post_type_object - Получает объект (данные) указанного типа записи: post, page, attachment или новый тип записи.
            // Объект содержит все параметры (настройки) типа записи.
//            echo "<pre>";
//            var_dump($type2);
//            echo "</pre>";

            $type = get_post_type_object(get_post_type($id))->labels->singular_name; // сначала мы получаем ярлык - строку, которая соответствует типу записи (cards - это см. register-post-types), а потом объект, где есть полная информация над данным типом записи
            $data = 'Клиент выбрал: <strong>' . $title . '</strong> <br>Из раздела <strong>' . $type . '</strong>';
            break;
        default:
            $data = get_post_meta($post_obj->ID, $slug, true);
            $data = $data ? $data : 'Нет данных';
            break;
    }

    echo '<p>' . $data . '</p>';
    // echo $slug;
    // echo '<pre>';
    // print_r($args);
    // echo '</pre>';
}


function si_status_column($col_name, $id)
{ // $col_name - имя колонки, $id - id поста для которого формируется значение этой колонки
    // когда будут выводится колонки - эта функция будет выполняться каждый раз, поэтому сделаем проверку:
    if ($col_name !== 'status') return;
    // дальше код будет работать, когда дойдем до вывода этой колонки: status

    //$id = get_the_ID();
    $status = get_field('orders_status', $id);
   // print_r($status);

    $text_status = ($status['value'] == "new") ? 'new' : (($status['value']) == "done" ? 'done' : 'clarification');

    echo $status ? '<span class="' . $text_status . '">' . $status['label'] . '</span>' : 0;
}

function si_add_col_status($defaults)
{ // те дефолтные колонки, которые есть в Wordpress из коробки
    $type = get_current_screen(); // возвращает информацию в админке про текущую страницу в которой мы находимся - и это объект
    if ($type->post_type === 'orders') { // если тип записи у нас orders
        $defaults['status'] = 'Статус'; // добавляем новый ключ
    }
    return $defaults;
}


/*
function si_order_date_cb($post_obj){ // принимает объект записи $post_obj
    $date = get_post_meta($post_obj->ID, 'si_order_date', true);
    $date = $date ? $date : '';
    echo '<span>' . $date . '</span>';
}
*/

/*
function si_order_name_cb($post_obj){ // принимает объект записи $post_obj
    $date = get_post_meta($post_obj->ID, 'si_order_date', true);
    $date = $date ? $date : '';
    echo '<span>' . $date . '</span>';
}
*/

