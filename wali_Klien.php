<?php
    //cek session
    if(empty($_SESSION['admin'])){
        $_SESSION['err'] = '<center>Anda harus login terlebih dahulu!</center>';
        header("Location: ./");
        die();
    } else {

        if(isset($_REQUEST['sub'])){
            $sub = $_REQUEST['sub'];
            switch ($sub) {
                
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
            $limit = 5;
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
                                            <div class="nav-wrapper blue-grey darken-1">
                                                <div class="col m12">
                                                    <ul class="left">
                                                        <li class="waves-effect waves-light hide-on-small-only"><a href="#" class="judul"><i class="material-icons">description</i> Wali Klien</a></li>
                                                        <li class="waves-effect waves-light">
                                                            <a href="?page=tsm&act=wp&id_surat='.$row['id_surat'].'&sub=add_wal"><i class="material-icons md-24">add_circle</i> Tambah Wali Klien</a>
                                                        </li>
                                                        <li class="waves-effect waves-light hide-on-small-only"><a href="?page=tsm"><i class="material-icons">arrow_back</i> Kembali</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </nav>
                                    </div>
                                </div>
                                <!-- Secondary Nav END -->
                            </div>
                            <!-- Row END -->

                            <!-- Perihal START -->
                            <div class="col s12">
                                <div class="card blue lighten-5">
                                    <div class="card-content">
                                        <p><p class="description">Klien&nbsp;&nbsp;: '.$row['isi'].'</p>
                                        <p><p class="description">Agama&nbsp;: '.$row['agama'].'</p>
                                        <p><p class="description">Status&nbsp;&nbsp;: '.$row['status_perkawinan'].'</p>
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
                            <div class="row jarak-form">

                                <div class="col m12" id="colres">
                                    <table class="bordered" id="tbl">
                                        <thead class="blue lighten-4" id="head">
                                            <tr>
                                                <th width="4%">No</th>
                                                <th width="20%">Nama Wali</th>
                                                <th width="14%">Pekerjaan<br/>NIK</th>
                                                <th width="12%">No Hp</th>
                                                <th width="22%">Hubungan<br/>Alamat</th>
                                                <th width="19%">Tindakan</th>
                                            </tr>
                                        </thead>
                                        <tbody>';

                                        $query2 = mysqli_query($config, "SELECT * FROM tbl_wali_Klien JOIN tbl_surat_masuk ON tbl_wali_Klien.id_surat = tbl_surat_masuk.id_surat WHERE tbl_wali_Klien.id_surat='$id_surat'");

                                        if(mysqli_num_rows($query2) > 0){
                                            $no = 0;
                                            while($row = mysqli_fetch_array($query2)){
                                            $no++;
                                             echo '
                                                <tr>
                                                    <td>'.$no.'</td>
                                                    <td>'.$row['nama_wali'].'</td>
                                                    <td>'.$row['pekerjaan_wali'].'<br/>'.$row['nik'].'</td>
                                                    <td>'.$row['no_telp'].'</td>
                                                    <td>'.$row['hubungan'].'<br/>'.$row['alamat_wali'].'</td>
                                                    <td><a class="btn small blue waves-effect waves-light" href="?page=tsm&act=wp&id_surat='.$id_surat.'&sub=edit_wal&id_wali='.$row['id_wali'].'"><i class="material-icons">edit</i> EDIT
                                                        </a>
                                                        <a class="btn small light-green darken-2 waves-effect waves-light" href="?page=tsm&act=wp&id_surat='.$id_surat.'&sub=del_wal&id_wali='.$row['id_wali'].'"><i class="material-icons">delete</i> DEL
                                                        </a>
                                                        <a class="btn small deep-orange waves-effect waves-light tooltipped" data-position="left" data-tooltip="Tombol ini akan menprint surat pernyataan wali dari Klien untuk dirawat" href="?page=tsm&act=wp&id_surat='.$id_surat.'&sub=ct_p&id_surat='.$id_surat.'" target="_blank"><i class="material-icons">print</i>PRINT PERNYATAAN
                                                        </a>
                                                    </td>
                                            </tr>';
                                            }
                                        } else {
                                            echo '<tr><td colspan="5"><center><p class="add">Tidak ada data Wali Klien untuk ditampilkan. <u><a href="?page=tsm&act=wp&id_surat='.$row['id_surat'].'&sub=add_wal">Tambah data</a></u></p></center></td></tr>';
                                        }
                                echo '</tbody></table>
                                </div>
                            </div>
                            <!-- Row form END -->';
                    }
                }
            }
        }
    }
?>
