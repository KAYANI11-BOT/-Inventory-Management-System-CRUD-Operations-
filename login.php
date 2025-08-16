<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

$conn = mysqli_connect("localhost", "root", "", "inventory_db");
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $stmt = $conn->prepare("SELECT id, password FROM users WHERE username=?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows === 1) {
        $stmt->bind_result($uid, $hashed_password);
        $stmt->fetch();
        if (password_verify($password, $hashed_password)) {
            $_SESSION['user_id'] = $uid;
            $_SESSION['username'] = $username;
            header("Location: index.php");
            exit();
        } else {
            $error = "Incorrect password.";
        }
    } else {
        $error = "User not found.";
    }
    $stmt->close();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login - Inventory</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body.login-bg {
            min-height: 100vh;
            margin: 0;
            background: url('lbg.jpg') no-repeat center center fixed;
            background-size: cover;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .container {
            width: 370px;
            height: 400px;
            background: rgba(255,255,255,0.94);
            border-radius: 14px;
            padding: 36px 32px 32px 32px;
            box-shadow: 0 6px 36px rgba(0,0,0,0.18), 0 1.5px 4px rgba(0,0,0,0.12);
            margin: 100px auto;

            display: flex;
            flex-direction: column;
            align-items: center;
        }
        h2 {
            margin-bottom: 22px;
            font-size: 2rem;
            font-style: Times New Roman;
            color: #1b2430;
            letter-spacing: 1px;
            font-weight: 600;
        }
        .item-form {
            width: 100%;
            display: flex;
            flex-direction: column;
            gap: 14px;
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
            margin-bottom: 2px;
            transition: background 0.2s;
        }
        .item-form button:hover {
            background: linear-gradient(90deg, #0056b3 80%, #007bff);
        }
        .item-form .cancel-btn {
            background: #dc3545;
            color: #fff;
            border: none;
            border-radius: 6px;
            padding: 10px 0;
            font-size: 1.06rem;
            font-weight: 500;
            margin-top: 2px;
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
                padding: 20px 6vw 18px 6vw;
                width: 92vw;
            }
        }
    </style>
</head>
<body class="login-bg">
    <div class="container">
        <h2>Login</h2>
        <br>
        <?php if ($error): ?><div class="alert"><?php echo $error; ?></div><?php endif; ?>
        <form method="post" class="item-form" autocomplete="off">
            <input type="text" name="username" placeholder="Username" required autofocus>

            <input type="password" name="password" placeholder="Password" required>
            <br>
            <button type="submit">Login</button>
            <a href="register.php" class="cancel-btn">Register</a>
        </form>
    </div>
</body>
</html>