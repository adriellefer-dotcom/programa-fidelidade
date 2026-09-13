<?php

session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: ../login.php");
    exit();
}

include("../config/conexao.php");
include("../includes/header.php");

$sql = "SELECT * FROM clientes ORDER BY nome";
$resultado = mysqli_query($conexao, $sql);

?>

<section class="banner">

    <div class="banner-texto">

        <h2>👥 Pacientes Cadastrados</h2>

        <p>
            Gerencie os pacientes participantes do Programa Fidelidade.
        </p>

    </div>

</section>

<div class="card" style="margin-top:30px;">

    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:25px;">

        <h3 style="margin:0;">
            Lista de Pacientes
        </h3>

        <a href="novo.php">

            <button style="width:auto;padding:12px 22px;">
                ➕ Novo Paciente
            </button>

        </a>

    </div>

    <table style="width:100%; border-collapse:collapse;">

        <thead>

            <tr style="background:#1e3a8a;color:white;">

                <th style="padding:14px;">Nome</th>
                <th>CPF</th>
                <th>Telefone</th>
                <th>Cidade</th>
                <th style="width:340px;">Ações</th>

            </tr>

        </thead>

        <tbody>

        <?php while($cliente = mysqli_fetch_assoc($resultado)){ ?>

            <tr style="border-bottom:1px solid #ddd;">

                <td style="padding:14px;">
                    <?= $cliente['nome']; ?>
                </td>

                <td>
                    <?= $cliente['cpf']; ?>
                </td>

                <td>
                    <?= $cliente['telefone']; ?>
                </td>

                <td>
                    <?= $cliente['cidade']; ?>
                </td>

                <td style="text-align:center;">

                    <a href="editar.php?id=<?= $cliente['id_cliente']; ?>"
                    title="Editar">
                        ✏️
                    </a>

                    &nbsp;&nbsp;

                    <a href="pontos.php?id=<?= $cliente['id_cliente']; ?>"
                    title="Lançar Pontuação">
                        ⭐
                    </a>

                    &nbsp;&nbsp;

                    <a href="resgatar.php?id=<?= $cliente['id_cliente']; ?>"
                    title="Resgatar Prêmios">
                        🎁
                    </a>

                    &nbsp;&nbsp;

                    <a href="excluir.php?id=<?= $cliente['id_cliente']; ?>"
                    title="Excluir"
                    onclick="return confirm('Deseja realmente excluir este paciente?');">
                        🗑️
                    </a>

                </td>

            </tr>

        <?php } ?>

        </tbody>

    </table>

</div>

<br>

<a href="../painel.php" class="btn-painel">

    ← Voltar ao Painel

</a>

<?php include("../includes/footer.php"); ?>