<?php
/*
Plugin Name: Ghost Date Time WP Widget
Plugin URI: https://github.com/XachMoreno/ghost-date-time-wp-widget
Description: A simple date & time widget based off of the Ghost dashboard widget.
Version: 1.0
Author: Zach Moreno & Alex Whedbee
Author URI: http://zachariahmoreno.com/
License: MIT.
*/

class ghost_clock extends WP_Widget {

    // Constructor
    function ghost_clock() {
        parent::WP_Widget(false, $name = __('Ghost Clock', 'A simple date & time widget.') );
    }
 
    // Widget Customization
    function form($instance) { 
        //Check Values
        if( $instance) {
            $title = esc_attr($instance['title']);
        } else {
            $title = '';
        }
    ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Widget Title', 'wp_widget_plugin'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" placeholder="Title Optional" value="<?php echo $title; ?>" />
        </p>
    <?php
    }

    // Widget Update
    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        //Fields
        $instance['title'] = strip_tags($new_instance['title']);
        return $instance;
    }

    // Widget Display
    function widget($args, $instance) {
        wp_enqueue_style( 'ghost-style', plugins_url('ghost-clock-widget/ghost.css') );
        wp_enqueue_script( 'ghost-script', plugins_url('ghost-clock-widget/ghost.js') );

        extract( $args );
        //Widget Option
        $title = apply_filters('widget_title', $instance['title']);
        echo $before_widget;
        // Display Widget
        echo '<div class="widget-text wp_widget_plugin_box">';

        // Check if title is set
        if ( $title ) {
            echo $before_title . $title . $after_title;
        }

        echo '
            <h2>Today</h2>
            <p id="time"></p>
            <p id="date"></p>';

        echo '</div>';
        echo $after_widget;
    }
}

// register widget
add_action('widgets_init', create_function('', 'return register_widget("ghost_clock");'));








// class ghost_clock extends WP_Widget {
//     function __construct() {
//         parent::__construct(false, $name = __('Ghost Clock'));
//     }
//     function form() {
        
//     }
//     function update() {

//     }
//     function widget($args, $instance) {

//     }
// }

// add_action('widgets_init', create_function('', 'return register_widget("ghost_clock");')
// );
?>