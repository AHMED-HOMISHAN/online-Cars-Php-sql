<?php
session_start();
if(isset($_COOKIE['maxwheelsu'])){
    setcookie("maxwheelsu",null,time() - 3600,"/");
    unset($_COOKIE['maxwheelsu']);

}else if(isset($_COOKIE['maxwheelsu'])) {
    setcookie("maxwheelsu",null,time() - 3600,"/");
    unset($_COOKIE['maxwheelsu']);

}
    session_unset();
    session_destroy(); // destroy session
    header("location:http://localhost:1234/cars/index.php");
?>