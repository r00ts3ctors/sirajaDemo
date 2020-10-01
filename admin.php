<?php
ob_start();
//cek session
session_start();

if (empty($_SESSION['admin'])) {
    $_SESSION['err'] = '<center>Anda harus login terlebih dahulu!</center>';
    header("Location: ./");
    die();
} else {
?>

    <!doctype html>
    <html lang="en">

    <!-- Include Head START -->
    <?php include('include/head.php'); ?>
    <!-- Include Head END -->

    <!-- Body START -->

    <body class="bg">

        <!-- Header START -->
        <header>
            <!-- Include Header Instansi START -->
            <div class="center"> Sistem Informasi Rehabilitasi Rawat Jalan </div>
            <div class="center"> BNN PROV KEPRI</div>
            <!-- Include Header Instansi END -->
            <!-- Include Navigation START -->
            <?php include('include/menu.php'); ?>
            <!-- Include Navigation END -->


            <div class="card">

                <marquee onmouseover="this.stop()" onmouseout="this.start()">

                    <div class="text"> Selamat Datang <?php echo $_SESSION['nama']; ?>, Anda login sebagai
                        <?php
                        if ($_SESSION['admin'] == 1) {
                            echo "Super Admin. Anda memiliki akses penuh terhadap sistem.";
                        } elseif ($_SESSION['admin'] == 2) {
                            echo "Kabid Rehabilitasi. Dan Selamat Bekerja di aplikasi SIRAJA.";
                        } elseif ($_SESSION['admin'] == 3) {
                            echo "Klink (IPWL), Dan Selamat Bekerja di aplikasi SIRAJA.";
                        } elseif ($_SESSION['admin'] == 4) {
                            echo "Konselor/Dokter, Dan Selamat Bekerja di aplikasi SIRAJA.";
                        } else {
                            echo "Klien/Wali Klien, Semangat Menuju Kesembuhan Untuk Keluarga yang Baik Anda.";
                        } ?>
                    </div>
                </marquee>

            </div>

        </header>
        <!-- Header END -->
        <?php


        if (isset($_REQUEST['page'])) {
            $page = $_REQUEST['page'];
            switch ($page) {
                case 'tsm':
                    include "manajemen_Klien.php";
                    break;
                case 'ctk':
                    include "cetak_disposisi.php";
                    break;
                case 'wp':
                    include "wali_Klien.php";
                    break;

                case 'asm':
                    include "agenda_surat_masuk.php";
                    break;

                case 'ref':
                    include "referensi.php";
                    break;
                case 'sett':
                    include "pengaturan.php";
                    break;
                case 'pro':
                    include "profil.php";
                    break;
                case 'gsm':
                    include "galeri_sm.php";
                    break;

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
                case 'scr':
                    include "scrining.php";
                    break;
                case 'bdt':
                    include "biodata.php";
                    break;
                case 'jp':
                    include "jadwal_Klien.php";
                    break;
                case 'grf':
                    include "grafik.php";
                    break;
                case 'cprj':
                    include "cetak_pernyataan_rj.php";
                    break;
                case 'ct_p':
                    include "cetak_penjamin.php";
                    break;
                case 'api':
                    include "assesment_perhari_ini.php";
                    break;
                case 'bp':
                    include "bnnp.php";
                    break;
                case 'wkdm':
                    include "waliklien_darimenu.php";
                    break;
            }
        } else {
        ?>
            <!-- Main START -->
            <main>
                <?php
                //menghitung jumlah surat masuk
                $count1 = mysqli_num_rows(mysqli_query($config, "SELECT * FROM tbl_surat_masuk"));

                //menghitung jumlah surat masuk
                $count3 = mysqli_num_rows(mysqli_query($config, "SELECT * FROM tbl_disposisi"));

                //menghitung jumlah klasifikasi
                $count4 = mysqli_num_rows(mysqli_query($config, "SELECT * FROM tbl_klasifikasi"));

                //menghitung jumlah pengguna
                $count5 = mysqli_num_rows(mysqli_query($config, "SELECT * FROM tbl_user"));
                ?>

                <!-- Info Statistic START -->
                <?php
                if ($_SESSION['admin'] == 1) {
                    $a1 = array("cyan", "yellow", "blue", "brown");

                    $query_kota = mysqli_query($config, "SELECT c.id AS id_kota, nama_kota FROM tbl_surat_masuk a LEFT JOIN tbl_klasifikasi b ON b.id_klasifikasi = a.klinik LEFT JOIN tbl_kota c ON c.id = b.kota WHERE c.id  IS NOT NULL GROUP BY id_kota,nama_kota");
                    $kota_hasil = mysqli_fetch_all($query_kota);
                    foreach ($kota_hasil as $kota_k => $kota_v) {
                        $random_keys = array_rand($a1, 3);
                ?>


                        <div class="row">
                            <div class="col m4" style="margin: 0px -80px 0px 10px;">
                                <div class="card">
                                    <?php
                                    $querySlide = mysqli_query($config, "SELECT * FROM tbl_slide WHERE status = 1 LIMIT 3");
                                    while ($slide = mysqli_fetch_array($querySlide)) { ?>
                                        <div class="mySlides fade">
                                            <img src="<?= "./asset/img/slide/" . $slide['nama_gambar']; ?>" style=" width:250px hight:50px">
                                            <div class="text"><?= $slide['capstion']; ?></div>
                                        </div>
                                    <?php } ?>
                                    <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                                    <a class="next" onclick="plusSlides(1)">&#10095;</a>
                                </div>
                            </div>
                            <div class="col m4">
                                <center>
                                    <a href="?page=tsm"><img src="./asset/img/manpas.png" /></a>
                                    <a href="?page=api"><img src="./asset/img/asesmen.png" /></a>
                                    <a href="?page=grf"><img src="./asset/img/statistik2.png" /></a>
                                    <br /><br />

                                    <a href="?page=ref"><img src="./asset/img/klasifikasi3.png" /></a>
                                    <a href="?page=sett&sub=usr"><img src="./asset/img/manageuser.png" /></a>
                                    <a href="?page=sett"><img src="./asset/img/Pengaturan3.png" /></a>
                                </center>


                            </div>

                            <div class="col m4">
                                <div class="card">
                                    <?php
                                    $dari_tanggal = "2020-09-01";
                                    $sampai_tanggal = "2020-09-30";

                                    $qry5 = "SELECT klinik, COUNT(*) AS jumlah FROM tbl_surat_masuk WHERE tgl_diterima BETWEEN '$dari_tanggal' AND '$sampai_tanggal' GROUP BY klinik";
                                    $query5 = mysqli_query($config, $qry5);

                                    $qry3 = "SELECT keterangan, COUNT(*) AS jumlah FROM tbl_surat_masuk WHERE tgl_diterima BETWEEN '$dari_tanggal' AND '$sampai_tanggal' GROUP BY keterangan";
                                    $query3 = mysqli_query($config, $qry3);

                                    $qry2 = "SELECT agama, COUNT(*) AS jumlah FROM tbl_surat_masuk WHERE tgl_diterima BETWEEN '$dari_tanggal' AND '$sampai_tanggal' GROUP BY agama";
                                    $query2 = mysqli_query($config, $qry2);

                                    $qry4 = "SELECT status_perkawinan, COUNT(*) AS jumlah FROM tbl_surat_masuk WHERE tgl_diterima BETWEEN '$dari_tanggal' AND '$sampai_tanggal' GROUP BY status_perkawinan";
                                    $query4 = mysqli_query($config, $qry4);




                                    ?>

                                    <div id="chart-bar-5"></div>
                                </div>
                            </div>
                        </div>
                        <!-- container START -->

                        <div class="container">

                            <div class="row">
                                <div class="col m4" style=" margin: 0px 0px 0px -420px">
                                    <a href="?page=tsm">
                                        <span class="card-title white-text">Grapik Statistic dari Akun <b><?php echo $kota_v[1]; ?></b></span>
                                        <h5 class="white-text link">
                                            <?php
                                            $query_grapik = mysqli_query($config, "SELECT COUNT(a.id_surat) AS jum, 
b.nama AS nama_klinik,b.id_klasifikasi, c.nama_kota, c.id AS id_kota FROM tbl_surat_masuk a LEFT JOIN tbl_klasifikasi b ON b.id_klasifikasi = a.klinik LEFT JOIN tbl_kota c ON c.id = b.kota
WHERE c.id IS NOT NULL AND c.id =" . $kota_v[0] . " GROUP BY nama_kota,nama_klinik");
                                            $grapik_hasil = mysqli_fetch_all($query_grapik);
                                            foreach ($grapik_hasil as $k => $v) {
                                                $query_jenis_kelamin = mysqli_query($config, "SELECT COUNT(a.id_surat) AS jum, a.jenis_kelamin, a.klinik FROM tbl_surat_masuk a LEFT JOIN tbl_klasifikasi b ON b.id_klasifikasi = a.klinik LEFT JOIN tbl_kota c ON c.id = b.kota
WHERE c.id IS NOT NULL and a.klinik=" . $v[2] . "
GROUP BY a.jenis_kelamin, a.klinik");
                                                $_jenis_kelamin_hasil = mysqli_fetch_all($query_jenis_kelamin);
                                            ?>
                                                <?php echo $v[1] . " <b>" . $v[0] . "</b><br>";

                                                foreach ($_jenis_kelamin_hasil as $kk => $kv) {
                                                    echo $kv[1] . " <b>" . $kv[0] . "</b><br>";
                                                }
                                                ?>

                                            <?php
                                                echo "<hr>";
                                            }
                                            ?>


                                        </h5>
                                    </a>
                                </div>
                                <div class="col m4">
                                    <div id="chart-pie-3"></div>


                                </div>

                                <div class="col m4">
                                    <div class="card">

                                        <div id="chart-pie-2"></div>

                                    </div>
                                </div>

                            </div>


                        <?php } ?>

                        <!-- Info Statistic START -->
                    <?php } ?>
                    <!-- Row END -->
                <?php } ?>
                        </div>
                        <!-- container END -->

            </main>
            <!-- Main END -->

            <!-- Include Footer START -->
            <?php include('include/footer.php'); ?>
            <!-- Include Footer END -->
            <script>
                var slideIndex = 1;
                showSlides(slideIndex);

                function plusSlides(n) {
                    showSlides(slideIndex += n);
                }

                function currentSlide(n) {
                    showSlides(slideIndex = n);
                }

                function showSlides(n) {
                    var i;
                    var slides = document.getElementsByClassName("mySlides");
                    var dots = document.getElementsByClassName("dot");
                    if (n > slides.length) {
                        slideIndex = 1
                    }
                    if (n < 1) {
                        slideIndex = slides.length
                    }
                    for (i = 0; i < slides.length; i++) {
                        slides[i].style.display = "none";
                    }
                    for (i = 0; i < dots.length; i++) {
                        dots[i].className = dots[i].className.replace(" active", "");
                    }
                    slides[slideIndex - 1].style.display = "block";
                    dots[slideIndex - 1].className += " active";
                }
            </script>



            <script type="text/javascript">
                var chart5; // globally available
                $(document).ready(function() {
                    Highcharts.setOptions({
                        colors: ['#0984e3', '#ff7675', '#00d9ff', '#6a65ff', '#ff73f5', '#ff5c76', '#2afff9', '#6fff6a', '#0984e3', '#ff7675', '#00d9ff', '#6a65ff', '#ff73f5', '#ff5c76', '#2afff9', '#6fff6a']
                    });

                    chart5 = new Highcharts.Chart({
                        chart: {
                            renderTo: 'chart-bar-5',
                            type: 'column'
                        },
                        title: {
                            text: 'Informasi Klinik'
                        },
                        xAxis: {
                            categories: ['Klinik']
                        },
                        yAxis: {
                            title: {
                                text: ''
                            }
                        },
                        legend: {
                            enabled: false
                        },
                        plotOptions: {
                            series: {
                                borderWidth: 0,
                                dataLabels: {
                                    enabled: true,
                                    format: '{point.y}'
                                }
                            }
                        },
                        series: [
                            <?php

                            while ($row = mysqli_fetch_array($query5)) { ?> {
                                    name: '<?php echo $row['klinik']; ?>',
                                    data: [<?php echo round($row['jumlah'], 2); ?>]
                                },
                            <?php } ?>
                        ]
                    });
                });
            </script>

            <script type="text/javascript">
                var chart3; // globally available
                $(document).ready(function() {
                    Highcharts.setOptions({
                        colors: ['#0984e3', '#ff7675', '#00d9ff', '#6a65ff', '#ff73f5', '#ff5c76', '#2afff9', '#6fff6a', '#0984e3', '#ff7675', '#00d9ff', '#6a65ff', '#ff73f5', '#ff5c76', '#2afff9', '#6fff6a']
                    });

                    chart3 = new Highcharts.Chart({
                        chart: {
                            renderTo: 'chart-bar-3',
                            type: 'column'
                        },
                        title: {
                            text: 'Suku'
                        },
                        xAxis: {
                            categories: ['Suku']
                        },
                        yAxis: {
                            title: {
                                text: 'Jumlah'
                            }
                        },
                        legend: {
                            enabled: false
                        },
                        plotOptions: {
                            series: {
                                borderWidth: 0,
                                dataLabels: {
                                    enabled: true,
                                    format: '{point.y}'
                                }
                            }
                        },
                        series: [
                            <?php

                            while ($row = mysqli_fetch_array($query3)) { ?> {
                                    name: '<?php echo $row['keterangan']; ?>',
                                    data: [<?php echo round($row['jumlah'], 2); ?>]
                                },
                            <?php } ?>
                        ]
                    });
                });

                $(function() {


                    var chart3;

                    $(document).ready(function() {
                        chart3 = new Highcharts.setOptions({
                            colors: ['#0984e3', '#ff7675', '#00d9ff', '#6a65ff', '#ff73f5', '#ff5c76', '#2afff9', '#6fff6a', '#0984e3', '#ff7675', '#00d9ff', '#6a65ff', '#ff73f5', '#ff5c76', '#2afff9', '#6fff6a']
                        });
                        // Build the chart
                        chart3 = new Highcharts.Chart({
                            chart: {
                                renderTo: 'chart-pie-3',
                                plotBackgroundColor: null,
                                plotBorderWidth: null,
                                plotShadow: false
                            },
                            title: {
                                text: 'Suku'
                            },
                            tooltip: {
                                pointFormat: '<b>{point.percentage}%</b>',
                                percentageDecimals: 1
                            },
                            plotOptions: {
                                pie: {
                                    allowPointSelect: true,
                                    cursor: 'pointer',
                                    dataLabels: {
                                        enabled: true
                                    },
                                    showInLegend: true
                                }
                            },
                            series: [{
                                type: 'pie',
                                name: '',
                                data: [
                                    <?php $query3 = mysqli_query($config, $qry3);
                                    while ($row = mysqli_fetch_array($query3)) { ?>['<?php echo $row['keterangan']; ?>', <?php echo $row['jumlah']; ?>],
                                    <?php } ?>
                                ]
                            }]
                        });
                    });

                });
            </script>

            <script type="text/javascript">
                var chart2; // globally available
                $(document).ready(function() {
                    Highcharts.setOptions({
                        colors: ['#1abc9c', '#95a5a6', '#3498db', '#f1c40f', '#3498db', '#9b59b6']
                    });

                    chart2 = new Highcharts.Chart({
                        chart: {
                            renderTo: 'chart-bar-2',
                            type: 'column'
                        },
                        title: {
                            text: 'Agama'
                        },
                        xAxis: {
                            categories: ['Agama']
                        },
                        yAxis: {
                            title: {
                                text: 'Jumlah'
                            }
                        },
                        legend: {
                            enabled: false
                        },
                        plotOptions: {
                            series: {
                                borderWidth: 0,
                                dataLabels: {
                                    enabled: true,
                                    format: '{point.y}'
                                }
                            }
                        },
                        series: [
                            <?php

                            while ($row = mysqli_fetch_array($query2)) { ?> {
                                    name: '<?php echo $row['agama']; ?>',
                                    data: [<?php echo round($row['jumlah'], 2); ?>]
                                },
                            <?php } ?>
                        ]
                    });
                });

                $(function() {


                    var chart2;

                    $(document).ready(function() {
                        chart2 = new Highcharts.setOptions({
                            colors: ['#1abc9c', '#95a5a6', '#3498db', '#f1c40f', '#3498db', '#9b59b6']
                        });
                        // Build the chart
                        chart2 = new Highcharts.Chart({
                            chart: {
                                renderTo: 'chart-pie-2',
                                plotBackgroundColor: null,
                                plotBorderWidth: null,
                                plotShadow: false
                            },
                            title: {
                                text: 'Agama'
                            },
                            tooltip: {
                                pointFormat: '<b>{point.percentage}%</b>',
                                percentageDecimals: 1
                            },
                            plotOptions: {
                                pie: {
                                    allowPointSelect: true,
                                    cursor: 'pointer',
                                    dataLabels: {
                                        enabled: true
                                    },
                                    showInLegend: true
                                }
                            },
                            series: [{
                                type: 'pie',
                                name: '',
                                data: [
                                    <?php $query2 = mysqli_query($config, $qry2);
                                    while ($row = mysqli_fetch_array($query2)) { ?>['<?php echo $row['agama']; ?>', <?php echo $row['jumlah']; ?>],
                                    <?php } ?>
                                ]
                            }]
                        });
                    });

                });
            </script>
    </body>
    <!-- Body END -->

    </html>

<?php
}
?>