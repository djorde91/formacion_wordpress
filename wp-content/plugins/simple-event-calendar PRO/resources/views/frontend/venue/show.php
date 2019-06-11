<?php
/**
 * @var $venue
 */
?>
<div class="venue_view gd_calendar_body">
    <?php if(has_post_thumbnail()){ ?>
        <div class="event_thumbnail">
            <?php echo the_post_thumbnail(); ?>
        </div>
    <?php } ?>
    <div class="venue_front_field">
        <div class="venue_location_label"><?php _e('Location', 'gd-calendar'); ?>:</div>
        <div class="venue_location_name"><?php if(!empty($venue->get_address())) {echo esc_html($venue->get_address());} ?></div>
    </div>
    <input id="address_view" class="address_view" type="hidden" value="<?php echo esc_html($venue->get_address()); ?>">
    <input id="latitude_view" class="latitude_view" type="hidden" value="<?php echo floatval($venue->get_latitude()); ?>">
    <input id="longitude_view" class="longitude_view" type="hidden" value="<?php echo floatval($venue->get_longitude()); ?>">
    <?php $i = random_int(0, 10000); ?>
    <div id="map_view_<?php echo $i; ?>" class="map_view event_map"></div>
</div>