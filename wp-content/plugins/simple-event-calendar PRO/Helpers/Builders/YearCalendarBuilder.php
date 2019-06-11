<?php

namespace GDCalendar\Helpers\Builders;

class YearCalendarBuilder extends CalendarBuilder {

	public function getFirstDay(){

		$firstDay = '01-' . '01' . '-' . $this->getYear();

		return $firstDay;
	}

	public function getLastDay(){

		$lastDay = '31-' . '12' . '-' . $this->getYear();

		return $lastDay;
	}
}