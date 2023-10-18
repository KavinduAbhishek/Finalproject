<?php
session_start();
?>
<?php
include 'Config.php';

// Check if the database connection is successful
if ($con->connect_error) {
  die("Connection failed: " . $conn->connect_error);
} else {
 
}

if (isset($_POST["checkout.php"])) {
  $firstname = (isset($_POST["firstname"]));
  $lastname = (isset($_POST["lastname"]));
  $addressline1 = (isset($_POST["address01"]));
  $addressline2 = (isset($_POST["address02"]));
  $country = (isset($_POST["country"]));
  $zipcode = (isset($_POST["zipcode"]));
  $city = (isset($_POST["city"]));
  $state = (isset($_POST["state"]));

    if (empty($firstname) || empty($lastname) || empty($addressline1) || empty($country) || empty($zipcode) || empty($city) || empty($state)) {
        $errors[] = 'Error: Please fill in all required fields.';
    } else {
        
       $sql="INSERT INTO `order` (firstname, lastname, addressline1, addressline2, country, zipcode, city, state) VALUES ('$firstname', '$lastname','$addressline1', '$addressline2', '$country', '$zipcode', '$city', '$state')";
       $return=mysqli_query($con,$sql);

        // Execute the prepared statement
        if ($return==1) {
            echo "Billing address data inserted successfully.";
        } else {
          $message[] = "Error inserting data into the database: " ;
        }

      
    }

    mysqli_close($con);
}
?>


<!Doctype html>
<!DOCTYPE html>
<html>
<head>
	
	<title>All Products - CLEONA Fashion</title>
  <link rel="stylesheet"  href="./ccs/style.css" >
	<link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 <link rel="stylesheet"  href="./ccs/checkout.css">

   
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
		<li><a class="active" href="index.php">Home</a></li>
          
          <li><a href="login_form.php" class="logout">Log Out</a></li>
         
	</ul>

    </nav>
        <a href="Shopping-cart.php"><img src="images/Carticon.png" width="30px" height="30px"></a>

       </div>
	</div>

<?php
if(isset($_REQUEST['logout']))
{
  session_unset();
  session_destroy();
}
?>


	<!--------Checkout----------->

<section class="packages" id="packages">
      <h1 class="heading" style="padding-bottom: 0px;text-align: left;font-weight: bold;padding-left: 2rem;font-size: 30px;">
       Checkout
      </h1>
      <div class="row">
        <div class="col-md-5">
          <h1 class="title_" style="padding-left: 2rem;">Billing Address</h1>
          <div class="container">
            <p class="p_">Please enter your billing address.</p>
            <hr class="hr_"></hr>
            <div class="form">
            <form method="POST" action="checkout.php">
              <div class="fields fields--2">
                <label class="field">
                  <span class="field__label" name="firstname" >First name</span>
                  <input type="text" id="firstname"/>
                </label>
                <label class="field">
                  <span class="field__label" name="lastname" >Last name</span>
                  <input type="text" id="lastname" ></input>
                </label>
              </div>
              <label class="field">
                <span class="field__label" name="address01" >Address Line 01</span>
                <input class="field__input" type="text" id="address01" />
              </label>
              <label class="field">
                <span class="field__label" name="address02" >Address Line 02</span>
                <input class="field__input" type="text" id="address02" />
              </label>
              <label class="field">
                <span class="field__label" name="country" >Country</span>
                <input class="field__input" type="text" id="country" />
              </label>
              <div class="fields fields--3">
                <label class="field">
                  <span class="field__label" name="zipcode">Zip code</span>
                  <input class="field__input" type="text" id="zipcode" pattern="[0-9]*" required />
                </label>
                <label class="field">
                  <span class="field__label" name="city" >City</span>
                  <input class="field__input" type="text" id="city" />
                </label>
                <label class="field">
                  <span class="field__label" name="state" >State</span>
                  <input class="field__input" type="text" id="state" />
                </label>
              </div>
            </div>
            <hr class="hr_"/>
            <button class="button_" name="save_details">Save Shipping Details</button>
          </div>
