<!DOCTYPE html>
<html lang="en">
<head>
	<title>Halaman Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="{{asset ('landingpage/Halamanlogin/images/icons/favicon.ico') }}"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset ('landingpage/Halamanlogin/vendor/bootstrap/css/bootstrap.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset ('landingpage/Halamanlogin/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset ('landingpage/Halamanlogin/fonts/Linearicons-Free-v1.0.0/icon-font.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset ('landingpage/Halamanlogin/vendor/animate/animate.css') }}">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="{{asset ('landingpage/Halamanlogin/vendor/css-hamburgers/hamburgers.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset ('landingpage/Halamanlogin/vendor/animsition/css/animsition.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset ('landingpage/Halamanlogin/vendor/select2/select2.min.css') }}">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="{{asset ('landingpage/Halamanlogin/vendor/daterangepicker/daterangepicker.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset ('landingpage/Halamanlogin/css/util.css') }}">
	<link rel="stylesheet" type="text/css" href="{{asset ('landingpage/Halamanlogin/css/main.css') }}">
<!--===============================================================================================-->
</head>
<body style="background-color: #666666;">
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form action="{{ route('registrasi.post') }}" class="login100-form validate-form" method="POST">
                    @csrf
					<span class="login100-form-title p-b-43">
						Login
					</span>
					
					@if ($errors->any())
						<div class="alert alert-danger">
							<strong>Kesalahan Terjadi:</strong>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif

					@if (Session::has('success'))
						<div class="alert alert-success">
							{{ Session::get('success') }}
						</div>
					@endif

                    
                    <!-- inputan -->
					<div class="wrap-input100 validate-input" data-validate = "Nama Lengkap Wajib diisi">
						<input class="input100" type="text" name="namalengkap" id="namalengkap">
						<span class="focus-input100"></span>
						<span class="label-input100">Nama Lengkap</span>
					</div>
					
					
					<div class="wrap-input100 validate-input" data-validate="Kelas Wajib diisi">
						<input class="input100" type="text" name="kelas" id="kelas">
						<span class="focus-input100"></span>
						<span class="label-input100">Kelas & Jurusan</span>
					</div>
					<div class="wrap-input100 validate-input" data-validate="Username wajib diisi">
						<input class="input100" type="text" name="username" id="username">
						<span class="focus-input100"></span>
						<span class="label-input100">Username</span>
					</div>
					<div class="wrap-input100 validate-input" data-validate="Email wajib diisi">
						<input class="input100" type="email" name="email" id="email">
						<span class="focus-input100"></span>
						<span class="label-input100">Email</span>
					</div>
					<div class="wrap-input100 validate-input" data-validate="Password is required">
						<input class="input100" type="password" name="password" id="password">
						<span class="focus-input100"></span>
						<span class="label-input100">Password</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Password is required">
						<input class="input100" type="password" name="re_password" id="re_password">
						<span class="focus-input100"></span>
						<span class="label-input100">Konfirmasi Password</span>
					</div>
                    

                     <!-- gambar -->
                    <div style="margin : 20px 20px 40px 20px">
                        <label for="gambar" style="margin-bottom: 10px; font-size: 13pt; color: #666666; ">Gambar</label>
                        <input type="file" class="form-input" name="gambar" id="gambar" style="margin-left: -20px;"/>
                    </div>
                    
					<div class="flex-sb-m w-full p-t-3 p-b-32">
						<div class="contact100-form-checkbox">
							<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
							<label class="label-checkbox100" for="ckb1">
								Remember me
							</label>
						</div>

						<div>
							<a href="#" class="txt1">
								Forgot Password?
							</a>
						</div>
					</div>
			

					<div class="container-login100-form-btn">
						<button class="login100-form-btn" type="submit">
							Login
						</button>
					</div>
					
					<div class="text-center p-t-khusus p-b-20">
						<span class="txt2">
							<a href="{{route('auth') }}">Sudah punya akun? Login disini</a>
						</span>
					</div>

					<div class="text-center p-t-46 p-b-20">
						<span class="txt2">
							or sign up using
						</span>
					</div>

					<div class="login100-form-social flex-c-m">
						<a href="#" class="login100-form-social-item flex-c-m bg1 m-r-5">
							<i class="fa fa-facebook-f" aria-hidden="true"></i>
						</a>

						<a href="#" class="login100-form-social-item flex-c-m bg2 m-r-5">
							<i class="fa fa-twitter" aria-hidden="true"></i>
						</a>
					</div>
				</form>

				<div class="login100-more" style="background-image: url('{{asset("landingpage/Halamanlogin/images/bg-01.jpg")}}');">
				</div>
			</div>
		</div>
	</div>
	
	

	
	
<!--===============================================================================================-->
	<script src="{{asset ('landingpage/Halamanlogin/vendor/jquery/jquery-3.2.1.min.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{asset ('landingpage/Halamanlogin/vendor/animsition/js/animsition.min.js') }}"></script>
<!--===============================================================================================-->
	<script a="{{asset ('landingpage/Halamanlogin/vendor/bootstrap/js/popper.js') }}"></script>
	<script src="{{asset ('landingpage/Halamanlogin/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{asset ('landingpage/Halamanlogin/vendor/select2/select2.min.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{asset ('landingpage/Halamanlogin/vendor/daterangepicker/moment.min.js') }}"></script>
	<script src="{{asset ('landingpage/Halamanlogin/vendor/daterangepicker/daterangepicker.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{asset ('landingpage/Halamanlogin/vendor/countdowntime/countdowntime.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{asset ('landingpage/Halamanlogin/js/main.js') }}"></script>

</body>
</html>


