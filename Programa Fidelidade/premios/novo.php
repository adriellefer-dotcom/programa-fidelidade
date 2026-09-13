<?php include("../includes/header.php"); ?>

<section class="banner">

    <div class="banner-texto">

        <h2>🎁 Cadastro de Prêmios</h2>

        <p>
            Cadastre um novo prêmio para o Programa Fidelidade.
        </p>

    </div>

</section>

<br>

<div class="card">

    <form action="salvar.php" method="POST">

        <label>Nome do Prêmio</label>

        <input
            type="text"
            name="nome"
            placeholder="Ex.: Limpeza de Pele"
            required>

        <label>Pontos Necessários</label>

        <input
            type="number"
            name="pontos"
            min="1"
            required>

        <button type="submit">

            💾 Cadastrar Prêmio

        </button>

    </form>

</div>

<br>

<a href="listar.php" class="btn-painel">

    ← Voltar

</a>

<?php include("../includes/footer.php"); ?>