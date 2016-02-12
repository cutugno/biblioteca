<?php defined('BASEPATH') OR exit('No direct script access allowed');

Class Dates {


    public function __construct() {

    }

	public function convertDate ($date,$direction) {
		
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
	
	public function convertDateTime ($date,$clean=0,$direction=1,$sep=" ") {
		
		$expldate=explode(" ",$date);
		$date=$this->convertDate($expldate[0],$direction);
		if ($clean==0) $date.=$sep.$expldate[1];
		
		return $date;
		
	}
	
	public function dateDifference($date_1,$date_2,$differenceFormat='%a' ) {
		
		$datetime1 = new DateTime($date_1);
		$datetime2 = new DateTime($date_2);
		
		$interval = $datetime1->diff($datetime2);
		
		return $interval->format($differenceFormat);
		
	}
	
	
}
