<?php
    // Konfigurasi database
    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "pengurus";
    
    // Membuat koneksi database
    $conn = mysqli_connect($host, $username, $password, $database);
    
    // Cek koneksi
    if (!$conn) {
        die("Koneksi gagal: " . mysqli_connect_error());
    }
    
    // Set charset
    mysqli_set_charset($conn, "utf8");
?>