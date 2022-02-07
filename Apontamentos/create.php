<?php
require_once '../db/ligacaoBD.php';
require_once '../components/navbar.php';

if((empty($iduser) && empty($_SESSION['email']))){
    header("Location: http://localhost:81/SIR2122/Trabalho/Home/index.php");
  }


$dados = array();
# preparar a query
$combo = $pdo->prepare('SELECT id_tipo_apontamento, descricao FROM tipo_apontamento');
# definir o fetch mode
$combo->setFetchMode(PDO::FETCH_ASSOC);
# executar instrução 
$combo->execute($dados);

$erros = [];
$desci = '';
$nota = '';
$tapont = '';
$imagem = '';
$visualizar = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $desci = $_POST['desc'];
    $nota = $_POST['nota'];
    $tapont = $_POST['id_tipo_apontamento'];
    $registo = new DateTime();
    $autregisto = $registo->format('Y-m-d');
    // $imagem = $_POST['imagem'];
    $upfile = $_FILES['imagem']['name'];
    if (file_exists("uploads/" . $upfile)) {
        $upfile = time() . $upfile;
        $imagem = $upfile;
        $upfile = "uploads/" . $upfile;
    } else {
        $imagem = $upfile;
        $upfile = "uploads/" . $upfile;
    }

    $visualizar = $_POST['visualizar'];
    if ($_POST['visualizar'] == 'sim') {
        $visualizar = 1;
    } else $visualizar = 0;




    $insert = $pdo->prepare("INSERT INTO apontamento(descricao,nota, id_tipo_apontamento,registo,imagem,visualizar,id_utilizador)
            VALUES(:desc, :nota, :id_tipo_apontamento, :registo, :imagem, :visualizar, :iduser)");

    $insert->bindValue(':desc', $desci);
    $insert->bindValue(':nota', $nota);
    $insert->bindValue(':id_tipo_apontamento', $tapont);
    $insert->bindValue(':registo', $autregisto);
    $insert->bindValue(':imagem', $imagem);
    $insert->bindValue(':visualizar', $visualizar);
    $insert->bindValue(':iduser', $iduser);

    $insert->execute();

    header("Location: http://localhost:81/SIR2122/Trabalho/Apontamentos/index.php");
}
?>
<link rel="stylesheet" href="../components/style.css">

<div class="container-list">


    <div>
        <h1>Criar apontamento</h1>

        <?php

        include_once '../components/form.php'
        ?>

    </div>
</div>
<?php
require_once '../components/footer.php';
?>