<?php
require_once "Config.php";
session_start();

if (isset($_GET['cart_id'])) {
    $cart_id = $_GET['cart_id'];
    
    // Perform the SQL DELETE operation to delete the item with the specified cart_id
    $query = "DELETE FROM cart WHERE cart_id = ?";
    $stmt = $con->prepare($query);
    
    if ($stmt) {
        $stmt->bind_param("i", $cart_id);
        $stmt->execute();
        
        // Redirect back to the shopping cart page after deletion
        header("Location: cart.php");
        exit();
    } else {
        echo "Error preparing the statement: " . $con->error;
    }
} else {
    echo "Invalid request. Missing cart_id parameter.";
}
?>
