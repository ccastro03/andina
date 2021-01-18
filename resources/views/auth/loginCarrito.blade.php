@extends('layouts.mainInicio')

@section('contentInicio')

<div class="row">
  <div class="col-lg-12 col-md-12 col-sm-12 d-flex text-center">
    <div class="card mx-auto w-50">
      <div class="card-body">
        <h4>Iniciar Sesión</h4>

        <form method="POST" action="{{ url('/cliente/login') }}" class="my-0">
          @csrf
          <div class="row form-group">
            <div class="input-group mb-3" style="margin-bottom: 0px !important;">
              <input class="form-control {{ $errors->has('codigo') ? ' is-danger' : '' }}" type="text" name="codigo" placeholder="Usuario" autofocus="">
              <div class="input-group-append">
                <div class="input-group-text"><span class="fas fa-user"></span></div>
              </div>              
            </div>
            @if ($errors->has('codigo'))
              <p class="text-danger" style="margin-bottom: 0px !important;"><em>{{ $errors->first('codigo') }}</em></p>
            @endif                    
          </div>

          <div class="row form-group">
            <div class="input-group mb-3" style="margin-bottom: 0px !important;">
              <input class="form-control {{ $errors->has('password') ? ' is-danger' : '' }}" type="password" name="password" placeholder="Contraseña">
              <div class="input-group-append">
                <div class="input-group-text"><span class="fas fa-lock"></span></div>
              </div>            
            </div>
            @if ($errors->has('password'))
              <p class="text-danger" style="margin-bottom: 0px !important;"><em>{{ $errors->first('password') }}</em></p>
            @endif            
          </div>

          <div class="row">
            <div class="col-8 mx-auto">
              <button class="button primary ml-auto btn-block">Ingresar</button>
            </div>
          </div
          >
        </form>
      </div>
    </div>
  </div>
</div>

@endsection