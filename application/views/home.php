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
            <p>Synoptic table on all the aticles in the shop</p>
          </div>
          <div>
            <ul class="breadcrumb">
              <li><a href="<?php echo site_url('loginController/home');  ?>"><i class="fa fa-home fa-lg"></i></a></li>
              <li><a href="#"><?php echo $headings; ?></a></li>
            </ul>
          </div>
        </div>
        <!-- page content-->
        <div class="row">
          <div class="col-md-3">
            <div class="widget-small primary"><i class="icon fa fa-users fa-3x"></i>
              <div class="info">
                <h4>Users</h4>
                <p> <b>5</b></p>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="widget-small info"><i class="icon fa fa-thumbs-o-up fa-3x"></i>
              <div class="info">
                <h4>Likes</h4>
                <p> <b>25</b></p>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="widget-small warning"><i class="icon fa fa-files-o fa-3x"></i>
              <div class="info">
                <h4>Uploades</h4>
                <p> <b>10</b></p>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="widget-small danger"><i class="icon fa fa-star fa-3x"></i>
              <div class="info">
                <h4>Stars</h4>
                <p> <b>500</b></p>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-3">
            <div class="widget-small primary coloured-icon"><i class="icon fa fa-users fa-3x"></i>
              <div class="info">
                <h4>Users</h4>
                <p> <b>5</b></p>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="widget-small info coloured-icon"><i class="icon fa fa-thumbs-o-up fa-3x"></i>
              <div class="info">
                <h4>Likes</h4>
                <p> <b>25</b></p>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="widget-small warning coloured-icon"><i class="icon fa fa-files-o fa-3x"></i>
              <div class="info">
                <h4>Uploades</h4>
                <p> <b>10</b></p>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="widget-small danger coloured-icon"><i class="icon fa fa-star fa-3x"></i>
              <div class="info">
                <h4>Stars</h4>
                <p> <b>500</b></p>
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
  <?php if(isset($alert) && isset($alert1)){?>
  $(window).load(function(){
    $.notify({
      <?php 
        echo 'title: "'.$alert.'",';   
        echo 'message: "'.$alert1.'",';  
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