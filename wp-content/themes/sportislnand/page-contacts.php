<?php
    /*
        Template Name: Шаблон для страницы контактов
    */
?>

<?php get_header() ?>
    <main class="main-content">
          <div class="wrapper">
           <?php get_template_part('tmp/breadcrumbs')?>
          </div>
            <?php if (is_user_logged_in()):?>
                <section class="contacts">
                      <?php if(have_posts()): while (have_posts()): the_post();?>
                            <div class="wrapper">
                      <h1 class="contacts__h main-heading"><?php the_title()?></h1>
                      <div class="map">
                        <a href="#" class="map__fallback">
                          <img src="<?php echo _si_assets_path('/img/map.jpg')?>" alt="Карта клуба SportIsland">
                          <span class="sr-only"> Карта </span>
                        </a>
                          <?php if(is_active_sidebar('si-map')){
                              dynamic_sidebar('si-map');
                          }?>
                      </div>
                      <p class="contacts__info">
                          <?php if(is_active_sidebar('si-after-map')){
                              dynamic_sidebar('si-after-map');
                          }?>
                      </p>
                        <?php the_content();?>
                    </div>
                      <?php endwhile; endif; ?>
                </section>
            <?php else:?>
            <div class="wrapper">
                <form class="registration" action="<?php echo esc_url(admin_url('admin-ajax.php'))?>">
                    <input type="text" name="login" required>
                    <input type="password" name="pass"required>
                    <input type="email" name="email" required>
                    <input type="hidden" name="action" value="registration">
                    <button type="submit"><?php _e('Регистрация','sport-island') ?></button>
                </form>
                <form class="auth" action="<?php echo esc_url(admin_url('admin-ajax.php'))?>">
                    <input type="text" name="login" required>
                    <input type="password" name="pass" required>
                    <input type="hidden" name="action" value="auth">
                    <button type="submit"><?php _e('Авторизация','sport-island')?></button>
                </form>
            </div>
            <?php endif;?>
        </main>
        <style>
            /*.auth{*/
            /*    display: none;*/
            /*}*/
        </style>
        <script>
            window.onload = ()=>{
                const reg = document.querySelector('.registration')
                const auth = document.querySelector('.auth')
                if(auth!=null){
                    reg.addEventListener('submit', async e=>{
                        e.preventDefault()
                        const data = new FormData(e.target) // передаем текущую форму, чтобы были собранны все ее данные
                        const result = await fetch(e.target.getAttribute('action'),{ // получаем адрес на который будем стучаться
                            method: 'POST',
                            body:data
                        })
                        // console.log(data)
                        // console.log(result)
                        if(result.ok){
                            e.target.style.display="none"
                            auth.style.display="block"
                            let id = await result.text() // этот метод прочитает ответ как текст
                            // console.log(id)
                        }
                    })
                    auth.addEventListener('submit', async e=>{
                        e.preventDefault()
                        const data = new FormData(e.target) // передаем текущую форму, чтобы были собранны все ее данные
                        const result = await fetch(e.target.getAttribute('action'),{ // получаем адрес на который будем стучаться
                            method: 'POST',
                            body:data
                        })
                        if(result.ok){
                            e.target.style.display="none"
                            let login = await result.text() // этот метод прочитает ответ как текст
                            window.location.reload();
                            console.log(login)
                            // document.body.insertAdjacentHTML('afterbegin',`<h1>Привет, ${login}</h1`)
                        }else{
                            console.log('Не получилось авторизоваться - такого пользователя нет или неправильно ввели данные')
                        }
                    })
                }
            }
        </script>
<?php get_footer() ?>
