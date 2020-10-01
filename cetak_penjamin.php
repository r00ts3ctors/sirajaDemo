<?php
    //cek session
    if(empty($_SESSION['admin'])){
        $_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login terlebih dahulu.';
        header("Location: ./");
        die();
    } else {

        echo '
        <style type="text/css">
            table {
                background: #fff;
                padding: 5px;
            }
            tr, td {
                border: none !important;
                border: none !important;
            }
            tr,td {
                vertical-align: top!important;
            }
            #right {
                border-right: none !important;
            }
            #left {
                border-left: none !important;
            }
            .isi {
                height: 300px!important;
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
            .separator {
                border-bottom: 2px solid #616161;
                margin: -1.3rem 0 1.5rem;
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
                    border: none !important;
                    border: none !important;
                    padding: 8px!important;

                }
                tr,td {
                    vertical-align: top!important;
                }
                #lbr {
                    font-size: 20px;
                }
                .isi {
                    height: 200px!important;
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
                    margin: 15px 0 0 75%;
                }
                .lead {
                    font-weight: bold;
                    text-decoration: underline;
                    margin-bottom: -10px;
                }
                #nama {
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
                .separator {
                    border-bottom: 2px solid #616161;
                    margin: -1rem 0 1rem;
                }

            }
        </style>

        <body onload="window.print()">

        <!-- Container START -->
            <div id="colres">
                <div class="disp">';
                    $query2 = mysqli_query($config, "SELECT institusi, nama, status, alamat, logo FROM tbl_instansi");
                    list($institusi, $nama, $status, $alamat, $logo) = mysqli_fetch_array($query2);
                        echo '<img class="logodisp" src="./upload/'.$logo.'"/>';
                        echo '<h5 class="up" id="nama">BADAN NARKOTIKA NASIONAL</h5><br/>';
                        echo '<h6 class="up">PROVINSI KEPULAUAN RIAU</h6>';
                        echo '<span id="alamat">'.$alamat.'</span>';
                        echo '<h9 class="up">.</h9>';
                    echo '

                </div>
                <div class="separator"></div>';

                $id_surat = mysqli_real_escape_string($config, $_REQUEST['id_surat']);
                $query = mysqli_query($config, "SELECT * FROM tbl_surat_masuk WHERE id_surat='$id_surat'");

                if(mysqli_num_rows($query) > 0){
                $no = 0;
                while($row = mysqli_fetch_array($query)){

                echo '
                    <table class="bordered" id="tbl">
                        <tbody>
                                <td class="tgh" id="lbr" colspan="5">SURAT PERNYATAAN MENJADI PENJAMIN
                            
                            <tr class="isi">
                              <td id="right" width="70%">
                                    <strong>Yang bertanda tangan dibawah ini (PENJAMIN) : </strong><br/><br/>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Nama&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : </strong>'.$row['nama'].'</br>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>No. KTP &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </strong>'.$row['indeks'].'<br/>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Tempat/Tanggal Lahir : </strong> '.$row['tempat_lahir'].','.indoDate($row['tgl_surat']).'<br/>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Alamat &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </strong>'.$row['asal_surat'].'<br/>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Pekerjaan &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </strong>'.$row['pekerjaan'].'<br/>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>No. Hp &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </strong>'.$row['kode'].'<br/><br/>
                                    <strong>Dengan ini saya BERSEDIA menjamin (TERJAMIN) :</strong><br/><br/>
                                    
                                ';
                            $query3 = mysqli_query($config, "SELECT * FROM tbl_wali_Klien JOIN tbl_surat_masuk ON tbl_wali_Klien.id_surat = tbl_surat_masuk.id_surat WHERE tbl_wali_Klien.id_surat='$id_surat'");

                            if(mysqli_num_rows($query3) > 0){
                                $no = 0;
                                $row = mysqli_fetch_array($query3);{
                                echo '
                            
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Nama&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : </strong>'.$row['nama_wali'].'<br/>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>No. KTP &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </strong>'.$row['nik'].'<br/>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Tempat/Tanggal Lahir : </strong> '.$row['tempat_lahir_wali'].','.indoDate($row['batas_waktu']).'<br/>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Alamat &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </strong>'.$row['alamat_wali'].'<br/>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Pekerjaan &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </strong>'.$row['pekerjaan_wali'].'<br/>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>No. Hp &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </strong>'.$row['no_telp'].'<br/><br/>
                                    <strong>Untuk :</strong><br/>
                                    

                                    1.  Yang bersangkutan (TERJAMIN) untuk mematuhi dan menghadiri semua jadwal kegiatan Wajib Lapor yang sudah ditetapkan oleh IPWL BNN Kota Batam dan hal tersebut merupakan konsekuensi yang wajib dijalani dari yang bersangkutan (TERJAMIN).<br/>
                                    2.  Jika yang bersangkutan (TERJAMIN) tidak mematuhi dan menghadiri maka saya (PENJAMIN) bersedia dituntut secara hukum sesuai dengan Undang-Undang yang berlaku.<br/>
                                </td>
                                <td id="left" width="30"><br/><br/><img src="./asset/img/buktiambil.png"/></td>
                            </tr><br/><br/><br/>
                            <tr>
                    <td id="right" width="50%"><br/>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Saksi<br/><br/><br/><br/><br/>
                <strong>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;( ............................... )</strong><br/></td>
                    <td id="left" width="50">Batam, '.indoDate($row['tgl_diterima']).'<br/>Yang Membuat Pernyataan<br/><br/><img src="./upload/Meterai_6000.png"/><br/><strong>(&nbsp; '.$row['nama_wali'].' &nbsp;)</strong><br/>
                    </td>
                </tr>

                </tbody>
            </table>
        </div>
        <div class="jarak2"></div>
    <!-- Container END -->';
        }
    } echo'
    </body>';
    }
}
}
?>
