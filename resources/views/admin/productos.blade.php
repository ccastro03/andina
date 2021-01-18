@extends('layouts.mainAdmin')

@section('contentAdmin')
    <div id="pnlProd" class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h5 class="card-title"><span id="titPnl"></span> Producto</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-3 form-group">
                            <label for="referencia" class="">Referencia</label>
                            <input name="referencia" id="referencia" type="text" class="form-control">
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <label for="descripcion">Descripción</label>
                            <textarea class="form-control" id="descripcion" rows="3"></textarea>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <label for="vlrUni">Valor Unitario</label>
                            <input name="vlrUni" id="vlrUni" type="text" class="form-control">
                        </div>                        

                        <input name="idProd" id="idProd" type="text" class="form-control" hidden>
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
                    <h3 class="card-title">Listado de Productos</h3>

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
                        <table class="table display table-striped table-bordered" style="width: 100% !important;" id="tablaProducto">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Referencia</th>
                                    <th>Descripción</th>
                                    <th>Valor Unitario</th>
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
            $("#pnlProd").hide();

            let table = $('#tablaProducto').DataTable({
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
                ajax: "{{ url('/productos/show') }}",
                columns: [
                    { data: 'id', visible:false },
                    { data: 'referencia' },                    
                    { data: 'descripcion' },
                    { data: 'valor_unitario' },
                    { defaultContent: "<button class='btn btn-secondary' id='btnedit' data-placement='bottom' data-html='true' title='Modificar' onclick='editar()' type='button'>"+
                        "<i class='fas fa-pencil-alt'></i></button> &nbsp; "+
                        "<button class='btn btn-danger' data-placement='bottom' data-html='true' title='Eliminar' onclick='eliminar()' type='button'>"+
                        "<i class='fas fa-trash'></i></button>"}
                ],
                "order": [[1, 'asc']]          
            });

            $('#tablaProducto tbody').on( 'click', 'tr', function () {
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
            $("#pnlProd").fadeIn(900);
            $("#accion").val('1');
            $("#referencia").focus();
        };

        function cancelar(){
            limpiarCampos();
            $("#pnlProd").fadeOut(300);
        };

        function limpiarCampos(){
            $("#referencia").val('');
            $("#descripcion").val('');
            $("#vlrUni").val('');
        };

        function guardar(){
            var referencia = document.getElementById("referencia").value;
            var descripcion = document.getElementById("descripcion").value;
            var vlrUni = document.getElementById("vlrUni").value;
            

            var idProd = document.getElementById("idProd").value;
            var tipoAcc = document.getElementById("accion").value;        
            var msg = '';          

            if(referencia == ''){
                $('#referencia').addClass("is-invalid");
                msg += '<em>El campo referencia debe estar lleno</em><br>';
            }else{
                $('#referencia').removeClass("is-invalid");
            }

            if(descripcion == ''){
                $('#descripcion').addClass("is-invalid");
                msg += '<em>El campo descripcion debe estar lleno</em><br>';
            }else{
                $('#descripcion').removeClass("is-invalid");
            }

            if(vlrUni == ''){
                $('#vlrUni').addClass("is-invalid");
                msg += '<em>El campo valor unitatio debe estar lleno</em><br>';
            }else{
                $('#vlrUni').removeClass("is-invalid");
            }                        

            if(msg == ''){
                if(tipoAcc == '1'){ // 1 - significa que esta insertando
                    $.ajax({
                        url: "/productos",
                        type: 'POST',
                        data: {'referencia':referencia,'descripcion':descripcion,'vlruni':vlrUni},
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        error: function(err) {
                            alertasCustom(4,'¡Error!',err.statusText+" : "+err.responseJSON['message']); // 1: success, 2:info, 3:warning, 4:error
                        },
                        success: function(res) {
                            alertasCustom(1,'¡Exito!',res); // 1: success, 2:info, 3:warning, 4:error
                            $("#pnlProd").fadeOut(300);
                            $('#tablaProducto').DataTable().ajax.reload();
                            limpiarCampos();
                            return false;
                        }
                    });
                }

                if(tipoAcc == '2'){ // 2 significa que esta actualizando
                    $.ajax({
                        url: "/productos/"+idProd,
                        type: 'PUT',
                        data: {'referencia':referencia,'descripcion':descripcion,'vlruni':vlrUni},
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        error: function(err) {
                            alertasCustom(4,'¡Error!',err.statusText+" : "+err.responseJSON['message']); // 1: success, 2:info, 3:warning, 4:error
                        },
                        success: function(res) {
                            alertasCustom(1,'¡Exito!',res); // 1: success, 2:info, 3:warning, 4:error
                            $("#pnlProd").fadeOut(300);
                            $('#tablaProducto').DataTable().ajax.reload();
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
            var table = $('#tablaProducto').DataTable();
            $('#tablaProducto tbody').on( 'click', 'tr', function () {
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
                            url: "/productos/"+arrData['id'],
                            type: 'DELETE',
                            data: {},
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},                  
                            error: function(err) {
                                mensajes('Error',err.statusText+" : "+err.responseJSON['message'],'error');
                            },
                            success: function(res) {
                                mensajes('Exito!',res,'success');
                                $('#tablaProducto').DataTable().ajax.reload();
                                return false;
                            }
                        });
                    }
                });
            });
        }; 

        function editar(){
            var table = $('#tablaProducto').DataTable();
            $('#tablaProducto tbody').on( 'click', 'tr', function () {
                var idx = table.row(this).index();
                var arrData = table.row(idx).data();

                $("#referencia").val(arrData['referencia']);
                $("#descripcion").val(arrData['descripcion']);
                $("#vlrUni").val(arrData['valor_unitario']);
                $("#idProd").val(arrData['id']);
                $("#accion").val('2');
            });

            $("#pnlProd").fadeIn(900);
            $("#referencia").focus();
        };        
    </script>  
@endsection