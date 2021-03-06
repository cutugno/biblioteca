<?php 

defined('BASEPATH') OR exit('No direct script access allowed');
 
class Test extends MY_Controller {
 
    public function pdf($id) {
		
		$this->session->set_userdata('dopo',current_url()); 
		
		if (!$this->checkLevel(0)){ // controllo se loggato
			$this->session->set_userdata('nocons',1);
			redirect('login');
		}
		
		if (empty($id)) redirect('prestiti/elenco');
				
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
        $data['content']=$this->load->view('templates/pdf/prestito',$data,TRUE); // content verrà generato da un altro template -> $content=$this->load->view('template',$data,TRUE)
        $data['pdf_name']="test.pdf";
        $data['pdf_oper']="I"; // I -> apre a video; D -> salva
		
		$this->load->view('test', $data);
        
    }
    
    public function mail() {
		
		$this->load->library('email');
		
		$mailview="contatta";
		$data['prova']="Prova email";
		$destinatario="sberz666@gmail.com";		
		$subject="Prova mail";
		
		echo $this->email->sendMail($mailview,$data,$destinatario,$subject);
		
	}
	
	public function livello () {
		
		if (!$this->checkLevel(1)){ // controllo se non loggato
			$this->session->set_userdata('nocons',1);
			redirect('login');
		}
		
		
		
	}
	
}
