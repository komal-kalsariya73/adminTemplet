<?php
session_start();  


if (!isset($_SESSION['logged_in'])) {
    header('Location: login.php');  
    exit();
}


?>
<?php
include "header.php";
?>
<style>
    .card-body{
        height:600px;
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
        <div class="container-fluid  dashboard-content">
                <!-- ============================================================== -->
                <!-- pageheader -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="page-header">
                            <h2 class="pageheader-title">All Products</h2>
                            <p class="pageheader-text">Proin placerat ante duiullam scelerisque a velit ac porta, fusce sit amet vestibulum mi. Morbi lobortis pulvinar quam.</p>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Tables</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">All Products</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- end pageheader -->
                <!-- ============================================================== -->
                <div class="row">
                    <!-- ============================================================== -->
                    <!-- basic table  -->
                    <!-- ============================================================== -->
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="card">
                            <div class="d-flex">
                            <h5 class="card-header p-2 flex-grow-1">Products</h5>
                            <a href="addProduct.php" ><button class="p-2 m-2 border-0 font-monospace"  style="background:#07193e;color:white">Add Product</button></a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered first">
                                        <thead class=""style="background:#0E0C28">
                                            <tr>
                                                 <th  style="color:white">Image</th>
                                                <th  style="color:white">Product Name</th>
                                                
                                                <th style="color:white">Price</th>
                                                <th style="color:white">Qntity</th>
                                                <th style="color:white">Stock</th>
                                                <th style="color:white">Category</th>
                                                <th style="color:white">Action</th>
                                                
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
<?php
include "mydatabase.php";

$sql = "SELECT products.*,categories.category
        FROM products
        JOIN categories ON products.category_id = categories.id ORDER BY id DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";

        
        $imagePaths = json_decode($row['image'], true);
       
        $firstImage = isset($imagePaths[0]) ? $imagePaths[0] : 'default.jpg';
        echo "<td>";
       
            
            echo "<img src='" . htmlspecialchars($firstImage) . "' class='rounded' style='width: 50px; height:50px; margin-right: 5px;'>";
       
        echo "</td>";

        echo "<td>" . $row['name'] . "</td>";
       
        echo "<td>" . $row['price'] . "</td>";
        echo "<td>" . $row['quantity'] . "</td>";
        echo "<td>" . $row['stock'] . "</td>";
        
        echo "<td>" . $row['category'] . "</td>";
        echo "<td>
            <a href='disaplaypro.php?id=" . $row['id'] . "' class=''>
                <i class='fas fa-box pr-2' style='color:#7ca6ec'></i>
            </a>
            <a href='Updateproduct.php?id=" . $row['id'] . "'>
                <i class='fas fa-pencil-alt pr-2' style='color:orange'></i>
            </a>
            
            <a href='javascript:void(0);' onclick='confirmDelete(" . $row['id'] . ")'>  <i class='fas fa-trash' style='color:red'></i></a>
                                                            <script>
                                                                function confirmDelete(id)
 {
                                                                if (confirm('Are you sure you want to delete this customer?')) {
                                                                window.location.href = 'deleteproduct.php?id=' + id;
                                                                }
                                                                }
                                                                </script>

        </td>";

        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='8' class='text-center'>No products found.</td></tr>";
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
                    <!-- ============================================================== -->
                    <!-- end data table  -->
                    <!-- ============================================================== -->
                
           
             
               
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
 
</html>