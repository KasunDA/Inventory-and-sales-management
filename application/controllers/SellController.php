<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require('fpdf.php');
require_once('dateFrench.php');
require_once('NumberToWords.php');
class PDF extends FPDF {
	function Footer(){
		$tab = DateFrench();
	    $this->SetY(-18);
	    $this->SetX(10);
	    $this->SetFont('courieri','I',8);
	    $this->Cell(0, 10, utf8_decode("Les Marchandises vendues restent la propriété de BELGOCAM jusqu'au règlement total de la Facture"),0,1,'C');
	    $this->SetFont('Consolas','',8);
	    $this->SetY(-18);
	    $this->SetX(10);
	    $this->Cell(0,10,'________________________________________________________________________________________________________________________',0,1,'C');
	    $this->SetFont('Consolas','',7);
	    $this->SetY(-15);
	    $this->SetX(10);
	    $y = date('Y');
	    $this->Cell(0,10,utf8_decode("© SAMARYTAN $y | Tel: +237 670-824-649 / +237 691-297-447 | Date d'édition : ".$tab[0]." à ".$tab[1]."H ".$tab[2]."Min ".$tab[3]."S |     Page ".$this->PageNo()."/{nb}"),0,0,'C');
	}	
}

class SellController extends CI_Controller {

	public function __construct(){
		parent::__construct();		 
        $this->load->model('SellModel'); 
        $this->load->model('ClientModel'); 
        $this->load->model('CategorieModel'); 
        $this->load->model('ClientModel'); 
        $this->load->model('ProduitModel'); 
        $this->load->model('StockModel');
        //$this->load->model('FactureModel'); 

	}

	public function header($pdf,$test,$name,$seller_name,$dateFact) {
		HeaderA5($pdf,$test,$name,$seller_name,$dateFact);		
	}
	public function header1($pdf, $date1, $date2, $nomEnreg){
		HeaderA5X($pdf, $date1, $date2, $nomEnreg);
	}

	public function sell(){
		$data['title'] = 'Ventes';
		$data['headings'] = "Vendre un ou plusieurs produits";
		$data['headings1'] = " ";
		//$data['produits'] = $this->SellModel->getAll(); 
		$data['clients'] = $this->ClientModel->lister();
		//echo $data['produits'];
			
		$this->load->view('sell', $data);
	}
	
	//return the clients infos with his corresponding prices
	public function getClientInfos(){
		$nomclient = strtolower($this->input->post('client'));		
		$infos = $this->ClientModel->getClientInfos($nomclient);
			if($infos != null){
				$msg = 'Client Trouvé';
				$articles = TRUE;
			}
			else{
				$msg = 'Ce Client n\'existes pas dans la base de données';
				$articles = FAlSE;
			}

		$this->cart->destroy();
		$data['numclient'] = $infos['numClient'];
		$data['nomclient'] = $infos['nomClient'];
		$libellecat = $infos['categorie'];

		$idCat = $this->CategorieModel->getIdCategorie($libellecat);
		$prixU = $this->CategorieModel->InitCategorie($idCat); //colonne prix pour categorie
		$data['catclient'] = $libellecat;
		$data['idcatclient'] = $idCat;
		$data['colprix'] = $prixU;
		$data['msg'] = $msg;
		$data['articles'] = $articles;
		
		$data['title'] = 'Ventes';
		$data['headings'] = "Vendre un ou plusieurs produits";
		$data['headings1'] = " ";
		$data['clients'] = $this->ClientModel->lister();
		// $data['produits'] = $this->SellModel->getAll();
		$data['produits'] = $this->ProduitModel->loadPrixClient($prixU);
		$this->load->view('sell', $data);
	}
	
	/******************************************************************
		MANAGEMENT OF MY CART OBJECTS
	*/
	public function opencart(){
        $data['cart']  = $this->cart->contents();
        $this->load->view("cart_modal", $data);
    }
    	// adds contents to cart
    public function add(){
		// Set array for send data.
		$insert_data = array(
					'id' => $this->input->post('id'),
					'name' => $this->input->post('name'),
					'price' => $this->input->post('price'),
					//'image' => $this->input->post('poid'),
					'codeProd' => 'P001',
					'stock' => $this->input->post('stock'),
					'qty' => 1
					);
		// This function add items into cart.
		$this->cart->insert($insert_data);
		// returns the number of items in the cart
		echo $nb = count($this->cart->contents());
	}

