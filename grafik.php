<script type="text/javascript" src="asset/highcharts/highcharts.js"></script>
<script type="text/javascript" src="asset/highcharts/modules/data.js"></script>
<script type="text/javascript" src="asset/highcharts/modules/drilldown.js"></script>
<script type="text/javascript" src="asset/highcharts/modules/exporting.js"></script>
<script type="text/javascript" src="asset/highcharts/modules/export-data.js"></script>
<script type="text/javascript" src="asset/highcharts/modules/accessibility.js"></script>

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

        if(isset($_REQUEST['submit'])){

            $dari_tanggal = $_REQUEST['dari_tanggal'];
            $sampai_tanggal = $_REQUEST['sampai_tanggal'];

            if($_REQUEST['dari_tanggal'] == "" || $_REQUEST['sampai_tanggal'] == ""){
                header("Location: ./admin.php?page=grf");
                die();
            } else {
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
                                                <li class="waves-effect waves-light"><a href="#" class="judul"><i class="material-icons">print</i>DATA STATISTIK<a></li>
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
                                <input id="dari_tanggal" type="text" name="dari_tanggal" id="dari_tanggal" required>
                                <label for="dari_tanggal">Dari Tanggal</label>
                            </div>
                            <div class="input-field col s3">
                                <i class="material-icons prefix md-prefix">date_range</i>
                                <input id="sampai_tanggal" type="text" name="sampai_tanggal" id="sampai_tanggal" required>
                                <label for="sampai_tanggal">Sampai Tanggal</label>
                            </div>
                            <div class="col s6">
                                <button type="submit" name="submit" class="btn-large blue waves-effect waves-light"> TAMPILKAN <i class="material-icons">visibility</i></button>
                            </div>
                        </form>
                    </div>
                    <!-- Row form END -->

                    <div class="row agenda">
                    
                    <div class="separator"></div>
                    <h5 class="hid">RESUME Klien</h5>
                        <div class="col s10">
                            <p class="warna agenda">Statistik Klien dari tanggal <strong>'.indoDate($dari_tanggal).'</strong> sampai dengan tanggal <strong>'.indoDate($sampai_tanggal).'</strong></p>
                        </div>
                        <div class="col s2">
                            <button type="submit" onClick="window.print()" class="btn-large deep-orange waves-effect waves-light right">CETAK <i class="material-icons">print</i></button>
                        </div>
                    </div>';

                    if($_SESSION['admin'] == 3){
                        $qry = "SELECT jenis_kelamin, COUNT(*) AS jumlah FROM tbl_surat_masuk WHERE tgl_diterima BETWEEN '$dari_tanggal' AND '$sampai_tanggal' AND id_user='".$_SESSION['id_user']."' GROUP BY jenis_kelamin";
                        $query3 = mysqli_query($config, $qry);

                        $qry2 = "SELECT agama, COUNT(*) AS jumlah FROM tbl_surat_masuk WHERE tgl_diterima BETWEEN '$dari_tanggal' AND '$sampai_tanggal' AND id_user='".$_SESSION['id_user']."'GROUP BY agama";
                        $query2 = mysqli_query($config, $qry2); 

                        $qry3 = "SELECT keterangan, COUNT(*) AS jumlah FROM tbl_surat_masuk WHERE tgl_diterima BETWEEN '$dari_tanggal' AND '$sampai_tanggal' AND id_user='".$_SESSION['id_user']."'GROUP BY keterangan";
                        $query3 = mysqli_query($config, $qry3);

                        $qry4 = "SELECT status_perkawinan, COUNT(*) AS jumlah FROM tbl_surat_masuk WHERE tgl_diterima BETWEEN '$dari_tanggal' AND '$sampai_tanggal' AND id_user='".$_SESSION['id_user']."'GROUP BY status_perkawinan";
                        $query4 = mysqli_query($config, $qry4);

                        $qry5 = "SELECT klinik, COUNT(*) AS jumlah FROM tbl_surat_masuk WHERE tgl_diterima BETWEEN '$dari_tanggal' AND '$sampai_tanggal' AND id_user='".$_SESSION['id_user']."'GROUP BY klinik";
                        $query5 = mysqli_query($config, $qry5);

                    } else {
                        $qry = "SELECT jenis_kelamin, COUNT(*) AS jumlah FROM tbl_surat_masuk WHERE tgl_diterima BETWEEN '$dari_tanggal' AND '$sampai_tanggal' GROUP BY jenis_kelamin";
                        $query = mysqli_query($config, $qry);

                        $qry2 = "SELECT agama, COUNT(*) AS jumlah FROM tbl_surat_masuk WHERE tgl_diterima BETWEEN '$dari_tanggal' AND '$sampai_tanggal' GROUP BY agama";
                        $query2 = mysqli_query($config, $qry2); 

                        $qry3 = "SELECT keterangan, COUNT(*) AS jumlah FROM tbl_surat_masuk WHERE tgl_diterima BETWEEN '$dari_tanggal' AND '$sampai_tanggal' GROUP BY keterangan";
                        $query3 = mysqli_query($config, $qry3);

                        $qry4 = "SELECT status_perkawinan, COUNT(*) AS jumlah FROM tbl_surat_masuk WHERE tgl_diterima BETWEEN '$dari_tanggal' AND '$sampai_tanggal' GROUP BY status_perkawinan";
                        $query4 = mysqli_query($config, $qry4);

                        $qry5 = "SELECT klinik, COUNT(*) AS jumlah FROM tbl_surat_masuk WHERE tgl_diterima BETWEEN '$dari_tanggal' AND '$sampai_tanggal' GROUP BY klinik";
                        $query5 = mysqli_query($config, $qry5);

                    }
                ?>
                
                <div class="row">
                    <div class="col s4">
                        <div id="chart-bar-1"></div>
                    </div>
                    <div class="col s4">
                        <div id="chart-pie-1"></div>
                    </div>
                </div>

                 <div class="row">
                    <div class="col s4">
                        <div id="chart-bar-2"></div>
                    </div>
                    <div class="col s4">
                        <div id="chart-pie-2"></div>
                    </div>
                </div>

                <div class="row">
                    <div class="col s4">
                        <div id="chart-bar-3"></div>
                    </div>
                    <div class="col s4">
                        <div id="chart-pie-3"></div>
                    </div>
                </div>

                <div class="row">
                    <div class="col s4">
                        <div id="chart-bar-4"></div>
                    </div>
                    <div class="col s4">
                        <div id="chart-pie-4"></div>
                    </div>
                </div>

                <div class="row">
                    <div class="col s4">
                        <div id="chart-bar-5"></div>
                    </div>
                    <div class="col s4">
                        <div id="chart-pie-5"></div>
                    </div>
                </div>

                <script type="text/javascript">  
                    var chart1; // globally available
                    $(document).ready(function() {
                        Highcharts.setOptions({
                                colors: ['#0984e3', '#ff7675']
                            });
                    
                      chart1 = new Highcharts.Chart({
                         chart: {
                            renderTo: 'chart-bar-1',
                            type: 'column'
                         },   
                         title: {
                            text: 'Jenis Kelamin'
                         },
                         xAxis: {
                            categories: ['Jenis Kelamin']
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
                        series:             
                            [
                                <?php
                                   
                                    while($row = mysqli_fetch_array($query)){ ?>
                                    {
                                        name: '<?php echo $row['jenis_kelamin']; ?>',
                                        data: [<?php echo round($row['jumlah'],2); ?>]
                                    },
                                <?php } ?>
                            ]
                      });
                    });  
               
                    $(function () {
                       
                        
                        var chart1;
                        
                        $(document).ready(function () {
                            chart1 = new Highcharts.setOptions({
                                colors: ['#0984e3', '#ff7675']
                            });
                            // Build the chart
                            chart1 = new Highcharts.Chart({
                                chart: {
                                    renderTo: 'chart-pie-1',
                                    plotBackgroundColor: null,
                                    plotBorderWidth: null,
                                    plotShadow: false
                                },
                                title: {
                                    text: 'PIE Jenis Kelamin'
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
                                        <?php $query1 = mysqli_query($config, $qry);
                                            while($row = mysqli_fetch_array($query1)){ ?>
                                        ['<?php echo $row['jenis_kelamin']; ?>' , <?php echo $row['jumlah']; ?>],
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
                                colors: ['#1abc9c', '#95a5a6','#3498db','#f1c40f','#3498db','#9b59b6']
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
                        series:             
                            [
                                <?php
                                   
                                    while($row = mysqli_fetch_array($query2)){ ?>
                                    {
                                        name: '<?php echo $row['agama']; ?>',
                                        data: [<?php echo round($row['jumlah'],2); ?>]
                                    },
                                <?php } ?>
                            ]
                      });
                    });  
               
                    $(function () {
                        
                        
                        var chart2;
                        
                        $(document).ready(function () {
                            chart2 = new Highcharts.setOptions({
                                colors: ['#1abc9c', '#95a5a6','#3498db','#f1c40f','#3498db','#9b59b6']
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
                                            while($row = mysqli_fetch_array($query2)){ ?>
                                        ['<?php echo $row['agama']; ?>' , <?php echo $row['jumlah']; ?>],
                                        <?php } ?>
                                    ]
                                }]
                            });
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
                        series:             
                            [
                                <?php
                                   
                                    while($row = mysqli_fetch_array($query3)){ ?>
                                    {
                                        name: '<?php echo $row['keterangan']; ?>',
                                        data: [<?php echo round($row['jumlah'],2); ?>]
                                    },
                                <?php } ?>
                            ]
                      });
                    });  
               
                    $(function () {
                       
                        
                        var chart3;
                        
                        $(document).ready(function () {
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
                                            while($row = mysqli_fetch_array($query3)){ ?>
                                        ['<?php echo $row['keterangan']; ?>' , <?php echo $row['jumlah']; ?>],
                                        <?php } ?>
                                    ]
                                }]
                            });
                        });
                        
                    });
                </script> 

                <script type="text/javascript">  
                    var chart4; // globally available
                    $(document).ready(function() {
                        Highcharts.setOptions({
                                colors: ['#0984e3', '#ff7675']
                            });
                    
                      chart4 = new Highcharts.Chart({
                         chart: {
                            renderTo: 'chart-bar-4',
                            type: 'column'
                         },   
                         title: {
                            text: 'Status Perkawinan'
                         },
                         xAxis: {
                            categories: ['Status Perkawinan']
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
                        series:             
                            [
                                <?php
                                   
                                    while($row = mysqli_fetch_array($query4)){ ?>
                                    {
                                        name: '<?php echo $row['status_perkawinan']; ?>',
                                        data: [<?php echo round($row['jumlah'],2); ?>]
                                    },
                                <?php } ?>
                            ]
                      });
                    });  
               
                    $(function () {
                       
                        
                        var chart4;
                        
                        $(document).ready(function () {
                            chart4 = new Highcharts.setOptions({
                                colors: ['#0984e3', '#ff7675']
                            });
                            // Build the chart
                            chart4 = new Highcharts.Chart({
                                chart: {
                                    renderTo: 'chart-pie-4',
                                    plotBackgroundColor: null,
                                    plotBorderWidth: null,
                                    plotShadow: false
                                },
                                title: {
                                    text: 'Status Perkawinan'
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
                                        <?php $query4 = mysqli_query($config, $qry4);
                                            while($row = mysqli_fetch_array($query4)){ ?>
                                        ['<?php echo $row['status_perkawinan']; ?>' , <?php echo $row['jumlah']; ?>],
                                        <?php } ?>
                                    ]
                                }]
                            });
                        });
                        
                    });
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
                            text: 'Klinik'
                         },
                         xAxis: {
                            categories: ['Klinik']
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
                        series:             
                            [
                                <?php
                                   
                                    while($row = mysqli_fetch_array($query5)){ ?>
                                    {
                                        name: '<?php echo $row['klinik']; ?>',
                                        data: [<?php echo round($row['jumlah'],2); ?>]
                                    },
                                <?php } ?>
                            ]
                      });
                    });  
               
                    $(function () {
                       
                        
                        var chart5;
                        
                        $(document).ready(function () {
                            chart5 = new Highcharts.setOptions({
                                colors: ['#0984e3', '#ff7675', '#00d9ff', '#6a65ff', '#ff73f5', '#ff5c76', '#2afff9', '#6fff6a', '#0984e3', '#ff7675', '#00d9ff', '#6a65ff', '#ff73f5', '#ff5c76', '#2afff9', '#6fff6a']
                            });
                            // Build the chart
                            chart5 = new Highcharts.Chart({
                                chart: {
                                    renderTo: 'chart-pie-5',
                                    plotBackgroundColor: null,
                                    plotBorderWidth: null,
                                    plotShadow: false
                                },
                                title: {
                                    text: 'Klinik'
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
                                        <?php $query5 = mysqli_query($config, $qry5);
                                            while($row = mysqli_fetch_array($query5)){ ?>
                                        ['<?php echo $row['klinik']; ?>' , <?php echo $row['jumlah']; ?>],
                                        <?php } ?>
                                    ]
                                }]
                            });
                        });
                        
                    });
                </script>

                            <?php } ?>

                        <?php } else {

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
                                                            <li class="waves-effect waves-light"><a href="#" class="judul"><i class="material-icons"></i> DATA STATISTIK<a></li>
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
                                            <input id="dari_tanggal" type="text" name="dari_tanggal" id="dari_tanggal" required>
                                            <label for="dari_tanggal">Dari Tanggal</label>
                                        </div>
                                        <div class="input-field col s3">
                                            <i class="material-icons prefix md-prefix">date_range</i>
                                            <input id="sampai_tanggal" type="text" name="sampai_tanggal" id="sampai_tanggal" required>
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
