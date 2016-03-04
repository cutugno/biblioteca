<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Libri extends MY_Controller {

	public function nuovo()	{
		
		$this->session->set_userdata('dopo',current_url());
		
		if (!$this->checkLevel(1)){ // controllo se non loggato
			$this->session->set_userdata('nocons',1);
			redirect('login');
		}
		
		$data['connesso']=$this->connesso(); // controllo connessione per caricamento css e js esterni o locali
				
		$this->load->library('form_validation');
					
		$this->form_validation->set_error_delimiters('<label class="text-danger">', '</label>');
		
		if ($this->form_validation->run('libro') !== FALSE) {
			// controllo se inventario già esiste
			$inv=$this->input->post('inventario');
			if (!$this->libri_model->checkInventario($inv)){
				$this->session->set_userdata('nuovo',$this->input->post());
				redirect ("libri/insert");
			}else{
				// inventario già esiste
				$this->session->set_flashdata('invesiste',$inv);
			}
		}
		
		$data['utente']=$this->session->utente;
		$data['select_local']=$this->select_model->selectItems("localizzazioni");
		$data['select_tipidoc']=$this->select_model->selectItems("tipidocumento");
		$data['select_argomenti']=$this->select_model->selectItems("argomenti");
			
		$this->load->view('templates/header',$data);
		$this->load->view('templates/menu',$data);
		$this->load->view('libri/nuovo',$data);
		$this->load->view('templates/footer',$data);
		// altri js
		$this->load->view('libri/js_nuovo');
		$this->load->view('templates/close');
		
		$this->session->unset_userdata('idlibro');
		$this->session->unset_userdata('insertlibro');
		$this->session->unset_userdata('noinsertlibro');
		$this->session->unset_userdata('fromsearch');
	}
	
	public function insert() {
		
		if (!$this->checkLevel(1)){ // controllo se non loggato
			$this->session->set_userdata('nocons',1);
			redirect('login');
		}
		
		if (!$this->session->nuovo) redirect ('homepage');
		
		$nuovo=$this->session->nuovo;
		$this->session->unset_userdata('nuovo');
		if ($libro=$this->libri_model->insertLibro($nuovo)){
			log_message("debug", "Libro inserito con id #".$libro.". Utente id #".$this->session->utente->id.". (libri/insert)", LOGPREFIX);
			$this->session->set_userdata('insertlibro',1);
		}else{
			log_message("error", "Errore inserimento libro. Utente id #".$this->session->utente->id.". (libri/insert)", LOGPREFIX);
			$this->session->set_userdata('noinsertlibro',1);
		}
		
		redirect ('libri/nuovo');
		
	}
	
	public function elenco() {
		
		if (!$this->checkLevel(0)){ // se utente non loggato entro lo stesso con livello = 0		
			$utente = new stdClass();
			$utente->livello=0;
			$this->session->set_userdata('utente',$utente);
		}
		
		$this->session->set_userdata('dopo',current_url()); 
		
		$data['utente']=$this->session->utente;
		$libri=$this->libri_model->elencoLibri();
		$libri ? $data['libri']=$libri : $data['libri']="";
		
		$this->load->view('templates/header',$data);
		$this->load->view('templates/menu',$data);
		$this->load->view('libri/elenco',$data);
		$this->load->view('templates/footer',$data);
		// altri js
		$this->load->view('libri/js_elenco',$data);
		$this->load->view('templates/close');
		
		$this->session->unset_userdata('idlibro');
		$this->session->unset_userdata('eliminalibro');
		$this->session->unset_userdata('noeliminalibro');
		$this->session->unset_userdata('fromsearch');
		
	}
	
	public function scheda($id) {
		
		if (!$this->checkLevel(0)){
			$utente = new stdClass();
			$utente->livello=0;
			$this->session->set_userdata('utente',$utente);
		}		
		
		if (empty($id)) redirect('libri/elenco'); // se $id non esiste torno a elenco
		
		$this->session->set_userdata('idlibro',$id); // mi serve se da qui passo alla scheda prestito
		$this->session->set_userdata('dopo',current_url()); 
		
		$this->load->library('form_validation');
	
		$this->form_validation->set_error_delimiters('<label class="text-danger">', '</label>');
				
		if ($this->form_validation->run('libro') !== FALSE) {
			$this->session->set_userdata('aggiornamento',$this->input->post());
			redirect ("libri/update");
		}

		$this->load->library('dates');
		
		// info libro
		$libro=$this->libri_model->getLibro($id);
		$data['libro']=$libro;
		$data['select_local']=$this->select_model->selectItems("localizzazioni");
		$data['select_tipidoc']=$this->select_model->selectItems("tipidocumento");
		$data['select_argomenti']=$this->select_model->selectItems("argomenti");
		
		// info prestito
		$prestito=$this->prestiti_model->getPrestitoByIdlibro ($id);
		
		// gestione date
		if ($prestito) {
			$prestito->data_prestito=$this->dates->convertDateTime($prestito->data_prestito,1);
			$prestito->data_reso ? $prestito->data_reso=$this->dates->convertDateTime($prestito->data_reso,1) : $prestito->data_reso="";
		}
		
		$data['prestito']=$prestito;
		
		// info menu
		$data['utente']=$this->session->utente;
		
		$data['readonly']=$this->session->utente->livello > 0;		
		
		$this->load->view('templates/header',$data);
		$this->load->view('templates/menu',$data);
		$this->load->view('libri/scheda',$data);
		$this->load->view('templates/footer',$data);
		// altri js
		$this->load->view('libri/js_scheda',$data);
		$this->load->view('templates/close');
		
		$this->session->unset_userdata('updatelibro');
		$this->session->unset_userdata('noupdatelibro');
		$this->session->unset_userdata('registratoreso');
		$this->session->unset_userdata('noregistratoreso');
		
	}
	
	public function update() {
		
		if (!$this->checkLevel(1)){ // controllo se non loggato
			$this->session->set_userdata('nocons',1);
			redirect('login');
		}
		
		if (!$this->session->aggiornamento) redirect ('homepage');
		
		$aggiornamento=$this->session->aggiornamento;
		$this->session->unset_userdata('aggiornamento');

		if ($libro=$this->libri_model->updateLibro($aggiornamento)){
			log_message("debug", "Aggiornato libro con id #".$aggiornamento['id'].". Utente id #".$this->session->utente->id.". (libri/update)", LOGPREFIX);
			$this->session->set_userdata('updatelibro',1);
		}else{
			log_message("error", "Errore aggiornamento libro con id #".$aggiornamento['id'].". Utente id #".$this->session->utente->id.". (libri/update)", LOGPREFIX);
			$this->session->set_userdata('noupdatelibro',1);
		}

		redirect ('libri/scheda/'.$aggiornamento['id']);
		
	}
	
	public function delete($id) {
		
		if (!$this->checkLevel(1)){ // controllo se non loggato
			$this->session->set_userdata('nocons',1);
			redirect('login');
		}
		if (empty($id)) redirect('libri/elenco'); // se $id non esiste torno a elenco
		
		if ($elimina=$this->libri_model->eliminaLibro($id)){
			log_message("debug", "Eliminato libro con id #".$id.". Utente id #".$this->session->utente->id.". (libri/delete)", LOGPREFIX);
			$this->session->set_userdata('eliminalibro',1);
		}else{
			log_message("error", "Errore eliminazione libro con id #".$id.". Utente id #".$this->session->utente->id.". (libri/delete)", LOGPREFIX);
			$this->session->set_userdata('noeliminalibro',1);
		}
		redirect ('libri/elenco');
	}
		
	public function ajaxFetchLibro() {
		
		/* recupero dati del libro il cui inventario è stato appena digitato nella scheda nuovo prestito */
		
		/*
		if (!$this->checkLevel(0)){ // controllo se loggato
			$this->session->set_userdata('nocons',1);
			redirect('login');
		}
		*/
		 
		if (empty($this->input->post())) return false;
		
		$this->output->enable_profiler(FALSE);
		
		$inv=$this->input->post('inventario');
		if ($libro=$this->libri_model->getLibroByInv($inv)){
			if ($libro->disp==1) {
				echo json_encode($libro); // libro disponibile
			}else{
				echo "no"; // non disponibile
			}
		}else{
			echo "false"; // inventario inesistente
		}
		
	}
	
	public function ajaxFetchInventario() {
		
		/* conto libri in db con id_localizzazione in post e genero nuovo inventario */
		
		/*
		if (!$this->checkLevel(0)){ // controllo se loggato
			$this->session->set_userdata('nocons',1);
			redirect('login');
		}
		*/
		
		if (empty($this->input->post())) return false;
		
		$this->output->enable_profiler(FALSE);
		
		$info=$this->libri_model->getLocalizzazioneInfo($this->input->post('id_local'));		
		$prefisso=$info->prefisso;		
		$quantita=$info->quantita;
		$quantita++;
		$cod="";
		for ($x=1;$x<=CODI-strlen($quantita);$x++){
			$cod.="0";
		}
		$codinv=$prefisso.$cod.$quantita;
		
		echo $codinv;
	
	}
	
}
