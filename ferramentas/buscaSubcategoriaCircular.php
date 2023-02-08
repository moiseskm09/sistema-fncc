<?php

include_once '../config/conexao.php';

	$id_categoria = $_REQUEST['id_categoria'];
	
	$result_sub_cat = "SELECT * FROM subcategoria_circulares WHERE id_categoria = '$id_categoria' ORDER BY subcategoria";
	$resultado_sub_cat = mysqli_query($conexao, $result_sub_cat);
	
	while ($row_sub_cat = mysqli_fetch_assoc($resultado_sub_cat) ) {
		$sub_categorias_post[] = array(
			'id'	=> $row_sub_cat['cod_subcategoria'],
			'nome_sub_categoria' => $row_sub_cat['subcategoria'],
		);
	}
	
	echo(json_encode($sub_categorias_post));
