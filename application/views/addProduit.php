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

    <div class="content-wrapper">
        <div class="page-title">
          <div>
            <h1><i class="fa fa-pie-chart"></i> <?php echo $headings; ?></h1>
            <p><?php echo $headings1; ?></p>
          </div>
          <div>
            <ul class="breadcrumb">
              <li><a href="<?php echo site_url('loginController/home');  ?>"><i class="fa fa-home fa-lg"></i></a></li>
              
              <li><a href="<?php echo site_url('produitController/ajouterProduit');  ?>"><?php echo $headings; ?></a></li>
            </ul>
          </div>
        </div>
        <!-- page content-->
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-body">
              <!-- edit only this part-->
              
                  <?php 
                    //echo validation_errors('<div class="text text-danger text-center"><b>', '</b></div>');
                    if(isset($msg)) echo '<p class="text text-danger text-center">'.$msg.'</p>';
                  ?>
                <?php echo form_open('produitController/add','role="form" class="form-horizontal" id="gestion"');  ?>
                <!--form class="form-horizontal" role="form" method="POST"-->
				<p class="text text-primary"> Les Champs avec <i class="text text-danger">* </i> sonts obligatoires</p>
                <div class="col-md-6">

                  <div class="form-group">
                  <label class="control-label col-sm-4" for="codeP">Code Produit <i class="text text-danger">* </i> :</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control text-lowercase" id="codeP" name="codeP" value="<?php echo set_value('codeP'); ?>" placeholder="Entrer le code du produit"  autofocus required>
                    <?php echo form_error('codeP','<p class="text text-danger text-center">', '</p>'); ?>
                  </div>
                </div>
                  <div class="form-group">
                    <label class="control-label col-sm-4" for="nom">Nom <i class="text text-danger">* </i> :</label>
                    <div class="col-sm-8">
                      <input class="form-control" type="text" id="nom" name="nom" value="<?php echo set_value('nom'); ?>" placeholder="Entrer le nom du produit" required>
                      <?php echo form_error('nom','<p class="text text-danger text-center">', '</p>'); ?>
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label class="control-label col-sm-4" for="desc">Description :</label>
                    <div class="col-sm-8">
                      <textarea class="form-control" rows="8" id="desc" name="desc" value="<?php echo set_value('desc'); ?>" placeholder="Entrer la description du produit" ></textarea>
                    </div>
                  </div>
                   <div class="form-group">
                    <label class="control-label col-sm-4" for="orig">Origine :</label>
                    <div class="col-sm-8">
                      <input class="form-control" type="text" id="orig" name="orig" value="<?php echo set_value('orig'); ?>" placeholder="l'origine du produit" >
                    </div>
                  </div>
                </div>
                <div class="col-md-6">

                 
                  <div class="form-group">
                    <label class="control-label col-sm-4" for="poids">Poids <i class="text text-danger">* </i> :</label>
                    <div class="col-sm-8">
                      <input class="form-control" type="text" id="poids" name="poids" value="<?php echo set_value('poids'); ?>" placeholder="Poids en KG" required>
                      <?php echo form_error('poids','<p class="text text-danger text-center">', '</p>'); ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-sm-4" for="prix">Prix Unitaire <i class="text text-danger">* </i> :</label>
                    <div class="col-sm-8">
                      <input class="form-control" type="text" id="prix" name="prix" value="<?php echo set_value('prix'); ?>" placeholder="Entrer prix unitaire du produit" required>
                      <?php echo form_error('prix','<p class="text text-danger text-center">', '</p>'); ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-sm-4" for="prixC1">Prix C1 <i class="text text-danger">* </i> :</label>
                    <div class="col-sm-8">
                      <input class="form-control" type="text" id="prixC1" name="prixC1" value="<?php echo set_value('prixC1'); ?>" placeholder="Entrer le prix des clients divers" required>
                      <?php echo form_error('prixC1','<p class="text text-danger text-center">', '</p>'); ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-sm-4" for="prixC2">Prix C2 <i class="text text-danger">* </i> :</label>
                    <div class="col-sm-8">
                      <input class="form-control" type="text" id="prixC2" name="prixC2" value="<?php echo set_value('prixC2'); ?>" placeholder="Entrer le prix des clients revendeurs (moyens)" required>
                      <?php echo form_error('prixC2','<p class="text text-danger text-center">', '</p>'); ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-sm-4" for="prixC3">Prix C3 <i class="text text-danger">* </i> :</label>
                    <div class="col-sm-8">
                      <input class="form-control" type="text" id="prixC3" name="prixC3" value="<?php echo set_value('prixC3'); ?>" placeholder="Entrer le prix des clients Grossiste" required>
                      <?php echo form_error('prixC3','<p class="text text-danger text-center">', '</p>'); ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-sm-4" for="prixC4"> Prix C4 <i class="text text-danger">* </i> :</label>
                    <div class="col-sm-8">
                      <input class="form-control" type="text" id="prixC4" name="prixC4" value="<?php echo set_value('prixC4'); ?>" placeholder="Entrer le prix des clients spéciaux" required>
                      <?php echo form_error('prixC4','<p class="text text-danger text-center">', '</p>'); ?>
                    </div>
                  </div>
                
                 </div>

                  <div class="form-group text text-center">
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
       <!-- js libraries-->
      <?php include('includes/scripts.php') ?>
      <!-- end of js libraries-->
<script type="text/javascript">
  <?php if(isset($msg)){?>
  $(window).load(function(){
    $.notify({
      <?php 
        echo 'title: "'.$msg.'",';   
        echo 'message: " ",';  
      ?>
      icon: 'fa fa-check' 
    },
    {
      type: "success"
    });
  });

  <?php } ?>
</script>
</html>