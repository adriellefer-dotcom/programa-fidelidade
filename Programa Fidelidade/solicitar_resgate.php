<?php

session_start();

if (!isset($_SESSION['cliente'])) {
    header("Location: consulta.php");
    exit();
}

include("config/conexao.php");

$id_cliente = $_SESSION['cliente'];

$premio = trim($_POST['premio']);
$pontos_gastos = intval($_POST['pontos_gastos']);

$data_solicitacao = date("Y-m-d");

$sqlVerifica = "SELECT id_resgate
                FROM resgates
                WHERE id_cliente = '$id_cliente'
                AND premio = '$premio'
                AND status = 'Pendente'";

$resultado = mysqli_query($conexao, $sqlVerifica);

if(mysqli_num_rows($resultado) > 0){

    echo "<script>

        alert('Você já possui uma solicitação pendente para este prêmio.');

        window.location='consulta_cliente.php';

    </script>";

    exit();

}

$sql = "INSERT INTO resgates
(
    id_cliente,
    premio,
    pontos_gastos,
    data_solicitacao,
    status
)
VALUES
(
    '$id_cliente',
    '$premio',
    '$pontos_gastos',
    '$data_solicitacao',
    'Pendente'
)";

if(mysqli_query($conexao, $sql)){

    echo "<script>

        alert('Solicitação enviada com sucesso! Nossa equipe entrará em contato para confirmar o seu benefício.');

        window.location='consulta_cliente.php';

    </script>";

}else{

    echo "<script>

        alert('Erro ao solicitar o resgate.');

        window.location='consulta_cliente.php';

    </script>";

}

?>