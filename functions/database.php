<?php
$serverName = "localhost";
$userName = "root";
$password = "";
$dataBaseName = "digital-product";

$conn = mysqli_connect($serverName,$userName,$password,$dataBaseName);

if (!$conn){
    die ("Error: ".mysqli_connect_error());
}?>
