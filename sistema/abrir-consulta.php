<?php
require_once '../config/sessao.php';
require_once '../config/conexao.php';
require_once '../config/config_geral.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <title>Abrir Consulta</title>
        <link rel="icon" type="image/png" sizes="512x512" href="../img/fncc-logotipo-colorido.png">
        <link rel="icon" type="image/png" sizes="48x48" href="../img/fncc-logotipo-colorido.png">
        <link rel="icon" type="image/png" sizes="32x32" href="../img/fncc-logotipo-colorido.png">
    <link href="../css/menu.css" rel="stylesheet" />
    <link href="../css/perfis.css" rel="stylesheet" />
    <link rel="manifest" href="../manifest.json">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v3.0.6/css/line.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <script src="https://code.jquery.com/jquery-3.6.2.min.js" integrity="sha256-2krYZKh//PcchRtd+H+VyyQoZ/e3EcrkxhM8ycwASPA=" crossorigin="anonymous"></script>
    <!-- Styles -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    <!-- Or for RTL support -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.rtl.min.css" />

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <link href="../css/style.css" rel="stylesheet" />
  </head>
  <body class="sb-nav-fixed fundo_tela">
      <?php include_once "../ferramentas/navbar.php"; ?>
    <div id="layoutSidenav">
        <?php include_once "../ferramentas/menu.php"; ?>
      <div id="layoutSidenav_content">
        <main>
          <div class="container-fluid">
            <!--conteudo da tela aqui!-->
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-2 pb-2 mb-2 border-bottom">
              <h5 class="titulo">Abrir Consulta</h5>
              <div class="btn-toolbar mb-2 mb-md-0">
                <div class="mr-2">
                  <a class="btn btn-sm btn-warning mb-1" onClick="history.go(-1)"><i class="uil uil-angle-left"></i> Voltar</a>
                  <a class="btn btn-sm botaoAjuda mb-1" href="#ajuda" data-toggle="modal" data-target="#ajuda"><i class="bi bi-info-circle"></i> Ajuda</a>
                </div>
              </div>

            </div>
            <form action="../ferramentas/abrir-consulta.php" method="POST" enctype="multipart/form-data">
            <div class="row">
                
              <div class="col-md-4 mb-2">
                <div class="accordion" id="accordionExample" style="height:100%; max-height: 100%;">
                  <div class="accordion-item" style="height:100%; max-height: 100%;">
                    <h2 class="accordion-header" id="headingOne">
                      <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        <span class="destaque fw-bold">Informações Gerais</span>
                      </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                      <div class="accordion-body">
                          <div class="row">
                              <div class="col-lg-12 col-md-12 col-12">
                                                    <input type="hidden" name="cod_coopUser" id="cod_coopUser" class="form-control" required value="<?php echo $COOPERATIVA; ?>">
                                                    <?php
                                                    $buscaCooperativas = mysqli_query($conexao, "SELECT cooperativa FROM cooperativas WHERE cod_coop = $COOPERATIVA");
                                                    $resultadoCooperativas = mysqli_fetch_assoc($buscaCooperativas);
                                                    ?>
                                                    <div class="form-floating mb-3">
                                                        <input type="text" name="coopUser" id="coopUser" class="form-control" placeholder="coop user" autocomplete="off" required value="<?php echo $resultadoCooperativas['cooperativa'] ?>" readonly>
                                                        <label for="coopUser">Cooperativa <span class="text-danger">*</span></label>
                                                    </div>  
                                                </div>
                              <div class="col-lg-12 col-md-12 col-12">
                                                    <input type="hidden" name="codUser" id="codUser" class="form-control" required value="<?php echo $CODIGOUSUARIO; ?>">
                                                    <div class="form-floating mb-3">
                                                        <input type="text" name="nomeUser" id="nomeUser" class="form-control" placeholder="Nome Usuário" autocomplete="off" required value="<?php echo $NOME; ?>" readonly>
                                                        <label for="nomeUser">Usuário <span class="text-danger">*</span></label>
                                                    </div>  
                                                </div>
                              <div class="col-lg-12 col-md-12 col-12">
    <div class="form-floating mb-3">
      <select class="form-select pesquisa-select" id="areaAtendimento" name="areaAtendimento" required>
        <option selected value="">Selecione uma opção</option>
            <option value="1">Atendimento Administrativo</option>
            <option value="2">Consultoria Técnica</option>
            <option value="3">Consultoria Jurídica</option>
      </select>
      <label for="areaAtendimento">Área de Atendimento <span class="text-danger">*</span></label>
    </div>
  </div>
                              <div class="col-lg-12 col-md-12 col-12">
    <div class="form-floating mb-3">
      <select class="form-select pesquisa-select" id="prioridadeAtend" name="prioridadeAtend" required>
          <option value="alta" class="text-danger fw-bold">Alta</option>
            <option value="media" class="text-warning fw-bold">Média</option>
            <option value="baixa" selected class="text-success fw-bold"> Baixa</option>
      </select>
      <label for="prioridadeAtend">Urgência <span class="text-danger">*</span></label>
    </div>
  </div>
                              <div class="col-lg-8 col-md-8 col-8">
    <div class="form-floating mb-3">
      <select class="form-select pesquisa-select" id="visibilidadeAtend" name="visibilidadeAtend" required>
          <option value="qualquer_um" >Qualquer um</option>
            <option value="minha_coop">Minha Cooperativa</option>
            <option value="eu" selected> Só para mim</option>
      </select>
      <label for="visibilidadeAtend">Visibilidade <span class="text-danger">*</span></label>
    </div>
  </div>
                               <div class="col-lg-4 col-md-4 col-4">
                                   <a title="Sobre a visibilidade" class="btn btn-lg botaoAjuda" href="#infoVisibilidade" data-toggle="modal" data-target="#infoVisibilidade" style="width:100%; height: 58px;"><i class="bi bi-info-circle" style="font-size: 28px;"></i></a>
                               </div>
                          </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-8 mb-2">
                <div class="accordion" id="accordionExample" style="height:100%; max-height: 100%;">
                  <div class="accordion-item" style="height:100%; max-height: 100%;">
                    <h2 class="accordion-header" id="headingOne">
                      <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseDois" aria-expanded="true" aria-controls="collapseDois">
                        <span class="destaque fw-bold">Descrição</span>
                      </button>
                    </h2>
                    <div id="collapseDois" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#collapseDois">
                      <div class="accordion-body" style="max-height: 430px; overflow-y: scroll;">
                          <div class="row">
                <div class="col-lg-12 col-md-12 col-12">
                          <div class="form-floating mb-3">
                              <input type="text" name="assuntoAtend" id="assuntoAtend" class="form-control" placeholder="Assunto da Cosulta" autocomplete="off" maxlength="60" required>
                            <label for="assuntoAtend">Assunto da Consulta <span class="text-danger">*</span></label>
                          </div>  
                        </div>
                              <div class="col-lg-12 col-md-21 col-12">
                  <div class="form-floating mb-3">
                      <textarea class="form-control" name="descricaoAtend" id="descricaoAtend" placeholder="Adicione uma descrição" style="height: 150px" maxlength="1000" required></textarea>
  <label for="descricaoAtend">Descrição da Consulta <span class="text-danger">*</span></label>
