<?php 
	include('../fonction.php');
    function getAffectationById1($id_affectation){
        $output[] = array();
        $output = getAffectationById($id_affectation);
        echo json_encode($output);
    }
    if(isset($_POST['id_affectation'])){
        getAffectationById1($_POST['id_affectation']);
    }else{
		header('Location: 404erreur.php'); 
    }
?>