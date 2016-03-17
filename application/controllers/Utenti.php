<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Utenti extends MY_Controller {
	
	public function elenco () {
		
		$this->session->set_userdata('dopo',current_url()); 
		
		if (!$this->checkLevel(1)){ // controllo se loggato
			$this->session->set_userdata('nocons',1);
			redirect('login');
		}
		
		$data['connesso']=$this->connesso(); // controllo connessione per caricamento css e js esterni o locali
		
		$data['utente']=$this->session->utente;
		$utenti=$this->utenti_model->elencoUtenti();
		$utenti ? $data['utenti']=$utenti : $data['utenti']="";
		
		$this->load->view('templates/header',$data);
		$this->load->view('templates/menu',$data);
		$this->load->view('utenti/elenco',$data);
		$this->load->view('templates/footer',$data);
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
		
		if (empty($id)) redirect('utenti/elenco'); // se $id non esiste torno a elenco
	
		$data['connesso']=$this->connesso(); // controllo connessione per caricamento css e js esterni o locali
		
		$this->load->library('form_validation');		
	
		$this->form_validation->set_error_delimiters('<label class="text-danger">', '</label>');
				
		if ($this->form_validation->run('utente') !== FALSE) {
			$this->session->set_userdata('aggiornamento_utente',$this->input->post());
			redirect ("utenti/update");
		}
		
		$data['utente']=$this->session->utente; // utente loggato
		if (!$utente=$this->utenti_model->getUtente($id)) redirect('utenti/elenco');
		
		// gestione date
		$this->load->helper('date');
		$utente->last_login=convertDateTime($utente->last_login);

		$data['infoutente']=$utente; // utente della scheda
		$data['readonly']=$this->session->utente->livello < 3;
		$data['readonly'] ? $data['btn_col']=6 : $data['btn_col']=4;
		$data['select_livelli']=$this->select_model->selectLivelli();
		
		$this->load->view('templates/header',$data);
		$this->load->view('templates/menu',$data);
		$this->load->view('utenti/scheda',$data);
		$this->load->view('templates/footer',$data);
		// altri js
		$this->load->view('utenti/js_scheda',$data);
		$this->load->view('templates/close');
		
		$this->session->unset_userdata('idlibro');
		$this->session->unset_userdata('fromsearch');
		$this->session->unset_userdata('updateutente');
		$this->session->unset_userdata('noupdateutente');
		$this->session->unset_userdata('noutente');
				
	}
	
	public function profilo () {
		
		$this->session->set_userdata('dopo',current_url());
		
		if (empty($this->session->utente->nome)) redirect('login');
		
		$data['utente']=$this->session->utente;
		$data['connesso']=$this->connesso(); // controllo connessione per caricamento css e js esterni o locali
		
		$this->load->library('form_validation');		
	
		$this->form_validation->set_error_delimiters('<label class="text-danger">', '</label>');
				
		if ($this->form_validation->run('utente') !== FALSE) {
			$this->session->set_userdata('aggiornamento_profilo',$this->input->post());
			redirect ("utenti/update_profilo");
		}
		
		$this->load->view('templates/header',$data);
		$this->load->view('templates/menu',$data);
		$this->load->view('utenti/profilo',$data);
		$this->load->view('templates/footer',$data);
		// altri js
		$this->load->view('utenti/js_profilo',$data);
		$this->load->view('templates/close');
		
		$this->session->unset_userdata('idlibro');
		$this->session->unset_userdata('fromsearch');
		$this->session->unset_userdata('updateutente');
		$this->session->unset_userdata('noupdateutente');
		$this->session->unset_userdata('updateprofilo');
		$this->session->unset_userdata('noupdateprofilo');		
		
	}
	
	public function password () {
		
		$this->session->set_userdata('dopo',current_url());
		
		if (empty($this->session->utente->nome)) redirect('login');
		
		$this->load->library('form_validation');		
	
		$this->form_validation->set_error_delimiters('<label class="text-danger">', '</label>');
				
		if ($this->form_validation->run('password') !== FALSE) {

			$this->session->set_userdata('aggiornamento_password',$this->input->post());
			redirect ("utenti/update_password");
		}
		
		$data['utente']=$this->session->utente;
		$data['connesso']=$this->connesso(); // controllo connessione per caricamento css e js esterni o locali
		
		$this->load->view('templates/header',$data);
		$this->load->view('templates/menu',$data);
		$this->load->view('utenti/password',$data);
		$this->load->view('templates/footer',$data);
		// altri js
		$this->load->view('utenti/js_password',$data);
		$this->load->view('templates/close');
		
		$this->session->unset_userdata('idlibro');
		$this->session->unset_userdata('fromsearch');
		$this->session->unset_userdata('updatepassword');
		$this->session->unset_userdata('noupdatepassword');
		
	}
	
	public function nuovo () {
		
		$this->session->set_userdata('dopo',current_url()); 
		
		if (!$this->checkLevel(2)){ // controllo se loggato
			$this->session->set_userdata('nocons',1);
			redirect('login');
		}
				
		$data['utente']=$this->session->utente;
		$data['select_livelli']=$this->select_model->selectLivelli();			
		$data['connesso']=$this->connesso(); // controllo connessione per caricamento css e js esterni o locali
		
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

		$this->load->view('templates/header',$data);
		$this->load->view('templates/menu',$data);
		$this->load->view('utenti/nuovo',$data);
		$this->load->view('templates/footer',$data);
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
		
		$data['connesso']=$this->connesso(); // controllo connessione per caricamento css e js esterni o locali
		
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
	
	public function update_profilo () {
		
		if (!$this->session->aggiornamento_profilo) redirect ('homepage');
		
		$aggiornamento_profilo=$this->session->aggiornamento_profilo;
		$this->session->unset_userdata('aggiornamento_profilo');

		if ($profilo=$this->utenti_model->updateProfile($aggiornamento_profilo)) {
			// aggiorno sessione utente
			$this->session->unset_userdata('utente');
			$datiutente=$this->utenti_model->getUserData($aggiornamento_profilo['id']);
			$this->session->set_userdata('utente',$datiutente);
		
			log_message("debug", "Aggiornato profilo utente con id #".$aggiornamento_profilo['id'].". (utenti/update_profilo)", LOGPREFIX);
			$this->session->set_userdata('updateprofilo',1);
		}else{
			log_message("error", "Errore aggiornamento profilo utente con id #".$aggiornamento_profilo['id'].". (utenti/update)", LOGPREFIX);
			$this->session->set_userdata('noupdateprofilo',1);
		}

		redirect ('profilo');
		
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
	
	public function update_password () {
		
		if (!$this->checkLevel(2)){ // controllo se loggato
			$this->session->set_userdata('nocons',1);
			redirect('login');
		}
		
		if (!$this->session->aggiornamento_password) redirect ('homepage');
		
		$aggiornamento_password=$this->session->aggiornamento_password;
		$this->session->unset_userdata('aggiornamento_password');
		
		//aggiungo id utente
		$aggiornamento_password['id']=$this->session->utente->id;		
		
		if ($password=$this->utenti_model->updatePassword($aggiornamento_password)) {
			// aggiorno sessione utente
			$this->session->unset_userdata('utente');
			$datiutente=$this->utenti_model->getUserData($aggiornamento_password['id']);
			$this->session->set_userdata('utente',$datiutente);
			
			log_message("debug", "Aggiornata password utente con id #".$aggiornamento_password['id']."(utenti/update_password)", LOGPREFIX);
			$this->session->set_userdata('updatepassword',1);
		}else{
			log_message("debug", "Errore aggiornamento password utente con id #".$aggiornamento_password['id'].". (utenti/update_password)", LOGPREFIX);
			$this->session->set_userdata('noupdatepassword',1);
		}	

		redirect ('modifica-password');
		
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
	
	public function contatta($id) {
		
		if (empty($id)) redirect($this->session->dopo); // se $id non esiste torno da dove sto venendo
				
		if (!$this->checkLevel(0)){ // controllo se loggato
			$this->session->set_userdata('nocons',1);
			redirect('login');
		}
		
		$this->load->library('form_validation');		
	
		$this->form_validation->set_error_delimiters('<label class="text-danger">', '</label>');
								
		if ($this->form_validation->run('contatta') !== FALSE) {
			
			/* str_replace messaggio dopo validazione
			 * 	$rcosa=array('"');
			 *	$rcon=array('\"');
			*/

			$this->session->set_userdata('contatta_utente',$this->input->post());
			redirect ("utenti/invia_messaggio");
		}
		
		
				
		$data['utente']=$this->session->utente;
		$data['connesso']=$this->connesso(); // controllo connessione per caricamento css e js esterni o locali
		$data['torna_url']=$this->session->dopo;
		$data['torna_txt']="Torna alla scheda";		
		
		$this->session->set_userdata('dopo',current_url()); 
		
		if (!$infoutente=$this->utenti_model->getUtente($id)){
			$this->session->set_userdata('noutente',1);
			redirect($data['torna_url']);
		}
		$data['infoutente']=$infoutente;
		
		$this->load->view('templates/header',$data);
		$this->load->view('templates/menu',$data);
		$this->load->view('utenti/contatta',$data);
		$this->load->view('templates/footer',$data);
		// altri js
		$this->load->view('utenti/js_contatta');
		$this->load->view('templates/close');
		
	}
	
	public function invia_messaggio() {
			
		if (!$this->checkLevel(0)){ // controllo se loggato
			$this->session->set_userdata('nocons',1);
			redirect('login');
		}
		
		if (!$this->session->contatta_utente) redirect ('homepage');
		
		$contatta_utente=$this->session->contatta_utente;
		$this->session->unset_userdata('contatta_utente');
		
		// invia mail a utente
		
		// redirect ('utenti/contatta/'.$contatta_utente['id'])
		
	}
	
}
