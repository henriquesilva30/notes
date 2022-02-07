<?php
# dados de acesso à minha base de dados
$host = 'localhost';
$dbname = '221b';
$user = 'root';
$pass = '';

# ligação à base de dados
try {
  $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass); // new PDO(tipo da base de dados:string de conexão específica do tipo definido)
  $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
}
catch(PDOException $e) {
    echo "Ocorreu um erro na ligação à base de dados";
    echo $e->getMessage();
    file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
    exit();
}


/* 
AJUDA:


PDO::ERRMODE_EXCEPTION
============================================================================================
O mais adequado na grande maioria das situações.
Em caso de problema (erro) é gerada uma exception, permitindo ao programador lidar com os erros por forma a escondê-los
do utilizador final que, de outra forma, poderia ficar com informação que eventualmente permitisse explorar o sistema.


CRIAÇÃO DE UTILIZADOR no phpMyAdmin
============================================================================================
Criação de utilizador de base de dados com acesso total à base de dados "osmeuslivros"
1. Selecionar base de dados (clique no nome da base de dados - na árvore do lado esquerdo).
2. Selecionar separador "Privileges".
3. Clicar em "New - Add user account".
    3.1 Definir "User name" (ei2021)
    3.2 Em "Host name" deixar como está (%)
    3.3 Definir Password (passwordmaisfacildomundo)
    3.4 Re-type para introdução (repetição) da palavra-passe definida em 3.3
4. Os restantes campos de "Login information" ficam conforme estão por defeito.
5. Em "Database for user account" fica conforme está por defeito.
6. Em "Global privileges" selecionar a caixa (checkbox) "Check all"
7. Clicar em "Go" para definir/criar utilizador
*/
?>