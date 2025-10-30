<?php
//load config.php 
include("config/config.php");
 
// untuk api_key newsapi.org
$api_key="b06d85f5e73047149a829b7982190b61";
 
// URL API 
$url="https://newsapi.org/v2/top-headlines?country=us&category=technology&apiKey=".$api_key;
 
// menyimpan hasil dalam variabel
$data=http_request_get($url);
 
// konversi data json ke array
$hasil=json_decode($data,true);

$kategoris = [
    'general' => 'Umum',
    'business' => 'Bisnis',
    'entertainment' => 'Hiburan',
    'health' => 'Kesehatan',
    'science' => 'Sains',
    'sports' => 'Olahraga',
    'technology' => 'Teknologi'
];
$negaras = [
    'indonesia' => 'Indonesia',
    'usa' => 'USA',
    'uk' => 'Inggris',
    'japan' => 'Jepang',
    'france' => 'Perancis',
    'germany' => 'Jerman',
    'singapore' => 'Singapura',
    'canada' => 'Kanada',
    'australia' => 'Australia'
];
// Mapping: key = negara value = array domain
$negara_domains = [
    'indonesia' => ['kompas.com','detik.com','cnnindonesia.com','tempo.co','tribunnews.com','antaranews.com','liputan6.com','merdeka.com','jawapos.com'],
    'usa' => ['cnn.com','nytimes.com','foxnews.com','washingtonpost.com','usatoday.com','npr.org','cnbc.com','abcnews.go.com'],
    'uk' => ['bbc.co.uk','theguardian.com','dailymail.co.uk','telegraph.co.uk','independent.co.uk','thetimes.co.uk'],
    'japan' => ['asahi.com','mainichi.jp','nhk.or.jp','nikkei.com','japantimes.co.jp'],
    'france' => ['lemonde.fr','lefigaro.fr','20minutes.fr','liberation.fr'],
    'germany' => ['spiegel.de','welt.de','faz.net','sueddeutsche.de'],
    'singapore' => ['straitstimes.com','channelnewsasia.com'],
    'canada' => ['cbc.ca','ctvnews.ca','globalnews.ca'],
    'australia' => ['abc.net.au','smh.com.au','theaustralian.com.au']
];

