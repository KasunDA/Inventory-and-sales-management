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
          var url= '/gestion/document/xdecaisse.pdf';                                 
          window.open(url,'_blank');
      </script>            
    <?php endif; ?>

    <div class="content-wrapper">
        <div class="page-title">
          <div>
            <h1><i class="fa fa-list"></i> <?php echo $headings; ?></h1>
            <p><p><?php echo $headings1; ?></p></p>
          </div>
          <div>
            <ul class="breadcrumb">
              <li><a href="<?php echo site_url('loginController/home');  ?>"><i class="fa fa-home fa-lg"></i></a></li>
              
              <li><a href="<?php echo site_url('SellController/xDeCaisse  ');  ?>"><?php echo $headings; ?></a></li>
            </ul>
          </div>
        </div>
        <!-- page content-->
           <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-body">
                
              <!-- edit only this part-->
                <div class="row">
                  <div class="col-sm-3"></div>
                  <div class="col-sm-8 com-sm-offset-2">
                    <?php echo form_open('SellController/printXDeCaisse','role="form" class="form-inline" id="gestion"');  ?>
                      <div class="form-group">
                        <label class="control-label">Date Début</label>
                        <input class="form-control" type="date" name="date1" id="date1" placeholder="Date Début" required>
                      </div>
                      <div class="form-group">
                        <label class="control-label">Date Fin</label>
                        <input class="form-control" type="date" name="date2" id="date2" placeholder="Date Fin" required>
                      </div>
                      <div class="form-group">
                        <button class="btn btn-primary icon-btn" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Valider</button>
                      </div>          
                    </form>
                  </div>
                  <div class="col-sm-3"></div>

                </div>

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
      $('document').ready(function() { 
  
        $('#date').datepicker({
          inline: false,
          dateFormat: 'yyyy-mm-dd'
        });
        
      });
      </script>
</html>