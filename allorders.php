<?php
session_start();  // Start the session

// Check if the user is logged in
if (!isset($_SESSION['logged_in'])) {
    header('Location: login.php');  // Redirect to login page if not logged in
    exit();
}

// Display the dashboard content
?>
<?php
include "header.php";
?>
<style>
    .card-body {
        height: 600px;
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
        <?php include "navbar.php"; ?>
        <!-- ============================================================== -->
        <!-- end navbar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- left sidebar -->
        <!-- ============================================================== -->
        <?php include "asidebar.php"; ?>
        <!-- ============================================================== -->
        <!-- end left sidebar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- wrapper  -->
        <!-- ============================================================== -->
        <div class="dashboard-wrapper">
            <div class="dashboard-ecommerce">
                <div class="container-fluid dashboard-content">
                    <!-- ============================================================== -->
                    <!-- pageheader  -->
                    <!-- ============================================================== -->
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="page-header">
                                <h2 class="pageheader-title">All Orders</h2>
                                <p class="pageheader-text">Nulla euismod urna eros, sit amet scelerisque torton lectus
                                    vel mauris facilisis faucibus at enim quis massa lobortis rutrum.</p>
                                <div class="page-breadcrumb">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Order</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">E-Commerce Order</li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ============================================================== -->
                    <!-- end pageheader  -->
                    <!-- ============================================================== -->
                    <div class="ecommerce-widget">
                        <div class="row">
                            <!-- ============================================================== -->
                            <!-- basic table  -->
                            <!-- ============================================================== -->
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="card">
                                    <div class="d-flex">
                                        <h5 class="card-header p-2 flex-grow-1">Orders</h5>
                                        <a href="addOrder.php">
                                            <button class="p-2 m-2 border-0 font-monospace" style="background:#07193e;color:white">Add Order</button>
                                        </a>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered first">
                                                <thead style="background:#0E0C28">
                                                    <tr>
                                                        <th style="color:white">Customer Name</th>
                                                        <th style="color:white">Product Name</th>
                                                        <th style="color:white">Quantity</th>
                                                        <th style="color:white">Price</th>
                                                        <th style="color:white">Pincode</th>
                                                        <th style="color:white">Address</th>
                                                        <th style="color:white">Order Date</th>
                                                        <th style="color:white">Order Status</th>
                                                        <th style="color:white">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    include "mydatabase.php";
                                                   
                                                    // Correct SQL query to fetch data from orders, customers, and products
                                                    $sql = "SELECT o.id AS order_id,  c.name AS customer_name, p.name, o.quantity, o.order_date,order_status, p.price, c.pincode, c.address
                                                            FROM orders o
                                                            JOIN customers c ON o.customer_id = c.id
                                                            JOIN products p ON o.product_id = p.id ORDER BY o.id DESC";
                                                    
                                                    $result = $conn->query($sql);
                                                    
                                                    if ($result->num_rows > 0) {
                                                        while ($row = $result->fetch_assoc()) {
                                                            echo "<tr>";
                                                            echo "<td>" . htmlspecialchars($row['customer_name']) . "</td>";
                                                            echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                                                            echo "<td>" . htmlspecialchars($row['quantity']) . "</td>";
                                                            echo "<td>" . htmlspecialchars($row['price']) . "</td>";
                                                            echo "<td>" . htmlspecialchars($row['pincode']) . "</td>";
                                                            echo "<td>" . htmlspecialchars($row['address']) . "</td>";
                                                            echo "<td>" . htmlspecialchars($row['order_date']) . "</td>";
                                                            echo "<td>";
                                                            echo "<select class='order-status-dropdown border-0' data-order-id='" . $row['order_id'] . "'" . 
                                                                 ($row['order_status'] == 'Complete' ? ' disabled' : '') . ">";
                                                            echo "<option value='Pending'" . ($row['order_status'] == 'Pending' ? ' selected' : '') . ">Pending</option>";
                                                            echo "<option value='Complete'" . ($row['order_status'] == 'Complete' ? ' selected' : '') . ">Complete</option>";
                                                            echo "<option value='Cancel'" . ($row['order_status'] == 'Cancel' ? ' selected' : '') . ">Cancel</option>";
                                                            echo "</select>";
                                                            echo "</td>";
                                                            
                                                            echo "<td>
                                                                <a href='dispalyorderdetail.php?id=" . $row['order_id'] . "' class=''>
                                                                    <i class='fas fa-eye' style='color:#7ca6ec'></i></a>
                                                              
                                                            
 <a href='javascript:void(0);' class='delete-order' data-order-id='" . $row['order_id'] . "'>
                                <i class='fas fa-trash' style='color:red'></i>
                            </a>
                            <a href='download_invoice.php?id={$row['order_id']}' class=''><i class='fas fa-download'></i>
</a>
    
                                                                
                                                            </td>";
                                                            echo "</tr>";
                                                        }
                                                    } else {
                                                        echo "<tr><td colspan='7' class='text-center'>No orders found.</td></tr>";
                                                    }
                                                    
                                                    $conn->close();
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
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
            <!-- footer -->
            <!-- ============================================================== -->
            <?php include "footer.php"; ?>
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
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function() {
    // Update order status when dropdown changes
    $('.order-status-dropdown').change(function() {
        if ($(this).prop('disabled')) {
            return; // Exit if dropdown is disabled
        }
        var orderId = $(this).data('order-id'); 
        var newStatus = $(this).val();

        $.ajax({
            url: 'update_order_status.php',
            type: 'POST',
            data: { order_id: orderId, order_status: newStatus },
            success: function(response) {
                alert(response); 
                location.reload();
            },
            error: function() {
                alert("Failed to update status. Please try again.");
            }
        });
    });

    // Delete order when delete icon is clicked
    $('.delete-order').click(function() {
        var orderId = $(this).data('order-id');

        if (confirm("Are you sure you want to delete this order?")) {
            $.ajax({
                url: 'orderstatusdelete.php',
                type: 'POST',
                data: { order_id: orderId },
                success: function(response) {
                    alert(response);
                    location.reload(); // Reload the page after deletion
                },
                error: function() {
                    alert("Failed to delete order. Please try again.");
                }
            });
        }
    });
});

</script>

</html>
