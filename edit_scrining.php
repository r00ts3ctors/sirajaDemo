<?php
    //cek session
    if(empty($_SESSION['admin'])){
        $_SESSION['err'] = '<center>Anda harus login terlebih dahulu!</center>';
        header("Location: ./");
        die();
    } else {

        if(isset($_REQUEST['submit'])){

            $id_surat = $_REQUEST['id_surat'];
            $query = mysqli_query($config, "SELECT * FROM tbl_surat_masuk WHERE id_surat='$id_surat'");
            list($id_surat) = mysqli_fetch_array($query);

            //validasi form kosong
            if($_REQUEST['isi_scrining'] == "" 
                || empty($_REQUEST['jenis_zat'])
                || $_REQUEST['pendidikan'] == ""
                || empty($_REQUEST['penyakit'])
                || $_REQUEST['usia_pakai'] == ""
                || empty($_REQUEST['jenis_zat_akhir'])
                || $_REQUEST['level_candu'] ==""){
                $_SESSION['errEmpty'] = 'ERROR! Semua form wajib diisi';
                echo '<script language="javascript">window.history.back();</script>';
            } else {

                $id_scrining = $_REQUEST['id_scrining'];
                $isi_scrining = $_REQUEST['isi_scrining'];
                $jenis_zat = implode(',', $_REQUEST['jenis_zat']); 
                $pendidikan = $_REQUEST['pendidikan'];
                $penyakit = implode(',', $_REQUEST['penyakit']); 
                $usia_pakai = $_REQUEST['usia_pakai'];
                $jenis_zat_akhir = implode(',', $_REQUEST['jenis_zat_akhir']); 
                $level_candu = $_REQUEST['level_candu'];
                $id_user = $_SESSION['id_user'];

                //validasi input data

                    if(!preg_match("/^[a-zA-Z0-9.,_()%&@\/\r\n -]*$/", $isi_scrining)){
                        $_SESSION['isi_scrining'] = 'Form Keterangan hanya boleh mengandung karakter huruf, angka, spasi, titik(.), koma(,), minus(-), garis miring(/), dan(&), underscore(_), kurung(), persen(%) dan at(@)';
                        echo '<script language="javascript">window.history.back();</script>';
                    } else {

                            if(!preg_match("/^[a-zA-Z0-9.,() \/ -]*$/", $pendidikan)){
                            $_SESSION['ependidikan'] = 'Form Alamat hanya boleh mengandung karakter huruf, angka, spasi, titik(.), koma(,), minus(-),kurung() dan garis miring(/)';
                            echo '<script language="javascript">window.history.back();</script>';
                            } else {
                                if(!preg_match("/^[a-zA-Z0-9.:,_()%&@\/\r\n -]*$/", $level_candu)){
                                $_SESSION['level_candu'] = 'Form Level Candu hanya boleh mengandung karakter huruf dan spasi';
                                echo '<script language="javascript">window.history.back();</script>';
                                } else {

                                    $query = mysqli_query($config, "UPDATE tbl_scrining SET 
                                        isi_scrining='$isi_scrining', 
                                        jenis_zat='$jenis_zat',
                                        pendidikan='$pendidikan',
                                        penyakit='$penyakit',
                                        usia_pakai='$usia_pakai',
                                        jenis_zat_akhir='$jenis_zat_akhir',
                                        level_candu='$level_candu', 
                                        id_surat='$id_surat', 
                                        id_user='$id_user' WHERE id_scrining='$id_scrining'");

                                    if($query == true){
                                        $_SESSION['succEdit'] = 'SUKSES! Data Scrining berhasil diupdate';
                                        echo '<script language="javascript">
                                                window.location.href="./admin.php?page=tsm&act=scr&id_surat='.$id_surat.'";
                                              </script>';
                                    } else {
                                        $_SESSION['errQ'] = 'ERROR! Ada masalah dengan query';
                                        echo '<script language="javascript">window.history.back();</script>';
                                    }
                                }
                            }
                        }
                    }
        } else {

            $id_scrining = mysqli_real_escape_string($config, $_REQUEST['id_scrining']);
            $query = mysqli_query($config, "SELECT * FROM tbl_scrining WHERE id_scrining='$id_scrining'");
            if(mysqli_num_rows($query) > 0){
                $no = 1;
                while($row = mysqli_fetch_array($query)){?>

                <!-- Row Start -->
                <div class="row">
                    <!-- Secondary Nav START -->
                    <div class="col s12">
                        <nav class="secondary-nav">
                            <div class="nav-wrapper blue-grey darken-1">
                                <ul class="left">
                                    <li class="waves-effect waves-light"><a href="#" class="judul"><i class="material-icons">edit</i> Edit  Data Hasil Formulir Wajib Lapor</a></li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                    <!-- Secondary Nav END -->
                </div>
                <!-- Row END -->

                <?php
                    if(isset($_SESSION['errEmpty'])){
                        $errEmpty = $_SESSION['errEmpty'];
                        echo '<div id="alert-message" class="row">
                                <div class="col m12">
                                    <div class="card red lighten-5">
                                        <div class="card-content notif">
                                            <span class="card-title red-text"><i class="material-icons md-36">clear</i> '.$errEmpty.'</span>
                                        </div>
                                    </div>
                                </div>
                            </div>';
                        unset($_SESSION['errEmpty']);
                    }
                    if(isset($_SESSION['errQ'])){
                        $errQ = $_SESSION['errQ'];
                        echo '<div id="alert-message" class="row">
                                <div class="col m12">
                                    <div class="card red lighten-5">
                                        <div class="card-content notif">
                                            <span class="card-title red-text"><i class="material-icons md-36">clear</i> '.$errQ.'</span>
                                        </div>
                                    </div>
                                </div>
                            </div>';
                        unset($_SESSION['errQ']);
                    }
                ?>

                <!-- Row form Start -->
                <div class="row jarak-form">

                    <!-- Form START -->
                    <form class="col s12" method="post" action="">

                        <!-- Row in form START -->
                        <div class="row">

                            <div class="input-field col s6">
                                <i class="material-icons prefix md-prefix">low_priority</i><label style="margin-top:-8px">Penyakit Penyerta</label><br/>
                                <?php
                                    $penyakit = explode(',', $row['penyakit']);
                                    $query = mysqli_query($config, "SELECT * FROM tbl_kategori WHERE id_katego IN ('1', '2', '3', '4', '5', '6', '7', '8', '9', '10')");

                                    if(mysqli_num_rows($query) > 0){
                                        $i = 0;
                                        while($data = mysqli_fetch_array($query)){
                                        $i++;
                                    ?>
                                        <input type="checkbox" id="penyakit<?php echo $i; ?>" class="validate" name="penyakit[]" value="<?php echo $data['nama_katego']; ?>"
                                        <?php if (in_array($data['nama_katego'], $penyakit)) echo "checked";?>
                                        >

                                        <label for="penyakit<?php echo $i; ?>"><?php echo $data['nama_katego']; ?></label><br>
                                <?php
                                        }
                                    }
                                 ?>
                            </div>
                            <div class="input-field col s6">
                                <i class="material-icons prefix md-prefix">low_priority</i><label style="margin-top:-8px">Narkoba Yang Digunakan Pertama Kali</label><br/>
                                <?php
                                    $jenis_zat = explode(',', $row['jenis_zat']);
                                    $query = mysqli_query($config, "SELECT * FROM tbl_kategori WHERE id_katego IN ('20','21','22','23','24','25','26','27','28','29','30','31')");

                                    if(mysqli_num_rows($query) > 0){
                                        $i = 0;
                                        while($data = mysqli_fetch_array($query)){
                                        $i++;
                                    ?>
                                        <input type="checkbox" id="jenis_zat<?php echo $i; ?>" class="validate" name="jenis_zat[]" value="<?php echo $data['nama_katego']; ?>"
                                        <?php if (in_array($data['nama_katego'], $jenis_zat)) echo "checked";?>
                                        >

                                        <label for="jenis_zat<?php echo $i; ?>"><?php echo $data['nama_katego']; ?></label><br>
                                <?php
                                        }
                                    }
                                 ?>
                            </div>
                            <div class="input-field col s6">
                                <i class="material-icons prefix md-prefix">low_priority</i><label style="margin-top:-8px">Narkoba Yang Digunakan 1 Tahun Terakhir</label><br/>
                                <?php
                                    $jenis_zat_akhir = explode(',', $row['jenis_zat_akhir']);
                                    $query = mysqli_query($config, "SELECT * FROM tbl_kategori WHERE id_katego IN ('20','21','22','23','24','25','26','27','28','29','30','31')");

                                    if(mysqli_num_rows($query) > 0){
                                        $i = 0;
                                        while($data = mysqli_fetch_array($query)){
                                        $i++;
                                    ?>
                                        <input type="checkbox" id="jenis_zat_akhir<?php echo $i; ?>" class="validate" name="jenis_zat_akhir[]" value="<?php echo $data['nama_katego']; ?>"
                                        <?php if (in_array($data['nama_katego'], $jenis_zat_akhir)) echo "checked";?>
                                        >

                                        <label for="jenis_zat_akhir<?php echo $i; ?>"><?php echo $data['nama_katego']; ?></label><br>
                                <?php
                                        }
                                    }
                                 ?>
                            </div>
                            <div class="input-field col s6">
                            <i class="material-icons prefix md-prefix">assignment_ind</i>
                            <input id="pendidikan" type="text" class="validate" name="pendidikan" value="<?php echo $row['pendidikan']; ?>" required>
                                <?php
                                    if(isset($_SESSION['ependidikan'])){
                                        $ependidikan = $_SESSION['ependidikan'];
                                        echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$ependidikan.'</div>';
                                        unset($_SESSION['ependidikan']);
                                    }
                                ?>
                            <label for="pendidikan">Pendidikan Terakhir</label>
                        </div>
                        <div class="input-field col s6">
                            <i class="material-icons prefix md-prefix">assignment_ind</i>
                            <input id="usia_pakai" type="text" class="validate" name="usia_pakai" value="<?php echo $row['usia_pakai']; ?>" required>
                                <?php
                                    if(isset($_SESSION['ependidikan'])){
                                        $ependidikan = $_SESSION['ependidikan'];
                                        echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$ependidikan.'</div>';
                                        unset($_SESSION['ependidikan']);
                                    }
                                ?>
                            <label for="usia_pakai">Usia Mulai Menggunakan Narkoba</label>
                        </div>
                            <div class="input-field col s6">
                                <i class="material-icons prefix md-prefix">low_priority</i><label>Level Candu</label>
                                <div class="input-field col s11 right">
                                    <select class="browser validate" name="level_candu" id="level_candu" required>
                                        <option value="<?php echo $row['level_candu']; ?>"><?php echo $row['level_candu']; ?></option>
                                        <option value="Ringan">Ringan</option>
                                        <option value="Sedang">Sedang</option>
                                        <option value="Berat">Berat</option>
                                    </select>
                                </div>
                                <?php
                                    if(isset($_SESSION['level_candu'])){
                                        $level_candu = $_SESSION['level_candu'];
                                        echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$level_candu.'</div>';
                                        unset($_SESSION['level_candu']);
                                    }
                                ?>
                            </div>
                            <div class="input-field col s6">
                                <i class="material-icons prefix md-prefix">description</i>
                                <textarea id="isi_scrining" class="materialize-textarea validate" name="isi_scrining" required><?php echo $row['isi_scrining'] ;?></textarea>
                                    <?php
                                        if(isset($_SESSION['isi_scrining'])){
                                            $isi_scrining = $_SESSION['isi_scrining'];
                                            echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$isi_scrining.'</div>';
                                            unset($_SESSION['isi_scrining']);
                                        }
                                    ?>
                                <label for="isi_scrining">isi Scrining</label>
                            </div>
                        <!-- Row in form END -->

                        <div class="row">
                            <div class="col 6">
                                <button type="submit" name ="submit" class="btn-large blue waves-effect waves-light">SUBMIT <i class="material-icons">done</i></button>
                            </div>
                            <div class="col 6">
                                <a href="?page=tsm&act=scr&id_surat=<?php echo $row['id_surat']; ?>" class="btn-large deep-orange waves-effect waves-light">BATAL <i class="material-icons">clear</i></a>
                            </div>
                        </div>

                    </form>
                    <!-- Form END -->

                </div>
                <!-- Row form END -->

<?php
                }
            }
        }
    }
?>
