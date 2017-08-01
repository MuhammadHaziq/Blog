<?php
/**
 * Created by PhpStorm.
 * User: MUHAMMAD HAJIQ
 * Date: 7/25/2017
 * Time: 3:42 PM
 */
session_start();
session_destroy();
header("location:login.php");