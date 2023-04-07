<?php
include_once '../config/conexao.php';
include_once '../config/config_geral.php';

if(isset($_GET["id"])){
    $codNoticia = $_GET["id"];
    $publicaNoticia = mysqli_query($conexao, "DELETE FROM site_noticias WHERE cod_noticia = '$codNoticia'");
    header("location: ../sistema/noticias.php?sucesso=1");
}else{
    header("location: ../sistema/noticias.php?erro=1");
}