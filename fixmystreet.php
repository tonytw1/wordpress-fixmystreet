<?php
/*
 Plugin Name: FixMyStreet
 Plugin URI: http://eelpieconsulting.co.uk/fixmystreet
 Description: Display content from MySocietys' FixMyStreet.
 Version: 1.0
 Author: Tony McCrae
 Author URI: http://eelpieconsulting.co.uk
 */


function getRssUrl($postcode) {
	return 'http://www.fixmystreet.com/rss?pc='.$postcode.'&type=local_problems';
}


function widget_fixmystreet($args) {
	extract($args);
	echo $before_title. 'FixMyStreet'.$after_title;
	echo $before_widget;

	$postcode = get_option('widget_fixmystreet_postcode');
	if ($postcode) {
		
		$feed = fetch_feed(getRssUrl($postcode));
		if ($feed) {
			foreach ( $feed->get_items(0, 10) as $item ) {	?>
				<li><a href="<?php echo $item->get_permalink(); ?>"> <?php echo $item->get_title(); ?></a></li>
				<?php 
			}
			
		} else {
			?><p>Could not load feed</p><?php
		}
	}	
	echo $after_widget;
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