<?php
require_once '../config/sessao.php';
require_once '../config/conexao.php';
require_once '../config/config_geral.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
        <title>Agenda</title>
        <link rel="icon" type="image/png" sizes="512x512" href="../img/fncc-logotipo-colorido.png">
        <link rel="icon" type="image/png" sizes="48x48" href="../img/fncc-logotipo-colorido.png">
        <link rel="icon" type="image/png" sizes="32x32" href="../img/fncc-logotipo-colorido.png">
        <link href="../css/menu.css" rel="stylesheet" />
        <link href="../css/perfis.css" rel="stylesheet" />
        <link rel="manifest" href="../manifest.json">
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
        
        <!-- Scripts -->
        <script src='../js/fullcalendar/dist/index.global.min.js'></script>
        <script src='../js/fullcalendar/packages/core/locales/pt-br.global.min.js'></script>
        <script src='../js/fullcalendar/packages/core/bootstrap5/index.global.min.js'></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <link href="../css/style.css" rel="stylesheet" />
        <link href="../css/grafico_circulo_ponto.css" rel="stylesheet" />
        <link href="../css/marcar-ponto.css" rel="stylesheet" />
        <script>

  document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
      headerToolbar: {
        themeSystem: 'bootstrap5',
        left: 'prev,next today',
        center: 'title',
        right: 'multiMonthYear,dayGridMonth,timeGridWeek,timeGridDay,listWeek'
      },
      locale: 'pt-br',
      initialView: 'multiMonthYear',
      initialDate: '<?php echo date("Y-m-d");?>',
      editable: false,
      selectable: true,
      dayMaxEvents: true, // allow "more" link when too many events
      // multiMonthMaxColumns: 1, // guarantee single column
      //showNonCurrentDates: true,
      // fixedWeekCount: false,
       //businessHours: true,
      // weekends: false,
      views: {
      multiMonthYear: { buttonText: 'Ano' },
      dayGridMonth: { buttonText: 'Mês' },
      timeGridWeek: { buttonText: 'Semana' },
      timeGridDay: { buttonText: 'Dia' },
      listWeek: { buttonText: 'Lista' }
    },
      events: '../ferramentas/listar_eventos.php'
    });

    calendar.render();
    calendar.updateSize();
  });

</script>
<style>
    #calendar {
        max-width: 100%;
    max-height: 500px;
  }
   @media only screen and (max-width: 768px) {
      #calendar {
        max-width: 100%;
        min-height: 530px;
  }
  }
  #calendar a {
      text-decoration: none;
  }
  .semana{
      font-size: 10px;
  }
</style>
    </head>
    <body class="sb-nav-fixed fundo_tela">
        <?php include_once "../ferramentas/navbar.php"; ?>
        <div id="layoutSidenav">
            <?php include_once "../ferramentas/menu.php"; ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <!-- header -->
                        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-2 pb-2 mb-2 border-bottom">
                            <div class="breadcrumb mb-2 mb-md-0" style="--bs-breadcrumb-divider: '>'; font-size: 16px;">
                                <span class="breadcrumb-item text-primary">Recursos Humanos</span>
                                <span class="breadcrumb-item active text-success">Agenda</span>
                            </div>
                            <div class="btn-toolbar mb-2 mb-md-0">
                                <div class="mr-2">
                                    <a class="btn btn-sm btn-warning mb-1" onClick="history.go(-1)"><i class="uil uil-angle-left"></i> Voltar</a>
                                    <a class="btn btn-sm btn-success mb-1" href="#novoEvento" data-toggle="modal" data-target="#novoEvento"><i class="bi bi-calendar3"></i> Novo Evento</a>
                                </div>
                            </div>
                        </div>
                        <!-- fim header -->
                        <!--conteudo da tela aqui-->
                            <div class="card mb-3">
                                <div class="card-body p-1">
                                    <div id="calendar"></div>
                                </div>
                            </div>

                        <!-- Modal subcategoria-->
