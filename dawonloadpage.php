<?php
require 'dompdf/autoload.inc.php';
include 'mydatabase.php'; 

use Dompdf\Dompdf;
use Dompdf\Options;


$dompdf = new Dompdf();


if (isset($_GET['id'])) {
    $order_id = $_GET['id'];

    
    $sql = "SELECT o.id AS order_id, c.name AS customer_name, c.phone, c.address, o.order_date, p.name AS product_name, p.price, o.quantity
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

        
        $html = '
        <!doctype html>
        <html lang="en">
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
            <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <title>Invoice - ' . $order['order_id'] . '</title>
            <style>
                h4 { margin: 0; }
                .w-full { width: 100%; }
                .w-half { width: 50%; }
                .margin-top { margin-top: 1.25rem; }
                .footer { font-size: 0.875rem; padding: 1rem; background-color: rgb(241 245 249); }
                table { width: 100%; border-spacing: 0; }
                table.products { font-size: 0.875rem; }
                table.products tr { background-color: rgb(96 165 250); }
                table.products th { color: #ffffff; padding: 0.5rem; }
                table tr.items { background-color: rgb(241 245 249); }
                table tr.items td { padding: 0.5rem; }
                .total { text-align: right; margin-top: 1rem; font-size: 0.875rem; }
            </style>
        </head>
        <body>
            <table class="w-full">
                <tr>
                    <td class="w-half">
                        <img src="your-logo.png" alt="Company Logo" width="200" />
                    </td>
                    <td class="w-half">
                        <h2>Invoice ID: ' . $order['order_id'] . '</h2>
                    </td>
                </tr>
            </table>

            <div class="margin-top">
                <table class="w-full">
                    <tr>
                        <td class="w-half">
                            <div><h4>To:</h4></div>
                            <div>' . $order['customer_name'] . '</div>
                            <div>' . $order['address'] . '</div>
                        </td>
                        <td class="w-half">
                            <div><h4>From:</h4></div>
                            <div>Your Company Name</div>
                            <div>Your Company Address</div>
                        </td>
                    </tr>
                </table>
            </div>

            <div class="margin-top">
                <table class="products">
                    <tr>
                        <th>Qty</th>
                        <th>Description</th>
                        <th>Price</th>
                    </tr>';

    
        $total = 0;
        while ($row = $result->fetch_assoc()) {
            $price = $row['price'] * $row['quantity'];
            $total += $price;

            $html .= '
            <tr class="items">
                <td>' . $row['quantity'] . '</td>
                <td>' . $row['product_name'] . '</td>
                <td>' . number_format($row['price'], 2) . '</td>
            </tr>';
        }

        $html .= '
                    <tr style="font-weight: bold;">
                        <td></td><td style="text-align:right;">Total ($)</td>
                        <td style="text-align:right;">' . number_format($total, 2) . '</td>
                    </tr>
                </table>
            </div>

            <div class="footer margin-top">
                <div>Thank you for your business!</div>
                <div>&copy; Your Company Name</div>
            </div>
        </body>
        </html>';

        
        $dompdf->loadHtml($html);

        
        $dompdf->setPaper('A4');

    
        $dompdf->render();

        
        $dompdf->stream('Order_' . $order['order_id'] . '_Invoice.pdf', array('Attachment' => 1)); // 1 to download, 0 to view in browser
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
