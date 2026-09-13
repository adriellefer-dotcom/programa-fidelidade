<?php

include("../config/conexao.php");

$nome = trim($_POST['nome']);
$pontos = intval($_POST['pontos']);

$sql = "INSERT INTO premios
(
    nome,
    pontos
)
VALUES
(
    '$nome',
    '$pontos'
)";

if(mysqli_query($conexao, $sql)){

    echo "<script>

        alert('Prêmio cadastrado com sucesso!');

        window.location='listar.php';

    </script>";

}else{

    echo "<script>

        alert('Erro ao cadastrar o prêmio.');

        history.back();

    </script>";

}