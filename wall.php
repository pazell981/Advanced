<?php
    session_start();
    include 'new-connection.php';
    date_default_timezone_set('America/Los_Angeles');
    if (isset($_SESSION['userid'])) {
        $query = "SELECT * FROM users WHERE id ='" . $_SESSION['userid'] . "'";
        $userinfo = fetch_record($query);
        $email = $userinfo['email'];
        $first = $userinfo['first_name'];
        $last = $userinfo['last_name'];
    } else {
        header('location: index.php');
        die();
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
                    if(isset($userinfo)){
                        echo "<h6>Welcome " . $first . "!  </h6>";
                        echo "<a href='logoff.php' class='button blue'>Log off</a>";
                    }else{
                        echo "<a href='index.php' class='button blue'>Log in</a>";
                    } 
                ?>
            </div>
        </div><!-- end of title -->
        <div id="body">
            <div id="post">
                <h4>Post a message</h4>
                <form action="post.php" method="post">
                    <input type="hidden" name="secure" value='secure'>
                    <input type="hidden" name="userid" value=<?php echo "'" . $_SESSION['userid'] . "'" ?>>
                    <textarea name="message"></textarea>
                    <input type="submit" name="post" value="Post" class="button blue">
                </form>
            </div><!-- end of post -->
            <div id="wall">
                <?php
                    $post_query = "SELECT * FROM posts ORDER BY created_at DESC";
                    $posts = fetch_all($post_query);
                    if(!is_null($posts)){
                        foreach ($posts as $post) {
                            $user_query = "SELECT first_name, last_name FROM users WHERE id ='" . $post['user_id'] . "'";
                            $user = fetch_record($user_query);
                            echo "<div class='posts'><span class='name'>" . $user['first_name'] . " " . $user['last_name'] . "</span> - <span class='date'>" . date('F jS\, Y g\:i', strtotime($post['created_at'])) . "</span>";
                            if ($_SESSION['userid']===$post['user_id'] && time()<=strtotime("+30 minutes",strtotime($post['created_at']))){
                                echo "<form action='post.php' method='post'><input type='hidden' name='secure' value='secure'><input type='hidden' name='message_id' value='" . $post['id'] . "'><input type='submit' name='delete_post' value='Delete Post' class='button width red delpost'></form>";
                            }
                            echo "<span class='post'>" . $post['message'] . "</span></div>";
                            $com_query = "SELECT * FROM comments WHERE message_id ='" . $post['id'] . " ORDER BY created_at DESC'";
                            $comments = fetch_all($com_query);
                            echo "<div class='comments'>";
                            if(!is_null($comments)){
                                foreach ($comments as $comment) {
                                    $user_query2 = "SELECT first_name, last_name FROM users WHERE id ='" . $comment['user_id'] . "'";
                                    $user = fetch_record($user_query2);
                                    echo "<div class='comment'><span class='name'>" . $user['first_name'] . " " . $user['last_name'] . "</span> - <span class='date'>" . date('F jS\, Y g\:i', strtotime($post['created_at'])) . "</span>";
                                    echo "<span class='content'>" . $comment['comment'] . "</span>";
                                    if ($_SESSION['userid']===$post['user_id'] && time()<=strtotime("+30 minutes",strtotime($post['created_at']))){
                                        echo "<form action='post.php' method='post'><input type='hidden' name='secure' value='secure'><input type='hidden' name='message_id' value='" . $comment['id'] . "'><input type='submit' name='delete_comment' value='Delete Comment' class='button width red delcom'></form>";
                                    }
                                    echo "</div>";
                                }
                            }
                            echo "</div>";
                            ?>
                            <div class="comment_box">
                                <form action="post.php" method="post">
                                    <input type="hidden" name="secure" value='secure'>
                                    <input type="hidden" name="userid" value=<?php echo "'" . $_SESSION['userid'] . "'" ?>>
                                    <input type="hidden" name="message_id" value=<?php echo "'" . $post['id'] . "'" ?>>
                                    <textarea name="comment"></textarea>
                                    <input type="submit" value="Comment" class="button width green">
                                </form>
                            </div><!-- end of comment box -->
                            <?php
                        }
                    }
                ?>
            </div><!-- end of wall -->
        </div><!-- end of body -->
        <div id="footer">
        </div><!-- end of footer -->
	</div><!-- end of wrapper -->
</div><!-- end of container -->
</body>
</html>