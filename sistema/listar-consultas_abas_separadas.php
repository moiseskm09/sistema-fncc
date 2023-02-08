<?php
require_once '../config/sessao.php';
require_once '../config/conexao.php';
//require_once '../config/config_geral.php';

if(isset($_GET["areaAtendimento"])){
    $areaAtendimento = $_GET["areaAtendimento"];
if(!empty($_GET['dataRefIncialF'])){$dataRefIncialF = date("Y-m-d 00:00:01", strtotime($_GET['dataRefIncialF']));}else{ $dataRefIncialF = date("2022-m-d 00:00:01");}
if(!empty($_GET['dataRefFinalF'])){$dataRefFinalF = date("Y-m-d 23:59:59", strtotime($_GET['dataRefFinalF']));}else{ $dataRefFinalF = date("Y-m-d 23:59:59");}

// COMEÇO FILTRO
    //Filtro 1 Minhas consultas
    if($USERGRUPO == 4){   
$sql_buscaConsultasFiltro = mysqli_query($conexao, "SELECT * FROM consultas INNER JOIN grupos_usuarios ON cons_grupo = cod_grupo INNER JOIN usuarios ON cons_user = id_usuario INNER JOIN cooperativas ON cons_coop = cod_coop INNER JOIN situacao_consultas ON cons_situacao = cod_situacao WHERE cons_user = '$CODIGOUSUARIO' and cons_grupo like '%$areaAtendimento%' and data_consulta >= '$dataRefIncialF' and data_consulta <= '$dataRefFinalF' ORDER BY cons_situacao ASC, cod_consulta DESC, cons_urgencia ASC");
}else{ 
 $sql_buscaConsultasFiltro = mysqli_query($conexao, "SELECT * FROM consultas INNER JOIN grupos_usuarios ON cons_grupo = cod_grupo INNER JOIN usuarios ON cons_user = id_usuario INNER JOIN cooperativas ON cons_coop = cod_coop INNER JOIN situacao_consultas ON cons_situacao = cod_situacao WHERE cons_user = '$CODIGOUSUARIO' and cons_grupo like '%$areaAtendimento%' and data_consulta >= '$dataRefIncialF' and data_consulta <= '$dataRefFinalF' OR user_responsavel = '$CODIGOUSUARIO' and cons_grupo like '%$areaAtendimento%' and data_consulta >= '$dataRefIncialF' and data_consulta <= '$dataRefFinalF' ORDER BY cons_situacao ASC, cod_consulta DESC, cons_urgencia ASC");
}
// fim filtro 1 minhas consultas
    //Filtro 2 Minha Coop ou Meu Grupo consultas
if($USERGRUPO == 4){
    $sql_buscaCoopConsultas = mysqli_query($conexao, "SELECT * FROM consultas INNER JOIN grupos_usuarios ON cons_grupo = cod_grupo INNER JOIN usuarios ON cons_user = id_usuario INNER JOIN cooperativas ON cons_coop = cod_coop INNER JOIN situacao_consultas ON cons_situacao = cod_situacao WHERE cons_user != '$CODIGOUSUARIO' and cons_coop = '$COOPERATIVA' and cons_visibilidade != 'eu' and cons_visibilidade = 'minha_coop' and cons_grupo like '%$areaAtendimento%' and data_consulta >= '$dataRefIncialF' and data_consulta <= '$dataRefFinalF' ORDER BY cons_situacao ASC, cod_consulta DESC, cons_urgencia ASC");
            }else{
                if($areaAtendimento != $USERGRUPO && $NIVEL != 2 AND $NIVEL != 1){
            $sql_buscaCoopConsultas = mysqli_query($conexao, "SELECT * FROM consultas INNER JOIN grupos_usuarios ON cons_grupo = cod_grupo INNER JOIN usuarios ON cons_user = id_usuario INNER JOIN cooperativas ON cons_coop = cod_coop INNER JOIN situacao_consultas ON cons_situacao = cod_situacao WHERE cons_user != '$CODIGOUSUARIO' and user_responsavel != '$CODIGOUSUARIO' and cons_coop = '$COOPERATIVA' and cons_grupo = '$USERGRUPO' and data_consulta >= '$dataRefIncialF' and data_consulta <= '$dataRefFinalF' ORDER BY cons_situacao ASC, cod_consulta DESC, cons_urgencia ASC");  
          echo '<div class="toast-container position-fixed bottom-0 end-0 p-3 ">
            <div id="liveToastGrupo" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="4000">
                <div class="toast-header border-light" style="background-color: #a3cfbb; color: #1c1d3c;">
                    <strong class="me-auto">FNCC AVISA</strong>
                    <small>Agora</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body" style="background-color: #a3cfbb; color: #1c1d3c;"">
                    <span>Você pode ver somente consultas do seu grupo!</span>
                </div>
            </div>
        </div>';
            }else{
               $sql_buscaCoopConsultas = mysqli_query($conexao, "SELECT * FROM consultas INNER JOIN grupos_usuarios ON cons_grupo = cod_grupo INNER JOIN usuarios ON cons_user = id_usuario INNER JOIN cooperativas ON cons_coop = cod_coop INNER JOIN situacao_consultas ON cons_situacao = cod_situacao WHERE cons_user != '$CODIGOUSUARIO' and user_responsavel != '$CODIGOUSUARIO' and cons_coop = '$COOPERATIVA' and cons_grupo like '%$areaAtendimento%' and data_consulta >= '$dataRefIncialF' and data_consulta <= '$dataRefFinalF' ORDER BY cons_situacao ASC, cod_consulta DESC, cons_urgencia ASC");   
              //echo "você pode fazer consultas";
            }
            }
// fim filtro 2 Minha Coop ou Meu Grupo consultas
                //Filtro 3 Publicas consultas
           if($USERGRUPO == 4){
$sql_buscaPublicaConsultas = mysqli_query($conexao, "SELECT * FROM consultas INNER JOIN grupos_usuarios ON cons_grupo = cod_grupo INNER JOIN usuarios ON cons_user = id_usuario INNER JOIN cooperativas ON cons_coop = cod_coop INNER JOIN situacao_consultas ON cons_situacao = cod_situacao WHERE cons_user != '$CODIGOUSUARIO' and user_responsavel != '$CODIGOUSUARIO' and cons_coop != '$COOPERATIVA' and cons_visibilidade != 'eu' and cons_visibilidade != 'minha_coop' and cons_visibilidade = 'qualquer_um' and cons_grupo like '%$areaAtendimento%' and data_consulta >= '$dataRefIncialF' and data_consulta <= '$dataRefFinalF' ORDER BY cons_situacao ASC, cod_consulta DESC, cons_urgencia ASC");
           }elseif($areaAtendimento != $USERGRUPO && $NIVEL != 2 AND $NIVEL != 1){
               $sql_buscaPublicaConsultas = mysqli_query($conexao, "SELECT * FROM consultas INNER JOIN grupos_usuarios ON cons_grupo = cod_grupo INNER JOIN usuarios ON cons_user = id_usuario INNER JOIN cooperativas ON cons_coop = cod_coop INNER JOIN situacao_consultas ON cons_situacao = cod_situacao WHERE cons_user != '$CODIGOUSUARIO' and user_responsavel != '$CODIGOUSUARIO' and cons_coop != '$COOPERATIVA' and cons_visibilidade != 'eu' and cons_visibilidade != 'minha_coop' and cons_visibilidade = 'qualquer_um' and cons_grupo like '%$USERGRUPO%' and data_consulta >= '$dataRefIncialF' and data_consulta <= '$dataRefFinalF' ORDER BY cons_situacao ASC, cod_consulta DESC, cons_urgencia ASC");
               //echo "você pode fazer consultas plublicas somente para seu grupo";
           }else{
            $sql_buscaPublicaConsultas = mysqli_query($conexao, "SELECT * FROM consultas INNER JOIN grupos_usuarios ON cons_grupo = cod_grupo INNER JOIN usuarios ON cons_user = id_usuario INNER JOIN cooperativas ON cons_coop = cod_coop INNER JOIN situacao_consultas ON cons_situacao = cod_situacao WHERE cons_user != '$CODIGOUSUARIO' and user_responsavel != '$CODIGOUSUARIO' and cons_coop != '$COOPERATIVA' and cons_visibilidade != 'eu' and cons_visibilidade != 'minha_coop' and cons_visibilidade = 'qualquer_um' and cons_grupo like '%$areaAtendimento%' and data_consulta >= '$dataRefIncialF' and data_consulta <= '$dataRefFinalF' ORDER BY cons_situacao ASC, cod_consulta DESC, cons_urgencia ASC");   
           }
           
// fim filtro 3 Publicas consultas
//Filtro 4 Todas
if($NIVEL == 2 && $COOPERATIVA == 57 OR $NIVEL == 1 && $COOPERATIVA == 57){
   $sql_buscaTodasConsultas = mysqli_query($conexao, "SELECT * FROM consultas INNER JOIN grupos_usuarios ON cons_grupo = cod_grupo INNER JOIN usuarios ON cons_user = id_usuario INNER JOIN cooperativas ON cons_coop = cod_coop INNER JOIN situacao_consultas ON cons_situacao = cod_situacao WHERE cons_user != '$CODIGOUSUARIO' and user_responsavel != '$CODIGOUSUARIO' and cons_coop = '$COOPERATIVA' and cons_grupo != '$USERGRUPO' and cons_grupo like '%$areaAtendimento%' and data_consulta >= '$dataRefIncialF' and data_consulta <= '$dataRefFinalF' ORDER BY cons_situacao ASC, cod_consulta DESC, cons_urgencia ASC");    
   //echo "fiz esse tambem";
}
// fim filtro 4 Todas
    $filtroON = 1;
//FIM FILTRO
}else{
if($USERGRUPO == 4){
  $sql_buscaMinhasConsultas = mysqli_query($conexao, "SELECT * FROM consultas INNER JOIN grupos_usuarios ON cons_grupo = cod_grupo INNER JOIN usuarios ON cons_user = id_usuario INNER JOIN cooperativas ON cons_coop = cod_coop INNER JOIN situacao_consultas ON cons_situacao = cod_situacao WHERE cons_user = '$CODIGOUSUARIO' ORDER BY cons_situacao ASC, cod_consulta DESC, cons_urgencia ASC");
}else{
 $sql_buscaMinhasConsultas = mysqli_query($conexao, "SELECT * FROM consultas INNER JOIN grupos_usuarios ON cons_grupo = cod_grupo INNER JOIN usuarios ON cons_user = id_usuario INNER JOIN cooperativas ON cons_coop = cod_coop INNER JOIN situacao_consultas ON cons_situacao = cod_situacao WHERE cons_user = '$CODIGOUSUARIO' OR user_responsavel = '$CODIGOUSUARIO' ORDER BY cons_situacao ASC, cod_consulta DESC, cons_urgencia ASC");
}

if($USERGRUPO == 4){
    $sql_buscaCoopConsultas = mysqli_query($conexao, "SELECT * FROM consultas INNER JOIN grupos_usuarios ON cons_grupo = cod_grupo INNER JOIN usuarios ON cons_user = id_usuario INNER JOIN cooperativas ON cons_coop = cod_coop INNER JOIN situacao_consultas ON cons_situacao = cod_situacao WHERE cons_user != '$CODIGOUSUARIO' and cons_coop = '$COOPERATIVA' and cons_visibilidade != 'eu' and cons_visibilidade = 'minha_coop' ORDER BY cons_situacao ASC, cod_consulta DESC, cons_urgencia ASC");
            }else{
                
            $sql_buscaCoopConsultas = mysqli_query($conexao, "SELECT * FROM consultas INNER JOIN grupos_usuarios ON cons_grupo = cod_grupo INNER JOIN usuarios ON cons_user = id_usuario INNER JOIN cooperativas ON cons_coop = cod_coop INNER JOIN situacao_consultas ON cons_situacao = cod_situacao WHERE cons_user != '$CODIGOUSUARIO' and user_responsavel != '$CODIGOUSUARIO' and cons_grupo = '$USERGRUPO' ORDER BY cons_situacao ASC, cod_consulta DESC, cons_urgencia ASC");    
            }
      
    $sql_buscaPublicaConsultas = mysqli_query($conexao, "SELECT * FROM consultas INNER JOIN grupos_usuarios ON cons_grupo = cod_grupo INNER JOIN usuarios ON cons_user = id_usuario INNER JOIN cooperativas ON cons_coop = cod_coop INNER JOIN situacao_consultas ON cons_situacao = cod_situacao WHERE cons_user != '$CODIGOUSUARIO' and cons_coop != '$COOPERATIVA' and cons_visibilidade != 'eu' and cons_visibilidade = 'qualquer_um' ORDER BY cons_situacao ASC, cod_consulta DESC, cons_urgencia ASC");

    $sql_buscaTodasConsultas = mysqli_query($conexao, "SELECT * FROM consultas INNER JOIN grupos_usuarios ON cons_grupo = cod_grupo INNER JOIN usuarios ON cons_user = id_usuario INNER JOIN cooperativas ON cons_coop = cod_coop INNER JOIN situacao_consultas ON cons_situacao = cod_situacao WHERE cons_user != '$CODIGOUSUARIO' and user_responsavel != '$CODIGOUSUARIO' and cons_grupo != '$USERGRUPO' ORDER BY cons_situacao ASC, cod_consulta DESC, cons_urgencia ASC");
    $filtroON = 0;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <title>Listar Consultas</title>
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
                        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-2 pb-2 mb-2 border-bottom">
                            <h5 class="titulo">Listar Consultas</h5>
                            <div class="btn-toolbar mb-2 mb-md-0">
                                <div class="mr-2">
                                    <a class="btn btn-sm btn-warning mb-1" onClick="history.go(-1)"><i class="uil uil-angle-left"></i> Voltar</a>
                                    <?php if($filtroON === 1){ ?>
                                    <a class="btn btn-sm btn-dark mb-1" href="listar-consultas.php"><i class="uil uil-filter-slash"></i> Limpar Filtro</a>
                                    <?php } ?>
                                    <a class="btn btn-sm btn-primary mb-1" href="#filtro" data-toggle="modal" data-target="#filtro"><i class="uil uil-filter"></i> Filtrar</a>
                                    <a class="btn btn-sm btn-primary mb-1" href="#ajuda" data-toggle="modal" data-target="#ajuda"><i class="bi bi-patch-question"></i> Ajuda</a>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-12">
<!-- Pills navs -->
<ul class="nav nav-pills nav-fill mb-1" id="ex1" role="tablist">
    <?php if($filtroON == 1){ } else {?>
  <li class="nav-item" role="presentation">
    <a class="nav-link active" id="ex2-tab-1" data-bs-toggle="pill" href="#ex2-pills-1" role="tab" aria-controls="ex2-pills-1" aria-selected="true">MINHAS</a>
  </li>
  <li class="nav-item" role="presentation">
    <a class="nav-link" id="ex2-tab-2" data-bs-toggle="pill" href="#ex2-pills-2" role="tab" aria-controls="ex2-pills-2" aria-selected="false"><?php if($USERGRUPO == 4){ echo "DA MINHA COOPERATIVA"; }else{ echo "DO MEU GRUPO";} ?></a>
  </li>
  <?php if($USERGRUPO == 4){ ?>
  <li class="nav-item" role="presentation">
    <a class="nav-link" id="ex2-tab-3" data-bs-toggle="pill" href="#ex2-pills-3" role="tab" aria-controls="ex2-pills-3" aria-selected="false">PÚBLICAS</a>
  </li>
  <?php }else{} ?>
  
    <?php if($NIVEL == 2 && $COOPERATIVA == 57 OR $NIVEL == 1 && $COOPERATIVA == 57){ ?>
  <li class="nav-item" role="presentation">
    <a class="nav-link" id="ex2-tab-3" data-bs-toggle="pill" href="#ex2-pills-4" role="tab" aria-controls="ex2-pills-4" aria-selected="false">TODAS</a>
  </li>
  <?php }else{} ?>
  <?php } ?>
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
                            <table class="table table-sm table-borderless order-column compact row-border tablesConsulta" style= "white-space: nowrap;">
                                <thead class="border theadN">
                                    <tr>
                                         <th>Nro | Abertura</th>
                                        <th>Assunto | Área de Atendimento</th>
                                        <th>Solicitante | Cooperativa</th>
                                        <th>Previsão | Situação</th>
                                        <th class="text-center">Ações</th>
                                    </tr>
                                </thead>
                                <tbody class="border bg-white">
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
                                                 <span class="destaque"> <?php echo strftime('%d.%m.%Y às %H:%M:%S', strtotime($resultadoMinhasConsultas["data_previsao"]));?></span>
                                              <br>
                                              <div class="progress">
                                                                            <?php 
                                                  if($resultadoMinhasConsultas['situacao'] == "Aberto"){
                                                      echo '<span class="badge badge-success d-inline"  style="width: 100%">'.$resultadoMinhasConsultas['situacao'].'</span>';
                                                  }elseif($resultadoMinhasConsultas['situacao'] == "Pendente"){
                                                     echo '<span class="badge badge-danger d-inline" style="width: 100%">'.$resultadoMinhasConsultas['situacao'].'</span>'; 
                                                  }elseif($resultadoMinhasConsultas['situacao'] == "Em Andamento"){
                                                     echo '<span class="badge badge-primary d-inline" style="width: 100%">'.$resultadoMinhasConsultas['situacao'].'</span>'; 
                                                  }elseif($resultadoMinhasConsultas['situacao'] == "Aguardando"){
                                                     echo '<span class="badge badge-warning d-inline" style="width: 100%">'.$resultadoMinhasConsultas['situacao'].'</span>';  
                                                  }
                                                  elseif($resultadoMinhasConsultas['situacao'] == "Fechado"){
                                                     echo '<span class="badge badge-secondary d-inline" style="width: 100%">'.$resultadoMinhasConsultas['situacao'].'</span>';  
                                                  }
                                                  elseif($resultadoMinhasConsultas['situacao'] == "Concluído"){
                                                     echo '<span class="badge badge-dark d-inline" style="width: 100%">'.$resultadoMinhasConsultas['situacao'].'</span>';  
                                                  }
                                                  ?>
                                                                        </div>
                                             </td>
                                                <td class="text-center" style="text-align: center; vertical-align:middle !important">
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
  <div class="tab-pane fade" id="ex2-pills-2" role="tabpanel" aria-labelledby="ex2-tab-2">
    
            
    <div class="table-responsive">
                            <table class="table table-sm table-borderless order-column compact row-border tablesConsulta" style= "white-space: nowrap;">
                                <thead class="border theadN">
                                    <tr>
                                         <th>Nro | Abertura</th>
                                        <th>Assunto | Área de Atendimento</th>
                                        <th>Solicitante | Cooperativa</th>
                                        <th>Previsão | Situação</th>
                                        <th class="text-center">Ações</th>
                                    </tr>
                                </thead>
                                <tbody class="border bg-white">
<?php
                                    if (mysqli_num_rows($sql_buscaCoopConsultas) > 0) {
                                        while ($resultadoCoopConsultas = mysqli_fetch_assoc($sql_buscaCoopConsultas)) {
                                            ?>
                                            <tr class="linha-hover">
                                                <td style="font-size:15px;">
                                              <span class="text-primary"><?php echo str_pad($resultadoCoopConsultas["cod_consulta"], 6, '0', STR_PAD_LEFT); ?></span>
                                              <br>
                                              <span class="destaque" style="font-size: 13px;"><?php echo strftime('%d.%m.%Y às %H:%M:%S', strtotime($resultadoCoopConsultas["data_consulta"])); ?></span>
                                             </td>
                                             <td style="font-size:15px;">
                                              <span class="text-primary"> <?php echo substr($resultadoCoopConsultas["cons_assunto"], 0, 30);?></span>
                                              <br>
                                              <span class="destaque" style="font-size: 13px;"><?php echo $resultadoCoopConsultas['grupo']; ?></span>
                                             </td>
                                             <td style="font-size:15px;">
                                                 <span class="text-primary"> <?php echo substr($resultadoCoopConsultas["nome"], 0, 30);?></span>
                                              <br>
                                              <span class="destaque" style="font-size: 13px;"><?php echo $resultadoCoopConsultas['cooperativa']; ?></span>
                                             </td>
                                             <td style="font-size:15px;" style="text-align: center; vertical-align:middle !important">
                                                 <span class="destaque"> <?php echo strftime('%d.%m.%Y às %H:%M:%S', strtotime($resultadoCoopConsultas["data_previsao"]));?></span>
                                              <br>
                                              <div class="progress">
                                                                            <?php 
                                                  if($resultadoCoopConsultas['situacao'] == "Aberto"){
                                                      echo '<span class="badge badge-success d-inline"  style="width: 100%">'.$resultadoCoopConsultas['situacao'].'</span>';
                                                  }elseif($resultadoCoopConsultas['situacao'] == "Pendente"){
                                                     echo '<span class="badge badge-danger d-inline" style="width: 100%">'.$resultadoCoopConsultas['situacao'].'</span>'; 
                                                  }elseif($resultadoCoopConsultas['situacao'] == "Em Andamento"){
                                                     echo '<span class="badge badge-primary d-inline" style="width: 100%">'.$resultadoCoopConsultas['situacao'].'</span>'; 
                                                  }elseif($resultadoCoopConsultas['situacao'] == "Aguardando"){
                                                     echo '<span class="badge badge-warning d-inline" style="width: 100%">'.$resultadoCoopConsultas['situacao'].'</span>';  
                                                  }
                                                  elseif($resultadoCoopConsultas['situacao'] == "Fechado"){
                                                     echo '<span class="badge badge-secondary d-inline" style="width: 100%">'.$resultadoCoopConsultas['situacao'].'</span>';  
                                                  }
                                                  elseif($resultadoCoopConsultas['situacao'] == "Concluído"){
                                                     echo '<span class="badge badge-dark d-inline" style="width: 100%">'.$resultadoCoopConsultas['situacao'].'</span>';  
                                                  }
                                                  ?>
                                                                        </div>
                                             </td>
                                                <td class="text-center" style="text-align: center; vertical-align:middle !important">
                                                    <a title="Editar" href="edicao-consulta.php?cod_consulta=<?php echo $resultadoCoopConsultas['cod_consulta'];?>"><i class="bi bi-pencil-square btn-sm btn-warning"></i></a>
                                                </td> 
                                            </tr>
                                            <?php
                                        }
                                    } else {
                                        ?>
                                        <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
      
      
  </div>
  <div  class="tab-pane fade" id="ex2-pills-3" role="tabpanel"  aria-labelledby="ex2-tab-3">
    
      
    <div class="table-responsive">
                            <table class="table table-sm table-borderless order-column compact row-border tablesConsulta" style= "white-space: nowrap;">
                                <thead class="border theadN">
                                    <tr>
                                         <th>Nro | Abertura</th>
                                        <th>Assunto | Área de Atendimento</th>
                                        <th>Solicitante | Cooperativa</th>
                                        <th>Previsão | Situação</th>
                                        <th class="text-center">Ações</th>
                                    </tr>
                                </thead>
                                <tbody class="border bg-white">
<?php
                                    if (mysqli_num_rows($sql_buscaPublicaConsultas) > 0) {
                                        while ($resultadoPublicaConsultas = mysqli_fetch_assoc($sql_buscaPublicaConsultas)) {
                                            ?>
                                            <tr class="linha-hover">
                                                <td style="font-size:15px;">
                                              <span class="text-primary"><?php echo str_pad($resultadoPublicaConsultas["cod_consulta"], 6, '0', STR_PAD_LEFT); ?></span>
                                              <br>
                                              <span class="destaque" style="font-size: 13px;"><?php echo strftime('%d.%m.%Y às %H:%M:%S', strtotime($resultadoPublicaConsultas["data_consulta"])); ?></span>
                                             </td>
                                             <td style="font-size:15px;">
                                              <span class="text-primary"> <?php echo substr($resultadoPublicaConsultas["cons_assunto"], 0, 30);?></span>
                                              <br>
                                              <span class="destaque" style="font-size: 13px;"><?php echo $resultadoPublicaConsultas['grupo']; ?></span>
                                             </td>
                                             <td style="font-size:15px;">
                                                 <span class="text-primary"> <?php echo substr($resultadoPublicaConsultas["nome"], 0, 30);?></span>
                                              <br>
                                              <span class="destaque" style="font-size: 13px;"><?php echo $resultadoPublicaConsultas['cooperativa']; ?></span>
                                             </td>
                                             <td style="font-size:15px;" style="text-align: center; vertical-align:middle !important">
                                                 <span class="destaque"> <?php echo strftime('%d.%m.%Y às %H:%M:%S', strtotime($resultadoPublicaConsultas["data_previsao"]));?></span>
                                              <br>
                                              <div class="progress">
                                                                            <?php 
                                                  if($resultadoPublicaConsultas['situacao'] == "Aberto"){
                                                      echo '<span class="badge badge-success d-inline"  style="width: 100%">'.$resultadoPublicaConsultas['situacao'].'</span>';
                                                  }elseif($resultadoCoopConsultas['situacao'] == "Pendente"){
                                                     echo '<span class="badge badge-danger d-inline" style="width: 100%">'.$resultadoPublicaConsultas['situacao'].'</span>'; 
                                                  }elseif($resultadoPublicaConsultas['situacao'] == "Em Andamento"){
                                                     echo '<span class="badge badge-primary d-inline" style="width: 100%">'.$resultadoPublicaConsultas['situacao'].'</span>'; 
                                                  }elseif($resultadoPublicaConsultas['situacao'] == "Aguardando"){
                                                     echo '<span class="badge badge-warning d-inline" style="width: 100%">'.$resultadoPublicaConsultas['situacao'].'</span>';  
                                                  }
                                                  elseif($resultadoPublicaConsultas['situacao'] == "Fechado"){
                                                     echo '<span class="badge badge-secondary d-inline" style="width: 100%">'.$resultadoPublicaConsultas['situacao'].'</span>';  
                                                  }
                                                  elseif($resultadoPublicaConsultas['situacao'] == "Concluído"){
                                                     echo '<span class="badge badge-dark d-inline" style="width: 100%">'.$resultadoPublicaConsultas['situacao'].'</span>';  
                                                  }
                                                  ?>
                                                                        </div>
                                             </td>
                                                <td class="text-center" style="text-align: center; vertical-align:middle !important">
                                                    <a title="Editar" href="edicao-consulta.php?cod_consulta=<?php echo $resultadoPublicaConsultas['cod_consulta'];?>"><i class="bi bi-pencil-square btn-sm btn-warning"></i></a>
                                                </td> 
                                            </tr>
                                            <?php
                                        }
                                    } else {
                                        ?>
                                        <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
      
      
  </div>
    <div  class="tab-pane fade" id="ex2-pills-4" role="tabpanel"  aria-labelledby="ex2-tab-4">
    <div class="table-responsive">
                            <table class="table table-sm table-borderless order-column compact row-border tablesConsulta" style= "white-space: nowrap;">
                                <thead class="border theadN">
                                    <tr>
                                         <th>Nro | Abertura</th>
                                        <th>Assunto | Área de Atendimento</th>
                                        <th>Solicitante | Cooperativa</th>
                                        <th>Previsão | Situação</th>
                                        <th class="text-center">Ações</th>
                                    </tr>
                                </thead>
                                <tbody class="border bg-white">
<?php
                                    if (mysqli_num_rows($sql_buscaTodasConsultas) > 0) {
                                        while ($resultadoTodasConsultas = mysqli_fetch_assoc($sql_buscaTodasConsultas)) {
                                            ?>
                                            <tr class="linha-hover">
                                                <td style="font-size:15px;">
                                              <span class="text-primary"><?php echo str_pad($resultadoTodasConsultas["cod_consulta"], 6, '0', STR_PAD_LEFT); ?></span>
                                              <br>
                                              <span class="destaque" style="font-size: 13px;"><?php echo strftime('%d.%m.%Y às %H:%M:%S', strtotime($resultadoTodasConsultas["data_consulta"])); ?></span>
                                             </td>
                                             <td style="font-size:15px;">
                                              <span class="text-primary"> <?php echo substr($resultadoTodasConsultas["cons_assunto"], 0, 30);?></span>
                                              <br>
                                              <span class="destaque" style="font-size: 13px;"><?php echo $resultadoTodasConsultas['grupo']; ?></span>
                                             </td>
                                             <td style="font-size:15px;">
                                                 <span class="text-primary"> <?php echo substr($resultadoTodasConsultas["nome"], 0, 30);?></span>
                                              <br>
                                              <span class="destaque" style="font-size: 13px;"><?php echo $resultadoTodasConsultas['cooperativa']; ?></span>
                                             </td>
                                             <td style="font-size:15px;" style="text-align: center; vertical-align:middle !important">
                                                 <span class="destaque"> <?php echo strftime('%d.%m.%Y às %H:%M:%S', strtotime($resultadoTodasConsultas["data_previsao"]));?></span>
                                              <br>
                                              <div class="progress">
                                                                            <?php 
                                                  if($resultadoTodasConsultas['situacao'] == "Aberto"){
                                                      echo '<span class="badge badge-success d-inline"  style="width: 100%">'.$resultadoTodasConsultas['situacao'].'</span>';
                                                  }elseif($resultadoTodasConsultas['situacao'] == "Pendente"){
                                                     echo '<span class="badge badge-danger d-inline" style="width: 100%">'.$resultadoTodasConsultas['situacao'].'</span>'; 
                                                  }elseif($resultadoTodasConsultas['situacao'] == "Em Andamento"){
                                                     echo '<span class="badge badge-primary d-inline" style="width: 100%">'.$resultadoTodasConsultas['situacao'].'</span>'; 
                                                  }elseif($resultadoTodasConsultas['situacao'] == "Aguardando"){
                                                     echo '<span class="badge badge-warning d-inline" style="width: 100%">'.$resultadoTodasConsultas['situacao'].'</span>';  
                                                  }
                                                  elseif($resultadoTodasConsultas['situacao'] == "Fechado"){
                                                     echo '<span class="badge badge-secondary d-inline" style="width: 100%">'.$resultadoTodasConsultas['situacao'].'</span>';  
                                                  }
                                                  elseif($resultadoTodasConsultas['situacao'] == "Concluído"){
                                                     echo '<span class="badge badge-dark d-inline" style="width: 100%">'.$resultadoTodasConsultas['situacao'].'</span>';  
                                                  }
                                                  ?>
                                                                        </div>
                                             </td>
                                                <td class="text-center" style="text-align: center; vertical-align:middle !important">
                                                    <a title="Editar" href="edicao-consulta.php?cod_consulta=<?php echo $resultadoTodasConsultas['cod_consulta'];?>"><i class="bi bi-pencil-square btn-sm btn-warning"></i></a>
                                                </td> 
                                            </tr>
                                            <?php
                                        }
                                    } else {
                                        ?>
                                        <?php
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
                            <table class="table table-sm table-borderless order-column compact row-border tablesConsulta" style= "white-space: nowrap;">
                                <thead class="border theadN">
                                    <tr>
                                         <th>Nro | Abertura</th>
                                        <th>Assunto | Área de Atendimento</th>
                                        <th>Solicitante | Cooperativa</th>
                                        <th>Previsão | Situação</th>
                                        <th class="text-center">Ações</th>
                                    </tr>
                                </thead>
                                <tbody class="border bg-white">
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
                                            <!--meu grupo ou coop -->
                                            <?php
                                            if (mysqli_num_rows($sql_buscaCoopConsultas) > 0) {
                                        while ($resultadoCoopConsultas = mysqli_fetch_assoc($sql_buscaCoopConsultas)) {
                                            ?>
                                            <tr class="linha-hover">
                                                <td style="font-size:15px;">
                                              <span class="text-primary"><?php echo str_pad($resultadoCoopConsultas["cod_consulta"], 6, '0', STR_PAD_LEFT); ?></span>
                                              <br>
                                              <span class="destaque" style="font-size: 13px;"><?php echo strftime('%d.%m.%Y às %H:%M:%S', strtotime($resultadoCoopConsultas["data_consulta"])); ?></span>
                                             </td>
                                             <td style="font-size:15px;">
                                              <span class="text-primary"> <?php echo substr($resultadoCoopConsultas["cons_assunto"], 0, 30);?></span>
                                              <br>
                                              <span class="destaque" style="font-size: 13px;"><?php echo $resultadoCoopConsultas['grupo']; ?></span>
                                             </td>
                                             <td style="font-size:15px;">
                                                 <span class="text-primary"> <?php echo substr($resultadoCoopConsultas["nome"], 0, 30);?></span>
                                              <br>
                                              <span class="destaque" style="font-size: 13px;"><?php echo $resultadoCoopConsultas['cooperativa']; ?></span>
                                             </td>
                                             <td style="font-size:15px;" style="text-align: center; vertical-align:middle !important">
                                                 <span class="destaque"> <?php echo strftime('%d.%m.%Y às %H:%M:%S', strtotime($resultadoCoopConsultas["data_previsao"]));?></span>
                                              <br>
                                              <div class="progress">
                                                                            <?php 
                                                  if($resultadoCoopConsultas['situacao'] == "Aberto"){
                                                      echo '<span class="badge badge-success d-inline"  style="width: 100%">'.$resultadoCoopConsultas['situacao'].'</span>';
                                                  }elseif($resultadoCoopConsultas['situacao'] == "Pendente"){
                                                     echo '<span class="badge badge-danger d-inline" style="width: 100%">'.$resultadoCoopConsultas['situacao'].'</span>'; 
                                                  }elseif($resultadoCoopConsultas['situacao'] == "Em Andamento"){
                                                     echo '<span class="badge badge-primary d-inline" style="width: 100%">'.$resultadoCoopConsultas['situacao'].'</span>'; 
                                                  }elseif($resultadoCoopConsultas['situacao'] == "Aguardando"){
                                                     echo '<span class="badge badge-warning d-inline" style="width: 100%">'.$resultadoCoopConsultas['situacao'].'</span>';  
                                                  }
                                                  elseif($resultadoCoopConsultas['situacao'] == "Fechado"){
                                                     echo '<span class="badge badge-secondary d-inline" style="width: 100%">'.$resultadoCoopConsultas['situacao'].'</span>';  
                                                  }
                                                  elseif($resultadoCoopConsultas['situacao'] == "Concluído"){
                                                     echo '<span class="badge badge-dark d-inline" style="width: 100%">'.$resultadoCoopConsultas['situacao'].'</span>';  
                                                  }
                                                  ?>
                                                                        </div>
                                             </td>
                                                <td class="text-center" style="text-align: center; vertical-align:middle !important">
                                                    <a title="Editar" href="edicao-consulta.php?cod_consulta=<?php echo $resultadoCoopConsultas['cod_consulta'];?>"><i class="bi bi-pencil-square btn-sm btn-warning"></i></a>
                                                </td> 
                                            </tr>
                                            <?php
                                        }
                                    } else {
                                        ?>
                                        <?php
                                    }
                                    ?>
                                            <!-- fim meu grupo ou coop -->
                                            <!-- inicio publicas -->
                                            <?php
                                    if (mysqli_num_rows($sql_buscaPublicaConsultas) > 0) {
                                        while ($resultadoPublicaConsultas = mysqli_fetch_assoc($sql_buscaPublicaConsultas)) {
                                            ?>
                                            <tr class="linha-hover">
                                                <td style="font-size:15px;">
                                              <span class="text-primary"><?php echo str_pad($resultadoPublicaConsultas["cod_consulta"], 6, '0', STR_PAD_LEFT); ?></span>
                                              <br>
                                              <span class="destaque" style="font-size: 13px;"><?php echo strftime('%d.%m.%Y às %H:%M:%S', strtotime($resultadoPublicaConsultas["data_consulta"])); ?></span>
                                             </td>
                                             <td style="font-size:15px;">
                                              <span class="text-primary"> <?php echo substr($resultadoPublicaConsultas["cons_assunto"], 0, 30);?></span>
                                              <br>
                                              <span class="destaque" style="font-size: 13px;"><?php echo $resultadoPublicaConsultas['grupo']; ?></span>
                                             </td>
                                             <td style="font-size:15px;">
                                                 <span class="text-primary"> <?php echo substr($resultadoPublicaConsultas["nome"], 0, 30);?></span>
                                              <br>
                                              <span class="destaque" style="font-size: 13px;"><?php echo $resultadoPublicaConsultas['cooperativa']; ?></span>
                                             </td>
                                             <td style="font-size:15px;" style="text-align: center; vertical-align:middle !important">
                                                 <span class="destaque"> <?php echo strftime('%d.%m.%Y às %H:%M:%S', strtotime($resultadoPublicaConsultas["data_previsao"]));?></span>
                                              <br>
                                              <div class="progress">
                                                                            <?php 
                                                  if($resultadoPublicaConsultas['situacao'] == "Aberto"){
                                                      echo '<span class="badge badge-success d-inline"  style="width: 100%">'.$resultadoPublicaConsultas['situacao'].'</span>';
                                                  }elseif($resultadoCoopConsultas['situacao'] == "Pendente"){
                                                     echo '<span class="badge badge-danger d-inline" style="width: 100%">'.$resultadoPublicaConsultas['situacao'].'</span>'; 
                                                  }elseif($resultadoPublicaConsultas['situacao'] == "Em Andamento"){
                                                     echo '<span class="badge badge-primary d-inline" style="width: 100%">'.$resultadoPublicaConsultas['situacao'].'</span>'; 
                                                  }elseif($resultadoPublicaConsultas['situacao'] == "Aguardando"){
                                                     echo '<span class="badge badge-warning d-inline" style="width: 100%">'.$resultadoPublicaConsultas['situacao'].'</span>';  
                                                  }
                                                  elseif($resultadoPublicaConsultas['situacao'] == "Fechado"){
                                                     echo '<span class="badge badge-secondary d-inline" style="width: 100%">'.$resultadoPublicaConsultas['situacao'].'</span>';  
                                                  }
                                                  elseif($resultadoPublicaConsultas['situacao'] == "Concluído"){
                                                     echo '<span class="badge badge-dark d-inline" style="width: 100%">'.$resultadoPublicaConsultas['situacao'].'</span>';  
                                                  }
                                                  ?>
                                                                        </div>
                                             </td>
                                                <td class="text-center" style="text-align: center; vertical-align:middle !important">
                                                    <a title="Editar" href="edicao-consulta.php?cod_consulta=<?php echo $resultadoPublicaConsultas['cod_consulta'];?>"><i class="bi bi-pencil-square btn-sm btn-warning"></i></a>
                                                </td> 
                                            </tr>
                                            <?php
                                        }
                                    } else {
                                        ?>
                                        <?php
                                    }
                                    ?>
                                            <!-- fim publicas -->
                                            <!-- inicio todas -->
                                            <?php
                                            if($NIVEL == 2 && $COOPERATIVA == 57 OR $NIVEL == 1 && $COOPERATIVA == 57){
                                    if (mysqli_num_rows($sql_buscaTodasConsultas) > 0) {
                                        while ($resultadoTodasConsultas = mysqli_fetch_assoc($sql_buscaTodasConsultas)) {
                                            ?>
                                            <tr class="linha-hover">
                                                <td style="font-size:15px;">
                                              <span class="text-primary"><?php echo str_pad($resultadoTodasConsultas["cod_consulta"], 6, '0', STR_PAD_LEFT); ?></span>
                                              <br>
                                              <span class="destaque" style="font-size: 13px;"><?php echo strftime('%d.%m.%Y às %H:%M:%S', strtotime($resultadoTodasConsultas["data_consulta"])); ?></span>
                                             </td>
                                             <td style="font-size:15px;">
                                              <span class="text-primary"> <?php echo substr($resultadoTodasConsultas["cons_assunto"], 0, 30);?></span>
                                              <br>
                                              <span class="destaque" style="font-size: 13px;"><?php echo $resultadoTodasConsultas['grupo']; ?></span>
                                             </td>
                                             <td style="font-size:15px;">
                                                 <span class="text-primary"> <?php echo substr($resultadoTodasConsultas["nome"], 0, 30);?></span>
                                              <br>
                                              <span class="destaque" style="font-size: 13px;"><?php echo $resultadoTodasConsultas['cooperativa']; ?></span>
                                             </td>
                                             <td style="font-size:15px;" style="text-align: center; vertical-align:middle !important">
                                                 <span class="destaque"> <?php echo strftime('%d.%m.%Y às %H:%M:%S', strtotime($resultadoTodasConsultas["data_previsao"]));?></span>
                                              <br>
                                              <div class="progress">
                                                                            <?php 
                                                  if($resultadoTodasConsultas['situacao'] == "Aberto"){
                                                      echo '<span class="badge badge-success d-inline"  style="width: 100%">'.$resultadoTodasConsultas['situacao'].'</span>';
                                                  }elseif($resultadoTodasConsultas['situacao'] == "Pendente"){
                                                     echo '<span class="badge badge-danger d-inline" style="width: 100%">'.$resultadoTodasConsultas['situacao'].'</span>'; 
                                                  }elseif($resultadoTodasConsultas['situacao'] == "Em Andamento"){
                                                     echo '<span class="badge badge-primary d-inline" style="width: 100%">'.$resultadoTodasConsultas['situacao'].'</span>'; 
                                                  }elseif($resultadoTodasConsultas['situacao'] == "Aguardando"){
                                                     echo '<span class="badge badge-warning d-inline" style="width: 100%">'.$resultadoTodasConsultas['situacao'].'</span>';  
                                                  }
                                                  elseif($resultadoTodasConsultas['situacao'] == "Fechado"){
                                                     echo '<span class="badge badge-secondary d-inline" style="width: 100%">'.$resultadoTodasConsultas['situacao'].'</span>';  
                                                  }
                                                  elseif($resultadoTodasConsultas['situacao'] == "Concluído"){
                                                     echo '<span class="badge badge-dark d-inline" style="width: 100%">'.$resultadoTodasConsultas['situacao'].'</span>';  
                                                  }
                                                  ?>
                                                                        </div>
                                             </td>
                                                <td class="text-center" style="text-align: center; vertical-align:middle !important">
                                                    <a title="Editar" href="edicao-consulta.php?cod_consulta=<?php echo $resultadoTodasConsultas['cod_consulta'];?>"><i class="bi bi-pencil-square btn-sm btn-warning"></i></a>
                                                </td> 
                                            </tr>
                                            <?php
                                        }
                                    } else {
                                        ?>
                                        <?php
                                    }
    }
                                    ?>
                                            <!-- fim todas -->
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
                                            <select class="form-select pesquisa-select" name="areaAtendimento">
                                                <option value="">Selecione uma opção</option>
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
            </div>
      </div>
      <div class="modal-footer card-fundo-body p-1">
        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="uil uil-times"></i> Cancelar</button>
        <button type="submit" class="btn btn-success loading btn-sm"><i class="uil uil-filter"></i> Filtrar</button>
        
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
            "ordering": true,
            order: [[2, 'desc']],
            "filter": true,
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
