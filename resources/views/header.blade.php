
<!DOCTYPE html>
 <html class="no-js"> 
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Magazine</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">


	<!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
	<link rel="shortcut icon" href="favicon.ico">
	<!-- Google Fonts -->
	<link href='http://fonts.googleapis.com/css?family=Playfair+Display:400,700,400italic|Roboto:400,300,700' rel='stylesheet' type='text/css'>
	<!-- Animate -->
	<link rel="stylesheet" href="{{url('assets/css/animate.css')}}">
	<!-- Icomoon -->
	<link rel="stylesheet" href="{{url('assets/css/icomoon.css')}}">
	<!-- Bootstrap  -->
	<link rel="stylesheet" href="{{url('assets/css/bootstrap.css')}}">

	<link rel="stylesheet" href="{{url('assets/css/style.css')}}">


	<!-- Modernizr JS -->
	<script src="{{url('assets/js/modernizr-2.6.2.min.js')}}"></script>
	

	</head>
	<body>
	<div id="fh5co-offcanvas">
		<a href="#" class="fh5co-close-offcanvas js-fh5co-close-offcanvas"><span><i class="icon-cross3"></i> <span>Close</span></span></a>
		<div class="fh5co-bio">
			<figure>
				<img src="{{url('assets/images/person1.jpg')}}" alt="Free HTML5 Bootstrap Template" class="img-responsive">
			</figure>
			<h3 class="heading">About Me</h3>
			<h2>Some Blogger</h2>
			<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. </p>
			
		</div>

		<div class="fh5co-menu">
			<div class="fh5co-box">
				<h3 class="heading">Categories</h3>
				<ul>
					@foreach ($categories as $category)
							<li><a href="{{url('/?cat='.$category->id)}}">{{$category->category}}</a></li>
					@endforeach
				</ul>
			</div>
			<div class="fh5co-box">
				<h3 class="heading">Search</h3>
				<form action="{{url('/')}}">
					<div class="form-group">
						<input type="text" name="find" class="form-control" placeholder="Type a keyword">
					</div>
				</form>
			</div>
		</div>
	</div>

	<header id="fh5co-header">
		
		<div class="container-fluid">

			<div class="row">
				<a href="#" class="js-fh5co-nav-toggle fh5co-nav-toggle"><i></i></a>
				@auth
				<ul class="fh5co-social">
					<li><span style="color: rgb(5, 0, 0);">Hi, {{Auth::user()->name;}}</span></li>
					<li><span class="logout-spn" style="font-size: 20px;"><a href="{{url('logout')}}" style="color:#0e0000;">LOGOUT</a></span></li>
			
				</ul>
				@endauth
				<div class="col-lg-12 col-md-12 text-center">
					<h1 id="fh5co-logo"><a href="{{url('/')}}">{{str_replace("_"," ",config('app.name'))}} <sup>TM</sup></a></h1>
				</div>

			</div>
		
		</div>

	</header>
	