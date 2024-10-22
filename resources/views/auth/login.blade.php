<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Pengguna</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">
    <style>
        /* Gaya untuk background dan layout */
        body {
            display: flex; /* Menggunakan flexbox untuk layout */
            height: 100vh; /* Membuat tinggi penuh */
            font-family: 'Source Sans Pro', sans-serif; /* Mengatur font */
            margin: 0; /* Menghilangkan margin default */
        }

        .image-container {
            flex: 1; /* Mengisi sisa ruang untuk gambar */
            background: url('ilustrasi1.jpg') no-repeat center center; /* Ganti dengan URL gambar background Anda */
            background-size: 600px; /* Memastikan gambar menutupi seluruh area */
        }

        .login-container {
            flex: 1; /* Mengisi sisa ruang untuk form */
            display: flex;
            align-items: center; /* Center vertical */
            justify-content: center; /* Center horizontal */
            background-color: rgba(255, 255, 255, 0.9); /* Warna latar belakang putih dengan sedikit transparansi */
           /* Menambahkan padding */
        }

        .login-box {
            width: 100%; /* Memastikan lebar penuh */
            max-width: 400px; /* Mengatur lebar maksimum */
            border-radius: 15px; /* Sudut membulat pada card */
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.5); /* Bayangan untuk efek kedalaman */
            padding: 20px; /* Menambahkan padding */
            transition: transform 0.3s ease; /* Transisi halus untuk hover */
        }

        .login-box:hover {
            transform: translateY(-5px); /* Efek angkat pada hover */
        }

        .input-group {
            margin-bottom: 15px; /* Menambahkan jarak antar input */
        }

        .input-group input {
            border-radius: 10px; /* Sudut membulat pada input */
            transition: border-color 0.3s; /* Transisi halus untuk border */
        }

        .input-group input:focus {
            border-color: #007bff; /* Ubah warna border saat fokus */
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5); /* Efek glow saat fokus */
        }

        .btn-primary {
            border-radius: 10px; /* Sudut membulat pada tombol */
            transition: background-color 0.3s, transform 0.3s; /* Transisi halus untuk background */
        }

        .btn-primary:hover {
            background-color: #0056b3; /* Warna background saat hover */
            transform: scale(1.05); /* Efek zoom saat hover */
        }

        .error-text {
            font-size: 12px; /* Ukuran font untuk pesan error */
        }

        /* Gaya untuk link register */
        .register-link {
            color: #007bff; /* Warna link */
            transition: color 0.3s; /* Transisi halus untuk warna */
        }

        .register-link:hover {
            color: #0056b3; /* Warna saat hover */
            text-decoration: underline; /* Garis bawah saat hover */
        }
    </style>
</head>

<body>
    <div class="image-container"></div> <!-- Gambar di sebelah kiri -->
    <div class="login-container">
        <div class="login-box">
            <div class="card card-outline card-info">
                <div class="card-header text-center">
                    <a href="{{ url('/') }}" class="h1"><b>Selamat Datang</b></a>
                </div>
                <div class="card-body">
                    <p class="login-box-msg">Masuk untuk memulai sesi Anda</p>
                    <form action="{{ url('login') }}" method="POST" id="form-login">
                        @csrf
                        <div class="input-group mb-3">
                            <input type="text" id="username" name="username" class="form-control"
                                placeholder="Username" required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>
                            <small id="error-username" class="error-text text-danger"></small>
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" id="password" name="password" class="form-control"
                                placeholder="Password" required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                            <small id="error-password" class="error-text text-danger"></small>
                        </div>
                        <div class="row">
                            <div class="col-8">
                                <div class="icheck-info">
                                    <input type="checkbox" id="remember"><label for="remember">Ingat Saya</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <button type="submit" class="btn btn-info btn-block">Masuk</button>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-12 text-center">
                                <span>Tidak memiliki akun? <a href="{{ url('register') }}" class="register-link">Daftar</a></span>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- jquery-validation -->
    <script src="{{ asset('adminlte/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/jquery-validation/additional-methods.min.js') }}"></script>
    <!-- SweetAlert2 -->
    <script src="{{ asset('adminlte/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('adminlte/dist/js/adminlte.min.js') }}"></script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function() {
            $("#form-login").validate({
                rules: {
                    username: {
                        required: true,
                        minlength: 4,
                        maxlength: 20
                    },
                    password: {
                        required: true,
                        minlength: 5,
                        maxlength: 20
                    }
                },
                submitHandler: function(form) {
                    $.ajax({
                        url: form.action,
                        type: form.method,
                        data: $(form).serialize(),
                        success: function(response) {
                            if (response.status) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil',
                                    text: response.message,
                                }).then(function() {
                                    window.location = response.redirect;
                                });
                            } else {
                                $('.error-text').text('');
                                $.each(response.msgField, function(prefix, val) {
                                    $('#error-' + prefix).text(val[0]);
                                });
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Terjadi Kesalahan',
                                    text: response.message
                                });
                            }
                        }
                    });
                    return false;
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.input-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        });
    </script>
</body>

</html>
