<?php
session_start();
include 'Config.php'; // Include your database configuration file

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

if (isset($_POST["login"])) {
    $user_role = mysqli_real_escape_string($con, $_POST['user_type']);
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    if ($user_role === 'tailor') {
        $table_name = 'tailor';
        $redirect_success = 'tailor_home.php';
    } else {
        $table_name = 'customer';
        $redirect_success = 'index.php';
    }

    // Perform a query to check if the user credentials are valid
    $query = "SELECT * FROM $table_name WHERE u_name = '$username' AND password = '$password'";
    $result = $con->query($query);

    if ($result->num_rows == 1) {
        // User login successful, set session variables and redirect accordingly
        $row = $result->fetch_assoc();
        $_SESSION['user_id'] = $row['customer_id']; // Store the user ID in the session
        $_SESSION['user_role'] = $row['user_role'];
        $_SESSION['username'] = $username;
        
        header("Location: $redirect_success");
    } else {
        // User login unsuccessful, redirect to login_form.php
        header("Location: login_form.php");
    }
}

// Add some debugging messages
if (isset($_POST["login"])) {
    echo "Login attempt made!<br>";
    echo "User role: " . $user_role . "<br>";
    echo "Username: " . $username . "<br>";
    echo "Password: " . $password . "<br>";
}

$con->close();
?>


<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="ccs/style.css">
    <link rel="stylesheet" href="ccs/AccountLog.css">
</head>
<body>
    <div class="container"> 
        <div class="navbar">
            <div class="logo">
                <img src="images/CLEONA Logo.jpg" >
            </div>
            <nav>
                <input type="checkbox" id="check">
                <label for="check" class="checkbtn">
                    <i class="fa fa-bars"></i>
                </label>
                <label class="logo1"></label>
                <ul>
                    <li><a href="index.php">Home</a></li>
                </ul>
            </nav>
        </div>
    </div>

    <div class="account-page">
        <div class="container">
            <div class="row">
                <div class="col-2">
                    <img src="Main1.png" width="100%">
                </div>
                <div class="col-2">
                    <div class="form-container">
                        <div class="form-btn">
                            <span>Login</span>
                            <hr id="Indicator">
                        </div>
                        <form id="LoginForm" action="login_form.php" method="post">
                            <select name="user_type">
                                <option value="tailor">Tailor</option>
                                <option value="customer">Customer</option>
                            </select>
                            <input type="text" name="username" placeholder="Username">
                            <input type="password" name="password" placeholder="Password">
                            <button type="submit" name="login" class="btn">Login</button>
                            <p>Create an Account <a href="reg.php">Register</a></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="footer">

<div class="box-container">

    <div class="box1  about" >
        <h3>About us</h3>
        <p>Elevate your wardrobe at CLEONA FASHION.<br> Discover fashion that inspires,<br> curated just for you. Start shopping now!</p>
        
    </div>
    
    <div class="box1">
        <h3>Follow us</h3>
       <div class="socials">
            <a href="https://www.facebook.com/profile.php?id=100090516544184&mibextid=ZbWKwL " target="_blank ">Facebook</a><br>
            <a href="https://instagram.com/_cleona_fashion_?igshid=NGExMmI2YTkyZg==" target="_blank ">Instagram</a><br>
            <a href="https://api.whatsapp.com/send/?phone=94716700468&text&app_absent=0 " target="_blank ">whatsapp</a>
        </div>
    </div>

       <div class="box1">
            <img src="images/CLEONA logo2.png" class="img-footer" >
        </div>

    <div class="box1">
       <div class="box2"><h3  >Download Our App</h3></div>
        <p>Dowload App For Android and iso Mobile Phone.</p>
         <div class="app-logo">
             <div class="app-logo1"><img src="images/app-store.png">
             </div>
            <img src="images/play-store.png">
           
        </div>
        
    </div>

</div>

<h1 class="credit ">Copyright 2022 - 2023 <span> CLEONA FASHION</span> | all rights reserved! </h1>

</section>

</body>
</html>
