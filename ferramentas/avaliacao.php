<?php
include_once '../config/conexao.php';
include_once '../config/config_geral.php';
if (isset($_POST['avaliacao'], $_POST['cod_consultaAval'])) {
    $avaliacao = $_POST['avaliacao'];
    $cod_consultaAval = $_POST['cod_consultaAval'];
    $data = date("Y-m-d H:i:s");
    $queryAvaliacao = "INSERT INTO avaliacao_consulta (aval_consulta, aval_avaliacao, aval_data) VALUES ('$cod_consultaAval', '$avaliacao', NOW())";
        $executaAvaliacao = mysqli_query($conexao, $queryAvaliacao);
        if($executaAvaliacao == 1){
          $queryConclusao = "UPDATE consultas SET cons_situacao = '6' , data_conclusao = '$data' WHERE cod_consulta = '$cod_consultaAval'";
          echo $queryConclusao;
        $executaConclusao = mysqli_query($conexao, $queryConclusao);
        if($executaConclusao == 1){
          header("location: ../sistema/listar-consultas.php?sucesso=5");
        }else{
            $deletaAval = "DELETE FROM avaliacao_consulta WHERE aval_consulta = '$cod_consultaAval'";
            header("location: ../sistema/edicao-consulta.php?erro=3&cod_consulta=$cod_consultaAval");
        }
        } else {
            header("location: ../sistema/edicao-consulta.php?erro=3&cod_consulta=$cod_consultaAval");
        }
}
