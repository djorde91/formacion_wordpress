<?php
/**
* @var $theme
 */

$theme_settings = new \GDCalendar\Models\Settings\ThemeSettings();
$settings = $theme_settings->get_all_theme_settings();
echo "<style>";
foreach ($settings as $k => $setting){
	if($theme === $k){
	    ?>
        .gd_calendar_theme_<?php echo $theme;?> .gd_calendar_small_date{background-color: #<?php echo $setting['Sidebar']['sidebar_header_bg_color']; ?>;}
        .gd_calendar_theme_<?php echo $theme;?> div.gd_calendar_current_date_small{background-color: #<?php echo $setting['Sidebar']['sidebar_current_date_bg_color']; ?>;}
        .gd_calendar_theme_<?php echo $theme;?> .gd_calendar_sidebar{background-color: #<?php echo $setting['Sidebar']['sidebar_bg_color']; ?>;}
        .gd_calendar_theme_<?php echo $theme;?> .gd_calendar_sidebar .circle_first{background-color: #<?php echo $setting['Sidebar']['sidebar_first_circle_bg_color']; ?>;}
        .gd_calendar_theme_<?php echo $theme;?> .gd_calendar_sidebar .circle_second{background-color: #<?php echo $setting['Sidebar']['sidebar_second_circle_bg_color']; ?>;}
        .gd_calendar_theme_<?php echo $theme;?> .gd_calendar_sidebar .circle_third{background-color: #<?php echo $setting['Sidebar']['sidebar_third_circle_bg_color']; ?>;}
        .gd_calendar_theme_<?php echo $theme;?> .gd_calendar_event_view_box button{background-color: #<?php echo $setting['Menu Bar']['view_button_bg_color']; ?>;}
        .gd_calendar_theme_<?php echo $theme;?> .gd_calendar_event_view_box button:hover{background-color: #<?php echo $setting['Menu Bar']['view_button_hover_bg_color']; ?>;}
        .gd_calendar_theme_<?php echo $theme;?> button.gd_calendar_active_view, button.gd_calendar_active_view:focus, button.gd_calendar_active_view:hover, button.gd_calendar_active_view:active{background-color: #<?php echo $setting['Menu Bar']['active_button_bg_color']; ?>;}
        .gd_calendar_theme_<?php echo $theme;?> .ui-state-highlight, .ui-widget-content .ui-state-highlight{background: #<?php echo $setting['Menu Bar']['datepicker_current_day_active_bg_color']; ?> !important;}
        .gd_calendar_theme_<?php echo $theme;?> .ui-state-active, .ui-widget-content .ui-state-active{background: #<?php echo $setting['Menu Bar']['datepicker_current_day_selected_bg_color']; ?> !important;}
        .gd_calendar_theme_<?php echo $theme;?> .ui-widget button{background: #<?php echo $setting['Menu Bar']['datepicker_button_bg_color']; ?> !important;}
        .gd_calendar_theme_<?php echo $theme;?> .gd_calendar_today{color: #<?php echo $setting['Day']['day_today_color']; ?>;}
        .gd_calendar_theme_<?php echo $theme;?> .gd_calendar_list .background_first{border-left: 3px solid #<?php echo $setting['Day']['day_event_first_border_left']; ?>;}
        .gd_calendar_theme_<?php echo $theme;?> .gd_calendar_list .background_second{border-left: 3px solid #<?php echo $setting['Day']['day_event_second_border_left']; ?>;}
        .gd_calendar_theme_<?php echo $theme;?> .gd_calendar_list .background_third{border-left: 3px solid #<?php echo $setting['Day']['day_event_third_border_left']; ?>;}
        .gd_calendar_theme_<?php echo $theme;?> .gd_calendar_list .gd_calendar_first_column, .gd_calendar_list .gd_calendar_last_column{background: #<?php echo $setting['Day']['day_table_weekend_columns_background_color']; ?> !important;}
        .gd_calendar_theme_<?php echo $theme;?> .gd_calendar_list .background_first{background-color: #<?php echo $setting['Day']['day_event_first_bg_color']; ?>;}
        .gd_calendar_theme_<?php echo $theme;?> .gd_calendar_list .background_second{background-color: #<?php echo $setting['Day']['day_event_second_bg_color']; ?>;}
        .gd_calendar_theme_<?php echo $theme;?> .gd_calendar_list .background_third{background-color: #<?php echo $setting['Day']['day_event_third_bg_color']; ?>;}
        .gd_calendar_theme_<?php echo $theme;?> .current_day_week{background-color: #<?php echo $setting['Week']['week_current_day_bg_color']; ?>;}
        .gd_calendar_theme_<?php echo $theme;?> .gd_calendar_week_number{color: #<?php echo $setting['Week']['week_number_color']; ?>;}
        .gd_calendar_theme_<?php echo $theme;?> .gd_calendar_week_table .background_first{border-left: 3px solid #<?php echo $setting['Week']['week_event_first_border_left']; ?>;}
        .gd_calendar_theme_<?php echo $theme;?> .gd_calendar_week_table .background_second{border-left: 3px solid #<?php echo $setting['Week']['week_event_second_border_left']; ?>;}
        .gd_calendar_theme_<?php echo $theme;?> .gd_calendar_week_table .background_third{border-left: 3px solid #<?php echo $setting['Week']['week_event_third_border_left']; ?>;}
        .gd_calendar_theme_<?php echo $theme;?> td.gd_calendar_week_cell{background: #<?php echo $setting['Week']['week_table_background_color']; ?>;}
        .gd_calendar_theme_<?php echo $theme;?> div.gd_calendar_see_all .gd_calendar_week_more_events{color: #<?php echo $setting['Week']['week_see_all_link_color']; ?>;}
        .gd_calendar_theme_<?php echo $theme;?> .gd_calendar_week_cell .gd_calendar_first_column, .gd_calendar_week_cell .gd_calendar_last_column{background: #<?php echo $setting['Week']['week_table_weekend_columns_background_color']; ?> !important;}
        .gd_calendar_theme_<?php echo $theme;?> .gd_calendar_week_table .background_first{background-color: #<?php echo $setting['Week']['week_event_first_bg_color']; ?>;}
        .gd_calendar_theme_<?php echo $theme;?> .gd_calendar_week_table .background_second{background-color: #<?php echo $setting['Week']['week_event_second_bg_color']; ?>;}
        .gd_calendar_theme_<?php echo $theme;?> .gd_calendar_week_table .background_third{background-color: #<?php echo $setting['Week']['week_event_third_bg_color']; ?>;}
        .gd_calendar_theme_<?php echo $theme;?> p.gd_calendar_current_date{background-color: #<?php echo $setting['Month']['month_current_date_bg_color']; ?>;}
        .gd_calendar_theme_<?php echo $theme;?> td.gd_calendar_day{background: #<?php echo $setting['Month']['month_table_background_color']; ?>;}
        .gd_calendar_theme_<?php echo $theme;?> .gd_calendar_weekend_bg{background: #<?php echo $setting['Month']['month_table_weekend_columns_background_color']; ?> !important;}
        .gd_calendar_theme_<?php echo $theme;?> div.gd_calendar_see_all .gd_calendar_month_more_events{color: #<?php echo $setting['Month']['month_see_all_link_color']; ?>;}
        .gd_calendar_theme_<?php echo $theme;?> .gd_calendar_table .circle_first{background-color: #<?php echo $setting['Month']['month_first_circle_bg_color']; ?>;}
        .gd_calendar_theme_<?php echo $theme;?> .gd_calendar_table .circle_second{background-color: #<?php echo $setting['Month']['month_second_circle_bg_color']; ?>;}
        .gd_calendar_theme_<?php echo $theme;?> .gd_calendar_table .circle_third{background-color: #<?php echo $setting['Month']['month_third_circle_bg_color']; ?>;}
        .gd_calendar_theme_<?php echo $theme;?> .gd_calendar_table .background_first{background-color: #<?php echo $setting['Month']['month_event_first_bg_color']; ?>;}
        .gd_calendar_theme_<?php echo $theme;?> .gd_calendar_table .background_second{background-color: #<?php echo $setting['Month']['month_event_second_bg_color']; ?>;}
        .gd_calendar_theme_<?php echo $theme;?> .gd_calendar_table .background_third{background-color: #<?php echo $setting['Month']['month_event_third_bg_color']; ?>;}
        .gd_calendar_theme_<?php echo $theme;?> p.gd_calendar_year_current_date{background-color: #<?php echo $setting['Year']['year_current_date_bg_color']; ?>;}
        .gd_calendar_theme_<?php echo $theme;?> .gd_calendar_year_title{color: #<?php echo $setting['Year']['year_title_color']; ?>;}
        .gd_calendar_theme_<?php echo $theme;?> .current_month_color{color: #<?php echo $setting['Year']['year_current_month_color']; ?> !important;}
        .gd_calendar_theme_<?php echo $theme;?> .gd_cyc{background: #<?php echo $setting['Year']['year_table_days_background_color']; ?>;}
        .gd_calendar_theme_<?php echo $theme;?> .gd_calendar_year_table .circle_first{background-color: #<?php echo $setting['Year']['year_first_circle_bg_color']; ?>;}
        .gd_calendar_theme_<?php echo $theme;?> .gd_calendar_year_table .circle_second{background-color: #<?php echo $setting['Year']['year_second_circle_bg_color']; ?>;}
        .gd_calendar_theme_<?php echo $theme;?> .gd_calendar_year_table .circle_third{background-color: #<?php echo $setting['Year']['year_third_circle_bg_color']; ?>;}
    <?php
	}
}
echo "</style>";
?>