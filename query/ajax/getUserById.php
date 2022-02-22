<?php 
	include('../fonction.php');
    function getUserById1($id_user){
        $output[] = array();
        $output = getUserById($id_user);
        echo json_encode($output);
    }
    if(isset($_POST['id_user'])){
        getUserById1($_POST['id_user']);
    }else{
		header('Location: 404erreur.php'); 
    }
?>