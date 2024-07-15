
function showProductItems(){  
    $(document).ready(function() {
        $.ajax({
            url:"viewAllProducts.php",
            method:"post",
            data:{record:1},
            success:function(data){
                $('.allContent-section').html(data);
            }
        });
    });
}

function showUsers(){
    $(document).ready(function() {
        $.ajax({
            url:"viewAllUsers.php",
            method:"post",
            data:{record:1},
            success:function(data){
                $('.allContent-section').html(data);
            }
        });
    });
}

function showAdmins(){
    $(document).ready(function() {
        $.ajax({
            url:"viewAllAdmins.php",
            method:"post",
            data:{record:1},
            success:function(data){
                $('.allContent-section').html(data);
            }
        });
    });
}

function showOrders(){
    $(document).ready(function() {
        $.ajax({
            url:"viewAllOrders.php",
            method:"post",
            data:{record:1},
            success:function(data){
                $('.allContent-section').html(data);
            }
        });
    });
}


//add product data
function addItems(){
    $(document).ready(function() {
        var p_code=$('#p_code').val();
        var p_name=$('#p_name').val();
        var p_desc=$('#p_desc').val();
        var p_price=$('#p_price').val();
        var p_qty=$('#p_qty').val();
        var upload=$('#upload').val();
        var file=$('#file')[0].files[0];

        var fd = new FormData();
        fd.append('p_code', p_code);
        fd.append('p_name', p_name);
        fd.append('p_desc', p_desc);
        fd.append('p_price', p_price);
        fd.append('p_qty', p_price);
        fd.append('file', file);
        fd.append('upload', upload);

        $.ajax({
            url:"addItem.php",
            method:"post",
            data:fd,
            processData: false,
            contentType: false,
            success: function(data){
                alert('Product Added successfully.');
                $('form').trigger('reset');
                showProductItems();
            }
        });
    });
}

//edit product data
function itemEditForm(id){
    $(document).ready(function() {
        $.ajax({
            url:"editItemForm.php",
            method:"post",
            data:{record:id},
            success:function(data){
                $('.allContent-section').html(data);
            }
        });
    });
}

//update product after submit
function updateItems(){
    $(document).ready(function() {
        var product_id = $('#product_id').val();
        var p_code = $('#p_code').val();
        var p_name = $('#p_name').val();
        var p_desc = $('#p_desc').val();
        var p_price = $('#p_price').val();
        var p_qty = $('#p_qty').val();
        var existingImage = $('#existingImage').val();
        var newImage = $('#newImage')[0].files[0];
        var fd = new FormData();
        fd.append('product_id', product_id);
        fd.append('p_code', p_code);
        fd.append('p_name', p_name);
        fd.append('p_desc', p_desc);
        fd.append('p_price', p_price);
        fd.append('p_qty', p_qty);
        fd.append('existingImage', existingImage);
        fd.append('newImage', newImage);

        $.ajax({
          url:'updateItem.php',
          method:'post',
          data:fd,
          processData: false,
          contentType: false,
          success: function(data){
            alert('Data Update Success.');
            $('form').trigger('reset');
            showProductItems();
          }
        });
    });
}

//delete product data
function itemDelete(id){
    $.ajax({
        url:"deleteItem.php",
        method:"post",
        data:{record:id},
        success:function(data){
            alert('Items Successfully deleted');
            $('form').trigger('reset');
            showProductItems();
        }
    });
}

//delete user data
function userDelete(id){
    $.ajax({
        url:"deleteUser.php",
        method:"post",
        data:{record:id},
        success:function(data){
            alert('User Successfully deleted');
            $('form').trigger('reset');
            showUsers();
        }
    });
}

