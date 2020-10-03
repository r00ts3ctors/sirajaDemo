<?php
    //cek session
    if(empty($_SESSION['admin'])){
        $_SESSION['err'] = '<center>Anda harus login terlebih dahulu!</center>';
        header("Location: ./");
        die();
    } else {

        echo '
            <style type="text/css">
                .hidd {
                    display: none
                }
                @media print{
                    body {
                        font-size: 12px!important;
                        color: #212121;
                    }
                    .disp {
                        text-align: center;
                        margin: -.5rem 0;
                        width: 100%;
                    }
                    nav {
                        display: none
                    }
                    .hidd {
                        display: block
                    }
                    .logodisp {
                        position: absolute;
                        width: 80px;
                        height: 80px;
                        left: 50px;
                        margin: 0 0 0 1.2rem;
                    }
                    .up {
                        font-size: 17px!important;
                        font-weight: normal;
                        margin-top: 45px;
                        text-transform: uppercase
                    }
                    #nama {
                        font-size: 20px!important;
                        text-transform: uppercase;
                        margin-top: 5px;
                        font-weight: bold;
                    }
                    .status {
                        font-size: 17px!important;
                        font-weight: normal;
                        margin-top: -1.5rem;
                    }
                    #alamat {
                        margin-top: -15px;
                        font-size: 13px;
                    }
                    .separator {
                        border-bottom: 2px solid #616161;
                        margin: 1rem 0;
                    }
                }
            </style>';

        $aktip = false;
        $dari_tanggal = "2020-01-01";
        $sampai_tanggal = "2021-01-01";
        if(isset($_SESSION['dari_tanggal'])){
            $aktip = true;
            $dari_tanggal = $_SESSION['dari_tanggal'];
        }
        
        if(isset($_SESSION['sampai_tanggal'])){
            $aktip = true;
            $dari_tanggal = $_SESSION['sampai_tanggal'];
        }
        if(isset($_REQUEST['SUBMIT-klinik']) && !empty($_REQUEST['klinik'])){
            $aktip = true;
            $_SESSION['klinik'] =  $_REQUEST['klinik'];
        }else if(isset($_REQUEST['SUBMIT-klinik']) && empty($_REQUEST['klinik'])){
            unset($_SESSION['klinik']);
        }
        if(isset($_REQUEST['SUBMIT-kota']) && !empty($_REQUEST['kota'])){
            $aktip = true;
            $_SESSION['kota'] =  $_REQUEST['kota'];
        }else if (isset($_REQUEST['SUBMIT-kota']) && empty($_REQUEST['kota'])){
            unset($_SESSION['kota']);
        }
        if(isset($_REQUEST['submit']) || $aktip){

            $dari_tanggal = $_REQUEST['dari_tanggal'];
            $sampai_tanggal = $_REQUEST['sampai_tanggal'];
            $_SESSION['dari_tanggal'] = $dari_tanggal;
            $_SESSION['sampai_tanggal'] = $sampai_tanggal;
            
            $where_admin = "";
            $klinik = null;
            $kota = null;
            
            if(isset($_SESSION['klinik']) && !empty($_SESSION['klinik'])){
                //$klinik = $_SESSION['klinik'];
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
                $where_admin = "and a.asal_surat like '%" . $kota ."%'";
            }
            
            if($_REQUEST['dari_tanggal'] == "" || $_REQUEST['sampai_tanggal'] == ""){
                header("Location: ./admin.php?page=asm");
                die();
            } else {
                if($_SESSION['admin'] == 3){
                    $query = mysqli_query($config, "SELECT a.*,b.nama AS nama_klinik, c.usia_pakai, c.penyakit, d.psikiatris,d.resume_masalah FROM tbl_surat_masuk a  LEFT JOIN tbl_klasifikasi b ON a.klinik = b.id_klasifikasi LEFT JOIN tbl_scrining c ON a.id_surat = c.id_surat LEFT JOIN tbl_asesmen d ON a.id_surat = d.id_surat WHERE a.tgl_diterima BETWEEN '$dari_tanggal' AND '$sampai_tanggal' AND a.id_user='".$_SESSION['id_user']."'");
                } else {
                    $query = mysqli_query($config, "SELECT a.*,b.nama AS nama_klinik, c.usia_pakai, c.penyakit, d.psikiatris,d.resume_masalah FROM tbl_surat_masuk a  LEFT JOIN tbl_klasifikasi b ON a.klinik = b.id_klasifikasi LEFT JOIN tbl_scrining c ON a.id_surat = c.id_surat LEFT JOIN tbl_asesmen d ON a.id_surat = d.id_surat WHERE a.tgl_diterima BETWEEN '$dari_tanggal' AND '$sampai_tanggal' $where_admin");
                }
                

                $query2 = mysqli_query($config, "SELECT nama FROM tbl_instansi");
                list($nama) = mysqli_fetch_array($query2);

                echo '
                    <!-- SHOW DAFTAR AGENDA -->
                    <!-- Row Start -->
                    <div class="row">
                        <!-- Secondary Nav START -->
                        <div class="col s12">
                            <div class="z-depth-1">
                                <nav class="secondary-nav">
                                    <div class="nav-wrapper blue-grey darken-1">
                                        <div class="col 12">
                                            <ul class="left">
                                                <li class="waves-effect waves-light"><a href="?page=asm" class="judul"><i class="material-icons">print</i>Lihat & Cetak Resume Klien<a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </nav>
                            </div>
                        </div>
                        <!-- Secondary Nav END -->
                    </div>
                    <!-- Row END -->

                    <!-- Row form Start -->
                    <div class="row jarak-form black-text">
                        <form class="col s12" method="post" action="">
                            <div class="input-field col s3">
                                <i class="material-icons prefix md-prefix">date_range</i>
                                <input id="dari_tanggal" type="text" name="dari_tanggal" id="dari_tanggal" required value="';echo $dari_tanggal;echo '">
                                <label for="dari_tanggal">Dari Tanggal</label>
                            </div>
                            <div class="input-field col s3">
                                <i class="material-icons prefix md-prefix">date_range</i>
                                <input id="sampai_tanggal" type="text" name="sampai_tanggal" id="sampai_tanggal" required value="';echo $sampai_tanggal;echo '">
                                <label for="sampai_tanggal">Sampai Tanggal</label>
                            </div>
                            <div class="col s6">
                                <button type="submit" name="submit" class="btn-large blue waves-effect waves-light"> TAMPILKAN <i class="material-icons">visibility</i></button>
                            </div>
                        </form>
                    </div>
                    <!-- Row form END -->

                    <div class="row agenda">
                    <div class="disp hidd">';
                        $query2 = mysqli_query($config, "SELECT institusi, nama, status, alamat, logo FROM tbl_instansi");
                        list($institusi, $nama, $status, $alamat, $logo) = mysqli_fetch_array($query2);
                            echo '<img class="logodisp" src="./upload/'.$logo.'"/>';

                            echo '<h6 class="up">'.$institusi.'</h6>';

                            echo '<h5 class="nama" id="nama">'.$nama.'</h5><br/>';

                            echo '<h6 class="status">'.$status.'</h6>';

                            echo '<span id="alamat">'.$alamat.'</span>

                    </div>
                    <div class="separator"></div>
                    <h5 class="hid">RESUME Klien</h5>

                        <div class="col s10">
                            <p class="warna agenda">Resume Klien dari tanggal <strong>'.indoDate($dari_tanggal).'</strong> sampai dengan tanggal <strong>'.indoDate($sampai_tanggal).'</strong></p>
                        </div>
                        <div class="col s2">
                            <button type="submit" onClick="window.print()" class="btn-large deep-orange waves-effect waves-light right">CETAK <i class="material-icons">print</i></button>
                        </div>
<!-- modal-kota -->
                                            <div id="modal-kota" class="modal">
                                                <div class="modal-content white">
                                                    <h5>Pilih kota yang ditampilkan di halaman</h5>';
                                                    $kota_query = mysqli_query($config, "SELECT id,nama_kota FROM tbl_kota");
                                                    $kota_hasil = mysqli_fetch_all($kota_query);
                                                    echo '
                                                    <div class="row">
   
                                                        <form method="post" action="">
                                                        <input id="dari_tanggal" type="text" name="dari_tanggal" id="dari_tanggal" required value="';if(isset($_SESSION['dari_tanggal'])){echo  $_SESSION['dari_tanggal'];};echo '" style="visibility: hidden !important">
                                                         <input id="sampai_tanggal" type="text" name="sampai_tanggal" id="sampai_tanggal" required value="';if(isset($_SESSION['sampai_tanggal'])){echo  $_SESSION['sampai_tanggal'];};echo '" style="visibility: hidden !important">
                                                          <div class="input-field col s12">

                                                            <select class="browser-default validate" name="kota">';
                                                            if(!isset($_SESSION['kota'])){
                                                                echo '<option value="" disabled selected>Tampilkan semua</option>';
                                                                foreach($kota_hasil as $k=>$v) {
                                                                    echo "<option value=" . $v[0] . ">" . $v[1] ."</option>";
                                                                }
                                                            } else {
                                                                  echo '<option value="">Tampilkan semua</option>';
                                                                  foreach($kota_hasil as $k=>$v) {
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
                                                                <button type="submit" class="modal-action waves-effect waves-green btn-flat" name="SUBMIT-kota">SUBMIT</button>';
                                                                if(isset($_REQUEST['SUBMIT-kota'])){ 
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
<!-- modal-klinik -->
                                            <div id="modal-klinik" class="modal">
                                                <div class="modal-content white">
                                                    <h5>Pilih klinik yang ditampilkan di halaman</h5>';
                                                    $query_klinik = mysqli_query($config, "SELECT id_klasifikasi as id,nama FROM tbl_klasifikasi");
                                                    $klinik_hasil = mysqli_fetch_all($query_klinik);
                                                    echo '
                                                    <div class="row">
                                                        <form method="post" action="">
                                                        <input id="dari_tanggal" type="text" name="dari_tanggal" id="dari_tanggal" required value="';if(isset($_SESSION['dari_tanggal'])){echo  $_SESSION['dari_tanggal'];};echo '" style="visibility: hidden !important">
                                                         <input id="sampai_tanggal" type="text" name="sampai_tanggal" id="sampai_tanggal" required value="';if(isset($_SESSION['sampai_tanggal'])){echo  $_SESSION['sampai_tanggal'];};echo '" style="visibility: hidden !important">
                                                          
                                                          <div class="input-field col s12">
                                                            <select class="browser-default validate" name="klinik">
                                                              
                                                                ';
                                                                if(!isset($_SESSION['klinik'])){
                                                                    echo '<option value="" disabled selected>Tampilkan semua</option>';
                                                                    foreach($klinik_hasil as $k=>$v) {
                                                                        echo "<option value=" . $v[0] . ">" . $v[1] ."</option>";
                                                                    }
                                                                } else {
                                                                    echo '<option value="">Tampilkan semua</option>';
                                                                    foreach($klinik_hasil as $k=>$v) {
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
                                                                <button type="submit" class="modal-action waves-effect waves-green btn-flat" name="SUBMIT-klinik">SUBMIT</button>
                                                               
                                                                <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Batal</a>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        <!-- ./modal-klinik -->

                    </div>
                    <div id="colres" class="warna cetak">
                        <table class="bordered" id="tbl" width="100%">
                            <thead class="blue lighten-4">
                                <tr>
                                    <th width="3%">No. Rekam Medis</th>
                                    <th width="5%">No. Hp</th>
                                    <th width="8%">Pengirim</th>
                                    <th width="8%">Alamat<span class="right tooltipped" data-position="left" data-tooltip="Atur kota yang ditampilkan"><a class="modal-trigger" href="#modal-kota"><i class="material-icons" style="color: #333;">home</i></a></span></th>
                                    <th width="8%">Nomor NIK</th>
                                    <th width="8%">Tanggal Lahir<br/> Klien</th>
                                    <th width="8%">Tanggal Mulai</th>
                                    <th width="8%">Penerima</th>
                                    <th width="8%">Suku</th>
                                    <th width="5%">Dokter</th>
                                    <th width="5%">Resume masalah</th>
                                    <th width="5%">Penyakit</th>
                                    <th width="5%">Usia Pakai</th>
                                    <th width="8%">Klinik<span class="right tooltipped" data-position="left" data-tooltip="Atur klinik yang ditampilkan"><a class="modal-trigger" href="#modal-klinik"><i class="material-icons" style="color: #333;">local_hospital</i></a></span></th>
                                </tr>
                            </thead>

                            <tbody>';

                            if(mysqli_num_rows($query) > 0){
                                $no = 0;
                                while($row = mysqli_fetch_array($query)){
                                 echo '
                                 <tr>
                                        <td>'.$row['no_agenda'].'</td>
                                        <td>'.$row['kode'].'</td>
                                        <td>'.$row['isi'].'</td>
                                        <td>'.$row['asal_surat'].'</td>
                                        <td>'.$row['no_surat'].'</td>
                                        <td>'.indoDate($row['tgl_surat']).'</td>
                                        <td>'.indoDate($row['tgl_diterima']).'</td>

                                        <td>';

                                        $id_user = $row['id_user'];
                                        $query3 = mysqli_query($config, "SELECT nama FROM tbl_user WHERE id_user='$id_user'");
                                        list($nama) = mysqli_fetch_array($query3);{
                                            $row['id_user'] = ''.$nama.'';
                                        }

                                        echo ''.$row['id_user'].'</td>
                                        
                                        <td>'.$row['keterangan'].'</td>
                                        <td>'.$row['psikiatris'].'</td>
                                        <td>'.$row['resume_masalah'].'</td>
                                        <td>'.$row['penyakit'].'</td>
                                        <td>'.$row['usia_pakai'].'</td>
                                        <td>';echo $row['nama_klinik'];echo '</td>
                                </tr>';
                                }
                            } else {
                                echo '<tr><td colspan="9"><center><p class="add">Tidak ada Resume Klien</p></center></td></tr>';
                            } echo '
                        </tbody></table>
                    </div>';
            }
        } else {

            echo '
                <!-- Row Start -->
                <div class="row">
                    <!-- Secondary Nav START -->
                    <div class="col s12">
                        <div class="z-depth-1">
                            <nav class="secondary-nav">
                                <div class="nav-wrapper blue-grey darken-1">
                                    <div class="col 12">
                                        <ul class="left">
                                            <li class="waves-effect waves-light"><a href="?page=ask" class="judul"><i class="material-icons">print</i> Lihat & Cetak Resume Klien<a></li>
                                        </ul>
                                    </div>
                                </div>
                            </nav>
                        </div>
                    </div>
                    <!-- Secondary Nav END -->
                </div>
                <!-- Row END -->

                <!-- Row form Start -->
                <div class="row jarak-form black-text">
                    <form class="col s12" method="post" action="">
                        <div class="input-field col s3">
                            <i class="material-icons prefix md-prefix">date_range</i>
                            <input id="dari_tanggal" type="text" name="dari_tanggal" id="dari_tanggal" required value="';if(isset($_SESSION['dari_tanggal'])){echo  $_SESSION['dari_tanggal'];};echo '">
                            <label for="dari_tanggal">Dari Tanggal</label>
                        </div>
                        <div class="input-field col s3">
                            <i class="material-icons prefix md-prefix">date_range</i>
                            <input id="sampai_tanggal" type="text" name="sampai_tanggal" id="sampai_tanggal" required value="';if(isset($_SESSION['sampai_tanggal'])){echo  $_SESSION['sampai_tanggal'];};echo '">
                            <label for="sampai_tanggal">Sampai Tanggal</label>
                        </div>
                        <div class="col s6">
                            <button type="submit" name="submit" class="btn-large blue waves-effect waves-light"> TAMPILKAN <i class="material-icons">visibility</i></button>
                        </div>
                    </form>
                </div>

                <!-- Row form END -->';
        }
    }
?>
