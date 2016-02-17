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
					'rules'  => 'valid_email',
					'errors' => array(
                         'valid_email' => 'Formato %s non valido'
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
			),			
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