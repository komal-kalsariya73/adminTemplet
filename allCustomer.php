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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<style>
     .card-body{
        height:600px;
    } 
    .paddingright{
        padding:10px;
        margin: 10px;
        display: inline-block;
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
                            <h2 class="pageheader-title">All Customers</h2>
                            <p class="pageheader-text">Proin placerat ante duiullam scelerisque a velit ac porta, fusce sit amet vestibulum mi. Morbi lobortis pulvinar quam.</p>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Tables</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">All Customer</li>
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
                            <h5 class="card-header p-2 flex-grow-1">Customer</h5>
                            <a href="addCustomer.php" ><button class="p-2 m-2 border-0 font-monospace" style="background:#07193e;color:white">Add Customer</button></a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table  table-bordered first">
                                        <thead class="" style="background:#0E0C28">
                                            <tr>
                                                <th  style="color:white">Name</th>
                                                <th  style="color:white">Email</th>
                                                <th style="color:white">City</th>
                                                <th style="color:white">Pincode</th>
                                                <th style="color:white">Address</th>
                                                <th style="color:white">Action</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                include "mydatabase.php";
                $sql = "SELECT * FROM customers ORDER BY id DESC";
                $result = $conn->query($sql);

                
                if ($result->num_rows > 0) {
                    
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        // echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . $row['name'] . "</td>";
                        echo "<td>" . $row['email'] . "</td>";
                        echo "<td>" . $row['city'] . "</td>";
                        echo "<td>" . $row['pincode'] . "</td>";
                     
                        echo "<td>" . $row['address'] . "</td>";
                        echo "<td>
        <a href='displaycustomer.php?id=" . $row['id'] . "' class=''>
            <i class='fas fa-box paddingright'  style='color:#7ca6ec;margin-right:10px;'></i>
        </a>
        <a href='updatecustomer.php?id=" . $row['id'] . "' class=''>
            <i class='fas fa-pencil-alt pr-2' style='color:orange'></i>
        </a>
       <a href='javascript:void(0);' class='deleteBtn' data-id='" . $row['id'] . "'>
                                <i class='fas fa-trash' style='color:red'></i>
                            </a>
    

    </td>";

                        echo "</tr>";
                    }
                } else {
                
                    echo "<tr><td colspan='7' class='text-center'>No customers found.</td></tr>";
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
<script>
$(document).ready(function () {
    
    $(document).on('click', '.deleteBtn', function (e) {
        e.preventDefault();

        var customerId = $(this).data('id');
        
        
        if (confirm('Are you sure you want to delete this customer?')) {
            $.ajax({
                url: 'deletecustomer.php', 
                type: 'POST',
                data: { id: customerId },
                success: function (response) {
                    
                    var result = JSON.parse(response); 
                    if (result.status === 'success') {
                        alert(result.message);
                        location.reload(); 
                    } else {
                        alert(result.message); 
                    }
                },
                error: function () {
                    alert("An error occurred while trying to delete the customer.");
                }
            });
        }
    });
});
</script>
</html>