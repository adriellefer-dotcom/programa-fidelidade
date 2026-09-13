<?php

$servidor = "localhost";
$usuario = "root";
$senha = "";
$banco = "programa_fidelidade";

$conexao = mysqli_connect($servidor, $usuario, $senha, $banco);

if (!$conexao) {
    die("Erro ao conectar ao banco de dados.");
}

?>