<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CategorieController extends CI_Controller {

	public function __construct(){
		parent::__construct();
        $this->load->model('CategorieModel'); 
	}

	public function ajouterCategorie(){
		$data['title'] = 'Ajouter Categorie';
		$data['headings'] = "Ajouter une Categorie";
		$data['headings1'] = "Ajouter une Categorie dans la base de données de votre boutique";
        $data['cat'] = $this->CategorieModel->lister();
		$this->load->view('addCategorie', $data);
	}

	public function add(){
		$this->form_validation->set_rules('cat','Libelle Categorie','required|min_length[2]|is_unique[categorie.libelleCat]',
										 array('required' => 'Veuillez renseigner le champ : %s',
										 		'min_length' => 'Entrez au moins 02 caractéres pour %s',
										 		'is_unique' => 'Cette Categorie existe déjà'
										 	)
										);
		if($this->form_validation->run() == TRUE){
			if(isset($_POST['ok'])){
				extract($_POST);
				$tab = array('libelleCat' => strtolower($cat));
				$query = $this->CategorieModel->ajouter($tab);
				if($this->db->affected_rows() == 1){
					$msg = 'Categorie Enrégistré Avec Success';
				}
				else{
					$msg = 'error during the insertion of this Category';
				}
			}
			$data['title'] = 'Ajouter Categories';
			$data['headings'] = "Ajouter une Categorie";
			$data['headings1'] = "Ajouter une Categorie dans la base de données de votre boutique";
			$data['msg'] = $msg;
			$data['cat'] = $this->CategorieModel->lister();
			$this->load->view('addCategorie', $data);	
		}else{
			$this->ajouterCategorie();
		}
	}

	public function listerCategorie(){
		$data['title'] = 'Lister Categories';
		$data['headings'] = "Lister Categories";
		$data['cat'] = $this->CategorieModel->lister();
		$data['headings1'] = "Voici la liste de tout les Categories disponible dans votre boutique";
		$this->load->view('addCategorie', $data);
	} 
}