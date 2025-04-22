<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Place Order - Suerte Motoplaza</title>
    <link rel="stylesheet" href="order.css">
    
    </style>
</head>
<body class="body">
    <header>
        <img src="FB_IMG_1744374036883.jpg" alt="Header Image" height="65px" width="105px" style="margin-left: 5px; text-align: left; border-radius: 100px;">
        <nav class="navigation">
            <a href="#">Menu</a>
        </nav>
    </header>

    <div class="order-container">
        <h2>Place an Order</h2>
        <form action="place_order.php" method="POST">
            <label for="customer_name">Customer Name</label>
            <input type="text" id="customer_name" name="customer_name" required>

            <label for="address">Address</label>
            <input type="text" id="address" name="address" required>

            <label for="contact">Contact Number</label>
            <input type="text" id="contact" name="contact" required>

            <label for="product_type">Product Type</label>
            <select id="product_type" name="product_type" required>
                <option value="">-- Select Product --</option>
                <option value="Motorcycle">Motorcycle</option>
                <option value="Appliance">Appliance</option>
                <option value="Spare Parts">Spare Parts</option>
            </select>

            <label for="payment_type">Payment Type</label>
            <select id="payment_type" name="payment_type" required>
                <option value="">-- Select Payment --</option>
                <option value="Cash">Cash</option>
                <option value="Installment">Installment</option>
            </select>

            <label for="order_date">Order Date</label>
            <input type="date" id="order_date" name="order_date" required>

            <button type="submit">Submit Order</button>
        </form>
    </div>

    <script src="Loginscript.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>
