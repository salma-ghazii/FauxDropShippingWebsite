






<html>
<head>
    <title>Home Page</title><link rel="stylesheet" href="style.css">
</head>
<body>
<div class="nav">
		<a id="logo">Clothes, Home & More</a>
		<a class="navLink" href="index.php">Home</a>
	</div>	
	<h1 align="center">Your Order has been Placed!</h1>
	<div align="center" border="1">

    

<?php
    $cnx = new mysqli('localhost', 'root', 'abc', 'website');

    if ($cnx->connect_error)

        die('Connection failed: ' . $cnx->connect_error);
   
    $first = $_GET["fname"];
    $last = $_GET["lname"];
    $card = $_GET["card"];
    $address = $_GET["address"];
    $product = $_GET["prod"];
    #$temp = str_replace('"','\"',$product);
    #echo $product . " " . $company;
    #query = 'INSERT INTO vermontProducts(name,description ,price, image, rating, i) VALUES (%s,%s,%s, %s, %s, %s)'
    #cursor.execute(query, (n,d, p, u, r, i))
    $query='INSERT INTO transactions(product,first ,last, card, address) VALUES ("'.$product.'","'.$first.'","'.$last.'","'.$card.'","'. $address.'")';
    #echo $query;
    $cursor = $cnx->query($query);


    echo '<a href="index.php"><button>Back to Home!</button></a><br/>';


    $cnx->close();



?>



</div>


</body>



</html>
