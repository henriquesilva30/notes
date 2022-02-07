<?php
include_once('../components/navbar.php');
?>
<?php
include_once('../db/ligacaoBD.php');
if (isset($_POST['registar'])) {
    $email = $_POST['email'];
    $nome = $_POST['nome'];
    $password = $_POST['password'];
    $password2 = $_POST['password2'];
    if ($password == $password2) {
        $insert = $pdo->prepare("INSERT INTO utilizador (email, password, nome, ativo ) VALUES (:email, :password, :nome, 1)");
        $insert->bindValue(':email', $email);
        $insert->bindValue(':password', $password);
        $insert->bindValue(':nome', $nome);

        if (!empty($insert)) {
            $select = $pdo->query("SELECT * from utilizador where email = '$email'");
            $row = $select->fetchAll(PDO::FETCH_ASSOC);
            if (empty($row)) {
                // var_dump($row);
                $insert->execute();
                header("Location: http://localhost:81/SIR2122/Trabalho/Home/index.php");
            } else { ?>
                <div id="alert">
                    <strong>Já existe email.</strong>
                </div>
    <?php
            }
        }
    } else ?>
    <div id="alert">
        <strong>Password não coincidem.</strong>
    </div>
<?php
}
?>
<link rel="stylesheet" href="../components/style.css">

<div class="container" id="div">
    <form class="form" name="login" id="form" method="POST">
        <input required class="form-control" placeholder="Email utilizador" name="email" type="email" /><br>
        <input required class="form-control" placeholder="Nome do utilizador" name="nome" type="text" /><br>
        <input required class="form-control" placeholder="Palavra-Passe" name="password" type="password" /><br>
        <input required class="form-control" placeholder="Reintroduza palavra-passe" name="password2" type="password" />
        <br>
        <a> <input type="submit" class="btn" name="registar" value="Submeter"></a>
    </form>
</div>

<?php
include_once('../components/footer.php')
?>