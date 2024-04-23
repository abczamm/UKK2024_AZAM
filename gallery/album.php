<!DOCTYPE html>
<html lang="en">
<head>
<?php
    session_start();
    if(!isset($_SESSION['userid']))
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ALBUM</title>
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
            max-width: 400px;
            margin: 20px auto;
        }

        form table {
            width: 100%;
            margin-top: 10px;
        }

        form table td {
            padding: 8px;
        }

        form input[type="text"] {
            width: 100%;
            padding: 8px;
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
    <h1>Halaman Album</h1>
    <p> <b><?=$_SESSION['namalengkap']?></b></p>
    <ul>
        <li><a href="home.php"><i class="fas fa-home"></i> Home</a></li>
        <li><a href="album.php"><i class="fas fa-images"></i> Album</a></li>
        <li><a href="foto.php"><i class="fas fa-camera"></i> Foto</a></li>
        <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
    </ul>
    <form action="tambah_album.php" method="post" onsubmit="return validateForm()">
        <table>
            <tr>
                <td>Nama Album</td>
                <td><input type="text" name="namaalbum" id="namaalbum"></td>
            </tr>
            <tr>
                <td>Deskripsi</td>
                <td><input type="text" name="deskripsi" id="deskripsi"></td>
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
            <th>Nama Album</th>
            <th>Deskripsi</th>
            <th>Tanggal dibuat</th>
            <th>Aksi</th>
        </tr>
        <?php
        include "koneksi.php";
        $userid=$_SESSION['userid'];
        $sql=mysqli_query($conn,"SELECT * FROM album where userid='$userid'");
        while ($data=mysqli_fetch_array($sql)) {
        ?>
        <tr>
            <td><?=$data['albumid']?></td>
            <td><?=$data['namaalbum']?></td>
            <td><?=$data['deskripsi']?></td>
            <td><?=$data['tanggaldibuat']?></td>
            ...
<td>
    <a href="hapus_album.php?albumid=<?=$data['albumid']?>" onclick="return confirmDelete();"><i class="fas fa-trash-alt"></i> Hapus</a>
    <a href="edit_album.php?albumid=<?=$data['albumid']?>"><i class="fas fa-edit"></i> Edit</a>
</td>
...

        </tr>
        <?php
        }
        ?>
    </table>

    ...
<!-- JavaScript untuk validasi input dan konfirmasi penghapusan -->
<script>
    function validateForm() {
        var namaAlbum = document.getElementById("namaalbum").value.trim();
        var deskripsi = document.getElementById("deskripsi").value.trim();
        if (namaAlbum === "" || deskripsi === "") {
            alert("Nama album dan deskripsi tidak boleh kosong!");
            return false;
        }
        return true;
    }

    function confirmDelete() {
        return confirm("Apakah Anda yakin ingin menghapus album ini?");
    }
</script>
