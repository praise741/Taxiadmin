<?php 
	include('../fonction.php');
    function getTypeVehiculeById1($id_type){
        $output[] = array();
        $output = getTypeVehiculeById($id_type);
        echo json_encode($output);
    }
    if(isset($_POST['id_type'])){
        getTypeVehiculeById1($_POST['id_type']);
    }else{
		header('Location: 404erreur.php'); 
    }
?>