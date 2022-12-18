<?php
include_once '../config/conexao.php';


  $id_perfil=$_POST['id'];
  
  $sql_permissao = "UPDATE nivel_acesso SET marcado = '0' WHERE cod_perfil = $id_perfil"; 
  $executa= mysqli_query($conexao, $sql_permissao);
  
  
if ($_POST && isset($_POST['permissao_menu'])){
  $ativo = $_POST['permissao_menu'];
 
  foreach($ativo as $valor){
      $sql = "UPDATE nivel_acesso SET marcado = '1' WHERE cod_perfil = $id_perfil and codSubmenu =".$valor; 
          $executa= mysqli_query($conexao, $sql);
  }
}

header("location: ../sistema/perfis-usuarios.php?sucesso=1");