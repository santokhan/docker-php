<?php
$title = "About Us";
$year = date("Y");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $title; ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f8;
            margin: 0;
            padding: 0;
        }

        header {
            background: #2d3748;
            color: white;
            padding: 20px;
            text-align: center;
        }

        .container {
            max-width: 800px;
            margin: 40px auto;
            background: white;
            padding: 30px;
            border-radius: 8px;
        }

        .box {
            background: #edf2f7;
            padding: 15px;
            border-radius: 6px;
            margin-top: 15px;
        }

        a {
            color: #2b6cb0;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<header>
    <h1>About This Project</h1>
</header>

<div class="container">
    <h2>Who We Are</h2>
    <p>
        This is a simple PHP project running inside a Docker environment.
        It is designed for learning and testing basic web hosting setups.
    </p>

    <div class="box">
        <strong>Project Type:</strong> Lightweight PHP App<br>
        <strong>Environment:</strong> Docker + Apache + PHP<br>
        <strong>Year:</strong> <?php echo $year; ?>
    </div>

    <div class="box">
        <strong>Purpose:</strong><br>
        To simulate a basic hosting-like environment without using cPanel.
    </div>

    <div class="box">
        <a href="/">← Back to Home</a>
    </div>
</div>

</body>
</html>