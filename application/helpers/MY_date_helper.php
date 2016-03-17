<?php
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2014 - 2016, British Columbia Institute of Technology
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package	CodeIgniter
 * @author	EllisLab Dev Team
 * @copyright	Copyright (c) 2008 - 2014, EllisLab, Inc. (https://ellislab.com/)
 * @copyright	Copyright (c) 2014 - 2016, British Columbia Institute of Technology (http://bcit.ca/)
 * @license	http://opensource.org/licenses/MIT	MIT License
 * @link	https://codeigniter.com
 * @since	Version 1.0.0
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CodeIgniter Date Helpers
 *
 * @package		CodeIgniter
 * @subpackage	Helpers
 * @category	Helpers
 * @author		EllisLab Dev Team
 * @link		https://codeigniter.com/user_guide/helpers/date_helper.html
 */

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
