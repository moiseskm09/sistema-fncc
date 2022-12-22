<?php
include_once '../config/conexao.php';

$cooperativa = $_GET['id'];

if(isset($cooperativa)){
    mysqli_query($conexao, "UPDATE cooperativas SET coop_status = '0' WHERE cod_coop = '$cooperativa'");
    header("location: ../sistema/cad-cooperativas.php?sucesso=2");
}