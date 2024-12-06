<?php

include "mydatabase.php";

include "mydatabase.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $category = mysqli_real_escape_string($conn, $_POST['category']);

    if (empty($category)) {
        echo json_encode(['status' => 'error', 'message' => 'Category cannot be empty.']);
        exit;
    }
    $checkQuery = "SELECT * FROM categories WHERE category = '$category'";
    $result = mysqli_query($conn, $checkQuery);

    if (mysqli_num_rows($result) > 0) {
        
        echo json_encode(['status' => 'error', 'message' => 'Category already exists.']);
        exit;
    }
    $sql = "INSERT INTO categories (category) VALUES ('$category')";

    if (mysqli_query($conn, $sql)) {
        echo json_encode(['status' => 'success', 'message' => 'Category added successfully!']);
        exit;
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Database error: ' . mysqli_error($conn)]);
    }
}

mysqli_close($conn);

?>
