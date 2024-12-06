<?php
session_start();  


if (!isset($_SESSION['logged_in'])) {
    header('Location: login.php');  
    exit();
}


?>
<?php
include 'mydatabase.php';

$sql = "SELECT id, name FROM customers";
$result = mysqli_query($conn, $sql);

$sql = "SELECT id,price , name FROM products";
echo $sql;
$resultproduct = mysqli_query($conn, $sql);
?>

<?php
include "header.php";
?>
<style>

.form-outline i {
    position: absolute;
    left:10px;
    top: 45%;
    transform: translateY(-50%);
    pointer-events: none;
    /* left: 5%; */
}

</style>

<body>
    <!-- ============================================================== -->
    <!-- main wrapper -->
    <!-- ============================================================== -->
    <div class="dashboard-main-wrapper">
        <!-- ============================================================== -->
        <!-- navbar -->
        <!-- ============================================================== -->
        <?php
       include "navbar.php";
       ?>
        <!-- ============================================================== -->
        <!-- end navbar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- left sidebar -->
        <!-- ============================================================== -->
        <?php
include "asidebar.php";
    ?>
        <!-- ============================================================== -->
        <!-- end left sidebar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- wrapper  -->
        <!-- ============================================================== -->
        <div class="dashboard-wrapper">
            <div class="dashboard-ecommerce">
                <div class="container-fluid dashboard-content  ">
                    <!-- ============================================================== -->
                    <!-- pageheader  -->
                    <!-- ============================================================== -->
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="page-header">
                                <h2 class="pageheader-title">Add Orders</h2>
                                <p class="pageheader-text">Nulla euismod urna eros, sit amet scelerisque torton lectus
                                    vel mauris facilisis faucibus at enim quis massa lobortis rutrum.</p>
                                <div class="page-breadcrumb">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="#"
                                                    class="breadcrumb-link">Order</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">E-Commerce Order</li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ============================================================== -->
                    <!-- end pageheader  -->
                    <div class="row">
                        <!-- ============================================================== -->
                        <!-- valifation types -->
                        <!-- ============================================================== -->
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="card">
                               
                                <div class="card-body">
                                    <form id="validationform" data-parsley-validate="" novalidate="" class=" m-auto w-50 shadow p-4">
                                    <h2 class="text-center">Add Orders</h2>

                                       
                                    <label class="col-12 col-sm-3 m-0 p-0">Customer Name</label>
                                    <div class="form-group row">
                                           
                                            <div class="col-12 col-sm-8 col-lg-12">
                                            <div data-mdb-input-init class="form-outline">
                                            <select id="customer" class="form-control pl-5" aria-label="Default select example" required onchange="disableCustomerSelect()">
     <option value="">Select Customer Name</option> 
     <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                                                <option value="<?php echo $row['id']; ?>">
                                                    <?php echo $row['name']; ?>
                                                </option>
                                            <?php } ?>
</select>
                                                <i class="fas fa-user ml-3 mb-1"></i>
                                                </div>
                                                <p id="message" style="color:red"></p>
                                            </div>
                                        </div>
                                       
                                        <label class="col-12 col-sm-3 m-0 p-0">Product Name</label>
                                        <div class="form-group row">
                                         
                                            <div class="col-12 col-sm-8 col-lg-12">
                                            <div data-mdb-input-init class="form-outline">
                                            <select id="product" class="form-control pl-5" aria-label="Default select example">
    <option value="">Select Product</option>
    <?php
        if (mysqli_num_rows($resultproduct) > 0) {
            while ($row = mysqli_fetch_assoc($resultproduct)) {
                // Fetch product name and price
                echo "<option value='" . $row['id'] . "' data-price='" . $row['price'] . "'>" . $row['name'] . "</option>";
            }
        } else {
            echo "<option disabled>No products available</option>";
        }
    ?>
</select>
                                                <i class="fas fa-box ml-3"></i>
                                                </div>
                                                  <p id="message1" style="color:red"></p>
                                            </div>
                                        </div>
                                      <p id="message3" style="color:red"></p>
                                        <div class="form-group row text-right">
                                            <div class="col col-sm-10 col-lg-12 offset-sm-1 offset-lg-0">
                                                <button type="submit" class="btn btn-space" style="background:#07193e;color:white" id="addMoreBtn">Add more</button>
                                                <!-- <button class="btn btn-space btn-secondary">Cancel</button> -->
                                            </div>
                                        </div>
                                    </form>

                                    <div class="row">
                        <!-- ============================================================== -->
                        <!-- basic table  -->
                        <!-- ============================================================== -->
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mt-2">
                            <div class="card">
                                <div class="d-flex">
                                    <h5 class="card-header p-2 flex-grow-1">Orders</h5>
                                    <!-- <a href="addOrder.php"><button
                                                class="p-2 m-2 border-0 font-monospace btn-danger">Add
                                                Order</button></a> -->
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered first  m-auto tbldisplay" id="orderTable">
                                            <thead class=""style="background:#0E0C28">
                                                <tr>
                                                    <th style="color:white">Product</th>
                                                    <th style="color:white">Price</th>
                                                    <th style="color:white">Qntity</th>
                                                    <th style="color:white">Total</th>
                                                    <th style="color:white">Action</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                              
                                                

                                                
                                               
                                              
                                            </tbody>
                                            
                                        </table>
                                        <div class="text-right">
        <strong>Total Price:</strong> $<span id="totalPrice">0</span>
    </div>
    <p id="demo1"></p>
                                    </div>
                                    <!-- <button type="button" class="btn btn-success mt-3 float-end" id="submitOrderBtn">Submit Order</button> -->
                                    <div class="form-group row text-right">
                                            <div class="col col-sm-10 col-lg-12 offset-sm-1 offset-lg-0">
                                                <button type="submit" class="btn btn-space" style="background:#07193e;color:white" id="submitOrderBtn">Submit</button>
                                                <!-- <button class="btn btn-space btn-secondary">Cancel</button> -->
                                            </div>
                                        </div>
                                        <p id="text1" style="color:red"></p>
                                </div>
                            </div>
                        </div>
                        <!-- ============================================================== -->
                        <!-- end basic table  -->
                        <!-- ============================================================== -->
                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- ============================================================== -->
                        <!-- end valifation types -->
                        <!-- ============================================================== -->
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <?php
         include "footer.php";
         ?>
            <!-- ============================================================== -->
            <!-- end footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- end wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- end main wrapper  -->
    <!-- ============================================================== -->
    <!-- Optional JavaScript -->
    <!-- jquery 3.3.1 -->

