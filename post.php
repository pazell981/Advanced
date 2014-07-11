<?php
session_start();
date_default_timezone_set('America/Los_Angeles');
include "new-connection.php";
if(!isset($_POST['secure'])){
	header('location: logoff.php');
	die();
} else {
	if(isset($_POST['post'])){
		$user = $_POST['userid'];
		$message = escape_this_string($_POST['message']);
		$query = "INSERT INTO posts (user_id, message, created_at, updated_at) VALUES ('" . $user . "', '" . $message . "', '" . date('Y-m-d H:i:s', time()) . "', '". date('Y-m-d H:i:s', time()) . "')";
		run_mysql_query($query);
		header('location: wall.php');
		die();
	}
	if(isset($_POST['comment'])){
		$user = $_POST['userid'];
		$comment = escape_this_string($_POST['comment']);
		$msgid = $_POST['message_id'];
		$query = "INSERT INTO comments (user_id, message_id, comment, created_at, updated_at) VALUES ('" . $user . "', '" . $msgid . "', '" . $comment . "', '" . date('Y-m-d H:i:s', time()) . "', '". date('Y-m-d H:i:s', time()) . "')";
		run_mysql_query($query);
		header('location: wall.php');
		die();
	}
	if(isset($_POST['delete_comment'])){
		$id = $_POST['message_id'];
		$query = "DELETE FROM comments WHERE id='" . $id . "'";
		run_mysql_query($query);
		header('location: wall.php');
		die();
	}
	if(isset($_POST['delete_post'])){
		$id = $_POST['message_id'];
		$query = "DELETE FROM posts WHERE id='" . $id . "'";
		run_mysql_query($query);
		header('location: wall.php');
		die();
	}
}
?>