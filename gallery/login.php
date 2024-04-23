<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Login</title>
    <style>
        a{
            text-decoration: none;
        }
        body {
            background: linear-gradient(45deg, #3498db, #e74c3c);
            background-size: cover;
            font-family: Arial, sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            position: relative; /* Tambahkan untuk posisi relatif */
        }

        h1 {
            color: #fff;
        }

        form {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            animation: fadeInUp 0.5s ease-in-out;
            transition: transform 0.3s ease-in-out;
            position: relative; /* Tambahkan untuk posisi relatif */
            z-index: 1; /* Tambahkan untuk menempatkan form di depan robot */
        }

        form:hover {
            transform: scale(1.05);
        }

        table {
            width: 100%;
        }

        td {
            padding: 8px;
            text-align: right;
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
            transition: all 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
            transform: scale(1.1);
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

        /* Animasi robot */
        #robot {
            position: absolute;
            bottom: -50px;
            left: 50%;
            transform: translateX(-50%);
            animation: moveRobot 5s infinite alternate;
        }

        @keyframes moveRobot {
            from {
                transform: translateX(-50%) rotate(0deg);
            }
            to {
                transform: translateX(-50%) rotate(10deg);
            }
        }
    </style>
</head>
<body>
    <h1></h1>
    <form action="proses_login.php" method="post">
        <table>
            <tr>
                <td>Username</td>
                <td><input type="text" name="username"></td>
            </tr>
            <tr>
                <td>Password</td>
                <td><input type="password" name="password"></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" value="Login"></td>
            </tr>
        </table>
        <h4>belum punya akun?</h4><a href="index.php">Register</a>
    </form>
    <!-- SVG Robot -->
    <svg id="robot" xmlns="http://www.w3.org/2000/svg" width="150" height="150" viewBox="0 0 24 24">
        <g fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M5 12a7 7 0 0 1 14 0z"/>
            <circle cx="16" cy="8" r="1"/>
            <circle cx="8" cy="8" r="1"/>
            <path d="M5.2 16H18.8c1.3 0 2.4.8 2.7 2H2.6c.3-1.2 1.4-2 2.6-2z"/>
        </g>
    </svg>
</body>
</html>