<div class="modal fade" id="novoEvento" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <form action="../ferramentas/adiciona-evento.php" method="POST">
    <div class="modal-content">
      <div class="modal-header header-filtro">
        <h5 class="modal-title" id="exampleModalLabel">Adicionar Evento</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body card-fundo-body">
          
            <div class="row">
                <div class="col-lg-12 col-md-12 col-12">
                                                    <div class="form-floating mb-3">
                                                        <input type="text" name="tituloEvento" class="form-control" id="tituloEvento" placeholder="Título do Evento" maxlength="50" autocomplete="off" required>
                                                        <label for="tituloEvento">Título do Evento</label>
                                                    </div>  
                                                </div>
                <div class="col-lg-6 col-md-6 col-12">
                                                            <div class="form-floating mb-3">
                                                                <input type="datetime-local" name="dataRefIncialF" id="dataRefIncialF" class="form-control" placeholder="Insira a data e hora inicial" required>
                                                                <label for="dataRefIncialF">Data e Hora Inicial<span class="text-danger">*</span></label>
                                                            </div>  
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-12">
                                                            <div class="form-floating mb-3">
                                                                <input type="datetime-local" name="dataRefFinalF" id="dataRefFinalF" class="form-control" placeholder="Insira a data e hora final" required>
                                                                <label for="dataRefFinalF">Data e Hora Final <span class="text-danger">*</span></label>
                                                            </div>  
                                                        </div>
                <div class="col-lg-6 col-md-6 col-12">
                                                    <div class="form-floating mb-3">
                                                        <input type="color" name="corEvento" class="form-control" id="corEvento" placeholder="Cor Evento" autocomplete="off" value='#6610f2' required>
                                                        <label for="corEvento">Cor do Evento</label>
                                                    </div>  
                                                </div>
                <div class="col-lg-6 col-md-6 col-12">
                                                    <div class="form-floating mb-3">
                                                        <input type="text" name="nomeAgendador" class="form-control" id="nomeAgendador" placeholder="Nome" autocomplete="off" value="<?php echo $NOME;?>" readonly required>
                                                        <label for="nomeAgendador">Participante</label>
                                                    </div>  
                                                </div>
               
                
            </div>
      </div>
      <div class="modal-footer card-fundo-body p-1">
          <button type="submit" class="btn btn-success loading btn-sm"><i class="uil uil-plus"></i> Adicionar Evento</button>
        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="uil uil-times"></i> Cancelar</button>
      </div>
    </div>
  </form>
  </div>
</div>
<!-- fim modal subcategoria -->

<?php
    if(isset($_GET["sucesso"])){
                            $sucesso = (int) $_GET["sucesso"];
                            if ($sucesso === 1) {
                                echo '<div class="toast-container position-fixed bottom-0 end-0 p-3 ">
            <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="4000">
                <div class="toast-header border-light" style="background-color: #a3cfbb; color: #1c1d3c;">
                    <strong class="me-auto">FNCC AVISA</strong>
                    <small>Agora</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body" style="background-color: #a3cfbb; color: #1c1d3c;"">
                    <span>Evento adicionado!</span>
                </div>
            </div>
        </div>';
    } }
    
     if (isset($_GET["erro"])) {
                            $erro = (int) $_GET["erro"];
                            if ($erro === 1) {
                                echo '<div class="toast-container position-fixed bottom-0 end-0 p-3">
            <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="4000">
                <div class="toast-header border-light" style="background-color: #f5c2c7; color: #1c1d3c;">
                    <strong class="me-auto">FNCC AVISA</strong>
                    <small>Agora</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body" style="background-color: #f5c2c7; color: #1c1d3c;"">
                    <span>Erro ao adicionar o evento!</span>
                </div>
            </div>
        </div>';
                            }
     }
                                ?>
                        <!--fim conteudo da tela aqui-->
                        <?php include_once "../ferramentas/modal_loading.php"; ?>
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
        <script>
            $(".nav .nav-link").on("click", function () {
                $(".nav").find(".menu-ativo").removeClass("menu-ativo");
                $(this).addClass("menu-ativo");
            });
        </script>

        <script src="../js/loading.js"></script>
        <script src="../js/grafico_circulo_home.js"></script>
        <script>
            var largura = window.innerWidth;
        // add the responsive classes after page initialization
        if (largura < 768){
window.onload = function () {
    $('.fc-toolbar.fc-header-toolbar').addClass('row');
    $('.fc-toolbar-chunk').addClass('col-12');
    $('.fc-col-header-cell-cushion').addClass('semana'); 
};

// add the responsive classes when navigating with calendar buttons
$(document).on('click', '.fc-button', function(e) {
    $('.fc-toolbar.fc-header-toolbar').addClass('row');
    $('.fc-toolbar-chunk').addClass('col-12');
    $('.fc-toolbar-title').addClass('col-12');
    $('.fc-col-header-cell-cushion').addClass('semana'); 
});
}
        </script>
    </body>
</html>
