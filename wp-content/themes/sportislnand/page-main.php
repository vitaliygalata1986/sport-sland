<?php
/*
    Template Name: Шаблон для главной страницы
*/
get_header();
?>

<main class="main-content">
    <h1 class="sr-only"> Домашняя страница спортклуба SportIsland. </h1>
    <div class="banner">
        <span class="sr-only">Будь в форме!</span>
        <a href="<?php echo get_post_type_archive_link('services') ?>" class="banner__link btn">записаться</a>
    </div>
    <?php
    $post_about = get_post(154);
    if ($post_about):
        ?>
        <article class="about">
            <div class="wrapper about__flex">
                <div class="about__wrap">
                    <h2 class="main-heading about__h"><?php echo $post_about->post_title; ?></h2>
                    <p class="about__text"><?php echo $post_about->post_excerpt; ?> </p>
                    <a href="<?php echo get_the_permalink($post_about->ID) ?>" class="about__link btn">подробнее</a>
                </div>

                <figure class="about__thumb">
                    <?php echo get_the_post_thumbnail($post_about->ID, 'full') ?>
                </figure>
            </div>
        </article>
    <?php endif; ?>
    <?php
    $sales = get_posts([
        'numberposts' => -1,
        'category_name' => 'sales',
        'meta_key' => 'sales_actual',
        'meta_value' => '1',
    ]);
    //echo '<pre>';
    // print_r($sales);
    // var_dump(get_field('sales_actual', $sales[0]->ID)); // bool(true)
    // var_dump(get_post_meta($sales[0]->ID, 'sales_actual', true)); // но в базе это все хранится в виде строки string(1) "1"
    //echo '</pre>';
    if ($sales): // если массив будет пуст, то он приведеться к false, то секция не выведится
        ?>
        <section class="sales">
            <div class="wrapper">
                <header class="sales__header">
                    <h2 class="main-heading sales__h"> акции и скидки </h2>
                    <p class="sales__btns">
                        <button class="sales__btn sales__btn_prev">
                            <span class="sr-only"> Предыдущие акции </span>
                        </button>
                        <button class="sales__btn sales__btn_next">
                            <span class="sr-only"> Следующие акции </span>
                        </button>
                    </p>
                </header>
                <div class="sales__slider slider">
                    <?php
                    global $post; // нам это нужно для корректной работы, так как мы находимся в не шаблона
                    foreach ($sales as $post):
                        setup_postdata($post);
                        ?>
                        <section class="slider__slide stock">
                            <a href="<?php the_permalink(); ?>" class="stock__link"
                               aria-label="Подробнее об акции скидка 20% на групповые занятия">
                                <?php the_post_thumbnail('post-thumbnail', ['class' => 'stock__thumb']); ?>
                                <h3 class="stock__h"> <?php the_title() ?> </h3>
                                <p class="stock__text"> <?php echo get_the_excerpt(); ?> </p>
                                <span class="stock__more link-more_inverse link-more">Подробнее</span>
                            </a>
                        </section>
                    <?php endforeach;
                    wp_reset_postdata(); ?>
                </div>
            </div>
        </section>
    <?php endif; ?>
    <?php $query = new WP_Query([
        'numbersposts' => -1,
        'post_type' => 'cards',
        'meta_key' => 'club_order',
        'orderby' => 'meta_value_num',
        'order' => 'ASC',
    ]);
    // $cards = $query->posts;
    // echo '<pre>';
    // print_r($cards);
    // echo '</pre>';
    if ($query->have_posts()):
        ?>
        <section class="cards cards_index">
            <div class="wrapper">
                <h2 class="main-heading cards__h"> клубные карты </h2>
                <ul class="cards__list row">
                    <?php while ($query->have_posts()):
                        $query->the_post();
                        $profit_class='';
                        if(get_field('club_profit')){
                            $profit_class=' card_profitable';
                        }
                        $benefits = get_field('club_benefits');
                        $benefits = explode(',', $benefits); // получили массив строк
                        $bg = get_the_post_thumbnail_url(get_the_ID());
                        $default=_si_assets_path('/img/index__cards_card1.jpg');
                        $bg = $bg ?
                            "style=\"background-image:url(${bg})\";" :
                            "style=\"background-image:url(${default})\";";
                        ?>
                        <li class="card<?php echo $profit_class; ?>" <?php echo $bg; ?>>
                            <h3 class="card__name"> <?php the_title()?> </h3>
                            <p class="card__time"> <?php the_field('club_time_start')?> &ndash; <?php the_field('club_time_end')?> </p>
                            <p class="card__price price"> <?php the_field('club_price')?> <span class="price__unit"
                                                                     aria-label="рублей в месяц">р.-/мес.</span>
                            </p>
                            <ul class="card__features">
                                <?php foreach ($benefits as $bn): ?>
                                <li class="card__feature"><?php echo $bn;?></li>
                                 <?php endforeach;?>
                            </ul>
                            <a data-post-id="<?php echo $id; ?>" href="#modal-form" class="card__buy btn btn_modal">купить</a>
                        </li>
                    <?php endwhile; wp_reset_postdata(); ?>
                </ul>
            </div>
        </section>
    <?php endif; ?>

    <?php // echo do_shortcode('[instagram-feed feed=1]')?>
</main>

<?php get_footer(); ?>
