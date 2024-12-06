<?php
include "mydatabase.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $names = $_POST['name'];
    $description=$_POST['description'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $quantity = $_POST['quantity'];
    $category = $_POST['category'];
    

    $error = "";

    $uploadDir = 'uploads/';
    $imagePaths = [];

    if (!empty($_FILES['image']['name'][0])) {
        foreach ($_FILES['image']['name'] as $key => $name) {
            $targetFilePath = $uploadDir . basename($name);
            $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));

            if (in_array($fileType, ['jpg', 'jpeg', 'png', 'gif'])) {
                if (move_uploaded_file($_FILES['image']['tmp_name'][$key], $targetFilePath)) {
                    $imagePaths[] = $targetFilePath;
                } else {
                    $error = "Error uploading file $name.";
                    break;
                }
            } else {
                $error = "Only JPG, JPEG, PNG, and GIF files are allowed.";
                break;
            }
        }
    }

    if ($error) {
        echo $error;
        exit();
    }

    $image = json_encode($imagePaths);

   
    $sql = "INSERT INTO products  (name,description ,price, stock, quantity, category_id,image)
VALUES ('$names','$description', '$price', '$stock', '$quantity', '$category','$image')";

if (mysqli_query($conn, $sql)) {
  // header("Location: allCustomer.php");
  // exit;
  echo json_encode(['status' => 'success', 'message' => 'insert successfull']);
  exit();
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
}

?>


