<?php
include 'mydatabase.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $customerId = $_POST['customer_id'];
    $orderData = $_POST['order'];


    foreach ($orderData as $item) {
        $productId = $item['product_id'];
        $quantity = $item['quantity'];
        $total = $item['total'];

        
        $orderQuery = "INSERT INTO orders (customer_id, product_id, quantity, total)
                       VALUES ('$customerId', '$productId', '$quantity', '$total')";
        
        if (mysqli_query($conn, $orderQuery)) {
            echo 'Order inserted successfully for product ID ' . $productId . '<br>';
        } else {
            echo 'Error: ' . mysqli_error($conn) . '<br>';
        }
    }
} else {
    echo 'Invalid request';
}
?>
