    <!-- Navbar -->
    <?php
    require_once('../db/ligacaoBD.php');
    include_once('../components/navbar.php');

    if (!empty($_SESSION['email'])) {
        session_destroy();
        header("Location:Home/index.php");
    }

    ?>
    <link rel="stylesheet" href="../components/style.css">

    <?php
    if (isset($_POST['b_login'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        if ((!empty($email)) && (!empty($password))) {
            $select = $pdo->prepare("SELECT * from utilizador WHERE email = :email AND password = :password");
            $select->bindValue(':email', $email);
            $select->bindValue(':password', $password);
            $select->execute();
            $row = $select->fetch(PDO::FETCH_ASSOC);

            //erro nos id alert
            if (!empty($row)) {
                if ($row['ativo'] == 1) {
                    session_start();
                    $_SESSION['email'] = $row['email'];
                    $_SESSION['id'] = $row['id'];
                    header("Location: http://localhost:81/SIR2122/Trabalho/Apontamentos/index.php");
                } else { ?>
                    <div id="alert">
                        <strong>Conta desativa.</strong>
                    </div>
                <?php
                }
            } else { ?>
                <div id="alert">
                    <strong>Credênciais não correspondem.</strong>
                </div>
    <?php
            }
        }
    }
    ?>

    <!-- First Container -->
    <div class="container" id="div">

        <form name="login" method="POST">
            <input required class="form-control" placeholder="Email utilizador" name="email" type="email" />
            <br>
            <input required class="form-control" placeholder="Palavra-Passe" name="password" type="password" />
            <br>
            <input type="submit" class="btn" name="b_login" value="Submeter">
        </form>
    </div>
    <?php
    include_once('../components/footer.php');
    ?>