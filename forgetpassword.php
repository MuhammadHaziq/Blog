<?php
/**
 * Created by PhpStorm.
 * User: MUHAMMAD HAJIQ
 * Date: 7/30/2017
 * Time: 3:25 AM
 */
include "includes/db.php";
$email="";
$password="";
$error="";
if($_POST){
    $email=$_POST['email'];
    if(!empty($email)){
        $db=new db();
        $result = $db->select('users');

        while ($row = $result->fetch()){
            if($row['email']==$email){
                $password =$row['password'];
                $flag=1;
                break;
            }else{
                $error= '<div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Please Enter Valid Email</div>
            <div id="returnVal" style="display:none;">false</div>';
            }
        }

    }
}
?>
<!doctype html>
<html lang="en">
*<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
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
        input[type=submit]:hover{
            border: solid 1px firebrick;

        }
        .error{
            font-size: 12px;
            color: red;
        }


    </style>
</head>
<body>



<form method="post">
    <h4>Get Password</h4>

    <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
        <input id="email" type="text" class="form-control" name="email" placeholder="Email" required>
    </div>

    <input type="submit" class="btn btn-primary" value="Get Password">
    <br>
    <label for="password">Password</label>
    <?php echo $password;?>

    <a href="login.php"><input type="button" class="btn btn-success pull-right" value="Login"></a>

    <span class="error"><?php echo $error?></span>


</form>
</body>
</html>
