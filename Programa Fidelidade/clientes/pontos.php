<?php

session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: ../login.php");
    exit();
}

include("../config/conexao.php");
include("../includes/header.php");

if (!isset($_GET['id'])) {
    header("Location: listar.php");
    exit();
}

$id = intval($_GET['id']);

// Busca o paciente
$sqlCliente = "SELECT * FROM clientes WHERE id_cliente = $id";
$resultCliente = mysqli_query($conexao, $sqlCliente);
$cliente = mysqli_fetch_assoc($resultCliente);

if (!$cliente) {
    header("Location: listar.php");
    exit();
}

// Calcula saldo atual
$sqlSaldo = "SELECT SUM(pontos) AS saldo
             FROM pontos
             WHERE id_cliente = $id";

$resultSaldo = mysqli_query($conexao, $sqlSaldo);
$saldo = mysqli_fetch_assoc($resultSaldo);

$totalPontos = $saldo['saldo'];

if ($totalPontos == NULL) {
    $totalPontos = 0;
}

// Histórico
$sqlHistorico = "SELECT *
                 FROM pontos
                 WHERE id_cliente = $id
                 ORDER BY data_lancamento DESC";

$resultHistorico = mysqli_query($conexao, $sqlHistorico);

?>

<section class="banner">

    <div class="banner-texto">

        <h2>⭐ Lançamento de Pontos</h2>

        <p>
            Registre uma nova pontuação para este paciente.
        </p>

    </div>

</section>

<div class="card" style="margin-top:30px;">

    <h3>👤 Dados do Paciente</h3>

    <br>

    <p><strong>Nome:</strong> <?= $cliente['nome']; ?></p>

    <p><strong>CPF:</strong> <?= $cliente['cpf']; ?></p>

    <p><strong>Telefone:</strong> <?= $cliente['telefone']; ?></p>

    <p><strong>Cidade:</strong> <?= $cliente['cidade']; ?></p>

    <br>

    <h3 style="color:#1e3a8a;">

        ⭐ Saldo Atual:
        <?= number_format($totalPontos,0,",","."); ?> pontos

    </h3>

</div>

<br>

<div class="card">

<form action="salvar_pontos.php" method="POST">

    <input
        type="hidden"
        name="id_cliente"
        value="<?= $cliente['id_cliente']; ?>">

    <label>Descrição do Procedimento</label>

    <input
        type="text"
        name="descricao"
        required>

    <label>Valor do Procedimento (R$)</label>

    <input
        type="number"
        name="valor"
        step="0.01"
        min="0"
        required>

    <button type="submit">

        💾 Salvar Pontuação

    </button>

    <br><br>

    <a href="listar.php" class="btn-painel">

        ← Voltar para Lista de Pacientes

    </a>

</form>

</div>

<br>

<div class="card">

<h3>📋 Histórico de Pontuação</h3>

<br>

<?php if(mysqli_num_rows($resultHistorico) > 0){ ?>

<table width="100%" cellspacing="0" cellpadding="10">

<tr style="background:#1e3a8a;color:white;">

    <th>Data</th>
    <th>Procedimento</th>
    <th>Valor</th>
    <th>Pontos</th>

</tr>

<?php while($linha = mysqli_fetch_assoc($resultHistorico)){ ?>

<tr>

    <td>

        <?= date('d/m/Y', strtotime($linha['data_lancamento'])); ?>

    </td>

    <td>

        <?= $linha['descricao']; ?>

    </td>

    <td>

        R$ <?= number_format($linha['valor'],2,",","."); ?>

    </td>

    <td>

        <?= number_format($linha['pontos'],0,",","."); ?>

    </td>

</tr>

<?php } ?>

</table>

<?php } else { ?>

<p>

    Nenhuma pontuação foi lançada para este paciente.

</p>

<?php } ?>

</div>

<?php include("../includes/footer.php"); ?>