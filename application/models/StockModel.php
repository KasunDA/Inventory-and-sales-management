<?php
	
	class StockModel extends CI_Model{
		
		function __construct(){
			parent::__construct();
			$this->load->database("db");
		}
		
		public function ajouter($vals){
			$query = $this->db->insert('stock',$vals);
                $this->db->reset_query();
                return $query;
		}
		
		public function lister(){
			$query = $this->db->select('numStock, sum(quantites) as tot,nom, prenom, dateStock')
								->from('stock')
								->join('user', 'stock.idU = user.idU')
								->group_by('numStock')
								->get();
					return $query->result_array();
		}
		public function findLastStockNumber(){
			$query = $this->db
	                        ->select_max('numStock')
	                        ->from('stock')
	                        ->limit(1)
	                        ->get();
	        $res = $query->row_array();
	        return $res['numStock'];
	     }

	    public function getOneStock($numStock){
		        $query = $this->db
		            ->select('numStock,quantites,dateStock, codeProds,nomProd')
		            ->from('stock')
					->join('produit', 'codeProd = codeProds', 'left')
					->where('numStock = ',$numStock)
					->order_by('nomProd','ASC')
		            ->order_by('codeProds','ASC')
		            ->get();
		        return $query->result_array();
		}
		public function getDateStock($idy){
			$query = $this->db->distinct('dateStock')
								->from('stock')
								->where('numStock',$idy)
								->group_by('numStock')
								->get();			
			$res = $query->row_array();
			return $res['dateStock'];
		}
		public function getNomEnregistreur($idy){
			$query = $this->db->distinct('nom, prenom')
								->from('stock')
								->join('user', 'user.idU = stock.idU AND numStock = '.$idy)
								//->where('numStock',$idy)
								->group_by('numStock')
								->get();			
			$res = $query->row_array();
			return $res['nom'].' '.$res['prenom'];
		}
}