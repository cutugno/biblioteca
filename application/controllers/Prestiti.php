<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Prestiti extends MY_Controller {

	public function nuovo()	{
		
		if (!$this->checkLevel(1)){ // controllo se loggato
			redirect('login');
		}
				
		$this->load->library('form_validation');
		
		$this->form_validation->set_error_delimiters('<label class="text-danger">', '</label>');
		
		if ($this->form_validation->run('prestito') !== FALSE) {
			// inserimento/update utente
			if ($this->input->post('id_utente')!=""){
				$id_utente=$this->input->post('id_utente');
				$datiutente['id']=$id_utente;
				$datiutente['nome']=$this->input->post('nome');
				$datiutente['classe']=$this->input->post('classe');
				$datiutente['email']=$this->input->post('email');
				if ($this->utenti_model->updateUtente($datiutente)) {
					log_message("debug", "Aggiornato utente con id #".$id_utente.". (prestiti/nuovo)", LOGPREFIX);
				}
			}else{
				$datiutente['nome']=$this->input->post('nome');
				$datiutente['classe']=$this->input->post('classe');
				$datiutente['email']=$this->input->post('email');
				$datiutente['livello']=1;
				$id_utente=$this->utenti_model->insertUtente($datiutente);
				log_message("debug", "Inserito utente con id #".$id_utente.". (prestiti/nuovo)", LOGPREFIX);
			}
			
			$prestito['codice']=$this->input->post('codice');
			$prestito['id_libro']=$this->input->post('id_libro');
			null !== $this->input->post('comodato') ? $prestito['comodato']=$this->input->post('comodato') : $prestito['comodato']="0";
			$prestito['note_prestito']=$this->input->post('note_prestito');
			$prestito['id_utente']=$id_utente;			
			$this->session->set_userdata('nuovop',$prestito);
			redirect ("prestiti/insertP");
		}

		$idlibro=$this->session->idlibro;
		if (isset($idlibro)){ // vengo da scheda libro
			$prestito=$this->libri_model->getLibro($idlibro);
			$data['prestito']=$prestito;
		}else{
			$data['prestito']=NULL;
		}
		
		// setto cod. prestito
		$count=$this->prestiti_model->lastPrestito(); // ultimo codice
		$count=substr($count,-1);
		$count++;
		$cod="";
		for ($x=1;$x<=CODL-strlen($count);$x++){
			$cod.="0";
		}
		$data['cod_prestito']=$cod.$count;

		$data['utente']=$this->session->utente;
		
		$this->load->view('templates/header');
		$this->load->view('templates/menu',$data);
		$this->load->view('prestiti/nuovo',$data);
		$this->load->view('templates/footer');
		// altri js
		$this->load->view('prestiti/js_nuovo');
		$this->load->view('templates/close');
		
		$this->session->unset_userdata('idlibro');
		$this->session->unset_userdata('insertprestito');
		$this->session->unset_userdata('noinsertprestito');
	}
	
	public function insertP() {
		
		if (!$this->checkLevel(1)){ // controllo se non loggato
			redirect('login');
		}
		
		$prestito=$this->session->nuovop;
		$this->session->unset_userdata('nuovop');
		
		if ($id_prestito=$this->prestiti_model->insertPrestito($prestito)) { // $ ins è id prestito appena inserito
			$this->session->set_userdata('insertprestito',1);
			log_message("debug", "Inserito prestito con id #".$id_prestito.". Utente con id #".$id_utente.". (prestiti/nuovo)", LOGPREFIX);
		}else{
			$this->session->set_userdata('noinsertprestito',1);
			log_message("error", "Errore nell'inserimento prestito libro con id #".$prestito['id_libro'].". Utente con id #".$id_utente.". (prestiti/nuovo)", LOGPREFIX);
		}
		redirect ('prestiti/nuovo');
		
	}
	
	public function reso() {
		
		if (!$this->checkLevel(1)){ // controllo se loggato
			redirect('login');
		}
		
		$data['utente']=$this->session->utente;
		
		$this->load->view('templates/header');
		$this->load->view('templates/menu',$data);
		$this->load->view('prestiti/reso');
		$this->load->view('templates/footer');
		// altri js
		$this->load->view('templates/close');
		
		$this->session->unset_userdata('idlibro');
	}
	
	public function elenco() {
		
		if (!$this->checkLevel(1)){ // controllo se loggato
			redirect('login');
		}
		
		$data['utente']=$this->session->utente;
		$data['prestiti']=$this->prestiti_model->elencoPrestiti();
		
		$this->load->view('templates/header');
		$this->load->view('templates/menu',$data);
		$this->load->view('prestiti/elenco',$data);
		$this->load->view('templates/footer');
		// altri js
		$this->load->view('prestiti/js_elenco');
		$this->load->view('templates/close');
		
		$this->session->unset_userdata('idlibro');
	}
	
}
