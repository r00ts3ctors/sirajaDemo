<?php
//cek session
if (!empty($_SESSION['admin'])) {
?>
    <?php
    // Modifikasi untuk menampilkan data admin kota sesuai kota yang di maksud 
    $k = $_SESSION['kota'];
    $datakota = mysqli_fetch_array(mysqli_query($config, "SELECT * FROM tbl_kota WHERE id = $k"));
    ?>



    <nav class="purple darken-4">
        <div class="nav-wrapper">
            <a href="./" class="brand-logo center hide-on-large-only"><img src="./asset/img/logo_siraja.png" width="150" height="60">|</a>
            <ul id="slide-out" class="side-nav" data-simplebar-direction="vertical">
                <li class="no-padding">
                    <div class="logo-side center blue-grey darken-3">
                        <?php
                        $query = mysqli_query($config, "SELECT * FROM tbl_instansi");
                        while ($data = mysqli_fetch_array($query)) {
                            if (!empty($data['logo'])) {
                                echo '<img class="logoside" src="./upload/' . $data['logo'] . '"/>';
                            } else {
                                echo '<img class="logoside" src="./asset/img/logo.png"/>';
                            }
                            if (!empty($data['nama'])) {
                                echo '<h5 class="smk-side">' . $data['nama'] . '</h5>';
                            } else {
                                echo '<h5 class="smk-side">BNN PROV. KEPULAUAN RIAU</h5>';
                            }
                            if (!empty($data['alamat'])) {
                                echo '<p class="description-side">' . $data['alamat'] . '</p>';
                            } else {
                                echo '<p class="description-side">Jalan Hang Jebat KM.3, Batu Besar, Nongsa, Batu Besar, Kecamatan Nongsa, Kota Batam, Kepulauan Riau 29465</p>';
                            }
                        }
                        ?>
                    </div>
                </li>
                <li class="no-padding blue-grey darken-4">
                    <ul class="collapsible collapsible-accordion">
                        <li>
                            <a class="collapsible-header"><i class="material-icons">account_circle</i><?php echo $_SESSION['nama']; ?></a>
                            <div class="collapsible-body">
                                <ul>
                                    <li><a href="?page=pro">Profil</a></li>
                                    <li><a href="?page=pro&sub=pass">Ubah Password</a></li>
                                    <li><a href="logout.php">Logout</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </li>
                <li><a href="./"><i class="material-icons middle">dashboard</i> Beranda</a></li>
                <!-- MENU LEVEL SUPERADMIN -->
                <?php if ($_SESSION['admin'] == 1 and $_SESSION['admin'] == 2) { ?>
                    <li class="no-padding">
                        <ul class="collapsible collapsible-accordion">
                            <li>
                                <a href="?page=tsm" class="collapsible-header"><i class="material-icons">repeat</i> Manajemen Klien</a>
                                <div class="collapsible-body">

                                </div>
                            </li>
                        </ul>
                    </li>
                    <li class="no-padding">
                        <ul class="collapsible collapsible-accordion">
                            <li>
                                <a href="?page=asm" class="collapsible-header"><i class="material-icons">assignment</i> Resume Klien</a>

                            </li>
                        </ul>
                    </li>
                    <li class="no-padding">
                        <ul class="collapsible collapsible-accordion">
                            <li>
                                <a href="?page=gsm" class="collapsible-header"><i class="material-icons">image</i> Berkas Klien</a>
                                <div class="collapsible-body">

                                </div>
                            </li>
                        </ul>
                    </li>
                    <li class="no-padding">
                        <ul class="collapsible collapsible-accordion">
                            <li>
                                <a href="?page=gsm" class="collapsible-header"><i class="material-icons">image</i> Berkas Klien</a>
                                <div class="collapsible-body">

                                </div>
                            </li>
                        </ul>
                    </li>
                    <li><a href="?page=ref"><i class="material-icons middle">class</i> Kategori Klinik</a></li>
                    <li><a href="?page=grf"><i class="material-icons middle">class</i> Data Statistik</a></li>
                    <li class="no-padding">
                        <ul class="collapsible collapsible-accordion">
                            <li>
                                <a class="collapsible-header"><i class="material-icons">settings</i> Pengaturan</a>
                                <div class="collapsible-body">
                                    <ul>
                                        <li><a href="?page=sett">Instansi</a></li>
                                        <li><a href="?page=sett&sub=usr">User</a></li>
                                        <li><a href="?page=sett&sub=back">Backup Database</a></li>
                                        <li><a href="?page=sett&sub=rest">Restore Database</a></li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </li>
                <?php } ?>
                <!-- MENU KLINIK -->
                <?php if ($_SESSION['admin'] == 3) { ?>
                    <li class="no-padding">
                        <ul class="collapsible collapsible-accordion">
                            <li>
                                <a href="?page=tsm" class="collapsible-header"><i class="material-icons">repeat</i> Manajemen Klien</a>
                                <div class="collapsible-body">

                                </div>
                            </li>
                        </ul>
                    </li>
                    <li class="no-padding">
                        <ul class="collapsible collapsible-accordion">
                            <li>
                                <a href="?page=asm" class="collapsible-header"><i class="material-icons">assignment</i> Resume Klien</a>

                            </li>
                        </ul>
                    </li>
                    <li class="no-padding">
                        <ul class="collapsible collapsible-accordion">
                            <li>
                                <a href="?page=gsm" class="collapsible-header"><i class="material-icons">image</i> Berkas Klien</a>
                                <div class="collapsible-body">

                                </div>
                            </li>
                        </ul>
                    </li>

                    <li><a href="?page=grf"><i class="material-icons middle">class</i> Data Statistik</a></li>
                    <li class="no-padding">
                        <ul class="collapsible collapsible-accordion">
                            <li>
                                <a class="collapsible-header"><i class="material-icons">settings</i> Pengaturan</a>
                                <div class="collapsible-body">
                                    <ul>
                                        <li><a href="?page=sett&sub=usr">User</a></li>
                                        <li><a href="?page=sett&sub=back">Backup Database</a></li>
                                        <li><a href="?page=sett&sub=rest">Restore Database</a></li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </li>
                <?php } ?>

                <!-- MENU DOKTER/KONSELOR -->
                <?php if ($_SESSION['admin'] == 4) { ?>
                    <li class="no-padding">
                        <ul class="collapsible collapsible-accordion">
                            <li>
                                <a href="?page=tsm" class="collapsible-header"><i class="material-icons">repeat</i> Manajemen Klien</a>
                                <div class="collapsible-body">

                                </div>
                            </li>
                        </ul>
                    </li>
                <?php } ?>
                <!-- MENU LEVEL Klien -->
                <?php if ($_SESSION['admin'] == 5) { ?>
                    <li class="no-padding">
                        <ul class="collapsible collapsible-accordion">
                            <li>
                                <a href="?page=jp" class="collapsible-header"><i class="material-icons">update</i>Jadwal Asesmen</a>
                            </li>
                            <li>
                                <a href="?page=bdt" class="collapsible-header"><i class="material-icons">assignment</i> Biodata</a>
                            </li>

                        </ul>
                    </li>
                <?php } ?>
                </li>
            </ul>
            <!-- Menu on medium and small screen END -->

            <!-- Menu on large screen START -->
            <ul class="center hide-on-med-and-down" id="nv">
                <li><a href="./" class="ams hide-on-med-and-down"><img src="./asset/img/logo_siraja.png" width="130" height="60"></a></li>
                <li>
                    <div class="grs">
                        </>
                </li>

                <!-- MENU LEVEL SUPERADMIN -->
                <?php if ($_SESSION['admin'] == 1) { ?>
                    <li><a class="button" href="?page=tsm" data-activates="transaksi">BNNP</a></li>
                    <li><a class="dropdown-button" href="#!" data-activates="pengaturan">BNNK <i class="material-icons md-18">arrow_drop_down</i></a></li>
                    <ul id='pengaturan' class='dropdown-content'>
                        <li><a href="?page=tsm">BNNK Batam</a></li>
                        <li><a href="?page=tsm">BNNK Tanjungpinang</a></li>
                        <li><a href="?page=tsm">BNNK Karimun</a></li>
                    </ul>
                    <li><a class="button" href="?page=bk" data-activates="transaksi">IPWL Lainnya</a></li>
                    <li><a class="button" href="?page=wkdm" data-activates="transaksi">KLIEN/WALI</a></li>
                    <li><a class="button" href="?page=blm" data-activates="transaksi">Informasi</a></li>
                    <li><a class="dropdown-button" href="#!" data-activates="pengaturan">Lain-lain<i class="material-icons md-18">arrow_drop_down</i></a></li>
                    <ul id='pengaturan' class='dropdown-content'>
                        <li><a href="?page=ref">Kategori Klinik</a></li>
                        <li><a href="?page=sett">Pengaturan</a></li>
                        <li><a href="?page=sett&sub=usr">User</a></li>
                        <li class="divider"></li>
                        <li><a href="?page=sett&sub=back">Backup Database</a></li>
                        <li><a href="?page=sett&sub=rest">Restore Database</a></li>
                    </ul>

                <?php } ?>



                <!-- MENU LEVEL KABID -->
                <?php if ($_SESSION['admin'] == 2) { ?>
                    <li><a class="button" href="?page=tsm" data-activates="transaksi">BNNP</a></li>
                    <li><a class="dropdown-button" href="#!" data-activates="pengaturan">BNNK <i class="material-icons md-18">arrow_drop_down</i></a></li>



                    <ul id='pengaturan' class='dropdown-content'>
                        <li><a href="?page=bp"><?php echo $datakota['nama_kota']; ?></a></li>

                    </ul>
                    <li><a class="button" href="?page=bk" data-activates="transaksi">IPWL Lainnya</a></li>
                    <li><a class="button" href="?page=wkdm" data-activates="transaksi">KLIEN/WALI</a></li>
                    <li><a class="button" href="?page=bk" data-activates="transaksi">Informasi</a></li>
                    <li><a class="dropdown-button" href="#!" data-activates="pengaturan">Lain-lain<i class="material-icons md-18">arrow_drop_down</i></a></li>
                    <ul id='pengaturan' class='dropdown-content'>
                        <li><a href="?page=sett">Pengaturan</a></li>
                        <li><a href="?page=sett&sub=usr">User</a></li>
                        <li class="divider"></li>
                        <li><a href="?page=sett&sub=back">Backup Database</a></li>
                        <li><a href="?page=sett&sub=rest">Restore Database</a></li>
                    </ul>
            </ul>
        <?php } ?>
        <!-- MENU KLINIK -->
        <?php if ($_SESSION['admin'] == 3) { ?>
            <li><a class="button" href="?page=tsm" data-activates="transaksi">Manajemen Klien</a></li>
            <li><a class="button" href="?page=blm" data-activates="transaksi">Informasi</a></li>
            <li><a href="?page=grf">Data Statistik</a></li>
        <?php } ?>
        <!-- MENU LEVEL DOKTER/KONSELOR -->
        <?php if ($_SESSION['admin'] == 4) { ?>
            <li><a class="button" href="?page=tsm" data-activates="transaksi">Manajemen Klien</a></li>
            <li><a class="button" href="?page=blm" data-activates="transaksi">Informasi</a></li>

        <?php } ?>
        <!-- MENU LEVEL Klien -->
        <?php if ($_SESSION['admin'] == 5) { ?>
            <li><a href="?page=bdt" class="button" data-activates="biodata"> Biodata</a></li>
            <li><a href="?page=jp" class="button">Jadwal Asesmen</a></li>
            <li><a class="button" href="?page=blm" data-activates="transaksi">Informasi</a></li>
        <?php } ?>

        <li class="right" style="margin-right: 10px;"><a class="dropdown-button" href="#!" data-activates="logout"><i class="material-icons">account_circle</i> <?php echo $_SESSION['nama']; ?><i class="material-icons md-18">arrow_drop_down</i></a></li>
        <ul id='logout' class='dropdown-content'>
            <li><a href="?page=pro">Profil</a></li>
            <li><a href="?page=pro&sub=pass">Ubah Password</a></li>
            <li class="divider"></li>
            <li><a href="logout.php"><i class="material-icons">settings_power</i> Logout</a></li>
        </ul>
        </ul>
        <!-- Menu on large screen END -->
        <a href="#" data-activates="slide-out" class="button-collapse" id="menu"><i class="material-icons">menu</i></a>
        </div>
    </nav>

<?php
} else {
    header("Location: ../");
    die();
}
?>