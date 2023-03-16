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
class Elementor_Hrefnick_Gallery_Widget extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'custom-gallery-widget';
    }

    public function get_title()
    {
        return __('Custom Gallery Widget', 'text-domain');
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

}