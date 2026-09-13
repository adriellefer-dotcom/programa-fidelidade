<?php

session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: ../login.php");
    exit();
}

include("../config/conexao.php");

$nome = trim($_POST["nome"]);
$cpf = trim($_POST["cpf"]);
$dt_nascimento = $_POST["dt_nascimento"];
$telefone = trim($_POST["telefone"]);
$email = trim($_POST["email"]);
$cidade = trim($_POST["cidade"]);
$senha = trim($_POST["senha"]);

// Armazena a senha usando hash seguro, em vez de texto puro.
$senhaHash = password_hash($senha, PASSWORD_DEFAULT);

$stmt = mysqli_prepare($conexao, "INSERT INTO clientes (nome, cpf, dt_nascimento, telefone, email, cidade, senha) VALUES (?, ?, ?, ?, ?, ?, ?)");
mysqli_stmt_bind_param($stmt, "sssssss", $nome, $cpf, $dt_nascimento, $telefone, $email, $cidade, $senhaHash);

if(mysqli_stmt_execute($stmt)){

    echo "<script>

        alert('Paciente cadastrado com sucesso!');

        window.location='listar.php';

    </script>";

}else{

    echo "<h2>Erro ao cadastrar o paciente.</h2>";

    echo "<br>";

    echo mysqli_error($conexao);

}

mysqli_stmt_close($stmt);

?>
