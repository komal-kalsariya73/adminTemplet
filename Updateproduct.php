<?php
session_start();  


if (!isset($_SESSION['logged_in'])) {
    header('Location: login.php');  
    exit();
}


?>
<?php
include 'mydatabase.php';

// Check if editing a product
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM products WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $product = mysqli_fetch_assoc($result);

    // Fetch categories
    $sql = "SELECT id, category FROM categories";
    $result = mysqli_query($conn, $sql);
}
?>
<?php include "header.php"; ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<style>
    /* Your CSS styles here */
</style>

<body>
    <div class="dashboard-main-wrapper">
        <?php include "navbar.php";
        include "asidebar.php"; ?>
        <div class="dashboard-wrapper">
            <div class="dashboard-ecommerce">
                <div class="container-fluid dashboard-content">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="page-header">
                                <div class="page-breadcrumb">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="card">
                                <div class="card-body">
                                    
                                    <form id="productForm" data-parsley-validate="" novalidate="" class="shadow m-auto p-4 w-50" enctype="multipart/form-data">
                                        <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
                                        <!-- Product Title -->
                                        <label>Product Title</label>
                                        <div class="form-group row">
                                            <div class="col-12">
                                                <input type="text" required placeholder="Enter product title" class="form-control" name="name" id="name" value="<?php echo $product['name'] ?? ''; ?>">
                                                <!-- <span id="demo1" class="error-message">Enter product name</span> -->
                                            </div>
                                        </div>
                                        <!-- Product Description -->
                                        <label>Description</label>
                                        <div class="form-group row">
                                            <div class="col-12">
                                                <textarea required class="form-control" name="description" id="description" placeholder="Enter your product description"><?php echo $product['description'] ?? ''; ?></textarea>
                                                <!-- <span id="demo2" class="error-message">Enter product description</span> -->
                                            </div>
                                        </div>
                                        <!-- Product Image -->
                                        <label>Image</label>
                                        <div class="form-group row">
                                            <div class="col-12">
                                                <input type="file" class="form-control" name="image[]" id="image" multiple>
                                                <!-- <span id="demo3" class="error-message">Upload product images</span> -->

                                                <?php if (!empty($product['image'])) : ?>
                                                    <div class="existing-images">
                                                        <?php
                                                        $images = json_decode($product['image'], true);
                                                       
                                                        foreach ($images as $image) :
                                                        ?>
                                                            <div style="display: inline-block; margin: 5px;">
                                                                <img src="<?php echo htmlspecialchars($image); ?>" alt="product Image" width="100"></br>
                                                                <label>
                                                                    <input type="checkbox" name="delete_images[]" value="<?php echo htmlspecialchars($image); ?>"> Delete
                                                                </label>
                                                            </div>
                                                        <?php endforeach; ?>
                                                    </div>

                                                    <input type="hidden" name="existing_images" value="<?php echo htmlspecialchars($product['image']); ?>">
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <!-- Product Price -->
                                        <label>Price</label>
                                        <div class="form-group row">
                                            <div class="col-12">
                                                <input type="number" required placeholder="Enter price" class="form-control" name="price" id="price" value="<?php echo $product['price'] ?? ''; ?>">
                                                <!-- <span id="demo4" class="error-message">Enter product price</span> -->
                                            </div>
                                        </div>
                                        <!-- Product Stock -->
                                        <label>Stock</label>
                                        <div class="form-group row">
                                            <div class="col-12">
                                                <input type="number" required placeholder="Enter stock amount" class="form-control" name="stock" id="stock" value="<?php echo $product['stock'] ?? ''; ?>">
                                                <!-- <span id="demo5" class="error-message">Enter product stock</span> -->
                                            </div>
                                        </div>
                                        <!-- Product Quantity -->
                                        <label>Quantity</label>
                                        <div class="form-group row">
                                            <div class="col-12">
                                                <input type="number" required placeholder="Enter quantity" class="form-control" name="quantity" id="quantity" value="<?php echo $product['quantity'] ?? ''; ?>">
                                                <!-- <span id="demo6" class="error-message">Enter product quantity</span> -->
                                            </div>
                                        </div>
                                        <!-- Product Category -->
                                        <label>Category</label>
                                        <div class="form-group row">
                                            <div class="col-12">
                                                <select required class="form-control" name="category" id="category">
                                                    <?php
                                                    if (mysqli_num_rows($result) > 0) {
                                                        while ($row = mysqli_fetch_assoc($result)) {
                                                            $selected = ($row['id'] == $product['category_id']) ? 'selected' : '';
                                                            echo "<option value='" . $row['id'] . "' $selected>" . $row['category'] . "</option>";
                                                        }
                                                    } else {
                                                        echo "<option disabled>No categories available</option>";
                                                    }
                                                    ?>
                                                </select>
                                                <!-- <span id="demo7" class="error-message">Select product category</span> -->
                                            </div>
                                        </div>
                                        <div id="responseMessage"></div>
                                        <!-- Submit Button -->
                                        <button type="submit" class="btn btn-primary btn-block mt-4">Submit</button>
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
        $("#productForm").on("submit", function(e) {
            e.preventDefault();

            var formData = new FormData(this);
            $.ajax({
    url: 'editproduct.php',
    type: 'POST',
    data: formData,
    contentType: false,
    processData: false,
    success: function(response) {
        try {
            response = JSON.parse(response);
            if (response.status === 'success') {
                $('#responseMessage').html('<p class="text-success d-inline">' + response.message + '</p><a href="allProduct.php">View</a>');
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
    });
</script>

</html>

