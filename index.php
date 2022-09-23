<?php
    session_start();
    require_once 'config.php';
    include 'operations/get_products.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>

    <style>
        tr.row_selected td{background-color:lightgray !important;} 
    </style>

</head>
<body>
    <h1 class="text-center">Developer Test</h1><br>

<div class="container">
  <div class="row">
    <div class="col-sm">

    <form>
    <div class="form-group row">
        <label for="prod_name" class="col-sm-2 col-form-label">Name</label>
        <div class="col-sm-10">
        <input type="text" class="form-control" id="prod_name" placeholder="Name">
        </div>
    </div>

    <div class="form-group row">
        <label for="prod_desc" class="col-sm-2 col-form-label">Description</label>
        <div class="col-sm-10">
        <input type="text" class="form-control" id="prod_desc" placeholder="Description">
        </div>
    </div>

    <div class="form-group row">
        <label for="prod_price" class="col-sm-2 col-form-label">Price</label>
        <div class="col-sm-10">
        <input type="number" class="form-control" id="prod_price" placeholder="Price">
        </div>
    </div>

    <div class="form-group row">
        <label for="prod_quantity" class="col-sm-2 col-form-label">Quantity</label>
        <div class="col-sm-10">
        <input type="number" class="form-control" id="prod_quantity" placeholder="Quantity">
        </div>
    </div>

    <div class="form-group">
    <div class="form-row">
    <div class="col-md-12">
        <select id="prod_category" name="prod_category" class="custom-select" id="inputGroupSelect04">
        <option selected value="Category">Category</option>
        <?php 
        $conn = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
        $query = "SELECT * FROM category";
        $result = mysqli_query($conn,$query);
        while($row = mysqli_fetch_assoc($result) ){
            $name =  $row['name'];
            echo "<option value='".$name."' >".$name."</option>";
        }
        $conn -> close();
        ?>
    </select>  
    </div>
    </div>
    </div>

    <hr>
    <button type="button" class="btn btn-outline-primary" id="save">Save</button>
    
    </form> <!-- END OF FORM --> 

    </div>

    <div class="col-sm">
    <div>
        <button class="btn btn-warning" id="edit">Edit</button>
        <button class="btn btn-danger" id="delete">Delete</button>
    </div><br>

    <div>


    <select class="form-select" aria-label="Default select example" id="selectStocks">
    <option selected value="default">All Stocks</option>
    <option value="withStocks">With Stocks</option>
    <option value="withoutStocks">Without Stocks</option>
    </select>
    </div><br>

    <div class="table-responsive">
        <table id="productsTable" class="table  table-striped table-bordered" id="dataTable" width="100%"  cellspacing="0">
        <thead class="thead-dark">
        <tr>
        <th style="display:none"></th>
        <th>Name</th>
        <th>Description</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Category</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($products as $prod) :  ?>
        <tr>
        <td style="display:none"><?= $prod['id']; ?></td>
        <td><?= $prod['name']; ?></td>
        <td><?= $prod['description']; ?></td>  
        <td><?= $prod['price']; ?></td>  
        <td><?= $prod['quantity']; ?></td>  
        <td><?= $prod['category']; ?></td>  
        </tr>
        <?php endforeach; ?>
        </tbody>
        </table>
        </div>
    </div>
  </div>
</div>


    <!-- Update Product Modal-->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
    <div class="form-group row">
        <label for="new_prod_name" class="col-sm-2 col-form-label">Name</label>
        <div class="col-sm-10">
        <input type="text" class="form-control" id="new_prod_name" placeholder="Name">
        </div>
    </div>

    <div class="form-group row">
        <label for="new_prod_desc" class="col-sm-2 col-form-label">Description</label>
        <div class="col-sm-10">
        <input type="text" class="form-control" id="new_prod_desc" placeholder="Description">
        </div>
    </div>

    <div class="form-group row">
        <label for="new_prod_price" class="col-sm-2 col-form-label">Price</label>
        <div class="col-sm-10">
        <input type="number" class="form-control" id="new_prod_price" placeholder="Price">
        </div>
    </div>

    <div class="form-group row">
        <label for="new_prod_quantity" class="col-sm-2 col-form-label">Quantity</label>
        <div class="col-sm-10">
        <input type="number" class="form-control" id="new_prod_quantity" placeholder="Quantity">
        </div>
    </div>

    <div class="form-group">
    <div class="form-row">
    <div class="col-md-12">
        <select id="new_prod_category" name="new_prod_category" class="custom-select" id="inputGroupSelect04">
        <option selected value="Category">Category</option>
        <?php 
        $conn = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
        $query = "SELECT * FROM category";
        $result = mysqli_query($conn,$query);
        while($row = mysqli_fetch_assoc($result) ){
            $name =  $row['name'];
            echo "<option value='".$name."' >".$name."</option>";
        }
        $conn -> close();
        ?>
    </select>  
    </div>
    </div>
    </div>    
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="save_changes">Save changes</button>
      </div>
    </div>
  </div>
