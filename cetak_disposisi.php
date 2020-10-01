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
                            
                                <td class="tgh" id="lbr" colspan="5">SURAT PERNYATAAN MENGIKUTI RAWAT JALAN
                            
                            <tr class="isi">
                              <td colspan="2">
                                    <strong>Yang bertanda tangan dibawah ini :</strong><br/><br/>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Nama&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : </strong>'.$row['nama'].'<br/>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>No. KTP &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </strong>'.$row['indeks'].'<br/>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Tempat/Tanggal Lahir : </strong> '.$row['tempat_lahir'].','.indoDate($row['tgl_surat']).'<br/>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Alamat &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </strong>'.$row['asal_surat'].'<br/>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Pekerjaan &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </strong>'.$row['pekerjaan'].'<br/>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>No. Hp &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </strong>'.$row['kode'].'<br/><br/>
                                    <strong>Dengan ini menyatakan bahwa :</strong><br/>
                                    <strong>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    1. Bersedia untuk mengikuti proses rawat jalan yang diadakan oleh BNN <br/>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    2. Wajib lapor ini merupakan Konsekuensi yang Wajib saya jalani sesuai waktu yang ditetapkan oleh pihak BNN <br/>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    3. Jika saya tidak mematuhi semua jadwal yang sudah ditetapkan oleh Klinik Pratama BNN Kota Batam maka saya siap menerima sanksi dari BNN sesuai dengan perundang-undangan yang berlaku.</strong><br/>
                                    <div style="height: 25px;"></div>
                                </td>
                                
                            </tr>
                </tbody>
            </table>
            <div id="lead">
                <p>Batam,'.indoDate($row['tgl_diterima']).'</p>
                <p>Yang Membuat Pernyataan</p>
                <div style="height: 15px;"></div><br/>
                <img src="./upload/Meterai_6000.png"/><br/>
                <div style="height: 15px;"></div><br/>
                <strong>'.$row['nama'].'</strong><br/>
            </div>
        </div>
        <div class="jarak2"></div>
    <!-- Container END -->';
        }
    } echo'
    </body>';
    }

?>
