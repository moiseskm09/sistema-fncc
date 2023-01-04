<?php
require_once '../config/sessao.php';
require_once '../config/conexao.php';
require_once '../config/config_geral.php';

$cooperativa = $_GET['id'];

$sqlBuscaInfo = mysqli_query($conexao, "SELECT * FROM cooperativas INNER JOIN categoria_cooperativa ON coop_categoria = cod_categoria_coop WHERE cod_coop = '$cooperativa'");
$resultadoBuscaInfo = mysqli_fetch_assoc($sqlBuscaInfo);
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
                        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                            <h5 class="titulo">Cooperativa <span class="destaque"> <?php echo ucfirst($resultadoBuscaInfo["cooperativa"]); ?></span></h5>
                            <div class="btn-toolbar mb-2 mb-md-0">
                                <div class="mr-2">
                                    <a class="btn btn-sm btn-warning" onClick="history.go(-1)"><i class="uil uil-angle-left"></i>Voltar</a>
                                </div>
                            </div>
                        </div>
                        <form action="../ferramentas/edita-cooperativa.php" method="POST">
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-12 mb-3">
                                    <div class="card" style="border-radius: 15px; height: 100%;">
                                        <div class="card-body text-center">
                                            <img itle="Foto Perfil" src="../img/foto_perfil/cooperativas/<?php echo $LOGO_COOP; ?>" alt="foto perfil"
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
                                            <p class="text-muted mb-1"><?php echo ucwords(strtolower($resultadoBuscaInfo["coop_razao"])); ?></p>
                                            <p class="text-muted mb-4"><?php echo "<span class='destaque'>CNPJ:</span> " . $resultadoBuscaInfo["coop_cnpj"]; ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-8 col-md-8 col-12 mb-3">
                                    <div class="card" style="border-radius: 15px; height: 100%;">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-lg-12 col-md-12 col-12">
                                                        <div class="form-floating mb-3">
                                                            <input type="text" name="coop_razao" class="form-control" id="coop_razao" placeholder="Razão Social" value="<?php
                                                            echo ucwords(strtolower($resultadoBuscaInfo["coop_razao"]));
                                                            ;
                                                            ?>">
                                                            <label for="coop_razao">Razão Social</label>
                                                        </div>  
                                                    </div>                 
                                                    <div class="col-lg-6 col-md-6 col-12">
                                                        <div class="form-floating mb-3">
                                                            <input type="text" name="coop_fantasia" class="form-control" id="coop_fantasia" placeholder="Nome Fantasia" value="<?php echo $resultadoBuscaInfo["cooperativa"]; ?>">
                                                            <label for="coop_fantasia">Nome Fantasia</label>
                                                        </div>  
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-12">
                                                        <div class="form-floating mb-3">
                                                            <input type="text" name="coop_categoria" class="form-control" id="coop_categoria" placeholder="Categoria" value="<?php echo $resultadoBuscaInfo["categoria_coop"]; ?>" disabled>
                                                            <label for="coop_categoria">Categoria</label>
                                                        </div>  
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-12">
                                                        <div class="form-floating mb-3">
                                                            <input type="text" name="coop_cnpj" class="form-control" id="coop_cnpj" placeholder="CNPJ" value="<?php echo $resultadoBuscaInfo["coop_cnpj"]; ?>">
                                                            <label for="coop_cnpj">CNPJ</label>
                                                        </div>  
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-12">
                                                        <div class="form-floating mb-3">
                                                            <input type="text" name="coop_im" class="form-control" id="coop_im" placeholder="Inscrição Municipal" value="<?php echo $resultadoBuscaInfo["coop_im"]; ?>">
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
                                                            <input type="text" name="coop_cep" class="form-control" id="coop_cep" placeholder="CEP" value="<?php echo $resultadoBuscaInfo["coop_cep"]; ?>">
                                                            <label for="coop_cep">CEP</label>
                                                        </div>  
                                                    </div>
                                                    <div class="col-lg-9 col-md-9 col-12">
                                                        <div class="form-floating mb-3">
                                                            <input type="text" name="coop_endereco" class="form-control" id="coop_endereco" placeholder="Endereço" value="<?php echo $resultadoBuscaInfo["coop_endereco"]; ?>" disabled>
                                                            <label for="coop_endereco">Endereço</label>
                                                        </div>  
                                                    </div>
                                                    <div class="col-lg-2 col-md-2 col-12">
                                                        <div class="form-floating mb-3">
                                                            <input type="text" name="coop_numero_casa" class="form-control" id="coop_numero_casa" placeholder="Número" value="<?php echo $resultadoBuscaInfo["coop_numero_casa"]; ?>">
                                                            <label for="coop_numero_casa">Número</label>
                                                        </div>  
                                                    </div>

                                                    <div class="col-lg-4 col-md-4 col-12">
                                                        <div class="form-floating mb-3">
                                                            <input type="text" name="coop_bairro" class="form-control" id="coop_bairro" placeholder="Bairro" value="<?php echo $resultadoBuscaInfo["coop_bairro"]; ?>" disabled>
                                                            <label for="coop_bairro">Bairro</label>
                                                        </div>  
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-12">
                                                        <div class="form-floating mb-3">
                                                            <input type="text" name="coop_cidade" class="form-control" id="coop_cidade" placeholder="Cidade" value="<?php echo $resultadoBuscaInfo["coop_cidade"]; ?>" disabled>
                                                            <label for="coop_cidade">Cidade</label>
                                                        </div>  
                                                    </div>
                                                    <div class="col-lg-2 col-md-2 col-12">
                                                        <div class="form-floating mb-3">
                                                            <input type="text" name="coop_estado" class="form-control" id="coop_estado" placeholder="Estado" value="<?php echo $resultadoBuscaInfo["coop_estado"]; ?>" disabled>
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
                                                    <span class="destaque fw-bold">Contato</span>
                                                </button>
                                            </h2>
                                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <div class="row">
                                                        <div class="col-lg-4 col-md-4 col-12">
                                                            <div class="form-floating mb-3">
                                                                <input type="text" name="coop_telefone" class="form-control phone" id="coop_telefone" placeholder="Telefone" value="<?php echo $resultadoBuscaInfo["coop_telefone"]; ?>">
                                                                <label for="coop_telefone">Telefone</label>
                                                            </div>  
                                                        </div>
                                                        <div class="col-lg-4 col-md-4 col-12">
                                                            <div class="form-floating mb-3">
                                                                <input type="text" name="coop_whatsapp" class="form-control" id="coop_whatsapp" placeholder="Whatsapp" value="<?php echo $resultadoBuscaInfo["coop_whatsapp"]; ?>">
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
                                                    <span class="destaque fw-bold">Diretoria / Conselho Administração</span>
                                                </button>
                                            </h2>
                                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
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
                                                    if (mysqli_num_rows($buscaDCA) > 0 ){
                                                        while($resultadoDCA = mysqli_fetch_assoc($buscaDCA)){ 
                                                    ?>
                                                    <div class="row mt-2 mb-2">
                                                        <div class="col-lg-4 col-md-4 col-12">
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
                                                                <input type="text" name="dca_telefone[]" class="form-control phone_with_ddd" id="dca_telefone" placeholder="Celular" value="<?php echo $resultadoDCA["dca_telefone"]; ?>">
                                                                <label for="dca_telefone">Celular</label>
                                                            </div>  
                                                        </div>
                                                        <div class="col-lg-7 col-md-7 col-12">
                                                            <div class="form-floating mb-3">
                                                                <input type="email" name="dca_email[]" class="form-control" id="dca_email" placeholder="E-mail" value="<?php echo $resultadoDCA["dca_email"]; ?>">
                                                                <label for="dca_email">E-mail</label>
                                                            </div>  
                                                        </div>
                                                        <div class="col-lg-1 col-md-1 col-12">
                                                            <br>
                                                            <a href="../ferramentas/deleta_dcacfcol.php?dca=<?php echo $resultadoDCA["dca_id"];?>&id=<?php echo $cooperativa;?>" class="btn btn-sm btn-danger"><i class="uil uil-trash-alt"></i></a>
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
                                                    <span class="destaque fw-bold">Conselho Fiscal</span>
                                                </button>
                                            </h2>
                                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
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
                                                    if (mysqli_num_rows($buscaCF) > 0 ){
                                                        while($resultadoCF = mysqli_fetch_assoc($buscaCF)){ 
                                                    ?>
                                                    <div class="row mt-2 mb-2">
                                                        <div class="col-lg-4 col-md-4 col-12">
                                                            <div class="form-floating mb-3">
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
                                                                <input type="text" name="cf_telefone[]" class="form-control phone_with_ddd" id="cf_telefone" placeholder="Celular" value="<?php echo $resultadoCF["cf_telefone"]; ?>">
                                                                <label for="cf_telefone">Celular</label>
                                                            </div>  
                                                        </div>
                                                        <div class="col-lg-7 col-md-7 col-12">
                                                            <div class="form-floating mb-3">
                                                                <input type="email" name="cf_email[]" class="form-control" id="cf_email" placeholder="E-mail" value="<?php echo $resultadoCF["cf_email"]; ?>">
                                                                <label for="cf_email">E-mail</label>
                                                            </div>  
                                                        </div>
                                                        <div class="col-lg-1 col-md-1 col-12">
                                                            <br>
                                                            <a href="../ferramentas/deleta_dcacfcol.php?cf=<?php echo $resultadoCF["cf_id"];?>&id=<?php echo $cooperativa;?>" class="btn btn-sm btn-danger"><i class="uil uil-trash-alt"></i></a>
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
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFor" aria-expanded="false" aria-controls="collapseThree">
                                                    <span class="destaque fw-bold"> Colaboradores </span>
                                                </button>
                                            </h2>
                                            <div id="collapseFor" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
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
                                                    if (mysqli_num_rows($buscaCOL) > 0 ){
                                                        while($resultadoCOL = mysqli_fetch_assoc($buscaCOL)){ 
                                                    ?>
                                                    <div class="row">
                                                        <div class="col-lg-4 col-md-4 col-12">
                                                            <div class="form-floating mb-3">
                                                                <input type="text" name="col_nome[]" class="form-control" id="col_nome" placeholder="Nome" value="<?php echo $resultadoCOL["col_nome"]; ?>">
                                                                <label for="col_nome">Nome Colaborador</label>
                                                            </div>  
                                                        </div>
                                                        <div class="col-lg-3 col-md-3 col-12">
                                                            <div class="form-floating mb-3">
                                                                <input type="text" name="col_area[]" class="form-control" id="col_area" placeholder="Área" value="<?php echo $resultadoCOL["col_area"]; ?>">
                                                                <label for="col_area">Área</label>
                                                            </div>  
                                                        </div>
                                                        <div class="col-lg-4 col-md-4 col-12">
                                                            <div class="form-floating mb-3">
                                                                <input type="email" name="col_email[]" class="form-control" id="col_email" placeholder="E-mail" value="<?php echo $resultadoCOL["col_email"]; ?>">
                                                                <label for="col_email">E-mail</label>
                                                            </div>  
                                                        </div>
                                                        <div class="col-lg-1 col-md-1 col-12">
                                                            <br>
                                                            <a href="../ferramentas/deleta_dcacfcol.php?col=<?php echo $resultadoCOL["cod_col"];?>&id=<?php echo $cooperativa;?>" class="btn btn-sm btn-danger"><i class="uil uil-trash-alt"></i></a>
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
<script src="../js/adiciona_campos_dca_cf_col.js"></script>
<script src="../js/toast.js"></script>
<script src="../js/campos_adicionais.js"></script>
<script src="../js/cp_mascaras.js"></script>
<script src="../js/scripts.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script> 
</body>
</html>
