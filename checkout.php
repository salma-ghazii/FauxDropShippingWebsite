<html>
<head>
    <title>Home Page</title><link rel="stylesheet" href="style.css">
</head>
<body>
<div class="nav">
		<a id="logo">Clothes, Home & More</a>
		<a class="navLink" href="index.php">Home</a>
	</div>	
	<h1 align="center">Check Out</h1>
	<!-- <div align="center" border="1"> -->
    <div class="wrapper">
	<div class="child">


    

<?php

    $cnx = new mysqli('localhost', 'root', 'abc', 'website');

    if ($cnx->connect_error)

        die('Connection failed: ' . $cnx->connect_error);
   
    $product = $_GET["prod"];
    $company = $_GET["comp"];
    $temp = str_replace('"','\"',$product);
    #echo $product . " " . $company;
    if($company == "vermont")
    	$query = 'SELECT * FROM products WHERE name="' .$temp. '"and company="vermont"';
    else
    	$query = 'SELECT * FROM products WHERE name="' .$temp. '" and company="dillards"';
    $cursor = $cnx->query($query);
    $item=$cursor->fetch_assoc();
    
   
    
 	#echo'<form action="/confirm.php?prod='.urlencode($item['name']).'">';
 	echo'
 	<form action="/confirm.php">
	  <label for="fname">First name:</label><br>
	  <input type="text" name="fname"><br>
	  <label for="lname">Last name:</label><br>
	  <input type="text" name="lname"><br><br>
	  
	  <label for="card">Card number:</label><br>
	  <input type="text" name="card"><br>
	  <label for="address">Address:</label><br>
	  <input type="text" name="address"><br><br>
	  <input type="hidden" name="prod" value="'.$product.'"><br><br>
	  
	  
	  <input type="submit" value="Submit" class="button">
    </form>
    ';
    
    
    
    echo '</div><div class="child">';

    echo '<img src="' .$item['image']. '"><br/>';
    
    echo '<p>'.$item['name'] . '</p><br/>';
    echo '$'.number_format($item['price']*1.1, 2, ".", ",") . '<br/>';


    #echo '<a href="checkout.php?prod='.urlencode($item['name']).'&comp='.$company.'"><button>Buy Now!</button></a><br/>';


    $cnx->close();



?>



</div>


</body>



</html>
