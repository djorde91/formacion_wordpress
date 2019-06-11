<?php
/**
 * Template for themes list single item
 * @var $theme \GDCalendar\Models\Settings\Theme
 */

$theme_id = absint($theme->get_id());

$remove_theme = admin_url('edit.php?post_type=gd_events&page=gd_events_themes&task=remove_theme&id=' . $theme_id);
$remove_theme = wp_nonce_url($remove_theme, 'gd_events_themes_remove_theme_' . $theme_id);
?>
<tr>
	<td class="theme-id">
<!--		--><?php //if($theme_id !== 1): ?>
<!--        <input type="checkbox" class="item-checkbox" name="items[]" value="--><?php //echo $theme_id; ?><!--">-->
<!--		--><?php //endif; ?>
    </td>
	<td class="theme-name">
        <?php if($theme_id !== 1): ?>
        <a href="<?php echo $theme->get_edit_link(); ?>"><?php echo esc_html(stripslashes($theme->get_name())); ?></a>
        <?php else: ?>
        <span><?php echo esc_html(stripslashes($theme->get_name())); ?></span>
        <?php endif; ?>
    </td>
	<td class="theme-actions">
		<?php if($theme_id !== 1): ?>
		<a class="gd_calendar_edit_theme" href="<?php echo $theme->get_edit_link(); ?>"><i class="gd_calendar_theme_icon gd_calendar_theme_icon_edit" aria-hidden="true"></i></a>
		<a class="gd_calendar_delete_theme" href="<?php echo $remove_theme; ?>"><i class="gd_calendar_theme_icon gd_calendar_theme_icon_remove" aria-hidden="true"></i></a>
		<?php endif; ?>
    </td>
</tr>
