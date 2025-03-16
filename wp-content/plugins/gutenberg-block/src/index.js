import { registerBlockType } from '@wordpress/blocks';
import Edit from './edit';
import Save from './save';
import './style.scss'; // импорт стилей для фронтенда и редактора

// var registerBlockType = wp.blocks.registerBlockType; //  это метод API Gutenberg, который используется для регистрации нового блока.

/*
    Gutenberg построен на React, но в WordPress он используется через wp.element, который оборачивает React.
    Функция createElement используется для создания элементов React вручную, без JSX.
*/

// var createElement = wp.element.createElement;

registerBlockType( 'vitos/myblock', {
	edit: Edit,
	save: Save,
} );

/*
    name – уникальный идентификатор блока (должен содержать префикс, например, vitos/myblock)
    settings – объект с настройками блока, включая его поведение в редакторе и сохранённый HTML-код
*/

/*
    edit() – что видит пользователь в редакторе
    save() – что сохраняется в базе данных
*/
