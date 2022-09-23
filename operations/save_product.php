<?php 
    session_start();
	include '../config.php';
	$conn = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);

    $result = array();

	$prod_name = mysqli_real_escape_string($conn,$_POST['prod_name']);
    $prod_desc = mysqli_real_escape_string($conn,$_POST['prod_desc']);
    $prod_price = mysqli_real_escape_string($conn,$_POST['prod_price']);
    $prod_quantity = mysqli_real_escape_string($conn,$_POST['prod_quantity']);
    $prod_category = mysqli_real_escape_string($conn,$_POST['prod_category']);

    $sql = "INSERT INTO products(name,description,price,quantity,category) 
    VALUES ('$prod_name', '$prod_desc', '$prod_price', '$prod_quantity','$prod_category')";

    if(mysqli_query($conn,$sql) == TRUE){
        $result[] = array("result" => "success");
        
	}else{
        echo $conn -> error;
        $result[] = array("result" => "error");;
    }

    echo json_encode($result);

    $conn -> close();



?>