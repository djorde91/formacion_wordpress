<?php
/**
 * @var $post_id
 * @var $calendar
 */
?>
<h2><?php _e('Select Theme', 'gd-calendar'); ?>:</h2>
<select name="theme" id="theme">
    <?php $all_themes = \GDCalendar\Models\Settings\Theme::get_all_themes_names(); ?>
    <?php foreach ($all_themes as $key => $theme) {
        ?>
        <option value='<?php echo $key; ?>' <?php selected($calendar->get_theme(), $key); ?> ><?php echo esc_html(stripslashes($theme)); ?></option>
    <?php } ?>
</select>