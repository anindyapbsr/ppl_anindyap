<?php
// File: test_name.php
require_once "Validator.php";

// Test Case 1: Nama valid (nama lengkap Anda)
try {
    $result = validateName("Anindya Purbasari"); // ganti dengan nama lengkapmu
    echo "PASS: Nama 'Anindya Purbasari' diterima\n";
} catch (Exception $e) {
    echo "FAIL: Nama 'Anindya Purbasari' tidak diterima. Error: " . $e->getMessage() . "\n";
}

// Test Case 2: Nama berisi angka
try {
    $result = validateName("Anin1212");
    echo "FAIL: Nama 'Anin1212' seharusnya ditolak\n";
} catch (Exception $e) {
    echo "PASS: Nama 'Anin1212' ditolak. Error: " . $e->getMessage() . "\n";
}

// Test Case 3: Nama kosong
try {
    $result = validateName("");
    echo "FAIL: Nama kosong seharusnya ditolak\n";
} catch (Exception $e) {
    echo "PASS: Nama kosong ditolak. Error: " . $e->getMessage() . "\n";
}