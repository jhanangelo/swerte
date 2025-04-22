<?php
include 'db_conn.php';

// Add employee
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register_employee'])) {
    $username = trim($_POST['username']);
    $password = password_hash(trim($_POST['password']), PASSWORD_DEFAULT);
    $role = $_POST['role'];

    // Check if the username already exists
    $check = $conn->prepare("SELECT id FROM employees WHERE username = ?");
    $check->bind_param("s", $username);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        $error = "⚠️ Username already exists. Please choose a different one.";
    } else {
        $stmt = $conn->prepare("INSERT INTO employees (username, password, role) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $password, $role);
        $stmt->execute();
        $success = "✅ Employee registered successfully!";
    }
}

// Fetch products
$products = mysqli_query($conn, "SELECT * FROM products");

// Fetch orders
$orders = mysqli_query($conn, "SELECT * FROM orders ORDER BY order_date DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manager Dashboard</title>
    <link rel="stylesheet" href="order.css">
    <style>
        table { width: 100%; background: #fff; border-collapse: collapse; }
        th, td { padding: 10px; border: 1px solid #ccc; text-align: center; }
        h2 { margin-top: 40px; }
        form input, form select { padding: 8px; margin: 5px; width: 200px; }
        .message { margin-top: 10px; font-weight: bold; }
    </style>
</head>
<body style="background-color: #ffc72c;">
    <header style="background-color: black;">
        <img src="FB_IMG_1744374036883.jpg" height="65" width="105" style="margin-left: 5px; border-radius: 100px;">
        <nav class="navigation">
            <a href="menu.html" style="color: beige;">Menu</a>
        </nav>
    </header>

    <main style="padding: 40px;">
        <div class="order-container">
            <h2>📦 Product Inventory Overview</h2>
            <table>
                <tr>
                    <th>Name</th><th>Type</th><th>Brand</th><th>Price</th><th>Stock</th><th>Warranty</th><th>Arrival</th>
                </tr>
                <?php while($p = mysqli_fetch_assoc($products)): ?>
                <tr>
                    <td><?= htmlspecialchars($p['name']) ?></td>
                    <td><?= htmlspecialchars($p['type']) ?></td>
                    <td><?= htmlspecialchars($p['brand']) ?></td>
                    <td>₱<?= number_format($p['price'], 2) ?></td>
                    <td><?= $p['stock'] ?></td>
                    <td><?= htmlspecialchars($p['warranty']) ?></td>
                    <td><?= htmlspecialchars($p['arrival_date']) ?></td>
                </tr>
                <?php endwhile; ?>
            </table>
        </div>

        <div class="order-container">
            <h2>🧾 Recent Orders</h2>
            <table>
                <tr>
                    <th>Customer</th><th>Product</th><th>Payment Type</th><th>Date</th><th>Sales Staff</th>
                </tr>
                <?php while($o = mysqli_fetch_assoc($orders)): ?>
                <tr>
                    <td><?= htmlspecialchars($o['customer_name']) ?></td>
                    <td><?= htmlspecialchars($o['product_name']) ?></td>
                    <td><?= htmlspecialchars($o['payment_type']) ?></td>
                    <td><?= htmlspecialchars($o['order_date']) ?></td>
                    <td><?= htmlspecialchars($o['employee_name']) ?></td>
                </tr>
                <?php endwhile; ?>
            </table>

            <h2>👤 Register New Employee</h2>
            <?php
            if (isset($success)) echo "<p class='message' style='color: green;'>$success</p>";
            if (isset($error)) echo "<p class='message' style='color: red;'>$error</p>";
            ?>
            <form method="POST">
                <input type="text" name="username" placeholder="Username" required><br>
                <input type="password" name="password" placeholder="Password" required><br>
                <select name="role" required>
                    <option value="">Select Role</option>
                    <option value="manager">manager</option>
                    <option value="sales">Sales Staff</option>
                    <option value="stock">Stock Manager</option>
                </select><br>
                <button type="submit" name="register_employee">Register Employee</button>
            </form>
        </div>
    </main>
</body>
</html>