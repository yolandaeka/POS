<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TOSERBA AMANAH</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">
    <!-- Custom CSS -->
    <style>
        /* General Styling */
        body {
            font-family: 'Source Sans Pro', sans-serif;
        }

        /* Hero Section */
        #home {
            position: relative;
            background-image: url('store1.jpg');
            /* Ganti dengan path gambar kamu */
            background-size: cover;
            background-position: center;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: white;
            z-index: 1;
        }

        #home::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 139, 0.8);
            /* Overlay hitam dengan opacity 50% */
            z-index: -1;
            /* Taruh overlay di bawah konten */
        }

        #home h1 {
            font-size: 3.5rem;
            font-weight: 700;
        }

        #home p {
            font-size: 1.25rem;
            margin: 20px 0;
        }

        #home .btn {
            padding: 10px 20px;
            font-size: 1.25rem;
            border-radius: 30px;
            transition: background-color 0.3s ease;
        }

        #home .btn:hover {
            background-color: #fff;
            color: #007bff;
        }

        /* Features Section */

        .feature-image {
            width: 100%;
            /* Atur lebar gambar sesuai kolom */
            height: 300px;
            /* Menjaga proporsi gambar */
            max-width: 300px;
            /* Atur lebar maksimum untuk membuat gambar persegi */
            display: block;
            /* Menjaga gambar agar berada di blok */
            margin: 0 auto;
            /* Rata tengah jika diperlukan */
        }

        .feature-box {
            margin-bottom: 20px;
            /* Tambahkan margin bawah untuk jarak antar elemen */
        }

        #about {
            padding: 60px 0;
        }

        #about h2 {
            font-size: 2.5rem;
            margin-bottom: 40px;
            font-weight: bold;
        }

        .feature-box i {
            color: #007bff;
            margin-bottom: 20px;
        }

        /* Product Section */
        #products {
            color: black;
            padding: 60px 0;
        }

        #products h2 {
            font-size: 2.5rem;
            margin-bottom: 40px;
            font-weight: bold;
        }

        #products img {
            max-height: 200px;
            object-fit: cover;
            transition: transform 0.3s ease;
            border-radius: 15px;
        }

        .category-card {
            border: 1px solid #e0e0e0;
            /* Tambahkan border untuk pemisah */
            border-radius: 8px;
            /* Sudut membulat untuk kartu kategori */
            padding: 20px;
            /* Ruang di dalam kartu */
            transition: transform 0.3s;
            /* Efek transisi */
        }

        .category-card:hover {
            transform: scale(1.05);
            /* Efek zoom saat hover */
        }

        .category-card img {
            max-height: 200px;
            /* Atur tinggi maksimum untuk gambar kategori */
            object-fit: cover;
            /* Pastikan gambar terpotong dengan baik */
        }


        #products img:hover {
            transform: scale(1.05);
        }

        /* Footer */
        footer {
            background-color: #007bff;
            color: white;
            padding: 20px 0;
            text-align: center;
        }
    </style>
</head>