$kategori = isset($_GET['kategori']) ? $_GET['kategori'] : 'general';
$negara = isset($_GET['negara']) ? $_GET['negara'] : 'indonesia';
$q = $kategori == 'general' ? '' : $kategori;
$domains = isset($negara_domains[$negara]) ? implode(",", $negara_domains[$negara]) : '';
if ($domains) {
    $url = "https://newsapi.org/v2/everything?q=".urlencode($q)."&domains=".urlencode($domains)."&apiKey=".$api_key;
    $data = http_request_get($url);
    $hasil = json_decode($data,true);
} else {
    $hasil = false;
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Rest Client dengan cURL</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
    /* Typography using safe system fonts */
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

    /* Card spacing and contrast */
    .card {
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        background-color: rgba(184, 229, 254, 1);
        border: 5px solid rgba(22, 6, 130, 0.06);
        transition: all 0.3s ease;
        margin-bottom: 20px;
    }

    .card-body {
        padding: 1.5rem;
    }

    .card-text {
        font-size: 1.1rem;
        line-height: 1.5;
        margin-bottom: 1rem;
    }

    .card-text strong {
        font-size: 1.2rem;
        font-weight: 600;
        color: #2c3e50;
        display: block;
        margin-top: 0.5rem;
    }

    .card-text i {
        font-size: 0.95rem;
        color: #666;
    }

    /* Navigation text */
    .navbar-brand {
        font-size: 2rem !important;
        font-weight: 600 !important;
    }

    .nav-link {
        font-size: 1.1rem !important;
        font-weight: 500 !important;
    }

    /* Link styling */
    .card-text a {
        font-size: 1.1rem;
        font-weight: 500;
        color: #0056b3;
        text-decoration: none;
    }

    .card-text a:hover {
        color: #003d82;
        text-decoration: underline;
    }

    /* Dark mode styles */
    .dark-mode {
        background-color: #1a1a1a;
        color: #ffffff;
    }

    .dark-mode .card {
        background-color: #232235;
        border-color: #28285a;
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

    .dark-mode .card-title,
    .dark-mode .card-text strong {
        color: #fff;
    }

    .dark-mode .card-text small {
        color: #fff;
    }

    .dark-mode .error-box {
        color: #fff;
        background: #311b92;
        border-color: #6f42c1;
    }

    .dark-mode label {
        color: #fff;
    }

    .dark-mode input,
    .dark-mode select {
        background: #232235;
        color: #fff;
        border-color: #666;
    }

    .dark-mode .btn-primary {
        background: #375a99;
        border-color: #6f42c1;
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
                    <a class="nav-link text-white-50" href="home.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white-50 active" href="index.php">News</a>
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
            <!-- Box debug dihapus sesuai permintaan -->
            <div class="col-12 mb-4">
                <form class="form-inline" method="get" action="index.php">
                    <label for="kategori" class="mr-2 font-weight-bold">Kategori:</label>
                    <select name="kategori" id="kategori" class="form-control mr-3">
                        <?php foreach($kategoris as $key => $label): ?>
                        <option value="<?= htmlspecialchars($key) ?>" <?= $kategori==$key?'selected':'' ?>>
                            <?= htmlspecialchars($label) ?></option>
                        <?php endforeach; ?>
                    </select>
                    <label for="negara" class="mr-2 font-weight-bold">Negara:</label>
                    <select name="negara" id="negara" class="form-control mr-3">
                        <?php foreach($negaras as $key => $label): ?>
                        <option value="<?= htmlspecialchars($key) ?>" <?= $negara==$key?'selected':'' ?>>
                            <?= htmlspecialchars($label) ?></option>
                        <?php endforeach; ?>
                    </select>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> Cari</button>
                </form>
            </div>
            <?php 

if ($hasil === false) {
    echo '<div class="col-12">';
    echo '<div class="error-box">';
    echo '<h3>Belum tersedia daftar situs berita untuk negara yang dipilih.</h3>';
    echo '<p>Silakan pilih negara lain (support: ID, US, UK, JP, FR, DE, SG, CA, AU).</p>';
    echo '</div>';
    echo '</div>';
} elseif (is_array($hasil) && isset($hasil['status']) && $hasil['status'] == 'ok' && isset($hasil['articles']) && count($hasil['articles'])>0) {
    
    // Looping jika data valid
    foreach ($hasil['articles'] as $row) { 
?>

            <div class="col-md-4" style="margin-top: 10px; margin-bottom: 10px;">
                <div class="card" style="width: 100%;">
                    <img src="<?php echo $row['urlToImage'] ?? 'placeholder.jpg'; ?>" class="card-img-top"
                        height="180px" alt="Gambar Berita">
                    <div class="card-body">
                        <p class="card-text mb-1">
                            <i>Oleh <?php echo htmlspecialchars($row['author'] ?? 'N/A'); ?></i>
                            <br>
                            <strong><?php echo htmlspecialchars($row['title']); ?></strong>
                        </p>
                        <p class="card-text"><small class="text-dark">Sumber:
                                <?php echo htmlspecialchars($row['source']['name'] ?? ''); ?></small></p>
                        <p class="text-right"><a href="<?php echo htmlspecialchars($row['url']); ?>"
                                target="_blank">Selengkapnya..</a></p>
                    </div>
                </div>
            </div>

            <?php 
    } // Akhir foreach
    
} else {
    // Tampilkan pesan error jika API request gagal (API Key salah, kuota habis, dll.)
    echo '<div class="col-12">';
    echo '<div class="error-box">';
    echo '<h3>Tidak ada berita ditemukan.</h3>';
    echo '<p>Coba pilih kategori lain pada negara tersebut.</p>';
    echo '</div>';
    echo '</div>';
}
?>

        </div>
    </div>

    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/darkmode.js"></script>
</body>

</html>