<?php
$connection = new mysqli('localhost','root','0810','search');
if($connection->connect_error){
    die('Error'.$connection->connect_error);
} 
?>