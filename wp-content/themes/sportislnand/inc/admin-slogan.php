<?php
// создаем новую настройку в админке для логотипа
add_action('admin_init', 'si_register_slogan');

function si_register_slogan()
{

    add_settings_field(
        'si_option_field_slogan_test',
        'Слоган вашего сайта (test): ',
        'si_option_slogan_cb_test',
        'writing',
        'default',
        ['label_for' => 'si_option_field_slogan_test']
    );

    add_settings_field( // сначала регестрируем это поле (т.е. отобразим инпут), а потом саму настройку
        'si_option_field_slogan', //id - который будет добавлен к этому инпуту
        'Слоган вашего сайта: ',
        'si_option_slogan_cb', // название функции, которая  будет отвечать за верстку этго поля
        'general', // ярлык той странице настроек, которой мы хотим добавить наше поле
        'default', // название секции, куда мы хотим добавить нашу настройку
        ['label_for' => 'si_option_field_slogan'] // параметры, которые попадут в вызов функции, которую мы будем создавать
    );
    register_setting( // запись в БД
    // 1 - название группы, к которой будет принадлежать опция
    // 2 - название опции, которая будет сохранятья в БД (id нашего поля)
        'general', // general должен совпадать с general в add_settings_field
        'si_option_field_slogan',
        'strval' // strval - Возвращает строковое значение переменной (т.е. превращает переменную в строку)
    );
    register_setting( // запись в БД
        'writing',
        'si_option_field_slogan_test',
        'strval'
    );
}

function si_option_slogan_cb($args){  // в $args попадет ['label_for' => 'si_option_field_slogan']
    $slug = $args['label_for'];
    ?>
    <!--данный id ()id="<?php // echo $slug; ?>" должен совпадать с label_for-->
    <input
        type="text"
        id="<?php echo $slug; ?>"
        value="<?php echo get_option($slug); // получает значение указанной настройки (опции) ?>"
        name="<?php echo $slug; ?>"
        class="regular-text"
    >
<?php } ?>

<?php
function si_option_slogan_cb_test($args){  // в $args попадет ['label_for' => 'si_option_field_slogan']
    $slug = $args['label_for'];
    ?>
    <!--данный id ()id="<?php // echo $slug; ?>" должен совпадать с label_for-->
    <input
        type="text"
        id="<?php echo $slug; ?>"
        value="<?php echo get_option($slug); ?>"
        name="<?php echo $slug; ?>"
        class="regular-text"
    >
<?php } ?>