<?php
	if ($_SESSION['logged_in'] == FALSE){
      redirect('/loginController/index/');
  }
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="<?php echo base_url().'inc/js/ventes.js';?>"></script>

    <title><?php echo $title; ?></title>
    <?php include('includes/libs.php') ?>
  </head>

  <body class="sidebar-mini fixed">
    <div class="wrapper">

    <!-- header of the page-->
    <?php include('includes/header.php') ?>
    <!-- end of header-->

    <!-- sidebar of the page-->
    <?php include('includes/sidebar.php') ?>
    <!-- end of sidebar-->

    <div class="content-wrapper">
        <div class="page-title">
          <div>
            <h1><i class="fa fa-pie-chart"></i> <?php echo $headings; ?></h1>
            <p><?php echo $headings1; ?></p>
          </div>
          <div>
            <ul class="breadcrumb">
              <li><a href="<?php echo site_url('loginController/home');  ?>"><i class="fa fa-home fa-lg"></i></a></li>
              
              <li><a href="<?php echo site_url('FactureController/ajouterFacture');  ?>"><?php echo $headings; ?></a></li>
            </ul>
          </div>
        </div>
        <!-- page content-->
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-body">
              <!-- edit only this part-->
                  
                <?php echo form_open('','role="form" class="form-horizontal" id="gestion"');  ?>
                <!--form class="form-horizontal" role="form" method="POST"-->
				                
               <div class="form-horizontal form-label-left input_mask">
                   <div class="form-group">
                      <div class="col-md-12">
                          <div class="col-md-4 col-sm-8 col-xs-12 " id="custom-search-input" >
                              <div class="input-group col-md-12">
                                  <input type="text" class="form-control" required autofocus name="client" id="client" placeholder="Nom Client" >
                                  <span class="input-group-btn">
                                      <button type="submit" name="search" class="btn btn-warning" id="search" formaction="<?php echo site_url('factureController/clientInfos');?>">
                                         <i class="fa fa-search">&nbsp; Load</i>
                                      </button>
                                  </span>
                              </div>
                          </div>
                          <?php if (isset($numclient)): ?>
	                          <div class="col-md-4 col-sm-8 col-xs-12 " id="custom-search-input" >
	                              <div class="input-group col-md-12">
	                                  <input type="text" class="form-control text text-center" readonly  name="infos" id="infos" class="infos" value="<?php echo $nomclient; ?>" >
	                              </div>
	                          </div>
	                          <div class="col-md-4 col-sm-8 col-xs-12 " id="custom-search-input" >
	                              <div class="input-group col-md-12">
	                                  <input type="text" class="form-control text text-center" readonly  name="infos" id="infos" class="infos" value="<?php echo $catclient; ?>" >
	                              </div>
	                          </div>
	                     <?php endif; ?>  
                      </div>  
                    </div>
                    
                 </div>
             </form>
                 <?php echo form_open('factureController/add','role="form" class="form-horizontal" id="gestion"');  ?>
                <p class="text text-primary text-center"> Les Champs precédés <i class="text text-danger">* </i> sonts obligatoires</p> 
                <div class="row">
					<p> 
						<!--input type="button" class="btn btn-primary" value="Ajouter Produit" onClick="addRow('dataTable')" /--> 
						<button type="button" class="btn btn-primary" onClick="addRow('dataTable')"><i class="fa fa-plus"></i> Ajouter Produit </button> 
						<button type="button" class="btn btn-danger" onClick="deleteRow('dataTable')"><i class="fa fa-minus"></i> Supprimer Produit </button> 
						<!--input type="button" class="btn btn-danger" value="Retirer Produit" onClick="deleteRow('dataTable')"  /--> 
					<p>(All acions apply only to entries with check marked check boxes only.)</p>
					</p>
					<table id="dataTable" class="table" border="0" cellpadding="2">
						<tbody>
							<tr>
								<td>
									<input class="control-label" type="checkbox"  name="chk[]" checked="checked">
								</td>
								<td>
									<label>Nom Produit</label>
									<input class="form-control nom0" type="text" required="required" id="nom[]" name="nom[]" placeholder="Nom Produit" >
								 </td>
								 <td>
									<label for="BX_age">Quantité</label>
									<input class="form-control qty0" type="text" required="required" id="quantite[]" name="quantite[]" placeholder="Quantité">
								 </td>
								 <td>
									<td>
									<label for="BX_age">Prix Unitaire</label>
									<input class="form-control" type="text" required="required" id="prix[]" name="prix[]" readonly placeholder="Prix Unitaire">
								 </td>
								 </td>
								 <td>
									<label for="BX_age">Total ( Prix U * Qty)</label>
									<input class="form-control" type="text" required="required" id="total0" name="total0" readonly placeholder="total">
								 </td>
							</tr>
						</tbody>
					</table>
						<div class="col-md-12">
							<div class="col-md-4">
							</div>
							<div class="col-md-2">
								<div class="form-group">
									<input class="form-control text text-center text-default" value="0" type="text" readonly id="totale1" name="totale1" >
								</div>
							</div>
							<div class="col-md-4">
							</div>
							<div class="col-md-2">
								<div class="form-group">
									<input class="form-control text text-center" type="text" readonly id="totale2" name="totale2" value="0" >
								</div>
							</div>
						</div>
						
						<input type="hidden" name="numclient" value="<?php if(isset($numclient))echo $numclient; ?>">
						<input type="hidden" name="nomclient" value="<?php if(isset($nomclient))echo $nomclient; ?>">
						<div class="form-group">
							<label class="control-label col-sm-4"></label>
							<div class="col-sm-8">
								<button class="btn btn-primary icon-btn" type="submit" name="ok"><i class="fa fa-fw fa-lg fa-check-circle"></i>Valider</button>&nbsp;&nbsp;&nbsp;

								<button class="btn btn-danger icon-btn" type="reset"><i class="fa fa-fw fa-lg fa-times-circle"></i>Annuler</button>
							</div>
						</div>
				</div>
				<!--div class="col-md-3">
					<div class="form-group">
						<input type="text" class="form-control" id="nom1" name="nom1" placeholder="Entrer le nom du produit"  >
					</div>
					<div class="form-group">
						<input type="text" class="form-control" id="nom2" name="nom2" placeholder="Entrer le nom du produit"  >
					</div>
					<div class="form-group">
						<input type="text" class="form-control" id="nom3" name="nom3" placeholder="Entrer le nom du produit"  >
					</div>
					<div class="form-group">
						<input type="text" class="form-control" id="nom4" name="nom4" placeholder="Entrer le nom du produit"  >
					</div>
					<div class="form-group">
						<label class="control-label text text-success" > TOTALS </label>
					</div>
                </div>
				<div class="col-md-1">
				</div>
                <div class="col-md-2">

                  <div class="form-group">
                    <label class="control-label " for="quantite">Quantite <i class="text text-danger">* </i> :</label>
					<input class="form-control text text-center" min="1" type="text" id="quantite0" name="quantite" placeholder="Quantité" required>
                  </div>
				   <div class="form-group">
						<input class="form-control text text-center" min="1" type="text" id="quantite1" name="quantite1" placeholder="Quantité" >
                  </div>
				   <div class="form-group">
						<input class="form-control text text-center" min="1" type="text" id="quantite2" name="quantite2" placeholder="Quantité" >
                  </div>
				   <div class="form-group">
						<input class="form-control text text-center" min="1" type="text" id="quantite3" name="quantite3" placeholder="Quantité" >
                  </div>
				   <div class="form-group">
						<input class="form-control text text-center" min="1" type="text" id="quantite4" name="quantite4" placeholder="Quantité" >
                  </div>
                  <div class="form-group">
						<input class="form-control text text-center" value="0" type="text" readonly id="totale1" name="totale1" >
                  </div>
                 </div>
				 <div class="col-md-1">
                 </div>
				 
				<div class="col-md-2">
					<div class="form-group">
                    <label class="control-label" for="prix">Prix Unitaire</label>
					<input class="form-control text text-center" type="text" id="prix0" readonly name="prix0" placeholder="Prix Unitaire" required>
                  </div>
				   <div class="form-group">
						<input class="form-control text text-center" type="text" id="prix1" readonly name="prix1" placeholder="Prix Unitaire" >
                  </div>
				   <div class="form-group">
						<input class="form-control text text-center" type="text" id="prix2" readonly name="prix2" placeholder="Prix Unitaire" >
                  </div>
				   <div class="form-group">
						<input class="form-control text text-center" type="text" id="prix3" readonly name="prix3" placeholder="Prix Unitaire" >
                  </div>
				   <div class="form-group">
						<input class="form-control text text-center" type="text" id="prix4" readonly name="prix4" placeholder="Prix Unitaire" >
                  </div>
				</div>
				<div class="col-md-1">
                 </div>
				<div class="col-md-2">
					<div class="form-group">
                    <label class="control-label " for="poids">Total (Prix U x Qté)</label>
					<input class="form-control text text-center" type="text" id="total0" readonly name="total0" placeholder="Total" required>
                  </div>
				   <div class="form-group">
						<input class="form-control text text-center" type="text" id="total1" readonly name="total1" placeholder="Total" >
                  </div>
				   <div class="form-group">
						<input class="form-control text text-center" type="text" id="total2" readonly name="total2" placeholder="Total" >
                  </div>
				   <div class="form-group">
						<input class="form-control text text-center" type="text" id="total3" readonly name="total3" placeholder="Total" >
                  </div>
				   <div class="form-group">
						<input class="form-control text text-center" type="text" id="total4" readonly name="total4" placeholder="Total" >
                  </div>
                  <div class="form-group">
						<input class="form-control text text-center" type="text" readonly id="totale2" name="totale2" value="0" >
                  </div>
				</div>
				 <input type="hidden" name="numclient" value="<?php if(isset($numclient))echo $numclient; ?>">
				 <input type="hidden" name="nomclient" value="<?php if(isset($nomclient))echo $nomclient; ?>">
                  <div class="form-group">
                   <label class="control-label col-sm-4"></label>
                    <div class="col-sm-8">
                    <button class="btn btn-primary icon-btn" type="submit" name="ok"><i class="fa fa-fw fa-lg fa-check-circle"></i>Valider</button>&nbsp;&nbsp;&nbsp;

                    <button class="btn btn-danger icon-btn" type="reset"><i class="fa fa-fw fa-lg fa-times-circle"></i>Annuler</button>
                    </div>
                  </div-->
                  
                </form>
				
               <!-- end edit only this part-->

              </div>
            </div>
          </div>
        </div>
         <!-- end page content-->
      </div>
  

    </div>    
  </body>
   <!-- js libraries-->
      <?php include('includes/scripts.php') ?>
      <!-- end of js libraries-->

		<script language="javascript"> 
			var liste = [
				<?php 
					$i = 1;
					foreach($produits as $key){
						//echo sizeof($produits)."\n";
						echo '"'.$key['nomProd'].'"';
						if($i == sizeof($produits)) echo " \n";
						else echo ",\n";
						$i++;
					}
				?>
			];
			var listeclient = [
				<?php 
					$i = 1;
					foreach($clients as $key){
						//echo sizeof($produits)."\n";
						echo '"'.$key['nom'].'"';
						if($i == sizeof($clients)) echo " \n";
						else echo ",\n";
						$i++;
					}
				?>
			];
		</script>


      

      <script language="javascript"> 

      		
			                 
         
		</script>

</html>