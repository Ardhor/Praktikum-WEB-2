<div class="row mb-3">
    <div class="col">
        <h3>Hapus data Karyawan</h3>
    </div>
    <div class="col">
        <a href="?page=karyawan" class="btn btn-primary float-end">
            <i class="fa fa-arrow-circle-left"></i>
            Kembali
        </a>
    </div>
</div>
<div id="pesan" class="row mb-3">
    <div class="col">
        <?php
            include "database/connection.php";
            $nik = $_GET['nik'];

            $sql = "DELETE FROM karyawan WHERE nik = $nik";

            $result = mysqli_query($connection, $sql);
            if(!$result) {
        ?>
                <div class="alert alert-danger" role="alert">
                    <i class="fa fa-exclamation-cirle"></i>
                    <?php echo mysqli_error($connection) ?>
                </div>
            <?php
            } else {
            ?>
                <div class="alert alert-success" role="alert">
                    <i class="fa fa-check-circle"></i>
                    Hapus data berhasil
                </div>
                <meta http-equiv="refresh" content="2;url=?page=karyawan">
            <?php    
            }
            ?>
    </div>
</div>