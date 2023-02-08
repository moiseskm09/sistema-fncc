<?php
require_once '../config/sessao.php';
require_once '../config/conexao.php';
require_once '../config/config_geral.php';

if (isset($_GET['cod_consulta'])) {
    $cod_consulta = $_GET['cod_consulta'];
    $consultaCH = mysqli_query($conexao, "SELECT
    cod_consulta,
    cons_coop,
    cons_user,
    cons_grupo,
    cons_urgencia,
    cons_visibilidade,
    cons_assunto,
    cons_desc_principal,
    data_consulta,
    data_previsao,
    data_conclusao,
    cons_situacao,
    user_responsavel,
    ua.user_grupo as uaUserGrupo,
    ur.user_grupo as urUserGrupo,
    ua.email,
    ua.nome AS user_abertura,
    ur.nome AS user_responsavel,
    cooperativa,
    visibilidade_valor,
    visibilidade,
    situacao
FROM
    consultas
INNER JOIN usuarios ua ON
    cons_user = ua.id_usuario
INNER JOIN cooperativas ON
	cons_coop = cod_coop
LEFT JOIN usuarios ur ON
    user_responsavel = ur.id_usuario
INNER JOIN visibilidade ON
	cons_visibilidade = visibilidade_valor
INNER JOIN situacao_consultas ON
    cons_situacao = cod_situacao
WHERE
    cod_consulta = '$cod_consulta'");
    $resultadoCH = mysqli_fetch_assoc($consultaCH);
} else {
    header("location: ../sistema/listar-consulta.php");
}
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <title>Edição de Consulta</title>
        <link rel="icon" type="image/png" sizes="512x512" href="../img/fncc-logotipo-colorido.png">
        <link rel="icon" type="image/png" sizes="48x48" href="../img/fncc-logotipo-colorido.png">
        <link rel="icon" type="image/png" sizes="32x32" href="../img/fncc-logotipo-colorido.png">
        <link href="../css/menu.css" rel="stylesheet" />
        <link href="../css/perfis.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://unicons.iconscout.com/release/v3.0.6/css/line.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
        <script src="https://code.jquery.com/jquery-3.6.2.min.js" integrity="sha256-2krYZKh//PcchRtd+H+VyyQoZ/e3EcrkxhM8ycwASPA=" crossorigin="anonymous"></script>
        <!-- Styles -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
        <!-- Or for RTL support -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.rtl.min.css" />
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
                            <h5 class="titulo">Dados da consulta #<?php echo str_pad($resultadoCH["cod_consulta"], 6, '0', STR_PAD_LEFT); ?></h5>
                            <div class="btn-toolbar mb-2 mb-md-0">
                                <div class="mr-2">
                                    <a class="btn btn-sm btn-warning mb-1" href="listar-consultas.php"><i class="uil uil-angle-left"></i> Voltar</a>
                                    <a class="btn btn-sm btn-primary mb-1" href="#ajuda" data-toggle="modal" data-target="#ajuda"><i class="bi bi-patch-question"></i> Ajuda</a>
                                </div>
                            </div>
                        </div>

                        <form action="../ferramentas/edita-consulta.php" method="POST" enctype="multipart/form-data">
                            <div class="row mt-2">
                                <div class="col-md-9 col-12" >
                                    <h3 class="destaque"><?php echo $resultadoCH["cons_assunto"]; ?></h3>
                                    <span class="text-muted">CH #<?php
            echo str_pad($resultadoCH["cod_consulta"], 6, '0', STR_PAD_LEFT);
            if ($resultadoCH["cons_urgencia"] == "baixa") {
                echo '<small> <i class="bi bi-circle-fill text-success"></i></small>';
            } elseif ($resultadoCH["cons_urgencia"] == "media") {
                echo '<small> <i class="bi bi-circle-fill text-warning"></i></small>';
            } elseif ($resultadoCH["cons_urgencia"] == "alta") {
                echo '<small> <i class="bi bi-circle-fill text-danger"></i></small>';
            }
            if ($resultadoCH["cons_situacao"] == 5) {
                echo " - <span class='destaque'><strong>Finalizado</strong></span>";
            } elseif ($resultadoCH["cons_situacao"] == 6) {
                echo " - <span class='destaque'><strong>Concluído</strong></span>";
            }
            ?></span>
                                </div>


                                <div class="col-lg-3 col-md-3 col-12">
                                    <?php
                                    $buscaGrupoUser = mysqli_query($conexao, "SELECT user_grupo from usuarios WHERE id_usuario = '$CODIGOUSUARIO'");
                                    $resultadoGrupoUser = mysqli_fetch_assoc($buscaGrupoUser);
                                    $grupoUser = $resultadoGrupoUser["user_grupo"];
                                    if ($grupoUser == 4) {
                                        ?>

                                        <div class="form-floating mb-3">
                                            <input type="hidden" value="<?php echo $resultadoCH["cons_situacao"]; ?>" name="situacaoCons" id="situacaoCons">
                                            <input type="text" class="form-control bg-white" placeholder="Situação" autocomplete="off" maxlength="60" readonly value="<?php echo ucwords($resultadoCH["situacao"]); ?>">
                                            <label for="situacaoCons">Situação <span class="text-danger">*</span></label>
                                        </div>
                                    <?php } else { ?>
                                        <div class="form-floating mb-3">
                                            <select class="form-select pesquisa-select" name="situacaoCons" required>
                                                <?php
                                                $consultaSituacao = mysqli_query($conexao, "SELECT * FROM situacao_consultas");
                                                if (mysqli_num_rows($consultaSituacao) > 0) {
                                                    while ($situacao = mysqli_fetch_assoc($consultaSituacao)) {
                                                        if ($situacao["cod_situacao"] == $resultadoCH["cons_situacao"]) {
                                                            ?>
                                                            <option class="text-dark" value="<?php echo $situacao["cod_situacao"]; ?>" selected><?php echo ucwords($situacao["situacao"]); ?></option>  
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <option class="text-dark" value="<?php echo $situacao["cod_situacao"]; ?>"><?php echo ucwords($situacao["situacao"]); ?></option>   
                                                            <?php
                                                        }
                                                    }
                                                } else {
                                                    
                                                }
                                                ?>
                                            </select>
                                            <label for="situacaoCons">Situação</label>
                                        </div>                          
                                    <?php } ?>
                                </div>
                            </div>

                            <div class="row mt-1 mb-3">
                                <div class="col-lg-9 col-md-9 col-12">
                                    <div class="card">
                                        <div class="card-header p-1 theadN">
                                            <div class="row">
                                                <div class="col-lg-1 col-md-1 col-3 text-center">
                                                    <img src="../img/foto_perfil/cooperativas/<?php echo $LOGO_COOP; ?>" width="60" height="60" class="bg-white rounded-circle"> 
                                                </div>
                                                <div class="col-lg-7 col-md-7 col-9">
                                                    <h5 class="text-primary mt-1"><?php echo ucwords($resultadoCH["user_abertura"]); ?></h5>
                                                    <p class="text-muted small" style="margin-top: -5px;"><?php echo $resultadoCH["cooperativa"]; ?></p>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-12">
                                                    <p class="text-muted small"><span class="text-primary">Aberto: </span> <?php echo strftime('%d.%m.%Y às %H:%M:%S', strtotime($resultadoCH["data_consulta"])); ?></p>
                                                    <p class="text-muted small" style="margin-top: -5px;"><span class="text-primary">Previsão: </span><?php
                                    //echo $data = strftime('%d.%m.%Y às %H:%M:%S',strtotime("+2 days",strtotime($resultadoCH["data_consulta"])));
                                    echo strftime('%d.%m.%Y às %H:%M:%S', strtotime($resultadoCH["data_previsao"]));
                                    ?></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body" style="max-height: 350px; overflow-y: scroll;">
                                            <div class="row mb-1">
                                                <div class="alert alert-dark" role="alert">
                                                    <p><?php echo $resultadoCH["cons_desc_principal"]; ?></p>
                                                    <hr>
                                                    <p class="mb-0">Por: <?php echo ucwords($resultadoCH["user_abertura"]); ?> <span class="float-end"><?php echo strftime('%d.%m.%Y às %H:%M:%S', strtotime($resultadoCH["data_consulta"])); ?></span></p>
                                                </div>
                                                <?php
                                                $buscaInteracoes = mysqli_query($conexao, "SELECT inter_descricao, inter_data, nome, user_grupo FROM consulta_interacoes INNER JOIN usuarios ON inter_user = id_usuario WHERE inter_cons = '$cod_consulta'");
                                                if (mysqli_num_fields($buscaInteracoes) > 0) {
                                                    while ($resultadoInteracoes = mysqli_fetch_assoc($buscaInteracoes)) {
                                                        ?>
                                                        <div class="alert <?php
                                                        if ($resultadoInteracoes["user_grupo"] != 4) {
                                                            echo "alert-success";
                                                        } else {
                                                            echo "alert-primary";
                                                        }
                                                        ?>" role="alert">
                                                            <p><?php echo $resultadoInteracoes["inter_descricao"]; ?></p>
                                                            <hr>
                                                            <p class="mb-0">Por: <?php echo ucwords($resultadoInteracoes["nome"]); ?> <span class="float-end"><?php echo strftime('%d.%m.%Y às %H:%M:%S', strtotime($resultadoInteracoes["inter_data"])); ?></span></p>
                                                        </div>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        <div class="card-footer theadN">
                                            <div class="row">
                                                <?php if ($resultadoCH["cons_situacao"] == 5 && $resultadoCH["cons_user"] == $CODIGOUSUARIO) {
                                                    ?>
                                                    <div class="col-12">
                                                        <h6 class="text-center mt-2">Este Chamado foi <strong>FINALIZADO</strong>, você está de acordo com a solução?</h6>
                                                    </div>
                                                    <div class="col-12 text-center">
                                                        <div class="mb-2 mb-md-0">
                                                            <div class="mr-2">
                                                                <a class="btn btn-sm btn-danger mb-1" href="#naoEstouAcordo" data-toggle="modal" data-target="#naoEstouAcordo"><i class="bi bi-emoji-frown"></i> Não</a>
                                                                <a class="btn btn-lg btn-success mb-1" href="#satisfacao" data-toggle="modal" data-target="#satisfacao"><i class="bi bi-emoji-smile"></i> Sim</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 mt-3 mb-2">
                                                        <footer class="blockquote-footer">Caso não haja interação sobre a finalização da consulta, a situação será automaticamente alterada para concluída em três dias!</footer>
                                                    </div>
                                                <?php } elseif ($resultadoCH["cons_situacao"] == 5 && $resultadoCH["cons_user"] != $CODIGOUSUARIO) { ?>
                                                    <div class="col-12">
                                                        <h6 class="text-center mt-2"><span class="lh-lg">Até aqui está tudo certo!</span><br> Essa consulta foi <strong>FINALIZADA</strong> e está aguardando a avaliação para ser <strong>CONCLUÍDA.</strong></h6>
                                                    </div>                                            
                                                    <?php
                                                } elseif ($resultadoCH["cons_situacao"] == 6) {
                                                    ?>
                                                    <div class="col-12">
                                                        <h6 class="text-center mt-2">Esta consulta foi <strong>CONCLUÍDA!</strong></h6>
                                                        <p class="text-muted small mt-2 mb-2 text-center"><span class="text-primary">Data Conclusão: </span> <?php echo strftime('%d.%m.%Y às %H:%M:%S', strtotime($resultadoCH["data_conclusao"])); ?></p>

                                                    </div>                                   
                                                    <?php
                                                } else {
                                                    ?>
                                                    <div class="col-lg-12 col-md-21 col-12">
                                                        <input type="hidden" name="cod_consulta" value="<?php echo $resultadoCH["cod_consulta"]; ?>">
                                                        <input type="hidden" name="cod_user" value="<?php echo $CODIGOUSUARIO; ?>">
                                                        <input type="hidden" name="cod_responsavel" value="<?php echo $resultadoCH["user_responsavel"]; ?>">
                                                        <input type="hidden" name="uaUserGrupo" value="<?php echo $resultadoCH["uaUserGrupo"]; ?>">
                                                        <input type="hidden" name="cons_coop" value="<?php echo $resultadoCH["cons_coop"]; ?>">

                                                        <div class="form-floating mb-3">
                                                            <textarea class="form-control" name="respostaConsulta" id="respostaConsulta" placeholder="Adicione uma resposta" style="height: 120px" maxlength="1000" required></textarea>
                                                            <label for="respostaConsulta">Resposta / Adicionar Informações <span class="text-danger">*</span></label>
                                                        </div>  
                                                    </div>
                                                    <div class="col-12 text-end">
                                                        <button type="submit" class="btn btn-md btn-success btnexecutafunc"><i class="bi bi-reply-all"></i> Responder </button>
                                                    </div>
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-12">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="accordion" id="accordionExample">
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header" id="headingOne">
                                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                            <span class="destaque fw-bold">Responsável</span>
                                                        </button>
                                                    </h2>
                                                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                                        <div class="accordion-body">
                                                            <div class="row">
                                                                <div class="col-lg-12 col-md-12 col-12">
                                                                    <div class="form-floating mb-3">
                                                                        <input type="text" name="nomeResponsavel" id="nomeResponsavel" class="form-control" placeholder="Nome do Responsável" autocomplete="off" maxlength="60" readonly required value=" <?php echo ucwords($resultadoCH["user_responsavel"]); ?>">
                                                                        <label for="nomeResponsavel">Nome do Responsável <span class="text-danger">*</span></label>
                                                                    </div>  
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="accordion" id="accordionAnexo">
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header" id="headingOne">
                                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseAnexo" aria-expanded="true" aria-controls="collapseAnexo">
                                                            <span class="destaque fw-bold">Anexos</span>
                                                        </button>
                                                    </h2>
                                                    <div id="collapseAnexo" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                                        <div class="accordion-body">
                                                            <div class="row">
                                                                <?php
                                                                $buscaAnexoConsulta = "SELECT * FROM arquivos_consultas WHERE arq_consulta =" . $resultadoCH["cod_consulta"] . " ORDER BY cod_arquivo DESC";
                                                                $buscaAnexo = mysqli_query($conexao, $buscaAnexoConsulta);
                                                                if (mysqli_num_rows($buscaAnexo)) {
                                                                    while ($resultadoAnexo = mysqli_fetch_assoc($buscaAnexo)) {
                                                                        ?>
                                                                        <div class="col-lg-12 col-md-12 col-12 mb-2">

                                                                            <a title="<?php echo $resultadoAnexo['arq_nome']; ?>" href="../ferramentas/download-anexo-consulta.php?cod_coop=<?php echo $resultadoCH["cons_coop"]; ?>&cod_consulta=<?php echo $resultadoCH["cod_consulta"]; ?>&nome_arquivo=<?php echo $resultadoAnexo['arq_nome']; ?>" data-confirm="Fazer Download" style="text-decoration: none;"><i class="uil uil-import btn-sm btn-outline-primary"> <?php echo substr($resultadoAnexo['arq_nome'], 0, 20); ?> </i></a>

                                                                        </div>
                                                                        <?php
                                                                    }
                                                                }
                                                                ?>
                                                                <?php if ($resultadoCH["cons_situacao"] == 5 OR $resultadoCH["cons_situacao"] == 6) {
                                                                    echo "<p class='alert alert-info'>Não é possivel adicionar anexos com a situação atual.</p>"; ?>

<?php } else { ?>
                                                                    <div class="col-lg-12 col-md-12 col-12 mb-2">
                                                                        <label class="btn-bs-file btn btn-sm btn-success">
                                                                            <i class="bi bi-upload"></i> ADICIONAR
                                                                            <input type="file" name="arquivoAtend[]" id="arquivoAtend" multiple/>
                                                                        </label>
                                                                    </div>
<?php } ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="accordion" id="accordionAcao">
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header" id="headingAcao">
                                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseAcao" aria-expanded="true" aria-controls="collapseAcao">
                                                            <span class="destaque fw-bold">Info. Adicionais</span>
                                                        </button>
                                                    </h2>
                                                    <div id="collapseAcao" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#collapseAcao">
                                                        <div class="accordion-body">
                                                            <div class="row">

                                                                <div class="col-lg-12 col-md-12 col-12">
                                                                    <?php
                                                                    if ($resultadoCH["cons_user"] != $CODIGOUSUARIO) {
                                                                        ?>
                                                                        <div class="form-floating mb-3">
                                                                            <input type="hidden" value="<?php echo $resultadoCH["cons_urgencia"]; ?>" name="urgencia" id="urgencia">
                                                                            <input type="text" class="form-control" placeholder="Urgência" autocomplete="off" maxlength="60" readonly required value="<?php echo ucwords($resultadoCH["cons_urgencia"]); ?>">
                                                                            <label for="urgencia">Urgência <span class="text-danger">*</span></label>
                                                                        </div>
<?php } else { ?>
                                                                        <div class="form-floating mb-3">
                                                                            <select class="form-select pesquisa-select" name="urgencia" required>
                                                                                <option value="<?php echo $resultadoCH["cons_urgencia"]; ?>"><?php echo ucwords($resultadoCH["cons_urgencia"]); ?></option>
                                                                                <?php
                                                                                $consultaUrgencia = mysqli_query($conexao, "SELECT * FROM urgencia");
                                                                                if (mysqli_num_rows($consultaUrgencia) > 0) {
                                                                                    while ($urgencia = mysqli_fetch_assoc($consultaUrgencia)) {
                                                                                        if ($urgencia["urgencia"] == $resultadoCH["cons_urgencia"]) {
                                                                                            
                                                                                        } else {
                                                                                            ?>
                                                                                            <option class="text-dark" value="<?php echo $urgencia["urgencia"]; ?>"><?php echo ucwords($urgencia["urgencia"]); ?></option>   
                                                                                            <?php
                                                                                        }
                                                                                    }
                                                                                } else {
                                                                                    
                                                                                }
                                                                                ?>
                                                                            </select>
                                                                            <label for="urgencia">Urgência</label>
                                                                        </div>                                                
<?php } ?>
                                                                </div>

                                                                <div class="col-lg-12 col-md-12 col-12">

                                                                    <?php
                                                                    if ($resultadoCH["cons_user"] != $CODIGOUSUARIO) {
                                                                        ?>
                                                                        <div class="form-floating mb-3">
                                                                            <input type="hidden" value="<?php echo $resultadoCH["visibilidade_valor"]; ?>" name="visibilidade" id="visibilidade">
                                                                            <input type="text" class="form-control" placeholder="Visibilidade" autocomplete="off" maxlength="60" readonly required value="<?php echo ucwords($resultadoCH["visibilidade"]); ?>">
                                                                            <label for="visibilidade">Visibilidade <span class="text-danger">*</span></label>
                                                                        </div>
                                                                        <?php
                                                                    } else {
                                                                        ?>
                                                                        <div class="form-floating mb-3">
                                                                            <select class="form-select pesquisa-select" name="visibilidade" required id="visibilidade">
                                                                                <option value="<?php echo $resultadoCH["visibilidade_valor"]; ?>"><?php echo ucwords($resultadoCH["visibilidade"]); ?></option>
                                                                                <?php
                                                                                $consultaVisibilidade = mysqli_query($conexao, "SELECT * FROM visibilidade");
                                                                                if (mysqli_num_rows($consultaVisibilidade) > 0) {
                                                                                    while ($visibilidade = mysqli_fetch_assoc($consultaVisibilidade)) {
                                                                                        if ($visibilidade["visibilidade_valor"] == $resultadoCH["cons_visibilidade"]) {
                                                                                            
                                                                                        } else {
                                                                                            ?>
                                                                                            <option class="text-dark" value="<?php echo $visibilidade["visibilidade_valor"]; ?>"><?php echo ucwords($visibilidade["visibilidade"]); ?></option>   
                                                                                            <?php
                                                                                        }
                                                                                    }
                                                                                } else {
                                                                                    
                                                                                }
                                                                                ?>
                                                                            </select>
                                                                            <label for="visibilidade">Visibilidade</label>
                                                                        </div>

                                                                        <?php
                                                                    }
                                                                    ?>

                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </div>

                        </form>

                        <?php
                        if (isset($_GET["sucesso"])) {
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
                        <!-- Modal Ajuda-->
                        <div class="modal fade" id="ajuda" tabindex="-1" role="dialog" aria-labelledby="ajuda" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
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
                                                <h6 class="destaque">Alterações na Cosulta</h6>
                                                <p>Todas as alterações realizadas na consulta deverá obrigatoriamente ter uma resposta / Adição de infomação para ser confirmada.</p>
                                            </div>
                                            <div class="col-12">
                                                <h6 class="destaque">Mudança de Situação</h6>
                                                <p>Disponível apenas para o consultor responsável.</p>
                                            </div>
                                            <div class="col-12">
                                                <h6 class="destaque">Inclusão de vários Anexos</h6>
                                                <p>Para adicionar mais de um arquivo na consulta utilize as teclas <code>CTRL (TECLADO) + CLIQUE DO MOUSE</code> para selecionar ou se preferir selecione com o <code>MOUSE</code> e arraste para o campo.</p>
                                            </div>
                                            <div class="col-12">
                                                <h6 class="destaque">Download de Anexos</h6>
                                                <p>O Download será realizado após o <code>CLIQUE DO MOUSE</code> em cima do nome do arquivo que fica na <strong>aba</strong> <code>ANEXOS</code> do lado direito da tela.</p>
                                            </div>
                                            <div class="col-12">
                                                <h6 class="destaque">Mudança de Visibilidade</h6>
                                                <p>Disponível apenas para o usuário que abriu a consulta.</p>
                                            </div>
                                            <div class="col-12">
                                                <h6 class="destaque">Mudança de Urgência</h6>
                                                <p>Disponível apenas para o usuário que abriu a consulta.</p>
                                            </div>
                                            <div class="col-12 text-end">
                                                <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal" aria-label="Fechar"><i class="bi bi-x"></i> Fechar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- fim modal ajuda -->

                        <!-- Modal satisfação-->
                        <div class="modal fade" id="satisfacao" tabindex="-1" role="dialog" aria-labelledby="ajuda" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header bg-success text-white p-2">
                                        <h5 class="modal-title" id="exampleModalLabel">Avaliar Consulta</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body card-fundo-body">
                                        <form action="../ferramentas/avaliacao.php" method="POST">
                                            <input type="hidden" name="cod_consultaAval" value="<?php echo $resultadoCH["cod_consulta"]; ?>">
                                            <div class="row">
                                                <div class="col-12">
                                                    <p>Precisamos saber seu nível de satisfação com essa consulta. Por favor selecione uma das opções abaixo para concluir!</p>
                                                </div>
                                                <div class="col-12 align-content-center">
                                                    <input type="radio" class="btn-check" name="avaliacao" value="otimo" id="otimo" autocomplete="off">
                                                    <label class="btn btn-outline-success text-center p-1" for="otimo" style="width:100%;"><img src="../img/icones/Emoji-Feliz.png" width="35" height="35" alt="Ótimo"/><br>Ótimo</label>
                                                </div>
                                                <div class="col-12 align-content-center">
                                                    <input type="radio" class="btn-check" name="avaliacao" value="bom" id="bom" autocomplete="off">
                                                    <label class="btn btn-outline-success text-center p-1" for="bom" style="width:100%;"><img src="../img/icones/Emoji-Bom.png" width="35" height="35" alt="Bom"/><br>Bom</label>
                                                </div>
                                                <div class="col-12 align-content-center">
                                                    <input type="radio" class="btn-check" name="avaliacao" value="regular" id="regular" autocomplete="off">
                                                    <label class="btn btn-outline-warning text-center p-1" for="regular" style="width:100%;"><img src="../img/icones/Emoji-Regular.png" width="35" height="35" alt="Regular"/><br>Regular</label>
                                                </div>
                                                <div class="col-12 align-content-center">
                                                    <input type="radio" class="btn-check" name="avaliacao" value="ruim" id="ruim" autocomplete="off">
                                                    <label class="btn btn-outline-danger text-center p-1" for="ruim" style="width:100%;"><img src="../img/icones/Emoji-Ruim.png" width="35" height="35" alt="Ruim"/><br>Ruim</label>
                                                </div>
                                                <div class="col-12 align-content-center">
                                                    <input type="radio" class="btn-check" name="avaliacao" value="pessimo" id="pessimo" autocomplete="off">
                                                    <label class="btn btn-outline-danger text-center p-1" for="pessimo" style="width:100%;"><img src="../img/icones/Emoji-Pessimo.png" width="35" height="35" alt="Péssimo"/><br>Péssimo</label>
                                                </div>
                                                <div class="col-12 text-end">
                                                    <button type="submit" class="btn btn-md btn-success" ><i class="bi bi-check2-square"></i> Concluir Consulta</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- fim satisfação -->


                        <!-- Modal não estou de acordo-->
                        <div class="modal fade" id="naoEstouAcordo" tabindex="-1" role="dialog" aria-labelledby="ajuda" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header bg-danger text-white p-2">
                                        <h5 class="modal-title" id="exampleModalLabel">Não Estou de Acordo</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body card-fundo-body">
                                        <form action="../ferramentas/nao-estou-acordo.php" method="POST">
                                            <input type="hidden" name="cod_consultaNaoEstouAcordo" value="<?php echo $resultadoCH["cod_consulta"]; ?>">
                                            <input type="hidden" name="cod_userNaoEstouAcordo" value="<?php echo $CODIGOUSUARIO; ?>">
                                            <div class="row">
                                                <div class="col-12">
                                                    <p><img src="../img/icones/Emoji-Ruim.png" width="35" height="35" alt="Ruim"/></p>
                                                    <p>Poxa, ficamos tristes em saber disso!<br>Conta pra gente por que você não está de acordo com a finalização. Vamos notificar os responsáveis e reabrir a consulta.</p>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-floating mb-3">
                                                        <textarea class="form-control" name="respostaNaoEstouAcordo" id="respostaNaoEstouAcordo" placeholder="Adicione uma resposta" style="height: 120px" maxlength="1000" required></textarea>
                                                        <label for="respostaNaoEstouAcordo">Conte o que aconteceu <span class="text-danger">*</span></label>
                                                    </div>
                                                </div>

                                                <div class="col-12 text-end">
                                                    <button type="submit" class="btn btn-md btn-success btnexecutafuncNC"><i class="bi bi-folder2-open"></i> Reabir Consulta</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- fim nao estou de acordo -->
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
            $(".nav .nav-link").on("click", function () {
                $(".nav").find(".menu-ativo").removeClass("menu-ativo");
                $(this).addClass("menu-ativo");
            });
        </script> 
        <script src="../js/loading.js"></script>
    </body>
</html>
