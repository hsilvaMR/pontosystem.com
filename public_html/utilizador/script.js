$(document).ready(function() {
    // abrir ponto
    $('.btn-abrirPonto').on('click', function() {
            window.location.href = "/ponto/abrir";
        })
        // fechar ponto 
    $('.btn-fecharPonto').on('click', function() {

            window.location.href = "/ponto/fechar";
        })
        // opem modal  
        // $('#modalTest').on('click', function() {
        //         $('#modal-open-point').modal('show');
        //     })
        // opem backoffice
    $('#backofficeTest').on('click', function() {
        window.location.href = "/admin/backoffice";
    })

    // tela login user
    $('.btnLogin').on('click', function() {
        window.location.href = "/login";
    })


    // modal de consulta
    $('.btnConsulta').on('click', function() {
        $('#modal-consulta').modal('show');
    })


    // reset Password
    $('#recoverPassword').on('click', function() {
        $('.modulo-reset-password').removeClass("d-none")
        $('.modulo-login').addClass("d-none")
    })

    // reset Password
    $('#moduloLogin').on('click', function() {

            $('.modulo-login').removeClass("d-none")
            $('.modulo-reset-password').addClass("d-none")
        })
        /*  ---------------------------------------------------  
                 Validar Pin 
            ---------------------------------------------------  
        */
    $('#formPinCheckOpen').on('submit', function(e) {
        var form = $(this);
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: form.attr('action'),
            data: new FormData(this),
            contentType: false,
            processData: false,
            cache: false,
            headers: { 'X-CSRF-Token': '{!! csrf_token() !!}' },
            success: function(data) {

                if (data == "invalid" || data == "empty") {
                    alert(data)
                } else {

                    // var response = $.trim(data)
                    var response = $.parseJSON(data)
                    if ($.trim(response.sucess) == "valido") {

                        switch ($('#idTipo').val()) {
                            case 'open':
                                $('#modal-open-point').modal('show');
                                dataAtual()
                                $('#nameId').val(response.nome);
                                $('#idFuncionario').val(response.id);
                                break;
                            default:
                                $('#modal-close-point').modal('show');
                                dataAtualClose()
                                $('#nameIdc').val(response.nome);
                                $('#idFuncionarioC').val(response.id);
                                break;
                        }

                    }

                }

            }
        });
    });

    /*  ---------------------------------------------------  
             Abrir Ponto 
         ---------------------------------------------------  
     */
    $('#openForm').on('submit', function(e) {
        var form = $(this);
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: form.attr('action'),
            data: new FormData(this),
            contentType: false,
            processData: false,
            cache: false,
            headers: { 'X-CSRF-Token': '{!! csrf_token() !!}' },
            success: function(data) {
                var response = $.trim(data)
                switch (response) {
                    case 'aberto':
                        alert("Ponto Aberto com Sucesso")
                        break;
                    default:
                        alert(response)
                        break;
                }

            }
        });
    });

    /*  ---------------------------------------------------  
             FEchar  Ponto 
         ---------------------------------------------------  
     */
    $('#closeForm').on('submit', function(e) {
        var form = $(this);
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: form.attr('action'),
            data: new FormData(this),
            contentType: false,
            processData: false,
            cache: false,
            headers: { 'X-CSRF-Token': '{!! csrf_token() !!}' },
            success: function(data) {
                var response = $.trim(data)
                switch (response) {
                    case 'fechado':
                        alert("Ponto Fechado com Sucesso !")
                        break;
                    default:
                        alert(response)
                        break;
                }

            }
        });
    });

    /*  ---------------------------------------------------  
             Ativar Conta 
         ---------------------------------------------------  
     */
    $('#frValidarConta').on('submit', function(e) {
        var form = $(this);
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: form.attr('action'),
            data: new FormData(this),
            contentType: false,
            processData: false,
            cache: false,
            headers: { 'X-CSRF-Token': '{!! csrf_token() !!}' },
            success: function(data) {
                var response = $.trim(data)
                switch (response) {
                    case 'ativo':
                        $('.infomsg').removeClass("d-none");
                        $('.infomsg').css('background-color', 'green');
                        $('#infomsgAtivar').html("Conta Ativado com Sucesso !");
                        setTimeout(function() {
                            var url = '/login';
                            if ($('#tipoV').val() == "Admin") {
                                url = "/admin"
                            }
                            window.location.href = url
                        }, 2000);
                        break;
                    default:
                        $('.infomsg').removeClass("d-none");
                        $('#infomsgAtivar').html(response);
                        break;
                }

            }
        });
    });

    /*  ---------------------------------------------------  
           NOVA Password
        ---------------------------------------------------  
    */
    $('#frResetPassword').on('submit', function(e) {
        var form = $(this);
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: form.attr('action'),
            data: new FormData(this),
            contentType: false,
            processData: false,
            cache: false,
            headers: { 'X-CSRF-Token': '{!! csrf_token() !!}' },
            success: function(data) {
                var response = $.trim(data)
                switch (response) {
                    case 'ativo':
                        $('.infomsg').removeClass("d-none");
                        $('.infomsg').css('background-color', 'green');
                        $('#infoPass').html("Password Atualizado com Sucesso !");
                        setTimeout(function() {
                            var url = '/login';
                            if ($('#tipoV').val() == "Admin") {
                                url = "/admin"
                            }
                            window.location.href = url
                        }, 2000);
                        break;
                    default:
                        $('.infomsg').removeClass("d-none");
                        $('.infomsg').css('background-color', 'red');
                        $('#infoPass').html(response);
                        break;
                }

            }
        });
    });

    /*  ---------------------------------------------------  
             Login  ADMIN 
         ---------------------------------------------------  
      */
    $('#loginFormUser').on('submit', function(e) {
        var form = $(this);
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: form.attr('action'),
            data: new FormData(this),
            contentType: false,
            processData: false,
            cache: false,
            headers: { 'X-CSRF-Token': '{!! csrf_token() !!}' },
            success: function(data) {
                var response = $.trim(data)
                switch (response) {
                    case 'success':
                        window.location.href = "/area-cliente/dashboard";
                        break;
                    default:
                        $('.infomsg').removeClass('d-none');
                        $('#errorMessg').html(response);
                        break;
                }
            }
        })
    });

    /*  ---------------------------------------------------  
             EDITAR UTILIZADOR  
        ---------------------------------------------------  
     */

    $('#editUser').on('submit', function(e) {
        var form = $(this);
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: form.attr('action'),
            data: new FormData(this),
            contentType: false,
            processData: false,
            cache: false,
            headers: { 'X-CSRF-Token': '{!! csrf_token() !!}' },
            success: function(data) {
                var response = $.trim(data)
                switch (response) {
                    case 'update':
                        $('.infomsg').removeClass("d-none");
                        $('.infomsg').css("background-color", "#20c997");
                        $('#errorMessg').html('Utilizador Atualizado com Sucesso!');
                        $("#editUser").trigger("reset")
                        $('#user-photo').addClass("d-none");
                        // box informacao after 3 second
                        setTimeout(function() {
                            $('.infomsg').addClass("d-none");
                        }, 6000); // dealy of 3 seconds
                        break;
                    default:
                        $('.infomsg').removeClass("d-none");
                        $('.infomsg').css("background-color", "red");
                        $('#errorMessg').html(response);
                        break;
                }
            }
        });
    });

    // delet Image
    $('#cleanFile').on('click', function() {
        if ($('#uploadF')) {

            $('#uploadF').val('');
            $('user-photo').attr('src', '');
            $('#user-photo').addClass("d-none");
        }
    })

    /*  ---------------------------------------------------  
           Recuperar Password 
        ---------------------------------------------------  
    */
    $('#frReset').on('submit', function(e) {
        var form = $(this);
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: form.attr('action'),
            data: new FormData(this),
            contentType: false,
            processData: false,
            cache: false,
            headers: { 'X-CSRF-Token': '{!! csrf_token() !!}' },
            success: function(data) {
                var response = $.trim(data)
                switch (response) {
                    case 'enviado':
                        $('.infomsg').removeClass("d-none");
                        $('.infomsg').css('background-color', 'green');
                        $('#infomsgAtivar').html("Email Enviado Com Sucesso !");

                        setTimeout(function() {
                            var url = '/login';
                            //  if ($('#tipoV').val() == "Admin") {
                            //      url = "/admin"
                            //  }
                            window.location.href = url
                        }, 2000);
                        break;
                    default:
                        $('.infomsg').removeClass("d-none");
                        $('#infomsgAtivar').html(response);
                        break;
                }

            }
        });
    });


    /*  ---------------------------------------------------  
            Consultar Horas 
       ---------------------------------------------------  
    */

    $('#consultaTime').on('submit', function(e) {
        var form = $(this);
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: form.attr('action'),
            data: new FormData(this),
            contentType: false,
            processData: false,
            cache: false,
            headers: { 'X-CSRF-Token': '{!! csrf_token() !!}' },
            success: function(data) {

                try {

                    let response = $.parseJSON(data)
                    if (response.total > 0) {
                        $('.box-result-consulta').removeClass("d-none")
                        $('.infomsg').removeClass("d-none");
                        $('#nomeF').val(response.nome);
                        let mesExt = $('#selecMonth').val() + "/" + $('#selecAno').val();
                        $('#dataStrong').html(mesExt);
                        $('#lblTotal').val(response.total + " Horas ");
                    } else {

                        alert("Nenhum Registo Encontrado Com Os Parâmetro Indicado !")
                        $('.box-result-consulta').addClass("d-none")
                    }

                } catch (error) {

                    alert("Nenhum Registo Encontrado Com Os Parâmetro Indicado !")
                    $('.box-result-consulta').addClass("d-none")
                    return false;
                }

            }
        });
    });

})

