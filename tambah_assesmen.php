<?php 
    //cek session
    if(empty($_SESSION['admin'])){
        $_SESSION['err'] = '<center>Anda harus login terlebih dahulu!</center>';
        header("Location: ./");
        die();
    } else {
        if(isset($_REQUEST['submit'])){

            $id_disposisi = $_REQUEST['id_disposisi'];
            
            $query = mysqli_query($config, "SELECT * FROM tbl_disposisi WHERE id_disposisi='$id_disposisi'");

            $no = 1;
            list($id_disposisi) = mysqli_fetch_array($query);

            //validasi form kosong
            if($_REQUEST['resume_masalah'] == "" 
                || empty($_REQUEST['pekerjaan_dukungan']) 
                || empty($_REQUEST['napza']) 
                || empty($_REQUEST['legal'])
                || empty($_REQUEST['keluarga_sosial'])
                || empty($_REQUEST['psikiatris'])
                || $_REQUEST['kriteria_diagnosis_napza'] == ""
                || $_REQUEST['diagnosis_lainnya'] == "" 
                || empty($_REQUEST['rencana_terapi'])
                || empty($_REQUEST['medis'])){
                $_SESSION['errEmpty'] = 'ERROR! Semua form wajib diisi';
                echo '<script language="javascript">window.history.back();</script>';
            } else {

                $pekerjaan_dukungan = implode(',', $_REQUEST['pekerjaan_dukungan']);
                $resume_masalah = $_REQUEST['resume_masalah']; 
                $napza = implode(',', $_REQUEST['napza']); 
                $legal = implode(',', $_REQUEST['legal']);
                $keluarga_sosial = implode(',', $_REQUEST['keluarga_sosial']); 
                $psikiatris = implode(',', $_REQUEST['psikiatris']);
                $kriteria_diagnosis_napza = $_REQUEST['kriteria_diagnosis_napza'];
                $diagnosis_lainnya = $_REQUEST['diagnosis_lainnya'];
                $rencana_terapi = implode(',', $_REQUEST['rencana_terapi']);
                $medis = implode(',', $_REQUEST['medis']); 
                $id_user = $_SESSION['id_user'];

                //validasi input data
                if(!preg_match("/^[a-zA-Z0-9.,()\/ -]*$/", $pekerjaan_dukungan)){
                    $_SESSION['pekerjaan_dukungan'] = 'Form Pekerjaan dukungan Assesmen hanya boleh mengandung karakter huruf, angka, spasi, titik(.), koma(,) minus(-). kurung() dan garis miring(/)';
                    echo '<script language="javascript">window.history.back();</script>';
                } else {

                    if(!preg_match("/^[a-zA-Z0-9.,_()%&@\/\r\n -]*$/", $resume_masalah)){
                        $_SESSION['resume_masalah'] = 'Form resume masalah hanya boleh mengandung karakter huruf, angka, spasi, titik(.), koma(,), minus(-), garis miring(/), dan(&), underscore(_), kurung(), persen(%) dan at(@)';
                        echo '<script language="javascript">window.history.back();</script>';
                    } else {
                            if(!preg_match("/^[a-zA-Z0-9.,_()%&@\/\r\n -]*$/", $medis)){
                                $_SESSION['medis'] = 'Form Medis hanya boleh mengandung karakter huruf dan spasi';
                                echo '<script language="javascript">window.history.back();</script>';
                            } else {
                                if(!preg_match("/^[a-zA-Z0-9.,_()%&@\/\r\n -]*$/", $napza)){
                                $_SESSION['napza'] = 'Form Napza hanya boleh mengandung karakter huruf dan spasi';
                                echo '<script language="javascript">window.history.back();</script>';
                            } else {
                                if(!preg_match("/^[a-zA-Z0-9.,_()%&@\/\r\n -]*$/", $legal)){
                                $_SESSION['legal'] = 'Form legal hanya boleh mengandung karakter huruf dan spasi';
                                echo '<script language="javascript">window.history.back();</script>';
                            } else {
                                if(!preg_match("/^[a-zA-Z0-9.,_()%&@\/\r\n -]*$/", $keluarga_sosial)){
                                $_SESSION['keluarga_sosial'] = 'Form keluarga sosial hanya boleh mengandung karakter huruf dan spasi';
                                echo '<script language="javascript">window.history.back();</script>';
                            } else {
                                if(!preg_match("/^[a-zA-Z0-9.,_()%&@\/\r\n -]*$/", $psikiatris)){
                                $_SESSION['psikiatris'] = 'Form psikiatris hanya boleh mengandung karakter huruf dan spasi';
                                echo '<script language="javascript">window.history.back();</script>';
                            } else {
                                if(!preg_match("/^[a-zA-Z0-9.,_()%&@\/\r\n -]*$/", $kriteria_diagnosis_napza)){
                                $_SESSION['kriteria_diagnosis_napza'] = 'Form kriteria diagnosis napza hanya boleh mengandung karakter huruf dan spasi';
                                echo '<script language="javascript">window.history.back();</script>';
                            } else {
                                if(!preg_match("/^[a-zA-Z0-9.,_()%&@\/\r\n -]*$/", $diagnosis_lainnya)){
                                $_SESSION['diagnosis_lainnya'] = 'Form diagnosis lainnya hanya boleh mengandung karakter huruf dan spasi';
                                echo '<script language="javascript">window.history.back();</script>';
                            } else {
                                if(!preg_match("/^[a-zA-Z0-9.,_()%&@\/\r\n -]*$/", $rencana_terapi)){
                                $_SESSION['rencana_terapi'] = 'Form rencana terapi hanya boleh mengandung karakter huruf dan spasi';
                                echo '<script language="javascript">window.history.back();</script>';
                            } else {

                                    $query = mysqli_query($config, "INSERT INTO tbl_asesmen(pekerjaan_dukungan,napza,legal,keluarga_sosial,psikiatris,kriteria_diagnosis_napza,diagnosis_lainnya,rencana_terapi,resume_masalah,medis,id_disposisi,id_user)
                                        VALUES('$pekerjaan_dukungan','$napza','$legal','$keluarga_sosial','$psikiatris','$kriteria_diagnosis_napza','$diagnosis_lainnya','$resume_masalah','$rencana_terapi','$medis','$id_disposisi','$id_user')");

                                    if($query == true){
                                        $_SESSION['succAdd'] = 'SUKSES! Data Assessment berhasil ditambahkan';
                                        echo '<script language="javascript">
                                                window.location.href="./admin.php?page=tsm&act=disp&id_disposisi='.$id_disposisi.'&sub=ass&id_disposisi='.$id_disposisi.'";
                                              </script>';
                                    } else {
                                        $_SESSION['errQ'] = 'ERROR! Ada masalah dengan query';
                                        echo '<script language="javascript">window.history.back();</script>';
                            }
                        }
                    }
                }
            }}}}}}}}
        }{?>

            <!-- Row Start -->
            <div class="row">
                <!-- Secondary Nav START -->
                <div class="col s12">
                    <nav class="secondary-nav">
                        <div class="nav-wrapper blue-grey darken-1">
                            <ul class="left">
                                <li class="waves-effect waves-light"><a href="#" class="judul"><i class="material-icons">description</i> Tambah Assesmen</a></li>
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
                        <div class=" col s10">
                            <div class="center">
                            <label class="black-text">MASALAH YANG DIHADAPI (0-9)</label>
                            </div>
                        </div>
                        <div class="input-field col s12">
                            <i class="material-icons prefix md-prefix">low_priority</i><label style="margin-top:-8px">Medis</label><br/>
                            <?php
                                $query = mysqli_query($config, "SELECT * FROM tbl_kategori WHERE id_katego 
                                    IN ('41','42','43','44','45','46','47','48','49','50')");

                                if(mysqli_num_rows($query) > 0){
                                    $i = 0;
                                    while($row = mysqli_fetch_array($query)){
                                    $i++;

                                ?>

                                    <input type="checkbox" id="medis<?php echo $i; ?>" class="validate" name="medis[]" value="<?php echo $row['nama_katego']; ?>">
                                    <label for="medis<?php echo $i; ?>"><?php echo $row['nama_katego']; ?></label>
                            <?php
                                    }
                                }
                             ?>
                        </div>
                        <div class="input-field col s12">
                            <i class="material-icons prefix md-prefix">low_priority</i><label style="margin-top:-8px">Pekerjaan / Dukungan </label><br/>
                            <?php
                                $query = mysqli_query($config, "SELECT * FROM tbl_kategori WHERE id_katego 
                                    IN ('41','42','43','44','45','46','47','48','49','50')");

                                if(mysqli_num_rows($query) > 0){
                                    $i = 0;
                                    while($row = mysqli_fetch_array($query)){
                                    $i++;

                                ?>

                                    <input type="checkbox" id="pekerjaan_dukungan<?php echo $i; ?>" class="validate" name="pekerjaan_dukungan[]" value="<?php echo $row['nama_katego']; ?>">
                                    <label for="pekerjaan_dukungan<?php echo $i; ?>"><?php echo $row['nama_katego']; ?></label>
                            <?php
                                    }
                                }
                             ?>
                        </div>
                        <div class="input-field col s12">
                            <i class="material-icons prefix md-prefix">low_priority</i><label style="margin-top:-8px">Napza</label><br/>
                            <?php
                                $query = mysqli_query($config, "SELECT * FROM tbl_kategori WHERE id_katego 
                                    IN ('41','42','43','44','45','46','47','48','49','50')");

                                if(mysqli_num_rows($query) > 0){
                                    $i = 0;
                                    while($row = mysqli_fetch_array($query)){
                                    $i++;

                                ?>

                                    <input type="checkbox" id="napza<?php echo $i; ?>" class="validate" name="napza[]" value="<?php echo $row['nama_katego']; ?>">
                                    <label for="napza<?php echo $i; ?>"><?php echo $row['nama_katego']; ?></label>
                            <?php
                                    }
                                }
                             ?>
                        </div>
                        <div class="input-field col s12">
                            <i class="material-icons prefix md-prefix">low_priority</i><label style="margin-top:-8px">Legal</label><br/>
                            <?php
                                $query = mysqli_query($config, "SELECT * FROM tbl_kategori WHERE id_katego 
                                    IN ('41','42','43','44','45','46','47','48','49','50')");

                                if(mysqli_num_rows($query) > 0){
                                    $i = 0;
                                    while($row = mysqli_fetch_array($query)){
                                    $i++;

                                ?>

                                    <input type="checkbox" id="legal<?php echo $i; ?>" class="validate" name="legal[]" value="<?php echo $row['nama_katego']; ?>">
                                    <label for="legal<?php echo $i; ?>"><?php echo $row['nama_katego']; ?></label>
                            <?php
                                    }
                                }
                             ?>
                        </div>
                        <div class="input-field col s12">
                            <i class="material-icons prefix md-prefix">low_priority</i><label style="margin-top:-8px">Keluarga / sosial</label><br/>
                            <?php
                                $query = mysqli_query($config, "SELECT * FROM tbl_kategori WHERE id_katego 
                                    IN ('41','42','43','44','45','46','47','48','49','50')");

                                if(mysqli_num_rows($query) > 0){
                                    $i = 0;
                                    while($row = mysqli_fetch_array($query)){
                                    $i++;

                                ?>

                                    <input type="checkbox" id="keluarga_sosial<?php echo $i; ?>" class="validate" name="keluarga_sosial[]" value="<?php echo $row['nama_katego']; ?>">
                                    <label for="keluarga_sosial<?php echo $i; ?>"><?php echo $row['nama_katego']; ?></label>
                            <?php
                                    }
                                }
                             ?>
                        </div>
                        <div class="input-field col s12">
                            <i class="material-icons prefix md-prefix">low_priority</i><label style="margin-top:-8px">Psikiatris</label><br/>
                            <?php
                                $query = mysqli_query($config, "SELECT * FROM tbl_kategori WHERE id_katego 
                                    IN ('41','42','43','44','45','46','47','48','49','50')");

                                if(mysqli_num_rows($query) > 0){
                                    $i = 0;
                                    while($row = mysqli_fetch_array($query)){
                                    $i++;

                                ?>

                                    <input type="checkbox" id="psikiatris<?php echo $i; ?>" class="validate" name="psikiatris[]" value="<?php echo $row['nama_katego']; ?>">
                                    <label for="psikiatris<?php echo $i; ?>"><?php echo $row['nama_katego']; ?></label>
                            <?php
                                    }
                                }
                             ?>

                        </div><br/>
                        <div class="input-field col s5">
                            <i class="material-icons prefix md-prefix">description</i>
                            <input id="kriteria_diagnosis_napza" type="text" class="validate" name="kriteria_diagnosis_napza" required>
                                <?php
                                    if(isset($_SESSION['kriteria_diagnosis_napza'])){
                                        $kriteria_diagnosis_napza = $_SESSION['kriteria_diagnosis_napza'];
                                        echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$kriteria_diagnosis_napza.'</div>';
                                        unset($_SESSION['kriteria_diagnosis_napza']);
                                    }
                                ?>
                            <label for="kriteria_diagnosis_napza">Klien/Klien memenuhi kriteria diagnosis Napza </label>
                        </div>
                        <div class="input-field col s5">
                            <i class="material-icons prefix md-prefix">description</i>
                            <input id="diagnosis_lainnya" type="text" class="validate" name="diagnosis_lainnya" required>
                                <?php
                                    if(isset($_SESSION['diagnosis_lainnya'])){
                                        $diagnosis_lainnya = $_SESSION['diagnosis_lainnya'];
                                        echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$diagnosis_lainnya.'</div>';
                                        unset($_SESSION['diagnosis_lainnya']);
                                    }
                                ?>
                            <label for="diagnosis_lainnya">Diagnosis Lainnya</label>
                        </div>
                        <div class="input-field col s5">
                            <i class="material-icons prefix md-prefix">low_priority</i><label style="margin-top:-8px">Rencana Terapi</label><br/>
                            <?php
                                $query = mysqli_query($config, "SELECT * FROM tbl_kategori WHERE id_katego 
                                    IN ('60','61','62','63','64','65','66','67','68')");

                                if(mysqli_num_rows($query) > 0){
                                    $i = 0;
                                    while($row = mysqli_fetch_array($query)){
                                    $i++;

                                ?>

                                    <input type="checkbox" id="rencana_terapi<?php echo $i; ?>" class="validate" name="rencana_terapi[]" value="<?php echo $row['nama_katego']; ?>">
                                    <label for="rencana_terapi<?php echo $i; ?>"><?php echo $row['nama_katego']; ?></label><br/>
                            <?php
                                    }
                                }
                             ?>
                        </div>
                        <div class="input-field col s6">
                            <i class="material-icons prefix md-prefix">description</i>
                            <textarea id="resume_masalah" class="materialize-textarea validate" name="resume_masalah" required></textarea>
                                <?php
                                    if(isset($_SESSION['resume_masalah'])){
                                        $resume_masalah = $_SESSION['resume_masalah'];
                                        echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$resume_masalah.'</div>';
                                        unset($_SESSION['resume_masalah']);
                                    }
                                ?>
                            <label for="resume_masalah">Resume Masalah</label>
                        </div><br/>
                     
                    <!-- Row in form END -->

                    <div class="row">
                        <div class="col 6">
                            <button type="submit" name ="submit" class="btn-large blue waves-effect waves-light">SUBMIT <i class="material-icons">done</i></button>
                        </div>
                        <div class="col 6">
                            <button type="reset" onclick="window.history.back();" class="btn-large deep-orange waves-effect waves-light">BATAL <i class="material-icons">clear</i></button>
                        </div>
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
