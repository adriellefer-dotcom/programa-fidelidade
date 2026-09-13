<?php

include("../config/conexao.php");

$id_cliente = intval($_POST['id_cliente']);

list($premio, $pontos) = explode("|", $_POST['premio']);

$data = date("Y-m-d");

// Verifica saldo atual

$sqlSaldo = "SELECT SUM(pontos) AS saldo
             FROM pontos
             WHERE id_cliente = $id_cliente";

$resultSaldo = mysqli_query($conexao, $sqlSaldo);
$saldo = mysqli_fetch_assoc($resultSaldo);

$totalPontos = $saldo['saldo'];

if($totalPontos == NULL){

    $totalPontos = 0;

}

// Verifica se possui pontos suficientes

if($totalPontos < $pontos){

    echo "<script>

        alert('O paciente não possui pontos suficientes.');

        window.location='resgatar.php?id=".$id_cliente."';

    </script>";

    exit();

}

// Grava o resgate

$sql = "INSERT INTO resgates
(
    id_cliente,
    premio,
    pontos_gastos,
    data_solicitacao,
    status
)
VALUES
(
    '$id_cliente',
    '$premio',
    '$pontos',
    '$data',
    'Aprovado'
)";

if(mysqli_query($conexao,$sql)){

    // Desconta os pontos do cliente

    $sqlPontos = "INSERT INTO pontos
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
        'Resgate: $premio',
        0,
        -$pontos
    )";

    mysqli_query($conexao,$sqlPontos);

    echo "<script>

        alert('Resgate realizado com sucesso!');

        window.location='listar.php';

    </script>";

}else{

    echo "<script>

        alert('Erro ao realizar o resgate.');

        history.back();

    </script>";

}

?>