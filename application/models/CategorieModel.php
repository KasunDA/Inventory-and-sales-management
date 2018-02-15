<?php
	
	class CategorieModel extends CI_Model{
		
		function __construct(){
			parent::__construct();
			$this->load->database("db");
		}
		
		public function ajouter($vals){
			$query = $this->db->insert('categorie',$vals);
                $this->db->reset_query();
                return $query;
		}
		
		public function lister(){
			$query = $this->db->select('*')
								->from('categorie')
								->get();
					return $query->result_array();
		}

		public function getIdCategorie($nomcat){
			$query = $this->db->select('idCat')
								->from('categorie')
								->where('libelleCat',$nomcat)
								->get();
			$res = $query->row_array();
	        return $res['idCat'];
		}

		public function InitCategorie($idCat){
			switch ($idCat) {
				case 1:
					return 'prixC1';
					break;
				case 2:
					return 'prixC2';
					break;
				case 3:
					return 'prixC3';
					break;
				case 4:
					return 'prixC4';
					break;
				default:
					return 'prixU';
					break;
			}
		}

	}