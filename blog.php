<?php
/**
 * Created by PhpStorm.
 * User: MUHAMMAD HAJIQ
 * Date: 7/25/2017
 * Time: 3:42 PM
 */ session_start();
if($_SESSION['login']){}else{
    header("location:login.php");
}
include "includes/header.php";
include "includes/db.php";

$error="";
?>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
            <a href="post.php"><button type="button" class="btn btn-primary pull-right"> POST </button> </a>
                <hr>
            </div>
        </div>
        <?php
         $db = new db();
        $result = $db->select("posts");
        while($row = $result->fetch()){
        ?>
        <div class="container">
            <div class="row">
                <div class="span12">
                    <div class="row">
                        <div class="span8">
                            <h4><strong><a href="#"><?php echo $row['title'];?></a></strong></h4>
                        </div>
                    </div>
                        <div class="span10">
                            <p><?php echo $row['text']?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="span8">
                            <p></p>
                            <p>
                                <i class="fa fa-user"></i> by <a href="#"><?php echo $row['username'];?></a>
                                | <i class="fa fa-calendar"></i> <?php echo $row['createdat'];?>
                                |<a href="www.facebook.com"><span i class="fa fa-facebook">facebook</span></a>
                                <a href="www.twitter.com"><span i class="fa fa-twitter">twitter</span></a>
                                <a href="www.gmail.com"><span i class="fa fa-envelope">email</span></a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <hr>


                    <?php }



        ?>


    </div>
<?php
?>
<div class="container" >
    <div class="row" >
        <div class="col-md-8" >
            <div class="page-header" >
                <h1 ><small class="pull-right" > Comment</small > Comments </h1 >
            </div >
            </div>
        </div>
    </div><?php
$db=new db();
$result1=$db->select('comment');
while($row1 = $result1->fetch()) {?>
    <div class="container" >
    <div class="row" >
        <div class="col-md-8" >
            <div class="comments-list" >
                <div class="media" >
                    <p class="pull-right" ><small > <?php echo $row1['createdat'];?> </small ></p >
                    <a class="media-left" href = "#" >
                        <img src = "images.jpg" >
                    </a >
                    <div class="media-body" >

                        <h4 class="media-heading user_name" > <?php echo $row1['username'];?></h4 >
                       <?php echo $row1['comment'];?>

                        <p ><small ><a href="delete.php?id=<?php echo $row1["id"]; ?>">Delete</a> </small ></p >
                    </div >
                </div >
                </div >
            </div >
        </div >
    </div >
<?php }?>
<div class="well" style="width: 900px">
    <small>Leave a Comment:</small>
    <form method="post" action="comment.php">
        <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
            <input id="comment" type="text" class="form-control" warp="hard" name="comment" placeholder="Enter Comment" required>
        </div>
        <div class="input-group-btn">
            <button class="btn btn-primary" type="submit">
                <i class="glyphicon glyphicon-log-in"> Comment </i>
            </button>
        </div>
        <?php echo $error;?>
    </form>
</div>
<?php
include "includes/footer.php";
?>
<!--<a href="logout.php"><input type="submit"  class="btn btn-primary" value="logout"></a>-->
