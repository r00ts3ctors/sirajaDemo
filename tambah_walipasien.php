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
            $no = 1;
            list($id_surat) = mysqli_fetch_array($query);

            //validasi form kosong
            if($_REQUEST['nama_wali'] == "" 
                || $_REQUEST['hubungan'] == "" 
                || $_REQUEST['no_telp'] == "" 
                || $_REQUEST['tempat_lahir_wali'] == ""
                || $_REQUEST['batas_waktu'] == ""
                || $_REQUEST['pekerjaan_wali'] == ""
                || $_REQUEST['nik'] == ""
                || $_REQUEST['alamat_wali'] == ""){
                $_SESSION['errEmpty'] = 'ERROR! Semua form wajib diisi';
                echo '<script language="javascript">window.history.back();</script>';
            } else {

                $nama_wali = $_REQUEST['nama_wali'];
                $hubungan = $_REQUEST['hubungan'];
                $no_telp = $_REQUEST['no_telp'];
                $tempat_lahir_wali = $_REQUEST['tempat_lahir_wali'];
                $batas_waktu = $_REQUEST['batas_waktu'];
                $pekerjaan_wali = $_REQUEST['pekerjaan_wali'];
                $nik = $_REQUEST['nik'];
                $alamat_wali = $_REQUEST['alamat_wali'];
                $id_user = $_SESSION['id_user'];

                //validasi input data
                if(!preg_match("/^[a-zA-Z0-9.,()\/ -]*$/", $nama_wali)){
                    $_SESSION['nama_wali'] = 'Form Nama Wali hanya boleh mengandung karakter huruf, angka, spasi, titik(.), koma(,) minus(-). kurung() dan garis miring(/)';
                    echo '<script language="javascript">window.history.back();</script>';
                } else {

                    if(!preg_match("/^[a-zA-Z0-9.,_()%&@\/\r\n -]*$/", $hubungan)){
                        $_SESSION['hubungan'] = 'Form Hubungan hanya boleh mengandung karakter huruf, angka, spasi, titik(.), koma(,), minus(-), garis miring(/), dan(&), underscore(_), kurung(), persen(%) dan at(@)';
                        echo '<script language="javascript">window.history.back();</script>';
                    } else {
                        if(!preg_match("/^[a-zA-Z0-9.,()%@\/ -]*$/", $tempat_lahir_wali)){
                                $_SESSION['tempat_lahir_wali'] = 'Form Tempat Lahir hanya boleh mengandung karakter huruf, angka, spasi, titik(.), koma(,), minus(-) garis miring(/), dan kurung()';
                                echo '<script language="javascript">window.history.back();</script>';
                            } else {

                        if(!preg_match("/^[0-9 -]*$/", $batas_waktu)){
                            $_SESSION['batas_waktu'] = 'Form Batas Waktu hanya boleh mengandung karakter huruf dan minus(-)<br/>';
                            echo '<script language="javascript">window.history.back();</script>';
                        } else {

                            if(!preg_match("/^[a-zA-Z0-9.,()%@\/ -]*$/", $alamat_wali)){
                                $_SESSION['alamat_wali'] = 'Form alamat wali hanya boleh mengandung karakter huruf, angka, spasi, titik(.), koma(,), minus(-) garis miring(/), dan kurung()';
                                echo '<script language="javascript">window.history.back();</script>';
                            } else {

                                if(!preg_match("/^[a-zA-Z0-9.,()%@\/ -]*$/", $no_telp)){
                                    $_SESSION['no_telp'] = 'Form Nomor Hp hanya boleh mengandung karakter angka dan spasi';
                                    echo '<script language="javascript">window.history.back();</script>';
                                } else {

                                    $query = mysqli_query($config, "INSERT INTO tbl_wali_Klien(nama_wali,no_telp,hubungan,tempat_lahir_wali,batas_waktu,pekerjaan_wali,alamat_wali,nik,id_surat,id_user)
                                        VALUES('$nama_wali','$no_telp','$hubungan','$tempat_lahir_wali','$batas_waktu','$pekerjaan_wali','$nik','$alamat_wali','$id_surat','$id_user')");

                                    if($query == true){
                                        $_SESSION['succAdd'] = 'SUKSES! Data berhasil ditambahkan ke sistem';
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
        } else {?>

            <!-- Row Start -->
            <div class="row">
                <!-- Secondary Nav START -->
                <div class="col s12">
                    <nav class="secondary-nav">
                        <div class="nav-wrapper blue-grey darken-1">
                            <ul class="left">
                                <li class="waves-effect waves-light"><a href="#" class="judul"><i class="material-icons">description</i> Tambah Wali Klien</a></li>
                            </ul>
                        </div>
                    </nav>
                </div>
                <!-- Secondary Nav END -->
            </div>
            <!-- Row END -->

            <?php
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
            ?>

            <!-- Row form Start -->
            <div class="row jarak-form">

                <!-- Form START -->
                <form class="col s12" method="post" action="">

                    <!-- Row in form START -->
                    <div class="row">
                        <div class="input-field col s6">
                            <i class="material-icons prefix md-prefix">assignment_ind</i>
                            <input id="nama_wali" type="text" class="validate" name="nama_wali" required>
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
                            <input id="tempat_lahir_wali" type="text" class="validate" name="tempat_lahir_wali" required>
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
                            <i class="material-icons prefix md-prefix">pin_drop</i>
                            <input id="no_telp" type="text" class="validate" name="no_telp" required>
                                <?php
                                    if(isset($_SESSION['no_telp'])){
                                        $no_telp = $_SESSION['no_telp'];
                                        echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$no_telp.'</div>';
                                        unset($_SESSION['no_telp']);
                                    }
                                ?>
                            <label for="no_telp">Nomor Hp</label>
                        </div>

                        <div class="input-field col s6">
                            <i class="material-icons prefix md-prefix">alarm</i>
                            <input id="batas_waktu" type="text" name="batas_waktu" class="datepicker" required>
                                <?php
                                    if(isset($_SESSION['batas_waktu'])){
                                        $batas_waktu = $_SESSION['batas_waktu'];
                                        echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$batas_waktu.'</div>';
                                        unset($_SESSION['batas_waktu']);
                                    }
                                ?>
                            <label for="batas_waktu">Tanggal Lahir</label>
                        </div>
                        <div class="input-field col s6">
                            <i class="material-icons prefix md-prefix">pin_drop</i>
                            <input id="pekerjaan_wali" type="text" class="validate" name="pekerjaan_wali" required>
                                <?php
                                    if(isset($_SESSION['pekerjaan_wali'])){
                                        $pekerjaan_wali = $_SESSION['pekerjaan_wali'];
                                        echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$pekerjaan_wali.'</div>';
                                        unset($_SESSION['pekerjaan_wali']);
                                    }
                                ?>
                            <label for="pekerjaan_wali">pekerjaan Wali</label>
                        </div>
                        <div class="input-field col s6">
                            <i class="material-icons prefix md-prefix">filter_2</i>
                            <input id="nik" type="text" class="validate" name="nik" required>
                                <?php
                                    if(isset($_SESSION['nik'])){
                                        $nik = $_SESSION['nik'];
                                        echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$nik.'</div>';
                                        unset($_SESSION['nik']);
                                    }
                                ?>
                            <label for="nik">NIK</label>
                        </div>
                        <div class="input-field col s6">
                            <i class="material-icons prefix md-prefix">pin_drop</i>
                            <input id="alamat_wali" type="text" class="validate" name="alamat_wali" required>
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
                            <i class="material-icons prefix md-prefix">streetview</i><label>Pilih Status Hubungan :</label><br/>
                            <div class="input-field col s11 right">
                                <select class="validate" name="hubungan" id="hubungan" required>
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
                    </div>
                    <!-- Row in form END -->

                    <div class="row">
                        <div class="col 6">
                            <button type="submit" name ="submit" class="btn-large blue waves-effect waves-light">SIMPAN <i class="material-icons">done</i></button>
                        </div>
                        <div class="col 6">
                            <button type="reset" onclick="window.history.back();" class="btn-large deep-orange waves-effect waves-light">BATAL <i class="material-icons">clear</i></button>
                        </div>
                    </div>

                </form>
                <!-- Form END -->

            </div>
            <!-- Row form END -->

<?php
        }
    }
?>
