<?php
if (!defined('ABSPATH')) {
    exit;
}

function sbmi_add_theme_page() {
    add_menu_page(
        'Simple BMI Calculator',
        'BMI Calculator WP',
        'manage_options',
        'sbmi-plugin-option',
        'sbmi_create_page',
        'dashicons-yes-alt',
        101
    );
}

add_action('admin_menu', 'sbmi_add_theme_page');


function sbmi_register_settings() {
    register_setting('sbmi-settings-group', 'sbmi_button_color');
    register_setting('sbmi-settings-group', 'sbmi_button_corner');
}
add_action('admin_init', 'sbmi_register_settings');

function sbmi_create_page() {
    ?>
    <div class="sbmi-admin-container">
        <h3>Simple BMI Calculator Settings</h3>
        <form method="post" action="options.php">
            <?php settings_fields('sbmi-settings-group'); ?>
            <?php do_settings_sections('sbmi-settings-group'); ?>
            <table class="form-table">
                <tr>
                    <th>Button Color</th>
                    <td><input type="color" name="sbmi_button_color" value="<?php echo esc_attr(get_option('sbmi_button_color')); ?>" /></td>
                </tr>
                <tr>
                    <th>Button Border Radius</th>
                    <td><input type="number" name="sbmi_button_corner" value="<?php echo esc_attr(get_option('sbmi_button_corner', '20')); ?>" /></td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}
