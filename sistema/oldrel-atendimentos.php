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
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">
  
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.3.4/css/buttons.dataTables.min.css">
<script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.flash.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.3.4/js/buttons.html5.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.3.4/js/buttons.print.min.js"></script>
        <!-- Styles -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" />
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
                            <h5 class="titulo">Relatório de Atendimento</h5>
                            <div class="btn-toolbar mb-2 mb-md-0">
                                <div class="mr-2">
                                    <a class="btn btn-sm btn-warning mb-1" onClick="history.go(-1)"><i class="uil uil-angle-left"></i> Voltar</a>
                                    <a class="btn btn-sm btn-primary mb-1" href="#ajuda" data-toggle="modal" data-target="#ajuda"><i class="bi bi-question"></i> Ajuda</a>                                  
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
                                                                <label for="areaAtendimento">Aréa de Atendimento</label>
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
                                                            <button type="submit" class="btn btn-sm btn-success"><i class="bi bi-funnel"></i> Filtrar Atendimentos</button>
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
  <div class="card-body text-center card-relatendimento" style="box-shadow: 0 0px 4px 0px rgba(0,143,251,0.85);">
      <span>Abertos</span>
      <h6><?php echo $totaldeConsultasAbertas;?></h6>
  </div>
</div>
                                                            </div>
                                                            <div class="col">
                                                                <div class="card mb-2">
  <div class="card-body text-center card-relatendimento" style="box-shadow: 0 0px 4px 0px rgba(0,227,150,0.85);">
      <span>Andamento</span>
      <h6><?php echo $totaldeConsultasEmAndamento;?></h6>
  </div>
</div>
                                                            </div>
                                                            <div class="col">
                                                                <div class="card mb-2">
  <div class="card-body text-center card-relatendimento" style="box-shadow: 0 0px 4px 0px rgba(254,176,25,0.85);">
      <span>Aguardando</span>
      <h6><?php echo $totaldeConsultasAguardando;?></h6>
  </div>
</div>
                                                            </div>
                                                            <div class="col">
                                                                <div class="card mb-2">
  <div class="card-body text-center card-relatendimento" style="box-shadow: 0 0px 4px 0px rgba(255,69,96,0.85);">
      <span>Pendentes</span>
      <h6><?php echo $totaldeConsultasPendente;?></h6>
  </div>
</div>
                                                            </div>
                                                            <div class="col">
                                                                <div class="card mb-2">
  <div class="card-body text-center card-relatendimento" style="box-shadow: 0 0px 4px 0px rgba(119,93,208,0.85);">
      <span>Fechados</span>
      <h6><?php echo $totaldeConsultasFechado;?></h6>
  </div>
</div>
                                                            </div>
                                                            <div class="col">
                                                                <div class="card mb-2">
  <div class="card-body text-center card-relatendimento" style="box-shadow: 0 0px 4px 0px rgba(0,143,251,0.85);">
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
                                                    
                                                    
                                                    <div class="col-12 mt-3 mb-2">
                                                        
                                                        <table class="mt-2 mb-2 table border-0 p-0 table-sm display tabelasAtendimento" style="visibility: hidden; height: 10px; width: 100%;">
                                                            
    <thead style="visibility: hidden; height: 10px;">
        <tr>
            <th>Situação</th>
            <th>Quantidade</th>
            <th>Percentual</th>
        </tr>
    </thead>
   
    <tbody style="visibility: hidden; height: 10px;">
        <tr>
            <td>Abertos</td>
            <td><?php echo $totaldeConsultasAbertas;?></td>
            <td><?php echo $percentualAbertos."%"?></td>
        </tr>
        <tr>
            <td>Em Andamento</td>
            <td><?php echo $totaldeConsultasEmAndamento;?></td>
            <td><?php echo $percentualEmAndamento."%"?></td>
        </tr>
        <tr>
            <td>Aguardando</td>
            <td><?php echo $totaldeConsultasAguardando;?></td>
            <td><?php echo $percentualAguardando."%"?></td>
        </tr>
        <tr>
            <td>Pendentes</td>
            <td><?php echo $totaldeConsultasPendente;?></td>
            <td><?php echo $percentualPendente."%"?></td>
        </tr>
        <tr>
            <td>Fechados</td>
            <td><?php echo $totaldeConsultasFechado;?></td>
            <td><?php echo $percentualFechado."%"?></td>
        </tr>
        <tr>
            <td>Concluídos</td>
            <td><?php echo $totaldeConsultasConcluido;?></td>
            <td><?php echo $percentualConcluido."%"?></td>
        </tr>
    </tbody>
    <tfoot>
            <tr>
                <th>Name</th>
                <th>Position</th>
                <th>Salary</th>
        </tfoot>
