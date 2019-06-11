<?php
/**
 * @var $view_categories array
 * @var $calendar
 */
?>
    <h2><?php _e('Choose View', 'gd-calendar'); ?>:</h2>
    <div class="gd_calendar_view_type_box">
        <div class="gd_calendar_view_type_sidebar">
		    <?php _e('Sidebar', 'gd-calendar'); ?>
            <div class="gd_calendar_view_type_sidebar_checkbox">
                <input type="hidden" name="gd_calendar_view_type_sidebar" value="0" />
                <input type="checkbox" id="gd_calendar_view_type_sidebar" name="gd_calendar_view_type_sidebar" value="gd_calendar_view_type_sidebar" <?php checked($calendar->get_view_type_sidebar(), 'gd_calendar_view_type_sidebar'); ?>>
                <label class="gd_calendar_switch_checkbox" for="gd_calendar_view_type_sidebar"></label>
            </div>
        </div>
        <br>
        <input type="checkbox" id="all_checkbox_view" value="all" <?php checked(count($calendar->get_view_type()), count($view_categories)) ?>><?php _e('All', 'gd-calendar'); ?><br>
        <div id="gd_calendar_view_type_checkboxes">
            <?php
            foreach ($view_categories as $key => $view_category) {
                $view_type = $calendar->get_view_type();
                $checked = false;
                if(in_array($key,$view_type)){
                    $checked = $key;
                }
                ?>
                <input type="checkbox" name="view[]" class="view" <?php checked($checked,$key); ?> value="<?php echo $key ?>"><?php echo $view_category; ?><br>
        <?php }
        ?>
        </div>
    </div>