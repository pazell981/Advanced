<?php
    session_start();
    include 'new-connection.php';
    if (isset($_SESSION['userid'])) {
        $userid = $_SESSION['userid'];
        $query = "SELECT * FROM user WHERE id ='" . $userid . "'";
        $userinfo = fetch_record($query);
        $email = $userinfo['email'];
        $first = $userinfo['first_name'];
        $last = $userinfo['last_name'];
    } else {
        $userid = null;
        $email = null;
        $first = null;
        $last = null;
    }
?>
<!DOCTYPE HTML>
<html>
<head>
	<meta charset="UTF-8">
	<title>PHP with MySQL - Intermediate</title>
	<meta name="description" content="PHP with MySQL - 07/09/14 - Intermediate">
	<link href='http://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="css.css">

</head>
<body>
<div id="container">
	<div id="wrapper">
		<div id="title">
            <h1>theWall</h1>
            <div id="user">
                <?php 
                    if(isset($user)){
                        echo "<h6>Welcome " . $first . "!  </h6>";
                        echo "<a href='logoff.php' class='button blue'>Log off</a>";
                    }else{
                        echo "<a href='index.php' class='button blue'>Log in</a>";
                    } 
                ?>
            </div>
        </div>
        <div id="body">

        </div>
        <div id="footer">
        </div>
	</div>
</div>
</body>
</html>