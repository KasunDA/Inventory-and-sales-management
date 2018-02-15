<?php
	
	class LoginModel extends CI_Model{
		
		function __construct(){
			parent::__construct();
			$this->load->database("db");
		}
		
     public function findOneUser($tab) {
		$query = $this->db
                        ->select('count(*) as nbre, idU, nom, prenom, idRole')
                        ->from('user')
                        ->where('login = ',$tab['login'])
                        ->where('password = ',$tab['password'])
                        ->get();
        return $query->row_array();
     }
		/*
		public function updateAgence($vals, $id){
			$query = $this->db->update('agence', $vals)
								->where('idAgence', $id);
		}

		public function delAgence($id){
			$query = $this->db->delete('agence', array('idagence' => $id));
		}
		*/
	}



