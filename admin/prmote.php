<?php 
require("../controller/connection.php");
if (isset($_GET['id'])){
    $block = intval(($_GET['id']));
    $activity = "UPDATE users SET User_type='1' WHERE id=:Block ; ";
    $activity=$connecting->prepare($activity);
    $activity->bindParam(":Block",$block, PDO::PARAM_STR);
    $activity->execute();
}

header('location:reg-users.php');
?>