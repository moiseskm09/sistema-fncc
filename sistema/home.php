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
        <link rel="manifest" href="../manifest.json">
        <script src="https://code.jquery.com/jquery-3.6.2.min.js" integrity="sha256-2krYZKh//PcchRtd+H+VyyQoZ/e3EcrkxhM8ycwASPA=" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://unicons.iconscout.com/release/v3.0.6/css/line.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
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
                       <div class="row mt-2">
                           <div class="col-md-12">
                               <h4 class="blockquote-footer" style="font-size: 20px;">Acesso Rápido</h4>
                           </div>
                       </div>
                       <div class="row">
                           <?php 
                           $buscaSubmenu = mysqli_query($conexao, "SELECT submenu, icone_sub, caminho FROM submenu INNER JOIN nivel_acesso ON cod_submenu = codSubmenu WHERE cod_perfil = 1 and marcado = 1 ORDER BY RAND() LIMIT 12");
        while ($resultadoAcessoRapido = mysqli_fetch_assoc($buscaSubmenu)) {
            ?>


                           <div class="col-lg-2 col-md-2 col-6">
                               <a href="<?php echo $resultadoAcessoRapido['caminho']; ?>" class="link-rapido">
                                   <div class="card mb-2 border-0" style="border-radius:15px;">
  <div class="card-body text-center card-acesso-rapido p-1">
      <h5><i class="<?php echo $resultadoAcessoRapido['icone_sub']; ?>"></i></h5>
      <h6><?php echo substr($resultadoAcessoRapido['submenu'], 0, 18); ?></h6>
  </div>
</div>
                               </a>
                           </div>
                                       <?php
        }
                           ?>
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
<script>
$(".nav .nav-link").on("click", function(){
   $(".nav").find(".menu-ativo").removeClass("menu-ativo");
   $(this).addClass("menu-ativo");
});
</script>
    </body>
</html>