</body>
<script>
    function disableCustomerSelect() {
            var customerSelect = document.getElementById('customer');
            if (customerSelect.value !== "") {
                customerSelect.disabled = true; 
                $('#message').text(""); 
            }
        }
    $(document).ready(function() {
        $(".tbldisplay").hide();
    $('#addMoreBtn').click(function(event) {
        event.preventDefault();
       
        var productSelect = $('#product');
        var customerSelect = $('#customer');
        var productId = productSelect.val();

        var productName = productSelect.find('option:selected').text();
        var productPrice = parseFloat(productSelect.find('option:selected').data('price'));
        var customerId = customerSelect.val();

        if (!customerId) {
                
                $("#message").text("Please select a customer name.")
                return;
            }
           
            if (!productId) {
                $("#message1").text("Please select a Product name.")
                return;
            }
        if(customerId || productId){
        
                $(".tbldisplay").show();
                $("#message1").hide();
        
        }

            var existingRow = null;
    $('#orderTable tbody tr').each(function() {
        if ($(this).data('product-id') == productId) {
            existingRow = $(this);
        }
    });

    if (existingRow) {
        
        var qtyInput = existingRow.find('.qtyInput');
        var newQuantity = parseInt(qtyInput.val()) + 1;
        qtyInput.val(newQuantity);

        var newTotal = productPrice * newQuantity;
        existingRow.find('.totalPrice').text('$' + newTotal.toFixed(2));
        calculateTotal(); 

    } else {

        if (productId !== '') {
            var newRow = `
                <tr data-product-id="${productId}">
                    <td>${productName}</td>
                    <td>$${productPrice.toFixed(2)}</td>
                    <td><input type="number" class="form-control qtyInput" value="1" min="1" data-price="${productPrice}"></td>
                    <td class="totalPrice">$${productPrice.toFixed(2)}</td>
                    <td><button type="button" class="btn btn-danger removeBtn">Remove</button></td>
                </tr>`;
            $('#orderTable tbody').append(newRow);
            calculateTotal();
        } else {
            alert('Please select a product');
        }
    }
    });

    
    $(document).on('input', '.qtyInput', function() {
        var row = $(this).closest('tr');
        var price = parseFloat($(this).data('price'));
        var quantity = parseInt($(this).val())||0;
        var total = price * quantity;
        row.find('.totalPrice').text('$' + total.toFixed(2));
        calculateTotal();
    });

   

    $(document).on('click', '.removeBtn', function() {
        $(this).closest('tr').remove();
        calculateTotal();
    });

    
    function calculateTotal() {
        var total = 0;
        $('#orderTable tbody tr').each(function() {
            total += parseFloat($(this).find('.totalPrice').text().replace('$', ''));
        });
        $('#totalPrice').text(total.toFixed(2));
    }


    $('#submitOrderBtn').click(function () {
    var customerId = $('#customer').val();
    if (!customerId) {
        $("#message3").text("Please select a customer name and product.");
        return;
    }

    var orderData = [];
    var isValid = true; // Flag to check if all quantities are valid

    $('#orderTable tbody tr').each(function () {
        var productId = $(this).data('product-id'); // Get the product ID from the row
        var price = $(this).find('td:eq(1)').text().replace('$', '');
        var quantityInput = $(this).find('.qtyInput');
        var quantity = parseInt(quantityInput.val()) || 0; // Default to 0 if invalid or empty

        if (quantity <= 0) {
            isValid = false;
            quantityInput.addClass('is-invalid'); // Highlight the invalid input
        } else {
            quantityInput.removeClass('is-invalid'); // Remove the invalid class if corrected
        }

        var total = $(this).find('.totalPrice').text().replace('$', '');

        orderData.push({
            product_id: productId,
            price: price,
            quantity: quantity,
            total: total
        });
    });

    if (!isValid) {
       

        $("#text1").text("Please fill out all quantity fields with valid numbers.");
        return; // Stop submission if validation fails
    }

    $.ajax({
        url: 'insertorder.php',
        type: 'POST',
        data: {
            customer_id: customerId,
            order: orderData
        },
        success: function (response) {
            window.location.href = 'allorders.php';
        },
        error: function () {
            alert('There was an error submitting the order.');
        }
    });
});

});


</script>
</html>