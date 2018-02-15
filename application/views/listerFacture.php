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
          var url= '/gestion/document/facture.pdf';                                 
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
              
              <li><a href="<?php echo site_url('sellController/listerFactures');  ?>"><?php echo $headings; ?></a></li>
            </ul>
          </div>
        </div>
        <!-- page content-->
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-body">
                
              <!-- edit only this part-->
                <table class="table table-hover table-bordered" id="sampleTable">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Numéro Facture</th>
                      <th>Nom Client</th>
                      <th># D'article</th>
                      <th>Total Payé</th>
                      <th>Date</th>
                      <th>Imprimer</th>

                    </tr>
                  </thead>
                  <tbody>
                      <?php 

                        $i = 1;
                        foreach ($factures as $key) {
                          
                       ?>                     
                    <tr>
                      <td><?php  echo $i;?></td>
                      <td> <?php echo $key['numFacture'];?></td>  
                      <td> <?php echo strtoupper($key['nomClient']);?></td>  
                      <td> <?php echo strtoupper($key['qty']);?></td>  
                      <td> <?php echo $key['total_paid'];?></td>  
                      <td> <?php echo $key['dateFact'];?></td>  
                      <td>
                        <a class="text text-primary" href="<?php echo site_url('sellController/printFacture?id='.$key['numFacture']) ?>">Imprimer &nbsp;<i class="fa fa-sm fa-print"></i></a></td>

                    </tr>
                    
                    <?php 
                      $i++;
                      }
                     ?>
                    
                  </tbody>
                </table>

                    <!--div class="row hidden-print mt-20">
                        <div class="col-xs-12 text-right"><a class="btn btn-primary" href="javascript:window.print();" target="_blank"><i class="fa fa-print"></i> Print</a></div>
                      </div-->

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
</html>