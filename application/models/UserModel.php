<?php
	
	class UserModel extends CI_Model{
		
		function __construct(){
			parent::__construct();
			$this->load->database("db");
		}
		
		public function ajouter($vals){
			$query = $this->db->insert('user',$vals);
                $this->db->reset_query();
                return $query;
		}
		
		public function lister(){
			$query = $this->db->select('nom, prenom, login, telephone, libelleRole')
								->from('user')
								->join('role', 'user.idRole = role.idRole')
								->get();
					return $query->result_array();
		}
	}