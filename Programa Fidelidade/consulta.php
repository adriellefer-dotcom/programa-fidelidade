<?php include("includes/header.php"); ?>

<section class="banner">

    <div class="banner-texto">

        <h2>💳 Consultar Meus Pontos</h2>

        <p>
            Acesse sua área exclusiva para consultar seu saldo de pontos,
            visualizar seu extrato e solicitar o resgate de benefícios.
        </p>

    </div>

</section>

<br>

<div class="card">

    <form action="login_cliente.php" method="POST">

        <label>CPF</label>

        <input
            type="text"
            name="cpf"
            placeholder="Digite seu CPF"
            required>

        <label>Senha</label>

        <input
            type="password"
            name="senha"
            placeholder="Digite sua senha"
            required>

        <button type="submit">

            🔍 Entrar

        </button>

    </form>

</div>

<?php include("includes/footer.php"); ?>