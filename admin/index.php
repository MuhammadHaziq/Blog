<?php
/**
 * Created by PhpStorm.
 * User: MUHAMMAD HAJIQ
 * Date: 7/25/2017
 * Time: 3:41 PM
 */
session_start();
if($_SESSION['login']){}else{
    header("location:../login.php");
}
?>
<button  type="button" value="logout" >
