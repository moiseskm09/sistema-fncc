<?php
require_once '../config/sessao.php';
require_once '../config/conexao.php';
require_once '../config/config_geral.php';

$query_events = "SELECT id, title, color, start, end, pessoa FROM events";
$resultado_events = mysqli_query($conexao, $query_events);
$eventos = [];

while($row_events = mysqli_fetch_assoc($resultado_events)){
    $id = $row_events['id'];
    $title = $row_events['title'];
    $color = $row_events['color'];
    $start = $row_events['start'];
    $end = $row_events['end'];
    $participante = $row_events['pessoa'];
    
    $eventos[] = [
        'id' => $id, 
        'title' => $title." - ".$participante, 
        'color' => $color, 
        'start' => $start, 
        'end' => $end, 
        ];
}

echo json_encode($eventos);