<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>{{ config('app.name', 'tollan-ya') }} | Log in  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/adminlte.min.css') }}">
  
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <b>{{ env('APP_NAME') }}</b>
    </div>
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">Inicia sesión para comenzar</p>

        <form method="POST" action="{{ route('login') }}">
          @csrf
          <div class="row form-group">
            <div class="input-group mb-3" style="margin-bottom: 0px !important;">
              <input class="form-control {{ $errors->has('usuario_id') ? ' is-danger' : '' }}" type="text" name="usuario_id" placeholder="Usuario" autofocus="">
              <div class="input-group-append">
                <div class="input-group-text"><span class="fas fa-user"></span></div>
              </div>              
            </div>
            @if ($errors->has('usuario_id'))
              <p class="text-danger" style="margin-bottom: 0px !important;"><em>{{ $errors->first('usuario_id') }}</em></p>
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
            <div class="col-4 mx-auto">
              <button class="btn btn-primary btn-block">Ingresar</button>
            </div>
          </div
          >
        </form>
      </div>
    </div>
  </div>

	<script src="{{ asset('js/jquery.js') }}"></script>
	<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('js/adminlte.js') }}"></script>	
</body>
</html>

