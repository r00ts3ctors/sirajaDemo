<?php
    //cek session
    if(empty($_SESSION['admin'])){

        $_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login terlebih dahulu.';
        header("Location: ./");
        die();
    } else {

        // if($_SESSION['admin'] != 1){
        //     echo '<script language="javascript">
        //             window.alert("ERROR! Anda tidak memiliki hak akses untuk membuka halaman ini");
        //             window.location.href="./logout.php";
        //           </script>';
        // } else {

          echo '<!-- Row Start -->
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
        <li class="tab"><a href="#test4">BNNP Kepulauan RIAU</a></li>
        <li class="tab"><a class="active" href="#test5">BNNKBatam</a></li>
        <li class="tab"><a href="#test6">BNNK Tanjungpinang</a></li>
      </ul>
    </div>
    <div class="card-content grey lighten-4">
      <div id="test4">Kepulauan RIAU1
 <div class="center">
                                    <div class="accent">
                                    <br/>
                                        <a href="?page=tsm"><img src="./asset/img/manpas.png"/></a> &nbsp;
                                        <a href="?page=api"><img src="./asset/img/asesmen.png"/></a>
                                        <a href="?page=grf"><img src="./asset/img/statistik2.png"/></a>
                                    <br/><br/>
                                        
                                        <a href="?page=ref"><img src="./asset/img/klasifikasi3.png"/></a> &nbsp;
                                        <a href="?page=sett&sub=usr"><img src="./asset/img/manageuser.png"/></a>
                                        <a href="?page=sett"><img src="./asset/img/Pengaturan3.png"/></a></center>
                                    <br/>
                                    </div>   
                                </div>
      </div>
      <div id="test5">Batam2
 <div class="center">
                                    <div class="accent">
                                    <br/>
                                        <a href="?page=tsm"><img src="./asset/img/manpas.png"/></a> &nbsp;
                                        <a href="?page=api"><img src="./asset/img/asesmen.png"/></a>
                                        <a href="?page=grf"><img src="./asset/img/statistik2.png"/></a>
                                    <br/><br/>
                                        
                                        <a href="?page=ref"><img src="./asset/img/klasifikasi3.png"/></a> &nbsp;
                                        <a href="?page=sett&sub=usr"><img src="./asset/img/manageuser.png"/></a>
                                        <a href="?page=sett"><img src="./asset/img/Pengaturan3.png"/></a></center>
                                    <br/>
                                    </div>   
                                </div>
      </div>
      <div id="test6">Tanjungpinang3
       <div class="center">
                                    <div class="accent">
                                    <br/>
                                        <a href="?page=tsm"><img src="./asset/img/manpas.png"/></a> &nbsp;
                                        <a href="?page=api"><img src="./asset/img/asesmen.png"/></a>
                                        <a href="?page=grf"><img src="./asset/img/statistik2.png"/></a>
                                    <br/><br/>
                                        
                                        <a href="?page=ref"><img src="./asset/img/klasifikasi3.png"/></a> &nbsp;
                                        <a href="?page=sett&sub=usr"><img src="./asset/img/manageuser.png"/></a>
                                        <a href="?page=sett"><img src="./asset/img/Pengaturan3.png"/></a></center>
                                    <br/>
                                    </div>   
                                </div>
                                </div>
    </div>
  </div>
                            </div>
                        </div>
                    </div>';
                }
            
?>
