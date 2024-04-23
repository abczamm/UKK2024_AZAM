<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Landing</title>
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

        p {
            text-align: center;
            font-size: 18px;
            margin-top: 10px;
        }

        b {
            color: #3498db;
        }

        table {
            width: 100%;
            border-collapse: collapse;
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
            max-width: 150px;
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

        /* Tambahkan gaya untuk ikon */
        .fas {
            margin-right: 5px;
        }
    </style>
</head>
<body>
    <h1>HOME</h1>
    <?php
    session_start();
    if(!isset($_SESSION['userid'])){
    ?>
    <ul>
        <li><a href="register.php"><i class="fas fa-user-plus"></i> Register</a></li>
        <li><a href="login.php"><i class="fas fa-sign-in-alt"></i> Login</a></li>
    </ul>
    <?php
    }else{
    ?>
    <p><b><?=$_SESSION['namalengkap']?></b></p>
    <ul>
        <li><a href="index.php"><i class="fas fa-home"></i> Home</a></li>
        <li><a href="album.php"><i class="fas fa-images"></i> Album</a></li>
        <li><a href="foto.php"><i class="fas fa-camera"></i> Foto</a></li>
        <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li> 
    </ul>
    <?php
    }
    ?>
    <table width="100%" border="1" cellpadding="5" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>Judul</th>
            <th>Deskripsi</th>
            <th>Foto</th>
            <th>Uploader</th>
            <th>Jumlah Like</th>
            <th>Aksi</th>
        </tr>
        <?php
        include "koneksi.php";
        $sql= mysqli_query($conn,"select * from foto,user where foto.userid=user.userid");
        while ($data=mysqli_fetch_array($sql)) {
        ?>
        <tr>
            <td><?=$data['fotoid']?></td>
            <td><?=$data['judulfoto']?></td>
            <td><?=$data['deskripsifoto']?></td>
            <td><img src="gambar/<?=$data['lokasifile']?>" width="150px"></td>
            <td><?=$data['namalengkap']?></td>
            <td>
                <?php
                $fotoid=$data['fotoid'];
                $sql2=mysqli_query($conn,"SELECT * FROM likefoto WHERE fotoid='$fotoid'");
                echo mysqli_num_rows($sql2);
                ?>
            </td>
            <td>
                <a href="like.php?fotoid=<?=$data['fotoid']?>"><i class="fas fa-thumbs-up"></i> Like</a>
                <a href="komentar.php?fotoid=<?=$data['fotoid']?>"><i class="fas fa-comment"></i> Komentar</a>
            </td>
        </tr>
        <?php   
        }
        ?>
    </table>
</body>
</html>
