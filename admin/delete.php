<?php 
require_once('../config.php');
$id = $_GET['id'];

$query = $mysqli->query("DELETE FROM products WHERE id = '$id'");
$success_message = 'product deleted successfully';
header("Location: admin.php?message=".$success_message."");
?>