<?php
require_once('../config.php');
require_once(baseLink.'functions/validations.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">

    <title>add product</title>

    <style>
    body {
        color: #fff;
        background: #3598dc;
        font-family: 'Roboto', sans-serif;
    }

    .form-control {
        height: 41px;
        background: #f2f2f2;
        box-shadow: none !important;
        border: none;
    }

    .form-control:focus {
        background: #e2e2e2;
    }

    .form-control,
    .btn {
        border-radius: 3px;
    }

    .signup-form {
        width: 390px;
        margin: 30px auto;
    }

    .signup-form form {
        color: #999;
        border-radius: 3px;
        margin-bottom: 15px;
        background: #fff;
        box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
        padding: 30px;
    }

    .signup-form h2 {
        color: #333;
        font-weight: bold;
        margin-top: 0;
    }

    .signup-form hr {
        margin: 0 -30px 20px;
    }

    .signup-form .form-group {
        margin-bottom: 20px;
    }

    .signup-form input[type="checkbox"] {
        margin-top: 3px;
    }

    .signup-form .row div:first-child {
        padding-right: 10px;
    }

    .signup-form .row div:last-child {
        padding-left: 10px;
    }

    .signup-form .btn {
        font-size: 16px;
        font-weight: bold;
        background: #3598dc;
        border: none;
        min-width: 140px;
    }

    .signup-form .btn:hover,
    .signup-form .btn:focus {
        background: #2389cd !important;
        outline: none;
    }

    .signup-form a {
        color: #fff;
        text-decoration: underline;
    }

    .signup-form a:hover {
        text-decoration: none;
    }

    .signup-form form a {
        color: #3598dc;
        text-decoration: none;
    }

    .signup-form form a:hover {
        text-decoration: underline;
    }

    .signup-form .hint-text {
        padding-bottom: 15px;
        text-align: center;
    }
    </style>
</head>

<body>

    <?php
    if (isset($_GET['id'])){
     $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT); //get product id from url
   //$results = $mysqli->query("SELECT * FROM products WHERE products.id =".$id." LIMIT 1");
     $select = "SELECT * FROM products WHERE products.id =".$id." LIMIT 1";
     $results = mysqli_query($conn, $select);
     $row = mysqli_fetch_assoc($results);
    }
          if (isset($_POST['submit'])){
         //$message = array();
         extract($_POST);
         if (checkEmpty($product_code) and checkEmpty($product_name) and checkEmpty($product_img_name) and checkEmpty($price))
         {
             require_once(baseLink.'functions/database.php');
             //Escape any speciale characacters to avoid SQL injection. 
             $product_code = mysqli_escape_string($conn, $product_code);
             $product_name = mysqli_escape_string($conn, $product_name);
             $product_img_name = mysqli_escape_string($conn, $product_img_name);
             $price = mysqli_escape_string($conn, $price);


             
             $query="UPDATE products SET product_code ='$product_code', product_name ='$product_name', product_img_name = '$product_img_name', price = '$price' WHERE id = '$id'";
             $sql=mysqli_query($conn,$query)or die("Could Not Perform the Query");
             $success_message = 'Product Updated successfully';
             header ("Location: admin.php?message=".$success_message."");
             exit;
     
         }
         else{
             //to put the values in input again
             $error_message = 'Please Fill The Form';
             $select = "SELECT * FROM products WHERE products.id =".$id." LIMIT 1";
             $results = mysqli_query($conn, $select);
             $row = mysqli_fetch_assoc($results);
             
         }
         
     
     
     }

?>
    <div class="signup-form">
        <h2>Edit Product</h2>
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
            <?php
		  require_once(baseLink.'functions/messages.php')?>
            <h2>UPDATE</h2>
            <p>fill this form to update product!</p>
            <hr>
            <input type="hidden" name="id" value="<?=$row['id']?>">
            <label>Product Code</label>
            <div class="form-group">
                <input type="text" class="form-control" name="product_code"
                    value="<?=(isset($row['id'])) ? $row['product_code']:''?>" placeholder="Product Code">
            </div>
            <label>Product Name</label>
            <div class="form-group">
                <input type="text" class="form-control" name="product_name"
                    value="<?=(isset($row['product_name'])) ? $row['product_name']:''?>" placeholder="Product Name">
            </div>
            <label>Product Img Name</label>
            <div class="form-group">
                <input type="text" class="form-control" name="product_img_name"
                    value="<?=(isset($row['product_img_name'])) ? $row['product_img_name']:''?>"
                    placeholder="Product Img Name">
            </div>
            <label>Product Price</label>
            <div class="form-group">
                <input type="text" class="form-control" name="price"
                    value="<?=(isset($row['price'])) ? $row['price']:''?>" placeholder="Price">
            </div>

            <div class="form-group">
                <button type="submit" name="submit" class="btn btn-primary btn-lg">Update</button>
            </div>
        </form>
    </div>
</body>

</html>