<?php
/**
 * Created by PhpStorm.
 * User: MUHAMMAD HAJIQ
 * Date: 8/1/2017
 * Time: 2:35 PM
 */
session_start();
if($_SESSION['login']){}else{
    header("location:login.php");
}
include "includes/db.php";
include "includes/header.php";
$db=new db();
//var_dump($db->comment1('hahaha', 'haziq', 1 , $_GET['id']));
//var_dump($_GET['id']);

$error ="";
$comment ="";
$userid = "";
$username ="";

if($_POST) {
    $comment = trim($_POST['comment']);

    if (!empty($comment)) {
        $db = new db();
        $result = $db->select("users");
        $flag = 0;
        while ($row = $result->fetch()) {
            if ($row['email'] == $_SESSION['email']) {
                echo  $userid = $row['id'];
                 echo  $username = $row['name'];
                $flag = 1;
                break;
            }
        }
    }
    if ($flag == 1) {
        $db->comment1($comment, $username, $userid , $_GET['id']);
            header("location:blog.php");
    }
        /*if(isset($_GET["id"])){
            if(is_numeric($_GET["id"])){
                if( $db->comment1($comment, $username, $userid , $_GET['id'])){
                          header("location:blog.php");
                }else{
                    header("location:blog.php");
                }
            }else{
                header("location:blog.php");
            }
        }else{
            header("location:blog.php");
        }
    }*/else{
        $error="Enter comment";
    }

}
?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Comment</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
        form{
            border: solid 1px #ccc;
            border-radius: 5px;
            width: 600px;
            margin: 5% auto;
            padding: 0 15px 15px 15px;

        }
        input[type=text]
        {
            width:100%;
            display: block;
            margin-bottom: 5px;
            border: solid 1px #ccc;
            border-radius: 3px;
            padding: 5px;
        }
        input[type=submit]:hover{
            border: solid 1px firebrick;
            background: firebrick;
        }
        button[type=submit]{
            float: right;
            margin-top: 4px;
        }
    </style>
</head>
<body>

<form method="post">
    <h4>Comment</h4>
     <?php  $db = new db();
        $result = $db->select("users");
        $flag = 0;
        while ($row = $result->fetch()) {
            if ($row['email'] == $_SESSION['email']) {
                $username = $row['name'];
                $flag = 1;
                break;
            }
        } ?>
    <label> UserName: </label><?php echo $username; ?>

    <div class="input-group">
        <label for="comment"> Comment:</label>
        <textarea cols="75" rows="5" id="comment" warp="hard" name="comment" placeholder="Comment" value="<?php echo $comment; ?>"required></textarea>
    </div>
    <div class="input-group-btn">
        <button class="btn btn-primary pull right" type="submit">Comment
        </button>
        <?php echo $error;?>

</form>

</body>
</html>