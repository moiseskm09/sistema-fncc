<?php
require_once '../config/config_geral.php';
require_once '../config/sessao.php';
require_once '../config/conexao.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <link href="../css/menu.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
       <script src="https://code.jquery.com/jquery-3.6.2.min.js" integrity="sha256-2krYZKh//PcchRtd+H+VyyQoZ/e3EcrkxhM8ycwASPA=" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://unicons.iconscout.com/release/v3.0.6/css/line.css">
<!-- Styles -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
<!-- Or for RTL support -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.rtl.min.css" />

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

        <script src="../js/mask.js"></script>
        <script src="../js/busca-cep.js"></script>
        <script src="../js/loading.js"></script>
        <link href="../css/style.css" rel="stylesheet" />
        <link href="../css/visualizar_doc.css" rel="stylesheet" />
    </head>
    <body> 
      <div class="d-flex " id="wrapper">
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">

        
            <div class="container-fluid" >
   <form id="EdicaoUsuario"  method="POST" action="" enctype="multipart/form-data">
   <br>
   <div class="form-row">
       <div class="col-md-3 col-lg-3">
           <div class="form-row">
               <div class="col-md-12 col-lg-12 text-center">
               <legend style="font-size:25px;">Editando <span class="text-info font-weight-bold"><?php echo $resultadoEditausuario['nome'] ?></span></legend>
               </div>
               <div class="col-md-12 col-lg-12 text-center">
                   <div class="rounded">
                       <img class="rounded mx-auto img-fluid" src="../img/users/<?php echo $resultadoEditausuario['img_user']; ?>" style="height: 200px;">
                   </div>
                   <div class="" style="padding-top: 10px;">
                       <label for="imagemUsuario" ><span class="text-info font-weight-bold">Escolha o arquivo e atualize</span></label>
                       <input type="file" class="form-control-file btn" id="imagemUsuario" name="imagemUsuario" maxlength="50" style="height:40px;">
                   </div>
               </div>
       </div>
       </div>
       <div class="col-md-9  col-lg-9" style="padding-top: 10px;">
	<div class="form-row">
        <div class="form-group col-md-5">
      <label for="nome">Nome</label>
      <input type="text" class="form-control" id="nome" name="nome" value="<?php echo $resultadoEditausuario['nome'] ?>" maxlength="50" required>
    </div>
	
	<div class="form-group col-md-7">
      <label for="sobrenome">Sobrenome</label>
      <input type="text" class="form-control" id="sobrenome" name="sobrenome" value="<?php echo $resultadoEditausuario['sobrenome'] ?>" maxlength="100" required>
    </div>
	
	<div class="form-group col-md-4">
      <label for="email">E-mail</label>
      <input type="email" class="form-control" id="email" name="email" value="<?php echo $resultadoEditausuario['email'] ?>" maxlength="100" required>
    </div>
	
	<div class="form-group col-md-4">
      <label for="usuario">Usuário</label>
      <input type="text" class="form-control" id="usuario" name="usuario" value="<?php echo $resultadoEditausuario['usuario'] ?>" maxlength="50" required>
    </div>
	
	 <div class="form-group col-md-4">
      <label for="niveldeacesso">Nível de Acesso</label>
      <select id="niveldeacesso" name="niveldeacesso" class="form-control" required>
        <option value="<?php echo $resultadoEditausuario['nivelid'] ?>" selected><?php echo $resultadoEditausuario['nivelcad'];  ?></option>
        < <?php while ($nivelcad = $consultanivel->fetch_array()) {
                            ?>
        <option value="<?php echo $nivelcad["id_nivel"];?>" ><?php echo $nivelcad["nivel"];?></option>
        <?php } ?>
      </select>
		</div>
            
            <div class="form-group col-md-4">
      <label for="empresauser">Empresa</label>
      <select id="empresauser" name="empresauser" class="form-control" required>
                <option value="<?php echo $resultadoEditausuario['cod_empresa'] ?>" selected><?php echo $resultadoEditausuario['fantasia'] ?></option>
                <?php while ($empresascad = $consultaempresa->fetch_array()) {
                            ?>
        <option value="<?php echo $empresascad["cod_empresa"];?>" ><?php echo $empresascad["fantasia"];?></option>
        <?php } ?>
      </select>
		</div>
            
            <div class="form-group col-md-4">
      <label for="departamentouser">Departamento</label>
      <select id="departamentouser" name="departamentouser" class="form-control" required>
                <option value="<?php echo $resultadoEditausuario['id_departamento'] ?>" selected><?php echo $resultadoEditausuario['descdepartamento'] ?></option>
                <?php while ($departamentocad = $consultadepartamento->fetch_array()) {
                            ?>
        <option value="<?php echo $departamentocad["cod_departamento"];?>" ><?php echo $departamentocad["descricao"];?></option>
        <?php } ?>
      </select>
		</div>
            

            <div class="form-group col-md-10" style="padding-top:20px;">
	<input type="hidden" id="id" name="id" value="<?php echo $idusuario; ?>">
   <button for="atualizar" type="submit" class="btn btn-primary">Atualizar</button>
      
	<input type="hidden" name="id" value="<?php echo $idusuario; ?>">  
	<a class="btn btn-danger" data-toggle="modal" href="#myModalsenha">Alterar Senha</a>
	</div>   
    
            <div class="form-group col-md-4">
	<a class="btn btn-info" href="consultaUsuario.php">Voltar</a>
	</div>   
  </div>
       </div>
    
