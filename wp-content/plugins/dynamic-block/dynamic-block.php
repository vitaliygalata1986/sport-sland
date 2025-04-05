<?php
/**
 * Plugin Name: Dynamic Posts
 * Description: Gutenberg Dynamic Block
 * Author: Vitaliy Galata
 */

 function vitos_dynamic_block_init(){
    register_block_type_from_metadata( __DIR__ );
 }

 add_action('init','vitos_dynamic_block_init');