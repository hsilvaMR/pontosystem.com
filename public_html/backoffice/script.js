 $(document).ready(function() {

     //  $('#table_id').dataTable({
     //      aoColumnDefs: [{
     //          "bSortable": false,
     //          "aTargets": [5]
     //      }]
     //  })

     //opem gestao user 
     $('#gestUser').on('click', function() {
         window.location.href = "/admin/users";
     })

     //opem registo de horas  
     $('#registerTime').on('click', function() {
         window.location.href = "/admin/registo-hora";
     })

     //opem registo de horas  
     $('#consultaH').on('click', function() {
         $('#modal-consulta').modal('show');
     })



     // modal de consulta
     $('.btnConsulta').on('click', function() {
         $('#modal-consulta').modal('show');
     })

     // open add user 
     $('#btn-add-user').on('click', function() {
         window.location.href = "/admin/user/add";
     })

     // delet Image
     $('#cleanFile').on('click', function() {
         if ($('#uploadF')) {

             $('#uploadF').val('');
             $('user-photo').attr('src', '');
             $('#user-photo').addClass("d-none");
         }
     })

     /*  ---------------------------------------------------  
            ADICIONAR  UTILIZADOR 
       ---------------------------------------------------  
    */
     $('#addUser').on('submit', function(e) {
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
                     case 'add':
                         $('.infomsg').removeClass("d-none");
                         $('.infomsg').css("background-color", "#20c997");
                         $('#errorMessg').html('Utilizador Registado com Sucesso!');
                         $("#addUser").trigger("reset")
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




     /*  ---------------------------------------------------  
             DELETAR UTILIZADOR   
        ---------------------------------------------------  
     */
     $("#dialog_sim").on('click', function() {

         $('#modal-delete').modal('hide');
         var id = localStorage.getItem("idDelet")
         $.ajax({
             type: 'POST',
             url: '/admin/user/delet/' + id,
             dataType: 'text',
             headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             },
             contentType: false,
             processData: false,
             success: function(data) {
                 var response = $.trim(data)
                 switch (response) {
                     case 'delet':
                         alert("Utilizador Removido com Sucesso !")
                         setTimeout(function() {
                             window.location.reload()
                         }, 1000);
                         break;
                     default:
                         alert(response)
                         break;
                 }
             }
         })

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

 });


 function uploadFile(input, element) {

     var imgElemento = document.getElementById("user-photo")
     $('#user-photo').removeClass("d-none")
     var quantidade = input.files.length;
     //PreViews
     const [file] = input.files
     imgElemento.src = URL.createObjectURL(file)

 }

 function saveId(id, idModal) {
     localStorage.setItem("idDelet", id)
     $('#' + idModal).modal('show');
 }

 function removID(idModal) {
     localStorage.removeItem("idDelet")
     $('#' + idModal).modal('hide');
 }

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