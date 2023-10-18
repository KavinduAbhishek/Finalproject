<?php
@include 'Config.php';

if (isset($_POST['update_product'])) {
    
    if (isset($_POST['item_id'])) {
        $item_id = $_POST['item_id']; 
        $product_price = $_POST['product_price'];
        $rdsmall = $_POST['rdsmall'];
        $rdmedium = $_POST['rdmedium'];
        $rdlarge = $_POST['rdlarge'];
        $rdxl = $_POST['rdxl'];
        $rdxxl = $_POST['rdxxl'];
        $description = $_POST['product_description'];

        
        $update_query = "UPDATE item SET price='$product_price', small='$rdsmall', medium='$rdmedium', large='$rdlarge', xl='$rdxl', xxl='$rdxxl', description='$description' WHERE item_id='$item_id'";

        $update_result = mysqli_query($con, $update_query);

        if ($update_result) {
            echo "Product updated successfully.";
        } else {
            echo "Failed to update product: " . mysqli_error($con);
        }
    } else {
        echo "Item ID is missing in the form.";
    }
}

$sql = "SELECT item_id, item_name FROM item";
$result = mysqli_query($con, $sql);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Product</title>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="BootStrap/css/bootstrap.min.css">
 
    <link rel="stylesheet" href="./ccs/style1.css">
    
    <script type="text/javascript" src="BootStrap/js/bootstrap.min.js"></script>
    
</head>
<body>
    <div class="container">
        <div class="admin-product-form-container">
            <?php if (isset($_GET['edit'])): ?>
                <?php
                $item_id = $_GET['edit']; 
                $query = "SELECT * FROM item WHERE item_id = '$item_id'";
                $result = mysqli_query($con, $query);

                if ($result && mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);

                    $product_price = $row['price'];
                    $rdsmall = $row['small'];
                    $rdmedium = $row['medium'];
                    $rdlarge = $row['large'];
                    $rdxl = $row['xl'];
                    $rdxxl = $row['xxl'];
                    $description = $row['description'];
                }
                ?>
                <form action="Update_item.php" method="post">
                    <input type="hidden" name="item_id" value="<?php echo $item_id; ?>"> 
                    <h3>Edit Product</h3>
                    <input type="number" placeholder="enter product price" name="product_price" class="box" value="<?php echo $product_price; ?>">
                    <h4 id="h4" class="box">small:  <input type="radio" value="Available"  name="rdsmall" <?php if ($rdsmall == 'Available') echo 'checked'; ?>>Available  <input type="radio"  name="rdsmall" value="Not Available" <?php if ($rdsmall == 'Not Available') echo 'checked'; ?>>Not Available</h4>
                <h4 id="h4" class="box">Medium: <input type="radio" value="Available"  name="rdmedium" <?php if ($rdmedium == 'Available') echo 'checked'; ?>>Available  <input type="radio"  name="rdmedium" value="Not Available" <?php if ($rdmedium == 'Not Available') echo 'checked'; ?>>Not Available</h4>
                <h4 id="h4" class="box">Large: <input type="radio" value="Available"  name="rdlarge" <?php if ($rdlarge == 'Available') echo 'checked'; ?>>Available  <input type="radio"  name="rdlarge" value="Not Available" <?php if ($rdlarge == 'Not Available') echo 'checked'; ?>>Not Available</h4>
                <h4 id="h4" class="box">XL: <input type="radio" value="Available"  name="rdxl" <?php if ($rdxl == 'Available') echo 'checked'; ?>>Available  <input type="radio"  name="rdxl" value="Not Available" <?php if ($rdxl == 'Not Available') echo 'checked'; ?>>Not Available</h4>
                <h4 id="h4" class="box">XXL: <input type="radio" value="Available" name="rdxxl" <?php if ($rdxxl == 'Available') echo 'checked'; ?>>Available  <input type="radio"  name="rdxxl" value="Not Available" <?php if ($rdxxl == 'Not Available') echo 'checked'; ?>>Not Available</h4>
                <textarea name="product_description" placeholder="Enter about your product description" rows="4" class="box"><?php echo $description; ?></textarea>
           
                    <input type="submit" class="btn" name="update_product" value="Update Product">
                </form>
            <?php else:{
             header("Location: Add_items.php");
            } ?>
             
            <?php endif; ?>
        </div>
    </div>
</body>
</html>

<?php
mysqli_close($con);
?>
