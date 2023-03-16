<?php
/**
 * Plugin Name: Elementor Custom Widgets
 * Description: Adds additional widgets to Elementor.
 * Plugin URI:  https://elementor.com/
 * Version:     1.0.0
 * Author:      hrefnick
 * Author URI:  https://hrefnick.com/
 * Text Domain: hrefnick-widget
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Register oEmbed Widget.
 *
 * Include widget file and register widget class.
 *
 * @since 1.0.0
 * @param \Elementor\Widgets_Manager $widgets_manager Elementor widgets manager.
 * @return void
 */
function register_hrefnick_widget( $widgets_manager ) {

    require_once( __DIR__ . '/widgets/hrefnick-gallery-widget.php' );

    $widgets_manager->register( new \Elementor_Hrefnick_Widget() );

}
add_action( 'elementor/widgets/register', 'register_hrefnick_widget' );