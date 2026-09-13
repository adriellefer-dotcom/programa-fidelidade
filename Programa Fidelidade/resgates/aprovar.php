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

// Evita aprovar duas vezes
if ($resgate['status'] != "Pendente") {

    header("Location: listar.php");
    exit();

}

// Atualiza o status
$sql = "UPDATE resgates
        SET status='Aprovado'
        WHERE id_resgate=$id_resgate";

mysqli_query($conexao, $sql);

// Lança os pontos negativos
$id_cliente = $resgate['id_cliente'];

$descricao = "Resgate - " . $resgate['premio'];

$valor = 0;

$pontos = -$resgate['pontos_gastos'];

$data = date("Y-m-d");

$sql = "INSERT INTO pontos
(
    id_cliente,
    data_lancamento,
    descricao,
    valor,
    pontos
)
VALUES
(
    '$id_cliente',
    '$data',
    '$descricao',
    '$valor',
    '$pontos'
)";

mysqli_query($conexao, $sql);

echo "<script>

alert('Resgate aprovado com sucesso!');

window.location='listar.php';

</script>";

?>