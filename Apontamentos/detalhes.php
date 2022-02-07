  <?php
  require_once('../db/ligacaoBD.php');
  require_once('../components/navbar.php');


  if ((empty($iduser) && empty($_SESSION['email']))) {
    header("Location: http://localhost:81/SIR2122/Trabalho/Home/index.php");
  }

  # preparação dos dados para o SELECT
  if (isset($_GET['id'])) {
    $dados = array($_GET['id']);
    # preparar a query
    $detalhe = $pdo->prepare('SELECT 
    *
    FROM apontamento a, utilizador u
    WHERE a.id_apontamento = ?
    AND a.id_utilizador = u.id');
    # definir o fetch mode
    $detalhe->setFetchMode(PDO::FETCH_ASSOC);
    # executar instrução 
    $detalhe->execute($dados);
    # colocar informação do registo numa variável PHP
    $apontamento = $detalhe->fetch();
    # número de registos para posterior validação 
    $numero_registos = $detalhe->rowCount();
  } else {
    $numero_registos = 0;
  }
  ?>
  <?php
  $tapont = $apontamento['id_tipo_apontamento'];
  $select = $pdo->prepare("SELECT * FROM tipo_apontamento WHERE id_tipo_apontamento = :id");
  $select->bindValue(':id', $tapont);
  $select->execute();
  $idTpApont = $select->fetch(PDO::FETCH_ASSOC);
  ?>

  <link rel="stylesheet" href="../components/style.css">

  <div class="container-list">


    <div class="container-flex">
      <div class="flexbox-item ">
        <h1>Informação do apontamento</h1>
      </div>
      <div class="flexbox-item flexbox-item-2">
        <form id="wmargin" action="">
          <a class="btn-edit" style="padding-left: 10px;" href="editar.php?id=<?php echo $apontamento['id_apontamento'] ?>">Editar</a>
        </form>
        <form  id="wmargin">
          <button type="button" class="btn-delete">
            <a onclick='return confirm("Deseja apagar este apontamento?");' href='eliminar.php?id=<?php echo $apontamento['id_apontamento']; ?>'>Apagar
          </button>
          </a>
        </form>
      </div>

      <div class="flexbox-item flexbox-item-row">
        <div class="flexbox-item flexbox-item-3">
          <p>ID apontamento: <?php echo $apontamento['id_apontamento']; ?>
          <p class="card-text">Nota <br><br><?php echo $apontamento['nota']; ?></p>
          <p>Autorização da visualização: <?php if ($apontamento['visualizar'] == '0') {
                                            echo 'Não';
                                          } else echo 'Sim' ?></p>
          <p>Tipo de apontamento: <?php echo $idTpApont['descricao']; ?></p>
          <p>Data de registo: <?php echo $apontamento['registo']; ?></p>

        </div>
        <?php if ($apontamento['visualizar'] == '1') { ?>
          <div class="flexbox-item flexbox-item-1">
            <?php if (empty($apontamento['imagem'])) { ?>
              <p class="legend ">Imagem sem conteudo</p>
            <?php } else  ?><img src="<?php echo $upfile ?>">
          </div>
        <?php } ?>


      </div>


      <div class="flexbox-item flexbox-item-2">



        <a class="btn-voltar" href="index.php" role="button">Voltar</a>


      </div>

    </div>
  </div>
  <?php
  require_once('../components/footer.php');
  /* 
  AJUDA:


  NOTAS
  ============================================================================================
  $LIGACAO » Database Handle
  $INSTRUCAO » Statement Handle


  LER (SELECT) INFORMAÇÃO DA BASE DE DADOS
  ============================================================================================
  Os dados são obtidos através de ->fetch(), um método disponbilizado na ligação à base de dados.
  Antes de invocar o fetch é necessário indicar ao PDO como queremos que a informação seja lida (fetch mode).
  Há várias opções:
  
    PDO::FETCH_ASSOC: returns an array indexed by column name
    PDO::FETCH_BOTH (default): returns an array indexed by both column name and number
    PDO::FETCH_BOUND: Assigns the values of your columns to the variables set with the ->bindColumn() method
    PDO::FETCH_CLASS: Assigns the values of your columns to properties of the named class. It will create the properties if matching properties do not exist
    PDO::FETCH_INTO: Updates an existing instance of the named class
    PDO::FETCH_LAZY: Combines PDO::FETCH_BOTH/PDO::FETCH_OBJ, creating the object variable names as they are used
    PDO::FETCH_NUM: returns an array indexed by column number
    PDO::FETCH_OBJ: returns an anonymous object with property names that correspond to the column names

  No nosso caso vamos utilizar uma que utiliza matéria já estudada:

    PDO::FETCH_ASSOC: retorna um array associativo com o nome das colunas da(s) tabela(s) da base de dados.

  */
  ?>