<!DOCTYPE html>
<html lang="en">
<head>
<?php
session_start();
if(!isset($_SESSION['userid'])){
    header("location:login.php");
}
?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Foto</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        h1 {
            color: #333;
            text-align: center;
            padding: 20px;
            background-color: #3498db;
            margin: 0;
        }

        p {
            text-align: center;
            font-size: 18px;
            margin-top: 10px;
        }

        b {
            color: #3498db;
        }

        ul {
            list-style: none;
            padding: 0;
            text-align: center;
            margin-top: 20px;
        }

        li {
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

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            animation: fadeInUp 0.5s ease-in-out;
            transition: transform 0.3s ease-in-out;
            max-width: 600px;
            margin: 20px auto;
        }

        form table {
            width: 100%;
            margin-top: 10px;
        }

        form table td {
            padding: 8px;
        }

        form input[type="text"], form select, form input[type="file"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }

        form input[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            cursor: pointer;
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
        }

        form input[type="submit"]:hover {
            background-color: #45a049;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }

        table th, table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        table th {
            background-color: #4caf50;
            color: #fff;
        }

        table img {
            max-width: 200px;
            height: auto;
        }

        table a {
            text-decoration: none;
            color: #3498db;
            margin-right: 10px;
            font-weight: bold;
        }

        table a:hover {
            color: #2980b9;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>
    <h1>FOTO</h1>
    <p> <b><?=$_SESSION['namalengkap']?></b></p>
    <ul>
        <li><a href="index.php"><i class="fas fa-home"></i> Home</a></li>
        <li><a href="album.php"><i class="fas fa-images"></i> Album</a></li>
        <li><a href="foto.php"><i class="fas fa-camera"></i> Foto</a></li>
        <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
    </ul>
    <form action="tambah_foto.php" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
        <table>
            <tr>
                <td>Judul</td>
                <td><input type="text" name="judulfoto" id="judulfoto"></td>
            </tr>
            <tr>
                <td>Deskripsi</td>
                <td><input type="text" name="deskripsifoto" id="deskripsifoto"></td>
            </tr>
            <tr>
                <td>Lokasi File</td>
                <td><input type="file" name="lokasifile" id="lokasifile"></td>
            </tr>
            <tr>
                <td>Album</td>
                <td>
                    <select name="albumid" id="albumid">
                        <?php
                        include "koneksi.php";
                        $userid=$_SESSION['userid'];
                        $sql=mysqli_query($conn,"SELECT * FROM album where userid='$userid'");
                        while($data=mysqli_fetch_array($sql)){
                        ?>
                        <option value="<?=$data['albumid']?>"><?=$data['namaalbum']?></option>
                        <?php
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" value="Tambah"></td>
            </tr>
        </table>
    </form>
    <table border="1" cellpadding="5" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>Judul</th>
            <th>Deskripsi</th>
            <th>Tanggal Unggah</th>
            <th>Lokasi File</th>
            <th>Album</th>
            <th>Disukai</th>
            <th>Aksi</th>
        </tr>
        <?php
        include "koneksi.php";
        $userid=$_SESSION['userid'];
        $sql=mysqli_query($conn,"SELECT * FROM foto,album where foto.userid='$userid' and foto.albumid=album.albumid");
        while ($data=mysqli_fetch_array($sql)) {
        ?>
        <tr>
            <td><?=$data['fotoid']?></td>
            <td><?=$data['judulfoto']?></td>
            <td><?=$data['deskripsifoto']?></td>
            <td><?=$data['tanggalunggah']?></td>
            <td>
                <img src="gambar\<?=$data['lokasifile']?>" width="200px">
            </td>
            <td><?=$data['namaalbum']?></td>
            <td>
                <?php
                $fotoid=$data['fotoid'];
                $sql2=mysqli_query($conn,"SELECT * FROM likefoto WHERE fotoid='$fotoid'");
                echo mysqli_num_rows($sql2);
                ?>
            </td>
            <td>
                <a href="hapus_foto.php?fotoid=<?=$data['fotoid']?>"><i class="fas fa-trash-alt"></i> Hapus</a>
                <a href="edit_foto.php?fotoid=<?=$data['fotoid']?>"><i class="fas fa-edit"></i> Edit</a>
            </td>
        </tr>
        <?php
        }
        ?>
    </table>

    <!-- JavaScript untuk validasi input dan ukuran file -->
    <script>
        function validateForm() {
            var judul = document.getElementById("judulfoto").value.trim();
            var deskripsi = document.getElementById("deskripsifoto").value.trim();
            var lokasiFile = document.getElementById("lokasifile");
            var albumId = document.getElementById("albumid").value.trim();

            // Validasi ukuran file
            if (lokasiFile.files.length > 0) {
                var fileSize = lokasiFile.files[0].size; // Ukuran file dalam bytes
                var maxSize = 5 * 1024 * 1024; // Maksimal 5 MB
                if (fileSize > maxSize) {
                    alert("Ukuran file melebihi batas maksimal (5 MB)!");
                    return false;
                }
            }

            // Validasi input kosong
            if (judul === "" || deskripsi === "" || albumId === "") {
                alert("Semua input harus diisi!");
                return false;
            }
            return true;
        }
    </script>
</body>
</html>
