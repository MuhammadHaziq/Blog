<?php
/**
 * Created by PhpStorm.
 * User: MUHAMMAD HAJIQ
 * Date: 7/30/2017
 * Time: 8:39 PM
 */
include "includes/db.php";
session_start();
var_dump($_SESSION['email']);
if($_SESSION['login']){}else{
    header("location:login.php");
}
//var_dump($_GET['id']);
//$db = new db();
//var_dump($db->comment('hahahah','haziq','1'));
$error = "";
$comment = "";
$userid = "";
$username = "";
if($_POST) {

    $comment = trim($_POST['comment']);
    if (!empty($comment)) {
        $db= new db();
        $result= $db->select("users");
        $flag=0;
        while($row = $result->fetch()){
            if($row['email']== $_SESSION['email']){
                echo $userid = $row['id'];
                echo $username=$row['name'];
                $flag=1;
                break;
            }
    }
}if($flag==1){
         $result = $db->comment($comment,$username,$userid);
        header("location:blog.php");
    }else{
        $error="plzz enter comment";
    }
}?>
<style>
    .input-group-addon a {
        color: #454545;
    }
</style>
<div class="well">
    <small>Leave a Comment:</small>
                        <form method="post">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input id="comment" type="text" class="form-control" name="comment" placeholder="Enter Comment" required>
                            </div>
                            <div class="input-group-btn">
                                <button class="btn btn-primary" type="submit">
                                    <i class="glyphicon glyphicon-log-in"> Comment </i>
                                </button>
                            </div>
                            <?php echo $error;?>
                        </form>
                    </div>