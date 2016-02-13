<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search extends MY_Controller {
	
	public function index()	{
		
		if (!$this->checkLevel(0)){ // se utente non loggato entro lo stesso con livello = 0		
			$utente = new stdClass();
			$utente->livello=0;
			$this->session->set_userdata('utente',$utente);
		}
		
		if (empty($this->session->search['type'])) redirect('homepage');
		
		$this->session->set_userdata('fromsearch',1);
		$type=$this->session->search['type'];		
		switch ($type) {
			case "csemplice":
				$keyword=$this->session->search['keyword'];
				$risultati=$this->libri_model->searchLibriSemplice($keyword);
				break;
			case "cprestito":
				$codice=$this->session->search['codice'];
				$risultati=$this->prestiti_model->getPrestitoByCodice($codice);
				break;
		}
		
		$risultati ? $data['risultati']=$risultati : $data['risultati']="";
		//var_dump ($risultati);
		
		// info menu
		$data['utente']=$this->session->utente;
		
		$this->load->view('templates/header');
		$this->load->view('templates/menu',$data);
		$this->load->view('search/'.$type,$data);
		$this->load->view('templates/footer');
		// altri js
		$this->load->view('search/js_index',$data);
		$this->load->view('templates/close');
		
	}
	
}
