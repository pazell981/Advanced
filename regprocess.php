<?php
	include 'new-connection.php';
    session_start();

    if(!isset($_POST['secure'])){
        header('location: index.php');
        die();
    }

    $errors = array();
    $errorcounter = 0;
    $encpassword='';
    $salt = bin2hex(openssl_random_pseudo_bytes(81));

    if(empty($_POST['first']) || is_numeric($_POST['first'])){
        $errors['first']=TRUE;
        $errorcounter++;
    } else{
        $errors['first']=FALSE;
        $first = escape_this_string($_POST['first']);
    }
    if(empty($_POST['last']) || is_numeric($_POST['last'])){
        $errors['last']=TRUE;
        $errorcounter++;
    } else{
        $errors['last']=FALSE;
        $first = escape_this_string($_POST['last']);
    }

    $dom = array('gov', 'com', 'edu');
    if(empty($_POST['email'])){
        $errors['email']=TRUE;
        $errorcounter++;
    } else {
        if(strpos($_POST['email'], '@') == FALSE && strpos($_POST['email'], '.')==FALSE){
            $errors['email']=TRUE;
            $errorcounter++;
        } else{
            $strtest = explode('@', $_POST['email']);
            $domtest = explode('.', $strtest[1]);
            if(!in_array($domtest[1], $dom)){
                $errors['email']=TRUE;
                $errorcounter++;
            }else{
                $errors['email']=FALSE;
                $first = escape_this_string($_POST['email']);
            }
        }
    }
    if(empty($_POST['password']) || strlen($_POST['password'])<=6){
        $errors['password']=TRUE;
        $errors['passwordconf']=TRUE;
        $errorcounter++;
    }else{
        $errors['password']=FALSE;
        if(empty($_POST['passwordconf']) || $_POST['password']!==$_POST['passwordconf']){
            $errors['passwordconf']=TRUE;
            $errorcounter++;
        }else{
            $errors['passwordconf']=FALSE;
            $password = escape_this_string($_POST['password']);
            $encpassword = crypt($password, $salt);
        }
    }


    $query = "INSERT INTO users (first_name, last_name, email, password, created_at, updated_at) VALUES ( '" . $_POST['first'] . "', '" . $_POST['last'] . "', '" . $_POST['email'] . "', '" . $encpassword . "', '". date('Y-m-d H:i:s', time()) . "', '". date('Y-m-d H:i:s', time()) . "')";

    if($errorcounter>0){
        $_SESSION['values'] = array('first'=>$_POST['first'], 'last'=>$_POST['last'], 'email'=>$_POST['email']);
        $_SESSION['errors'] = $errors;
        $_SESSION['status'] = "error";
        header('location: register.php');
        die();       
    } elseif (run_mysql_query($query)){
        $_SESSION['status'] = "success";
        header('location: index.php');
        die();
    } else {
        $_SESSION['values'] = array('first'=>$_POST['first'], 'last'=>$_POST['last'], 'email'=>$_POST['email']);
        $_SESSION['errors'] = $errors;
        $_SESSION['status'] = "error";
        header('location: register.php');
        die();  
    }	
?>