<?php
    // Include konfigurasi database
    include("config.php");
    
    // Set header untuk JSON
    header('Content-Type: application/json');
    
    // Cek apakah ada parameter ID (untuk edit data)
    $id = isset($_GET['id']) ? $_GET['id'] : null;
    
    if ($id) {
        // Query untuk mengambil data berdasarkan ID
        $query = "SELECT * FROM pengurus WHERE id = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        
        if ($result && mysqli_num_rows($result) > 0) {
            $data = mysqli_fetch_assoc($result);
            echo json_encode($data);
        } else {
            echo json_encode(array('error' => 'Data tidak ditemukan'));
        }
    } else {
        // Query untuk mengambil semua data
        $query = "SELECT * FROM pengurus ORDER BY id ASC";
        $result = mysqli_query($conn, $query);
        
        if ($result && mysqli_num_rows($result) > 0) {
            $data = array();
            while ($row = mysqli_fetch_assoc($result)) {
                $data[] = $row;
            }
            echo json_encode($data);
        } else {
            echo json_encode(array('error' => 'Tidak ada data'));
        }
    }
    
    // Tutup koneksi
    mysqli_close($conn);
?>