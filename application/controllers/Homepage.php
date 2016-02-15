<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Homepage extends MY_Controller {
	
	public function index()	{
		
		if (!$this->checkLevel(0)){ // controllo se loggato
			$utente = new stdClass();
			$utente->livello=0;
			$this->session->set_userdata('utente',$utente);
		}
		
		$this->session->set_userdata('dopo',current_url());
		
		$this->load->library('form_validation');
	
		$this->form_validation->set_error_delimiters('<label class="text-danger">', '</label>');
				
		if ($this->form_validation->run($this->input->post('type')) !== FALSE) {
			$this->session->set_userdata('search',$this->input->post());
			log_message("info", "Effettuata ricerca. Criteri: ".json_encode($this->input->post()).". (search/index)", LOGPREFIX); 
			redirect ("search");
		}
		
		$data['utente']=$this->session->utente;	
		
		$data['select_local']=$this->select_model->selectItems("localizzazioni");
		$data['select_tipidoc']=$this->select_model->selectItems("tipidocumento");
		$data['select_argomenti']=$this->select_model->selectItems("argomenti");
		
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
		$this->session->unset_userdata('nocons');
		
	}
	
	
}
