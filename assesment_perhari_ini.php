<?php
    //cek session
    if(empty($_SESSION['admin'])){
        $_SESSION['err'] = '<center>Anda harus login terlebih dahulu!</center>';
        header("Location: ./");
        die();
    } else {

        if($_SESSION['admin'] != 1 AND $_SESSION['admin'] != 2 AND $_SESSION['admin'] != 3 AND $_SESSION['admin'] != 4){
            echo '<script language="javascript">
                    window.alert("ERROR! Anda tidak memiliki hak akses untuk membuka halaman ini");
                    window.location.href="./logout.php";
                  </script>';
        } else {

            if(isset($_REQUEST['act'])){
                $act = $_REQUEST['act'];
                switch ($act) {
                    case 'add':
                        include "tambah_surat_masuk.php";
                        break;
                    case 'add_wal':
                        include "tambah_waliKlien.php";
                        break;
                    case 'edit':
                        include "edit_Klien.php";
                        break;
                    case 'disp':
                        include "disposisi.php";
                        break;
                    case 'wp':
                        include "wali_Klien.php";
                        break;
                    case 'ass':
                        include "assesmen.php";
                        break;
                    case 'scr':
                        include "scrining.php";
                        break;
                    case 'print':
                        include "cetak_disposisi.php";
                        break;
                    case 'api':
                        include "assesment_perhari_ini.php";
                        break;
                }
            } else {

                $query = mysqli_query($config, "SELECT surat_masuk FROM tbl_sett");
                list($surat_masuk) = mysqli_fetch_array($query);

                //pagging
                $limit = $surat_masuk;
                $pg = @$_GET['pg'];
                if(empty($pg)){
                    $curr = 0;
                    $pg = 1;
                } else {
                    $curr = ($pg - 1) * $limit;
                }?>

                <!-- Row Start -->
                <div class="row">
                    <!-- Secondary Nav START -->
                    <div class="col s12">
                        <div class="z-depth-1">
                            <nav class="secondary-nav">
                                <div class="nav-wrapper blue-grey darken-1">
                                    <div class="col m7">
                                        <ul class="left">
                                            <li class="waves-effect waves-light hide-on-small-only"><a href="?page=tsm" class="judul"><i class="material-icons">loyalty</i> Assessment Klien Hari Ini</a></li>
                                        </ul>
                                    </div>
                                    <div class="col m5 hide-on-med-and-down">
                                        <form method="post" action="?page=tsm">
                                            <div class="input-field round-in-box">
                                                <input id="search" type="search" name="cari" placeholder="Ketik nama & tekan enter mencari data..." required>
                                                <label for="search"><i class="material-icons md-dark">search</i></label>
                                                <input type="submit" name="submit" class="hidden">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </nav>
                        </div>
                    </div>
                    <!-- Secondary Nav END -->
                </div>
                <!-- Row END -->

                <?php
                    if(isset($_SESSION['succAdd'])){
                        $succAdd = $_SESSION['succAdd'];
                        echo '<div id="alert-message" class="row">
                                <div class="col m12">
                                    <div class="card green lighten-5">
                                        <div class="card-content notif">
                                            <span class="card-title green-text"><i class="material-icons md-36">done</i> '.$succAdd.'</span>
                                        </div>
                                    </div>
                                </div>
                            </div>';
                        unset($_SESSION['succAdd']);
                    }
                    if(isset($_SESSION['succEdit'])){
                        $succEdit = $_SESSION['succEdit'];
                        echo '<div id="alert-message" class="row">
                                <div class="col m12">
                                    <div class="card green lighten-5">
                                        <div class="card-content notif">
                                            <span class="card-title green-text"><i class="material-icons md-36">done</i> '.$succEdit.'</span>
                                        </div>
                                    </div>
                                </div>
                            </div>';
                        unset($_SESSION['succEdit']);
                    }
                    if(isset($_SESSION['succDel'])){
                        $succDel = $_SESSION['succDel'];
                        echo '<div id="alert-message" class="row">
                                <div class="col m12">
                                    <div class="card green lighten-5">
                                        <div class="card-content notif">
                                            <span class="card-title green-text"><i class="material-icons md-36">done</i> '.$succDel.'</span>
                                        </div>
                                    </div>
                                </div>
                            </div>';
                        unset($_SESSION['succDel']);
                    }
                ?>

                <!-- Row form Start -->
                <div class="row jarak-form">

                <?php
                    if(isset($_REQUEST['submit'])){
                    $cari = mysqli_real_escape_string($config, $_REQUEST['cari']);
                        echo '
                        <div class="col s12" style="margin-top: -18px;">
                            <div class="card blue lighten-5">
                                <div class="card-content">
                                <p class="description">Hasil pencarian untuk kata kunci <strong>"'.stripslashes($cari).'"</strong><span class="right"><a href="?page=tsm"><i class="material-icons md-36" style="color: #333;">clear</i></a></span></p>
                                </div>
                            </div>
                        </div>

                        <div class="col m12" id="colres">
                        <table class="bordered" id="tbl">
                            <thead class="blue lighten-4" id="head">
                                <tr>
                                    <th width="10%">No. R.Medis<br/>No. Hp</th>
                                    <th width="30%">Nama<br/> File</th>
                                    <th width="24%">Alamat</th>
                                    <th width="18%">No. KTP<br/>Tgl Lahir</th>
                                    <th width="18%">Tindakan <span class="right"><i class="material-icons" style="color: #333;">settings</i></span></th>
                                </tr>
                            </thead>
                            <tbody>';

                            //script untuk mencari data
                            if($_SESSION['admin'] == 1){
                                $query = mysqli_query($config, "SELECT * FROM tbl_disposisi WHERE nama LIKE '%$cari%' ORDER by id_surat DESC LIMIT 15");
                            } else {
                                $query = mysqli_query($config, "SELECT * FROM tbl_disposisi WHERE nama LIKE '%$cari%' AND id_user='".$_SESSION['id_user']."' ORDER by id_surat DESC LIMIT 15");
                            }
                            
                            if(mysqli_num_rows($query) > 0){
                                $no = 1;
                                while($row = mysqli_fetch_array($query)){
                                  echo '
                                  <tr>
                                    <td>'.$row['no_agenda'].'<br/><hr/>'.$row['kode'].'</td>
                                    <td>'.substr($row['nama'],0,200).'<br/><br/><strong><a class="btn small blue">File <i class="material-icons">forward</i></a>:</strong>';

                                    if(!empty($row['file'])){
                                        echo ' <strong><a href="?page=gsm&act=fsm&id_surat='.$row['id_surat'].'">'.$row['file'].'</a></strong>';
                                    } else {
                                        echo '<em>Tidak ada file yang di upload</em>';
                                    } echo '</td>
                                    <td>'.$row['asal_surat'].'</td>
                                    <td>'.$row['no_surat'].'<br/><hr/>'.indoDate($row['tgl_surat']).'</td>
                                    <td>';

                                    if($_SESSION['admin'] == 1 || $_SESSION['admin'] == 2){
                                        echo '<a class="btn small deep-purple accent-4 waves-effect waves-light tooltipped" data-position="left" data-tooltip="Pilih Scrining untuk menscrining Klien" href="?page=tsm&act=scr&id_surat='.$row['id_surat'].'"><i class="material-icons">update</i> Scrining</a>
                                                <a class="btn small yellow darken-3 waves-effect waves-light tooltipped" data-position="left" data-tooltip="Pilih Jadwal untuk menambahkan Jadwal Pertemuan dengan Klien" href="?page=tsm&act=disp&id_surat='.$row['id_surat'].'">
                                                    <i class="material-icons">update</i> Jadwal</a>
                                                <a class="btn small light-green waves-effect waves-light tooltipped" data-position="left" data-tooltip="Pilih untuk kolola Wali Klien" href="?page=tsm&act=wp&id_surat='.$row['id_surat'].'">
                                                    <i class="material-icons">person_pin</i> Wali</a>
                                                <a class="btn small purple accent-3 waves-effect waves-light" href="?page=ctk&id_surat='.$row['id_surat'].'" target="_blank">
                                                    <i class="material-icons">print</i> PRINT</a>
                                                <a class="btn small deep-orange waves-effect waves-light" href="?page=tsm&act=del&id_surat='.$row['id_surat'].'">
                                                    <i class="material-icons">delete</i> DEL</a>
                                                <a class="btn small blue waves-effect waves-light" href="?page=tsm&act=edit&id_surat='.$row['id_surat'].'">
                                                    <i class="material-icons">edit</i> EDIT</a>';
                                    } else {
                                      echo '
                                            <a class="btn small deep-purple accent-4 waves-effect waves-light tooltipped" data-position="left" data-tooltip="Pilih Scrining untuk menscrining Klien" href="?page=tsm&act=scr&id_surat='.$row['id_surat'].'"><i class="material-icons">update</i> Scrining</a>
                                                <a class="btn small yellow darken-3 waves-effect waves-light tooltipped" data-position="left" data-tooltip="Pilih Jadwal untuk menambahkan Jadwal Pertemuan dengan Klien" href="?page=tsm&act=disp&id_surat='.$row['id_surat'].'">
                                                    <i class="material-icons">update</i> Jadwal</a>
                                                <a class="btn small light-green waves-effect waves-light tooltipped" data-position="left" data-tooltip="Pilih untuk kolola Wali Klien" href="?page=tsm&act=wp&id_surat='.$row['id_surat'].'">
                                                    <i class="material-icons">person_pin</i> Wali</a>
                                                <a class="btn small purple accent-3 waves-effect waves-light" href="?page=ctk&id_surat='.$row['id_surat'].'" target="_blank">
                                                    <i class="material-icons">print</i> PRINT</a>
                                                <a class="btn small deep-orange waves-effect waves-light" href="?page=tsm&act=del&id_surat='.$row['id_surat'].'">
                                                    <i class="material-icons">delete</i> DEL</a>
                                                <a class="btn small blue waves-effect waves-light" href="?page=tsm&act=edit&id_surat='.$row['id_surat'].'">
                                                    <i class="material-icons">edit</i> EDIT</a>';
                                    } echo '
                                        </td>
                                    </tr>';
                                }
                            } else {
                                echo '<tr><td colspan="5"><center><p class="add">Tidak ada data Klien yang ditemukan</p></center></td></tr>';
                            }
                             echo '</tbody></table><br/><br/>
                        </div>
                    </div>
                    <!-- Row form END -->';

                    } else {

                        echo '
                        <div class="col m12" id="colres">
                            <table class="bordered" id="tbl">
                                <thead class="blue lighten-4" id="head">
                                    <tr>
                                        <th width="10%">No. R.Medis<br/>No. Hp</th>
                                        <th width="30%">Nama<br/> File</th>
                                        <th width="24%">Alamat</th>
                                        <th width="18%">No. KTP<br/>Tgl Lahir</th>
                                        <th width="18%">Tindakan <span class="right tooltipped" data-position="left" data-tooltip="Atur jumlah data yang ditampilkan"><a class="modal-trigger" href="#modal"><i class="material-icons" style="color: #333;">settings</i></a></span></th>

                                            <div id="modal" class="modal">
                                                <div class="modal-content white">
                                                    <h5>Jumlah data yang ditampilkan per halaman</h5>';
                                                    $query = mysqli_query($config, "SELECT id_sett,surat_masuk FROM tbl_sett");
                                                    list($id_sett,$surat_masuk) = mysqli_fetch_array($query);
                                                    echo '
                                                    <div class="row">
                                                        <form method="post" action="">
                                                            <div class="input-field col s12">
                                                                <input type="hidden" value="'.$id_sett.'" name="id_sett">
                                                                <div class="input-field col s1" style="float: left;">
                                                                    <i class="material-icons prefix md-prefix">looks_one</i>
                                                                </div>
                                                                <div class="input-field col s11 right" style="margin: -5px 0 20px;">
                                                                    <select class="browser-default validate" name="surat_masuk" required>
                                                                        <option value="'.$surat_masuk.'">'.$surat_masuk.'</option>
                                                                        <option value="5">5</option>
                                                                        <option value="10">10</option>
                                                                        <option value="20">20</option>
                                                                        <option value="50">50</option>
                                                                        <option value="100">100</option>
                                                                    </select>
                                                                </div>
                                                                <div class="modal-footer white">
                                                                    <button type="submit" class="modal-action waves-effect waves-green btn-flat" name="SUBMIT">SUBMIT</button>';
                                                                    if(isset($_REQUEST['SUBMIT'])){
                                                                        $id_sett = "1";
                                                                        $surat_masuk = $_REQUEST['surat_masuk'];
                                                                        $id_user = $_SESSION['id_user'];

                                                                        $query = mysqli_query($config, "UPDATE tbl_sett SET surat_masuk='$surat_masuk',id_user='$id_user' WHERE id_sett='$id_sett'");
                                                                        if($query == true){
                                                                            header("Location: ./admin.php?page=tsm");
                                                                            die();
                                                                        }
                                                                    } echo '
                                                                    <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Batal</a>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                    </tr>
                                </thead>
                                <tbody>';

                                //script untuk menampilkan data
                                if($_SESSION['admin'] == 1){
                                    $query = mysqli_query($config, "SELECT * FROM tbl_disposisi JOIN tbl_surat_masuk ON tbl_disposisi.id_surat = tbl_surat_masuk.id_surat WHERE tbl_disposisi.id_surat ORDER by id_surat DESC LIMIT $curr, $limit");
                                } else {
                                    $query = mysqli_query($config, "SELECT * FROM tbl_disposisi WHERE id_user='".$_SESSION['id_user']."' ORDER by id_surat DESC LIMIT $curr, $limit");
                                }
                               
                                if(mysqli_num_rows($query) > 0){
                                    $no = 0;
                                    while($row = mysqli_fetch_array($query)){
                                      echo '
                                      <tr>
                                        <td>'.$row['no_agenda'].'<br/><hr/>'.$row['kode'].'</td>
                                        <td>'.substr($row['nama'],0,200).'<br/><br/><strong><a class="btn small blue">File <i class="material-icons">forward</i></a> :</strong>';

                                        if(!empty($row['file'])){
                                            echo ' <strong><a href="?page=gsm&act=fsm&id_surat='.$row['id_surat'].'">'.$row['file'].'</a></strong>';
                                        } else {
                                            echo '<em>Tidak ada file yang di upload</em>';
                                        } echo '</td>
                                        <td>'.$row['asal_surat'].'</td>
                                        <td>'.$row['no_surat'].'<br/><hr/>'.indoDate($row['tgl_surat']).'</td>
                                        <td>';
                                        
                                        if($_SESSION['admin'] == 1 || $_SESSION['admin'] == 2){
                                            echo '<a class="btn small deep-purple accent-4 waves-effect waves-light tooltipped" data-position="left" data-tooltip="Pilih Scrining untuk menscrining Klien" href="?page=tsm&act=scr&id_surat='.$row['id_surat'].'"><i class="material-icons">update</i> Scrining</a>
                                                <a class="btn small yellow darken-3 waves-effect waves-light tooltipped" data-position="left" data-tooltip="Pilih Jadwal untuk menambahkan Jadwal Pertemuan dengan Klien" href="?page=tsm&act=disp&id_surat='.$row['id_surat'].'">
                                                    <i class="material-icons">update</i> Jadwal</a>
                                                <a class="btn small light-green waves-effect waves-light tooltipped" data-position="left" data-tooltip="Pilih untuk kolola Wali Klien" href="?page=tsm&act=wp&id_surat='.$row['id_surat'].'">
                                                    <i class="material-icons">person_pin</i> Wali</a>
                                                <a class="btn small purple accent-3 waves-effect waves-light" href="?page=ctk&id_surat='.$row['id_surat'].'" target="_blank">
                                                    <i class="material-icons">print</i> PRINT</a>
                                                <a class="btn small deep-orange waves-effect waves-light" href="?page=tsm&act=del&id_surat='.$row['id_surat'].'">
                                                    <i class="material-icons">delete</i> DEL</a>
                                                <a class="btn small blue waves-effect waves-light" href="?page=tsm&act=edit&id_surat='.$row['id_surat'].'">
                                                    <i class="material-icons">edit</i> EDIT</a>';
                                        } else {
                                          echo '
                                                <a class="btn small deep-purple accent-4 waves-effect waves-light tooltipped" data-position="left" data-tooltip="Pilih Scrining untuk menscrining Klien" href="?page=tsm&act=scr&id_surat='.$row['id_surat'].'"><i class="material-icons">update</i> Scrining</a>
                                                <a class="btn small yellow darken-3 waves-effect waves-light tooltipped" data-position="left" data-tooltip="Pilih Jadwal untuk menambahkan Jadwal Pertemuan dengan Klien" href="?page=tsm&act=disp&id_surat='.$row['id_surat'].'">
                                                    <i class="material-icons">update</i> Jadwal</a>
                                                <a class="btn small light-green waves-effect waves-light tooltipped" data-position="left" data-tooltip="Pilih untuk kolola Wali Klien" href="?page=tsm&act=wp&id_surat='.$row['id_surat'].'">
                                                    <i class="material-icons">person_pin</i> Wali</a>
                                                <a class="btn small purple accent-3 waves-effect waves-light" href="?page=ctk&id_surat='.$row['id_surat'].'" target="_blank">
                                                    <i class="material-icons">print</i> PRINT</a>
                                                <a class="btn small deep-orange waves-effect waves-light" href="?page=tsm&act=del&id_surat='.$row['id_surat'].'">
                                                    <i class="material-icons">delete</i> DEL</a>
                                                <a class="btn small blue waves-effect waves-light" href="?page=tsm&act=edit&id_surat='.$row['id_surat'].'">
                                                    <i class="material-icons">edit</i> EDIT</a>';
                                        } echo '
                                        </td>
                                    </tr>';
                                }
                            } else {
                                echo '<tr><td colspan="5"><center><p class="add">Tidak ada data untuk ditampilkan. <u><a href="?page=tsm&act=add">Tambah data baru</a></u></p></center></td></tr>';
                            }
                          echo '</tbody></table>
                        </div>
                    </div>
                    <!-- Row form END -->';

                    if($_SESSION['admin'] == 1){
                        $query = mysqli_query($config, "SELECT * FROM tbl_disposisi");
                    } else {
                        $query = mysqli_query($config, "SELECT * FROM tbl_disposisi WHERE id_user='".$_SESSION['id_user']."'");
                    }
                    $cdata = mysqli_num_rows($query);
                    $cpg = ceil($cdata/$limit);

                    echo '<br/><!-- Pagination START -->
                          <ul class="pagination">';

                    if($cdata > $limit ){

                        //first and previous pagging
                        if($pg > 1){
                            $prev = $pg - 1;
                            echo '<li><a href="?page=tsm&pg=1"><i class="material-icons md-48">first_page</i></a></li>
                                  <li><a href="?page=tsm&pg='.$prev.'"><i class="material-icons md-48">chevron_left</i></a></li>';
                        } else {
                            echo '<li class="disabled"><a href="#"><i class="material-icons md-48">first_page</i></a></li>
                                  <li class="disabled"><a href="#"><i class="material-icons md-48">chevron_left</i></a></li>';
                        }

                        //perulangan pagging
                        for ($i = 1; $i <= $cpg; $i++) {
                            if ((($i >= $pg - 3) && ($i <= $pg + 3)) || ($i == 1) || ($i == $cpg)) {
                                if ($i == $pg) echo '<li class="active waves-effect waves-dark"><a href="?page=tsm&pg='.$i.'"> '.$i.' </a></li>';
                                else echo '<li class="waves-effect waves-dark"><a href="?page=tsm&pg='.$i.'"> '.$i.' </a></li>';
                            }
                        }

                        //last and next pagging
                        if($pg < $cpg){
                            $next = $pg + 1;
                            echo '<li><a href="?page=tsm&pg='.$next.'"><i class="material-icons md-48">chevron_right</i></a></li>
                                  <li><a href="?page=tsm&pg='.$cpg.'"><i class="material-icons md-48">last_page</i></a></li>';
                        } else {
                            echo '<li class="disabled"><a href="#"><i class="material-icons md-48">chevron_right</i></a></li>
                                  <li class="disabled"><a href="#"><i class="material-icons md-48">last_page</i></a></li>';
                        }
                        echo '
                        </ul>';
                    } else {
                        echo '';
                    }
                }
            }
        }
    }
?>
