<?php

namespace GDCalendar\Database\Migrations;

use GDCalendar\Models\Settings\Theme;

class CreateThemesTable
{

    public static function run()
    {
        global $wpdb;

	    $wpdb->query(
		    "CREATE TABLE IF NOT EXISTS " . $wpdb->prefix . "gdcalendarthemes(
                id int(11) unsigned NOT NULL AUTO_INCREMENT,
                name VARCHAR(255) NOT NULL,
                PRIMARY KEY(id)
            ) ENGINE=InnoDB"
	    );

        self::insertDefaultTheme();
    }

    private static function insertDefaultTheme()
    {
        global $wpdb;

        $rows = $wpdb->get_results('SELECT id FROM '.$wpdb->prefix.'gdcalendarthemes LIMIT 1');

        if(!empty($rows)){
            return;
        }

	    $defaultThemes = array(
		    1 => 'Default Theme',
		    2 => 'Burgundy',         // Theme 1
		    3 => 'Green',            // Theme 2
		    4 => 'Matt Purple',      // Theme 3
		    5 => 'Matt Blue',        // Theme 4
		    6 => 'Yellow',           // Theme 5
		    7 => 'Coral',            // Theme 6
		    8 => 'Orange',           // Theme 7
		    9 => 'Purple',           // Theme 8
		    10 => 'Scampi',           // Theme 9
		    11 => 'Light Matt Blue',  // Theme 10
		    12 => 'Turquoise',        // Theme 11
		    13 => 'Dark Matt Green',  // Theme 12
	    );

	    foreach ($defaultThemes as $defaultTheme){
		    $theme = new Theme();
		    $theme->set_name( $defaultTheme );
		    $theme->save();
	    }
    }

}