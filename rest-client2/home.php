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
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", "Liberation Sans", sans-serif;
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
    }
    .card {
        box-shadow: 0 1px 2px rgba(0, 0, 0, .06);
        background-color: rgba(184, 229, 254, 1);
        border: 5px solid rgba(22, 6, 130, 0.06);
        transition: all 0.3s ease;
    }
    .card-title,
    .card-text strong {
        font-weight: 700px;
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
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark" style="background: linear-gradient(90deg, #0d6efd 0%, #6f42c1 100%);">
        <a class="navbar-brand fw-semibold" href="home.php" style="font-size: 1.8rem; margin-left: 20px;">NewsAPI</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link text-white-50 active" href="home.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white-50" href="news.php">News</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white-50" href="about.php">About</a>
                </li>
            </ul>
            <button id="darkModeBtn" class="dark-mode-btn" onclick="toggleDarkMode()">
                <i class="fas fa-moon"></i> Dark Mode
            </button>
        </div>
    </nav>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2>Welcome to NewsAPI</h2>
                <p>Your source for the latest technology news from around the world.</p>
            </div>
        </div>
    </div>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/darkmode.js"></script>
</body>
</html>