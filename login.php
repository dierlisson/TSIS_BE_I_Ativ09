<?php 
session_start();
require_once "dbLogin.php";

$user = isset($_POST['user']) ? trim($_POST['user']) : false;
$password = isset($_POST['password']) ? md5(trim($_POST['password'])) : false;

$user = filter_var($user, FILTER_SANITIZE_EMAIL);

if (!$user || !$password) {
    echo "Por favor, preencha todos os campos.";
    exit;
}

// Consulta no banco de dados para verificar se o login existe e a senha está correta.
$sql = "SELECT id, user, password, nome FROM auth_usr WHERE user = ?";
$stmt = mysqli_prepare($connect, $sql);

if ($stmt) {
    mysqli_stmt_bind_param($stmt, "s", $user);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($resultado) > 0) {
        $dados = mysqli_fetch_array($resultado);
        if ($password === $dados["password"]) {
            $_SESSION["id_usuario"] = $dados["id"];
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