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
              
              <li><a href="<?php echo site_url('RoleController/ajouterRole');  ?>"><?php echo $headings; ?></a></li>
            </ul>
          </div>
        </div>
        <!-- page content-->
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-body">
              <!-- edit only this part-->
                <div class="col-md-6"> 
                      <?php 
                        if(isset($msg)) echo '<p class="text text-danger text-center">'.$msg.'</p>';
                      ?>  
                      <?php echo form_open('RoleController/add','role="form" class="form-horizontal" id="gestion"');  ?>
                      <!--form class="form-horizontal" role="form" method="POST"-->
					  <p class="text text-primary"> Les Champs avec <i class="text text-danger">* </i> sonts obligatoires</p>
                          <div class="form-group">
                            <label class="control-label col-sm-4" for="libelle">Libelle Role <i class="text text-danger">* </i> :</label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control text-lowercase" id="libelle" name="libelle" value="<?php echo set_value('libelle'); ?>" placeholder="Libelle du role" required autofocus>
                              <?php echo form_error('libelle','<p class="text text-danger text-center">', '</p>'); ?>
                            </div>
                          </div>                          
                          <div class="form-group">
                              <label class="control-label col-sm-4"></label>
                              <div class="col-sm-8 ">
                                  &nbsp;&nbsp;
                                <button class="btn btn-primary icon-btn" type="submit" name="ok"><i class="fa fa-fw fa-lg fa-check-circle"></i>Ajouter</button>&nbsp;&nbsp;&nbsp;

                                <button class="btn btn-danger icon-btn" type="reset"><i class="fa fa-fw fa-lg fa-times-circle"></i>Annuler</button>
                              </div>
                          </div>
      				        </form>
                </div>
        				<div class="col-md-6">				
        					 <table class="table table-hover table-bordered" id="sampleTable">
                          <thead>
                            <tr>
                              <th>#</th>
                              <th>Libelle</th>
                              <th>Modifier</th>

                            </tr>
                          </thead>
                          <tbody>
                              <?php 

                                $i = 1;
                                foreach ($roles as $key) {

                               ?>                     
                            <tr>
                              <th><?php  echo $i;?></th>
                              <td> <?php echo $key['libelleRole'];?></td>
                              <td class="bg-primary text text-center">Modifier &nbsp;<i class="fa fa-sm fa-edit"></i></td>
                            </tr>

                            <?php 
                              $i++;
                              }
                             ?>
                          </tbody>
                        </table>
        				</div>                
              <p>.</p>
							<!-- end edit only this part-->
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