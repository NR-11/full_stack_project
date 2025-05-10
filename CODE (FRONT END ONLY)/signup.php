<?php
include 'connect.php';

if (isset($_POST['submit']) && isset($_POST['F_Name']) && isset($_POST['L_Name']) && isset($_POST['Email']) && isset($_POST['Pass'])) {
    $F_Name = htmlspecialchars($_POST['F_Name']);
    $L_Name = htmlspecialchars($_POST['L_Name']);
    $Email = htmlspecialchars($_POST['Email']);
    $Pass = htmlspecialchars($_POST['Pass']);
    @$add_user = "INSERT INTO users (F_Name, L_Name, Email ,Pass) VALUES ('$F_Name', '$L_Name','$Email','$Pass')";
    @$result = mysqli_query($conn, $add_user);
    if ($result) {
        header("Location: login.php");
        exit();
    } else {
        echo "<script> alert('Error Try Again');</script>";
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    body {
        background-image: url('images/signup_bg.jpg');
        background-size: cover;
        background-position: center;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    .signup-container {
        background: rgba(255, 255, 255, 0.1);
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
        background: rgba(255, 255, 255, 0.2);
        border: none;
    }

    .form-control::placeholder {
        color: rgba(255, 255, 255, 0.897);
    }
    </style>
</head>

<body>
    <div class="signup-container">
        <div class="logo-container">
            <img src="images/logo.png">
            <h4>INSIDER</h4>
        </div>
        <h3>Sign Up</h3>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="mb-3">
                <input type="text" name="F_Name" class="form-control" placeholder="First Name" min="3" max="20"
                    required>
            </div>
            <div class="mb-3">
                <input type="text" name="L_Name" class="form-control" placeholder="Last Name" min="3" max="20" required>
            </div>
            <div class="mb-3">
                <input type="email" name="Email" class="form-control" placeholder="Email Address" min="3" max="30"
                    required>
            </div>
            <div class="mb-3">
                <input type="password" name="Pass" class="form-control" placeholder="Password" min="3" max="20"
                    required>
            </div>
            <button type="submit" name="submit" class="btn btn-primary w-100">Sign Up</button>


        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>