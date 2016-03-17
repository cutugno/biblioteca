<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// ------------------------------------------------------------------------

if ( ! function_exists('convertDate')) {

	function convertDate ($date,$direction) {
		
		switch ($direction){
			case 1: // da db a visualizzazione
				$del1="-";
				$del2="/";
				break;
			case 2: // da visualizzazione a db
				$del1="/";
				$del2="-";
				break;
		}
		$date=explode($del1,$date);
		$date=$date[2].$del2.$date[1].$del2.$date[0];
		
		return $date;
				
	}
	
}

if ( ! function_exists('convertDateTime')) {

	function convertDateTime ($date,$clean=0,$direction=1,$sep=" ") {
		
		$expldate=explode(" ",$date);
		$date=convertDate($expldate[0],$direction);
		if ($clean==0) $date.=$sep.$expldate[1];
		
		return $date;
		
	}

}

if ( ! function_exists('dateDifference')) {
	
	function dateDifference($date_1,$date_2,$differenceFormat='%a' ) {
		
		$datetime1 = new DateTime($date_1);
		$datetime2 = new DateTime($date_2);
		
		$interval = $datetime1->diff($datetime2);
		
		return $interval->format($differenceFormat);
		
	}
	
}

if ( ! function_exists('currentDateTime')) {
	
	function currentDateTime($datestring="%d.%m.%Y-%H.%i.%s") {
		
		$CI =& get_instance();
		
		$CI->load->helper('date');
		return mdate($datestring, time());
		
	}
	
}

// ------------------------------------------------------------------------
