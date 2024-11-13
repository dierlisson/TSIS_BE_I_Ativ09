<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
  }

if(!isset($_SESSION["id_usuario"]) || !isset($_SESSION["nome_usuario"]))
{
header("Location: index.php");
exit;
}