	public function remove() {
		$rowid = $this->input->post('rowid');
		// Check rowid value.
		if ($rowid==="all"){
		// Destroy data which store in session.
			$this->cart->destroy();
		}else{
		// Destroy selected rowid in session.
		$data = array(
				'rowid' => $rowid,
				'qty' => 0
				);
		// Update cart data, after cancel.
		$this->cart->update($data);
		}
		echo $nb = count($this->cart->contents());
		// This will show cancel data in cart.
	}

	public function update_cart(){
		// Recieve post values,calcute them and update
		$rowid = $this->input->post('rowid');
		$price = $this->input->post('price');
		$amount = $price * $this->input->post('qty');
		$qty = $_POST['qty'];

		$data = array(
			'rowid' => $rowid,
			'price' => $price,
			'amount' => $amount,
			'qty' => $qty
			);
		$this->cart->update($data);
		echo $data['amount'];
	}

	// enrégistrer la vente 
	
	public function enregistrer(){
		if ($cart = $this->cart->contents()):
			//creation du numéro de la facture
			$date = date("Ymd");
			$cmertime = date("H")+1;
			$time = date($cmertime."is");
			$numFact = $date.$time;
			//--------------------------------
			$idClient = $_SESSION['numClient'];

			$nomClient = $_SESSION['nomClient'];		
			$idU = $this->session->userdata('userid');			
				
			//$prenom = $this->session->userdata('usersurname');	
			$time1 = date($cmertime.":i:s");
			$dateFact = date("Y-m-d $time1");		
			//copie des elements du panier
			foreach ($cart as $item):
			//array pour enregistrer une vente
			$tab = array('numFacture' => $numFact, 'numBordereau' => $numFact,'idClient' => $idClient,
						 'idProds' => $item['id'], 'prixV' => $item['price'], 'quantite' => $item['qty'],
						 'dateFact' => $dateFact, 'idU' => $idU
			 );
			//array pour mettre stock a jour
			$idy = $item['id'];
			$stock = $item['stock'];
			$qty = $item['qty'];

				$newStock = $stock - $qty;
				$tab1 = array('stock' => $newStock);
				$seller_name = $this->SellModel->seachSeller($numFact);
					//check if a stock value is negative before proceeding
					if($newStock < 0){
						$msg = 'echec de la transaction: une quantité est supérieure au stock';
						 goto jump;
					}


				$this->db->trans_begin();

					$query1 = $this->SellModel->updateStock($idy, $tab1);
					$query = $this->SellModel->enregFact($tab);

				if ($this->db->trans_status() === FALSE){
					$this->db->trans_rollback();
					$msg = 'TRANSACTION A ECHOUE!!!!!';
				}else{
					$this->db->trans_commit();
					$msg = 'TRANSACTION S\'EST TERMINE AVEC SUCCESS!!!!!';
				}
			endforeach;
			
			$date = DateToStringConvertion($dateFact);
			// $this->ProduceFacture($numFact,$nomClient,$dateFact);
			$data['lien'] = $this->ProduceFacture($numFact,$nomClient,$seller_name,$date);
		endif;
			unset(
				$_SESSION['numClient'],
				$_SESSION['nomClient']
			);
			$this->cart->destroy();	
			jump:
			$data['title'] = 'Ventes';
			$data['headings'] = "Vendre un ou plusieurs produits";
			$data['headings1'] = "Vendre un ou plusieurs produits";
			$data['msg'] = $msg;
			$data['clients'] = $this->ClientModel->lister();
			
			$this->load->view('sell', $data);
			// redirect('/SellController/sell/');
	}

	public function listerFactures(){

		$data['title'] = 'Lister Factures';
		$data['headings'] = "Lister Factures";
		$data['factures'] = $this->SellModel->getAllFacture();
		$data['headings1'] = "Voici la liste de tout les Factures de la boutique";
		$this->load->view('listerFacture', $data);
	}