</table>
                                                    </div>
                                                    <div class="col-12">
                                                        <a class="btn btn-outline-dark mb-1" href="../ferramentas/imprimirConsulta.php?cooperativaAtendimento=<?php echo $cooperativaAtendimento;?>&areaAtendimento=<?php echo $areaAtendimento;?>&dataRefIncialF=<?php echo $dataRefIncialF;?>&dataRefFinalF=<?php echo $dataRefFinalF;?>" target="_blank" title="Imprimir"><i class="bi bi-filetype-pdf"></i> Exportar PDF</a>
                                                        <a class="btn btn-outline-success mb-1" href="../ferramentas/imprimirExcelConsulta.php?cooperativaAtendimento=<?php echo $cooperativaAtendimento;?>&areaAtendimento=<?php echo $areaAtendimento;?>&dataRefIncialF=<?php echo $dataRefIncialF;?>&dataRefFinalF=<?php echo $dataRefFinalF;?>" target="_blank" title="Imprimir"><i class="bi bi-file-earmark-spreadsheet"></i> Exportar Excel</a>
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
          series: [{
          name: 'Percentual Consultas',
          data: [
                      <?php echo $percentualAbertos;?>,
                      <?php echo $percentualEmAndamento;?>,
                      <?php echo $percentualAguardando;?>,
                      <?php echo $percentualPendente;?>,
                      <?php echo $percentualFechado;?>,
                      <?php echo $percentualConcluido;?>]
        }],
          chart: {
          height: 350,
          type: 'bar',
           background: '#fff',
           toolbar: {
        show: false,
        offsetX: 0,
        offsetY: 0,
        tools: {
          download: false
        }
      }
        },
        
        
        plotOptions: {
          bar: {
            borderRadius: 10,
            distributed: true,
            dataLabels: {
              position: 'center' // top, center, bottom
              
            }
          }
        },
        dataLabels: {
          enabled: true,
          formatter: function (val) {
            return val + "%";
          },
          offsetY: -20,
          style: {
            fontSize: '15px',
            colors: ["#ffffff"]
          }
        },
        legend: {
          show: false
        },
        xaxis: {
          categories: ["Aberto", "Em Andamento", "Aguardando", "Pendente", "Fechado", "Concluído"],
          position: 'top',
          axisBorder: {
            show: false
          },
          axisTicks: {
            show: false
          },
          crosshairs: {
            fill: {
              type: 'gradient',
              gradient: {
                colorFrom: '#D8E3F0',
                colorTo: '#BED1E6',
                stops: [0, 100],
                opacityFrom: 0.4,
                opacityTo: 0.5,
              }
            }
          },
          tooltip: {
            enabled: true,
          }
        },
        yaxis: {
          axisBorder: {
            show: false
          },
          axisTicks: {
            show: false,
          },
          labels: {
            show: false,
            formatter: function (val) {
              return val + "%";
            }
          }
        
        },
        title: {
          text: 'Percentual de consultas por status',
          floating: true,
          offsetY: 330,
          align: 'center',
          style: {
            color: '#444'
          }
        }
        };

        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();
      
      
    
        </script>
        
        <script type="text/javascript">

    $(document).ready(function () {
        $('table.tabelasAtendimento').DataTable({
            dom: 'Bfrtip',
            "scrollX": false,
            "scrollY": "0",
            "scrollCollapse": false,
            "paging": false,
             buttons: [
                {
                extend: 'excelHtml5',
                title: 'Relatório de Atendimentos',
                messageTop: 'Filtro:  <?php echo "Cooperativa: ".$coopHeaderExport." || Area de Atendimento: ". $AreaHeaderExport." || Data Inicial: ".$dataRefInicialExport." || Data Final: ".$dataRefFinalExport;?>',
                text: 'Exportar Excel',
        className: 'red'
            },
            {
                extend: 'csvHtml5',
                title: 'Relatório de Atendimentos',
                messageTop: 'Filtro:  <?php echo "Cooperativa: ".$coopHeaderExport." || Area de Atendimento: ". $AreaHeaderExport." || Data Inicial: ".$dataRefInicialExport." || Data Final: ".$dataRefFinalExport;?>',
                text: 'Exportar CSV'
                
            },
            {
                extend: 'pdfHtml5',
                title: 'Relatório de Atendimentos',
                messageTop: 'Filtro:  <?php echo "Cooperativa: ".$coopHeaderExport." || Area de Atendimento: ". $AreaHeaderExport." || Data Inicial: ".$dataRefInicialExport." || Data Final: ".$dataRefFinalExport;?>',
                text: 'Exportar PDF'
            },
            {
                extend: 'copyHtml5',
                title: 'Relatório de Atendimentos',
                messageTop: 'Filtro:  <?php echo "Cooperativa: ".$coopHeaderExport." || Area de Atendimento: ". $AreaHeaderExport." || Data Inicial: ".$dataRefInicialExport." || Data Final: ".$dataRefFinalExport;?>',
                text: 'Copiar para &aacute;rea de transfer&ecirc;ncia'
            },
            {
                extend: 'print',
                title: 'Relatório de Atendimentos',
                messageTop: 'Filtro:  <?php echo "Cooperativa: ".$coopHeaderExport." || Area de Atendimento: ". $AreaHeaderExport." || Data Inicial: ".$dataRefInicialExport." || Data Final: ".$dataRefFinalExport;?>',
                text: 'Imprimir',
                "bFooter": true
            }
            ],
            "ordering": false,
            "filter": false,
            "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.22/i18n/Portuguese-Brasil.json",
                "oAria": {
                    "sSortAscending": ": Ordenar colunas de forma ascendente",
                    "sSortDescending": ": Ordenar colunas de forma descendente"
                }
            }
        });
    });
</script>

    </body>
</html>
