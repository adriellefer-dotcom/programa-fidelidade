<?php

session_start();

include("config/admin.php");

if(isset($_POST['entrar'])){

    $usuario = trim($_POST['usuario'] ?? '');
    $senha   = trim($_POST['senha'] ?? '');

    if($usuario === ADMIN_USER && password_verify($senha, ADMIN_PASSWORD_HASH)){

        $_SESSION['admin'] = "Administrador";

        header("Location: painel.php");
        exit();

    }else{

        echo "<script>alert('Usuário ou senha inválidos!');</script>";

    }

}

include("includes/header.php");

?>

<section class="banner">

    <div class="banner-texto">

        <h2>🔒 Área Administrativa</h2>

        <p>
            Acesso exclusivo para colaboradores autorizados.
        </p>

    </div>

</section>

<br>

<div class="card">

    <form method="POST">

        <label>Usuário</label>

        <input
            type="text"
            name="usuario"
            placeholder="Digite seu usuário"
            required>

        <label>Senha</label>

        <input
            type="password"
            name="senha"
            placeholder="Digite sua senha"
            required>

        <button
            type="submit"
            name="entrar">

            Entrar

        </button>

    </form>

</div>

<?php include("includes/footer.php"); ?>
