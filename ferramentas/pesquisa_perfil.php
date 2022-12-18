<?php

$perfil_clicado = $_POST['nome_perfil'];

header("location: ../sistema/perfis-usuarios.php?id=".$perfil_clicado);