<body class="hold-transition sidebar-collapse layout-top-nav">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand-md navbar-light navbar-white" style="position: sticky;
    top: 0;
    z-index: 1000;">
            <div class="container">
                <a href="{{ url('index3.html') }}" class="navbar-brand">
                    <img src="{{ asset('adminlte/dist/img/AdminLTELogo.png') }}" alt="Logo"
                        class="brand-image img-circle elevation-3" style="opacity: .8;">
                    <span class="brand-text font-weight-bold">TOSERBA AMANAH</span>
                </a>

                <button class="navbar-toggler order-1" type="button" data-toggle="collapse"
                    data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse order-3" id="navbarCollapse">
                    <!-- Centered navbar links -->
                    <ul class="navbar-nav mx-auto">
                        <li class="nav-item">
                            <a href="#home" class="nav-link">Home</a>
                        </li>
                        <li class="nav-item">
                            <a href="#about" class="nav-link">About</a>
                        </li>
                        <li class="nav-item">
                            <a href="#products" class="nav-link">Products</a>
                        </li>
                    </ul>

                    <!-- Right navbar links -->
                    <a href="{{ route('login') }}">
                        <button class="btn btn-primary">Login</button>
                    </a>
                </div>
            </div>
        </nav>
        <!-- /.navbar -->

        <!-- Hero Section -->
        <section id="home">
            <div class="container">
                <h1 class="display-4">Selamat Datang di TOSERBA AMANAH</h1>
                <p class="lead">Nikmati pengalaman berbelanja lengkap dan nyaman dengan berbagai pilihan produk
                    kebutuhan Anda, dari bahan pokok hingga elektronik.
                    Kualitas terbaik, harga terjangkau, dan pelayanan ramah menanti Anda</p>
                <a href="#products" class="btn btn-primary">Selengkapnya</a>
            </div>
        </section>

        <!-- Features Section -->
        <section id="about" class="text-center">
            <div class="container">
                <h2>Tentang Kami</h2>
                <div class="row align-items-center">
                    <div class="col-md-4 feature-box text-left">
                        <img src="store2.jpg" alt="Toserba Amanah" class="feature-image">
                    </div>
                    <div class="col-md-8 feature-box text-left">
                        <p>TOSERBA AMANAH adalah pusat perbelanjaan serba ada yang menyediakan beragam kebutuhan
                            sehari-hari dengan kualitas terbaik dan harga terjangkau.
                            Kami menawarkan berbagai produk mulai dari kebutuhan pokok seperti sembako, bahan makanan
                            segar, produk rumah tangga, hingga pakaian, elektronik, dan peralatan rumah tangga.
                            Toserba Amanah menjadi solusi belanja praktis bagi keluarga, menghadirkan kenyamanan
                            berbelanja dengan produk berkualitas dalam satu tempat.</p>
                    </div>
                </div>
            </div>
        </section>


        <!-- Product Section -->
        <section id="products" class="text-center">
            <div class="container">
                <h2>Kategori Produk</h2>
                <div class="row">
                    <div class="col-md-4 mb-4">
                        <div class="category-card">
                            <img src="eletronik.jpg" alt="Elektronik" class="img-fluid rounded mb-3">
                            <h4>Elektronik</h4>
                            <p>Temukan berbagai produk elektronik terkini dengan kualitas terbaik.</p>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="category-card">
                            <img src="clothes.jpg" alt="Pakaian" class="img-fluid rounded mb-3">
                            <h4>Pakaian</h4>
                            <p>Ragam pilihan pakaian untuk semua gaya dan kebutuhan.</p>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="category-card">
                            <img src="rumah.jpg" alt="Peralatan Rumah" class="img-fluid rounded mb-3">
                            <h4>Peralatan Rumah</h4>
                            <p>Peralatan rumah tangga yang memudahkan aktivitas sehari-hari.</p>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="category-card">
                            <img src="makanminum.jpg" alt="Makanan & Minuman" class="img-fluid rounded mb-3">
                            <h4>Makanan & Minuman</h4>
                            <p>Berbagai pilihan makanan dan minuman untuk setiap selera.</p>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="category-card">
                            <img src="obat.jpg" alt="Kesehatan" class="img-fluid rounded mb-3">
                            <h4>Kesehatan</h4>
                            <p>Produk kesehatan untuk menjaga kebugaran dan kesejahteraan.</p>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="category-card">
                            <img src="ATK.jpg" alt="ATK" class="img-fluid rounded mb-3">
                            <h4>ATK</h4>
                            <p>Berbagai alat tulis dan perlengkapan kantor untuk kebutuhan sehari-hari.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer Section -->
        <footer>
            <p>&copy; 2024 TOSERBA AMANAH. All rights reserved.</p>
        </footer>
    </div>

    <!-- REQUIRED SCRIPTS -->
    <script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('adminlte/dist/js/adminlte.min.js') }}"></script>

</body>

</html>
