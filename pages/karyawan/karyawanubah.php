<div class="row mb-3">
    <div class="col">
        <h3>Ubah data karyawan</h3>
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
            if(isset($_POST['simpan_button'])){
                $nik = $_POST["nik"];
                $nama = $_POST['nama'];
                $tanggal_mulai = $_POST['tanggal_mulai'];
                $gaji_pokok = $_POST['gaji_pokok'];
                $status_karyawan = $_POST['status_karyawan'];
                $bagian_id = $_POST['bagian_id'];
                
                $updateSQL = "UPDATE karyawan SET
                    nik='$nik',
                    nama='$nama',
                    tanggal_mulai='$tanggal_mulai',
                    gaji_pokok=$gaji_pokok,
                    status_karyawan='$status_karyawan',
                    bagian_id=$bagian_id WHERE nik='$nik'";
                $result = mysqli_query($connection, $updateSQL);
                if (!$result){
        ?>      
                    <div class="alert alert-danger" role="alert">
                        <i class="fa fa-exclamation-circle"></i>
                        <?php echo mysqli_error($connection) ?>
                    </div>
                <?php                  
                } else {
                ?>
                    <div class="alert alert-success" role="alert">
                            <i class="fa fa-check-circle"></i>
                            Ubah Data Berhasil Disimpan
                        </div>
        <?php        
                    }
                }
            $nik = $_GET['nik'];
            $selectSQL = "SELECT * FROM karyawan WHERE nik = $nik";
            $result = mysqli_query($connection, $selectSQL);
            if (!$result || mysqli_num_rows($result) == 0) {
                echo '<meta http-equiv="refresh" content="0;url=page=bagian">';
            }
            $row = mysqli_fetch_assoc($result);
            $tetap_checked = $row["status_karyawan"] == "TETAP" ? "checked" : "";
            $kontrak_checked = $row["status_karyawan"] == "KONTRAK" ? "checked" : "";
            $magang_checked = $row["status_karyawan"] == "MAGANG" ? "checked" : "";
        ?>
    </div>
</div>
<div id="inputan" class="row mb-3">
    <div class="col">
        <div class="card px-3 py-3">
            <form action="" method="POST">
                <div class="mb-3">
                    <label for="nik" class="form-label">NIK</label>
                    <input type="text" class="form-control" id="nik" name="nik" placeholder="misal: 0001" 
                    value="<?php echo $row['nik']?>" readonly>
                </div>
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama" placeholder="misal: Agus sitompul" 
                    value="<?php echo $row['nama']?>" required>
                </div>
                <div class="mb-3">
                    <label for="tanggal_mulai" class="form-label">Tanggal Mulai Bekerja</label>
                    <input type="date" class="form-control" id="tanggal_mulai" name="tanggal_mulai" 
                    value="<?php echo $row['tanggal_mulai']?>" required>
                </div>
                <div class="mb-3">
                    <label for="gaji_pokok" class="form-label">Gaji Pokok</label>
                    <input type="number" class="form-control" id="gaji_pokok" name="gaji_pokok" 
                    value="<?php echo $row['gaji_pokok']?>" required>
                </div>
                <label class="form-label" for="">Status Karyawan</label>
                <div class="mb-3 mt-3">
                    <input type="radio" class="form-check-input" name="status_karyawan" id="TETAP" 
                    value="tetap" <?php echo $tetap_checked?> required>
                    <label for="TETAP" class="form-check-label">TETAP</label>
                </div>
                <div class="mb-3 mt-3">
                    <input type="radio" class="form-check-input" name="status_karyawan" id="MAGANG" 
                    value="magang" <?php echo $magang_checked?> required>
                    <label for="MAGANG" class="form-check-label">MAGANG</label>
                </div>
                <div class="mb-3 mt-3">
                    <input type="radio" class="form-check-input" name="status_karyawan" id="KONTRAK" 
                    value="KONTRAK" <?php echo $kontrak_checked?> required>
                    <label for="KONTRAK" class="form-check-label">KONTRAK</label>
                </div>
                <div class="mb-3 mt-3">
                    <label for="bagian_id" class="form-label">Bagian</label>
                    <?php
                        $selectSQLbagian = "SELECT * FROM bagian";
                        $result_bagian = mysqli_query($connection, $selectSQLbagian);
                        if(!$result_bagian){
                     ?>  
                            <div role="alert" class="alert alert-danger">
                                <?php echo mysqli_error($connection)?>
                            </div>     
                    <?php
                            return;        
                        }
                        if (mysqli_num_rows($result_bagian) == 0){
                    ?>      <div role="alert" class="alert alert-light">
                                Data Kosong
                            </div>
                    <?php        
                            return;      
                        }
                    ?>
                    <select name="bagian_id" aria-label="default select example" class="form-select">
                        <option value="" selected>-- Pilih Bagian --</option>
                    <?php
                        while ($row_bagian = mysqli_fetch_assoc($result_bagian)){
                            $bagian_selected = $row['bagian_id'] == $row_bagian['id'] ? " selected" : "";
                    ?>
                            <option 
                                value="<?php echo $row_bagian["id"]?>">
                                <?php echo $bagian_selected?>
                                    <?php echo $row_bagian['nama']?>
                            </option>
                        <?php        
                            }
                        ?>
                    </select>
                <div class="col mb-3">
                    <button class="btn btn-success" type="submit" name="simpan_button">
                        <i class="fas fa-save"></i>
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }    
</script>