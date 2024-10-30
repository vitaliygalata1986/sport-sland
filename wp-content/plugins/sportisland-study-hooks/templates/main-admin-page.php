<div class="wrap">
    <h1><?php _e('General Settings', 'sportisland'); ?></h1>
    <?php settings_errors();?>
    <form action="options.php" method="post">
        <?php settings_fields('sportisland_main_group'); // Выводит скрытые поля формы на странице настроек (option_page, _wpnonce, ...). ?>
        <?php do_settings_sections('sportisland-main-settings'); ?>
        <?php submit_button(); ?>
    </form>
</div>
