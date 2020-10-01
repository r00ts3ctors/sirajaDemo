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

        $id_scrining = mysqli_real_escape_string($config, $_REQUEST['id_scrining']);

        $query = mysqli_query($config, "SELECT * FROM tbl_scrining WHERE id_scrining='$id_scrining'");

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
                                                <td width="13%">Isi Scrining</td>
                                                <td width="1%">:</td>
                                                <td width="86%">'.$row['isi_scrining'].'</td>
                                            </tr>
                                            <tr>
                                                <td width="13%">Level</td>
                                                <td width="1%">:</td>
                                                <td width="86%">'.$row['level_candu'].'</td>
                                            </tr>
                                            <tr>
                                                <td width="13%">jenis Pertama digunakan</td>
                                                <td width="1%">:</td>
                                                <td width="86%">'.$row['jenis_zat'].'</td>
                                            </tr>
                                            <tr>
                                                <td width="13%">Pendidikan Terakhir</td>
                                                <td width="1%">:</td>
                                                <td width="86%">'.$row['pendidikan'].'</td>
                                            </tr>
                                            <tr>
                                                <td width="13%">Penyakit Bawaan</td>
                                                <td width="1%">:</td>
                                                <td width="86%">'.$row['penyakit'].'</td>
                                            </tr>
                                            <tr>
                                                <td width="13%">Usia Mulai Memakai</td>
                                                <td width="1%">:</td>
                                                <td width="86%">'.$row['usia_pakai'].'</td>
                                            </tr>
                                            <tr>
                                                <td width="13%">1 Tahun Terakhir Narkoba jenis</td>
                                                <td width="1%">:</td>
                                                <td width="86%">'.$row['jenis_zat_akhir'].'</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="card-action">
                                     <a href="?page=tsm&act=scr&id_surat='.$row['id_surat'].'&sub=del_s&submit=yes&id_scrining='.$row['id_scrining'].'" class="btn-large deep-orange waves-effect waves-light white-text">HAPUS <i class="material-icons">delete</i></a>
                                    <a href="?page=tsm&act=scr&id_surat='.$row['id_surat'].'" class="btn-large blue waves-effect waves-light white-text">BATAL <i class="material-icons">clear</i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Row form END -->';

                    if(isset($_REQUEST['submit'])){
                        $id_scrining = $_REQUEST['id_scrining'];

                        $query = mysqli_query($config, "DELETE FROM tbl_scrining WHERE id_scrining='$id_scrining'");

                        if($query == true){
                            $_SESSION['succDel'] = 'SUKSES! Data berhasil dihapus ';
                            echo '<script language="javascript">
                                    window.location.href="./admin.php?page=tsm&act=scr&id_surat='.$row['id_surat'].'";
                                  </script>';
                        } else {
                            $_SESSION['errQ'] = 'ERROR! Ada masalah dengan query';
                            echo '<script language="javascript">
                                    window.location.href="./admin.php?page=tsm&act=scr&id_surat='.$row['id_surat'].'&sub=del_s&id_scrining='.$row['id_scrining'].'";
                                  </script>';
                        }
                    }
                }
            }
        }
?>
