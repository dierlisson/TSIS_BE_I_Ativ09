<?php 
session_start();
require_once "dbLogin.php";

$email = isset($_POST['email']) ? trim($_POST['email']) : false;
$senha = isset($_POST['senha']) ? md5(trim($_POST['senha'])) : false;

$email = filter_var($email, FILTER_SANITIZE_EMAIL);

if (!$email || !$senha) {
    echo "Por favor, preencha todos os campos.";
    exit;
}

// Consulta no banco de dados para verificar se o login existe e a senha está correta.
$sql = "SELECT idUsuario, email, senha, nome FROM auth_usr WHERE email = ?";
$stmt = mysqli_prepare($connect, $sql);

if ($stmt) {
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($resultado) > 0) {
        $dados = mysqli_fetch_array($resultado);
        if ($senha === $dados["senha"]) {
            $_SESSION["id_usuario"] = $dados["idUsuario"];
            $_SESSION["nome_usuario"] = stripslashes($dados["nome"]);
            header("Location: consultar.php");
            exit;
        } else {
            echo "Senha inválida.";
            exit;
        }
    } else {
        echo "Login inexistente!";
        exit;
    }
} else {
    echo "Erro na preparação da consulta: " . mysqli_error($connect);
    exit;
}
?>