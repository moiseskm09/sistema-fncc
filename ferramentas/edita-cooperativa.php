<?php

require_once '../config/conexao.php';
//require_once '../config/config_geral.php';


if (isset($_POST["cooperativaid"], $_POST["coop_razao"], $_POST["coop_cnpj"])) {

    $cooperativa = $_POST["cooperativaid"];
    $coop_razao = $_POST["coop_razao"];
    $coop_fantasia = $_POST["coop_fantasia"];
    $coop_categoria = $_POST["coop_categoria"];
    $coop_cnpj = $_POST["coop_cnpj"];
    $coop_im = $_POST["coop_im"];
    $coop_nire = $_POST["coop_nire"];
    $coop_cep = $_POST["coop_cep"];
    $coop_endereco = $_POST["coop_endereco"];
    $coop_numero_casa = $_POST["coop_numero_casa"];
    $coop_complemento = $_POST["coop_complemento"];
    $coop_bairro = $_POST["coop_bairro"];
    $coop_cidade = $_POST["coop_cidade"];
    $coop_estado = $_POST["coop_estado"];
    $coop_telefone = $_POST["coop_telefone"];
    $coop_whatsapp = $_POST["coop_whatsapp"];
    $coop_email = $_POST["coop_email"];
    $coop_sistema = $_POST["coop_sistema"];

    $queryAtualizaDadosPrincipais = "UPDATE cooperativas SET coop_razao = '$coop_razao', cooperativa = '$coop_fantasia', coop_cnpj = '$coop_cnpj', coop_categoria = '$coop_categoria', coop_nire = '$coop_nire', coop_im = '$coop_im', coop_cep = '$coop_cep', coop_endereco = '$coop_endereco', coop_numero_casa = '$coop_numero_casa', coop_complemento = '$coop_complemento', coop_bairro = '$coop_bairro', coop_cidade = '$coop_cidade', coop_estado = '$coop_estado', coop_telefone = '$coop_telefone' , coop_whatsapp = '$coop_whatsapp', coop_email = '$coop_email', coop_sistema = '$coop_sistema', coop_dados_atualizados = '1'  WHERE cod_coop = '$cooperativa'";
    $atualizaDadosPrincipais = mysqli_query($conexao, $queryAtualizaDadosPrincipais);



    /* BLOCO DA DIRETORIA / CONSELHO ADM */
    if (isset($_POST["dca_id"], $_POST["dca_coop"], $_POST["dca_nome"], $_POST["dca_cargo"], $_POST["dca_telefone"], $_POST["dca_email"])) {
        //SE TIVER ALGO DO DCA PARA ATUALIZAR
        $dca_id = $_POST["dca_id"];
        $dca_coop = $_POST["dca_coop"];
        $dca_nome = $_POST["dca_nome"];
        $dca_cargo = $_POST["dca_cargo"];
        $dca_mandato = $_POST["dca_mandato"];
        $dca_telefone = $_POST["dca_telefone"];
        $dca_email = $_POST["dca_email"];

        function dca($dca_id, $dca_coop, $dca_nome, $dca_cargo, $dca_mandato, $dca_telefone, $dca_email) {
            return "('{$dca_id}','{$dca_coop}','{$dca_nome}', '{$dca_cargo}', '{$dca_mandato}', '{$dca_telefone}', '{$dca_email}')";
        }

        $dados = array_map("dca", $dca_id, $dca_nome, $dca_cargo, $dca_telefone, $dca_email, $dca_mandato, $dca_coop);
        $queryDCA = sprintf("REPLACE INTO diretoria_conselhoadm (dca_id, dca_nome, dca_cargo, dca_telefone, dca_email, dca_mandato, dca_coop) VALUES %s", join(', ', $dados));
//echo $queryDCA."\n";
        $executaDCA = mysqli_query($conexao, $queryDCA);
    } else {
        //SE NÃO TIVER PREENCHIDO O DCA NÃO FAZ NADA
    }

    if (isset($_POST["dca_nomeN"], $_POST["dca_cargoN"], $_POST["dca_telefoneN"], $_POST["dca_emailN"])) {
        //SE TIVER ALGO DO DCAN PARA ADICIONAR
        $dca_nomeN = $_POST["dca_nomeN"];
        $dca_cargoN = $_POST["dca_cargoN"];
        $dca_mandatoN = $_POST["dca_mandatoN"];
        $dca_telefoneN = $_POST["dca_telefoneN"];
        $dca_emailN = $_POST["dca_emailN"];
        $dcaCoopN = $_POST["dcaCoopN"];

        function dcan($dca_nomeN, $dca_cargoN, $dca_mandatoN, $dca_telefoneN, $dca_emailN, $dcaCoopN) {
            //global $cooperativa;
            return "('{$dca_nomeN}', '{$dca_cargoN}', '{$dca_mandatoN}', '{$dca_telefoneN}', '{$dca_emailN}', '{$dcaCoopN}')";
        }

        $dadosN = array_map("dcan", $dca_nomeN, $dca_cargoN, $dca_telefoneN, $dca_emailN, $dca_mandatoN, $dcaCoopN);
        $queryDCAN = sprintf("INSERT INTO diretoria_conselhoadm (dca_nome, dca_cargo, dca_telefone, dca_email, dca_mandato, dca_coop) VALUES %s", join(', ', $dadosN));
//echo $queryDCAN."\n";
        $executaDCAN = mysqli_query($conexao, $queryDCAN);
    } else {
        //SE NÃO TIVER PREENCHIDO O DCAN NÃO FAZ NADA
    }
    /* FIM BLOCO DA DIRETORIA / CONSELHO ADM */


    /* BLOCO DO CONSELHO FISCAL */
    if (isset($_POST["cf_id"], $_POST["cf_coop"], $_POST["cf_nome"], $_POST["cf_cargo"], $_POST["cf_telefone"], $_POST["cf_email"])) {
        //SE TIVER ALGO DO cf PARA ATUALIZAR
        $cf_id = $_POST["cf_id"];
        $cf_coop = $_POST["cf_coop"];
        $cf_nome = $_POST["cf_nome"];
        $cf_cargo = $_POST["cf_cargo"];
        $cf_mandato = $_POST["cf_mandato"];
        $cf_telefone = $_POST["cf_telefone"];
        $cf_email = $_POST["cf_email"];

        function cf($cf_id, $cf_coop, $cf_nome, $cf_cargo, $cf_mandato, $cf_telefone, $cf_email) {
            return "('{$cf_id}','{$cf_coop}','{$cf_nome}', '{$cf_cargo}', '{$cf_mandato}', '{$cf_telefone}', '{$cf_email}')";
        }

        $dadosCF = array_map("cf", $cf_id, $cf_nome, $cf_cargo, $cf_telefone, $cf_email, $cf_mandato, $cf_coop);
        $queryCF = sprintf("REPLACE INTO conselho_fiscal (cf_id, cf_nome, cf_cargo, cf_telefone, cf_email, cf_mandato, cf_coop) VALUES %s", join(', ', $dadosCF));
        //echo $queryCF . "\n";
        $executaCF = mysqli_query($conexao, $queryCF);
    } else {
        //SE NÃO TIVER PREENCHIDO O CF NÃO FAZ NADA
    }

    if (isset($_POST["cf_nomeN"], $_POST["cf_cargoN"], $_POST["cf_telefoneN"], $_POST["cf_emailN"])) {
        //SE TIVER ALGO DO cf PARA ADICIONAR
        $cf_nomeN = $_POST["cf_nomeN"];
        $cf_cargoN = $_POST["cf_cargoN"];
        $cf_mandatoN = $_POST["cf_mandatoN"];
        $cf_telefoneN = $_POST["cf_telefoneN"];
        $cf_emailN = $_POST["cf_emailN"];
        $cfCoopN = $_POST["cfCoopN"];

        function cfn($cf_nomeN, $cf_cargoN, $cf_mandatoN, $cf_telefoneN, $cf_emailN, $cfCoopN) {
            //global $cooperativa;
            return "('{$cf_nomeN}', '{$cf_cargoN}', '{$cf_mandatoN}', '{$cf_telefoneN}', '{$cf_emailN}', '{$cfCoopN}')";
        }

        $dadosCFN = array_map("cfn", $cf_nomeN, $cf_cargoN, $cf_telefoneN, $cf_emailN, $cf_mandatoN, $cfCoopN);
        $queryCFN = sprintf("INSERT INTO conselho_fiscal (cf_nome, cf_cargo, cf_telefone, cf_email, cf_mandato, cf_coop) VALUES %s", join(', ', $dadosCFN));
       // echo $queryCFN . "\n";
        $executaCFN = mysqli_query($conexao, $queryCFN);
    } else {
        //SE NÃO TIVER PREENCHIDO O CFN NÃO FAZ NADA
    }
    /* FIM BLOCO DO CONSELHO FISCAL */

    /* BLOCO DO COLABORADOR */
    if (isset($_POST["cod_col"], $_POST["col_nome"], $_POST["col_area"], $_POST["col_email"], $_POST["col_coop"])) {
        //SE TIVER ALGO DO col PARA ATUALIZAR
        $col_coop = $_POST["col_coop"];
        $cod_col = $_POST["cod_col"];
        $col_nome = $_POST["col_nome"];
        $col_area = $_POST["col_area"];
        $col_email = $_POST["col_email"];

        function col($cod_col, $col_nome, $col_area, $col_email, $col_coop) {
            return "('{$cod_col}','{$col_nome}','{$col_area}', '{$col_email}', '{$col_coop}')";
        }

        $dadosCol = array_map("col", $cod_col, $col_nome, $col_area, $col_email, $col_coop);
        $queryCol = sprintf("REPLACE INTO colaboradores_coop (cod_col, col_nome, col_area, col_email, col_coop) VALUES %s", join(', ', $dadosCol));
//echo $queryCol."\n";
        $executaCol = mysqli_query($conexao, $queryCol);
    } else {
        //SE NÃO TIVER PREENCHIDO O DCA NÃO FAZ NADA
    }

    if (isset($_POST["col_nomeN"], $_POST["col_areaN"], $_POST["col_emailN"])) {
        //SE TIVER ALGO DO col PARA adiciona
        $col_nomeN = $_POST["col_nomeN"];
        $col_areaN = $_POST["col_areaN"];
        $col_emailN = $_POST["col_emailN"];
        $colCoopN = $_POST["colCoopN"];

        function colN($col_nomeN, $col_areaN, $col_emailN, $colCoopN) {
            return "('{$col_nomeN}','{$col_areaN}', '{$col_emailN}', '{$colCoopN}')";
        }

        $dadosColN = array_map("colN", $col_nomeN, $col_areaN, $col_emailN, $colCoopN);
        $queryColN = sprintf("INSERT INTO colaboradores_coop (col_nome, col_area, col_email, col_coop) VALUES %s", join(', ', $dadosColN));
//echo $queryColN."\n";
        $executaColN = mysqli_query($conexao, $queryColN);
    } else {
        //SE NÃO TIVER PREENCHIDO O DCA NÃO FAZ NADA
    }

    /* FIM DO COLABORADOR */
    
    header("location: ../sistema/editar-cooperativa.php?id=$cooperativa&sucesso=1");
}else{
  header("location: ../sistema/cad-cooperativas.php");
}