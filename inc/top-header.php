<?php
    $sess_username = $_SESSION['username'];
    // $sess_full_name = $_SESSION['full_name'];
    $sess_email = $_SESSION['email'];
    $sess_user_id = $_SESSION['user_id'];

?>
<!--Start topbar header-->
<header class="topbar-nav">
 <nav id="header-setting" class="navbar navbar-expand fixed-top">
  <ul class="navbar-nav mr-auto align-items-center">
    <li class="nav-item">
      <a class="nav-link toggle-menu" href="javascript:void();">
       <i class="icon-menu menu-icon"></i>
     </a>
    </li>
    <li class="nav-item">
      <form class="search-bar">
        <input type="text" class="form-control" placeholder="Rechercher">
         <a href="javascript:void();"><i class="icon-magnifier"></i></a>
      </form>
    </li>
  </ul>
     
  <ul class="navbar-nav align-items-center right-nav-link">
    <li class="nav-item">
      <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" data-toggle="dropdown" href="#">
        <span class="user-profile"><img src="https://via.placeholder.com/110x110" class="img-circle" alt="user avatar"></span>
      </a>
      <ul class="dropdown-menu dropdown-menu-right">
       <li class="dropdown-item user-details">
        <a href="javaScript:void();">
           <div class="media">
             <div class="avatar"><img class="align-self-start mr-3" src="https://via.placeholder.com/110x110" alt="user avatar"></div>
            <div class="media-body">
            <h6 class="mt-2 user-title">
              <?php if(isset($sess_email)){
                echo $sess_email;
              }?>
            </h6>
            <p class="user-subtitle"><?php if(isset($sess_username)){
                echo "Bonjour, ".$sess_username;
              }?></p>
            </div>
           </div>
          </a>
        </li>
  
        

        <li class="dropdown-divider"></li>
        <!-- <li class="dropdown-item"><i class="icon-envelope mr-2"></i> Inbox</li>
        <li class="dropdown-divider"></li>
        <li class="dropdown-item"><i class="icon-wallet mr-2"></i> Account</li>
        <li class="dropdown-divider"></li>
        <li class="dropdown-item"><i class="icon-settings mr-2"></i> Setting</li> -->
        <li class="dropdown-divider"></li>
        <li class="dropdown-item"><i class="icon-settings mr-2"></i><a href="change-password.php?chg_pass=<?php echo $sess_user_id;?>">Changer le mot de passe</a></li>
        <li class="dropdown-divider"></li>
        <li class="dropdown-item"><i class="icon-power mr-2"></i><a href="../sign-out.php">Se déconnecter</a></li>
      </ul>
    </li>
  </ul>
</nav>
</header>
<!--End topbar header-->