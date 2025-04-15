<?php
/**
 * Plugin Name: Dynamic Posts
 * Description: Gutenberg Dynamic Block
 * Author: Vitaliy Galata
 */

 function vitos_latest_posts_block($attributes){
   
   echo "<pre>";
   print_r($attributes);   
   echo "</pre>";
   
  
  $arg = array(
   'posts_per_page' => $attributes['postsPerPage'],
   'post_status' => 'publish',
   'order' =>  $attributes['order'],
	'orderby' =>  $attributes['orderBy'],
  );

  	if(isset($attributes['category'])){
		$arg['category__in'] = $attributes['category'];
	}
	$latest_posts = get_posts($arg);

  
  $latest_posts = get_posts($arg);

  $html = "<div ". get_block_wrapper_attributes() ." >";

  if(!empty($latest_posts)) {
     foreach($latest_posts as $post){
      setup_postdata($post);
      $html .= "<div>";
      if($attributes['showImage'] && has_post_thumbnail($post->ID)){  // если у поста есть картинка и пользователь хочет ее показать
         $html .= wp_kses_post( get_the_post_thumbnail($post->ID, 'thumbnail'));
      }
         $html .= "<time datetime='" . esc_attr(get_the_date('c', $post)) . "'>" . esc_html(get_the_date('', $post)) . "</time>"; // если в get_the_date('') ничего не передает то используется формат админ панели
         $html .= "<h2><a href='" . esc_url(get_the_permalink($post->ID)) . "'>" . esc_html(get_the_title($post->ID)) . "</a></h2>";
         //$html .= "<p>" . get_the_content($post->ID) . "</p>";
      $html .= "</div>";
  }
}
   $html .='</div>';
   return $html;
 }

 function vitos_dynamic_block_init(){
    register_block_type_from_metadata( __DIR__, array(
      'render_callback' => 'vitos_latest_posts_block', // этот render_callback будет отвечать за фронтенд часть за динамическую часть, которая будет генериться на php
    ) );
 }

 add_action('init','vitos_dynamic_block_init');
 

 // npm i @wordpress/data
 // npm i @wordpress/date
 // npm i @wordpress/components