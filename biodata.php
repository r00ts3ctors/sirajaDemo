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
                echo'<div class="row jarak-form">
                        <div class="collapsible-header white"><span class="add">Data Anda</span><i class="material-icons md-prefix md-36">assignment_ind</i>
                        </div>
                        <ul class="collapsible purple lighten-2" data-collapsible="accordion">
                            <li>
                                <div class="collapsible-header white"><span class="add">Klik Untuk Tampilkan</span><i class="material-icons md-prefix md-36">touch_app</i></div>
                                    <div class="collapsible-body white">
                                        <div class="col m12 white">
                                            <table>
                                                <tbody>
                                                    <tr>
                                                        <td width="13%">No. Rekam Medis</td>
                                                        <td width="1%">:</td>
                                                        <td width="86%">'.$row['no_agenda'].'</td>
                                                    </tr>
                                                    <tr>
                                                        <td width="13%">No. Hp</td>
                                                        <td width="1%">:</td>
                                                        <td width="86%">'.$row['kode'].'</td>
                                                    </tr>
                                                    <td width="13%">No. KK</td>
                                                    <td width="1%">:</td>
                                                    <td width="86%">'.$row['indeks'].'</td>
                                                    </tr>
                                                    <tr>
                                                    <td width="13%">Pengirim</td>
                                                    <td width="1%">:</td>
                                                    <td width="86%">'.$row['isi'].'</td>
                                                    </tr>
                                                    <tr>
                                                        <td width="13%">Alamat</td>
                                                        <td width="1%">:</td>
                                                        <td width="86%">'.$row['asal_surat'].'</td>
                                                    </tr>
                                                    <tr>
                                                        <td width="13%">No. NIK</td>
                                                        <td width="1%">:</td>
                                                        <td width="86%">'.$row['no_surat'].'</td>
                                                    </tr>
                                                    <tr>
                                                        <td width="13%">Tanggal Lahir</td>
                                                        <td width="1%">:</td>
                                                        <td width="86%">'.indoDate($row['tgl_surat']).'</td
                                                    </tr>
                                                    <tr>
                                                        <td width="13%">Suku</td>
                                                        <td width="1%">:</td>
                                                        <td width="86%">'.$row['keterangan'].'</td>
                                                    </tr>
                                                    <tr>
                                                        <td width="13%">Jenis Kelamin</td>
                                                        <td width="1%">:</td>
                                                        <td width="86%">'.$row['jenis_kelamin'].'</td>
                                                    </tr>
                                                    <tr>
                                                        <td width="13%">Agama</td>
                                                        <td width="1%">:</td>
                                                        <td width="86%">'.$row['agama'].'</td>
                                                    </tr>
                                                    <tr>
                                                        <td width="13%">Tempat Lahir</td>
                                                        <td width="1%">:</td>
                                                        <td width="86%">'.$row['tempat_lahir'].'</td>
                                                    </tr>
                                                    <tr>
                                                        <td width="13%">Status</td>
                                                        <td width="1%">:</td>
                                                        <td width="86%">'.$row['status_perkawinan'].'</td>
                                                    </tr>
                                                    <tr>
                                                        <td width="13%">Pekerjaan</td>
                                                        <td width="1%">:</td>
                                                        <td width="86%">'.$row['pekerjaan'].'</td>
                                                    </tr>
                                                    <tr>
                                                        <td width="13%">kewarganegaraan</td>
                                                        <td width="1%">:</td>
                                                        <td width="86%">'.$row['kewarganegaraan'].'</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        ';

                        if(empty($row['file'])){
                            echo '';
                        } else {

                            $ekstensi = array('jpg','png','jpeg');
                            $ekstensi2 = array('doc','docx');
                            $file = $row['file'];
                            $x = explode('.', $file);
                            $eks = strtolower(end($x));

                            if(in_array($eks, $ekstensi) == true){
                                echo '<img class="gbr" data-caption="'.date('d M Y', strtotime($row['tgl_diterima'])).'" src="./upload/surat_masuk/'.$row['file'].'"/>';
                            } else {

                                if(in_array($eks, $ekstensi2) == true){
                                    echo '
                                    <div class="gbr">
                                        <div class="row">
                                            <div class="col s12">
                                                <div class="col s9 left">
                                                    <div class="card">
                                                        <div class="card-content">
                                                            <p>File lampiran Klien ini bertipe <strong>document</strong>, silakan klik link dibawah ini untuk melihat file lampiran tersebut.</p>
                                                        </div>
                                                        <div class="card-action">
                                                            <strong>Lihat file :</strong> <a class="blue-text" href="./upload/surat_masuk/'.$row['file'].'" target="_blank">'.$row['file'].'</a>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col s3 right">
                                                    <img class="file" src="./asset/img/word.png">
                                                </div>
                                            </div>
                                        </div>
                                    </div>';
                                } else {
                                    echo '
                                    <div class="gbr">
                                        <div class="row">
                                            <div class="col s12">
                                                <div class="col s9 left">
                                                    <div class="card">
                                                        <div class="card-content">
                                                            <p>File lampiran Klien ini bertipe <strong>PDF</strong>, silakan klik link dibawah ini untuk melihat file lampiran tersebut.</p>
                                                        </div>
                                                        <div class="card-action">
                                                            <strong>Lihat file :</strong> <a class="blue-text" href="./upload/surat_masuk/'.$row['file'].'" target="_blank">'.$row['file'].'</a>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col s3 right">
                                                    <img class="file" src="./asset/img/pdf.png">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    ';
                                }
                            }
                        } echo '
                    
                    </div></br><button onclick="window.history.back()" class="btn-large blue waves-effect waves-light left"><i class="material-icons">arrow_back</i> KEMBALI</button>';
            }
        }
    }
?>
