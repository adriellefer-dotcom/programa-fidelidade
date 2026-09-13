<?php

include("../config/conexao.php");
include("../includes/header.php");

$sql = "SELECT *
        FROM premios
        ORDER BY pontos";

$resultado = mysqli_query($conexao,$sql);

?>

<section class="banner">

    <div class="banner-texto">

        <h2>🎁 Prêmios</h2>

        <p>

            Cadastre e gerencie os prêmios do Programa Fidelidade.

        </p>

    </div>

</section>

<div class="card" style="margin-top:30px;">

<div style="display:flex;
justify-content:space-between;
align-items:center;
margin-bottom:25px;">

<h3 style="margin:0;">

Lista de Prêmios

</h3>

<a href="novo.php">

<button style="width:auto;padding:12px 22px;">

➕ Novo Prêmio

</button>

</a>

</div>

<table style="width:100%;border-collapse:collapse;">

<thead>

<tr style="background:#1e3a8a;color:white;">

<th style="padding:14px;">

Prêmio

</th>

<th>

Pontos

</th>

<th style="width:180px;">

Ações

</th>

</tr>

</thead>

<tbody>

<?php while($premio = mysqli_fetch_assoc($resultado)){ ?>

<tr style="border-bottom:1px solid #ddd;">

<td style="padding:14px;">

<?= $premio['nome']; ?>

</td>

<td>

<?= number_format($premio['pontos'],0,",","."); ?>

</td>

<td>

<a
href="editar.php?id=<?= $premio['id_premio']; ?>"
title="Editar">

✏️

</a>

&nbsp;&nbsp;

<a
href="excluir.php?id=<?= $premio['id_premio']; ?>"
title="Excluir"
onclick="return confirm('Deseja excluir este prêmio?');">

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