<!DOCTYPE html>
<html>
	<head>
		<!-- Basic Page Info -->
		<meta charset="utf-8" />
		<title>
			UJIAN SMK
    </title>
    <style>
      th td {
        padding: 5px 5px !important;
        margin: 0px !important;
      }
    </style>
		<!-- Site favicon -->

<link
    rel="icon"
    type="image/png"
    sizes="32x32"
    href="{{ url('gambar', ['logo.png']) }}"/>
<link
    rel="icon"
    type="image/png"
    sizes="16x16"
    href="{{ url('gambar', ['logo.png']) }}"/>

<!-- Mobile Specific Metas -->
<meta
    name="viewport"
    content="width=device-width, initial-scale=1, maximum-scale=1"/>

@include('layouts.header')
@yield('head')

	</head>
	<body class="bg-sm body-sm">
		<a href="{{ url('/', []) }}" class="btn btn-secondary" style="position: fixed; bottom: 20px; right: 20px;">
			<i class="fa fa-refresh"></i> Refresh Halaman
		</a>

		<nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
			<a class="navbar-brand" href="#">
			<img
				src="{{ url('gambar', ['logo.png']) }}"
				width="30"
				height="30"
				class="d-inline-block align-top"
				alt="">
				<h3 class="d-inline-block mt-1">
					UJIAN SMK
				</h3>
			</a>

			<button
				class="navbar-toggler"
				type="button"
				data-toggle="collapse"
				data-target="#navbarNav"
				aria-controls="navbarNav"
				aria-expanded="false"
				aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarNav">
				<ul class="navbar-nav ml-auto">
					<li class="nav-item active">
						<a
							class="nav-link btn btn-sm text-bold text-success btn-outline-success my-2 my-sm-0"
							href="{{ url('login', []) }}">
							<i class="fa fa-sign-in"></i>
							LOGIN
						</a>
					</li>

				</ul>
			</div>

    	</nav>


		<div class="container">
			
			@yield('content')
		</div>
		
		@include('layouts.footer')
    @include('sweetalert::alert')
	@yield('foot')
	</body>
</html>
