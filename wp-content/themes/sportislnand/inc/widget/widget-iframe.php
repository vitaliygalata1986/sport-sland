<?php

class SI_Widget_Iframe extends WP_Widget
{

    public function __construct()
    {
        parent::__construct('si_widget_iframe', 'SportIsland - Iframe', [
            'name' => 'SportIsland - Iframe',
            'description' => 'Выводит iframe. Полезен для встаривания видео, карт и прочего контента через iframe.',
        ]);
    }

    public function form($instance)
    {
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('id-code'); ?>">Вставьте iframe код</label>
            <textarea class="widefat" name="<?php echo $this->get_field_name('code') ?>>"
                value="<?php echo esc_html($instance['code']); ?>"
                id="<?php echo $this->get_field_id('id-code'); ?>">
                <?php echo esc_html($instance['code']) ?>
            </textarea>
        </p>

        <?php
    }

    public function widget($args, $instance)
    {
        echo $instance['code'];

    }

    public function update($new_instance, $old_instance)
    {
        return $new_instance;
    }
}

?>