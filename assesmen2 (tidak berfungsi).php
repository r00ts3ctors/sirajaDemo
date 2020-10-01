<?php
    //cek session
    if(empty($_SESSION['admin'])){
        $_SESSION['err'] = '<center>Anda harus login terlebih dahulu!</center>';
        header("Location: ./");
        die();
    } else {

        if(isset($_REQUEST['sub1'])){
            $sub1 = $_REQUEST['sub1'];
            switch ($sub1) {
                case 'add_a':
                    include "tambah_assesmen.php";
                    break;
                case 'edit_a':
                    include "edit_assesmen.php";
                    break;
                case 'del_a':
                    include "hapus_assesmen.php";
                    break;
                case 'ass':
                    include "assesmen.php";
                    break;
     
           }
        } else {

                $id_disposisi = mysqli_real_escape_string($config, $_REQUEST['id_disposisi']);
                
                $query3 = mysqli_query($config, "SELECT * FROM tbl_disposisi JOIN tbl_surat_masuk ON tbl_disposisi.id_disposisi = tbl_surat_masuk.id_disposisi WHERE tbl_disposisi.id_disposisi='$id_disposisi'");

                if(mysqli_num_rows($query3) > 0){
                    $no = 1;
                     $row = mysqli_fetch_array($query3);{

                
                echo '
                            <!-- Perihal START -->
                            <div class="row jarak-card">
                                <div class="col m12">
                                    <div class="card">
                                        <div class="card-content">
                                            <table>
                                                <thead class="blue lighten-5 blue-text">
                                                    <div class="confir red-text"><i class="material-icons md-36">update</i>Berikut data singkat Klien dan Waktu Janjian</div>
                                                </thead>

                                                <tbody>
                                                    <tr>
                                                        <td width="13%">Nama</td>
                                                        <td width="1%">:</td>
                                                        <td width="86%">'.$row['nama'].'</td>
                                                    </tr>
                                                    <tr>
                                                        <td width="13%">No. KTP</td>
                                                        <td width="1%">:</td>
                                                        <td width="86%">'.$row['no_surat'].'</td>
                                                    </tr>
                                                    <tr>
                                                        <td width="13%">Pekerjaan</td>
                                                        <td width="1%">:</td>
                                                        <td width="86%">'.$row['pekerjaan'].'</td>
                                                    </tr>
                                                    <tr>
                                                        <td width="13%">Nomor Hp</td>
                                                        <td width="1%">:</td>
                                                        <td width="86%">'.$row['kode'].'</td>
                                                    </tr>
                                                    <tr>
                                                        <td width="13%">Jam</td>
                                                        <td width="1%">:</td>
                                                        <td width="86%">'.$row['sifat'].'</td>
                                                    </tr>
                                                    <tr>
                                                        <td width="13%">Tanggal</td>
                                                        <td width="1%">:</td>
                                                        <td width="86%">'.$row['batas_waktu'].'</td>
                                                    </tr>
                                                    <tr>
                                                        <td width="13%">Keterangan</td>
                                                        <td width="1%">:</td>
                                                        <td width="86%">'.$row['isi_disposisi'].'</td>
                                                    </tr>      
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>';

                            
                         
                
                        ?><?php

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

                            
        $id_disposisi = mysqli_real_escape_string($config, $_REQUEST['id_disposisi']);
        $query = mysqli_query($config, "SELECT * FROM tbl_asesmen WHERE id_disposisi='$id_disposisi'");

        if(mysqli_num_rows($query) > 0){
            $no = 1;
            while($row = mysqli_fetch_array($query)){
                echo '
                <!-- Row form Start -->
                <div class="row jarak-card">
                    <div class="col m12">
                    <div class="card">
                        <div class="card-content">
                        <table>
                            <thead class="red lighten-5 red-text">
                                <div class="confir red-text"><i class="material-icons md-36">record_voice_over</i>
                                Hasil Assessment</div>
                            </thead>

                            <tbody>
                                <tr>
                                    <td width="13%">Opsi</td>
                                    <td width="1%">:</td>
                                    <td width="86%">'.$row['opsi'].'</td>
                                </tr>
                                <tr>
                                    <td width="13%">Hasil Assessment</td>
                                    <td width="1%">:</td>
                                    <td width="86%">'.$row['isi_asessmen'].'</td>
                                </tr>
                                <tr>
                                    <td width="13%">Jenis</td>
                                    <td width="1%">:</td>
                                    <td width="86%">'.$row['jenis'].'</td>
                                </tr>';
                            }
                        } else {
                        echo '
                                <div class="row jarak-card">
                                    <div class="col m12">
                                        <div class="card">
                                            <div class="card-content">
                                                <table>
                                                    <thead class="red lighten-5 red-text">
                                                        <div class="confir red-text"><i class="material-icons md-36">record_voice_over</i>Hasil Assessment
                                                        </div>
                                                    </thead>

                                                <tbody>
                                                    <td colspan="5"><center><p class="add">Klien ini belum di Assessment. <u><a class="btn-large blue waves-effect waves-light white-text" href="?page=tsm&act=disp&id_disposisi='.$row['id_disposisi'].'&sub=ass&id_disposisi='.$row['id_disposisi'].'&sub1=add_a">Tambah data baru</a></p></center></td>
                                                </tbody> 
                                            </table>
                                        </div>
                                    </tbody> 
                                </table>
                            </div>
                        <div class="card-action">
                            <a href="?page=tsm&act=disp&id_surat='.$row['id_surat'].'" class="btn-large deep-orange waves-effect waves-light white-text">Kembali <i class="material-icons">keyboard_return</i>
                            </a>
                        </div>

                    </div>
                </div>
            </div>
            <!-- Row form END -->';
                   }
                }
            }
        }   
    }
?>
