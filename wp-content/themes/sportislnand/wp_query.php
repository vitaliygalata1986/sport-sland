<?php
/*
    Template Name: wp_query()
*/
?>

<?php get_header() ?>
<main class="main-content">
    <div class="wrapper">
        <p>Объект WP_Query</p><br>

        <?php

        // получить квартиры у которых термин таксономии: appartments
        /*
        $query = new WP_Query([
            'post_type' => 'houses',
            'posts_per_page' => 3,
            'meta_key' => 'price',
            'orderby' => 'meta_value_num', // meta_value_num - при сортировке учитывать meta поле как число, иначе будет как строка сравниваться, и окажется, что 11 > чем 100
            'order' => 'ASC', // по возрастанию
            'type'=>'appartments' // ярлык самого термина - т.е. нам нужны Квартиры
            ]
        );
        */

        // Получим 3 квартиры, которые готовы к продаже, которые являются новостроем, и цена была до 75 000, результаты вывести по возрастанию цены

        $query = new WP_Query([
            'post_type' => 'houses',
            'posts_per_page' => 3,
            'meta_key' => 'price',
            'orderby' => 'meta_value_num', // meta_value_num - при сортировке учитывать meta поле как число, иначе будет как строка сравниваться, и окажется, что 11 > чем 100
            'order' => 'ASC', // по возрастанию
            // tax_query - спец. ключ, в котором мы можем передавать несколько запросов, связанных с таксономиями
            'tax_query' => [
                'relation' => 'AND', // чтобы все наши запросы были объедененны по логике AND - все и сразу
                [
                    'taxonomy' => 'type', // таксономия type - квартиры
                    'field' => 'slug', // по какому полю мы быдуем вытаскивать термины таксономии
                    'terms' => 'appartments',

                    // если 'field' => 'id', то нужно в terms передать 24 - id термина appartments
                    // 'terms' => 24,

                    // если передадим  //'field' => 'name',
                    //'terms' => 'Квартиры',
                ],
                [
                    'taxonomy' => 'method', // способ реализации - продажа
                    'field' => 'slug',
                    'terms' => 'sell',
                ],
                [
                    'taxonomy' => 'type', // нам нужны только новые квартиры, тоесть новострои
                    'field' => 'slug',
                    'terms' => 'new',
                ],
                // исключим те, которые не введены в эксплуатацию
                [
                    'taxonomy' => 'status',
                    'field' => 'slug',
                    'terms' => 'note_in_use',
                    'operator' => 'NOT IN', // чтобы исключить настройку (по умочанию он IN - тоесть включать записи, которые соответствуют этим терминам)
                ],
            ],
            // настройки запроса, связанные с мета данными
            'meta_query' => [ // поля для произвольных полей
                [
                    'key' => 'price',
                    'value' => '75000',
                    // нам нужно не больше 75000 - т.е. меньше или равно 75000
                    'compare' => '<='
                ]
            ]
        ]);
        //    echo "<pre>";
        //     var_dump($query->posts); // posts - массив с нашими записями
        //    echo "</pre>";

        /*
            foreach ($query->posts as $post){
        //          echo "<pre>";
        //          print_r($post);
        //          echo "</pre>";
                echo $post->post_title . '<br/>';
                echo $post->post_content . '<br/>';
                echo "<hr>";
            }
            return;
        */
        ?>

        <?php if ($query->have_posts()): while ($query->have_posts()): $query->the_post(); ?>
            <h2> <?php the_title(); ?></h2>
            <?php the_content(); ?>
            <p>Цена: <?php the_field('price'); ?>
            <hr>
        <?php
        endwhile;
            wp_reset_postdata();
        endif;
        ?>


        <?php
        echo "<hr><hr>";
        echo "<h1>Все объекты</h1>";
        echo "<hr><hr>";
        // вывод всех квартир
        $posts = get_posts([
            'post_type' => 'houses',
            'numberposts' => -1,
            'order' => 'ASC',
        ]);

        foreach ($posts as $post): setup_postdata($post); // передаем объект записи $post ?>
            <h2> <?php the_title(); ?></h2>
            <?php the_content(); ?>
            <p>Цена: <?php the_field('price'); ?>
            <hr>
        <?php endforeach;
        wp_reset_postdata(); ?>

<!--        setup_postdata() - это функция WordPress, которая устанавливает глобальные переменные для текущей записи в цикле. В вашем примере она используется внутри цикла foreach для установки контекста текущей записи, чтобы после этого использовать функции WordPress, такие как the_title(), the_content(), the_field() и т. д., которые используют глобальную переменную $post.-->
<!--        Это нужно для того, чтобы вы могли обращаться к полям и содержимому текущей записи без явного указания объекта записи, который вы обрабатываете в цикле foreach. Фактически, после вызова setup_postdata($post) вы можете использовать функции WordPress без передачи объекта записи в качестве аргумента.-->

    </div>
</main>
<?php get_footer() ?>
