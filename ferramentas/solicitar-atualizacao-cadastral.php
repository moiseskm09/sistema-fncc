<?php

require_once '../config/sessao.php';
require_once '../config/conexao.php';
require_once '../config/config_geral.php';


$SolicitaAtualizacao = mysqli_query($conexao, "UPDATE cooperativas SET coop_dados_atualizados = '0'");

if ($SolicitaAtualizacao == 1 || $SolicitaAtualizacao > 1){
    header("location: ../sistema/cad-cooperativas.php?sucesso=3");
}else{
    header("location: ../sistema/cad-cooperativas.php?erro=1");
}