<?php
// Header
include_once 'header.php';
$auth = false;
$senhaPadrao = 123456;
$emailPadrao = "email@teste.com";

if (!function_exists('login')) {
	function login()
	{
?>
		<div class="global-container">
			<div class="card login-form">
				<div class="card-body">
					<h3 class="card-title text-center">Autenticação do usuário</h3>
					<div class="card-text">
						<form action="./login.php" method="post">
							<div class="form-group">
								<label for="exampleInputEmail1">Email:</label>
								<input type="email" class="form-control form-control-sm" name="txtemail" id="email" required>
							</div>
							<div class="form-group">
								<label for="exampleInputPassword1">Senha:</label>
								<input type="password" class="form-control form-control-sm" name="txtsenha" id="password" required>
							</div>
							<button type="submit" class="btn btn-secondary btn-block" name="btlogin">Login</button>
						</form>
					</div>
				</div>
			</div>
		</div>
<?php
	}
}

// Verifica se a função startAuth já foi definida
if (!function_exists('startAuth')) {
	function startAuth()
	{
		global $auth;

		if ($auth == true) {
			include_once 'consultar.php';
		} else {
			login();
		}
	}
}
// Verifica se a função validate_login já foi definida
if (!function_exists('validate_login')) {
	function validate_login($email, $senha)
	{
		global $emailPadrao, $senhaPadrao, $auth;

		if ($email == $emailPadrao && $senha == $senhaPadrao) {
			return true;
		} else {
			echo "<h1>Email ou senha inválidos!</h1>";
			header("Refresh: 2; url=login.php");
			exit();
		}
	}
}

// Verifica se o formulário foi enviado
if (isset($_POST['btlogin'])) {
	$email = $_POST['txtemail'];
	$senha = $_POST['txtsenha'];

	$auth = validate_login($email, $senha);
	startAuth();
}
startAuth();
?>

<link rel="stylesheet" href="css/login.css">
<?php include_once 'footer.php'; ?>