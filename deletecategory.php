<?php
include 'mydatabase.php';

if (isset($_POST['id'])) {
    $categoryId = $_POST['id'];

    
    $checkSql = "SELECT * FROM products WHERE category_id = $categoryId";
    $checkResult = mysqli_query($conn, $checkSql);

    if (mysqli_num_rows($checkResult) > 0) {
        
        echo json_encode([
            'status' => 'error',
            'message' => 'This category cannot be deleted as it is used by some products.'
        ]);
        exit();
    } else {
        
        $deleteSql = "DELETE FROM categories WHERE id = $categoryId";

        if (mysqli_query($conn, $deleteSql)) {
        
            echo json_encode([
                'status' => 'success',
                'message' => 'Category deleted successfully.'
            ]);
        } else {
            
            echo json_encode([
                'status' => 'error',
                'message' => 'Error deleting category: ' . mysqli_error($conn)
            ]);
        }
        exit();
    }
} else {
    
    echo json_encode([
        'status' => 'error',
        'message' => 'Invalid request.'
    ]);
    exit();
}

mysqli_close($conn);
?>
