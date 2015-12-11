<?php
    include 'inc/process_login.php';

	use Parse\ParseUser;
    
	$currentUserIndex = ParseUser::getCurrentUser();
	$username = $firstName = $lastName = '';
    $userNotLogged = false;

    if($currentUserIndex){
        //There is a logged in user!
        $currentUserIndex->fetch();
        $username = $currentUserIndex->getUsername();
        $firstName = $currentUserIndex->get("firstName");
        $lastName = $currentUserIndex->get("lastName");
    }else{
        $userNotLogged = true;
    }

	$pageTitle = "SkillCourt";
	include('html/head.php');
	include('html/body.php');
	include('html/footer.php'); 
?>