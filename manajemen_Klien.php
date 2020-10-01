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
                        include "tambah_Klien.php";
                        break;
                    case 'add_wal':
                        include "tambah_waliKlien.php";
                        break;
                    case 'edit':
                        include "edit_Klien.php";
                        break;
                    case 'disp':
                        include "penjadwalan.php";
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
                    case 'del':
                        include "hapus_Klien.php";
                        break;
                }
            } else {

                $query = mysqli_query($config, "SELECT surat_masuk FROM tbl_sett");
                list($surat_masuk) = mysqli_fetch_array($query);

                //pagging
                $limit = $surat_masuk == 0 ? 100 : $surat_masuk;
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
                                            <li class="waves-effect waves-light hide-on-small-only"><a href="?page=tsm" class="judul"><i class="material-icons">loyalty</i> Data Klien</a></li>
                                            <li class="waves-effect waves-light">
                                                <a href="?page=tsm&act=add"><i class="material-icons md-24">group_add</i> Tambah Data Klien</a>
                                            </li>
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
                                $query = mysqli_query($config, "SELECT * FROM tbl_surat_masuk WHERE nama LIKE '%$cari%' ORDER by id_surat DESC LIMIT 15");
                            } else {
                                $query = mysqli_query($config, "SELECT * FROM tbl_surat_masuk WHERE nama LIKE '%$cari%' AND id_user='".$_SESSION['id_user']."' ORDER by id_surat DESC LIMIT 15");
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
                                        <th width="30%">Nama<br/>Tgl Masuk</th>
                                        <th width="18%">Tgl. Lahir</th>
                                        <th width="12%">Status</th>
                                        <span class="right tooltipped" data-position="left" data-tooltip="Atur klinik yang ditampilkan"><a class="modal-trigger" href="#modal-klinik"><i class="material-icons" style="color: #333;">local_hospital</i></a></span>
                                        <!-- modal-klinik -->
                                            <div id="modal-klinik" class="modal">
                                                <div class="modal-content white">
                                                    <h5>Pilih klinik yang ditampilkan di halaman</h5>';
                                                    $query = mysqli_query($config, "SELECT id_klasifikasi as id,nama FROM tbl_klasifikasi");
                                                    $rs = mysqli_fetch_all($query);
                                                    echo '
                                                    <div class="row">
                                                        <form method="post" action="">
                                                        
                                                          <div class="input-field col s12">
                                                            <select class="browser-default validate" name="klinik">
                                                              
                                                                ';
                                                                if(!isset($_SESSION['klinik'])){
                                                                    echo '<option value="" disabled selected>Tampilkan semua</option>';
                                                                    foreach($rs as $k=>$v) {
                                                                        echo "<option value=" . $v[0] . ">" . $v[1] ."</option>";
                                                                    }
                                                                } else {
                                                                    echo '<option value="">Tampilkan semua</option>';
                                                                    foreach($rs as $k=>$v) {
                                                                        if($v[0] === $_SESSION['klinik']){
                                                                            echo "<option value=" . $v[0] . " selected>" . $v[1] ."</option>";
                                                                        } else {
                                                                            echo "<option value=" . $v[0] . ">" . $v[1] ."</option>";
                                                                        }
                                                                    }
                                                                };
                                                                
                                                                
                                                                echo '


                                                            </select>
                                                           
                                                          </div>
                                                            <div class="modal-footer white">
                                                                <button type="submit" class="modal-action waves-effect waves-green btn-flat" name="simpan-klinik">Simpan</button>';
                                                                if(isset($_REQUEST['simpan-klinik'])){
                                                                    
                                                                    if(isset($_REQUEST['klinik']) && !empty($_REQUEST['klinik'])){
                                                                        $_SESSION['klinik'] =  $_REQUEST['klinik'];
                                                                    }else if(isset($_REQUEST['klinik']) && empty($_REQUEST['klinik'])){
                                                                        unset($_SESSION['klinik']);
                                                                    }
                                                                    
                                                                } echo '
                                                                <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Batal</a>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        <!-- ./modal-klinik -->
                                        <span class="right tooltipped" data-position="left" data-tooltip="Atur kota yang ditampilkan"><a class="modal-trigger" href="#modal-kota"><i class="material-icons" style="color: #333;">home</i></a></span>
                                        <!-- modal-kota -->
                                            <div id="modal-kota" class="modal">
                                                <div class="modal-content white">
                                                    <h5>Pilih kota yang ditampilkan di halaman</h5>';
                                                    $query = mysqli_query($config, "SELECT id,nama_kota FROM tbl_kota");
                                                    $rs = mysqli_fetch_all($query);
                                                    echo '
                                                    <div class="row">
   
                                                        <form method="post" action="">
                                                        
                                                          <div class="input-field col s12">
                                                            <select class="browser-default validate" name="kota">';
                                                            if(!isset($_SESSION['kota'])){
                                                                echo '<option value="" disabled selected>Tampilkan semua</option>';
                                                                foreach($rs as $k=>$v) {
                                                                    echo "<option value=" . $v[0] . ">" . $v[1] ."</option>";
                                                                }
                                                            } else {
                                                                  echo '<option value="">Tampilkan semua</option>';
                                                                  foreach($rs as $k=>$v) {
                                                                      if($v[0] === $_SESSION['kota']){
                                                                          echo "<option value=" . $v[0] . " selected>" . $v[1] ."</option>";
                                                                      } else {
                                                                          echo "<option value=" . $v[0] . ">" . $v[1] ."</option>";
                                                                      }
                                                                  }
                                                            };
                                                                  
                                                                
                                                                echo '
                                                            </select>
                                                           
                                                          </div>
                                                            <div class="modal-footer white">
                                                                <button type="submit" class="modal-action waves-effect waves-green btn-flat" name="simpan-kota">Simpan</button>';
                                                                if(isset($_REQUEST['simpan-kota'])){ 
                                                                    if(isset($_REQUEST['kota']) && !empty($_REQUEST['kota'])){
                                                                        $_SESSION['kota'] =  $_REQUEST['kota'];
                                                                    } else if(isset($_REQUEST['kota']) && empty($_REQUEST['kota'])){
                                                                        unset($_SESSION['kota']);
                                                                    }
                                                                    
                                                                } echo '
                                                                <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Batal</a>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        <!-- ./modal-kota -->
                                        <th width="20%">Tindakan </th><span class="right tooltipped" data-position="left" data-tooltip="Atur jumlah data yang ditampilkan"><a class="modal-trigger" href="#modal"><i class="material-icons" style="color: #333;">settings</i></a></span>

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
                                                                    <button type="submit" class="modal-action waves-effect waves-green btn-flat" name="simpan">Simpan</button>';
                                                                    if(isset($_REQUEST['simpan'])){
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
                                
                                $where_admin = "";
                                $klinik = null;
                                $kota = null;
                                
                                if(isset($_SESSION['klinik']) && !empty($_SESSION['klinik'])){
                                    $klinik = $_SESSION['klinik'];
                                }
                                
                                if(isset($_SESSION['kota']) && !empty($_SESSION['kota'])){
                                    $query = mysqli_query($config, "SELECT nama_kota FROM tbl_kota where id=" . $_SESSION['kota']);
                                    list($nama_kota) = mysqli_fetch_array($query);
                                    $kota = $nama_kota;
                                }
                                
                                if(!is_null($klinik) && !is_null($kota)){
                                   $where_admin = "where a.asal_surat like '%" . $kota ."%' and a.klinik=" . $klinik;
                                } else if(!is_null($klinik)){                                   
                                   $where_admin = "where a.klinik=" . $klinik;
                                } else if(!is_null($kota)){
                                   $where_admin = "where a.asal_surat like '%" . $kota ."%'";
                                }
                                
                                if($_SESSION['admin'] == 1){
                                    $query = mysqli_query($config, "SELECT a.*,b.nama as nama_klinik from tbl_surat_masuk a LEFT JOIN tbl_klasifikasi b ON a.klinik = b.id_klasifikasi $where_admin ORDER BY a.id_surat DESC LIMIT $curr, $limit");
                                } else {
                                    $query = mysqli_query($config, "SELECT * FROM tbl_surat_masuk WHERE id_user='".$_SESSION['id_user']."' ORDER by id_surat DESC LIMIT $curr, $limit");
                                }
                               
                               if(mysqli_num_rows($query) > 0){
                                    $no = 1;
                                    while($row = mysqli_fetch_array($query)){
                                      echo '
                                      <tr>
                                        <td>'.$row['no_agenda'].'<br/><hr/>'.$row['kode'].'</td>
                                        <td>'.substr($row['nama'],0,200).'<br/><br/>'.indoDate($row['tgl_diterima']).'</td>
                                        

                                        <td>'.indoDate($row['tgl_surat']).'</td>
                                        <td>status ada 3</td>
                                        <td>';
                                        
                                        if($_SESSION['admin'] == 1 || $_SESSION['admin'] == 2){
                                            echo '
                                                <a class="btn small deep-purple accent-4 waves-effect waves-light tooltipped" data-position="left" data-tooltip="Pilih View untuk mengelola data Klien" href="?page=tsm&act=scr&id_surat='.$row['id_surat'].'"><i class="material-icons">update</i> View</a>
                                                <a class="btn small blue waves-effect waves-light" href="?page=tsm&act=edit&id_surat='.$row['id_surat'].'">
                                                    <i class="material-icons">edit</i> EDIT</a>
                                                <a class="btn small deep-orange waves-effect waves-light" href="?page=tsm&act=del&id_surat='.$row['id_surat'].'">
                                                    <i class="material-icons">delete</i> DEL</a>';
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
                        $query = mysqli_query($config, "SELECT * FROM tbl_surat_masuk");
                    } else {
                        $query = mysqli_query($config, "SELECT * FROM tbl_surat_masuk WHERE id_user='".$_SESSION['id_user']."'");
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
