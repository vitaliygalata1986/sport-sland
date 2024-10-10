<?php
    /*
        Template Name: getPosts()
    */
?>

<?php get_header() ?>
<main class="main-content">
      <div class="wrapper">
          Функция getPosts()
      </div>
      <?php
        $results = get_posts([
            // 'include' => [140], // ID постов, которые нужно получить.
            'post_type'=>'houses',
            'meta_key' => 'price', // отсортируем по цене
            'numberposts' => 3,
            'orderby' => 'meta_value', // сортировать по значению поля meta_value ( 'meta_key' => 'price')
            'order' => 'ASC',
        ]);
        echo "<pre>";
      // print_r($results);
        //var_dump($results);
        echo "</pre>";
      ?>

    <?php foreach( $results as $post ):
        setup_postdata($post); // передаем объект записи $post
    ?>
<!--        <h2> --><?php //echo $post->post_title; ?><!--</h2>-->
        <h2> <?php the_title(); ?></h2>
        <?php the_content();?>
        <?php //echo apply_filters('the_content',$post->post_content); ?>
<!--        <p>Цена: --><?//= get_post_meta($post->ID,'price', true); //  true-чтобы вернуло только одно значение, а не массив ?><!--</p>-->
<!--        <p>Цена: --><?//= get_field('price', $post->ID);?>
        <p>Цена: <?php the_field('price'); // здесь id передавать уже ненужно, так как используем setup_postdata($post) ?>
    <?php endforeach; wp_reset_postdata();// чтобы дальше работа WP не нарушалась - так как setup_postdata настроена глобально на $post - и эта функция сбросит $post в дефолтное состояние?>

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
    </main>
<?php get_footer() ?>
