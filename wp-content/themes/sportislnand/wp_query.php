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
    $query = new WP_Query([
        'post_type' => 'houses',
        'posts_per_page' => 3,
        'meta_key' => 'price',
        'orderby' => 'meta_value_num', // meta_value_num - при сортировке учитывать meta поле как число, иначе будет как строка сранвиваться, и окажется, что 11 > чем 100
        'order' => 'ASC', // по возсрастанию
        //'type'=>'appartments' // ярлык самого термина - т.е. нам нужны Квартиры
        // спец. ключ, в котором мы можем передавать несколько запросов, связанных с таксономиями
        'tax_query' => [
            'relation'=>'AND', // чтобы все наши запросы были объедененны по логике AND - все и сразу
            [
                'taxonomy' => 'type', // таксономия type - квартиры
                //'field' => 'id',
                //'field' => 'name',
                'field' => 'slug',
                'terms' => 'appartments',
                // 'terms' => 24,
                //'terms' => 'Квартиры',
            ],
            [
                'taxonomy' => 'method', // способ реализации - продажа
                'field' => 'slug',
                'terms' => 'sell',
            ],
            [
                'taxonomy' => 'type', // нам нужны только новые
                'field' => 'slug',
                'terms' => 'new',
            ],
            [
                'taxonomy' => 'status', // эти записи с такой таксономией будут исключены из результата
                'field' => 'name',
                'terms' => 'Не введен в эксплуатацию',
                'operator' => 'NOT IN', // чтобы исключить настройку
            ],
        ],
        'meta_query' =>[ // поля для произвольных полей
                [
                        'key' => 'price',
                        'value' => '75000',
                        // нам нужно не больше 75000 - т.е. меньше или равно 120000
                        'compare' => '<='
                ]
        ]
    ]);

    if( $query->have_posts()): while ($query->have_posts()): $query->the_post();

    ?>
        <?php
           //  echo "<pre>";
           //  print_r($query);
           //  var_dump($query->posts);
           //  echo "</pre>";
        ?>

        <h2> <?php the_title(); ?></h2>
        <?php the_content();?>
        <p>Цена: <?php the_field('price');?>
        <hr>

<?php
    endwhile;
    wp_reset_postdata();
    endif;
    ?>
        <br><br>
        <p>Все объекты недвижимости:</p>
    <?php

    $posts=get_posts([
        'post_type' => 'houses',
        'numberposts' => -1,
        'order'       => 'ASC',
    ]);

   foreach( $posts as $post ):
        setup_postdata($post); // передаем объект записи $post
    ?>

        <h2> <?php the_title(); ?></h2>
        <?php the_content();?>
        <p>Цена: <?php the_field('price'); ?>
       <hr>
    <?php endforeach; wp_reset_postdata();?>


    </div>
</main>
<?php get_footer() ?>
