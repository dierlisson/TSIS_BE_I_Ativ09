<?php
$servername = "localhost";
$username = "root";
$password = "usbw";
$db_name ="produtos";

$connect = mysqli_connect($servername, $username, $password, $db_name);

if(mysqli_connect_error()){
    echo "Falha de conexão com o banco de dados: ". mysqli_connect_error();
}

