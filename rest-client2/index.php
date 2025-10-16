<?php
//load config.php
include("config/config.php");
 
//untuk api_key newsapi.org
$api_key="b06d85f5e73047149a829b7982190b61";

//url api untuk ambil berita headline dari Amerika Serikat
$url="https://newsapi.org/v2/top-headlines?country=us&apiKey=".$api_key;

// Alternatif URL jika tidak ada berita US (diurutkan berdasarkan prioritas)
$alternative_urls = [
    "https://newsapi.org/v2/top-headlines?country=id&apiKey=".$api_key,
    "https://newsapi.org/v2/top-headlines?language=en&apiKey=".$api_key,
    "https://newsapi.org/v2/top-headlines?category=technology&language=en&apiKey=".$api_key,
    "https://newsapi.org/v2/top-headlines?category=business&language=en&apiKey=".$api_key
];
 
//menyimpan hasil dalam variabel
$data=http_request_get($url);

//konversi data json ke array
$hasil=json_decode($data,true);

//cek apakah data berhasil diambil
$error_message = "";
if (!$data) {
    $error_message = "Gagal mengambil data dari API.";
} elseif (!$hasil || !isset($hasil['articles']) || empty($hasil['articles'])) {
    // Jika tidak ada berita US, coba dengan alternatif URL
    $success = false;
    
    // Coba alternatif URL berdasarkan prioritas
    foreach ($alternative_urls as $alt_url) {
        $data = http_request_get($alt_url);
        $hasil = json_decode($data, true);
        
        if ($hasil && isset($hasil['articles']) && !empty($hasil['articles'])) {
            $success = true;
            break; // Berhenti setelah menemukan berita yang valid
        }
    }
    
    if (!$success) {
        // Jika semua API gagal, gunakan berita sample
        $hasil = [
            'status' => 'ok',
            'totalResults' => 3,
            'articles' => [
                [
                    'title' => 'Teknologi AI Terbaru Mengubah Dunia',
                    'description' => 'Perkembangan teknologi Artificial Intelligence terbaru membawa perubahan signifikan dalam berbagai industri.',
                    'url' => '#',
                    'urlToImage' => 'https://via.placeholder.com/400x200/17a2b8/ffffff?text=AI+Technology',
                    'author' => 'Tech News',
                    'publishedAt' => date('c')
                ],
                [
                    'title' => 'Ekonomi Global Menunjukkan Tanda Pemulihan',
                    'description' => 'Indikator ekonomi global menunjukkan tanda-tanda pemulihan yang positif setelah periode sulit.',
                    'url' => '#',
                    'urlToImage' => 'https://via.placeholder.com/400x200/28a745/ffffff?text=Global+Economy',
                    'author' => 'Finance Today',
                    'publishedAt' => date('c')
                ],
                [
                    'title' => 'Inovasi Terbaru dalam Dunia Pendidikan',
                    'description' => 'Metode pembelajaran baru yang inovatif mengubah cara kita memahami dan menerima pendidikan.',
                    'url' => '#',
                    'urlToImage' => 'https://via.placeholder.com/400x200/dc3545/ffffff?text=Education',
                    'author' => 'Edu News',
                    'publishedAt' => date('c')
                ]
            ]
        ];
        $error_message = ""; // Clear error message
    }
}

// Debug info (hapus ini setelah testing)
if (isset($_GET['debug'])) {
    echo "<pre>";
    echo "API Response:\n";
    print_r($hasil);
    echo "\nFirst Article:\n";
    if (isset($hasil['articles'][0])) {
        print_r($hasil['articles'][0]);
    }
    echo "</pre>";
}
 
?>
<!DOCTYPE html>
<html>

