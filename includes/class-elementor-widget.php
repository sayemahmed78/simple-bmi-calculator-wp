<?php
if (!defined('ABSPATH')) {
    exit;
}

class Elementor_BMI_Calculator_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'bmi_calculator_widget';
    }

    public function get_title() {
        return __('BMI Calculator', 'simple-bmi-calculator-wp');
    }

    public function get_icon() {
        return 'dashicons-calculator';
    }

    public function get_categories() {
        return ['basic'];
    }

    protected function _register_controls() {
        $this->start_controls_section('content_section', [
            'label' => __('Content', 'simple-bmi-calculator-wp'),
            'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
        ]);

        $this->add_control('button_text', [
            'label' => __('Button Text', 'simple-bmi-calculator-wp'),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => __('Calculate', 'simple-bmi-calculator-wp'),
        ]);

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        <div class="bmi-calculator-container">
            <form id="bmi-calculator-form">
                <label for="height">Height (cm):</label>
                <input type="number" id="height" required><br><br>
                <label for="weight">Weight (kg):</label>
                <input type="number" id="weight" required><br><br>
                <button type="button" id="bmi-calculate-button"><?php echo esc_html($settings['button_text']); ?></button>
            </form>
            <div id="bmi-result"></div>
            <div id="bmi-range">Normal BMI Range is 18.5 - 24.9</div>
        </div>
        <?php
    }
}
