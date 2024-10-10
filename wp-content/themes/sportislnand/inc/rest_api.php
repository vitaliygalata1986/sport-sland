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
               // return is_user_logged_in(); // только авторизированный пользователь имеет доступ к эндпоинту
               return true; // т.е. всегда разрешает вход
               // return current_user_can('administrator'); // является ли пользователем администратором
               // return current_user_can('manage_options'); // является ли пользователем администратором
            }
        ],
        [
            'methods' => 'POST',
            'callback' => 'set_houses_title',
            'permission_callback' => function () {
                // return false; // запрещаем доступ на этот роут (только для авторизованных)
                // return current_user_can('manage_options'); // true/false  возвращает
                return true;
            },
            'args' => [
                'id' => [ // без id мы не сможем поменять заголовок у каой-то записи
                    'required' => true,
                    'type' => 'integer',
                    'default' => 334, // по дефолту это первая квартира с id 153
                ],
                'title' => [
                    'required' => true,
                    'type' => 'string',
                ]
            ]
        ]
    ]);

    // http://sport-island.loc/wp-json/blog/v1/user/1
    register_rest_route('blog/v1', 'user/(?P<id>\d+)', [
        [
            'methods'  => 'GET',
            'callback' => 'get_user',
        ],
        [
            'methods'  => 'POST',
            'callback' => 'set_user_title',
        ]

    ]);
});

function get_user($request) {
    $user_id = $request->get_param('id');
    $user = get_user_by('id', $user_id);

    if (!$user) {
        return new WP_Error('no_user', 'User not found', array('status' => 404));
    }

    return [
        'ID' => $user->ID,
        'user_login' => $user->user_login,
        'user_email' => $user->user_email,
        'display_name' => $user->display_name,
    ];
}

function set_user_title(){

}


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
