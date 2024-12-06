<?php

include 'mydatabase.php';

if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    
    $sql = "DELETE FROM products WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $product_id); 

    
    if ($stmt->execute()) {
        
        header("Location: allProduct.php");
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }

    
    $stmt->close();
} else {
    echo "No product ID provided.";
}


$conn->close();
?>
