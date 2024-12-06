<?php
include 'mydatabase.php'; 

if (isset($_POST['id'])) {
    $customerId = $_POST['id'];

    $orderCheckQuery = "SELECT COUNT(*) AS order_count FROM orders WHERE customer_id = ?";
    $stmt = $conn->prepare($orderCheckQuery);
    $stmt->bind_param("i", $customerId);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    
    if ($row['order_count'] > 0) {
        echo json_encode(['status' => 'error', 'message' => 'This customer cannot be deleted because they have associated orders.']);
    } else {
    // Check if the ID is numeric (sanity check)
    if (is_numeric($customerId)) {
        // Prepare the SQL query to delete the customer
        $sql = "DELETE FROM customers WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $customerId); // Bind the customer ID to the query

        if ($stmt->execute()) {
            echo json_encode(['status' => 'success', 'message' => 'Customer deleted successfully.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to delete customer.']);
        }

        $stmt->close();
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid customer ID.']);
    }
}
} else {
    echo json_encode(['status' => 'error', 'message' => 'No customer ID provided.']);
}

$conn->close();
?>
