<?php 

include_once '../config/conexao.php';

$nome_perfil_novo=$_POST['nome_perfil_novo'];
            
$insere_perfil= mysqli_query($conexao, "INSERT INTO perfis_usuarios (perfil) VALUES ('$nome_perfil_novo')");
            
$consulta_perfil_criado = mysqli_query($conexao, "SELECT p_cod FROM perfis_usuarios WHERE perfil = '$nome_perfil_novo' ORDER BY p_cod DESC LIMIT 1");
            
$resultado_criacao_perfil = mysqli_fetch_assoc($consulta_perfil_criado);
            
$id_perfil_criado = $resultado_criacao_perfil['p_cod'];
            
            
$buscaMenu = mysqli_query($conexao, "SELECT id_menu, cod_submenu FROM menu INNER JOIN submenu ON id_menu = cod_menu");

while($resultadoMenu = mysqli_fetch_assoc($buscaMenu)){
    $idMenu = $resultadoMenu["id_menu"];
    $cod_submenu = $resultadoMenu["cod_submenu"];
    $insere_permissao_perfil_criado = mysqli_query($conexao, "INSERT INTO nivel_acesso (cod_perfil, codMenu, codSubmenu, marcado) VALUES ($id_perfil_criado, $idMenu, $cod_submenu, 0)");
}        

 header("location: ../sistema/perfis-usuarios.php?id=".$id_perfil_criado);
         
 
