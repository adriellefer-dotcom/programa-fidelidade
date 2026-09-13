<?php

session_start();

if (!isset($_SESSION['cliente'])) {
    header("Location: consulta.php");
    exit();
}

include("config/conexao.php");
include("includes/header.php");

$id_cliente = $_SESSION['cliente'];

// Busca os dados do paciente
$sqlCliente = "SELECT * FROM clientes
               WHERE id_cliente = $id_cliente";

$resultCliente = mysqli_query($conexao, $sqlCliente);
$cliente = mysqli_fetch_assoc($resultCliente);

// Calcula o saldo de pontos
$sqlSaldo = "SELECT SUM(pontos) AS saldo
             FROM pontos
             WHERE id_cliente = $id_cliente";

$resultSaldo = mysqli_query($conexao, $sqlSaldo);
$saldo = mysqli_fetch_assoc($resultSaldo);

$totalPontos = $saldo['saldo'];

if ($totalPontos == NULL) {
    $totalPontos = 0;
}

// Categoria do cliente

if($totalPontos >= 30000){

    $categoria = "💎 Cliente Diamante";

}elseif($totalPontos >= 20000){

    $categoria = "🥇 Cliente Ouro";

}elseif($totalPontos >= 10000){

    $categoria = "🥈 Cliente Prata";

}else{

    $categoria = "🥉 Cliente Bronze";

}

?>

<section class="banner">

    <div class="banner-texto">

        <h2>

            👋 Olá,
            <?= $cliente['nome']; ?>!

        </h2>

        <p>

            Bem-vindo ao Programa Fidelidade.

        </p>

    </div>

</section>

<br>

<div class="card">

    <h3>⭐ Saldo Atual</h3>

    <h1 style="color:#1e3a8a;font-size:50px;">

        <?= number_format($totalPontos,0,",","."); ?>

        Pontos

    </h1>

    <br>

    <h3>🏆 Categoria</h3>

    <p>

        <?= $categoria; ?>

    </p>

</div>

<br>

<h2 style="color:#1e3a8a; margin-bottom:20px;">

    🎁 Prêmios Disponíveis

</h2>

<?php

$sqlPremios = "SELECT *
               FROM premios
               ORDER BY pontos";

$resultPremios = mysqli_query($conexao,$sqlPremios);

?>

<div class="cards">

<?php while($premio=mysqli_fetch_assoc($resultPremios)){ ?>

<div class="card">

<h3>

🎁

<?= $premio['nome']; ?>

</h3>

<p>

<?= number_format($premio['pontos'],0,",","."); ?>

Pontos

</p>

<br>

<?php if($totalPontos >= $premio['pontos']){ ?>

<form action="solicitar_resgate.php" method="POST">

<input
type="hidden"
name="premio"
value="<?= $premio['nome']; ?>">

<input
type="hidden"
name="pontos_gastos"
value="<?= $premio['pontos']; ?>">

<button>

Solicitar Resgate

</button>

</form>

<?php }else{ ?>

<p>

🔒 Faltam

<strong>

<?= number_format($premio['pontos']-$totalPontos,0,",","."); ?>

</strong>

pontos.

</p>

<?php } ?>

</div>

<?php } ?>

</div>

<!-- HISTÓRICO -->

<div class="card">

<h3>📋 Histórico</h3>

<?php

$sqlHistorico = "SELECT *
                 FROM pontos
                 WHERE id_cliente = $id_cliente
                 ORDER BY data_lancamento DESC";

$resultHistorico = mysqli_query($conexao,$sqlHistorico);

?>

<br>

<?php if(mysqli_num_rows($resultHistorico) > 0){ ?>

<table width="100%" cellspacing="0" cellpadding="8">

<tr style="background:#1e3a8a;color:white;">

<th>Data</th>

<th>Descrição</th>

<th>Pontos</th>

</tr>

<?php while($linha=mysqli_fetch_assoc($resultHistorico)){ ?>

<tr>

<td>

<?= date('d/m/Y',strtotime($linha['data_lancamento'])); ?>

</td>

<td>

<?= $linha['descricao']; ?>

</td>

<td>

<?= number_format($linha['pontos'],0,",","."); ?>

</td>

</tr>

<?php } ?>

</table>

<?php }else{ ?>

<p>

Nenhuma movimentação encontrada.

</p>

<?php } ?>

</div>

</div>

<br>

<div style="text-align:center;">

<a href="logout_cliente.php" class="btn-sair">

Sair

</a>

</div>

<?php include("includes/footer.php"); ?>