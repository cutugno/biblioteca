<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Email extends CI_Email {
	
	public function sendMail ($mailview,$data,$destinatario,$subject) {
		
		/* $mailview: view con template email da caricare
		 * $data: dati necessari per rimepire il template
		 * $destinatario: indirizzo email del destinatario della mail
		 * $subject: soggetto della mail
		 */
		  
		$CI =& get_instance();
		$CI->load->library('email'); // libreria estesa con funzione sendMail
		
		$CI->config->load('email',TRUE); // file config application/config/email.php
		$email_config = $CI->config->item('email');

		$message=$CI->load->view($email_config['email_templates_folder'].$mailview,$data,TRUE);		
		$from = $email_config['sender_confirm_address'];
		$from_name = $email_config['sender_confirm_name'];
		
		$CI->email->from($from, $from_name);
		$CI->email->to($destinatario);
		$CI->email->subject($subject);
		$CI->email->message($message);
		
		return $CI->email->send();
	}

}
