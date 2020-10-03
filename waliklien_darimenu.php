<?php
//cek session
if (empty($_SESSION['admin'])) {
    $_SESSION['err'] = '<center>Anda harus login terlebih dahulu!</center>';
    header("Location: ./");
    die();
} else {

    if ($_SESSION['admin'] != 1 and $_SESSION['admin'] != 2 and $_SESSION['admin'] != 3 and $_SESSION['admin'] != 4 and $_SESSION['admin'] != 5 and $_SESSION['admin'] != 6 and $_SESSION['admin'] != 7 and $_SESSION['admin'] != 8) {
        echo '<script language="javascript">
                    window.alert("ERROR! Anda tidak memiliki hak akses untuk membuka halaman ini");
                    window.location.href="./logout.php";
                  </script>';
    } else {

        if (isset($_REQUEST['act'])) {
            $act = $_REQUEST['act'];
            switch ($act) {
                case 'add':
                    include "tambah_Klien.php";
                    break;
                case 'edit':
                    include "edit_surat_masuk.php";
                    break;
                case 'disp':
                    include "disposisi.php";
                    break;
                case 'print':
                    include "cetak_disposisi.php";
                    break;
                case 'del':
                    include "hapus_surat_masuk.php";
                    break;
                case 'lht':
                    include "lihat_disposisi.php";
                    break;
                case 'tts':
                    include "tambah_terusan_sek.php";
                    break;
                case 'dispterus':
                    include "terusan_sek.php";
                    break;
                case 'delter':
                    include "hapus_terusan_sek.php";
                    break;
                case 'ttskab':
                    include "tambah_terusan_kabag.php";
                    break;
                case 'editerkab':
                    include "edit_terusan_kabag.php";
                    break;
                case 'dispteruskab':
                    include "terusan_kabag.php";
                    break;
                case 'delterkab':
                    include "hapus_terusan_kabag.php";
                    break;
            }
        } else {

            $query = mysqli_query($config, "SELECT surat_masuk FROM tbl_sett");
            list($surat_masuk) = mysqli_fetch_array($query);

            //pagging
            $limit = $surat_masuk;
            $pg = @$_GET['pg'];
            if (empty($pg)) {
                $curr = 0;
                $pg = 1;
            } else {
                $curr = ($pg - 1) * $limit;
            } ?>

            <!-- Row Start -->
            <div class="row">
                <!-- Secondary Nav START -->
                <div class="col s12">
                    <div class="z-depth-1">
                        <nav class="secondary-nav">
                            <div class="nav-wrapper blue-grey darken-1">
                                <div class="col m7">
                                    <ul class="left">
                                        <li class="waves-effect waves-light hide-on-small-only"><a href="?page=wkdm" class="judul"><i class="material-icons">wc</i> Data Klien & Wali</a></li>

                                        <?php
                                        if ($_SESSION['admin'] == 1) { ?>
                                            <li class="grey darken-9 waves-effect waves-light">
                                                <a href="?page=wkdm&act=add"><i class="material-icons md-24">add_circle</i> Tambah Data</a>
                                            </li>
                                        <?php
                                        }
                                        ?>
                                    </ul>
                                </div>
                                <div class="col m5 hide-on-med-and-down">
                                    <form method="post" action="?page=wkdm">
                                        <div class="input-field round-in-box">
                                            <input id="search" type="search" name="cari" placeholder="Ketik dan tekan enter mencari data..." required>
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

            <!-- Row form Start -->
            <div class="row jarak-form">

    <?php
            if (isset($_REQUEST['submit'])) {
                $cari = mysqli_real_escape_string($config, $_REQUEST['cari']);
                echo '
                        <div class="col s12" style="margin-top: -18px;">
                            <div class="card blue lighten-5">
                                <div class="card-content">
                                <p class="description">Hasil pencarian untuk kata kunci <strong>"' . stripslashes($cari) . '"</strong><span class="right"><a href="?page=wkdm"><i class="material-icons md-36" style="color: #333;">clear</i></a></span></p>
                                </div>
                            </div>
                        </div>

                        <div class="col m12" id="colres">
                        <table class="bordered" id="tbl">
                            <thead class="blue lighten-4" id="head">
                                <tr>
                                    <th width="10%">No. RM</th>
                                    <th width="30%">Perihal</th>
                                    <th width="24%">Asal Surat</th>
                                    <th width="18%">No. Surat<br/>Tgl Surat</th>
                                    <th width="18%">Tindakan <span class="right"><i class="material-icons" style="color: #333;">settings</i></span></th>
                                </tr>
                            </thead>
                            <tbody>';

                //script untuk mencari data
                $query = mysqli_query($config, "SELECT * FROM tbl_surat_masuk WHERE isi LIKE '%$cari%' ORDER by id_surat DESC LIMIT 15");
                if (mysqli_num_rows($query) > 0) {
                    $no = 1;
                    while ($row = mysqli_fetch_array($query)) {
                        echo '
                                  <tr>
                                    <td>' . $row['no_agenda'] . '</td>
                                    <td>' . substr($row['isi'], 0, 200) . '</td>
                                    <td>' . $row['asal_surat'] . '</td>
                                    <td>' . $row['no_surat'] . '<br/><hr/>' . indoDate($row['tgl_surat']) . '</td>
                                    <td>';

                        if ($_SESSION['admin'] == 1 || $_SESSION['admin'] == 2) {
                            echo '<a class="btn small blue waves-effect waves-light" href="?page=tsm&act=edit&id_surat=' . $row['id_surat'] . '">
                                                    <i class="material-icons">edit</i>EDIT&nbsp;</a>
                                                <a class="btn small deep-orange waves-effect waves-light" href="?page=tsm&act=del&id_surat=' . $row['id_surat'] . '">
                                                    <i class="material-icons">delete</i> DEL</a>';
                        } else {
                            echo '<a class="btn small light-green darken-3 waves-effect waves-light" href="?page=lht&id_surat=' . $row['id_surat'] . '" target="">
                                                <i class="material-icons">visibility</i> LIHAT</a>
                                            <a class="btn small yellow darken-3 waves-effect waves-light" href="?page=ctk&id_surat=' . $row['id_surat'] . '" target="_blank">
                                                <i class="material-icons">print</i> PRINT</a>';
                        }
                        echo '
                                        </td>
                                    </tr>';
                    }
                } else {
                    echo '<tr><td colspan="5"><center><p class="add">Tidak ada data yang ditemukan</p></center></td></tr>';
                }
                echo '</tbody></table><br/><br/>
                        </div>
                    </div>
                    <!-- Row form END -->';
            } else {
                $thadmin = '';
                $thawal = 24;
                if (($_SESSION['admin'] == 1)) {
                    $thadmin = '';
                    $thawal = 18;
                }

                echo '
                        <div class="col m12" id="colres">
                            <table class="bordered" id="tbl">
                                <thead class="blue lighten-4" id="head">
                                    <tr>
                                        <th width="5%">No</th>
                                        <th width="10%">No. RM</th>
                                        <th width="20%">Nama Klien</th>
                                        <th width="' . $thawal . '%">Nama Wali</th>
                                        <th width="15%">Hubungan<br/></th>
                                        <th width="10%">' . $thadmin . '</th>
                                        <th width="20%">Tindakan <span class="right tooltipped" data-position="left" data-tooltip="Atur jumlah data yang ditampilkan"><a class="modal-trigger" href="#modal"><i class="material-icons" style="color: #333;">settings</i></a></span></th>

                                            <div id="modal" class="modal">
                                                <div class="modal-content white">
                                                    <h5>Jumlah data yang ditampilkan per halaman</h5>';
                $query = mysqli_query($config, "SELECT id_sett,surat_masuk FROM tbl_sett");
                list($id_sett, $surat_masuk) = mysqli_fetch_array($query);
                echo '
                                                    <div class="row">
                                                        <form method="post" action="">
                                                            <div class="input-field col s12">
                                                                <input type="hidden" value="' . $id_sett . '" name="id_sett">
                                                                <div class="input-field col s1" style="float: left;">
                                                                    <i class="material-icons prefix md-prefix">looks_one</i>
                                                                </div>
                                                                <div class="input-field col s11 right" style="margin: -5px 0 20px;">
                                                                    <select class="browser-default validate" name="surat_masuk" required>
                                                                        <option value="' . $surat_masuk . '">' . $surat_masuk . '</option>
                                                                        <option value="5">5</option>
                                                                        <option value="10">10</option>
                                                                        <option value="20">20</option>
                                                                        <option value="50">50</option>
                                                                        <option value="100">100</option>
                                                                    </select>
                                                                </div>
                                                                <div class="modal-footer white">
                                                                    <button type="submit" class="modal-action waves-effect waves-green btn-flat" name="simpan">Simpan</button>';
                if (isset($_REQUEST['simpan'])) {
                    $id_sett = "1";
                    $surat_masuk = $_REQUEST['surat_masuk'];
                    $id_user = $_SESSION['id_user'];

                    $query = mysqli_query($config, "UPDATE tbl_sett SET surat_masuk='$surat_masuk',id_user='$id_user' WHERE id_sett='$id_sett'");
                    if ($query == true) {
                        header("Location: ./admin.php?page=wkdm");
                        die();
                    }
                }
                echo '
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

                $x = mysqli_query($config, "SELECT 
                                tbl_surat_masuk.no_agenda as no_agenda,
                                tbl_surat_masuk.nama as nama_klien,
                                tbl_wali_klien.nama_wali as nama_wali,
                                tbl_wali_klien.hubungan as hubungan,
                                tbl_surat_masuk.id_surat as id_surat
                                 FROM tbl_surat_masuk INNER JOIN tbl_wali_klien ON tbl_surat_masuk.halo = tbl_wali_klien.halo ORDER by tbl_surat_masuk.id_surat DESC LIMIT $curr, $limit");

                if (mysqli_num_rows($query) > 0) {
                    $no = 1;
                    while ($row = mysqli_fetch_array($x)) {
                        $status = 'Belum';
                        echo '
                                      <tr>
                                      <td>' . $no . '</td>
                                        <td>' . $row['no_agenda'] . '</td>
                                        <td>' . $row['nama_klien'] . '</td>
                                        <td>' . $row['nama_wali'] . '</td>
                                          <td>' . $row['hubungan'] . '</td>
                                        <td><td>';


                        if ($_SESSION['admin'] == 1 || $_SESSION['admin'] == 2) {
                            echo '<a class="btn small blue waves-effect waves-light" href="?page=tsm&act=edit&id_surat=' . $row['id_surat'] . '">
                                                    <i class="material-icons">edit</i>EDIT&nbsp;</a>
                                                <a class="btn small deep-orange waves-effect waves-light" href="?page=tsm&act=del&id_surat=' . $row['id_surat'] . '">
                                                    <i class="material-icons">delete</i> DEL</a>';
                        }
                        echo '
                                        </td>
                                    </tr>';
                        $no++;
                    }
                } else {
                    echo '<tr><td colspan="5"><center><p class="add">Tidak ada data untuk ditampilkan. <u><a href="?page=tsm&act=add">Tambah data baru</a></u></p></center></td></tr>';
                }
                echo '</tbody></table>
                        </div>
                    </div>
                    <!-- Row form END -->';

                $query = mysqli_query($config, "SELECT * FROM tbl_surat_masuk");
                $cdata = mysqli_num_rows($query);
                $cpg = ceil($cdata / $limit);

                echo '<br/><!-- Pagination START -->
                          <ul class="pagination">';

                if ($cdata > $limit) {

                    //first and previous pagging
                    if ($pg > 1) {
                        $prev = $pg - 1;
                        echo '<li><a href="?page=wkdm&pg=1"><i class="material-icons md-48">first_page</i></a></li>
                                  <li><a href="?page=wkdm&pg=' . $prev . '"><i class="material-icons md-48">chevron_left</i></a></li>';
                    } else {
                        echo '<li class="disabled"><a href="#"><i class="material-icons md-48">first_page</i></a></li>
                                  <li class="disabled"><a href="#"><i class="material-icons md-48">chevron_left</i></a></li>';
                    }

                    //perulangan pagging
                    for ($i = 1; $i <= $cpg; $i++) {
                        if ((($i >= $pg - 3) && ($i <= $pg + 3)) || ($i == 1) || ($i == $cpg)) {
                            if ($i == $pg) echo '<li class="active waves-effect waves-dark"><a href="?page=wkdm&pg=' . $i . '"> ' . $i . ' </a></li>';
                            else echo '<li class="waves-effect waves-dark"><a href="?page=wkdm&pg=' . $i . '"> ' . $i . ' </a></li>';
                        }
                    }

                    //last and next pagging
                    if ($pg < $cpg) {
                        $next = $pg + 1;
                        echo '<li><a href="?page=wkdm&pg=' . $next . '"><i class="material-icons md-48">chevron_right</i></a></li>
                                  <li><a href="?page=wkdm&pg=' . $cpg . '"><i class="material-icons md-48">last_page</i></a></li>';
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