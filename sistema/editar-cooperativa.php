<?php
require_once '../config/sessao.php';
require_once '../config/conexao.php';
require_once '../config/config_geral.php';

$cooperativa = $_GET['id'];

$sqlBuscaInfo = mysqli_query($conexao, "SELECT * FROM cooperativas WHERE cod_coop = '$cooperativa'");
$resultadoBuscaInfo = mysqli_fetch_assoc($sqlBuscaInfo);
?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <title>Edição Cooperativa</title>
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
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="../js/mask.js"></script>
    <script src="../js/busca-cep.js"></script>
    <script src="../js/loading.js"></script>
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
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-1 pb-1 mb-1 border-bottom">
              <div class="breadcrumb mb-2 mb-md-0" style="--bs-breadcrumb-divider: '>'; font-size: 16px;">
                                <span class="breadcrumb-item text-primary">Cadastro</span>
                                <span class="breadcrumb-item text-primary">Cooperativas</span>
                                <span class="breadcrumb-item active text-success"><?php echo ucfirst($resultadoBuscaInfo["cooperativa"]); ?></span>
                            </div>
              <div class="btn-toolbar mb-2 mb-md-0">
                <div class="mr-2">
                  <a class="btn btn-sm btn-warning" href="cad-cooperativas.php"><i class="uil uil-angle-left"></i>Voltar</a>
                </div>
              </div>
            </div>
            <form action="../ferramentas/edita-cooperativa.php" method="POST">
              <div class="row">
                <div class="col-lg-4 col-md-4 col-12 mb-3">
                  <div class="card" style="border-radius: 15px; height: 100%;">
                    <div class="card-body text-center">
                      <img itle="Foto Perfil" src="../img/foto_perfil/cooperativas/<?php echo "logo_fncc.png"; ?>" alt="foto perfil"
                           class="rounded-circle img-fluid bg-light" style="width: 165px;">
                      <h5 class="my-3">
                        <button title="<?php
                        if ($resultadoBuscaInfo["coop_status"] == 1) {
                            echo "Ativo";
                        } else {
                            echo "Inativo";
                        }
                        ?>" class="btn btn-outline-<?php
                                if ($resultadoBuscaInfo["coop_status"] == 1) {
                                    echo "success";
                                } else {
                                    echo "danger";
                                }
                                ?> position-relative">
                                <?php echo ucfirst($resultadoBuscaInfo["cooperativa"]); ?>
                          <span class="position-absolute top-0 start-100 translate-middle p-2 bg-<?php
                          if ($resultadoBuscaInfo["coop_status"] == 1) {
                              echo "success";
                          } else {
                              echo "danger";
                          }
                          ?> border border-light rounded-circle">
                            <span class="visually-hidden">Situação da Cooperativa</span>
                          </span>
                        </button>
                      </h5>
                      <p class="text-muted mb-1"><?php echo strtoupper(strtolower($resultadoBuscaInfo["coop_razao"])); ?></p>
                      <p class="text-muted mb-4"><?php echo "<span class='destaque'>CNPJ:</span> " . $resultadoBuscaInfo["coop_cnpj"]."<br>"."<span class='destaque'>Matrícula:</span> " . $resultadoBuscaInfo["coop_matricula"]; ?></p>
                    </div>
                  </div>
                </div>
                <div class="col-lg-8 col-md-8 col-12 mb-3">
                  <div class="card" style="border-radius: 15px; height: 100%;">
                    <div class="card-body">
                      <div class="row">
                        <div class="col-lg-12 col-md-12 col-12">
                          <div class="form-floating mb-3">
                            <input type="hidden" name="cooperativaid" value="<?php echo $cooperativa; ?>">
                            <input type="text" name="coop_razao" class="form-control" id="coop_razao" placeholder="Razão Social" value="<?php
                            echo strtoupper(strtolower($resultadoBuscaInfo["coop_razao"]));
                            ?>">
                            <label for="coop_razao">Razão Social</label>
                          </div>  
                        </div>                 
                        <div class="col-lg-5 col-md-5 col-12">
                          <div class="form-floating mb-3">
                            <input type="text" name="coop_fantasia" class="form-control" id="coop_fantasia" placeholder="Nome Fantasia" value="<?php echo $resultadoBuscaInfo["cooperativa"]; ?>">
                            <label for="coop_fantasia">Nome Fantasia</label>
                          </div>  
                        </div>
                        <div class="col-lg-4 col-md-4 col-12">
                          <div class="form-floating mb-3">
                            <input type="text" name="coop_categoria" class="form-control" id="coop_categoria" placeholder="Categoria" value="<?php echo $resultadoBuscaInfo["coop_categoria"]; ?>">
                            <label for="coop_categoria">Categoria</label>
                          </div>  
                        </div>
                        <div class="col-lg-3 col-md-3 col-12">
                          <div class="form-floating mb-3">
                            <input type="text" name="coop_sistema" class="form-control" id="coop_sistema" placeholder="Sistema" value="<?php echo $resultadoBuscaInfo["coop_sistema"]; ?>">
                            <label for="coop_sistema">Sistema</label>
                          </div>  
                        </div>
                        <div class="col-lg-4 col-md-4 col-12">
                          <div class="form-floating mb-3">
                            <input type="tel" name="coop_cnpj" class="form-control cnpj" id="coop_cnpj" placeholder="CNPJ" value="<?php echo $resultadoBuscaInfo["coop_cnpj"]; ?>" autocomplete="off">
                            <label for="coop_cnpj">CNPJ</label>
                          </div>  
                        </div>
                        <div class="col-lg-4 col-md-4 col-12">
                          <div class="form-floating mb-3">
                            <input type="tel" name="coop_im" class="form-control im" id="coop_im" placeholder="Inscrição Municipal" value="<?php echo $resultadoBuscaInfo["coop_im"]; ?>" autocomplete="off">
                            <label for="coop_im">Inscrição Municipal</label>
                          </div>  
                        </div>
                        <div class="col-lg-4 col-md-4 col-12">
                          <div class="form-floating mb-3">
                            <input type="text" name="coop_nire" class="form-control" id="coop_nire" placeholder="NIRE" value="<?php echo $resultadoBuscaInfo["coop_nire"]; ?>">
                            <label for="coop_nire">NIRE</label>
                          </div>  
                        </div>
                        <div class="col-lg-3 col-md-3 col-12">
                          <div class="form-floating mb-3">
                            <input type="tel" name="coop_cep" class="form-control cep" id="cep" placeholder="CEP" value="<?php echo $resultadoBuscaInfo["coop_cep"]; ?>" onchange="pesquisacep(cep.value)" autocomplete="off">
                            <label for="coop_cep">CEP</label>
                          </div>  
                        </div>
                        <div class="col-lg-7 col-md-7 col-12">
                          <div class="form-floating mb-3">
                            <input type="text" name="coop_endereco" class="form-control" id="endereco" placeholder="Endereço" value="<?php echo $resultadoBuscaInfo["coop_endereco"]; ?>">
                            <label for="coop_endereco">Endereço</label>
                          </div>  
                        </div>
                        <div class="col-lg-2 col-md-2 col-12">
                          <div class="form-floating mb-3">
                            <input type="tel" name="coop_numero_casa" class="form-control" id="coop_numero_casa" placeholder="Número" value="<?php echo $resultadoBuscaInfo["coop_numero_casa"]; ?>" maxlength="6" autocomplete="off">
                            <label for="coop_numero_casa">Número</label>
                          </div>  
                        </div>
                        <div class="col-lg-3 col-md-3 col-12">
                          <div class="form-floating mb-3">
                            <input type="text" name="coop_complemento" class="form-control" id="coop_complemento" placeholder="Complemento" value="<?php echo $resultadoBuscaInfo["coop_complemento"]; ?>" autocomplete="off">
                            <label for="coop_complemento">Complemento</label>
                          </div>  
                        </div>

                        <div class="col-lg-3 col-md-3 col-12">
                          <div class="form-floating mb-3">
                            <input type="text" name="coop_bairro" class="form-control" id="bairro" placeholder="Bairro" value="<?php echo $resultadoBuscaInfo["coop_bairro"]; ?>">
                            <label for="coop_bairro">Bairro</label>
                          </div>  
                        </div>
                        <div class="col-lg-4 col-md-4 col-12">
                          <div class="form-floating mb-3">
                            <input type="text" name="coop_cidade" class="form-control" id="cidade" placeholder="Cidade" value="<?php echo $resultadoBuscaInfo["coop_cidade"]; ?>" readonly>
                            <label for="coop_cidade">Cidade</label>
                          </div>  
                        </div>
                        <div class="col-lg-2 col-md-2 col-12">
                          <div class="form-floating mb-3">
                            <input type="text" name="coop_estado" class="form-control" id="estado" placeholder="Estado" value="<?php echo $resultadoBuscaInfo["coop_estado"]; ?>" readonly>
                            <label for="coop_estado">Estado</label>
                          </div>  
                        </div>
                      </div>
                    </div>

                  </div>
                </div>
                <div class="col-lg-12 col-md-12 col-12">
                  <div class="accordion" id="accordionExample">
                    <div class="accordion-item">
                      <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                          <span class="fw-bold">Contato</span>
                        </button>
                      </h2>
                      <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne">
                        <div class="accordion-body">
                          <div class="row">
                            <div class="col-lg-4 col-md-4 col-12">
                              <div class="form-floating mb-3">
                                <input type="tel" name="coop_telefone" class="form-control phone" id="coop_telefone" placeholder="Telefone" value="<?php echo $resultadoBuscaInfo["coop_telefone"]; ?>">
                                <label for="coop_telefone">Telefone</label>
                              </div>  
                            </div>
                            <div class="col-lg-4 col-md-4 col-12">
                              <div class="form-floating mb-3">
                                <input type="tel" name="coop_whatsapp" class="form-control phone_with_ddd" id="coop_whatsapp" placeholder="Whatsapp" value="<?php echo $resultadoBuscaInfo["coop_whatsapp"]; ?>">
                                <label for="coop_whatsapp">Whatsapp</label>
                              </div>  
                            </div>
                            <div class="col-lg-4 col-md-4 col-12">
                              <div class="form-floating mb-3">
                                <input type="email" name="coop_email" class="form-control" id="coop_email" placeholder="E-mail" value="<?php echo $resultadoBuscaInfo["coop_email"]; ?>">
                                <label for="coop_email">E-mail</label>
                              </div>  
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="accordion-item">
                      <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                          <span class="fw-bold">Diretoria / Conselho Administração</span>
                        </button>
                      </h2>
                      <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo">
                        <div class="accordion-body">
                          <div class="row">
                            <div class="col-12">
                              <button type="button" id="btn-dca" class="float-end btn btn-sm btn-outline-success p-1"><i class="uil uil-plus"></i> Adicionar</button>
                            </div>
                          </div>
                          <div id="dcaadicionais" class="mb-2">
                          </div>
                          <?php
                          $buscaDCA = mysqli_query($conexao, "SELECT * FROM diretoria_conselhoadm WHERE dca_coop = $cooperativa");
                          if (mysqli_num_rows($buscaDCA) > 0) {
                              while ($resultadoDCA = mysqli_fetch_assoc($buscaDCA)) {
                                  ?>
                                  <div class="row mt-2 mb-3">
                                    <div class="col-lg-4 col-md-4 col-12">
                                      <input type="hidden" name="dca_id[]" value="<?php echo $resultadoDCA["dca_id"]; ?>">
                                      <input type="hidden" name="dca_coop[]" value="<?php echo $cooperativa; ?>">
                                      <div class="form-floating mb-3">
                                        <input type="text" name="dca_nome[]" class="form-control" id="dca_nome" placeholder="Nome" value="<?php echo $resultadoDCA["dca_nome"]; ?>">
                                        <label for="dca_nome">Nome</label>
                                      </div>  
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-12">
                                      <div class="form-floating mb-3">
                                        <input type="text" name="dca_cargo[]" class="form-control" id="dca_cargo" placeholder="Cargo" value="<?php echo $resultadoDCA["dca_cargo"]; ?>">
                                        <label for="dca_cargo">Cargo</label>
                                      </div>  
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-12">
                                      <div class="form-floating mb-3">
                                        <input type="date" name="dca_mandato[]" class="form-control" id="dca_mandato" placeholder="Mandato" value="<?php echo $resultadoDCA["dca_mandato"]; ?>">
                                        <label for="dca_mandato">Mandato</label>
                                      </div>  
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-12">
                                      <div class="form-floating mb-3">
                                        <input type="tel" name="dca_telefone[]" class="form-control phone_with_ddd" id="dca_telefone" placeholder="Celular" value="<?php echo $resultadoDCA["dca_telefone"]; ?>">
                                        <label for="dca_telefone">Celular</label>
                                      </div>  
                                    </div>
                                    <div class="col-lg-7 col-md-7 col-12">
                                      <div class="form-floating mb-3">
                                        <input type="email" name="dca_email[]" class="form-control" id="dca_email" placeholder="E-mail" value="<?php echo $resultadoDCA["dca_email"]; ?>">
                                        <label for="dca_email">E-mail</label>
                                      </div>  
                                    </div>
                                    <div class="col-lg-1 col-md-1 col-12 g-2 align-items-center">
                                      <a href="../ferramentas/deleta_dcacfcol.php?dca=<?php echo $resultadoDCA["dca_id"]; ?>&id=<?php echo $cooperativa; ?>" class="btn btn-md btn-danger" data-confirm="Tem certeza de que deseja excluir o item selecionado?"><i class="uil uil-trash-alt"></i></a>
                                    </div>
                                  </div>
                                  <?php
                              }
                          }
                          ?>
                        </div>
                      </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                          <span class="fw-bold"> Conselho Fiscal </span>
                        </button>
                      </h2>

                      <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree">
                        <div class="accordion-body">
                          <div class="row">
                            <div class="col-12">
                              <button type="button" id="btn-cf" class="float-end btn btn-sm btn-outline-success p-1"><i class="uil uil-plus"></i> Adicionar</button>
                            </div>
                          </div>
                          <div id="cfadicionais" class="mb-2">
                          </div>

                          <?php
                          $buscaCF = mysqli_query($conexao, "SELECT * FROM conselho_fiscal WHERE cf_coop = $cooperativa");
                          if (mysqli_num_rows($buscaCF) > 0) {
                              while ($resultadoCF = mysqli_fetch_assoc($buscaCF)) {
                                  ?>
                                  <div class="row mt-2 mb-2">
                                    <div class="col-lg-4 col-md-4 col-12">
                                      <div class="form-floating mb-3">
                                        <input type="hidden" name="cf_id[]" value="<?php echo $resultadoCF["cf_id"]; ?>">
                                        <input type="hidden" name="cf_coop[]" value="<?php echo $cooperativa; ?>">
                                        <input type="text" name="cf_nome[]" class="form-control" id="cf_nome" placeholder="Nome" value="<?php echo $resultadoCF["cf_nome"]; ?>">
                                        <label for="cf_nome">Nome</label>
                                      </div>  
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-12">
                                      <div class="form-floating mb-3">
                                        <input type="text" name="cf_cargo[]" class="form-control" id="cf_cargo" placeholder="Cargo" value="<?php echo $resultadoCF["cf_cargo"]; ?>">
                                        <label for="cf_cargo">Cargo</label>
                                      </div>  
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-12">
                                      <div class="form-floating mb-3">
                                        <input type="date" name="cf_mandato[]" class="form-control" id="cf_mandato" placeholder="Mandato" value="<?php echo $resultadoCF["cf_mandato"]; ?>">
                                        <label for="cf_mandato">Mandato</label>
                                      </div>  
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-12">
                                      <div class="form-floating mb-3">
                                        <input type="tel" name="cf_telefone[]" class="form-control phone_with_ddd" placeholder="Celular" value="<?php echo $resultadoCF["cf_telefone"]; ?>">
                                        <label for="cf_telefone">Celular</label>
                                      </div>  
                                    </div>
                                    <div class="col-lg-7 col-md-7 col-12">
                                      <div class="form-floating mb-3">
                                        <input type="email" name="cf_email[]" class="form-control" placeholder="E-mail" value="<?php echo $resultadoCF["cf_email"]; ?>">
                                        <label for="cf_email">E-mail</label>
                                      </div>  
                                    </div>
                                    <div class="col-lg-1 col-md-1 col-12 g-2 align-items-center">
                                      <a href="../ferramentas/deleta_dcacfcol.php?cf=<?php echo $resultadoCF["cf_id"]; ?>&id=<?php echo $cooperativa; ?>" class="btn btn-md btn-danger" data-confirm="Tem certeza de que deseja excluir o item selecionado?"><i class="uil uil-trash-alt"></i></a>
                                    </div>
                                  </div>
                                  <?php
                              }
                          }
                          ?>
                        </div>
                      </div>
                    </div>
                    <div class="accordion-item">
                      <h2 class="accordion-header" id="headingFor">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFor" aria-expanded="false" aria-controls="collapseFor">
                          <span class="fw-bold"> Colaboradores </span>
                        </button>
                      </h2>
                      <div id="collapseFor" class="accordion-collapse collapse" aria-labelledby="headingFor">
                        <div class="accordion-body">
                          <div class="row">
                            <div class="col-12">
                              <button type="button" id="btn-col" class="float-end btn btn-sm btn-outline-success p-1"><i class="uil uil-plus"></i> Adicionar</button>
                            </div>
                          </div>
                          <div id="coladicionais">
                          </div>
                          <?php
                          $buscaCOL = mysqli_query($conexao, "SELECT * FROM colaboradores_coop WHERE col_coop = $cooperativa");
                          if (mysqli_num_rows($buscaCOL) > 0) {
                              while ($resultadoCOL = mysqli_fetch_assoc($buscaCOL)) {
                                  ?>
                                  <div class="row mt-2 mb-3">
                                    <div class="col-lg-4 col-md-4 col-12">
                                      <div class="form-floating mb-3">
                                        <input type="hidden" name="cod_col[]" value="<?php echo $resultadoCOL["cod_col"]; ?>">
                                        <input type="hidden" name="col_coop[]" value="<?php echo $resultadoCOL["col_coop"]; ?>">
                                        <input type="text" name="col_nome[]" class="form-control" placeholder="Nome" value="<?php echo $resultadoCOL["col_nome"]; ?>">
                                        <label for="col_nome">Nome Colaborador</label>
                                      </div>  
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-12">
                                      <div class="form-floating mb-3">
                                        <input type="text" name="col_area[]" class="form-control" placeholder="Área" value="<?php echo $resultadoCOL["col_area"]; ?>">
                                        <label for="col_area">Área</label>
                                      </div>  
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-12">
                                      <div class="form-floating mb-3">
                                        <input type="email" name="col_email[]" class="form-control" placeholder="E-mail" value="<?php echo $resultadoCOL["col_email"]; ?>">
                                        <label for="col_email">E-mail</label>
                                      </div>  
                                    </div>
                                    <div class="col-lg-1 col-md-1 col-12 g-2 align-items-center">
                                      <a href="../ferramentas/deleta_dcacfcol.php?col=<?php echo $resultadoCOL["cod_col"]; ?>&id=<?php echo $cooperativa; ?>" class="btn btn-md btn-danger" data-confirm="Tem certeza de que deseja excluir o item selecionado?"><i class="uil uil-trash-alt"></i></a>
                                    </div>
                                  </div>
                                  <?php
                              }
                          }
                          ?>
                        </div>
                      </div>
                    </div>
                  </div>  

                </div>
                <div class="col-md-12 col-lg-12 col-12">
                  <button type="submit" class="btn btn-md btn-success mb-3"><i class="uil uil-sync"></i> Atualizar Dados</button>
                </div>
            </form>
          </div>


          <?php
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
                    <span> Dados atualizados com sucesso!</span>
                </div>
            </div>
        </div>';
          }
          ?>
          <!--fim conteudo da tela aqui!-->
      </div>
    </main>
    <?php include_once "../ferramentas/rodape.php"; ?>
  </div>


