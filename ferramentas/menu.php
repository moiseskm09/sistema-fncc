<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion fundo-menu" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <a class="nav-link link-menu" href="home.php">
                        <div class="sb-nav-link-icon"><i class="bi bi-house-door tamanho-icone"></i></div>
                        TELA PRINCIPAL  
                    </a> 
                <?php
                $seleciona_menu = mysqli_query($conexao, "SELECT * FROM nivel_acesso
                                                    INNER JOIN menu ON codMenu = id_menu
                                                    WHERE cod_perfil = '$NIVEL' and marcado != '0'
                                                    GROUP BY menu");
                while ($resultado = mysqli_fetch_assoc($seleciona_menu)) {
                    $idMenu = $resultado["id_menu"];
                    ?>  
                    <a class="nav-link link-menu collapsed" href="#<?php echo $resultado['caminho_drop']; ?>" data-toggle="collapse" data-target="#<?php echo $resultado['caminho_drop']; ?>" aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon"><i class="<?php echo $resultado['icone']; ?> tamanho-icone"></i></div>
                        <?php echo $resultado['menu']; ?>
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>       
                    <?php
                    $seleciona_submenu = mysqli_query($conexao, "SELECT submenu, icone_sub, caminho FROM nivel_acesso
                                                            INNER JOIN submenu ON codSubmenu = cod_submenu and cod_perfil = '$NIVEL' 
                                                            WHERE cod_menu = '$idMenu' AND marcado = '1'");
                    if (mysqli_num_rows($seleciona_submenu) == 0) {
                        
                    } else {
                        ?>
                        <div class="collapse" id="<?php echo $resultado['caminho_drop']; ?>" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                            <nav class="fundo-submenu">
                                <?php
                                while ($resultado_submenu = mysqli_fetch_assoc($seleciona_submenu)) {
                                    ?>
                                    <a class="nav-link link-submenu" href="<?php echo $resultado_submenu['caminho']; ?>">
                                        <div class="sb-nav-link-icon"><i class="<?php echo $resultado_submenu['icone_sub']; ?> tamanho-icone"></i></div>
                                    <?php echo $resultado_submenu['submenu']; ?></a>
        <?php } ?> 
                            </nav>
                        </div>

    <?php }
} ?>           
            </div>
        </div>

                    </nav>
                    </div>