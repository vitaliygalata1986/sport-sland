<?php
/**
 * Plugin Name: My Block for Gutenberg
 * Description: Gutenberg Block
 * Author: Vitaliy Galata
 */

// Эта функция выполняет регистрацию нового Gutenberg-блока
// Эта функция регистрирует блок на основе метаданных из block.json, который должен находиться в папке плагина
// (указан __DIR__, то есть текущая директория плагина)
// block.json содержит ключевые параметры блока, такие как название, стили, скрипты и настройки.
 function vitos_gutenberg_block_init(){
    // register_block_type_from_metadata( __DIR__ );
    register_block_type_from_metadata( __DIR__ );
 }

 // Этот код добавляет функцию vitos_gutenberg_block_init в хук init,
 // чтобы блок был зарегистрирован при инициализации WordPress.
 add_action('init','vitos_gutenberg_block_init');

 // https://developer.wordpress.org/block-editor/reference-guides/packages/packages-scripts/
 // npm install @wordpress/scripts --save-dev
 // npm i @wordpress/blocks
 // npx wp-scripts build
 // npx wp-scripts format - для форматирования кода
 // npm i @wordpress/block-editor
 // npm i format - для форматирования кода
 // npm run lint:js - проверка кода на соответствия правилам

/*
    ESLint — это инструмент для автоматической проверки кода JavaScript на ошибки и несоответствия стилю кодирования.
    В твоем случае ты используешь @wordpress/eslint-plugin, который помогает писать код в соответствии со стандартами WordPress.
    Зачем он нужен?
        - Находит ошибки в коде еще до его выполнения.
        - Обеспечивает единый стиль кода в проекте.
        - Автоматически исправляет мелкие ошибки (если включен --fix).
        - Облегчает работу с WordPress, применяя рекомендованные правила.
*/