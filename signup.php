<?php
/**
 * Created by PhpStorm.
 * User: MUHAMMAD HAJIQ
 * Date: 7/31/2017
 * Time: 5:28 PM
 */
include "includes/db.php";
$name="";
$email="";
$password="";
$status="";
$error="";
$error1="";

$e_password="";
$e_email="";
$e_name="";
$e_status="";
if($_POST){
    $name=trim($_POST['name']);
    $email=trim($_POST['email']);
    $password=trim($_POST['password']);
    $status=trim($_POST['status']);
    $flag=0;

    $db=new db();

    if(empty($name)){
        $e_name = "Please enter name";
        $flag = 1;
    }else if(!preg_match("/^[A-z]{3,15}$/",$name)){
        $flag = 1;
        $e_name = "Invalid name";
    }else if(!empty($name)){
        $result = $db->select('users');
        while ($row = $result->fetch())
        {
            if($name == $row['name'])
            {
                $flag=1;
                $error = '<p class="help-block text-danger">Change IT </p>';
            }
        }
    }

    if(empty($email)){
        $flag = 1;
        $e_email ="enter email";
    }else if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
        $flag = 1;
        $e_email ="invalid email";
    }else if(!empty($email)){}
    $result = $db->select('users');
    while ($row = $result->fetch())
    {
        if($email == $row['email'])
        {
            $flag=1;
            $error1 = '<p class="help-block text-danger">Change IT </p>';
        }
    }

    if(empty($password)){
        $flag = 1;
        $e_password = "enter password";
    }else if(!preg_match("/^[A-z0-9]{3,9}$/",$password)){
        $flag = 1;
        $e_password ="invalid password";
    }
    if($flag==0){
        $result =$db->Register($name,$email,$status,$password);
        session_start();
        $_SESSION['login'] = true;
        header("location:blog.php");
    }
}?>

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
    .error{
        font-size: 12px;
        color: red;
    }
</style>
</head>
<body>


<form method="post" action="signup.php">
    <h4>Sign UP</h4>
    <label for="email"> Email:</label>

    <input type="email" id="email" name="email" placeholder="User Name"value="<?php echo $email; ?> "required>
    <?php echo $error1;?>
    <p><?php echo $e_email;?></p>

    <label for="Password">Password:</label>
    <input type="password"id="Password" name="password" placeholder="password" value="<?php echo $password; ?>"required>
    <p><?php echo $e_password; ?></p>

    <label for="Name"> Name:</label>
    <input type="text" id="Name" name="name" placeholder="Enter Name" value="<?php echo $name; ?>"required>
    <p><?php echo $error?></p>
    <p><?php echo $e_name;?></p>

    <label for="Status">Status:</label>

    <input type="radio" id="status" name="status" placeholder="Enter Status" value="<?php echo $status; ?>">Admin
    <input type="radio" id="status" name="status" placeholder="Enter Status" value="<?php echo $status; ?>">Visitor
    <input type="radio" id="status" name="status" placeholder="Enter Status" value="<?php echo $status; ?>">Moderator
    <p><?php echo $e_status ;?></p>
    <input type="submit" class="btn btn-primary" value="Login">

</form>
