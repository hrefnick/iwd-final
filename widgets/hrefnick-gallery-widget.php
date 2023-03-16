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
        return esc_html__('Custom Post-Type Gallery', 'hrefnick-widget');
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

        $this->add_control(
            'button_text',
            [
                'label' => esc_html__( 'Button Text', 'hrefnick-widget' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Read More', 'hrefnick-widget' ),
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_layout',
            [
                'label' => esc_html__( 'Layout', 'hrefnick-widget' ),
            ]
        );

        $this->add_control(
            'posts_per_row',
            [
                'label' => esc_html__( 'Posts per row', 'hrefnick-widget' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 4,
                'min' => 1,
                'max' => 6,
                'step' => 1,
                'selectors' => [
                    '{{WRAPPER}} .custom-gallery' => 'grid-template-columns: repeat({{VALUE}},1fr);',
            ]
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

        $this->add_control(
            'card_border_radius',
            [
                'label' => esc_html__( 'Card Border Radius', 'hrefnick-widget' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .card' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'title_style_section',
            [
                'label' => esc_html__( 'Title Style', 'hrefnick-widget' ),
                'tab' => Controls_Manager::TAB_STYLE,
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

        $this->add_control(
            'title_alignment',
            [
                'label' => esc_html__( 'Title Alignment', 'hrefnick-widget' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__( 'Left', 'your-plugin' ),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'your-plugin' ),
                        'icon' => 'eicon-h-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'your-plugin' ),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'default' => 'center',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .card-title' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'button_style_section',
            [
                'label' => esc_html__( 'Button Style', 'hrefnick-widget' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'card_button_typography',
                'label' => esc_html__( 'Button Typography', 'hrefnick-widget' ),
                'selector' => '{{WRAPPER}} .custom-button',
            ]
        );

        $this->add_control(
            'button_background_color',
            [
                'label' => esc_html__( 'Button Background Color', 'hrefnick-widget' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .custom-button' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'hover_button_background_color',
            [
                'label' => esc_html__( 'Hover Background Color', 'hrefnick-widget' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .custom-button:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_text_color',
            [
                'label' => esc_html__( 'Button Text Color', 'hrefnick-widget' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .custom-button' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'hover_button_text_color',
            [
                'label' => esc_html__( 'Hover Text Color', 'hrefnick-widget' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .custom-button:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_padding',
            [
                'label' => esc_html__( 'Button Padding', 'hrefnick-widget' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .custom-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'button_margin',
            [
                'label' => esc_html__( 'Button Margin', 'hrefnick-widget' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .custom-button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'button_alignment',
            [
                'label' => esc_html__( 'Button Alignment', 'hrefnick-widget' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__( 'Left', 'hrefnick-widget' ),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'hrefnick-widget' ),
                        'icon' => 'eicon-h-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'hrefnick-widget' ),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'default' => 'center',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .my-card-button' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'button_border',
                'label' => esc_html__( 'Button Border', 'hrefnick-widget' ),
                'selector' => '{{WRAPPER}} .custom-button',
            ]
        );

        $this->add_control(
            'button_border_radius',
            [
                'label' => esc_html__( 'Button Border Radius', 'hrefnick-widget' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .custom-button' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );


        $this->end_controls_section();
    }

    // begin render, this is what the user will see

    protected function render() {
        $settings = $this->get_settings_for_display();

        $post_type = $settings['post_type'];
        $posts_per_row = $settings['posts_per_row'];
        $args = array(
            'post_type' => $post_type,
            'posts_per_page' => -1,
        );

        $query = new WP_Query( $args );

        if ( $query->have_posts() ) :
            $output =  '<div class="custom-gallery">';

           // $output .= '<div class="my-custom-gallery-widget">';
            //$output .= '<div class="row">';

            $post_count = 0;

            while ( $query->have_posts() ) : $query->the_post();

                if ( has_post_thumbnail() ) :
                    $post_link = get_permalink();
                    $alignment_class = 'text-' . $settings['button_alignment'];
                    $output .= '<div class="custom-gallery-item">';
                    $output .= '<a href="' . $post_link . '">';
                    $output .= '<div class="card">';
                    $output .= '<div class="card-image"><a href="' . $post_link . '">' . get_the_post_thumbnail() . '</a></div>';
                    $output .= '<div class="card-content">';
                    $output .= '<h3 class="card-title">' . get_the_title() . '</h3>';
                    $output .=  $settings['button_text'] ?
                            '<div class="my-card-button ' . esc_attr( $alignment_class ) . '">
                            <a href="' . esc_url( get_permalink() ) . '" class="custom-button elementor-button-link elementor-button elementor-size-md" 
                            style="background-color:' . esc_attr( $settings['button_color'] ) . '">'
                            . esc_html( $settings['button_text'] ) . '</a>
                            </div>'
                        : '';

                    $output .= '</div>'; // .card-content
                    $output .= '</div>'; // .card
                    $output .= '</a>';
                    $output .= '</div>'; // .custom-gallery-item
                endif;
                $post_count++;
                //if ( $post_count % $posts_per_row === 0 ) {
                 //   $output .= '</div><div class="row">';
              //  }
            endwhile;


           // $output .= '</div>'; // .row
           // $output .= '</div>';
            $output .= '</div>'; // .custom-gallery

            wp_reset_postdata();

            echo $output;
        endif;
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