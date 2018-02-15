<?php
	
	class SellModel extends CI_Model{
		
		function __construct(){
			parent::__construct();
		}
		
		public function getAll(){
			$query = $this->db->select('*')
								->from('produit')
								->where('stock > 0')
								->get();
					return $query->result_array();
		}

		public function getClientName($idy){
			$query = $this->db->distinct('nomClient')
								->from('facture')
								->join('client', 'client.numClient = facture.idClient')
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

		public function searchClient($name){
			$query = $this->db->select();
		}

		public function seachSeller($id){
			$query = $this->db->distinct('nom, prenom')
								->from('facture')
								->join('user', 'user.idU = facture.idU')
								->where('numFacture',$id)
								->group_by('numFacture')
								->get();			
			$res = $query->row_array();
			return $res['nom'].' '.$res['prenom'];

		}

		public function enregFact($vals){
			$query = $this->db->insert('facture',$vals);
            $this->db->reset_query();
            return $query;
		}

		public function getStock($id){
			$query = $this->db->select('stock')
								->from('produit')
								->where('idProd', $id)
								->get();
            	return $query->result_array();
		    
		}
		// mise a jour du stock dans la table produit
		public function updateStock($id, $vals){
			$query = $this->db->where("idProd",$id)
							  ->update("produit", $vals);
								
			$this->db->reset_query();
            return $query;
		}
		public function getAllFacture(){
			$query = $this->db->select('numFacture, numBordereau, nomClient,sum(quantite) as qty, sum(quantite*prixV) as total_paid, dateFact')
								->from('facture')
								->join('client', 'client.numClient = facture.idClient')
								->group_by('numFacture')
								->order_by('idFact DESC')
								->get();
					return $query->result_array();
		}

		public function getOneFacture($idy){
			$query = $this->db->select('nomClient, idProds, nomProd, quantite, prixV,(quantite*prixV) as tot, dateFact')
								->from('facture')
								->join('client', 'client.numClient = facture.idClient')
								->join('produit', 'produit.idProd = facture.idProds')
								->where('numFacture',$idy)
								->group_by('idProd')
								->order_by('nomProd ASC')
								->get();
					return $query->result_array();
		}

		public function getTotalFact($idy){
			$query = $this->db->select('sum(quantite*prixV) as tot')
								->from('facture')
								->where('numFacture',$idy)
								->group_by('numFacture')
								->get();
			/*foreach ($query->result() as $row){
	        	echo $row->tot;
			}*/
			$res = $query->row_array();
			return $res['tot'];
		}

		public function getXDeCaisse($date1, $date2){
			/*
			$query = $this->db->select('numFacture, idClient, nomClient,sum(quantite) as qty, sum(prixV*quantite) as tot, dateFact')
								->from('facture')
								->join('client', "facture.idClient = client.numClient")
								->like('dateFact', $date1, 'after')
								->or_like('dateFact', $date2, 'after')
								->group_by('numFacture')
								->order_by('idFact ASC')
								->get();
					return $query->result_array();
			*/
			$query = $this->db->select('numFacture, idClient, nomClient,sum(quantite) as qty, sum(prixV*quantite) as tot, dateFact')
						->from('facture')
						->join('client', "facture.idClient = client.numClient AND dateFact between '$date1 00:00:00' and '$date2 23:59:59'")
						->group_by('numFacture')
						->order_by('idFact ASC')
						->get();
			return $query->result_array();
		}
}