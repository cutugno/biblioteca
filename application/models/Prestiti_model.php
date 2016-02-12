<?php

	class Prestiti_model extends CI_Model {
		
		public function __construct () {
			$this->load->database();
		}
		
		public function checkPrestito($id_libro) {
			
			$query=$this->db->get_where('prestiti',array('id_libro'=>$id_libro));
			
			return $query->num_rows(); 
						
		}
		
		public function getPrestito($id) {
			
			$query=$this->db->select('prestiti.*,libri.inventario, libri.autore, libri.titolo, libri.isbn, libri.disp, utenti.nome as utente, utenti.email, utenti.classe')
				->join('libri','prestiti.id_libro=libri.id')
				->join('utenti','prestiti.id_utente=utenti.id')
				->where('prestiti.id',$id)
				->get('prestiti');
			
			if ($query->num_rows()>0) {
				return $query->row();
			}
			return FALSE;
			
		}
		
		public function getPrestitoByIdlibro($id_libro) {
			
			$query=$this->db->select('prestiti.*,libri.inventario, libri.autore, libri.titolo, libri.isbn, libri.disp, utenti.nome as utente, utenti.email, utenti.classe')
				->join('libri','prestiti.id_libro=libri.id')
				->join('utenti','prestiti.id_utente=utenti.id')
				->where('prestiti.id_libro',$id_libro)
				->where('prestiti.data_reso',NULL)
				->order_by('data_prestito','DESC')
				->limit(1)
				->get('prestiti');
			
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
			return FALSE;
			
		}
		
		public function elencoPrestiti () {
				
			$query=$this->db->select('prestiti.*, libri.inventario, libri.titolo, utenti.nome')
				->join('libri', 'prestiti.id_libro=libri.id')
				->join('utenti', 'prestiti.id_utente=utenti.id')
				->order_by('codice')
				->get('prestiti');
				
			if ($query->num_rows()>0){
				return $query->result();
			}else{
				return FALSE;
			}
			
		}
		
		public function registraReso ($id) {
			
			$inquery=$this->db->select('id_libro')
				->where('id',$id)
				->get_compiled_select('prestiti');
				
			// query update disp in libri
			$query=$this->db->set('disp',1)
				->where('id','('.$inquery.')',FALSE)
				->update('libri');
				
			// query update data_reso in prestiti
			$query=$this->db->set('data_reso','NOW()',FALSE)
				->where('id',$id)
				->update('prestiti');
			
			return $this->db->affected_rows()>0;
			
		}
			
	}
	
