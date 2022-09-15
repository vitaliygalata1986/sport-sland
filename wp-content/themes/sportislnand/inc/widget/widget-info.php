<?php

class SI_Widget_Info extends WP_Widget{
    // вызываем родительский метод __construct 1-й - ярлык,с помощью которого мы можем обращаться к этому виджету
    public function __construct(){ // переопределим родительский метод __construct
        parent::__construct('si_widget_info', 'SportIsland - Информация',[
            'name'=>'SportIsland - Информация',
            'description'=>'Выводит информацию о спорт - клубе.',
        ]); // si_widget_text должно совпадать с SI_Widget_Text
    }

    // переопределим еще два метода
    public function form($instance){ // отвечает за форму верстки, которая будет видна в админке
        // $instance - те данные, которые записанны в базе (чтобы при вновьобращении к виджету - можно было бы его отредактировать, иначе будет пусто)
            $vars=[
                'position' =>'Адрес',
                'time' =>'Время',
                'phone' =>'Номер телефона',
                'mail' =>'Адрес электронной почты',
            ];
        ?>

        <p>
            <label for="<?php echo $this->get_field_id('id-info');?>">Текст:</label>
            <input
                    type="text"
                    class="widefat"
                    name="<?php echo $this->get_field_name('info')?>"
                    value="<?php echo $instance['info'] // по ключу info, который мы указали в name - выведим данные ?>"
                    id="<?php echo $this->get_field_id('id-info'); // функция возвращает уникальный id, через this можем получать методы родит. класса ?>"
            >
        </p><p>
            <label for="<?php echo $this->get_field_id('id-var');?>">Выберите вариант отображения:</label>
            <select
                    class="widefat"
                    name="<?php echo $this->get_field_name('var')?>>"
                    id="<?php echo $this->get_field_id('id-var');?>"
            >
                <?php foreach ($vars as $var => $desc):?>
                    <option
                            value="<?php echo $var;?>"
                        <?php selected($instance['var'],$var, true); // 1-тот вариант, который уже выбран (var - select name=var) - т.е. достаем из базы, 2-й, тот option, который сейчас распечатывается. Функция selected сравнивает, какой раньше вариант был выбран и записан в базу $instance['slug'], с тем вариантом, который сейчас выводится $slug - и если они совпадают, то функция вернет нам строку checked
                        // Но нам ненужно, чтобы она была возвращена, нам нужно, чтобы ее вывели true - выводить echo
                        ?>
                    >
                        <?php echo $desc;?>
                    </option>
                <?php endforeach;?>
            </select>
        </p>


        <?php
    }

    public  function  widget($args, $instance){ // данный метод работает, когда собирается страница на фронтенде, $instance - данные, которые хранятся в базе
        switch($instance['var']){
            case 'position' :
                ?>
                    <span class="widget-address"> <?php echo $instance['info'];?></span>
                <?php
                break;
            case 'time' :
                ?>
                    <span class="widget-working-time"> <?php echo $instance['info'];?> </span>
                <?php
                break;
            case 'phone' :
                $tel = preg_replace('/[^+0-9]/', '', $instance['info']);
                ?>
                    <a href="tel:<?php echo $tel;?>" class="widget-phone"><?php echo $instance['info'];?></a>
                <?php
                break;
            case 'mail' :
                ?>
                    <a href="mailto:<?php echo $instance['info'];?>" class="widget-email"><?php echo $instance['info'];?></a>
                <?php
                break;
            default: echo '';
            break;
        }
    }



    public  function  update($new_instance, $old_instance){ // срабатывает в момент, кода происходит редактирование данных
        // $new_instance - новые введенные данные
        // $old_instance - данные, которые уже были введенны
        return $new_instance; // то, что мы здесь вернем - будет сохранено и потом эти данные вернуться нам назад и будут подставленны в value
    }
}

?>