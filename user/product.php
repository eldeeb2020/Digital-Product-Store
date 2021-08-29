<?php
session_start();
require_once('../config.php');

require_once(baseLink."functions/new_database.php");

$current_url = urlencode($url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Shopping Cart</title>
<link href="style/style.css" rel="stylesheet" type="text/css">
<style>
            
            body{
                background-color:DodgerBlue;
            }
            
            
        </style>
</head>
<body>


<h1 align="center">Products </h1>




<?php
$results = $mysqli->query("SELECT product_code, product_name, product_img_name, price FROM products ORDER BY id ASC");
while($row = mysqli_fetch_assoc($results)){
	echo $row['product_name'];
	echo '<div class="product-thumb"><img src="'.baseUrl.'images/'.$row['product_img_name'].'"> </div>';
	echo '<br>';
	echo '<br>';


} //
?>
<!-- Products List End -->
<h1>
Date: <?php echo date("l jS \of F Y h:i:s A");?>
</h1>
</body>
</html>
