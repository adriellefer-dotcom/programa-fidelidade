<?php

include("config/conexao.php");
include("includes/header.php");

?>

<section class="banner">

    <div class="banner-texto">

        <h2>🎁 Prêmios do Programa Fidelidade</h2>

        <p>
            Acumule pontos em seus procedimentos e troque por benefícios
            exclusivos preparados especialmente para nossos clientes.
        </p>

    </div>

</section>

<?php

$sql = "SELECT *
        FROM premios
        ORDER BY pontos";

$resultado = mysqli_query($conexao, $sql);

$contador = 0;

?>

<section class="cards">

<?php while($premio = mysqli_fetch_assoc($resultado)){ ?>

    <?php
    // Fecha a primeira linha e abre a segunda após o terceiro prêmio
    if($contador == 3){
        echo '</section>';
        echo '<section class="cards">';
    }
    ?>

    <div class="card">

        <h3>🎁 <?= $premio['nome']; ?></h3>

        <p>

            <strong>

                <?= number_format($premio['pontos'],0,",","."); ?>

                Pontos

            </strong>

        </p>

        <br>

        <p>

            Benefício disponível no Programa Fidelidade.

        </p>

    </div>

<?php

$contador++;

} ?>

    <div class="card">

        <h3>⭐ Como Funciona?</h3>

        <p>

            A cada <strong>R$ 1,00</strong> gasto em procedimentos,
            você acumula <strong>1 ponto</strong>.

        </p>

        <br>

        <p>

            Consulte seu saldo de pontos e acompanhe seus benefícios pela área
            <strong>Consultar Pontos</strong>.

        </p>

    </div>

</section>

<?php include("includes/footer.php"); ?>