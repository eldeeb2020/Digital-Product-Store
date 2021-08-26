<?php

if(isset($_POST))
{
    //extract($_POST);
    $email=$_POST['email'];  
    $pass=$_POST['pass'];  
    include 'database.php';
    $sql=mysqli_query($conn,"SELECT * FROM admin where email='$email' AND pass='$pass'");
    $row  = mysqli_fetch_array($sql);

    if(is_array($row))
    {
    
          
          header('location:admin.php');
        
        
    }
    
    else{
        
        header('location:login_admin.php');
        
    }
}
?>