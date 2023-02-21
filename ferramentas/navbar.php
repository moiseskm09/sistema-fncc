<nav class="sb-topnav navbar navbar-expand fundo-navbar">
    <a class="navbar-brand" href="home.php" style="color: #ffffff; margin-left: -10px; max-width: 100%;"><img class="" src="../img/logofncc.png" height="45px;"></a>
    <button class="order-1 order-lg-0 menu-mobile" id="sidebarToggle" href="#"><i class="uil uil-list-ul" style="font-size:20px;"></i></button>
    <!-- Navbar Search-->
    <i class="mx-auto bi bi-arrow-repeat botaoRefresh rounded-circle fw-bold text-white" onClick="window.location.reload()" style="font-size: 30px;"></i>
    <!-- Navbar-->
    <ul class="navbar-nav d-md-inline-block form-inline ml-auto">
        
        <li class="nav-item dropdown">
            <a class="nav-link link-menu dropdown-toggle text-white" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img src="../img/foto_perfil/cooperativas/<?php echo $LOGO_COOP;?>" width="40" height="40" class="bg-white rounded-circle"> 
            </a>
            
            <div class="dropdown-menu dropdown-menu-right display-flex menu_perfil" aria-labelledby="userDropdown">
                <div></div>
                <!-- Perfil usuario -->
                <div class="row align-items-center">
                    <div class="col-md-4 col-4 align-items-center">
                        <img src="../img/foto_perfil/cooperativas/<?php echo $LOGO_COOP;?>" class="rounded-circle ml-1 mr-2" style="max-width: 100%;">
                    </div>
                    <div class="col-md-7 col-7">
                        <h4 class="text-primary mt-2"><?php echo ucfirst($NOME); ?></h4>
                        <h6 style="word-wrap: break-word; font-size: 15px;"><?php echo $EMAIL; ?></h6>
                        <a class="btn btn-danger btn-sm" href="../ferramentas/logout.php"><i class="uil uil-times"></i> Desconectar</a>
                    </div>
                    
                </div>
                <div class="row">
                    <div class="col-md-12">
                    <hr style="border: 2px solid #e3e3e3;">
                    </div>
                </div>
                <div class="row p-1">
                    <div class="col-md-12 col-12">
                        <a class="btn btn-success text-white mb-1" href="meus-dados.php?id=<?php echo $CODIGOUSUARIO;?>" style="width: 100%;"><i class="uil uil-user-circle"></i> Meu Perfil</a>
                    </div>
                </div>
                <!-- Perfil usuario -->
            </div>
        </li>
    </ul>
</nav>