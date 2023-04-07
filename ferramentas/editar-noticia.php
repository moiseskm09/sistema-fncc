<?php
include_once '../config/conexao.php';
include_once '../config/config_geral.php';
include_once 'slug.php';

if (isset($_POST["codNoticia"], $_POST["tituloNoticia"], $_POST["subtituloNoticia"], $_POST["textoNoticia"], $_POST["categoriaNoticia"])) {
   $tituloNoticia = $_POST["tituloNoticia"];
   $subtituloNoticia = $_POST["subtituloNoticia"];
   $textoNoticia = $_POST["textoNoticia"];
   $categoriaNoticia = $_POST["categoriaNoticia"]; 
   $codNoticia = $_POST["codNoticia"];
   $slug = url_slug($tituloNoticia, ['transliterate' => true]);

$queryAtualizaNoticia = mysqli_query($conexao, "UPDATE site_noticias SET titulo_noticia  = '$tituloNoticia', subtitulo_noticia = '$subtituloNoticia', texto_noticia = '$textoNoticia', categoria_noticia = '$categoriaNoticia', slug_noticia = '$slug' WHERE cod_noticia = '$codNoticia'");    
if($queryAtualizaNoticia == 1){
    header("location: ../sistema/editar-noticia.php?id=$codNoticia&sucesso=4");
}else{
    header("location: ../sistema/editar-noticia.php?id=$codNoticia&sucesso=4");
}
}else{
header("location: ../sistema/editar-noticia.php?id=$codNoticia&erro=2");
}