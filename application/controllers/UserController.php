<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserController extends CI_Controller {

	public function __construct(){
		parent::__construct();
        $this->load->model('UserModel'); 
        $this->load->model('RoleModel'); 
	}

	public function ajouterUser(){
		$data['title'] = 'Ajouter Utilisateurs';
		$data['headings'] = "Ajouter un Utilisateur";
		$data['headings1'] = "Ajouter un Utilisateur dans la base de données de votre boutique";
        $data['user'] = $this->UserModel->lister();
		$data['roles'] = $this->RoleModel->lister();
		$this->load->view('addUser', $data);
	}

	public function add(){
		$this->form_validation->set_rules('nom','Nom','required|min_length[2]',
										 array('required' => 'Veuillez renseigner le champ : %s',
										 		'min_length' => 'Entrez au moins 02 caractéres pour %s'
										 	)
										);
		$this->form_validation->set_rules('prenom','Prénom','min_length[2]',
										 array('min_length' => 'Entrez au moins 02 caractéres pour %s')
										);
		$this->form_validation->set_rules('tel','Telephone','required|min_length[9]|max_length[9]|numeric|is_unique[user.telephone]',
											array('required' => 'Veuillez renseigner le champ : %s',
										 		'min_length' => 'Entrez au moins 02 caractéres pour %s',
										 		'numeric'	=>	'Entrez un numéro valide',
										 		'min_length'	=>	'Entrez un numéro avec au moins 9 chiffres',
										 		'max_length'	=>	'Entrez un numéro avec au plus 9 chiffres',
										 		'is_unique'	=>	'Ce numéro existe déjà dans la base de données'
										 	)
										);
		$this->form_validation->set_rules('login','Login','required|min_length[2]|is_unique[user.login]',
										 array('required' => 'Veuillez renseigner le champ : %s',
										 		'min_length' => 'Entrez au moins 02 caractéres pour %s',
										 		'is_unique'	=>	'Ce login existe déjà dans la base de données'
										 	)
										);
		$this->form_validation->set_rules('pass','Mot De Passe','required|min_length[2]',
										 array('required' => 'Veuillez renseigner le champ : %s',
										 		'min_length' => 'Entrez au moins 02 caractéres pour %s'
										 	)
										);
		$this->form_validation->set_rules('pass1','Confirmer Mot De Passe','required|min_length[2]|matches[pass]',
										 array('required' => 'Veuillez renseigner le champ : %s',
										 		'min_length' => 'Entrez au moins 02 caractéres pour %s',
										 		'matches'	=>	'Confirmation pass indentique au précédent'
										 	)
										);
		if($this->form_validation->run() == TRUE){
			if(isset($_POST['ok'])){
				extract($_POST);
				if($pass == $pass1){
					$cipher = '$'.base64_encode('simo').'$'. md5($pass);
				    $tab = array('nom'=> strtolower($nom),'prenom'=> strtolower($prenom),'telephone'=> $tel,
				    			'password'=> $cipher, 'login'=> strtolower($login),'idRole'=> strtolower($role));
				    $query = $this->UserModel->ajouter($tab);
				    if($this->db->affected_rows() == 1){
						$msg = 'Utilisateur Enrégistré Avec Success';
					}
					else{
						$msg = 'error during the insertion of this User';
					}
				}
	        }
	        $data['title'] = 'Ajouter Utilisateurs';
			$data['headings'] = "Ajouter un Utilisateur";
			$data['headings1'] = "Ajouter un Utilisateur dans la base de données de votre boutique";
			$data['msg'] = $msg;
	        $data['user'] = $this->UserModel->lister();
	        $data['roles'] = $this->RoleModel->lister();
			$this->load->view('addUser', $data);
		}else{
			$this->ajouterUser();
		}
	}
}
