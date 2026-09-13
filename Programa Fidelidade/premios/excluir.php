<?php

include("../config/conexao.php");

if (!isset($_GET['id'])) {

    header("Location:listar.php");
    exit();

}

$id = intval($_GET['id']);

$sql = "DELETE FROM premios
        WHERE id_premio = $id";

if(mysqli_query($conexao, $sql)){

    echo "<script>

            alert('Prêmio excluído com sucesso!');

            window.location='listar.php';

          </script>";

}else{

    echo "<script>

            alert('Erro ao excluir o prêmio.');

            window.location='listar.php';

          </script>";

}

?>