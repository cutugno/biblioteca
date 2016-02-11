<?php

	class Prestiti_model extends CI_Model {
		
		public function __construct () {
			$this->load->database();
		}
		
		public function checkPrestito($id_libro) {
			
			$query=$this->db->get_where('prestiti',array('id_libro'=>$id_libro));
			
			return $query->num_rows(); 
						
		}
		
		public function getPrestito($id_libro) {
			
			$query=$this->db->get_where('prestiti',array('id_libro'=>$id_libro));
			
			if ($query->num_rows()>0) {
				return $query->row();
			}
			return FALSE;
			
		}
				
		public function lastPrestito() {
			
			$query=$this->db->select('codice')
				->from('prestiti')
				->order_by('codice', 'DESC')
				->limit(1)
				->get();
					
			if ($query->num_rows()>0){
				$res=$query->row();
				return $res->codice;
			}
			return FALSE;
	
		}
		
		public function insertPrestito ($dati) {
			
			if ($query=$this->db->insert('prestiti', $dati)) return $this->db->insert_id();
			
		}
			
	}
	
