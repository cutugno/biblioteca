<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Libri extends MY_Controller {

	public function nuovo()	{
		
		if (!$this->checkLevel(1)){ // controllo se non loggato
			redirect('login');
		}
		
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
		$data['select_generi']=$this->select_model->selectItems("generi");
			
		$this->load->view('templates/header');
		$this->load->view('templates/menu',$data);
		$this->load->view('libri/nuovo',$data);
		$this->load->view('templates/footer');
		// altri js
		$this->load->view('libri/js_nuovo');
		$this->load->view('templates/close');
		
		$this->session->unset_userdata('idlibro');
		$this->session->unset_userdata('insertlibro');
		$this->session->unset_userdata('noinsertlibro');
	}
	
	public function insert() {
		
		if (!$this->checkLevel(1)){ // controllo se non loggato
			redirect('login');
		}
		
		$nuovo=$this->session->nuovo;
		$this->session->unset_userdata('nuovo');
		if ($libro=$this->libri_model->insertLibro($nuovo)){
			log_message("info", "Libro inserito con id #".$libro.". Utente id #".$this->session->utente->id.". (libri/insert)", LOGPREFIX);
			$this->session->set_userdata('prestitiinsertlibro',1);
		}else{
			log_message("error", "Errore inserimento libro. Utente id #".$this->session->utente->id.". (libri/insert)", LOGPREFIX);
			$this->session->set_userdata('noinsertlibro',1);
		}
		
		redirect ('libri/nuovo');
		
	}
	
	public function elenco() {
		
		if (!$this->checkLevel(1)){ // controllo se non loggato
			redirect('login');
		}
		
		$data['utente']=$this->session->utente;
		$data['libri']=$this->libri_model->elencoLibri();
		// info prestiti
		foreach ($data['libri'] as $key=>$val) {
			$id=$val->id;	
			$prestato=$this->prestiti_model->checkPrestito($id);
			$data['libri'][$key]->disp=$prestato ? 0 : 1;
		}

		$this->load->view('templates/header');
		$this->load->view('templates/menu',$data);
		$this->load->view('libri/elenco',$data);
		$this->load->view('templates/footer');
		// altri js
		$this->load->view('libri/js_elenco',$data);
		$this->load->view('templates/close');
		
		$this->session->unset_userdata('idlibro');
		$this->session->unset_userdata('eliminalibro');
		$this->session->unset_userdata('noeliminalibro');
		
	}
	
	public function scheda($id) {
		
		if (!$this->checkLevel(1)){ // controllo se non loggato
			redirect('login');
		}
		if (empty($id)) redirect('libri/elenco'); // se $id non esiste torno a elenco
		
		$this->session->set_userdata('idlibro',$id);
		
		$this->load->library('form_validation');
	
		$this->form_validation->set_error_delimiters('<label class="text-danger">', '</label>');
				
		if ($this->form_validation->run('libro') !== FALSE) {
			$this->session->set_userdata('aggiornamento',$this->input->post());
			redirect ("libri/update");
		}

		// info libro
		$libro=$this->libri_model->getLibro($id);
		$data['libro']=$libro;
		$data['select_local']=$this->select_model->selectItems("localizzazioni");
		$data['select_tipidoc']=$this->select_model->selectItems("tipidocumento");
		$data['select_generi']=$this->select_model->selectItems("generi");
		// info prestito
		if ($disp=$this->prestiti_model->checkPrestito($id)) {
			$prestito="";			
		}else{
			// non disponibile
			$prestito=$this->prestiti_model->getPrestito($id);
		}
		$data['disp']=$disp;
		$data['prestito']=$prestito;
		// info menu
		$data['utente']=$this->session->utente;
		
		$this->load->view('templates/header');
		$this->load->view('templates/menu',$data);
		$this->load->view('libri/scheda',$data);
		$this->load->view('templates/footer');
		// altri js
		$this->load->view('libri/js_scheda',$data);
		$this->load->view('templates/close');
		
		$this->session->unset_userdata('updatelibro');
		$this->session->unset_userdata('noupdatelibro');
		
	}
	
	public function update() {
		
		if (!$this->checkLevel(1)){ // controllo se non loggato
			redirect('login');
		}
		
		$aggiornamento=$this->session->aggiornamento;
		$this->session->unset_userdata('aggiornamento');

		if ($libro=$this->libri_model->updateLibro($aggiornamento)){
			log_message("info", "Aggiornato libro con id #".$aggiornamento['id'].". Utente id #".$this->session->utente->id.". (libri/update)", LOGPREFIX);
			$this->session->set_userdata('updatelibro',1);
		}else{
			log_message("error", "Errore aggiornamento libro con id #".$aggiornamento['id'].". Utente id #".$this->session->utente->id.". (libri/update)", LOGPREFIX);
			$this->session->set_userdata('noupdatelibro',1);
		}

		redirect ('libri/scheda/'.$aggiornamento['id']);
		
	}
	
	public function delete($id) {
		
		if (!$this->checkLevel(1)){ // controllo se non loggato
			redirect('login');
		}
		if (empty($id)) redirect('libri/elenco'); // se $id non esiste torno a elenco
		
		if ($elimina=$this->libri_model->eliminaLibro($id)){
			log_message("info", "Eliminato libro con id #".$id.". Utente id #".$this->session->utente->id.". (libri/delete)", LOGPREFIX);
			$this->session->set_userdata('eliminalibro',1);
		}else{
			log_message("error", "Errore eliminazione libro con id #".$id.". Utente id #".$this->session->utente->id.". (libri/delete)", LOGPREFIX);
			$this->session->set_userdata('noeliminalibro',1);
		}
		redirect ('libri/elenco');
	}
		
	public function ajaxFetch() {
		
		if (!$this->checkLevel(1)){ // controllo se loggato
			redirect('login');
		}
		if (empty($this->input->post())) return false;
		
		$this->output->enable_profiler(FALSE);
		
		$inv=$this->input->post('inventario');
		if ($libro=$this->libri_model->getLibroByInv($inv)){
			if (!$disp=$this->prestiti_model->checkPrestito($libro->id)) {
				echo json_encode($libro);
			}else{
				echo "no";
			}
		}else{
			echo "false";
		}
		
	}
	
}
