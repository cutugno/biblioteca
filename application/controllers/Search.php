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
		
		$data['connesso']=$this->connesso(); // controllo connessione per caricamento css e js esterni o locali
		
		$this->session->set_userdata('fromsearch',1);
		$type=$this->session->search['type'];		
		switch ($type) {
			case "csemplice":
				$keywords=explode(" ",$this->session->search['keyword']);
				$risultati=$this->libri_model->searchLibriSemplice($keywords);
				break;
			case "cprestito":
				$codice=$this->session->search['codice'];
				$risultati=$this->prestiti_model->getPrestitoByCodice($codice); // risultati in realtà è un singolo record
				$this->load->library('dates');
				// gestione date e giorni passati
				$adesso=date("Y-m-d", time());
				if (null != $risultati->data_prestito) {
					$prestito=explode(" ",$risultati->data_prestito);
					$prestito=$prestito[0];
					$risultati->diff_prestito=$this->dates->dateDifference($adesso,$prestito);
					$risultati->data_prestito=$this->dates->convertDateTime($risultati->data_prestito,1);
				}			
				if (null != $risultati->data_reso) {
					$reso=explode(" ",$risultati->data_reso);
					$reso=$reso[0];
					$risultati->diff_reso=$this->dates->dateDifference($adesso,$reso);
					$risultati->data_reso=$this->dates->convertDateTime($risultati->data_reso,1);				
				}
				break;
			case "cavanzata":
				$risultati=$this->libri_model->searchLibriAvanzata($this->session->search);
				$data["tipodoc"] = NULL != $this->session->search['id_tipodoc'] ? $this->select_model->getItemName("tipidocumento",$this->session->search['id_tipodoc']) : "";	
				$data["local"] = NULL != $this->session->search['id_localizzazione'] ? $this->select_model->getItemName("localizzazioni",$this->session->search['id_localizzazione']) : "";	
				$data["argomento"] = NULL != $this->session->search['id_argomento'] ? $this->select_model->getItemName("argomenti",$this->session->search['id_argomento']) : "";	
				
				$data['select_local']=$this->select_model->selectItems("localizzazioni");
				$data['select_tipidoc']=$this->select_model->selectItems("tipidocumento");
				$data['select_argomenti']=$this->select_model->selectItems("argomenti");
				break;
		}
		
		$risultati ? $data['risultati']=$risultati : $data['risultati']="";
		// var_dump ($risultati);
		
		// info menu
		$data['utente']=$this->session->utente;
		
		$this->load->view('templates/header',$data);
		$this->load->view('templates/menu',$data);
		$this->load->view('search/'.$type,$data);
		$this->load->view('templates/footer',$data);
		// altri js
		$this->load->view('search/js_index',$data);
		$this->load->view('templates/close');
		
	}
	
}
