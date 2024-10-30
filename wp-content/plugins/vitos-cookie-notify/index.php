<?php

/*
    Plugin Name: Cookie Notify By Vitos
    Description: Выводит уведомление для пользователей сайта о том, что сайт использует cookie.
    License: GPL2
 */


register_activation_hook(__FILE__,'cnv_activation'); // __FILE__ - ссылка на исполняемый файл - сохраняет информацию о текущем файле, в котором происходит работа скрипта
register_deactivation_hook(__FILE__, 'cnv_deactivation');

function cnv_options(){
    return [
        'cnv_bg' => '#000',
        'cnv_color' => '#fff',
        'cnv_text' => 'Мы используем куки',
        'cnv_position' => 'bottom',
    ];
}

function cnv_activation(){
    $options = cnv_options(); // при активации получим наши option
    foreach ($options as $key => $value){
        update_option($key, $value); // Обновляет значение опции (настройки) в базе данных.
    }

}

function cnv_deactivation(){
    $options = cnv_options();
    foreach ($options as $key => $value){
        delete_option($key);
    }
}


add_action('admin_menu', 'cnv_register_menu'); // хук для добавления страницы в администраторское меню

function cnv_register_menu(){
    add_menu_page(
        'Cookie уведомление', // текст внутри тега title
        'Cookie уведомление', // то, что увидим в боковом меню
        'manage_options', // права доступа - имеет ли право заходить в этот пункт меню пользователь, который не является администратором - в нашем случае у админа и супер админа
        'cnv_settings',// menu_slug
        'cnv_admin_page_view', // функция, которая будет отвечать за верстку
        ' dashicons-buddicons-pm', // иконка
         5 // позиционирование если не укажем, что плагин будет в конце списка
    );
}

function cnv_admin_page_view(){
    if(!empty($_POST)){ // если не пустой массив $_POST
        // то данные пришли и мы будем обновлять наши поля
        update_option('cnv_bg', $_POST['cnv_bg']);
        update_option('cnv_color', $_POST['cnv_color']);
        update_option('cnv_text', $_POST['cnv_text']);
        update_option('cnv_position', $_POST['cnv_position']);
    }
    $bg = get_option('cnv_bg');
    $color = get_option('cnv_color');
    $text = get_option('cnv_text');
    $position = get_option('cnv_position');
    // echo $bg;
 ?>
<h2>Настроки уведомления:</h2>
    <form method="POST">
        <p>
            <lable>
                Введите значение для цвета фона:
                <input type="text" name="cnv_bg" value="<?php echo $bg; ?>">
            </lable>
        </p>
        <p>
            <lable>
                Введите значение для цвета текста:
                <input type="text" name="cnv_color" value="<?php echo $color; ?>">
            </lable>
        </p>
        <p>
            <lable>
                Введите текст уведомления:
                <input type="text" name="cnv_text" value="<?php echo $text; ?>">
            </lable>
        </p>
        <fieldset>
            <legend>Выберите положение для уведомления:</legend>
            <label>
                Сверху
                <input
                    type="radio"
                    name="cnv_position"
                    value="top"
                    <?php checked('top',$position, true) // текущее значение инпута, переменная, которая нас интересует выводить значение атрибута или возвращать - ставим truе чтобы выводить?>
                >
            </label>
            <label>
                Снизу
                <input
                        type="radio"
                        name="cnv_position"
                        value="bottom"
                    <?php checked('bottom',$position, true) // текущее значение инпута, переменная, которая нас интересует выводить значение атрибута или возвращать - ставим truе чтобы выводить?>
                >
            </label>
        </fieldset>
        <br>
        <button type="submit">Сохранить настройки</button>
    </form>
<?php
}

/*
add_action('wp_footer',function (){
    $options = cnv_options(); // при активации получим наши option
    foreach ($options as $key => $value){
        echo $key . ' => ' . get_option($key, $value) . '<br/>'; //  get_option - функция для получения значений настроек из базы данных
    }
});
*/

add_action('wp_footer','cnv_front_page_view');

function cnv_front_page_view(){
    if($_COOKIE['cnv_cookie_agreement'] !=='agreed'){ // если этой куки нет, то покажем верстку
        $bg = get_option('cnv_bg');
        $color = get_option('cnv_color');
        $text = get_option('cnv_text');
        $position = get_option('cnv_position');
        $css = $position . ':0;'; // top:0
    }

?>
    <div class="alert">
        <div class="wrapper">
            <?php echo $text;?>
            <br>
            <button class="alert__btn">Я согласен</button>
        </div>
        <style>
            .alert{
                color: <?php echo $color; ?>;
                background-color: <?php echo $bg; ?>;
                position: fixed;
                <?php echo $css; ?>
                left:0;
                z-index: 9999999;
                text-align: center;
                font-size: 30px;
                padding: 20px 10px;
                width: 100%;
            }
            .alert .alert__btn{
                border: 1px solid <?php echo $color; ?>;
                background-color: transparent;
                font:inherit;
                font-size: 14px;
                color: <?php echo $color; ?>;
                padding: 10px 20px;
                cursor: pointer;
            }
            .alert .alert__btn:hover, .alert .alert__btn:active, .alert .alert__btn:focus{
                background-color: <?php echo $color; ?>;
                color: <?php echo $bg; ?>;
                transition: 0.3s;
            }
        </style>
        <script>
            const url = "<?php echo esc_url(admin_url('admin-ajax.php'))?>";
            const btn = document.querySelector('.alert__btn');
            btn.addEventListener('click',async function (){
                const data = new FormData();
                // console.log(data)
                data.append('action','cnv_cookie_ajax') // передаем наш хук
                btn.disabled=true
                let response = await fetch(url,{
                    method: 'POST',
                    body: data
                })
                btn.disabled=false
                if(response.status === 200 ){
                    btn.closest('.alert').remove() // скрываем верстку
                }else{
                    console.log(response.statusText)
                    return
                }

            })
        </script>
    </div>
<?php

}

add_action('wp_ajax_nopriv_cnv_cookie_ajax','cnv_ajax_handler');
add_action('wp_ajax_cnv_cookie_ajax','cnv_ajax_handler');

function cnv_ajax_handler(){
    setcookie('cnv_cookie_agreement', 'agreed',time()+60*60*24*30,'/'); // название куки, значение, время жизни куки 1 месяц, путь к директории, которая доступна - любая директория, которая есть на сервере
    // time() - текущее время, когда был отправлен аякс запрос + 60 с + 60 мин. 24 часа и 30 дней
    echo 'Ok';
    wp_die();
}



