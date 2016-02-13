<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Utenti extends MY_Controller {

	public function ajaxFetch() {
		
		/* recupero elenco utenti per autocomplete nella scheda nuovo prestito */
		
		if (!$this->checkLevel(0)){ // controllo se loggato
			redirect('login');
		}
		if (empty($this->input->get())) redirect('homepage');
		
		$this->output->enable_profiler(FALSE);
		
		$term=$this->input->get('term');
	
		$utenti=$this->utenti_model->getUtentiAutocomplete($term);
		echo json_encode($utenti);
		
	}
	
	public function ajaxFetchSingolo() {
		
		/* recupero dati dell'utente il cui nome è stato appena selezionato nell'autocomplete nella scheda nuovo prestito */
		
		if (!$this->checkLevel(0)){ // controllo se loggato
			redirect('login');
		}
		if (empty($this->input->post())) redirect('homepage');
		
		$this->output->enable_profiler(FALSE);
		
		$id=$this->input->post('id');
		$utente=$this->utenti_model->getUserData($id);
		echo json_encode($utente);
		
	}
	
}
