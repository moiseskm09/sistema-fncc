<?php

$colNome = $_POST['col_nome'];
//echo $colNome[0];
$ColArea = $_POST['col_area'];
$colEmail = $_POST['col_email'];

$array = array(array('nome' => "$colNome", 'area' => "$ColArea", 'email' => "$colEmail"));
print_r($array);
