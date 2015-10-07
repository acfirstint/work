<div class="wrap">

    <h1>Options page here</h1>
    <div>
        <form action="options.php" method="post">
            <?php settings_fields('theme_options'); ?>
            <?php do_settings_sections('plugin'); ?>

            <input name="Submit" type="submit" value="<?php esc_attr_e('Save Changes'); ?>" />
        </form>
    </div>

</div>