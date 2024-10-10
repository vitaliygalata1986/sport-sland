<?php
add_action('wp_head', 'sportisland_test_head');

function sportisland_test_head(){
    // echo "<h1>Hello form tag</h1>";
   // echo "<style>body {background-color:#121314; }</style>";
}

/*
add_action('wp_body_open', function (){
    echo '<h2>Body Hello</h2>';
});
*/

add_filter('wp_body_open', function (){
  //  echo '<h2>Body Hello</h2>';
});

add_action('wp_footer', function (){
  //  echo '<h2>Hello form footer</h2>';
},20);

// add_filter('the_title', 'sportisland_change_title',10,2); // 2 - кол. аргументов, которые передаем в фильтр - это $title,$post_id

/*
function sportisland_change_title($title,$post_id){
    // echo $title;
   // return '';
   // var_dump($post_id);
    if(!is_singular()){ // если это не отдельный пост
        return $title;
    }
    return mb_convert_case($title, MB_CASE_LOWER); // mb_convert_case - производит смену регистра символов в строке, MB_CASE_LOWER - к нижнему регистру
}
*/