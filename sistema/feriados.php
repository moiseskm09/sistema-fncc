<?php 
require_once '../config/sessao.php';
require_once '../config/conexao.php';
require_once '../config/config_geral.php';


$buscaferiados = mysqli_query($conexao, "SELECT * FROM feriados");
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
        <title>Feriados</title>
        <link rel="icon" type="image/png" sizes="512x512" href="../img/fncc-logotipo-colorido.png">
        <link rel="icon" type="image/png" sizes="48x48" href="../img/fncc-logotipo-colorido.png">
        <link rel="icon" type="image/png" sizes="32x32" href="../img/fncc-logotipo-colorido.png">
        <link href="../css/menu.css" rel="stylesheet" />
        <link rel="manifest" href="../manifest.json">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
       <script src="https://code.jquery.com/jquery-3.6.2.min.js" integrity="sha256-2krYZKh//PcchRtd+H+VyyQoZ/e3EcrkxhM8ycwASPA=" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://unicons.iconscout.com/release/v3.0.6/css/line.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
<!-- Styles -->
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
        <style>
            </style>
    </head>
    <body class="sb-nav-fixed fundo_tela">
       <?php include_once "../ferramentas/navbar.php";?>
        <div id="layoutSidenav">
            <?php include_once "../ferramentas/menu.php";?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <!-- header -->
                        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-2 pb-2 mb-2 border-bottom">
                            <div class="breadcrumb mb-2 mb-md-0" style="--bs-breadcrumb-divider: '>'; font-size: 16px;">
                                <span class="breadcrumb-item text-primary">Configurações</span>
                                <span class="breadcrumb-item active text-success">Feriados</span>
                            </div>
                            <div class="btn-toolbar mb-2 mb-md-0">
                                <div class="mr-2">
                                    <a class="btn btn-sm btn-success mb-1" href="#addFeriado" data-toggle="modal" data-target="#addFeriado"><i class="uil uil-plus"></i> Adicionar Feriado</a>
                                    <a class="btn btn-sm btn-warning mb-1" onClick="history.go(-1)"><i class="uil uil-angle-left"></i> Voltar</a>
                                </div>
                            </div>
                        </div>
                        <!-- fim header -->
                       <!--conteudo da tela aqui!-->
                       <div class="row">
                           <div class="col-12">
                                       <?php if(mysqli_num_rows($buscaferiados) > 0 ){ 
                                           while($resultadoFeriado = mysqli_fetch_assoc($buscaferiados)){
                                           ?>
                                <div class="list-group mb-2">
  <a type="button" href="#feriado<?php echo strftime('%d%b%Y', strtotime($resultadoFeriado["data"]));?>" data-toggle="modal" data-target="#feriado<?php echo strftime('%d%b%Y', strtotime($resultadoFeriado["data"]));?>" class="list-group-item list-group-item-action">
   <i class="bi bi-link-45deg link-feriado"></i>
      <div class="d-flex w-100 justify-content-between">
      <h5 class="mb-1 destaque"><?php echo $resultadoFeriado["feriado"];?></h5>
      <small class="fw-bold text-primary"><?php echo ucwords(strftime('%d - %b', strtotime($resultadoFeriado["data"]))); ?></small>
    </div>
    <p class="mb-1 cor-primaria"><?php echo $resultadoFeriado["tipo_feriado"];?></p>
    <div class="d-flex w-100 justify-content-between">
        <small class="fw-bold text-muted"><?php if ($resultadoFeriado["facultativo"] == 0){ echo "Obrigatório"; }else{ echo "Opcional";} ?></small>
        
    </div>
    
  </a>
<small title="Excluir Feriado - <?php echo $resultadoFeriado["feriado"];?>" class="fw-bold text-danger">
            <a href="../ferramentas/deleta-feriado.php?cod_feriado=<?php echo $resultadoFeriado["cod_feriado"]; ?>" desativar-confirm="Tem certeza de que deseja o item selecionado?" class="botao-excluir-feriado btn btn-sm btn-outline-danger"><i class="bi bi-trash3"></i></a>
        </small>
</div>     
                               <!-- Modal Feriado -->
<div class="modal fade" id="feriado<?php echo strftime('%d%b%Y', strtotime($resultadoFeriado["data"]));?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header header-filtro">
                    <h5 class="modal-title" id="exampleModalLabel"><?php echo $resultadoFeriado["feriado"];?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body card-fundo-body">
                    <form action="../ferramentas/atualiza-feriado.php" method="POST">
                      <div class="row">
                          <input type="hidden" name="cod_feriado" value="<?php echo $resultadoFeriado["cod_feriado"]; ?>">
                          <div class="col-lg-12 col-md-12 col-12">
                                                    <div class="form-floating mb-3">
                                                        <input type="date" name="dataRefIncial" id="dataRefIncial" value="<?php echo $resultadoFeriado["data"]; ?>" class="form-control" placeholder="Insira a data ref inicial" autocomplete="off" required>
                                                        <label for="dataRefIncial">Data<span class="text-danger">*</span></label>
                                                    </div>  
                                                </div>
                          
                          <div class="col-lg-12 col-md-12 col-12">
                          <div class="form-floating mb-3">
                            <input type="text" name="nomeFeriado" id="nomeFeriado" value="<?php echo $resultadoFeriado["feriado"]; ?>" class="form-control" placeholder="Feriado" autocomplete="off" required>
                            <label for="nome">Feriado</label>
                          </div>  
                        </div>
                          <div class="col-lg-12 col-md-12 col-12">
    <div class="form-floating mb-3">
      <select class="form-select pesquisa-select" name="tipoFeriado" required>
            <option value="<?php echo $resultadoFeriado["tipo_feriado"];?>"> - <?php echo $resultadoFeriado["tipo_feriado"];?> - </option>
            <option value="Feriado Nacional">Feriado Nacional</option>
            <option value="Feriado Estadual">Feriado Estadual</option>
            <option value="Feriado Municipal">Feriado Municipal</option>
            <option value="Feriado Facultativo">Feriado Facultativo</option>
      </select>
      <label for="tipoFeriado">Tipo de Feriado</label>
    </div>
  </div>
                      </div>
                      <div class="modal-footer card-fundo-body p-0 border-0">
                        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="uil uil-times"></i> Fechar</button>
                        <button type="submit" class="btn btn-success loading btn-sm"><i class="bi bi-arrow-clockwise"></i> Atualizar Feriado</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
</div>
                               <!-- Modal Feriado -->
                                           <?php } }else{
                                           echo '<div class="text-center">Não há dados para exibir!</div>';
                                       }
