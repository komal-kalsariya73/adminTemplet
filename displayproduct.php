<?php

include 'mydatabase.php';

if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    
    $sql = "SELECT products.*, categories.category FROM products
    LEFT JOIN categories ON products.category_id = categories.id 
    WHERE products.id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $product_id); 
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    
    if (mysqli_num_rows($result) > 0) {
        $product = mysqli_fetch_assoc($result);
    } else {
        echo "product not found.";
        exit;
    }

    
    mysqli_stmt_close($stmt);
} else {
    echo "No product ID provided.";
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

                    <!-- ============================================================== -->
                    <!-- end pageheader  -->
                    <!-- ============================================================== -->
                    <div class="student-profile py-4">
                        <div class="">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="card shadow-sm">
                                        <div class="card-header bg-transparent text-center">
                                        <?php
                                            $images = json_decode($product['image'], true);
                                            if ($images) {
                                                foreach ($images as $image) {
                                                    echo "<img src='" . htmlspecialchars($image) .  "' class='rounded' style='width: 100px; height:100px; margin-right: 5px;'>";
                                                }
                                            } else {
                                                echo "<p>No images available</p>";
                                            }
                                            
                                            ?>
                                        </div>
                                      
                                    </div>
                                </div>
                                <div class="col-lg-8">
                                    <div class="card shadow-sm">
                                        <div class="card-header bg-transparent border-0">
                                            <h3 class="mb-0"><i class="far fa-clone pr-1"></i>Products</h3>
                                        </div>
                                        <div class="card-body pt-0">
                                            <table class="table border-0">
                                            <tr>
                                                    <th width="30%">Product</th>
                                                    <td width="2%">:</td>
                                                    <td><?php echo $product['name']; ?></td>
                                                </tr>
                                                <tr>
                                                    <th width="30%">Price</th>
                                                    <td width="2%">:</td>
                                                    <td><?php echo $product['price']; ?></td>
                                                </tr>
                                                <tr>
                                                    <th width="30%">Stock</th>
                                                    <td width="2%">:</td>
                                                    <td><?php echo $product['stock']; ?></td>
                                                </tr>
                                                <tr>
                                                    <th width="30%">Qntity</th>
                                                    <td width="2%">:</td>
                                                    <td><?php echo $product['quantity']; ?></td>
                                                </tr>
                                                <tr>
                                                    <th width="30%">Category</th>
                                                    <td width="2%">:</td>
                                                    <td><?php echo $product['category']; ?></td>
                                                </tr>
                                                
                                              
                                               
                                            </table>
                                        </div>
                                    </div>
                                    <div style="height: 26px"></div>
                                    <div class="card shadow-sm">
                                        <div class="card-header bg-transparent border-0">
                                            <h3 class="mb-0"><i class="far fa-clone pr-1"></i>Other Information</h3>
                                        </div>
                                        <div class="card-body pt-0">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                                                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim
                                                veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
                                                commodo consequat.</p>
                                        </div>
                                    </div>
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