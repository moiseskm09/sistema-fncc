<nav class="sb-topnav navbar navbar-expand fundo-navbar">
    <a class="navbar-brand" href="home.php" style="color: #ffffff; margin-left: -10px; max-width: 100%;"><img class="" src="../img/logofncc.png" height="45px;"></a>
    <button class="order-1 order-lg-0 menu-mobile" id="sidebarToggle" href="#"><i class="uil uil-list-ul" style="font-size:20px;"></i></button>
    <!-- Navbar Search-->
    <i class="mx-auto bi bi-arrow-repeat botaoRefresh rounded-circle fw-bold text-white" onClick="window.location.reload()" style="font-size: 30px;"></i>
    <!-- Navbar-->
    <ul class="navbar-nav d-md-inline-block form-inline ml-auto">
        
        <li class="nav-item dropdown">
            <a class="nav-link link-menu dropdown-toggle text-white border-0" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img src="../img/foto_perfil/cooperativas/<?php echo "logo_fncc.png";?>" width="40" height="40" class="bg-white rounded-circle"> 
            </a>
            
            <div class="dropdown-menu dropdown-menu-right menu_perfil" id="menu_perfil" aria-labelledby="userDropdown">
                <div></div>
                <!-- Perfil usuario -->
                <div class="row text-center align-items-center">
                    
                    <div class="col-md-12 col-12 align-items-center">
                        <img src="../img/foto_perfil/cooperativas/<?php echo "logo_fncc.png";?>" class="rounded-circle" style="height: 50px; height: 50px;">
                    </div>
                    <div class="col-12">
                        <h4 class="text-primary"><?php echo ucfirst($NOME); ?></h4>
                        <h6 style="word-wrap: break-word; font-size: 13px;"><?php echo substr($EMAIL, 0, 22); ?></h6>
                        <hr class="dropdown-divider border border-2 border-secondary opacity-25">
                    </div>
                    
                    <div class="col-12">
                        
                        <a class="btn btn-md btn-primary mt-2 mb-2" href="meus-dados.php?id=<?php echo $CODIGOUSUARIO;?>"><i class="bi bi-person-lines-fill"></i> Meus Dados</a>
                        <a class="btn btn-danger btn-md mb-1" href="../ferramentas/logout.php"><i class="bi bi-box-arrow-right"></i> Desconectar</a>
                    </div>
                    
                </div>
                <!-- Perfil usuario -->
            </div>
        </li>
    </ul>
</nav>