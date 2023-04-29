<?php
require_once '../config/conexao.php';
require_once '../config/sessao.php';
require_once '../config/config_geral.php';
require_once 'sql-grafico-circulo-home.php';

function saudacao() {
    $hora = date('H');
    if ($hora >= 6 && $hora <= 12)
        return 'Bom dia';
    else if ($hora > 12 && $hora <= 18)
        return 'Boa tarde';
    else
        return 'Boa noite';
}
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
        <title>Tela Principal</title>
        <link rel="icon" type="image/png" sizes="512x512" href="../img/fncc-logotipo-colorido.png">
        <link rel="icon" type="image/png" sizes="48x48" href="../img/fncc-logotipo-colorido.png">
        <link rel="icon" type="image/png" sizes="32x32" href="../img/fncc-logotipo-colorido.png">
        <link href="../css/menu.css" rel="stylesheet" />
        <link href="../css/home.css" rel="stylesheet" />
        <link rel="manifest" href="../manifest.json">
        <script src="https://code.jquery.com/jquery-3.6.2.min.js" integrity="sha256-2krYZKh//PcchRtd+H+VyyQoZ/e3EcrkxhM8ycwASPA=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://unicons.iconscout.com/release/v3.0.6/css/line.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
        <link href="../css/style.css" rel="stylesheet" />
        <link href="../css/grafico_circulo_home.css" rel="stylesheet" />
    </head>
    <body class="sb-nav-fixed fundo_tela">
        <?php include_once "../ferramentas/navbar.php"; ?>
        <div id="layoutSidenav">
            <?php include_once "../ferramentas/menu.php"; ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <!--conteudo da tela aqui!-->
                        <div class="row">
                            <div class="col-md-12">
                                <h6 class="mt-1"><?php echo saudacao(); ?>, <span class="destaque"><?php echo ucwords($NOME); ?></span></h6>
                                <!--<p>Que bom te ver por aqui! <i class=" fw-bold destaque bi bi-emoji-smile"></i></p>-->
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="mt-2 blockquote-footer" style="font-size: 16px;">Acesso Rápido</h4>
                            </div>
                        </div>
                        <div class="row">
                            <?php
                            $buscaSubmenu = mysqli_query($conexao, "SELECT submenu, icone_sub, caminho FROM submenu INNER JOIN nivel_acesso ON cod_submenu = codSubmenu WHERE cod_perfil = $NIVEL and marcado = 1 ORDER BY RAND() LIMIT 12");
                            while ($resultadoAcessoRapido = mysqli_fetch_assoc($buscaSubmenu)) {
                                ?>


                                <div class="col-lg-2 col-md-2 col-6 mb-2">
                                    <a href="<?php echo $resultadoAcessoRapido['caminho']; ?>" class="link-rapido">
                                        <div class="card h-100 border-0" style="border-radius:15px;">
                                            <div class="card-body text-center card-acesso-rapido p-1">
                                                <h5><i class="<?php echo $resultadoAcessoRapido['icone_sub']; ?>"></i></h5>
                                                <h6><?php echo substr($resultadoAcessoRapido['submenu'], 0, 17); ?></h6>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h4 class="blockquote-footer mt-2" style="font-size: 16px;">Quadro de Avisos</h4>
                                    </div>
                                    <div class="col-12">
                                        <div class="card mb-2 border-0 card-aviso">
                                            <div class="card-header fw-bold">
                                                <div class="row">
                                                    <div class="col text-center" style="white-space: nowrap;">Aviso</div>
                                                    <div class="col text-center">Data</div>
                                                    <div class="col text-center">Ação</div>
                                                </div>
                                            </div>
                                            <div class="card-body text-center p-1">
                                                <?php
                                                $queryAviso = "SELECT * FROM avisos WHERE coop_aviso in($COOPERATIVA, 0) ORDER BY cod_aviso DESC LIMIT 4 ";
                                                $buscaAviso = mysqli_query($conexao, $queryAviso);
                                                if (mysqli_num_rows($buscaAviso) > 0) {
                                                    ?>
                                                    <ul class="list-group list-group-flush"> 
                                                        <?php
                                                        while ($resultadoAviso = mysqli_fetch_assoc($buscaAviso)) {
                                                            ?>
                                                            <li class="list-group-item list-group-item-action">
                                                                <div class="row">
                                                                    <div class="col col-4" style="white-space: nowrap;"><?php echo $resultadoAviso["aviso"]; ?></div>
                                                                    <div class="col col-4"><?php echo strftime('%d.%m.%Y', strtotime($resultadoAviso["data_aviso"])); ?></div>
                                                                    <div class="col col-4"><a class="btn btn-sm btn-outline-primary" title="Visualizar" href="<?php echo $resultadoAviso["link_aviso"]; ?>">Visualizar</a></div>
                                                                </div>
                                                            </li>
                                                            <?php
                                                        }
                                                    } else {
                                                        ?>
                                                        <h6 class="destaque" style="margin-top:18%;">Ainda não temos avisos para exibir! <i class="bi bi-emoji-neutral"></i></h6>
                                                        <?php
                                                    }
                                                    ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h4 class="blockquote-footer mt-2" style="font-size: 16px;">Dashboard</h4>
                                    </div>
                                    <div class="col-12">
                                        <div class="card mb-2 border-0 home-dashboard">
                                            <div class="card-header fw-bold">
                                                <div class="row">
                                                    <div class="col text-center" style="font-size: 14px;">Dashboard Consultas</div>
                                                </div>
                                            </div>
                                            <div class="card-body text-center p-1 d-lg-flex justify-content-lg-center align-items-lg-center">
                                                <div class="row">
                                                    <div class="col-md-3 col-lg-3 col-6 mb-2" >
                                                        <!-- Progress bar 1 -->
                                                        <div class="progress mx-auto" data-value='<?php echo $totalAbertos; ?>'>
                                                            <span class="progress-left">
                                                                <span class="progress-bar aberto"></span>
                                                            </span>
                                                            <span class="progress-right">
                                                                <span class="progress-bar aberto"></span>
                                                            </span>
                                                            <div class="progress-value w-100 h-100 rounded-circle d-flex align-items-center justify-content-center">
                                                                <span class="h5 mb-0"><?php echo $totalAbertos; ?><br><span style="font-size: 13px;">Abertos</span></span>
                                                            </div>
                                                        </div>
                                                        <!-- END -->
                                                    </div>
                                                    <div class="col-md-3 col-lg-3 col-6 mb-2">
                                                        <!-- Progress bar 1 -->
                                                        <div class="progress mx-auto" data-value='<?php echo $totalAndamento; ?>'>
                                                            <span class="progress-left">
                                                                <span class="progress-bar emAndamento"></span>
                                                            </span>
                                                            <span class="progress-right">
                                                                <span class="progress-bar emAndamento"></span>
                                                            </span>
                                                            <div class="progress-value w-100 h-100 rounded-circle d-flex align-items-center justify-content-center">
                                                                <span class="h5 mb-0"><?php echo $totalAndamento; ?><br><span style="font-size: 13px;">Andamento</span></span>
                                                            </div>
                                                        </div>
                                                        <!-- END -->
                                                    </div>
                                                    <div class="col-md-3 col-lg-3 col-6 mb-2">
                                                        <!-- Progress bar 1 -->
                                                        <div class="progress mx-auto" data-value='<?php echo $totalAguardando; ?>'>
                                                            <span class="progress-left">
                                                                <span class="progress-bar aguardando"></span>
                                                            </span>
                                                            <span class="progress-right">
                                                                <span class="progress-bar aguardando"></span>
                                                            </span>
                                                            <div class="progress-value w-100 h-100 rounded-circle d-flex align-items-center justify-content-center">
                                                                <span class="h5 mb-0"><?php echo $totalAguardando; ?><br><span style="font-size: 13px;">Aguardando</span></span>
                                                            </div>
                                                        </div>
                                                        <!-- END -->
                                                    </div>
                                                    <div class="col-md-3 col-lg-3 col-6 mb-2">
                                                        <!-- Progress bar 1 -->
                                                        <div class="progress mx-auto" data-value='<?php echo $totalPendente; ?>'>
                                                            <span class="progress-left">
                                                                <span class="progress-bar pendente"></span>
                                                            </span>
                                                            <span class="progress-right">
                                                                <span class="progress-bar pendente"></span>
                                                            </span>
                                                            <div class="progress-value w-100 h-100 rounded-circle d-flex align-items-center justify-content-center">
                                                                <span class="h5 mb-0"><?php echo $totalPendente; ?><br><span style="font-size: 13px;">Pendente</span></span>
                                                            </div>
                                                        </div>
                                                        <!-- END -->
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                        
                        
                        <!-- Modal atualiza cadastro-->
            <div class="modal fade" id="atualizaCadastroCoop" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered" >
      <div class="modal-content border-0" style="box-shadow: 0 0 2px 1px #FFD70F;">
      <div class="modal-body p-2">
          <p style="font-size:18px;" class="cor-primaria">Olá <strong class="destaque"><?php echo $NOME; ?></strong>.<br> Os dados cadastrais da sua Cooperativa estão desatualizados!<br>Gostaria de atualizá-los agora?</p>
      </div>
      <div class="modal-footer p-0 border-0">
        <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal"><i class="bi bi-emoji-frown"></i> NÃO</button>
        <a type="button" href="editar-cooperativa.php?id=<?php echo $COOPERATIVA;?>" class="btn btn-lg btn-success"><i class="bi bi-emoji-smile"></i> SIM</a>
      </div>
    </div>
  </div>
</div>
                        <!-- modal atualiza cadastro -->
                        <!-- Modal lgpd -->
            <div class="modal fade" id="lgpd" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
                <div class="modal-dialog modal-lg modal-dialog-scrollable">
      <div class="modal-content border-0" style="box-shadow: 0 0 2px 1px #FFD70F;">
          <div class="modal-header header-filtro">
        <h5 class="modal-title" id="exampleModalLabel">TERMO DE CONSENTIMENTO PARA TRATAMENTO DE DADOS PESSOAIS</h5>
      </div>
      <div class="modal-body p-2" style="font-size:15px;">
          <p class="cor-primaria">Olá <strong class="destaque"><?php echo $NOME; ?></strong>.</p>
          <p>A <strong class="destaque">FNCC</strong> leva a sério a sua privacidade e a proteção dos seus dados pessoais e este documento tem o objetivo de explicar, de forma clara e transparente, como os seus dados pessoais são tratados quando você acessa o sistema, , assim como quais são seus direitos e obrigações quanto à proteção de dados pessoais.</p>
          <p>Neste contexto, o <strong class="destaque">FNCC</strong> em regra é o controlador dos dados pessoais e, portanto, responsável por tomar decisões relacionadas à forma e extensão do tratamento dos dados pessoais coletados e mantidos em virtude da sua relação conosco.</p>
          <p>Ademais, esclarecemos que a Lei Geral de Proteção de Dados exige que todos os dados pessoais tratados pela <strong class="destaque">FNCC</strong> sejam tratados de acordo com princípios específicos, determinados no art. 6º desta lei. Assim, os dados pessoais devem:</p>
          <ul>
              <li>Ser tratados em boa-fé e de maneira transparente;</li>
              <li>Ser coletados para propósitos legítimos, específicos, explícitos e informados e não ser posteriormente tratados de forma incompatível com essas finalidades;</li>
              <li>Ser adequados e limitados ao mínimo necessário para atingir as finalidades para os quais são tratados;</li>
              <li>Ser exatos, claros, relevantes e atualizados, sendo que devem ser tomadas todas as medidas razoáveis para garantir que os dados pessoais imprecisos ou inaplicáveis aos fins para os quais são coletados, armazenados e/ou tratados sejam apagados ou retificados sem demora;</li>
              <li>Ser tratados de maneira a garantir a segurança adequada dos dados pessoais, incluindo utilizando medidas técnicas e administrativas aptas a proteger os dados pessoais de acessos não autorizados e de situações acidentais ou ilícitas de destruição, perda, alteração, comunicação ou difusão;</li>
              <li>Não ser tratados para fins discriminatórios ilícitos ou abusivos.</li>
          </ul>
          <h6>QUE TIPOS DE DADOS PESSOAIS A FNCC TRATA SOBRE VOCÊ E PARA QUAIS FINALIDADES?</h6>
          <p>A <strong class="destaque">FNCC</strong> coleta dados pessoais diretamente de você. Podemos coletar:</p>
          <ul>
              <li>nome completo;</li>
              <li>e-mail;</li>
              <li>número de telefone;</li>
              <li>nome da empresa onde você trabalha;</li>
              <li>cargo;</li>
              <li>número de CPF;</li>
              <li>cidade e estado.</li>
          </ul>
          <p>Entendemos que os dados pessoais que coletamos são necessários e servem para podermos elaborar e emitir o orçamento de serviços solicitado por você.</p>
          <h6>COMO ARMAZENAMOS OS SEUS DADOS PESSOAIS</h6>
          <p>Os dados pessoais que utilizamos são armazenados em servidor de arquivos digitais e/ou em sistemas de gestão utilizados pela <strong class="destaque">FNCC</strong>.</p>
          <p>Somente pessoas autorizadas têm acesso aos locais onde os dados são armazenados e estas possuem obrigação de sigilo firmada com a <strong class="destaque">FNCC</strong>.</p>
          <p>O armazenamento dos dados pessoais será mantido somente pelo período necessário para cumprir a finalidade pela qual os dados foram coletados, ou até que haja solicitação de exclusão feita pelo <strong>TITULAR</strong>, salvo para cumprimento de obrigação legal, observando-se o prazo de armazenamento determinado pela legislação brasileira.</p>
      <h6>COM QUEM COMPARTILHAMOS SEUS DADOS PESSOAIS</h6>
      <p>A <strong class="destaque">FNCC</strong> poderá compartilhar seus dados pessoais com os colaboradores das equipes técnicas, bem como com sua área comercial; e por força de ordem judicial ou de demandas de autoridades administrativas, para defesa dos interesses da <strong class="destaque">FNCC</strong>.</p>
      <p>Em conformidade ao artigo 48 da Lei nº 13.709, a <strong class="destaque">FNCC</strong> comunicará ao TITULAR e à Autoridade Nacional de Proteção de Dados – ANPD a ocorrência de incidente de segurança que possa acarretar risco ou dano relevante ao TITULAR.</p>
      <h6>QUAIS SÃO OS SEUS DIREITOS E COMO VOCÊ PODE EXERCÊ-LOS?</h6>
      <p>A <strong class="destaque">FNCC</strong> compromete-se a cumprir com os direitos que a LGPD garante a você. São eles:</p>
      <ul>
              <li>Confirmação de tratamento e acesso;</li>
              <li>Correção;</li>
              <li>Anonimização, bloqueio ou eliminação;</li>
              <li>Portabilidade;</li>
              <li>Informações sobre o compartilhamento;</li>
              <li>Informação sobre a possibilidade de não oferecer consentimento e sobre as consequências da sua negativa;</li>
              <li>Revisão de decisões automatizadas;</li>
              <li>Revogação de consentimento;</li>
              <li>Oposição.</li>
          </ul>
      <p>No entanto, como comentamos acima, em alguns casos não poderemos processar completamente o seu pedido de exclusão ou sua oposição, na medida em que poderemos tratar seus dados pessoais para o cumprimento de nossas obrigações legais e/ou regulatórias, para exercício de direitos em processos, para execução do seu contrato conosco, para o legítimo interesse da <strong class="destaque">FNCC</strong>, entre outras finalidades informadas a você. Quando isto ocorrer, nós informaremos você na resposta à sua solicitação e estaremos disponíveis para esclarecer suas dúvidas sobre o tema.</p>
      <p>Além dos direitos acima citados, você tem o direito de peticionar à ANPD caso você entenda que o tratamento de seus dados pessoais tenha sido realizado de forma ilícita ou em desacordo com a legislação aplicável ao tema.</p>
      <p>Por favor, considere que podemos solicitar informações com o propósito de verificar sua identidade antes de atender a quaisquer solicitações para exercer os direitos acima elencados.</p>
      <h6>COMO A FNCC PROTEGE SEUS DADOS PESSOAIS</h6>
      <p>Nos comprometemos e assumimos a responsabilidade de utilizar seus dados pessoais com o máximo cuidado e segurança possível, sempre em respeito as finalidades descritas neste TERMO. Com este propósito, adotamos medidas técnicas e organizacionais para conferir segurança a todos os dados pessoais tratados pela <strong class="destaque">FNCC</strong>.</p>
      <p>Exemplos de tais medidas são controles de acesso segmentado (níveis e listas de controle de acesso aos sistemas), acordos de não divulgação, políticas de uso de equipamentos, anti-malware, firewall, controle de acesso lógico, autenticação de rede e atualizações regulares dos softwares, backup dos dados pessoais, entre outros controles.</p>
      <p>Nós nos esforçamos para criar e manter um ambiente seguro no que toca a proteção de dados pessoais, mas infelizmente não podemos garantir total segurança. Falhas de hardware ou software que não estejam sob controle da <strong class="destaque">FNCC</strong>, assim como outros fatores externos podem comprometer a segurança dos seus dados pessoais. Assim, caso você identifique ou tome conhecimento de qualquer fator que comprometa a segurança dos seus dados pessoais ou de terceiros nos ambientes da <strong class="destaque">FNCC</strong>, por favor entre em contato conosco por meio do canal de comunicação indicado abaixo.</p>
      <h6>COMO E COM QUEM FALAR NA FNCC SOBRE PROTEÇÃO DE DADOS PESSOAIS</h6>
      <p>Em caso de dúvidas quanto ao conteúdo deste <strong>TERMO</strong> ou sobre qualquer tema atinente à forma como a <strong class="destaque">FNCC</strong> trata dados pessoais, assim como para exercitar seus direitos como <strong>TITULAR</strong>, conforme descrito no capítulo acima, basta entrar em contato conosco por meio do e-mail fncc@fncc.com.br, sendo que as solicitações serão consideradas de acordo com as leis aplicáveis.</p>
      <p>Ao assinar o presente TERMO, você consente e concorda que a <strong class="destaque">FNCC</strong> tome decisões referentes ao tratamento de seus dados pessoais, bem como realize o tratamento destes, envolvendo operações como a coleta, produção, recepção, classificação, utilização, acesso, reprodução, transmissão, distribuição, processamento, arquivamento, armazenamento, eliminação, avaliação ou controle da informação, modificação, comunicação, transferência, difusão ou extração.</p>
      </div>
      <div class="modal-footer p-0">
        <a type="button" class="btn btn-sm btn-danger" href="../ferramentas/logout.php"><i class="bi bi-emoji-frown"></i> NÃO</button>
        <a type="button" href="../ferramentas/lgpd.php?id=<?php echo $CODIGOUSUARIO;?>" class="btn btn-lg btn-success"><i class="bi bi-emoji-smile"></i> SIM</a>
      </div>
    </div>
  </div>
</div>
                        <!-- modal lgpd -->
                        <!--fim conteudo da tela aqui!-->
                    </div>
                </main>
                <?php include_once "../ferramentas/rodape.php"; ?>
            </div>
        </div>
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
        <script src="../js/grafico_circulo_home.js"></script>
        
        
        <?php
        if($NIVEL == 3 || $NIVEL == 4){  
        }else{
        $ConsultaCoopCadastro = mysqli_query($conexao, "SELECT coop_dados_atualizados FROM cooperativas WHERE cod_coop = '$COOPERATIVA'");
        if(mysqli_num_rows($ConsultaCoopCadastro) > 0 ){
            $resultadoCadastroCoop = mysqli_fetch_assoc($ConsultaCoopCadastro);
            $coopDadosAtualizado = $resultadoCadastroCoop["coop_dados_atualizados"];
            if($coopDadosAtualizado == 1){
            }else{
               echo '<script type="text/javascript">
    $(window).on("load",function(){
    $("#atualizaCadastroCoop").modal("show"); });
</script>'; 
            }
        }
        }
        ?>

        <?php 
        $consultaLGPD = mysqli_query($conexao, "SELECT lgpd FROM usuarios WHERE id_usuario = '$CODIGOUSUARIO'");
        if(mysqli_num_rows($consultaLGPD) > 0){
            $resultadoLGPD = mysqli_fetch_assoc($consultaLGPD);
            $lgpdAceita = $resultadoLGPD["lgpd"];
            if($lgpdAceita == "1"){
                
            }else{
                echo '<script type="text/javascript">
    $(window).on("load",function(){
    $("#lgpd").modal("show"); });
</script>';
            }
        }
        ?>

    </body>
</html>