</form>
</div>
    <?php

    if (isset($_POST['nome'], $_POST['sobrenome'], $_POST['email'], $_POST['usuario'], $_POST['niveldeacesso'], $_POST['empresauser'], $_POST['departamentouser'])) {
            
      $nome=$_POST['nome'];
      $sobrenome=$_POST['sobrenome'];
      $email=$_POST['email'];
      $usuarioEditado=$_POST['usuario'];
      $niveldeacesso=$_POST['niveldeacesso'];
      $empresauser=$_POST['empresauser'];
      $departamentouser=$_POST['departamentouser'];
      $imagem_perfil = $_FILES['imagemUsuario'];
     
      // verifica se foi enviado um arquivo
if ( isset( $_FILES[ 'imagemUsuario' ][ 'name' ] ) && $_FILES[ 'imagemUsuario' ][ 'error' ] == 0 ) {
    //bloco upload imagem usuario
                         // Pega extensão da imagem
		preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $imagem_perfil["name"], $ext);
                        // Gera um nome único para a imagem
        	$nome_imagem = md5(uniqid(time())) . "." . $ext[1];
                // Caminho de onde ficará a imagem
        	$caminho_imagem = "../img/users/" . $nome_imagem;
                // Faz o upload da imagem para seu respectivo caminho
	        move_uploaded_file($imagem_perfil["tmp_name"], $caminho_imagem);
                 //fim bloco upload imagem usuario
                    $atualiza_usario= mysqli_query($conexao, "UPDATE usuarios SET nome='$nome', sobrenome='$sobrenome', email='$email', usuario='$usuarioEditado', nivel='$niveldeacesso', id_empresa='$empresauser', id_departamento='$departamentouser', img_user='$nome_imagem' WHERE id='$idusuario'");
                      echo '<div class="alert alert-success">Alterações realizadas com sucesso!</div>';?>
                        <meta http-equiv='refresh' content='1'>
                        <?php
}else {
    $atualiza_usario= mysqli_query($conexao, "UPDATE usuarios SET nome='$nome', sobrenome='$sobrenome', email='$email', usuario='$usuarioEditado', nivel='$niveldeacesso', id_empresa='$empresauser', id_departamento='$departamentouser' WHERE id='$idusuario'");
                      echo '<div class="alert alert-success">Alterações realizadas com sucesso!</div>';?>
                        <meta http-equiv='refresh' content='1'>
                        <?php
}
          } else {
      }
    ?>    
    <!-- The Modal -->
  <div class="modal" id="myModalsenha">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Alterar senha</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
          <form id="validacao"  method="post" action="alterasenha.php" enctype="multipart/form-data">
	
	<label for="usuario">Usuário</label>
      <input type="text" class="form-control" id="usuario" name="usuario" value="<?php echo $resultadoEditausuario['usuario'] ?>" readonly required>
	<input type="hidden" name="id" value="<?php echo $idusuario; ?>">
	<br>
	<label for="senhaatual">Senha atual</label>
      <input type="password" class="form-control" id="senhaatual" name="senhaatual" placeholder="Digite a Senha atual" required minlength="8" maxlength="16">
	  
	<br>
<label for="novasenha">Nova Senha</label>
      <input type="password" class="form-control" id="novasenha" name="novasenha" placeholder="Digite a nova senha" required minlength="8" maxlength="16">
	  <span class="help-block">Deve conter entre 8 e 16 caracteres</span>	
<br>

<br>

<label for="confirmacao">Confirme a senha</label>
      <input type="password" class="form-control" id="confirmacao" name="confirmacao" placeholder="Confirme a nova senha" required minlength="8" maxlength="16">
	 	  
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
		<button type="submit" class="btn btn-primary" >Alterar Senha</button>
		<button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
        </div>
         </form>
	
      </div>
    </div>
  <!-- Page Content -->
  <!-- Conteudo da tela aqui -->
 
 </div> 
    <!-- The Modal -->
               <div class="footer">
  <p>Versão <?php echo VERSAO; ?> </p>
</div> 
    </div>
      </div>
         <!-- Menu Toggle Script -->
  <script>
    $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });
  </script> 
            <!-- Bootstrap core JavaScript -->
        <script src="../vendor/jquery/jquery.min.js"></script>
        <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    </body>
</html>