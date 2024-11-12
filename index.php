<?php
require_once 'dbLogin.php';
if(isset($_SESSION["id_usuario"])){
    header("Location: consultar.php");
    exit;
}
// Header
include_once 'header.php';
?>

<link rel="stylesheet" href="css/login.css">


<div class="global-container">
    <div class="card login-form">
        <div class="card-body">
            <h3 class="card-title text-center">Autenticação do usuário</h3>
            <div class="card-text">
                <form action="./login.php" method="post">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email:</label>
                        <input type="email" class="form-control form-control-sm" name="user" id="email" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Senha:</label>
                        <input type="password" class="form-control form-control-sm" name="password" id="password" required>
                    </div>
                    <button type="submit" class="btn btn-secondary btn-block" name="btlogin">Login</button>
                </form>
            </div>
        </div>
    </div>
</div>


<?php include_once 'footer.php'; ?>