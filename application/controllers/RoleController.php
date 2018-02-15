<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RoleController extends CI_Controller {

	public function __construct(){
		parent::__construct();
        $this->load->model('RoleModel'); 
	}

	public function ajouterRole(){
		$data['title'] = 'Ajouter Role';
		$data['headings'] = "Ajouter un Role";
		$data['headings1'] = "Ajouter un Role dans la base de données de votre boutique";
        $data['roles'] = $this->RoleModel->lister();
		$this->load->view('addRole', $data);
	}
	
    public function add(){
    	$this->form_validation->set_rules('libelle','Libelle Role','required|min_length[2]|is_unique[role.libelleRole]',
										 array('required' => 'Veuillez renseigner le champ : %s',
										 		'min_length' => 'Entrez au moins 02 caractéres pour %s',
										 		'is_unique' => 'Ce role existe déjà'
										 	)
										);
    	if($this->form_validation->run() == TRUE){
			if(isset($_POST['ok'])){
				extract($_POST);
				$date= unix_to_human(time(), TRUE, 'eu');
				//'dateAjout' => $date,
				$tab = array('libelleRole' => strtolower($libelle));
				$query = $this->RoleModel->ajouter($tab);
				if($this->db->affected_rows() == 1){
					$msg = 'Role Enrégistré Avec Success';
				}
				else{
					$msg = 'error during the insertion of this Role';
				}
			}
			$data['title'] = 'Ajouter Role';
			$data['headings'] = "Ajouter un Role";
			$data['headings1'] = "Ajouter un Role dans la base de données de votre boutique";
	        $data['roles'] = $this->RoleModel->lister();
			$data['msg'] = $msg;
			$this->load->view('addRole', $data);
		}else{
			$this->ajouterRole();
		}
	}

}