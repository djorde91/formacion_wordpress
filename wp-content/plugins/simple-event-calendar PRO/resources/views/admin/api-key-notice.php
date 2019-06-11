<?php
/**
 * Template for API key notice
 */
?>
<div id="gd_calendar_no_api_key_big_notice" class="error">
	<p class="map_api_info"><?php _e( 'Attention!', 'gd-calendar' ); ?><br><?php _e( 'If you want to use Google Map for adding venues, please note that All Google Maps users now required to have an API key to function. You can read more about that', 'gd-calendar' ); ?> <a href="https://googlegeodevelopers.blogspot.am/2016/06/building-for-scale-updates-to-google.html" target="_blank"><?php _e( 'here.', 'gd-calendar' ); ?></a></p>
	<div><a class="map_api_btn map_api_btn_raised_blue" target="_blank" href="https://console.developers.google.com/flows/enableapi?apiid=maps_backend,geocoding_backend,directions_backend,distance_matrix_backend,elevation_backend,places_backend&keyType=CLIENT_SIDE&reusekey=true"><?php _e( 'Register for Google Maps API now', 'gd-calendar' ); ?></a></div>
	<p class="map_api_info">Once registered, simply paste your API key here and press the save button. It will activate in 5-10 minutes.</p>
	<div>
		<form action="" method="post" >
			<label class="map_api_text">
				<span class="map_api_label">API KEY</span>
				<div class="map_api_input_block">
					<input name="gd_calendar_api_key_input" class="gd_calendar_api_key_input" value="" required="required" type="text"><span class="control_title">Input the api key here</span>
					<div class="map_api_bar"></div>
				</div>
			</label>
			<div class="gd_calendar_apply_action"><button class="gd_calendar_save_api_key_button map_api_btn map_api_btn_raised_green">Save</button><span class="spinner"></span></div>
		</form>
	</div>
	<p class="map_api_info">Need help? <a href="//grandwp.com/support/" target="_blank">Contact Us</a> and we will help you with installation.</p>
    <a href="" class="hide_notification_button"><i class="fa fa-close"></i></a>
</div>
