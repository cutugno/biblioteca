<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller {

	public function index()	{
		
		/* controllo se loggato */
		if ($this->checkLevel(0)){ 
			redirect ('homepage');
		}else{
			$utente = new stdClass();
			$utente->livello=0;
		}

		$this->load->library('form_validation');
		
		$this->form_validation->set_error_delimiters('<label class="text-danger">', '</label>');
		
		if ($this->form_validation->run('login') !== FALSE) {
			// query validazione
			$this->load->model('utenti_model');
			$username=$this->input->post('username');
			$password=$this->input->post('password');
			if ($idutente=$this->utenti_model->checkLogin($username,$password)){
				// set session
				$datiutente=$this->utenti_model->getUserData($idutente);
				$this->session->set_userdata('utente',$datiutente);
				$logmsg="Login effettuato. Creata nuova sessione utente id #".$datiutente->id.".";
				if ($this->input->post('ricordami')==1){
					// setto cookie persistente
					$cookie = $this->input->cookie('ci_session'); 
					$this->input->set_cookie('ci_session', $cookie, '157680000'); 
					$logmsg.=" Settato cookie persistente.";
				}
				log_message("debug", $logmsg." (login/index)", LOGPREFIX);
				redirect ($this->session->dopo);
			}else{
				log_message("error", "Login errato. Username ".$this->input->post("username").". (login/index)", LOGPREFIX);
				$this->session->set_flashdata('nologin',1);
			}
		}
		
		$data['utente']=$utente;
				
		$this->load->view('templates/header');
		$this->load->view('templates/menu',$data);
		$this->load->view('login/index');
		$this->load->view('templates/footer');
		$this->load->view('login/js_login');
		$this->load->view('templates/close');
	}
	
	public function logout() {
		
		/* controllo se non loggato */
		if (!$this->checkLevel(0)){ 
			redirect ('homepage');
		}
		
		log_message("debug","Logout effettuato. Utente id #".$this->session->utente->id.". (login/logout)", LOGPREFIX);		
		$this->session->sess_destroy();		
		
		redirect('homepage');
		
	}
	
}
