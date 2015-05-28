<?php
/*
Plugin Name: SF Love Quotes Widget
Plugin URI: http://www.seofixing.com/
Description: Adds a Love Quotes widget that display famous Quotes about love and wedding with thumbnails.
Version: 1.0
Author: Bestseogr
Author URI: http://www.seofixing.com/
License: GPL2
*/
	
	
class wp_lovequotes_plugin extends WP_Widget {

	// constructor
    function wp_lovequotes_plugin() {
        parent::WP_Widget(false, $name = __('SF Love Quotes', 'wp_lq_plugin') );
                                  }		   
	// widget form creation
function form($instance) {
    // Check values
if( $instance) {
     
     $title = esc_attr($instance['title']);
	 $text42 = esc_attr($instance['text42']);
	 $checkbox22 = esc_attr($instance['checkbox22']);
	 $checkbox23 = esc_attr($instance['checkbox23']);
	  
} else {
     $title = '';
	 $text42 = '250';
	 $checkbox22 = '1';
	 $checkbox23 = '0';
	
} ?>
<p><img src="<?php echo plugins_url( '/assets/sharethelove.png', __FILE__ ); ?>" align="center" width="100%" /></p>
<p>
<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'wp_lq_plugin'); ?></label>
<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
</p>

<p><b>IMAGE WIDTH:</b></p>
<p><i style="font-size: 10px;">* This is the max image width without .px</i></p>
<p>
<label for="<?php echo $this->get_field_id('text42'); ?>"><?php _e('Width:&nbsp;', 'wp_lq_plugin'); ?></label>
<input class="widefat" style="width:50px;" id="<?php echo $this->get_field_id('text42'); ?>" name="<?php echo $this->get_field_name('text42'); ?>" type="text" value="<?php echo $text42; ?>" />
</p>
<p>
<input id="<?php echo $this->get_field_id('checkbox23'); ?>" name="<?php echo $this->get_field_name('checkbox23'); ?>" type="checkbox" value="1" <?php checked( '1', $checkbox23 ); ?> />
<label for="<?php echo $this->get_field_id('checkbox23'); ?>"><?php _e('Link to Full image?', 'wp_lq_plugin'); ?></label>
<p><i style="font-size: 10px;">* Use this if your Template supports LightBox</i></p>
</p>
<p>
<input id="<?php echo $this->get_field_id('checkbox22'); ?>" name="<?php echo $this->get_field_name('checkbox22'); ?>" type="checkbox" value="1" <?php checked( '1', $checkbox22 ); ?> />
<label for="<?php echo $this->get_field_id('checkbox22'); ?>"><?php _e('Show credit?', 'wp_lq_plugin'); ?></label>
</p>

<?php }
	// update widget
function update($new_instance, $old_instance) {
      $instance = $old_instance;
      // Fields
      $instance['title'] = strip_tags($new_instance['title']);
	  $instance['text42'] = strip_tags($new_instance['text42']);
	  $instance['checkbox22'] = strip_tags($new_instance['checkbox22']);
	  $instance['checkbox23'] = strip_tags($new_instance['checkbox23']);
     return $instance;
}
	// display widget
function widget($args, $instance) {
   extract( $args );
   // these are the widget options
   $title = apply_filters('widget_title', $instance['title']);
   $text42 = $instance['text42'];
   $checkbox22 = $instance['checkbox22'];
   $checkbox23 = $instance['checkbox23'];
  // wp_register_style('lovequotes', plugins_url('Sf-lovequotes/CSS/main.css'), false, '1.0', 'all');
  // wp_print_styles(array('lovequotes', 'lovequotes'));
   echo $before_widget;
   // Display the widget
?>
  <div>
<?php // Check if title is set
   if ( $title ) {
      echo $before_title . $title . $after_title;
   }
    $f_contents = file("http://www.top-gamos.com/assets/lovequotes.txt"); 
    $line = $f_contents[rand(0, count($f_contents) - 1)];

if( $checkbox23 AND $checkbox23 == '1')
      { ?>
	<a href="<?php echo $line; ?>"><img rel="lightbox" style="width: 100%; height: auto; max-width: <?php echo $text42 ?>px; margin-left: auto; margin-right: auto;" src="<?php echo $line; ?>"></a>
<?php  } else { ?>
   <img rel="lightbox[TopGamos]" style="width: 100%; height: auto; max-width: <?php echo $text42 ?>px; margin-left: auto; margin-right: auto;" src="<?php echo $line; ?>">
<?php } 
echo '<p align="center" style="margin-top: 0px; font-size:14px; "><a style="font-size:14px;" target="_blank" href="http://www.top-gamos.com/love-quotes">More ... Love Quotes</a></p>';
   if( $checkbox22 AND $checkbox22 == '1')
      {
        echo '<p align="center" style="padding: 0px 0px 0 0; margin-top: -20px; font-size:10px; ">Powered by <a style="font-size:10px;" target="_blank" href="http://www.top-gamos.com">Top-Gamos</a></p>';
      }
  echo '</div>';
   echo $after_widget; 
   }
}   
// register widget
add_action('widgets_init', create_function('', 'return register_widget("wp_lovequotes_plugin");'));

?>