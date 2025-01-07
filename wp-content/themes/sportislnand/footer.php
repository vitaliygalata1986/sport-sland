<div class="modal">
    <div class="wrapper">
        <section class="modal-content modal-form" id="modal-form">
            <button class="modal__closer">
                <span class="sr-only">Закрыть</span>
            </button>
            <form method="post" action="<?php echo esc_url(admin_url('admin-post.php'))?>" class="modal-form__form">
                <h2 class="modal-content__h"> Отправить заявку </h2>
                <p> Оставьте свои контакты и менеджер с Вами свяжется </p>
                <p>
                    <label>
                        <span class="sr-only">Имя: </span>
                        <input type="text" name="si-user-name" placeholder="Имя">
                    </label>
                </p>
                <p>
                    <label>
                        <span class="sr-only">Телефон:</span>
                        <input type="text" name="si-user-phone" placeholder="Телефон" pattern="^\+{0,1}[0-9]{4,}$" required="">
                    </label>
                </p>
                <input type="hidden" name="action" value="si-modal-form">
                <button class="btn" type="submit">Отправить</button>
            </form>
        </section>
    </div>
</div>
<div class="footer">
    <header class="main-header">
        <div class="wrapper main-header__wrap">
            <p class="main-header__logolink">
                <?php the_custom_logo(); ?>
                <span class="slogan"><?php echo get_option('si_option_field_slogan')?></span>
            </p>

            <?php
                $locations = get_nav_menu_locations();
                $menu_id = $locations['menu-footer']; // получим id меню, который привязан к зоне menu-footer
                $menuitems = wp_get_nav_menu_items($menu_id, [
                    'order' => 'ASC',
                    'orderby' => 'menu_order', // сортировка пунктов меню по позициям
                ]);
            ?>
            <nav class="main-navigation">
                <ul class="main-navigation__list">
                    <?php
                    $count = 0;
                    $submenu = false;
                    foreach ($menuitems as $item):
                        $http_s = 'http' . ( (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !='off' ) ? 's' : '' ) . '://'; // если в $_SERVER есть HTTPS и он не отключен
                        $url = $http_s . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];

                        $class_text = '';
                        if($item->url === $url){ // если адрес пункта меню совпадает с адресом текущей страницы
                            $class_text = 'class="active"';
                        }
                        $link = $item->url;
                        $title = $item->title;
                        // item does not have a parent so menu_item_parent equals 0 (false)
                        if (!$item->menu_item_parent):
                            $parent_id = $item->ID;
                            ?>
                            <li <?php echo $class_text;?>>
                                <a href="<?php echo $link; ?>" class="title">
                                    <?php echo $title; ?>
                                </a>
                        <?php endif; ?>
                        <?php if ($parent_id == $item->menu_item_parent): ?>
                        <?php if (!$submenu): $submenu = true; ?>
                            <ul class="sub-menu">
                        <?php endif; ?>
                                <li <?php echo $class_text;?>>
                                    <a href="<?php echo $link; ?>" class="title"><?php echo $title; ?></a>
                                </li>
                        <?php if ( !isset($menuitems[ $count + 1 ]) || $menuitems[ $count + 1 ]->menu_item_parent != $parent_id && $submenu ): ?>
                            </ul>
                            <?php $submenu = false; endif; ?>
                    <?php endif; ?>
                        <?php if ( !isset($menuitems[ $count + 1 ]) || $menuitems[ $count + 1 ]->menu_item_parent != $parent_id ): ?>
                        </li>
                        <?php $submenu = false; endif; ?>
                        <?php $count++; endforeach; ?>
                </ul>
            </nav>
            <?php if(is_active_sidebar('si-footer')){
                dynamic_sidebar('si-footer');
            }?>
        </div>
    </header>

    <footer class="main-footer wrapper">
        <div class="row main-footer__row">
            <div class="main-footer__widget main-footer__widget_copyright">
                <span class="widget-text"><?php if(is_active_sidebar('si-footer-column-1')) { dynamic_sidebar('si-footer-column-1'); }?></span>
            </div>
            <div class="main-footer__widget">
                <p class="widget-contact-mail">
                    <?php if(is_active_sidebar('si-footer-column-2')){
                        dynamic_sidebar('si-footer-column-2');
                    }?>
                </p>
            </div>
            <div class="main-footer__widget main-footer__widget_social">
                <?php if(is_active_sidebar('si-footer-column-3')){
                    dynamic_sidebar('si-footer-column-3');
                }?>
            </div>
        </div>
    </footer>
</div>

<script>
    window.wpApiSettings = { // к объекту window добавляют ключ wpApiSettings
        nonce: '<?php echo wp_create_nonce('wp_rest') // сгенерируем nonce,который будет фигурировать при запросе на REST API?>',
        restUrl: '<?php echo esc_url_raw(rest_url()) // сформирует базовый путь до REST API?>',
    }

    // для get запроса
/*
        ;(async()=>{
            const req = await fetch(wpApiSettings.restUrl+'real_estate/v1/houses/?_wpnonce='+wpApiSettings.nonce);
            const res = await req.json();
            console.log(res);
        })()
*/

    // для post запроса
    /*
    ;(async()=>{
        const data = new FormData();
        data.append('title', 'Новый заголовок для квартира 153');
        const req = await fetch(wpApiSettings.restUrl+'real_estate/v1/houses/',{
            method: 'POST',
            headers:{
                'X-WP-Nonce': wpApiSettings.nonce // передаем в POST запрос nonce
            },
            body: data // тело запроса
        });
        const res = await req.json();
        console.log(res);
    })()
    */

/*
    const test = async function(){
        const req = await fetch(wpApiSettings.restUrl+'real_estate/v1/houses/?_wpnonce='+wpApiSettings.nonce);
        const res = await req.json();
        console.log(res);
    }
    test()
*/

</script>

<?php wp_footer(); ?>
</body>
</html>
