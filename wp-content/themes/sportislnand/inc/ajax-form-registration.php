<?php

add_action('wp_ajax_nopriv_registration','example_reg'); // здесь нужно только для не зарегестрированного пользователя
add_action('wp_ajax_nopriv_auth','example_auth');

function example_reg(){
    if(isset($_POST['login'])){
        $log = strip_tags($_POST['login']);
    }

    if(isset($_POST['pass'])){
        $pass = strip_tags($_POST['pass']);
    }

    if(isset($_POST['email'])){
        $email = strip_tags($_POST['email']);
    }

    $res = wp_create_user($log, $pass, $email); // вернет id, если пользователя удалось зарегестрировать
    if(!is_wp_error($res)){ // is_wp_error - проверяет - является ли объект, который мы сюда передадим - объектом класа WP_Error
        // если ошибки нет
        wp_die($res,200); // $res - это просто строкам с id, 200 - это статус
    }else{
        wp_die('Не получилось',400);
    }
}

function example_auth(){
    $log = $_POST['login'];
    $pass = $_POST['pass'];
    $res = wp_authenticate($log, $pass); // возвращает объект юзера - всеми данными про пользователя, или WP_ERROR
    if(!is_wp_error($res)){ // если ошибки нет, то пользователь такой в базе есть
       // мы должны его авторизовать - для этого вызываем функцию wp_set_auth_cookie()
       wp_set_auth_cookie($res->ID); // принимает id пользователя и подготавливает куки для авторизации и она этиже куки устанавливает
       wp_die(get_userdata($res->ID)->user_login,200); // на фронт енд передадим логин пользоваетеля
    }else{
        wp_die('Не получилось',400);
    }
}