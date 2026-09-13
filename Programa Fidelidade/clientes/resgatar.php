<?php

include("../config/conexao.php");
include("../includes/header.php");

if(!isset($_GET['id'])){

    header("Location:listar.php");
    exit();

}

$id = intval($_GET['id']);

$sqlCliente = "SELECT *
               FROM clientes
               WHERE id_cliente = $id";

$resultCliente = mysqli_query($conexao,$sqlCliente);
$cliente = mysqli_fetch_assoc($resultCliente);

$sqlSaldo = "SELECT SUM(pontos) AS saldo
             FROM pontos
             WHERE id_cliente = $id";

$resultSaldo = mysqli_query($conexao,$sqlSaldo);
$saldo = mysqli_fetch_assoc($resultSaldo);

$totalPontos = $saldo['saldo'];

if($totalPontos == NULL){
    $totalPontos = 0;
}

// Busca todos os prêmios
$sqlPremios = "SELECT *
               FROM premios
               ORDER BY pontos";

$resultPremios = mysqli_query($conexao,$sqlPremios);

// Conta quantos prêmios o paciente pode resgatar
$premiosDisponiveis = 0;

while($linha = mysqli_fetch_assoc($resultPremios)){

    if($totalPontos >= $linha['pontos']){

        $premiosDisponiveis++;

    }

}

// Volta o ponteiro para o início do resultado
mysqli_data_seek($resultPremios, 0);

?>

<section class="banner">

    <div class="banner-texto">

        <h2>🎁 Resgate Administrativo</h2>

        <p>

            Entrega de prêmio diretamente ao paciente.

        </p>

    </div>

</section>

<br>

<div class="card">

    <h3>Paciente</h3>

    <p>

        <strong>

            <?= $cliente['nome']; ?>

        </strong>

    </p>

    <br>

    <h3>Saldo Atual</h3>

    <p style="font-size:28px;color:#1e3a8a;">

        <?= number_format($totalPontos,0,",","."); ?>

        pontos

    </p>

</div>

<br>

<div class="card">

<form action="confirmar_resgate.php" method="POST">

    <input
        type="hidden"
        name="id_cliente"
        value="<?= $cliente['id_cliente']; ?>">

    <label>Escolha o prêmio</label>

    <?php if($premiosDisponiveis > 0){ ?>

        <select name="premio" required>

            <option value="">

                Selecione um prêmio

            </option>

            <?php while($premio = mysqli_fetch_assoc($resultPremios)){ ?>

                <?php if($totalPontos >= $premio['pontos']){ ?>

                    <option value="<?= $premio['nome']; ?>|<?= $premio['pontos']; ?>">

                        <?= $premio['nome']; ?>

                        -

                        <?= number_format($premio['pontos'],0,",","."); ?>

                        Pontos

                    </option>

                <?php } ?>

            <?php } ?>

        </select>

        <br><br>

        <button>

            Confirmar Resgate

        </button>

    <?php }else{ ?>

        <p style="color:#d9534f;font-weight:bold;">

            Este paciente ainda não possui pontos suficientes para resgatar nenhum prêmio.

        </p>

    <?php } ?>

</form>

</div>

<br>

<a href="listar.php" class="btn-painel">

    ← Voltar aos Pacientes

</a>

<?php include("../includes/footer.php"); ?>