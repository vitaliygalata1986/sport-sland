<?php

add_action('wp_ajax_nopriv_post-likes','si_likes');
add_action('wp_ajax_post-likes','si_likes');
add_action('save_post', 'si_save_like_meta'); // хук save_post срабатывает, когда данные приходят на сервер после сохранения записи или поста и т.д.
add_action('manage_posts_custom_column', 'si_like_column',5,2); // хук срабатывает в тот момент, когда создаются колонки 5 - приоритет 2 - сколько параметров принимает функция
add_filter('manage_posts_columns', 'si_add_col_likes'); // manage_posts_columns на который повесим нашу функцию для регистрации колонок


function si_likes(){
    // echo 'Все получили';
    $id = $_POST['id'];
    $todo = $_POST['todo'];
    $current_data=get_post_meta( $id,'si-like',true);
    $current_data = $current_data ? $current_data : 0;
    if($todo === 'plus'){
        $current_data++;
    }else{
        $current_data--;
    }
    $res = update_post_meta($id, 'si-like', $current_data); // если post_meta не существует - она будет созданна, возвращет true, если удалось обновить post_meta
    if($res){
        echo $current_data;
        wp_die();
    }else{
        wp_die('Лайк не сохранился, ошибка на сервере. Попробуйте еще раз.', 500);
    }
}

function si_meta_like_cb($post_obj, $args){ // в $args получим  [10,16]
    $likes = get_post_meta($post_obj->ID,'si-like',true); // получим значение лайков для каждого объекта - get_post_meta - получает значение произвольного поля
    // $post_obj->ID - взяли из объекта записи id
    // si-like - создадим для лайков ключ si-like - здесь мы сохраняем данные о лайках
    // true - получить последнее значениеи этого поля
    //т.е. мы у конкретного поста проверяем - какие есть мета данные с id полем: si-like
    //$likes = $likes ? $likes : 0;
    // echo "<input type=\"text\" name=\"si-like\" value=\"${likes}\">";
    echo '<p>' . $likes . '</p>';
}

function si_save_like_meta($post_id){
    if(isset($_POST['si-like'])){
        update_post_meta($post_id,'si-like',$_POST['si-like']); // те данные, которые пришли в $_POST - мы передаем в качестве value
    }
}

function si_like_column($col_name, $id){ // $col_name - имя колонки, $id - id поста для которого формируется значение этой колонки
    // когда будут выводится колонки - эта функция будет выполняться каждый раз, поэтому сделаем проверку:
    if($col_name !== 'col_likes') return;
    // дальше код будет работать, когда дойдем до вывода этой колонки: si-like
    $likes = get_post_meta($id,'si-like', true);
    echo $likes ? $likes : 0;
}

function si_add_col_likes($defaults){ // те дефолтные колонки, которые есть в Wordpress из коробки
    $type = get_current_screen(); // возвращает информацию в админке про текущую страницу в которой мы находимся - и это объект
    if($type->post_type === 'post'){ // если тип записи у нас запись
        $defaults['col_likes'] = 'Лайки'; // добавляем новый ключ
    }
    return $defaults;
}
