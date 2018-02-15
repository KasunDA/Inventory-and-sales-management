<?php
	
	class ClientModel extends CI_Model{
		
		function __construct(){
			parent::__construct();
			$this->load->database("db");
		}
		
		public function ajouter($vals){
			$query = $this->db->insert('client',$vals);
                $this->db->reset_query();
                return $query;
		}
		
		public function lister(){
			$query = $this->db->select('*')
								->from('client')
								->get();
					return $query->result_array();
		}

		public function getClientInfos($nomclient){
			$query = $this->db->select('*')
								->from('client')
								->where('nomClient',$nomclient)
								->get();
			return $query->row_array();
		}

		public function getClientName($idy){
			$query = $this->db->distinct('nomClient')
								->from('client')
								->where('numClient',$idy)
								->get();			
			$res = $query->row_array();
			return $res['nomClient'];
		}
	}