<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Libri extends MY_Controller {

	public function nuovo()	{
		
		if (!$this->checkLevel(0)){ // controllo se non loggato
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
		
		$this->session->unset_userdata('insertlibro');
		$this->session->unset_userdata('noinsertlibro');
	}
	
	public function insert() {
		
		if (!$this->checkLevel(0)){ // controllo se non loggato
			redirect('login');
		}
		
		$nuovo=$this->session->nuovo;
		$this->session->unset_userdata('nuovo');
		if ($libro=$this->libri_model->insertLibro($nuovo)){
			$this->session->set_userdata('insertlibro',1);
		}else{
			$this->session->set_userdata('noinsertlibro',1);
		}
		
		redirect ('libri/nuovo');
		
	}
	
	public function elenco() {
		
		if (!$this->checkLevel(0)){ // controllo se non loggato
			redirect('login');
		}
		
		$data['utente']=$this->session->utente;
		$data['libri']=$this->libri_model->elencoLibri();
		
		$this->load->view('templates/header');
		$this->load->view('templates/menu',$data);
		$this->load->view('libri/elenco',$data);
		$this->load->view('templates/footer');
		// altri js
		$this->load->view('libri/js_elenco',$data);
		$this->load->view('templates/close');
		
		$this->session->unset_userdata('eliminalibro');
		$this->session->unset_userdata('noeliminalibro');
		
	}
	
	public function scheda($id) {
		
		if (!$this->checkLevel(0)){ // controllo se non loggato
			redirect('login');
		}
		if (empty($id)) redirect('libri/elenco'); // se $id non esiste torno a elenco
		
		$this->load->library('form_validation');
	
		$this->form_validation->set_error_delimiters('<label class="text-danger">', '</label>');
				
		if ($this->form_validation->run('libro') !== FALSE) {
			$this->session->set_userdata('aggiornamento',$this->input->post());
			redirect ("libri/update");
		}
		
		if (!$this->checkLevel(0)){ // controllo se non loggato
			redirect('login');
		}
		
		$nuovo=$this->session->nuovo;
		$this->session->unset_userdata('nuovo');
		$libro=$this->libri_model->getLibro($id);
		
		$data['utente']=$this->session->utente;
		$data['select_local']=$this->select_model->selectItems("localizzazioni");
		$data['select_tipidoc']=$this->select_model->selectItems("tipidocumento");
		$data['select_generi']=$this->select_model->selectItems("generi");
		$data['libro']=$libro;	
		
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
		
		if (!$this->checkLevel(0)){ // controllo se non loggato
			redirect('login');
		}
		
		$aggiornamento=$this->session->aggiornamento;
		$this->session->unset_userdata('aggiornamento');

		if ($libro=$this->libri_model->updateLibro($aggiornamento)){
			$this->session->set_userdata('updatelibro',1);
		}else{
			$this->session->set_userdata('noupdatelibro',1);
		}

		redirect ('libri/scheda/'.$aggiornamento['id']);
		
	}
	
	public function delete($id) {
		
		if (!$this->checkLevel(0)){ // controllo se non loggato
			redirect('login');
		}
		if (empty($id)) redirect('libri/elenco'); // se $id non esiste torno a elenco
		
		if ($elimina=$this->libri_model->eliminaLibro($id)){
			$this->session->set_userdata('eliminalibro',1);
		}else{
			$this->session->set_userdata('noeliminalibro',1);
		}
		redirect ('libri/elenco');
	}
		
	
}
