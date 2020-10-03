<?php
//cek session
error_reporting(0);
if (empty($_SESSION['admin'])) {
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
            padding: 3px !important;
        }

        tr,
        td {
            border-collapse: collapse;
            border: 1px solid #e4e4e4;
        }

        tr,
        td {
            vertical-align: top !important;
        }

        .isi {
            height: 100px !important;
        }

        .isihal {
            height: 60px !important;
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

        .cb2 {
            border: 1px solid #222;
            height: 20px;
            float: left;
            margin-right: 5px;
            width: 20px;
        }

        @media print {
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

            tr,
            td {
                border-collapse: collapse;
                border: 1px solid #444;
                padding: 3px !important;

            }

            tr,
            td {
                vertical-align: top !important;
            }

            #lbr {
                font-size: 15px;
            }

            .isi {
                height: 100px !important;
            }

            .isihal {
                height: 60px !important;
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
                font-size: 20px !important;
                font-weight: bold;
                text-transform: uppercase;
                margin: -10px 0 -20px 0;
            }

            .up {
                font-size: 17px !important;
                font-weight: normal;
            }

            .status {
                font-size: 17px !important;
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

    if (isset($_REQUEST['sub'])) {
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
            case 'add_z':
                include "tambah_jenis_zat.php";
                break;
            case 'del_z':
                include "hapus_jenis_zat.php";
                break;
            case 'edit_z':
                include "edit_jenis_zat.php";
                break;
            case 'add_tjkl':
                include "tambah_jadwal_konsel_keluarga.php";
                break;
            case 'del_tjkl':
                include "hapus_jadwal_konsel_keluarga.php";
                break;
            case 'edit_tjkl':
                include "edit_jadwal_konsel_keluarga.php";
                break;
            case 'add_tjklpok':
                include "tambah_jadwal_konsel_kelompok.php";
                break;
            case 'del_tjklpok':
                include "hapus_jadwal_konsel_kelompok.php";
                break;
            case 'edit_tjklpok':
                include "edit_jadwal_konsel_kelompok.php";
                break;
        }
    } else {
        //pagging
        $limit = 1;
        $pg = @$_GET['pg'];
        if (empty($pg)) {
            $curr = 0;
            $pg = 1;
        } else {
            $curr = ($pg - 1) * $limit;
        }

        $id_surat = $_REQUEST['id_surat'];

        $query = mysqli_query($config, "SELECT * FROM tbl_surat_masuk WHERE id_surat='$id_surat'");

        // Modifikasi kembali 
        $query1 = mysqli_query($config, "SELECT 
        tbl_surat_masuk.id_user as id_user,
        tbl_surat_masuk.nama as nama,
        tbl_surat_masuk.tempat_lahir as tempat_lahir,
        tbl_surat_masuk.jenis_kelamin as jenis_kelamin,
        tbl_surat_masuk.agama as agama,
        tbl_surat_masuk.status_perkawinan as status_perkawinan,
        tbl_surat_masuk.isi as isi,
        tbl_wali_klien.nama_wali as namawali,
        tbl_wali_klien.hubungan as hubunganwali,
        tbl_wali_klien.no_telp as tlp
       
         FROM tbl_surat_masuk INNER JOIN tbl_wali_klien ON tbl_surat_masuk.halo = tbl_wali_klien.halo WHERE tbl_surat_masuk.id_surat ='$id_surat'");


        if (mysqli_num_rows($query1) > 0) {
            $no = 1;
            while ($row = mysqli_fetch_array($query1)) {

                if ($_SESSION['id_user'] != $row['id_user'] and $_SESSION['id_user'] != 1) {
                    echo '<script language="javascript">
                                window.alert("ERROR! Anda tidak memiliki hak akses untuk melihat data ini");
                                window.location.href="./admin.php?page=tsm";
                              </script>';
                } else {
                    // banyak codenya bos 
    ?>

                    <?php

                    if (isset($_SESSION['succAdd'])) {
                        $succAdd = $_SESSION['succAdd'];
                        echo '<div id="alert-message" class="row">
                                        <div class="col m12">
                                            <div class="card green lighten-5">
                                                <div class="card-content notif">
                                                    <span class="card-title green-text"><i class="material-icons md-36">done</i> ' . $succAdd . '</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>';
                        unset($_SESSION['succAdd']);
                    }
                    if (isset($_SESSION['succEdit'])) {
                        $succEdit = $_SESSION['succEdit'];
                        echo '<div id="alert-message" class="row">
                                        <div class="col m12">
                                            <div class="card green lighten-5">
                                                <div class="card-content notif">
                                                    <span class="card-title green-text"><i class="material-icons md-36">done</i> ' . $succEdit . '</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>';
                        unset($_SESSION['succEdit']);
                    }
                    if (isset($_SESSION['succDel'])) {
                        $succDel = $_SESSION['succDel'];
                        echo '<div id="alert-message" class="row">
                                        <div class="col m12">
                                            <div class="card green lighten-5">
                                                <div class="card-content notif">
                                                    <span class="card-title green-text"><i class="material-icons md-36">done</i> ' . $succDel . '</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>';
                        unset($_SESSION['succDel']);
                    }

                    ?>
                    <div class="row">
                        <!-- Secondary Nav START -->
                        <div class="col s12">
                            <div class="z-depth-1">
                                <nav class="secondary-nav">
                                    <div class="nav-wrapper blue-grey darken-1">
                                        <div class="col m12">
                                            <div class="nav-wrapper blue-grey darken-1 center">

                                                <div class="waves-effect waves-light hide-on-small-only"><a href="#" class="judul"><i class="material-icons">update</i> Proses Rehabilitasi Klien </a></li>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </nav>
                            </div>
                        </div>


                        <!-- Secondary Nav END -->
                    </div>

                    <div class="row">
                        <div class="card blue lighten-5">
                            <div class="card-content col s4">

                                <p>
                                    <p class="description">Klien&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?php echo $row['isi']; ?></p>
                                    <p>
                                        <p class="description">Agama&nbsp;: <?php echo $row['agama']; ?></p>
                                        <p>
                                            <p class="description">Status&nbsp;&nbsp;: <?php echo $row['status_perkawinan']; ?></p>
                            </div>

                            <div class="card-content col s2">
                                <a class="btn small blue lighten-5 tooltipped black-text" data-position="left" data-tooltip="Kolola Wali Klien" href="?page=tsm&act=wp&id_surat=' . $row['id_surat'] . '">
                                    <i class="material-icons">person_pin</i> Wali</a>
                            </div>

                            <div class="card-content col s4">

                                <p>


                                    <p class="description">Nama Wali&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?php echo $row['namawali']; ?></p>
                                    <p>
                                        <p class="description">Hubungan &nbsp;: <?php echo $row['hubunganwali']; ?></p>
                                        <p>
                                            <p class="description">No . Telepon&nbsp;&nbsp;: <?php echo $row['tlp']; ?></p>
                            </div>

                        </div>
                    </div>
                    <!-- Row END -->

                    <!-- Row form Start -->
                    <div class="row">
                        <div class="col m12">
                            <div class="card">
                                <div class="card">
                                    <div class="card-tabs">
                                        <ul class="tabs tabs-fixed-width">
                                            <li class="tab active"><a href="#test4">Scrining</a></li>
                                            <li class="tab"><a class="" href="#test5">Formulir Wajib Lapor</a></li>
                                            <li class="tab"><a class="" href="#test6">Konseling Pertemuan</a></li>
                                            <li class="tab"><a class="" href="#test7">Konseling Keluarga</a></li>
                                        </ul>
                                    </div>

                                    <div class="card-content grey lighten-4">
                                        <div id="test4">

                                            <div class="center">
                                                <div class="accent">

                                                    <table>
                                                        <thead class="blue lighten-5 blue-text">
                                                            <div class="confir blue-text"><i class="material-icons md-36">filter_1</i>
                                                                Data Hasil Scrining<i class="material-icons md-36 right">call_received</i></div>
                                                        </thead>
                                                        <?php
                                                        @$query2 = mysqli_query($config, "SELECT * FROM tbl_jenis_zat JOIN tbl_surat_masuk ON tbl_jenis_zat.id_surat = tbl_surat_masuk.id_surat WHERE tbl_jenis_zat.id_surat='$id_surat'");


                                                        if (mysqli_num_rows($query2) > 0) {
                                                            $no = 0;

                                                            while ($row = mysqli_fetch_array($query2)) {
                                                                $no++;
                                                                echo '
                                        <tbody>
                                            <tr>
                                                <td width="70%"><center>Jenis Zat</center></td>
                                                <td width="30%"><center>Level</center></td>
                                            </tr>
                                            <tr>
                                                <td width="70%">A. Tembakau (rokok,cerutu,kretek,dll)</td>
                                                <td width="30%">';

                                                                $tembakau = explode(',', $row['tembakau']);
                                                                $query3 = mysqli_query($config, "SELECT * FROM tbl_kategori  WHERE id_katego IN ('70', '71', '72')");
                                                                if (mysqli_num_rows($query3) > 0) {
                                                                    while ($r = mysqli_fetch_array($query3)) {
                                                                        echo '
                                                <div class="chk">
                                                <div class="cb2">';
                                                                        if (in_array($r['nama_katego'], $tembakau)) {
                                                                            echo '<div class="check">&check;</div>';
                                                                        }
                                                                        echo '
                                                </div>
                                                    <span>' . $r['nama_katego'] . '</span>
                                                </div>';
                                                                    }
                                                                }
                                                                echo '
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="70%">B. Minuman berakohol (bir, anggur, sopi, tuak,cap tikus,dll)</td>
                                                <td width="30%">';

                                                                $minuman_berakohol = explode(',', $row['minuman_berakohol']);
                                                                $query3 = mysqli_query($config, "SELECT * FROM tbl_kategori  WHERE id_katego IN ('70', '71', '72')");
                                                                if (mysqli_num_rows($query3) > 0) {
                                                                    while ($r = mysqli_fetch_array($query3)) {
                                                                        echo '
                                                <div class="chk">
                                                <div class="cb">';
                                                                        if (in_array($r['nama_katego'], $minuman_berakohol)) {
                                                                            echo '<div class="check">&check;</div>';
                                                                        }
                                                                        echo '
                                                </div>
                                                    <span>' . $r['nama_katego'] . '</span>
                                                </div>';
                                                                    }
                                                                }
                                                                echo '
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="70%">C. Kanabis (mariuana,ganja,gelek,cimeng,dll)</td>
                                                <td width="30%">';

                                                                $kanabis = explode(',', $row['kanabis']);
                                                                $query3 = mysqli_query($config, "SELECT * FROM tbl_kategori  WHERE id_katego IN ('70', '71', '72')");
                                                                if (mysqli_num_rows($query3) > 0) {
                                                                    while ($r = mysqli_fetch_array($query3)) {
                                                                        echo '
                                                <div class="chk">
                                                <div class="cb">';
                                                                        if (in_array($r['nama_katego'], $kanabis)) {
                                                                            echo '<div class="check">&check;</div>';
                                                                        }
                                                                        echo '
                                                </div>
                                                    <span>' . $r['nama_katego'] . '</span>
                                                </div>';
                                                                    }
                                                                }
                                                                echo '
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="70%">D. Kokain (coke,crack, etc.)</td>
                                             
                                                <td width="30%">';

                                                                $kokain = explode(',', $row['kokain']);
                                                                $query3 = mysqli_query($config, "SELECT * FROM tbl_kategori  WHERE id_katego IN ('70', '71', '72')");
                                                                if (mysqli_num_rows($query3) > 0) {
                                                                    while ($r = mysqli_fetch_array($query3)) {
                                                                        echo '
                                                <div class="chk">
                                                <div class="cb">';
                                                                        if (in_array($r['nama_katego'], $kokain)) {
                                                                            echo '<div class="check">&check;</div>';
                                                                        }
                                                                        echo '
                                                </div>
                                                    <span>' . $r['nama_katego'] . '</span>
                                                </div>';
                                                                    }
                                                                }
                                                                echo '
                                            </tr>
                                            <tr>
                                                <td width="70%">E. Stimulant jenis amfetamin(ekstasi,shabu,dll)</td>
                                                <td width="30%">';

                                                                $stimulant = explode(',', $row['stimulant']);
                                                                $query3 = mysqli_query($config, "SELECT * FROM tbl_kategori  WHERE id_katego IN ('70', '71', '72')");
                                                                if (mysqli_num_rows($query3) > 0) {
                                                                    while ($r = mysqli_fetch_array($query3)) {
                                                                        echo '
                                                <div class="chk">
                                                <div class="cb">';
                                                                        if (in_array($r['nama_katego'], $stimulant)) {
                                                                            echo '<div class="check">&check;</div>';
                                                                        }
                                                                        echo '
                                                </div>
                                                    <span>' . $r['nama_katego'] . '</span>
                                                </div>';
                                                                    }
                                                                }
                                                                echo '
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="70%">F. Inhalansia (lem,bensin,tiner,dll)</td>
                                                <td width="30%">';

                                                                $inhalansia = explode(',', $row['inhalansia']);
                                                                $query3 = mysqli_query($config, "SELECT * FROM tbl_kategori  WHERE id_katego IN ('70', '71', '72')");
                                                                if (mysqli_num_rows($query3) > 0) {
                                                                    while ($r = mysqli_fetch_array($query3)) {
                                                                        echo '
                                                <div class="chk">
                                                <div class="cb">';
                                                                        if (in_array($r['nama_katego'], $inhalansia)) {
                                                                            echo '<div class="check">&check;</div>';
                                                                        }
                                                                        echo '
                                                </div>
                                                    <span>' . $r['nama_katego'] . '</span>
                                                </div>';
                                                                    }
                                                                }
                                                                echo '
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="70%">G. Sedaktiva atau obat tidur (pil koplo, alprazolam,kamlet,leksotan,rohypnol,dll)</td>
                                                <td width="30%">';

                                                                $sedaktiva_obti = explode(',', $row['sedaktiva_obti']);
                                                                $query3 = mysqli_query($config, "SELECT * FROM tbl_kategori  WHERE id_katego IN ('70', '71', '72')");
                                                                if (mysqli_num_rows($query3) > 0) {
                                                                    while ($r = mysqli_fetch_array($query3)) {
                                                                        echo '
                                                <div class="chk">
                                                <div class="cb">';
                                                                        if (in_array($r['nama_katego'], $sedaktiva_obti)) {
                                                                            echo '<div class="check">&check;</div>';
                                                                        }
                                                                        echo '
                                                </div>
                                                    <span>' . $r['nama_katego'] . '</span>
                                                </div>';
                                                                    }
                                                                }
                                                                echo '
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="70%">H. Halusinogens (LSD, jamur tahi sapi, PCP,dll)</td>
                                                <td width="30%">';

                                                                $halusinogens = explode(',', $row['halusinogens']);
                                                                $query3 = mysqli_query($config, "SELECT * FROM tbl_kategori  WHERE id_katego IN ('70', '71', '72')");
                                                                if (mysqli_num_rows($query3) > 0) {
                                                                    while ($r = mysqli_fetch_array($query3)) {
                                                                        echo '
                                                <div class="chk">
                                                <div class="cb">';
                                                                        if (in_array($r['nama_katego'], $halusinogens)) {
                                                                            echo '<div class="check">&check;</div>';
                                                                        }
                                                                        echo '
                                                </div>
                                                    <span>' . $r['nama_katego'] . '</span>
                                                </div>';
                                                                    }
                                                                }
                                                                echo '
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="70%">I. Opioida (heroin,putaw,morfin,metadon,kodein,dll)</td>
                                                <td width="30%">';

                                                                $opioida = explode(',', $row['opioida']);
                                                                $query3 = mysqli_query($config, "SELECT * FROM tbl_kategori  WHERE id_katego IN ('70', '71', '72')");
                                                                if (mysqli_num_rows($query3) > 0) {
                                                                    while ($r = mysqli_fetch_array($query3)) {
                                                                        echo '
                                                <div class="chk">
                                                <div class="cb">';
                                                                        if (in_array($r['nama_katego'], $opioida)) {
                                                                            echo '<div class="check">&check;</div>';
                                                                        }
                                                                        echo '
                                                </div>
                                                    <span>' . $r['nama_katego'] . '</span>
                                                </div>';
                                                                    }
                                                                }
                                                                echo '
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="70%">J. Zat-lain, jelaskan = . . . . . . ' . $row['nama_zat'] . ' . . . . . . </td>
                                                <td width="30%">';

                                                                $zat_lain = explode(',', $row['zat_lain']);
                                                                $query3 = mysqli_query($config, "SELECT * FROM tbl_kategori  WHERE id_katego IN ('70', '71', '72')");
                                                                if (mysqli_num_rows($query3) > 0) {
                                                                    while ($r = mysqli_fetch_array($query3)) {
                                                                        echo '
                                                <div class="chk">
                                                <div class="cb">';
                                                                        if (in_array($r['nama_katego'], $zat_lain)) {
                                                                            echo '<div class="check">&check;</div>';
                                                                        }
                                                                        echo '
                                                </div>
                                                    <span>' . $r['nama_katego'] . '</span>
                                                </div>';
                                                                    }
                                                                }
                                                                echo '
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="card-action">
                                <td width="15%"></td>
                                     <a class="btn small purple accent-3 waves-effect waves-light" href="?page=tsm&act=scr&id_surat=' . $id_surat . '&sub=edit_z&id_zat=' . $row['id_zat'] . '">
                                        <i class="material-icons">edit</i> EDIT</a>
                                    <a class="btn small blue waves-effect waves-light" href="?page=tsm&act=scr&id_surat=' . $id_surat . '&sub=del_z&id_zat=' . $row['id_zat'] . '"><i class="material-icons">delete</i> Hapus</a>
                                <td width="85%">
                                    <a class="btn Large deep-orange waves-effect waves-light tooltipped" data-position="right" data-tooltip="Tombol ini akan menprint surat pernyataan rawat jalan" href="?page=tsm&act=scr&id_surat=' . $id_surat . '&sub=cprj&id_surat=' . $id_surat . '" target="_blank">
                                    <i class="material-icons">print</i> PRINT RAJAL
                                    </a>
                                    <a class="btn Large deep-orange waves-effect waves-light tooltipped" data-position="right" data-tooltip="Tombol ini akan menprint surat rekomendasi ke Balai Rehabilitasi untuk di rawat inap" href="?page=tsm&act=scr&id_surat=' . $id_surat . '&sub=cprj&id_surat=' . $id_surat . '" target="_blank">
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
                            <a class="btn small blue waves-effect waves-light white-text" href="?page=tsm&act=scr&id_surat=' . $id_surat . '&sub=add_z"><b>Scrinang Sekarang</b></a></center></td></tr>';
                                                        }

                                                        ?>

                                                    </table>

                                                </div>




                                            </div>
                                        </div>
                                    </div>

                                    <div id="test5">
                                        <div class="center">
                                            <div class="accent">
                                                <table>
                                                    <thead class="blue lighten-5 blue-text">
                                                        <div class="confir blue-text"><i class="material-icons md-36">filter_2</i>
                                                            Data Hasil Formulir Wajib Lapor<i class="material-icons md-36 right">call_received</i></div>
                                                    </thead>

                                                    <?php
                                                    $query2 = mysqli_query($config, "SELECT * FROM tbl_scrining JOIN tbl_surat_masuk ON tbl_scrining.id_surat = tbl_surat_masuk.id_surat WHERE tbl_scrining.id_surat='$id_surat'");
                                                    if (mysqli_num_rows($query2) > 0) {
                                                        $no = 0;
                                                        while ($row = mysqli_fetch_array($query2)) {
                                                            $no++;
                                                            echo '
                                        <tbody>
                                            <tr>
                                                <td width="13%">Isi Scrining</td>
                                                <td width="1%">:</td>
                                                <td width="86%">' . $row['isi_scrining'] . '</td>
                                            </tr>
                                            <tr>
                                                <td width="13%">Level</td>
                                                <td width="1%">:</td>
                                                <td width="86%">' . $row['level_candu'] . '</td>
                                            </tr>
                                            <tr>
                                                <td width="13%">jenis Pertama digunakan</td>
                                                <td width="1%">:</td>
                                                <td width="86%">' . $row['jenis_zat'] . '</td>
                                            </tr>
                                            <tr>
                                                <td width="13%">Pendidikan Terakhir</td>
                                                <td width="1%">:</td>
                                                <td width="86%">' . $row['pendidikan'] . '</td>
                                            </tr>
                                            <tr>
                                                <td width="13%">Penyakit Bawaan</td>
                                                <td width="1%">:</td>
                                                <td width="86%">' . $row['penyakit'] . '</td>
                                            </tr>
                                            <tr>
                                                <td width="13%">Penyakit</td>
                                                <td width="1%">:</td>
                                                <td width="86%">';


                                                            $penyakit = explode(',', $row['penyakit']);
                                                            $query3 = mysqli_query($config, "SELECT * FROM tbl_kategori  WHERE id_katego IN ('1', '2', '3', '4', '5', '6', '7', '8', '9', '10')");
                                                            if (mysqli_num_rows($query3) > 0) {
                                                                while ($r = mysqli_fetch_array($query3)) {
                                                                    echo '
                                                <div class="chk">
                                                <div class="cb">';
                                                                    if (in_array($r['nama_katego'], $penyakit)) {
                                                                        echo '<div class="check">&check;</div>';
                                                                    }
                                                                    echo '
                                                </div>
                                                    <span>' . $r['nama_katego'] . '</span>
                                                </div>';
                                                                }
                                                            }
                                                            echo '
                                            </tr>
                                            <tr>
                                                <td width="13%">Usia Mulai Memakai</td>
                                                <td width="1%">:</td>
                                                <td width="86%">' . $row['usia_pakai'] . '</td>
                                            </tr>
                                            <tr>
                                                <td width="13%">1 Tahun Terakhir Narkoba jenis</td>
                                                <td width="1%">:</td>
                                                <td width="86%">' . $row['jenis_zat_akhir'] . '</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="card-action">
                                <td width="15%"></td>
                                     <a class="btn small purple accent-3 waves-effect waves-light" href="?page=tsm&act=scr&id_surat=' . $id_surat . '&sub=edit_s&id_scrining=' . $row['id_scrining'] . '">
                                        <i class="material-icons">edit</i> EDIT</a>
                                    <a class="btn small blue waves-effect waves-light" href="?page=tsm&act=scr&id_surat=' . $id_surat . '&sub=del_s&id_scrining=' . $row['id_scrining'] . '"><i class="material-icons">delete</i> Hapus</a>
                                <td width="85%">
                                    <a class="btn Large deep-orange waves-effect waves-light tooltipped" data-position="right" data-tooltip="Tombol ini akan menprint surat pernyataan rawat jalan" href="?page=tsm&act=scr&id_surat=' . $id_surat . '&sub=cprj&id_surat=' . $id_surat . '" target="_blank">
                                    <i class="material-icons">print</i> PRINT RAJAL
                                    </a>
                                    <a class="btn Large deep-orange waves-effect waves-light tooltipped" data-position="right" data-tooltip="Tombol ini akan menprint surat rekomendasi ke Balai Rehabilitasi untuk di rawat inap" href="?page=tsm&act=scr&id_surat=' . $id_surat . '&sub=cprj&id_surat=' . $id_surat . '" target="_blank">
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
                                                        echo '<tr><td colspan="5"><center><p class="add">Tidak ada data Formulir Wajib Lapor untuk ditampilkan.</p>
                            <a class="btn small blue waves-effect waves-light white-text" href="?page=tsm&act=scr&id_surat=' . $row['id_surat'] . '&sub=add_s"><b>Isi Form Sekarang</b></a></center></td></tr>';
                                                    }
                                                    ?>
                                            </div>
                                        </div>
                                    </div>





                                    <div id="test6">

                                        <div class="center">
                                            <div class="accent">
                                                <div class="card-content">
                                                    <table class="bordered" id="tbl">
                                                        <thead class="blue lighten-4" id="head">
                                                            <tr width="0%">
                                                                <center>
                                                                    <div class="form blue lighten-4 black-text"><i class="material-icons md-36">filter_3</i> Data Hasil Konseling Pertemuan 1 - 8<i class="material-icons md-36 right">call_received</i>
                                                                    </div>
                                                                </center>
                                                            </tr>
                                                            <tr>
                                                                <th width="4%">
                                                                    <center>Pertemuan Ke</center>
                                                                </th>
                                                                <th width="15%">Waktu<br />Tanggal</th>
                                                                <th width="29%">Keterangan</th>
                                                                <th width="20%">Status Konseling</th>
                                                                <th width="34%">Tindakan</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                            <?php
                                                            $query4 = mysqli_query($config, "SELECT * FROM tbl_disposisi JOIN tbl_surat_masuk ON tbl_disposisi.id_surat = tbl_surat_masuk.id_surat WHERE tbl_disposisi.id_surat='$id_surat'");

                                                            if (mysqli_num_rows($query4) > 0) {
                                                                $no = 0;
                                                                while ($row = mysqli_fetch_array($query4)) {
                                                                    $no++;
                                                                    echo '
                                                <tr>
                                                    <td><center>' . $no . '</center></td>
                                                    <td>' . $row['sifat'] . '<br/>' . indoDate($row['batas_waktu']) . '</td>
                                                    <td>' . $row['isi_disposisi'] . '</td>
                                                    <td>Yes/No</td>

                                                    <td>
                                                        <a class="btn small blue lighten-3 waves-light black-text" href="?page=tsm&act=disp&id_surat=' . $id_surat . '&sub=ass&id_disposisi=' . $row['id_disposisi'] . '"><i class="material-icons">record_voice_over</i> Konseling</a>
                                                        <a class="btn small deep-orange waves-light" href="?page=tsm&act=disp&id_surat=' . $id_surat . '&sub=edit&id_disposisi=' . $row['id_disposisi'] . '">
                                                            <i class="material-icons">edit</i> EDIT</a>
                                                        <a class="btn small deep-orange waves-light" href="?page=tsm&act=disp&id_surat=' . $id_surat . '&sub=del&id_disposisi=' . $row['id_disposisi'] . '"><i class="material-icons">delete</i> DEL</a>
                                                    </td>
                                            </tr>';
                                                                }
                                                            } else {
                                                                echo '<tr><td colspan="5"><center><p class="add">Tidak ada data Waktu Janjian & Konseling untuk ditampilkan. <br><u><a class="btn small blue waves-effect waves-light white-text" href="?page=tsm&act=disp&id_surat=' . $row['id_surat'] . '&sub=add">Buat Jadwal baru</a></u></p></center></td></tr>';
                                                            }
                                                            ?>

                                                        </tbody>

                                                    </table>

                                                </div>
                                                <br />
                                                <div class"form">
                                                    <a class="btn small blue lighten-4 waves-effect waves-light black-text" href="?page=tsm&act=disp&id_surat=<?php echo $id_surat; ?>&sub=add"><i class="material-icons">edit</i>Tambah Jadwal Konseling</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="test7">

                                        <div class="center">
                                            <div class="accent">
                                                <div class="container">

                                                    <?php
                                                    $id_surat = $_REQUEST['id_surat'];

                                                    $query = mysqli_query($config, "SELECT * FROM tbl_surat_masuk WHERE id_surat='$id_surat'");

                                                    if (mysqli_num_rows($query) > 0) {
                                                        $no = 1;
                                                        while ($row = mysqli_fetch_array($query)) {

                                                            if ($_SESSION['id_user'] != $row['id_user'] and $_SESSION['id_user'] != 1 and $_SESSION['admin'] != 2) {
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
                                                <div class="form blue lighten-4 black-text"><i class="material-icons md-36">filter_3</i> Data Konseling Keluarga & Kelompok<i class="material-icons md-36 right">call_received</i>
                                            </div></center></tr>
                                            <tr>
                                                <th width="4%"><center>Jenis</center></th>
                                                <th width="15%">Waktu<br/>Tanggal</th>
                                                <th width="29%">Keterangan</th>
                                                <th width="20%">Status Konseling</th>
                                                <th width="34%">Tindakan</th>
                                            </tr>
                                        </thead>
                                        <tbody>';

                                                                $query5 = mysqli_query($config, "SELECT * FROM tbl_jdl_kon_keluarga JOIN tbl_surat_masuk ON tbl_jdl_kon_keluarga.id_surat = tbl_surat_masuk.id_surat WHERE tbl_jdl_kon_keluarga.id_surat='$id_surat'");

                                                                if (mysqli_num_rows($query5) > 0) {
                                                                    $no = 0;
                                                                    while ($row = mysqli_fetch_array($query5)) {
                                                                        $no++;
                                                                        echo '
                                                <tr>
                                                    <td><center>Konseling Keluarga</center></td>
                                                    <td>' . $row['jam_acara'] . '<br/>' . indoDate($row['batas_waktu']) . '</td>
                                                    <td>' . $row['isi_jad_keluarga'] . '</td>
                                                    <td>Yes/No</td>

                                                    <td>
                                                        <a class="btn small blue lighten-3 waves-light black-text" href="?page=tsm&act=scr&id_surat=' . $id_surat . '&sub=ass&id_jad_kon_keluarga=' . $row['id_jad_kon_keluarga'] . '"><i class="material-icons">record_voice_over</i> Konseling</a>
                                                        <a class="btn small deep-orange waves-light" href="?page=tsm&act=scr&id_surat=' . $id_surat . '&sub=edit_tjkl&id_jad_kon_keluarga=' . $row['id_jad_kon_keluarga'] . '">
                                                            <i class="material-icons">edit</i> EDIT</a>
                                                        <a class="btn small deep-orange waves-light" href="?page=tsm&act=scr&id_surat=' . $id_surat . '&sub=del_tjkl&id_jad_kon_keluarga=' . $row['id_jad_kon_keluarga'] . '"><i class="material-icons">delete</i> DEL</a>
                                                    </td>
                                            </tr>';
                                                                    }
                                                                } else {
                                                                    echo '<tr><td colspan="5"><center><p class="add">Tidak ada data Waktu Janjian & Konseling Keluarga untuk ditampilkan. <br><u><a class="btn small blue waves-effect waves-light white-text" href="?page=tsm&act=scr&id_surat=' . $row['id_surat'] . '&sub=add_tjkl">Buat Jadwal Konseling Keluarga</a></u></p></center>
                                                </td>
                                            </tr>';
                                                                }
                                                            }

                                                    ?>
                                                            <!-- Include penjadwalan kelompok START -->
                                                    <?php
                                                            $query6 = mysqli_query($config, "SELECT * FROM tbl_jdl_kon_kelompok JOIN tbl_surat_masuk ON tbl_jdl_kon_kelompok.id_surat = tbl_surat_masuk.id_surat WHERE tbl_jdl_kon_kelompok.id_surat='$id_surat'");

                                                            if (mysqli_num_rows($query6) > 0) {
                                                                $no = 0;
                                                                while ($row = mysqli_fetch_array($query6)) {
                                                                    $no++;
                                                                    echo '
                                                <tr>
                                                    <td><center>Konseling Kelompok</center></td>
                                                    <td>' . $row['jam_acara_kelompok'] . '<br/>' . indoDate($row['batas_waktu']) . '</td>
                                                    <td>' . $row['isi_jad_kelompok'] . '</td>
                                                    <td>Yes/No</td>

                                                    <td>
                                                        <a class="btn small blue lighten-3 waves-light black-text" href="?page=tsm&act=scr&id_surat=' . $id_surat . '&sub=ass&id_jad_kon_kelompok=' . $row['id_jad_kon_kelompok'] . '"><i class="material-icons">record_voice_over</i> Konseling</a>
                                                        <a class="btn small deep-orange waves-light" href="?page=tsm&act=scr&id_surat=' . $id_surat . '&sub=edit_tjklpok&id_jad_kon_kelompok=' . $row['id_jad_kon_kelompok'] . '">
                                                            <i class="material-icons">edit</i> EDIT</a>
                                                        <a class="btn small deep-orange waves-light" href="?page=tsm&act=scr&id_surat=' . $id_surat . '&sub=del_tjklpok&id_jad_kon_kelompok=' . $row['id_jad_kon_kelompok'] . '"><i class="material-icons">delete</i> DEL</a>
                                                    </td>
                                            </tr>';
                                                                }
                                                            } else {
                                                                echo '<tr><td colspan="5"><center><p class="add">Tidak ada data Waktu Janjian & Konseling Kelompok untuk ditampilkan. <br><u><a class="btn small blue waves-effect waves-light white-text" href="?page=tsm&act=scr&id_surat=' . $id_surat . '&sub=add_tjklpok">Buat Jadwal Konseling Kelompok</a></u></p></center></td></tr>';
                                                            }
                                                            echo '</tbody>
                                </table>
                                </div>
                            </div>
                            <!-- Row form END -->';
                                                        }
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>

<?php }
            }
        }
    }
} ?>