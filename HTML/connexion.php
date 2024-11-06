<?php
$mysqli= new mysqli("localhost","root","","projetfinal");

if($mysqli->connect_error){
    
    die('erreur de conn('.$mysqli ->connect_errno.')'.$mysqli->connect_error);
}

?>