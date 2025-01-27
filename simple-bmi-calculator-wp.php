<?php
/**
 * Plugin Name:       Simple BMI Calculator WP
 * Plugin URI:        https://wordpress.org/plugins/simple-bmi-calculator-wp
 * Description:       A simple BMI calculator plugin for WordPress with customizable button color and border radius. The plugin also support as a elementor addons.
 * Version:           1.0.0
 * Requires at least: 5.8
 * Requires PHP:      7.2
 * Author:            Sayem Ahmed
 * Author URI:        https://mdsayemahmed.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       simple-bmi-calculator-wp
 */

 if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

// Includes
//require_once plugin_dir_path(__FILE__) . 'includes/class-elementor-widget.php';
require_once plugin_dir_path(__FILE__) . 'includes/admin-page.php';
require_once plugin_dir_path(__FILE__) . 'includes/shortcode.php';

// Enqueue Styles and Scripts
function sbmi_enqueue_scripts() {
    wp_enqueue_style('sbmi-style', plugins_url('css/style.css', __FILE__), [], '1.0.0');
    wp_enqueue_script('sbmi-script', plugins_url('js/bmi-calculator.js', __FILE__), [], '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'sbmi_enqueue_scripts');

  // Plugin Option Admin Page Style
  function sbmi_add_theme_css(){
    wp_enqueue_style( 'sbmi-admin-style', plugins_url( 'css/style.css', __FILE__ ), false, "1.0.0");
  
  }
  add_action('admin_enqueue_scripts', 'sbmi_add_theme_css');

//Elementor Widget Registration
add_action( 'elementor/widgets/register', function( $widgets_manager ) {
    require_once plugin_dir_path( __FILE__ ) . 'includes/class-elementor-widget.php';
    $widgets_manager->register( new \Elementor_BMI_Calculator_Widget());
} );



