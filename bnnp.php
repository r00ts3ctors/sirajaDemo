<?php
//cek session
if (empty($_SESSION['admin'])) {

    $_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login terlebih dahulu.';
    header("Location: ./");
    die();
} else { ?>
    <div class="row">
        <!-- Secondary Nav START -->
        <div class="col s12">
            <div class="z-depth-1">
                <nav class="secondary-nav">
                    <div class="nav-wrapper blue-grey darken-1">
                        <div class="col m12">
                            <ul class="left">
                                <li class="waves-effect waves-light"><a href="?page=sett&sub=rest" class="judul"><i class="material-icons">storage</i> BNN PROVINSI KEPULAUAN RIAU</a></li>
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
    <div class="row">
        <div class="col m12">
            <div class="card">
                <div class="card">
                    <div class="card-tabs">
                        <ul class="tabs tabs-fixed-width">
                            <?php
                            // Array ( [0] => 3 [id_klasifikasi] => 3 [1] => 004 [kode] => 004 [2] => Klink awalbros [nama] => Klink awalbros [3] => Jalan Nongsa batam [uraian] => Jalan Nongsa batam [4] => 1 
                            $idkota = $_SESSION['kota'];
                            $dataKlinik = mysqli_query($config, "SELECT * FROM tbl_klasifikasi WHERE kota = $idkota");
                            $nomor = 1;
                            while ($row = mysqli_fetch_array($dataKlinik)) {
                                $test = $row['nama'];
                            ?>

                                <li class="tab"><a href="#maulana<?php echo $nomor; ?>"><?php echo $row['nama']; ?></a></li>


                            <?php
                                $nomor++;
                            }

                            ?>
                            <!-- <li class="tab"><a class="active" href="#test5">BNNK Batam</a></li>
                            <li class="tab"><a href="#test4">BNNP Kepulauan RIAU</a></li> -->
                        </ul>
                    </div>
                    <div class="card-content grey lighten-4">

                        <?php
                        $idkota = $_SESSION['kota'];
                        $d = mysqli_query($config, "SELECT * FROM tbl_klasifikasi WHERE kota = $idkota");
                        $dataTotal = mysqli_num_rows($d);


                        for ($i = 0; $i < $dataTotal; $i++) { ?>


                            <div id="maulana<?php echo $i + 1; ?>">Managemen Klien
                                <div class="center">
                                    <div class="accent">
                                        <h2>Form input</h2>
                                    </div>
                                </div>
                            </div>
                        <?php }

                        ?>



                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>