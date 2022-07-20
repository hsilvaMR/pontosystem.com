 $(document).ready(function() {

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
                Login  ADMIN 
            ---------------------------------------------------  
         */
     $('#loginFormAdmin').on('submit', function(e) {
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
                         window.location.href = "/admin/backoffice";
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
                             var url = '/admin';
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


 })