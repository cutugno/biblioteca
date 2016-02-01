<?php

	class Select_model extends CI_Model {
		
		public function __construct () {
			$this->load->database();
		}
		
		public function selectItems($tabella) {
			
			$query = $this->db->order_by("nome")
				->get($tabella);
			if ($query->num_rows()>0){
				return $res=$query->result_array();
			}else{
				return null;
			}
			
		}
			
	}
	
