<?php
/**
 * Template for edit theme page
 * @var $theme \GDCalendar\Models\Settings\Theme
 */

$id = absint($theme->get_id());
$name = $theme->get_name();
$save_data_nonce = wp_create_nonce('gd_calendar_theme_save_data_nonce' . $id);

$theme_settings = new \GDCalendar\Models\Settings\ThemeSettings();
$settings = $theme_settings->get_all_theme_settings();
$descriptions = $theme_settings->get_theme_settings_fields_name();
?>

<form action="edit.php?post_type=gd_events&page=gd_events_themes&id=<?php echo $id; ?>&save_data_nonce=<?php echo $save_data_nonce; ?>"
      method="post" name="gd_calendar_theme_save_form" id="gd_calendar_theme_save_form">

	<div class="gd_calendar_theme_options_container">
        <div class="theme-save-head">
            <input type="submit" class="theme-save" value="<?php _e('Save Theme', 'gd-calendar'); ?>"/>
            <span class="spinner"></span>
        </div>
        <div class="gd_calendar_theme_option_box">
            <div class="gd_calendar_theme_option_header">
                <label>Theme Name</label>
                <input name="gd_calendar_theme_name" value="<?php echo stripslashes($name); ?>" type="text" />
            </div>
            <div class="gd_calendar_theme_option_body">
	            <?php
	            foreach ($settings as $key => $setting){
		            if($id === $key){
		                foreach ($setting as $key_type => $options){
		                    ?>
                            <div class="gd_calendar_theme_section_wrap active">
                                <div class="gd_calendar_theme_section_heading">
                                    <div class="gd_calendar_theme_section_heading_inner">
                                        <h3><?php echo $key_type; ?></h3>
                                        <span class="gd_calendar_theme_section_arrow">
                                            <svg id="Layer_1" x="0px" y="0px" viewBox="0 0 491.996 491.996"
                                                 style="enable-background:new 0 0 491.996 491.996;" xml:space="preserve" width="12px" height="12px"><g><g><path
                                                                d="M484.132,124.986l-16.116-16.228c-5.072-5.068-11.82-7.86-19.032-7.86c-7.208,0-13.964,2.792-19.036,7.86l-183.84,183.848    L62.056,108.554c-5.064-5.068-11.82-7.856-19.028-7.856s-13.968,2.788-19.036,7.856l-16.12,16.128    c-10.496,10.488-10.496,27.572,0,38.06l219.136,219.924c5.064,5.064,11.812,8.632,19.084,8.632h0.084    c7.212,0,13.96-3.572,19.024-8.632l218.932-219.328c5.072-5.064,7.856-12.016,7.864-19.224    C491.996,136.902,489.204,130.046,484.132,124.986z"
                                                                fill="rgba(0,0,0,0.65)"/></g></g></svg>
                                        </span>
                                    </div>
                                </div>
                                <div class="gd_calendar_theme_section_content">
                                    <?php
                                    foreach ($options as $k => $opt_value){
                                        foreach ($descriptions as $description){
                                            if($description->theme_option_key === $k){
                                                $opt_key = $description->theme_option_key;
                                                $field_description = esc_html($description->description);
                                                $field_help = esc_html($description->help);
                                            }
                                        }
                                        ?>
                                        <div class="gd_calendar_theme_option_field">
                                            <label class="gd_calendar_theme_option_label">
                                                <span class="gd_calendar_theme_option_name"><?php _e($field_description, 'gd-calendar'); ?>

                                                    <span class="gd_calendar_theme_option_help">
                                                        <span class="gd_calendar_theme_option_help_icon">?</span>
                                                        <span class="gd_calendar_theme_option_help_text_wrap">
                                                            <span class="gd_calendar_theme_option_help_text"><?php _e($field_help, 'gd-calendar'); ?></span>
                                                            <span class="gd_calendar_theme_option_help_text_tooltip"></span>
                                                        </span>
                                                    </span>

                                                </span>
                                                <input type="text" name="gd_calendar_theme_type[<?php esc_html_e($key_type); ?>][<?php esc_html_e($opt_key) ?>]" value="<?php echo $opt_value; ?>" class="jscolor gd_calendar_theme_option_value" autocomplete="off" >
                                            </label>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                            <?php
                        }
		            }
	            } ?>
            </div>
        </div>
    </div>

	<input type="hidden" id="gd_calendar_theme_id" name="gd_calendar_theme_id" value="<?php echo $id ?>">
	
</form>