<head>
    <title>Rest Client dengan cURL</title>
    <!-- CSS Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
    .card {
        transition: transform 0.3s ease;
        margin-bottom: 20px;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .card-img-top {
        object-fit: cover;
        height: 200px;
        width: 100%;
        display: block;
    }

    .card-img-top:not([src]) {
        background: linear-gradient(45deg, #f0f0f0, #e0e0e0);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .card-img-top:not([src]):after {
        content: "🖼️ No Image";
        color: #666;
        font-size: 14px;
    }

    .news-card {
        margin-bottom: 20px;
    }

    .author-info {
        font-size: 0.9em;
        color: #6c757d;
        margin-bottom: 10px;
    }

    .news-title {
        font-weight: 600;
        margin-bottom: 10px;
    }

    .loading-spinner {
        display: none;
        text-align: center;
        padding: 50px;
    }

    .card-footer {
        background-color: #f8f9fa;
        border-top: 1px solid #dee2e6;
    }

    .navbar-brand {
        font-weight: bold;
    }

    .btn-primary {
        background-color: #17a2b8;
        border-color: #17a2b8;
    }

    .btn-primary:hover {
        background-color: #138496;
        border-color: #117a8b;
    }

    .img-error {
        background-color: #f8f9fa;
        border: 1px solid #dee2e6;
    }

    .card-img-top.img-error {
        background: linear-gradient(45deg, #f8f9fa, #e9ecef);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #6c757d;
        font-size: 14px;
    }
    </style>
</head>

<body>

    <!-- navbar -->
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-info">
        <div class="container">
            <a class="navbar-brand" href="#"><i class="fas fa-newspaper"></i> NewsReader</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="#"><i class="fas fa-home"></i> Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-newspaper"></i> News</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-info-circle"></i> About</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- navbar -->
    <div class="container" style="margin-top: 75px;">
        <?php if ($error_message): ?>
        <div class="alert alert-danger" role="alert">
            <h4 class="alert-heading">Error!</h4>
            <p><?php echo $error_message; ?></p>
            <hr>
            <p class="mb-0">Silakan cek koneksi internet atau API key NewsAPI.</p>
        </div>
        <?php else: ?>
        <div class="row">
            <!-- looping hasil data di array article -->
            <?php if (isset($hasil['articles']) && is_array($hasil['articles'])): ?>
            <?php foreach ($hasil['articles'] as $row): ?>
            <?php if ($row['title'] && $row['url']): ?>
            <div class="col-lg-4 col-md-6 col-sm-12 news-card">
                <div class="card h-100">
                    <img src="<?php echo !empty($row['urlToImage']) ? htmlspecialchars($row['urlToImage']) : 'https://via.placeholder.com/400x200/17a2b8/ffffff?text=No+Image'; ?>"
                        class="card-img-top" alt="<?php echo htmlspecialchars($row['title']); ?>"
                        onerror="this.src='https://via.placeholder.com/400x200/17a2b8/ffffff?text=No+Image'; this.onerror=null;"
                        loading="lazy">
                    <div class="card-body d-flex flex-column">
                        <div class="author-info">
                            <i class="fas fa-user"></i>
                            <?php echo htmlspecialchars($row['author'] ?? 'Unknown Author'); ?>
                        </div>
                        <h5 class="card-title news-title">
                            <?php echo htmlspecialchars($row['title']); ?>
                        </h5>
                        <?php if ($row['description']): ?>
                        <p class="card-text flex-grow-1">
                            <?php echo htmlspecialchars(substr($row['description'], 0, 120)) . '...'; ?>
                        </p>
                        <?php endif; ?>
                        <div class="mt-auto">
                            <a href="<?php echo htmlspecialchars($row['url']); ?>" target="_blank"
                                class="btn btn-primary btn-sm">
                                Baca Selengkapnya
                            </a>
                        </div>
                    </div>
                    <div class="card-footer text-muted">
                        <small>
                            <?php echo date('d M Y H:i', strtotime($row['publishedAt'] ?? 'now')); ?>
                        </small>
                    </div>
                </div>
            </div>
            <?php endif; ?>
            <?php endforeach; ?>
            <?php else: ?>
            <div class="col-12">
                <div class="alert alert-info" role="alert">
                    <h4 class="alert-heading">Tidak ada berita</h4>
                    <p>Tidak ada berita yang tersedia saat ini.</p>
                </div>
            </div>
            <?php endif; ?>
        </div>
        <?php endif; ?>
    </div>

    <!-- JS Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>

    <script>
    $(document).ready(function() {
        // Smooth scrolling for anchor links
        $('a[href^="#"]').on('click', function(event) {
            var target = $(this.getAttribute('href'));
            if (target.length) {
                event.preventDefault();
                $('html, body').stop().animate({
                    scrollTop: target.offset().top - 80
                }, 1000);
            }
        });

        // Add loading state to external links
        $('a[target="_blank"]').on('click', function() {
            $(this).html('<i class="fas fa-spinner fa-spin"></i> Loading...');
        });

        // Image error handling
        $('img').on('error', function() {
            $(this).attr('src', 'https://via.placeholder.com/400x200/17a2b8/ffffff?text=No+Image');
            $(this).addClass('img-error');
        });

        // Check if images are loading
        $('img').each(function() {
            if (!this.complete || this.naturalWidth === 0) {
                console.log('Image failed to load:', this.src);
            }
        });
    });
    </script>
</body>

</html>