</form> 
        </div>
        <div class="col-md-7">
          <div>
            <h1 class="title_">Card Details</h1>
            <div class="screen flex-center">
              <form class="popup flex">
                <!-- CARD FORM -->
                <div class="flex-fill flex-vertical">
                  <div class="flex-between flex-vertical-center"></div>
                  <div class="card-data flex-fill flex-vertical">
                    <!-- Card Number -->
                    <div class="flex-between flex-vertical-center">
                      <div class="card-property-title">
                        <strong>Card Number</strong>
                        <span>Enter 16-digit card number on the card</span>
                      </div>
                    </div>
                    <!-- Card Field -->
                    <div class="flex-between">
                      <div class="card-number flex-vertical-center flex-fill">
                        <div
                          class="card-number-field flex-vertical-center flex-fill">

                          <!-----------master card icon ----------->

                          <h1><i class="mastercard-icon"></i><h1>
                          
                          <input
                            class="numbers"
                            type="number"
                            min="1"
                            max="9999"
                            placeholder="0000"
                          />-
                          <input
                            class="numbers"
                            type="number"
                            placeholder="0000"
                          />-
                          <input
                            class="numbers"
                            type="number"
                            placeholder="0000"
                          />-
                          <input
                            class="numbers"
                            type="number"
                            placeholder="0000"
                            data-bound="carddigits_mock"
                            data-def="0000"
                          />
                        </div>
                        <i
                          class="ai-circle-check-fill size-lg f-main-color"
                        ></i>
                      </div>
                    </div>
                    <!-- Expiry Date -->
                    <div class="flex-between">
                      <div class="card-property-title">
                        <strong>Expiry Date</strong>
                        <span>Enter the expiration date of the card</span>
                      </div>
                      <div class="card-property-value flex-vertical-center">
                        <div class="input-container half-width">
                          <input
                            class="numbers"
                            data-bound="mm_mock"
                            data-def="00"
                            type="number"
                            min="1"
                            max="12"
                            step="1"
                            placeholder="MM"
                          />
                        </div>
                        <span class="m-md">/</span>
                        <div class="input-container half-width">
                          <input
                            class="numbers"
                            data-bound="yy_mock"
                            data-def="01"
                            type="number"
                            min="23"
                            max="99"
                            step="1"
                            placeholder="YY"
                          />
                        </div>
                      </div>
                    </div>
                    <!-- CCV Number -->
                    <div class="flex-between">
                      <div class="card-property-title">
                        <strong>CVC Number</strong>
                        <span
                          >Enter card verification code from the back of the
                          card</span
                        >
                      </div>
                      <div class="card-property-value">
                        <div class="input-container">
                          <input id="cvc" type="password" />
                          <i
                            id="cvc_toggler"
                            data-target="cvc"
                            class="ai-eye-open pointer"
                          ></i>
                        </div>
                      </div>
                    </div>
                    <!-- Name -->
                    <div class="flex-between">
                      <div class="card-property-title">
                        <strong>Cardholder Name</strong>
                        <span>Enter cardholder's name</span>
                      </div>
                      <div class="card-property-value">
                        <div class="input-container">
                          <input
                            id="name"
                            data-bound="name_mock"
                            data-def="Mr. Cardholder"
                            type="text"
                            class="uppercase"
                            placeholder="CARDHOLDER NAME"
                          />
                          <i class="ai-person"></i>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="action flex-center">
                    <button type="submit" class="b-main-color pointer">
                      Pay Now
                    </button>
                  </div>
                </div>
                <!-- SIDEBAR -->
                <div class="sidebar flex-vertical">
                  <div></div>
                  <div class="purchase-section flex-fill flex-vertical">
                    <div class="card-mockup flex-vertical">
                      <div class="flex-fill flex-between">
                        <i
                          class="ai-bitcoin-fill size-xl f-secondary-color"
                        ></i>
                        <i class="ai-wifi size-lg f-secondary-color"></i>
                      </div>
                      <div>
                        <div
                          id="name_mock"
                          class="size-md pb-sm uppercase ellipsis"
                        >
                          Cardholder Name
                        </div>
                        <div class="size-md pb-md">
                          <strong>
                            <span class="pr-sm">
                              &#x2022;&#x2022;&#x2022;&#x2022;
                            </span>
                            <span id="carddigits_mock">0000</span>
                          </strong>
                        </div>
                        <div class="flex-between flex-vertical-center">
                          <strong class="size-md">
                            <span id="mm_mock">00</span>/<span id="yy_mock"
                              >01</span
                            >
                          </strong>
                          <!------------master card icon-------------->

                          <h1><i class="mastercard-icon"></i><h1>

                        </div>
                      </div>
                    </div>
                    <ul class="purchase-props">
                      <li class="flex-between">
                        <span>Price</span>
                        <strong id="total-display">total</strong>
                      </li>
                      <li class="flex-between">
                        <span>Order number</span>
                        <strong id="ordernumber"></strong>
                      </li>
                      <li class="flex-between">
                        <span>VAT (20%)</span>
                        <strong id="vatcalculate"></strong>
                      </li>
                    </ul>
                  </div>
                  <div class="separation-line"></div>
                  <div class="total-section flex-between flex-vertical-center">
                    <div class="flex-fill flex-vertical">
                      <div class="total-label f-secondary-color">
                        You have to Pay
                      </div>
                      <div id="totalPay">
                       
                      </div>
                    </div>
                    <i class="ai-coin size-lg"></i>
                  </div>
                </div>
              </form>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <div class="icons_express">
                        <i class="fab fa-google-pay i_"></i>
                        <i class="fab fa-apple-pay i_"></i>
                        <i class="fab fa-paypal i_"></i>
                    </div>
                </div>
            </div>
          </div>
        </div>
      </div>
    </section>




<!---------Footer---------->

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

  <script src="js/checkout.js"></script>
  
</body>
</html>