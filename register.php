<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

// Add database connection
$conn = mysqli_connect("localhost", "root", "", "inventory_db");

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $password2 = $_POST['password2'];

    if ($password !== $password2) {
        $error = "Passwords do not match!";
    } else {
        // Check if username exists
        $stmt = $conn->prepare("SELECT id FROM users WHERE username=?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $error = "Username already taken.";
        } else {
            // Insert user
            $hashed = password_hash($password, PASSWORD_DEFAULT);
            $stmt->close();
            $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
            $stmt->bind_param("ss", $username, $hashed);
            $stmt->execute();
            $_SESSION['user_id'] = $stmt->insert_id;
            $_SESSION['username'] = $username;
            header("Location: index.php");
            exit();
        }
        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Register - Inventory</title>
    <style>
        body {
            min-height: 100vh;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', 'Roboto', Arial, sans-serif;
            background: url('bg.png') no-repeat center center fixed;
            background-size: cover;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .container {
            width: 350px;
            background: rgba(255,255,255,0.93);
            border-radius: 12px;
            padding: 38px 28px 22px 28px;
            box-shadow: 0 6px 36px rgba(0,0,0,0.15), 0 1.5px 4px rgba(0,0,0,0.11);
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #1b2430;
            font-size: 2rem;
            font-weight: 600;
            letter-spacing: 1px;
        }
        .item-form {
            width: 100%;
            display: flex;
            flex-direction: column;
            gap: 15px;
            align-items: stretch;
        }
        .item-form input {
            padding: 11px;
            font-size: 1.05rem;
            border: 1.5px solid #b0b9c6;
            border-radius: 6px;
            background: #f7f8fa;
            transition: border 0.2s;
            outline: none;
        }
        .item-form input:focus {
            border: 1.5px solid #007bff;
            background: #fff;
        }
        .item-form button {
            padding: 10px 0;
            background: linear-gradient(90deg, #007bff 80%, #0056b3);
            color: #fff;
            font-size: 1.06rem;
            font-weight: 500;
            border-radius: 6px;
            border: none;
            cursor: pointer;
            margin-bottom: 4px;
            transition: background 0.2s;
        }
        .item-form button:hover {
            background: linear-gradient(90deg, #0056b3 80%, #007bff);
        }
        .item-form .cancel-btn {
            background: #dc3545;
            color: #fff;
            border-radius: 6px;
            padding: 10px 0;
            font-size: 1.06rem;
            font-weight: 500;
            margin-top: 2px;
            border: none;
            transition: background 0.2s;
            display: block;
            text-align: center;
            text-decoration: none;
        }
        .item-form .cancel-btn:hover {
            background: #a71d2a;
        }
        .alert {
            background: #f8d7da;
            color: #721c24;
            padding: 10px;
            margin-bottom: 16px;
            border-radius: 4px;
            text-align: center;
            font-size: 1rem;
        }
        @media (max-width: 480px) {
            .container {
                padding: 18px 2vw 12px 2vw;
                width: 92vw;
            }
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Register</h2>
    <?php if ($error): ?><div class="alert"><?php echo $error; ?></div><?php endif; ?>
    <form method="post" class="item-form">
        <input type="text" name="username" placeholder="Username" required autocomplete="off">
        <input type="password" name="password" placeholder="Password" required>
        <input type="password" name="password2" placeholder="Confirm Password" required>
        <button type="submit" name="submit">Register</button>
        <a href="login.php" class="cancel-btn">Login</a>
    </form>
</div>
</body>
</html>