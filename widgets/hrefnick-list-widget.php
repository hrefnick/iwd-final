<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Css_Filter;
use Elementor\Repeater;


/**
 * Elementor hrefnick Gallery Widget.
 *
 * Elementor widget that displays custom post types in a gallery.
 *
 * @since 1.0.0
 */
class Elementor_Hrefnick_Widget2 extends \Elementor\Widget_Base
{
    // widget registration
    public function get_name()
    {
        return 'custom-list-widget';
    }

    public function get_title()
    {
        return esc_html__('Custom List', 'hrefnick-widget');
    }

    public function get_icon()
    {
        return 'eicon-editor-list-ul';
    }

    public function get_categories()
    {
        return ['general'];
    }

    public function get_keywords()
    {
        return ['hrefnick', 'list', 'custom list'];
    }

    // begin controls section
    protected function _register_controls()
    {
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Content', 'hrefnick-widget' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'list_title',
            [
                'label' => esc_html__( 'List Title', 'hrefnick-widget' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'List Title', 'hrefnick-widget' ),
                'placeholder' => esc_html__( 'List Title', 'hrefnick-widget' ),
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'list_item',
            [
                'label' => esc_html__( 'List Item', 'hrefnick-widget' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'List Item', 'hrefnick-widget' ),
                'placeholder' => esc_html__( 'List Item', 'hrefnick-widget' ),
            ]
        );

        $this->add_control(
            'list_items',
            [
                'label' => esc_html__( 'List Items', 'hrefnick-widget' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'list_item' => esc_html__( 'List Item 1', 'hrefnick-widget' ),
                    ],
                    [
                        'list_item' => esc_html__( 'List Item 2', 'hrefnick-widget' ),
                    ],
                    [
                        'list_item' => esc_html__( 'List Item 3', 'hrefnick-widget' ),
                    ],
                ],
                'title_field' => '{{{ list_item }}}',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'list_settings',
            [
                'label' => esc_html__( 'List Settings', 'hrefnick-widget' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );


        $this->add_control(
            'bullet_icon',
            [
                'label' => esc_html__( 'Bullet Icon', 'hrefnick-widget' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'description' => esc_html__( 'Upload a custom bullet icon, for best results use 10px by 10px.', 'hrefnick-widget' ),
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'list_style_section',
            [
                'label' => esc_html__( 'List Style', 'hrefnick-widget' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'list_item_typography',
                'label' => esc_html__( 'Typography', 'hrefnick-widget' ),
                'selector' => '{{WRAPPER}} .custom-list li',
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            'list_style_section',
            [
                'label' => esc_html__( 'List Style', 'hrefnick-widget' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'list_background_color',
            [
                'label' => esc_html__( 'List Background Color', 'hrefnick-widget' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .custom-list' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'list_text_color',
            [
                'label' => esc_html__( 'List Text Color', 'hrefnick-widget' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .custom-list li' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'list_padding',
            [
                'label' => esc_html__( 'List Padding', 'hrefnick-widget' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .custom-list' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'list_margin',
            [
                'label' => esc_html__( 'List Margin', 'hrefnick-widget' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .custom-list' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'list_border',
                'label' => esc_html__( 'List Border', 'hrefnick-widget' ),
                'selector' => '{{WRAPPER}} .custom-list',
            ]
        );

        $this->add_control(
            'list_border_radius',
            [
                'label' => esc_html__( 'List Border Radius', 'hrefnick-widget' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .custom-list' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'list_item_style_section',
            [
                'label' => esc_html__( 'List Item Style', 'hrefnick-widget' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'list_item_background_color',
            [
                'label' => esc_html__( 'List Item Color', 'hrefnick-widget' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .custom-list li' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'bullet_padding',
            [
                'label' => esc_html__( 'Bullet Padding', 'hrefnick-widget' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .spacing' => 'padding-left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'list_item_padding',
            [
                'label' => esc_html__( 'List Item Padding', 'hrefnick-widget' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .custom-list li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'list_item_margin',
            [
                'label' => esc_html__( 'List Item Margin', 'hrefnick-widget' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .custom-list li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'list_item_border',
                'label' => esc_html__( 'List Item Border', 'hrefnick-widget' ),
                'selector' => '{{WRAPPER}} .custom-list li',
            ]
        );

        $this->add_control(
            'list_item_border_radius',
            [
                'label' => esc_html__( 'List Item Border Radius', 'hrefnick-widget' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .custom-list li' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    // begin render, this is what the user will see

    protected function render() {
        $settings = $this->get_settings_for_display();
        $list_items = $settings['list_items'];
        $bullet_icon = $settings['bullet_icon'];

        echo '<ul class="custom-list" style="list-style: none;">';
        foreach ( $list_items as $list_item ) {
            echo '<li class="custom-list-item">';
            if ( ! empty( $bullet_icon['url'] ) ) {
                echo '<img src="' . $bullet_icon['url'] . '" class="custom-list-icon" alt="" />';
            }
            echo '<span class="spacing"></span>';
            echo $list_item['list_item'];
            echo '</li>';
        }
        echo '</ul>';
    }

}