function validate(evt) {
    var theEvent = evt || window.event;

    // Handle paste
    if (theEvent.type === 'paste') {
        key = event.clipboardData.getData('text/plain');
    } else {
        // Handle key press
        var key = theEvent.keyCode || theEvent.which;
        key = String.fromCharCode(key);
    }

    var regex = /[0-9]|\./;
    if (!regex.test(key)) {
        theEvent.returnValue = false;
        if (theEvent.preventDefault) theEvent.preventDefault();
    }
}

function dataAtual() {

    var current = new Date();

    $('#horaId').val(current.toLocaleTimeString());
    $('#diaID').val(current.getDate());
    var months = ["Janeiro", "Feveiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"];
    // months[current.getMonth()]
    $('#mesID').val(months[current.getMonth()]);
    // mestring(current)
    $('#anoID').val(current.getFullYear());
}

function dataAtualClose() {

    var current = new Date();

    $('#horaIdC').val(current.toLocaleTimeString());
    $('#diaIDC').val(current.getDate());
    var months = ["Janeiro", "Feveiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"];
    // months[current.getMonth()]
    $('#mesIDC').val(months[current.getMonth()]);
    // mestring(current)
    $('#anoIDC').val(current.getFullYear());
}


function mestring(month) {

    switch (month.getMonth()) {
        case '1':
            $('#mesID').val("Janeiro");
            break;
        case '2':
            $('#mesID').val("Feveiro");
            break;
        case '3':
            $('#mesID').val("Março");
            break;
        case '4':
            $('#mesID').val("Abril");
            break;
        case '5':
            $('#mesID').val("Maio");
            break;
        case '6':
            $('#mesID').val("Junho");
            break;
        case '7':
            $('#mesID').val("Julho");
            break;
        case '8':
            $('#mesID').val("Agosto");
            break;
        case '9':
            $('#mesID').val("Setembro");
            break;
        case '10':
            $('#mesID').val("Outubro");
            break;
        case '11':
            $('#mesID').val("Novembro");
            break;
        case '12':
            $('#mesID').val("Dezembro");
            break;
    }
}

function uploadFile(input, element) {

    var imgElemento = document.getElementById("user-photo")
    $('#user-photo').removeClass("d-none")
    var quantidade = input.files.length;
    //PreViews
    const [file] = input.files
    imgElemento.src = URL.createObjectURL(file)

}


// setTimeout(function() {

//     $('#horaId').val(current.toLocaleTimeString());

// }, 600); // dealy of 3 seconds