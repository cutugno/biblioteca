<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Homepage extends MY_Controller {
	
	public function index()	{
		
		if ($this->checkLevel(0)){ // controllo se loggato
			$utente=$this->session->utente;
		}else{
			$utente = new stdClass();
			$utente->livello=0;
			$this->session->utente=$utente;
		}
		
		$this->session->set_userdata('dopo',current_url());
		
		$this->load->library('form_validation');
	
		$this->form_validation->set_error_delimiters('<label class="text-danger">', '</label>');
				
		if ($this->form_validation->run($this->input->post('type')) !== FALSE) {
			$this->session->set_userdata('search',$this->input->post());
			redirect ("search");
		}
		
		$data['utente']=$utente;	
		
		// controllo tab attivo all'ingresso
		$data['activelibro']=$data['activeprestito']="";
		switch ($this->input->post('type')) {
			case "cprestito":
				$data['activeprestito']="active ";
				break;
			default:
				$data['activelibro']="active ";
				break;
		}
		
		$this->load->view('templates/header');
		$this->load->view('templates/menu',$data);
		$this->load->view('homepage/index');
		$this->load->view('templates/footer');
		// altri js
		$this->load->view('homepage/js_index');
		$this->load->view('templates/close');
		
		$this->session->unset_userdata('idlibro');
		$this->session->unset_userdata('fromsearch');
	}
	
	
}
