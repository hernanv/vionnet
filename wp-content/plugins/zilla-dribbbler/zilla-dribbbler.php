<?php
/*
Plugin Name: ZillaDribbbler
Plugin URI: http://www.themezilla.com/plugins/zilladribbbler/
Description: Provides a widget that allows you to display your most recent Dribbble shots.
Version: 1.0
Author: Mark Southard - ThemeZilla
Author URI: http://www.themezilla.com
*/

/**
 * ZillaDribbbler Class
 */

class ZillaDribbbler {

	function __construct() {
		add_shortcode('zilla_dribbbler', array(&$this, 'shortcode'));
		add_action('widgets_init', create_function('', 'register_widget("ZillaDribbbler_Widget");'));
		add_action('wp_enqueue_scripts', array(&$this, 'enqueue_scripts'));
	}

	function shortcode( $atts ) {
		extract( shortcode_atts( array(
			'player' => '',
			'shots' => 5
		), $atts ) );

		return $this->do_zilla_dribbbler( esc_attr($player), esc_attr($shots) );
	}

	function do_zilla_dribbbler( $player, $shots ) {
		// check for cached version
		$key = 'zilladribbbler_' . $player;
		$shots_cache = get_transient($key);

		if( $shots_cache === false ) {
			$url 		= 'http://api.dribbble.com/players/' . $player . '/shots/?per_page=15';
			$response 	= wp_remote_get( $url );

			if( is_wp_error( $response ) ) 
				return;

			$xml = wp_remote_retrieve_body( $response );

			if( is_wp_error( $xml ) )
				return;

			if( $response['headers']['status'] == 200 ) {

				$json = json_decode( $xml );
				$dribbble_shots = $json->shots;

				set_transient($key, $dribbble_shots, 60*5);
			}
		} else {
			$dribbble_shots = $shots_cache;
		}

		if( $dribbble_shots ) {
			$i = 0;
			$output = '<ul class="zilla-dribbble-shots">';

			foreach( $dribbble_shots as $dribbble_shot ) {
				if( $i == $shots )
					break;

				$output .= '<li>';
				$output .= '<a href="' . $dribbble_shot->url . '">';
				$output .= '<img height="' . $dribbble_shot->height . '" width="' . $dribbble_shots[$i]->width . '" src="' . $dribbble_shot->image_url . '" alt="' . $dribbble_shot->title . '" />';
				$output .= '</a>';
				$output .= '</li>';
				
				$i++;
			}

			$output .= '</ul>';
		} else {
			$output = '<em>' . __('Error retrieving Dribbble shots', 'zilla') . '</em>';
		}

		return $output;
	}

	function enqueue_scripts() {
		wp_enqueue_style( 'zilla-dribbbler', plugins_url( '/css/zilla-dribbbler.css', __FILE__ ) );
	}
}
global $zilla_dribbbler;
$zilla_dribbbler = new ZillaDribbbler();


/**
 * Widget
 */

class ZillaDribbbler_Widget extends WP_Widget {

	function __construct() {
		$widget_ops = array( 'description' => __('Use this widget to display your latest Dribbble shots.') );
		parent::__construct( 'zilla-dribbbler-widget', 'Zilla Dribbbler', $widget_ops );
	}

	function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		$desc = $instance['description'];
		$player = $instance['player'];
		$shots = $instance['shots'];

		echo $before_widget;
		if ( !empty( $title ) ) echo $before_title . $title . $after_title;

		if( $desc ) echo '<p>' . $desc . '</p>';

		global $zilla_dribbbler;
		echo $zilla_dribbbler->do_zilla_dribbbler($player, $shots);

		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['description'] = strip_tags($new_instance['description'], '<a><b><strong><i><em>');
		$instance['player'] = trim($new_instance['player']);
		$instance['shots'] = trim($new_instance['shots']);
		return $instance;
	}

	function form( $instance ) {
		$defaults = array(
			'title' => '',
			'description' => '',
			'player' => 'ormanclark',
			'shots' => 2
		);

		$instance = wp_parse_args( (array) $instance, $defaults );

		$title = $instance['title'];
		$desc = $instance['description'];
		$player = $instance['player'];
		$shots = $instance['shots'];

		?>

		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('description'); ?>"><?php _e('Description:'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('description'); ?>" name="<?php echo $this->get_field_name('description'); ?>" type="text" value="<?php echo $desc; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('player'); ?>"><?php _e('Dribbble player:'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('player'); ?>" name="<?php echo $this->get_field_name('player'); ?>" type="text" value="<?php echo $player; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('shots'); ?>"><?php _e('Number of shots to display:'); ?></label>
			<select name="<?php echo $this->get_field_name('shots'); ?>">
				<?php for( $i = 1; $i <= 15; $i++ ) { ?>
					<option value="<?php echo $i; ?>" <?php selected( $i, $shots ); ?>><?php echo $i; ?></option>
				<?php } ?>
			</select>
		</p>

		<?php
	}

}