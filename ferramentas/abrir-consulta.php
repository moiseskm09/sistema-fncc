<?php
include_once '../config/conexao.php';
include_once '../config/config_geral.php';

if (isset($_POST["cod_coopUser"], $_POST["codUser"], $_POST["areaAtendimento"], $_POST["prioridadeAtend"], $_POST["visibilidadeAtend"], $_POST["assuntoAtend"], $_POST["descricaoAtend"])) {
    
    $cod_coopUser = $_POST["cod_coopUser"];
    $codUser = $_POST["codUser"];
    $areaAtendimento = $_POST["areaAtendimento"];
    $prioridadeAtend = $_POST["prioridadeAtend"];
    $visibilidadeAtend = $_POST["visibilidadeAtend"];
    $assuntoAtend = $_POST["assuntoAtend"];
    $descricaoAtend = $_POST["descricaoAtend"];
    $data = date("Y-m-d H:i:s");
    
    $query = "INSERT INTO consultas (cons_coop, cons_user, cons_grupo, cons_urgencia, cons_visibilidade, cons_assunto, cons_desc_principal, data_consulta, cons_situacao, user_responsavel, data_previsao) VALUES ('$cod_coopUser','$codUser','$areaAtendimento','$prioridadeAtend','$visibilidadeAtend','$assuntoAtend','$descricaoAtend', '$data', 1, '0', date_add(now(), interval 2 day))";
    $executaQuery = mysqli_query($conexao, $query);
    
    if($executaQuery == 1){
        $queryCodConsulta = "SELECT cod_consulta, nome, cooperativa FROM consultas INNER JOIN cooperativas ON cons_coop = cod_coop INNER JOIN usuarios ON cons_user = id_usuario WHERE cons_coop = '$cod_coopUser' and  cons_user = '$codUser' and cons_assunto = '$assuntoAtend' and data_consulta = '$data' LIMIT 1";
        $executaQueryCodConsulta = mysqli_query($conexao, $queryCodConsulta);
        $resultadoCodConsulta = mysqli_fetch_assoc($executaQueryCodConsulta);
        $codConsulta = $resultadoCodConsulta["cod_consulta"];
        $nomeUserAberturaConsulta = $resultadoCodConsulta["nome"];  
        $cooperativaUserAberturaConsulta = $resultadoCodConsulta["cooperativa"]; 
        $dir = "../arquivos/consultas/consulta_coop_$cod_coopUser/consulta_$codConsulta";
        mkdir($dir, 0777, true);
        $erro = 0;
        //echo $erro;
        
        $queryAviso = "INSERT INTO avisos (coop_aviso, aviso, data_aviso, link_aviso) VALUES ('57', 'Nova Consulta', NOW(), 'listar-consultas.php')";
        $executaAviso = mysqli_query($conexao, $queryAviso);
        if($visibilidadeAtend == "minha_coop"){
           $queryAviso = "INSERT INTO avisos (coop_aviso, aviso, data_aviso, link_aviso) VALUES ('$cod_coopUser', 'Nova Consulta', NOW(), 'listar-consultas.php')";
        $executaAviso = mysqli_query($conexao, $queryAviso); 
        }elseif($visibilidadeAtend == "qualquer_um"){
           $queryAviso = "INSERT INTO avisos (coop_aviso, aviso, data_aviso, link_aviso) VALUES ('0', 'Nova Consulta', NOW(), 'listar-consultas.php')";
        $executaAviso = mysqli_query($conexao, $queryAviso); 
        }
        
        
        if(isset($_FILES['arquivoAtend'])){
    $countfiles = count($_FILES['arquivoAtend']['name']);
    // Looping all files
    for($i=0;$i<$countfiles;$i++){
        $filename = $_FILES['arquivoAtend']['name'][$i];
        $horaInclusao = date("His");
        $tituloArq = str_replace('/', '_', $filename); 
        $path = $filename;
        $nomeFinal = str_replace(' ', '_', $tituloArq);  
        //echo $nomeFinal."<br>";
        // Upload file
        //move_uploaded_file($_FILES['arquivoAtend']['tmp_name'][$i],'upload/'.$filenamehoraInclusao);
        if (move_uploaded_file($_FILES['arquivoAtend']['tmp_name'][$i], "$dir/" . $nomeFinal)) {
            $queryArq = "INSERT INTO arquivos_consultas (arq_nome, arq_consulta, arq_data) VALUES ('$nomeFinal', '$codConsulta', NOW())";
            $executaQueryArq = mysqli_query($conexao, $queryArq);
        }else{
            $erro++;
        }
        }
    }
    /* Envia email para os responsaveis da area depois da abertura da consulta */
    include_once 'email/config_geral_email.php';
    include_once 'email/template/abertura_consulta.php';
    
    $consultaUsersAreaAtendimento = mysqli_query($conexao, "SELECT nome, email FROM usuarios WHERE user_grupo = '$areaAtendimento'");
    if(mysqli_num_rows($consultaUsersAreaAtendimento) > 0){
        while($resultadoUsersAreaAtendimento = mysqli_fetch_assoc($consultaUsersAreaAtendimento)){
            $nomeUserAtendimento = $resultadoUsersAreaAtendimento["nome"];
            $emailUserAtendimento = $resultadoUsersAreaAtendimento["email"];
            $mail->AddAddress($emailUserAtendimento, $nomeUserAtendimento);
        }
        $enviado = $mail->Send();
        header("location: ../sistema/edicao-consulta.php?sucesso=1&cod_consulta=$codConsulta");
    }else{
        header("location: ../sistema/edicao-consulta.php?sucesso=1&cod_consulta=$codConsulta");
    }
    /* Fim Envia email para os responsaveis da area depois da abertura da consulta */
      
    }else{
       header("location: ../sistema/abrir-consulta.php?erro=3");
    }
}else{
    header("location: ../sistema/abrir-consulta.php?erro=1");
}