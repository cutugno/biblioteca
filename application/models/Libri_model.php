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
			
			$query=$this->db->set($dati)
						->where('id',$dati['id'])
						->update('libri');
					
			return $this->db->affected_rows()>0;
		
		}
	
		public function eliminaLibro ($id) {
			
			return $query=$this->db->delete('libri', array('id' => $id));
			
		}
		
		public function checkInventario ($inv) {
			
			$query=$this->db->get_where('libri',array("inventario"=>$inv));
			
			return $query->num_rows();
			
		}
		
		public function elencoLibri () { 
				
			$query=$this->db->select('libri.*,localizzazioni.nome as localizzazione,argomenti.nome as argomento')
				->join('localizzazioni','libri.id_localizzazione=localizzazioni.id')
				->join('argomenti','libri.id_argomento=argomenti.id')
				->order_by('inventario')
				->get('libri');
				
			if ($query->num_rows()>0){
				return $query->result();
			}else{
				return FALSE;
			}
			
		}
		
		public function searchLibriSemplice ($keyword) {
			
			$query=$this->db->select('libri.*,localizzazioni.nome as localizzazione,argomenti.nome as argomento')
				->join('localizzazioni','libri.id_localizzazione=localizzazioni.id')
				->join('argomenti','libri.id_argomento=argomenti.id')
				->like('libri.keywords',$keyword)
				->order_by('inventario','ASC')
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
		
		public function toggleDisp ($id,$disp) {
			
			$query=$this->db->set('disp',$disp)
				->where('id',$id)
				->update('libri');
			return $this->db->affected_rows()>0;
	
		}
		
		public function getLocalizzazioneInfo ($id_local) {
						
			$res = new stdClass();
			
			$query=$this->db->select('count(*) as quantita')
				->where('id_localizzazione',$id_local)
				->get('libri');
				
			if ($query->num_rows()>0){
				$res->quantita=$query->row()->quantita;
			}else{
				return FALSE;
			}				
			$query=$this->db->select('pref_inventario')
				->where('id',$id_local)
				->get('localizzazioni');
			if ($query->num_rows()>0){
				$res->prefisso=$query->row()->pref_inventario;
			}else{
				return FALSE;
			}	
				
			return $res;
		}
			
	}
	
