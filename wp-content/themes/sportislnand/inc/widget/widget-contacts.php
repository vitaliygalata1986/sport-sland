<?php

class SI_Widget_Contacts extends WP_Widget
{

    public function __construct()
    {
        parent::__construct('si_widget_contacts', 'SportIsland - Виджет контактов', [
            'name' => 'SportIsland - Виджет контактов',
            'description' => 'Выводит номер телефона и адрес',
        ]);
    }

    public function form($instance)
    {
        ?>


        <p>
            <label for="<?php echo $this->get_field_id('id-phone'); ?>">Введите номер телефона</label>
            <input
                    type="text"
                    class="widefat"
                    name="<?php echo $this->get_field_name('phone') ?>>"
                    value="<?php echo $instance['phone'] // по ключу text, который мы указали в name - выведим данные
                    ?>"
                    id="<?php echo $this->get_field_id('id-phone'); // функция возвращает уникальный id, через this можем получать методы родит. класса
                    ?>"
            >
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('id-address'); ?>">Введите адрес:</label>
            <input
                    type="text"
                    class="widefat"
                    name="<?php echo $this->get_field_name('address') ?>>"
                    value="<?php echo $instance['address'] // по ключу text, который мы указали в name - выведим данные
                    ?>"
                    id="<?php echo $this->get_field_id('id-address'); // функция возвращает уникальный id, через this можем получать методы родит. класса
                    ?>"
            >
        </p>

        <?php
    }

    public function widget($args, $instance)
    {
        $tel_text = $instance['phone'];
        $pattern = '/[^+0-9]/'; // вырежим все то,что нам ненужно (нам ненужны символы, но допускается +) [] - диапозон тех значений, которые нас устроят это + и от 0 до 9
        // с помощью этой реругярки будем вырезать, поэтому используем каретку ^ - т.е. кроме
        $tel = preg_replace($pattern, '', $tel_text); // '' - это на что нужно заменить все совпадения
        ?>
        <address class="main-header__widget widget-contacts">
            <a href="tel:<?php echo $tel;?>" class="widget-contacts__phone"><?php echo $instance['phone'];?></a>
            <p class="widget-contacts__address"><?php echo $instance['address'];?></p>
        </address>
<?php }

    public function update($new_instance, $old_instance)
    { // срабатывает в момент, кода происходит редактирование данных
        return $new_instance; // то, что мы здесь вернем - будет сохранено и потом эти данные вернуться нам назад и будут подставленны в value
    }
}

?>