<?php
    //cek session
    if(empty($_SESSION['admin'])){
        $_SESSION['err'] = '<center>Anda harus login terlebih dahulu!</center>';
        header("Location: ./");
        die();
    } else {

        ?>
        <style type="text/css">
            #colres {
                margin-top: 30px;
            }
            table {
                background: #fff;
                padding: 3px!important;
            }
            tr, td {
                border-collapse: collapse;
                border: 1px solid #e4e4e4;
            }
            tr,td {
                vertical-align: top!important;
            }
            .isi {
                height: 100px!important;
            }
            .isihal {
                height: 60px!important;
            }
            .disp {
                text-align: center;
                padding: 1.5rem 0;
                margin-bottom: .5rem;
            }
            .logodisp {
                float: left;
                position: relative;
                width: 110px;
                height: 110px;
                margin: 0 0 0 1rem;
            }
            #lead {
                width: auto;
                position: relative;
                margin: 25px 0 0 75%;
            }
            .lead {
                font-weight: bold;
                text-decoration: underline;
                margin-bottom: -10px;
            }
            .tgh {
                text-align: center;
            }
            #nama {
                font-size: 2.1rem;
                margin-bottom: -1rem;
            }
            #alamat {
                font-size: 16px;
            }
            .up {
                text-transform: uppercase;
                margin: 0;
                line-height: 2.2rem;
                font-size: 1.5rem;
            }
            .status {
                margin: 0;
                font-size: 1.3rem;
                margin-bottom: .5rem;
            }
            #lbr {
                font-size: 20px;
                font-weight: bold;
            }
            .chk {
                margin-bottom: 5px;
            }
            .chk:first-of-type {
                margin-top: 5px;
            }
            .check {
                font-size: 31px;
                margin: -15px 0 0 -2px
            }
            .cb {
                border: 1px solid #222;
                height: 20px;
                float: left;
                margin-right: 5px;
                width: 20px;
            }
            @media print{
                body {
                    font-size: 12px;
                    color: #212121;
                }
                nav {
                    display: none;
                }
                table {
                    width: 100%;
                    font-size: 12px;
                    color: #212121;
                }
                tr, td {
                    border-collapse: collapse;
                    border: 1px  solid #444;
                    padding: 3px!important;

                }
                tr,td {
                    vertical-align: top!important;
                }
                #lbr {
                    font-size: 15px;
                }
                .isi {
                    height: 100px!important;
                }

                .isihal {
                    height: 60px!important;
                }
                .tgh {
                    text-align: center;
                }
                .disp {
                    text-align: center;
                    margin: -.5rem 0;
                }
                .logodisp {
                    float: left;
                    position: relative;
                    width: 80px;
                    height: 80px;
                    margin: .5rem 0 0 .5rem;
                }
                #lead {
                    width: auto;
                    position: relative;
                    margin: 5px 0 0 50%;
                }
                .lead {
                    font-weight: bold;
                    text-decoration: underline;
                    margin-bottom: -5px;
                }
                #nama1 {
                    font-size: 20px!important;
                    font-weight: bold;
                    text-transform: uppercase;
                    margin: -10px 0 -20px 0;
                }
                .up {
                    font-size: 17px!important;
                    font-weight: normal;
                }
                .status {
                    font-size: 17px!important;
                    font-weight: normal;
                    margin-bottom: -.1rem;
                }
                #alamat {
                    margin-top: -15px;
                    font-size: 13px;
                }
                #lbr {
                    font-size: 17px;
                    font-weight: bold;
                }


            }
        </style>
            <?php

        if(isset($_REQUEST['sub'])){
            $sub = $_REQUEST['sub'];
            switch ($sub) {
                case 'add_s':
                    include "tambah_scrining.php";
                    break;
                case 'edit_s':
                    include "edit_scrining.php";
                    break;
                case 'del_s':
                    include "hapus_scrining.php";
                    break;
                case 'ctk':
                    include "cetak_rawat_inap.php";
                    break;
                case 'cprj':
                    include "cetak_pernyataan_rj.php";
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
                case 'add':
                    include "tambah_jadwal.php";
                    break;
                case 'add_a':
                    include "tambah_assesmen.php";
                    break;
                case 'edit_d':
                    include "edit_jadwal.php";
                    break;
                case 'del':
                    include "hapus_jadwal.php";
                    break;
                case 'add_wal':
                    include "tambah_waliKlien.php";
                    break;
                case 'add':
                    include "tambah_Klienk.php";
                    break;
                case 'tsm':
                    include "manajemen_Klien.php";
                    break;
                case 'edit_wal':
                    include "edit_wali_Klien.php";
                    break;
                case 'del_wal':
                    include "hapus_wali_Klien.php";
                    break;
                case 'ct_p':
                    include "cetak_penjamin.php";
                    break;
                
     
           }
        } else {
            //pagging
            $limit = 1;
            $pg = @$_GET['pg'];
                if(empty($pg)){
                    $curr = 0;
                    $pg = 1;
                } else {
                    $curr = ($pg - 1) * $limit;
                }
                
                $id_surat = $_REQUEST['id_surat'];

                $query = mysqli_query($config, "SELECT * FROM tbl_surat_masuk WHERE id_surat='$id_surat'");

                if(mysqli_num_rows($query) > 0){
                    $no = 1;
                    while($row = mysqli_fetch_array($query)){

                    if($_SESSION['id_user'] != $row['id_user'] AND $_SESSION['id_user'] != 1){
                        echo '<script language="javascript">
                                window.alert("ERROR! Anda tidak memiliki hak akses untuk melihat data ini");
                                window.location.href="./admin.php?page=tsm";
                              </script>';
                    } else {

                      echo '<!-- Row Start -->
                            <div class="row">
                                <!-- Secondary Nav START -->
                                <div class="col s12">
                                    <div class="z-depth-1">
                                        <nav class="secondary-nav">
                                            <div class="nav-wrapper blue-grey darken-1 center">
                                                
                                                    <div class="waves-effect waves-light hide-on-small-only"><a href="#" class="judul"><i class="material-icons">update</i> Proses Rehabilitasi Klien </a></li>
                                                   
                                                </div>
                                            </div>
                                        </nav>
                                    </div>
                                </div>
                                <!-- Secondary Nav END -->
                            </div>
                            <!-- Row END -->

                            <!-- Perihal START -->
                            <div class="row">
                                <div class="card blue lighten-5">
                                    <div class="card-content col s5">
                                    
                                        <p><p class="description">Klien&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: '.$row['isi'].'</p>
                                        <p><p class="description">Agama&nbsp;: '.$row['agama'].'</p>
                                        <p><p class="description">Status&nbsp;&nbsp;: '.$row['status_perkawinan'].'</p>
                                    </div>
                                    <div class="card-content col s3">
                                    <a class="btn small blue lighten-5 tooltipped black-text"data-position="left" data-tooltip="Kolola Wali Klien" href="?page=tsm&act=wp&id_surat='.$row['id_surat'].'">
                                                    <i class="material-icons">person_pin</i> Wali</a>
                                    </div>
                                </div>
                            </div>
                            <!-- Perihal END -->';

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
                            echo '
                    <!-- Row form Start -->
                    <div class="row jarak-card">
                        <div class="col m12">
                            <div class="card">
                                <div class="card-content">
                                    <table>
                                        <thead class="blue lighten-5 blue-text">
                                            <div class="confir blue-text"><i class="material-icons md-36">slow_motion_video</i>
                                            Data Hasil Scrining Klien<i class="material-icons md-36 right">call_received</i></div>
                                        </thead>';
                                        $query2 = mysqli_query($config, "SELECT * FROM tbl_scrining JOIN tbl_surat_masuk ON tbl_scrining.id_surat = tbl_surat_masuk.id_surat WHERE tbl_scrining.id_surat='$id_surat'");

                                        if(mysqli_num_rows($query2) > 0){
                                            $no = 0;
                                            while($row = mysqli_fetch_array($query2)){
                                            $no++;
                                             echo '
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
                                                <td width="13%">Penyakit</td>
                                                <td width="1%">:</td>
                                                <td width="86%">';


                                                $penyakit = explode(',', $row['penyakit']);
                                                $query3 = mysqli_query($config, "SELECT * FROM tbl_kategori  WHERE id_katego IN ('1', '2', '3', '4', '5', '6', '7', '8', '9', '10')");
                                                    if(mysqli_num_rows($query3) > 0){
                                                    while($r = mysqli_fetch_array($query3)){
                                                    echo'
                                                <div class="chk">
                                                <div class="cb">';
                                                if (in_array($r['nama_katego'], $penyakit)) {
                                                echo '<div class="check">&check;</div>';
                                                }
                                                echo '
                                                </div>
                                                    <span>'.$r['nama_katego'].'</span>
                                                </div>';
                                                    }
                                                }
                                                echo '
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
                                <td width="15%"></td>
                                     <a class="btn small purple accent-3 waves-effect waves-light" href="?page=tsm&act=scr&id_surat='.$id_surat.'&sub=edit_s&id_scrining='.$row['id_scrining'].'">
                                        <i class="material-icons">edit</i> EDIT</a>
                                    <a class="btn small blue waves-effect waves-light" href="?page=tsm&act=scr&id_surat='.$id_surat.'&sub=del_s&id_scrining='.$row['id_scrining'].'"><i class="material-icons">delete</i> Hapus</a>
                                <td width="85%">
                                    <a class="btn Large deep-orange waves-effect waves-light tooltipped" data-position="right" data-tooltip="Tombol ini akan menprint surat pernyataan rawat jalan" href="?page=tsm&act=scr&id_surat='.$id_surat.'&sub=cprj&id_surat='.$id_surat.'" target="_blank">
                                    <i class="material-icons">print</i> PRINT RAJAL
                                    </a>
                                    <a class="btn Large deep-orange waves-effect waves-light tooltipped" data-position="right" data-tooltip="Tombol ini akan menprint surat rekomendasi ke Balai Rehabilitasi untuk di rawat inap" href="?page=tsm&act=scr&id_surat='.$id_surat.'&sub=cprj&id_surat='.$id_surat.'" target="_blank">
                                    <i class="material-icons">print</i> PRINT RANAP
                                    </a>
                                </td>
    
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Row form END -->';
                }
                    } else {
                        echo '<tr><td colspan="5"><center><p class="add">Tidak ada data hasil Scrinang untuk ditampilkan.</p>
                            <a class="btn small blue waves-effect waves-light white-text" href="?page=tsm&act=scr&id_surat='.$row['id_surat'].'&sub=add_s"><b>Scrinang Sekarang</b></a></center></td></tr>';
                            }
                    echo '</tbody></table>

                        </div>
                       
                    <!-- Row form END -->';
                    }
                }
            }
        }
    }
