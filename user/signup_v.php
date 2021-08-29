<?php
require_once('../config.php');
require_once(baseLink.'functions/validations.php');

if (isset($_POST)){
    //$message = array();
    extract($_POST);
    if (checkEmpty($email) and checkEmpty($confirm_password) and checkEmpty($name))
    {
        require_once(baseLink.'functions/database.php');
        //Escape any speciale characacters to avoid SQL injection. 
        $name = mysqli_escape_string($conn, $name);
        $email = mysqli_escape_string($conn, $email);
        $confirm_password = mysqli_escape_string($conn, $confirm_password);

        $query="INSERT INTO user(name, email,pass) VALUES ('$name', '$email', '$confirm_password')";
        $sql=mysqli_query($conn,$query)or die("Could Not Perform the Query");
        header ("Location: product.php?status=success");

    }
    else{
        
        $error = 'please file th form';
        //header("Location: signUp.php?error=".$error."");
        
    }
    if(isset($error)) {

        header("Location: signUp.php?error=".$error."");

        
    }


}



?>