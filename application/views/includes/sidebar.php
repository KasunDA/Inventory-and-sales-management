    <!-- Side-Nav-->
      <aside class="main-sidebar hidden-print">
        <section class="sidebar">
          <div class="user-panel">
            <div class="pull-left image">
              <img class="img-circle" src="inc/images/logo.jpg<?php //echo img('inc/images/chick.jpg');?>" alt="User Image">
            </div>
            <div class="pull-left info">
               <?php 
                  $username = $this->session->userdata('username');
                    echo strtoupper($username);

                ?>
            </div>
          </div>
          <!-- Sidebar Menu-->
          <ul class="sidebar-menu">
            
             <li><a href="<?php echo site_url('loginController/home');  ?>"><i class="fa fa-pie-chart"></i><span>Shop</span></a></li>

            <li class="treeview">
              <a href="#"><i class="fa fa-shopping-cart"></i><span>Produits</span><i class="fa fa-angle-right"></i></a>
              <ul class="treeview-menu">
                <li><a href="<?php echo site_url('produitController/ajouterProduit');  ?>"><i class="fa fa-cart-plus"></i> Ajouter Produit</a></li>
                <li><a href="<?php echo site_url('produitController/listerProduit');  ?>"><i class="fa fa-circle-o"></i> Lister Produit</a></li>
                <li><a href="<?php echo site_url('StockController/ajouterStock');  ?>"><i class="fa fa-circle-o"></i>Enregistrer Nouveau Stock</a></li>
              </ul>
            </li>

            <li class="treeview"><a href="#"><i class="fa fa-users"></i><span>Clients</span><i class="fa fa-angle-right"></i></a>
              <ul class="treeview-menu">
                <li><a href="<?php echo site_url('clientController/ajouterClient');  ?>"><i class="fa fa-user-plus"></i> Ajouter Clients</a></li>
                <li><a href="<?php echo site_url('clientController/listerClient');  ?>"><i class="fa fa-circle-o"></i> Lister Clients</a></li>                
              </ul>
            </li>
            <li class="treeview"><a href="#"><i class="fa fa-gears"></i><span>Configuration</span><i class="fa fa-angle-right"></i></a>
              <ul class="treeview-menu">
                <li><a href="<?php echo site_url('CategorieController/ajouterCategorie');  ?>"><i class="fa fa-circle-o"></i>Définir Catégories</a></li>
                 <li><a href="<?php echo site_url('RoleController/ajouterRole');  ?>"><i class="fa fa-circle-o"></i>Définir Rôles</a></li>
                <li><a href="<?php echo site_url('UserController/ajouterUser');  ?>"><i class="fa fa-circle-o"></i>Gerer Utilisateurs</a></li>
                
                </ul>
            </li>
			     <!--li><a href="<?php echo site_url('FactureController/ajouterFacture');  ?>"><i class="fa fa-shopping-cart"></i>Ventes</a></li-->
            <li><a href="<?php echo site_url('SellController/sell');  ?>"><i class="fa fa-shopping-cart"></i>Ventes</a></li>

            <li class="treeview"><a href="#"><i class="fa fa-file-pdf-o"></i><span>Listing</span><i class="fa fa-angle-right"></i></a>
              <ul class="treeview-menu">
                <li><a href="<?php echo site_url('SellController/listerFactures');  ?>"><i class="fa fa-circle-o"></i> Lister Factures</a></li>
                <li><a href="<?php echo site_url('StockController/listerBordereaux');  ?>"><i class="fa fa-circle-o"></i> Lister Bordereaux</a></li>
                <li><a href="<?php echo site_url('SellController/xDeCaisse');  ?>"><i class="fa fa-circle-o"></i> Produire X-De Caisse</a></li>
                
              </ul>
            </li-->
          </ul>
        </section>
      </aside>