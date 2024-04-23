<?php
session_start();
if(!isset($_SESSION['userid'])){
  header("location:login.php");
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Halaman Edit Foto</title>
  <!-- Tambahkan link Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <style type="text/css">
    * {
      font-family: "Trebuchet MS";
    }
    h1 {
      text-transform: uppercase;
      color: salmon;
      text-align: center;
    }
    ul {
      list-style: none;
      padding: 0;
      text-align: center;
      margin-top: 20px;
    }
    ul li {
      display: inline-block;
      margin: 0 15px;
    }
    a {
      text-decoration: none;
      color: #333;
      font-weight: bold;
      font-size: 16px;
      transition: color 0.3s ease-in-out;
    }
    a:hover {
      color: #3498db;
    }
    button {
      background-color: salmon;
      color: #fff;
      padding: 10px;
      text-decoration: none;
      font-size: 12px;
      border: 0px;
      margin-top: 20px;
    }
    label {
      margin-top: 10px;
      float: left;
      text-align: left;
      width: 100%;
    }
    input {
      padding: 6px;
      width: 100%;
      box-sizing: border-box;
      background: #f8f8f8;
      border: 2px solid #ccc;
      outline-color: salmon;
    }
    div {
      width: 100%;
      height: auto;
    }
    .base {
      width: 400px;
      height: auto;
      padding: 20px;
      margin-left: auto;
      margin-right: auto;
      background: #ededed;
    }
  </style>
</head>
<body>
  <h1>Halaman Edit Foto</h1>
  <ul>
    <li><a href="index.php"><i class="fas fa-home"></i> Home</a></li>
    <li><a href="album.php"><i class="fas fa-images"></i> Album</a></li>
    <li><a href="foto.php"><i class="fas fa-camera"></i> Foto</a></li>
    <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
  </ul>
  <form action="update_foto.php" method="POST" enctype="multipart/form-data">
    <section class="base">
      <?php
      // memanggil file koneksi.php untuk membuat koneksi
      include 'koneksi.php';

      // mengecek apakah di url ada nilai GET id
      if (isset($_GET['fotoid'])) {
        // ambil nilai id dari url dan disimpan dalam variabel $id
        $fotoid = ($_GET["fotoid"]);

        // menampilkan data dari database yang mempunyai id=$id
        $query = "SELECT * FROM foto WHERE fotoid='$fotoid'";
        $result = mysqli_query($conn, $query);
        // jika data gagal diambil maka akan tampil error berikut
        if(!$result){
          die ("Query Error: ".mysqli_errno($conn).
             " - ".mysqli_error($conn));
        }
        // mengambil data dari database
        $data = mysqli_fetch_assoc($result);
        // apabila data tidak ada pada database maka akan dijalankan perintah ini
        if (!count($data)) {
          echo "<script>alert('Data tidak ditemukan pada database');window.location='ed.it_foto.php';</script>";
        }
      } else {
        // apabila tidak ada data GET id pada akan di redirect ke index.php
        echo "<script>alert('Masukkan data id.');window.location='edit_foto.php';</script>";
      }         
      ?>
      <input name="fotoid" value="<?php echo $data['fotoid']; ?>" hidden />
      <div>
        <label>Judul</label>
        <input type="text" name="judulfoto" value="<?php echo $data['judulfoto']; ?>" autofocus="" required="" />
      </div>
      <div>
        <label>Deskripsi</label>
        <input type="text" name="deskripsifoto" value="<?php echo $data['deskripsifoto']; ?>" autofocus="" required="" />
      </div>
      <div>
        <label>Lokasi File</label>
        <img src="gambar/<?php echo $data['lokasifile']; ?>" style="width: 120px;float: left;margin-bottom: 5px;">
        <input type="file" name="lokasifile" />
        <i style="float: left;font-size: 11px;color: red">Abaikan jika tidak merubah gambar produk</i>
      </div>
      <div>
        <label>Album</label>
        <select name="albumid" >
          <?php
          $userid=$_SESSION['userid'];
          $sql2=mysqli_query($conn,"SELECT * FROM album WHERE userid='$userid'");
          while($data2=mysqli_fetch_array($sql2)){
          ?>
          <option value="<?=$data2['albumid']?>"<?php if($data2['albumid']==$data['albumid']){echo 'selected';}?>><?=$data2['namaalbum']?></option>
          <?php
        }
        ?>  
      </select>
    </div>
    <button type="submit"><i class="fas fa-save"></i> Simpan Perubahan</button>
    <div></div>
  </section>
</form>
</body>
</html>
