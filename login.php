<?php
ob_start(); // Start output buffering
session_start();
include('db_conn.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST["username"]);
    $password = $_POST["password"]; // Don't escape passwords unnecessarily

    // Remember Me
    if (isset($_POST["remember"])) {
        setcookie("username", $username, time() + (86400 * 30), "/");
        setcookie("password", $password, time() + (86400 * 30), "/"); // Optional
    } else {
        setcookie("username", "", time() - 3600, "/");
        setcookie("password", "", time() - 3600, "/");
    }

    $query = "SELECT * FROM employees WHERE username=? LIMIT 1";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();

        if (password_verify($password, $row["password"])) {
            $_SESSION["username"] = $row["username"];
            $_SESSION["role"] = $row["role"];

            // Redirect by role
            $role = strtolower(trim($row["role"]));

    switch ($role) {
        case 'manager':
            header("Location: manager.php");
            exit();
        case 'stock':
            header("Location: stock.php");
            exit();
        case 'sales':
            header("Location: order.php");
            exit();
        default:
            echo "❌ Unknown role: [$role]";
            exit();
            }
        } else {
            echo "❌ Incorrect password.";
        }
    } else {
        echo "❌ Username not found.";
    }

    $stmt->close();
    $conn->close();
}
?>
<?php ob_end_flush(); ?>