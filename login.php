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

$sql = "SELECT id, user, passwors, nome FROM auth_usr WHERE user = " . $user . "";
$resultado = mysqli_query($connect,$sql);
$total = mysqli_num_rows($resultado);


if (!$total) {
	$GLOBALS["password"];
	$GLOBALS["resultado"];
	$dados = mysqli_fetch_array($resultado);
	if (!strcmp($password, $dados["password"])) {
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
