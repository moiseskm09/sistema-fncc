<?php
include_once '../config/sessao.php';
include_once '../config/conexao.php';
include_once '../config/config_geral.php';

if (isset($_POST['respostaNaoEstouAcordo'], $_POST['cod_consultaNaoEstouAcordo'], $_POST['cod_userNaoEstouAcordo'])) {
    $respostaNaoEstouAcordo = $_POST['respostaNaoEstouAcordo'];
    $cod_consultaNaoEstouAcordo = $_POST['cod_consultaNaoEstouAcordo'];
    $cod_userNaoEstouAcordo = $_POST['cod_userNaoEstouAcordo'];
    $data = date("Y-m-d H:i:s");
    
    $queryNaoEstouAcordo = "INSERT INTO consulta_interacoes (inter_user, inter_cons, inter_descricao, inter_data) VALUES ('$cod_userNaoEstouAcordo','$cod_consultaNaoEstouAcordo', '$respostaNaoEstouAcordo', '$data')";
    
        $executaNaoEstouAcordo = mysqli_query($conexao, $queryNaoEstouAcordo);
        
        if($executaNaoEstouAcordo == 1){
          $queryReabre = "UPDATE consultas SET cons_situacao = '3' WHERE cod_consulta = '$cod_consultaNaoEstouAcordo'";
        $executaReabre = mysqli_query($conexao, $queryReabre);
        
        if($executaReabre == 1){
            
             /* Envia email para o responsavel da consulta */
    include_once 'email/config_geral_email.php';
    
    $consultaUserResponsavel = mysqli_query($conexao, "SELECT nome, email FROM consultas INNER JOIN usuarios ON user_responsavel = id_usuario WHERE cod_consulta = '$cod_consultaNaoEstouAcordo'");
    if(mysqli_num_rows($consultaUserResponsavel) > 0){
        while($resultadoUserResponsavel = mysqli_fetch_assoc($consultaUserResponsavel)){
            $nomeUserResponsavel = $resultadoUserResponsavel["nome"];
            $emailUserResponsavel = $resultadoUserResponsavel["email"];
            $mail->AddAddress($emailUserResponsavel, $nomeUserResponsavel);
        }
        include_once 'email/template/nao_concordancia_consulta.php';
        $enviado = $mail->Send();
    }
    /* Fim Envia email para o responsavel da consulta */
    
          header("location: ../sistema/edicao-consulta.php?sucesso=6&cod_consulta=$cod_consultaNaoEstouAcordo");
        }else{
            $deletaAval = "DELETE FROM consulta_interacoes WHERE inter_user = '$cod_userNaoEstouAcordo' and inter_cons = '$cod_consultaNaoEstouAcordo' and inter_descricao = '$respostaNaoEstouAcordo' and inter_data = '$data'";
            header("location: ../sistema/edicao-consulta.php?erro=4&cod_consulta=$cod_consultaNaoEstouAcordo");
        }
        } else {
            header("location: ../sistema/edicao-consulta.php?erro=4&cod_consulta=$cod_consultaNaoEstouAcordo");
        }
}
