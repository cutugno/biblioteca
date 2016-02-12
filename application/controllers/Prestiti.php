<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Prestiti extends MY_Controller {

	public function nuovo()	{
		
		$this->session->set_userdata('dopo',current_url());
		
		if (!$this->checkLevel(0)){ // controllo se loggato
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
				//$datiutente['livello']=1;
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
		$count ? $count=substr($count,-1) : $count=0;
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
				
	}
	
	public function insertP() {
		
		if (!$this->checkLevel(0)){ // controllo se non loggato
			redirect('login');
		}
		
		$prestito=$this->session->nuovop;
		$this->session->unset_userdata('nuovop');
		
		if ($id_prestito=$this->prestiti_model->insertPrestito($prestito)) { // $ ins è id prestito appena inserito
			// update disponibilità libro=0
			$this->libri_model->toggleDisp($prestito['id_libro'],0);
			$this->session->set_userdata('insertprestito',1);
			log_message("debug", "Inserito prestito con id #".$id_prestito.". Utente con id #".$id_utente.". (prestiti/nuovo)", LOGPREFIX);
		}else{
			$this->session->set_userdata('noinsertprestito',1);
			log_message("error", "Errore nell'inserimento prestito libro con id #".$prestito['id_libro'].". Utente con id #".$id_utente.". (prestiti/nuovo)", LOGPREFIX);
		}
		redirect ('prestiti/scheda/'.$id_prestito);
		
	}
	
	public function reso($id) {
		
		if (!$this->checkLevel(0)){ // controllo se loggato
			redirect('login');
		}
		
		if (empty($id)) redirect('prestiti/elenco'); // se $id non esiste torno a elenco
		
		// query reso
		if ($this->prestiti_model->registraReso($id)){
			$this->session->set_userdata('registratoreso',1);
		}else{
			$this->session->set_userdata('noregistratoreso',1);
			$redir="prestiti/scheda/".$id;
		}
		
		// redirect
		if (empty($redir)){
			$redir=$this->session->dopo;
			$this->session->unset_userdata('dopo');
		}
		redirect($redir);

	}
	
	public function elenco() {
		
		$this->session->set_userdata('dopo',current_url());
	
		if (!$this->checkLevel(0)){ // controllo se loggato
			redirect('login');
		}		
		
		$prestiti=$this->prestiti_model->elencoPrestiti();
		$this->load->library('dates');
		foreach ($prestiti as $key=>$val){
			// gestione date e giorni passati
			$adesso=date("Y-m-d", time());
			if (null != $val->data_prestito) {
				$prestito=explode(" ",$val->data_prestito);
				$prestito=$prestito[0];
				$prestiti[$key]->diff_prestito=$this->dates->dateDifference($adesso,$prestito);
				$prestiti[$key]->data_prestito=$this->dates->convertDateTime($val->data_prestito,1);
			}			
			if (null != $val->data_reso) {
				$reso=explode(" ",$val->data_reso);
				$reso=$reso[0];
				$prestiti[$key]->diff_reso=$this->dates->dateDifference($adesso,$reso);
				$prestiti[$key]->data_reso=$this->dates->convertDateTime($val->data_reso,1);				
			}
		}
		$data['utente']=$this->session->utente;
		$data['prestiti']=$prestiti;
		
		$this->load->view('templates/header');
		$this->load->view('templates/menu',$data);
		$this->load->view('prestiti/elenco',$data);
		$this->load->view('templates/footer');
		// altri js
		$this->load->view('prestiti/js_elenco');
		$this->load->view('templates/close');
		
		$this->session->unset_userdata('idlibro');
		$this->session->unset_userdata('registratoreso');
		$this->session->unset_userdata('noregistratoreso');
		
	}
	
	public function scheda($id) {
		
		$this->session->set_userdata('dopo',current_url()); 
		
		if (!$this->checkLevel(0)){ // controllo se loggato
			redirect('login');
		}
		if (empty($id)) redirect('prestiti/elenco'); // se $id non esiste torno a elenco	
		
		$this->load->library('dates');
				
		// info prestito
		$prestito=$this->prestiti_model->getPrestito($id);
		
		// gestione date
		$prestito->data_prestito=$this->dates->convertDateTime($prestito->data_prestito);
		$prestito->data_reso ? $prestito->data_reso=$this->dates->convertDateTime($prestito->data_reso) : $prestito->data_reso="";
		
		$data['prestito']=$prestito;

		// info menu
		$data['utente']=$this->session->utente;
		
		$this->load->view('templates/header');
		$this->load->view('templates/menu',$data);
		$this->load->view('prestiti/scheda',$data);
		$this->load->view('templates/footer');
		// altri js
		$this->load->view('prestiti/js_scheda',$data);
		$this->load->view('templates/close');
		
		$this->session->unset_userdata('idlibro');
		$this->session->unset_userdata('insertprestito');
		$this->session->unset_userdata('noinsertprestito');
		$this->session->unset_userdata('registratoreso');
		$this->session->unset_userdata('noregistratoreso');
		
	}
	
}
