(function (blocks, element, editor) {
    var el = element.createElement;

    blocks.registerBlockType('sportisland-block/block3', { // регестрируем блок под именем sportisland-block/block3
    // используем настройки, которые использовали в json
        title: 'Sportisland Block 3',
        icon: 'welcome-view-site',
        category: 'text',
        attributes: {
            title: {
                type: 'string', // тип нашего блока - строка
                default: 'Title',
            },
            content: {
                type: 'string',
                default: 'Content...',
            },
        },
        // методы
        edit: function (props) {
            return el(
                'div',
                {className: props.className}, // воспользуемся стандартным класом
                el(
                    editor.RichText,
                    {
                        tagName: 'h3',
                        className: 'sportisland-block-block3-title',
                        value: props.attributes.title,
                        onChange: function (title) { // передаем то, что мы хотим релактировать
                            props.setAttributes({title: title})
                        }
                    }
                ),
                el(
                    editor.RichText,
                    {
                        tagName: 'div',
                        className: 'sportisland-block-block3-content',
                        value: props.attributes.content,
                        onChange: function (content) {
                            props.setAttributes({content: content})
                        }
                    }
                )
            );
        },

        save: function (props) {
            return el(
                'div',
                {className: props.className},
                el(
                    editor.RichText.Content,
                    {
                        tagName: 'h3',
                        className: 'sportisland-block-block3-title',
                        value: props.attributes.title,
                    }
                ),
                el(
                    editor.RichText.Content,
                    {
                        tagName: 'div',
                        className: 'sportisland-block-block3-content',
                        value: props.attributes.content,
                    }
                )
            );
        },
    });
})(window.wp.blocks, window.wp.element, window.wp.blockEditor);
