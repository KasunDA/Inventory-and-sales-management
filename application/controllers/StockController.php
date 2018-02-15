	<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require('fpdf.php');
require_once('NumberToWords.php');
require_once('dateFrench.php');
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
class StockController extends CI_Controller {

	public function __construct(){
		parent::__construct();
        $this->load->model('StockModel'); 
        $this->load->model('ProduitModel'); 
	}

	public function header($pdf,$numstock,$date, $nomEnreg){
		HeaderA5L($pdf,$numstock,$date, $nomEnreg);		
	}

	public function ajouterStock(){
		$data['title'] = 'Ajouter Stocks';
		$data['headings'] = "Ajouter un Stock";
		$data['headings1'] = "Ajouter un Stock dans la base de données de votre boutique"; 
        //unix_to_human(time('d-m-Y'), TRUE, 'eu');
		$data['produits'] = $this->ProduitModel->lister();
		$this->load->view('addStock', $data);
	}

	public function add(){
		if(isset($_POST['ok'])){
			$date= unix_to_human(time(), TRUE, 'FR');
			
	        //recuperer le dernier idstock
	        $nbre = $this->StockModel->findLastStockNumber();
	        $numstock = $nbre+1;	//construire le prochain numeros de stock    	
	    		    	
	    	for ($i=0; $i <5 ; $i++) { 
	    		// recuperer les variables envoyer
	    		$nomprod = $this->input->post('nom'.$i);
	    		$quantite = $this->input->post('quantite'.$i);
	    		$idU = $this->session->userdata('userid');
	    		//tester si colonne produit et quantité non null
	    		if($nomprod!=null and $quantite!=null) {
	    			//recuperer le code du produit
	    			$codeprod = $this->ProduitModel->findCodeProduit($nomprod);	    			
	    			$tab = array('numStock' => $numstock, 'quantites' => $quantite, 'codeProds' => $codeprod, 
	    						'idU' => $idU,'dateStock' => $date);
	    			//enregistrer le nouveau stock pour le produit
	    			$query = $this->StockModel->ajouter($tab);
	    			if ($query) {
	    				//recuperer la quantité en stock du produit dans la table produit
		    			$stock = $this->ProduitModel->findQuantiteProduit($codeprod, $nomprod);
		    			//ajouter la nouvelle valeur du stock nouvellement enregistré a l'ancienne valeur dans la table produit
		    			$newstock = $stock+$quantite;
		    			$tabe = array('stock' => $newstock);

		    			$idProd = $this->ProduitModel->findIDProduit($nomprod,$codeprod);
		    			
		    			// mettre a jour la quantité de stock dans la table produit
		    			$query = $this->ProduitModel->updateQuantiteProduit($tabe, $idProd);
	    			} 			
	    			$msg = 'Stock was successfully inserted';	   				
	    		}
	    	}
	    	$date = DateToStringConvertion($date);
			$data['lien'] = $this->ProduceBordereauLivraison($numstock,$date);
		}
		else{$msg = 'error during the insertion of this Stock';}
        $data['title'] = 'Ajouter Stocks';
		$data['headings'] = "Ajouter un Stock";
		$data['headings1'] = "Ajouter un Stock dans la base de données de votre boutique";
		$data['msg'] = $msg;
		$data['produits'] = $this->ProduitModel->lister();
		$this->load->view('addStock', $data);
	}

	public function listerBordereaux(){
		$data['title'] = 'Lister Stocks';
		$data['headings'] = "Lister Stocks";
		$data['stock'] = $this->StockModel->lister();
		$data['headings1'] = "Voici la liste de tout les Stocks disponible dans votre boutique";
		$this->load->view('listerStock', $data);
	}
	public function printStock(){
		if (isset($_GET['id'])) {
			$id = $_GET['id'];
			// $data['test'] = $id;
			if($id != null){
				$dateStock = $this->StockModel->getDateStock($id);
				$nomEnreg = $this->StockModel->getNomEnregistreur($id);
				//var_dump($nomEnreg);
				$date = DateToStringConvertion($dateStock);			

				$data['lien'] = $this->ProduceBordereauLivraison($id,$date,$nomEnreg);
				$data['title'] = 'Lister Stocks';
				$data['headings'] = "Lister Stocks";
				$data['stock'] = $this->StockModel->lister();
				$data['headings1'] = "Voici la liste de tout les Stocks disponible dans votre boutique";
				$this->load->view('listerStock', $data);
			}
		}
	}
	public function ProduceBordereauLivraison($numstock,$date,$nomEnreg){
		$pdf = new PDF();
		$pdf->AliasNbPages();
		$pdf->SetAutoPageBreak(1,13);
		$pdf->AddPage('L','A5');
		$this->header($pdf,$numstock,$date, $nomEnreg);
		$w = array(10,80,40,60);

		$produits = $this->StockModel->getOneStock($numstock);
		$i=1;
		$qtite = 0;
		foreach ($produits as $prod) {
			if ($i%2 == 1) {$border = ''; $rb='';} 
			else {$border = 'L'; $rb='R';}
			$pdf->SetFont('courieri','I',10);
			$pdf->Cell($w[0],5,$i,$border,0,'C', false);
			$pdf->Cell($w[1],5,utf8_decode(strtoupper($prod['nomProd'])),$border,0,'L', false);
			$pdf->Cell($w[2],5,$prod['quantites'],$border,0,'C', false);
			$pdf->Cell($w[3],5,'',$border.$rb,1,'C', false);			
			$i++;
			$qtite +=$prod['quantites'];
		}

		$pdf->SetFont('Consolas','',10);
		$pdf->Cell($w[0],8,'','LTB',0,'C', false);
		$pdf->Cell($w[1],8,'TOTAL','BT',0,'C', false);				
		$pdf->Cell($w[2],8,$qtite,'LBRT',0,'C', false);
		$pdf->Cell($w[3],8,'','T',1,'C', false);

		$pdf->Output("document/bordereauLivraison.pdf",'F');
		$lien = "document/bordereauLivraison.pdf";
		return $lien;
	}

}