    var counter = 0;
    $(document).ready(function(){

        $("#save").click(function(){
            var prod_name = $("#prod_name").val();
            var prod_desc = $("#prod_desc").val();
            var prod_price = $("#prod_price").val();
            var prod_quantity = $("#prod_quantity").val();
            var prod_category = $("#prod_category").val();

            if(prod_name == "" || prod_desc == "" || prod_price == "" || 
            prod_quantity == ""){
                alert("Please fill up all fields");
            }else{

                if(prod_category == "Category"){
                    alert("Please select a valid category")
                }else{

                    $.ajax({
                        type:"POST",
                        url: "operations/save_product.php",
                        data: {prod_name:prod_name,prod_desc:prod_desc,prod_price:prod_price,
                        prod_quantity:prod_quantity,prod_category:prod_category},
                        dataType:"text",
                        success:function(data){
                            alert("Product Saved...")
                            window.location.reload();
                        }
                    })
            }

        }

        });

    });

    $(document).ready( function () {
        $('#productsTable').DataTable();
    } );


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

            if(new_prod_name == "" || new_prod_desc == "" || new_prod_price == "" || 
            new_prod_quantity == ""){
                alert("Please fill up all fields");
            }else{

                if(new_prod_category == "Category"){
                    alert("Please select a valid category")
                }else{

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
            }

        }

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
                $("#productsTable td").remove();
                for (var i=0;i<len;i++){
                    $('#productsTable tbody').append('<tr><td>'+response[i]['prod_name']+'</td><td>'+response[i]['prod_desc']+'</td><td>'+response[i]['prod_price']+'</td><td>'+response[i]['prod_quantity']+'</td><td>'+response[i]['prod_category']+'</td><td>'+'</td></tr>')               
                
                }
            }

        })
    });


