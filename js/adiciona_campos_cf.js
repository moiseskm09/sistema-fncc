var cont = 1;
        $('#btn-cf').click(function () {
cont++;
        $('#cfadicionais').append('<div class="row mt-2" id="cfAdd' + cont + '"> <div class="col-lg-4 col-md-4 col-12"> <div class="form-floating mb-3"> <input type="text" name="cf_nomeN[]" class="form-control" placeholder="Nome"> <label for="cf_nome">Nome</label> </div></div><div class="col-lg-4 col-md-4 col-12"> <div class="form-floating mb-3"> <input type="text" name="cf_cargoN[]" class="form-control" placeholder="Cargo"> <label for="cf_cargo">Cargo</label> </div></div><div class="col-lg-4 col-md-4 col-12"> <div class="form-floating mb-3"> <input type="date" name="cf_mandatoN[]" class="form-control" placeholder="Mandato"> <label for="cf_mandato">Mandato</label> </div></div><div class="col-lg-4 col-md-4 col-12"> <div class="form-floating mb-3"> <input type="tel" name="cf_telefoneN[]" class="form-control maskcel" placeholder="Celular" data-mask="(00) 0 0000-0000"> <label for="cf_telefone">Celular</label> </div></div><div class="col-lg-7 col-md-7 col-12"> <div class="form-floating mb-3"> <input type="email" name="cf_emailN[]" class="form-control" placeholder="E-mail"> <label for="cf_email">E-mail</label> </div></div><div class="col-lg-1 col-md-1 col-12 g-2 align-items-center"><button type="button" id="' + cont + '" class="btn btn-danger btn-md btn-apagar"><i class="uil uil-minus-square"></i></button></div></div>');
});
        $('form').on('click', '.btn-apagar', function () {
var button_id = $(this).attr("id");
        $('#cfAdd' + button_id + '').remove();
});