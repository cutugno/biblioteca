<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Homepage extends MY_Controller {
	
	public function index()	{
		
		if ($this->checkLevel(0)){ // controllo se loggato
			$utente=$this->session->utente;
		}else{
			$utente = new stdClass();
			$utente->livello=0;
		}
		
		$this->session->set_userdata('dopo',current_url());
		
		$data['utente']=$utente;		
		
		$this->load->view('templates/header');
		$this->load->view('templates/menu',$data);
		$this->load->view('homepage/index');
		$this->load->view('templates/footer');
		// altri js
		$this->load->view('templates/close');
	}
	
}
