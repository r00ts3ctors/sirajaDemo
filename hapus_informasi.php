<?php
require_once 'include/config.php';
require_once 'include/functions.php';
$config = conn($host, $username, $password, $database);


@$page = $_REQUEST['page'];
$hapus = mysqli_query($config, "DELETE FROM tbl_informasi WHERE id='$page'");
if ($hapus == true) {
    $_SESSION['succHapus'] = 'SUKSES! Data Informasi berhasil dihapus';
    echo '<script language="javascript">window.location.href="./admin.php?page=blm"; </script>';
}
