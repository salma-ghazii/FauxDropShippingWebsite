<html>
<head>
    <title>Home</title><link rel="stylesheet" href="style.css">
</head>
<?php
	function displaySection($cat){
		$cnx = new mysqli('localhost', 'root', 'abc', 'website');
		if ($cnx->connect_error)
			die('Connection failed: ' . $cnx->connect_error);
		$count=0;
		$r=0;
		$query = 'SELECT * FROM products WHERE category="'.$cat.'" and company="vermont"';
		$cursor = $cnx->query($query);
		while($row = $cursor->fetch_assoc()){
			if($r%3==0)
			echo '<tr style="">';
			echo '<td colspan="2"><a href="compare.php?prod='.urlencode($row['name']).'&comp=vermont"><img src="' .$row['image']. '"style=""></a><br /><p>' .$row['name']. '</p></td>';
			if($r%3==2)
			echo '</tr>';
			$r++;
		}
		$query = 'SELECT * FROM products WHERE category="'.$cat.'" and company="dillards"';
		$cursor = $cnx->query($query);
		while($row = $cursor->fetch_assoc()){
			if($r%3==0)
				echo '<tr style="">';
			echo '<td colspan="2"><a href="compare.php?prod='.urlencode($row['name']).'&comp=dillards"><img src="' .$row['image']. '"style=""></a><br /><p>' .$row['name']. '</p></td>';
			if($r%3==2)
			echo '</tr>';
			$count++;
			$r++;
		}
		if($r%3==0)
			echo '</tr>';
		$cnx->close();
	}
?>
<body>
	<div class="nav">
		<a id="logo">Clothes, Home & More</a>
		<a class="navLink" href="index.php">Home</a>
	</div>	
	<div class="mainWrap">
	<img class="main" src="https://images.pexels.com/photos/5698856/pexels-photo-5698856.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1">
	<div class="name">Clothes, Home & More</div>
	</div>
	<h1 align="center">Our Featured Products!</h1>
	<h3 align="center">Men's Clothing</h3>
	<table align="center" border="1">

<?php
    displaySection("men");
?>
</table>

<h3 align="center">Women's Clothing</h3>
<table align="center" border="1">
<?php
    displaySection("women");
?>
</table>

<h3 align="center">Home</h3>
<table align="center" border="1">
<?php
    displaySection("home");
?>
</table>

<h3 align="center">Accessories</h3>
<table align="center" border="1">
<?php
    displaySection("accessories");
?>
</table>

<h3 align="center">Beauty</h3>
<table align="center" border="1">
<?php
    displaySection("beauty");
?>
</table>

</body>
</html>
