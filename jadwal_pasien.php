<?php
    //cek session
    if(empty($_SESSION['admin'])){
        $_SESSION['err'] = '<center>Anda harus login terlebih dahulu!</center>';
        header("Location: ./");
        die();
    } else {
        

        $id_surat = mysqli_real_escape_string($config, $_SESSION['username']);
        $query = mysqli_query($config, "SELECT id_surat, no_agenda, no_surat, asal_surat, nama, tempat_lahir, jenis_kelamin, agama, status_perkawinan, pekerjaan, kewarganegaraan, isi, kode, indeks, tgl_surat,tgl_diterima, file, keterangan, id_user FROM tbl_surat_masuk WHERE no_surat='$id_surat'");
        if(mysqli_num_rows($query) > 0){
                    $no = 1;
                    while($row = mysqli_fetch_array($query)){

                      echo '<!-- Row Start -->
                            <div class="row">
                                <!-- Secondary Nav START -->
                                <div class="col s12">
                                    <div class="z-depth-1">
                                        <nav class="secondary-nav">
                                            <div class="nav-wrapper blue-grey darken-1">
                                                <div class="col m12">
                                                    <ul class="left">
                                                        <li class="waves-effect waves-light hide-on-small-only"><a href="#" class="judul"><i class="material-icons">update</i> Jadwal Dengan Klien </a></li>
                                                        <li class="waves-effect waves-light">
                                                            <a href="?page=tsm&act=disp&id_surat='.$row['id_surat'].'&sub=add"><i class="material-icons md-24">alarm_add</i> Tambah Waktu Janjian</a>
                                                        </li>
                                                        <li class="waves-effect waves-light hide-on-small-only"><a href="?page=bdt"><i class="material-icons">keyboard_return</i> Kembali</a></li>
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
                                                <th width="6%">Pertemuan Ke</th>
                                                <th width="24%">Waktu<br/>Tanggal</th>
                                                <th width="40%">Keterangan</th>
                                                <th width="30%">Tindakan</th>
                                            </tr>
                                        </thead>
                                        <tbody>';

                                        $query2 = mysqli_query($config, "SELECT * FROM tbl_disposisi JOIN tbl_surat_masuk ON tbl_disposisi.id_surat = tbl_surat_masuk.id_surat WHERE tbl_disposisi.id_surat='$id_surat'");

                                        if(mysqli_num_rows($query2) > 0){
                                            $no = 0;
                                            while($row = mysqli_fetch_array($query2)){
                                            $no++;
                                             echo '
                                                <tr>
                                                    <td>'.$no.'</td>
                                                    <td>'.$row['sifat'].'<br/>'.indoDate($row['batas_waktu']).'</td>
                                                    <td>'.$row['isi_disposisi'].'</td>

                                                    <td>
                                                        <a class="btn small deep-orange waves-effect waves-light" href="?page=tsm&act=disp&id_surat='.$id_surat.'&sub=ass&id_disposisi='.$row['id_disposisi'].'"><i class="material-icons">record_voice_over</i>Assesmen</a>
                                                        <a class="btn small blue waves-effect waves-light" href="?page=tsm&act=disp&id_surat='.$id_surat.'&sub=edit&id_disposisi='.$row['id_disposisi'].'">
                                                            <i class="material-icons">edit</i> EDIT</a>
                                                        <a class="btn small blue waves-effect waves-light" href="?page=tsm&act=disp&id_surat='.$id_surat.'&sub=del&id_disposisi='.$row['id_disposisi'].'"><i class="material-icons">delete</i> DEL</a>
                                                    </td>
                                            </tr>';
                                            }
                                        } else {
                                            echo '<tr><td colspan="5"><center><p class="add">Tidak ada data Waktu Janjian untuk ditampilkan. <u><a href="?page=tsm&act=disp&id_surat='.$row['id_surat'].'&sub=add">Tambah data baru</a></u></p></center></td></tr>';
                                        }
                                echo '</tbody></table>
                                </div>
                            </div>
                            <!-- Row form END -->';
            }
        }
    }
?>
