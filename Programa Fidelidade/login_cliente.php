<?php

session_start();

include("config/conexao.php");

$cpf = trim($_POST['cpf'] ?? '');
$senha = trim($_POST['senha'] ?? '');

// Busca o cliente pelo CPF. A senha é verificada pelo hash armazenado no banco.
$stmt = mysqli_prepare($conexao, "SELECT * FROM clientes WHERE cpf = ?");
mysqli_stmt_bind_param($stmt, "s", $cpf);
mysqli_stmt_execute($stmt);

$resultado = mysqli_stmt_get_result($stmt);

if(mysqli_num_rows($resultado) == 1){

    $cliente = mysqli_fetch_assoc($resultado);

    if(password_verify($senha, $cliente['senha'])){

        $_SESSION['cliente'] = $cliente['id_cliente'];
        $_SESSION['nome_cliente'] = $cliente['nome'];

        header("Location: consulta_cliente.php");
        exit();

    }
}

echo "<script>

    alert('CPF ou senha inválidos!');

    window.location='consulta.php';

</script>";

mysqli_stmt_close($stmt);

?>
