( function ( blocks, element ) {
    var el = element.createElement;

    blocks.registerBlockType( 'gutenberg-examples/example-01-basic', { // регестрируем новый блок и указываем его название
        edit: function () { // увидим в редакторе
            return el( 'p', { // название тега, в котором будет выводиться нижняя строка
                className: 'block-editor-rich-text__editable block-editor-block-list__block wp-block is-selected wp-block-paragraph rich-text'
            }, 'Hello World (from the editor).' );
        },
        save: function () { // увидим на фронт части
            return el( 'h3', {
                className: 'block-test-class'
            }, 'Hola mundo (from the frontend).' );
        },
    } );
} )( window.wp.blocks, window.wp.element ); // эти два параметра передаются в функцию function ( blocks, element )

