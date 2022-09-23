<?php
    session_start();
    require_once '../config.php';
    $conn = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);

    $prod_name = $_POST['prod_name'];
    $query = "SELECT * from products where name = '$prod_name'";

    $result = mysqli_query($conn,$query);
    $resultCheck = mysqli_num_rows($result);

    $_SESSION['prod_id'] = $_POST['prod_id'];

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