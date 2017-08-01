<?php
/**
 * Created by PhpStorm.
 * User: MUHAMMAD HAJIQ
 * Date* 7/25/2017
 * Time: 3:41 PM
 */
include "includes/db.php";

$name="";
$email ="";
$password ="";
$error ="";
if($_POST){
    $email = $_POST['email'];
    $password = $_POST['password'];

    if(!empty($email) && !empty($password) && filter_var($email , FILTER_VALIDATE_EMAIL)){
        $db = new db();
        $result  = $db->select("users");
        $flag= 0;
        while($row = $result->fetch()){
            if($row['email']== $email && $row['password']==$password){

                $flag = 1;
                break;
            }

            }

        if($flag ==1){
            session_start();
            $_SESSION['email']=$row['email'];
            $_SESSION['login']= true;
            header("location:blog.php");
        }else{
             $error= "Invalid user name";/*'<div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Please Enter Valid Username and Password</div>
            <div id="returnVal" style="display:none;">false</div>';*/
        }
    }
    else{
        $error= "Invalid user name";/*'<div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Please Enter Valid Username and Password</div>
            <div id="returnVal" style="display:none;">false</div>';*/
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
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

   <style>
       form{
           border: solid 1px #ccc;
           border-radius: 5px;
           width: 400px;
           margin: 5% auto;
           padding: 0 15px 15px 15px;
       }
       input[type=email],input[type=password]{
           width: 100%;
           display: block;
           margin-bottom: 5px;
           border: solid 1px #ccc;
           border-radius: 3px;
           padding: 5px;
       }
       button[type=submit]:hover{
           border: solid 1px darkblue;

       }
      button[type=submit]{
           border-radius: 4px ;

       }
       button[type=button]{
           float: right;
       }

       .error{
           font-size: 12px;
           color: red;
       }
       .imgcontainer {
           text-align: center;
           margin: 24px 0 12px 0;
       }

       img.avatar {
           width: 40%;
           border-radius: 50%;
       }
       .input-group-btn{
           display: inline;
       }

   </style>
</head>
<body>


<form method="post">
    <div class="imgcontainer">
        <img src="images.jpg" alt="Avatar" class="avatar">
    </div>
    <br>
    <br>
    <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
        <input id="email" type="text" class="form-control" name="email" placeholder="Email" required>
    </div>
    <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
        <input id="password" type="password" class="form-control" name="password" placeholder="Password" required>
    </div>
    <br>
    <div class="input-group-btn">
        <button class="btn btn-primary" type="submit">
            <i class="glyphicon glyphicon-log-in"> Login </i>
        </button>
     </div>
        <div class="input-group-btn">
            <a href="signup.php"> <button class="btn btn-default" type="button">
                <i class="glyphicon glyphicon-sign-up"> SignUp </i>
            </a>
            </button>
            </div>

            <div class="input-group-btn">
               <a href="forgetpassword.php"><button class="btn btn-default " type="button">
                    <i class="glyphicon glyphicon-log-in"> ForGetPassword</i>
                </a>
                </button>
                </div>
        <p class="help-block text-danger error"><?php echo $error;?></p>
</form>



</body>
</html>

