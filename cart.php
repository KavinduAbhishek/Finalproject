
<!DOCTYPE html>
<html>
    <style>
    .delete-btn{
        background-color: red !important;
    }
    </style>
<head>
<link rel="stylesheet" href="style2.css">
    <link rel="stylesheet" type="text/css" href="ccs/cart.css">
    <title>Shopping Cart</title>
</head>
<body>
<!DOCTYPE html>
<html>
<head><title>Cleona Fashion</title>
	<link rel="stylesheet" href="style2.css">
	<link rel="stylesheet" href="./ccs/cart.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   
 </head>

 <body>

<div class="header">
 
          <!--logo-->
          <div class="navbar">
	    <div class="logo">
		<img src="images/CLEONA Logo.jpg">
        </div>
		
			<!-- Menu -->
			<nav>
				<input type="checkbox" id="check">
				<label for="check" class="checkbtn">
					<i class="fa fa-bars"></i>
				</label>
				<label class="logo1"></label>

				<ul>
			
			
        <ul class="navbar"> 
            <li><a class="active" href="index.php">Home</a></li>
            <li><a href="view_item.php">Products</a></li>
            <li><a href="cart.php">Cart</a></li>
			
			<a href="design.php"><img src="images/cloth hanger.png" width="30px" height="30px"></a>
	
			
		</div>
		</div> 

    <div class="container">
        <h1>Your Shopping Cart</h1>
    
       
       <?php
require_once "Config.php";
session_start();

$user_id = $_SESSION['user_id'];

$query = "SELECT * FROM cart WHERE user_id = ?";

$stmt = $con->prepare($query);

if ($stmt) {
    
    $stmt->bind_param("i", $user_id);

    
    $stmt->execute();

   
    $result = $stmt->get_result();

    
    $cart_items = array();
    while ($row = $result->fetch_assoc()) {
        $cart_items[] = $row;
    }

    // Close the statement
    $stmt->close();

} else {
    echo "Error preparing the statement: " . $con->error;
}
        foreach ($cart_items as $item) {
            $cart_id = $item['cart_id'];
            $image = $item['image'];
            $item_name = $item['name'];
            $price = $item['cost'];
            $selected_size = $item['size'];
            $description = $item['description'];
        
            echo '<div class="cart-item">';
            echo '<img src="products/' . $image . '">';
            echo '<div class="details">';
            echo '<h2>' . $item_name . '</h2>';
            echo '<p>Price: $' . $price . '</p>';
            echo '<p>Size: ' . $selected_size . '</p>';
            echo '<p>Description: ' . $description . '</p>';
            echo '<p>Quantity: </p> <input type="number" class="quantity" value="1" min="1" style="width: 30px;">';
            echo '<br> <br><br> ';
            echo '<div class="shopping-cart"><a class="addto" onclick="addToCart(' . $price . ')">Add to Cart</a> <a class="delete-btn" href="cart_delete.php?cart_id=' . $cart_id . '">Delete</a></div>'; 
         
            echo '</div>';
            echo '</div>';
        }
        
      
        ?>
   
            <h2>Checkout</h2>
            <div id="checkout-items"></div>
            <div class="checkout-total">
                <strong>Total: $<span id="total">0</span></strong>
            </div>
            <button id="clearcart-button" class="button_" style="margin-bottom: 0.5rem;">Clear Cart</button>
            <button id="checkout-button" a href="checkout.php" class="button_" type="submit">Checkout</button>
            <a class="addto" href="view_item.php">Continue Shopping</a> 
            <form action="checkout.php" method="post">
                <input type="hidden" name="name" id="item-name-input">
                <input type="hidden" name="total" id="checkout-total-input" value="0">
                <input type="hidden" name="size" id="item-size-input">
                <input type="hidden" name="quantity" id="item-quantity-input" value="1">
                <input type="hidden" name="image" id="item-image-input">
               
                
            </form>
        </div>
    </div>

<!-- Footer -->
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
					<a href="https://instagram.com/cleona_fashion?igshid=NGExMmI2YTkyZg==" target="_blank ">Instagram</a><br>
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
	<h1 class="credit">Copyright 2022 - 2023 <span> CLEONA FASHION</span> | all rights reserved! </h1>
</section>

    <script src="cart.js"></script>
</body>
</html>
