var cont = 1;
        $('#btn-col').click(function () {
cont++;
        $('#coladicionais').append('<div class="row mt-2" id="colAdd' + cont + '"> <div class="col-lg-4 col-md-4 col-12"> <div class="form-floating mb-3"> <input type="text" name="col_nomeN[]" class="form-control" placeholder="Nome"> <label for="col_nome">Nome Colaborador</label> </div></div><div class="col-lg-3 col-md-3 col-12"> <div class="form-floating mb-3"> <input type="text" name="col_areaN[]" class="form-control" placeholder="Área"> <label for="col_area">Área</label> </div></div><div class="col-lg-4 col-md-4 col-12"> <div class="form-floating mb-3"> <input type="email" name="col_emailN[]" class="form-control" placeholder="E-mail"> <label for="col_email">E-mail</label> </div></div><div class="col-lg-1 col-md-1 col-12 g-2 align-items-center"><button type="button" id="' + cont + '" class="btn btn-danger btn-md btn-apagar"><i class="uil uil-minus-square"></i></button> </div></div>');
});
        $('form').on('click', '.btn-apagar', function () {
var button_id = $(this).attr("id");
        $('#colAdd' + button_id + '').remove();
});