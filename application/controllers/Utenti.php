<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Utenti extends MY_Controller {
	
	public function elenco () {
		
		$this->session->set_userdata('dopo',current_url()); 
		
		if (!$this->checkLevel(1)){ // controllo se loggato
			$this->session->set_userdata('nocons',1);
			redirect('login');
		}
		
		$data['utente']=$this->session->utente;
		$utenti=$this->utenti_model->elencoUtenti();
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
		$this->session->unset_userdata('eliminautente');
		$this->session->unset_userdata('noeliminautente');
		
	}
	
	public function scheda ($id) {
			
		$this->session->set_userdata('dopo',current_url()); 
		
		if (!$this->checkLevel(1)){ // controllo se loggato
			$this->session->set_userdata('nocons',1);
			redirect('login');
		}
		
		if (empty($id)) redirect('libri/elenco'); // se $id non esiste torno a elenco
		
		$this->load->library('form_validation');		
	
		$this->form_validation->set_error_delimiters('<label class="text-danger">', '</label>');
				
		if ($this->form_validation->run('utente') !== FALSE) {
			$this->session->set_userdata('aggiornamento_utente',$this->input->post());
			redirect ("utenti/update");
		}
		
		$data['utente']=$this->session->utente;
		if (!$utente=$this->utenti_model->getUtente($id)) redirect('utenti/elenco');
		
		// gestione date
		$this->load->library('dates');
		$utente->last_login=$this->dates->convertDateTime($utente->last_login);

		$data['infoutente']=$utente;
		$data['readonly']=$this->session->utente->livello < 3;
		$data['readonly'] ? $data['btn_col']=6 : $data['btn_col']=4;
		$data['select_livelli']=$this->select_model->selectLivelli();
		
		$this->load->view('templates/header');
		$this->load->view('templates/menu',$data);
		$this->load->view('utenti/scheda',$data);
		$this->load->view('templates/footer');
		// altri js
		$this->load->view('utenti/js_scheda',$data);
		$this->load->view('templates/close');
		
		$this->session->unset_userdata('idlibro');
		$this->session->unset_userdata('fromsearch');
		$this->session->unset_userdata('updateutente');
		$this->session->unset_userdata('noupdateutente');
				
	}
	
	public function profilo () {
		
		$this->session->set_userdata('dopo',current_url());
		
		if (empty($this->session->utente->nome)) redirect('login');
		
		$data['utente']=$this->session->utente;
		
		$this->load->view('templates/header');
		$this->load->view('templates/menu',$data);
		$this->load->view('utenti/profilo',$data);
		$this->load->view('templates/footer');
		// altri js
		// $this->load->view('utenti/js_profilo',$data);
		$this->load->view('templates/close');
		
		$this->session->unset_userdata('idlibro');
		$this->session->unset_userdata('fromsearch');
		$this->session->unset_userdata('updateutente');
		$this->session->unset_userdata('noupdateutente');
		
	}
	
	public function nuovo () {
		
		$this->session->set_userdata('dopo',current_url()); 
		
		if (!$this->checkLevel(2)){ // controllo se loggato
			$this->session->set_userdata('nocons',1);
			redirect('login');
		}
		
		$this->load->library('form_validation');
					
		$this->form_validation->set_error_delimiters('<label class="text-danger">', '</label>');
		
		if ($this->form_validation->run('nuovoutente') !== FALSE) {
			// controllo se username già esiste
			$username=$this->input->post('username');
			if (!$this->utenti_model->checkUsername($username)){
				$this->session->set_userdata('nuovoutente',$this->input->post());
				redirect ("utenti/insert");
			}else{
				// username già esiste
				$this->session->set_flashdata('utenteesiste',$username);
			}
		}
		
		$data['utente']=$this->session->utente;
		$data['select_livelli']=$this->select_model->selectLivelli();
			
		$this->load->view('templates/header');
		$this->load->view('templates/menu',$data);
		$this->load->view('utenti/nuovo',$data);
		$this->load->view('templates/footer');
		// altri js
		$this->load->view('utenti/js_nuovo');
		$this->load->view('templates/close');
		
		$this->session->unset_userdata('idlibro');
		$this->session->unset_userdata('fromsearch');
		$this->session->unset_userdata('insertutente');
		$this->session->unset_userdata('noinsertutente');
		
	}
	
	public function insert () {
		
		if (!$this->checkLevel(2)){ // controllo se loggato
			$this->session->set_userdata('nocons',1);
			redirect('login');
		}
		
		if (!$this->session->nuovoutente) redirect ('homepage');
		
		$nuovoutente=$this->session->nuovoutente;
		$this->session->unset_userdata('nuovo_utente');
		$nuovoutente['password']=sha1('cambiami');
		if ($utente=$this->utenti_model->insertUtente($nuovoutente)){
			log_message("debug", "Nuovo utente inserito con id #".$utente.". Utente id #".$this->session->utente->id.". (utenti/insert)", LOGPREFIX);
			$this->session->set_userdata('insertutente',1);
		}else{
			log_message("error", "Errore inserimento nuovo utente. Utente id #".$this->session->utente->id.". (utenti/insert)", LOGPREFIX);
			$this->session->set_userdata('noinsertutente',1);
		}
		
		redirect ('utenti/nuovo');
		
	}
	
	public function update () {
		
		if (!$this->checkLevel(2)){ // controllo se loggato
			$this->session->set_userdata('nocons',1);
			redirect('login');
		}
		
		if (!$this->session->aggiornamento_utente) redirect ('homepage');
		
		$aggiornamento_utente=$this->session->aggiornamento_utente;
		$this->session->unset_userdata('aggiornamento_utente');
		
		if ($utente=$this->utenti_model->updateUtente($aggiornamento_utente)){
			log_message("debug", "Aggiornato utente con id #".$aggiornamento_utente['id'].". Utente id #".$this->session->utente->id.". (utenti/update)", LOGPREFIX);
			$this->session->set_userdata('updateutente',1);
		}else{
			log_message("error", "Errore aggiornamento utente con id #".$aggiornamento_utente['id'].". Utente id #".$this->session->utente->id.". (utenti/update)", LOGPREFIX);
			$this->session->set_userdata('noupdateutente',1);
		}

		redirect ('utenti/scheda/'.$aggiornamento_utente['id']);
		
	}
	
	public function delete($id) {
		
		if (!$this->checkLevel(2)){ // controllo se non loggato
			$this->session->set_userdata('nocons',1);
			redirect('login');
		}
		if (empty($id)) redirect('utenti/elenco'); // se $id non esiste torno a elenco
		
		if ($elimina=$this->utenti_model->eliminaUtente($id)){
			log_message("debug", "Eliminato utente con id #".$id.". Utente operatore id #".$this->session->utente->id.". (utenti/delete)", LOGPREFIX);
			$this->session->set_userdata('eliminautente',1);
		}else{
			log_message("error", "Errore eliminazione utente con id #".$id.". Utente operatore id #".$this->session->utente->id.". (utenti/delete)", LOGPREFIX);
			$this->session->set_userdata('noeliminautente',1);
		}
		redirect ('utenti/elenco');
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
