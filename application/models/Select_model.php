<?php

	class Select_model extends CI_Model {
		
		public function __construct () {
			$this->load->database();
		}
		
		public function selectItems($tabella) {
			
			$query = $this->db->order_by("nome")
				->get($tabella);
				
			if ($query->num_rows()>0){
				return $query->result_array();
			}else{
				return null;
			}
			
		}
		
		public function selectLivelli() {
			
			$query = $this->db->where_not_in("nome","Super")
				->order_by("nome")
				->get("livelli");
				
			if ($query->num_rows()>0){
				return $query->result_array();
			}else{
				return null;
			}
			
		}
		
		public function getItemName($tabella,$id) {
			
			$query=$this->db->select("nome")
				->where("id",$id)
				->get($tabella);
				
			if ($query->num_rows()>0){
				$res=$query->row();
				return $res->nome;
			}
			return false;
			
		}
			
	}
	
