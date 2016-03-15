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
		
		public function checkUsername ($username) {
			
			$query = $this->db->get_where('utenti', array('username' => $username));
			
			return $query->num_rows();
			
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
		
		public function updateLastLogin ($id) {
			
			$query=$this->db->set('last_login','NOW()',FALSE)
				->where('id',$id)
				->update ('utenti');
			
		}
		
		public function updateUtente ($dati) {
			
			extract ($dati);		
			
			$query=$this->db->set('nome',$nome)
				->set('classe',$classe)
				->set('email',$email)
				->set('telefono',$telefono)
				->set('livello',$livello)
				->set('last_edit','NOW()',FALSE)
				->where('id',$id)
				->update('utenti');
				
			return $this->db->affected_rows()>0;
		
		}
		
		public function updateProfile ($dati) {
			
			extract($dati);
			
			$query=$this->db->set('nome',$nome)
				->set('classe',$classe)
				->set('email',$email)
				->set('telefono',$telefono)				
				->set('last_edit','NOW()',FALSE)
				->where('id',$id)
				->update('utenti');
				
			return $this->db->affected_rows()>0;
			
		}
		
		public function updatePassword ($dati) {
			
			
		}
		
		public function insertUtente ($dati) {
			
			$query=$this->db->set($dati)
				->set('last_edit','NOW()',FALSE)
				->insert('utenti');
				
			if ($query) return $this->db->insert_id();
			return FALSE;
			
		}
		
		public function elencoUtenti () {
			
			$query=$this->db->select('utenti.*,livelli.nome as livello')
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
		
		public function eliminaUtente ($id) {
			
			return $query=$this->db->delete('utenti', array('id' => $id));
			
		}
	}
	
