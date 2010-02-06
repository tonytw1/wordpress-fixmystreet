<?php
/*
 Plugin Name: FixMyStreet
 Plugin URI: http://eelpieconsulting.co.uk/fixmystreet
 Description: Display content from MySocietys' FixMyStreet.
 Version: 1.0
 Author: Tony McCrae
 Author URI: http://eelpieconsulting.co.uk
 */

function widget_fixmystreet($args) {
	extract($args);
	?>
	<?php echo $before_widget; ?>
	<?php echo $before_title. 'FixMyStreet'. $after_title; ?>

	<?php
	$postcode = get_option('widget_fixmystreet_postcode');
	echo esc_attr($postcode);
	?>

	<?php echo $after_widget; ?>
	<?php
}



function control_fixmystreet() {
	$data = get_option('widget_fixmystreet_postcode');
	?>
	<p><label>Postcode: <input name="widget_fixmystreet_postcode" type="text" value="<?php echo esc_attr($data); ?>" /></label></p>
	<?php

	if (isset($_POST['widget_fixmystreet_postcode'])) {
		$postcode = $_POST['widget_fixmystreet_postcode'];
		update_option('widget_fixmystreet_postcode', $postcode);
	}
	
}


function init_fixmystreet(){
	register_sidebar_widget("FixMyStreet", "widget_fixmystreet");
	register_widget_control("FixMyStreet", "control_fixmystreet");
}


add_action("plugins_loaded", "init_fixmystreet");

?>