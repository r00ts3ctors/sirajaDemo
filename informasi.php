<div class="row">
    <h4>Informasi</h4>
    <?php

    if (isset($_SESSION['succAdd'])) {
        $succAdd = $_SESSION['succAdd'];
        echo '<div id="alert-message" class="row">
        <div class="col m12">
        <div class="card green lighten-5">
        <div class="card-content notif">
        <span class="card-title green-text"><i class="material-icons md-36">done</i> ' . $succAdd . '</span>
        </div>
        </div>
        </div>
        </div>';
        unset($_SESSION['succAdd']);
    }

    if (isset($_SESSION['succHapus'])) {
        $succHapus = $_SESSION['succHapus'];
        echo '<div id="alert-message" class="row">
                <div class="col m12">
                         <div class="card green lighten-5">
                             <div class="card-content notif">
                            <span class="card-title green-text"><i class="material-icons md-36">done</i> ' . $succHapus . '</span>
                        </div>
                    </div>
                </div>
            </div>';
        unset($_SESSION['succHapus']);
        # code...
    }
    ?>
    <?php
    // form input di hilangkan dari user 
    $userAkses = $_SESSION['admin'];
    if ($userAkses == 5) {
    ?>
        <h6>Informasi Klient Silahkan di baca dengan baik.</h6>
    <?php
    } else {
    ?>
        <form action="" method="post">
            <div class="row">
                <div class="col s4">
                    <label for="">Title</label>
                    <input type="text" name="title" class="form-control" placeholder="Title Informasi">
                </div>
                <div class="col m4">
                    <label for="">Katagori</label>
                    <select name="katagori" id="">
                        <option value="">-- Pilih Katagori -- </option>
                        <option value="Artikel">Artikel</option>
                        <option value="Edukasi">Edukasi</option>
                        <option value="Pengumuman">Pengumuman</option>

                    </select>
                </div>

                <div class="col s4">
                    <label for="">Untuk</label>
                    <select name="untukuser" id="">
                        <option value="All">-- Semua -- </option>
                        <option value="Klien"> Klien</option>
                        <option value="Dokter"> Dokter</option>
                        <option value="AdminKota"> Admin Kab / Kota</option>
                        <option value="UserIPWL">User IPWL </option>


                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col s12">
                    <label for="">Title</label>
                    <input type="text" name="pesan" class="form-control" placeholder="Pesan Informasi">
                </div>

                <button type="submit" class="btn btn-large btn-warning float-left" style="margin: 0px 0px 0px 20px;" name="proses"> Proses</button>
        </form>
    <?php
    }

    ?>



</div>


<h5>List Informasi</h5>

<div class="row">

    <table class="bordered">
        <thead>
            <tr>
                <th>No.</th>
                <th>Pesan</th>
                <th>Tanggal</th>
                <th>Untuk</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php

            $dataPesan = mysqli_query($config, "SELECT * FROM tbl_informasi WHERE status_info = 1 LIMIT 10");
            $nomor = 1;
            while ($row = mysqli_fetch_array($dataPesan)) { ?>
                <tr>
                    <td><?php echo $nomor; ?></td>
                    <td><?php echo $row['title'] ?></td>
                    <td><?php echo $row['tgl_informasi'] ?></td>
                    <td><?php echo $row['untukuser'] ?></td>
                    <td>
                        <?php
                        $userAkses = $_SESSION['admin'];
                        if ($userAkses == 5) {
                            // jika user akses maka akan di hilangkan 
                        ?>
                            <a href="#" class="btn btn-md">Detail Informasi</a>
                        <?php } else {
                            // jika bukan user 
                        ?>
                            <a href="hapus_informasi.php?page=<?php echo $row['id']; ?>" class="btn btn-md">Hapus</a>
                        <?php }

                        ?>


                    </td>
                </tr>
            <?php
                $nomor++;
            }

            ?>

        </tbody>
    </table>
</div>
<?php


// Array ( [title] => SADF [katagori] => Artikel [untukuser] => Dokter [pesan] => ASDFASD )

if (isset($_POST['proses'])) {
    $title = $_POST['title'];
    $katagori = $_POST['katagori'];
    $untukuser = $_POST['untukuser'];
    $isi = $_POST['pesan'];

    $save = mysqli_query($config, "INSERT INTO tbl_informasi (id, title, katagori, pesan, untukuser) values('', '$title', '$katagori', '$isi', '$untukuser')");
    if ($save == true) {
        $_SESSION['succAdd'] = 'SUKSES! Data Informasi berhasil ditambahkan';
        echo '<script language="javascript">window.location.href="./admin.php?page=blm"; </script>';
    } else {
        $_SESSION['errQ'] = 'ERROR! Ada masalah dengan query';
        echo '<script language="javascript">window.history.back();</script>';
    }
}


?>