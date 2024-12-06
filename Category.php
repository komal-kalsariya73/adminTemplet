<?php
session_start();  


if (!isset($_SESSION['logged_in'])) {
    header('Location: login.php');  
    exit();
}


?>
 <?php

    include 'mydatabase.php';


    ?>

 <?php
    include "header.php";
    ?>
 <style>
     .form-outline i {
         position: absolute;
         top: 50%;
         bottom: 10%;
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
                                 <h2 class="pageheader-title">Category</h2>
                                 <p class="pageheader-text">Nulla euismod urna eros, sit amet scelerisque torton lectus
                                     vel mauris facilisis faucibus at enim quis massa lobortis rutrum.</p>
                                 <div class="page-breadcrumb">
                                     <nav aria-label="breadcrumb">
                                         <ol class="breadcrumb">
                                             <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Category</a>
                                             </li>
                                             <li class="breadcrumb-item active" aria-current="page">E-Commerce Category
                                             </li>
                                         </ol>
                                     </nav>
                                 </div>
                             </div>
                         </div>
                     </div>
                     <!-- ============================================================== -->
                     <div class="row">
                         <!-- ============================================================== -->
                         <!-- valifation types -->
                         <!-- ============================================================== -->
                         <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                             <div class="card h-100">
                               
                                 <div class="card-body">
                                     <form id="validationform" data-parsley-validate="" novalidate="" action="insertcategory.php" method="post" class="shadow w-50 p-4 m-auto">
                                     <h2 class="text-center">Add Category</h2>
                                     <label class="col-12 col-sm-3 m-0 p-0">Category</label>    
                                     <div class="form-group row">
                                           
                                             <div class="col-12 col-sm-8 col-lg-12">

                                                 <div data-mdb-input-init class="form-outline">
                                                     <input type="text" required="" placeholder="Enter Category"
                                                         class="form-control pl-5" name="category" id="category" />
                                                     <i class="fas fa-boxes ml-3"></i>
                                                 </div>
                                                 <p id="message" style="color:red"></p>
                                             </div>
                                         </div>
                                         <div class="form-group row text-right">
                                             <div class="col col-sm-10 col-lg-12 offset-sm-1 offset-lg-0">
                                                 <button type="submit" class="btn btn-space" style="background:#07193e;color:white">Add Category</button>
                                                 <!-- <button class="btn btn-space btn-secondary">Cancel</button> -->
                                             </div>
                                         </div>
<div id="responseMessage"></div>
                                     </form>
                                 </div> <!-- end pageheader  -->

                             </div>
                         </div>
                     </div>


                     <div class="row">
                         <!-- ============================================================== -->
                         <!-- basic table  -->
                         <!-- ============================================================== -->
                         <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                             <div class="card">
                                 <div class="d-flex">
                                     <h5 class="card-header p-2 flex-grow-1">Category</h5>
                                     <!-- <a href="addOrder.php"><button
                                                class="p-2 m-2 border-0 font-monospace btn-danger">Add
                                                Order</button></a> -->
                                 </div>
                                 <div class="card-body h-100">
                                     <div class="table-responsive">
                                         <table class="table table-striped table-hover table-bordered first w-50 m-auto">
                                             <thead class="bg-primary">
                                                 <tr>
                                                     <th style="color:white">Category</th>

                                                     <th style="color:white">Action</th>

                                                 </tr>
                                             </thead>
                                             <tbody>
                                                 <?php
                                                    include "mydatabase.php";
                                                    $sql = "SELECT * FROM categories ORDER BY id DESC";
                                                    $result = $conn->query($sql);


                                                    if ($result->num_rows > 0) {

                                                        while ($row = $result->fetch_assoc()) {
                                                            echo "<tr>";
                                                            // echo "<td>" . $row['id'] . "</td>"; 
                                                            echo "<td>" . $row['category'] . "</td>";

                                                            echo "<td>
       
        <a href='updatecategory.php?id=" . $row['id'] . "' class=''>
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
   $(document).ready(function() {
    // Form submission for adding category
    $("#validationform").on("submit", function(e) {
        e.preventDefault();
       
        var formData = new FormData(this);
        $.ajax({
            url: 'insertcategory.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                try {
                    response = JSON.parse(response); 
                    if (response.status === 'success') {
                        $("#responseMessage").html('<p class="text-success">' + response.message + '</p>');
                        setTimeout(() => {
                            location.reload(); 
                        },); 
                    } else {
                        $("#responseMessage").html('<p style="color:red;">' + response.message + '</p>');
                    }
                } catch (e) {
                    console.error('Invalid JSON response:', response);
                    $("#responseMessage").html('<p style="color:red;">An error occurred while processing the response.</p>');
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', error);
                $("#responseMessage").html('<p style="color:red;">Failed to send request: ' + error + '</p>');
            }
        });
    });

    // Delete category via AJAX
    $(document).on('click', '.deleteBtn', function(e) {
        e.preventDefault();

        var categoryId = $(this).data('id'); 

        if (confirm('Are you sure you want to delete this category?')) {
            $.ajax({
                url: 'deletecategory.php', 
                type: 'POST',
                data: { id: categoryId }, 
                success: function(response) {
                    var result = JSON.parse(response); 
                    if (result.status === 'success') {
                        alert(result.message); 
                        location.reload(); 
                    } else {
                        alert(result.message); 
                    }
                },
                error: function() {
                    alert("An error occurred while trying to delete the category.");
                }
            });
        }
    });
});

</script>
 </html>