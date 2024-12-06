<?php
include 'mydatabase.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $gender = isset($_POST['gender']) ? $_POST['gender'] : null;

    if ($gender === null) {
        echo json_encode(['status' => 'fail', 'message' => 'Gender is required.']);
        exit();
    }
    $id = $_POST['id'];
    $name = $_POST['name'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $city = $_POST['city'];
    $pincode = $_POST['pincode'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
   

    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $allowed_types = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/webp']; 
        $imageType = mime_content_type($_FILES['image']['tmp_name']); 

        if (!in_array($imageType, $allowed_types)) {
            echo json_encode(['status' => 'fail', 'message' => 'Invalid file type. Only JPG, JPEG, PNG, WEBP, and GIF files are allowed.']);
            exit();
        }

        $target_dir = "uploads/";
        $image = $target_dir . basename($_FILES["image"]["name"]);

        if (!move_uploaded_file($_FILES["image"]["tmp_name"], $image)) {
            echo json_encode(['status' => 'fail', 'message' => 'Error uploading image.']);
            exit();
        }
    } else {
        // Use the current image if no new file is uploaded
        $image = isset($_POST['current_image']) ? $_POST['current_image'] : '';
    }

    $sql = "UPDATE customers SET name = ?, lastname = ?, email = ?, city = ?, pincode = ?, phone = ?, address = ?, gender = ?, image = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssssissssi", $name, $lastname, $email, $city, $pincode, $phone, $address, $gender, $image, $id);

    if (mysqli_stmt_execute($stmt)) {
        echo json_encode(['status' => 'success', 'message' => 'Update successful']);
    } else {
        echo json_encode(['status' => 'fail', 'message' => 'Error updating customer: ' . mysqli_stmt_error($stmt)]);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}


?>
