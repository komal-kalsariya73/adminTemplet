<?php

include 'mydatabase.php';

if (isset($_GET['id'])) {
    $order_id = $_GET['id'];

    
    // $sql = "SELECT * FROM customers WHERE id = ?";
    $sql = "SELECT o.id AS order_id, c.name AS customer_name,p.image, p.name AS product_name, o.quantity, o.order_date,o.total,o.order_status,p.price,p.description, p.category_id , c.phone,c.address, c.lastname,c.gender,c.city,categories.category AS category_name
    FROM orders o
    JOIN customers c ON o.customer_id = c.id
    JOIN products p ON o.product_id = p.id
     JOIN categories ON p.category_id = categories.id where o.id=?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $order_id); 
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    
    if (mysqli_num_rows($result) > 0) {
        $order = mysqli_fetch_assoc($result);
    } else {
        echo "Customer not found.";
        exit;
    }

    
    mysqli_stmt_close($stmt);
} else {
    echo "No customer ID provided.";
    exit;
}

?>

<?php
include "header.php";
?>

<style>
.bg-col {
    background: #cbd8f3;
}

.bgimg {
    width: 100px;
    height: 100px;
    border-radius: 50px;
}
.student-profile{
    height: 750px;
}
body {
  
    padding: 0;
    margin: 0;
    font-family: 'Lato', sans-serif;
    color: #000;
}
.student-profile .card {
    border-radius: 10px;
}
.student-profile .card .card-header .profile_img {
    width: 150px;
    height: 150px;
    object-fit: cover;
    margin: 10px auto;
    /* border: 10px solid #ccc; */
    border-radius: 50%;
}
/* .student-profile .card h3 {
    font-size: 20px;
    font-weight: 700;
}
.student-profile .card p {
    font-size: 16px;
    color: #000;
}
.student-profile .table th,
.student-profile .table td {
    font-size: 14px;
    padding: 5px 10px;
    color: #000;
} */
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
                                <h2 class="pageheader-title">Cutomer Orders</h2>
                                <p class="pageheader-text">Nulla euismod urna eros, sit amet scelerisque torton lectus vel mauris facilisis faucibus at enim quis massa lobortis rutrum.</p>
                                <div class="page-breadcrumb">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">E-Commerce Dashboard Template</li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ============================================================== -->
                    <!-- end pageheader  -->
                    <!-- ============================================================== -->
                    <div class="student-profile py-4">
                        <div class="">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="card shadow-sm">
                                    <h3 class="m-4"><i class="far fa-clone pr-1"></i>Order Detail</h3>
                                    <table class="table">
                                                <tr>
                                                    <th width="30%">Order Id</th>
                                                    <td width="2%">:</td>
                                                    <td><?php echo $order['order_id']; ?></td>
                                                </tr>
                                                <tr>
                                                    <th width="30% pr-0">Product Name</th>
                                                    <td width="2%">:</td>
                                                    <td><?php echo $order['product_name']; ?></td>
                                                </tr>
                                                <tr>
                                                    <th width="30%">Quantity</th>
                                                    <td width="2%">:</td>
                                                    <td><?php echo $order['quantity']; ?></td>
                                                </tr>
                                                <tr>
                                                    <th width="30%">Order Status</th>
                                                    <td width="2%">:</td>
                                                    <td><?php echo $order['order_status']; ?></td>
                                                </tr>
                                                <tr>
                                                    <th width="30%">Order Date</th>
                                                    <td width="2%">:</td>
                                                    <td><?php echo $order['order_date']; ?></td>
                                                </tr>
                                                <tr>
                                                    <th width="30%">Total</th>
                                                    <td width="2%">:</td>
                                                    <td><?php echo $order['total']; ?></td>
                                                </tr>
                                               
                                               
                                            </table>
                                        </div>
                                       
                                    </div>
                                    <div class="col-lg-4">
                                    <div class="card shadow-sm">
                                        <div class="card-header bg-transparent border-0">
                                            <h3 class="mb-0"><i class="far fa-clone pr-1"></i>Custumer Information</h3>
                                        </div>
                                        <div class="card-body pt-0">
                                            <table class="table">
                                                <tr>
                                                    <th width="30%">First Name</th>
                                                    <td width="2%">:</td>
                                                    <td><?php echo $order['customer_name']; ?></td>
                                                </tr>
                                                <tr>
                                                    <th width="30%">Last Name</th>
                                                    <td width="2%">:</td>
                                                    <td><?php echo $order['lastname']; ?></td>
                                                </tr>
                                                <tr>
                                                    <th width="30%">Gender</th>
                                                    <td width="2%">:</td>
                                                    <td><?php echo $order['gender']; ?></td>
                                                </tr>
                                                <tr>
                                                    <th width="30%">City</th>
                                                    <td width="2%">:</td>
                                                    <td><?php echo $order['city']; ?></td>
                                                </tr>
                                               
                                                <tr>
                                                    <th width="30%">Phone</th>
                                                    <td width="2%">:</td>
                                                    <td><?php echo $order['phone']; ?></td>
                                                </tr>
                                                <tr>
                                                    <th width="30%">Address</th>
                                                    <td width="2%">:</td>
                                                    <td><?php echo $order['address']; ?></td>
                                                </tr>
                                               
                                               
                                            </table>
                                        </div>
                                    </div>
                                    <div style="height: 26px"></div>
                                    
                                </div>
                                </div>
                              
                            </div>
                        </div>
                    </div>



                </div>
                <?php
         include "footer.php";
         ?>
            </div>
           
        </div>
        <!-- ============================================================== -->
        <!-- footer -->
        <!-- ============================================================== -->

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

</html>