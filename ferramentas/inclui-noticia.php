<?php
include_once '../config/conexao.php';
//include_once '../config/config_geral.php';
include_once 'slug.php';

if (isset($_POST["tituloNoticia"], $_POST["subtituloNoticia"], $_POST["textoNoticia"], $_POST["categoriaNoticia"], $_FILES['imgNoticia'])) {
   $tituloNoticia = $_POST["tituloNoticia"];
   $subtituloNoticia = $_POST["subtituloNoticia"];
   $textoNoticia = $_POST["textoNoticia"];
   $categoriaNoticia = $_POST["categoriaNoticia"];
   $imgNoticia = $_FILES["imgNoticia"];
   $dataNoticia = date("Y-m-d");
   $HoraNoticia = date("His");
   $dirImagem = "../../site-fncc/assets/imagens/imagens_noticias";
   $slug = url_slug($tituloNoticia, ['transliterate' => true]);
   // imagem 
    $nomeImagem = str_replace('/', '_', $dataNoticia."_".$tituloNoticia."_".$HoraNoticia);  
    $path = $_FILES['imgNoticia']['name'];
    $ext = pathinfo($path, PATHINFO_EXTENSION);
    $nomeFinalImgNoticia = str_replace(' ', '_', $nomeImagem) . "." . $ext;
   //imagem
    if (move_uploaded_file($imgNoticia["tmp_name"], "$dirImagem/" . $nomeFinalImgNoticia)) {
        $queryInsereNoticia = mysqli_query($conexao, "INSERT  site_noticias (titulo_noticia, subtitulo_noticia, texto_noticia, categoria_noticia, slug_noticia, img_noticia, publicado, data_noticia) VALUES ('$tituloNoticia', '$subtituloNoticia', '$textoNoticia', '$categoriaNoticia', '$slug', '$nomeFinalImgNoticia', 0, '$dataNoticia')");
        if($queryInsereNoticia == 1){
            $buscaCodNoticia = mysqli_query($conexao, "SELECT cod_noticia FROM site_noticias WHERE slug_noticia = '$slug'");
            $resultadoCodigo = mysqli_fetch_assoc($buscaCodNoticia);
            $codNoticia = $resultadoCodigo["cod_noticia"];
            header("location: ../sistema/editar-noticia.php?id=$codNoticia&sucesso=1");
        }else{
            header("location: ../sistema/incluir-noticia.php?erro=2");
        }
    }else{
        header("location: ../sistema/incluir-noticia.php?erro=2");
    }
}else{
header("location: ../sistema/incluir-noticia.php?erro=1");
}