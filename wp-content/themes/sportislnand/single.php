<?php get_header()?>
<main class="main-content">
      <div class="wrapper">
          <?php get_template_part('tmp/breadcrumbs')?>
      </div>
        <?php if(have_posts()): while (have_posts()): the_post();?>
      <article class="main-article wrapper">
        <header class="main-article__header">
            <?php 
                $custom_thumb = get_field('post_si_thumb');
//                echo "<pre>";
//                print_r($custom_thumb);
//                echo "</pre>";
                if($custom_thumb){
                    $url = $custom_thumb['url'];
                    $alt = $custom_thumb['alt'];
                    ?>
                        <picture>
                            <source srcset="<?php echo $custom_thumb['sizes']['si_pic']?>" media="(max-width:600px)">
                            <img src="<?php echo $url?>" alt="<?php echo $alt?>" class="main-article__thumb">
                        </picture>

<!--                        <img-->
<!--                                srcset="-->
<!--                                    --><?php //echo $custom_thumb['sizes']['si_pic']?><!-- 600w,-->
<!--                                    --><?php //echo $custom_thumb['sizes']['si_pic']?><!-- 480w,-->
<!--                                    --><?php //echo $custom_thumb['sizes']['si_pic']?><!-- 400w"-->
<!--                                sizes="(max-width: 320px) 400px,-->
<!--                                       (max-width: 480px) 440px,-->
<!--                                       100%"-->
<!--                                src="--><?php //echo $url?><!--" alt="--><?php //echo $alt?><!--" class="main-article__thumb"-->
<!--                        >-->

<!--                    <img-->
<!--                            srcset="--><?php //echo $custom_thumb['sizes']['si_pic']?><!-- 600w"-->
<!--                            sizes="(max-width: 480px) 440px, 100%"-->
<!--                            src="--><?php //echo $url?><!--" alt="--><?php //echo $alt?><!--" class="main-article__thumb"-->
<!--                    >-->

                    <?php

                   // echo "<img src=\"$url\" alt=\"$alt\" class=\"main-article__thumb\">";
                }else{
                    the_post_thumbnail('post-thumbnail', [
                        'class' => 'main-article__thumb'
                    ]);
                }
          ?>
          <h1 class="main-article__h"><?php the_title()?></h1>
        </header>
        <?php the_content();?>
        <footer class="main-article__footer">
          <time datetime="<?php echo get_the_date('Y-m-d')?>"><?php echo get_the_date('d F Y')?></time>
          <button
                  class="main-article__like like"
                  style="background-color: transparent; border: none; font-size: 16px; cursor:pointer; font:inherit";
                  data-href="<?php echo esc_url(admin_url('admin-ajax.php'))?>"
                  data-id="<?php echo $id;?>"
          >

                 <!-- <script>
                     // window.ajaxUrl = '<?php // echo esc_url(admin_url('admin-ajax.php'))?>';
                  </script>
                  -->
            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 51.997 51.997" style="enable-background:new 0 0 51.997 51.997;" xml:space="preserve">
              <style> path{
	 		fill: #666;
	 	}
	 </style>
              <path d="M51.911,16.242C51.152,7.888,45.239,1.827,37.839,1.827c-4.93,0-9.444,2.653-11.984,6.905
	c-2.517-4.307-6.846-6.906-11.697-6.906c-7.399,0-13.313,6.061-14.071,14.415c-0.06,0.369-0.306,2.311,0.442,5.478
	c1.078,4.568,3.568,8.723,7.199,12.013l18.115,16.439l18.426-16.438c3.631-3.291,6.121-7.445,7.199-12.014
	C52.216,18.553,51.97,16.611,51.911,16.242z" />
            </svg>
            <span class="like__text">Нравится </span>
            <span class="like__count">
				<?php 
					$likes = get_post_meta($id,'si-like',true); // true чтобы не возвращался массив, а конкретное значение лайков
					echo $likes ? $likes : 0;
				?>
			</span>
          </button>
            <script>
                window.addEventListener('load', function (){
                    const $likeBtn = document.querySelector('.like'); // кнопка
                    const postId = $likeBtn.dataset.id;
                    // есть ли в localstorage информация про эту страницу? Ведь нам нужно знать - лайкнул ли пользов. на этой странице? Информацию о лайках - мы будем хранить в localstorage
                    // если инфы нет - то лучше добавить пустую строку
                    try{
                        if(!localStorage.getItem('liked')){ // если в localStorage нет liked
                            localStorage.setItem('liked','')
                        }
                    }catch (e){
                        console.log(e)
                    }

                    function getAboutLike(id){ // получение инфы про лайк
                        let hasLike = false; // когда человек перв. раз зах. на стр. - его лайка там нет
                        // попытаемся прочитать инфу с localStorage
                        // но он может быть отсутствующим
                        try{
                            hasLike = localStorage.getItem('liked').split(',').includes(id) // разобьем это все на массив
                            // includes возвращает булевый тип данных - т.е. мы проверим - находится ли в масиве такой элемент
                        }catch (e){
                            console.log(e)
                        }
                        return hasLike
                    }

                    // есть лайк на этой странице - или нет?
                    let hasLike = getAboutLike(postId)
                    if(hasLike){ // если лайки на этой странице есть
                        $likeBtn.classList.add('like_liked'); // отмечаем данный лайк
                    }

                    $likeBtn.addEventListener('click',async function (e){
                        e.preventDefault() // для перестраховки, хотя это кнопка
                        // есть лайк или нет
                        let hasLike = getAboutLike(postId) // postId доступен по замыканию

                        // формируем данные для отправки на сервер
                        const data = new FormData() // удобный API, который при отправке будет автоматически преобразован в такой вид, который необходим для отправки по http
                        data.append('action','post-likes') // добавляем необх. инф. для отправки
                        let todo = hasLike ? 'minus' : 'plus'
                        data.append('todo', todo) // в data отправим ключ todo со значением переменной todo
                        // передадим id страницы, с которой был добавлен лайк
                        data.append('id', postId)

                        $likeBtn.disabled=true
                        let response = await fetch($likeBtn.dataset.href,{
                            method: 'POST',
                            body: data
                        })
                        $likeBtn.disabled=false


                        if(response.status === 200 ){
                            let result = await response.text()

                            $likeBtn.querySelector('.like__count').textContent = result
                            let localdata = localStorage.getItem('liked')
                            // console.log(localdata) //166
                            let newData = ''
                                if(hasLike){ // если лайк был добавлен, то нужно удалить из localstorage
                                    // после фильтрации id текущей записи не будет присутствовать в массиве
                                    newData = localdata.split(',').filter(function (id){
                                        return id !== postId
                                    }).join(',')
                                }else{
                                    // отфильтруем пустые строки
                                    newData = localdata.split(',').filter(function (item){
                                        return item !== ''
                                    }).concat(postId).join(',')
                                }
                                localStorage.setItem('liked', newData)
                                $likeBtn.classList.toggle('like_liked');
                        }else{
                           // console.log(response.statusText)
                        }

                    })
                })
            </script>
        </footer>
      </article>
        <?php endwhile;?>
        <?php endif;?>
    </main>

<?php get_footer()?>