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
            $todayColor = esc_attr($instance['todayColor']);
            $timeColor = esc_attr($instance['timeColor']);
            $dateColor = esc_attr($instance['dateColor']);
            $display = esc_attr($instance['display']);
        } else {
            $title = '';
            $todayColor = '';
            $timeColor = '';
            $dateColor = '';
            $display = '';
        }
    ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Widget Title', 'wp_widget_plugin'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" placeholder="Title Optional" value="<?php echo $title; ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('todayColor'); ?>"><?php _e('Today Font Color', 'wp_widget_plugin'); ?></label><br>
            <input id="<?php echo $this->get_field_id('todayColor'); ?>" name="<?php echo $this->get_field_name('todayColor'); ?>" type="color" value="<?php echo $todayColor; ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('timeColor'); ?>"><?php _e('Time Font Color', 'wp_widget_plugin'); ?></label><br>
            <input id="<?php echo $this->get_field_id('timeColor'); ?>" name="<?php echo $this->get_field_name('timeColor'); ?>" type="color" value="<?php echo $color; ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('dateColor'); ?>"><?php _e('Date Font Color', 'wp_widget_plugin'); ?></label><br>
            <input id="<?php echo $this->get_field_id('dateColor'); ?>" name="<?php echo $this->get_field_name('dateColor'); ?>" type="color" value="<?php echo $dateColor; ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('display'); ?>"><?php _e('Display Today', 'wp_widget_plugin'); ?></label><br>
                <select id="<?php echo $this->get_field_id('display'); ?>" name="<?php echo $this->get_field_name('display'); ?>">
                    <option value="block">True</option>
                    <option value="none">False</option>
                </select>
        </p>
    <?php
    }

    // Widget Update
    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        //Fields
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['todayColor'] = strip_tags($new_instance['todayColor']);
        $instance['timeColor'] = strip_tags($new_instance['timeColor']);
        $instance['dateColor'] = strip_tags($new_instance['dateColor']);
        $instance['display'] = strip_tags($new_instance['display']);
        return $instance;
    }

    // Widget Display
    function widget($args, $instance) {
        wp_enqueue_style( 'ghost-style', plugins_url('ghost-date-time-wp-widget/ghost-date-time-wp-widget.min.css') );
        wp_enqueue_script( 'ghost-script', plugins_url('ghost-date-time-wp-widget/ghost-date-time-wp-widget.min.js') );

        extract( $args );
        //Widget Option
        $title = apply_filters('widget_title', $instance['title']);
        $todayColor = $instance['todayColor'];
        $timeColor = $instance['timeColor'];
        $dateColor = $instance['dateColor'];
        $display = $instance['display'];
        echo $before_widget;
        // Display Widget
        echo '<div class="widget-text wp_widget_plugin_box">';

        // Check if title is set
        if ( $title ) {
            echo $before_title . $title . $after_title;
        }

        echo '
            <h2 style="display:'.$display.'; color:'.$todayColor.'">Today</h2>
            <p id="time" style="color:'.$timeColor.'"></p>
            <p id="date" style="color:'.$dateColor.'"></p>';

        echo '</div>';
        echo $after_widget;
    }
}

// register widget
add_action('widgets_init', create_function('', 'return register_widget("ghost_clock");'));
?>
