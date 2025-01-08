<?php
/**
 * Template for rendering categories widget.
 *
 * @var string $categories HTML списка категорий.
 */
?>

<?php
/*

'/**...*' Открытие и закрытие многострочного комментария. Символы /** указывают, что это докблок.
Template for rendering categories widget.: Описание файла или функции. Указывает, что этот шаблон используется для рендера списка категорий.
@var string $categories:
 - @var: Специальная аннотация, указывающая на тип данных переменной.
 - string: Тип данных переменной $categories. Здесь это строка.
 - $categories: Имя переменной, которая используется в данном файле.
 - HTML списка категорий: Дополнительное описание переменной.
*/
?>

<ul class="vitoscats-categories">
    <?php echo $categories; ?>
</ul>