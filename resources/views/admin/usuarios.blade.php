@extends('layouts.mainAdmin')

@section('contentAdmin')
    <div id="pnlUsu" class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h5 class="card-title"><span id="titPnl"></span> Usuario</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-4 form-group">
                            <label for="usucod" class="">Usuario</label>
                            <input name="usucod" id="usucod" type="text" class="form-control">
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 input-group">
                            <label for="usupass" class="w-100">Contraseña</label>
                            <div class="input-group mb-3">
                                <input name="usupass" id="usupass" type="password" class="form-control">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i id="icoEYE" class="fa fa-eye" onclick="verPass()"></i></span>
                                </div>                            
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 form-group">
                            <label for="usunom" class="">Nombre</label>
                            <input name="usunom" id="usunom" type="text" class="form-control">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-4 form-group">
                            <label for="usumail" class="">Email</label>
                            <input name="usumail" id="usumail" type="email" class="form-control">
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 form-group">
                            <label for="usutel" class="">Teléfono</label>
                            <input name="usutel" id="usutel" type="text" class="form-control">
                        </div>
                        <input name="accion" id="accion" type="text" class="form-control" hidden>                      
                    </div>
                    <div class="row">
                        <button class="mb-2 mr-2 btn btn-success ml-auto" onclick='guardar()'>Aceptar</button>
                        <button class="mb-2 mr-2 btn btn-danger" onclick='cancelar()'>Cancelar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">Listado de usuarios</h3>

                    <div class="card-tools">
                        <ul class="nav nav-pills ml-auto">
                            <li class="nav-item">
                                <button class="btn btn-primary" onclick='nuevo()'>Nuevo</button>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive" style="width: 100% !important;">                    
                        <table class="table display table-striped table-bordered" style="width: 100% !important;" id="tablaUsuarios">
                            <thead>
                                <tr>
                                    <th>Usuario</th>
                                    <th>Contraseña</th>
                                    <th>Nombre</th>
                                    <th>Email</th>
                                    <th>Teléfono</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                        </table>
                    </div>                  
                </div>
            </div>            
        </div>
    </div>

    <script>
        $(function() {
            $("#pnlUsu").hide();

            let table = $('#tablaUsuarios').DataTable({
                "language": {
                    "emptyTable":			"No hay datos disponibles en la tabla.",
                    "info":		   		"Del _START_ al _END_ de _TOTAL_ ",
                    "infoEmpty":			"Mostrando 0 registros de un total de 0.",
                    "infoFiltered":			"(filtrados de un total de _MAX_ registros)",
                    "infoPostFix":			"(actualizados)",
                    "lengthMenu":			"Mostrar _MENU_ registros",
                    "loadingRecords":		"Cargando...",
                    "processing":			"Procesando...",
                    "search":			"Buscar:",
                    "searchPlaceholder":		"Dato para buscar",
                    "zeroRecords":			"No se han encontrado coincidencias.",
                    "paginate": {
                        "first":			"Primera",
                        "last":				"Última",
                        "next":				"Siguiente",
                        "previous":			"Anterior"
                    },
                    "aria": {
                        "sortAscending":	"Ordenación ascendente",
                        "sortDescending":	"Ordenación descendente"
                    }
                },            
                processing: true,
                serverSide: true,
                ajax: "{{ url('/usuarios/show') }}",
                columns: [
                    { data: 'usuario_id' },
                    { data: 'password' },
                    { data: 'usuario_nombre' },
                    { data: 'email' },
                    { data: 'usuario_telf' },
                    { defaultContent: "<button class='btn btn-secondary' id='btnedit' data-placement='bottom' data-html='true' title='Modificar' onclick='editar()' type='button'>"+
                        "<i class='fas fa-pencil-alt'></i></button> &nbsp; "+
                        "<button class='btn btn-danger' data-placement='bottom' data-html='true' title='Eliminar' onclick='eliminar()' type='button'>"+
                        "<i class='fas fa-trash'></i></button>"}
                ],
                "order": [[1, 'asc']]          
            });

            $('#tablaUsuarios tbody').on( 'click', 'tr', function () {
                if ( $(this).hasClass('selected') ) {
                    $(this).removeClass('selected');
                }
                else {
                    table.$('tr.selected').removeClass('selected');
                    $(this).addClass('selected');
                }
            });
        });

        function verPass(){
            var tipo = document.getElementById("usupass");
            var icon = document.getElementById("icoEYE");
            if(tipo.type == "password"){
                tipo.type = "text";
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            }else{
                tipo.type = "password";
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }

        function nuevo(){
            limpiarCampos();
            $("#pnlUsu").fadeIn(900);
            $("#accion").val('1');
            $("#usucod").focus();        
        };

        function cancelar(){
            limpiarCampos();
            $("#pnlUsu").fadeOut(300);
        };

        function limpiarCampos(){
            $("#usucod").val('');
            $("#usupass").val('');
            $("#usunom").val('');
            $("#usumail").val('');
            $("#usutel").val('');
            $("#accion").val('');
            $('#usucod').removeAttr('disabled'); //Enable
        };

        function guardar(){
            var usucod = document.getElementById("usucod").value;
            var usupass = document.getElementById("usupass").value;
            var usunom = document.getElementById("usunom").value;
            var usumail = document.getElementById("usumail").value;
            var usutel = document.getElementById("usutel").value;
            var tipoAcc = document.getElementById("accion").value;        
            var msg = '';          

            if(usucod == ''){
                $('#usucod').addClass("is-invalid");
                msg += '<em>El campo usuario debe estar lleno</em><br>';
            }else{
                $('#usucod').removeClass("is-invalid");
            }
            if(usupass == ''){
                $('#usupass').addClass("is-invalid");
                msg += '<em>El campo contraseña debe estar lleno</em>';
            }else{
                $('#usupass').removeClass("is-invalid");
            }
            if(usunom == ''){
                $('#usunom').addClass("is-invalid");
                msg += '<em>El campo nombre debe estar lleno</em>';
            }else{
                $('#usunom').removeClass("is-invalid");
            }
            if(usumail == ''){
                $('#usumail').addClass("is-invalid");
                msg += '<em>El campo E-mail debe estar lleno</em>';
            }else{
                $('#usumail').removeClass("is-invalid");
            }
            if(usutel == ''){
                $('#usutel').addClass("is-invalid");
                msg += '<em>El campo telefono debe estar lleno</em>';
            }else{
                $('#usutel').removeClass("is-invalid");
            } 

            if(msg == ''){
                if(tipoAcc == '1'){ // 1 - significa que esta insertando
                    $.ajax({
                        url: "/usuarios",
                        type: 'POST',
                        data: {'usucod':usucod,'usupass':usupass,'usunom':usunom,'usumail':usumail,'usutel':usutel},
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        error: function(err) {
                            alertasCustom(4,'¡Error!',err.statusText+" : "+err.responseJSON['message']); // 1: success, 2:info, 3:warning, 4:error
                        },
                        success: function(res) {
                            alertasCustom(1,'¡Exito!',res); // 1: success, 2:info, 3:warning, 4:error
                            $("#pnlUsu").fadeOut(300);
                            $('#tablaUsuarios').DataTable().ajax.reload();
                            limpiarCampos();
                            return false;
                        }
                    });
                }

                if(tipoAcc == '2'){ // 2 significa que esta actualizando
                    $.ajax({
                        url: "/usuarios/"+usucod,
                        type: 'PUT',
                        data: {'usucod':usucod,'usupass':usupass,'usunom':usunom,'usumail':usumail,'usutel':usutel},
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        error: function(err) {
                            alertasCustom(4,'¡Error!',err.statusText+" : "+err.responseJSON['message']); // 1: success, 2:info, 3:warning, 4:error
                        },
                        success: function(res) {
                            alertasCustom(1,'¡Exito!',res); // 1: success, 2:info, 3:warning, 4:error
                            $("#pnlUsu").fadeOut(300);
                            $('#tablaUsuarios').DataTable().ajax.reload();
                            limpiarCampos();
                            return false;
                        }
                    });
                }            
            }else{
                alertasCustom(4,'¡Atencion!',msg); // 1: success, 2:info, 3:warning, 4:error
            }
        };

        function eliminar(){
            var table = $('#tablaUsuarios').DataTable();
            $('#tablaUsuarios tbody').on( 'click', 'tr', function () {
                var idx = table.row(this).index();
                var arrData = table.row(idx).data();

                swal({
                    title: "Esta seguro de eliminar este registro?",
                    text: "Una vez eliminado no podra recuperarlo!",
                    icon: "warning",
                    buttons: ["No", "Si"],
                    dangerMode: true,
                    })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            url: "/usuarios/"+arrData['usuario_id'],
                            type: 'DELETE',
                            data: {},
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},                  
                            error: function(err) {
                                mensajes('Error',err.statusText+" : "+err.responseJSON['message'],'error');
                            },
                            success: function(res) {
                                mensajes('Exito!',res,'success');
                                $('#tablaUsuarios').DataTable().ajax.reload();
                                return false;
                            }
                        });
                    }
                });
            });
        }; 

        function editar(){
            var table = $('#tablaUsuarios').DataTable();
            $('#tablaUsuarios tbody').on( 'click', 'tr', function () {
                var idx = table.row(this).index();
                var arrData = table.row(idx).data();

                $("#usucod").val(arrData['usuario_id']);
                $('#usucod').attr('disabled', 'disabled'); //Disable
                $("#usupass").val(arrData['password']);
                $("#usunom").val(arrData['usuario_nombre']);
                $("#usumail").val(arrData['email']);
                $("#usutel").val(arrData['usuario_telf']);
                $("#idUsu").val(arrData['usuario_id']);
                $("#accion").val('2');
            });

            $("#pnlUsu").fadeIn(900);
            $("#usucod").focus();
        };        
    </script>  
@endsection