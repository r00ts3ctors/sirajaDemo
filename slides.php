<?php
    //cek session
    if(empty($_SESSION['admin'])){
        $_SESSION['err'] = '<center>Anda harus login terlebih dahulu!</center>';
        header("Location: ./");
        die();
    } else {
echo " 
      <!--Import Google Icon Font-->
      <link href='http://fonts.googleapis.com/icon?family=Material+Icons' rel='stylesheet'>
      <!--Import materialize.css-->
      <link type='text/css' rel='stylesheet' href='css/materialize.min.css'  media='screen,projection'/>
      <!--Let browser know website is optimized for mobile-->

 

      <meta name='viewport' content='width=device-width, initial-scale=1.0'/>
    </head>
    <body>
 <div class='container'>
  <div class='slider'>
    <ul class='slides'>";

foreach ($data->result() as $slide) {
     echo " <li>
        <img src='".$slide->gambar."'> <!-- random image -->
        <div class='caption center-align'>
          <h3>Keterangan</h3>
          <h5 class='light grey-text text-lighten-3'>".$slide->keterangan."</h5>
        </div>
      </li>";
}

    echo "</ul>
  </div>
  </div>
      <!--Import jQuery before materialize.js-->
      <script type='text/javascript' src='https://code.jquery.com/jquery-2.1.1.min.js'></script>
      <script type='text/javascript' src='js/materialize.min.js'></script>
   <!-- create by arifweb.com -->
   <script type='text/javascript' >  
   $(document).ready(function(){
      $('.slider').slider({full_width: true});
 });
 </script>
<a href='arifweb.com' > ©2016 </a>
    </body>
  </html>
 ";
}
?>
