<?php
	date_default_timezone_set ('Africa/Ouagadougou');
    session_start();
    include("connexion.php");
    $con->set_charset("utf8");
	require_once('php_image_magician.php');

    /* Start User */
    function setUser($id,$nom_prenom,$email,$mdp,$statut,$telephone,$categorie_user){
        include("connexion.php");
        $con->set_charset("utf8");
        $res = '0';
        $nom_prenom = str_replace("'","\'",$nom_prenom);
        $email = str_replace("'","\'",$email);
        $mdp = str_replace("'","\'",$mdp);
        $statut = str_replace("'","\'",$statut);
        $date_heure = date('Y-m-d H:i:s');

        $mdp = md5($mdp);

        $sql_verif = "SELECT id FROM tj_user WHERE email='$email' AND mdp='$mdp'";
        $result_verif = mysqli_query($con,$sql_verif);

        if(mysqli_num_rows($result_verif) > 0){
            $res = '2';
        }else{
            $sql = "INSERT INTO tj_user (id, nom_prenom, email, mdp, creer, statut, telephone, id_categorie_user)
            VALUES ($id,'$nom_prenom', '$email', '$mdp', '$date_heure', '$statut', '$telephone', $categorie_user)";
            $result = mysqli_query($con,$sql);
            if($result == 1){
                $res = '1';
            } else {
                $res = '0';
            }
        }
        mysqli_close($con);
        return $res;
    }

    function setUserMod($id,$id_user_cat,$nom_prenom,$phone,$email,$statut){
        include("connexion.php");
        $con->set_charset("utf8");
        $res = '0';
        $nom_prenom = str_replace("'","\'",$nom_prenom);
        $phone = str_replace("'","\'",$phone);
        $email = str_replace("'","\'",$email);
        $date_heure = date('Y-m-d H:i:s');

        $sql = "UPDATE tj_user SET nom_prenom='$nom_prenom', telephone='$phone', email='$email', statut='$statut', id_categorie_user=$id_user_cat WHERE id=$id";
        $result = mysqli_query($con,$sql);
        
        mysqli_close($con);
        return $res;
    }

    function getUser(){
        include("connexion.php");
        $con->set_charset("utf8");
        $sql = "SELECT u.id,u.nom_prenom,u.telephone,u.email,u.statut,u.creer,u.modifier,c.libelle as libCatUser
        FROM tj_user u, tj_categorie_user c
        WHERE u.id_categorie_user=c.id";
        $result = mysqli_query($con,$sql);
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $output[] = $row;
        }
        
        mysqli_close($con);
        if(mysqli_num_rows($result) > 0){
            return $output;
        }else{
            return $output = [];
        }
    }

    function delUser($id){
        include("connexion.php");
        $con->set_charset("utf8");
        $sql = "DELETE FROM tj_user WHERE id=$id";
        $result = mysqli_query($con,$sql);
    }

    function enableUser($id){
        include("connexion.php");
        $con->set_charset("utf8");
        $sql = "UPDATE tj_user SET statut='yes' WHERE id=$id";
        $result = mysqli_query($con,$sql);
    }

    function disableUser($id){
        include("connexion.php");
        $con->set_charset("utf8");
        $sql = "UPDATE tj_user SET statut='no' WHERE id=$id";
        $result = mysqli_query($con,$sql);
    }

    function getLastUser(){
        include("connexion.php");
        $con->set_charset("utf8");
        $sql = "SELECT * FROM tj_user ORDER BY id DESC LIMIT 1";
        $result = mysqli_query($con,$sql);
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $output[] = $row;
        }
        
        mysqli_close($con);
        if(mysqli_num_rows($result) > 0){
            return $output;
        }else{
            return $output = [];
        }
    }

    function getUserById($id_user){
        include("connexion.php");
        $con->set_charset("utf8");
        $sql = "SELECT u.id,u.nom_prenom,u.telephone,u.email,u.statut,u.creer,u.modifier,u.id_categorie_user,c.libelle as libCatUser
        FROM tj_user u, tj_categorie_user c
        WHERE u.id_categorie_user=c.id AND u.id=$id_user";
        $result = mysqli_query($con,$sql);
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $output[] = $row;
        }
        
        mysqli_close($con);
        if(mysqli_num_rows($result) > 0){
            return $output;
        }else{
            return $output = [];
        }
    }
    /* End User */

    /* Start notification */
    function getNotification(){
        include("connexion.php");
        $con->set_charset("utf8");
        $sql = "SELECT * FROM tj_notification";
        $result = mysqli_query($con,$sql);
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $output[] = $row;
        }
        
        mysqli_close($con);
        if(mysqli_num_rows($result) > 0){
            return $output;
        }else{
            return $output = [];
        }
    }

    function delNotification($id){
        include("connexion.php");
        $con->set_charset("utf8");
        $sql = "DELETE FROM tj_notification WHERE id=$id";
        $result = mysqli_query($con,$sql);
    }
    /* End notification */

    /* Start Connexion */
    function setConnexion($email,$mdp){
        include("connexion.php");
        $con->set_charset("utf8");
        $res = '0';
        $email = str_replace("'","\'",$email);
        $mdp = str_replace("'","\'",$mdp);
        $date_heure = date('Y-m-d H:i:s');

        $mdp = md5($mdp);

        $sql_verif = "SELECT u.id,u.nom_prenom,u.telephone,u.email,u.statut,u.creer,u.modifier,c.libelle as libCatUser
        FROM tj_user u, tj_categorie_user c
        WHERE u.id_categorie_user=c.id AND u.email='$email' AND u.mdp='$mdp' AND u.statut='yes'";
        $result_verif = mysqli_query($con,$sql_verif);

        if(mysqli_num_rows($result_verif) > 0){
            // output data of each row
            while($row = mysqli_fetch_assoc($result_verif)) {
                $output[] = $row;
            }
            $output['res'] = '1';
        }else{
            $output['res'] = '2';
        }
        mysqli_close($con);
        return $output;
    }
    /* End Connexion */

    /* Start Categorie User */
    function setCategorieUser($libelle){
        include("connexion.php");
        $con->set_charset("utf8");
        $res = '0';
        $libelle = str_replace("'","\'",$libelle);
        $date_heure = date('Y-m-d H:i:s');

        $sql_verif = "SELECT id FROM tj_categorie_user WHERE libelle='$libelle'";
        $result_verif = mysqli_query($con,$sql_verif);

        if(mysqli_num_rows($result_verif) > 0){
            $res = '2';
        }else{
            $sql = "INSERT INTO tj_categorie_user (libelle, creer) VALUES ('$libelle', '$date_heure')";
            $result = mysqli_query($con,$sql);
            if($result == 1){
                $res = '1';
            } else {
                $res = '0';
            }
        }
        mysqli_close($con);
        return $res;
    }

    function setCategorieUserMod($id,$categorie){
        include("connexion.php");
        $con->set_charset("utf8");
        $res = '0';
        $nom_prenom = str_replace("'","\'",$nom_prenom);
        $telephone = str_replace("'","\'",$telephone);
        $email = str_replace("'","\'",$email);
        $date_heure = date('Y-m-d H:i:s');

        $sql = "UPDATE tj_categorie_user SET libelle='$categorie' WHERE id=$id";
        $result = mysqli_query($con,$sql);
        
        mysqli_close($con);
        return $res;
    }

    function getCategorieUser(){
        include("connexion.php");
        $con->set_charset("utf8");
        $sql = "SELECT * FROM tj_categorie_user";
        $result = mysqli_query($con,$sql);
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $output[] = $row;
        }
        
        mysqli_close($con);
        if(mysqli_num_rows($result) > 0){
            return $output;
        }else{
            return $output = [];
        }
    }

    function getCategorieUserById($id_categorie){
        include("connexion.php");
        $con->set_charset("utf8");
        $sql = "SELECT * FROM tj_categorie_user WHERE id=$id_categorie";
        $result = mysqli_query($con,$sql);
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $output[] = $row;
        }
        
        mysqli_close($con);
        if(mysqli_num_rows($result) > 0){
            return $output;
        }else{
            return $output = [];
        }
    }

    function getIdCategorieUserByLibelle($lib_annee){
        include("connexion.php");
        $con->set_charset("utf8");
        $sql = "SELECT id FROM tj_categorie_user WHERE libelle='$lib_annee'";
        $result = mysqli_query($con,$sql);
        // output data of each row
        $id = 0;
        while($row = mysqli_fetch_assoc($result)) {
            $id = $row['id'];
        }
        
        mysqli_close($con);
        return $id;
    }

    function delCategorieUser($id){
        include("connexion.php");
        $con->set_charset("utf8");
        $sql = "DELETE FROM tj_categorie_user WHERE id=$id";
        $result = mysqli_query($con,$sql);
        mysqli_close($con);
    }

    function getLastCategorieUser(){
        include("connexion.php");
        $con->set_charset("utf8");
        $sql = "SELECT * FROM tj_categorie_user ORDER BY id DESC LIMIT 1";
        $result = mysqli_query($con,$sql);
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $output[] = $row;
        }
        
        mysqli_close($con);
        if(mysqli_num_rows($result) > 0){
            return $output;
        }else{
            return $output = [];
        }
    }
    /* End Categorie User */

    /* Start Type véhicule */
    function setTypeVehicule($libelle){
        include("connexion.php");
        $con->set_charset("utf8");
        $res = '0';
        $libelle = str_replace("'","\'",$libelle);
        $date_heure = date('Y-m-d H:i:s');

        $sql_verif = "SELECT id FROM tj_type_vehicule WHERE libelle='$libelle'";
        $result_verif = mysqli_query($con,$sql_verif);

        if(mysqli_num_rows($result_verif) > 0){
            $res = '2';
        }else{
            $sql = "INSERT INTO tj_type_vehicule (libelle, creer) VALUES ('$libelle', '$date_heure')";
            $result = mysqli_query($con,$sql);
            if($result == 1){
                $res = '1';
            } else {
                $res = '0';
            }
        }
        mysqli_close($con);
        return $res;
    }

    function setTypeVehiculeMod($id,$libelle){
        include("connexion.php");
        $con->set_charset("utf8");
        $res = '0';
        $libelle = str_replace("'","\'",$libelle);
        $date_heure = date('Y-m-d H:i:s');

        $sql = "UPDATE tj_type_vehicule SET libelle='$libelle', modifier='$date_heure' WHERE id=$id";
        $result = mysqli_query($con,$sql);
        
        mysqli_close($con);
        return $res;
    }

    function getTypeVehicule(){
        include("connexion.php");
        $con->set_charset("utf8");
        $sql = "SELECT * FROM tj_type_vehicule";
        $result = mysqli_query($con,$sql);
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $output[] = $row;
        }
        
        mysqli_close($con);
        if(mysqli_num_rows($result) > 0){
            return $output;
        }else{
            return $output = [];
        }
    }

    function getTypeVehiculeById($id_type){
        include("connexion.php");
        $con->set_charset("utf8");
        $sql = "SELECT * FROM tj_type_vehicule WHERE id=$id_type";
        $result = mysqli_query($con,$sql);
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $output[] = $row;
        }
        
        mysqli_close($con);
        if(mysqli_num_rows($result) > 0){
            return $output;
        }else{
            return $output = [];
        }
    }

    function getIdTypeVehiculeByLibelle($lib_annee){
        include("connexion.php");
        $con->set_charset("utf8");
        $sql = "SELECT id FROM tj_type_vehicule WHERE libelle='$lib_annee'";
        $result = mysqli_query($con,$sql);
        // output data of each row
        $id = 0;
        while($row = mysqli_fetch_assoc($result)) {
            $id = $row['id'];
        }
        
        mysqli_close($con);
        return $id;
    }

    function delTypeVehicule($id){
        include("connexion.php");
        $con->set_charset("utf8");
        $sql = "DELETE FROM tj_type_vehicule WHERE id=$id";
        $result = mysqli_query($con,$sql);
        mysqli_close($con);
    }

    function getLastTypeVehicule(){
        include("connexion.php");
        $con->set_charset("utf8");
        $sql = "SELECT * FROM tj_type_vehicule ORDER BY id DESC LIMIT 1";
        $result = mysqli_query($con,$sql);
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $output[] = $row;
        }
        
        mysqli_close($con);
        if(mysqli_num_rows($result) > 0){
            return $output;
        }else{
            return $output = [];
        }
    }
    /* End Type véhicule */

    /* Start Taxi */
    function setTaxi($type_vehicule,$numero,$statut,$immatriculation){
        include("connexion.php");
        $con->set_charset("utf8");
        $res = '0';
        $numero = str_replace("'","\'",$numero);
        $immatriculation = str_replace("'","\'",$immatriculation);
        $date_heure = date('Y-m-d H:i:s');

        $sql_verif = "SELECT id FROM tj_taxi WHERE numero='$numero'";
        $result_verif = mysqli_query($con,$sql_verif);

        if(mysqli_num_rows($result_verif) > 0){
            $res = '2';
        }else{
            $sql = "INSERT INTO tj_taxi (numero, immatriculation, statut, id_type_vehicule, creer) VALUES ('$numero', '$immatriculation', '$statut', $type_vehicule, '$date_heure')";
            $result = mysqli_query($con,$sql);
            if($result == 1){
                $res = '1';
            } else {
                $res = '0';
            }
        }
        mysqli_close($con);
        return $res;
    }

    function setTaxiMod($id,$type_vehicule,$numero,$immatriculation,$statut){
        include("connexion.php");
        $con->set_charset("utf8");
        $res = '0';
        $numero = str_replace("'","\'",$numero);
        $immatriculation = str_replace("'","\'",$immatriculation);
        $date_heure = date('Y-m-d H:i:s');

        $sql = "UPDATE tj_taxi SET id_type_vehicule='$type_vehicule', numero='$numero', immatriculation='$immatriculation', statut='$statut', modifier='$date_heure' WHERE id=$id";
        $result = mysqli_query($con,$sql);
        
        mysqli_close($con);
        return $res;
    }

    function getTaxi(){
        include("connexion.php");
        $con->set_charset("utf8");
        $sql = "SELECT v.id,v.numero,v.immatriculation,v.statut,v.creer,v.modifier,tv.libelle as libTypeVehicule
        FROM tj_taxi v, tj_type_vehicule tv
        WHERE v.id_type_vehicule=tv.id";
        $result = mysqli_query($con,$sql);
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $output[] = $row;
        }
        
        mysqli_close($con);
        if(mysqli_num_rows($result) > 0){
            return $output;
        }else{
            return $output = [];
        }
    }

    function getTaxiById($id_taxi){
        include("connexion.php");
        $con->set_charset("utf8");
        $sql = "SELECT * FROM tj_taxi WHERE id=$id_taxi";
        $result = mysqli_query($con,$sql);
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $output[] = $row;
        }
        
        mysqli_close($con);
        if(mysqli_num_rows($result) > 0){
            return $output;
        }else{
            return $output = [];
        }
    }

    function getIdTaxiByLibelle($lib_annee){
        include("connexion.php");
        $con->set_charset("utf8");
        $sql = "SELECT id FROM tj_taxi WHERE libelle='$lib_annee'";
        $result = mysqli_query($con,$sql);
        // output data of each row
        $id = 0;
        while($row = mysqli_fetch_assoc($result)) {
            $id = $row['id'];
        }
        
        mysqli_close($con);
        return $id;
    }

    function delTaxi($id){
        include("connexion.php");
        $con->set_charset("utf8");
        $sql = "DELETE FROM tj_taxi WHERE id=$id";
        $result = mysqli_query($con,$sql);
        mysqli_close($con);
    }

    function enableTaxi($id){
        include("connexion.php");
        $con->set_charset("utf8");
        $sql = "UPDATE tj_taxi SET statut='yes' WHERE id=$id";
        $result = mysqli_query($con,$sql);
    }

    function disableTaxi($id){
        include("connexion.php");
        $con->set_charset("utf8");
        $sql = "UPDATE tj_taxi SET statut='no' WHERE id=$id";
        $result = mysqli_query($con,$sql);
    }

    function getLastTaxi(){
        include("connexion.php");
        $con->set_charset("utf8");
        $sql = "SELECT * FROM tj_taxi ORDER BY id DESC LIMIT 1";
        $result = mysqli_query($con,$sql);
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $output[] = $row;
        }
        
        mysqli_close($con);
        if(mysqli_num_rows($result) > 0){
            return $output;
        }else{
            return $output = [];
        }
    }
    /* End Taxi */

    /* Start Véhicule */
    function setVehicule($type_vehicule,$statut,$prix,$nb_place,$image,$nombre){
        include("connexion.php");
        $con->set_charset("utf8");
        $res = '0';
        $date_heure = date('Y-m-d H:i:s');

        $sql_verif = "SELECT id FROM tj_vehicule WHERE id_type_vehicule=$type_vehicule";
        $result_verif = mysqli_query($con,$sql_verif);

        if(mysqli_num_rows($result_verif) > 0){
            $res = '2';
        }else{
            $sql = "INSERT INTO tj_vehicule (nombre, statut, prix, nb_place, image, id_type_vehicule, creer)
            VALUES ('$nombre', '$statut', $prix, $nb_place, '$image', $type_vehicule, '$date_heure')";
            $result = mysqli_query($con,$sql);
            if($result == 1){
                $res = '1';
            } else {
                $res = '0';
            }
        }
        mysqli_close($con);
        return $res;
    }

    function setVehiculeMod($id,$type_vehicule,$statut,$prix,$nb_place,$image,$nombre){
        include("connexion.php");
        $con->set_charset("utf8");
        $res = '0';
        $date_heure = date('Y-m-d H:i:s');

        $sql = "UPDATE tj_vehicule SET id_type_vehicule='$type_vehicule', nombre='$nombre', statut='$statut', prix=$prix, nb_place=$nb_place, image='$image', modifier='$date_heure' WHERE id=$id";
        $result = mysqli_query($con,$sql);
        
        mysqli_close($con);
        return $res;
    }

    function getVehicule(){
        include("connexion.php");
        $con->set_charset("utf8");
        $sql = "SELECT v.id,v.nombre,v.image,v.statut,v.prix,v.nb_place,v.creer,v.modifier,tv.libelle as libTypeVehicule
        FROM tj_vehicule v, tj_type_vehicule tv
        WHERE v.id_type_vehicule=tv.id";
        $result = mysqli_query($con,$sql);
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $output[] = $row;
        }
        
        mysqli_close($con);
        if(mysqli_num_rows($result) > 0){
            return $output;
        }else{
            return $output = [];
        }
    }

    function getVehiculeById($id_vehicule){
        include("connexion.php");
        $con->set_charset("utf8");
        $sql = "SELECT * FROM tj_vehicule WHERE id=$id_vehicule";
        $result = mysqli_query($con,$sql);
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $output[] = $row;
        }
        
        mysqli_close($con);
        if(mysqli_num_rows($result) > 0){
            return $output;
        }else{
            return $output = [];
        }
    }

    function getIdVehiculeByLibelle($lib_annee){
        include("connexion.php");
        $con->set_charset("utf8");
        $sql = "SELECT id FROM tj_vehicule WHERE libelle='$lib_annee'";
        $result = mysqli_query($con,$sql);
        // output data of each row
        $id = 0;
        while($row = mysqli_fetch_assoc($result)) {
            $id = $row['id'];
        }
        
        mysqli_close($con);
        return $id;
    }

    function delVehicule($id){
        include("connexion.php");
        $con->set_charset("utf8");
        $sql = "DELETE FROM tj_vehicule WHERE id=$id";
        $result = mysqli_query($con,$sql);
        mysqli_close($con);
    }

    function enableVehicule($id){
        include("connexion.php");
        $con->set_charset("utf8");
        $sql = "UPDATE tj_vehicule SET statut='yes' WHERE id=$id";
        $result = mysqli_query($con,$sql);
    }

    function disableVehicule($id){
        include("connexion.php");
        $con->set_charset("utf8");
        $sql = "UPDATE tj_vehicule SET statut='no' WHERE id=$id";
        $result = mysqli_query($con,$sql);
    }

    function getLastVehicule(){
        include("connexion.php");
        $con->set_charset("utf8");
        $sql = "SELECT * FROM tj_vehicule ORDER BY id DESC LIMIT 1";
        $result = mysqli_query($con,$sql);
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $output[] = $row;
        }
        
        mysqli_close($con);
        if(mysqli_num_rows($result) > 0){
            return $output;
        }else{
            return $output = [];
        }
    }
    /* End Véhicule */

    /* Start Conducteur */
    function setConducteur($nom,$prenom,$cnib,$statut,$login,$mdp){
        include("connexion.php");
        $con->set_charset("utf8");
        $res = '0';
        $nom = str_replace("'","\'",$nom);
        $prenom = str_replace("'","\'",$prenom);
        $cnib = str_replace("'","\'",$cnib);
        $login = str_replace("'","\'",$login);
        $mdp = str_replace("'","\'",$mdp);
        $date_heure = date('Y-m-d H:i:s');

        $mdp = md5($mdp);

        $sql_verif = "SELECT id FROM tj_conducteur WHERE phone='$login' AND mdp='$mdp'";
        $result_verif = mysqli_query($con,$sql_verif);

        if(mysqli_num_rows($result_verif) > 0){
            $res = '2';
        }else{
            $sql = "INSERT INTO tj_conducteur (nom, prenom, cnib, phone, mdp, statut, creer, online) VALUES ('$nom', '$prenom', '$cnib', '$login', '$mdp', '$statut', '$date_heure', 'oui')";
            $result = mysqli_query($con,$sql);
            if($result == 1){
                $res = '1';
            } else {
                $res = '0';
            }
        }
        mysqli_close($con);
        return $res;
    }

    function setConducteurMod($id,$nom,$prenom,$cnib,$login,$statut){
        include("connexion.php");
        $con->set_charset("utf8");
        $res = '0';
        $nom = str_replace("'","\'",$nom);
        $prenom = str_replace("'","\'",$prenom);
        $cnib = str_replace("'","\'",$cnib);
        $login = str_replace("'","\'",$login);
        $statut = str_replace("'","\'",$statut);
        $date_heure = date('Y-m-d H:i:s');

        $sql = "UPDATE tj_conducteur SET nom='$nom', prenom='$prenom', cnib='$cnib', phone='$login', statut='$statut', modifier='$date_heure' WHERE id=$id";
        $result = mysqli_query($con,$sql);
        
        mysqli_close($con);
        return $res;
    }

    function getConducteur(){
        include("connexion.php");
        $con->set_charset("utf8");
        $sql = "SELECT * FROM tj_conducteur";
        $result = mysqli_query($con,$sql);
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $output[] = $row;
        }
        
        mysqli_close($con);
        if(mysqli_num_rows($result) > 0){
            return $output;
        }else{
            return $output = [];
        }
    }

    function getConducteurById($id_conducteur){
        include("connexion.php");
        $con->set_charset("utf8");
        $sql = "SELECT * FROM tj_conducteur WHERE id=$id_conducteur";
        $result = mysqli_query($con,$sql);
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $output[] = $row;
        }
        
        mysqli_close($con);
        if(mysqli_num_rows($result) > 0){
            return $output;
        }else{
            return $output = [];
        }
    }

    function getIdConducteurByLibelle($lib_annee){
        include("connexion.php");
        $con->set_charset("utf8");
        $sql = "SELECT id FROM tj_conducteur WHERE libelle='$lib_annee'";
        $result = mysqli_query($con,$sql);
        // output data of each row
        $id = 0;
        while($row = mysqli_fetch_assoc($result)) {
            $id = $row['id'];
        }
        
        mysqli_close($con);
        return $id;
    }

    function delConducteur($id){
        include("connexion.php");
        $con->set_charset("utf8");
        $sql = "DELETE FROM tj_conducteur WHERE id=$id";
        $result = mysqli_query($con,$sql);
        mysqli_close($con);
    }

    function enableConducteur($id){
        include("connexion.php");
        $con->set_charset("utf8");
        $sql = "UPDATE tj_conducteur SET statut='yes' WHERE id=$id";
        $result = mysqli_query($con,$sql);
    }

    function disableConducteur($id){
        include("connexion.php");
        $con->set_charset("utf8");
        $sql = "UPDATE tj_conducteur SET statut='no' WHERE id=$id";
        $result = mysqli_query($con,$sql);
    }

    function getLastConducteur(){
        include("connexion.php");
        $con->set_charset("utf8");
        $sql = "SELECT * FROM tj_conducteur ORDER BY id DESC LIMIT 1";
        $result = mysqli_query($con,$sql);
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $output[] = $row;
        }
        
        mysqli_close($con);
        if(mysqli_num_rows($result) > 0){
            return $output;
        }else{
            return $output = [];
        }
    }
    /* End Conducteur */

    /* Start Affectation */
    function setAffectation($conducteur,$vehicule,$statut){
        include("connexion.php");
        $con->set_charset("utf8");
        $res = '0';
        $date_heure = date('Y-m-d H:i:s');

        $mdp = md5($mdp);

        $sql_verif = "SELECT id FROM tj_affectation WHERE id_taxi='$vehicule'";
        $result_verif = mysqli_query($con,$sql_verif);

        if(mysqli_num_rows($result_verif) > 0){
            $res = '2';
        }else{
            $sql = "INSERT INTO tj_affectation (id_taxi, id_conducteur, statut, creer) VALUES ('$vehicule', '$conducteur', '$statut', '$date_heure')";
            $result = mysqli_query($con,$sql);
            if($result == 1){
                $res = '1';
            } else {
                $res = '0';
            }
        }
        mysqli_close($con);
        return $res;
    }

    function setAffectationMod($id,$id_conducteur,$id_taxi,$statut){
        include("connexion.php");
        $con->set_charset("utf8");
        $res = '0';
        $date_heure = date('Y-m-d H:i:s');

        $sql = "UPDATE tj_affectation SET id_conducteur=$id_conducteur, id_taxi=$id_taxi, statut='$statut', modifier='$date_heure' WHERE id=$id";
        $result = mysqli_query($con,$sql);
        
        mysqli_close($con);
        return $res;
    }

    function getAffectation(){
        include("connexion.php");
        $con->set_charset("utf8");
        $sql = "SELECT a.id,a.statut,a.creer,a.modifier,v.numero,c.nom,c.prenom,v.id as idTaxi,c.id as idConducteur
        FROM tj_affectation a, tj_taxi v, tj_conducteur c
        WHERE a.id_taxi=v.id AND a.id_conducteur=c.id";
        $result = mysqli_query($con,$sql);
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $output[] = $row;
        }
        
        mysqli_close($con);
        if(mysqli_num_rows($result) > 0){
            return $output;
        }else{
            return $output = [];
        }
    }

    function getAffectationById($id_affectation){
        include("connexion.php");
        $con->set_charset("utf8");
        $sql = "SELECT * FROM tj_affectation WHERE id=$id_affectation";
        $result = mysqli_query($con,$sql);
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $output[] = $row;
        }
        
        mysqli_close($con);
        if(mysqli_num_rows($result) > 0){
            return $output;
        }else{
            return $output = [];
        }
    }

    function getIdAffectationByLibelle($lib_annee){
        include("connexion.php");
        $con->set_charset("utf8");
        $sql = "SELECT id FROM tj_affectation WHERE libelle='$lib_annee'";
        $result = mysqli_query($con,$sql);
        // output data of each row
        $id = 0;
        while($row = mysqli_fetch_assoc($result)) {
            $id = $row['id'];
        }
        
        mysqli_close($con);
        return $id;
    }

    function delAffectation($id){
        include("connexion.php");
        $con->set_charset("utf8");
        $sql = "DELETE FROM tj_affectation WHERE id=$id";
        $result = mysqli_query($con,$sql);
        mysqli_close($con);
    }

    function enableAffectation($id){
        include("connexion.php");
        $con->set_charset("utf8");
        $sql = "UPDATE tj_affectation SET statut='yes' WHERE id=$id";
        $result = mysqli_query($con,$sql);
    }

    function disableAffectation($id){
        include("connexion.php");
        $con->set_charset("utf8");
        $sql = "UPDATE tj_affectation SET statut='no' WHERE id=$id";
        $result = mysqli_query($con,$sql);
    }

    function getLastAffectation(){
        include("connexion.php");
        $con->set_charset("utf8");
        $sql = "SELECT * FROM tj_affectation ORDER BY id DESC LIMIT 1";
        $result = mysqli_query($con,$sql);
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $output[] = $row;
        }
        
        mysqli_close($con);
        if(mysqli_num_rows($result) > 0){
            return $output;
        }else{
            return $output = [];
        }
    }
    /* End Affectation */

    /* Start User App */
    function setUtilisateurApp($conducteur,$vehicule,$statut){
        include("connexion.php");
        $con->set_charset("utf8");
        $res = '0';
        $date_heure = date('Y-m-d H:i:s');

        $mdp = md5($mdp);

        $sql_verif = "SELECT id FROM tj_user_app WHERE id_taxi='$vehicule'";
        $result_verif = mysqli_query($con,$sql_verif);

        if(mysqli_num_rows($result_verif) > 0){
            $res = '2';
        }else{
            $sql = "INSERT INTO tj_user_app (id_taxi, id_conducteur, statut, creer) VALUES ('$vehicule', '$conducteur', '$statut', '$date_heure')";
            $result = mysqli_query($con,$sql);
            if($result == 1){
                $res = '1';
            } else {
                $res = '0';
            }
        }
        mysqli_close($con);
        return $res;
    }

    function setUtilisateurAppMod($id,$id_conducteur,$id_taxi,$statut){
        include("connexion.php");
        $con->set_charset("utf8");
        $res = '0';
        $date_heure = date('Y-m-d H:i:s');

        $sql = "UPDATE tj_user_app SET id_conducteur=$id_conducteur, id_taxi=$id_taxi, statut='$statut', modifier='$date_heure' WHERE id=$id";
        $result = mysqli_query($con,$sql);
        
        mysqli_close($con);
        return $res;
    }

    function getUserApp(){
        include("connexion.php");
        $con->set_charset("utf8");
        $sql = "SELECT * FROM tj_user_app";
        $result = mysqli_query($con,$sql);
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $output[] = $row;
        }
        
        mysqli_close($con);
        if(mysqli_num_rows($result) > 0){
            return $output;
        }else{
            return $output = [];
        }
    }

    function getUserAppById($id_affectation){
        include("connexion.php");
        $con->set_charset("utf8");
        $sql = "SELECT * FROM tj_user_app WHERE id=$id_affectation";
        $result = mysqli_query($con,$sql);
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $output[] = $row;
        }
        
        mysqli_close($con);
        if(mysqli_num_rows($result) > 0){
            return $output;
        }else{
            return $output = [];
        }
    }

    function getIdUserAppByLibelle($lib_annee){
        include("connexion.php");
        $con->set_charset("utf8");
        $sql = "SELECT id FROM tj_user_app WHERE libelle='$lib_annee'";
        $result = mysqli_query($con,$sql);
        // output data of each row
        $id = 0;
        while($row = mysqli_fetch_assoc($result)) {
            $id = $row['id'];
        }
        
        mysqli_close($con);
        return $id;
    }

    function delUserApp($id){
        include("connexion.php");
        $con->set_charset("utf8");
        $sql = "DELETE FROM tj_user_app WHERE id=$id";
        $result = mysqli_query($con,$sql);
        mysqli_close($con);
    }

    function enableUserApp($id){
        include("connexion.php");
        $con->set_charset("utf8");
        $sql = "UPDATE tj_user_app SET statut='yes' WHERE id=$id";
        $result = mysqli_query($con,$sql);
    }

    function disableUserApp($id){
        include("connexion.php");
        $con->set_charset("utf8");
        $sql = "UPDATE tj_user_app SET statut='no' WHERE id=$id";
        $result = mysqli_query($con,$sql);
    }

    function getLastUserApp(){
        include("connexion.php");
        $con->set_charset("utf8");
        $sql = "SELECT * FROM tj_user_app ORDER BY id DESC LIMIT 1";
        $result = mysqli_query($con,$sql);
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $output[] = $row;
        }
        
        mysqli_close($con);
        if(mysqli_num_rows($result) > 0){
            return $output;
        }else{
            return $output = [];
        }
    }
    /* End User App */

    /* Start Suggestion */
    function setSuggestion($conducteur,$vehicule,$statut){
        include("connexion.php");
        $con->set_charset("utf8");
        $res = '0';
        $date_heure = date('Y-m-d H:i:s');

        $mdp = md5($mdp);

        $sql_verif = "SELECT id FROM tj_suggestion WHERE id_taxi='$vehicule'";
        $result_verif = mysqli_query($con,$sql_verif);

        if(mysqli_num_rows($result_verif) > 0){
            $res = '2';
        }else{
            $sql = "INSERT INTO tj_suggestion (id_taxi, id_conducteur, statut, creer) VALUES ('$vehicule', '$conducteur', '$statut', '$date_heure')";
            $result = mysqli_query($con,$sql);
            if($result == 1){
                $res = '1';
            } else {
                $res = '0';
            }
        }
        mysqli_close($con);
        return $res;
    }

    function setSuggestionMod($id,$id_conducteur,$id_taxi,$statut){
        include("connexion.php");
        $con->set_charset("utf8");
        $res = '0';
        $date_heure = date('Y-m-d H:i:s');

        $sql = "UPDATE tj_suggestion SET id_conducteur=$id_conducteur, id_taxi=$id_taxi, statut='$statut', modifier='$date_heure' WHERE id=$id";
        $result = mysqli_query($con,$sql);
        
        mysqli_close($con);
        return $res;
    }

    function getSuggestion(){
        include("connexion.php");
        $con->set_charset("utf8");
        $sql = "SELECT s.id,s.message,s.creer,s.modifier,s.id_user_app
        FROM tj_suggestion s, tj_user_app u WHERE s.id_user_app=u.id";
        $result = mysqli_query($con,$sql);
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $output[] = $row;
        }
        
        mysqli_close($con);
        if(mysqli_num_rows($result) > 0){
            return $output;
        }else{
            return $output = [];
        }
    }

    function getSuggestionById($id_affectation){
        include("connexion.php");
        $con->set_charset("utf8");
        $sql = "SELECT * FROM tj_suggestion WHERE id=$id_affectation";
        $result = mysqli_query($con,$sql);
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $output[] = $row;
        }
        
        mysqli_close($con);
        if(mysqli_num_rows($result) > 0){
            return $output;
        }else{
            return $output = [];
        }
    }

    function getIdSuggestionByLibelle($lib_annee){
        include("connexion.php");
        $con->set_charset("utf8");
        $sql = "SELECT id FROM tj_suggestion WHERE libelle='$lib_annee'";
        $result = mysqli_query($con,$sql);
        // output data of each row
        $id = 0;
        while($row = mysqli_fetch_assoc($result)) {
            $id = $row['id'];
        }
        
        mysqli_close($con);
        return $id;
    }

    function delSuggestion($id){
        include("connexion.php");
        $con->set_charset("utf8");
        $sql = "DELETE FROM tj_suggestion WHERE id=$id";
        $result = mysqli_query($con,$sql);
        mysqli_close($con);
    }

    function enableSuggestion($id){
        include("connexion.php");
        $con->set_charset("utf8");
        $sql = "UPDATE tj_suggestion SET statut='yes' WHERE id=$id";
        $result = mysqli_query($con,$sql);
    }

    function disableSuggestion($id){
        include("connexion.php");
        $con->set_charset("utf8");
        $sql = "UPDATE tj_suggestion SET statut='no' WHERE id=$id";
        $result = mysqli_query($con,$sql);
    }

    function getLastSuggestion(){
        include("connexion.php");
        $con->set_charset("utf8");
        $sql = "SELECT * FROM tj_suggestion ORDER BY id DESC LIMIT 1";
        $result = mysqli_query($con,$sql);
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $output[] = $row;
        }
        
        mysqli_close($con);
        if(mysqli_num_rows($result) > 0){
            return $output;
        }else{
            return $output = [];
        }
    }
    /* End Suggestion */

    /* Start Commentaire */
    function setCommentaire($conducteur,$vehicule,$statut){
        include("connexion.php");
        $con->set_charset("utf8");
        $res = '0';
        $date_heure = date('Y-m-d H:i:s');

        $mdp = md5($mdp);

        $sql_verif = "SELECT id FROM tj_commentaire WHERE id_taxi='$vehicule'";
        $result_verif = mysqli_query($con,$sql_verif);

        if(mysqli_num_rows($result_verif) > 0){
            $res = '2';
        }else{
            $sql = "INSERT INTO tj_commentaire (id_taxi, id_conducteur, statut, creer) VALUES ('$vehicule', '$conducteur', '$statut', '$date_heure')";
            $result = mysqli_query($con,$sql);
            if($result == 1){
                $res = '1';
            } else {
                $res = '0';
            }
        }
        mysqli_close($con);
        return $res;
    }

    function setCommentaireMod($id,$id_conducteur,$id_taxi,$statut){
        include("connexion.php");
        $con->set_charset("utf8");
        $res = '0';
        $date_heure = date('Y-m-d H:i:s');

        $sql = "UPDATE tj_commentaire SET id_conducteur=$id_conducteur, id_taxi=$id_taxi, statut='$statut', modifier='$date_heure' WHERE id=$id";
        $result = mysqli_query($con,$sql);
        
        mysqli_close($con);
        return $res;
    }

    function getCommentaire(){
        include("connexion.php");
        $con->set_charset("utf8");
        $sql = "SELECT c.id,c.description,c.id_conducteur,c.creer,c.modifier,c.id_user_app,c.statut
        FROM tj_commentaire c, tj_user_app u WHERE c.id_user_app=u.id";
        $result = mysqli_query($con,$sql);
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $output[] = $row;
        }
        
        mysqli_close($con);
        if(mysqli_num_rows($result) > 0){
            return $output;
        }else{
            return $output = [];
        }
    }

    function getCommentaireById($id_affectation){
        include("connexion.php");
        $con->set_charset("utf8");
        $sql = "SELECT * FROM tj_commentaire WHERE id=$id_affectation";
        $result = mysqli_query($con,$sql);
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $output[] = $row;
        }
        
        mysqli_close($con);
        if(mysqli_num_rows($result) > 0){
            return $output;
        }else{
            return $output = [];
        }
    }

    function getIdCommentaireByLibelle($lib_annee){
        include("connexion.php");
        $con->set_charset("utf8");
        $sql = "SELECT id FROM tj_commentaire WHERE libelle='$lib_annee'";
        $result = mysqli_query($con,$sql);
        // output data of each row
        $id = 0;
        while($row = mysqli_fetch_assoc($result)) {
            $id = $row['id'];
        }
        
        mysqli_close($con);
        return $id;
    }

    function delCommentaire($id){
        include("connexion.php");
        $con->set_charset("utf8");
        $sql = "DELETE FROM tj_commentaire WHERE id=$id";
        $result = mysqli_query($con,$sql);
        mysqli_close($con);
    }

    function enableCommentaire($id){
        include("connexion.php");
        $con->set_charset("utf8");
        $sql = "UPDATE tj_commentaire SET statut='yes' WHERE id=$id";
        $result = mysqli_query($con,$sql);
    }

    function disableCommentaire($id){
        include("connexion.php");
        $con->set_charset("utf8");
        $sql = "UPDATE tj_commentaire SET statut='no' WHERE id=$id";
        $result = mysqli_query($con,$sql);
    }

    function getLastCommentaire(){
        include("connexion.php");
        $con->set_charset("utf8");
        $sql = "SELECT * FROM tj_commentaire ORDER BY id DESC LIMIT 1";
        $result = mysqli_query($con,$sql);
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $output[] = $row;
        }
        
        mysqli_close($con);
        if(mysqli_num_rows($result) > 0){
            return $output;
        }else{
            return $output = [];
        }
    }
    /* End Commentaire */

    /* Start Requête */
    function setRequete($conducteur,$vehicule,$statut){
        include("connexion.php");
        $con->set_charset("utf8");
        $res = '0';
        $date_heure = date('Y-m-d H:i:s');

        $mdp = md5($mdp);

        $sql_verif = "SELECT id FROM tj_requete WHERE id_taxi='$vehicule'";
        $result_verif = mysqli_query($con,$sql_verif);

        if(mysqli_num_rows($result_verif) > 0){
            $res = '2';
        }else{
            $sql = "INSERT INTO tj_requete (id_taxi, id_conducteur, statut, creer) VALUES ('$vehicule', '$conducteur', '$statut', '$date_heure')";
            $result = mysqli_query($con,$sql);
            if($result == 1){
                $res = '1';
            } else {
                $res = '0';
            }
        }
        mysqli_close($con);
        return $res;
    }

    function setRequeteMod($id,$id_conducteur,$id_taxi,$statut){
        include("connexion.php");
        $con->set_charset("utf8");
        $res = '0';
        $date_heure = date('Y-m-d H:i:s');

        $sql = "UPDATE tj_requete SET id_conducteur=$id_conducteur, id_taxi=$id_taxi, statut='$statut', modifier='$date_heure' WHERE id=$id";
        $result = mysqli_query($con,$sql);
        
        mysqli_close($con);
        return $res;
    }

    function getRequete(){
        include("connexion.php");
        $con->set_charset("utf8");
        $sql = "SELECT r.id,r.distance,r.creer,r.modifier,r.id_user_app,r.statut,r.statut_course,u.nom,u.prenom
        FROM tj_requete r, tj_user_app u WHERE r.id_user_app=u.id";
        $result = mysqli_query($con,$sql);
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $output[] = $row;
        }
        
        mysqli_close($con);
        if(mysqli_num_rows($result) > 0){
            return $output;
        }else{
            return $output = [];
        }
    }

    function getRequeteById($id_affectation){
        include("connexion.php");
        $con->set_charset("utf8");
        $sql = "SELECT * FROM tj_requete WHERE id=$id_affectation";
        $result = mysqli_query($con,$sql);
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $output[] = $row;
        }
        
        mysqli_close($con);
        if(mysqli_num_rows($result) > 0){
            return $output;
        }else{
            return $output = [];
        }
    }

    function getIdRequeteByLibelle($lib_annee){
        include("connexion.php");
        $con->set_charset("utf8");
        $sql = "SELECT id FROM tj_requete WHERE libelle='$lib_annee'";
        $result = mysqli_query($con,$sql);
        // output data of each row
        $id = 0;
        while($row = mysqli_fetch_assoc($result)) {
            $id = $row['id'];
        }
        
        mysqli_close($con);
        return $id;
    }

    function delRequete($id){
        include("connexion.php");
        $con->set_charset("utf8");
        $sql = "DELETE FROM tj_requete WHERE id=$id";
        $result = mysqli_query($con,$sql);
        mysqli_close($con);
    }

    function enableRequete($id){
        include("connexion.php");
        $con->set_charset("utf8");
        $sql = "UPDATE tj_requete SET statut='yes' WHERE id=$id";
        $result = mysqli_query($con,$sql);
    }

    function disableRequete($id){
        include("connexion.php");
        $con->set_charset("utf8");
        $sql = "UPDATE tj_requete SET statut='no' WHERE id=$id";
        $result = mysqli_query($con,$sql);
    }

    function getLastRequete(){
        include("connexion.php");
        $con->set_charset("utf8");
        $sql = "SELECT * FROM tj_requete ORDER BY id DESC LIMIT 1";
        $result = mysqli_query($con,$sql);
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $output[] = $row;
        }
        
        mysqli_close($con);
        if(mysqli_num_rows($result) > 0){
            return $output;
        }else{
            return $output = [];
        }
    }
    /* End Requête */

    /* Start Réservation */
    /*function setReservation($conducteur,$vehicule,$statut){
        include("connexion.php");
        $con->set_charset("utf8");
        $res = '0';
        $date_heure = date('Y-m-d H:i:s');

        $mdp = md5($mdp);

        $sql_verif = "SELECT id FROM tj_reservation_taxi WHERE id_taxi='$vehicule'";
        $result_verif = mysqli_query($con,$sql_verif);

        if(mysqli_num_rows($result_verif) > 0){
            $res = '2';
        }else{
            $sql = "INSERT INTO tj_reservation_taxi (id_taxi, id_conducteur, statut, creer) VALUES ('$vehicule', '$conducteur', '$statut', '$date_heure')";
            $result = mysqli_query($con,$sql);
            if($result == 1){
                $res = '1';
            } else {
                $res = '0';
            }
        }
        mysqli_close($con);
        return $res;
    }*/

    /*function setReservationMod($id,$id_conducteur,$id_taxi,$statut){
        include("connexion.php");
        $con->set_charset("utf8");
        $res = '0';
        $date_heure = date('Y-m-d H:i:s');

        $sql = "UPDATE tj_reservation_taxi SET id_conducteur=$id_conducteur, id_taxi=$id_taxi, statut='$statut', modifier='$date_heure' WHERE id=$id";
        $result = mysqli_query($con,$sql);
        
        mysqli_close($con);
        return $res;
    }*/

    function getReservation(){
        include("connexion.php");
        $con->set_charset("utf8");
        $sql = "SELECT r.id,r.cout,r.distance,r.date_depart,r.heure_depart,r.contact,r.creer,r.modifier,r.id_user_app,r.statut,u.nom,u.prenom
        FROM tj_reservation_taxi r, tj_user_app u WHERE r.id_user_app=u.id";
        $result = mysqli_query($con,$sql);
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $output[] = $row;
        }
        
        mysqli_close($con);
        if(mysqli_num_rows($result) > 0){
            return $output;
        }else{
            return $output = [];
        }
    }

    /*function getReservationById($id_reservation){
        include("connexion.php");
        $con->set_charset("utf8");
        $sql = "SELECT * FROM tj_reservation_taxi WHERE id=$id_reservation";
        $result = mysqli_query($con,$sql);
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $output[] = $row;
        }
        
        mysqli_close($con);
        if(mysqli_num_rows($result) > 0){
            return $output;
        }else{
            return $output = [];
        }
    }*/

    function getIdReservationByLibelle($lib_annee){
        include("connexion.php");
        $con->set_charset("utf8");
        $sql = "SELECT id FROM tj_reservation_taxi WHERE libelle='$lib_annee'";
        $result = mysqli_query($con,$sql);
        // output data of each row
        $id = 0;
        while($row = mysqli_fetch_assoc($result)) {
            $id = $row['id'];
        }
        
        mysqli_close($con);
        return $id;
    }

    function delReservation($id){
        include("connexion.php");
        $con->set_charset("utf8");
        $sql = "DELETE FROM tj_reservation_taxi WHERE id=$id";
        $result = mysqli_query($con,$sql);
        mysqli_close($con);
    }

    function enableReservation($id){
        include("connexion.php");
        $con->set_charset("utf8");
        $sql = "UPDATE tj_reservation_taxi SET statut='accepter' WHERE id=$id";
        $result = mysqli_query($con,$sql);
    }

    function disableReservation($id){
        include("connexion.php");
        $con->set_charset("utf8");
        $sql = "UPDATE tj_reservation_taxi SET statut='refuser' WHERE id=$id";
        $result = mysqli_query($con,$sql);
    }

    function closeReservation($id){
        include("connexion.php");
        $con->set_charset("utf8");
        $sql = "UPDATE tj_reservation_taxi SET statut='clôturer' WHERE id=$id";
        $result = mysqli_query($con,$sql);
    }

    function getLastReservation(){
        include("connexion.php");
        $con->set_charset("utf8");
        $sql = "SELECT * FROM tj_reservation_taxi ORDER BY id DESC LIMIT 1";
        $result = mysqli_query($con,$sql);
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $output[] = $row;
        }
        
        mysqli_close($con);
        if(mysqli_num_rows($result) > 0){
            return $output;
        }else{
            return $output = [];
        }
    }
    /* End Réservation */

    /* Start Location */
    /*function setLocation($conducteur,$vehicule,$statut){
        include("connexion.php");
        $con->set_charset("utf8");
        $res = '0';
        $date_heure = date('Y-m-d H:i:s');

        $mdp = md5($mdp);

        $sql_verif = "SELECT id FROM tj_location_vehicule WHERE id_taxi='$vehicule'";
        $result_verif = mysqli_query($con,$sql_verif);

        if(mysqli_num_rows($result_verif) > 0){
            $res = '2';
        }else{
            $sql = "INSERT INTO tj_location_vehicule (id_taxi, id_conducteur, statut, creer) VALUES ('$vehicule', '$conducteur', '$statut', '$date_heure')";
            $result = mysqli_query($con,$sql);
            if($result == 1){
                $res = '1';
            } else {
                $res = '0';
            }
        }
        mysqli_close($con);
        return $res;
    }*/

    /*function setLocationMod($id,$id_conducteur,$id_taxi,$statut){
        include("connexion.php");
        $con->set_charset("utf8");
        $res = '0';
        $date_heure = date('Y-m-d H:i:s');

        $sql = "UPDATE tj_location_vehicule SET id_conducteur=$id_conducteur, id_taxi=$id_taxi, statut='$statut', modifier='$date_heure' WHERE id=$id";
        $result = mysqli_query($con,$sql);
        
        mysqli_close($con);
        return $res;
    }*/

    function getLocation(){
        include("connexion.php");
        $con->set_charset("utf8");
        $sql = "SELECT l.id,l.nb_jour,l.contact,l.date_debut,l.date_fin,l.creer,l.modifier,l.id_user_app,l.statut,
        u.nom,u.prenom,tv.libelle as libTypeVehicule
        FROM tj_location_vehicule l, tj_user_app u, tj_vehicule v, tj_type_vehicule tv
        WHERE l.id_user_app=u.id AND l.id_vehicule=v.id AND v.id_type_vehicule=tv.id";
        $result = mysqli_query($con,$sql);
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $output[] = $row;
        }
        
        mysqli_close($con);
        if(mysqli_num_rows($result) > 0){
            return $output;
        }else{
            return $output = [];
        }
    }

    /*function getLocationById($id_reservation){
        include("connexion.php");
        $con->set_charset("utf8");
        $sql = "SELECT * FROM tj_location_vehicule WHERE id=$id_reservation";
        $result = mysqli_query($con,$sql);
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $output[] = $row;
        }
        
        mysqli_close($con);
        if(mysqli_num_rows($result) > 0){
            return $output;
        }else{
            return $output = [];
        }
    }*/

    function getIdLocationByLibelle($lib_annee){
        include("connexion.php");
        $con->set_charset("utf8");
        $sql = "SELECT id FROM tj_location_vehicule WHERE libelle='$lib_annee'";
        $result = mysqli_query($con,$sql);
        // output data of each row
        $id = 0;
        while($row = mysqli_fetch_assoc($result)) {
            $id = $row['id'];
        }
        
        mysqli_close($con);
        return $id;
    }

    function delLocation($id){
        include("connexion.php");
        $con->set_charset("utf8");
        $sql = "DELETE FROM tj_location_vehicule WHERE id=$id";
        $result = mysqli_query($con,$sql);
        mysqli_close($con);
    }

    function enableLocation($id){
        include("connexion.php");
        $con->set_charset("utf8");
        $sql = "UPDATE tj_location_vehicule SET statut='accepter' WHERE id=$id";
        $result = mysqli_query($con,$sql);
    }

    function disableLocation($id){
        include("connexion.php");
        $con->set_charset("utf8");
        $sql = "UPDATE tj_location_vehicule SET statut='refuser' WHERE id=$id";
        $result = mysqli_query($con,$sql);
    }

    function closeLocation($id){
        include("connexion.php");
        $con->set_charset("utf8");
        $sql = "UPDATE tj_location_vehicule SET statut='clôturer' WHERE id=$id";
        $result = mysqli_query($con,$sql);
    }

    function getLastLocation(){
        include("connexion.php");
        $con->set_charset("utf8");
        $sql = "SELECT * FROM tj_location_vehicule ORDER BY id DESC LIMIT 1";
        $result = mysqli_query($con,$sql);
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $output[] = $row;
        }
        
        mysqli_close($con);
        if(mysqli_num_rows($result) > 0){
            return $output;
        }else{
            return $output = [];
        }
    }
    /* End Location */

    /* Start change mot de passe */
    function setChangeMdp($anc_mdp,$new_mdp){
        include("connexion.php");
        $con->set_charset("utf8");
        $res = '0';
        $anc_mdp = str_replace("'","\'",$anc_mdp);
        $new_mdp = str_replace("'","\'",$new_mdp);
        $date_heure = date('Y-m-d H:i:s');

        $anc_mdp = md5($anc_mdp);
        $new_mdp = md5($new_mdp);

        $sql = "SELECT id FROM tj_user WHERE mdp='$anc_mdp'";
        $result = mysqli_query($con,$sql);
        if(mysqli_num_rows($result) > 0){
            $sql1 = "UPDATE tj_user SET mdp='$new_mdp' WHERE mdp='$anc_mdp'";
            if (mysqli_query($con,$sql1)) {
                $res = '1';
            } else {
                $res = '0';
            }
        }else{
            $res = '0';
        }
        
        return $res;
    }
    /* End change mot de passe */

    /* Start Resize image */
    function resizeImage($img,$width,$height,$name){
        /*	Purpose: Open image
        *	Usage:	 resize('filename.type')
        * 	Params:	 filename.type - the filename to open
        */
        $magicianObj = new imageLib($img);


        /*	Purpose: Resize image
        *	Usage:	 resizeImage([width], [height])
        * 	Params:	 width - the new width to resize to
        *			 height - the new height to resize to 
        */	
        // $magicianObj -> resizeImage($width, $height);
        $magicianObj -> resizeImage($width, $height, 'crop', true);


        /*	Purpose: Save image
        *	Usage:	 saveImage('[filename.type]', [quality])
        * 	Params:	 filename.type - the filename and file type to save as
        * 			 quality - (optional) 0-100 (100 being the highest (default))
        *				Only applies to jpg & png only
        */
        $magicianObj -> saveImage($name, 100);
    }
    /* End Resize image */
?>