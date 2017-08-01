<?php
/**
 * Created by PhpStorm.
 * User: MUHAMMAD HAJIQ
 * Date: 7/29/2017
 * Time: 12:53 AM
 */
include "includes/db.php";
include "includes/header.php";
$name="";
session_start();
//var_dump($_SESSION['email']);


if($_SESSION['login']){}else{
    header("location:login.php");
}
$username="";
$userid="";
$title = "";
$text = "";
$error = "";
if($_POST){
    $title = trim($_POST['title']);
    $text =trim($_POST['text']);
    $db = new db();
    $flag=1;
    if(!empty($text)&&!empty($title)) {
        $result = $db->select("posts");
        while ($row = $result->fetch()) {
            if ($row['title'] !== $title && $row['text'] !== $text) {
                $flag = 1;
                   $result1= $db->select("users");
                    while($row1 = $result1->fetch()){
                        if($row1['email']==$_SESSION['email']){
                            $userid = $row1['id'];
                            $username=$row1['name'];
                        }
                    }

                $result = $db->posts($title , $text ,$userid, $username );
                header("location:blog.php");

                 break;
            }
        }




    } if($flag == 0){
        $error='<div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Please change the Email:</div>
            <div id="returnVal" style="display:none;">false</div>';


    }

}?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Post</title>
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

<form method="post" action="post.php">
    <h4>POST</h4>
    <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
        <input id="title" type="text" class="form-control" name="title" placeholder="Title">
    </div>

    <div class="input-group">
    <label for="post"> Post:</label>
    <textarea cols="75" rows="25" id="post" name="text" placeholder="Post" value="<?php echo $text; ?>"required></textarea>
    </div>
    <?php echo $error;?>
    <div class="input-group-btn">
        <button class="btn btn-primary pull right" type="submit">Post
        </button>

</form>

</body>
</html>