?>

                               
                              
                           </div>
                       </div>
                       
                       <!-- Modal Adiciona Feriado -->
<div class="modal fade" id="addFeriado" tabindex="-1" role="dialog" aria-labelledby="addFeriado" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header header-filtro">
                    <h5 class="modal-title" id="exampleModalLabel">Adicionar Feriado</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body card-fundo-body">
                    <form action="../ferramentas/adiciona-feriado.php" method="POST">
                      <div class="row">
                          <div class="col-lg-12 col-md-12 col-12">
                                                    <div class="form-floating mb-3">
                                                        <input type="date" name="data" id="data" class="form-control" placeholder="Insira a data" autocomplete="off" required>
                                                        <label for="data">Data<span class="text-danger">*</span></label>
                                                    </div>  
                                                </div>
                          
                          <div class="col-lg-12 col-md-12 col-12">
                          <div class="form-floating mb-3">
                            <input type="text" name="feriado" id="feriado" class="form-control" placeholder="Feriado" autocomplete="off" required>
                            <label for="feriado">Feriado</label>
                          </div>  
                        </div>
                          <div class="col-lg-12 col-md-12 col-12">
    <div class="form-floating mb-3">
      <select class="form-select pesquisa-select" name="feriadoTipo" required>
            <option value=""> - Selecione - </option>
            <option value="Feriado Nacional">Feriado Nacional</option>
            <option value="Feriado Estadual">Feriado Estadual</option>
            <option value="Feriado Municipal">Feriado Municipal</option>
            <option value="Feriado Facultativo">Feriado Facultativo</option>
      </select>
      <label for="feriadoTipo">Tipo de Feriado</label>
    </div>
  </div>
                      </div>
                      <div class="modal-footer card-fundo-body p-0 border-0">
                          <button type="submit" class="btn btn-success loading btn-sm"><i class="bi bi-plus"></i> Adicionar Feriado</button>
                        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="uil uil-times"></i> Fechar</button>
                  </div>
                        </form>
                </div>
              </div>
            </div>
