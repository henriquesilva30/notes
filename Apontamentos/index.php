<?php
require_once '../db/ligacaoBD.php';
require_once('../components/navbar.php');

if ((empty($iduser) && empty($_SESSION['email']))) {
    header("Location: http://localhost:81/SIR2122/Trabalho/Home/index.php");
}


//  $keyword = '';
if (isset($_POST['search'])) {
    $keyword = $_POST['keyword'];
    // // // echo 'aqui'; erro nos keyword
    $statement = $pdo->prepare("SELECT * FROM apontamento WHERE descricao LIKE :keyword OR nota LIKE :keyword OR registo LIKE :keyword HAVING id_utilizador = :iduser  ORDER BY registo DESC");
    $statement->bindValue(':iduser', $iduser);
    $statement->bindValue(':keyword', '%' . $keyword . '%');
    $statement->execute();
    $apontamentos = $statement->fetchAll(PDO::FETCH_ASSOC);
    // var_dump($iduser);
} else {

    $statement = $pdo->prepare("SELECT * FROM apontamento WHERE id_utilizador = :iduser ORDER BY registo DESC");
    $statement->bindValue('iduser', $iduser);
    $statement->execute();

    $apontamentos = $statement->fetchAll(PDO::FETCH_ASSOC);
}


//combox
$dados = array();
# preparar a query
$combo = $pdo->prepare('SELECT id_tipo_apontamento, descricao FROM tipo_apontamento');
# definir o fetch mode
$combo->setFetchMode(PDO::FETCH_ASSOC);
# executar instrução 
$combo->execute($dados);
?>

<link rel="stylesheet" href="../components/style.css">



<div class="container-list" id="div-auto">
    <div class="title">
        <h1>Lista de apontamentos</h1>
    </div>

    <div class="tools">
        <button class="btn-small">
            <a href="create.php">Criar apontamento</a>
        </button>
        <!-- aqui erro nos filtros -->
        <form class="form-search" action="" method="POST">
            <select class="form-select" id="id_tipo_apontamento" name="id_tipo_apontamento">
                <option value="">Tipo de apontamento
                <option>
                    <?php
                    while ($row = $combo->fetch()) {
                    ?>
                <option value="<?php echo $row['id_tipo_apontamento']; ?>"><?php echo $row['descricao']; ?></option>
            <?php
                    }
            ?>
            </select>
            <input type="search" id="margin" name="keyword" class="form-control" <?php if (isset($_POST['keyword'])) { ?> value="<?php echo $_POST['keyword'] ?>" <?php } else ?> placeholder="Pesquisar apontamento">
            <button class="btn-search" name="search"></button>
        </form>

    </div>
    <?php foreach ($apontamentos as $i => $apontamento) :

        $tapont = $apontamento['id_tipo_apontamento'];
        $select = $pdo->prepare("SELECT * FROM tipo_apontamento WHERE id_tipo_apontamento = :id");
        $select->bindValue(':id', $tapont);
        $select->execute();
        $idTpApont = $select->fetch(PDO::FETCH_ASSOC);
    ?>

        <li>
            <div class="listagem">

                <a id="margin" href="detalhes.php?id=<?php echo $apontamento['id_apontamento']; ?>">
                    <h4><?php echo '<b>' . $apontamento['descricao'] . '</b> - ' . $apontamento['nota'] ?></h4>
                    <span class="badge"><?php echo $apontamento['registo'] ?></span>
                    <?php if ($apontamento['nota']) : ?>
                        <p><?php echo $idTpApont['descricao'] ?></p>
                    <?php endif; ?>
                </a>

                <div class="col-button">
                    <form action="">
                        <a href="editar.php?id=<?php echo $apontamento['id_apontamento'] ?>" class="btn-edit">Editar</a>
                    </form>
                    <form>
                        <button type="button" class="btn-delete">
                            <a onclick='return confirm("Deseja apagar este apontamento?");' href='eliminar.php?id=<?php echo $apontamento['id_apontamento']; ?>'>Apagar
                        </button>
                        </a>
                    </form>
                </div>


            </div>
        </li>


    <?php endforeach; ?>
</div>
<?php
require_once('../components/footer.php');
?>