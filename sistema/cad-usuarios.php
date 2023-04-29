<?php
require_once '../config/sessao.php';
require_once '../config/conexao.php';
require_once '../config/config_geral.php';

if (isset($_GET['nome'])) {
    $nome = $_GET['nome'];
    $sql_buscaUsuarios = mysqli_query($conexao, "SELECT * FROM usuarios INNER JOIN cooperativas ON user_coop = cod_coop WHERE nome LIKE '%$nome%'");
    $numeroLinhas = mysqli_num_rows($sql_buscaUsuarios);
    $filtroON = 1;
} else {

    //verifica a página atual caso seja informada na URL, senão atribui como 1ª página 
    $pagina = (isset($_GET['pagina'])) ? $_GET['pagina'] : 1;

    //pegar todos os registros do banco de dados
    $sql = mysqli_query($conexao, "SELECT id_usuario FROM usuarios WHERE u_status != '0'");
    $numeroTotalLinhas = mysqli_num_rows($sql);

    //define o numero de itens por pagina
    $itens_por_pagina = 10;

    //divide o total de linhas pelo numero maximo de registro e retorna um numero inteiro
    $numero_paginas = ceil($numeroTotalLinhas / $itens_por_pagina);

    $inicio = ($itens_por_pagina * $pagina) - $itens_por_pagina;

    $sql_buscaUsuarios = mysqli_query($conexao, "SELECT id_usuario, nome, sobrenome, email, u_status, cooperativa FROM usuarios INNER JOIN cooperativas ON user_coop = cod_coop ORDER BY u_status DESC, nome LIMIT $inicio, $itens_por_pagina ");
    $numeroLinhas = mysqli_num_rows($sql_buscaUsuarios);
    $filtroON = 0;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
        <title>Cadastro de Usuários</title>
        <link rel="icon" type="image/png" sizes="512x512" href="../img/fncc-logotipo-colorido.png">
        <link rel="icon" type="image/png" sizes="48x48" href="../img/fncc-logotipo-colorido.png">
        <link rel="icon" type="image/png" sizes="32x32" href="../img/fncc-logotipo-colorido.png">
        <link href="../css/menu.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://unicons.iconscout.com/release/v3.0.6/css/line.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
        <script src="https://code.jquery.com/jquery-3.6.2.min.js" integrity="sha256-2krYZKh//PcchRtd+H+VyyQoZ/e3EcrkxhM8ycwASPA=" crossorigin="anonymous"></script>
        <!-- Styles -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
        <!-- Or for RTL support -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.rtl.min.css" />
        <script src="../js/mask.js"></script>
        <script src="../js/busca-cep.js"></script>
        <link href="../css/style.css" rel="stylesheet" />
        <link rel="manifest" href="../manifest.json">
    </head>
    <body class="sb-nav-fixed fundo_tela">
        <?php include_once "../ferramentas/navbar.php"; ?>
        <div id="layoutSidenav">
            <?php include_once "../ferramentas/menu.php"; ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <!--conteudo da tela aqui!-->
                        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-1 pb-1 mb-1 border-bottom">
                            <div class="breadcrumb mb-2 mb-md-0" style="--bs-breadcrumb-divider: '>'; font-size: 16px;">
                      <span class="breadcrumb-item text-primary">Cadastro</span>
                      <span class="breadcrumb-item active text-success">Usuários</span>
                  </div>
                            <div class="btn-toolbar mb-2 mb-md-0">
                                <div class="mr-1">
                                    <a class="btn btn-sm btn-warning mb-1" onClick="history.go(-1)"><i class="uil uil-angle-left"></i> Voltar</a>
                                    <a class="btn btn-sm btn-success mb-1" href="#adicionaUsuario" data-toggle="modal" data-target="#adicionaUsuario"><i class="uil uil-plus"></i> Adicionar</a>                         
                                    <?php if ($filtroON === 1) { ?>
                                        <a class="btn btn-sm btn-dark mb-1" href="cad-usuarios.php"><i class="uil uil-filter-slash"></i> Limpar Filtro</a>
                                    <?php } ?>
                                    <a class="btn btn-sm btn-primary mb-1" href="#filtro" data-toggle="modal" data-target="#filtro"><i class="uil uil-filter"></i> Filtrar</a>
                                    <a class="btn btn-sm botaoAjuda mb-1" href="#ajuda" data-toggle="modal" data-target="#ajuda"><i class="bi bi-info-circle"></i> Ajuda</a>
                                </div>
                            </div>
                        </div>
                        
  
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead class="theadN">
                                    <tr>
                                        <th>Código</th>
                                        <th>Nome</th>
                                        <th>Sobrenome</th>
                                        <th>Cooperativa</th>
                                        <th>E-mail</th>
                                        <th>Status</th>
                                        <th class="text-center">Ações</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white p-0">
                                    <?php
                                    if ($numeroLinhas > 0) {
                                        while ($resultadoUsuario = mysqli_fetch_assoc($sql_buscaUsuarios)) {
                                            ?>
                                            <tr class="linha-hover">
                                                <td><span class="badge badge-info rounded-pill d-inline"><?php echo $resultadoUsuario['id_usuario']; ?></span></td>
                                                <td><?php echo ucwords(strtolower($resultadoUsuario['nome'])); ?></td>
                                                <td><?php echo $resultadoUsuario['sobrenome']; ?></td>
                                                <td><?php echo $resultadoUsuario['cooperativa']; ?></td>
                                                <td><?php echo $resultadoUsuario['email']; ?></td>
                                                <td><?php if ($resultadoUsuario['u_status'] == 1) {
                                        echo '<span class="badge badge-success rounded-pill d-inline">Ativo</span>';
                                    } else {
                                        echo '<span class="badge badge-danger rounded-pill d-inline">Inativo</span>';
                                    } ?></td>
                                                <td class="text-center">
                                                    <a href="editar-usuario.php?id=<?php echo $resultadoUsuario['id_usuario']; ?>" class=""><i class="bi bi-pencil-square text-dark btn-sm btn-warning"></i></a>
                                                    <a href="../ferramentas/desativa-usuario.php?id=<?php echo $resultadoUsuario['id_usuario']; ?>" desativar-confirm="Tem certeza de que deseja excluir o item selecionado?"><i class="bi bi-trash text-white btn-sm btn-danger"></i></a>
                                                </td> 
                                            </tr>
        <?php
    }
} else {
    ?>
                                        <tr class="linha-hover">
                                            <td colspan="4" class="text-center">Não há itens para exibir</td>
                                        </tr>
    <?php
}
?>
                                </tbody>
<tfoot class="p-0">
                  <tr>
                    <td colspan="3"><?php echo "Mostrando " . $numeroLinhas; ?> de <?php echo $numeroTotalLinhas; ?> registros</td>
                    <td colspan="4">
                      <nav>
                        <ul class="pagination pagination-sm justify-content-end">
                          <li class="page-item">
                            <a class="page-link" href="?pagina=1" tabindex="-1"><span aria-hidden="true">&laquo;</span>
                              <span class="sr-only">Primeira</span></a>
                          </li>
                          <?php
                          for ($i = 1; $i < $numero_paginas + 1; $i++) {
                              $estilo = "";
                              if ($pagina == $i) {
                                  $estilo = 'active';
                              }
                              ?>
                              <li class="page-item <?php echo $estilo; ?>"><a class="page-link" href="?pagina=<?php echo $i; ?>"><?php echo $i; ?></a></li>
<?php }
?>
                          <li class="page-item">
                            <a class="page-link" href="?pagina=<?php echo $numero_paginas ?>"><span aria-hidden="true">&raquo;</span>
                              <span class="sr-only">Última</span></a>
                          </li>
                        </ul>
                      </nav>
                    </td>
                  </tr>
                </tfoot>
                            </table>
                        </div>

                        <!-- Modal -->
                        <div class="modal fade" id="filtro" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header header-filtro">
                                        <h5 class="modal-title" id="exampleModalLabel">Filtrar dados</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body card-fundo-body">
                                        <form action="" method="GET">
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12 col-12">
                                                    <div class="form-floating mb-3">
                                                        <input type="text" name="nome" id="fnome" class="form-control focoInput" placeholder="Nome" autocomplete="off" required>
                                                        <label for="fnome">Nome</label>
                                                    </div>  
                                                </div>
                                            </div>
                                    </div>
                                    <div class="modal-footer card-fundo-body p-1">
                                        <button type="submit" class="btn btn-success loading btn-sm"><i class="uil uil-filter"></i> Filtrar</button>
                                        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="uil uil-times"></i> Cancelar</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal adiciona usuario -->
                        <div class="modal fade" id="adicionaUsuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header header-filtro">
                                        <h5 class="modal-title" id="exampleModalLabel">Cadastrar Usuário</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body card-fundo-body">
                                        <form action="../ferramentas/adiciona-usuario.php" method="POST">
                                            <!-- info obrigatoria -->
                                            <div class="form-row">
                                                <div class="col-lg-6 col-md-6 col-12">
                                                    <div class="form-floating mb-3">
                                                        <input type="text" name="nome" class="form-control" id="nome" placeholder="Nome" autocomplete="off" required>
                                                        <label for="nome">Nome</label>
                                                    </div>  
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-12">
                                                    <div class="form-floating mb-3">
                                                        <input type="text" name="sobrenome" class="form-control" id="sobrenome" placeholder="Sobrenome" autocomplete="off" required>
                                                        <label for="sobrenome">Sobrenome</label>
                                                    </div>  
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-12">
                                                    <div class="form-floating mb-3">
                                                        <select class="form-select pesquisa-select" id="cooperativa" name="cooperativa" required>
                                                            <option value="">Selecione</option>
                                                            <?php
                                                            $buscaCoop = mysqli_query($conexao, "SELECT * FROM cooperativas");
                                                            while ($resultadoCoop = mysqli_fetch_assoc($buscaCoop)) {
                                                                ?>
                                                                <option value="<?php echo $resultadoCoop['cod_coop'] ?>"><?php echo $resultadoCoop['cooperativa'] ?></option>
    <?php
}
?>
                                                        </select>
                                                        <label for="floatingSelect">Cooperativa</label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-12">
                                                    <div class="form-floating mb-3">
                                                        <input type="email" name="email" class="form-control" id="email" placeholder="E-mail" autocomplete="off" required>
                                                        <label for="email">E-mail</label>
                                                    </div>  
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-12">
                                                    <div class="form-floating mb-3">
                                                        <input type="text" name="usuario" class="form-control" id="usuario" placeholder="Usuário" autocomplete="off" required>
                                                        <label for="usuario">Usuário</label>
                                                    </div>  
                                                </div>
                                                <div class="col-lg-4 col-md-6 col-12">
                                                    <div class="form-floating mb-3">
                                                        <select class="form-select pesquisa-select" id="nivel" name="nivel" required>
                                                            <option value="">Selecione</option>
                                                            <?php
                                                            $buscaNivel = mysqli_query($conexao, "SELECT * FROM perfis_usuarios");
                                                            while ($resultadoNivel = mysqli_fetch_assoc($buscaNivel)) {
                                                                ?>
                                                                <option value="<?php echo $resultadoNivel['p_cod'] ?>"><?php echo $resultadoNivel['perfil'] ?></option>
    <?php
}
?> 
                                                        </select>
                                                        <label for="floatingSelect">Nível de Acesso</label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-12">
                                                    <div class="form-floating mb-3">
                                                        <select class="form-select pesquisa-select" id="grupo" name="grupo" required>
                                                            <option value="">Selecione</option>
                                                            <?php
                                                            $buscaGrupo = mysqli_query($conexao, "SELECT * FROM grupos_usuarios");
                                                            while ($resultadoGrupo = mysqli_fetch_assoc($buscaGrupo)) {
                                                                ?>
                                                                <option value="<?php echo $resultadoGrupo['cod_grupo'] ?>"><?php echo $resultadoGrupo['grupo'] ?></option>
    <?php
}
?> 
                                                        </select>
                                                        <label for="grupo">Grupo</label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-12">
                                                    <div class="form-floating mb-3">
                                                        <select class="form-select pesquisa-select" id="supervisor" name="supervisor" required>
                                                            <option value="0">NÃO</option>
                                                            <option value="1">SIM</option>
                                                            </select>
                                                        <label for="supervisor">SUPERVISOR (SOMENTE FNCC)</label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-12">
                                                    <div class="form-floating mb-3">
                                                        <select class="form-select pesquisa-select" id="controlaPonto" name="controlaPonto" required>
                                                            <option value="0">NÃO</option>
                                                            <option value="1">SIM</option>
                                                            </select>
                                                        <label for="controlaPonto">CONTROLA PONTO (SOMENTE FNCC)</label>
                                                    </div>
                                                </div>
                                                <div class="col-12 text-left">
                                                    <button type="submit" class="btn btn-success btn-md btncaduser"><i class="uil uil-plus"></i> Adicionar</button>
                                                </div>
                                            </div>                           
                                            <!-- info obrigatoria -->
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        if (isset($_GET["erro"])) {
                            $erro = (int) $_GET["erro"];
                            if ($erro === 1) {
                                echo '<div class="toast-container position-fixed bottom-0 end-0 p-3">
            <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="3000">
                <div class="toast-header border-light" style="background-color: #f5c2c7; color: #1c1d3c;">
                    <strong class="me-auto">FNCC AVISA</strong>
                    <small>Agora</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body" style="background-color: #f5c2c7; color: #1c1d3c;"">
                    <span>Os campos não foram preenchidos!</span>
                </div>
            </div>
        </div>';
                            } elseif ($erro === 2) {
                                echo '<div class="toast-container position-fixed bottom-0 end-0 p-3 ">
            <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="3000">
                <div class="toast-header border-light" style="background-color: #f5c2c7; color: #1c1d3c;">
                    <strong class="me-auto">FNCC AVISA</strong>
                    <small>Agora</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body" style="background-color: #f5c2c7; color: #1c1d3c;"">
                    <span>Já existe um cadastro para este usuário!</span>
                </div>
            </div>
        </div>';
                            } elseif ($erro === 3) {
                                echo '<div class="toast-container position-fixed bottom-0 end-0 p-3 ">
            <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="3000">
                <div class="toast-header border-light" style="background-color: #f5c2c7; color: #1c1d3c;">
                    <strong class="me-auto">FNCC AVISA</strong>
                    <small>Agora</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body" style="background-color: #f5c2c7; color: #1c1d3c;"">
                    <span>Erro ao salvar o cadastro! Tente Novamente!</span>
                </div>
            </div>
        </div>';
                            }
                        }
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
                    <span> Usuário criado com sucesso!</span>
                </div>
            </div>
        </div>';
                        } else if ($sucesso === 2) {
                            echo '<div class="toast-container position-fixed bottom-0 end-0 p-3 ">
            <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="3000">
                <div class="toast-header border-light" style="background-color: #fff3cd; color: #1c1d3c;">
                    <strong class="me-auto">FNCC AVISA</strong>
                    <small>Agora</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body" style="background-color: #fff3cd; color: #1c1d3c;"">
                    <span> Usuário desativado com sucesso!</span>
                </div>
            </div>
        </div>';
                        }
                        ?>
                        <?php include_once "../ferramentas/modal_loading.php"; ?>
                        
                        
                        <!-- Modal Ajuda-->
                        <div class="modal fade" id="ajuda" tabindex="-1" role="dialog" aria-labelledby="ajuda" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable" role="document">
                                <div class="modal-content">
                                    <div class="modal-header bg-info text-dark p-2">
                                        <h5 class="modal-title" id="exampleModalLabel">Ajuda</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body card-fundo-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <h6 class="destaque">Nível de Acesso</h6>
                                                <p>Permissões atribuÍdas no menu CONFIGURAÇÕES - PERFIS DE ACESSO determinam o que o usuário poderá acessar dentro do sistema!</p>
                                                <h6 class="destaque">Grupo</h6>
                                                <p>A qual o usuário pertence! Usuários que <strong>NÃO SÃO DA FNCC</strong> deverão obrigatoriamente ser incluídos no grupo <strong>COOPERATIVAS</strong>.</p>
                                                <h6 class="destaque">Supervisor</h6>
                                                <p>Algumas funções do sistema só estão disponíveis para a alçada <strong>SUPERVISOR</strong>. Exemplos de telas <strong>(JUSTIFICATIVA DE PONTO, JORNADA DE TRABALHO, AJUSTE DE PONTO E COMPENSAÇÃO)</strong>. O padrão dessa opção é <strong>NÃO</strong> e deverá ser mantida assim <strong>exceto se o usuário for da FNCC e um supervisor</strong>.</p>
                                                <h6 class="destaque">Controla Ponto</h6>
                                                <p>Selecione <strong>SIM</strong> se o usuário for marcar e controlar seus horários pelo sistema.</p>
                                               
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer p-1 card-fundo-body">
                                        <div class="row">
                                            <div class="col-12 text-end">
                                                <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal" aria-label="Fechar"><i class="bi bi-x"></i> Fechar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- modal ajuda -->
                        <!--fim conteudo da tela aqui!-->
                    </div>
                </main>
<?php include_once "../ferramentas/rodape.php"; ?>
            </div>
        </div>
        <script>
            $('.pesquisa-select').select2({
                theme: 'bootstrap-5';
            });
        </script>  
        <script src="../js/toast.js"></script>
        <script src="../js/scripts.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
        <!-- JavaScript Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
        <script src="../js/desativar.js"></script>
        <script src="../js/campos_adicionais.js"></script>
        <script src="../js/cp_mascaras.js"></script>
        <script>
            $(".nav .nav-link").on("click", function () {
                $(".nav").find(".menu-ativo").removeClass("menu-ativo");
                $(this).addClass("menu-ativo");
            });
        </script>
        <script src="../js/loading.js"></script>
        <script>
    $('#filtro').on('shown.bs.modal', function () {
    $('.focoInput').focus();
});  
</script>
    </body>
</html>
