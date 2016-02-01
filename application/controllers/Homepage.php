<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Homepage extends MY_Controller {

	public function index()	{
		
		if (!$this->checkLevel(0)){ // controllo se loggato
			redirect('login');
		}
		
		$data['utente']=$this->session->utente;
		$data['select_local']=$this->select_model->selectItems("localizzazioni");
		$data['select_tipidoc']=$this->select_model->selectItems("tipidocumento");
		$data['select_generi']=$this->select_model->selectItems("generi");
		
		$this->load->view('templates/header');
		$this->load->view('templates/menu',$data);
		$this->load->view('homepage/index');
		$this->load->view('templates/footer');
		// altri js
		$this->load->view('templates/close');
	}
	
}
