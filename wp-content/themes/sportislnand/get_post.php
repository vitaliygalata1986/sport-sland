<?php
    /*
        Template Name: getPost()
    */
?>

<?php get_header() ?>
<main class="main-content">
      <div class="wrapper">
          <p>Функция getPost()</p>
          <?php
            $post = get_post(140);
            //var_dump($post);
            echo  $post->ID;
          ?>
          <h1><?= $post->post_title; ?></h1>
          <h1><?= apply_filters('the_content',$post->post_title); // фильтр the_content - все функции, которые подписаны на этот фильтр сработают и работоспособность многих плагинов будет сохранена ?></h1>
          <p><?= $post->post_content; ?></p>
          <p>Цена: <?= get_post_meta($post->ID,'price', true); //  true-чтобы вернуло только одно значение, а не массив ?></p>
          <p>Цена: <?= get_field('price',$post->ID); ?></p>
          <p>Цена: <?= get_fields($post->ID)['price']; ?></p>

          <?php
              $post = get_post(140,ARRAY_A );
              // var_dump($post);
          ?>
          <h1><?= $post['post_title']; ?></h1>


          <?php
            $post = get_post(140,ARRAY_N );
            // var_dump($post);
          ?>
          <h1><?= $post[5]; ?></h1>


      </div>

    </main>
<?php get_footer() ?>
