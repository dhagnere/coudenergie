<?php
    $sess_username = $_SESSION['username'];
    // $sess_full_name = $_SESSION['full_name'];
    $sess_email = $_SESSION['email'];
    $sess_user_id = $_SESSION['user_id'];

?>
<!-- Start sidebar-wrapper-->
   <div id="sidebar-wrapper" data-simplebar="" data-simplebar-auto-hide="true">
     <div class="brand-logo">
      <a href="index.php">
       <img src="../img/logoCdk.png" class="logo-icon" alt="logo icon">
       <h5 class="logo-text">CoudEnergie</h5>
     </a>
   </div>
   <div class="user-details">
    <div class="media align-items-center user-pointer collapsed" data-toggle="collapse" data-target="#user-dropdown">
      <div class="avatar"><img class="mr-3 side-user-img" src="https://via.placeholder.com/110x110" alt="user avatar"></div>
       <div class="media-body">
       <h6 class="side-user-name"><?php if(isset($sess_username)){
                echo "Bonjour, ".$sess_username;
              }?></h6>
      </div>
       </div>
     <div id="user-dropdown" class="collapse">
      <ul class="user-setting-menu">
<!--             <li><a href="javaScript:void();"><i class="icon-user"></i>  My Profile</a></li>
            <li><a href="javaScript:void();"><i class="icon-settings"></i> Setting</a></li> -->
      <li><a href="../sign-out.php"><i class="icon-power"></i> Se deconnecter</a></li>
      </ul>
     </div>
      </div>
   <ul class="sidebar-menu">
      <li class="sidebar-header">NAVIGATION</li>
      <li>
        <a href="index.php" class="waves-effect">
          <i class="zmdi zmdi-view-dashboard"></i> <span>Accueil</span>
      	</a>
      </li>
      <li>
        <a href="javaScript:void();" class="waves-effect">
          <i class="zmdi zmdi-home"></i> <span>Batiments/Lieux</span><i class="fa fa-angle-left pull-right"></i>
        </a>
    		<ul class="sidebar-submenu">
    			<li><a href="add-building.php"><i class="zmdi zmdi-dot-circle-alt"></i> Ajouter un bâtiment</a></li>
    			<li><a href="all-buildings.php"><i class="zmdi zmdi-dot-circle-alt"></i> Voir tous les bâtiments</a></li>
    		</ul>
      </li>

      <li>
        <a href="javaScript:void();" class="waves-effect">
          <i class="zmdi zmdi-home"></i> <span>facturations</span><i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="sidebar-submenu">
          <li><a href="add-cost.php"><i class="zmdi zmdi-dot-circle-alt"></i> Entrer une dépense</a></li>
          <li><a href="all-costs.php"><i class="zmdi zmdi-dot-circle-alt"></i> Voir toutes les dépenses</a></li>
        </ul>
      </li>

      
    

     
      </ul>
   </div>
   <!--End sidebar-wrapper