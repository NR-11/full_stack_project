<?php
include 'connect.php';

if (isset($_POST['submit']) && isset($_POST['Email']) && isset($_POST['Pass'])) {
    $Email = trim(htmlspecialchars($_POST['Email']));
    $Pass = trim(htmlspecialchars($_POST['Pass']));

    $query = "SELECT * FROM users WHERE Email='$Email' AND Pass='$Pass'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_array($result);
        session_start();
        $_SESSION['ID'] = $row['User_id'];
        $_SESSION['Email'] = $Email;
        $_SESSION['F_Name'] = $row['F_Name'];
        $_SESSION['L_Name'] = $row['L_Name'];
        $_SESSION['Pass'] = $row['Pass'];

        header("Location: home.php");
        exit();
    } else {
        echo "<script>alert('Error Try Again');</script>";
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    body {
        background: url('images/login_bg.jpg') no-repeat center center/cover;
        background-size: cover;
        background-position: center;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    .login-container {
        background: rgba(255, 255, 255, 0.2);
        padding: 40px;
        border-radius: 15px;
        backdrop-filter: blur(10px);
        width: 550px;
        text-align: center;
        color: white;
    }

    .logo-container {
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 10px;
    }

    .logo-container img {
        width: 50px;
        height: 50px;
        margin-right: 10px;
    }

    .form-control {
        background: rgba(255, 255, 255, 0.5);
        border: none;
        padding: 10px;
    }

    .form-control::placeholder {
        color: rgba(61, 61, 61, 0.897);
    }
    </style>

</head>

<body>
    <div class="login-container">
        <div class="logo-container">
            <img src="images/logo.png">
            <h4>INSIDER</h4>
        </div>
        <h3>Log In</h3>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="mb-3">
                <input type="email" name="Email" class="form-control" placeholder="Enter your email" required>
            </div>

            <div class="mb-3">
                <input type="password" name="Pass" class="form-control" placeholder="Enter your password" required>
            </div>
            <button type="submit" name="submit" class="btn btn-primary w-100 mt-2">Log In</button>
        </form>
    </div>
</body>

</html>