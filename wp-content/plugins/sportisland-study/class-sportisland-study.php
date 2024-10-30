<?php

class Sportisland_Study
{

    // 1 - способ
    public function convert_title()
    {
        add_filter('the_title', function ($title, $post_id) {
            if (!is_singular()) { // если это не отдельный пост
                return $title;
            }
            return mb_convert_case($title, MB_CASE_LOWER);
        }, 10, 2); // 2 - кол. аргументов, которые передаем в фильтр - это $title,$post_id
    }

    // 2 - способ
    // при создании экземпляра класа был автоматически вызван метод convert_title
    /*
    public function __construct()
    {
        add_filter('the_title', array($this, 'convert_title'), 10, 2);
        // итак, на этот фильтр: 'the_title' навесить метод 'convert_title', который явл. методом объекта $this
        // array нужен для того, чтобы из одного метода вызвать другой метод, то мы должны указать это в виде массива
    }
    */

    /*
    public function convert_title($title)
    {
        if (!is_singular()) { // если это не отдельный пост
            return $title;
        }
        return mb_convert_case($title, MB_CASE_LOWER);
    }
    */


    //  3 - способ - использование статического метода
    /*
    public static function convert_title()
    {
        add_filter('the_title', function ($title, $post_id) {
            if (!is_singular()) { // если это не отдельный пост
                return $title;
            }
            return mb_convert_case($title, MB_CASE_LOWER);
        }, 10, 2); // 2 - кол. аргументов, которые передаем в фильтр - это $title,$post_id
    }
    */


    //  4 - способ
    /*
    public static function convert_title($title)
    {
        if (!is_singular()) { // если это не отдельный пост
            return $title;
        }
        return mb_convert_case($title, MB_CASE_LOWER);
    }
    */
}


