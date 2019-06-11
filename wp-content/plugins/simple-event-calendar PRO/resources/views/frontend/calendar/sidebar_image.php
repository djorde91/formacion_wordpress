<?php
/**
 * Calendar Month Sidebar Image Generator
 * @var $currentMonthName
 * @var $currentMonthImage
 */
    switch ($currentMonthName){
        case 'January':
            $currentMonthImage = 'january_image';
            break;
        case 'February':
            $currentMonthImage = 'february_image';
            break;
        case 'March':
            $currentMonthImage = 'march_image';
            break;
        case 'April':
            $currentMonthImage = 'april_image';
            break;
        case 'May':
            $currentMonthImage = 'may_image';
            break;
        case 'June':
            $currentMonthImage = 'june_image';
            break;
        case 'July':
            $currentMonthImage = 'july_image';
            break;
        case 'August':
            $currentMonthImage = 'august_image';
            break;
        case 'September':
            $currentMonthImage = 'september_image';
            break;
        case 'October':
            $currentMonthImage = 'october_image';
            break;
        case 'November':
            $currentMonthImage = 'november_image';
            break;
        case 'December':
            $currentMonthImage = 'december_image';
            break;
    }

    echo $currentMonthImage;
