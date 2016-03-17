<?php 

defined('BASEPATH') OR exit('No direct script access allowed');
 
class Stampa extends MY_Controller {
 
    public function ricevuta ($id) { // stampa ricevuta prestito
		
		$this->session->set_userdata('dopo',current_url()); 
		
		if (!$this->checkLevel(0)){ // controllo se loggato
			$this->session->set_userdata('nocons',1);
			redirect('login');
		}
		
		if (empty($id)) redirect('prestiti/elenco');	
		
		$data['connesso']=$this->connesso(); // controllo connessione per caricamento css e js esterni o locali
		
		$this->load->helper('tcpdf_helper');
		$this->load->helper('date');	
				
		// info prestito
		$prestito=$this->prestiti_model->getPrestito($id);
		
		// gestione date
		$prestito->data_prestito=convertDateTime($prestito->data_prestito);
		$prestito->data_reso ? $prestito->data_reso=convertDateTime($prestito->data_reso) : $prestito->data_reso="";
		
		$data['prestito']=$prestito;
		$data['title']="TEST";
		$data['logo']=base_url('images/logoGL.png');
        $data['content']=$this->load->view('templates/pdf/prestito',$data,TRUE); 
        $data['pdf_name']="test.pdf";
        $data['pdf_oper']="I"; // I -> apre a video; D -> salva
		
		$this->load->view('test', $data);
        
    }
    
}
