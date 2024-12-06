<?php

include 'mydatabase.php';

header('Content-Type: application/json');

// Ensure the request is POST and includes an ID
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
    exit;
}

$id = $_POST['id'] ?? null;
$category_name = $_POST['category_name'] ?? '';

if (!$id) {
    echo json_encode(['status' => 'error', 'message' => 'Invalid category ID']);
    exit;
}

if (empty($category_name)) {
    echo json_encode(['status' => 'error', 'message' => 'Category name is required']);
    exit;
}

// Prepare and execute the update query
$update_sql = "UPDATE categories SET category = ? WHERE id = ?";
$update_stmt = mysqli_prepare($conn, $update_sql);

if ($update_stmt) {
    mysqli_stmt_bind_param($update_stmt, "si", $category_name, $id);

    if (mysqli_stmt_execute($update_stmt)) {
        echo json_encode(['status' => 'success', 'message' => 'Category updated successfully']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error updating category: ' . mysqli_error($conn)]);
    }

    mysqli_stmt_close($update_stmt);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Failed to prepare the SQL statement']);
}

mysqli_close($conn);
?>
