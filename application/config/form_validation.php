<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config = array(
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
			)
	),
	// tipi ricerca
	'csemplice' => array(
			array(
					'field'  => 'keyword',
					'label'  => 'Cerca',
					'rules'  => 'required',
					'errors' => array(
                         'required' => '%s qualcosa!'
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
	)
		
);