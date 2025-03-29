<?php
/**
 * Plugin Name: Gutenberg Inner Block
 * Description: Gutenberg Inner Block
 * Author: Vitaliy Galata
 */

 function vitos_gutenberg_block_inner(){
    register_block_type_from_metadata( __DIR__ );
 }

 add_action('init','vitos_gutenberg_block_inner');