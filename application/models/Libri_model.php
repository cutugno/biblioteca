<?php

	class Libri_model extends CI_Model {
		
		public function __construct () {
			$this->load->database();
		}
		
		public function insertLibro ($dati) {
			
			 if ($query=$this->db->insert('libri', $dati)) return $this->db->insert_id();
			 
			 return FALSE;
		
		}
		
		public function updateLibro ($dati) {
			
			return $query=$this->db->replace('libri', $dati);			
		
		}
		
		public function eliminaLibro ($id) {
			
			return $query=$this->db->delete('libri', array('id' => $id));
			
		}
		
		public function checkInventario ($inv) {
			
			$query=$this->db->get_where('libri',array("inventario"=>$inv));
			
			return $query->num_rows();
			
		}
		
		public function elencoLibri () {  // migliorare con join su prestiti
				
			$query=$this->db->select('libri.*,localizzazioni.nome as localizzazione,generi.nome as genere')
				->join('localizzazioni','libri.id_localizzazione=localizzazioni.id')
				->join('generi','libri.id_genere=generi.id')
				->order_by('inventario')
				->get('libri');
				
			if ($query->num_rows()>0){
				return $query->result();
			}else{
				return FALSE;
			}
			
		}
		
		public function getLibro ($id) {
						
			$query=$this->db->get_where('libri',array('id'=>$id));
			
			if ($query->num_rows()>0){
				return $query->row();
			}else{
				return FALSE;
			}
			
		}
		
		public function getLibroByInv ($inventario) {
						
			$query=$this->db->get_where('libri',array('inventario'=>$inventario));
			
			if ($query->num_rows()>0){
				return $query->row();
			}else{
				return FALSE;
			}
			
		}
			
	}
	
