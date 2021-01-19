@extends('layouts.mainInicio')

@section('contentInicio')
    <div class="row pb-3">
        <div class="col-lg-12 col-md-12 col-sm-12">

            @if(Auth::guard('cliente')->check())
                <form id="logout-form" action="{{ url('cliente/logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>            

                <span>Cliente: <strong>{{ Auth::guard('cliente')->User()->nombre }}</strong></span>
                <a href="/detalleCarrito" class="button secondary mx-auto">Carrito</a>
                <a class="button primary mx-auto" onclick="event.preventDefault(); 
                document.getElementById('logout-form').submit();" id="logout"> Salir </a>
            @else
                <a href="/registrar" class="button secondary mx-auto ml-2">Registrarse</a>
                <a href="/ingresar" class="button primary mx-auto">Iniciar Sesión</a>            
            @endif
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 d-flex text-center">
            <div class="card mx-auto w-90">
            <div class="card-body">
                <h4>Registro</h4>

                    @csrf
                    <div class="row form-group">
                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <input type="text" class="form-control" name="usuario" id="usuario" placeholder="Usuario">
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <input type="password" class="form-control" name="password" id="password" placeholder="Contraseña">
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre">
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <input type="text" class="form-control" name="mail" id="mail" placeholder="Email">  
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <input type="text" class="form-control" name="tele" id="tele" placeholder="Teléfono">  
                        </div>    
                    </div>                                                    

                    <div class="row form-group">
                        <div class="col-8 mx-auto">
                        <button class="button primary ml-auto" onclick="registroCliente()">Registrar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function registroCliente(){
            var usuario = document.getElementById("usuario").value;
            var password = document.getElementById("password").value;
            var nombre = document.getElementById("nombre").value;
            var mail = document.getElementById("mail").value;
            var tele = document.getElementById("tele").value;
            var cantErr = 0;

            if(usuario == ''){
                $('#usuario').addClass("is-invalid");
                cantErr ++ ;
            }else{
                $('#usuario').removeClass("is-invalid");
            }
            if(password == ''){
                $('#password').addClass("is-invalid");
                cantErr ++ ;
            }else{
                $('#password').removeClass("is-invalid");
            }
            if(nombre == ''){
                $('#nombre').addClass("is-invalid");
                cantErr ++ ;
            }else{
                $('#nombre').removeClass("is-invalid");
            }
            if(mail == ''){
                $('#mail').addClass("is-invalid");
                cantErr ++ ;
            }else{
                $('#mail').removeClass("is-invalid");
            }
            if(tele == ''){
                $('#tele').addClass("is-invalid");
                cantErr ++ ;
            }else{
                $('#tele').removeClass("is-invalid");
            }

            if(cantErr == 0){
                $.ajax({
                    url: "/cliente/registro",
                    type: 'POST',
                    data: {'usuario':usuario,'password':password,'nombre':nombre,'mail':mail,'tele':tele},
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    error: function(err) {
                        alertasCustom('error','Error!',err.statusText+" : "+err.responseJSON['message'],'error'); // 1: success, 2:info, 3:warning, 4:error
                    },
                    success: function(res) {
                        alertasCustom('success','Exito!',res); // 1: success, 2:info, 3:warning, 4:error
                        limpiarCampos();
                        return false;
                    }
                });            
            }

        }

        function limpiarCampos(){
            $("#usuario").val('');
            $("#password").val('');
            $("#nombre").val('');
            $("#mail").val('');
            $("#tele").val('');
        }    
    </script>
@endsection