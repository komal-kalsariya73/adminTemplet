<?php
include 'mydatabase.php';

if (isset($_GET['id'])) {
    $order_id = $_GET['id'];

    $sql = "SELECT o.id AS order_id, c.name AS customer_name, c.id AS customer_id, p.image, p.name AS product_name, o.quantity, o.order_date, o.total, o.order_status, p.price, p.description, p.category_id, c.phone, c.address, c.lastname, c.gender, c.city, categories.category AS category_name
            FROM orders o
            JOIN customers c ON o.customer_id = c.id
            JOIN products p ON o.product_id = p.id
            JOIN categories ON p.category_id = categories.id
            WHERE o.id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $order_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        $order = mysqli_fetch_assoc($result);
        $customer_id = $order['customer_id'];  // Store customer ID for later use
    } else {
        echo "Customer not found.";
        exit;
    }

    mysqli_stmt_close($stmt);
} else {
    echo "No order ID provided.";
    exit;
}
?>
<style>
    .card-body{
        height: 600px;
    }
    .totalpri{
        margin-right: 80px;
        padding-top: 10px;
    }
</style>

<?php
include "header.php";
?>

<?php
       include "navbar.php";
       ?>
         <?php
include "asidebar.php";
    ?>
<div class="dashboard-wrapper ">


    <div class="dashboard-ecommerce">
        <div class="container-fluid dashboard-content">
        <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mt-5">
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
            <div class="student-profile py-4">
                <div class="row">
                    
                    <div class="col-lg-4 mt-4">
                        <div class="">
                            <div class="card-header bg-transparent border-0">
                                <h3 class="mb-0"><i class="far fa-clone pr-1"></i>Customer Information</h3>
                            </div>
                            <div class="card-body pt-0">
                                <table class="table">
                                    <tr><th>First Name</th><td><?php echo $order['customer_name']; ?></td></tr>
                                    <tr><th>Last Name</th><td><?php echo $order['lastname']; ?></td></tr>
                                    <tr><th>Gender</th><td><?php echo $order['gender']; ?></td></tr>
                                    <tr><th>City</th><td><?php echo $order['city']; ?></td></tr>
                                    <tr><th>Phone</th><td><?php echo $order['phone']; ?></td></tr>
                                    <tr><th>Address</th><td><?php echo $order['address']; ?></td></tr>
                                    
                                </table>
                            </div>
                        </div>
                    </div>

                    
                    <div class="col-lg-8">
                        <?php
                    
                        $sql = "SELECT p.name AS product_name, p.price, o.quantity
                        FROM orders o
                        JOIN products p ON o.product_id = p.id
                        WHERE o.id = ?";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param("i", $order_id);
                        $stmt->execute();
                        $result = $stmt->get_result();

                        
                        echo "<h3>Products for Customer: " . htmlspecialchars($order['customer_name']) . "</h3>";
                        echo "<table class='table table-bordered'>
                                <tr><th>Product Name</th><th>Quantity</th><th>Price</th></tr>";
                        
                        $totalPrice = 0;  

                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>" . htmlspecialchars($row['product_name']) . "</td>
                                    <td>" . htmlspecialchars($row['quantity']) . "</td>
                                    <td>" . htmlspecialchars($row['price']) . "</td>
                                     
                                  </tr>";
                            $totalPrice += $row['price'] * $row['quantity'];  
                        }
                        echo "</table>";
                        echo "<div class='text-right  text-dark totalpri'><strong>Total Price:</strong> $" . number_format($totalPrice, 2) . "</div>";

                        $stmt->close();
                        $conn->close();
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include "footer.php"; ?>

</div>


</body>
</html>
