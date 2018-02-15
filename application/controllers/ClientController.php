<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ClientController extends CI_Controller {

	public function __construct(){
		parent::__construct();
        $this->load->model('ClientModel'); 
        $this->load->model('CategorieModel'); 
	}

	public function ajouterClient(){
		$data['title'] = 'Ajouter Clients';
		$data['headings'] = "Ajouter un Client";
		$data['headings1'] = "Ajouter un Client dans la base de données de votre boutique";
       
        $cmertime = date("H")+1;
        $time1 = date($cmertime.":i:s");
		$data['date'] = date("Y-m-d $time1");
       
		$data['cats'] = $this->CategorieModel->lister();
        //unix_to_human(time('d-m-Y'), TRUE, 'eu');
		$this->load->view('addClient', $data);
	}

	public function add(){
		//form validation rules for the forms
		$this->form_validation->set_rules('nom','Noms Client','required|min_length[2]',
										 array('required' => 'Veuillez renseigner le champ : %s',
										 		'min_length' => 'Entrez au moins 02 caractéres pour %s'
										 	)
										);
		$this->form_validation->set_rules('localite','Localite','required|min_length[4]',
											array('required' => 'Veuillez renseigner le champ : %s',
										 		'min_length' => 'Entrez au moins 02 caractéres pour %s'
										 	)
										);
		$this->form_validation->set_rules('tel1','Contact 1','required|min_length[9]|max_length[9]|numeric|is_unique[client.contact1]|is_unique[client.contact2]',
											array('required' => 'Veuillez renseigner le champ : %s',
										 		'min_length' => 'Entrez au moins 02 caractéres pour %s',
										 		'numeric'	=>	'Entrez un numéro valide',
										 		'min_length'	=>	'Entrez un numéro avec au moins 9 chiffres',
										 		'max_length'	=>	'Entrez un numéro avec au plus 9 chiffres',
										 		'is_unique'	=>	'Ce numéro existe déjà dans la base de données'
										 	)
										);
		$this->form_validation->set_rules('tel2','Contact 2','min_length[9]|max_length[9]|numeric|is_unique[client.contact1]|is_unique[client.contact2]|differs[tel1]',
											array(
										 		'min_length' => 'Entrez au moins 02 caractéres pour %s',
										 		'numeric'	=>	'Entrez un numéro valide',
										 		'min_length'	=>	'Entrez un numéro avec au moins 9 chiffres',
										 		'max_length'	=>	'Entrez un numéro avec au plus 9 chiffres',
										 		'is_unique'	=>	'Ce numéro existe déjà dans la base de données',
										 		'differs'	=>	'Ces numéros Doivent être différent'
										 	)
										);
		if($this->form_validation->run() == TRUE){
			if(isset($_POST['ok'])){
				extract($_POST);
				//$date= unix_to_human(time(), TRUE, 'GB');
				$cmertime = date("H")+1;
				$time = date($cmertime.":i:s");
				$dateAjout = date("Y-m-d $time");
				
				$tab = array('nomClient' => strtolower($nom), 'nomEntreprise' => strtolower($entreprise), 
							'nomPromoteur' => strtolower($promoteur),'localite' => strtolower($localite), 
							'categorie' => strtolower($cat), 'representant' => strtolower($representant),
	                        'codePostal' => strtolower($codepostal), 'dateEnreg' => $dateAjout, 
	                        'contact1'=>$tel1,'contact2'=>$tel2);
				$query = $this->ClientModel->ajouter($tab);
				$msg = 'Client was successfully inserted';
				if($this->db->affected_rows() == 1){
					$msg = 'Client Enrégistré Avec Success';
				}
				else{
					$msg = 'error during the insertion of this product';
				}
			}
	        $data['title'] = 'Ajouter Clients';
			$data['headings'] = "Ajouter un Client";
			$data['headings1'] = "Ajouter un Client dans la base de données de votre boutique";
			$data['msg'] = $msg;
			$data['date'] = date("Y-m-d $time1");
			$this->load->view('addClient', $data);
			//redirect('/ClientController/ajouterClient/');
		}else{
			$this->ajouterClient();
		}
	}

	public function listerClient(){
		$data['title'] = 'Lister Clients';
		$data['headings'] = "Lister Clients";
		$data['clients'] = $this->ClientModel->lister();
		$data['headings1'] = "Voici la liste de tout les Clients disponible dans votre boutique";
		$this->load->view('listerClient', $data);
	}
}
