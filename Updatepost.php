<?php
/**
 * Created by PhpStorm.
 * User: MUHAMMAD HAJIQ
 * Date: 8/1/2017
 * Time: 11:02 PM
 */
include "includes/db.php";
$db=new db();
//var_dump($db->update("posts",1,"haziq","hello"));

$title = "";
$text = "";

$e_title = "";
$e_text = "";


if($_POST){
    $title = trim($_POST['title']);
    $text = trim($_POST['text']);


    $flag = 0;

    if(empty($title)){
        $e_title = "Please enter title";
        $flag = 1;
    }

    if(empty($text)){
        $flag = 1;
        $e_text ="enter text";
    }


    if($flag == 0){
        $db = new db();
        $result = $db->update('posts',$_GET['id'],$title,$text);
        header("location:blog.php");
    }
}else{
    if(isset($_GET["id"])){
        if(is_numeric($_GET["id"])){
            $db = new db();
            if($db->alreadyexist("posts",$_GET["id"])){
                $result = $db->select('posts');
                while($row = $result->fetch()) {
                        if($row['id']==$_GET['id']) {
                            $title = $row["title"];
                            $text = $row["text"];
                        }
                }
            }
        }
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

<form method="post">
    <h4>POST</h4>
    <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
        <input id="title" type="text" class="form-control" name="title" placeholder="Title" value="<?php echo $title; ?>">
    </div>
<p><?php echo $e_title;?></p>
    <div class="input-group">
        <label for="post"> Post:</label>
        <textarea cols="75" rows="25" id="post" name="text" placeholder="Post" required><?php echo $text; ?></textarea>
    </div>
    <p><?php echo $e_text;?></p>
    <div class="input-group-btn">
        <button class="btn btn-primary pull right" type="submit">Post
        </button>
    </div>
</form>

</body>
</html>


