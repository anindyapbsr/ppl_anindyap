<?php
include("config/config.php");
$api_key="b06d85f5e73047149a829b7982190b61";
$url="https://newsapi.org/v2/top-headlines?country=us&category=technology&apiKey=".$api_key;
$data=http_request_get($url);
$hasil=json_decode($data,true);
?>
<!DOCTYPE html>
<html>

<head>
    <title>Home - NewsAPI</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
    body {
        font-family: "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
        font-size: 16px;
        line-height: 1.6;
        background-color: rgb(225, 243, 254);
        transition: all 0.3s ease;
    }

    .container {
        margin-top: 75px;
    }

    .error-box {
        background-color: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
        padding: 15px;
        border-radius: 5px;
        font-size: 1.1rem;
    }

    .card {
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        background-color: rgba(184, 229, 254, 1);
        border: 5px solid rgba(22, 6, 130, 0.06);
        transition: all 0.3s ease;
    }

    .card-title {
        font-size: 1.4rem;
        font-weight: 600;
        margin-bottom: 1rem;
        color: #2c3e50;
    }

    .card-text {
        font-size: 1.1rem;
        line-height: 1.5;
    }

    .card-text strong {
        font-weight: 600;
    }

    /* Hero */
    .hero {
        margin-top: 64px;
        background: linear-gradient(90deg, #0d6efd 0%, #6f42c1 100%);
        color: #fff;
        border-radius: 16px;
        padding: 48px 28px;
    }

    .hero h1 {
        font-size: 2.8rem;
        font-weight: 800;
        letter-spacing: .3px;
        margin-bottom: 20px;
        line-height: 1.2;
    }

    .hero p {
        opacity: .95;
        font-size: 1.25rem;
        margin-bottom: 30px;
        line-height: 1.6;
        font-weight: 400;
    }

    .hero .cta-btn {
        background: #ffffff;
        color: #0d6efd;
        border: none;
        padding: 10px 18px;
        border-radius: 8px;
        font-weight: 600;
    }

    .hero .cta-btn:hover {
        opacity: .9;
    }

    /* Feature cards */
    .feature-icon {
        width: 48px;
        height: 48px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        background: rgba(13, 110, 253, .12);
        color: #0d6efd;
        margin-bottom: 12px;
        font-size: 1.25rem;
    }

    /* Dark mode styles */
    .dark-mode {
        background-color: #1a1a1a;
        color: #ffffff;
    }

    .dark-mode .card {
        background-color: #2d2d2d;
        border-color: #3d3d3d;
    }

    .dark-mode .card-text {
        color: #ffffff;
    }

    .dark-mode .navbar {
        background: linear-gradient(90deg, #1a237e 0%, #311b92 100%) !important;
    }

    .dark-mode .hero {
        background: linear-gradient(90deg, #1a237e 0%, #311b92 100%);
    }

    .dark-mode .hero .cta-btn {
        background: #0d6efd;
        color: #fff;
    }

    .dark-mode .feature-icon {
        background: rgba(255, 255, 255, .08);
        color: #fff;
    }

    .dark-mode .card-title {
        color: #fff;
    }

    /* Dark mode button */
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

    .dark-mode .dark-mode-btn {
        border-color: rgba(255, 255, 255, 0.2);
    }
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
                    <a class="nav-link text-white-50 active" href="home.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white-50" href="index.php">News</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white-50" href="about.php">About</a>
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
                <div class="hero">
                    <h1>Temukan Berita Terbaru, Lebih Cepat</h1>
                    <p>Akses update berita teknologi dan umum dari berbagai sumber terpercaya. Gunakan filter kategori
                        dan negara untuk hasil yang lebih relevan.</p>
                    <a href="index.php" class="btn cta-btn"><i class="fas fa-newspaper"></i> Jelajahi Berita</a>
                </div>
            </div>
        </div>

        <div class="row" style="margin-top: 28px;">
            <div class="col-md-4" style="margin-bottom: 16px;">
                <div class="card p-3 h-100">
                    <div class="feature-icon"><i class="fas fa-filter"></i></div>
                    <h5 class="card-title">Filter Pintar</h5>
                    <p class="card-text">Saring berita berdasarkan kategori dan negara agar hasil lebih sesuai
                        kebutuhan.</p>
                </div>
            </div>
            <div class="col-md-4" style="margin-bottom: 16px;">
                <div class="card p-3 h-100">
                    <div class="feature-icon"><i class="fas fa-moon"></i></div>
                    <h5 class="card-title">Tema Gelap</h5>
                    <p class="card-text">Mode gelap yang nyaman untuk mata, konsisten di seluruh halaman.</p>
                </div>
            </div>
            <div class="col-md-4" style="margin-bottom: 16px;">
                <div class="card p-3 h-100">
                    <div class="feature-icon"><i class="fas fa-bolt"></i></div>
                    <h5 class="card-title">Cepat & Responsif</h5>
                    <p class="card-text">Antarmuka ringan dengan performa cepat di berbagai perangkat.</p>
                </div>
            </div>
        </div>
    </div>

    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/darkmode.js"></script>
</body>

</html>