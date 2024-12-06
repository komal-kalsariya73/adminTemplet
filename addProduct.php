<?php
session_start();  


if (!isset($_SESSION['logged_in'])) {
    header('Location: login.php');  
    exit();
}


?>
<?php
include 'mydatabase.php';

$sql = "SELECT id, category FROM categories";
$result = mysqli_query($conn, $sql);
?>
<?php
include "header.php";
?>
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<style>
/* .card-body {
    height: 600px;
} */

.form-outline {
      position: relative;
   }
   .form-outline i {
      position: absolute;
      /* right: 10px; */
      left:5px;
      top: 60%;
      transform: translateY(-50%);
      pointer-events: none;
      color: #888;
   }
   .form-outline .form-control {
      padding-right: 35px;
   }
   .error-message {
      color: red;
      font-size: 0.875rem;
      display: none;
   }
input[type=file] {
    color: #71748d;
    background-color: #fff;
    border-color: none !important; 
    outline: 0;
    box-shadow:none;
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
                                <h2 class="pageheader-title">Product</h2>
                                <p class="pageheader-text">Nulla euismod urna eros, sit amet scelerisque torton lectus
                                    vel mauris facilisis faucibus at enim quis massa lobortis rutrum.</p>
                                <div class="page-breadcrumb">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="#"
                                                    class="breadcrumb-link">Dashboard</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">E-Commerce Dashboard
                                                Template</li>
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
                                <!-- <h5 class="card-header">Add Products</h5> -->
                                <div class="card-body">
                                    <form id="validationform" data-parsley-validate="" novalidate="" class="shadow m-auto p-4 w-50"  enctype="multipart/form-data">
                                    <h2 class="text-center">Add Product</h2>
                                    <label class="col-12 col-sm-3 m-0 p-0">Product
                                    Title</label>
                                        <div class="form-group row">
                                            
                                            <div class="col-12 col-sm-8 col-lg-12">
                                                <div data-mdb-input-init class="form-outline">
                                                    <input type="text" required="" placeholder="Enter product title"
                                                        class="form-control pl-5" name="name" id="name">
                                                        <i class="fas fa-box ml-3"></i>
                                                </div>
                                                <span id="demo1" style="color:red">Enter product Name</span>
                                            </div>
                                        </div>
                                        <label
                                                class="col-12 col-sm-3 m-0 p-0">Description</label>
                                        <div class="form-group row">
                                            
                                            <div class="col-12 col-sm-8 col-lg-12">
                                            <div data-mdb-input-init class="form-outline">
                                                <textarea required="" class="form-control pl-5"
                                                    placeholder="Enter your product description" name="description" id="description"></textarea>
                                                    <i class="fas fa-list ml-3"></i>
</div>
<span id="demo2" style="color:red">Enter product Description</span>
                                            </div>
                                            
                                        </div>
                                        <label class="col-12 col-sm-3 m-0 p-0">Image</label>
                                        <div class="form-group row">
                                           
                                            <div class="col-12 col-sm-8 col-lg-12">
                                                <div data-mdb-input-init class="form-outline">
                                                    <input type="file" required="" placeholder="Enter product title"
                                                        class="form-control pl-5" name="image[]" id="image" multiple>
                                                        <i class="fas fa-tag ml-3"></i>
                                                </div>
                                                <span id="demo3" style="color:red">Enter product images</span>
                                            </div>
                                        </div>
                                        <label class="col-12 col-sm-3 m-0 p-0">Price</label>
                                        <div class="form-group row">
                                            
                                            <div class="col-12 col-sm-8 col-lg-12">
                                            <div data-mdb-input-init class="form-outline">
                                                <input data-parsley-type="digits" type="number" required=""
                                                    placeholder="Enter Pinclode" class="form-control pl-5" name="price" id="price">
                                                    <i class="fas fa-dollar-sign ml-3"></i>
                                                    </div>
                                                    <span id="demo4" style="color:red">Enter product Price</span>
                                            </div>
                                           
                                        </div>
                                        <label class="col-12 col-sm-3 m-0 p-0">Stock</label>
                                        <div class="form-group row">
                                            
                                            <div class="col-12 col-sm-8 col-lg-12">
                                            <div data-mdb-input-init class="form-outline">
                                                <input data-parsley-type="digits" type="number" required=""
                                                    placeholder="Enter Pinclode" class="form-control pl-5" name="stock" id="stock">
                                                    <i class="fas fa-dollar-sign ml-3"></i>
                                                    </div>
                                                    <span id="demo5" style="color:red">Enter product Stock</span>
                                            </div>
                                        </div>
                                        <label class="col-12 col-sm-3 m-0 p-0">Qntity</label>
                                        <div class="form-group row">
                                           
                                            <div class="col-12 col-sm-8 col-lg-12">
                                            <div data-mdb-input-init class="form-outline">
                                                <input data-parsley-type="number" type="number" required=""
                                                    placeholder="Enter only numbers" class="form-control pl-5" name="quantity" id="quantity">
                                                    <i class="fas fa-shopping-cart ml-3"></i>
                                                    </div>
                                                    <span id="demo6" style="color:red">Enter product Qntity</span>
                                            </div>
                                        </div>
                                        <label class="col-12 col-sm-3 m-0 p-0">Category</label>
                                        <div class="form-group row">
                                           
                                            <div class="col-12 col-sm-8 col-lg-12">
                                            <div data-mdb-input-init class="form-outline">
                                                <select class="form-control pl-5" aria-label="Default select example" name="category" id="category">
                                                <option selected disabled>Select Category</option>
                                                        <?php
                                                        if (mysqli_num_rows($result) > 0) {
                                                            while ($row = mysqli_fetch_assoc($result)) {
                                                                echo "<option value='" . $row['id'] . "'>" . $row['category'] . "</option>";
                                                            }
                                                        } else {
                                                            echo "<option disabled>No categories available</option>";
                                                        }
                                                        ?>
                                                </select>
                                                <i class="fas fa-boxes ml-3"></i>
                                                </div>
                                                <span id="demo7" style="color:red">Select Product Category</span>
                                            </div>
                                            <div id="responseMessage"></div>
                                        </div>
                                        <div class="form-group row text-right">
                                            <div class="col col-sm-10 col-lg-12 offset-sm-1 offset-lg-0">
                                                <button type="submit" class="btn btn-space" style="background:#07193e;color:white">Add Product</button>
                                                <!-- <button class="btn btn-space btn-secondary">Cancel</button> -->
                                            </div>
                                        </div>
                                    </form>
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
    $(document).ready(function () {
    // $("#demo").hide();
    $("#demo1").hide();
    $("#demo2").hide();
    $("#demo3").hide();
    $("#demo4").hide();
    $("#demo5").hide();
    $("#demo6").hide();
    $("#demo7").hide();
  

    $("#validationform").on("submit", function (e) {
        e.preventDefault(); 

       
        let description = $("#description").val();
        let price = $("#price").val();
        let name = $("#name").val();
       let category =$("#category").val();
        let stock = $("#stock").val();
        let quantity = $("#quantity").val();
        let images = $('input[name="image"]').val();

        let isvalid = true;

        
        if (
            name === "" || description === "" || 
            
            price === "" || category === "" || stock === "" || images === "" || quantity === ""
        ) {
           
            $("#demo1").show();
            $("#demo2").show();
            $("#demo3").show();
            $("#demo4").show();
            $("#demo5").show();
            $("#demo6").show();
            $("#demo7").show();
          
            isvalid = false;
        } else {
           
           
            $("#demo1").hide();
            $("#demo2").hide();
            $("#demo3").hide();
            $("#demo4").hide();
            $("#demo5").hide();
            $("#demo6").hide();
            $("#demo7").hide();
           
        }

        if (!isvalid) return;

        
        var formData = new FormData(this);

        $.ajax({
            url: "insertproduct.php",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            cache: false,
            dataType: 'json',
            success: function (response) {
                if (response.status === 'success') {
                    $('#responseMessage').html('<p class="text-success d-inline">'+response.message+'</p><a href="allProduct.php">View</a>');
                    // window.location.href = "allCustomer.php"; 
                } else {
                    $("#responseMessage").html(`<p style="color:red;">${response.message}</p>`);
                }
            },
            error: function () {
                $("#responseMessage").html("<p style='color:red;'>An error occurred while registering.</p>");
            }
        });
    });
});

</script>
</html>
<?php mysqli_close($conn); ?>