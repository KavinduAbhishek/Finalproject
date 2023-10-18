<?php
@include 'Config.php';
if(isset($_POST["submit"]))
{
    $message = $_POST['message'];

    $sql = "INSERT INTO feedback(feedback) VALUES ('$message')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Feedback submitted successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
  
mysqli_close($con);


}

?>

<html>
    <head>
        <title>Tailors Page</title>

        <!--Custom css file link-->

	<link rel="stylesheet" type="text/css" href="feedback.css">
        	<!--font awesome cdn link-->
	
	<link rel="stylesheet" type="text/css" href="BootStrap/css/bootstrap.min.css">
	
	
	
	<script type="text/javascript " src="BootStrap/js/bootstrap.min.js"></script>
	

    </head>
    <body>
    <div class="feedback-box">
        <h1>Feedback</h1>
        <form action="submit_feedback.php" method="POST">
           
            <label for="message">Feedback:</label><br>
            <textarea id="message" name="message" rows="4" cols="50" required></textarea><br><br>
            <input type="submit" value="Submit" name="submit">
        </form>
    </div>
</body>
</html>
