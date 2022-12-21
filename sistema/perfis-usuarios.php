<?php
require_once '../config/sessao.php';
require_once '../config/conexao.php';
require_once '../config/config_geral.php';

if (isset($_GET['id'])) {
    $clicado_perfil = $_GET['id'];
    $consulta_perfil_clicado = mysqli_query($conexao, "SELECT * from perfis_usuarios WHERE p_cod = '$clicado_perfil'");
    $resultado_perfil_clicado = mysqli_fetch_assoc($consulta_perfil_clicado);
    $perfil_option = $resultado_perfil_clicado['perfil'];
} else {
    $clicado_perfil = "";
}
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <link href="../css/menu.css" rel="stylesheet" />
        <link href="../css/perfis.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://unicons.iconscout.com/release/v3.0.6/css/line.css">
        <script src="https://code.jquery.com/jquery-3.6.2.min.js" integrity="sha256-2krYZKh//PcchRtd+H+VyyQoZ/e3EcrkxhM8ycwASPA=" crossorigin="anonymous"></script>
        <!-- Styles -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
        <!-- Or for RTL support -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.rtl.min.css" />

        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <link href="../css/style.css" rel="stylesheet" />
    </head>
    <body class="sb-nav-fixed fundo_tela">
        <?php include_once "../ferramentas/navbar.php"; ?>
        <div id="layoutSidenav">
            <?php include_once "../ferramentas/menu.php"; ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <!--conteudo da tela aqui!-->
                        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                            <h5 class="titulo">Perfis de acesso</h5>
                            <div class="btn-toolbar mb-2 mb-md-0">
                                <div class="mr-2">
                                    <a class="btn btn-sm btn-warning" onClick="history.go(-1)"><i class="uil uil-angle-left"></i>Voltar</a>
                                    <a href="#criarPerfil" data-toggle="modal" data-target="#criarPerfil" class="btn btn-sm btn-success">Adicionar <i class="uil uil-plus"></i></a>
                                </div>
                            </div>

                        </div>
                        <div class="form-row mt-3">
                            <div class="col-md-4">
                                <div class="accordion" id="selecioneperfil">
                                    <div class="card border-0 mb-2 " style="border-radius: 10px;">
                                        <a href="#perfis" data-toggle="collapse"  aria-expanded="true" aria-controls="perfil" class="text-center header-filtro p-2 borda">Selecione um perfil </a>

                                        <div id="perfis" class="collapse show" aria-labelledby="headingOne" data-parent="#selecioneperfil">
                                            <div class="card-body bg-white">
                                                <div class="form-group">
                                                    <form action="../ferramentas/pesquisa_perfil.php" method="POST" id="perfil">
                                                        <div class="form-group">

                                                            <select id="caixa-digitacao" name="nome_perfil" onchange="this.form.submit()" class="diitacao pesquisa-select" required style="width: 100%;">

                                                                <option value=""><?php
                                                                    if (isset($perfil_option)) {
                                                                        echo $perfil_option;
                                                                    } else {
                                                                        echo "Selecione ...";
                                                                    }
                                                                    ?></option>
                                                                <?php
                                                                $consulta_perfil = mysqli_query($conexao, "SELECT * FROM perfis_usuarios");
                                                                if (mysqli_num_rows($consulta_perfil) > 0) {
                                                                    while ($perfis = mysqli_fetch_assoc($consulta_perfil)) {
                                                                        if ($perfis["p_cod"] == $clicado_perfil) {
                                                                            
                                                                        } else {
                                                                            ?>
                                                                            <option value="<?php echo $perfis["p_cod"]; ?>"><?php echo $perfis["perfil"]; ?></option>   
                                                                            <?php
                                                                        }
                                                                    }
                                                                } else {
                                                                    
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>        
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="accordion" id="permissoes">
                                    <div class="card border-0" style="border-radius: 10px;">
                                        <a href="#perfilpermissoes" data-toggle="collapse"  aria-expanded="true" aria-controls="perfilpermissoes" class="text-center header-filtro p-2 borda">Permissões <?php
                                            if (isset($perfil_option)) {
                                                echo "do Perfil <span style='color: #FFD70F'>" . $perfil_option . "</span>";
                                            } else {
                                                
                                            }
                                            ?></a>

                                        <div id="perfilpermissoes" class="collapse show" aria-labelledby="headingOne" data-parent="#permissoes">
                                            <div class="card-body bg-white" style="max-height: 395px; overflow-y: scroll;">
                                                <div class="">
                                                    <?php
                                                    if ($clicado_perfil == null) {
                                                        echo '<div class="alert-info">';
                                                        echo '<p class="alert font-weight-bold p-2">Selecione um perfil para visualizar as permissões!</p>';
                                                    } else {
                                                        ?>

                                                        <ul class="list-unstyled">
                                                            <?php
                                                            $seleciona_menu_permissao = mysqli_query($conexao, "SELECT * FROM menu");
                                                            while ($resultado_permissao = mysqli_fetch_assoc($seleciona_menu_permissao)) {
                                                                $idMenuPermissao = $resultado_permissao["id_menu"];
                                                                ?>

                                                                <li>
                                                                    <div class="p-2 destaque mb-2 mt-2">
                                                                        <strong class="">
                                                                            <?php echo $resultado_permissao['menu']; ?>
                                                                        </strong>
                                                                    </div>                    

                                                                    <?php
                                                                    $seleciona_submenu_permissao = mysqli_query($conexao, "SELECT submenu, marcado, cod_submenu FROM submenu
                                                            INNER JOIN nivel_acesso ON codSubmenu = cod_submenu and cod_perfil = '$clicado_perfil' WHERE codMenu = '$idMenuPermissao'");
                                                                    if (mysqli_num_rows($seleciona_submenu_permissao) == 0) {
                                                                        echo "sem informações para exibir";
                                                                    } else {
                                                                        ?>
                                                                        <ul class="list-unstyled list-unstyled" id="">
                                                                            <form action="../ferramentas/atualiza_permissao_usuario.php" method="POST">

                                                                                <div class="form-row">
                                                                                    <?php
                                                                                    while ($resultado_submenu_permissao = mysqli_fetch_assoc($seleciona_submenu_permissao)) {

                                                                                        if ($resultado_submenu_permissao['marcado'] == 1) {
                                                                                            ?>
                                                                                            <li>
                                                                                                <div class="col-md-12">
                                                                                                    <div class="form-check">
                                                                                                        <input class="form-check-input" type="checkbox" name="permissao_menu[]" value="<?php echo $resultado_submenu_permissao['cod_submenu']; ?>" id="<?php echo $resultado_submenu_permissao['cod_submenu']; ?>" checked>
                                                                                                        <label class="form-check-label" for="<?php echo $resultado_submenu_permissao['cod_submenu']; ?>">
                                                                                                            <?php echo $resultado_submenu_permissao['submenu']; ?>
                                                                                                        </label>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </li>

                                                                                            <?php
                                                                                        } else {
                                                                                            ?>
                                                                                            <li>
                                                                                                <div class="col-md-12">
                                                                                                    <div class="form-check">
                                                                                                        <input class="form-check-input" type="checkbox" name="permissao_menu[]" value="<?php echo $resultado_submenu_permissao['cod_submenu']; ?>" id="<?php echo $resultado_submenu_permissao['cod_submenu']; ?>">
                                                                                                        <label class="form-check-label" for="<?php echo $resultado_submenu_permissao['cod_submenu']; ?>">
                                                                                                            <?php echo $resultado_submenu_permissao['submenu']; ?>
                                                                                                        </label>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </li>
                                                                                            <?php
                                                                                        }
                                                                                    }
                                                                                    ?>
                                                                                </div>
                                                                        </ul>
                                                                    <?php } ?>
                                                                </li>
                                                            <?php }
                                                            ?>
                                                            <div class="text-right col-md-12">
                                                                <li>

                                                                    <button class="btn btn-small btn-success loading" type="submit">Salvar</button>
                                                                </li>

                                                            </div>
                                                            <input type="hidden" id="id" name="id" value="<?php echo $clicado_perfil; ?>">
                                                            </form>
                                                        </ul>       
                                                    <?php } ?>             

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                            $sucesso = (int) $_GET["sucesso"];
                            if ($sucesso === 1) {
                                echo '<div class="toast-container position-fixed bottom-0 end-0 p-3 ">
            <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="3000">
                <div class="toast-header border-light" style="background-color: #a3cfbb; color: #1c1d3c;">
                    <strong class="me-auto">FNCC AVISA</strong>
                    <small>Agora</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body" style="background-color: #a3cfbb; color: #1c1d3c;"">
                    <span> Perfil atualizado!</span>
                </div>
            </div>
        </div>';
                            }
                            ?>
                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="criarPerfil" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header header-filtro">
                                        <h5 class="modal-title" id="exampleModalLabel">Criação de perfil</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body card-fundo-body">
                                        <form action="../ferramentas/cadastrarPerfil.php" method="POST">
                                            <label for="nome_perfil_novo">Nome do Perfil</label>
                                            <input type="text" id="caixa-nome_perfil_novo" class="form-control digitacao" name="nome_perfil_novo" placeholder="Insira o nome do perfil" required>
                                            </div>
                                            <div class="modal-footer card-fundo-body">
                                                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancelar <i class="uil uil-times"></i></button>
                                                <button type="submit" class="btn btn-success loading btn-sm">Criar <i class="uil uil-plus"></i></button>

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--fim conteudo da tela aqui!-->
                    </div>
                </main>
                <?php include_once "../ferramentas/rodape.php"; ?>
            </div>
        </div>
        <script>
            $('.pesquisa-select').select2({
                theme: 'bootstrap-5'
            });

        </script>  
        <script src="../js/toast.js"></script>
        <script src="../js/scripts.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
        <!-- JavaScript Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>       
    </body>
</html>
