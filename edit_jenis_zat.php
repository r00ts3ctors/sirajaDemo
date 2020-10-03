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

                $nama_zat = $_REQUEST['nama_zat'];
                $tembakau = implode(',', $_REQUEST['tembakau']); 
                $minuman_berakohol = implode(',', $_REQUEST['minuman_berakohol']); 
                $kanabis = implode(',', $_REQUEST['kanabis']); 
                $kokain = implode(',', $_REQUEST['kokain']); 
                $stimulant = implode(',', $_REQUEST['stimulant']); 
                $inhalansia = implode(',', $_REQUEST['inhalansia']); 
                $sedaktiva_obti = implode(',', $_REQUEST['sedaktiva_obti']); 
                $halusinogens = implode(',', $_REQUEST['halusinogens']);
                $opioida = implode(',', $_REQUEST['opioida']); 
                $zat_lain = implode(',', $_REQUEST['zat_lain']); 
                $id_user = $_SESSION['id_user'];

                //validasi input data

                  

                                    $query = mysqli_query($config, "UPDATE tbl_jenis_zat SET 
                                        nama_zat='$nama_zat',
                                        tembakau='$tembakau',
                                        minuman_berakohol='$minuman_berakohol',
                                        kanabis='$kanabis',
                                        kokain='$kokain',
                                        stimulant='$stimulant',
                                        inhalansia='$inhalansia',
                                        sedaktiva_obti='$sedaktiva_obti',
                                        halusinogens='$halusinogens',
                                        opioida='$opioida',
                                        zat_lain='$zat_lain',
                                         
                                        id_surat='$id_surat', 
                                        id_user='$id_user' WHERE id_zat='$id_zat'");

                                    if($query == true){
                                        $_SESSION['succEdit'] = 'SUKSES! Data Scrining berhasil diupdate';
                                        echo '<script language="javascript">
                                                window.location.href="./admin.php?page=tsm&act=scr&id_surat='.$id_surat.'";
                                              </script>';
                                    } else {
                                        $_SESSION['errQ'] = 'ERROR! Ada masalah dengan query';
                                        echo '<script language="javascript">window.history.back();</script>';
                                    }
                                
        } else {

            $id_zat = mysqli_real_escape_string($config, $_REQUEST['id_zat']);
            $query = mysqli_query($config, "SELECT * FROM tbl_jenis_zat WHERE id_zat='$id_zat'");
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
                                    <li class="waves-effect waves-light"><a href="#" class="judul"><i class="material-icons">edit</i> Edit Data Scrining</a></li>
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
                        <table class="bordered" id="tbl">
                        <thead class="blue lighten-4" id="head">
                            <tr>
                                <th width="80%"><center>Jenis Zat</center></th>
                                <th width="20%">Level</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><label style="margin-top:-8px"><br>A. Tembakau (rokok,cerutu,kretek,dll)</label>
                                </td>
                                <td>
                                                    <?php
                                    $tembakau = explode(',', $row['tembakau']);
                                    $query = mysqli_query($config, "SELECT * FROM tbl_kategori WHERE id_katego IN ('70', '71', '72')");
                                    if(mysqli_num_rows($query) > 0){
                                        $i = 0;
                                        while($data = mysqli_fetch_array($query)){
                                        $i++;
                                    ?>
                                        <input type="checkbox" id="tembakau<?php echo $i; ?>" class="validate" name="tembakau[]" value="<?php echo $data['nama_katego']; ?>"
                                        <?php if (in_array($data['nama_katego'], $tembakau)) echo "checked";?>
                                        >
                                        <label for="tembakau<?php echo $i; ?>"><?php echo $data['nama_katego']; ?></label><br>
                                <?php
                                        }
                                    }
                                 ?>
                            </td>
                        </tr>
                    </tbody>
                    <tbody>
                            <tr>
                                <td><label style="margin-top:-8px"><br>B. Minuman berakohol (bir, anggur, sopi, tuak,cap tikus,dll)</label>
                                </td>
                                <td>
                                                    <?php
                                    $minuman_berakohol = explode(',', $row['minuman_berakohol']);
                                    $query = mysqli_query($config, "SELECT * FROM tbl_kategori WHERE id_katego IN ('70', '71', '72')");
                                    if(mysqli_num_rows($query) > 0){
                                        $i = 0;
                                        while($data = mysqli_fetch_array($query)){
                                        $i++;
                                    ?>
                                        <input type="checkbox" id="minuman_berakohol<?php echo $i; ?>" class="validate" name="minuman_berakohol[]" value="<?php echo $data['nama_katego']; ?>"
                                        <?php if (in_array($data['nama_katego'], $minuman_berakohol)) echo "checked";?>
                                        >
                                        <label for="minuman_berakohol<?php echo $i; ?>"><?php echo $data['nama_katego']; ?></label><br>
                                <?php
                                        }
                                    }
                                 ?>
                            </td>
                        </tr>
                    </tbody>
                    <tbody>
                            <tr>
                                <td><label style="margin-top:-8px"><br>C. Kanabis (mariuana,ganja,gelek,cimeng,dll)</label>
                                </td>
                                <td>
                                                    <?php
                                    $kanabis = explode(',', $row['kanabis']);
                                    $query = mysqli_query($config, "SELECT * FROM tbl_kategori WHERE id_katego IN ('70', '71', '72')");
                                    if(mysqli_num_rows($query) > 0){
                                        $i = 0;
                                        while($data = mysqli_fetch_array($query)){
                                        $i++;
                                    ?>
                                        <input type="checkbox" id="kanabis<?php echo $i; ?>" class="validate" name="kanabis[]" value="<?php echo $data['nama_katego']; ?>"
                                        <?php if (in_array($data['nama_katego'], $kanabis)) echo "checked";?>
                                        >
                                        <label for="kanabis<?php echo $i; ?>"><?php echo $data['nama_katego']; ?></label><br>
                                <?php
                                        }
                                    }
                                 ?>
                            </td>
                        </tr>
                    </tbody>
                    <tbody>
                            <tr>
                                <td><label style="margin-top:-8px"><br>D. Kokain (coke,crack, etc.)</label>
                                </td>
                                <td>
                                                    <?php
                                    $kokain = explode(',', $row['kokain']);
                                    $query = mysqli_query($config, "SELECT * FROM tbl_kategori WHERE id_katego IN ('70', '71', '72')");
                                    if(mysqli_num_rows($query) > 0){
                                        $i = 0;
                                        while($data = mysqli_fetch_array($query)){
                                        $i++;
                                    ?>
                                        <input type="checkbox" id="kokain<?php echo $i; ?>" class="validate" name="kokain[]" value="<?php echo $data['nama_katego']; ?>"
                                        <?php if (in_array($data['nama_katego'], $kokain)) echo "checked";?>
                                        >
                                        <label for="kokain<?php echo $i; ?>"><?php echo $data['nama_katego']; ?></label><br>
                                <?php
                                        }
                                    }
                                 ?>
                            </td>
                        </tr>
                    </tbody>
                    <tbody>
                            <tr>
                                <td><label style="margin-top:-8px"><br>E. Stimulant jenis amfetamin(ekstasi,shabu,dll)</label>
                                </td>
                                <td>
                                                    <?php
                                    $stimulant = explode(',', $row['stimulant']);
                                    $query = mysqli_query($config, "SELECT * FROM tbl_kategori WHERE id_katego IN ('70', '71', '72')");
                                    if(mysqli_num_rows($query) > 0){
                                        $i = 0;
                                        while($data = mysqli_fetch_array($query)){
                                        $i++;
                                    ?>
                                        <input type="checkbox" id="stimulant<?php echo $i; ?>" class="validate" name="stimulant[]" value="<?php echo $data['nama_katego']; ?>"
                                        <?php if (in_array($data['nama_katego'], $stimulant)) echo "checked";?>
                                        >
                                        <label for="stimulant<?php echo $i; ?>"><?php echo $data['nama_katego']; ?></label><br>
                                <?php
                                        }
                                    }
                                 ?>
                            </td>
                        </tr>
                    </tbody>
                    <tbody>
                            <tr>
                                <td><label style="margin-top:-8px"><br>F. Inhalansia (lem,bensin,tiner,dll)</label>
                                </td>
                                <td>
                                                    <?php
                                    $inhalansia = explode(',', $row['inhalansia']);
                                    $query = mysqli_query($config, "SELECT * FROM tbl_kategori WHERE id_katego IN ('70', '71', '72')");
                                    if(mysqli_num_rows($query) > 0){
                                        $i = 0;
                                        while($data = mysqli_fetch_array($query)){
                                        $i++;
                                    ?>
                                        <input type="checkbox" id="inhalansia<?php echo $i; ?>" class="validate" name="inhalansia[]" value="<?php echo $data['nama_katego']; ?>"
                                        <?php if (in_array($data['nama_katego'], $inhalansia)) echo "checked";?>
                                        >
                                        <label for="inhalansia<?php echo $i; ?>"><?php echo $data['nama_katego']; ?></label><br>
                                <?php
                                        }
                                    }
                                 ?>
                            </td>
                        </tr>
                    </tbody>
                    <tbody>
                            <tr>
                                <td><label style="margin-top:-8px"><br>G. Sedaktiva atau obat tidur (pil koplo, alprazolam,kamlet,leksotan,rohypnol,dll)</label>
                                </td>
                                <td>
                                                    <?php
                                    $sedaktiva_obti = explode(',', $row['sedaktiva_obti']);
                                    $query = mysqli_query($config, "SELECT * FROM tbl_kategori WHERE id_katego IN ('70', '71', '72')");
                                    if(mysqli_num_rows($query) > 0){
                                        $i = 0;
                                        while($data = mysqli_fetch_array($query)){
                                        $i++;
                                    ?>
                                        <input type="checkbox" id="sedaktiva_obti<?php echo $i; ?>" class="validate" name="sedaktiva_obti[]" value="<?php echo $data['nama_katego']; ?>"
                                        <?php if (in_array($data['nama_katego'], $sedaktiva_obti)) echo "checked";?>
                                        >
                                        <label for="sedaktiva_obti<?php echo $i; ?>"><?php echo $data['nama_katego']; ?></label><br>
                                <?php
                                        }
                                    }
                                 ?>
                            </td>
                        </tr>
                    </tbody>
                    <tbody>
                            <tr>
                                <td><label style="margin-top:-8px"><br>H. Halusinogens (LSD, jamur tahi sapi, PCP,dll)</label>
                                </td>
                                <td>
                                                    <?php
                                    $halusinogens = explode(',', $row['halusinogens']);
                                    $query = mysqli_query($config, "SELECT * FROM tbl_kategori WHERE id_katego IN ('70', '71', '72')");
                                    if(mysqli_num_rows($query) > 0){
                                        $i = 0;
                                        while($data = mysqli_fetch_array($query)){
                                        $i++;
                                    ?>
                                        <input type="checkbox" id="halusinogens<?php echo $i; ?>" class="validate" name="halusinogens[]" value="<?php echo $data['nama_katego']; ?>"
                                        <?php if (in_array($data['nama_katego'], $halusinogens)) echo "checked";?>
                                        >
                                        <label for="halusinogens<?php echo $i; ?>"><?php echo $data['nama_katego']; ?></label><br>
                                <?php
                                        }
                                    }
                                 ?>
                            </td>
                        </tr>
                    </tbody>
                    <tbody>
                            <tr>
                                <td><label style="margin-top:-8px"><br>I. Opioida (heroin,putaw,morfin,metadon,kodein,dll)</label>
                                </td>
                                <td>
                                                    <?php
                                    $opioida = explode(',', $row['opioida']);
                                    $query = mysqli_query($config, "SELECT * FROM tbl_kategori WHERE id_katego IN ('70', '71', '72')");
                                    if(mysqli_num_rows($query) > 0){
                                        $i = 0;
                                        while($data = mysqli_fetch_array($query)){
                                        $i++;
                                    ?>
                                        <input type="checkbox" id="opioida<?php echo $i; ?>" class="validate" name="opioida[]" value="<?php echo $data['nama_katego']; ?>"
                                        <?php if (in_array($data['nama_katego'], $opioida)) echo "checked";?>
                                        >
                                        <label for="opioida<?php echo $i; ?>"><?php echo $data['nama_katego']; ?></label><br>
                                <?php
                                        }
                                    }
                                 ?>
                            </td>
                        </tr>
                    </tbody>
                        

                    <tbody>
                            <tr>
                                <td>
                                    <div class="input-field">
                                        <input id="nama_zat" type="text" class="validate" name="nama_zat" value="<?php echo $row['nama_zat']; ?>" required>
                                        <?php
                                            if(isset($_SESSION['ependidikan'])){
                                                $ependidikan = $_SESSION['ependidikan'];
                                                echo '<div id="alert-message" class="callout bottom z-depth-1 red lighten-4 red-text">'.$ependidikan.'</div>';
                                                unset($_SESSION['ependidikan']);
                                            }
                                        ?>
                                    <label for="nama_zat">J. Zat-lain, jelaskan =  </label>
                                    </div>
                                </td>
                                <td>
                                                    <?php
                                    $zat_lain = explode(',', $row['zat_lain']);
                                    $query = mysqli_query($config, "SELECT * FROM tbl_kategori WHERE id_katego IN ('70', '71', '72')");
                                    if(mysqli_num_rows($query) > 0){
                                        $i = 0;
                                        while($data = mysqli_fetch_array($query)){
                                        $i++;
                                    ?>
                                        <input type="checkbox" id="zat_lain<?php echo $i; ?>" class="validate" name="zat_lain[]" value="<?php echo $data['nama_katego']; ?>"
                                        <?php if (in_array($data['nama_katego'], $zat_lain)) echo "checked";?>
                                        >
                                        <label for="zat_lain<?php echo $i; ?>"><?php echo $data['nama_katego']; ?></label><br>
                                <?php
                                        }
                                    }
                                 ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
                        <div class="row">

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
