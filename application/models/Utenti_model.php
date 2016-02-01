<?php

	class Utenti_model extends CI_Model {
		
		public function __construct () {
			$this->load->database();
		}
		
		public function checkLogin($username,$password) {
			
			$query = $this->db->get_where('utenti', array('username' => $username, 'password' => sha1($password)));
			if ($query->num_rows()>0){
				$res=$query->row();
				return $res->id;
			}else{
				return null;
			}
			
		}
		
		public function getUserData($id) {
			
			$query = $this->db->select("utenti.*,livelli.descrizione")
				->from("utenti")
				->join("livelli","livelli.livello=utenti.livello")
				->where("utenti.id", $id)
				->get();
			if ($query->num_rows()>0){
				$res=$query->row();
				return $res;
			}else{
				return null;
			}
			
		}
			
	}
	
