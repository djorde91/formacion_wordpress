<?
/**
 * @var $location
 */
?>
<div class="venue_box">
    <table id="venue_info" class="venue_info">
        <tr class="venue_field">
            <td><?php _e('Address', 'gd-calendar'); ?></td>
            <td><input type="text" name="address" id="address" autocomplete="off" placeholder="<?php _e('Address...', 'gd-calendar'); ?>" value="<?php if($location->get_address() == true) echo esc_html($location->get_address()); ?>"></td>
        </tr>
        <tr class="venue_field">
            <td><?php _e('Latitude', 'gd-calendar'); ?></td>
            <td><input type="text" id="latitude" class="gd_calendar_map_coordinates" name="latitude" value="<?php if($location->get_latitude() == true) echo floatval($location->get_latitude()); ?>"></td>
        </tr>
        <tr class="venue_field">
            <td><?php _e('Longitude', 'gd-calendar'); ?></td>
            <td><input type="text" id="longitude" class="gd_calendar_map_coordinates" name="longitude" value="<?php if($location->get_longitude() == true) echo floatval($location->get_longitude()); ?>"></td>
        </tr>
    </table>
    <div id="map"></div>
</div>