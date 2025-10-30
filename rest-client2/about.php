<!DOCTYPE html>
<html>
<head>
    <title>About - NewsAPI</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
    body {
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", "Liberation Sans", sans-serif;
        background-color: rgb(225, 243, 254);
        transition: all 0.3s ease;
    }
    .container { margin-top: 75px; }
    .hero-about {
        margin-top: 64px;
        background: linear-gradient(90deg, #6f42c1 0%, #0d6efd 100%);
        color: #fff;
        border-radius: 16px;
        padding: 48px 28px;
        text-align: center;
    }
    .hero-about i {
        font-size: 2.5rem;
        margin-bottom: 18px;
    }
    .hero-about h1 {
        font-weight: 800;
        margin-bottom: 12px;
    }
    .hero-about p {
        font-size: 1.07rem;
        margin-bottom: 0;
        opacity: .97;
    }
    .about-feature-icon {
        width: 48px; height: 48px;
        display: inline-flex; align-items: center; justify-content: center;
        border-radius: 12px;
        background: rgba(13,110,253,0.13);
        color: #0d6efd;
        margin-bottom: 12px;
        font-size: 1.3rem;
    }
    .card-title, .card-text strong { font-weight: 700px; }
    .dark-mode {background-color: #1a1a1a; color: #fff;}
    .dark-mode .card {background-color: #2d2d2d; border-color: #3d3d3d;}
    .dark-mode .navbar, .dark-mode .hero-about {
        background: linear-gradient(90deg, #1a237e 0%, #311b92 100%) !important;
    }
    .dark-mode .about-feature-icon { background: rgba(255,255,255,0.08); color: #fff; }
    .dark-mode .card-title { color: #fff; }
    .dark-mode .card-text { color: #fff; }
    .dark-mode-btn {
        background-color: transparent;
        border: 1px solid rgba(255, 255, 255, 0.5);
        color: rgba(255, 255, 255, 0.7);
        padding: 0.375rem 0.75rem;
        border-radius: 0.25rem;
        cursor: pointer;
        transition: all 0.3s ease;
        margin-left: 10px;
    }
    .dark-mode-btn:hover {
        background-color: rgba(255, 255, 255, 0.1);
        color: rgba(255, 255, 255, 1);
    }
    .dark-mode .dark-mode-btn {border-color: rgba(255,255,255,0.2);}
    </style>
</head>
<body>
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark"
        style="background: linear-gradient(90deg, #0d6efd 0%, #6f42c1 100%);">
        <a class="navbar-brand fw-semibold" href="home.php" style="font-size: 1.8rem; margin-left: 20px;">NewsAPI</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link text-white-50" href="home.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white-50" href="index.php">News</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white-50 active" href="about.php">About</a>
                </li>
            </ul>
            <button id="darkModeBtn" class="dark-mode-btn ml-auto" onclick="toggleDarkMode()">
                <i class="fas fa-moon"></i> Dark Mode
            </button>
        </div>
    </nav>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="hero-about">
                    <i class="fas fa-info-circle"></i>
                    <h1>Tentang NewsAPI Project</h1>
                    <p>NewsAPI Project adalah portal berita modern yang menggunakan layanan API berita global dan nasional. Dengan filter kategori & negara, Anda bisa mendapatkan informasi terupdate secara cepat dan relevan.
                    </p>
                </div>
            </div>
        </div>
        <div class="row" style="margin-top:28px;">
            <div class="col-md-4" style="margin-bottom:16px;">
                <div class="card p-3 h-100">
                    <div class="about-feature-icon"><i class="fas fa-layer-group"></i></div>
                    <h5 class="card-title">Sumber Terpercaya</h5>
                    <p class="card-text">Mengambil berita langsung dari media resmi dan portal populer nasional & internasional.</p>
                </div>
            </div>
            <div class="col-md-4" style="margin-bottom:16px;">
                <div class="card p-3 h-100">
                    <div class="about-feature-icon"><i class="fas fa-globe"></i></div>
                    <h5 class="card-title">Lintas Negara & Kategori</h5>
                    <p class="card-text">Jelajah berita dunia sesuai kebutuhan, baik teknologi, hiburan, olahraga, atau aktual nasional.</p>
                </div>
            </div>
            <div class="col-md-4" style="margin-bottom:16px;">
                <div class="card p-3 h-100">
                    <div class="about-feature-icon"><i class="fas fa-bolt"></i></div>
                    <h5 class="card-title">Akses Instan</h5>
                    <p class="card-text">Tampilan clean & responsif, serta mode gelap otomatis demi kenyamanan membaca Anda.</p>
                </div>
            </div>
        </div>
    </div>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/darkmode.js"></script>
</body>
</html>