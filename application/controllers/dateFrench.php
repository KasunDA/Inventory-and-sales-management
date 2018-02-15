<?php
function JourFrench($jrs){
		switch ($jrs) {
			case 'Monday':
				$jrs = 'Lundi';
				break;
			case 'Tuesday':
				$jrs = 'Mardi';
				break;
			case 'Wednesday':
				$jrs = 'Mercredi';
				break;
			case 'Thursday':
				$jrs = 'Jeudi';
				break;
			case 'Friday':
				$jrs = 'Vendredi';
				break;
			case 'Saturday':
				$jrs = 'Samedi';
				break;
			case 'Sunday':
				$jrs = 'Dimanche';
				break;		
			}
		return $jrs;	
		}

function MoisFrench($Mois){
	switch ($Mois) {
		case 'January':
			$Mois = 'Janvier';
			break;
		case 'February':
			$Mois = 'Février';
			break;
		case 'March':
			$Mois = 'Mars';
			break;
		case 'April':
			$Mois = 'Avril';
			break;
		case 'May':
			$Mois = 'Mai';
			break;
		case 'June':
			$Mois = 'Juin';
			break;
		case 'July':
			$Mois = 'Juillet';
			break;
		case 'August':
			$Mois = 'Août';
			break;
		case 'September':
			$Mois = 'Septembre';
			break;
		case 'October':
			$Mois = 'Octobre';
			break;
		case 'November':
			$Mois = 'Novembre';
			break;
		case 'December':
			$Mois = 'Décembre';
			break;							
		}
	return $Mois;	
	}

function DateFrench(){
	$joursemaine = JourFrench(date("l"));
	$jrs = date("d");
	$mois = MoisFrench(date("F"));
	$annee = date("Y");

	$jour = "$joursemaine $jrs $mois $annee";
	$heure = date('H')+1;
	$minute = date ('i');
	$seconde = date('s');
	$tab = array($jour,$heure,$minute,$seconde);

	return $tab;
		}

function DateToStringConvertion($date){
	$date0 = substr($date, 0,10);
	$tab = explode('-', $date0);
	$date1 = $tab[2].'/'.$tab[1].'/'.$tab[0];
	$tab = explode(' ', $date);
	$date2 = $tab[1];
	$date = $date1.' à '.$date2;
	return $date;
	}

function HeaderA5($pdf,$test,$name,$seller_name,$dateFact) {
	$pdf->AddFont('courieri','I','courieri.php');
	$pdf->AddFont('advanced_dot_digital-7','B','advanced_dot_digital-7.php');
	$pdf->AddFont('Consolas','','Consolas.php');
	
	$pdf->SetXY(30, 10);
    //$pdf->AddFont('advanced_dot_digital-7','B','advanced_dot_digital-7.php');
	$pdf->SetFont('advanced_dot_digital-7','B',14);
	$pdf->Cell(5,4,"BFLGOCAM SA",0,1,'C');
	//$pdf->ln(2);
	$pdf->SetXY(6, 14);
	$pdf->SetFont('courieri','I','8');
	$pdf->MultiCell(64, 4, utf8_decode("Le spécialiste de l'aliment avicole 13288 DOUALA \nTel: 670000000 Fax: 670000000."),0,'L',false);
		
	$pdf->SetXY(70, 10);
	$pdf->AddFont('Consolas','','Consolas.php');
	$pdf->SetFont('Consolas','',10);
	$pdf->Cell(15,4,utf8_decode("Facture N°: "),0,0,'L');
	$pdf->SetXY(92, 10);
	$pdf->SetFont('courieri','I',10);
	$pdf->Cell(15,4,utf8_decode("$test"),0,0,'L');

	$pdf->SetXY(130, 10);
	$pdf->AddFont('Consolas','','Consolas.php');
	$pdf->SetFont('Consolas','',10);
	$pdf->Cell(15,4,utf8_decode("Client: "),0,0,'L');
	$pdf->SetXY(144, 10);
	$pdf->SetFont('courieri','I',10);
	$pdf->Cell(30,4,strtoupper(utf8_decode("$name")),0,1,'L');

	$pdf->Ln(10);
	$pdf->SetX(70);
   	$pdf->SetFont('Consolas','',16);
	$pdf->Cell(70,1,"FACTURE CLIENT",0,1,'C');	
	$pdf->SetFont('Consolas','',10);
	$pdf->SetXY(128, 23);
	$pdf->Cell(30,1,utf8_decode("DU : "),0,0,'C');
	$pdf->SetFont('courieri','I',10);
	$pdf->Cell(30,1,utf8_decode($dateFact),0,1,'C');

	$pdf->Ln(6);
	$pdf->SetFont('Consolas','',10);
	$pdf->SetX(10);
	$pdf->Cell(30,1,utf8_decode("Vendu par : "),0,0,'L');
	$pdf->SetFont('courieri','I',10);
	//$uname = strtoupper($_SESSION['username'].' '.$_SESSION['usersurname']);
	$pdf->SetX(34);
	$pdf->Cell(30,1,utf8_decode($seller_name),0,1,'L');


	$pdf->SetFont('Consolas','',10);
	$tableHeader = array('s/n', 'Nom / Libellé Produit', 'Prix Unitaire', 'Quantité', 'Total');
	$w = array(10,80,30,20,50);
	$pdf->SetXY(10,30);
	$pdf->Ln(5);
	$pdf->Cell($w[0],7,utf8_decode($tableHeader[0]),'LTB',0,'C', false);
	$pdf->Cell($w[1],7,utf8_decode($tableHeader[1]),'LTB',0,'C', false);
	$pdf->Cell($w[2],7,utf8_decode($tableHeader[2]),'LTB',0,'C', false);
	$pdf->Cell($w[3],7,utf8_decode($tableHeader[3]),'LTB',0,'C', false);
	$pdf->Cell($w[4],7,utf8_decode($tableHeader[4]),'LTBR',0,'C', false);
    $pdf->Ln(7);
	}

