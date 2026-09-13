<?php

session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: ../login.php");
    exit();
}

include("../config/conexao.php");
include("../includes/header.php");

$sql = "SELECT
            r.*,
            c.nome
        FROM resgates r
        INNER JOIN clientes c
            ON r.id_cliente = c.id_cliente
        ORDER BY r.data_solicitacao DESC";

$resultado = mysqli_query($conexao, $sql);

?>

<section class="banner">

    <div class="banner-texto">

        <h2>🎁 Gerenciamento de Resgates</h2>

        <p>

            Aprove ou cancele as solicitações de resgate realizadas pelos pacientes.

        </p>

    </div>

</section>

<br>

<div class="card">

<h3>Solicitações</h3>

<br>

<?php if(mysqli_num_rows($resultado) > 0){ ?>

<table width="100%" cellspacing="0" cellpadding="10">

<tr style="background:#1e3a8a;color:white;">

    <th>Paciente</th>
    <th>Prêmio</th>
    <th>Pontos</th>
    <th>Data</th>
    <th>Status</th>
    <th>Ações</th>

</tr>

<?php while($linha = mysqli_fetch_assoc($resultado)){ ?>

<tr>

    <td>

        <?= $linha['nome']; ?>

    </td>

    <td>

        <?= $linha['premio']; ?>

    </td>

    <td>

        <?= number_format($linha['pontos_gastos'],0,",","."); ?>

    </td>

    <td>

        <?= date('d/m/Y', strtotime($linha['data_solicitacao'])); ?>

    </td>

    <td>

        <?= $linha['status']; ?>

    </td>

    <td>

<?php if($linha['status'] == "Pendente"){ ?>

<a href="aprovar.php?id=<?= $linha['id_resgate']; ?>">

✅ Aprovar

</a>

|

<a href="cancelar.php?id=<?= $linha['id_resgate']; ?>">

❌ Cancelar

</a>

<?php }else{ ?>

-

<?php } ?>

    </td>

</tr>

<?php } ?>

</table>

<?php }else{ ?>

<p>

Nenhuma solicitação de resgate encontrada.

</p>

<?php } ?>

<br>

<a href="../painel.php" class="btn-painel">

← Voltar ao Painel

</a>

</div>

<?php include("../includes/footer.php"); ?>