<?php
include 'mydatabase.php';

if (isset($_POST['order_id']) && isset($_POST['order_status'])) {
    $order_id = $_POST['order_id'];
    $order_status = $_POST['order_status'];

    
    $sql = "UPDATE orders SET order_status = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "si", $order_status, $order_id);

    if (mysqli_stmt_execute($stmt)) {
        echo "Order status updated successfully.";
    } else {
        echo "Failed to update order status.";
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
} else {
    echo "Invalid input.";
}
?>
