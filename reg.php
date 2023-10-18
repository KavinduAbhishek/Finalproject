<?php
@include 'Config.php';

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

if (isset($_POST["submit"])) {
    // Accept data and sanitize inputsecho "u_name: $u_name<br>";
echo "contact_number: $contact_number<br>";
echo "email: $email<br>";
echo "password: $password<br>";
echo "user_type: $user_type<br>";


    $u_name = mysqli_real_escape_string($con, $_POST['u_name']);
    $contact_number = mysqli_real_escape_string($con, $_POST['contact_number']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['pwd']);
    $user_type = $_POST['user_type']; // Get the selected value from the combo box

    // Check if any of the required form fields are empty

    if (empty($u_name) || empty($contact_number) || empty($email) || empty($password) || empty($user_type)) {
        $message[] = 'Error: Please fill in all required fields.';
    } else {
        // Insert the selected user type into the user_type table
        $user_type_sql = "INSERT INTO user_type (user_type) VALUES (?)";
        $user_type_stmt = $con->prepare($user_type_sql);
        if ($user_type_stmt) {
            $user_type_stmt->bind_param("s", $user_type);
            if ($user_type_stmt->execute()) {
                
                $user_type_stmt->close();
            } else {
                $message[] = 'Error: ' . $user_type_stmt->error;
            }
        } else {
            $message[] = 'Error: ' . $con->error;
        }

        // Determine the table name based on the selected value
        $table_name = ($user_type === 'tailor') ? 'tailor' : 'customer';

        // Prepare and execute the SQL statement to insert user details
        $sql = "INSERT INTO `$table_name`(`u_name`, `contact_number`, `email`, `password`) VALUES (?, ?, ?, ?)";
        $stmt = $con->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("ssss", $u_name, $contact_number, $email, $password);
            if ($stmt->execute()) {
          header("Location: login_form.php");

            } else {
                $message[] = 'Error: ' . $stmt->error;
            }
            $stmt->close();
        } else {
            $message[] = 'Error: ' . $con->error;
        }
    }
}

$con->close();
?>




<!Doctype html>
<!DOCTYPE html>
<html>
<head>

<link rel="stylesheet"  href="/ccs/style.css" >
   
   <link rel="stylesheet" href="ccs/AccountReg1.css">
    
    <title>All Products - CLEONA Fashion</title>

 
    
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
    <ul >
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
                           
                            <span >Register</span>
                            <hr id="Indicator">
                        </div>
                      
                         <form id="RegistationForm" action="reg.php" method="post">

                         <select name="user_type">
                            <option value="tailor">Tailor</option>
                            <option value="customer" name="customer" selected>Customer</option> 
                         </select>
                            <input type="text" name="u_name" placeholder="User name">
                            <input type="text" name="contact_number" placeholder="Phone Number">
                            <input type="email" name="email" placeholder="Email">
                            <input type="password" name="pwd" placeholder="password">
                            <input type="password" name="pwd1" placeholder="Comfirm password">
                            <button type="Submit" name="submit" class="btn">Register</button>

                           <p>Create a Account <a href="login_form.php">Login.</a></p>
                          
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

