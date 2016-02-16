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
			
			$query = $this->db->select("utenti.*,livelli.nome as descrizione")
				->from("utenti")
				->join("livelli","livelli.livello=utenti.livello")
				->where("utenti.id", $id)
				->get();
			if ($query->num_rows()>0){
				return $query->row();
			}else{
				return null;
			}
			
		}
		
		public function getUtentiAutocomplete($nome) {
			
			$query=$this->db->select('id,nome')
				->like('nome', $nome, 'after') 
				->get('utenti');
		
			if ($query->num_rows()>0){
				return $query->result();
			}
			return FALSE;
			
		}	
		
		public function updateUtente ($dati) {
			
			extract ($dati);		
			
			$query=$this->db->set('nome',$nome)
				->set('classe',$classe)
				->set('email',$email)
				->set('telefono',$telefono)
				->set('livello',$livello)
				->where('id',$id)
				->update('utenti');
				
			return $this->db->affected_rows()>0;
		
		}
		
		public function insertUtente ($dati) {
			
			if ($query=$this->db->insert('utenti', $dati)) return $this->db->insert_id();
			 
			return FALSE;
			
		}
		
		public function elencoUtenti () {
			
			$query=$this->db->select('utenti.id,utenti.nome,utenti.email,utenti.telefono,utenti.classe,livelli.nome as livello')
				->join('livelli', 'utenti.livello=livelli.livello')
				->where_not_in('livelli.nome', 'super')
				->get('utenti');
			
			if ($query->num_rows()>0){
				return $query->result();
			}
			return FALSE;
			
		}
		
		public function getUtente ($id) {
		
			$query=$this->db->select('utenti.*,livelli.nome as descrizione')
				->where('utenti.id',$id)
				->join('livelli', 'utenti.livello=livelli.livello')
				->get('utenti');
				
			if ($query->num_rows()>0){
				return $query->row();
			}
			return FALSE;
				
		}
	}
	
