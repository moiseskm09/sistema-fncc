<?php
include_once '../config/conexao.php';

if (isset($_POST['cod_consulta'], $_POST['cod_user'], $_POST['respostaConsulta'])) {
    $cod_consulta = $_POST['cod_consulta'];
    $cod_user = $_POST['cod_user'];
    $respostaConsulta = $_POST['respostaConsulta'];
    $cons_coop = $_POST['cons_coop'];
    $query = "INSERT INTO consulta_interacoes (inter_user, inter_cons, inter_descricao, inter_data) VALUES ('$cod_user', '$cod_consulta', '$respostaConsulta', NOW())";
    $insereInteracao = mysqli_query($conexao, $query);

    if(isset($_FILES['arquivoAtend'])){
    $countfiles = count($_FILES['arquivoAtend']['name']);
    // Looping all files
    for($i=0;$i<$countfiles;$i++){
        $filename = $_FILES['arquivoAtend']['name'][$i];
        $horaInclusao = date("His");
        $tituloArq = str_replace('/', '_', $filename); 
        $path = $filename;
        $nomeFinal = str_replace(' ', '_', $tituloArq);  
        $dir = "../arquivos/consultas/consulta_coop_$cons_coop/consulta_$cod_consulta";
        mkdir($dir, 0777, true);
        if (move_uploaded_file($_FILES['arquivoAtend']['tmp_name'][$i], "$dir/" . $nomeFinal)) {
            $queryArq = "INSERT INTO arquivos_consultas (arq_nome, arq_consulta, arq_data) VALUES ('$nomeFinal', '$cod_consulta', NOW())";
            $executaQueryArq = mysqli_query($conexao, $queryArq);
        }else{
            $erro++;
        }
        }
    }
    
    $buscaGrupoUser = mysqli_query($conexao, "SELECT user_grupo from usuarios WHERE id_usuario = '$cod_user'");
    $resultadoGrupoUser = mysqli_fetch_assoc($buscaGrupoUser);
    $grupoUser = $resultadoGrupoUser["user_grupo"];


    if (isset($_POST['situacaoCons'], $_POST['urgencia'], $_POST['visibilidade'], $_POST['uaUserGrupo'], $grupoUser)) {
        $situacaoCons = $_POST['situacaoCons'];
        $urgencia = $_POST['urgencia'];
        $visibilidade = $_POST['visibilidade'];
        $uaUserGrupo = (int) $_POST['uaUserGrupo'];
        if ($grupoUser == 4) {
            $queryPropriedades = "UPDATE consultas SET cons_situacao = '$situacaoCons', cons_urgencia = '$urgencia', cons_visibilidade = '$visibilidade' WHERE cod_consulta = '$cod_consulta'";
            $atualizaPropriedades = mysqli_query($conexao, $queryPropriedades);
        } else {
            $queryPropriedadesS = "UPDATE consultas SET cons_situacao = '$situacaoCons', cons_urgencia = '$urgencia', cons_visibilidade = '$visibilidade', user_responsavel = '$cod_user' WHERE cod_consulta = '$cod_consulta'";
            $atualizaPropriedades = mysqli_query($conexao, $queryPropriedadesS);
        }
    } else {
        $atualizaPropriedades = 1;
    }
    if ($insereInteracao == 1 && $atualizaPropriedades == 1) {
        
        
        /* Envia email para o responsavel ou para o usuario da consulta */
    include_once 'email/config_geral_email.php';
    
    
    if ($grupoUser == 4) {
        $consultaUserEnvioEmail = mysqli_query($conexao, "SELECT nome, email FROM consultas INNER JOIN usuarios on user_responsavel = id_usuario WHERE cod_consulta = '$cod_consulta'");
    if(mysqli_num_rows($consultaUserEnvioEmail) > 0){
        while($resultadoEnvioEmail = mysqli_fetch_assoc($consultaUserEnvioEmail)){
            $nomeUserEnvioEmail = $resultadoEnvioEmail["nome"];
            $emailUserEnvioEmail = $resultadoEnvioEmail["email"];
            $mail->AddAddress($emailUserEnvioEmail, $nomeUserEnvioEmail);
        }
        include_once 'email/template/interacoes_consultas.php';
        $enviado = $mail->Send();
    }
    }else{
       $consultaUserEnvioEmail = mysqli_query($conexao, "SELECT nome, email FROM consultas INNER JOIN usuarios on cons_user = id_usuario WHERE cod_consulta = '$cod_consulta'");
    if(mysqli_num_rows($consultaUserEnvioEmail) > 0){
        while($resultadoEnvioEmail = mysqli_fetch_assoc($consultaUserEnvioEmail)){
            $nomeUserEnvioEmail = $resultadoEnvioEmail["nome"];
            $emailUserEnvioEmail = $resultadoEnvioEmail["email"];
            $mail->AddAddress($emailUserEnvioEmail, $nomeUserEnvioEmail);
        }
        include_once 'email/template/interacoes_consultas.php';
        $enviado = $mail->Send();
    } 
    }
    /* Fim Envia email para os responsaveis da area depois da abertura da consulta */
        
    header("location: ../sistema/edicao-consulta.php?sucesso=1&cod_consulta=$cod_consulta");
    } else {
        header("location: ../sistema/edicao-consulta.php?erro=1&cod_consulta=$cod_consulta");
    }
} else {
    header("location: ../sistema/edicao-consulta.php?erro=2&cod_consulta=$cod_consulta");
}