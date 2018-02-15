<?php
	
	class ProduitModel extends CI_Model{
		
		function __construct(){
			parent::__construct();
			$this->load->database("db");
		}
		
		public function ajouter($vals){
			$query = $this->db->insert('produit',$vals);
                //$this->db->reset_query();
                return $query;
		}
		
		public function lister(){
			$query = $this->db->select('*')
								->from('produit')
								->get();
			return $query->result_array();
		}

		public function loadPrixClient($prixU){
			$query = $this->db->select('idProd,stock, codeProd, nomProd,'.$prixU)
								->from('produit')
								->where('stock > 0')
								->get();
			if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $a[] = array(
                		'idProd' => $row['idProd'],
                        'codeProd' => $row['codeProd'],
                        'nomProd' => $row['nomProd'],
                        'prix' => $row[$prixU],
                        'stock' => $row['stock']
                         );
                }     
	         }  
	         else $a[] = null;
	                       
	        return $a;
		}

		public function loadPrixProduit($codeprod, $colprix) {
			$query = $this->db
	                        ->select('codeProd, '.$colprix)
	                        ->from('produit')
	                        ->where('codeProd',$codeprod)
	                        ->get();
	        $res = $query->row_array();
	        echo $res[$colprix];
	     }

		public function findCodeProduit($nomprod) {
			$query = $this->db
	                        ->select('codeProd')
	                        ->from('produit')
	                        ->where('nomProd',$nomprod)
	                        ->get();
	        $res = $query->row_array();
	        return $res['codeProd'];
	     }

	     public function findIDProduit($nomprod,$codeprod) {
			$query = $this->db
	                        ->select('idProd')
	                        ->from('produit')
	                        ->where('codeProd',$codeprod)
	                        ->where('nomProd',$nomprod)
	                        ->get();
	        $res = $query->row_array();
	        return $res['idProd'];
	     }

	     public function findQuantiteProduit($codeprod,$nomprod) {
			$query = $this->db
	                        ->select('stock')
	                        ->from('produit')
	                        ->where('codeProd',$codeprod)
	                        ->where('nomProd',$nomprod)
	                        ->get();
	        $res = $query->row_array();
	        return $res['stock'];
	     }
		
		public function updateQuantiteProduit($vals, $ID){
			$query = $this->db->where('idProd', $ID)
							  ->update('produit', $vals);
			return $query;

		}

		/*
		public function supprimer($id){
			$query = $this->db->delete('produit', array('idProd' => $id));
		}

		

		public function getProduit($id){
			$query = $this->db->select('*')
								->from('produit')
								->where('idProd',$id)
								->get(produit);
					return $query->result_array();
		}
		*/
	
	}



