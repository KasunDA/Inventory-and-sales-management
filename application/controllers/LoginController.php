<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoginController extends CI_Controller {

	public function __construct(){
		parent::__construct();
        $this->load->model('loginModel'); 
	}

	public function index(){
		$data['title'] = "Login Page";
		$this->load->view('login', $data);
	}

	public function home(){
		$data['title'] = "Home Page";
		$data['headings'] = "Shop";
		$data['alert'] = "Connexion Réussi";
		$data['alert1'] = "Votre session est maintenant actif";
		$this->load->view('home', $data);
	}

	public function connect(){
    	$this->form_validation->set_rules('login','Login','required|min_length[1]');
    	$this->form_validation->set_rules('password','Mot De Passe','required|min_length[1]');

    	$login = stripslashes(strtolower(($this->input->post('login'))));
		$passwd = stripslashes($this->input->post('password'));
		
		$cipher = '$'.base64_encode('simo').'$'. md5($passwd);

		if($this->form_validation->run() == TRUE){
			$tab = array('login' => $login, 'password' => $cipher);
			$tab1 = $this->loginModel->findOneUser($tab);
			if ($tab1['nbre'] == 1) {
					$sessiondata = array(
					        'userid'  => $tab1['idU'],
					        'username'  => $tab1['nom'],
					        'usersurname'  => $tab1['prenom'],
					        'idrole'  => $tab1['idRole'],
					        'logged_in' => TRUE
					);
				$this->session->set_userdata($sessiondata);
				$this->home();
			}
			else {
					$data['msg']  = '<b>Login OU Mot De Passe Invalide</b>';
					$data['title'] = "Login Page";
					$this->load->view("login", $data);
				}
		}
		else {
			$this->index();
		 }

    }

    public function logout(){
    	session_destroy();
    	$data['title'] = "Login Page";
    	$this->load->view("login", $data);
    }

    public function ajouterProduit(){
		$data['title'] = 'Ajouter Produit';
		$data['headings'] = "Ajouter un Produit";
		$this->load->view('addProduit', $data);
	}
}
