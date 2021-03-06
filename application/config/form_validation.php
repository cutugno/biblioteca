<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config = array(
	'login' => array(
			array(
					'field'  => 'username',
					'label'  => 'Username',
					'rules'  => 'required',
					'errors' => array(
                         'required' => '%s obbligatorio'
					)
			),
			array(
					'field'  => 'password',
					'label'  => 'Password',
					'rules'  => 'required',
					'errors' => array(
                         'required' => '%s obbligatoria'
					)
			)
	),
	'libro' => array(
			array(
					'field'  => 'id_localizzazione',
					'label'  => 'Localizzazione',
					'rules'  => 'required',
					'errors' => array(
                        'required' => '%s obbligatoria'
					)
			),
			array(
					'field'  => 'inventario',
					'label'  => 'Inventario',
					'rules'  => 'required',
					'errors' => array(
                        'required' => '%s obbligatorio'
					)
			),
			array(
					'field'  => 'collocazione',
					'label'  => 'Collocazione',
					'rules'  => 'max_length[100]',
					'errors' => array(
                        'max_length' => 'Massimo {param} caratteri'
					)
			),
			array(
					'field'  => 'autore',
					'label'  => 'Autore',
					'rules'  => 'required|max_length[100]',
					'errors' => array('required' => '%s obbligatorio',
									  'max_length' => 'Massimo {param} caratteri'
					)
			),
			array(
					'field'  => 'titolo',
					'label'  => 'titolo',
					'rules'  => 'required|max_length[100]',
					'errors' => array('required' => '%s obbligatorio',
									  'max_length' => 'Massimo {param} caratteri'
					)
			),
			array(
					'field'  => 'editore',
					'label'  => 'Editore',
					'rules'  => 'max_length[45]',
					'errors' => array(
                        'max_length' => 'Massimo {param} caratteri'
					)
			),
			array(
					'field'  => 'luogo',
					'label'  => 'Luogo',
					'rules'  => 'max_length[45]',
					'errors' => array(
                        'max_length' => 'Massimo {param} caratteri'
					)
			),
			array(
					'field'  => 'anno',
					'label'  => 'Anno',
					'rules'  => 'numeric|exact_length[4]',
					'errors' => array('numeric' => 'Solo numeri',
									  'exact_length' => 'L\'anno è di {param} caratteri numerici'
					)
			),
			array(
					'field'  => 'lingua',
					'label'  => 'Lingua',
					'rules'  => 'max_length[45]',
					'errors' => array(
                        'max_length' => 'Massimo {param} caratteri'
					)
			),
			array(
					'field'  => 'cdd',
					'label'  => 'CDD',
					'rules'  => 'max_length[20]',
					'errors' => array(
                        'max_length' => 'Massimo {param} caratteri'
					)
			),
			array(
					'field'  => 'descrizione_cdd',
					'label'  => 'Descrizione CDD',
					'rules'  => 'max_length[100]',
					'errors' => array(
                        'max_length' => 'Massimo {param} caratteri'
					)
			),
			array(
					'field'  => 'curatore',
					'label'  => 'Curatore',
					'rules'  => 'max_length[100]',
					'errors' => array(
                        'max_length' => 'Massimo {param} caratteri'
					)
			),
			array(
					'field'  => 'traduttore',
					'label'  => 'Traduttore',
					'rules'  => 'max_length[100]',
					'errors' => array(
                        'max_length' => 'Massimo {param} caratteri'
					)
			)
	),
	'prestito' => array(
			array(
					'field'  => 'id_libro',
					'label'  => 'Inventario',
					'rules'  => 'required',
					'errors' => array(
                         'required' => '%s obbligatorio'
					)
			),
			array(
					'field'  => 'nome',
					'label'  => 'Utente',
					'rules'  => 'required',
					'errors' => array(
                         'required' => '%s obbligatorio'
					)
			),array(
					'field'  => 'email',
					'label'  => 'Email',
					// controllo email è utilizzabile (non esiste)
					'rules'  => array(
						'valid_email',						
						array(
							'usable_email',
							function($value) {
								$CI =& get_instance();
							
								$CI->load->database();
								
								$query = $CI->db->select('*')
									->where('email',$value)
									->where('id !=',$CI->input->post('id_utente'))
									->get('utenti');
									
								return $query->num_rows()==0;
							}
						)
					),
					'errors' => array(
							'valid_email' => 'Formato %s non valido',
							'usable_email' => '%s già in uso'
					)
			),array(
					'field'  => 'telefono',
					'label'  => 'Telefono',
					'rules'  => 'numeric|min_length[6]|max_length[11]',
					'errors' => array(
                         'numeric' => 'Solo numeri',
                         'min_length' => 'Min 6 caratteri',
                         'max_length' => 'Max 11 caratteri'
					)
			)
	),
	'utente' => array(
			array(
					'field'  => 'nome',
					'label'  => 'Utente',
					'rules'  => 'required',
					'errors' => array(
                         'required' => '%s obbligatorio'
					)
			),array(
					'field'  => 'email',
					'label'  => 'Email',
					'rules'  => array(
						'valid_email',						
						array(
							'usable_email',
							function($value) {
								$CI =& get_instance();
							
								$CI->load->database();
								
								$query = $CI->db->select('*')
									->where('email',$value)
									->where('id !=',$CI->input->post('id_utente'))
									->get('utenti');
									
								return $query->num_rows()==0;
							}
						)
					),
					'errors' => array(
							'valid_email' => 'Formato %s non valido',
							'usable_email' => '%s già in uso'
					)
			),array(
					'field'  => 'telefono',
					'label'  => 'Telefono',
					'rules'  => 'numeric|min_length[6]|max_length[11]',
					'errors' => array(
                         'numeric' => 'Solo numeri',
                         'min_length' => 'Min 6 caratteri',
                         'max_length' => 'Max 11 caratteri'
					)
			)		
	),
	'nuovoutente' => array(
			array(
					'field'  => 'username',
					'label'  => 'Username',
					'rules'  => 'required|alpha_numeric|min_length[6]|max_length[12]',
					'errors' => array(
                         'required' => '%s obbligatorio',
                         'alpha_numeric' => 'Solo caratteri alfanumerici',
                         'min_length' => 'Min 6 caratteri',
                         'max_length' => 'Max 12 caratteri',
					)
			),
			array(
					'field'  => 'nome',
					'label'  => 'Nome',
					'rules'  => 'required',
					'errors' => array(
                         'required' => '%s obbligatorio'
					)
			),array(
					'field'  => 'email',
					'label'  => 'Email',
					'rules'  => array(
						'valid_email',						
						array(
							'usable_email',
							function($value) {
								$CI =& get_instance();
							
								$CI->load->database();
								
								$query = $CI->db->select('*')
									->where('email',$value)
									->where('id !=',$CI->input->post('id_utente'))
									->get('utenti');
									
								return $query->num_rows()==0;
							}
						)
					),
					'errors' => array(
							'valid_email' => 'Formato %s non valido',
							'usable_email' => '%s già in uso'
					)
			),array(
					'field'  => 'telefono',
					'label'  => 'Telefono',
					'rules'  => 'numeric|min_length[6]|max_length[11]',
					'errors' => array(
                         'numeric' => 'Solo numeri',
                         'min_length' => 'Min 6 caratteri',
                         'max_length' => 'Max 11 caratteri'
					)
			)		
	),
	'password' => array(
			array(
				'field'  => 'old_password',
				'label'  => 'Vecchia password',
				'rules'  => array(
					'required',
					array(
						'check_old_password',
						function($value) {
							$CI =& get_instance();
						
							return (sha1($value)==$CI->session->utente->password);
						}
					)
				),
				'errors' => array(
						'required' => '%s obbligatoria',
						'check_old_password' => '%s errata'
				)
			),array(
				'field'  => 'new_password',
				'label'  => 'Nuova password',
				'rules'  => 'required',
				'errors' => array(
						'required' => '%s obbligatoria'
				)
			),array(
				'field'  => 'conf_password',
				'label'  => 'Conferma password',
				'rules'  => 'required|matches[new_password]',
				'errors' => array(
						'required' => '%s obbligatoria',
						'matches' => 'Le due password non corrispondono'
				)
			),
	),
	'import' => array(
			array(
					'field'  => 'csvname',
					'label'  => 'File .csv',
					'rules'  => 'required',
					'errors' => array(
                         'required' => '%s obbligatorio'
					)
			),array(
					'field'  => 'metodo',
					'label'  => 'Metodo',
					'rules'  => 'required',
					'errors' => array(
						 'required' => '%s obbligatorio'
					)
			)
	),
	'contatta' => array(
			array(
					'field'  => 'email',
					'label'  => 'Email',
					'rules'  => 'required|valid_email',
					'errors' => array(
                         'required' => '%s obbligatoria',
                         'valid_email' => 'Formato %s non valido'
					)
			),
			array(
					'field'  => 'messaggio',
					'label'  => 'Messaggio',
					'rules'  => array(
						'required',
						array(
							'summernote_required',
							function($value) {
								return strip_tags($value)!="";
							}
						)
					),
					'errors' => array(
							'required' => '%s obbligatorio',
							'summernote_required' => '%s obbligatorio'
					)
			)
	),
	// tipi ricerca
	'csemplice' => array(
			array(
					'field'  => 'keyword',
					'label'  => 'Ricerca',
					'rules'  => 'required|min_length[4]',
					'errors' => array(
                         'required'   => '%s qualcosa!',
                         'min_length' => 'Prova una %s più specifica (min 4 caratteri)' 
					)
			)
	),
	'cprestito' => array(
			array(
					'field'  => 'codice',
					'label'  => 'Codice',
					'rules'  => 'required',
					'errors' => array(
                         'required' => '%s obbligatorio'
					)
			)
	),
	'cavanzata' => array(
			array(
					'field'  => 'type',
					'label'  => 'Tipo',
					'rules'  => 'required',
					'errors' => array(
                         'required' => '%s obbligatorio'
					)
			)
	)
		
		
);