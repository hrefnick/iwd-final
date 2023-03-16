<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Elementor hrefnick Gallery Widget.
 *
 * Elementor widget that displays custom post types in a gallery.
 *
 * @since 1.0.0
 */
class Elementor_Hrefnick_Widget extends \Elementor\Widget_Base
{
    // widget registration
    public function get_name()
    {
        return 'custom-gallery-widget';
    }

    public function get_title()
    {
        return esc_html__('Custom Post Type Gallery Widget', 'hrefnick-widget');
    }

    public function get_icon()
    {
        return 'fa fa-image';
    }

    public function get_categories()
    {
        return ['general'];
    }

    public function get_keywords() {
        return [ 'hrefnick', 'gallery', 'custom post type' ];
    }

    // begin controls section
    protected function _register_controls() {
        $this->start_controls_section(
            'section_content',
            [
                'label' => esc_html__( 'Content', 'text-domain' ),
            ]
        );

        $this->add_control(
            'post_type',
            [
                'label' => esc_html__( 'Post Type', 'text-domain' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => $this->get_post_types(),
                'default' => 'post',
            ]
        );

        $this->end_controls_section();
    }

}