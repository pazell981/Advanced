<?php
session_start();
include "new-connection.php";

if(!isset($_POST['secure'])){
	header('location: index.php');
	die();
} else {
	$email = escape_this_string($_POST['email']);
	$password = escape_this_string($_POST['password']);
	$errors = array('email'=>null,'password'=>null);

	$query = "SELECT id, password FROM users WHERE email='" . $email . "'";

	$result = fetch_record($query);
	$encpassword = crypt($password, $result['password']);

	if(is_null($result)){
		$errors['email']=TRUE;
		$_SESSION['error']=$errors;
		header('location: index.php');
		die();
	} elseif ($result['password']!==$encpassword) {
		$errors['password']=TRUE;
		$_SESSION['error']=$errors;
		$_SESSION['email']=$email;
		header('location: index.php');
		die();
	} else{
		$_SESSION['userid'] = $result['id'];
		header('location: wall.php');
		die();
	}
}
?>