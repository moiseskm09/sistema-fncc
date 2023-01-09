<?php

//verifica se a sessão é valida
session_cache_expire(3);
$cache_expire = session_cache_expire();

session_start();

session_regenerate_id();
// Define sessão para o usuário logado
$EMAIL = $_SESSION["email"];
$NOME = $_SESSION["nome"];
$NIVEL = $_SESSION["user_nivel"];
$CODIGOUSUARIO = $_SESSION['CodUser'];
$LOGO_COOP = $_SESSION['logo_coop'];
$COOPERATIVA = $_SESSION['user_coop'];

if (!isset($EMAIL) || !isset ($NOME) || !isset ($NIVEL)) {
	header("Location: ../index.php");
	exit;
} else {
}