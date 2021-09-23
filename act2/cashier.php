<?php
    session_start();

    if(!isset($_SESSION['username']) || $_SESSION['role'] != "cashier"){
        header("location:index.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cashier Page</title>

</head>
<body class="bg-dark">
    <h1>Cashier Dashboard</h1>
    <a href="logout.php">Logout</a>
</body>
</html>