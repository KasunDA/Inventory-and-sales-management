<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProduitController extends CI_Controller {

	public function __construct(){
		parent::__construct();
        $this->load->model('ProduitModel'); 
	}

	public function ajouterProduit(){
		$data['title'] = 'Ajouter Produit';
		$data['headings'] = "Ajouter un Produit";
		$data['headings1'] = "Ajouter un Produit dans la base de données de votre boutique";
		$this->load->view('addProduit', $data);
	}
	
	public function add(){
		//form validation rules for the forms
		$this->form_validation->set_rules('codeP','Code Produit','required|min_length[2]|is_unique[produit.codeProd]',
										 array('required' => 'Veuillez renseigner le champ : %s',
										 		'min_length' => 'Entrez au moins 02 caractéres pour %s',
										 		'is_unique' => 'Un produit avec ce code existe déjà'
										 	)
										);
		$this->form_validation->set_rules('nom','Nom','required|min_length[4]',
											array('required' => 'Veuillez renseigner le champ : %s',
										 		'min_length' => 'Entrez au moins 02 caractéres pour %s'
										 	)
										);
		$this->form_validation->set_rules('poids','Poids','required|min_length[1]|numeric');
		$this->form_validation->set_rules('prix','Prix Unitaire','required|min_length[1]|numeric');
		$this->form_validation->set_rules('prixC1','Prix C1','required|min_length[1]|numeric');
		$this->form_validation->set_rules('prixC2','Prix C2','required|min_length[1]|numeric');
		$this->form_validation->set_rules('prixC3','Prix C3','required|min_length[1]|numeric');
		$this->form_validation->set_rules('prixC4','Prix C4','required|min_length[1]|numeric');
		if($this->form_validation->run() == TRUE){
			if(isset($_POST['ok'])){
				extract($_POST);
				$cmertime = date("H")+1;
				$time = date($cmertime.":i:s");
				$dateAjout = date("Y-m-d $time");
				//$dateAjout = date('Y-m-d');
				$tab = array('codeProd' => strtolower($codeP), 'nomProd' => strtolower($nom), 
							'description' => strtolower($desc), 'origin' => strtolower($orig), 
							'poid' => strtolower($poids), 'prixU' => $prix, 'prixC1' => $prixC1, 
							'prixC2' => $prixC2, 'prixC3' => $prixC3, 'prixC4' => $prixC4, 
							'dateAjout' =>$dateAjout, 'stock'=>0);
				$query = $this->ProduitModel->ajouter($tab);
				//var_dump($this->db->affected_rows());
				if($this->db->affected_rows() == 1){
					$msg = 'Produit Enrégistré Avec Success';
				}
				else{
					$msg = 'error during the insertion of this product';
				}

			}
			$data['title'] = 'Ajouter Produit';
			$data['headings'] = "Ajouter un Produit";
			$data['headings1'] = "Ajouter un Produit dans la base de données de votre boutique";
			$data['msg'] = $msg;
			$this->load->view('addProduit', $data);
		
		}else{
			$this->ajouterProduit();
		}
	}

	public function listerProduit(){
		$data['title'] = 'Lister Produits';
		$data['headings'] = "Lister Produits";
		$data['produits'] = $this->ProduitModel->lister();
		$data['headings1'] = "Voici la liste de tout les produits disponible dans votre boutique";
		$this->load->view('listerProduit', $data);
	} 
	
	public function loadPrixU(){	
		if (isset($_GET['colprix'])) {			
			$nomprod = $_GET['nomprod'];
			$colprix = $_GET['colprix'];
			//recuperer code du produit
			$codeprod = $this->ProduitModel->findCodeProduit($nomprod);			
			// recuperer le prix unitiare du produit pour la categorie du client
			$this->ProduitModel->loadPrixProduit($codeprod, $colprix); 	
		} 		
	}
}
