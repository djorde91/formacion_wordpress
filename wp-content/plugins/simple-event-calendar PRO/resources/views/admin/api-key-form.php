<?php
/**
 * Template for API Key form
 */

$api_key = GDCalendar()->getApiKey();
?>
<form class="gd_calendar_main_api_form <?php if ( is_null($api_key) || $api_key == '' ) { echo 'hide'; } ?>" action="" method="post">
    <label class="map_api_text">
        <span class="map_api_label"><?php _e( 'API KEY', 'gd-calendar' ); ?></span>
        <div class="map_api_input_block">
            <input name="gd_calendar_api_key_input" class="gd_calendar_api_key_input" value="<?php echo $api_key; ?>"
                   required="required" type="text"><span class="control_title"><?php _e( 'Input the api key here', 'gd-calendar' ); ?></span>
            <span id="error-api-key" class="hide">Invalid Api Key</span>
            <div class="map_api_bar"></div>
        </div>
    </label>
    <span class="gd_calendar_apply_action"><button class="gd_calendar_save_api_key_button map_api_btn map_api_btn_raised_green"><?php _e( 'Save', 'gd-calendar' ); ?></button><span class="spinner"></span></span>
</form>
