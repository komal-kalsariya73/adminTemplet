<?php
session_start();  


if (!isset($_SESSION['logged_in'])) {
    header('Location: login.php');  
    exit();
}


?>
<?php
include 'mydatabase.php';

if (isset($_GET['id'])) {
    $customer_id = $_GET['id'];
    $gender=$_GET['gender'];

    $sql = "SELECT * FROM customers WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $customer_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $customer = $result->fetch_assoc();
    } else {
        echo "Customer not found.";
        exit;
    }
} else {
    echo "No customer ID provided.";
    exit;
}
?>
<?php
   include "header.php";
   ?>
<style>
   /* .card-body {
   height: 600px;
   } */
   .form-outline i {
   position: absolute;
   top: 70%;
   transform: translateY(-50%);
   pointer-events: none;
   /* left: 5%; */
   }
   /* input::placeholder {
   padding-left: 25px;
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
                        <h2 class="pageheader-title">Customers</h2>
                        <p class="pageheader-text">Nulla euismod urna eros, sit amet scelerisque torton lectus
                           vel mauris facilisis faucibus at enim quis massa lobortis rutrum.
                        </p>
                        <div class="page-breadcrumb">
                           <nav aria-label="breadcrumb">
                              <ol class="breadcrumb">
                                 <li class="breadcrumb-item"><a href="#"
                                    class="breadcrumb-link">Dashboard</a></li>
                                 <li class="breadcrumb-item active" aria-current="page">E-Commerce Dashboard
                                    Template
                                 </li>
                              </ol>
                           </nav>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- ============================================================== -->
               <!-- end pageheader  -->
               <div class="row">
                  <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                     <div class="card">
                        <!-- <h5 class="card-header">Add Customer Details</h5> -->
                        <div class="card-body">
                           <form id="validationform" data-parsley-validate="" novalidate=""
                              class=" w-75 shadow m-auto p-4" action="" method=""
                              enctype="multipart/form-data">
                              <h2 class="text-center">Edit Customer Details</h2>
                              <section class="">
                                 <div class="container">
                                    <div class="row d-flex justify-content-center align-items-center">
                                       <div class="col">
                                          <div class="card card-registration">
                                             <div class="row g-0">
                                                <div class="col-xl-12">
                                                   <div class="card-body  text-black">
                                                      <div class="row">
                                                      <input type="hidden" name="id" value="<?php echo $customer['id']; ?>" />
                                                         <div class="col-md-6 mb-4">
                                                            <div data-mdb-input-init
                                                               class="form-outline">
                                                               <label class="form-label text-dark"
                                                                  for="form3Example1m">First
                                                               name</label>
                                                               <input type="text" id="name"
                                                                  name="name"
                                                                  class="form-control form-control-lg pl-5"
                                                                  placeholder="Enter Your FirstName"   value="<?php echo $customer['name']; ?>"/>
                                                               <i class="fas fa-user ml-3"></i>
                                                               <!-- <span id="demo1" style="color: red;">Please enter name</span> -->
                                                            </div>
                                                         </div>
                                                         <div class="col-md-6 mb-4">
                                                            <div data-mdb-input-init
                                                               class="form-outline">
                                                               <label class="form-label text-dark"
                                                                  for="form3Example1n">Last
                                                               name</label>
                                                               <input type="text" id="lastname"
                                                                  name="lastname"
                                                                  class="form-control form-control-lg pl-5"
                                                                  placeholder="Enter Your Lastname"  value="<?php echo $customer['lastname']; ?>"/>
                                                               <i class="fas fa-user ml-3"></i>
                                                               <!-- <span id="demo2" style="color: red;">Please enter lastname</span> -->
                                                            </div>
                                                         </div>
                                                      </div>
                                                      <div class="row">
                                                      <div class="col-md-6 mb-4">
                                                            <div data-mdb-input-init
                                                               class="form-outline">
                                                               <label class="form-label text-dark"
                                                                  for="form3Example1n">Email
                                                               </label>
                                                               <input type="email" id="email"
                                                                  name="email"
                                                                  class="form-control form-control-lg pl-5"
                                                                  placeholder="Enter Your Email"  value="<?php echo $customer['email']; ?>"/>
                                                               <i class="fas fa-box ml-3"></i>
                                                               <!-- <span id="demo2" style="color: red;">Please enter lastname</span> -->
                                                            </div>
                                                         </div>
                                                         <div class="col-md-6 mb-4">
                                                            <div data-mdb-input-init
                                                               class="form-outline">
                                                               <label class="form-label text-dark"
                                                                  for="form3Example1m">Address
                                                               </label>
                                                               <input type="text" id="address"
                                                                  name="address"
                                                                  class="form-control form-control-lg pl-5"
                                                                  placeholder="Enter Your Address"  value="<?php echo $customer['address']; ?>"/>
                                                               <i class="fas fa-home ml-3"></i>
                                                               <!-- <span id="demo1" style="color: red;">Please enter name</span> -->
                                                            </div>
                                                         </div>
                                                        
                                                      </div>
                                                      
                                                      <div data-mdb-input-init
                                                         class="form-outline mb-4">
                                                         <label class="form-label text-dark"
                                                            for="form3Example8">Phone</label>
                                                         <input type="number" id="phone" name="phone"
                                                            class="form-control form-control-lg"
                                                            placeholder="Enter Your phone Number"  value="<?php echo $customer['phone']; ?>" />
                                                            <!-- <i class="fas fa-bus"></i> -->
                                                         <!-- <span id="demo3" style="color: red;">Please enter Address</span> -->
                                                      </div>
                                                      <span id="demo8" style="color: red;" class="mt=0"></span> 
                                                      <div class="d-md-flex justify-content-start align-items-center py-2">
    <label class="form-label p-2 text-dark" for="form3Example1n">Gender</label>
    <label class="custom-control custom-radio custom-control-inline">
        <input type="radio" name="gender" id="male" 
            value="Male" <?php echo ($customer['gender'] == 'Male') ? 'checked' : ''; ?>
            class="custom-control-input pl-2">
        <span class="custom-control-label">Male</span>
    </label>
    <label class="custom-control custom-radio custom-control-inline">
        <input type="radio" name="gender" id="female" 
            value="Female" <?php echo ($customer['gender'] == 'Female') ? 'checked' : ''; ?>
            class="custom-control-input">
        <span class="custom-control-label">Female</span>
    </label>
</div>
                                                    
                                                      <div data-mdb-input-init
                                                         class="form-outline mb-4">
                                                         <label class="form-label text-dark"
                                                            for="form3Example90">Pincode</label>
                                                         <input type="text" id="pincode"
                                                            name="pincode"
                                                            class="form-control form-control-lg"
                                                            placeholder="Enter Pincode"  value="<?php echo $customer['pincode']; ?>"/>
                                                         <!-- <span id="demo5" style="color: red;">Please
                                                            enter pincode</span> -->
                                                      </div>
                                                      <span id="demo10" style="color: red;"></span>
                                                      <div data-mdb-input-init
                                                         class="form-outline mb-4">
                                                         <label class="form-label text-dark"
                                                            for="form3Example99">City</label>
                                                         <!-- <input type="text"id="course" name="course" class="form-control form-control-lg"  placeholder="Enter Your Course"/> -->
                                                         <select id="inputState"
                                                            class="form-control pl-3" id="city"
                                                            name="city">
                                                            <!-- <option> Choose...</option> -->
                                                            <option value="Surat" <?php echo ($customer['city'] == 'Surat') ? 'selected' : ''; ?>>Surat</option>
                                                            <option value="Mumbai" <?php echo ($customer['city'] == 'Mahuva') ? 'selected' : ''; ?>>Mumbai</option>
                                                            <option value="Rajkot" <?php echo ($customer['city'] == 'Rajkot') ? 'selected' : ''; ?>>Rajkot</option>
                                                            <option value="Mahuva" <?php echo ($customer['city'] == 'Mahuva') ? 'selected' : ''; ?>>Mahuva</option>
                                                         </select>
                                                         <!-- <i class="fas fa-home ml-3"></i>  -->
                                                         <!-- <span id="demo6" style="color: red;">Please
                                                            enter course</span> -->
                                                      </div>
                                                      <div data-mdb-input-init
                                                         class="form-outline mb-4">
                                                      <label for="email"
                                                         class="form-label text-dark">Profile
                                                      Image<span
                                                         class="text-danger"></span></label>
                                                      <input type="file" id="image" name="image"
                                                         accept="image/*">
                                                         <small>Current Image: <?php echo $customer['image']; ?></small><br>
                                                   </div>
                                                   <div class="d-flex justify-content-end m-2">
                                                      <button type="submit" data-mdb-button-init
                                                         data-mdb-ripple-init class="btn text-uppercase"
                                                         name="upload"
                                                         style="background:#07193e;color:white;">Update</button>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                        </div>
                        <div id="responseMessage"></div>
                        </section>
                        </form>
                     </div>
                  </div>
               </div>
               <!-- ============================================================== -->
               <!-- end valifation types -->
               <!-- ============================================================== -->
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
<script>
$(document).ready(function () {
   
    $("#demo8").hide();
 
    $("#demo10").hide();
  

    $("#validationform").on("submit", function (e) {
        e.preventDefault(); 

     
        let phone = $("#phone").val();
        let pincode = $("#pincode").val();
      
        let images = $('input[name="image"]').val();

        let isvalid = true;

    
            
            let phonevali = /^[0-9]{10}$/;
            if (!phonevali.test(phone)) {
                $("#demo8").show().html("Please enter a valid 10-digit phone number");
                isvalid = false;
            } else {
                $("#demo8").hide();
            }

            
            let pincodevali = /^[0-9]{6}$/;
            if (!pincodevali.test(pincode)) {
                $("#demo10").show().html("Please enter a valid 6-digit pincode");
                isvalid = false;
            } else {
                $("#demo10").hide();
            }
        

        if (!isvalid) return;

        
        var formData = new FormData(this);

        $.ajax({
            url: "editcustomer.php",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            cache: false,
            dataType: 'json',
            
            success: function (response) {
                if (response.status === 'success') {
                    $('#responseMessage').html('<p class="text-success d-inline">'+response.message+'</p><a href="allCustomer.php">View</a>');
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