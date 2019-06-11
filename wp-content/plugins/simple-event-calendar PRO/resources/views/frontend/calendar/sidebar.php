<?php
/**
 * Calendar Month Sidebar View
 * @var $sidebar_month \GDCalendar\Helpers\Builders\MonthCalendarBuilder
 */
    $calendar_id = $sidebar_month->getPostId();
    ?>
<!--    <div class="gd_calendar_sidebar" data-calendar-id="--><?php //echo $calendar_id; ?><!--">-->
    <?php

    $sidebar = true;
    $dateComponents = $sidebar_month->getDateComponents();
    $currentMonthName = $dateComponents['month'];
    $currentYear = $sidebar_month->getYear();
    $dayOfWeek = $dateComponents['wday'];
    $currentMonth = str_pad($sidebar_month->getMonth(), 2, "0", STR_PAD_LEFT);

    $currentDateObj = new DateTime($sidebar_month->getCurrentDate());
    $currentDate = $currentDateObj->format('m/d/Y');
    $tomorrowDateObj = new DateTime($sidebar_month->getCurrentDate());
    $tomorrowDateObj->modify('+1 day');
    $tomorrowDate = $tomorrowDateObj->format('m/d/Y');

    $hold_month = $sidebar_month->getMonth() . '/01/' . $sidebar_month->getYear();

    $first_week_number = absint($sidebar_month->getCurrentWeekdayNumber($sidebar_month->getYear()."-".$currentMonth."-01"));
    $current_week_number = absint($sidebar_month->getCurrentWeekdayNumber($currentDate));
    ?>
    <div class="gd_calendar_small_date" data-date="<?php echo $hold_month; ?>">
        <span><?php echo $currentMonthName; ?></span>
        <span class="current_year_color"><?php echo $currentYear; ?></span>
        <span class="gd_calendar_month_image <?php
        $currentMonthImage = '';
        \GDCalendar\Helpers\View::render('frontend/calendar/sidebar_image.php', array(
            'currentMonthName' => $currentMonthName,
            'currentMonthImage' => $currentMonthImage,
        ));
        ?>">
        </span>
    </div>
    <div class="gd_calendar_arrow_box">
        <a href="#" id="gd_calendar_left_arrow" data-type="left_arrow"><span>&#10094;</span></a>
        <a href="#" id="gd_calendar_right_arrow" data-type="right_arrow"><span>&#10095;</span></a>
    </div>
    <div class="gd_calendar_small">
        <table class='gd_calendar_small_table'>
            <tr><?php
                foreach($sidebar_month->getDaysOfWeek() as $key => $day) {
                    ?>
                    <th class='gd_calendar_header_small'><?php echo $day; ?></th>
                    <?php
                }
                ?></tr><tr class="<?php echo ($first_week_number === $current_week_number) ? 'gd_calendar_current_week_number' : '' ?>"><?php
                for($i=1; $i <= $dayOfWeek; $i++){
                    echo '<td></td>';
                }
                $currentDay = 1;
                while ($currentDay <= $sidebar_month->getDaysCount()) {
                $currentDayRel = str_pad($currentDay, 2, "0", STR_PAD_LEFT);
                $date = $sidebar_month->getYear()."-$currentMonth-$currentDayRel";
                $week_number = absint($sidebar_month->getCurrentWeekdayNumber($date));
                if ($dayOfWeek == 7) {
                $dayOfWeek = 0;
                ?>
            </tr><tr class="<?php echo ($week_number === $current_week_number) ? 'gd_calendar_current_week_number' : '' ?>">
                <?php
                }
                $current_date = '';
                if($sidebar_month->getCurrentDate() === $date ) {
                    $current_date = 'gd_calendar_current_date_small';
                }
                ?>
                <td class='gd_calendar_day_small' rel='<?php echo $date; ?>'>
                    <div class="<?php echo $current_date; ?>">
                    <p><?php echo $currentDay; ?></p>
                    <?php
                    \GDCalendar\Helpers\View::render('frontend/calendar/events.php', array(
                        'searched_event' => $sidebar_month->getSearchedEvent(),
                        'date' => $date,
                        'sidebar' => $sidebar,
                        'calendar_id' => $calendar_id,
                        'builder' => $sidebar_month,
                    ));
                    ?>
                    </div>
                </td>
                <?php
                $currentDay++;
                $dayOfWeek++;
                }
                for( $i=1; $i <= (7- $dayOfWeek); $i++ ){
                    echo '<td></td>';
                }
                ?>
            </tr>
        </table>
    </div>
    <?php
    $currentWeekDay = absint($sidebar_month->getWeekday());
    $week_events = \GDCalendar\Helpers\Builders\CalendarBuilder::getEventByWeek($currentDate, $sidebar_month);
    $count = 0;
    $today = '';
    $current_day = '';
    $event_date = '';
    foreach($sidebar_month->getDaysOfWeek() as $key => $day_name) {
        if(!empty($week_events[$key])){
            if($currentWeekDay === $key){
                $current_day = __('Today', 'gd-calendar');
                $today = 'gd_calendar_today';
                $event_date = $currentDate;
            }
            elseif ($currentWeekDay + 1 === $key){
                $current_day = __('Tomorrow', 'gd-calendar');
                $today = '';
                $event_date = $tomorrowDate;
            }
            else{
                if($currentWeekDay > $key){continue;}
                $current_day = __(date('l', strtotime($day_name)), 'gd-calendar');
                $event_date = __(date('m/d/Y', strtotime($day_name)), 'gd-calendar');
                $today = '';
            }
            if($count < 3){
                ?>
                <div class="gd_calendar_small_box">
                    <div class="gd_calendar_small_day <?php echo $today ?>"><?php echo strtoupper($current_day) . ' ' . $event_date; ?></div>
                    <?php
                    $counter = 0;

                    if(isset($_POST['id'])){
                        $post_id = absint($_POST['id']);
                    }
                    elseif (null !== get_post()){
                        $post_id = absint(get_post()->ID);
                    }

                    $calendar = new \GDCalendar\Models\PostTypes\Calendar($post_id);
                    $post_type = $calendar->get_select_events_by();
                    $selected_categories = $calendar->get_cat();

                    $tax_param = '';
                    if(!empty($selected_categories) && taxonomy_exists($post_type)){
                        $tax_param = array(
                            'taxonomy' => $post_type,
                            'terms' => $selected_categories,
                            'include_children' => false,
                        );
                    }

                    $events = \GDCalendar\Models\PostTypes\Event::get(array(
                            'post_status' => 'publish',
                            'tax_query' => array(
                                $tax_param,
                            ))
                    );
                    if($events && !empty($events)) {
                        foreach ($events as $event) {
                            $event_id = absint($event->get_id());

                            if (!empty($selected_categories)) {
                                if ($post_type === \GDCalendar\Models\PostTypes\Organizer::get_post_type()) {
                                    $organizers = $event->get_event_organizer();
                                    $org_result = array_intersect($organizers, $selected_categories);
                                    $result = (!empty($org_result)) ? true : false;
                                } elseif ($post_type === \GDCalendar\Models\PostTypes\Venue::get_post_type()) {
                                    $venue = $event->get_event_venue();
                                    $result = in_array($venue, $selected_categories);
                                } else {
                                    $result = true;
                                }
                            } else {
                                $result = true;
                            }
                            if (true === $result) {
	                            if( $event->get_repeat() === 'repeat' && $event->get_repeat_type() !== 'choose_type' ) {
		                            $repeat_type = absint($event->get_repeat_type());
		                            $eventAllDay = $event->get_all_day();
		                            $eventStartDay = new DateTime($event->get_start_date());
		                            $eventEndDate = new DateTime($event->get_end_date());
		                            $eventInterval = intval($eventStartDay->diff($eventEndDate)->format('%a'));

		                            $repeatTypeValue = \GDCalendar\Models\PostTypes\Event::$repeat_types[ $repeat_type ];

		                            $maxDate = new DateTime($sidebar_month->getLastDay());
		                            $minDate = new DateTime($sidebar_month->getFirstDay());

		                            switch($repeat_type){
			                            case 1:
				                            $repeatValue = $event->get_repeat_day();
				                            break;
			                            case 2:
				                            $repeatValue = $event->get_repeat_week();
				                            break;
			                            case 3:
				                            $repeatValue = $event->get_repeat_month();
				                            break;
			                            case 4:
				                            $repeatValue = $event->get_repeat_year();
				                            break;
			                            default:
				                            $repeatValue = $event->get_repeat_day();
		                            }
		                            if(is_null($repeatValue) || $repeatValue === 0){
			                            $repeatValue = 1;
		                            }
		                            $event_dates = \GDCalendar\Helpers\Builders\CalendarBuilder::getRepeatedEventsDateRange($eventStartDay, $eventEndDate, $eventInterval, $repeatValue, $maxDate, $minDate, $repeatTypeValue, $eventAllDay );
	                            }
	                            else{
		                            $event_dates = $event->get_date_range();
                                }

                                $title = $event->get_post_data()->post_title;
	                            $start_time = sanitize_text_field(substr($event->get_start_date(), 11, 8));
                                $end_time = sanitize_text_field(substr($event->get_end_date(), 11, 8));

                                $all_day = "";
                                if ($start_time == "" || $end_time == "") {
                                    $all_day = __('All day', 'gd-calendar');
                                }

                                foreach ($event_dates as $dates) {
                                    foreach ($dates as $date):
                                        if ($event_date === date("m/d/Y", strtotime(substr($date, 0, 10)))) {
                                            if ($counter < 3) {
                                                $circle = '';
                                                if ($counter == 0) {
                                                    $circle = 'circle_first';
                                                } elseif ($counter == 1) {
                                                    $circle = 'circle_second';
                                                } elseif ($counter == 2) {
                                                    $circle = 'circle_third';
                                                }
                                                ?>
                                                <div class="gd_calendar_small_event">
                                                    <span class="<?php echo $circle; ?> circle_big"></span>
                                                    <span class="gd_calendar_small_title"><?php echo $title; ?></span>
                                                    <span class="gd_calendar_small_time"><?php echo ($start_time == "" || $end_time == "") ? $all_day : ($start_time . ' - ' . $end_time); ?></span>
                                                </div>
                                                <?php
                                            }
                                            $counter++;
                                        }
                                    endforeach;
                                }
                            }
                        }
                    }
                    ?>
                    <div class="gd_calendar_clear"></div>
                </div>
                <?php
            }
            $count++;
        }
    }
    ?>
<!--    </div>-->