</div>  
                </div>
                              <div class="col-lg-12 col-md-12 col-12">
                <div class="form-group atendimentofiles">
                  <input type="file" class="form-control" name="arquivoAtend[]" id="arquivoAtend" multiple>
                </div>
              </div>
                              <div class="col-12 text-end">
                          <button type="submit" class="btn btn-md btn-success loading"><i class="bi bi-plus"></i> Abrir Consulta</button>
                        </div>
            </div>
                      </div>
                    </div>
                  </div>
                </div>     
              </div>
              <?php
              if(isset($_GET["sucesso"])){
                            $sucesso = (int) $_GET["sucesso"];
              if ($sucesso === 1) {
                  echo '<div class="toast-container position-fixed bottom-0 end-0 p-3 ">
            <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="3000">
                <div class="toast-header border-light" style="background-color: #a3cfbb; color: #1c1d3c;">
                    <strong class="me-auto">FNCC AVISA</strong>
                    <small>Agora</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body" style="background-color: #a3cfbb; color: #1c1d3c;"">
                    <span>Consulta Criada!</span>
                </div>
            </div>
        </div>';
              }
              }
              ?>
                   
            </div>
                 </form>
            <!-- Modal -->
            <div class="modal fade" id="infoVisibilidade" tabindex="-1" role="dialog" aria-labelledby="infoVisibilidade" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header bg-warning text-dark p-2">
                    <h5 class="modal-title" id="exampleModalLabel">Sobre a Visibilidade</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body card-fundo-body">
                      <div class="row">
                          <div class="col-12">
                              <h6 class="destaque">Qualquer Um</h6>
                              <p>Consultas marcadas com a visibilidade <code>Qualquer Um</code> serão visíveis para todas as cooperativas e usuários do sistema.</p>
                          </div>
                          <div class="col-12">
                              <h6 class="destaque">Minha Cooperativa</h6>
                              <p>Consultas marcadas com a visibilidade <code>Minha Cooperativa</code> serão visíveis para todos os usuários da sua Cooperativa.</p>
                          </div>
                          <div class="col-12">
                              <h6 class="destaque">Só para mim</h6>
                              <p>Consultas marcadas com a visibilidade <code>Só para mim</code> serão visíveis apenas para você.</p>
                          </div>
                          <div class="col-12 text-end">
                          <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal" aria-label="Fechar"><i class="bi bi-x"></i> Fechar</button>
                        </div>
                      </div>
                  </div>
                </div>
              </div>
            </div>
            
            
            <!-- Modal Ajuda-->
            <div class="modal fade" id="ajuda" tabindex="-1" role="dialog" aria-labelledby="ajuda" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header bg-info text-dark p-2">
                    <h5 class="modal-title" id="exampleModalLabel">Ajuda</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body card-fundo-body">
                      <div class="row">
                          <div class="col-12">
                              <h6 class="destaque">Inclusão de vários arquivos</h6>
                              <p>Para adicionar mais de um arquivo na consulta utilize as teclas <code>CTRL (TECLADO) + CLIQUE DO MOUSE</code> para selecionar ou se preferir selecione com o <code>MOUSE</code> e arraste para o campo.</p>
                          </div>
                          <div class="col-12 text-end">
                          <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal" aria-label="Fechar"><i class="bi bi-x"></i> Fechar</button>
                        </div>
                      </div>
                  </div>
                </div>
              </div>
            </div>
            <?php include_once "../ferramentas/modal_loading.php"; ?>
            <!--fim conteudo da tela aqui!-->
          </div>
        </main>
        <?php include_once "../ferramentas/rodape.php"; ?>
      </div>
    </div>
    <script>
        $('.pesquisa-select').select2({
            theme: 'bootstrap-5';
        });

    </script>  
    <script src="../js/toast.js"></script>
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
<script src="../js/loading.js"></script>
  </body>
</html>
