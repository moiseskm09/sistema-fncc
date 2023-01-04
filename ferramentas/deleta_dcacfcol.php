<?php
include_once '../config/conexao.php';

if(isset($_GET['dca'], $_GET['id'])){
    $dca = $_GET['dca'];
    $cop_id = $_GET['id'];
    //echo "dca = ".$dca;
    mysqli_query($conexao, "DELETE FROM diretoria_conselhoadm WHERE dca_id = '$dca'");
    header("location: ../sistema/editar-cooperativa.php?id=$cop_id&sucesso=1");
}elseif(isset($_GET['cf'], $_GET['id'])){
    $cf = $_GET['cf'];
    $cop_id = $_GET['id'];
    //echo "cf = ".$cf;
    mysqli_query($conexao, "DELETE FROM conselho_fiscal WHERE cf_id = '$cf'");
    header("location: ../sistema/editar-cooperativa.php?id=$cop_id&sucesso=1");
}elseif(isset($_GET['col'], $_GET['id'])){
    $col = $_GET['col'];
    $cop_id = $_GET['id'];
    //echo "col = ".$col;
    mysqli_query($conexao, "DELETE FROM colaboradores_coop WHERE cod_col = '$col'");
    header("location: ../sistema/editar-cooperativa.php?id=$cop_id&sucesso=1");
}else{
    $cop_id = $_GET['id'];
    header("location: ../sistema/editar-cooperativa.php?id=$cop_id&erro=1");
}