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
				<h1><i class="fa fa-list"></i> <?php echo $headings; ?></h1>
				<p><p><?php echo $headings1; ?></p></p>
			  </div>
			  <div>
				<ul class="breadcrumb">
				  <li><a href="<?php echo site_url('loginController/home');  ?>"><i class="fa fa-home fa-lg"></i></a></li>
				  
				  <li><a href="<?php echo site_url('UserController/ajouterUser');  ?>"><?php echo $headings; ?></a></li>
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
								<?php 
			                    	if(isset($msg)) echo '<p class="text text-danger text-center">'.$msg.'</p>';
			                  	?>
								<?php echo form_open('UserController/add','role="form" class="form-horizontal" id="gestion"');  ?>
								<p class="text text-primary"> Les Champs avec <i class="text text-danger">* </i> sonts obligatoires</p>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label col-sm-4" for="nom"> Nom <i class="text text-danger">* </i> :</label>
											<div class="col-sm-8">
											  <input type="text" class="form-control" id="nom" name="nom" value="<?php echo set_value('nom'); ?>" placeholder="Nom Utilisateur" autofocus required>
                      							<?php echo form_error('nom','<p class="text text-danger text-center">', '</p>'); ?>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-sm-4" for="prenom"> Prénom :</label>
											<div class="col-sm-8">
											  <input type="text" class="form-control" id="prenom" name="prenom" value="<?php echo set_value('prenom'); ?>" placeholder="Prénom Utilisateur"  >
                      							<?php echo form_error('prenom','<p class="text text-danger text-center">', '</p>'); ?>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-sm-4" for="tel"> Telephone <i class="text text-danger">* </i> :</label>
											<div class="col-sm-8">
											  <input type="text" class="form-control" id="tel" name="tel" value="<?php echo set_value('tel'); ?>" placeholder="Numéro de téléphone" required>
                      							<?php echo form_error('tel','<p class="text text-danger text-center">', '</p>'); ?>
											</div>
										</div>																					
									    <div class="form-group">
											<label class="control-label col-sm-4" for="role"> Role <i class="text text-danger">* </i> :</label>
											<div class="col-sm-8">
												<select class="form-control" id="role" name="role">
													<?php foreach($roles as $key){?>
														<option value="<?php echo $key['idRole']?>"><?php echo strtoupper($key['libelleRole']);?></option>
													<?php }?>
												</select>
											</div>
										</div>
									</div>
								
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label col-sm-4" for="login"> Login <i class="text text-danger">* </i> :</label>
											<div class="col-sm-8">
											  <input type="text" class="form-control" id="login" name="login" value="<?php echo set_value('login'); ?>" placeholder="Login" required>
                      							<?php echo form_error('login','<p class="text text-danger text-center">', '</p>'); ?>
											</div>
										</div>
                                        <div class="form-group">
											<label class="control-label col-sm-4" for="pass"> Mot De Passe <i class="text text-danger">* </i> :</label>
											<div class="col-sm-8">
											  <input type="password" class="form-control" id="pass" name="pass" placeholder="Mot de passe" required>
                      							<?php echo form_error('pass','<p class="text text-danger text-center">', '</p>'); ?>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-sm-4" for="pass1"> Confirmer Mot De passe <i class="text text-danger">* </i> :</label>
											<div class="col-sm-8">
											  <input type="password" class="form-control" id="pass1" name="pass1" placeholder="Confirmer Mot De passe" required>
                      							<?php echo form_error('pass1','<p class="text text-danger text-center">', '</p>'); ?>
											</div>
										</div>

									</div>
									<div class="form-group">
										<label class="control-label col-sm-4"></label>
										<div class="col-sm-8 text text-center">
											<button class="btn btn-primary icon-btn" type="submit" name="ok"><i class="fa fa-fw fa-lg fa-check-circle"></i>Ajouter</button>&nbsp;&nbsp;&nbsp;
											<button class="btn btn-danger icon-btn" type="reset"><i class="fa fa-fw fa-lg fa-times-circle"></i>Annuler</button>
										</div>
									</div>
								</form>
							</div>
							<div class="row">
                                <h1 class="text text-primary text-center"> Liste Des Utilisateurs enrégistrés</h1>
									<table class="table table-hover table-bordered" id="sampleTable">
										<thead>
											<tr>
												<th>#</th>
												<th>Noms</th>
                                                <th>Prenoms</th>
                                                <th>Telephone</th>
                                                <th>Login</th>
                                                <th>Rôle</th>
												<th>Modifier</th>
											</tr>
										</thead>
										<tbody>
											<?php 
											$i = 1;
											foreach ($user as $key) {
											?>                     
											<tr>
											  <th><?php  echo $i;?></th>
											  <td><?php echo strtoupper($key['nom']);?></td>
                                              <td><?php echo strtoupper($key['prenom']);?></td>
                                              <td><?php echo $key['telephone'];?></td>
                                              <td><?php echo strtoupper($key['login']);?></td>
                                              <td><?php echo strtoupper($key['libelleRole']);?></td>
											  <td class="bg-primary text text-center">Modifier &nbsp;<i class="fa fa-sm fa-edit"></i></td>
											</tr>
									
									<?php $i++;}?>
										</tbody>
									</table>
							</div>

							<!-- end edit only this part-->
						</div>
					</div>
				</div>
			 <!-- end page content-->
			</div>
	   


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