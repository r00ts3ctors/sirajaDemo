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
            if($_REQUEST['nama_wali'] == "" 
                || $_REQUEST['alamat_wali'] == "" 
                || $_REQUEST['hubungan'] == "" 
                || $_REQUEST['pekerjaan_wali'] == ""
                || $_REQUEST['tempat_lahir_wali'] == ""
                || $_REQUEST['nik'] == ""
                || $_REQUEST['batas_waktu'] == ""
                || $_REQUEST['no_telp'] == ""){
                $_SESSION['errEmpty'] = 'ERROR! Semua form wajib diisi';
                echo '<script language="javascript">window.history.back();</script>';
            } else {
 
                $id_wali = $_REQUEST['id_wali'];
                $nama_wali = $_REQUEST['nama_wali'];
                $alamat_wali = $_REQUEST['alamat_wali'];
                $hubungan = $_REQUEST['hubungan'];
                $pekerjaan_wali = $_REQUEST['pekerjaan_wali'];
                $tempat_lahir_wali = $_REQUEST['tempat_lahir_wali'];
                $nik = $_REQUEST['nik'];
                $batas_waktu = $_REQUEST['batas_waktu'];
                $no_telp = $_REQUEST['no_telp'];
                $id_user = $_SESSION['id_user'];

                //validasi input data
                if(!preg_match("/^[a-zA-Z0-9.,()\/ -]*$/", $nama_wali)){
                    $_SESSION['nama_wali'] = 'Form Nama Wali hanya boleh mengandung karakter huruf, angka, spasi, titik(.), koma(,) minus(-). kurung() dan garis miring(/)';
                    echo '<script language="javascript">window.history.back();</script>';
                } else {

                    if(!preg_match("/^[a-zA-Z0-9.,_()%&@\/\r\n -]*$/", $alamat_wali)){
                        $_SESSION['alamat_wali'] = 'Form Alamat Wali hanya boleh mengandung karakter huruf, angka, spasi, titik(.), koma(,), minus(-), garis miring(/), dan(&), underscore(_), kurung(), persen(%) dan at(@)';
                        echo '<script language="javascript">window.history.back();</script>';
                    } else {

                        if(!preg_match("/^[0-9 -]*$/", $batas_waktu)){
                            $_SESSION['batas_waktu'] = 'Form Tanggal Lahir hanya boleh mengandung karakter huruf dan minus(-)';
                            echo '<script language="javascript">window.history.back();</script>';
                        } else {

                            if(!preg_match("/^[0-9 -]*$/", $no_telp)){
                                $_SESSION['no_telp'] = 'Form no telp hanya boleh mengandung karakter angka, minus(-)';
                                echo '<script language="javascript">window.history.back();</script>';
                            } else {

                                if(!preg_match("/^[a-zA-Z0-9.,()%@\/ -]*$/", $hubungan)){
                                    $_SESSION['hubungan'] = 'Form Hunungan hanya boleh mengandung karakter huruf dan spasi';
                                    echo '<script language="javascript">window.history.back();</script>';
                                } else {
                                    if(!preg_match("/^[a-zA-Z0-9.,()%@\/ -]*$/", $tempat_lahir_wali)){
                                    $_SESSION['tempat_lahir_wali'] = 'Form Tempat Lahir hanya boleh mengandung karakter huruf dan spasi';
                                    echo '<script language="javascript">window.history.back();</script>';
                                } else {
                                    if(!preg_match("/^[a-zA-Z0-9.,()%@\/ -]*$/", $pekerjaan_wali)){
                                    $_SESSION['pekerjaan_wali'] = 'Form Pekerjaan hanya boleh mengandung karakter huruf dan spasi';
                                    echo '<script language="javascript">window.history.back();</script>';
                                } else {
                                    if(!preg_match("/^[0-9 -]*$/", $nik)){
                                    $_SESSION['nik'] = 'Form NIK hanya boleh mengandung karakter huruf dan spasi';
                                    echo '<script language="javascript">window.history.back();</script>';
                                } else {

                                    $query = mysqli_query($config, "UPDATE tbl_wali_Klien SET nama_wali='$nama_wali', alamat_wali='$alamat_wali', hubungan='$hubungan', tempat_lahir_wali='$tempat_lahir_wali', pekerjaan_wali='$pekerjaan_wali', nik='$nik', batas_waktu='$batas_waktu', no_telp='$no_telp', id_surat='$id_surat', id_user='$id_user' WHERE id_wali='$id_wali'");

                                    if($query == true){
                                        $_SESSION['succEdit'] = 'SUKSES! Data berhasil diupdate';
                                        echo '<script language="javascript">
                                                window.location.href="./admin.php?page=tsm&act=wp&id_surat='.$id_surat.'";
                                              </script>';
                                    } else {
                                        $_SESSION['errQ'] = 'ERROR! Ada masalah dengan query';
                                        echo '<script language="javascript">window.history.back();</script>';
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        }
        }
        } else {

            $id_wali = mysqli_real_escape_string($config, $_REQUEST['id_wali']);
            $query = mysqli_query($config, "SELECT * FROM tbl_wali_Klien WHERE id_wali='$id_wali'");
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
                                    <li class="waves-effect waves-light"><a href="#" class="judul"><i class="material-icons">edit</i> Edit Wali Klien</a></li>
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
                                <input type="hidden" value="<?php echo $row['id_wali'] ;?>">
                                <i class="material-icons prefix md-prefix">account_box</i>
                                <input id="nama_wali" type="text" class="validate" name="nama_wali" value="<?php echo $row['nama_wali'] ;?>" required>
                                    <?php
                                        if(isset($_SESSION['nama_wali'])){
                                            $nama_wali = $_SESSION['nama_wali'];
                                            echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$nama_wali.'</div>';
                                            unset($_SESSION['nama_wali']);
                                        }
                                    ?>
                                <label for="nama_wali">Nama Wali</label>
                            </div>
                            <div class="input-field col s6">
                                <i class="material-icons prefix md-prefix">add_location</i>
                                <input id="tempat_lahir_wali" type="text" class="validate" name="tempat_lahir_wali" value="<?php echo $row['tempat_lahir_wali'] ;?>" required>
                                    <?php
                                        if(isset($_SESSION['tempat_lahir_wali'])){
                                            $tempat_lahir_wali = $_SESSION['tempat_lahir_wali'];
                                            echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$tempat_lahir_wali.'</div>';
                                            unset($_SESSION['tempat_lahir_wali']);
                                        }
                                    ?>
                                <label for="tempat_lahir_wali">Tempat Lahir</label>
                            </div>
                            <div class="input-field col s6">
                                <i class="material-icons prefix md-prefix">alarm</i>
                                <input id="batas_waktu" type="text" name="batas_waktu" class="datepicker" value="<?php echo $row['batas_waktu']; ?>"required>
                                    <?php
                                        if(isset($_SESSION['batas_waktu'])){
                                            $batas_waktu = $_SESSION['batas_waktu'];
                                            echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$batas_waktu.'</div>';
                                            unset($_SESSION['batas_waktu']);
                                        }
                                    ?>
                                <label for="batas_waktu">Batas Waktu</label>
                            </div>
                            <div class="input-field col s6">
                                <i class="material-icons prefix md-prefix">description</i>
                                <textarea id="alamat_wali" class="materialize-textarea validate" name="alamat_wali" required><?php echo $row['alamat_wali'] ;?></textarea>
                                    <?php
                                        if(isset($_SESSION['alamat_wali'])){
                                            $alamat_wali = $_SESSION['alamat_wali'];
                                            echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$alamat_wali.'</div>';
                                            unset($_SESSION['alamat_wali']);
                                        }
                                    ?>
                                <label for="alamat_wali">Alamat Wali</label>
                            </div>
                            <div class="input-field col s6">
                                <i class="material-icons prefix md-prefix">featured_play_list   </i>
                                <input id="no_telp" type="text" class="validate" name="no_telp" value="<?php echo $row['no_telp'] ;?>" required>
                                    <?php
                                        if(isset($_SESSION['no_telp'])){
                                            $no_telp = $_SESSION['no_telp'];
                                            echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$no_telp.'</div>';
                                            unset($_SESSION['no_telp']);
                                        }
                                    ?>
                                <label for="no_telp">NO HP</label>
                            </div>
                            <div class="input-field col s6">
                                <i class="material-icons prefix md-prefix">filter_2</i>
                                <input id="nik" type="text" class="validate" name="nik" value="<?php echo $row['nik'] ;?>" required>
                                    <?php
                                        if(isset($_SESSION['nik'])){
                                            $nik = $_SESSION['nik'];
                                            echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$nik.'</div>';
                                            unset($_SESSION['nik']);
                                        }
                                    ?>
                                <label for="nik">Nik </label>
                            </div><div class="input-field col s6">
                                <i class="material-icons prefix md-prefix">filter_3</i>
                                <input id="pekerjaan_wali" type="text" class="validate" name="pekerjaan_wali" value="<?php echo $row['pekerjaan_wali'] ;?>" required>
                                    <?php
                                        if(isset($_SESSION['pekerjaan_wali'])){
                                            $pekerjaan_wali = $_SESSION['pekerjaan_wali'];
                                            echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$pekerjaan_wali.'</div>';
                                            unset($_SESSION['pekerjaan_wali']);
                                        }
                                    ?>
                                <label for="pekerjaan_wali">Pekerjaan Wali</label>
                            </div>
                            <div class="input-field col s6">
                                <i class="material-icons prefix md-prefix">low_priority</i><label>Pilih Hubungan Kekeluargaan</label>
                                <div class="input-field col s11 right">
                                    <select class="browser-default validate" name="hubungan" id="hubungan" required>
                                        <option value="<?php echo $row['hubungan']; ?>"><?php echo $row['hubungan']; ?></option>
                                        <option value="Ayah">Ayah</option>
                                        <option value="Ibu">Ibu</option>
                                        <option value="Abang Kandung">Abang Kandung</option>
                                        <option value="Adik Kandung">Adik Kandung</option>
                                        <option value="Sepupu">Sepupu</option>
                                        <option value="Om/Tante">Om/Tante</option>
                                        <option value="Suami/Istri">Suami/Istri</option>
                                        <option value="Hubungan Lain">Hubungan Lain</option>
                                    </select>
                            </div>
                                <?php
                                    if(isset($_SESSION['hubungan'])){
                                        $hubungan = $_SESSION['hubungan'];
                                        echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$hubungan.'</div>';
                                        unset($_SESSION['hubungan']);
                                    }
                                ?>
                        </div>
                        <!-- Row in form END -->

                        <div class="row">
                            <div class="col 6">
                                <button type="submit" name ="submit" class="btn-large blue waves-effect waves-light">SUBMIT <i class="material-icons">done</i></button>
                            </div>
                            <div class="col 6">
                                <a href="?page=tsm&act=wp&id_surat=<?php echo $row['id_surat']; ?>" class="btn-large deep-orange waves-effect waves-light">BATAL <i class="material-icons">clear</i></a>
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
