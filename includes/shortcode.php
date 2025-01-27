<?php
if (!defined('ABSPATH')) {
    exit;
}

function bmi_calculator_shortcode() {
    ob_start();
    ?>
    <div class="bmi-calculator-container">
        <form id="bmi-calculator-form">
            <label for="height">Height (cm):</label>
            <input type="number" id="height" required><br><br>
            <label for="weight">Weight (kg):</label>
            <input type="number" id="weight" required><br><br>
            <button type="button" id="bmi-calculate-button">Calculate</button>
        </form>
        <div id="bmi-result"></div>
        <div id="bmi-range">Normal BMI Range is 18.5 - 24.9</div>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('bmi_calculator_wp', 'bmi_calculator_shortcode');
