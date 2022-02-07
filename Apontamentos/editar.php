<?php
require_once '../db/ligacaoBD.php';
require_once '../components/navbar.php';

$idApontamento = $_GET['id'] ?? null;

if (!$_GET['id']) {
    header('location: index.php');
    exit;
}


if ((empty($iduser) && empty($_SESSION['email']))) {
    header("Location: http://localhost:81/SIR2122/Trabalho/Home/index.php");
}

$dados = array();
# preparar a query
$combo = $pdo->prepare('SELECT id_tipo_apontamento, descricao FROM tipo_apontamento');
# definir o fetch mode
$combo->setFetchMode(PDO::FETCH_ASSOC);
# executar instrução 
$combo->execute($dados);
$tipoapont = $combo->fetch(PDO::FETCH_ASSOC);

$select = $pdo->prepare("SELECT * FROM apontamento WHERE id_apontamento = :id");
$select->bindValue(':id', $idApontamento);
$select->execute();
$apontamento = $select->fetch(PDO::FETCH_ASSOC);


$tapont = $apontamento['id_tipo_apontamento'];
$select = $pdo->prepare("SELECT * FROM tipo_apontamento WHERE id_tipo_apontamento = :id");
$select->bindValue(':id', $tapont);
$select->execute();
$idTpApont = $select->fetch(PDO::FETCH_ASSOC);


$desci = $apontamento['descricao'];
$nota = $apontamento['nota'];
$tapont = $apontamento['id_tipo_apontamento'];
$imagem = $apontamento['imagem'];
$visualizar = $apontamento['visualizar'];


$erros = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $desci = $_POST['desc'];
    $nota = $_POST['nota'];
    $tapont = $_POST['id_tipo_apontamento'];
    $imagem = $_POST['imagem'];
    $visualizar = $_POST['visualizar'];
    if ($_POST['visualizar'] == 'sim') {
        $visualizar = 1;
    } else $visualizar = 0;


    if (empty($erros)) {

        $update = $pdo->prepare("UPDATE apontamento SET descricao = :desc ,nota = :nota, id_tipo_apontamento = :id_tipo_apontamento,imagem = :imagem,visualizar = :visualizar WHERE id_apontamento = :id");

        $update->bindValue(':desc', $desci);
        $update->bindValue(':nota', $nota);
        $update->bindValue(':id_tipo_apontamento', $tapont);
        $update->bindValue(':imagem', $imagem);
        $update->bindValue(':visualizar', $visualizar);
        $update->bindValue(':id', $idApontamento);

        $update->execute();
        header("Location: index.php");
    }
}
?>
<link rel="stylesheet" href="../components/style.css">

<div class="container-list">


    <div>
        <h1>Editar apontamento</h1>

        <?php

        include_once '../components/form.php'
        ?>


    </div>
</div>
<?php
require_once '../components/footer.php';
?>