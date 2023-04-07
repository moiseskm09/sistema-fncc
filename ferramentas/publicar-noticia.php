<?php
include_once '../config/conexao.php';
include_once '../config/config_geral.php';

if(isset($_GET["cod_noticia"], $_GET["publicar"])){
    $codNoticia = $_GET["cod_noticia"];
    $publicar = $_GET["publicar"];
    $dataPublicado = date("Y-m-d");
    if($publicar == 1){
    $publicaNoticia = mysqli_query($conexao, "UPDATE site_noticias SET publicado = 1, data_publicacao = '$dataPublicado' WHERE cod_noticia = '$codNoticia'");
    header("location: ../sistema/editar-noticia.php?id=$codNoticia&sucesso=2");
    }else{
        $publicaNoticia = mysqli_query($conexao, "UPDATE site_noticias SET publicado = 0, data_publicacao = null WHERE cod_noticia = '$codNoticia'");
    header("location: ../sistema/editar-noticia.php?id=$codNoticia&sucesso=3");
    }
}else{
    header("location: ../sistema/noticias.php");
}