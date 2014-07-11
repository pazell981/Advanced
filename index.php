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
    } elseif (isset($_SESSION['error'])) {
    	$errors = $_SESSION['error'];
    	$userid = null;
       	if(isset($_SESSION['email'])){
       		 $email = $_SESSION['email'];
       	} else {
       			$email = null;
       	}
        $first = null;
        $last = null;
    } else{
    	$errors = array('email'=>FALSE, 'password'=>FALSE);
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
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script type="text/javascript">
            $(document).ready(function(){
                $("<p class='standout'>Please verify this information, there was an error verifying this entry.</p>").insertBefore(".errors");
            });
    </script>
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
                </div> <!--end user -->
            </div><!-- end of title -->
            <div id="body">
            	<?php
            		if(isset($_SESSION['status'])){
            			if($_SESSION['status']=="success"){
            				echo "<h3 class='success'>Congratulations, your account has been created please login.</h3>";
                            $_SESSION = array();
            			}
            			if($_SESSION['status']=="logoff"){
            				echo "<h3 class='success'>You have been logged off.  See you next time!</h3>";
                            $_SESSION = array();
            			}
            		}
            		if($errors['email']==TRUE){
            			echo "<h3 class='error'>There was an error verifying your e-mail, please try to log-in again or <a href='register.php'>create a new account</a>.</h3>";
            		}
            		if($errors['password']==TRUE){
            			echo "<h3 class='error'>There was an error verifying your password, please try to log-in again.</h3>";
            		}
            	?>
            	<div id="login">
    	        	<form action='login.php' method='post'>
    		        	<table>
    		        		<tbody>
    			        		<tr>
    			        			<td><label>E-mail:</label></td>
    			        		</tr>
    			        		<tr>
    			        			<td><input type="text" name="email"
    					            	<?php
    					                	if($errors['email']==TRUE){
    					                    	    echo "value='" . $email . "' class='errors'";
                                                    $_SESSION = array();
    					                    	} else {
    					                    	    echo "value='" . $email . "'";
    					                    	}
                    					?>
    			        			></td>
    			        		</tr>
    			        		<tr>
    				        		<td><label>Password:</label></td>
    				        	</tr>
    				        	<tr>
    				        		<td><input type="password" name="password"
    					            	<?php
    					                	if($errors['password']==TRUE){
    												echo "class='errors'";
                                                    $_SESSION = array();
    					                    	}
                    					?>
    				        		></td>
    			        		</tr>
    			        		<tr>
    			        			<td><a href="register.php" class="button blue width">Create an Account</a></td>
    			        			<td><input type="submit" name="secure" value="Log-In" class="button blue width"></td>
    			        		</tr>
    		        		</tbody>
    		        	</table>
    	        	</form>
            	</div> <!-- end login -->
            </div> <!--end body -->
            <div id="footer">
            </div><!-- end of footer -->
    	</div>  <!-- end wrapper -->
    </div><!-- end of container -->
</body>
</html>