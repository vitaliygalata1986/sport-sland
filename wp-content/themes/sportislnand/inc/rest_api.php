<?php

add_action('rest_api_init', function () {

    // myplugin/v1 - namespace - чтобы роуты, созданные разными программистами не совпажали друг с другом - своего рода префикс
    // v1 - версионирование внутри роутов
    // author-posts - окончание роута. Также можем передавать регулярку- здесь отслеживает числа и сохраняет по ключу id <id>
    // т.е. на выхоже мы получим: /author-posts/15
    // когда кто-то зайдет на этот роут, то будет запущен солбэк: my_awesome_func - и в этот колэек будут переданы параметры, связ. с роутом  и среде них будет ключ id в котором будет сохранено то, что было введено в строке браузера
    // P- обозначает pattern, так в старых регулярках дописывали, и без нее будет работать
    //register_rest_route( 'flats/v1', '/author-posts/(?P<id>\d+)', [
    register_rest_route('real_estate/v1', '/houses/', [
        [
            'methods' => 'GET',
            'callback' => 'get_houses',
            'permission_callback' => function () {
                // return true; // т.е. всегда разрешает вход
                return current_user_can('manage_options'); // true/false  возвращает
            }
        ],
        [
            'methods' => 'POST',
            'callback' => 'set_houses_title',
            'permission_callback' => function () {
                // return false; // запрещаем доступ на этот роут (только для авторизованных)
                return current_user_can('manage_options'); // true/false  возвращает
            },
            'args' => [
                'id' => [ // без id мы не сможем поменять заголовок у каой-то записи
                    'required' => true,
                    'type' => 'integer',
                    'default' => 153, // по дефолту это первая квартира с id 153
                ],
                'title' => [
                    'required' => true,
                    'type' => 'string',
                ]
            ]
        ]
    ]);
});


function get_houses($req)
{ // $req - объект,который будет доступен (здесь будут методы, в котором мы можем получить все переданные параметры вместе с запросом)
    return get_posts([ // достаточно что-то вернуть, WP сам закодирует в JSON
        'numberposts' => -1,
        'post_type' => 'houses'
    ]);
}

function set_houses_title($req)
{
    $id = $req->get_param('id'); // получаем id из объекта $req
    $title = $req->get_param('title');
    wp_update_post([
        'ID' => $id,
        'post_title' => $title
    ]);
    return get_post($id, ARRAY_A); // вернем новый обновенный post - нам нужно, чтобы данная функция вернула post в виде ассоциативного массива - чтобы правильно сконвертировать в json
    // return 'It works';
}
