<?php

class SI_Widget_Text extends WP_Widget{
    // вызываем родительский метод __construct 1-й - ярлык,с помощью которого мы можем обращаться к этому виджету
   public function __construct(){ // переопределим родительский метод __construct
       parent::__construct('si_widget_text', 'SportIsland - Текстовый виджет',[
            'name'=>'SportIsland - Текстовый виджет',
            'description'=>'Выводит простой текст без верстки',
       ]); // si_widget_text должно совпадать с SI_Widget_Text
   }

   // переопределим еще два метода
    public function form($instance){ // отвечает за форму верстки, которая будет видна в админке
        // $instance - те данные, которые записанны в базе (чтобы при вновьобращении к виджету - можно было бы его отредактировать, иначе будет пусто)
?>

<!--тег form писать ненужно, а только те, которые нужын для нашей формы и кнопку сохранить тоже ненуж ноделать. WP это добавит автоматически.-->
<p>
    <label for="<?php echo $this->get_field_id('id-text');?>">Введите текст</label>
    <textarea
        type="text"
        class="widefat"
        name="<?php echo $this->get_field_name('text')?>>"
        value="<?php echo $instance['text'] // по ключу text, который мы указали в name - выведим данные ?>"
        id="<?php echo $this->get_field_id('id-text'); // функция возвращает уникальный id, через this можем получать методы родит. класса ?>"
    >
        <?php echo $instance['text'] ?>
    </textarea>
</p>

<?php
   }

    public  function  widget($args, $instance){ // данный метод работает, когда собирается страница на фронтенде, $instance - данные, которые хранятся в базе
                                                // $args - те данные, которые были указаны в register_sidebar
        //echo $args['before_widget'];
        echo apply_filters('si_widget_text',$instance['text']); // получаем те данные, которые были сохранены
        //echo $args['after_widget'];
		//echo $instance['text'];
        // все функции, подписанные на этот фильтр apply_filters - запустятся в этом месте (у нас это do_shortcode)
        // и в качестве параметра будет передан тот текст, который нужно вывести
    }



    public  function  update($new_instance, $old_instance){ // срабатывает в момент, кода происходит редактирование данных
        // $new_instance - новые введенные данные
        // $old_instance - данные, которые уже были введенны
        return $new_instance; // то, что мы здесь вернем - будет сохранено и потом эти данные вернуться нам назад и будут подставленны в value
    }
}

?>