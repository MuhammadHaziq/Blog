<?php
/**
 * Created by PhpStorm.
 * User: MUHAMMAD HAJIQ
 * Date: 7/29/2017
 * Time: 1:16 AM
 */
include "db.php";
 $db=new db();
$result = $db->select("posts");
while($row = $result->fetch() ){
echo $row['title'] , $row['text'] ,$row['userid'] . '<br>';

}
?>
    <!--<div class="container">
        <div class="row col-md-12 col-sm-12 col-xs-12 col-lg-12">
            <label for="Title">Title: </label>
            <span></span>
            <div class="clearfix col-lg-12 col-xs-12 col-sm-12 col-md-12"></div>
        </div>
    </div>-->
