<!DOCTYPE html>
<html lang="en">

<head>
    <title>Halaman Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="{{ asset('landingpage/Halamanlogin/images/icons/favicon.ico') }}" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('landingpage/Halamanlogin/vendor/bootstrap/css/bootstrap.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('landingpage/Halamanlogin/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('landingpage/Halamanlogin/fonts/Linearicons-Free-v1.0.0/icon-font.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('landingpage/Halamanlogin/vendor/animate/animate.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('landingpage/Halamanlogin/vendor/css-hamburgers/hamburgers.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('landingpage/Halamanlogin/vendor/animsition/css/animsition.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('landingpage/Halamanlogin/vendor/select2/select2.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('landingpage/Halamanlogin/vendor/daterangepicker/daterangepicker.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('landingpage/Halamanlogin/css/util.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('landingpage/Halamanlogin/css/main.css') }}">
    <!--===============================================================================================-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

</head>

<body style="background-color: #666666;">

    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <form action="{{route('auth') }}" class="login100-form validate-form" method="POST">
                    @csrf
                    <a href="/" class="btn btn-sm btn-primary">Kembali</a>
                    <span class="login100-form-title p-b-43">
                        Login
                    </span>
                    <!-- jika gagal -->
                    @if ($errors->any())
                    <div id="error-alert"
                        class="alert alert-danger"
                        data-clear-url="{{ route('clear.errors') }}"
                        data-token="{{ csrf_token() }}"
                        style="position: relative;">

                        <button type="button" id="close-alert" style="
							position: absolute;
							top: 5px;
							right: 15px;
							background: transparent;
							border: none;
							font-size: 30px;
							color: black;
							cursor: pointer;
						">&times;</button>

                        <strong>Kesalahan Terjadi:</strong>
						<ul style="list-style-type: disc; padding-left: 20px;">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    @if (Session::has('success'))
                    <div id="success-alert"
                        class="alert alert-success"
                        data-clear-url="{{ route('clear.success') }}"
                        data-token="{{ csrf_token() }}"
                        style="position: relative;">

                        <button type="button" id="close-success" style="
							position: absolute;
							top: 5px;
							right: 15px;
							background: transparent;
							border: none;
							font-size: 20px;
							color: #155724; /* warna hijau pesan success */
							cursor: pointer;">&times;
                        </button>

                        {{ Session::get('success') }}
                    </div>
                    @endif

                    <div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
                        <input class="input100" type="text" name="email" value="{{old('email')}}">
                        <span class="focus-input100"></span>
                        <span class="label-input100">Email</span>
                    </div>


                    <div class="wrap-input100 validate-input" data-validate="Password is required" style="position: relative;">
                        <input class="input100" type="password" name="password" id="login-password">
                        <span class="focus-input100"></span>
                        <span class="label-input100">Password</span>
                        <i class="bi bi-eye-slash toggle-password" data-target="login-password" style="position:absolute; right:15px; top:50%; transform:translateY(-50%); cursor:pointer;"></i>
                    </div>


                    <div class="flex-sb-m w-full p-t-3 p-b-32">
                        <div class="contact100-form-checkbox">
                            <input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
                            <label class="label-checkbox100" for="ckb1">
                                Remember me
                            </label>
                        </div>

                        <div>
                            <a href="{{ route('reset_halaman1') }}" class="txt1">
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
                            <a href="{{ route('registrasi') }}">Belum punya akun? Buat Akun</a>
                        </span>
                    </div>

                    {{-- <div class="text-center p-t-46 p-b-20">
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
					</div> --}}
                </form>

                <div class="login100-more"
                    style="background-image: url('{{asset("landingpage/Halamanlogin/images/bg-01.jpg")}}');"></div>
            </div>
        </div>
    </div>





    <!--===============================================================================================-->
    <script src="{{ asset('landingpage/Halamanlogin/vendor/jquery/jquery-3.2.1.min.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('landingpage/Halamanlogin/vendor/animsition/js/animsition.min.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('landingpage/Halamanlogin/vendor/bootstrap/js/popper.js') }}"></script>
    <script src="{{ asset('landingpage/Halamanlogin/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('landingpage/Halamanlogin/vendor/select2/select2.min.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('landingpage/Halamanlogin/vendor/daterangepicker/moment.min.js') }}"></script>
    <script src="{{ asset('landingpage/Halamanlogin/vendor/daterangepicker/daterangepicker.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('landingpage/Halamanlogin/vendor/countdowntime/countdowntime.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('landingpage/Halamanlogin/js/main.js') }}"></script>

    <!-- myjs -->
    <script src="{{ asset('landingpage/Halamanlogin/js/myjs/registrasi.js') }}"></script>

    <!-- icon mata -->
    <script>
        document.querySelectorAll('.toggle-password').forEach(icon => {
            icon.addEventListener('click', function() {
                const input = document.getElementById(this.dataset.target);
                const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
                input.setAttribute('type', type);

                this.classList.toggle('bi-eye');
                this.classList.toggle('bi-eye-slash');
            });
        });
    </script>
</body>

</html>