<!-- Nom &amp; Prénom: WOUMTANA P. Youssouf
            Téléphone: +226 63 86 22 46 / 73 35 41 41
                Email: issoufwoumtana@gmail.com -->
<?php
    // include("query/fonction.php");
    if(!isset($_SESSION['user_info']) && count($_SESSION['user_info']) == 0)
        header('Location: login.php');
?>
<!-- ============================================================== -->
<!-- Logo -->
<!-- ============================================================== -->
<div class="navbar-header">
    <a class="navbar-brand" href="index.php">
        <!-- Logo icon -->
        <b>
            <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
            <!-- Dark Logo icon -->
            <img src="assets/images/logo.png" alt="homepage" class="dark-logo" width="100%"/>
            <!-- Light Logo icon -->
            <img src="assets/images/logo-light-icon.png" alt="homepage" class="light-logo" />
        </b>
        <!--End Logo icon -->
        <!-- Logo text -->
        <span>
            <!-- dark Logo text -->
            <!-- <img src="assets/images/logo-text.png" alt="homepage" class="dark-logo" /> -->
            <!-- Light Logo text -->    
            <!-- <img src="assets/images/logo-light-text.png" class="light-logo" alt="homepage" /> -->
        </span>
    </a>
</div>
<!-- ============================================================== -->
<!-- End Logo -->
<!-- ============================================================== -->
<div class="navbar-collapse">
    <!-- ============================================================== -->
    <!-- toggle and nav items -->
    <!-- ============================================================== -->
    <ul class="navbar-nav mr-auto mt-md-0">
        <!-- This is  -->
        <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="mdi mdi-menu"></i></a> </li>
        <li class="nav-item m-l-10"> <a class="nav-link sidebartoggler hidden-sm-down text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
        <!-- ============================================================== -->
        <!-- Comment -->
    </ul>
    <!-- ============================================================== -->
    <!-- User profile and search -->
    <!-- ============================================================== -->
    <ul class="navbar-nav my-lg-0">
        <!-- ============================================================== -->
        <?php
            $tab_user_info[] = array();
            $tab_user_info = $_SESSION['user_info'];
        ?>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="assets/images/users/flag.png" alt="user" class="profile-pic" /></a>
            <div class="dropdown-menu dropdown-menu-right scale-up">
                <ul class="dropdown-user">
                    <li>
                        <div class="dw-user-box">
                            <div class="u-img"><img src="assets/images/users/flag.png" alt="user"></div>
                            <div class="u-text">
                                <h4><?php echo $tab_user_info['nom_prenom']; ?></h4>
                                <p class="text-muted"><?php echo $tab_user_info['libCatUser']; ?></p>
                                    <a href="change-password.php" class="btn btn-rounded btn-danger btn-sm">Password</a>
                                </div>
                        </div>
                    </li>
                    <li role="separator" class="divider"></li>
                    <!-- <li><a href="#"><i class="ti-user"></i> Mon Profil</a></li> -->
                    <!-- <li><a href="#"><i class="ti-wallet"></i> My Balance</a></li> -->
                    <!-- <li><a href="#"><i class="ti-email"></i> Mot de passe</a></li> -->
                    <!-- <li role="separator" class="divider"></li>
                    <li><a href="#"><i class="ti-settings"></i> Account Setting</a></li> -->
                    <li role="separator" class="divider"></li>
                    <li><a href="query/action.php?logout=yes"><i class="fa fa-power-off"></i> Log out</a></li>
                </ul>
            </div>
        </li>
    </ul>
</div>