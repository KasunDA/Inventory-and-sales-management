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
    
    <?php if (isset($lien)): ?>
      <script type="text/javascript">
          var url= '/gestion/document/facture.pdf';                                 
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
              
              <li><a href="<?php echo site_url('SellController/sell');  ?>"><?php echo $headings; ?></a></li>
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
                <?php echo form_open('','role="form" class="form-horizontal" id="gestion"');  ?>
                <!--form class="form-horizontal" role="form" method="POST"-->
				                
               <div class="form-horizontal form-label-left input_mask">
                   <div class="form-group">
                      <div class="col-md-12">
                          <div class="col-md-4 col-sm-8 col-xs-12 " id="custom-search-input" >
                              <div class="input-group col-md-12">
                              <form>
                                  <input type="text" class="form-control" required autofocus name="client" id="client" placeholder="Nom Client" >
                                  <span class="input-group-btn">
                                      <button type="submit" name="search" class="btn btn-warning" id="search" formaction="<?php echo site_url('sellController/getClientInfos');?>">
                                         <i class="fa fa-search">&nbsp; Load</i>
                                      </button>
                                  </span>
                               </form>
                              </div>
                          </div>
                          <?php if (isset($numclient)): 
                            $_SESSION['numClient'] = $numclient;                            
                          	$_SESSION['nomClient'] = $nomclient;                          	
                          ?>
	                          <div class="col-md-4 col-sm-8 col-xs-12 " id="custom-search-input" >
	                              <div class="input-group col-md-12">
	                                  <input type="text" class="form-control text text-center" readonly  name="infos" id="infos" class="infos" value="<?php echo strtoupper($nomclient); ?>" >
	                              </div>
	                          </div>
	                          <div class="col-md-4 col-sm-8 col-xs-12 " id="custom-search-input" >
	                              <div class="input-group col-md-12">
	                                  <input type="text" class="form-control text text-center" readonly  name="infos" id="infos" class="infos" value="<?php echo strtoupper($catclient); ?>" >
	                              </div>
	                          </div>
	                     <?php endif; ?>  
                      </div>  
                    </div>
                    
                 </div>

                 <div class="row">
                 	
		  <?php

            if(isset($produits) && is_array($produits) && count($produits) && $articles == TRUE){
        ?>   	
            	<div class="col-sm-10">
                 		
                 	</div>
                 	<div class="col-sm-2">
                 	<!-- Trigger the modal with a button -->
					<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#exampleModal" data-keyboard="true" onclick="javascript:opencart()">
						<span>
						 	Panier ( <span class="cartcount"><?php echo count($this->cart->contents());  ?></span> )
						</span>
					</button> 
						<?//php echo "$nom"; ?>
					</div>
			<?php
            $i=1;
            foreach ($produits as $key => $data) { 
            ?>
          	<div class="col-sm-2 alert alert-info text text-center">
            	<p class="hidden stock<?php echo $data['idProd'] ?>" rel="<?php echo $data['stock'] ?>"> <?php echo $data['stock'] ?></p>
              	<p class="name<?php echo $data['idProd'] ?>" rel="<?php echo $data['idProd'] ?>"><?php echo $data['nomProd'] ?></p>
                
              	<div class="price-label price<?php echo $data['idProd'] ?>" rel="<?php echo $data['prix'] ?>">
					FCFA <?php echo $data['prix'] ?>
				
				</div>

                <button class="btn btn-primary btn-xs" onclick="javascript:addtocart(<?php echo $data['idProd'] ?>)">Vendre</button>
               
            </div>
            <?php
	            $i++;
	              } } 
        ?>


                 	<!--?php endif ?-->
                 </div>
             
				
               <!-- end edit only this part-->

              </div>
            </div>
          </div>
        </div>
         <!-- end page content-->
      </div>
  

    </div>    

		<!-- Modal -->
		
  
   <!-- js libraries-->
      <?php include('includes/scripts.php') ?>
      <!-- end of js libraries-->

		<script language="javascript"> 
			
			var listeclient = [
				<?php 
					$i = 1;
					foreach($clients as $key){
						//echo sizeof($produits)."\n";
						echo '"'.strtoupper($key['nomClient']).'"';
						if($i == sizeof($clients)) echo " \n";
						else echo ",\n";
						$i++;
					}
				?>
			];

			$( "#client").autocomplete({
			source: listeclient
		});
		</script>

		<script type="text/javascript">
			function addtocart(p_id){

				var price = $('.price'+p_id).attr('rel');
				//var poid = $('.poid'+p_id).attr('rel');
				var name  = $('.name'+p_id).text();
				var id    = $('.name'+p_id).attr('rel');
				var stock = $('.stock'+p_id).attr('rel');
				
		        $.ajax({
		                type: "POST",
		                url: "<?php echo site_url('SellController/add');?>",
		                //data: "id="+id+"&name="+name+"&price="+price,
		                data: "id="+id+"&name="+name+"&price="+price+"&stock="+stock,
		                success: function (response) {
		                	//alert(id+"--"+name+"--"+price+"--"+stock);
		                	$(".cartcount").text(response);
		                }
		            });
			}


		  function opencart(){

		      $.ajax({
		          type: "POST",
		          url: "<?php echo site_url('SellController/opencart');?>",
		          data: "",
		          success: function (response) {
		          $(".displaycontent").html(response);
		          }
		      });
		  }

		</script>
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
		<div class="modal fade bs-example-modal-lg displaycontent" id="exampleModal" >
	</body>
</html>