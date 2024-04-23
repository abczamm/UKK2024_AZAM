<!DOCTYPE html>
<html lang="en">
<head>
<?php
    session_start();
    if(!isset($_SESSION['userid']))
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>komentar</title>
    <!-- Tambahkan link Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            color: #333;
        }

        h1 {
            text-align: center;
            padding: 20px;
            background-color: #3498db;
            margin: 0;
            color: #fff;
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
            width: 50%;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #3498db;
            color: #fff;
        }

        input {
            padding: 8px;
            margin: 4px 0;
            width: 100%;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    
    <h1>komentar</h1>
    <ul>
        <li><a href="index.php"><i class="fas fa-home"></i> Home</a></li>
        <li><a href="album.php"><i class="fas fa-images"></i> Album</a></li>
        <li><a href="foto.php"><i class="fas fa-camera"></i> Foto</a></li>
        <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
    </ul>
    <form action="tambah_komentar.php" method="post" onsubmit="return validateComment()">
        <?php
        include "koneksi.php";
        $fotoid=$_GET['fotoid'];
        $sql=mysqli_query($conn,"SELECT * FROM foto WHERE fotoid='$fotoid'");
        while($data=mysqli_fetch_array($sql)){
        ?>
        <input type="text" name="fotoid" value="<?=$data['fotoid']?>" hidden>
        <table>
            <tr>
                <td>judul</td>
                <td><input type="text" name="judulfoto" value="<?=$data['judulfoto']?>"></td>
            </tr>
            <tr>
                <td>Deskripsi</td>
                <td><input type="text" name="deskripsifoto" value="<?=$data['deskripsifoto']?>"></td>
            </tr>
            <tr>
                <td>foto</td>
                <td><img src="gambar/<?=$data['lokasifile']?>" width="200px"></td>
            </tr>
            <tr>
                <td>komentar</td>
                <td><input type="text" name="isikomentar" id="isikomentar"></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" value="tambah"></td>
            </tr>
        </table>
        <?php
        }
        ?>
    </form>
    <table>
        <tr>
            <th>id</th>
            <th>nama</th>
            <th>komentar</th>
            <th>tanggal</th>
        </tr>
        <?php
        include "koneksi.php";
        $userid=$_SESSION['userid'];
        $sql=mysqli_query($conn,"SELECT * FROM komentarfoto,user where komentarfoto.userid=user.userid");
        while($data=mysqli_fetch_array($sql)){
        ?>
        <tr>
            <td><?=$data['komentarid']?></td>
            <td><?=$data['namalengkap']?></td>
            <td><?=$data['isikomentar']?></td>
            <td><?=$data['tanggalkomentar']?></td>
        </tr>
        <?php
        }
        ?>
    </table>

    <!-- JavaScript untuk validasi komentar -->
    <script>
        function validateComment() {
            var comment = document.getElementById("isikomentar").value.trim();
            if (comment === "") {
                alert("Komentar tidak boleh kosong!");
                return false;
            }
            return true;
        }
    </script>
</body>
</html>
