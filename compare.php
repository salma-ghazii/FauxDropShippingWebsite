<html>
<head>
    <title>Home Page</title><link rel="stylesheet" href="style.css">
</head>
<body>
<div class="nav">
		<a id="logo">Clothes, Home & More</a>
		<a class="navLink" href="index.php">Home</a>
	</div>	
	<h1 align="center">Choose From Our Similar Product!</h1>
    <h3 align="center">The Cheaper Product Is Highlighted in Green!</h3>

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
    $index=$item['i'];
    if($company == "vermont"){
    	$company2="dillards";
    	$query = 'SELECT * FROM products WHERE i="' .$index. '"and company="dillards"';
    	}
    else{
    	$company2="vermont";
    	$query = 'SELECT * FROM products WHERE i="' .$index. '"and company="vermont"';
    	}

    

    $cursor = $cnx->query($query);
    $item2=$cursor->fetch_assoc();
    
    
    
    
    
    echo '<img src="' .$item['image']. '" style=""><br/>';
    if($item2['price'] > $item['price'])
    	echo '<font color="green">'.$item['name'] . '</font><br/>';
    else
    	echo '<font color="red">'.$item['name'] . '</font><br/>';
    echo $item['description'] . '<br/>';
    echo 'Rated '. $item['rating']. '<br/>';
    echo '$'.number_format($item['price']*1.1, 2, ".", ",") . '<br/>';
    echo '<a href="checkout.php?prod='.urlencode($item['name']).'&comp='.$company.'"><button>Buy Now!</button></a><br/>';
    echo '</div><div class="child">';
    echo '<img src="' .$item2['image']. '"style=""><br/>';


    if($item2['price'] < $item['price'])
    	echo '<font color="green">'.$item2['name'] . '</font><br/>';
    else
    	echo '<font color="red">'.$item2['name'] . '</font><br/>';
    echo $item2['description'] . '<br/>';
    echo 'Rated '. $item2['rating']. '<br/>';
    echo '$'.number_format($item2['price']*1.1, 2, ".", ",") . '<br/>';
    echo '<a href="checkout.php?prod='.urlencode($item2['name']).'&comp='.$company2.'"><button>Buy Now!</button></a>';
    $cnx->close();



?>



</div>
</div>


</body>



</html>
