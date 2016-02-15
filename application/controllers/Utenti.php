<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Utenti extends MY_Controller {
	
	public function elenco () {
		
		if (!$this->checkLevel(1)){ // controllo se loggato
			$this->session->set_userdata('nocons',1);
			redirect('login');
		}
		
		$this->session->set_userdata('dopo',current_url()); 
		
		$data['utente']=$this->session->utente;
		$utenti=$this->utenti_model->elencoUtenti();
		// var_dump ($utenti);
		$utenti ? $data['utenti']=$utenti : $data['utenti']="";
		
		$this->load->view('templates/header');
		$this->load->view('templates/menu',$data);
		$this->load->view('utenti/elenco',$data);
		$this->load->view('templates/footer');
		// altri js
		$this->load->view('utenti/js_elenco',$data);
		$this->load->view('templates/close');
		
		$this->session->unset_userdata('idlibro');
		$this->session->unset_userdata('fromsearch');
		
	}
	
	public function scheda ($id) {
		
		
		if (!$this->checkLevel(1)){ // controllo se loggato
			$this->session->set_userdata('nocons',1);
			redirect('login');
		}
		
		$this->session->set_userdata('dopo',current_url()); 
		
		if (empty($id)) redirect('libri/elenco'); // se $id non esiste torno a elenco
		
		$data['utente']=$this->session->utente;
		if (!$utente=$this->utenti_model->getUtente($id)) redirect('utenti/elenco');
		$data['infoutente']=$utente;
		$data['readonly']=$this->session->utente->livello < 3;
		$data['readonly'] ? $data['btn_col']=6 : $data['btn_col']=4;
		$data['select_livelli']=$this->select_model->selectItems('livelli');
		
		$this->load->view('templates/header');
		$this->load->view('templates/menu',$data);
		$this->load->view('utenti/scheda',$data);
		$this->load->view('templates/footer');
		// altri js
		// $this->load->view('utenti/js_scheda',$data);
		$this->load->view('templates/close');
		
		$this->session->unset_userdata('idlibro');
		$this->session->unset_userdata('fromsearch');
		
		
	}

	public function ajaxFetchUtenti() {
		
		/* recupero elenco utenti per autocomplete nella scheda nuovo prestito */
		
		/*
		if (!$this->checkLevel(0)){ // controllo se loggato
			$this->session->set_userdata('nocons',1);
			redirect('login');
		}
		*/
		 
		if (empty($this->input->get())) redirect('homepage');
		
		$this->output->enable_profiler(FALSE);
		
		$term=$this->input->get('term');
	
		$utenti=$this->utenti_model->getUtentiAutocomplete($term);
		echo json_encode($utenti);
		
	}
	
	public function ajaxFetchSingolo() {
		
		/* recupero dati dell'utente il cui nome è stato appena selezionato nell'autocomplete nella scheda nuovo prestito */
		
		/*
		if (!$this->checkLevel(0)){ // controllo se loggato
			$this->session->set_userdata('nocons',1);
			redirect('login');
		}
		*/
		
		if (empty($this->input->post())) redirect('homepage');
		
		$this->output->enable_profiler(FALSE);
		
		$id=$this->input->post('id');
		$utente=$this->utenti_model->getUserData($id);
		echo json_encode($utente);
		
	}
	
}
