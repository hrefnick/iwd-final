<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;

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
        return 'eicon-gallery-grid';
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
                'label' => esc_html__( 'Content', 'hrefnick-widget' ),
            ]
        );

        $this->add_control(
            'post_type',
            [
                'label' => esc_html__( 'Post Type', 'hrefnick-widget' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => $this->get_post_types(),
                'default' => 'post',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'card_style_section',
            [
                'label' => esc_html__( 'Card Style', 'hrefnick-widget' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'card_background_color',
            [
                'label' => esc_html__( 'Background Color', 'hrefnick-widget' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .custom-gallery .card' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'card_title_color',
            [
                'label' => esc_html__( 'Title Color', 'hrefnick-widget' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .custom-gallery .card .card-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'card_title_typography',
                'label' => esc_html__( 'Title Typography', 'hrefnick-widget' ),
                'selector' => '{{WRAPPER}} .custom-gallery .card .card-title',
            ]
        );

        $this->add_responsive_control(
            'card_padding',
            [
                'label' => esc_html__( 'Card Padding', 'hrefnick-widget' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .custom-gallery .card' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'card_margin',
            [
                'label' => esc_html__( 'Card Margin', 'hrefnick-widget' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .custom-gallery .card' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'card_border',
                'label' => esc_html__( 'Card Border', 'hrefnick-widget' ),
                'selector' => '{{WRAPPER}} .custom-gallery .card',
            ]
        );


        $this->end_controls_section();
    }

    // begin render, this is what the user will see

    protected function render() {
        $settings = $this->get_settings_for_display();

        $post_type = $settings['post_type'];

        $args = array(
            'post_type' => $post_type,
            'posts_per_page' => -1,
        );

        $query = new WP_Query( $args );

        if ( $query->have_posts() ) :
            echo '<div class="custom-gallery">';

            while ( $query->have_posts() ) : $query->the_post();

                if ( has_post_thumbnail() ) :
                    $post_link = get_permalink();
                    echo '<div class="custom-gallery-item">';
                    echo '<a href="' . $post_link . '">';
                    echo '<div class="card">';
                    echo '<div class="card-image"><a href="' . $post_link . '">' . get_the_post_thumbnail() . '</a></div>';
                    echo '<div class="card-content">';
                    echo '<h3 class="card-title"><a href="' . $post_link . '">' . get_the_title() . '</a></h3>';
                    echo '</div>'; // .card-content
                    echo '</div>'; // .card
                    echo '</a>';
                    echo '</div>'; // .custom-gallery-item
                endif;

            endwhile;

            echo '</div>'; // .custom-gallery
        endif;

        wp_reset_postdata();
    }

    // get post types for gallery
    private function get_post_types() {
        $post_types = get_post_types(
            array(
                'public' => true,
                '_builtin' => false
            ),
            'objects'
        );

        $options = array();

        foreach ( $post_types as $post_type ) {
            $options[ $post_type->name ] = $post_type->label;
        }
        return $options;
    }

}