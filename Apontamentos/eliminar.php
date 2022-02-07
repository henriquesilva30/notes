<?php
require_once('../db/ligacaoBD.php');
require_once('../components/navbar.php');


if((empty($iduser) && empty($_SESSION['email']))){
  header("Location: http://localhost:81/SIR2122/Trabalho/Home/index.php");
}

$idApontamento = $_GET['id'];

// var_dump($idProduto);
 if(($_GET['id'])){
    $delete = $pdo->prepare("DELETE FROM apontamento WHERE id_apontamento = :id");
    $delete->bindValue(':id', $idApontamento);
    $delete->execute();
     header("Location: http://localhost:81/SIR2122/Trabalho/Apontamentos/index.php");
 }

?>