</div>

<!-- DELETE PRODUCT MODAL -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Would you like to remove this product?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
        <button type="button" class="btn btn-primary" id="deleteProduct">Yes</button>
      </div>
    </div>
  </div>
</div>


<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<link rel="stylesheet" type="text/css" href="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/css/jquery.dataTables.css"/>
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>


<script>
    var counter = 0;
    $(document).ready(function(){

        $("#save").click(function(){
            var prod_name = $("#prod_name").val();
            var prod_desc = $("#prod_desc").val();
            var prod_price = $("#prod_price").val();
            var prod_quantity = $("#prod_quantity").val();
            var prod_category = $("#prod_category").val();

            $.ajax({
                type:"POST",
                url: "operations/save_product.php",
                data: {prod_name:prod_name,prod_desc:prod_desc,prod_price:prod_price,
                prod_quantity:prod_quantity,prod_category:prod_category},
                dataType:"text",
                success:function(data){
                    alert("Product Saved...")
                }
            })

        });

    });

    $(document).ready( function () {
        $('#productsTable').DataTable();
    } );

</script>

<script>

    $("#edit").click(function(){
        if(counter == 0){
            alert("Please select a product to edit");
        }else{
            $("#editModal").modal("show");
        }
    });
    
    $("#delete").click(function(){
        if(counter == 0){
            alert("Please select a product to remove");
        }else{
            $("#deleteModal").modal("show");
        }
    });

    var table = $('#productsTable').DataTable();   
    $('#productsTable tbody').on('click', 'tr', function () {
        var data = table.row( this ).data();
        $("#productsTable tbody tr").removeClass('row_selected');        
        $(this).addClass('row_selected');
        var data = table.row( this ).data();
        var prod_id = data[0];
        var prod_name = data[1];
        var prod_price = data[2];
        counter++;
        $("#edit").click(function (){
            $.ajax({
                type:"POST",
                url: "operations/products.php",
                data:{prod_id:prod_id,prod_name:prod_name},
                dataType:"json",
                success:function(response){
                    var len = response.length;
                    for(var i=0; i<len; i++){
                        $("#new_prod_name").val(response[i]['prod_name']);
                        $("#new_prod_desc").val(response[i]['prod_desc']);
                        $("#new_prod_price").val(response[i]['prod_price']);
                        $("#new_prod_quantity").val(response[i]['prod_quantity']);
                        $('#new_prod_category').append($('<option>', {
                            value: response[i]['prod_category'],
                            text: response[i]['prod_category'],
                            selected: "selected"
                        }));
                    }
                }
            });
        
        });

        $("#save_changes").click(function(){
            var new_prod_name = $("#new_prod_name").val();
            var new_prod_desc = $("#new_prod_desc").val();
            var new_prod_price = $("#new_prod_price").val();
            var new_prod_quantity = $("#new_prod_quantity").val();
            var new_prod_category = $("#new_prod_category").val();

            $.ajax({
                type:"POST",
                url:"operations/update_product.php",
                data:{new_prod_name:new_prod_name,new_prod_desc:new_prod_desc,
                new_prod_price:new_prod_price,new_prod_quantity:new_prod_quantity,
                new_prod_category:new_prod_category},
                dataType:"text",
                success:function(){
                    alert("Product updated")
                    window.location.reload();
                }
            })

        });

        $("#deleteProduct").click(function(){
            $.ajax({
                type:"POST",
                url:"operations/delete_product.php",
                data:{prod_id,prod_id},
                dataType:"text",
                success:function(){
                    alert("Product deleted successfully")
                    window.location.reload();
                }
            });
        });

   
        
    });


    $("#selectStocks").on('change', function(){
        var selection = $("#selectStocks").val();

        if(selection == "default"){
            window.location.reload();
        }

        $.ajax({
            type:"POST",
            url:"operations/stocksFilter.php",
            data:{selection:selection},
            dataType:"json",
            success:function(response){
                var len = response.length;
                for (var i=0;i<len;i++){
                    $("#productsTable td").remove();
                    $('#productsTable tbody').append('<tr><td>'+response[i]['prod_name']+'</td><td>'+response[i]['prod_desc']+'</td><td>'+response[i]['prod_price']+'</td><td>'+response[i]['prod_quantity']+'</td><td>'+response[i]['prod_category']+'</td><td>'+'</td></tr>')               
                
                }
            }

        })
    });


    



</script>



</body>
</html>