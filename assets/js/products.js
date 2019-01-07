$(document).ready( function () {

    //populating datatables coming from database using ajax/serverside
    $('#productsTable').DataTable({
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": 'products/get_products',
            "type": "POST",
            "data": {csrf_test_name:csrf_token}
        },

        //Set column definition initialisation properties.
        "columnDefs": [
            { 
                "targets": [ 0 ], //first column / numbering column
                "visible": false, //set not visible
            }
        ]
    });

    //adding new products using ajax 
    $('#newProductForm').submit(function(event){
        event.preventDefault();

        var data = $(this).serialize();
        var title;
        var text;
        var icon; 
        $.ajax({
            method: 'post',
            url: 'products/insert_product',
            data: data,
            success: function(response){
                if(response == 1){
                    swal({
                        title : "New Product Added",
                        text : "You sucessfully add a product",
                        icon : "success",
                    }).then(function() {
                        window.location.reload();
                    });
                }else if(response == 0){
                    swal({
                        title : "Error",
                        text : "Product not been added",
                        icon : "error",
                    }).then(function() {
                        window.location.reload();
                    });
                }else{
                    swal({
                        title : "SKU Warning",
                        text : response,
                        icon : "warning",
                    });
                }
            }
        });
    });

    //delete products in ajax way
    $('#productsTable tbody').on('click', '.product-delete', function (){
        swal("Do you want to delete this product?", {
            buttons: {
                cancel: "Cancel",
                ok: true,
            },
        })
        .then((value) => {
            if (value == "ok") {
                var id = $(this).data('id');
                $.ajax({
                    method: 'get',
                    url: 'products/delete_product',
                    data: {id:id,csrf_test_name:csrf_token },
                    success: function(response){
                        if(response == 1){
                            swal({
                                title: "Product Deleted",
                                text: "Data has been successfully deleted",
                                icon: "success",
                            }).then(function() {
                                window.location.reload();
                            });
                        }else{
                            swal({
                                title: "Error",
                                text: "Failed to delete the data",
                                icon: "error",
                            });
                        }
                    }
                });
            }
        });
    });

    //populating update product form
    $('#productsTable tbody').on('click', '.product-update', function (){
        var id = $(this).data('id');
        $.ajax({
            method: 'post',
            url: 'products/get_product_data',
            dataType: 'json',
            data: {id:id,csrf_test_name:csrf_token },
            success: function(response){
                //console.log(response);
                $('#updateProductForm input[name=id]').val(response[0].id);
                $('#updateProductForm input[name=sku]').val(response[0].sku);
                $('#updateProductForm input[name=product_name]').val(response[0].name);
                $('#updateProductForm select[name=category]').val(response[0].category_id);
                $('#updateProductForm input[name=description]').val(response[0].description);
                $('#updateProductForm input[name=initial_price]').val(response[0].initial_price);
                $('#updateProductForm input[name=srp]').val(response[0].price);
                $('#updateProductModal').modal();
            },
            error: function(xhr){
                console.log(xhr.responseText);
            }
        });
    });

    //updating products using ajax 
    $('#updateProductForm').submit(function(event){
        event.preventDefault();

        var data = $(this).serialize();
        $.ajax({
            method: 'post',
            url: 'products/update_product',
            data: data,
            success: function(response){
                if(response == 1){
                    swal({
                        title: "Product Updated",
                        text: "You sucessfully update the product",
                        icon: "success",
                    }).then(function(){
                         window.location.reload()
                    });
                }else if(response == 0){
                    swal({
                        title: "Error",
                        text: "Update Failed",
                        icon: "error",
                    }).then(function(){
                        window.location.reload()
                    });

                }else{
                    swal({
                        title: "Warning",
                        text: response,
                        icon: "warning",
                    }); 
                }
            }
        });
    });


    //script below is for category

    $('#categoryTable').DataTable({
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": 'get_categories',
            "type": "POST",
            "data": {csrf_test_name:csrf_token}
        },

        //Set column definition initialisation properties.
        "columnDefs": [
            { 
                "targets": [ 0 ], //first column / numbering column
                "visible": false, //set not visible
            }
        ]
    });

    $('#addCategoryForm').submit(function(event){
        event.preventDefault();
        var data = $(this).serialize();
        if($('#addCategoryForm .category').val() != ""){
            $.ajax({
                method:'post',
                url:'add_category',
                data:data,
                success:function(response){
                   if(response == 1){
                        title = "New Category Added";
                        text = "You sucessfully add a category";
                        icon = "success";
                    }else if(response == 0){
                        title = "Error";
                        text = "Category not been added";
                        icon = "error";
                    }else{
                        title = "Warning";
                        text = response;
                        icon = "warning";
                    }

                    swal({
                        title: title,
                        text: text,
                        icon: icon,
                    }).then(function() {
                        window.location.reload();
                    });
                },
                error:function(xhr){    
                    console.log(xhr.responseText);
                }
            });
        }else{
            swal({
                title: "Warning",
                text: "Please input category",
                icon: "warning",
            }); 
        }
    });

    $('#categoryTable tbody').on('click','.category-delete', function(){
        var id = $(this).data('id');
        var data = {id:id,csrf_test_name:csrf_token};
        $.ajax({
            method:'get',
            url:'delete_category',
            data:data,
            success:function(response){
                if(response == 1){
                        title = "Category Deleted";
                        text = "You sucessfully deleted a category";
                        icon = "success";
                    }else if(response == 0){
                        title = "Error";
                        text = "Category not deleted";
                        icon = "error";
                    }else{
                        title = "Warning";
                        text = response;
                        icon = "warning";
                    }

                    swal({
                        title: title,
                        text: text,
                        icon: icon,
                    }).then(function() {
                        window.location.reload();
                    });
            },
            error:function(xhr){
                console.log(xhr.responseText);
            }
        });
    });

    $('#categoryTable tbody').on('click', '.category-update', function (){
        var id = $(this).data('id');
        $.ajax({
            method: 'post',
            url: 'get_category_data',
            dataType: 'json',
            data: {id:id,csrf_test_name:csrf_token },
            success: function(response){
                $('#updateCategoryForm .category').val(response[0].category);
                $('#updateCategoryForm input[name=id]').val(response[0].id);
                $('#updateCategoryModal').modal();
            },
            error: function(xhr){
                console.log(xhr.responseText);
            }
        });
    });

    $('#updateCategoryForm').submit(function(event){
        event.preventDefault();
        var data = $(this).serialize();
        $.ajax({
            method:'post',
            url:'update_category',
            data:data,
            success: function(response){
                console.log(response);
            },
            error: function(xhr){
                console.log(xhr.responseText);
            }
        });
    });
});
