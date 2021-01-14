@extends('layouts.mainAdmin')

@section('contentAdmin')
    <div class="row">
        <div class="col-lg-12 col-sm-12 col-md-12">
            <div class="card card-primary card-outline card-outline-tabs">
                <div class="card-header p-0 border-bottom-0">
                    <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill" href="#custom-tabs-four-home" role="tab" aria-controls="custom-tabs-four-home" aria-selected="true">Datos Identificación</a>
                        </li>
                        <!-- <li class="nav-item">
                            <a class="nav-link" id="custom-tabs-four-profile-tab" data-toggle="pill" href="#custom-tabs-four-profile" role="tab" aria-controls="custom-tabs-four-profile" aria-selected="false">Historia Clínica</a>
                        </li> -->
                        <!-- <li class="nav-item">
                            <a class="nav-link" id="custom-tabs-four-messages-tab" data-toggle="pill" href="#custom-tabs-four-messages" role="tab" aria-controls="custom-tabs-four-messages" aria-selected="false">Historia Deportiva</a>
                        </li> -->
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="custom-tabs-four-tabContent">
                        <div class="tab-pane fade show active" id="custom-tabs-four-home" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">
                            <div class="col-12">                        
                                <div class="row">
                                    <div class="col-lg-3 col-md-3 col-sm-3 form-group">
                                        <label for="nombre1" class="">Primer Nombre</label>
                                        <input name="nombre1" id="nombre1" type="text" class="form-control">
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-3 form-group">
                                        <label for="nombre2" class="">Segundo Nombre</label>
                                        <input name="nombre2" id="nombre2" type="text" class="form-control">
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-3 form-group">
                                        <label for="apellido1" class="">Primer Apellido</label>
                                        <input name="apellido1" id="apellido1" type="text" class="form-control">
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-3 form-group">
                                        <label for="apellido2" class="">Segundo Apellido</label>
                                        <input name="apellido2" id="apellido2" type="text" class="form-control">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-3 col-sm-3 form-group">
                                        <label for="fechaNace" class="">Fecha de Nacimiento</label>
                                        <input name="fechaNace" id="fechaNace" type="date" class="form-control">
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                        <div class="position-relative form-group">
                                            <label for="estrato" class="">Estrato socioeconómico</label>
                                            <select name="estrato" id="estrato" class="form-control">
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-3 form-group">
                                        <label for="id_escolaridad" class="">Escolaridad</label>
                                        <select class="form-control" name="id_escolaridad" id="id_escolaridad" style="width: 100% !important"></select>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-3 form-group">
                                        <label for="id_etnia" class="">Etnia</label>
                                        <select class="form-control" name="id_etnia" id="id_etnia" style="width: 100% !important"></select>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-3 form-group">
                                        <label for="id_etnia" class="">Historia CLinica</label>
                                        <label for="id_etnia" class="">Historia deportiva</label>
                                    </div>                                    
                                </div>
                                
                                <div class="row">
                                </div>
                            </div>
                        </div>
                        <!-- <div class="tab-pane fade" id="custom-tabs-four-profile" role="tabpanel" aria-labelledby="custom-tabs-four-profile-tab">
                            Mauris tincidunt mi at erat gravida, eget tristique urna bibendum. Mauris pharetra purus ut ligula tempor, et vulputate metus facilisis. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Maecenas sollicitudin, nisi a luctus interdum, nisl ligula placerat mi, quis posuere purus ligula eu lectus. Donec nunc tellus, elementum sit amet ultricies at, posuere nec nunc. Nunc euismod pellentesque diam. 
                        </div> -->
                        <!-- <div class="tab-pane fade" id="custom-tabs-four-messages" role="tabpanel" aria-labelledby="custom-tabs-four-messages-tab">
                            Morbi turpis dolor, vulputate vitae felis non, tincidunt congue mauris. Phasellus volutpat augue id mi placerat mollis. Vivamus faucibus eu massa eget condimentum. Fusce nec hendrerit sem, ac tristique nulla. Integer vestibulum orci odio. Cras nec augue ipsum. Suspendisse ut velit condimentum, mattis urna a, malesuada nunc. Curabitur eleifend facilisis velit finibus tristique. Nam vulputate, eros non luctus efficitur, ipsum odio volutpat massa, sit amet sollicitudin est libero sed ipsum. Nulla lacinia, ex vitae gravida fermentum, lectus ipsum gravida arcu, id fermentum metus arcu vel metus. Curabitur eget sem eu risus tincidunt eleifend ac ornare magna. 
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(function() {

            $('#id_escolaridad').select2({
                ajax: {
                    url: 'listEscolaridad',
                    dataType: 'json',
                    data: function (params) {
                        return {
                            busqueda: params.term,
                        };
                    },
                    processResults: function (data) {
                        return {
                            results: data
                        };
                    },
                    cache: true
                },
                placeholder: 'Seleccione ...',
                language: {
                    noResults: function() {
                        return "No hay resultados";        
                    },
                    searching: function() {
                        return "Buscando...";
                    }
                }         
            });

            $('#id_etnia').select2({
                ajax: {
                    url: 'listEtnia',
                    dataType: 'json',
                    data: function (params) {
                        return {
                            busqueda: params.term,
                        };
                    },
                    processResults: function (data) {
                        return {
                            results: data
                        };
                    },
                    cache: true
                },
                placeholder: 'Seleccione ...',
                language: {
                    noResults: function() {
                        return "No hay resultados";        
                    },
                    searching: function() {
                        return "Buscando...";
                    }
                }         
            });            
        });
    </script>
@endsection