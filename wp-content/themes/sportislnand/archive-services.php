<?php get_header() ?>
<main class="main-content">
      <h1 class="sr-only">Услуги</h1>
      <div class="wrapper">
          <?php get_template_part('tmp/breadcrumbs')?>
        <?php if(have_posts()): ?>
            <ul class="services-list">
                <?php while (have_posts()) : the_post(); ?>
                    <li class="services-list__item service">
            <h2 class="service__name main-heading"> <?php the_title()?> </h2>
            <p class="service__text"><?php echo get_the_content();?></p>
            <p class="service__action">
                <a data-post-id="<?php echo $id; ?>" href="#modal-form" class="service__subscribe btn btn_modal">записаться</a>
              <strong class="service__price price"> <?php the_field('services_price');?> <span class="price__unit">р./мес.</span>
              </strong>
            </p>
            <figure class="service__thumb">
                <?php the_post_thumbnail('post-thumbnail', [
                    'class' => 'service__img'
                ]); ?>
            </figure>
          </li>
                <?php endwhile;?>
            </ul>
        <?php else:
            get_template_part('tmp/no-posts');
            endif;
        ?>
      </div>
    </main>
<?php get_footer() ?>