function HeaderA5L($pdf,$numstock,$date, $nomEnreg) {
	$pdf->AddFont('courieri','I','courieri.php');
	//$pdf->AddFont('advanced_dot_digital-7','B','advanced_dot_digital-7.php');
	$pdf->AddFont('Consolas','','Consolas.php');
	
	$pdf->SetXY(30, 10);
    $pdf->AddFont('advanced_dot_digital-7','','advanced_dot_digital-7.php');
	$pdf->SetFont('advanced_dot_digital-7','',14);
	
	$pdf->Cell(5,4,"BFLGOCAM SA",0,1,'C');
	//$pdf->ln(2);
	$pdf->SetXY(6, 14);
	$pdf->SetFont('courieri','I','8');
	$pdf->MultiCell(64, 4, utf8_decode("Le spécialiste de l'aliment avicole 13288 DOUALA \nTel: 670000000 Fax: 670000000."),0,'L',false);
	
	$pdf->SetXY(70, 10);
	$pdf->AddFont('Consolas','','Consolas.php');
	$pdf->SetFont('Consolas','',10);
	$pdf->Cell(15,4,utf8_decode("Bordereau N°: "),0,0,'L');
	$pdf->SetXY(96, 10);
	$pdf->SetFont('courieri','I',10);
	$pdf->Cell(15,4,utf8_decode("$numstock"),0,0,'L');

	$pdf->SetXY(130, 10);
	$pdf->AddFont('Consolas','','Consolas.php');
	$pdf->SetFont('Consolas','',10);
	$pdf->Cell(15,4,utf8_decode("Client: "),0,0,'L');
	$pdf->SetXY(144, 10);
	$pdf->SetFont('courieri','I',10);
	$pdf->Cell(30,4,strtoupper(utf8_decode("test")),0,1,'L');

	$pdf->Ln(10);
	$pdf->SetX(70);
   	$pdf->SetFont('Consolas','',16);
	$pdf->Cell(65,1,"BORDEREAU DE LIVRAISON",0,1,'C');	
	$pdf->SetFont('Consolas','',10);
	$pdf->SetXY(128, 24);
	$pdf->Cell(34,1,utf8_decode("DATE : "),0,0,'C');
	$pdf->SetFont('courieri','I',10);
	$pdf->Cell(30,1,utf8_decode($date),0,1,'C');

	$pdf->Ln(6);
	$pdf->SetFont('Consolas','',10);
	$pdf->SetX(10);
	$pdf->Cell(30,1,utf8_decode("Enrégistré par : "),0,0,'L');
	$pdf->SetFont('courieri','I',10);
	//$uname = strtoupper("Nom d'un usager");
	$pdf->SetX(55);
	$pdf->Cell(30,1,utf8_decode($nomEnreg),0,1,'C');

	$pdf->SetFont('Consolas','',10);
	$tableHeader = array('s/n', 'Nom / Libellé Produit', 'Quantité','Observations');
	$w = array(10,80,40,60);
	$pdf->SetXY(10,30);
	$pdf->Ln(5);
	$pdf->Cell($w[0],7,utf8_decode($tableHeader[0]),'LTB',0,'C', false);
	$pdf->Cell($w[1],7,utf8_decode($tableHeader[1]),'LTB',0,'C', false);
	$pdf->Cell($w[2],7,utf8_decode($tableHeader[2]),'LTB',0,'C', false);
	$pdf->Cell($w[3],7,utf8_decode($tableHeader[3]),'LTBR',0,'C', false);
    
    $pdf->Ln(7);
}
function HeaderA5X($pdf, $date1, $date2, $nomEnreg){
	$pdf->AddFont('courieri','I','courieri.php');
	//$pdf->AddFont('advanced_dot_digital-7','B','advanced_dot_digital-7.php');
	$pdf->AddFont('Consolas','','Consolas.php');
	
	$pdf->SetXY(30, 10);
    $pdf->AddFont('advanced_dot_digital-7','','advanced_dot_digital-7.php');
	$pdf->SetFont('advanced_dot_digital-7','',14);
	
	$pdf->Cell(5,4,"BFLGOCAM SA",0,1,'C');
	//$pdf->ln(2);
	$pdf->SetXY(6, 14);
	$pdf->SetFont('courieri','I','8');
	$pdf->MultiCell(64, 4, utf8_decode("Le spécialiste de l'aliment avicole 13288 DOUALA \nTel: 670000000 Fax: 670000000."),0,'L',false);
	
	$pdf->SetXY(90, 10);
	$pdf->AddFont('Consolas','','Consolas.php');
	$pdf->SetFont('Consolas','',10);
	$pdf->Cell(15,4,utf8_decode("DU: "),0,0,'L');
	$pdf->SetXY(96, 10);
	$pdf->SetFont('courieri','I',10);
	$pdf->Cell(15,4,utf8_decode("$date1"),0,0,'L');

	$pdf->SetXY(135, 10);
	$pdf->AddFont('Consolas','','Consolas.php');
	$pdf->SetFont('Consolas','',10);
	$pdf->Cell(15,4,utf8_decode("AU: "),0,0,'L');
	$pdf->SetXY(144, 10);
	$pdf->SetFont('courieri','I',10);
	$pdf->Cell(30,4,strtoupper(utf8_decode("$date2")),0,1,'L');

	$pdf->Ln(10);
	$pdf->SetX(70);
   	$pdf->SetFont('Consolas','',16);
	$pdf->Cell(65,1,"X DE CAISSE",0,1,'C');	
	$pdf->SetFont('Consolas','',10);
	$pdf->SetXY(128, 24);
	$pdf->Cell(34,1,utf8_decode("DATE : "),0,0,'C');
	$pdf->SetFont('courieri','I',10);
	$pdf->Cell(30,1,utf8_decode(date('d-m-Y')),0,1,'C');

	$pdf->Ln(6);
	$pdf->SetFont('Consolas','',10);
	$pdf->SetX(10);
	$pdf->Cell(30,1,utf8_decode("Imprimé par : "),0,0,'L');
	$pdf->SetFont('courieri','I',10);
	$pdf->SetX(55);
	$pdf->Cell(30,1,utf8_decode(strtoupper($nomEnreg)),0,1,'C');

	$pdf->SetFont('Consolas','',10);
	$tableHeader = array('s/n', 'Num Facture', 'Nom Client', 'Date', '# Prods', 'Total');
	$w = array(9,33,54,45,13,32);
	$pdf->SetXY(10,30);
	$pdf->Ln(5);
	$pdf->Cell($w[0],7,utf8_decode($tableHeader[0]),'LTB',0,'C', false);
	$pdf->Cell($w[1],7,utf8_decode($tableHeader[1]),'LTB',0,'C', false);
	$pdf->Cell($w[2],7,utf8_decode($tableHeader[2]),'LTB',0,'C', false);
	$pdf->Cell($w[3],7,utf8_decode($tableHeader[3]),'LTB',0,'C', false);
	$pdf->Cell($w[4],7,utf8_decode($tableHeader[4]),'LTB',0,'C', false);
	$pdf->Cell($w[5],7,utf8_decode($tableHeader[5]),'LTBR',0,'C', false);
    
    $pdf->Ln(7);
}