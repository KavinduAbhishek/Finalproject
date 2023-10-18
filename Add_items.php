<?php
@include 'Config.php';
if(isset($_POST["add_product"]))
{
    //Accept data
    $cmbproducts=$_POST['cmbproducts'];
	$product_price=$_POST['product_price'];
	$rdsmall=$_POST['rdsmall'];
	$rdmedium=$_POST['rdmedium'];
	$rdlarge=$_POST['rdlarge'];
	$rdxl=$_POST['rdxl'];
	$rdxxl=$_POST['rdxxl'];
	$product_description=$_POST['product_description'];
	$productImage=$_FILES["prodImg"]["name"];

    if(empty($cmbproducts) || empty($product_price) || empty($rdsmall) || empty($rdlarge) || empty($rdlarge) || empty($rdxl) || empty($rdxxl) || empty($product_description) ||  empty($productImage)){
		$message[]='please fill out all';
	}else{
    //perform sql
    $sql="INSERT INTO item(item_name,price,small,medium,large,xl,xxl,description,image) VALUES('$cmbproducts','$product_price','$rdsmall','$rdmedium','$rdlarge','$rdxl','$rdxxl','$product_description','$productImage')";
    $return=mysqli_query($con,$sql);
    //upload file in to server folder
    if($return==1)
    {
        $uploadfile="products/$productImage";
        move_uploaded_file($_FILES['prodImg']['tmp_name'],$uploadfile);
        $message[]='new product added successfully';
    }
    else{
        $message[]='could not add product';
        }
}
   


mysqli_close($con);


}

?>


<html>
    <head>
        <title>Tailors Page</title>
        	<!--font awesome cdn link-->
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
	<link rel="stylesheet" type="text/css" href="BootStrap/css/bootstrap.min.css">
	
	<!--Custom css file link-->
    <link rel="stylesheet" type="text/css" href="/ccs/style.css">
	<link rel="stylesheet" type="text/css" href="./ccs/style1.css">
	
	<script type="text/javascript " src="BootStrap/js/bootstrap.min.js"></script>
	

    </head>
    <body>

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

				<!-- Home titles -->
				<ul>
					

					<li><a class="active" href="tailor_home.php">Home</a></li>
					<li><a href="View_item.php">View Shop</a></li>
					
					
				</ul>
			</nav>
       </div>
    </div> 

        <div class="container">
        <div class="admin-product-form-container">
		<form action="<?php $_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">
			<h3>add a new product</h3>
			<h4 id="h4" class="box">Product name: <select name="cmbproducts" id="select" >
			<option selected="selected" value="Shirt">Shirt</option>
			<option selected="selected" value="Frock">Frock</option>
			<option selected="selected" value="Skirt">Skirt</option>
			<option selected="selected" value="Croptops">Croptops</option>
			<option selected="selected" value="Jeans">Jeans</option></select></h4>
			<input type="number" placeholder="enter product price" name="product_price" class="box">
			<h4 id="h4" class="box">small:  <input type="radio" value="Available"  name="rdsmall">Available  <input type="radio"  name="rdsmall" value="Not Available" checked>Not Available</h4>
			<h4 id="h4" class="box">Medium: <input type="radio" value="Available"  name="rdmedium">Available  <input type="radio"  name="rdmedium" value="Not Available"  checked>Not Available</h4>
			<h4 id="h4"class="box">Large: <input type="radio" value="Available"  name="rdlarge">Available  <input type="radio"  name="rdlarge" value="Not Available" checked>Not Available</h4>
			<h4 id="h4"class="box">XL: <input type="radio" value="Available"  name="rdxl">Available  <input type="radio"  name="rdxl" value="Not Available" checked>Not Available</h4>
			<h4 id="h4"class="box">XXL: <input type="radio" value="Available" name="rdxxl">Available  <input type="radio"  name="rdxxl" value="Not Available" checked>Not Available</h4>
			<textarea name="product_description" placeholder="Enter about your product description" rows="4"class="box"></textarea>
			<input type="file" name="prodImg" class="box">
			<input type="submit" class="btn" name="add_product" value="add product">

		</form>
	</div>
</div>
</body>
</html>


<?php
    @include 'Config.php';

    $sql="SELECT * FROM item";
    $result=mysqli_query($con,$sql);

    //print result
    echo "<div class=container>";
   echo" <div class=poduct-display>";
	echo "<table border= width=500px>";
    echo "<thead>";
    echo "<tr >";
    echo "<th width=100px text-align=center>item image</th>";
    echo "<th width=100px text-align=center>item name</th>";
    echo "<th width=100px text-align=center>price</th>";
    echo "<th width=100px text-align=center>small</th>";
    echo "<th width=100px text-align=center>medium</th>";
    echo "<th width=100px text-align=center>large</th>";
    echo "<th width=100px text-align=center>XL</th>";
    echo "<th width=100px text-align=center>XXL</th>";
    echo "<th width=100px text-align=center>Description</th>";
    echo "<th colspan=2 width=100px text-align=center>action</th>";
    echo "</tr>";
    echo "</thead>";
    while ($row=mysqli_fetch_array($result)){
        echo "<tr>";
        echo "<td><img src='products/$row[9]' height=100px weight=100px></td>";
        echo "<td>$row[1]</td>";
        echo "<td>$row[2]</td>";
        echo "<td>$row[3]</td>";
        echo "<td>$row[4]</td>";
        echo "<td>$row[5]</td>";
        echo "<td>$row[6]</td>";
        echo "<td>$row[7]</td>";
        echo "<td>$row[8]</td>";
        echo "<td>";
        echo "<a href='Update_item.php?edit= $row[0] class='btn' style = 'display: block; width: 100%; cursor: pointer; border-radius: .5rem; margin-top:1rem ;font-size:1.7rem; padding: 1rem 3rem; background:var(--green); color:var(--white); text-align:center;'><i class='fas fa-edit'></i>edit</a>";
        echo "<br>";
        echo "<a href='Delete_items.php?delete= $row[0] class='btn' style = 'display: block; width: 100%; cursor: pointer; border-radius: .5rem; margin-top:1rem ;font-size:1.7rem; padding: 1rem 3rem; background:crimson; color:var(--white); text-align:center;'><i class='fas fa-trash'></i>delete</a>";
        echo "</td>";
        echo "</tr>";
    }
    

   echo "</table>";
    echo "</div>";
    echo "</div>";
    mysqli_close($con);



?>
