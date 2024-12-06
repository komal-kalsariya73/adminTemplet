<?php
include "mydatabase.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $lastname=$_POST['lastname'];
    $email = $_POST['email'];
    $city = $_POST['city'];
    $pincode = $_POST['pincode'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $gender = isset($_POST['gender']) ? $_POST['gender'] : null;

    $sql_check = "SELECT * FROM customers WHERE email = '$email'";

$result_check = $conn->query($sql_check);

if ($result_check->num_rows > 0) {
    echo json_encode(['status' => 'fail', 'message' => 'This email is already registered.']);
    exit(); 
} 

    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $allowed_types = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/webp']; 
        $imageType = mime_content_type($_FILES['image']['tmp_name']); 

        if (!in_array($imageType, $allowed_types)) {
            echo json_encode(['status' => 'fail', 'message' => 'Invalid file type. Only JPG, JPEG, PNG, WEBP, and GIF files are allowed.']);
            exit();
        }

        $imageName = basename($_FILES['image']['name']);
        $imagePath = 'uploads/' . $imageName;
        if (!move_uploaded_file($_FILES['image']['tmp_name'], $imagePath)) {
            echo json_encode(['status' => 'fail', 'message' => 'Error uploading file.']);
            exit();
        }
    } else {
        $imagePath = null;
    }

   
    $sql = "INSERT INTO customers  (name,lastname ,email, city, pincode, phone, address,image,gender)
VALUES ('$name','$lastname', '$email', '$city', '$pincode', '$phone', '$address','$imagePath','$gender')";

if (mysqli_query($conn, $sql)) {
  
  echo json_encode(['status' => 'success', 'message' => 'insert successfull']);
  exit();
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
}

?>


