<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/login.js') }}" defer></script>

    <!-- Fonts -->
    {{--
    <link rel="dns-prefetch" href="//fonts.gstatic.com"> --}}
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    {{--
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css"> --}}

    <!-- Styles -->
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
<!--===============================================================================================-->
</head>
<body>

	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="{!!url('/img/logo_eba.png')!!}" alt="IMG">
				</div>
                @yield('content')
				{{-- <form class="login100-form validate-form">
					<span class="login100-form-title">
						Iniciar Session
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
						<input class="input100" type="text" name="email" placeholder="Usuario">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-user" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input class="input100" type="password" name="pass" placeholder="Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Login
						</button>
					</div> --}}

					<!-- <div class="text-center p-t-12">
						<span class="txt1">
							Forgot
						</span>
						<a class="txt2" href="#">
							Username / Password?
						</a>
					</div> -->

					<!-- <div class="text-center p-t-136">
						<a class="txt2" href="#">
							Create your Account
							<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
						</a>
					</div> -->
				{{-- </form> --}}
			</div>
		</div>
	</div>




<!--===============================================================================================-->

	<script >
         window.onload = function () {
            // $('.js-tilt').tilt({
            //     scale: 1.1
            // })
            var user_error =@json($errors->has('username'));
            var pass_error =@json($errors->has('password'));
            console.log(user_error);
            if(user_error){
                toastr.error('Error Usuario Incorrecto','Error');
            }
            if(pass_error){
                toastr.error('Error Password Incorrecto','Error');
            }
            // var usermessage = @json($errors->first());
            // console.log(user);
        };


	</script>


</body>
</html>
