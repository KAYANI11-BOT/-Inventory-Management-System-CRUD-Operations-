<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Welcome | Inventory Management System</title>
</head>
<body style="
    min-height:100vh;
    margin:0;
    padding:0;
    font-family:'Segoe UI', 'Roboto', Arial, sans-serif;
    background: url('bg.jpg') no-repeat center center fixed;
    background-size: cover;
    display: flex;
    align-items: center;
    justify-content: center;
">
    <div style="
        background: rgba(255,255,255,0.95);
        border-radius: 18px;
        padding: 42px 36px 34px 36px;
        box-shadow: 0 6px 36px rgba(0,0,0,0.17), 0 1.5px 4px rgba(0,0,0,0.12);
        max-width: 440px;
        width: 92vw;
        text-align: center;
        display: flex;
        flex-direction: column;
        align-items: center;
    ">
        <img src="https://cdn-icons-png.flaticon.com/512/4285/4285428.png" alt="Inventory Icon"
            style="width: 85px; height: 85px; margin-bottom: 16px; border-radius: 12px; box-shadow: 0 2px 10px rgba(0,123,255,0.08); background: #eaf2fb;">
        <h1 style="
            font-family: 'Pacifico', cursive, 'Segoe UI', Arial, sans-serif;
            font-size: 2.45rem;
            color: #0056b3;
            margin-bottom: 18px;
            letter-spacing: 1.5px;
            text-shadow: 1px 3px 12px rgba(0,0,0,0.06);
        ">
            Welcome!
        </h1>
        <p style="
            font-size: 1.09rem;
            color: #222b38;
            margin-bottom: 26px;
            font-family: 'Segoe UI', Arial, sans-serif;
            letter-spacing: 0.4px;
        ">
            Welcome to the <b>Inventory Management System</b>.<br>
            Securely manage your stock, edit and track your items with ease.<br>
            <span style="color:#007bff;">Please login or register to continue.</span>
        </p>
        <div style="display:flex; justify-content:center; gap:20px; margin-top:15px;">
            <a href="./login.php" style="
                padding: 11px 38px;
                background: linear-gradient(90deg, #007bff 80%, #0056b3);
                color: #fff;
                border-radius: 7px;
                border: none;
                font-size: 1.08rem;
                font-weight: 500;
                text-decoration: none;
                letter-spacing: 0.6px;
                box-shadow: 0 0.5px 4px rgba(0,0,0,0.10);
                transition: background 0.17s, transform 0.14s;
                font-family: 'Segoe UI', Arial, sans-serif;
            "
            onmouseover="this.style.background='linear-gradient(90deg,#0056b3 80%,#007bff)'; this.style.transform='scale(1.05)';"
            onmouseout="this.style.background='linear-gradient(90deg,#007bff 80%,#0056b3)'; this.style.transform='scale(1)';"
            >Login</a>
            <a href="./register.php" style="
                padding: 11px 30px;
                background: #dc3545;
                color: #fff;
                border-radius: 7px;
                font-size: 1.08rem;
                font-weight: 500;
                text-decoration: none;
                letter-spacing: 0.6px;
                border: none;
                box-shadow: 0 0.5px 4px rgba(0,0,0,0.10);
                transition: background 0.17s, transform 0.14s;
                font-family: 'Segoe UI', Arial, sans-serif;
            "
            onmouseover="this.style.background='#a71d2a'; this.style.transform='scale(1.05)';"
            onmouseout="this.style.background='#dc3545'; this.style.transform='scale(1)';"
            >Register</a>
        </div>
    </div>
    <!-- Google Fonts for heading -->
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
</body>
</html>