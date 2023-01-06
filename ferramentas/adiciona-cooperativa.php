<?php
include_once '../config/conexao.php';
require_once '../config/config_geral.php';
if(isset($_POST["coop_razao"], $_POST["coop_fantasia"], $_POST["coop_cnpj"], $_POST["coop_matricula"])){
$coop_razao = $_POST["coop_razao"];
$coop_fantasia = $_POST["coop_fantasia"];
$coop_cnpj = $_POST["coop_cnpj"];
$coop_matricula = $_POST["coop_matricula"];
$coop_telefone = $_POST["coop_telefone"];
$coop_whatsapp = $_POST["coop_whatsapp"];
$coop_email = $_POST["coop_email"];
$coop_data_cadastro = date("Y-m-d");
$queryCoopAdd = mysqli_query($conexao, "INSERT INTO cooperativas (coop_matricula, coop_razao, cooperativa, coop_cnpj, coop_telefone, coop_whatsapp, coop_email, coop_data_cadastro) VALUES ('$coop_matricula','$coop_razao', '$coop_fantasia', '$coop_cnpj', '$coop_telefone', '$coop_whatsapp', '$coop_email', '$coop_data_cadastro')");
header("location: ../sistema/cad-cooperativas.php?sucesso=1");
}else{
    header("location: ../sistema/cad-cooperativas.php?erro=1");
}
