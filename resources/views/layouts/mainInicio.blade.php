<!DOCTYPE HTML>
<html>
	<head>
		<title>Pruebas Andina</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />

		<link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}" />
		<link rel="stylesheet" href="{{ asset('css/main.css') }}" />
		<link rel="stylesheet" href="{{ asset('css/style.css') }}" />

		<meta name="csrf-token" content="{{ csrf_token() }}">
	</head>
	<body class="is-preload">

		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Main -->
					<div id="main">
						<div class="inner">

							<!-- Header -->
							<header id="header">
								<a href="/inicio" class="logo"><strong>Andina</strong></a>
							</header>
							<div class="content">
								<header>
									<h3>RESOLUCION DE PROBLEMAS DE ALGORITMIA BASICOS</h3>
								</header>
							</div>			
							<br>				
							<div class="content">
								@yield('contentInicio')
							</div>
						</div>
					</div>

				<!-- Sidebar -->
					<div id="sidebar">
						<div class="inner">

							<!-- Menu -->
							<nav id="menu">
								<header class="major">
									<h2>Menu</h2>
								</header>
								<ul>
									<li><a href="/inicio">Inicio</a></li>
									<li><a href="/vectores">Ordenamiento Vectores</a></li>
									<li><a href="/potencia">Potenciación</a></li>
									<li><a href="/carrito">Carrito de Compras</a></li>
								</ul>
							</nav>
						</div>
					</div>

			</div>

		<!-- Scripts -->
            <script src="{{ asset('js/jquery.min.js') }}"></script>
            <script src="{{ asset('js/browser.min.js') }}"></script>
            <script src="{{ asset('js/breakpoints.min.js') }}"></script>
            <script src="{{ asset('js/util.js') }}"></script>
			<script src="{{ asset('js/main.js') }}"></script>
			<script src="{{ asset('js/sweetAlert.js') }}"></script>

		<script>
			function alertasCustom($tipo,$titulo,$texto){
				swal({
					title: $titulo,
					text: $texto,
					icon: $tipo,
					buttons: false,
					timer: 3000,
				});
			};			
		</script>
	</body>
</html>