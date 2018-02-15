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
              
              <li><a href="<?php echo site_url('clientController/ajouterclient');  ?>"><?php echo $headings; ?></a></li>
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
                    if(isset($msg)) echo '<p class="text text-danger text-center">'.$msg.'</p>';
                  ?>
                <?php echo form_open('clientController/add','role="form" class="form-horizontal" id="gestion"');  ?>
                <!--form class="form-horizontal" role="form" method="POST"-->
					<p class="text text-primary"> Les Champs avec <i class="text text-danger">* </i> sonts obligatoires</p>
                <div class="col-md-6">
                    <div class="form-group">
                    <label class="control-label col-sm-4" for="date">Date :</label>
                    <div class="col-sm-8">
                      <input class="form-control text text-center" type="text" value="<?php echo $date; ?>" name="datejour" readonly>
                    </div>
                  </div>
                  <div class="form-group">
                  <label class="control-label col-sm-4" for="nom">Noms Client <i class="text text-danger">* </i>:</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="nom" name="nom" value="<?php echo set_value('nom'); ?>" placeholder="Nom du client" autofocus required>
                    <?php echo form_error('nom','<p class="text text-danger text-center">', '</p>'); ?>
                  </div>
                </div>
                  <div class="form-group">
                    <label class="control-label col-sm-4" for="entreprise">Nom Entreprise :</label>
                    <div class="col-sm-8">
                      <input class="form-control" type="text" id="entreprise" name="entreprise" value="<?php echo set_value('entreprise'); ?>" placeholder="Nom de L'entreprise" >
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-sm-4" for="promoteur">Nom Promoteur :</label>
                    <div class="col-sm-8">
                      <input class="form-control" type="text" id="promoteur" name="promoteur" value="<?php echo set_value('promoteur'); ?>" placeholder="Nom du promoteur" >
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-sm-4" for="localite">Localité <i class="text text-danger">*</i> :</label>
                    <div class="col-sm-8">
                      <input class="form-control" type="text" id="localite" name="localite" value="<?php echo set_value('localite'); ?>" placeholder="Localité de l'entreprise" required>
                      <?php echo form_error('localite','<p class="text text-danger text-center">', '</p>'); ?>
                    </div>
                  </div>

                </div>
                <div class="col-md-6">

                  <div class="form-group">
                    <label class="control-label col-sm-4" for="cat">Categorie <i class="text text-danger">*</i> :</label>
                    <div class="col-sm-8">
                      <select class="form-control" id="cat" id="cat" name="cat">
							<?php foreach($cats as $key){?>
								<option value="<?php echo $key['libelleCat']?>"><?php echo strtoupper($key['libelleCat']);?></option>
							<?php }?>
                      </select>
                  </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-sm-4" for="representant">Représentant :</label>
                    <div class="col-sm-8">
                      <input class="form-control" type="text" id="representant" name="representant" value="<?php echo set_value('representant'); ?>" placeholder="Nom du représentant du client" >
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-sm-4" for="codepostal">Code Postal :</label>
                    <div class="col-sm-8">
                      <input class="form-control" type="text" id="codepostal" name="codepostal" value="<?php echo set_value('codepostal'); ?>" placeholder="Code postal du client" >
                    </div>
                  </div>
                    <div class="form-group">
                    <label class="control-label col-sm-4" for="tel1">Contact 1 <i class="text text-danger">* </i> :</label>
                    <div class="col-sm-8">
                      <input class="form-control" type="number" id="tel1" name="tel1" value="<?php echo set_value('tel1'); ?>" placeholder="Contact client" required>
                      <?php echo form_error('tel1','<p class="text text-danger text-center">', '</p>'); ?>
                    </div>
                  </div>
                    <div class="form-group">
                    <label class="control-label col-sm-4" for="tel2">Contact 2 :</label>
                    <div class="col-sm-8">
                      <input class="form-control" type="number" id="tel2" name="tel2" value="<?php echo set_value('tel2'); ?>" placeholder="Contact client" >
                      <?php echo form_error('tel2','<p class="text text-danger text-center">', '</p>'); ?>
                    </div>
                  </div>
                  <br/>


                 </div>
                <div class="form-group">
                      <label class="control-label col-sm-4"></label>
                      <div class="col-sm-8">
                      <button class="btn btn-danger icon-btn" type="reset"><i class="fa fa-fw fa-lg fa-times-circle"></i>Annuler</button>
                      
                      <button class="btn btn-primary icon-btn" type="submit" name="ok"><i class="fa fa-fw fa-lg fa-check-circle"></i>Ajouter</button>&nbsp;&nbsp;&nbsp;

                      </div>

                  </div>
                  <div class="form-group">
                      
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