<?php
include_once('../components/navbar.php');
if (!empty($_SESSION['email'])) {
    session_destroy();
    header("Location:http://localhost:81/SIR2122/Trabalho/Home/index.php");
}

?>
<link rel="stylesheet" href="../components/style.css">

<section>

    <div id="div" class="container">
        <h1>Welcome to Apontamento</h1>
    </div>
</section>


<?php
include_once('../components/footer.php');
?>