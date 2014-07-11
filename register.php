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
    } elseif (isset($_SESSION['values'])) {
    	$values = $_SESSION['values'];
        $errors = $_SESSION['errors'];
        $status = $_SESSION['status'];
    	$userid = null;
        $email = null;
        $first = null;
        $last = null;
    } else{
    	$values = array('first'=>"", 'last'=>"", 'email'=>"");
        $errors = array('first'=>"", 'last'=>"", 'email'=>"", 'password'=>"", 'passwordconf'=>"");
        $status = "";
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
                $("<p class='standout'>Please verify this information, there was an error creating your account please try again.</p>").insertBefore(".errors");
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
            </div><!-- end of user -->
        </div><!-- end of title -->
        <div id="body">
        	<?php
            	if($status=="error"){
                	echo "<h3 class='error'>There was an error with your submission please verify your registration information and resubmit.</h3>";
            	}
        	?>
        	<div id="register">
	        	<form action='regprocess.php' method='post'>
		        	<table>
		        		<tbody>
			        		<tr>
			        			<td><label>First Name:</label></td>
			        		</tr>
			        		<tr>
			        			<td><input type="text" name="first"
                					<?php 
					                    if($errors['first']==TRUE){
					                        echo "value='" . $values['first'] . "' class='errors'";
					                    } else {
					                        echo "value='" . $values['first'] . "'";
					                    }
                					?>
			        			></td>
			        		</tr>
			        		<tr>
				        		<td><label>Last Name:</label></td>
				        	</tr>
				        	<tr>
				        		<td><input type="text" name="last"
                					<?php 
					                    if($errors['last']==TRUE){
					                        echo "value='" . $values['last'] . "' class='errors'";
					                    } else {
					                        echo "value='" . $values['last'] . "'";
					                    }
                					?>
			        			></td>
			        		</tr>
			        		<tr>
			        			<td><label>E-mail:</label></td>
			        		</tr>
			        		<tr>
			        			<td><input type="text" name="email"
                					<?php 
					                    if($errors['last']==TRUE){
					                        echo "value='" . $values['email'] . "' class='errors'";
					                    } else {
					                        echo "value='" . $values['email'] . "'";
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
					                    } 
					                ?>
				        		></td>
			        		</tr>
			        		<tr>
				        		<td><label>Password Confirmation:</label></td>
				        	</tr>
				        	<tr>
				        		<td><input type="password" name="passwordconf"
				        			<?php 
					                    if($errors['passwordconf']==TRUE){
					                        echo "class='errors'";
					                    } 
					                ?>
				        		></td>
			        		</tr>
			        		<tr>
			        			<td><input type="submit" name="secure" value="Create Account" class="button blue width"></td>
			        		</tr>
		        		</tbody>
		        	</table>
	        	</form>
        	</div><!-- end of register -->
        </div><!-- end of body -->
        <div id="footer">
        </div><!-- end of footer -->
	</div><!-- end of wrapper -->
</div><!-- end of container -->
</body>
</html>
<?php
$_SESSION = array();
?>