<?php
/**
 * Created by PhpStorm.
 * User: MUHAMMAD HAJIQ
 * Date: 7/31/2017
 * Time: 1:18 PM
 */

include "includes/db.php";
var_dump($_GET['id']);

session_start();
if($_SESSION['login']){}else{
    header("location:blog.php");
    echo '<div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Please Login</div>
            <div id="returnVal" style="display:none;">false</div>';
}

if(isset($_GET["id"])){
    if(is_numeric($_GET["id"])){
        $db = new db();
        if($db->alreadyexist("posts",$_GET["id"])){
            if($db->delete("posts",$_GET['id'])){
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
}else{
    header("location:blog.php");
}