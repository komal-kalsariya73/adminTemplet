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
        echo "Product not found.";
        exit;
    }

    mysqli_stmt_close($stmt);
} else {
    echo "No product ID provided.";
    exit;
}
?>

<?php include "header.php"; ?>

<style>
/* Main product page styling */
.bg-col { background: #cbd8f3; }
.bgimg { width: 100px; height: 100px; border-radius: 50px; }
.student-profile { height: 750px; }
body { padding: 0; margin: 0; font-family: 'Lato', sans-serif; color: #000; }
.student-profile .card { border-radius: 10px; }
.student-profile .card .card-header .profile_img {
    width: 150px; height: 150px; object-fit: cover; margin: 10px auto;
    border-radius: 50%;
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
                                <h2 class="pageheader-title">E-commerce Product Single </h2>
                                <p class="pageheader-text">Browse through our collection.</p>
                                <div class="page-breadcrumb">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">E-commerce</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">Product Details</li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="offset-xl-2 col-xl-8 col-lg-12 col-md-12">
                            <div class="row">
                                <div class="col-xl-6">
                                    <div id="productslider-1" class="carousel slide" data-ride="carousel">
                                        <div class="carousel-inner">
                                            <?php
                                           $images = json_decode($product['image'], true);
                                           if (!empty($images) && is_array($images)) {
                                               // Re-index the images array to ensure it starts at index 0 after deletions
                                               $images = array_values($images);
                                           
                                               foreach ($images as $index => $image) {
                                                   echo "<div class='carousel-item " . ($index === 0 ? "active" : "") . "'>
                                                         <img src='" . htmlspecialchars($image) . "' class='d-block w-100' style='height: 400px;'>
                                                         </div>";
                                               }
                                           } else {
                                               echo "<div class='carousel-item active'><p>No images available</p></div>";
                                           }
                                            ?>
                                        </div>
                                        <a class="carousel-control-prev" href="#productslider-1" role="button" data-slide="prev">
                                            <span class="carousel-control-prev-icon"></span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                        <a class="carousel-control-next" href="#productslider-1" role="button" data-slide="next">
                                            <span class="carousel-control-next-icon"></span>
                                            <span class="sr-only">Next</span>
                                        </a>
                                    </div>

                                    <div class="thumbnail-images mt-3">
                                        <?php
                                        if (!empty($images) && is_array($images)) {
                                            foreach ($images as $index => $thumbnail) {
                                                echo "<img src='" . htmlspecialchars($thumbnail) . "' class='rounded mt-2 border' 
                                                      style='width: 70px; height: 70px; margin-right: 5px; cursor: pointer;' 
                                                      onclick='changeCarouselImage($index)'>";
                                            }
                                        } else {
                                            echo "<p>No images available</p>";
                                        }
                                        ?>
                                    </div>
                                </div>

                                <div class="col-xl-6 border-left">
                                <div class="product-details">
                                        <div class="border-bottom pb-3 mb-3">
                                            <h2 class="mb-3"><?php echo $product['name']?></h2>
                                            <div class="product-rating d-inline-block float-right">
                                                <i class="fa fa-fw fa-star"></i>
                                                <i class="fa fa-fw fa-star"></i>
                                                <i class="fa fa-fw fa-star"></i>
                                                <i class="fa fa-fw fa-star"></i>
                                                <i class="fa fa-fw fa-star"></i>
                                            </div>
                                            <h3 class="mb-0 text-primary">$<?php echo $product['price']?></h3>
                                        </div>
                                        <div class="product-colors border-bottom">
                                            <h4>Categories</h4>
                                            <?php echo $product['category']?>
                                        </div>
                                        <div class="product-size border-bottom">
                                            <h4>Price</h4>$
                                            <?php echo $product['price']?>
                                            <div class="product-qty">
                                                <h4>Quantity</h4>
                                                <div class="quantity">
                                                <?php echo $product['quantity']?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="product-description">
                                            <h4 class="mb-1">Descriptions</h4>
                                            <?php echo $product['description']?>
                                            <a href="allProduct.php" class="btn w-100" style="background:#07193e;color:white">Back to List</a>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 m-b-60 mt-4">
                                    <div class="simple-card">
                                        <ul class="nav nav-tabs" id="myTab5" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active border-left-0" id="product-tab-1" data-toggle="tab" href="#tab-1" role="tab" aria-controls="product-tab-1" aria-selected="true">Descriptions</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="product-tab-2" data-toggle="tab" href="#tab-2" role="tab" aria-controls="product-tab-2" aria-selected="false">Reviews</a>
                                            </li>
                                        </ul>
                                        <div class="tab-content" id="myTabContent5">
                                            <div class="tab-pane fade show active" id="tab-1" role="tabpanel" aria-labelledby="product-tab-1">
                                                <p>Praesent et cursus quam. Etiam vulputate est et metus pellentesque iaculis. Suspendisse nec urna augue. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubiliaurae.</p>
                                                <p>Nam condimentum erat aliquet rutrum fringilla. Suspendisse potenti. Vestibulum placerat elementum sollicitudin. Aliquam consequat molestie tortor, et dignissim quam blandit nec. Donec tincidunt dui libero, ac convallis urna dapibus eu. Praesent volutpat mi eget diam efficitur, a mollis quam ultricies. Morbi eu turpis odio.</p>
                                                <ul class="list-unstyled arrow">
                                                    <li>
                                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>
                                                    <li>Donec ut elit sodales, dignissim elit et, sollicitudin nulla.</li>
                                                    <li>Donec at leo sed nisl vestibulum fermentum.
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="tab-pane fade" id="tab-2" role="tabpanel" aria-labelledby="product-tab-2">
                                                <div class="review-block">
                                                    <p class="review-text font-italic m-0">“Vestibulum cursus felis vel arcu convallis, viverra commodo felis bibendum. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Proin non auctor est, sed lacinia velit. Orci varius natoque penatibus et magnis dis parturient montes nascetur ridiculus mus.”</p>
                                                    <div class="rating-star mb-4">
                                                        <i class="fa fa-fw fa-star"></i>
                                                        <i class="fa fa-fw fa-star"></i>
                                                        <i class="fa fa-fw fa-star"></i>
                                                        <i class="fa fa-fw fa-star"></i>
                                                        <i class="fa fa-fw fa-star"></i>
                                                    </div>
                                                    <span class="text-dark font-weight-bold">Virgina G. Lightfoot</span><small class="text-mute"> (Company name)</small>
                                                </div>
                                                <div class="review-block border-top mt-3 pt-3">
                                                    <p class="review-text font-italic m-0">“Integer pretium laoreet mi ultrices tincidunt. Suspendisse eget risus nec sapien malesuada ullamcorper eu ac sapien. Maecenas nulla orci, varius ac tincidunt non, ornare a sem. Aliquam sed massa volutpat, aliquet nibh sit amet, tincidunt ex. Donec interdum pharetra dignissim.”</p>
                                                    <div class="rating-star mb-4">
                                                        <i class="fa fa-fw fa-star"></i>
                                                        <i class="fa fa-fw fa-star"></i>
                                                        <i class="fa fa-fw fa-star"></i>
                                                        <i class="fa fa-fw fa-star"></i>
                                                        <i class="fa fa-fw fa-star"></i>
                                                    </div>
                                                    <span class="text-dark font-weight-bold">Ruby B. Matheny</span><small class="text-mute"> (Company name)</small>
                                                </div>
                                                <div class="review-block  border-top mt-3 pt-3">
                                                    <p class="review-text font-italic m-0">“ Cras non rutrum neque. Sed lacinia ex elit, vel viverra nisl faucibus eu. Aenean faucibus neque vestibulum condimentum maximus. In id porttitor nisi. Quisque sit amet commodo arcu, cursus pharetra elit. Nam tincidunt lobortis augueat euismod ante sodales non. ”</p>
                                                    <div class="rating-star mb-4">
                                                        <i class="fa fa-fw fa-star"></i>
                                                        <i class="fa fa-fw fa-star"></i>
                                                        <i class="fa fa-fw fa-star"></i>
                                                        <i class="fa fa-fw fa-star"></i>
                                                        <i class="fa fa-fw fa-star"></i>
                                                    </div>
                                                    <span class="text-dark font-weight-bold">Gloria S. Castillo</span><small class="text-mute"> (Company name)</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
                <?php include "footer.php"; ?>
            </div>
           
        </div>
    </div>
</body>

<script>
function changeCarouselImage(index) {
    const carouselItems = document.querySelectorAll('#productslider-1 .carousel-item');

   
    if (carouselItems.length > 0) {
       
        carouselItems.forEach(function(item) {
            item.classList.remove('active');
        });

        
        if (carouselItems[index]) {
            carouselItems[index].classList.add('active');
        } else {
            carouselItems[0].classList.add('active');
        }
    }
}

</script>
</html>
