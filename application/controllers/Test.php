<?php 

defined('BASEPATH') OR exit('No direct script access allowed');
 
class Test extends MY_Controller {
 
    public function index() {
		
		$this->session->set_userdata('dopo',current_url()); 
		
		if (!$this->checkLevel(0)){ // controllo se loggato
			$this->session->set_userdata('nocons',1);
			redirect('login');
		}
		
		$this->load->helper('tcpdf_helper');
		$this->load->library('dates');
				
		$id=13; // passarlo in altra maniera
		// info prestito
		$prestito=$this->prestiti_model->getPrestito($id);
		
		// gestione date
		$prestito->data_prestito=$this->dates->convertDateTime($prestito->data_prestito);
		$prestito->data_reso ? $prestito->data_reso=$this->dates->convertDateTime($prestito->data_reso) : $prestito->data_reso="";
		
		$data['prestito']=$prestito;
		$data['title']="TEST";
		$data['logo']=base_url('images/logoGL.png');
		var_dump ($data['logo']);
        $data['content']=$this->load->view('templates/pdf/prestito',$data,TRUE); // content verrà generato da un altro template -> $content=$this->load->view('template',$data,TRUE)
        $data['pdf_name']="test.pdf";
        $data['pdf_oper']="I"; // I -> apre a video; D -> salva
		
		$this->load->view('test', $data);
        
    }
}
