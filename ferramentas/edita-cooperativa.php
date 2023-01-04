<?php
require_once '../config/conexao.php';
//require_once '../config/config_geral.php';

$cooperativa = $_POST["cooperativaid"];
$dca_nomeN = $_POST["dca_nomeN"];
echo $dca_nomeN;

/* BLOCO DA DIRETORIA / CONSELHO ADM */
$dca_id = $_POST["dca_id"];
$dca_coop = $_POST["dca_coop"];
$dca_nome = $_POST["dca_nome"];
$dca_cargo = $_POST["dca_cargo"];
$dca_mandato = $_POST["dca_mandato"];
$dca_telefone = $_POST["dca_telefone"];
$dca_email = $_POST["dca_email"];
if(isset($dca_id, $dca_coop, $dca_nome, $dca_cargo, $dca_telefone, $dca_email)){
    //SE TIVER ALGO DO DCA PARA ATUALIZAR
function dca ($dca_id, $dca_coop, $dca_nome, $dca_cargo, $dca_mandato, $dca_telefone, $dca_email) {
    return "('{$dca_id}','{$dca_coop}','{$dca_nome}', '{$dca_cargo}', '{$dca_mandato}', '{$dca_telefone}', '{$dca_email}')";
}
$dados = array_map("dca", $dca_id, $dca_nome, $dca_cargo, $dca_telefone, $dca_email, $dca_mandato, $dca_coop);
$queryDCA = sprintf("REPLACE INTO diretoria_conselhoadm (dca_id, dca_nome, dca_cargo, dca_telefone, dca_email, dca_mandato, dca_coop) VALUES %s", join(', ',$dados));
//echo $queryDCA."\n";
$executaDCA = mysqli_query($conexao, $queryDCA);
}else {
    //SE NÃO TIVER PREENCHIDO O DCA NÃO FAZ NADA
}

$dca_nomeN = $_POST["dca_nomeN"];
$dca_cargoN = $_POST["dca_cargoN"];
$dca_mandatoN = $_POST["dca_mandatoN"];
$dca_telefoneN = $_POST["dca_telefoneN"];
$dca_emailN = $_POST["dca_emailN"];
if(isset($cooperativa, $dca_nomeN, $dca_cargoN, $dca_telefoneN, $dca_emailN)){
    //SE TIVER ALGO DO DCAN PARA ADICIONAR
function dcan ($dca_nomeN, $dca_cargoN, $dca_mandatoN, $dca_telefoneN, $dca_emailN) {
    global $cooperativa;
    return "('{$cooperativa}','{$dca_nomeN}', '{$dca_cargoN}', '{$dca_mandatoN}', '{$dca_telefoneN}', '{$dca_emailN}')";
}
$dadosN = array_map("dcan", $dca_nomeN, $dca_cargoN, $dca_telefoneN, $dca_emailN, $dca_mandatoN, $cooperativa);
$queryDCAN = sprintf("INSERT INTO diretoria_conselhoadm (dca_nome, dca_cargo, dca_telefone, dca_email, dca_mandato, dca_coop) VALUES %s", join(', ',$dadosN));
echo $queryDCAN."\n";
$executaDCAN = mysqli_query($conexao, $queryDCAN);
}else {
    //SE NÃO TIVER PREENCHIDO O DCAN NÃO FAZ NADA
}
/* FIM BLOCO DA DIRETORIA / CONSELHO ADM */

