<?php 
	include('../fonction.php');
    function getVehiculeById1($id_vehicule){
        $output[] = array();
        $output = getVehiculeById($id_vehicule);
        echo json_encode($output);
    }
    if(isset($_POST['id_vehicule'])){
        getVehiculeById1($_POST['id_vehicule']);
    }else{
		header('Location: 404erreur.php'); 
    }
?>