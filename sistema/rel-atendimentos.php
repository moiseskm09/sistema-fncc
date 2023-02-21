<?php
require_once '../config/sessao.php';
require_once '../config/conexao.php';
require_once '../config/config_geral.php';

if (!empty($_POST["cooperativa"] || $_POST["areaAtendimento"] || $_POST["dataRefIncialF"] || $_POST["dataRefFinalF"])) {
    
    $cooperativaAtendimento = $_POST["cooperativa"];
    $areaAtendimento = $_POST["areaAtendimento"];
    $dataRefIncialF = $_POST["dataRefIncialF"];
    $dataRefFinalF = $_POST["dataRefFinalF"];
    $horaInicial = " 00:00:01";
    $horaFinal = " 23:59:59";
    
    
    $buscaTotais =  mysqli_query($conexao, "SELECT count(cod_consulta) AS total_atendimentos FROM consultas WHERE data_consulta >= '$dataRefIncialF$horaInicial' and data_consulta <= '$dataRefFinalF$horaFinal' and cons_coop like '%$cooperativaAtendimento%' and cons_grupo like '%$areaAtendimento%'");
   
    $buscaAtendimentoAbertos = mysqli_query($conexao, "SELECT count(cod_consulta) AS total_atendimentos FROM consultas WHERE data_consulta >= '$dataRefIncialF$horaInicial' and data_consulta <= '$dataRefFinalF$horaFinal' and cons_coop like '%$cooperativaAtendimento%' and cons_grupo like '%$areaAtendimento%' and cons_situacao = '1'");
    
    $buscaAtendimentoEmAndamento = mysqli_query($conexao, "SELECT count(cod_consulta) AS total_atendimentos FROM consultas WHERE data_consulta >= '$dataRefIncialF$horaInicial' and data_consulta <= '$dataRefFinalF$horaFinal' and cons_coop like '%$cooperativaAtendimento%' and cons_grupo like '%$areaAtendimento%' and cons_situacao = '2'");
    
    $buscaAtendimentoAguardando = mysqli_query($conexao, "SELECT count(cod_consulta) AS total_atendimentos FROM consultas WHERE data_consulta >= '$dataRefIncialF$horaInicial' and data_consulta <= '$dataRefFinalF$horaFinal' and cons_coop like '%$cooperativaAtendimento%' and cons_grupo like '%$areaAtendimento%' and cons_situacao = '4'");
    
    $buscaAtendimentoPendente = mysqli_query($conexao, "SELECT count(cod_consulta) AS total_atendimentos FROM consultas WHERE data_consulta >= '$dataRefIncialF$horaInicial' and data_consulta <= '$dataRefFinalF$horaFinal' and cons_coop like '%$cooperativaAtendimento%' and cons_grupo like '%$areaAtendimento%' and cons_situacao = '3'");
    
    $buscaAtendimentoFechado = mysqli_query($conexao, "SELECT count(cod_consulta) AS total_atendimentos FROM consultas WHERE data_consulta >= '$dataRefIncialF$horaInicial' and data_consulta <= '$dataRefFinalF$horaFinal' and cons_coop like '%$cooperativaAtendimento%' and cons_grupo like '%$areaAtendimento%' and cons_situacao = '5'");
    
    $buscaAtendimentoConcluido = mysqli_query($conexao, "SELECT count(cod_consulta) AS total_atendimentos FROM consultas WHERE data_consulta >= '$dataRefIncialF$horaInicial' and data_consulta <= '$dataRefFinalF$horaFinal' and cons_coop like '%$cooperativaAtendimento%' and cons_grupo like '%$areaAtendimento%' and cons_situacao = '6'");
    
    $resultadoTotalAtendimentos = mysqli_fetch_assoc($buscaTotais);
    if($resultadoTotalAtendimentos["total_atendimentos"] > 0){
    $resultadoAtendimentosAbertos = mysqli_fetch_assoc($buscaAtendimentoAbertos);
    $resultadoAtendimentosEmAndamento = mysqli_fetch_assoc($buscaAtendimentoEmAndamento);
    $resultadoAtendimentosAguardando = mysqli_fetch_assoc($buscaAtendimentoAguardando);
    $resultadoAtendimentosPendente = mysqli_fetch_assoc($buscaAtendimentoPendente);
    $resultadoAtendimentosFechado = mysqli_fetch_assoc($buscaAtendimentoFechado);
    $resultadoAtendimentosConcluido = mysqli_fetch_assoc($buscaAtendimentoConcluido);
    
    $totaldeConsultas = $resultadoTotalAtendimentos["total_atendimentos"];
    $totaldeConsultasAbertas = $resultadoAtendimentosAbertos["total_atendimentos"];
    $totaldeConsultasEmAndamento = $resultadoAtendimentosEmAndamento["total_atendimentos"];
    $totaldeConsultasAguardando = $resultadoAtendimentosAguardando["total_atendimentos"];
    $totaldeConsultasPendente = $resultadoAtendimentosPendente["total_atendimentos"];
    $totaldeConsultasFechado = $resultadoAtendimentosFechado["total_atendimentos"];
    $totaldeConsultasConcluido = $resultadoAtendimentosConcluido["total_atendimentos"];
    
    $percentualAbertos = number_format($totaldeConsultasAbertas / $totaldeConsultas * 100, 0, '.', '');
    $percentualEmAndamento = number_format($totaldeConsultasEmAndamento / $totaldeConsultas * 100, 0, '.', '');
    $percentualAguardando = number_format($totaldeConsultasAguardando / $totaldeConsultas * 100, 0, '.', '');
    $percentualPendente = number_format($totaldeConsultasPendente / $totaldeConsultas * 100, 0, '.', '');
    $percentualFechado = number_format($totaldeConsultasFechado / $totaldeConsultas * 100, 0, '.', '');
    $percentualConcluido = number_format($totaldeConsultasConcluido / $totaldeConsultas * 100, 0, '.', '');
}else{
    $totaldeConsultas = 0;
    $totaldeConsultasAbertas = 0;
    $totaldeConsultasEmAndamento = 0;
    $totaldeConsultasAguardando = 0;
    $totaldeConsultasPendente = 0;
    $totaldeConsultasFechado = 0;
    $totaldeConsultasConcluido = 0;
    
    $percentualAbertos = 0;
    $percentualEmAndamento = 0;
    $percentualAguardando = 0;
    $percentualPendente = 0;
    $percentualFechado = 0;
    $percentualConcluido = 0;
}
      if(!empty($cooperativaAtendimento)){
        $buscaNomeCoopExport = mysqli_query($conexao, "SELECT cooperativa FROM cooperativas WHERE cod_coop = '$cooperativaAtendimento'");
        $resultadoCoopExport = mysqli_fetch_assoc($buscaNomeCoopExport);
        $coopHeaderExport = $resultadoCoopExport["cooperativa"];
    }else{
        $coopHeaderExport = "Todas";
    
    }
    
    if(!empty($areaAtendimento)){
        $buscaNomeareaAtendimento = mysqli_query($conexao, "SELECT grupo FROM grupos_usuarios WHERE cod_grupo = '$areaAtendimento'");
        $resultadoareaAtendimento = mysqli_fetch_assoc($buscaNomeareaAtendimento);
        $AreaHeaderExport = $resultadoareaAtendimento["cooperativa"];
    }else{
        $AreaHeaderExport = "Todas";
    }
    
    $dataRefInicialExport = date("d/m/Y", strtotime($dataRefIncialF));
    $dataRefFinalExport = date("d/m/Y", strtotime($dataRefFinalF));
    
    $filtroON = 1;
} else {
    $dataRefIncialF = date("Y-m-d", strtotime("-1 month"));
    $dataRefFinalF = date("Y-m-d");
    $horaInicial = " 00:00:01";
    $horaFinal = " 23:59:59";
    $buscaTotais =  mysqli_query($conexao, "SELECT count(cod_consulta) AS total_atendimentos FROM consultas WHERE data_consulta >= '$dataRefIncialF$horaInicial' and data_consulta <= '$dataRefFinalF$horaFinal'");
    
    $buscaAtendimentoAbertos = mysqli_query($conexao, "SELECT count(cod_consulta) AS total_atendimentos FROM consultas WHERE data_consulta >= '$dataRefIncialF$horaInicial' and data_consulta <= '$dataRefFinalF$horaFinal' and cons_situacao = '1'");
    
    $buscaAtendimentoEmAndamento = mysqli_query($conexao, "SELECT count(cod_consulta) AS total_atendimentos FROM consultas WHERE data_consulta >= '$dataRefIncialF$horaInicial' and data_consulta <= '$dataRefFinalF$horaFinal' and cons_situacao = '2'");
    
    $buscaAtendimentoAguardando = mysqli_query($conexao, "SELECT count(cod_consulta) AS total_atendimentos FROM consultas WHERE data_consulta >= '$dataRefIncialF$horaInicial' and data_consulta <= '$dataRefFinalF$horaFinal' and cons_situacao = '4'");
    
    $buscaAtendimentoPendente = mysqli_query($conexao, "SELECT count(cod_consulta) AS total_atendimentos FROM consultas WHERE data_consulta >= '$dataRefIncialF$horaInicial' and data_consulta <= '$dataRefFinalF$horaFinal' and cons_situacao = '3'");
    
    $buscaAtendimentoFechado = mysqli_query($conexao, "SELECT count(cod_consulta) AS total_atendimentos FROM consultas WHERE data_consulta >= '$dataRefIncialF$horaInicial' and data_consulta <= '$dataRefFinalF$horaFinal' and cons_situacao = '5'");
    
    $buscaAtendimentoConcluido = mysqli_query($conexao, "SELECT count(cod_consulta) AS total_atendimentos FROM consultas WHERE data_consulta >= '$dataRefIncialF$horaInicial' and data_consulta <= '$dataRefFinalF$horaFinal' and cons_situacao = '6'");
    
    $resultadoTotalAtendimentos = mysqli_fetch_assoc($buscaTotais);
    if($resultadoTotalAtendimentos["total_atendimentos"] > 0){
    $resultadoAtendimentosAbertos = mysqli_fetch_assoc($buscaAtendimentoAbertos);
    $resultadoAtendimentosEmAndamento = mysqli_fetch_assoc($buscaAtendimentoEmAndamento);
    $resultadoAtendimentosAguardando = mysqli_fetch_assoc($buscaAtendimentoAguardando);
    $resultadoAtendimentosPendente = mysqli_fetch_assoc($buscaAtendimentoPendente);
    $resultadoAtendimentosFechado = mysqli_fetch_assoc($buscaAtendimentoFechado);
    $resultadoAtendimentosConcluido = mysqli_fetch_assoc($buscaAtendimentoConcluido);
    
    $totaldeConsultas = $resultadoTotalAtendimentos["total_atendimentos"];
    $totaldeConsultasAbertas = $resultadoAtendimentosAbertos["total_atendimentos"];
    $totaldeConsultasEmAndamento = $resultadoAtendimentosEmAndamento["total_atendimentos"];
    $totaldeConsultasAguardando = $resultadoAtendimentosAguardando["total_atendimentos"];
    $totaldeConsultasPendente = $resultadoAtendimentosPendente["total_atendimentos"];
    $totaldeConsultasFechado = $resultadoAtendimentosFechado["total_atendimentos"];
    $totaldeConsultasConcluido = $resultadoAtendimentosConcluido["total_atendimentos"];
    
    $percentualAbertos = number_format($totaldeConsultasAbertas / $totaldeConsultas * 100, 0, '.', '');
    $percentualEmAndamento = number_format($totaldeConsultasEmAndamento / $totaldeConsultas * 100, 0, '.', '');
    $percentualAguardando = number_format($totaldeConsultasAguardando / $totaldeConsultas * 100, 0, '.', '');
    $percentualPendente = number_format($totaldeConsultasPendente / $totaldeConsultas * 100, 0, '.', '');
    $percentualFechado = number_format($totaldeConsultasFechado / $totaldeConsultas * 100, 0, '.', '');
    $percentualConcluido = number_format($totaldeConsultasConcluido / $totaldeConsultas * 100, 0, '.', '');
    }else{
    $totaldeConsultas = 0;
    $totaldeConsultasAbertas = 0;
    $totaldeConsultasEmAndamento = 0;
    $totaldeConsultasAguardando = 0;
    $totaldeConsultasPendente = 0;
    $totaldeConsultasFechado = 0;
    $totaldeConsultasConcluido = 0;
    
    $percentualAbertos = 0;
    $percentualEmAndamento = 0;
    $percentualAguardando = 0;
    $percentualPendente = 0;
    $percentualFechado = 0;
    $percentualConcluido = 0;
}
    $filtroON = 0;
    $coopHeaderExport = "Todas";
    $AreaHeaderExport = "Todas";
    $dataRefInicialExport = date("d/m/Y", strtotime($dataRefIncialF));
    $dataRefFinalExport = date("d/m/Y", strtotime($dataRefFinalF));
    
    
}
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <title>Relatório de Atendimentos</title>
        <link rel="icon" type="image/png" sizes="512x512" href="../img/fncc-logotipo-colorido.png">
        <link rel="icon" type="image/png" sizes="48x48" href="../img/fncc-logotipo-colorido.png">
        <link rel="icon" type="image/png" sizes="32x32" href="../img/fncc-logotipo-colorido.png">
        <link href="../css/menu.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://unicons.iconscout.com/release/v3.0.6/css/line.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
        <script src="https://code.jquery.com/jquery-3.6.2.min.js" integrity="sha256-2krYZKh//PcchRtd+H+VyyQoZ/e3EcrkxhM8ycwASPA=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
         <!-- Styles -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
        <!-- Or for RTL support -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.rtl.min.css" />

        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <link href="../css/style.css" rel="stylesheet" />
        <link href="../css/graficos.css" rel="stylesheet" />
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
                            <div class="breadcrumb mb-2 mb-md-0" style="--bs-breadcrumb-divider: '>'; font-size: 16px;">
                      <span class="breadcrumb-item text-primary">Estatísticas</span>
                      <span class="breadcrumb-item active text-success">Atendimento</span>
                  </div>
                            <div class="btn-toolbar mb-2 mb-md-0">
                                <div class="mr-2">
                                    <a class="btn btn-sm btn-warning mb-1" onClick="history.go(-1)"><i class="uil uil-angle-left"></i> Voltar</a>
                                    <!--<a class="btn btn-sm btn-primary mb-1" href="#ajuda" data-toggle="modal" data-target="#ajuda"><i class="bi bi-question"></i> Ajuda</a>     -->                             
                                </div>
                            </div>

                        </div>

                        <div class="row" id="renderPDF">

                            <div class="col-md-12">
                                <div class="accordion mb-2" id="accordionExample">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingOne">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                <span class="destaque fw-bold">Filtro</span>
                                            </button>
                                        </h2>
                                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                <form action="" method="POST">
                                                    <div class="row">
                                                        <div class="col-lg-3 col-md-3 col-12">
                                                            <div class="form-floating mb-3">
                                                                <select class="form-select pesquisa-select" id="cooperativa" name="cooperativa">
                                                                    <option value="">Todas</option>
                                                                    <?php
                                                                    $buscaCoop = mysqli_query($conexao, "SELECT * FROM cooperativas");
                                                                    while ($resultadoCoop = mysqli_fetch_assoc($buscaCoop)) {
                                                                        if($cooperativaAtendimento == $resultadoCoop['cod_coop']){
         echo '<option selected value='.$resultadoCoop['cod_coop'].'>'.$resultadoCoop['cooperativa'].'</option>';                                                                   
                                                                        }else{
                                                                        ?>
                                                                        <option value="<?php echo $resultadoCoop['cod_coop'] ?>"><?php echo $resultadoCoop['cooperativa'] ?></option>
                                                                        <?php
                                                                    }
                                                                    }
                                                                    ?>
                                                                </select>
                                                                <label for="floatingSelect">Cooperativa</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3 col-md-3 col-12">
                                                            <div class="form-floating mb-3">
                                                                <select class="form-select pesquisa-select" id="areaAtendimento" name="areaAtendimento">
                                                                    <option value="">Todas</option>
                                                                    <?php
                                                                    $buscaareaAtendimento = mysqli_query($conexao, "SELECT * FROM grupos_usuarios WHERE cod_grupo != 4");
                                                                    while ($resultadoareaAtendimento = mysqli_fetch_assoc($buscaareaAtendimento)) {
                                                                        if($areaAtendimento == $resultadoareaAtendimento['cod_grupo']){
         echo '<option selected value='.$resultadoareaAtendimento['cod_grupo'].'>'.$resultadoareaAtendimento['grupo'].'</option>';                                                                   
                                                                        }else{
                                                                        ?>
                                                                        <option value="<?php echo $resultadoareaAtendimento['cod_grupo'] ?>"><?php echo $resultadoareaAtendimento['grupo'] ?></option>
                                                                        <?php
                                                                    }
                                                                    }
                                                                    ?>
                                                                </select>
                                                                <label for="areaAtendimento">Área de Atendimento</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3 col-md-3 col-12">
                                                            <div class="form-floating mb-3">
                                                                <input type="date" name="dataRefIncialF" id="dataRefIncialF" class="form-control" placeholder="Insira a data ref inicial" value="<?php echo $dataRefIncialF; ?>" required>
                                                                <label for="dataRefIncialF">Data Abertura Inicial <span class="text-danger">*</span></label>
                                                            </div>  
                                                        </div>
                                                        <div class="col-lg-3 col-md-3 col-12">
                                                            <div class="form-floating mb-3">
                                                                <input type="date" name="dataRefFinalF" id="dataRefFinalF" class="form-control" placeholder="Insira a data ref final" value="<?php echo $dataRefFinalF; ?>" required>
                                                                <label for="dataRefFinalF">Data Abertura Final <span class="text-danger">*</span></label>
                                                            </div>  
                                                        </div>
                                                        <div class="col-12 text-end">
                                                            <button type="submit" id="filtrarAtendimento" class="btn btn-sm btn-success"><i class="bi bi-funnel"></i> Filtrar Atendimentos</button>
                                                        </div>

                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="accordion mb-2" id="accordionExample" >
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingOne">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseDois" aria-expanded="true" aria-controls="collapseDois">
                                                <span class="destaque fw-bold">Resultado</span>
                                            </button>
                                        </h2>
                                        <div id="collapseDois" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#collapseDois">
                                            <div class="accordion-body">
                                                <div class="row">
                                                    
                                                <?php
                                                if($resultadoTotalAtendimentos["total_atendimentos"] > 0){ ?>
                                                    <div class="col-md-12 col-12 mb-3">
                                                        <div class="row">
                                                            <div class="col">
                                                                <div class="card mb-2">
  <div class="card-body text-center card-relatendimento" style="border: 1px solid rgba(0,143,251,0.85); box-shadow: 0 0px 4px 0px rgba(0,143,251,0.85);">
      <span>Abertos</span>
      <h6><?php echo $totaldeConsultasAbertas;?></h6>
  </div>
</div>
                                                            </div>
                                                            <div class="col">
                                                                <div class="card mb-2">
  <div class="card-body text-center card-relatendimento" style="border: 1px solid rgba(0,227,150,0.85); box-shadow: 0 0px 4px 0px rgba(0,227,150,0.85);">
      <span>Andamento</span>
      <h6><?php echo $totaldeConsultasEmAndamento;?></h6>
  </div>
</div>
                                                            </div>
                                                            <div class="col">
                                                                <div class="card mb-2">
  <div class="card-body text-center card-relatendimento" style="border: 1px solid rgba(254,176,25,0.85); box-shadow: 0 0px 3px 0px rgba(254,176,25,0.85);">
      <span>Aguardando</span>
      <h6><?php echo $totaldeConsultasAguardando;?></h6>
  </div>
</div>
                                                            </div>
                                                            <div class="col">
                                                                <div class="card mb-2">
  <div class="card-body text-center card-relatendimento" style="border: 1px solid rgba(255,69,96,0.85); box-shadow: 0 0px 4px 0px rgba(255,69,96,0.85);">
      <span>Pendentes</span>
      <h6><?php echo $totaldeConsultasPendente;?></h6>
  </div>
</div>
                                                            </div>
                                                            <div class="col">
                                                                <div class="card mb-2">
  <div class="card-body text-center card-relatendimento" style="border: 1px solid rgba(119,93,208,0.85); box-shadow: 0 0px 4px 0px rgba(119,93,208,0.85);">
      <span>Fechados</span>
      <h6><?php echo $totaldeConsultasFechado;?></h6>
  </div>
</div>
                                                            </div>
                                                            <div class="col">
                                                                <div class="card mb-2">
  <div class="card-body text-center card-relatendimento" style="border: 1px solid rgba(0,143,251,0.85); box-shadow: 0 0px 4px 0px rgba(0,143,251,0.85);">
      <span>Concluídos</span>
      <h6><?php echo $totaldeConsultasConcluido;?></h6>
  </div>
</div>
                                                            </div>
                                                            
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 col-12">
                                                       <div id="chart"></div>
                                                    </div>
                                                    <div class="col-12">

                                                        <div class="btn-toolbar mb-2 mb-md-0">
                                <div class="mr-2">
                                    <a class="btn btn-outline-danger mb-1" id="imprimirpdf" href="../ferramentas/relatorios/rel-atendimentosPdf.php?cooperativaAtendimento=<?php echo $cooperativaAtendimento;?>&areaAtendimento=<?php echo $areaAtendimento;?>&dataRefIncialF=<?php echo $dataRefIncialF;?>&dataRefFinalF=<?php echo $dataRefFinalF;?>" target="_blank" title="Exportar PDF"><i class="bi bi-filetype-pdf"></i> Exportar PDF</a>
                                    <a class="btn btn-outline-success mb-1" id="imprimirexcel" href="../ferramentas/relatorios/rel-atendimetosExcel.php?cooperativaAtendimento=<?php echo $cooperativaAtendimento;?>&areaAtendimento=<?php echo $areaAtendimento;?>&dataRefIncialF=<?php echo $dataRefIncialF;?>&dataRefFinalF=<?php echo $dataRefFinalF;?>" target="_blank" title="Exportar Excel"><i class="bi bi-file-earmark-spreadsheet"></i>Exportar Excel</a>
                                    <a onclick="printCertificate()" class="btn btn-dark mb-1" id="imprimirtela" title="Exportar Tela"><i class="bi bi-laptop"></i> Exportar Tela</a>
                                </div>
                            </div>
                                                    </div>
                                                <?php
                                                } else {
                                                    
                                                    ?>
                                                    <p class="text-center alert alert-warning">Não há dados para exibir com o filtro selecionado!</p>
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
            $(".nav .nav-link").on("click", function () {
                $(".nav").find(".menu-ativo").removeClass("menu-ativo");
                $(this).addClass("menu-ativo");
            });
        </script>
        <script src="../js/loading.js"></script>
        <script>
        
      
        var options = {
    "chart": {
        "animations": {
            "enabled": true,
            "easing": "swing"
        },
        "background": "#fff",
        "dropShadow": {
            "blur": 0
        },
        "foreColor": "#373D3F",
        "fontFamily": "Roboto",
        "height": 350,
        "id": "44St6",
        "toolbar": {
            "show": false
        },
        "type": "bar"
    },
    "plotOptions": {
        "bar": {
            "columnWidth": "80%",
            "borderRadius": 10,
            "colors": {
                "backgroundBarOpacity": 0.8
            },
            "dataLabels": {
                "position": "center"
            }
        },
        "radialBar": {
            "hollow": {
                "background": "#fff"
            },
            "dataLabels": {
                "name": {},
                "value": {},
                "total": {}
            }
        },
        "pie": {
            "donut": {
                "labels": {
                    "name": {},
                    "value": {},
                    "total": {}
                }
            }
        }
    },
    "dataLabels": {
        "offsetY": 5,
        formatter: function (val) {
              return val + "%";
            },
        "style": {
            "fontSize": 15,
            "colors": [
                "#f1f2f3"
            ]
        },
        "background": {
            "enabled": false
        }
    },
    "grid": {
        "show": false,
        "position": "front",
        "padding": {
            "right": 25,
            "left": 15
        }
    },
    "legend": {
        "floating": true,
        "position": "top",
        "fontSize": 14,
        "offsetY": 0,
        "markers": {
            "shape": "square",
            "size": 8
        },
        "itemMargin": {
            "vertical": 0
        }
    },
    "series": [
        {
            "name": "Percentual",
            "data": [
                {
                    "x": "Abertos",
                    "y": <?php echo $percentualAbertos;?>,
                    "fillColor": "#008ffb"
                },
                {
                    "x": "Em Andamento",
                    "y": <?php echo $percentualEmAndamento;?>,
                    "fillColor": "#00e396"
                },
                {
                    "x": "Aguardando",
                    "y": <?php echo $percentualAguardando;?>,
                    "fillColor": "#feb019"
                },
                {
                    "x": "Pendente",
                    "y": <?php echo $percentualPendente;?>,
                    "fillColor": "#ff4560"
                },
                {
                    "x": "Fechado",
                    "y": <?php echo $percentualFechado;?>,
                    "fillColor": "#775dd0"
                },
                {
                    "x": "Concluído",
                    "y": <?php echo $percentualConcluido;?>,
                    "fillColor": "#008ffb"
                }
            ]
        }
    ],
    "stroke": {
        "show": false,
        "lineCap": "round"
    },
    "tooltip": {
        "shared": false,
        "intersect": true
    },
    "xaxis": {
        "labels": {
            "trim": true,
            "style": {}
        },
        "tickPlacement": "between",
        "position": "top",
        "title": {
            "text": "% DE CONSULTAS POR SITUAÇÃO",
            "offsetY": 320,
            "style": {
                "fontSize": 15,
                "fontWeight": 500
            }
        },
        "tooltip": {
            "enabled": true
        }
    },
    "yaxis": {
        "show": false,
        "tickAmount": 5,
        "labels": {
            "style": {}
        },
        "title": {
            "offsetY": 75,
            "offsetX": 7,
            "style": {
                "fontWeight": 700
            }
        }
    },
    "theme": {
        "palette": "palette3"
    }
};

        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();
      
      
    
        </script>
        <script>
        function printCertificate() {
            document.getElementById('filtrarAtendimento').style.display = 'none';
            document.getElementById('imprimirpdf').style.display = 'none';
            document.getElementById('imprimirexcel').style.display = 'none';
            document.getElementById('imprimirtela').style.display = 'none';
            const printContents = document.getElementById('renderPDF').innerHTML;
            const originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
            document.getElementById('filtrarAtendimento').style.display = 'inline';
            document.getElementById('imprimirpdf').style.display = 'inline';
            document.getElementById('imprimirexcel').style.display = 'inline';
            document.getElementById('imprimirtela').style.display = 'inline';
        }
    </script>
    </body>
</html>
