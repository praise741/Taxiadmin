<?php 
	include('../fonction.php');
    function getTaxiById1($id_taxi){
        $output[] = array();
        $output = getTaxiById($id_taxi);
        echo json_encode($output);
    }
    if(isset($_POST['id_taxi'])){
        getTaxiById1($_POST['id_taxi']);
    }else{
		header('Location: 404erreur.php'); 
    }
?>