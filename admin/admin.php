<?php
require_once('../config.php');
require_once(baseLink.'functions/validations.php');


$current_url = urlencode($url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
?>
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Shopping Cart</title>
    <link href="<?=baseUrl;?>style/style.css" rel="stylesheet" type="text/css">
    <style>
    body {
        background-color: DodgerBlue;
    }
    </style>
</head>

<body>

    <?php    if (isset($_GET['message'])){ //check if there is a message
              $success_message= $_GET['message']; 

}
		  ?>

    <?php

$results = $mysqli->query("SELECT id, product_code, product_name, product_img_name, price FROM products ORDER BY id ASC");

if (isset($_GET['search'])){ //search function
    
    $search = $_GET['search'];
    if (checkEmpty($search)){
    $results = $mysqli->query("SELECT * FROM  products WHERE products.product_name LIKE '%".$search."%'");
}
else{
    $error_message = 'enter name to search';
}}
require_once(baseLink.'functions/messages.php')
?>
    <!-- search form-->
    <h1 align="center">Admin Panel </h1>
    <form method="GET">
        <input type="text" name="search" placeholder="enter name to search">
        <input type="submit" value="search">
    </form>
    <!-- end search form-->

    <!--disply list of product -->
   
    <table>
        <thead>
            <tr>
                <th>
                    Name
                </th>
                <th>
                    Img
                </th>
                <th>
                    Actions
                </th>

            </tr>
        </thead>
        <?php
		while($row = mysqli_fetch_assoc($results)){
			?>
        <tr>
            <td><?=$row['product_name']?></td>
            <td><?='<img src="'.baseUrl.'images/'.$row['product_img_name'].'.jpg'.'">'?></td>
            <td><a href="edit.php?id=<?=$row['id']?>">Edit Product</a> | <a
                    href="delete.php?id=<?=$row['id']?>">Delete Product</a></td>


        </tr>

        <?php
			
		}
		
		?>
        <tfoot>
            <tr>
                <td colspan="1" style="text-align: center"><?=mysqli_num_rows($results)?> Product
                </td>
            </tr>
            
            <tr>
                <td style="text-align: center"><a href="<?=baseUrl;?>admin/add_product.php">Add New Product</a></td>
            </tr>
        </tfoot>
    </table>
    <!-- end list -->

    <?php
    /*
//Products List

$result = $mysqli->query("SELECT product_code, product_name, product_img_name, price FROM products ORDER BY id ASC");
if($result){
$products_item = '<ul class="products">';
$url = baseUrl;

while($obj = $result->fetch_object())
{
$products_item .= <<<EOT
	<li class="product">
	<form method="post" action="cart_update.php">
	<div class="product-content"><h3>{$obj->product_name}</h3>
	<div class="product-thumb"><img src="{$url}/images/{$obj->product_img_name}"></div>
	<div class="product-info">
	Price {$currency}{$obj->price} 
	
	<fieldset>
	
	
	
	<label>
		<span>Quantity</span>
		<input type="text" size="2" maxlength="2" name="product_qty" value="1" />
	</label>
	
	</fieldset>
	<input type="hidden" name="product_code" value="{$obj->product_code}" />
	<input type="hidden" name="type" value="add" />
    <input type="hidden" name="return_url" value="{$current_url}" />
    <br>
    <div align="center"><button type="submit" class="add_to_cart">Delete Product</button></div>
    <br>

	</div></div>
	</form>
	</li>
EOT;
}

$products_item .= '</ul>';
echo $products_item;
}

    <div align="center" ; background-color:white><button type="button" class="add_to_cart">Add New Product</button>
    </div>


*/
?>
</body>

</html>