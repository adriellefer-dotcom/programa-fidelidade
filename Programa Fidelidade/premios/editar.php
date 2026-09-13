<?php

include("../config/conexao.php");

$id = intval($_GET['id']);

$sql = "SELECT *
        FROM premios
        WHERE id_premio = $id";

$resultado = mysqli_query($conexao, $sql);
$premio = mysqli_fetch_assoc($resultado);

if(isset($_POST['editar'])){

    $nome = trim($_POST['nome']);
    $pontos = intval($_POST['pontos']);

    $sql = "UPDATE premios SET

            nome='$nome',
            pontos='$pontos'

            WHERE id_premio=$id";

    mysqli_query($conexao, $sql);

    header("Location:listar.php");
    exit();

}

include("../includes/header.php");

?>

<section class="banner">

    <div class="banner-texto">

        <h2>✏️ Editar Prêmio</h2>

        <p>

            Atualize as informações do prêmio.

        </p>

    </div>

</section>

<br>

<div class="card">

<form method="POST">

<label>Nome do Prêmio</label>

<input
type="text"
name="nome"
value="<?= $premio['nome']; ?>"
required>

<label>Pontos Necessários</label>

<input
type="number"
name="pontos"
value="<?= $premio['pontos']; ?>"
required>

<button
type="submit"
name="editar">

💾 Salvar Alterações

</button>

</form>

</div>

<br>

<a href="listar.php" class="btn-painel">

← Voltar

</a>

<?php include("../includes/footer.php"); ?>