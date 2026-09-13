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

$id_resgate = intval($_GET['id']);

// Busca o resgate
$sql = "SELECT *
        FROM resgates
        WHERE id_resgate = $id_resgate";

$resultado = mysqli_query($conexao, $sql);
$resgate = mysqli_fetch_assoc($resultado);

if (!$resgate) {
    header("Location: listar.php");
    exit();
}

// Só permite cancelar pedidos pendentes
if ($resgate['status'] != "Pendente") {
    header("Location: listar.php");
    exit();
}

// Atualiza o status
$sql = "UPDATE resgates
        SET status = 'Cancelado'
        WHERE id_resgate = $id_resgate";

if (mysqli_query($conexao, $sql)) {

    echo "<script>

        alert('Resgate cancelado com sucesso!');

        window.location='listar.php';

    </script>";

} else {

    echo "<script>

        alert('Erro ao cancelar o resgate.');

        window.location='listar.php';

    </script>";

}

?>