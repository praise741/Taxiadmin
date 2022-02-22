<!-- Nom &amp; Prénom: WOUMTANA P. Youssouf
            Téléphone: +226 63 86 22 46 / 73 35 41 41
                Email: issoufwoumtana@gmail.com -->
<?php
    // include("query/fonction.php");
    if(!isset($_SESSION['user_info']) && count($_SESSION['user_info']) == 0)
        header('Location: login.php');
?>
<!-- User profile -->
<div class="user-profile">
    <!-- User profile image -->
    <div class="profile-img"> 
        <img src="assets/images/users/flag.png" alt="user" />
        <!-- this is blinking heartbit-->
        <div class="notify setpos"> <span class="heartbit"></span> <span class="point"></span> </div>
    </div>
    <?php
        $tab_user_info[] = array();
        $tab_user_info = $_SESSION['user_info'];
    ?>
    <!-- User profile text-->
    <div class="profile-text">
        <h5><?php echo $tab_user_info['nom_prenom']; ?></h5>
        <a href="query/action.php?logout=yes" class="" data-toggle="tooltip" title="Log out"><i class="mdi mdi-power"></i></a>
        <div class="dropdown-menu animated flipInY">
            <!-- text-->
            <a href="#" class="dropdown-item"><i class="ti-user"></i> My Profile</a>
            <!-- text-->
            <a href="#" class="dropdown-item"><i class="ti-wallet"></i> Password</a>
            <div class="dropdown-divider"></div>
            <!-- text-->
            <a href="query/action.php?logout=yes" class="dropdown-item"><i class="fa fa-power-off"></i> Log out</a>
            <!-- text-->
        </div>
    </div>
</div>
<!-- End User profile text-->
<!-- Sidebar navigation-->
<nav class="sidebar-nav">
    <ul id="sidebarnav">
        <li class="nav-devider"></li>
        <li class="nav-small-cap">MONITORING THE MOBILE</li>
        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-account-multiple"></i><span class="hide-menu">User APP</span></a>
            <ul aria-expanded="false" class="collapse">
                <li><a href="list-user.php">User List</a></li>
                <li><a href="notification.php">Notification</a></li>
                <!-- <li><a href="commentaire-avis.php">Commentaire & Avis</a></li> -->
            </ul>
        </li>
        <li class="nav-small-cap">PARAMETER OF MOBILE</li>
        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-settings"></i><span class="hide-menu">Administrative tools</span></a>
            <ul aria-expanded="false" class="collapse">
                <li><a href="categorie-user.php">Category of user</a></li>
                <li><a href="user.php">User admin.</a></li>
            </ul>
        </li>
        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-settings-box"></i><span class="hide-menu">Codification</span></a>
            <ul aria-expanded="false" class="collapse">
                <li><a href="type-vehicule.php">Vehicle type</a></li>
            </ul>
        </li>
        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-pen"></i><span class="hide-menu">Coordination</span></a>
            <ul aria-expanded="false" class="collapse">
                <li><a href="taxi.php">Taxi</a></li>
                <li><a href="vehicule.php">Vehicle</a></li>
                <li><a href="conducteur.php">Driver</a></li>
                <li><a href="affectation.php">Affectation</a></li>
                <li><a href="requete.php">Request</a></li>
                <li><a href="reservation.php">Taxi reservation</a></li>
                <li><a href="location-vehicule.php">Car rent</a></li>
            </ul>
        </li>
        <!-- <li class="nav-small-cap">SUIVI DU MOBILE</li> -->
    </ul>
</nav>
<!-- End Sidebar navigation -->