<?php

session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: ../login.php");
    exit();
}

include("../includes/header.php");

?>

<section class="banner">

    <div class="banner-texto">

        <h2>👥 Cadastro de Pacientes</h2>

        <p>
            Preencha os dados abaixo para cadastrar um novo paciente no Programa Fidelidade.
        </p>

    </div>

</section>

<br>

<div class="card">

    <form action="salvar.php" method="POST">

        <label>Nome Completo</label>
        <input
            type="text"
            name="nome"
            required>

        <label>CPF</label>
        <input
            type="text"
            name="cpf"
            required>

        <label>Data de Nascimento</label>
        <input
            type="date"
            name="dt_nascimento"
            required>

        <label>Telefone</label>
        <input
            type="text"
            name="telefone">

        <label>E-mail</label>
        <input
            type="email"
            name="email">

        <label>Cidade</label>
        <input
            type="text"
            name="cidade">

        <label>Senha</label>
        <input
            type="password"
            name="senha"
            required>

        <button type="submit">

            💾 Cadastrar Paciente

        </button>

        <br><br>

        <a href="listar.php" class="btn-painel">

            ← Voltar para Lista de Pacientes

        </a>

    </form>

</div>

<?php include("../includes/footer.php"); ?>