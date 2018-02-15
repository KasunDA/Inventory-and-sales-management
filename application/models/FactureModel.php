<?php
	
	class FactureModel extends CI_Model{
		
		function __construct(){
			parent::__construct();
			$this->load->database("db");
		}
		
		public function ajouter($vals){
			$query = $this->db->insert('facture',$vals);
                $this->db->reset_query();
                return $query;
		}
		
		public function lister(){
			$query = $this->db->select('*')
								->from('facture')
								->get();
					return $query->result_array();
		}

		public function getClientName($idy){
			$query = $this->db->distinct('nomClient')
								->from('facture')
								->where('numFacture',$idy)
								->group_by('numFacture')
								->get();			
			$res = $query->row_array();
			return $res['nomClient'];
		}

		public function getDateFact($idy){
			$query = $this->db->distinct('dateFact')
								->from('facture')
								->where('numFacture',$idy)
								->group_by('numFacture')
								->get();			
			$res = $query->row_array();
			return $res['dateFact'];
		}
	}