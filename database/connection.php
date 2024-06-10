<?php
    $servername = "localhost";
    $user = "root";
    $password = "";
    $database_name = "penggajian";

    $connection = mysqli_connect($servername, $user, $password, $database_name);

    if (!$connection) {
        die("Gagal Koneksi : ". mysqli_connect_error());
    }
?>