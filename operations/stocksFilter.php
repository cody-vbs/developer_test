<?php
    session_start();
    require_once '../config.php';
    $conn = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);


    $selection = $_POST['selection'];

    $query="";

    if($selection == "withStocks"){
        $query = "SELECT * from products where not quantity = '0'";
    }else{
        $query = "SELECT * from products where quantity = '0'";
    }

    $result = mysqli_query($conn,$query);
    $resultCheck = mysqli_num_rows($result);

    $resultArr = array();

    if($resultCheck > 0){
        while($row = mysqli_fetch_assoc($result)){
            $resultArr[] = array("prod_name" => $row['name'], "prod_desc" => $row['description'], 
             "prod_price" => $row['price'], "prod_quantity" => $row['quantity'], "prod_category" => $row['category']);
        }
    }

    echo json_encode($resultArr);
    
    $conn -> close();


?>