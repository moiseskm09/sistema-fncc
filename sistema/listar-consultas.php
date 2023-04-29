<?php
require_once '../config/sessao.php';
require_once '../config/conexao.php';
//require_once '../config/config_geral.php';

if(isset($_GET["areaAtendimento"])){
    if($USERGRUPO == 4){
        $CoopAtendimento = "";
    }else{
        $CoopAtendimento = $_GET["coopAtendimento"];
    }
$situacaoAtendimento = $_GET["situacaoAtendimento"];
$areaAtendimento = $_GET["areaAtendimento"];

if(!empty($_GET['dataRefIncialF'])){$dataRefIncialF = date("Y-m-d 00:00:01", strtotime($_GET['dataRefIncialF']));}else{ $dataRefIncialF = date("2022-m-d 00:00:01");}
if(!empty($_GET['dataRefFinalF'])){$dataRefFinalF = date("Y-m-d 23:59:59", strtotime($_GET['dataRefFinalF']));}else{ $dataRefFinalF = date("Y-m-d 23:59:59");}

if(!empty($_GET["visibilidadeAtendimento"])){
if($USERGRUPO == 4 && $_GET["visibilidadeAtendimento"] != "qualquer_um"){
    $visibilidadeAtendimento = $_GET["visibilidadeAtendimento"];
    $parteSql = "cons_user != '$CODIGOUSUARIO' and cons_visibilidade = '$visibilidadeAtendimento' and cons_coop = '$COOPERATIVA' and cons_grupo like '%$areaAtendimento%' and data_consulta >= '$dataRefIncialF' and data_consulta <= '$dataRefFinalF' and cons_situacao like '%$situacaoAtendimento%'";
}else{
 $visibilidadeAtendimento = $_GET["visibilidadeAtendimento"];   
 $parteSql = "cons_user != '$CODIGOUSUARIO' and cons_visibilidade = '$visibilidadeAtendimento' and cons_grupo like '%$areaAtendimento%' and data_consulta >= '$dataRefIncialF' and data_consulta <= '$dataRefFinalF' and cons_coop like '%$CoopAtendimento%' and cons_situacao like '%$situacaoAtendimento%'";
}
}else{
 $visibilidadeAtendimento = $_GET["visibilidadeAtendimento"];   
 $parteSql = "cons_user != '$CODIGOUSUARIO' and cons_visibilidade = '$visibilidadeAtendimento' and cons_grupo like '%$areaAtendimento%' and data_consulta >= '$dataRefIncialF' and data_consulta <= '$dataRefFinalF' and cons_coop like '%$CoopAtendimento%' and cons_situacao like '%$situacaoAtendimento%'";   
}



if($USERGRUPO == 4){
  $sql_buscaConsultasFiltro = mysqli_query($conexao, "SELECT cod_consulta, data_consulta, cons_assunto, grupo, nome, cooperativa, data_previsao, situacao, visibilidade FROM consultas INNER JOIN grupos_usuarios ON cons_grupo = cod_grupo INNER JOIN usuarios ON cons_user = id_usuario INNER JOIN cooperativas ON cons_coop = cod_coop INNER JOIN situacao_consultas ON cons_situacao = cod_situacao INNER JOIN visibilidade ON cons_visibilidade = visibilidade_valor WHERE cons_user = '$CODIGOUSUARIO' and cons_visibilidade = '$visibilidadeAtendimento' and cons_grupo like '%$areaAtendimento%' and data_consulta >= '$dataRefIncialF' and data_consulta <= '$dataRefFinalF' and cons_coop like '%$CoopAtendimento%' and cons_situacao like '%$situacaoAtendimento%' OR $parteSql ORDER BY cons_situacao ASC, cons_visibilidade asc, data_consulta DESC, cod_consulta ASC LIMIT 50");
  
}elseif($USERGRUPO != 4 && $NIVEL != 1 AND $NIVEL != 2){
 $sql_buscaConsultasFiltro = mysqli_query($conexao, "SELECT cod_consulta, data_consulta, cons_assunto, grupo, nome, cooperativa, data_previsao, situacao, visibilidade FROM consultas INNER JOIN grupos_usuarios ON cons_grupo = cod_grupo INNER JOIN usuarios ON cons_user = id_usuario INNER JOIN cooperativas ON cons_coop = cod_coop INNER JOIN situacao_consultas ON cons_situacao = cod_situacao INNER JOIN visibilidade ON cons_visibilidade = visibilidade_valor WHERE cons_user = '$CODIGOUSUARIO' and cons_grupo like '%$USERGRUPO%' and data_consulta >= '$dataRefIncialF' and data_consulta <= '$dataRefFinalF' and cons_coop like '%$CoopAtendimento%' and cons_situacao like '%$situacaoAtendimento%' and cons_visibilidade like '%$visibilidadeAtendimento%' OR user_responsavel =  '$CODIGOUSUARIO' and cons_grupo like '%$USERGRUPO%' and data_consulta >= '$dataRefIncialF' and data_consulta <= '$dataRefFinalF' and cons_coop like '%$CoopAtendimento%' and cons_situacao like '%$situacaoAtendimento%' and cons_visibilidade like '%$visibilidadeAtendimento%' OR cons_grupo = '$USERGRUPO' and cons_grupo like '%$USERGRUPO%' and data_consulta >= '$dataRefIncialF' and data_consulta <= '$dataRefFinalF' and cons_coop like '%$CoopAtendimento%' and cons_situacao like '%$situacaoAtendimento%' and cons_visibilidade like '%$visibilidadeAtendimento%' ORDER BY cons_situacao ASC, cod_consulta asc, data_consulta ASC LIMIT 50");
}else{
    
   $sql_buscaConsultasFiltro  = mysqli_query($conexao, "SELECT cod_consulta, data_consulta, cons_assunto, grupo, nome, cooperativa, data_previsao, situacao, visibilidade FROM consultas INNER JOIN grupos_usuarios ON cons_grupo = cod_grupo INNER JOIN usuarios ON cons_user = id_usuario INNER JOIN cooperativas ON cons_coop = cod_coop INNER JOIN situacao_consultas ON cons_situacao = cod_situacao INNER JOIN visibilidade ON cons_visibilidade = visibilidade_valor WHERE cons_user = '$CODIGOUSUARIO' and cons_grupo like '%$areaAtendimento%' and data_consulta >= '$dataRefIncialF' and data_consulta <= '$dataRefFinalF' and cons_coop like '%$CoopAtendimento%' and cons_situacao like '%$situacaoAtendimento%' and cons_visibilidade like '%$visibilidadeAtendimento%' OR user_responsavel =  '$CODIGOUSUARIO' and cons_grupo like '%$areaAtendimento%' and data_consulta >= '$dataRefIncialF' and data_consulta <= '$dataRefFinalF' and cons_coop like '%$CoopAtendimento%' and cons_situacao like '%$situacaoAtendimento%' and cons_visibilidade like '%$visibilidadeAtendimento%' OR cons_grupo = '$USERGRUPO' and cons_grupo like '%$areaAtendimento%' and data_consulta >= '$dataRefIncialF' and data_consulta <= '$dataRefFinalF' and cons_coop like '%$CoopAtendimento%' and cons_situacao like '%$situacaoAtendimento%' and cons_visibilidade like '%$visibilidadeAtendimento%' OR cons_grupo != '$USERGRUPO' and cons_grupo like '%$areaAtendimento%' and data_consulta >= '$dataRefIncialF' and data_consulta <= '$dataRefFinalF' and cons_coop like '%$CoopAtendimento%' and cons_situacao like '%$situacaoAtendimento%' and cons_visibilidade like '%$visibilidadeAtendimento%' ORDER BY cons_grupo ASC, cons_situacao ASC, data_consulta ASC LIMIT 100");
}

$filtroON = 1;
//FIM FILTRO
}else{
if($USERGRUPO == 4){
  $sql_buscaMinhasConsultas = mysqli_query($conexao, "SELECT cod_consulta, data_consulta, cons_assunto, grupo, nome, cooperativa, data_previsao, situacao, visibilidade FROM consultas INNER JOIN grupos_usuarios ON cons_grupo = cod_grupo INNER JOIN usuarios ON cons_user = id_usuario INNER JOIN cooperativas ON cons_coop = cod_coop INNER JOIN situacao_consultas ON cons_situacao = cod_situacao INNER JOIN visibilidade ON cons_visibilidade = visibilidade_valor WHERE cons_user = '$CODIGOUSUARIO' OR cons_user != '$CODIGOUSUARIO' and cons_visibilidade = 'minha_coop' and cons_coop = '$COOPERATIVA' OR cons_user != '$CODIGOUSUARIO' and cons_visibilidade = 'qualquer_um' and cons_coop != '$COOPERATIVA' ORDER BY cons_situacao ASC, cons_visibilidade asc, data_consulta DESC, cod_consulta ASC LIMIT 50");
}elseif($USERGRUPO != 4 && $NIVEL != 1 AND $NIVEL != 2){
 $sql_buscaMinhasConsultas = mysqli_query($conexao, "SELECT cod_consulta, data_consulta, cons_assunto, grupo, nome, cooperativa, data_previsao, situacao, visibilidade FROM consultas INNER JOIN grupos_usuarios ON cons_grupo = cod_grupo INNER JOIN usuarios ON cons_user = id_usuario INNER JOIN cooperativas ON cons_coop = cod_coop INNER JOIN situacao_consultas ON cons_situacao = cod_situacao INNER JOIN visibilidade ON cons_visibilidade = visibilidade_valor WHERE cons_user = '$CODIGOUSUARIO' OR user_responsavel =  '$CODIGOUSUARIO' OR cons_grupo = '$USERGRUPO' ORDER BY cons_situacao ASC, cod_consulta asc, data_consulta ASC LIMIT 50");
}else{
   $sql_buscaMinhasConsultas = mysqli_query($conexao, "SELECT cod_consulta, data_consulta, cons_assunto, grupo, nome, cooperativa, data_previsao, situacao, visibilidade FROM consultas INNER JOIN grupos_usuarios ON cons_grupo = cod_grupo INNER JOIN usuarios ON cons_user = id_usuario INNER JOIN cooperativas ON cons_coop = cod_coop INNER JOIN situacao_consultas ON cons_situacao = cod_situacao INNER JOIN visibilidade ON cons_visibilidade = visibilidade_valor WHERE cons_user = '$CODIGOUSUARIO' OR user_responsavel =  '$CODIGOUSUARIO' OR cons_grupo = '$USERGRUPO' OR cons_grupo != '$USERGRUPO' ORDER BY cons_grupo ASC, cons_situacao ASC, data_consulta ASC LIMIT 100");
}
    $filtroON = 0;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
        <title>Listar Consultas</title>
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
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">
  
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>
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
                        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-1 pb-1 mb-1 border-bottom">
                            <div class="breadcrumb mb-2 mb-md-0" style="--bs-breadcrumb-divider: '>'; font-size: 16px;">
                      <span class="breadcrumb-item text-primary">Consultas</span>
                      <span class="breadcrumb-item active text-success">Listar Consultas</span>
                  </div>
                            <div class="btn-toolbar mb-2 mb-md-0">
                                <div class="mr-2">
                                    <a class="btn btn-sm btn-warning mb-1" onClick="history.go(-1)"><i class="uil uil-angle-left"></i> Voltar</a>
                                    <?php if($filtroON === 1){ ?>
                                    <a class="btn btn-sm btn-dark mb-1" href="listar-consultas.php"><i class="uil uil-filter-slash"></i> Limpar Filtro</a>
                                    <?php } ?>
                                    <a class="btn btn-sm btn-primary mb-1" href="#filtro" data-toggle="modal" data-target="#filtro"><i class="uil uil-filter"></i> Filtrar</a>
                                    <a class="btn btn-sm botaoAjuda mb-1" href="#ajuda" data-toggle="modal" data-target="#ajuda"><i class="bi bi-info-circle"></i> Ajuda</a>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-12">
<!-- Pills navs -->
<ul class="nav nav-pills nav-fill mb-1" id="ex1" role="tablist">
    <?php if($filtroON == 1){ } else {?>
  <li class="nav-item" role="presentation">
    <a class="nav-link active" id="ex2-tab-1" data-bs-toggle="pill" href="#ex2-pills-1" role="tab" aria-controls="ex2-pills-1" aria-selected="true">CONSULTAS</a>
  </li>
  <?php }?>
 <?php if($filtroON == 1){ ?>
  <li class="nav-item" role="presentation">
    <a class="nav-link active" id="ex2-tab-3" data-bs-toggle="pill" href="#ex2-pills-5" role="tab" aria-controls="ex2-pills-5" aria-selected="false">RESULTADO DO FILTRO</a>
  </li>
  <?php }else{} ?>
</ul>
<!-- Pills navs -->

<!-- Pills content -->
<div class="tab-content" id="ex2-content">
    <?php if($filtroON == 1){ } else {?>
  <div class="tab-pane fade show active" id="ex2-pills-1" role="tabpanel" aria-labelledby="ex2-tab-1">
    <div class="table-responsive">
                            <table class="table table-borderless order-column compact row-border tablesConsulta" style= "white-space: nowrap;">
                                <thead class="border theadN">
                                    <tr>
                                         <th>Nro | Abertura</th>
                                        <th>Assunto | Área de Atendimento</th>
                                        <th>Solicitante | Cooperativa</th>
                                        <th>Previsão | Situação</th>
                                        <th>Visibilidade</th>
                                        <th class="text-center">Ações</th>
                                    </tr>
                                </thead>
                                <tbody class="p-0 bg-white">
<?php
                                    if (mysqli_num_rows($sql_buscaMinhasConsultas) > 0) {
                                        while ($resultadoMinhasConsultas = mysqli_fetch_assoc($sql_buscaMinhasConsultas)) {
                                            ?>
                                            <tr class="linha-hover">
                                                <td style="font-size:15px;">
                                              <span class="text-primary"><?php echo str_pad($resultadoMinhasConsultas["cod_consulta"], 6, '0', STR_PAD_LEFT); ?></span>
                                              <br>
                                              <span class="destaque" style="font-size: 13px;"><?php echo strftime('%d.%m.%Y às %H:%M:%S', strtotime($resultadoMinhasConsultas["data_consulta"])); ?></span>
                                             </td>
                                             <td style="font-size:15px;">
                                              <span class="text-primary"> <?php echo substr($resultadoMinhasConsultas["cons_assunto"], 0, 30);?></span>
                                              <br>
                                              <span class="destaque" style="font-size: 13px;"><?php echo $resultadoMinhasConsultas['grupo']; ?></span>
                                             </td>
                                             <td style="font-size:15px;">
                                                 <span class="text-primary"> <?php echo substr($resultadoMinhasConsultas["nome"], 0, 30);?></span>
                                              <br>
                                              <span class="destaque" style="font-size: 13px;"><?php echo $resultadoMinhasConsultas['cooperativa']; ?></span>
                                             </td>
                                             <td style="font-size:15px;" style="text-align: center; vertical-align:middle !important">
                                                 <span class="destaque text-center"> <?php echo strftime('%d.%m.%Y às %H:%M:%S', strtotime($resultadoMinhasConsultas["data_previsao"]));?></span>
                                              <br>
                                              <div class="progress" style="font-size:15px;">
                                                                            <?php 
                                                  if($resultadoMinhasConsultas['situacao'] == "Aberto"){
                                                      echo '<span class="badge badge-success d-inline"  style="width: 100%;">'.$resultadoMinhasConsultas['situacao'].'</span>';
                                                  }elseif($resultadoMinhasConsultas['situacao'] == "Pendente"){
                                                     echo '<span class="badge badge-danger d-inline" style="width: 100%;">'.$resultadoMinhasConsultas['situacao'].'</span>'; 
                                                  }elseif($resultadoMinhasConsultas['situacao'] == "Em Andamento"){
                                                     echo '<span class="badge badge-primary d-inline" style="width: 100%;">'.$resultadoMinhasConsultas['situacao'].'</span>'; 
                                                  }elseif($resultadoMinhasConsultas['situacao'] == "Aguardando"){
                                                     echo '<span class="badge badge-warning d-inline" style="width: 100%;">'.$resultadoMinhasConsultas['situacao'].'</span>';  
                                                  }
                                                  elseif($resultadoMinhasConsultas['situacao'] == "Fechado"){
                                                     echo '<span class="badge badge-secondary d-inline" style="width: 100%;">'.$resultadoMinhasConsultas['situacao'].'</span>';  
                                                  }
                                                  elseif($resultadoMinhasConsultas['situacao'] == "Concluído"){
                                                     echo '<span class="badge badge-dark d-inline" style="width: 100%;">'.$resultadoMinhasConsultas['situacao'].'</span>';  
                                                  }
                                                  ?>
                                                                        </div>
                                             </td>
                                             <td style="font-size:14px;text-align: center; vertical-align:middle !important;">
                                                 <span class="destaque"> <?php echo $resultadoMinhasConsultas['visibilidade'];?></span>
                                             </td>
                                                <td class="text-center" style="text-align: center; vertical-align:middle !important;">
                                                    <a title="Editar" href="edicao-consulta.php?cod_consulta=<?php echo $resultadoMinhasConsultas['cod_consulta'];?>"><i class="bi bi-pencil-square btn-sm btn-warning"></i></a>
                                                </td> 
                                            </tr>
                                            <?php
                                        }
                                    } else {
                                    }
                                    ?>
                                            
                                </tbody>
                            </table>
                        </div>
  </div>
    <?php }?>
    <!-- filtrado -->
    <?php if($filtroON == 1){?>
    <div  class="tab-pane fade show active" id="ex2-pills-5" role="tabpanel"  aria-labelledby="ex2-tab-5">
    <div class="table-responsive">
                            <table class="table table-borderless order-column compact row-border tablesConsulta" style= "white-space: nowrap;">
                                <thead class="border theadN">
                                    <tr>
                                         <th>Nro | Abertura</th>
                                        <th>Assunto | Área de Atendimento</th>
                                        <th>Solicitante | Cooperativa</th>
                                        <th>Previsão | Situação</th>
                                        <th>Visibilidade</th>
                                        <th class="text-center">Ações</th>
                                    </tr>
                                </thead>
                                <tbody class="p-0 bg-white">
                                    <!-- Minhas Consultas -->
<?php
                                    if (mysqli_num_rows($sql_buscaConsultasFiltro) > 0) {
                                        while ($resultadoConsultasFiltro = mysqli_fetch_assoc($sql_buscaConsultasFiltro)) {
                                            ?>
                                            <tr class="linha-hover">
                                                <td style="font-size:15px;">
                                              <span class="text-primary"><?php echo str_pad($resultadoConsultasFiltro["cod_consulta"], 6, '0', STR_PAD_LEFT); ?></span>
                                              <br>
                                              <span class="destaque" style="font-size: 13px;"><?php echo strftime('%d.%m.%Y às %H:%M:%S', strtotime($resultadoConsultasFiltro["data_consulta"])); ?></span>
                                             </td>
                                             <td style="font-size:15px;">
                                              <span class="text-primary"> <?php echo substr($resultadoConsultasFiltro["cons_assunto"], 0, 30);?></span>
                                              <br>
                                              <span class="destaque" style="font-size: 13px;"><?php echo $resultadoConsultasFiltro['grupo']; ?></span>
                                             </td>
                                             <td style="font-size:15px;">
                                                 <span class="text-primary"> <?php echo substr($resultadoConsultasFiltro["nome"], 0, 30);?></span>
                                              <br>
                                              <span class="destaque" style="font-size: 13px;"><?php echo $resultadoConsultasFiltro['cooperativa']; ?></span>
                                             </td>
                                             <td style="font-size:15px;" style="text-align: center; vertical-align:middle !important">
                                                 <span class="destaque"> <?php echo strftime('%d.%m.%Y às %H:%M:%S', strtotime($resultadoConsultasFiltro["data_previsao"]));?></span>
                                              <br>
                                              <div class="progress">
                                                                            <?php 
                                                  if($resultadoConsultasFiltro['situacao'] == "Aberto"){
                                                      echo '<span class="badge badge-success d-inline"  style="width: 100%">'.$resultadoConsultasFiltro['situacao'].'</span>';
                                                  }elseif($resultadoConsultasFiltro['situacao'] == "Pendente"){
                                                     echo '<span class="badge badge-danger d-inline" style="width: 100%">'.$resultadoConsultasFiltro['situacao'].'</span>'; 
                                                  }elseif($resultadoConsultasFiltro['situacao'] == "Em Andamento"){
                                                     echo '<span class="badge badge-primary d-inline" style="width: 100%">'.$resultadoConsultasFiltro['situacao'].'</span>'; 
                                                  }elseif($resultadoConsultasFiltro['situacao'] == "Aguardando"){
                                                     echo '<span class="badge badge-warning d-inline" style="width: 100%">'.$resultadoConsultasFiltro['situacao'].'</span>';  
                                                  }
                                                  elseif($resultadoConsultasFiltro['situacao'] == "Fechado"){
                                                     echo '<span class="badge badge-secondary d-inline" style="width: 100%">'.$resultadoConsultasFiltro['situacao'].'</span>';  
                                                  }
                                                  elseif($resultadoConsultasFiltro['situacao'] == "Concluído"){
                                                     echo '<span class="badge badge-dark d-inline" style="width: 100%">'.$resultadoConsultasFiltro['situacao'].'</span>';  
                                                  }
                                                  ?>
                                                                        </div>
                                             </td>
                                             <td style="font-size:14px;text-align: center; vertical-align:middle !important;">
                                                 <span class="destaque"> <?php echo $resultadoConsultasFiltro['visibilidade'];?></span>
                                             </td>
                                                <td class="text-center" style="text-align: center; vertical-align:middle !important">
                                                    <a title="Editar" href="edicao-consulta.php?cod_consulta=<?php echo $resultadoConsultasFiltro['cod_consulta'];?>"><i class="bi bi-pencil-square btn-sm btn-warning"></i></a>
                                                </td> 
                                            </tr>
                                            <?php
                                        }
                                    } else {
                                        ?>
                                        <?php
                                    }
                                    ?> 
                                            <!-- fim minhas consultas -->
                                            
                                </tbody>
                            </table>
                        </div>
      
      
  </div>
    <?php }?>
    <!-- fim filtro -->
</div>
<!-- Pills content -->
                            </div>
                        </div>
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
                                                <p>Consultas marcadas com a visibilidade <code>Qualquer Um</code> serão visíveis para todos as cooperativas e usuários do sistema.</p>
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
                                                <h6 class="destaque">Filtro</h6>
                                                <p>O filtro aplicado será definido em todas as abas.</p>
                                            </div>
                                            <div class="col-12">
                                                <h6 class="destaque">Abas</h6>
                                                <p><code>MINHAS</code><br>Exibe todas as consultas abertas em seu nome.<br> Para Consultores exibirá consultas em que é responsável.</p>
                                            </div>
                                            <div class="col-12">
                                                <p><code>MINHA COOPERATIVA</code><br>Exibe todas as consultas abertas da cooperativa que o usuário faz parte e que estão com status de visualização <code>MINHA COOPERATIVA</code> e <code>PÚBLICAS</code>.<br> Não está disponível para Consultores.</p>
                                            </div>
                                            <div class="col-12">
                                                <p><code>PÚBLICAS</code><br>Exibe todas as consultas abertas da cooperativa que o usuário <strong>NÃO</strong> faz parte e que estão com status de visualização <code>PÚBLICA</code>.<br> Não está disponível para Consultores.</p>
                                            </div>
                                            <div class="col-12">
                                                <p><code>MEU GRUPO</code><br>Disponível apenas para <code>Consultores</code>, exibe consultas abertas para a sua área de atendimento.</p>
                                            </div>
                                            <div class="col-12 text-end">
                                                <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal" aria-label="Fechar"><i class="bi bi-x"></i> Fechar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        
                                           <!-- Modal Filtro -->
<div class="modal fade" id="filtro" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header header-filtro">
        <h5 class="modal-title" id="exampleModalLabel">Filtrar dados</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body card-fundo-body">
          <form action="" method="GET">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-12">                   
  <div class="form-floating mb-3">
      <!-- coop -->
      <?php 
      /*
      if($USERGRUPO == "4"){
          $consultaCoopAtendimento = mysqli_query($conexao, "SELECT cod_coop, cooperativa FROM cooperativas WHERE cod_coop = '$COOPERATIVA'");
      ?>
      <select class="form-select pesquisa-select" name="coopAtendimento">
      <option value="">Selecione</option>
      <?php
      while ($CoopAtendimento = mysqli_fetch_assoc($consultaCoopAtendimento)) {
       ?>
       <option class="text-dark" value="<?php echo $CoopAtendimento["cod_coop"]; ?>"><?php echo ucwords($CoopAtendimento["cooperativa"]); ?></option>   

      <?php
      }
      ?>
       </select>
             <label for="coopAtendimento">Cooperativa</label>
       <?php
      }else{ 
      }
      */
      ?>
      <!-- coop -->
      
      <!-- demais  users -->
      <?php 
      if($USERGRUPO != "4"){
          $consultaCoopAtendimento = mysqli_query($conexao, "SELECT cod_coop, cooperativa FROM cooperativas");
          ?>
      <select class="form-select pesquisa-select" name="coopAtendimento">
      <option value="">Todas</option>
      <?php
      while ($CoopAtendimento = mysqli_fetch_assoc($consultaCoopAtendimento)) {
          ?>
      <option class="text-dark" value="<?php echo $CoopAtendimento["cod_coop"]; ?>"><?php echo ucwords($CoopAtendimento["cooperativa"]); ?></option>   
      <?php
      }
      ?>
      </select>
             <label for="coopAtendimento">Cooperativa</label>
      <?php
      }else{ 
       }
       ?>
       <!-- demais  users -->
                                        </div>

  </div>
                
              
                  <?php if($USERGRUPO == 2 || $USERGRUPO == 3 ){
                      $consultaareaAtendimento = mysqli_query($conexao, "SELECT * FROM grupos_usuarios WHERE cod_grupo = '$USERGRUPO'");
                      if (mysqli_num_rows($consultaareaAtendimento) > 0) {
                          $areaAtendimento = mysqli_fetch_assoc($consultaareaAtendimento);
                      ?>
                  <input type="hidden" name="areaAtendimento" class="form-control" id="coop_razao" placeholder="Grupo" autocomplete="off" value="<?php echo ucwords($areaAtendimento["cod_grupo"]); ?>">
          <!--        <div class="form-floating mb-3">
                      <input type="text" class="form-control" id="grupo_texto" placeholder="Grupo" autocomplete="off" value="<?php/* echo ucwords($areaAtendimento["grupo"]); */?>">
                            <label for="grupo_texto">GRUPO</label>
                          </div> -->
                  <?php }else { } ?>
                      <?php }else {?>
                  <div class="col-lg-6 col-md-6 col-12">
                  <div class="form-floating mb-3">
                                            <select class="form-select pesquisa-select" name="areaAtendimento">
                                                <option value="">Todas</option>
                                                <?php
                                                $consultaareaAtendimento = mysqli_query($conexao, "SELECT * FROM grupos_usuarios");
                                                if (mysqli_num_rows($consultaareaAtendimento) > 0) {
                                                    while ($areaAtendimento = mysqli_fetch_assoc($consultaareaAtendimento)) {
                                                        if($areaAtendimento["grupo"] == "Cooperativas"){
                                                            
                                                        }else{
                                                            ?>

                                                            <option class="text-dark" value="<?php echo $areaAtendimento["cod_grupo"]; ?>"><?php echo ucwords($areaAtendimento["grupo"]); ?></option>   
                                                    <?php
                                                    } }
                                        } else {
                                            
                                        }
                                        ?>
                                            </select>
                                            <label for="areaAtendimento">Área de atendimento</label>
                                        </div>
                      </div>
                  <?php } ?>
  
                <div class="col-lg-6 col-md-6 col-12">
  <div class="form-floating mb-3">
                                            <select class="form-select pesquisa-select" name="situacaoAtendimento">
                                                <option value="">Todas</option>
                                                <?php
                                                $consultaSituacaoAtendimento = mysqli_query($conexao, "SELECT * FROM  situacao_consultas");
                                                if (mysqli_num_rows($consultaSituacaoAtendimento) > 0) {
                                                    while ($situacaoAtendimento = mysqli_fetch_assoc($consultaSituacaoAtendimento)) {
                                                            ?>
                                                            <option class="text-dark" value="<?php echo $situacaoAtendimento["cod_situacao"]; ?>"><?php echo ucwords($situacaoAtendimento["situacao"]); ?></option>   
                                                    <?php
                                      }
                                        } else {
                                            
                                        }
                                        ?>
                                            </select>
                                            <label for="situacaoAtendimento">Situação</label>
                                        </div>
  </div>
                <div class="col-lg-6 col-md-6 col-12">
                                                    <div class="form-floating mb-3">
                                                        <input type="date" name="dataRefIncialF" id="dataRefIncialF" class="form-control" placeholder="Insira a data ref inicial" autocomplete="off">
                                                        <label for="dataRefIncialF">Data Abertura Inicial <span class="text-danger">*</span></label>
                                                    </div>  
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-12">
                                                    <div class="form-floating mb-3">
                                                        <input type="date" name="dataRefFinalF" id="dataRefFinalF" class="form-control" placeholder="Insira a data ref final" autocomplete="off">
                                                        <label for="dataRefFinalF">Data Abertura Final <span class="text-danger">*</span></label>
                                                    </div>  
                                                </div>
                <div class="<?php if($USERGRUPO == 2 || $USERGRUPO == 3 ){ echo "col-lg-6 col-md-6 col-12";}else { echo "col-lg-12 col-md-12 col-12"; }?>">
  <div class="form-floating mb-3">
                                            <select class="form-select pesquisa-select" name="visibilidadeAtendimento">
                                                <option value="">Todas</option>
                                                <?php
                                                $consultaVisibilidadeAtendimento = mysqli_query($conexao, "SELECT * FROM  visibilidade");
                                                if (mysqli_num_rows($consultaSituacaoAtendimento) > 0) {
                                                    while ($visibilidadeAtendimento = mysqli_fetch_assoc($consultaVisibilidadeAtendimento)) {
                                                            ?>
                                                            <option class="text-dark" value="<?php echo $visibilidadeAtendimento["visibilidade_valor"]; ?>"><?php echo ucwords($visibilidadeAtendimento["visibilidade"]); ?></option>   
                                                    <?php
                                      }
                                        } else {
                                            
                                        }
                                        ?>
                                            </select>
                                            <label for="visibilidadeAtendimento">Visibilidade</label>
                                        </div>
  </div>
            </div>
      </div>
      <div class="modal-footer card-fundo-body p-1">
          <button type="submit" class="btn btn-success loading btn-sm"><i class="uil uil-filter"></i> Filtrar</button>
        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="uil uil-times"></i> Cancelar</button>
        </form>
      </div>
    </div>
  </div>
</div>    
                        
                       <!-- fim modal filtro -->
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
         <script type="text/javascript">

    $(document).ready(function () {
        $('table.tablesConsulta').DataTable({
            dom: 'Bfrtip',
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
