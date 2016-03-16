<?php

	class Import_model extends CI_Model {
		
		public function __construct () {
			$this->load->database();
		}
		
		public function truncateTable ($tabella) {
			
			$query=$this->db->truncate($tabella);
			
		}
		
		public function checkLocalizzazione ($loc) {
			
			$query=$this->db->get_where("localizzazioni",array("nome"=>$loc));
			
			if ($query->num_rows()>0) return $query->row();
			return false;
		
		}
		
		public function countLibriForLoc ($id_loc) {
			
			$query=$this->db->get_where("libri",array("id_localizzazione"=>$id_loc));
			
			return $query->num_rows();
			
		}
		
		public function checkTipodoc ($tipodoc) {
			
			$query=$this->db->get_where("tipidocumento",array("nome"=>$tipodoc));
			
			if ($query->num_rows()>0) return $query->row();
			return false;
			
		}
		
		public function insertTipodoc ($tipodoc) {
			
			$query=$this->db->set("nome",ucfirst($tipodoc))
				->insert("tipidocumento");
				
			if ($query) return $this->db->insert_id();
			return false;			
			
		}
		
		public function getIdArgomento ($cod) {
			
			$query=$this->db->select("id")
				->where("cod",$cod)
				->get("argomenti");
			
			if ($query->num_rows()>0) return $query->row();
			return false;
			
		}
		
		public function newLibro ($libro) {
			
			$query=$this->db->set($libro)
				->insert("libri");
			
			if ($query) return $this->db->insert_id();
			return false;
			
		}
	}
	
