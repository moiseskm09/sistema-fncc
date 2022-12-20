<?php 
require_once '../config/conexao.php';
require_once '../config/sessao.php';
require_once '../config/config_geral.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <link href="../css/menu.css" rel="stylesheet" />
        <link href="../css/home.css" rel="stylesheet" />
        <link href="../css/style.css" rel="stylesheet" />
        <link rel="manifest" href="../css/manifest.json">
        <script src="https://code.jquery.com/jquery-3.6.2.min.js" integrity="sha256-2krYZKh//PcchRtd+H+VyyQoZ/e3EcrkxhM8ycwASPA=" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://unicons.iconscout.com/release/v3.0.6/css/line.css">
    </head>
    <body class="sb-nav-fixed fundo_tela">
       <?php include_once "../ferramentas/navbar.php";?>
        <div id="layoutSidenav">
            <?php include_once "../ferramentas/menu.php";?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                       <!--conteudo da tela aqui!-->
                       <div class="form-row mt-2">
                           <div class="col-md-12">
                               <h6>Olá, <span class="destaque"><?php echo ucwords($NOME);?></span></h6>
                               <p>Quem bom te ver por aqui :)</p>
                           </div>

                       </div>
                       <div class="form-row">
                           <div class="col-md-12">
                               <h4 class="blockquote-footer" style="font-size: 20px;">Dashboard</h4>
                           </div>
                           
                       </div>
                       <div class="form-row">
                           <?php 
                           //$sqlCredenciados = mysqli_query($conexao, "SELECT cred_id FROM credenciados WHERE cred_status = '1'");
    //$CredCadastrados = mysqli_num_rows($sqlCredenciados);
                           ?>
                           <div class="col-md-3 col-4">
                               <a href="cad-credenciados.php" class="link-acesso">
                               <div class="card border-0 mb-1 mt-1">
  <div class="card-body acesso-rapido p-1">
      <h5 class="card-title"><?php echo "50";?> <i class="uil uil-users-alt icone-acesso"></i></h5>
      <h6 class="card-text texto-acessorapido">CREDENCIADOS</h6>
  </div>
</div>
                               </a>
                           </div>
                           <div class="col-md-3 col-4">
                               <a href="cad-usuarios.php" class="link-acesso">
                               <div class="card border-0 mb-1 mt-1">
  <div class="card-body acesso-rapido p-1">
      <h5 class="card-title">50 <i class="uil uil-user-plus icone-acesso"></i></h5>
      <h6 class="card-text texto-acessorapido">CLIENTES</h6>
  </div>
</div>
                               </a>
                           </div>
                           <?php 
                           //$sql = mysqli_query($conexao, "SELECT id_usuario FROM usuarios WHERE u_status != '0'");
    //$userCadastrados = mysqli_num_rows($sql);
                           ?>
                           <div class="col-md-3 col-4">
                               <a href="cad-usuarios.php" class="link-acesso">
                               <div class="card border-0 mb-1 mt-1">
  <div class="card-body acesso-rapido p-1">
      <h5 class="card-title"><?php echo "50";?> <i class="uil uil-user-check icone-acesso"></i></h5>
      <h6 class="card-text texto-acessorapido">USUÁRIOS</h6>
  </div>
</div>
                               </a>
                           </div>
                           <div class="col-md-3 col-4">
                               <a href="<?php echo $acessoRapido['caminho'];?>" class="link-acesso">
                               <div class="card border-0 mb-1 mt-1">
  <div class="card-body acesso-rapido p-1">
      <h5 class="card-title">50 <i class="uil uil-file-search-alt icone-acesso"></i></h5>
      <h6 class="card-text texto-acessorapido">EM ANÁLISE TÉCNICA</h6>
  </div>
