<?php

session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

include("includes/header.php");

?>

<section class="painel">

    <h1>🛠️ Painel Administrativo</h1>

    <p class="boas-vindas">

        Bem-vindo(a),

        <strong>

            <?= $_SESSION['admin']; ?>

        </strong>

    </p>

    <div class="cards">

        <div class="card">

            <h3>👥 Clientes</h3>

            <p>

                Cadastre, consulte, edite e exclua os pacientes participantes do Programa Fidelidade.

            </p>

            <a href="clientes/listar.php" class="btn-painel">

                Acessar

            </a>

        </div>

        <div class="card">

            <h3>🎁 Prêmios</h3>

            <p>
                Cadastre, edite e exclua os prêmios do Programa Fidelidade.
            </p>

            <a href="premios/listar.php" class="btn-painel">

                Gerenciar Prêmios

            </a>

        </div>

    </div>

    <div class="cards">

        <div class="card">

            <h3>🎁 Resgates</h3>

            <p>

                Consulte e aprove os pedidos de resgate realizados pelos pacientes.

            </p>

            <a href="resgates/listar.php" class="btn-painel">

                Gerenciar Resgates

            </a>

        </div>

        <div class="card">

            <h3>🚪 Encerrar Sessão</h3>

            <p>

                Finalize o acesso ao sistema administrativo.

            </p>

            <a href="logout.php" class="btn-sair">

                Logout

            </a>

        </div>

    </div>

</section>

<?php include("includes/footer.php"); ?>