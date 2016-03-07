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
		$this->load->library('dates');
				
		// info prestito
		$prestito=$this->prestiti_model->getPrestito($id);
		
		// gestione date
		$prestito->data_prestito=$this->dates->convertDateTime($prestito->data_prestito);
		$prestito->data_reso ? $prestito->data_reso=$this->dates->convertDateTime($prestito->data_reso) : $prestito->data_reso="";
		
		$data['prestito']=$prestito;
		$data['title']="TEST";
		$data['logo']=base_url('images/logoGL.png');
        $data['content']=$this->load->view('templates/pdf/prestito',$data,TRUE); // content verrà generato da un altro template -> $content=$this->load->view('template',$data,TRUE)
        $data['pdf_name']="test.pdf";
        $data['pdf_oper']="I"; // I -> apre a video; D -> salva
		
		$this->load->view('test', $data);
        
    }
    
    public function import () {
		
		$data['connesso']=$this->connesso(); // controllo connessione per caricamento css e js esterni o locali
		
		$this->load->model('import_model');
		
		$tabelle=array("libri","tipidocumento");
		foreach ($tabelle as $val) {
			$this->import_model->truncateTable($val);
		}
		
		$total=$cont=0;
		$handle=fopen(site_url("csv/liceale.csv"),"r");
		
		while (($data=fgetcsv($handle,1000,","))!==FALSE){
			$total++;	
			
			// localizzazione e inventario
			$loc=$this->import_model->checkLocalizzazione($data[1]);
			$new_idloc=$loc->id;
			$prefinv=$loc->pref_inventario;
			// contare quanti libri già esistono con questo $new_idloc come id_localizzazione e formare la parte numerica del codice inventario
			$count=$this->import_model->countLibriForLoc($new_idloc);		
			$count++;
			$cod="";
			for ($x=1;$x<=CODL-strlen($count);$x++){
				$cod.="0";
			}
			$new_inv=$prefinv.$cod.$count;
			
			// tipo documento
			if ($tipodoc=$this->import_model->checkTipodoc($data[3])){
				$new_idtipodoc=$tipodoc->id;
			}else{
				$new_idtipodoc=$this->import_model->insertTipodoc($data[3]);
			}
			
			// argomento
			if (NULL != $data[11]){
				$cod=substr($data[11],0,1);
				$arg=$this->import_model->getIdArgomento($cod);
				$new_idargomento=$arg->id;
			}else{
				$new_idargomento="1";
			}
			
			//inserimento
			$libro['inventario']=$new_inv;
			$libro['id_localizzazione']=$new_idloc;
			$libro['collocazione']=$data[2];
			$libro['id_tipodoc']=$new_idtipodoc;
			$libro['autore']=$data[4];
			$libro['titolo']=$data[5];
			$libro['luogo']=$data[6];
			$libro['editore']=$data[7];
			$libro['anno']=$data[8];
			$libro['note']=$data[9];
			$libro['isbn']=$data[10];
			$libro['id_argomento']=$new_idargomento;
			$libro['cdd']=$data[11];
			$libro['descrizione_cdd']=$data[12];
			$libro['curatore']=$data[13];
			$libro['traduttore']=$data[14];
			$libro['lingua']=$data[15];
			
			if ($new_libro=$this->import_model->newLibro($libro)){
				$cont++;
				echo "Libro #$total inserito. ID: $new_libro<br>";
			}else{
				echo "Libro #$total non inserito<br>";
			}	
		}
		echo "Importazione completata. Importati $cont libri di $total";
		
	}
	
}
