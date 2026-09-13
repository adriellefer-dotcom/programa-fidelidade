<?php

session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: ../login.php");
    exit();
}

include("../config/conexao.php");

$id_cliente = intval($_POST['id_cliente']);
$descricao = trim($_POST['descricao']);
$valor = floatval($_POST['valor']);

// Regra da Versão 1.0
// Cada R$ 1,00 = 1 ponto

$pontos = floor($valor);

// Data atual

$data = date("Y-m-d");

// Salva o lançamento

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

if(mysqli_query($conexao, $sql)){

    echo "<script>

        alert('Pontuação lançada com sucesso!');

        window.location='pontos.php?id=$id_cliente';

    </script>";

}else{

    echo "<script>

        alert('Erro ao lançar a pontuação.');

        window.location='pontos.php?id=$id_cliente';

    </script>";

}

?>