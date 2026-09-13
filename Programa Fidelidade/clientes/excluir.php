<?php

session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: ../login.php");
    exit();
}

include("../config/conexao.php");

if (!isset($_GET['id'])) {
    header("Location: listar.php");
    exit();
}

$id = intval($_GET['id']);

// Exclui primeiro os resgates do cliente
mysqli_query($conexao, "DELETE FROM resgates WHERE id_cliente = $id");

// Exclui os pontos do cliente
mysqli_query($conexao, "DELETE FROM pontos WHERE id_cliente = $id");

// Agora exclui o cliente
$sql = "DELETE FROM clientes
        WHERE id_cliente = $id";

if(mysqli_query($conexao, $sql)){

    echo "<script>

        alert('Paciente excluído com sucesso!');

        window.location='listar.php';

    </script>";

}else{

    echo "<script>

        alert('Erro ao excluir o paciente.');

        window.location='listar.php';

    </script>";

}

?>