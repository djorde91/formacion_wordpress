<?php
/**
 * Calendar Year View
 * @var $year \GDCalendar\Helpers\Builders\MonthCalendarBuilder
 */

$months = $year->getMonthsOfYear();
$currentDateComponents = $year->getDateComponents();
$currentMonthName = $currentDateComponents['month'];
$currentMonth = $year->getMonth();
$currentYear = $year->getYear();
$month = 0;
$forcount=0;

if(isset($_POST['search']) && !empty($_POST['search'])){
    $_GET['search'] = sanitize_text_field($_POST['search']);
}

if(isset($_GET['search']) && $_GET['search'] == true && $year->getSearchedEvent() == false){
    ?>
    <div class="gd_calendar_message">
        <?php esc_html_e('No results found', 'gd-calendar'); ?>
    </div>
<?php
}

?>
<div class="gd_calendar_year_title"><?php echo $currentYear; ?></div>
<table border=0>
<?php
$weeksIn=0;
$even=0;

/*getting events*/
if(isset($_POST['id'])){
	$post_id = absint($_POST['id']);
}
elseif (null !== get_post()){
	$post_id = absint(get_post()->ID);
}
else{throw new \Exception('Cannot show year view for not existing post');}
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
		 )
	 )
 );



for ($row=1; $row<=3; $row++) {

    echo '<tr>';
    for ($column=1; $column<=4; $column++) {
	    if($weeksIn>=5 && $column%2 == 0){ $extraline='extra-margin';}
	    echo '<td class="gd_calendar_month '.$extraline.'">';
        $month++;
        $dateComponents = $year->getDateComponents($month);
        $dayOfWeek = $dateComponents['wday'];
        $thisYear = absint(date("Y"));
	    $currentMonth=absint(date('m', strtotime('-1 month')))+1;
        ?>
        <table class='gd_calendar_year_table'>
            <tr>
                <th colspan="7" class="<?php echo ($currentYear == $thisYear && $currentMonth == $month) ? 'current_month_color' : ''; ?>"><?php echo $months[$month-1]; ?> </th>
            </tr>
            <tr><?php
                foreach($year->getDaysOfWeek() as $key => $day) {
	                $even++;
                    ?>
                    <td class='gd_calendar_header_year'><?php echo $day; ?></td>
                    <?php
                }
                ?></tr><tr><?php
                for($i=1; $i <= $dayOfWeek; $i++){
                    echo '<td></td>';
                }
                $currentDay = 1;
		        $weeksIn=0;
		        $extraline="";
                while ($currentDay <= $year->getDaysCount($month)) {
                    if ($dayOfWeek == 7) {
                        $dayOfWeek = 0;
                        ?>
                        </tr>
                        <?php $weeksIn++; ?>
                        <tr>
                        <?php
                    }
                $currentDayRel = str_pad($currentDay, 2, "0", STR_PAD_LEFT);
                $currentMonthRel = str_pad($month, 2, "0", STR_PAD_LEFT);
                $date = $year->getYear()."-$currentMonthRel-$currentDayRel";
                ?>
                <td class='gd_cyc' rel='<?php echo $date; ?>'>
                <p <?php echo ($year->getCurrentDate() === $date ) ? 'class="gd_calendar_year_current_date"' : ''; ?>><?php echo $currentDay; ?></p>

                <?php

                    $evn_small_wrapper='<div class="gd_es">';
                    $has_event="";

                    $counter = 1;
                    if(isset($_GET['search'])){
                        foreach ($year->getSearchedEvent() as $event) {
                            $event_id = absint($event);
                            $get_searched_event = new \GDCalendar\Models\PostTypes\Event($event_id);

	                        if( $get_searched_event->get_repeat() === 'repeat' && $get_searched_event->get_repeat_type() !== "choose_type" ) {
		                        $repeat_type = absint($get_searched_event->get_repeat_type());
		                        $eventAllDay = $get_searched_event->get_all_day();
		                        $eventStartDay = new DateTime($get_searched_event->get_start_date());
		                        $eventEndDate = new DateTime($get_searched_event->get_end_date());
		                        $eventInterval = intval($eventStartDay->diff($eventEndDate)->format('%a'));
		                        $repeatTypeValue = \GDCalendar\Models\PostTypes\Event::$repeat_types[ $repeat_type ];

		                        $maxDate = new DateTime($year->getLastDay());
		                        $minDate = new DateTime($year->getFirstDay());

		                        switch($repeat_type){
			                        case 1:
				                        $repeatValue = $get_searched_event->get_repeat_day();
				                        break;
			                        case 2:
				                        $repeatValue = $get_searched_event->get_repeat_week();
				                        break;
			                        case 3:
				                        $repeatValue = $get_searched_event->get_repeat_month();
				                        break;
			                        case 4:
				                        $repeatValue = $get_searched_event->get_repeat_year();
				                        break;
			                        default:
				                        $repeatValue = $get_searched_event->get_repeat_day();
		                        }
		                        if(is_null($repeatValue) || $repeatValue === 0){
			                        $repeatValue = 1;
		                        }
		                        $event_dates = \GDCalendar\Helpers\Builders\CalendarBuilder::getRepeatedEventsDateRange($eventStartDay, $eventEndDate, $eventInterval, $repeatValue, $maxDate, $minDate, $repeatTypeValue, $eventAllDay );
	                        }
	                        else{
		                        $event_dates = $get_searched_event->get_date_range();
                            }
                            if(!empty($event_dates)):
                                foreach ($event_dates as $value){
	                                foreach ($value as $event_date):
                                        if($date === substr($event_date, 0, 10)){
                                            if ($counter <= 3) {
                                                $circle = '';
                                                if($counter == 1){
                                                    $circle = 'circle_first';
                                                }
                                                elseif($counter == 2){
                                                    $circle = 'circle_second';
                                                }
                                                elseif($counter == 3){
                                                    $circle = 'circle_third';
                                                }

	                                            $has_event.='<span class="'.$circle.'"></span>';

                                            }
                                            $counter++;
                                        }
                                    endforeach;
                                }
                            endif;
                         }
                    }
                    else{
                        if($events && !empty($events)) {

	                        $sort_events = array();
	                        foreach ($events as $key => $value){
		                        $sort_events[] = strtotime(substr($value->get_start_date(), 11, 8));
	                        }
	                        array_multisort($sort_events, SORT_ASC, $events);

                            foreach ($events as $event) {
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
	                                if( $event->get_repeat() === 'repeat' && $event->get_repeat_type() !== 'choose_type') {
		                                $repeat_type = absint($event->get_repeat_type());
		                                $eventAllDay = $event->get_all_day();
		                                $eventStartDay = new DateTime($event->get_start_date());
		                                $eventEndDate = new DateTime($event->get_end_date());
		                                $eventInterval = intval($eventStartDay->diff($eventEndDate)->format('%a'));

		                                $repeatTypeValue = \GDCalendar\Models\PostTypes\Event::$repeat_types[ $repeat_type ];

		                                $maxDate = new DateTime($year->getLastDay());
		                                $minDate = new DateTime($year->getFirstDay());

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
	                                }else{
		                                $event_dates = $event->get_date_range();
	                                }
	                                if(!empty($event_dates)):
                                        foreach ($event_dates as $value) {
	                                        foreach ($value as $event_date):
                                                if ($date === substr($event_date, 0, 10)) {
                                                    if ($counter <= 3) {
                                                        $circle = '';
                                                        if ($counter == 1) {
                                                            $circle = 'circle_first';
                                                        } elseif ($counter == 2) {
                                                            $circle = 'circle_second';
                                                        } elseif ($counter == 3) {
                                                            $circle = 'circle_third';
                                                        }

                                                        $has_event.=' <span class="'.$circle.'"></span>';
                                                    }
                                                    $counter++;
                                                }
	                                        endforeach;
                                        }
                                    endif;
                                }
                            }
                        }
                    }

                    if($has_event!=""){
	                    $evn_small_wrapper.=$has_event."</div>";
	                    echo  $evn_small_wrapper;
                    }
                ?>



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
        </td>
        <?php


    }
    echo '</tr>';

}
?>
</table>

