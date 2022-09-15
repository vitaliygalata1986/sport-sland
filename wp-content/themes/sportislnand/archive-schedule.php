<?php get_header() ?>
<main class="main-content">
      <div class="wrapper">
          <?php get_template_part('tmp/breadcrumbs')?>
        <h1 class="main-heading schedule-page__h">расписание</h1>
        <div class="tabs">
          <ul class="tabs-btns">
              <?php
                $days = get_terms([
                   'taxonomy' => 'schedule_days',
                    'order' => 'ASC', // сортируем по ярлыку
                    'orderby' => 'slug',
                ]);
                $index=0;
                // print_r($days); // получим массив, где каждый отдельный элмент массива - это объект
              ?>
              <?php foreach ($days as $day): ?>
                    <li class="tabs-btns__item<?php echo $index === 0 ? ' active-tab' : ''?>">
              <a href="#<?php echo $day->slug;?>" class="tabs-btns__btn" aria-label="<?php echo $day->description;?>"> <?php echo $day->name;?> </a>
            </li>
              <?php $index++; endforeach;?>

          </ul>
          <ul class="tabs-content">
              <?php
                $index=0;
                foreach ($days as $day):
              ?>
                <li class="tabs-content__item<?php echo $index === 0 ? ' active-tab' : ''?>" id="<?php echo $day->slug;?>">
                  <h2 class="sr-only"><?php echo $day->description;?></h2>
                      <ul class="schedule tabs-content__list">
                        <?php
                            // получаем записи, прикрепленные к таксономии shedule_days
                            $actions = new WP_Query([
                                'posts_per_page' => -1,
                                'post_type' => 'schedule',

                                /*
                                 'tax_query' => array(
                                    array(
                                        'taxonomy' => 'schedule_days',
                                        'field'    => 'slug', // Поле которое будет указывать в параметре terms Может быть:
                                                              // id или term_id - в terms указываем id терминов.
                                                              // name - в terms указываем заголовок термина.
                                                              // slug - в terms указываем ярлык термина.
                                        'terms'    => $day->slug // термины таксономии, из которых нужно вывести записи.
                                    )
                                ),
                                */

                                // array( 'schedule_days' => $day->slug ),

                                'schedule_days' => $day->slug, // возьмем именно те записи у которой таксономия days была установлена в положении $day->slug - т.е.

                                // мы идем в цикле по терминам таксономии:   foreach ($days as $day): и на каждой итерации получаем записи, которые закреплены за этим термином: $day->slug
                                'meta_key' => 'shedule_time_start', // т.е. мы будем делать сортировку. Нам нужно вывести те записи, которые раньше начинаются чем вечернее
                                // в ACF есть такоф ключ shedule_time_start - это для начала занятия
                                'orderby' => 'meta_value_num', // чтобы сортировка было по числу
                                'order' =>'ASC'
                            ]);

//                            echo "<pre>";
//                            print_r($actions);
//                            echo "</pre>";
                        if($actions->have_posts()):
                        ?>
                        <?php while ($actions->have_posts() ): $actions->the_post(); ?>
                            <li class="schedule__item">
                              <p class="schedule__time"> <?php the_field('shedule_time_start');?> &ndash; <?php the_field('shedule_time_end');?> </p>
                              <h2 class="schedule__h"> <?php the_field('shedule_name');?> </h2>
                              <p class="schedule__trainer"> с <?php echo esc_html(get_the_title(get_field('shedule_trainer'))); // получим заголовок тренера по id?> </p>
                              <!--нужно получить значение термина таксономии зал для текущий записи-->
                                <!--get_the_terms говрит о т ом, что мы хотим получить термины какой-то конкретной записи,а не все термины-->
                                <!--  $id будет доступна после того,как мы вызвали the_post() -->
                                <p class="schedule__place"
                                    style="color: <?php echo get_field('place_color', 'places_' . get_the_terms($id, 'places')[0]->term_id)
                                    // нужно передать id таксономии, в начале указываем ярлык той сущности, которую хотим получить, а затем добавляем id термина?>"
                                >
                                    <?php
                                    // $test = get_the_terms($id, 'places')[0];
                                    // echo '<pre>';
                                    // print_r($test);
                                    // echo '</pre>';
                                       echo get_the_terms($id, 'places')[0]->name;
                                    // верентся массив, возьмем только первый самый элемент?>
                                </p>
                            </li>
                        <?php endwhile; wp_reset_postdata($id); endif;?>
                      </ul>
            </li>
              <?php $index++; endforeach; ?>
          </ul>
        </div>
      </div>
    </main>
<?php get_footer() ?>