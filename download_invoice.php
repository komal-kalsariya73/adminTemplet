<?php
require 'dompdf/autoload.inc.php';
include 'mydatabase.php'; 

use Dompdf\Dompdf;
use Dompdf\Options;

$dompdf = new Dompdf();

if (isset($_GET['id'])) {
    $order_id = $_GET['id'];

    $sql = "SELECT o.id AS order_id, c.name AS customer_name,c.lastname,c.pincode, c.phone, c.address, o.order_date, p.name AS product_name, p.price, o.quantity
            FROM orders o
            JOIN customers c ON o.customer_id = c.id
            JOIN products p ON o.product_id = p.id
            WHERE o.id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $order_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $order = $result->fetch_assoc();
         $base_url = base_url.'assets/images/logos.jpg';
         
        // Adding Bootstrap CSS inline for styling
        $html = '
        <html>
        <head>
            <style>
                body { font-family: Arial, sans-serif; }
                table { width: 100%; border-collapse: collapse; margin-top: 210px;}
                th, td { padding: 10px; text-align: left; border: 1px solid #ddd;font-size: 12px; }
                th { background-color: #f8f9fa;font-size: 12px;  }
                .container { width: 80%; margin: 0 auto; }
                .imgbg{width:50px;height:50px}
                .leftheader { float: left; font-size: 12px; margin-top:40px}
                .header { float: right; font-size: 12px; margin-top:50px}
                .footer { text-align: center; font-size: 0.8rem; color: #666; margin-top: 20px; }
                .total { font-weight: ; font-size: 12px; text-align: right; }
            </style>
        </head>
        <body>
            <div class="container">
             <div class="leftheader">
                    <h2><img class="imgbg" src="data:image/png;base64,' . base64_encode(file_get_contents("".base_url."assets/images/logos.jpg")) . '">Order</h2>
                    <p><strong>Order ID:</strong> ' . $order['order_id'] . '</p>
                   <p><strong>Today Date:</strong> ' . date("Y-m-d") . '</p>
                    <p><strong>Order Date:</strong> ' . $order['order_date'] . '</p>
                </div>
                <div class="header">
                   
                    
                    <p><strong>Customer Name:</strong> ' . $order['customer_name'] . '</p>
                      <p><strong>Last Name:</strong> ' . $order['lastname'] . '</p>
                    <p><strong>Phone:</strong> ' . $order['phone'] . '</p>
                     <p><strong>Pincode:</strong> ' . $order['pincode'] . '</p>
                    <p><strong>Address:</strong> ' . $order['address'] . '</p>
                   
                </div>

                <table>
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>';

        
        $result->data_seek(0);
        $totalAmount = 0;

        while ($row = $result->fetch_assoc()) {
            $productTotal = $row['price'] * $row['quantity'];
            $html .= '
            <tr>
                <td>' . $row['product_name'] . '</td>
                <td>$' . number_format($row['price'], 2) . '</td>
                <td>' . $row['quantity'] . '</td>
                <td>$' . number_format($productTotal, 2) . '</td>
            </tr>';
            $totalAmount += $productTotal;
        }

    
        $html .= '
                    </tbody>
                    <tfoot>
                     <tr>
                        
                            <td colspan="3" class="total">SubTotal:</td>
                            <td class="total">$' . number_format($totalAmount, 2) . '</td>
                        </tr>
                        <tr>

                            <td colspan="3" class="total">Total Amount:</td>
                            <td class="total">$' . number_format($totalAmount, 2) . '</td>
                        </tr>
                    </tfoot>
                </table>

                <div class="footer">
                    <p>Thank you for your order!</p>
             
                </div>
            </div>
        </body>
        </html>';

        
        $dompdf->loadHtml($html);

    
        $dompdf->setPaper('A4');

        
        $dompdf->render();

        
        $dompdf->stream('Order_' . $order['order_id'] . '_Invoice.pdf', array('Attachment' => 0)); 
    } else {
        echo "Order not found.";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "No order ID provided.";
    exit;
}
?>
