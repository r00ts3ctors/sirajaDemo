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
            if($_REQUEST['isi_jad_kelompok'] == "" 
                || $_REQUEST['jam_acara_kelompok'] == "" 
                || $_REQUEST['batas_waktu'] == ""){
                $_SESSION['errEmpty'] = 'ERROR! Semua form wajib diisi';
                echo '<script language="javascript">window.history.back();</script>';
            } else {

                $isi_jad_kelompok = $_REQUEST['isi_jad_kelompok'];
                $jam_acara_kelompok = $_REQUEST['jam_acara_kelompok'];
                $batas_waktu = $_REQUEST['batas_waktu'];
                $id_user = $_SESSION['id_user'];

                //validasi input data

                    if(!preg_match("/^[a-zA-Z0-9.,_()%&@\/\r\n -]*$/", $isi_jad_kelompok)){
                        $_SESSION['isi_jad_kelompok'] = 'Form Keterangan hanya boleh mengandung karakter huruf, angka, spasi, titik(.), koma(,), minus(-), garis miring(/), dan(&), underscore(_), kurung(), persen(%) dan at(@)';
                        echo '<script language="javascript">window.history.back();</script>';
                    } else {

                        if(!preg_match("/^[0-9 -]*$/", $batas_waktu)){
                            $_SESSION['batas_waktu'] = 'Form Tanggal hanya boleh mengandung karakter huruf dan minus(-)<br/>';
                            echo '<script language="javascript">window.history.back();</script>';
                        } else {

                                if(!preg_match("/^[a-zA-Z0-9.:,_()%&@\/\r\n -]*$/", $jam_acara_kelompok)){
                                    $_SESSION['jam_acara_kelompok'] = 'Form Jam hanya boleh mengandung karakter angka, huruf dan spasi atau yang dipilih';
                                    echo '<script language="javascript">window.history.back();</script>';
                                } else {

                                    $query = mysqli_query($config, "INSERT INTO tbl_jdl_kon_kelompok(isi_jad_kelompok,jam_acara_kelompok,batas_waktu,id_surat,id_user)
                                        VALUES('$isi_jad_kelompok','$jam_acara_kelompok','$batas_waktu','$id_surat','$id_user')");

                                    if($query == true){
                                        $_SESSION['succAdd'] = 'SUKSES! Data Jadwal Konseling Keluarga berhasil ditambahkan';
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
        } else {?>

            <!-- Row Start -->
            <div class="row">
                <!-- Secondary Nav START -->
                <div class="col s12">
                    <nav class="secondary-nav">
                        <div class="nav-wrapper blue-grey darken-1">
                            <ul class="left">
                                <li class="waves-effect waves-light"><a href="#" class="judul"><i class="material-icons">update</i> Tambah Jadwal Konseling Kelompok</a></li>
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
                            <i class="material-icons prefix md-prefix">alarm</i><label>Pilih Jam</label>
                            <div class="input-field col s11 right">
                                <select class="validate" name="jam_acara_kelompok" id="jam_acara_kelompok" required>
                                    <option value="08:00 Wib">08:00 Wib</option>
                                    <option value="08:30 Wib">08:30 Wib</option>
                                    <option value="09:00 Wib">09:00 Wib</option>
                                    <option value="09:30 Wib">09:30 Wib</option>
                                    <option value="10:00 Wib">10:00 Wib</option>
                                    <option value="10:30 Wib">10:30 Wib</option>
                                    <option value="11:00 Wib">11:00 Wib</option>
                                    <option value="11:30 Wib">11:30 Wib</option>
                                    <option value="12:00 Wib">12:00 Wib</option>
                                    <option value="12:30 Wib">12:30 Wib</option>

                                    <option value="13:00 Wib">13:00 Wib</option>
                                    <option value="13:30 Wib">13:30 Wib</option>
                                    <option value="14:00 Wib">14:00 Wib</option>
                                    <option value="14:30 Wib">14:30 Wib</option>
                                    <option value="15:00 Wib">15:00 Wib</option>
                                    <option value="15:30 Wib">15:30 Wib</option>
                                    <option value="16:00 Wib">16:00 Wib</option>
                                    <option value="16:30 Wib">16:30 Wib</option>
                                </select>
                            </div>
                            <?php
                                if(isset($_SESSION['jam_acara_kelompok'])){
                                    $jam_acara_kelompok = $_SESSION['jam_acara_kelompok'];
                                    echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$jam_acara_kelompok.'</div>';
                                    unset($_SESSION['jam_acara_kelompok']);
                                }
                            ?>
                        </div>
                        <div class="input-field col s6">
                            <i class="material-icons prefix md-prefix">low_priority</i>
                            <input id="batas_waktu" type="text" name="batas_waktu" class="datepicker" required>
                                <?php
                                    if(isset($_SESSION['batas_waktu'])){
                                        $batas_waktu = $_SESSION['batas_waktu'];
                                        echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$batas_waktu.'</div>';
                                        unset($_SESSION['batas_waktu']);
                                    }
                                ?>
                            <label for="batas_waktu">Tanggal Bertemu</label>
                        </div>
                        
                        <div class="input-field col s12">
                            <i class="material-icons prefix md-prefix">description</i>
                            <textarea id="isi_jad_kelompok" class="materialize-textarea validate" name="isi_jad_kelompok" required></textarea>
                                <?php
                                    if(isset($_SESSION['isi_jad_kelompok'])){
                                        $isi_jad_kelompok = $_SESSION['isi_jad_kelompok'];
                                        echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$isi_jad_kelompok.'</div>';
                                        unset($_SESSION['isi_jad_kelompok']);
                                    }
                                ?>
                            <label for="isi_jad_kelompok">Keterangan</label>
                        </div>

                    </div>
                    <!-- Row in form END -->

                    <div class="row">
                        <div class="col 6">
                            <button type="submit" name ="submit" class="btn-large blue waves-effect waves-light">SUBMIT <i class="material-icons">done</i></button>
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
