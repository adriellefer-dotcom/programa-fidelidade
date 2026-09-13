<?php

session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: ../login.php");
    exit();
}

include("../config/conexao.php");

$id = $_GET['id'];

$sql = "SELECT * FROM clientes WHERE id_cliente = $id";
$resultado = mysqli_query($conexao, $sql);
$cliente = mysqli_fetch_assoc($resultado);

if(isset($_POST['editar'])){

    $nome = trim($_POST['nome']);
    $cpf = trim($_POST['cpf']);
    $dt_nascimento = $_POST['dt_nascimento'];
    $telefone = trim($_POST['telefone']);
    $email = trim($_POST['email']);
    $cidade = trim($_POST['cidade']);

    $sql = "UPDATE clientes SET

        nome='$nome',
        cpf='$cpf',
        dt_nascimento='$dt_nascimento',
        telefone='$telefone',
        email='$email',
        cidade='$cidade'

        WHERE id_cliente=$id";

    mysqli_query($conexao, $sql);

    echo "<script>

            alert('Paciente atualizado com sucesso!');

            window.location='listar.php';

          </script>";

    exit();

}

include("../includes/header.php");

?>

<section class="banner">

    <div class="banner-texto">

        <h2>✏️ Editar Paciente</h2>

        <p>

            Atualize as informações do paciente cadastrado.

        </p>

    </div>

</section>

<br>

<div class="card">

<form method="POST">

    <label>Nome Completo</label>

    <input
        type="text"
        name="nome"
        value="<?= $cliente['nome']; ?>"
        required>

    <label>CPF</label>

    <input
        type="text"
        name="cpf"
        value="<?= $cliente['cpf']; ?>"
        required>

    <label>Data de Nascimento</label>

    <input
        type="date"
        name="dt_nascimento"
        value="<?= $cliente['dt_nascimento']; ?>"
        required>

    <label>Telefone</label>

    <input
        type="text"
        name="telefone"
        value="<?= $cliente['telefone']; ?>">

    <label>E-mail</label>

    <input
        type="email"
        name="email"
        value="<?= $cliente['email']; ?>">

    <label>Cidade</label>

    <input
        type="text"
        name="cidade"
        value="<?= $cliente['cidade']; ?>">

    <button
        type="submit"
        name="editar">

        💾 Salvar Alterações

    </button>

    <br><br>

    <a href="listar.php" class="btn-painel">

        ← Voltar para Lista de Pacientes

    </a>

</form>

</div>

<?php include("../includes/footer.php"); ?>