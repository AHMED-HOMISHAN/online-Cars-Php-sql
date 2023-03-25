<?php
try{
    $connecting = new PDO("mysql:host=localhost;dbname=maxwheels;",'root','');
    $connecting->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   
}catch(PDOException $e){
   
    echo("<h1>connecting failer" ).  $e->getMessage().'</h1>';
    echo'<h2>DB_SERVER</h2>';
}
?>