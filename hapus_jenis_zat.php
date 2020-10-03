<?php
    //cek session
    if(empty($_SESSION['admin'])){
        $_SESSION['err'] = '<center>Anda harus login terlebih dahulu!</center>';
        header("Location: ./");
        die();
    } else {

        if(isset($_SESSION['errQ'])){
            $errQ = $_SESSION['errQ'];
            echo '<div id="alert-message" class="row jarak-card">
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

        $id_zat = mysqli_real_escape_string($config, $_REQUEST['id_zat']);

        $query = mysqli_query($config, "SELECT * FROM tbl_jenis_zat WHERE id_zat='$id_zat'");

        if(mysqli_num_rows($query) > 0){
            $no = 1;
            while($row = mysqli_fetch_array($query)){

              echo '<!-- Row form Start -->
                    <div class="row jarak-card">
                        <div class="col m12">
                            <div class="card">
                                <div class="red lighten-4 card-content">
                                    <table>
                                        <thead class="red lighten-5 red-text">
                                            <div class="confir red-text"><i class="material-icons md-36">error_outline</i>
                                            Apakah Anda yakin akan menghapus data ini?</div>
                                        </thead>

                                        <tbody>
                                            <tr>
                                                <td width="70%">A. Tembakau (rokok,cerutu,kretek,dll)</td>
                                                <td width="1%">:</td>
                                                <td width="29%">'.$row['tembakau'].'</td>
                                            </tr>
                                            <tr>
                                                <td width="70%">
B. Minuman berakohol (bir, anggur, sopi, tuak,cap tikus,dll)</td>
                                                <td width="1%">:</td>
                                                <td width="29%">'.$row['minuman_berakohol'].'</td>
                                            </tr>
                                            <tr>
                                                <td width="70%">
C. Kanabis (mariuana,ganja,gelek,cimeng,dll)</td>
                                                <td width="1%">:</td>
                                                <td width="29%">'.$row['kanabis'].'</td>
                                            </tr>
                                            <tr>
                                                <td width="70%">D. Kokain (coke,crack, etc.)</td>
                                                <td width="1%">:</td>
                                                <td width="29%">'.$row['kokain'].'</td>
                                            </tr>
                                            <tr>
                                                <td width="70%">E. Stimulant jenis amfetamin(ekstasi,shabu,dll)</td>
                                                <td width="1%">:</td>
                                                <td width="29%">'.$row['stimulant'].'</td>
                                            </tr>
                                            <tr>
                                                <td width="70%">F. Inhalansia (lem,bensin,tiner,dll)</td>
                                                <td width="1%">:</td>
                                                <td width="29%">'.$row['inhalansia'].'</td>
                                            </tr>
                                            <tr>
                                                <td width="70%">G. Sedaktiva atau obat tidur (pil koplo, alprazolam,kamlet,leksotan,rohypnol,dll)</td>
                                                <td width="1%">:</td>
                                                <td width="29%">'.$row['sedaktiva_obti'].'</td>
                                            </tr>
                                            <tr>
                                                <td width="70%">H. Halusinogens (LSD, jamur tahi sapi, PCP,dll)</td>
                                                <td width="1%">:</td>
                                                <td width="29%">'.$row['halusinogens'].'</td>
                                            </tr>
                                            <tr>
                                                <td width="70%">I. Opioida (heroin,putaw,morfin,metadon,kodein,dll)</td>
                                                <td width="1%">:</td>
                                                <td width="29%">'.$row['opioida'].'</td>
                                            </tr>
                                            <tr>
                                                <td width="70%">Zat Lain, Penjelasan....'.$row['nama_zat'].'</td>
                                                <td width="1%">:</td>
                                                <td width="29%">'.$row['zat_lain'].'</td>
                                            </tr>
                                            
                                        </tbody>
                                    </table>
                                </div>
                                <div class="card-action">
                                     <a href="?page=tsm&act=scr&id_surat='.$row['id_surat'].'&sub=del_z&submit=yes&id_zat='.$row['id_zat'].'" class="btn-large deep-orange waves-effect waves-light white-text">HAPUS <i class="material-icons">delete</i></a>
                                    <a href="?page=tsm&act=scr&id_surat='.$row['id_surat'].'" class="btn-large blue waves-effect waves-light white-text">BATAL <i class="material-icons">clear</i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Row form END -->';

                    if(isset($_REQUEST['submit'])){
                        $id_zat = $_REQUEST['id_zat'];

                        $query = mysqli_query($config, "DELETE FROM tbl_jenis_zat WHERE id_zat='$id_zat'");

                        if($query == true){
                            $_SESSION['succDel'] = 'SUKSES! Data berhasil dihapus ';
                            echo '<script language="javascript">
                                    window.location.href="./admin.php?page=tsm&act=scr&id_surat='.$row['id_surat'].'";
                                  </script>';
                        } else {
                            $_SESSION['errQ'] = 'ERROR! Ada masalah dengan query';
                            echo '<script language="javascript">
                                    window.location.href="./admin.php?page=tsm&act=scr&id_surat='.$row['id_surat'].'&sub=del_z&id_zat='.$row['id_zat'].'";
                                  </script>';
                        }
                    }
                }
            }
        }
?>
