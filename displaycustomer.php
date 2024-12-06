<?php

include 'mydatabase.php';

if (isset($_GET['id'])) {
    $customer_id = $_GET['id'];

    
    $sql = "SELECT * FROM customers WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $customer_id); 
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    
    if (mysqli_num_rows($result) > 0) {
        $customer = mysqli_fetch_assoc($result);
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

                    <!-- ============================================================== -->
                    <!-- end pageheader  -->
                    <!-- ============================================================== -->
                    <div class="student-profile py-4">
                        <div class="">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="card shadow-sm">
                                        <div class="card-header bg-transparent text-center">
                                            <img class="profile_img" src="<?php echo $customer['image']; ?>"
                                                alt="student dp">
                                            
                                        </div>
                                        <div class="card-body">
                                            <p class="mb-0 text-center text-dark"><strong class="pr-1 text-dark"></strong><?php echo $customer['name']; ?></p>
                                            <p class="mb-0 text-center text-dark"><strong class="pr-1 text-dark"></strong><?php echo $customer['email']; ?></p>
                                            <a href="allCustomer.php" class="btn w-100 mt-3" style="background:#07193e;color:white">Back to List</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-8">
                                    <div class="card shadow-sm">
                                        <div class="card-header bg-transparent border-0">
                                            <h3 class="mb-0"><i class="far fa-clone pr-1"></i>Custumer Information</h3>
                                        </div>
                                        <div class="card-body pt-0">
                                            <table class="table table-bordered">
                                                <tr>
                                                    <th width="30%">FirstName</th>
                                                    <td width="2%">:</td>
                                                    <td><?php echo $customer['name']; ?></td>
                                                </tr>
                                                <tr>
                                                    <th width="30%">LastName</th>
                                                    <td width="2%">:</td>
                                                    <td><?php echo $customer['lastname']; ?></td>
                                                </tr>
                                                <tr>
                                                    <th width="30%">Gender</th>
                                                    <td width="2%">:</td>
                                                    <td><?php echo $customer['gender']; ?></td>
                                                </tr>
                                                <tr>
                                                    <th width="30%">City</th>
                                                    <td width="2%">:</td>
                                                    <td><?php echo $customer['city']; ?></td>
                                                </tr>
                                                <tr>
                                                    <th width="30%">Pincode</th>
                                                    <td width="2%">:</td>
                                                    <td><?php echo $customer['pincode']; ?></td>
                                                </tr>
                                                <tr>
                                                    <th width="30%">Phone</th>
                                                    <td width="2%">:</td>
                                                    <td><?php echo $customer['phone']; ?></td>
                                                </tr>
                                                <tr>
                                                    <th width="30%">Address</th>
                                                    <td width="2%">:</td>
                                                    <td><?php echo $customer['address']; ?></td>
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