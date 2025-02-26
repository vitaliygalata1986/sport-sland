import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps } from '@wordpress/block-editor'; // react hook в котором хранятся свойства блока (классы, id, data-атрибуты и т.д.)
import './style.scss'; // импорт стилей для фронтенда и редактора
import './editor.scss'; // импорт стилей для редактора
// var registerBlockType = wp.blocks.registerBlockType; //  это метод API Gutenberg, который используется для регистрации нового блока.

/*
    Gutenberg построен на React, но в WordPress он используется через wp.element, который оборачивает React.
    Функция createElement используется для создания элементов React вручную, без JSX.
*/

// var createElement = wp.element.createElement;

registerBlockType('vitos/myblock', {
  edit: function () {
    const blockProps = useBlockProps();
    // console.log(blockProps); // {id: 'block-6fdc1f4e-8c6e-4241-bf0b-36624c3a399e', tabIndex: 0, role: 'document', aria-label: 'Блок: My Block', ref: ƒ, …}
    return <h1 {...blockProps}>Edit 2</h1>;
  },
  save: function () {
    const blockProps = useBlockProps.save(); // на фронте дефолтных свойств не будет
    return <h1 {...blockProps}>Save 2</h1>;
  },
});

/*
    name – уникальный идентификатор блока (должен содержать префикс, например, vitos/myblock)
    settings – объект с настройками блока, включая его поведение в редакторе и сохранённый HTML-код
*/

/*
    edit() – что видит пользователь в редакторе
    save() – что сохраняется в базе данных
*/
