<?php

namespace GDCalendar\Database\Migrations;

use GDCalendar\Models\Settings\ThemeSettings;

class DeleteThemeSettingTable extends ThemeSettings {

	public static function run(){
		self::deleteDefaultThemeSettings();
	}

	private static function deleteDefaultThemeSettings(){

		global $wpdb;

		$wpdb->query( "DELETE FROM " . self::getTableName() . " WHERE theme_option_key = 'active_view_active_bg_color' " );

	}

}