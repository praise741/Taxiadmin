<?php 
    include("fonction.php");

    /* Start user */
    if((isset($_POST['id_user']) && !empty($_POST['id_user'])) 
    && (isset($_POST['nom_prenom']) && !empty($_POST['nom_prenom']))
    && (isset($_POST['email']) && !empty($_POST['email']))
    && (isset($_POST['mdp']) && !empty($_POST['mdp']))
    && (isset($_POST['telephone']) && !empty($_POST['telephone']))
    && (isset($_POST['statut']) && !empty($_POST['statut']))
    && (isset($_POST['categorie_user']) && !empty($_POST['categorie_user']))){
        $res = setUser($_POST['id_user'],$_POST['nom_prenom'],$_POST['email'],$_POST['mdp'],$_POST['statut'],$_POST['telephone'],$_POST['categorie_user']);
        if($res == 1){
            $_SESSION['status'] = 1;
            header('Location: '.$_SERVER['HTTP_REFERER']);
        }else{
            $_SESSION['status'] = 2;
            header('Location: '.$_SERVER['HTTP_REFERER']);
        }
    }

    if((isset($_POST['id_user_mod']) && !empty($_POST['id_user_mod'])) 
    && (isset($_POST['categorie_user_mod']) && !empty($_POST['categorie_user_mod']))
    && (isset($_POST['nom_prenom_mod']) && !empty($_POST['nom_prenom_mod']))
    && (isset($_POST['telephone_mod']) && !empty($_POST['telephone_mod']))
    && (isset($_POST['email_mod']) && !empty($_POST['email_mod']))
    && (isset($_POST['statut_mod']) && !empty($_POST['statut_mod']))){
        $res = setUserMod($_POST['id_user_mod'],$_POST['categorie_user_mod'],$_POST['nom_prenom_mod']
        ,$_POST['telephone_mod'],$_POST['email_mod'],$_POST['statut_mod']);
        // if($res == 1)
            $_SESSION['status'] = 1;
            header('Location: '.$_SERVER['HTTP_REFERER']);
    }

    if((isset($_GET['id_user']))){
        delUser($_GET['id_user']);
        $_SESSION['status'] = 1;
        header('Location: '.$_SERVER['HTTP_REFERER']);
    }

    if((isset($_GET['id_user_activer']))){
        enableUser($_GET['id_user_activer']);
        $_SESSION['status'] = 1;
        header('Location: '.$_SERVER['HTTP_REFERER']);
    }

    if((isset($_GET['id_user_desactiver']))){
        disableUser($_GET['id_user_desactiver']);
        $_SESSION['status'] = 1;
        header('Location: '.$_SERVER['HTTP_REFERER']);
    }
    /* End user */

    /* Start notification */
    if((isset($_GET['id_notification']))){
        delNotification($_GET['id_notification']);
        $_SESSION['status'] = 1;
        header('Location: '.$_SERVER['HTTP_REFERER']);
    }
    /* End notification */

    /* Start connexion */
    if((isset($_POST['email_sc']) && !empty($_POST['email_sc'])) 
    && (isset($_POST['mdp_sc']) && !empty($_POST['mdp_sc']))){
        $tab = array();
        $tab_user_info = array();
        $tab = setConnexion($_POST['email_sc'],$_POST['mdp_sc']);
        // $tab = setConnexion("admin@admin.com","admin");
        $res = $tab['res'];
        if(count($tab) != 0)
            $tab_user_info = $tab[0];

        if($res == 1){
            $_SESSION['user_info'] = $tab_user_info;
            $_SESSION['status'] = 1;
            header('Location: ../index.php');
        }else{
            $_SESSION['status'] = 2;
            header('Location: '.$_SERVER['HTTP_REFERER']);
        }
    }
    /* End connexion */

    /* Start change mdp */
    if((isset($_POST['anc_mdp']) && !empty($_POST['anc_mdp'])) 
    && (isset($_POST['new_mdp']) && !empty($_POST['new_mdp']))){
        $res = setChangeMdp($_POST['anc_mdp'],$_POST['new_mdp']);
        if($res == 1){
            $_SESSION['status'] = 1;
            header('Location: '.$_SERVER['HTTP_REFERER']);
        }else{
            $_SESSION['status'] = 2;
            header('Location: '.$_SERVER['HTTP_REFERER']);
        }
    }
    /* End change mdp */

    /* Start deconnexion */
    if(isset($_GET['logout']) && $_GET['logout'] == 'yes') {
        session_destroy();
        unset($_SESSION['user_info']);
        header('Location: ../login.php');
    }
    /* End deconnexion */

    /* Start catégorie utilisateur */
    if((isset($_POST['libelle_categorie_user']) && !empty($_POST['libelle_categorie_user']))){
        $res = setCategorieUser($_POST['libelle_categorie_user']);
        if($res == 1){
            $_SESSION['status'] = 1;
            header('Location: '.$_SERVER['HTTP_REFERER']);
        }else{
            $_SESSION['status'] = 2;
            header('Location: '.$_SERVER['HTTP_REFERER']);
        }
    }

    if((isset($_POST['id_categorie_user_mod']) && !empty($_POST['id_categorie_user_mod'])) 
    && (isset($_POST['libelle_categorie_user_mod']) && !empty($_POST['libelle_categorie_user_mod']))){
        $res = setCategorieUserMod($_POST['id_categorie_user_mod'],$_POST['libelle_categorie_user_mod']);
        // if($res == 1)
            $_SESSION['status'] = 1;
            header('Location: '.$_SERVER['HTTP_REFERER']);
    }

    if((isset($_GET['id_categorie_user']))){
        delCategorieUser($_GET['id_categorie_user']);
        $_SESSION['status'] = 1;
        header('Location: '.$_SERVER['HTTP_REFERER']);
    }
    /* End catégorie utilisateur */

    /* Start type véhicule */
    if((isset($_POST['libelle_type_vehicule']) && !empty($_POST['libelle_type_vehicule']))){
        $res = setTypeVehicule($_POST['libelle_type_vehicule']);
        if($res == 1){
            $_SESSION['status'] = 1;
            header('Location: '.$_SERVER['HTTP_REFERER']);
        }else{
            $_SESSION['status'] = 2;
            header('Location: '.$_SERVER['HTTP_REFERER']);
        }
    }

    if((isset($_POST['id_type_vehicule_mod']) && !empty($_POST['id_type_vehicule_mod'])) 
    && (isset($_POST['libelle_type_vehicule_mod']) && !empty($_POST['libelle_type_vehicule_mod']))){
        $res = setTypeVehiculeMod($_POST['id_type_vehicule_mod'],$_POST['libelle_type_vehicule_mod']);
        // if($res == 1)
            $_SESSION['status'] = 1;
            header('Location: '.$_SERVER['HTTP_REFERER']);
    }

    if((isset($_GET['id_type_vehicule']))){
        delTypeVehicule($_GET['id_type_vehicule']);
        $_SESSION['status'] = 1;
        header('Location: '.$_SERVER['HTTP_REFERER']);
    }
    /* End type véhicule */

    /* Start taxi */
    if((isset($_POST['type_taxi']) && !empty($_POST['type_taxi']))
    && (isset($_POST['numero_taxi']) && !empty($_POST['numero_taxi']))
    && (isset($_POST['statut_taxi']) && !empty($_POST['statut_taxi']))
    && (isset($_POST['immatriculation_taxi']) && !empty($_POST['immatriculation_taxi']))){
        $res = setTaxi($_POST['type_taxi'],$_POST['numero_taxi'],$_POST['statut_taxi'],$_POST['immatriculation_taxi']);
        if($res == 1){
            $_SESSION['status'] = 1;
            header('Location: '.$_SERVER['HTTP_REFERER']);
        }else{
            $_SESSION['status'] = 2;
            header('Location: '.$_SERVER['HTTP_REFERER']);
        }
    }

    if((isset($_POST['id_taxi_mod']) && !empty($_POST['id_taxi_mod'])) 
    && (isset($_POST['type_taxi_mod']) && !empty($_POST['type_taxi_mod']))
    && (isset($_POST['numero_taxi_mod']) && !empty($_POST['numero_taxi_mod']))
    && (isset($_POST['immatriculation_taxi_mod']) && !empty($_POST['immatriculation_taxi_mod']))
    && (isset($_POST['statut_taxi_mod']) && !empty($_POST['statut_taxi_mod']))){
        $res = setTaxiMod($_POST['id_taxi_mod'],$_POST['type_taxi_mod']
        ,$_POST['numero_taxi_mod'],$_POST['immatriculation_taxi_mod'],$_POST['statut_taxi_mod']);
        // if($res == 1)
            $_SESSION['status'] = 1;
            header('Location: '.$_SERVER['HTTP_REFERER']);
    }

    if((isset($_GET['id_taxi']))){
        delTaxi($_GET['id_taxi']);
        $_SESSION['status'] = 1;
        header('Location: '.$_SERVER['HTTP_REFERER']);
    }

    if((isset($_GET['id_taxi_activer']))){
        enableTaxi($_GET['id_taxi_activer']);
        $_SESSION['status'] = 1;
        header('Location: '.$_SERVER['HTTP_REFERER']);
    }

    if((isset($_GET['id_taxi_desactiver']))){
        disableTaxi($_GET['id_taxi_desactiver']);
        $_SESSION['status'] = 1;
        header('Location: '.$_SERVER['HTTP_REFERER']);
    }
    /* End taxi */

    /* Start véhicule */
    if((isset($_POST['type_vehicule']) && !empty($_POST['type_vehicule']))
    && (isset($_POST['statut_vehicule']) && !empty($_POST['statut_vehicule']))
    && (isset($_POST['prix_vehicule']) && !empty($_POST['prix_vehicule']))
    && (isset($_POST['nb_place_vehicule']) && !empty($_POST['nb_place_vehicule']))
    && (isset($_POST['nombre_vehicule']) && !empty($_POST['nombre_vehicule']))
    && (isset($_FILES['image_vehicule']) && !empty($_FILES['image_vehicule']))){
        
        $temp = explode(".", $_FILES["image_vehicule"]["name"]);
        $newfile = 'image_vehicule'.'_'.microtime(true).'_'.rand(0,round(microtime(true)));
        $extension = '.'.end($temp);
        $newfilename = $newfile.''.$extension;
        
        $target_dir = '../assets/images/vehicule/';
        $target_file = $target_dir . basename($newfilename);
        $upload_ok = 1;
        $image_file_type = pathinfo($target_file,PATHINFO_EXTENSION);
        
        if($image_file_type == 'jpg' || $image_file_type == 'png' || $image_file_type == 'jpeg' || $image_file_type == 'gif'){
            $target_dir = "../assets/images/vehicule/";
            $target_file = $target_dir . basename($newfilename);
        }

        // Check file size
        if ($_FILES["image_vehicule"]["size"] > 10000000) { //10Mo
            //echo "File too big.";
            $upload_ok = 0;
        }
        // Limit allowed file formats
        if($image_file_type != "jpg" && $image_file_type != "png" && $image_file_type != "jpeg" && $image_file_type != "JPG" && $image_file_type != "PNG" && $image_file_type != "JPEG") {
            //echo "Only JPG, JPEG, PNG & GIF files are allowed.";
            $upload_ok = 0;
        }
        // Check if $upload_ok is set to 0 by an error
        if ($upload_ok == 0) {
            echo "Your file was not uploaded.";
            $_SESSION['status'] = 3;
            header('Location: '.$_SERVER['HTTP_REFERER']);
        // If all the checks are passed, file is uploaded
        } else {
            if (move_uploaded_file($_FILES["image_vehicule"]["tmp_name"], $target_file)) {
                //echo "The file ". basename($newfilename). " was uploaded.";
                
                $res = setVehicule($_POST['type_vehicule'],$_POST['statut_vehicule'],$_POST['prix_vehicule']
                ,$_POST['nb_place_vehicule'],$newfilename,$_POST['nombre_vehicule']);
                if($res == 1){
                    $_SESSION['status'] = 1;
                    header('Location: '.$_SERVER['HTTP_REFERER']);
                }else{
                    $_SESSION['status'] = 2;
                    header('Location: '.$_SERVER['HTTP_REFERER']);
                }
            } else {
                //echo "A error has occured uploading.";
                $_SESSION['status'] = 2;
                header('Location: '.$_SERVER['HTTP_REFERER']);
            }
        }
    }

    if((isset($_POST['id_vehicule_mod']) && !empty($_POST['id_vehicule_mod'])) 
    && (isset($_POST['type_vehicule_mod']) && !empty($_POST['type_vehicule_mod']))
    && (isset($_POST['prix_vehicule_mod']) && !empty($_POST['prix_vehicule_mod']))
    && (isset($_POST['nb_place_vehicule_mod']) && !empty($_POST['nb_place_vehicule_mod']))
    && (isset($_FILES['image_vehicule_mod']) && !empty($_FILES['image_vehicule_mod']))
    && (isset($_POST['nombre_vehicule_mod']) && !empty($_POST['nombre_vehicule_mod']))
    && (isset($_POST['statut_vehicule_mod']) && !empty($_POST['statut_vehicule_mod']))){

        $temp = explode(".", $_FILES["image_vehicule_mod"]["name"]);
        $newfile = 'image_vehicule'.'_'.microtime(true).'_'.rand(0,round(microtime(true)));
        $extension = '.'.end($temp);
        $newfilename = $newfile.''.$extension;
        
        $target_dir = '../assets/images/vehicule/';
        $target_file = $target_dir . basename($newfilename);
        $upload_ok = 1;
        $image_file_type = pathinfo($target_file,PATHINFO_EXTENSION);
        
        if($image_file_type == 'jpg' || $image_file_type == 'png' || $image_file_type == 'jpeg' || $image_file_type == 'gif'){
            $target_dir = "../assets/images/vehicule/";
            $target_file = $target_dir . basename($newfilename);
        }

        // Check file size
        if ($_FILES["image_vehicule_mod"]["size"] > 10000000) { //10Mo
            //echo "File too big.";
            $upload_ok = 0;
        }
        // Limit allowed file formats
        if($image_file_type != "jpg" && $image_file_type != "png" && $image_file_type != "jpeg" && $image_file_type != "JPG" && $image_file_type != "PNG" && $image_file_type != "JPEG") {
            //echo "Only JPG, JPEG, PNG & GIF files are allowed.";
            $upload_ok = 0;
        }
        // Check if $upload_ok is set to 0 by an error
        if ($upload_ok == 0) {
            echo "Your file was not uploaded.";
            $_SESSION['status'] = 3;
            header('Location: '.$_SERVER['HTTP_REFERER']);
        // If all the checks are passed, file is uploaded
        } else {
            if (move_uploaded_file($_FILES["image_vehicule_mod"]["tmp_name"], $target_file)) {
                //echo "The file ". basename($newfilename). " was uploaded.";
                
                $res = setVehiculeMod($_POST['id_vehicule_mod'],$_POST['type_vehicule_mod']
                ,$_POST['statut_vehicule_mod'],$_POST['prix_vehicule_mod'],$_POST['nb_place_vehicule_mod'],$newfilename,$_POST['nombre_vehicule_mod']);
                // if($res == 1)
                    $_SESSION['status'] = 1;
                    header('Location: '.$_SERVER['HTTP_REFERER']);
            } else {
                //echo "A error has occured uploading.";
                $_SESSION['status'] = 2;
                header('Location: '.$_SERVER['HTTP_REFERER']);
            }
        }
    }

    if((isset($_GET['id_vehicule']))){
        delVehicule($_GET['id_vehicule']);
        $_SESSION['status'] = 1;
        header('Location: '.$_SERVER['HTTP_REFERER']);
    }

    if((isset($_GET['id_vehicule_activer']))){
        enableVehicule($_GET['id_vehicule_activer']);
        $_SESSION['status'] = 1;
        header('Location: '.$_SERVER['HTTP_REFERER']);
    }

    if((isset($_GET['id_vehicule_desactiver']))){
        disableVehicule($_GET['id_vehicule_desactiver']);
        $_SESSION['status'] = 1;
        header('Location: '.$_SERVER['HTTP_REFERER']);
    }
    /* End véhicule */

    /* Start conducteur */
    if((isset($_POST['nom_conducteur']) && !empty($_POST['nom_conducteur']))
    && (isset($_POST['prenom_conducteur']) && !empty($_POST['prenom_conducteur']))
    && (isset($_POST['cnib_conducteur']) && !empty($_POST['cnib_conducteur']))
    && (isset($_POST['mdp_conducteur']) && !empty($_POST['mdp_conducteur']))
    && (isset($_POST['statut_conducteur']) && !empty($_POST['statut_conducteur']))
    && (isset($_POST['login_conducteur']) && !empty($_POST['login_conducteur']))){
        $res = setConducteur($_POST['nom_conducteur'],$_POST['prenom_conducteur'],$_POST['cnib_conducteur'],$_POST['statut_conducteur'],$_POST['login_conducteur'],$_POST['mdp_conducteur']);
        if($res == 1){
            $_SESSION['status'] = 1;
            header('Location: '.$_SERVER['HTTP_REFERER']);
        }else{
            $_SESSION['status'] = 2;
            header('Location: '.$_SERVER['HTTP_REFERER']);
        }
    }

    if((isset($_POST['id_conducteur_mod']) && !empty($_POST['id_conducteur_mod'])) 
    && (isset($_POST['nom_conducteur_mod']) && !empty($_POST['nom_conducteur_mod']))
    && (isset($_POST['prenom_conducteur_mod']) && !empty($_POST['prenom_conducteur_mod']))
    && (isset($_POST['cnib_conducteur_mod']) && !empty($_POST['cnib_conducteur_mod']))
    && (isset($_POST['login_conducteur_mod']) && !empty($_POST['login_conducteur_mod']))
    && (isset($_POST['statut_conducteur_mod']) && !empty($_POST['statut_conducteur_mod']))){
        $res = setConducteurMod($_POST['id_conducteur_mod'],$_POST['nom_conducteur_mod'],$_POST['prenom_conducteur_mod']
        ,$_POST['cnib_conducteur_mod'],$_POST['login_conducteur_mod'],$_POST['statut_conducteur_mod']);
        // if($res == 1)
            $_SESSION['status'] = 1;
            header('Location: '.$_SERVER['HTTP_REFERER']);
    }

    if((isset($_GET['id_conducteur']))){
        delConducteur($_GET['id_conducteur']);
        $_SESSION['status'] = 1;
        header('Location: '.$_SERVER['HTTP_REFERER']);
    }

    if((isset($_GET['id_conducteur_activer']))){
        enableConducteur($_GET['id_conducteur_activer']);
        $_SESSION['status'] = 1;
        header('Location: '.$_SERVER['HTTP_REFERER']);
    }

    if((isset($_GET['id_conducteur_desactiver']))){
        disableConducteur($_GET['id_conducteur_desactiver']);
        $_SESSION['status'] = 1;
        header('Location: '.$_SERVER['HTTP_REFERER']);
    }
    /* End conducteur */

    /* Start affectation */
    if((isset($_POST['conducteur_affectation']) && !empty($_POST['conducteur_affectation']))
    && (isset($_POST['taxi_affectation']) && !empty($_POST['taxi_affectation']))
    && (isset($_POST['statut_affectation']) && !empty($_POST['statut_affectation']))){
        $res = setAffectation($_POST['conducteur_affectation'],$_POST['taxi_affectation'],$_POST['statut_affectation']);
        if($res == 1){
            $_SESSION['status'] = 1;
            header('Location: '.$_SERVER['HTTP_REFERER']);
        }else{
            $_SESSION['status'] = 2;
            header('Location: '.$_SERVER['HTTP_REFERER']);
        }
    }

    if((isset($_POST['id_affectation_mod']) && !empty($_POST['id_affectation_mod'])) 
    && (isset($_POST['conducteur_affectation_mod']) && !empty($_POST['conducteur_affectation_mod']))
    && (isset($_POST['taxi_affectation_mod']) && !empty($_POST['taxi_affectation_mod']))
    && (isset($_POST['statut_affectation_mod']) && !empty($_POST['statut_affectation_mod']))){
        $res = setAffectationMod($_POST['id_affectation_mod'],$_POST['conducteur_affectation_mod'],$_POST['taxi_affectation_mod']
        ,$_POST['statut_affectation_mod']);
        // if($res == 1)
            $_SESSION['status'] = 1;
            header('Location: '.$_SERVER['HTTP_REFERER']);
    }

    if((isset($_GET['id_affectation']))){
        delAffectation($_GET['id_affectation']);
        $_SESSION['status'] = 1;
        header('Location: '.$_SERVER['HTTP_REFERER']);
    }

    if((isset($_GET['id_affectation_activer']))){
        enableAffectation($_GET['id_affectation_activer']);
        $_SESSION['status'] = 1;
        header('Location: '.$_SERVER['HTTP_REFERER']);
    }

    if((isset($_GET['id_affectation_desactiver']))){
        disableAffectation($_GET['id_affectation_desactiver']);
        $_SESSION['status'] = 1;
        header('Location: '.$_SERVER['HTTP_REFERER']);
    }
    /* End affectation */

    /* Start Location */
        if((isset($_GET['id_location']))){
            delLocation($_GET['id_location']);
            $_SESSION['status'] = 1;
            header('Location: '.$_SERVER['HTTP_REFERER']);
        }

        if((isset($_GET['id_location_activer']))){
            enableLocation($_GET['id_location_activer']);
            $_SESSION['status'] = 1;
            header('Location: '.$_SERVER['HTTP_REFERER']);
        }

        if((isset($_GET['id_location_desactiver']))){
            disableLocation($_GET['id_location_desactiver']);
            $_SESSION['status'] = 1;
            header('Location: '.$_SERVER['HTTP_REFERER']);
        }

        if((isset($_GET['id_location_cloturer']))){
            closeLocation($_GET['id_location_cloturer']);
            $_SESSION['status'] = 1;
            header('Location: '.$_SERVER['HTTP_REFERER']);
        }
    /* End Location */

    /* Start Réservation */
        if((isset($_GET['id_reservation']))){
            delReservation($_GET['id_reservation']);
            $_SESSION['status'] = 1;
            header('Location: '.$_SERVER['HTTP_REFERER']);
        }

        if((isset($_GET['id_reservation_activer']))){
            enableReservation($_GET['id_reservation_activer']);
            $_SESSION['status'] = 1;
            header('Location: '.$_SERVER['HTTP_REFERER']);
        }

        if((isset($_GET['id_reservation_desactiver']))){
            disableReservation($_GET['id_reservation_desactiver']);
            $_SESSION['status'] = 1;
            header('Location: '.$_SERVER['HTTP_REFERER']);
        }

        if((isset($_GET['id_reservation_cloturer']))){
            closeReservation($_GET['id_reservation_cloturer']);
            $_SESSION['status'] = 1;
            header('Location: '.$_SERVER['HTTP_REFERER']);
        }
    /* End Réservation */

    /* Start User app */
        if((isset($_GET['id_user_app']))){
            delUserApp($_GET['id_user_app']);
            $_SESSION['status'] = 1;
            header('Location: '.$_SERVER['HTTP_REFERER']);
        }

        if((isset($_GET['id_user_app_activer']))){
            enableUserApp($_GET['id_user_app_activer']);
            $_SESSION['status'] = 1;
            header('Location: '.$_SERVER['HTTP_REFERER']);
        }

        if((isset($_GET['id_user_app_desactiver']))){
            disableUserApp($_GET['id_user_app_desactiver']);
            $_SESSION['status'] = 1;
            header('Location: '.$_SERVER['HTTP_REFERER']);
        }
    /* End User app */
?>