<?php
	
	class RoleModel extends CI_Model{
		
		function __construct(){
			parent::__construct();
			$this->load->database("db");
		}
		
		public function ajouter($vals){
			$query = $this->db->insert('role',$vals);
                $this->db->reset_query();
                return $query;
		}
		
		public function lister(){
			$query = $this->db->select('*')
								->from('role')
								->get();
					return $query->result_array();
		}
	}