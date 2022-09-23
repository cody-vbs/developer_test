<?php
session_start();
require_once '../config.php';
$conn = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);


$new_prod_name = mysqli_real_escape_string($conn,$_POST['new_prod_name']);
$new_prod_desc = mysqli_real_escape_string($conn,$_POST['new_prod_desc']);
$new_prod_price = mysqli_real_escape_string($conn,$_POST['new_prod_price']);
$new_prod_quantity = mysqli_real_escape_string($conn,$_POST['new_prod_quantity']);
$new_prod_category = mysqli_real_escape_string($conn,$_POST['new_prod_category']);
$prod_id= $_SESSION['prod_id'];

$query = "UPDATE products set name='$new_prod_name',description = '$new_prod_desc',
price = '$new_prod_price', quantity = '$new_prod_quantity', category = '$new_prod_category'
where id= '$prod_id'";

if(mysqli_query($conn, $query) == TRUE){
    $success= "Product updated";
}

$conn -> close();


?>


