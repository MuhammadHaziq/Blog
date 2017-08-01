<?php
/**
 * Created by PhpStorm.
 * User: MUHAMMAD HAJIQ
 * Date: 7/28/2017
 * Time: 12:45 PM
 */
// session_start();
//if($_SESSION['login']){}else{
  //  header("location:../login.php");
//}
session_start();
$email= $_SESSION['email'];
echo $email . '<br>';
include "includes/db.php";
$db= new db();
$result = $db->selectbyemail('users','$email');
while($row = $result->fetch()){
    echo $row['id'] , $row['name'] . '<br> <hr>';
}
$password="";
$email = "";
 $result1 = $db->select('users');
 while($row1= $result1->fetch()) {
     if ($row1['email'] == $email) {
         echo $row1['password'];




     }
 }

?><form>
    <h4>Get Password</h4>

    <label for="email">Email</label>
    <input type="email" name="email" id="email" placeholder="User Name" value="<?php echo $row1['email']; ?>" required>
    <input type="submit" class="btn btn-primary" value="Get Password">
    <label for="password">Password</label>
    <?php echo $row1['password'];?>