	public function printFacture(){
		if (isset($_GET['id'])) {
			$id = $_GET['id'];
			if($id != null){
				$client_name = $this->SellModel->getClientName($id);
				$dateFact = $this->SellModel->getDateFact($id);
				$seller_name = $this->SellModel->seachSeller($id);

				$date = DateToStringConvertion($dateFact);
				/*
					function to be used in displaying the contents of the pdf
				$pdf = $this->output
						        ->set_content_type('pdf')
						        ->set_output(file_get_contents('document/facture.pdf'));
				*/
				$data['lien'] = $this->ProduceFacture($id,$client_name,$seller_name, $date);
				$data['title'] = 'Lister Factures';
				$data['headings'] = "Lister Factures";
				$data['factures'] = $this->SellModel->getAllFacture();
				$data['headings1'] = "Voici la liste de tout les Factures de la boutique";
				$this->load->view('listerFacture', $data);
				//$this->listerFactures();
				//redirect('/SellController/sell/');
			}
		}
	}

	public function ProduceFacture($test,$name,$seller_name, $dateFact){
		$pdf = new PDF();
		$pdf->AliasNbPages();
		$pdf->SetAutoPageBreak(1,13);
		$pdf->SetAuthor('simobrice6@gmail.com');
		$pdf->SetCreator('fpdf 1.81');
		$pdf->SetSubject('Factures des ventes');
		$pdf->AddPage('L','A5');
		$this->header($pdf,$test,$name,$seller_name,$dateFact);
		$w = array(10,80,30,20,50);

		$facture = $this->SellModel->getOneFacture($test);
		$total = $this->SellModel->getTotalFact($test);
		$i=1;
		$qtite = 0;
		foreach ($facture as $fact) {
			if ($i%2 == 1) {$border = ''; $rb='';} 
			else {$border = 'L'; $rb='R';}
			$pdf->SetFont('courieri','I',10);
			$pdf->Cell($w[0],5,$i,$border,0,'C', false);
			$pdf->Cell($w[1],5,utf8_decode(strtoupper($fact['nomProd'])),$border,0,'L', false);
			$pdf->Cell($w[2],5,$fact['prixV'].' Fcfa',$border,0,'C', false);
			$pdf->Cell($w[3],5,$fact['quantite'],$border,0,'C', false);	
			$pdf->Cell($w[4],5,$fact['tot'].' Fcfa',$border.$rb,1,'C', false);
			$i++;
			$qtite +=$fact['quantite'];
		}
		
		$pdf->Cell($w[0]+$w[1],6,'','TR',0,'C', false);
		$pdf->SetFont('Consolas','',10);
		$pdf->Cell($w[2],6,'TOTAL','BT',0,'C', false);
		$pdf->Cell($w[3],6,$qtite,'BT',0,'C', false);
		$pdf->Cell($w[4],6,$total.' Fcfa','BRT',1,'C', false);
		$pdf->SetFont('courieri','I',10);
		$pdf->Cell(18,6,utf8_decode('Montant:'),'',0,'L', false);
		$pdf->SetFont('Consolas','',10);
		$pdf->Cell(172,6, ucwords(int2str($total)).' Fcfa','',1,'L', false);

		$pdf->SetFont('courieri','I',10);

		$x = $pdf->GetX();
		$y = $pdf->GetY();
		$pdf->SetXY($x+10,$y);
		$pdf->Cell(60,8,utf8_decode('Signature Du Magasinier'),'',0,'L', false);
		$pdf->Cell(60,8,utf8_decode('Signature Du Client'),'',0,'L', false);
		$pdf->Cell(60,8,utf8_decode('Signature De La Caisse'),'',0,'L', false);

		$pdf->Output("document/facture.pdf",'F');
		$lien = "document/facture.pdf";
		//return $lien;
		$data['lien'] = $lien;
		return $data['lien'];
	}

	public function xDeCaisse(){
		$data['title'] = 'Produire X De Caisse';
		$data['headings'] = "Produire X De Caisse";
		$data['headings1'] = "Produire X De Caisse dans l'intervale de 2 dates";
		$this->load->view('xdecaisse', $data);
	}

