<?php
    session_start();

    $conn = new mysqli("localhost", "root", "", "act2");

    $msg = "";

    if(isset($_POST['login'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $password = sha1($password);
        $userType = $_POST['userType'];

        $sql = "SELECT * FROM users WHERE username=? AND password=? AND user_type=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $username,$password,$userType);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        session_regenerate_id();
        $_SESSION['username'] = $row['username'];
        $_SESSION['role'] = $row['user_type'];
        session_write_close();

        if($result->num_rows==1 && $_SESSION['role'] == "admin"){
            header("location:admin.php");
        }
        else if($result->num_rows==1 && $_SESSION['role'] == "accountant"){
            header("location:accountant.php");
        }
        else if($result->num_rows==1 && $_SESSION['role'] == "cashier"){
            header("location:cashier.php");
        }
        else if($result->num_rows==1 && $_SESSION['role'] == "secretary"){
            header("location:secretary.php");
        }
        else if($result->num_rows==1 && $_SESSION['role'] == "student"){
            header("location:student.php");
        }
        else {
            $msg = "Username or Password is Incorrect";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">


</head>
<body class="bg-dark">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7 bg-light mt-5 px-0">
                <h3 class="text-center text-light bg-info p-3">Eyes Breaker!</h3>
                <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post" class="p-4 login">
                    <div class="form-group">
                        <input type="text" name="username" class="form-control form-control-lg" placeholder="Username" required>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control form-control-lg" placeholder="Password" required>
                    </div>
                    <div class="form-group lead">
                        <label form="userType">User: </label>
                        <input type="radio" name="userType" value="admin" class="custom-radio" required>&nbsp;Admin |
                        <input type="radio" name="userType" value="accountant" class="custom-radio" required>&nbsp;Accountant |
                        <input type="radio" name="userType" value="cashier" class="custom-radio" required>&nbsp;Cashier |
                        <input type="radio" name="userType" value="secretary" class="custom-radio" required>&nbsp;Secretary |
                        <input type="radio" name="userType" value="student" class="custom-radio" required>&nbsp;Student |
                    </div>
                    <div class="form-group">
                        <input type="submit" name="login" class="btn btn-danger btn-block">
                    </div>
                        <h5 class="text-danger text-center"><?= $msg; ?></h5>
                </form>
            </div>
        </div>
    </div>
</body>
</html>