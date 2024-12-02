<<<<<<< HEAD
<?php
// uploads.php

// Tentukan folder tujuan untuk menyimpan gambar
$uploadDir = 'admin/uploads/';

// Mengecek apakah folder uploads sudah ada, jika belum buat foldernya
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true); // Membuat folder uploads jika belum ada
    echo "Folder uploads berhasil dibuat.";
} else {
    echo "Folder uploads sudah ada.";
}
?>
=======
<?php
// uploads.php

// Tentukan folder tujuan untuk menyimpan gambar
$uploadDir = 'admin/uploads/';

// Mengecek apakah folder uploads sudah ada, jika belum buat foldernya
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true); // Membuat folder uploads jika belum ada
    echo "Folder uploads berhasil dibuat.";
} else {
    echo "Folder uploads sudah ada.";
}
?>
>>>>>>> 9566594f536fed5e6100bf8751beb1cb5fb9a232