	public function printXDeCaisse(){
		if (isset($_POST['date1']) && isset($_POST['date2'])) {
			$date1 = $_POST['date1'];
			$date2 = $_POST['date2'];
			if($date1 != null && $date2 != null){
				// change the date formats to the desired ones
				// $D1 = str_replace("/", "-", $date1).' 00:00:00';
				// $D2 = str_replace("/", "-", $date2).' 23:59:59';
				$D1 = str_replace("/", "-", $date1);
				$D2 = str_replace("/", "-", $date2);
				$nomEnreg = $_SESSION['username'].' '.$_SESSION['usersurname'];
				/*
				$D1 = DateToStringConvertion($date1);
				$D2 = DateToStringConvertion($date2);
				*/
				
				$data['lien'] = $this->ProduceXDeCaisse($D1, $D2, $nomEnreg);
				$data['title'] = 'Produire X De Caisse';
				$data['headings'] = "Produire X De Caisse";
				$data['headings1'] = "Produire X De Caisse dans l'intervale de 2 dates";
				$this->load->view('xdecaisse', $data);
				//$this->listerFactures();
				//redirect('/SellController/sell/');
			}
		}
	}

	public function ProduceXDeCaisse($date1, $date2, $nomEnreg){
		$pdf = new PDF();
		$pdf->AliasNbPages();
		$pdf->SetAutoPageBreak(1,13);
		$pdf->SetAuthor('simobrice6@gmail.com');
		$pdf->SetCreator('fpdf 1.81');
		$pdf->SetSubject('X De Caisse du '.$date1.' au '.$date2);
		$pdf->AddPage('L','A5');
		$this->header1($pdf, $date1, $date2, $nomEnreg);
		$w = array(9,33,54,45,13,32);

		$xdecaisse = $this->SellModel->getXDeCaisse($date1, $date2);
		$i=1;
		$qtite = 0;
		$tot = 0;
		foreach ($xdecaisse as $xdc) {
			if ($i%2 == 1) {$border = ''; $rb='';} 
			else {$border = 'L'; $rb='R';}
			$pdf->SetFont('courieri','I',10);
			$pdf->Cell($w[0],5,$i,$border,0,'C', false);
			$pdf->Cell($w[1],5,$xdc['numFacture'],$border,0,'L', false);
			$pdf->Cell($w[2],5,utf8_decode(strtoupper(substr($xdc['nomClient'],0,24))),$border,0,'L', false);
			$pdf->Cell($w[3],5,utf8_decode(strtoupper($xdc['dateFact'])),$border,0,'C', false);
			$pdf->Cell($w[4],5,$xdc['qty'],$border,0,'C', false);	
			$pdf->Cell($w[5],5,$xdc['tot'].' Fcfa',$border.$rb,1,'C', false);
			$i++;
			$qtite +=$xdc['qty'];
			$tot += $xdc['tot'];
		}
		
		$pdf->Cell($w[0]+$w[1]+$w[2],6,'','TR',0,'C', false);
		$pdf->SetFont('Consolas','',10);
		$pdf->Cell($w[3],6,'TOTAL','BT',0,'C', false);
		$pdf->Cell($w[4],6,$qtite,'BT',0,'C', false);
		$pdf->Cell($w[5],6,$tot.' Fcfa','BRT',1,'C', false);
		$pdf->SetFont('courieri','I',10);
		$pdf->Cell(18,6,utf8_decode('Montant:'),'',0,'L', false);
		$pdf->SetFont('Consolas','',10);
		$pdf->Cell(172,6, ucwords(int2str($tot)).' Fcfa','',1,'L', false);

		$pdf->SetFont('courieri','I',10);
		/*
		$x = $pdf->GetX();
		$y = $pdf->GetY();
		$pdf->SetXY($x+10,$y);
		$pdf->Cell(60,8,utf8_decode('Signature Du Magasinier'),'',0,'L', false);
		$pdf->Cell(60,8,utf8_decode('Signature Du Client'),'',0,'L', false);
		$pdf->Cell(60,8,utf8_decode('Signature De La Caisse'),'',0,'L', false);
		*/

		$pdf->Output("document/xdecaisse.pdf",'F');
		$lien = "document/xdecaisse.pdf";
		//return $lien;
		$data['lien'] = $lien;
		return $data['lien'];
	}	    
}