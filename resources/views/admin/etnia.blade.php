@extends('layouts.mainAdmin')

@section('contentAdmin')
    <div id="pnlEtnia" class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h5 class="card-title"><span id="titPnl"></span> Etnia</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-3 form-group">
                            <label for="nombre" class="">Nombre</label>
                            <input name="nombre" id="nombre" type="text" class="form-control">
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <div class="position-relative form-group">
                                <label for="selEstado" class="">Estado</label>
                                <select name="selEstado" id="selEstado" class="form-control">
                                    <option value="1">Activo</option>
                                    <option value="0">Inactivo</option>
                                </select>
                            </div>
                        </div>

                        <input name="idEtni" id="idEtni" type="text" class="form-control" hidden>
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
                    <h3 class="card-title">Listado de Etnias</h3>

                    <div class="card-tools">
                        <ul class="nav nav-pills ml-auto">
                            <li class="nav-item">
                                <button class="btn btn-primary" onclick='nuevo()'>Nueva</button>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive" style="width: 100% !important;">                    
                        <table class="table display table-striped table-bordered" style="width: 100% !important;" id="tablaEtnia">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Estado</th>
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
            $("#pnlEtnia").hide();

            let table = $('#tablaEtnia').DataTable({
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
                ajax: "{{ url('/etnia/show') }}",
                columns: [
                    { data: 'etnia_nombre' },
                    { render: function (data, type, JsonResultRow, meta) {
                        var dato = "Inactivo";
                        if(JsonResultRow['estado'] == 1){
                            dato = "Activo";
                        };
                        return "<span>"+dato+"</span>";}
                    },                    
                    { defaultContent: "<button class='btn btn-secondary' id='btnedit' data-placement='bottom' data-html='true' title='Modificar' onclick='editar()' type='button'>"+
                        "<i class='fas fa-pencil-alt'></i></button> &nbsp; "+
                        "<button class='btn btn-danger' data-placement='bottom' data-html='true' title='Eliminar' onclick='eliminar()' type='button'>"+
                        "<i class='fas fa-trash'></i></button>"}
                ],
                "order": [[1, 'asc']]          
            });

            $('#tablaEtnia tbody').on( 'click', 'tr', function () {
                if ( $(this).hasClass('selected') ) {
                    $(this).removeClass('selected');
                }
                else {
                    table.$('tr.selected').removeClass('selected');
                    $(this).addClass('selected');
                }
            });
        });

        function nuevo(){
            limpiarCampos();
            $("#pnlEtnia").fadeIn(900);
            $("#accion").val('1');
            $("#nombre").focus();        
        };

        function cancelar(){
            limpiarCampos();
            $("#pnlEtnia").fadeOut(300);
        };

        function limpiarCampos(){
            $("#nombre").val('');
            $("#selEstado").val('1');
        };

        function guardar(){
            var nombre = document.getElementById("nombre").value;
            var estado = document.getElementById("selEstado").value;
            var idEtni = document.getElementById("idEtni").value;
            var tipoAcc = document.getElementById("accion").value;        
            var msg = '';          

            if(nombre == ''){
                $('#nombre').addClass("is-invalid");
                msg += '<em>El campo nombre debe estar lleno</em><br>';
            }else{
                $('#nombre').removeClass("is-invalid");
            }

            if(msg == ''){
                if(tipoAcc == '1'){ // 1 - significa que esta insertando
                    $.ajax({
                        url: "/etnia",
                        type: 'POST',
                        data: {'nombre':nombre,'estado':estado},
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        error: function(err) {
                            alertasCustom(4,'¡Error!',err.statusText+" : "+err.responseJSON['message']); // 1: success, 2:info, 3:warning, 4:error
                        },
                        success: function(res) {
                            alertasCustom(1,'¡Exito!',res); // 1: success, 2:info, 3:warning, 4:error
                            $("#pnlEtnia").fadeOut(300);
                            $('#tablaEtnia').DataTable().ajax.reload();
                            limpiarCampos();
                            return false;
                        }
                    });
                }

                if(tipoAcc == '2'){ // 2 significa que esta actualizando
                    $.ajax({
                        url: "/etnia/"+idEtni,
                        type: 'PUT',
                        data: {'nombre':nombre,'estado':estado},
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        error: function(err) {
                            alertasCustom(4,'¡Error!',err.statusText+" : "+err.responseJSON['message']); // 1: success, 2:info, 3:warning, 4:error
                        },
                        success: function(res) {
                            alertasCustom(1,'¡Exito!',res); // 1: success, 2:info, 3:warning, 4:error
                            $("#pnlEtnia").fadeOut(300);
                            $('#tablaEtnia').DataTable().ajax.reload();
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
            var table = $('#tablaEtnia').DataTable();
            $('#tablaEtnia tbody').on( 'click', 'tr', function () {
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
                            url: "/etnia/"+arrData['id_etnia'],
                            type: 'DELETE',
                            data: {},
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},                  
                            error: function(err) {
                                mensajes('Error',err.statusText+" : "+err.responseJSON['message'],'error');
                            },
                            success: function(res) {
                                mensajes('Exito!',res,'success');
                                $('#tablaEtnia').DataTable().ajax.reload();
                                return false;
                            }
                        });
                    }
                });
            });
        }; 

        function editar(){
            var table = $('#tablaEtnia').DataTable();
            $('#tablaEtnia tbody').on( 'click', 'tr', function () {
                var idx = table.row(this).index();
                var arrData = table.row(idx).data();

                $("#nombre").val(arrData['etnia_nombre']);
                $("#selEstado").val(arrData['estado']);
                $("#idEtni").val(arrData['id_etnia']);
                $("#accion").val('2');
            });

            $("#pnlEtnia").fadeIn(900);
            $("#nombre").focus();
        };        
    </script>  
@endsection