<?php
$new_theme_link = admin_url( 'edit.php?post_type=gd_events&page=gd_events_themes&task=create_new_theme' );

$new_theme_link = wp_nonce_url( $new_theme_link, 'gd_events_themes_create_new_theme' );
?>
<tr>
	<td colspan="3"><?php _e('No Themes Found.','gd-calendar');?>
		<a href="<?php echo $new_theme_link;?>"><?php _e('Add New', 'gd-calendar');?></a>
	</td>
</tr>