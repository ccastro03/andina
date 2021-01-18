@extends('layouts.mainInicio')

@section('contentInicio')
    <div class="row float-right">
        <div class="col-lg-12 col-md-12 col-sm-12">

            @if(Auth::guard('cliente')->check())
                <form id="logout-form" action="{{ url('cliente/logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>            

                <span>Usuario: <strong>{{ Auth::guard('cliente')->User()->nombre }}</strong></span>
                <a href="/detalleCarrito" class="button secondary ml-auto">Carrito</a>
                <a class="button primary mx-auto" onclick="event.preventDefault(); 
                document.getElementById('logout-form').submit();" id="logout"> Salir </a>
            @else
                <a href="/registrar" class="button secondary ml-auto">Registrarse</a>
                <a href="/ingresar" class="button primary ml-auto">Iniciar Sesión</a>            
            @endif
        </div>
    </div>

    <script>
    </script>
@endsection