<?php
/**
 * Template for main themes list
 */

?>
<div class="">

    <table class="widefat fixed striped">
        <thead>
        <tr>
            <th scope="col" id="header-id" style="width:20px">
<!--                <span><input type="checkbox" id="select-all"></span>-->
            </th>
            <th scope="col" id="header-name" style="width:90%;"><span><?php _e('Theme', 'gd-calendar'); ?></span></th>
            <th><?php _e('Actions', 'gd-calendar'); ?></th>
        </tr>
        </thead>
        <tbody>
        <?php

        $paged = isset($_GET['paged']) ? $_GET['paged'] : 1;

        $themes = \GDCalendar\Models\Settings\Theme::get(array(
	        'paged' => $paged,
        ));
        if (!empty($themes)) {
	        foreach ($themes as $theme) {
		        \GDCalendar\Helpers\View::render('admin/calendar-theme-list-single-item.php', array('theme' => $theme));
	        }
        } else {
	        \GDCalendar\Helpers\View::render('admin/calendar-theme-list-no-items.php');
        }

        ?>
        </tbody>

        <tfoot>
        <tr>
            <th scope="col" class="footer-id" style="width:20px"></th>
            <th scope="col" class="footer-name"><span><?php _e('Theme', 'gd-calendar'); ?></span></th>
            <th><?php _e('Actions', 'gd-calendar'); ?></th>
        </tr>
        </tfoot>
    </table>
</div>