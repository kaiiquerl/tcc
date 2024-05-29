<?php
error_reporting(0);
ini_set('display_errors', 0 );

$usuario  = "root";
$senha    = "";
$url      = "localhost";
$database = "inventario";

$conexao = mysqli_connect($url, $usuario, $senha, $database) or die('Erro de conexão com BD');
