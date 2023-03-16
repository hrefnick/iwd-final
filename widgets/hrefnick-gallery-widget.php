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