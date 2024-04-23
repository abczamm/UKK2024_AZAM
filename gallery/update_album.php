<?php
include "koneksi.php";
session_start();

$namaalbum=$_POST['namaalbum'];
$deskripsi=$_POST['deskripsi'];


$sql=mysqli_query($conn,"UPDATE album SET namaalbum='$namaalbum',deskripsi='$deskripsi'");
header("location:album.php");
?>