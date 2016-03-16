<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Import extends MY_Controller {
	
	 public function index () {
		
		$this->session->set_userdata('dopo',current_url()); 
		
		if (!$this->checkLevel(2)){ // controllo se non loggato
			$this->session->set_userdata('nocons',1);
			redirect('login');
		}	
						
		$this->load->library('form_validation');
					
		$this->form_validation->set_error_delimiters('<label class="text-danger">', '</label>');
		
		if ($this->form_validation->run('import') !== FALSE) {
			$this->session->set_userdata('importazione',$this->input->post());
			redirect('import/doimport');					
		}		
		
		$data['utente']=$this->session->utente;
		$data['connesso']=$this->connesso(); // controllo connessione per caricamento css e js esterni o locali
		
		$this->load->view('templates/header',$data);
		$this->load->view('templates/menu',$data);
		$this->load->view('import/index',$data); // contiene il form per caricare file csv e impostare parametri importazione
		$this->load->view('templates/footer',$data);
		// altri js
		$this->load->view('import/js_index',$data);
		$this->load->view('templates/close');
		
		$this->session->unset_userdata('idlibro');
		$this->session->unset_userdata('fromsearch');
		$this->session->unset_userdata('import');
		$this->session->unset_userdata('noimport');
		$this->session->unset_userdata('echoimport');
				 
	}
	
	public function doimport() {
			
		if (!$this->session->importazione) redirect ('homepage');		
		$importazione=$this->session->importazione;
		$this->session->unset_userdata('importazione');
		
		$this->load->model('import_model');
			
		$output="Inizio procedura di importazione libri con metodo ".$importazione['metodo'].". Utente ID #".$this->session->utente->id."\n";
		
		// metodo truncate
		if ($importazione['metodo']=="truncate") {			
			$tabelle=array("libri","tipidocumento","prestiti");
				foreach ($tabelle as $val) {
				$this->import_model->truncateTable($val);
				$output.="Svuotate tabelle Libri, Tipi_documento e Prestiti\n";
			}
		}
		
		$cont=0;
		$total=-1;
		$filename=CSVUPLOADIR.$importazione['csvname'];
		
		// controllo se $filename esiste ed è apribile
		if (file_exists($filename)){			
			$handle=fopen($filename,"r");
			$output.="Aperto file ".$filename."\n";
			while (($data=fgetcsv($handle,1000,","))!==FALSE){
				$total++;	
				if ($total==0) continue;
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
					// se cod è numerico
					if (is_numeric($cod)){
						$arg=$this->import_model->getIdArgomento($cod);
						$new_idargomento=$arg->id;
					}else{
						$new_idargomento="1";
					}
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
					$output.="Libro #$total inserito. ID: $new_libro\n";
				}else{
					$output.="Libro #$total non inserito\n";
				}	
			}
			$echo="Importazione libri completata. Importati $cont libri di $total";
			$output.=$echo;
			// $output va in file log dedicato per importazione; $echo va in log generico e stampato a video in swal
			log_message("debug", $echo." con metodo ".$importazione['metodo'].". Utente id #".$this->session->utente->id.". (import/doimport)", LOGPREFIX);
			$this->session->set_userdata('import',1);		
			unlink($filename);	
		}else{
			// file csv inesistente o inaccessibile
			$echo="Importazione libri non effettuata. Il file .csv non può essere aperto";
			$output.=$echo;
			log_message("error", $echo.". Utente id #".$this->session->utente->id.". (import/doimport)", LOGPREFIX);
			$this->session->set_userdata('noimport',1);
		}
		$this->session->set_userdata('echoimport',$echo);
		
		//scrittura $output in file di .log
		$this->load->library('dates');
		$this->load->helper('file');
		
		$now=$this->dates->currentDateTime();
		$logname=IMPORTLOGDIR."import-".$now.".log";
		write_file($logname, $output);

		redirect ('import');
		
	}
	
	public function loadCSV () {
		
		/* salvo file csv per importazione libri */
		
		$this->output->enable_profiler(FALSE);
		
		$uploadir=CSVUPLOADIR;

		if ($_FILES['file']['error'] == UPLOAD_ERR_OK) {
			$tmpname = $_FILES['file']['tmp_name'];
			$filename = $uploadir.basename($_FILES['file']['name']);
			$upload=move_uploaded_file($tmpname, $filename);
		}else{
			$upload=false;
		}
		
		echo $upload;
		
	}
	
	public function unlinkCSV () {
		
		/* cancello file csv per importazione libri */
		
		$this->output->enable_profiler(FALSE);
		
		if (empty($this->input->post())) return false;
		
		$uploadir=CSVUPLOADIR;
		$filename=$uploadir.$this->input->post('csvfile');			
		if (file_exists($filename)){
			$unlink=unlink($filename);
		}else{
			$unlink=false;
		}
				
		echo $unlink;
		
	}
	
}
