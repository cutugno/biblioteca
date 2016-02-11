<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Utenti extends MY_Controller {

	public function ajaxFetch() {
		
		if (!$this->checkLevel(1)){ // controllo se loggato
			redirect('login');
		}
		if (empty($this->input->get())) redirect('homepage');
		
		$this->output->enable_profiler(FALSE);
		
		$term=$this->input->get('term');
	
		$utenti=$this->utenti_model->getUtentiAutocomplete($term);
		echo json_encode($utenti);
		
	}
	
	public function ajaxFetchSingolo() {
		
		if (!$this->checkLevel(1)){ // controllo se loggato
			redirect('login');
		}
		if (empty($this->input->post())) redirect('homepage');
		
		$this->output->enable_profiler(FALSE);
		
		$id=$this->input->post('id');
		$utente=$this->utenti_model->getUserData($id);
		echo json_encode($utente);
		
	}
	
}
