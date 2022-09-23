<?php
    session_start();
    require_once '../config.php';
    $conn = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);

    $prod_id = $_POST['prod_id'];
    
    $query = "DELETE from products where id = '$prod_id'";

    if(mysqli_query($conn,$query) == TRUE){
        $success = 'true';
    }

    $conn -> close();

?>  