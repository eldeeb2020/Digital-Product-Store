<?php

if(isset($_POST))
{
    extract($_POST);
    include 'database.php';
    $sql=mysqli_query($conn,"SELECT * FROM user where pass='$pass' and email='$email'");
    $row  = mysqli_fetch_array($sql);
    if(is_array($row)) //check if there is a vlue in the array ROW 
    // we can use if (empty) to check if there no element on the array ROW
    {
        
        header('location:product.php');
        
    
    }
    
    else{
        
        echo "invalid user name or password";
    }
}
?>