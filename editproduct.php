<?php
include 'mydatabase.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $quantity = $_POST['quantity'];
    $category = $_POST['category'];

    $uploadDir = 'uploads/';
    $newImagePaths = [];

    
    if (!empty($_FILES['image']['name'][0])) {
        foreach ($_FILES['image']['name'] as $key => $name) {
            $targetFilePath = $uploadDir . basename($name);
            $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));

            if (in_array($fileType, ['jpg', 'jpeg', 'png', 'gif'])) {
                if (move_uploaded_file($_FILES['image']['tmp_name'][$key], $targetFilePath)) {
                    $newImagePaths[] = $targetFilePath;
                }
            }
        }
    }

    
    $existingImages = !empty($_POST['existing_images']) ? json_decode($_POST['existing_images'], true) : [];
    $imagesToKeep = [];
    $imagesToDelete = isset($_POST['delete_images']) ? $_POST['delete_images'] : [];

    
    foreach ($existingImages as $existingImage) {
        if (!in_array($existingImage, $imagesToDelete)) {
            $imagesToKeep[] = $existingImage;
        } else {
            if (file_exists($existingImage)) {
                unlink($existingImage);
            }
        }
    }

    
    $finalImagePaths = array_merge($imagesToKeep, $newImagePaths);
    $encodedImages = json_encode($finalImagePaths);

    
    $sql = "UPDATE products SET name = ?, description = ?, price = ?, stock = ?, quantity = ?, category_id = ?, image = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssdiiisi", $name, $description, $price, $stock, $quantity, $category, $encodedImages, $id);

    if (mysqli_stmt_execute($stmt)) {
        echo json_encode(['status' => 'success', 'message' => 'Update successful']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to update product: ' . mysqli_stmt_error($stmt)]);
    }
    exit();
}

mysqli_close($conn);
?>
