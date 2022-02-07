<?php
require_once '../db/ligacaoBD.php';
require_once '../components/navbar.php';

if (isset($_GET['apaga'])) {
    require_once '../db/ligacaoBD.php';
    $update = $pdo->prepare("UPDATE utilizador SET ativo = 0 WHERE id = $iduser");
    $update->execute();
    header("Location: http://localhost:81/SIR2122/Trabalho/Home/index.php");
}


// if (isset($_POST['desativar'])) {
//     require_once '../db/ligacaoBD.php';
//     $update = $pdo->prepare("UPDATE utilizador SET ativo = 0 WHERE id = $iduser");
//     $update->execute();
// } else {
if ((empty($iduser) && empty($_SESSION['email']))) {
    header("Location: http://localhost:81/SIR2122/Trabalho/Home/index.php");
}


$select = $pdo->prepare("SELECT * FROM utilizador WHERE id = :id");
$select->bindValue(':id', $iduser);
$select->execute();
$user = $select->fetch(PDO::FETCH_ASSOC);


$email = $user['email'];
$nome = $user['nome'];


$erros = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $nome = $_POST['nome'];


    if (empty($erros)) {

        $update = $pdo->prepare("UPDATE utilizador SET email = :email ,nome = :nome  WHERE id = :id");

        $update->bindValue(':email', $email);
        $update->bindValue(':nome', $nome);
        $update->bindValue(':id', $iduser);
        $_SESSION['email'] = $email;
        $update->execute();
        header("Location: http://localhost:81/SIR2122/Trabalho/Apontamentos/index.php");
    }
}
// }

?>

<link rel="stylesheet" href="../components/style.css">

<div class="container" id="div">


    <div>
        <h1>Dados pessoais</h1>

        <form action="" method="POST">

            <label class="form-label">Email</label>
            <input type="text" required class="form-control" name="email" value="<?php echo $email ?>">
            <br>
            <label class="form-label">Nome </label>
            <input class="form-control" name="nome" required value="<?php echo $nome ?>">

            <div id="inline">
                <button class="btn-voltar" id="margin">Submeter</button>
                <button class="btn-voltar" id="margin" href="http://localhost:81/SIR2122/Trabalho/Apontamentos/index.php">Voltar</button>
            </div>

            <a id="desativar" onclick='return confirm("Deseja apagar este utilizador?");' href='?apaga'>Desativar
            </a>
        </form>
    </div>
</div>
<?php
require_once '../components/footer.php';
?>