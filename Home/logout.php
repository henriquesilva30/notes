<?php 
session_start();
session_destroy();
header ("Location:http://localhost:81/SIR2122/Trabalho/Home/index.php");
?>