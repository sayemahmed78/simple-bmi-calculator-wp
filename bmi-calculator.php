<?php
/**
 * Plugin Name:       Simple BMI Calculator WP
 * Plugin URI:        https://wordpress.org/plugins/simple-bmi-calculator-wp
 * Description:       A simple BMI calculator plugin for WordPress with customizable button color and border radius.
 * Version:           1.0.0
 * Requires at least: 5.8
 * Requires PHP:      7.2
 * Author:            Sayem Ahmed
 * Author URI:        https://mdsayemahmed.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       simple-bmi-calculator-wp
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

// Admin menu setup
function sbmi_add_theme_page(){
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

// Register settings for the plugin
function sbmi_register_settings() {
    register_setting('sbmi-settings-group', 'sbmi_button_color');
    register_setting('sbmi-settings-group', 'sbmi_button_corner');
}
add_action('admin_init', 'sbmi_register_settings');

// Enqueue styles for the front-end
function bmi_calculator_styles() {
    wp_enqueue_style('bmi-calculator-style', plugins_url('css/style.css', __FILE__), array(), '1.0.0');
}
add_action('wp_enqueue_scripts', 'bmi_calculator_styles');


// Enqueue styles for the admin
add_action('admin_enqueue_scripts', 'bmi_calculator_styles_admin');
function bmi_calculator_styles_admin() {
    wp_enqueue_style('bmi-calculator-style', plugins_url('css/style.css', __FILE__), array(), '1.0.0');
}

 

// Create the content for the admin page
function sbmi_create_page(){
    ?>
    <!-- Success Message Section -->
    <?php if (isset($_GET['settings-updated']) && $_GET['settings-updated'] == true) : ?>
            <div id="setting-error-settings_updated" class="updated notice is-dismissible">
                <p><strong>Your settings have been saved.</strong></p>
            </div>
        <?php endif; ?>
    <div class="sbmi-admin-container">

        <div class="sbmi-setting-part">
        <h3>Simple BMI Calculator Settings</h3>
        <form method="post" action="options.php">
            <?php settings_fields('sbmi-settings-group'); ?>
            <?php do_settings_sections('sbmi-settings-group'); ?>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">Button Color</th>
                    <td>
                        <input type="color" name="sbmi_button_color" value="<?php echo esc_attr(get_option('sbmi_button_color')); ?>" />
                        <p class="description">Change your button color.</p>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">Button Border Radius Style</th>
                    <td>
                        <input type="number" id="button-corner" name="sbmi_button_corner" value="<?php echo esc_attr(get_option('sbmi_button_corner', '20'));?>">
                        <p class="description">Input the button radius style.</p>
                    </td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>

        <div class="shortcode-display">
                <p>Use the shortcode below to display the BMI calculator on your site:</p>
                <code>[bmi_calculator_wp]</code>
            </div>

        </div>
   

    <!-- About Author Section -->
        <div class="sbmi-author-info">
            <h3 id="title"><?php echo esc_html('👩‍💻 About Author'); ?></h3>
            <p><img class="author-img" style="backgound-color: red !important" src="<?php echo esc_url(plugin_dir_url(__FILE__) . 'img/author.png'); ?>" alt="Author Image"></p>
            <p>I'm <strong><a href="https://mdsayemahmed.com/" target="_blank" rel="noopener noreferrer">Sayem Ahmed</a></strong>, a dedicated Full-stack Web Developer, thriving on crafting error-free websites with a focus on delivering 100% client satisfaction. Passionate about continuous learning, I actively share my knowledge with others, embracing every opportunity to contribute. Solving real-world problems is not just my job, it's what I love to do.</p>
        </div>
    </div>
    

    <?php
}



// Shortcode for displaying the BMI calculator
function bmi_calculator_shortcode() {
    ob_start(); ?>
    <div class="bmi-calculator-container">
        <form id="bmi-calculator-form">
            <label for="height">Height (cm):</label>
            <input type="number" id="height" required><br><br>
            <label for="weight">Weight (kg):</label>
            <input type="number" id="weight" required><br><br>
            <button type="button" onclick="calculateBMI()" id="bmi-calculate-button">Calculate</button>
        </form>
        <div id="bmi-result"></div>
        <div id="bmi-range">Normal BMI Range is 18.5 - 24.9</div>
    </div>
    <script>
    function calculateBMI() {
        var height = parseFloat(document.getElementById("height").value) / 100;
        var weight = parseFloat(document.getElementById("weight").value);
        var bmi = weight / (height * height);
        var category = "";

        if (bmi < 18.5) category = "Underweight";
        else if (bmi < 24.9) category = "Normal weight";
        else if (bmi < 29.9) category = "Overweight";
        else category = "Obesity";

        document.getElementById("bmi-result").innerText = "Your BMI: " + bmi.toFixed(2) + " (" + category + ")";
        document.getElementById("bmi-result").style.display = "block"
        var ContentRange = document.getElementById("bmi-range");
        ContentRange.style.display = "block";
    }


    document.getElementById('button-corner').addEventListener('input', function() {
    var borderRadius = this.value + 'px';
    document.getElementById('bmi-calculate-button').style.borderRadius = borderRadius;
});
    </script>
    <?php
    return ob_get_clean();
}
add_shortcode('bmi_calculator_wp', 'bmi_calculator_shortcode');

// Add custom CSS for button styling
function bmi_calculator_customizer_css() {
    ?>
    <style type="text/css">
        #bmi-calculate-button {
            background-color: <?php echo esc_attr(get_option('sbmi_button_color')); ?>;
           
            <?php if (get_option('sbmi_button_corner', '20')) : ?>
                border-radius: <?php echo esc_attr(get_option('sbmi_button_corner')) ?>px;
            <?php else : ?>
                border-radius: 0;
            <?php endif; ?>
        }
    </style>
    <?php
}
add_action('wp_head', 'bmi_calculator_customizer_css');