</div>
<script>
    $('.pesquisa-select').select2({
        theme: 'bootstrap-5'
    });
</script>  
<script>
    window.onload = (event) => {
        var toastLiveExample = document.getElementById('liveToast')
        var toast = new bootstrap.Toast(toastLiveExample)
        toast.show()
    }
</script>
<script>
var cont = 1;
        $('#btn-dca').click(function () {
cont++;
        $('#dcaadicionais').append('<div class="row mt-2" id="dcaAdd' + cont + '"> <div class="col-lg-4 col-md-4 col-12"> <div class="form-floating mb-3"> <input type="hidden" name="dcaCoopN[]" value="<?php echo $cooperativa; ?>"> <input type="text" name="dca_nomeN[]" class="form-control" placeholder="Nome"> <label for="dca_nome">Nome</label> </div></div><div class="col-lg-4 col-md-4 col-12"> <div class="form-floating mb-3"> <input type="text" name="dca_cargoN[]" class="form-control" placeholder="Cargo"> <label for="dca_cargo">Cargo</label> </div></div><div class="col-lg-4 col-md-4 col-12"> <div class="form-floating mb-3"> <input type="date" name="dca_mandatoN[]" class="form-control" placeholder="Mandato"> <label for="dca_mandato">Mandato</label> </div></div><div class="col-lg-4 col-md-4 col-12"> <div class="form-floating mb-3"> <input type="tel" class="form-control maskcel" name="dca_telefoneN[]" placeholder="Celular" data-mask="(00) 0 0000-0000"> <label for="dca_telefone">Celular</label> </div></div><div class="col-lg-7 col-md-7 col-12"> <div class="form-floating mb-3"> <input type="email" name="dca_emailN[]" class="form-control" placeholder="E-mail"> <label for="dca_email">E-mail</label> </div></div><div class="col-lg-1 col-md-1 col-12 g-2 align-items-center"><button type="button" id="' + cont + '" class="btn btn-danger btn-md btn-apagar"><i class="uil uil-minus-square"></i></button></div></div>');
});
        $('form').on('click', '.btn-apagar', function () {
var button_id = $(this).attr("id");
        $('#dcaAdd' + button_id + '').remove();
});
</script>
<script>
var cont = 1;
        $('#btn-cf').click(function () {
cont++;
        $('#cfadicionais').append('<div class="row mt-2" id="cfAdd' + cont + '"> <div class="col-lg-4 col-md-4 col-12"> <div class="form-floating mb-3"> <input type="hidden" name="cfCoopN[]" value="<?php echo $cooperativa; ?>"> <input type="text" name="cf_nomeN[]" class="form-control" placeholder="Nome"> <label for="cf_nome">Nome</label> </div></div><div class="col-lg-4 col-md-4 col-12"> <div class="form-floating mb-3"> <input type="text" name="cf_cargoN[]" class="form-control" placeholder="Cargo"> <label for="cf_cargo">Cargo</label> </div></div><div class="col-lg-4 col-md-4 col-12"> <div class="form-floating mb-3"> <input type="date" name="cf_mandatoN[]" class="form-control" placeholder="Mandato"> <label for="cf_mandato">Mandato</label> </div></div><div class="col-lg-4 col-md-4 col-12"> <div class="form-floating mb-3"> <input type="tel" name="cf_telefoneN[]" class="form-control maskcel" placeholder="Celular" data-mask="(00) 0 0000-0000"> <label for="cf_telefone">Celular</label> </div></div><div class="col-lg-7 col-md-7 col-12"> <div class="form-floating mb-3"> <input type="email" name="cf_emailN[]" class="form-control" placeholder="E-mail"> <label for="cf_email">E-mail</label> </div></div><div class="col-lg-1 col-md-1 col-12 g-2 align-items-center"><button type="button" id="' + cont + '" class="btn btn-danger btn-md btn-apagar"><i class="uil uil-minus-square"></i></button></div></div>');
});
        $('form').on('click', '.btn-apagar', function () {
var button_id = $(this).attr("id");
        $('#cfAdd' + button_id + '').remove();
});
</script>
<script>
var cont = 1;
        $('#btn-col').click(function () {
cont++;
        $('#coladicionais').append('<div class="row mt-2" id="colAdd' + cont + '"> <div class="col-lg-4 col-md-4 col-12"> <div class="form-floating mb-3"> <input type="hidden" name="colCoopN[]" value="<?php echo $cooperativa; ?>"> <input type="text" name="col_nomeN[]" class="form-control" placeholder="Nome"> <label for="col_nome">Nome Colaborador</label> </div></div><div class="col-lg-3 col-md-3 col-12"> <div class="form-floating mb-3"> <input type="text" name="col_areaN[]" class="form-control" placeholder="Área"> <label for="col_area">Área</label> </div></div><div class="col-lg-4 col-md-4 col-12"> <div class="form-floating mb-3"> <input type="email" name="col_emailN[]" class="form-control" placeholder="E-mail"> <label for="col_email">E-mail</label> </div></div><div class="col-lg-1 col-md-1 col-12 g-2 align-items-center"><button type="button" id="' + cont + '" class="btn btn-danger btn-md btn-apagar"><i class="uil uil-minus-square"></i></button> </div></div>');
});
        $('form').on('click', '.btn-apagar', function () {
var button_id = $(this).attr("id");
        $('#colAdd' + button_id + '').remove();
});
</script>
<script src="../js/toast.js"></script>
<script src="../js/campos_adicionais.js"></script>
<script src="../js/cp_mascaras.js"></script>
<script src="../js/scripts.js"></script>
<script src="../js/desativar.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script> 

<script>
    $(document).on("focus", ".maskcel", function () {
        $(this).mask('00 0 0000-0000', {reverse: true});
    });
</script>
<script>
$(".nav .nav-link").on("click", function(){
   $(".nav").find(".menu-ativo").removeClass("menu-ativo");
   $(this).addClass("menu-ativo");
});
</script>
</body>
</html>
