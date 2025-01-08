( function ( blocks, element, serverSideRender, blockEditor ) {
    var el = element.createElement,
        registerBlockType = blocks.registerBlockType,
        ServerSideRender = serverSideRender,
        useBlockProps = blockEditor.useBlockProps;

    registerBlockType( 'vitoswidget-block/block', {
        apiVersion: 1,
        title: 'Widget Categories',
        icon: 'list-view',
        category: 'widgets',

        edit: function ( props ) { // метод для бек-енда
            const blockProps = useBlockProps();
            return el(
                'div',
                blockProps,
                el( ServerSideRender, {
                    block: 'vitoswidget-block/block',
                    attributes: props.attributes,
                } )
            );
        },
    } );
} )(
    window.wp.blocks,
    window.wp.element,
    window.wp.serverSideRender,
    window.wp.blockEditor
);

/*
Регистрация блока: Код регистрирует новый блок с помощью registerBlockType. Он называет блок 'vitoswidget-block/block' и задаёт основные параметры:

title: Имя блока (отображается в редакторе).
icon: Иконка для блока.
category: Категория, в которой блок будет отображаться (в данном случае widgets).
Использование серверного рендеринга: В edit используется компонент ServerSideRender для отображения блока. Это позволяет блокам рендериться на сервере (PHP) с учётом их атрибутов.

Компонент useBlockProps: Этот хук используется для добавления атрибутов к обёрточному элементу блока (например, классы CSS).
* */

/*
Почему используется ServerSideRender?
Этот подход удобен, когда содержимое блока зависит от данных на сервере (например, категорий, записей, или пользовательских данных),
а не фиксированных значений, введённых пользователем в редакторе.
*/