</div>
                               <!-- Modal Adiciona Feriado -->
                               
                               <?php
                   if (isset($_GET["sucesso"])) {
                            $sucesso = (int) $_GET["sucesso"];
            if($sucesso === 1){
            echo '<div class="toast-container position-fixed bottom-0 end-0 p-3 ">
            <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="4000">
                <div class="toast-header border-light" style="background-color: #a3cfbb; color: #1c1d3c;">
                    <strong class="me-auto">FNCC AVISA</strong>
                    <small>Agora</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body" style="background-color: #a3cfbb; color: #1c1d3c;"">
                    <span>Atualizado!</span>
                </div>
            </div>
        </div>';
            }elseif($sucesso === 2){
            echo '<div class="toast-container position-fixed bottom-0 end-0 p-3 ">
            <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="4000">
                <div class="toast-header border-light" style="background-color: #a3cfbb; color: #1c1d3c;">
                    <strong class="me-auto">FNCC AVISA</strong>
                    <small>Agora</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body" style="background-color: #a3cfbb; color: #1c1d3c;"">
                    <span>Feriado inserido!</span>
                </div>
            </div>
        </div>';
            }elseif($sucesso === 3){
            echo '<div class="toast-container position-fixed bottom-0 end-0 p-3 ">
            <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="4000">
                <div class="toast-header border-light" style="background-color: #a3cfbb; color: #1c1d3c;">
                    <strong class="me-auto">FNCC AVISA</strong>
                    <small>Agora</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body" style="background-color: #a3cfbb; color: #1c1d3c;"">
                    <span>Feriado Excluído!</span>
                </div>
            </div>
        </div>';
            }
                        }
                        if (isset($_GET["erro"])) {
                            $erro = (int) $_GET["erro"];
            if($erro === 1){
             
           echo '<div class="toast-container position-fixed bottom-0 end-0 p-3">
            <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="4000">
                <div class="toast-header border-light" style="background-color: #f5c2c7; color: #1c1d3c;">
                    <strong class="me-auto">FNCC AVISA</strong>
                    <small>Agora</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body" style="background-color: #f5c2c7; color: #1c1d3c;"">
                    <span>Erro ao atualizar! Tente novamente!</span>
                </div>
            </div>
        </div>'; 
        }elseif($erro === 2){
             
           echo '<div class="toast-container position-fixed bottom-0 end-0 p-3">
            <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="4000">
                <div class="toast-header border-light" style="background-color: #f5c2c7; color: #1c1d3c;">
                    <strong class="me-auto">FNCC AVISA</strong>
                    <small>Agora</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body" style="background-color: #f5c2c7; color: #1c1d3c;"">
                    <span>Erro a inserir! Tente novamente!</span>
                </div>
            </div>
        </div>'; 
        }elseif($erro === 3){
             
           echo '<div class="toast-container position-fixed bottom-0 end-0 p-3">
            <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="4000">
                <div class="toast-header border-light" style="background-color: #f5c2c7; color: #1c1d3c;">
                    <strong class="me-auto">FNCC AVISA</strong>
                    <small>Agora</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body" style="background-color: #f5c2c7; color: #1c1d3c;"">
                    <span>Já existe um feriado nessa data!</span>
                </div>
            </div>
        </div>'; 
        }elseif($erro === 4){
             
           echo '<div class="toast-container position-fixed bottom-0 end-0 p-3">
            <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="4000">
                <div class="toast-header border-light" style="background-color: #f5c2c7; color: #1c1d3c;">
                    <strong class="me-auto">FNCC AVISA</strong>
                    <small>Agora</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body" style="background-color: #f5c2c7; color: #1c1d3c;"">
                    <span>Erro ao Excluir!</span>
                </div>
            </div>
        </div>'; 
        }
                        }
                       ?>
                       <!--fim conteudo da tela aqui!-->
                    </div>
                </main>
                <?php include_once "../ferramentas/rodape.php";?>
            </div>
        </div>
        <script>
$( '.pesquisa-select' ).select2( {
    theme: 'bootstrap-5';
} );
        </script>  
<script src="../js/toast.js"></script>
        <script src="../js/campos_adicionais.js"></script>
        <script src="../js/cp_mascaras.js"></script>
        <script src="../js/scripts.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script> 
<script src="../js/boletos.js"></script>
<script src="../js/confirmacao_pag.js"></script>
<script src="../js/desativar.js"></script>
<script>
$(".nav .nav-link").on("click", function(){
   $(".nav").find(".menu-ativo").removeClass("menu-ativo");
   $(this).addClass("menu-ativo");
});
</script>
    </body>
</html>