?>
<!-- Include penjadwalan START -->
<?php
         //pagging
            $limit = 8;
            $pg = @$_GET['pg'];
                if(empty($pg)){
                    $curr = 0;
                    $pg = 1;
                } else {
                    $curr = ($pg - 1) * $limit;
                }
                
                $id_surat = $_REQUEST['id_surat'];

                $query = mysqli_query($config, "SELECT * FROM tbl_surat_masuk WHERE id_surat='$id_surat'");

                if(mysqli_num_rows($query) > 0){
                    $no = 1;
                    while($row = mysqli_fetch_array($query)){

                    if($_SESSION['id_user'] != $row['id_user'] AND $_SESSION['id_user'] != 1 AND $_SESSION['admin'] != 2){
                        echo '<script language="javascript">
                                window.alert("ERROR! Anda tidak memiliki hak akses untuk melihat data ini");
                                window.location.href="./admin.php?page=tsm";
                              </script>';
                    } else {

                            echo '
                            <!-- Row form Start -->
                            <div class="row jarak-form">
                                <div class="col m12" id="colres">
                                    <table class="bordered" id="tbl">
                                        <thead class="blue lighten-4" id="head">
                                            <tr width="0%"><center>
                                                <div class="form blue lighten-4 black-text"><i class="material-icons md-36">slow_motion_video</i> Data Hasil Konseling Pertemuan<i class="material-icons md-36 right">call_received</i>
                                            </div></center></tr>
                                            <tr>
                                                <th width="6%"><center>Pertemuan Ke</center></th>
                                                <th width="10%">Waktu<br/>Tanggal</th>
                                                <th width="22%">Keterangan</th>
                                                <th width="32%">Status Konseling</th>
                                                <th width="30%">Tindakan</th>
                                            </tr>
                                        </thead>
                                        <tbody>';

                                        $query4 = mysqli_query($config, "SELECT * FROM tbl_disposisi JOIN tbl_surat_masuk ON tbl_disposisi.id_surat = tbl_surat_masuk.id_surat WHERE tbl_disposisi.id_surat='$id_surat'");

                                        if(mysqli_num_rows($query4) > 0){
                                            $no = 0;
                                            while($row = mysqli_fetch_array($query4)){
                                            $no++;
                                             echo '
                                                <tr>
                                                    <td><center>'.$no.'</center></td>
                                                    <td>'.$row['sifat'].'<br/>'.indoDate($row['batas_waktu']).'</td>
                                                    <td>'.$row['isi_disposisi'].'</td>
                                                    <td>Yes/No</td>

                                                    <td>
                                                        <a class="btn small blue lighten-3 waves-light black-text" href="?page=tsm&act=disp&id_surat='.$id_surat.'&sub=ass&id_disposisi='.$row['id_disposisi'].'"><i class="material-icons">record_voice_over</i> Konseling</a>
                                                        <a class="btn small deep-orange waves-light" href="?page=tsm&act=disp&id_surat='.$id_surat.'&sub=edit&id_disposisi='.$row['id_disposisi'].'">
                                                            <i class="material-icons">edit</i> EDIT</a>
                                                        <a class="btn small deep-orange waves-light" href="?page=tsm&act=disp&id_surat='.$id_surat.'&sub=del&id_disposisi='.$row['id_disposisi'].'"><i class="material-icons">delete</i> DEL</a>
                                                    </td>
                                            </tr>';
                                            }
                                        } else {
                                            echo '<tr><td colspan="5"><center><p class="add">Tidak ada data Waktu Janjian & Konseling untuk ditampilkan. <br><u><a class="btn small blue waves-effect waves-light white-text" href="?page=tsm&act=disp&id_surat='.$row['id_surat'].'&sub=add">Tambah data baru</a></u></p></center></td></tr>';
                                           
                                        }
                                echo '</tbody>
                                </table>
                                </div>

                            </div>
                            <div class"form">
                            <a class="btn small blue lighten-4 waves-effect waves-light black-text" href="?page=tsm&act=disp&id_surat='.$row['id_surat'].'&sub=add"><i class="material-icons">edit</i>Tambah Jadwal Konseling</a>
                            </div>
                            <!-- Row form END -->';
                    }
                }
            }
        
    
?>

<!-- Include penjadwalan AND -->