</div>
                               </a>
                           </div>
                           <div class="col-md-3 col-4">
                               <a href="<?php echo $acessoRapido['caminho'];?>" class="link-acesso">
                               <div class="card border-0 mb-1 mt-1">
  <div class="card-body acesso-rapido p-1">
      <h5 class="card-title">50 <i class="uil uil-calendar-alt icone-acesso"></i></h5>
      <h6 class="card-text texto-acessorapido">VISTORIA AGENDADAS</h6>
  </div>
</div>
                               </a>
                           </div>
                           <div class="col-md-3 col-4">
                               <a href="<?php echo $acessoRapido['caminho'];?>" class="link-acesso">
                               <div class="card border-0 mb-1 mt-1">
  <div class="card-body acesso-rapido p-1">
      <h5 class="card-title">50 <i class="uil uil-file-exclamation-alt icone-acesso"></i></h5>
      <h6 class="card-text texto-acessorapido">EM ANÁLISE PARCIAL</h6>
  </div>
</div>
                               </a>
                           </div>
                           <div class="col-md-3 col-4">
                               <a href="<?php echo $acessoRapido['caminho'];?>" class="link-acesso">
                               <div class="card border-0 mb-1 mt-1">
  <div class="card-body acesso-rapido p-1">
      <h5 class="card-title">50 <i class="uil uil-receipt icone-acesso"></i></h5>
      <h6 class="card-text texto-acessorapido">EM ANÁLISE FINANCEIRA</h6>
  </div>
</div>
                               </a>
                           </div>
                           <div class="col-md-3 col-4">
                               <a href="<?php echo $acessoRapido['caminho'];?>" class="link-acesso">
                               <div class="card border-0 mb-1 mt-1">
  <div class="card-body acesso-rapido p-1">
      <h5 class="card-title">50 <i class="uil uil-archive-alt icone-acesso"></i></h5>
      <h6 class="card-text texto-acessorapido">FATURADAS</h6>
  </div>
</div>
                               </a>
                           </div>
                           <div class="col-md-3 col-4">
                               <a href="<?php echo $acessoRapido['caminho'];?>" class="link-acesso">
                               <div class="card border-0 mb-1 mt-1">
  <div class="card-body acesso-rapido p-1">
      <h5 class="card-title">50 <i class="uil uil-multiply icone-acesso"></i></h5>
      <h6 class="card-text texto-acessorapido">REJEITADAS</h6>
  </div>
</div>
                               </a>
                           </div>
                           <div class="col-md-3 col-4">
                               <a href="<?php echo $acessoRapido['caminho'];?>" class="link-acesso">
                               <div class="card border-0 mb-1 mt-1">
  <div class="card-body acesso-rapido p-1">
      <h5 class="card-title">50 <i class="uil uil-map icone-acesso"></i></h5>
      <h6 class="card-text texto-acessorapido">MAPA GERAL</h6>
  </div>
</div>
                               </a>
                           </div>
                           <div class="col-md-3 col-4">
                               <a href="<?php echo $acessoRapido['caminho'];?>" class="link-acesso">
                               <div class="card border-0 mb-1 mt-1">
  <div class="card-body acesso-rapido p-1">
      <h5 class="card-title">50 <i class="uil uil-file-alt icone-acesso"></i></h5>
      <h6 class="card-text texto-acessorapido">RELATÓRIOS</h6>
  </div>
</div>
                               </a>
                           </div>
                           <div class="col-md-3 col-4">
                               <a href="<?php echo $acessoRapido['caminho'];?>" class="link-acesso">
                               <div class="card border-0 mb-1 mt-1">
  <div class="card-body acesso-rapido p-1">
      <h5 class="card-title">50 <i class="uil uil-chart-line icone-acesso"></i></h5>
      <h6 class="card-text texto-acessorapido">GRÁFICOS</h6>
  </div>
</div>
                               </a>
                           </div>
                       </div>
                       
                     
                       <!--fim conteudo da tela aqui!-->
                    </div>
                </main>
                <?php include_once "../ferramentas/rodape.php";?>
            </div>
        </div>
       <script src="../js/scripts.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>    
    </body>
</html>
