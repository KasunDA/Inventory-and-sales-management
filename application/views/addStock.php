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

    <?php if (isset($lien)): ?>
      <script type="text/javascript">
          var url= '/gestion/document/bordereauLivraison.pdf';                                 
          window.open(url,'_blank');
      </script>            
    <?php endif; ?>

    <div class="content-wrapper">
        <div class="page-title">
          <div>
            <h1><i class="fa fa-pie-chart"></i> <?php echo $headings; ?></h1>
            <p><?php echo $headings1; ?></p>
          </div>
          <div>
            <ul class="breadcrumb">
              <li><a href="<?php echo site_url('loginController/home');  ?>"><i class="fa fa-home fa-lg"></i></a></li>
              
              <li><a href="<?php echo site_url('stockController/ajouterStock');  ?>"><?php echo $headings; ?></a></li>
            </ul>
          </div>
        </div>
        <!-- page content-->
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-body">
              <!-- edit only this part-->
                  
                <?php echo form_open('StockController/add','role="form" class="form-horizontal" id="gestion"');  ?>
                <!--form class="form-horizontal" role="form" method="POST"-->
				<p class="text text-primary"> Les Champs avec <i class="text text-danger">* </i> sonts obligatoires</p>
                <div class="col-md-6">

					<div class="form-group">
						<label class="control-label col-sm-4" for="nom">Nom Produit <i class="text text-danger">* </i> :</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="nom" name="nom0" placeholder="Entrer le nom du produit" required autofocus>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-4" for="nom">Nom Produit&nbsp;&nbsp;&nbsp; :</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="nom1" name="nom1" placeholder="Entrer le nom du produit">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-4" for="nom">Nom Produit&nbsp;&nbsp;&nbsp; :</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="nom2" name="nom2" placeholder="Entrer le nom du produit">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-4" for="nom">Nom Produit&nbsp;&nbsp;&nbsp; :</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="nom3" name="nom3" placeholder="Entrer le nom du produit">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-4" for="nom">Nom Produit&nbsp;&nbsp;&nbsp; :</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="nom4" name="nom4" placeholder="Entrer le nom du produit">
						</div>
					</div>
                </div>
                <div class="col-md-6">

                  <div class="form-group">
                    <label class="control-label col-sm-4" for="poids">Quantite <i class="text text-danger">* </i> :</label>
                    <div class="col-sm-8">
                      <input class="form-control" type="text" id="quantite" name="quantite0" placeholder="Quantité" required>
                    </div>
                  </div>
				   <div class="form-group">
                    <label class="control-label col-sm-4" for="poids">Quantite&nbsp;&nbsp;&nbsp;:</label>
                    <div class="col-sm-8">
                      <input class="form-control" type="text" id="quantite" name="quantite1" placeholder="Quantité" >
                    </div>
                  </div>
				   <div class="form-group">
                    <label class="control-label col-sm-4" for="poids">Quantite&nbsp;&nbsp;&nbsp;:</label>
                    <div class="col-sm-8">
                      <input class="form-control" type="text" id="quantite" name="quantite2" placeholder="Quantité" >
                    </div>
                  </div>
				   <div class="form-group">
                    <label class="control-label col-sm-4" for="poids">Quantite&nbsp;&nbsp;&nbsp;:</label>
                    <div class="col-sm-8">
                      <input class="form-control" type="text" id="quantite" name="quantite3" placeholder="Quantité" >
                    </div>
                  </div>
				   <div class="form-group">
                    <label class="control-label col-sm-4" for="poids">Quantite&nbsp;&nbsp;&nbsp;:</label>
                    <div class="col-sm-8">
                      <input class="form-control" type="text" id="quantite" name="quantite4" placeholder="Quantité" >
                    </div>
                  </div>
                  
                 </div>

                  <div class="form-group">
                   <label class="control-label col-sm-4"></label>
                    <div class="col-sm-8">
                    <button class="btn btn-primary icon-btn" type="submit" name="ok"><i class="fa fa-fw fa-lg fa-check-circle"></i>Ajouter</button>&nbsp;&nbsp;&nbsp;

                    <button class="btn btn-danger icon-btn" type="reset"><i class="fa fa-fw fa-lg fa-times-circle"></i>Annuler</button>
                    </div>
                  </div>
                  
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
		<script> 
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
			
		</script>
       <!-- js libraries-->
      <?php include('includes/scripts.php') ?>
      <!-- end of js libraries-->
</html>