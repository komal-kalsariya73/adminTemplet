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
    $id = $_GET['id'];

    $sql = "SELECT * FROM categories WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $category = mysqli_fetch_assoc($result);

    if (!$category) {
        echo "Category not found!";
        exit;
    }
    mysqli_stmt_close($stmt);
} else {
    echo "Invalid category ID!";
    exit;
}

include "header.php";
?>

<style>
    .form-outline i {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        pointer-events: none;
    }
    .card-body{
        height: 700px;
    }
</style>

<body>
<div class="dashboard-main-wrapper">
    <?php include "navbar.php"; ?>
    <?php include "asidebar.php"; ?>

    <div class="dashboard-wrapper">
        <div class="dashboard-ecommerce">
            <div class="container-fluid dashboard-content">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="page-header">
                            <h2 class="pageheader-title">Category</h2>
                            <p class="pageheader-text">Update the category below.</p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-12">
                        <div class="card h-100">
                            <div class="card-body">
                                <form id="validationform" method="post" class="shadow w-50 p-4 m-auto">
                                    <h2 class="text-center">Edit Category</h2>
                                    <input type="hidden" id="category_id" name="category_id" value="<?php echo htmlspecialchars($id); ?>">
                                    <div class="form-group row">
                                        <label class="col-12">Category</label>
                                        <div class="col-12">
                                            <div class="form-outline">
                                                <input type="text" required="" placeholder="Enter Category" class="form-control pl-5" name="category_name" id="category" value="<?php echo htmlspecialchars($category['category']); ?>" />
                                                <i class="fas fa-boxes ml-3"></i>
                                            </div>
                                        </div>
                                        <div id="responseMessage"></div>
                                    </div>
                                    <div class="form-group row text-right">
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-space" style="background:#07193e;color:white">Update</button>
                                        </div>
                                    </div>
                                   
                                </form>
                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php include "footer.php"; ?>
    </div>
</div>

</body>

<script>
    $(document).ready(function() {
        $("#validationform").on("submit", function(event) {
            event.preventDefault();

            var category_id = $("#category_id").val();
            var category_name = $("#category").val();
            $.ajax({
                url: "editcategory.php",
                type: "POST",
                data: {
                    id: category_id,
                    category_name: category_name
                },
                dataType: "json",
                success: function(response) {
                    if (response.status === "success") {
                        $('#responseMessage').html('<p class="text-success d-inline">'+response.message+'</p><a href="Category.php">View</a>');
                    } else {
                        $("#resultMessage").html("<div class='alert alert-danger'>" + response.message + "</div>");
                    }
                },
                error: function() {
                    $("#resultMessage").html("<div class='alert alert-danger'>An error occurred while updating the category.</div>");
                }
            });
        });
    });
</script>
</html>
