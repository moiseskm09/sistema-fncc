var cont = 1;
        $('#btn-dca').click(function () {
cont++;
        $('#dcaadicionais').append('<div class="row" id="dcaAdd' + cont + '"> <div class="col-lg-4 col-md-4 col-12"> <div class="form-floating mb-3"> <input type="text" name="dca_nomeN[]" class="form-control" placeholder="Nome"> <label for="dca_nome">Nome</label> </div></div><div class="col-lg-4 col-md-4 col-12"> <div class="form-floating mb-3"> <input type="text" name="dca_cargoN[]" class="form-control" placeholder="Cargo"> <label for="dca_cargo">Cargo</label> </div></div><div class="col-lg-4 col-md-4 col-12"> <div class="form-floating mb-3"> <input type="date" name="dca_mandatoN[]" class="form-control" placeholder="Mandato"> <label for="dca_mandato">Mandato</label> </div></div><div class="col-lg-4 col-md-4 col-12"> <div class="form-floating mb-3"> <input type="text" name="dca_telefoneN[]" class="form-control phone_with_ddd" placeholder="Celular"> <label for="dca_telefone">Celular</label> </div></div><div class="col-lg-7 col-md-7 col-12"> <div class="form-floating mb-3"> <input type="email" name="dca_emailN[]" class="form-control" placeholder="E-mail"> <label for="dca_email">E-mail</label> </div></div><div class="col-lg-1 col-md-1 col-12"><br><button type="button" id="' + cont + '" class="btn btn-danger btn-sm btn-apagar"><i class="uil uil-minus-square"></i></button></div></div>');
});
        $('form').on('click', '.btn-apagar', function () {
var button_id = $(this).attr("id");
        $('#dcaAdd' + button_id + '').remove();
});


var cont = 1;
        $('#btn-cf').click(function () {
cont++;
        $('#cfadicionais').append('<div class="row" id="cfAdd' + cont + '"> <div class="col-lg-4 col-md-4 col-12"> <div class="form-floating mb-3"> <input type="text" name="cf_nome[]" class="form-control" id="cf_nome" placeholder="Nome"> <label for="cf_nome">Nome</label> </div></div><div class="col-lg-4 col-md-4 col-12"> <div class="form-floating mb-3"> <input type="text" name="cf_cargo[]" class="form-control" id="cf_cargo" placeholder="Cargo"> <label for="cf_cargo">Cargo</label> </div></div><div class="col-lg-4 col-md-4 col-12"> <div class="form-floating mb-3"> <input type="date" name="cf_mandato[]" class="form-control" id="cf_mandato" placeholder="Mandato"> <label for="cf_mandato">Mandato</label> </div></div><div class="col-lg-4 col-md-4 col-12"> <div class="form-floating mb-3"> <input type="text" name="cf_telefone[]" class="form-control" id="cf_telefone" placeholder="Telefone"> <label for="cf_telefone">Telefone</label> </div></div><div class="col-lg-7 col-md-7 col-12"> <div class="form-floating mb-3"> <input type="email" name="cf_email[]" class="form-control" id="cf_email" placeholder="E-mail"> <label for="cf_email">E-mail</label> </div></div><div class="col-lg-1 col-md-1 col-12"><br><button type="button" id="' + cont + '" class="btn btn-danger btn-sm btn-apagar"><i class="uil uil-minus-square"></i></button></div></div>');
});
        $('form').on('click', '.btn-apagar', function () {
var button_id = $(this).attr("id");
        $('#cfAdd' + button_id + '').remove();
});


var cont = 1;
        $('#btn-col').click(function () {
cont++;
        $('#coladicionais').append('<div class="row" id="colAdd' + cont + '"> <div class="col-lg-4 col-md-4 col-12"> <div class="form-floating mb-3"> <input type="text" name="col_nome[]" class="form-control" id="col_nome" placeholder="Nome"> <label for="col_nome">Nome Colaborador</label> </div></div><div class="col-lg-3 col-md-3 col-12"> <div class="form-floating mb-3"> <input type="text" name="col_area[]" class="form-control" id="col_area" placeholder="Área"> <label for="col_area">Área</label> </div></div><div class="col-lg-4 col-md-4 col-12"> <div class="form-floating mb-3"> <input type="email" name="col_email[]" class="form-control" id="col_email" placeholder="E-mail"> <label for="col_email">E-mail</label> </div></div><div class="col-lg-1 col-md-1 col-12"><br><button type="button" id="' + cont + '" class="btn btn-danger btn-sm btn-apagar"><i class="uil uil-minus-square"></i></button> </div></div>');
});
        $('form').on('click', '.btn-apagar', function () {
var button_id = $(this).attr("id");
        $('#colAdd' + button_id + '').remove();
});



