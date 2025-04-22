<?php
include 'db_conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize inputs
    $customer_name = mysqli_real_escape_string($conn, $_POST['customer_name']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $contact = mysqli_real_escape_string($conn, $_POST['contact']);
    $product_type = mysqli_real_escape_string($conn, $_POST['product_type']);
    $payment_type = mysqli_real_escape_string($conn, $_POST['payment_type']);
    $order_date = mysqli_real_escape_string($conn, $_POST['order_date']);
    $employee_id = 1; // Replace with actual logged-in employee's ID

    // Step 1: Insert or fetch customer from customers table
    $customer_check = $conn->query("SELECT customer_id FROM customers WHERE name='$customer_name' AND contact='$contact' LIMIT 1");
    if ($customer_check->num_rows > 0) {
        $customer = $customer_check->fetch_assoc();
        $customer_id = $customer['customer_id'];
    } else {
        $conn->query("INSERT INTO customers (name, address, contact) VALUES ('$customer_name', '$address', '$contact')");
        $customer_id = $conn->insert_id;
    }
    
    // Step 2: Insert into orders table
    $sql = "INSERT INTO orders (customer_id, employee_id, order_date, payment_type)
            VALUES ('$customer_id', '$employee_id', '$order_date', '$payment_type')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Order placed successfully!'); window.location.href = 'order.html';</script>";
    } else {
        echo "Error inserting order: " . mysqli_error($conn);
    }

    mysqli_close($conn);
} else {
    echo "Invalid request method.";
}
?>
