<?php
include 'mydatabase.php';

if (isset($_POST['order_id'])) {  
    $order_id = $_POST['order_id'];

    
    $status_check_sql = "SELECT order_status FROM orders WHERE id = ?";
    $status_stmt = mysqli_prepare($conn, $status_check_sql);
    mysqli_stmt_bind_param($status_stmt, "i", $order_id);
    mysqli_stmt_execute($status_stmt);
    mysqli_stmt_bind_result($status_stmt, $order_status);
    mysqli_stmt_fetch($status_stmt);
    mysqli_stmt_close($status_stmt);

    if ($order_status == 'Complete' || $order_status == 'Cancel') {
        
        $delete_sql = "DELETE FROM orders WHERE id = ?";
        $delete_stmt = mysqli_prepare($conn, $delete_sql);
        mysqli_stmt_bind_param($delete_stmt, "i", $order_id);

        if (mysqli_stmt_execute($delete_stmt)) {
            echo "Order deleted successfully.";
        } else {
            echo "Failed to delete order.";
        }

        mysqli_stmt_close($delete_stmt);
    } else {
        echo "Only orders with 'Complete' status can be deleted.";
    }
} else {
    echo "Order ID not provided.";
}

mysqli_close($conn);
