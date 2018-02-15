<?php
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == TRUE){
      redirect('/loginController/home/');
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
  <body>
    <section class="material-half-bg">
      <div class="cover"></div>
    </section>
    <section class="login-content">
      <div class="logo">
        <h1>Belgocam</h1>
      </div>
      <div class="login-box">
      <?php echo form_open('loginController/connect'); ?>
        <div class="login-form" >
          <h3 class="login-head"><i class="fa fa-lg fa-fw fa-user"></i>CONNECTEZ VOUS</h3>
          <div class="form-group">
            <?php 
              echo validation_errors('<div class="text text-danger text-center"><b>', '</b></div>');
            	if(isset($msg)) echo '<p class="text text-danger text-center">'.$msg.'</p>';
            ?>
          </div>

          <div class="form-group">
            <label for="login" class="control-label">Login</label>
            <input class="form-control" type="text" name="login" id="login" value="<?php echo set_value('login'); ?>" placeholder="login" autofocus required>
          </div>
          <div class="form-group">
            <label for="password" class="control-label">Mot De passe</label>
            <input class="form-control" type="password" name="password" id="password" value="<?php echo set_value('password'); ?>" placeholder="Mot De Passe" required>
          </div>
          <br/><br/>
          <div class="form-group btn-container">
            <button class="btn btn-primary btn-block">CONNEXION <i class="fa fa-sign-in fa-lg"></i></button>
          </div>
          </div>
        </form>
      </div>
    </section>
  </body>
  <script src="<?php echo base_url().'inc/js/jquery-2.1.4.min.js';?>"></script>
  <script src="<?php echo base_url().'inc/js/essential-plugins.js';?>"></script>
  <script src="<?php echo base_url().'inc/js/bootstrap.min.js';?>"></script>
  <script src="<?php echo base_url().'inc/js/plugins/pace.min.js';?>"></script>
  <script src="<?php echo base_url().'inc/js/main.js';?>"></script>
</html>