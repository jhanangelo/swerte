<?php
include 'db_conn.php';

// Handle Add Product
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_product'])) {
    $name = $_POST['name'];
    $type = $_POST['type'];
    $brand = $_POST['brand'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $warranty = $_POST['warranty'];
    $arrival_date = $_POST['arrival_date'];

    $sql = "INSERT INTO products (name, type, brand, price, stock, warranty, arrival_date)
            VALUES ('$name', '$type', '$brand', '$price', '$stock', '$warranty', '$arrival_date')";
    mysqli_query($conn, $sql);

    // Redirect to prevent re-submission
    header("Location: stock.php?added=1");
    exit();
}

// Handle Update Stock
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_stock'])) {
    $product_id = $_POST['product_id'];
    $new_stock = $_POST['new_stock'];

    $sql = "UPDATE products SET stock = '$new_stock' WHERE id = '$product_id'";
    mysqli_query($conn, $sql);

    // Redirect to prevent re-update on refresh
    header("Location: stock.php?updated=1");
    exit();
}

// Fetch all products
$result = mysqli_query($conn, "SELECT * FROM products ORDER BY arrival_date DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Stock Manager</title>
    <link rel="stylesheet" href="stock.css">
</head>
<body style="background-color:#ffc72c;">
    <header style="background-color: black;">
        <img src="FB_IMG_1744374036883.jpg" alt="Header Image" height="65px" width="105px" style="margin-left: 5px; border-radius: 100px;">
        <nav class="navigation">
            <a href="menu.html" style="color: beige;">Menu</a>
        </nav>
    </header>

    <main style="padding: 40px;">
        <div class="order-container">
            <h2>📦 Product Inventory</h2>

            <?php if (isset($_GET['added'])): ?>
                <p style="color: green; font-weight: bold;">✅ Product added successfully!</p>
            <?php endif; ?>

            <?php if (isset($_GET['updated'])): ?>
                <p style="color: green; font-weight: bold;">✅ Product stock updated!</p>
            <?php endif; ?>

            <table border="1" cellpadding="10" cellspacing="0" style="background-color: #f9f9f9; width: 100%;">
                <tr>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Brand</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Warranty</th>
                    <th>Arrival Date</th>
                    <th>Update Stock</th>
                </tr>
                <?php while($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?= htmlspecialchars($row['name']) ?></td>
                    <td><?= htmlspecialchars($row['type']) ?></td>
                    <td><?= htmlspecialchars($row['brand']) ?></td>
                    <td>₱<?= number_format($row['price'], 2) ?></td>
                    <td><?= $row['stock'] ?></td>
                    <td><?= $row['warranty'] ?></td>
                    <td><?= $row['arrival_date'] ?></td>
                    <td>
                        <form method="POST">
                        <input type="number" name="new_stock" min="0" value="<?= $row['stock'] ?>" required>
                            <button type="submit" name="update_stock">Update</button>
                        </form>
                    </td>
                </tr>
                <?php } ?>
            </table>

            <hr style="margin: 40px 0;">

            <h2>➕ Add New Product</h2>
            <form method="POST" style="max-width: 600px;">
                <input type="text" name="name" placeholder="Product Name" required><br><br>
                <input type="text" name="type" placeholder="Type (Motorcycle, Appliance, etc.)" required><br><br>
                <input type="text" name="brand" placeholder="Brand" required><br><br>
                <input type="number" step="0.01" name="price" placeholder="Price (₱)" required><br><br>
                <input type="number" name="stock" placeholder="Initial Stock" required><br><br>
                <input type="text" name="warranty" placeholder="Warranty (e.g., 1 year)" required><br><br>
                <input type="date" name="arrival_date" required><br><br>
                <button type="submit" name="add_product">Add Product</button>
            </form>
        </div>
    </main>
</body>
</html>