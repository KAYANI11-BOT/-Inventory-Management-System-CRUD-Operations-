<?php
// edit.php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$conn = mysqli_connect("localhost", "root", "", "inventory_db");

//fetch data
$id = $_GET['id'];
$query = "SELECT * FROM items WHERE id = $id";
$result = mysqli_query($conn, $query);
$item = $result->fetch_assoc();
    

// Update logic
if (isset($_POST['submit'])) 
{
    $id = $_POST['id'];
    $name = $_POST['name'];
    $qty = $_POST['qty'];
    $price = $_POST['price'];
    $id = $_POST['id'];
    $sql = "UPDATE items SET name='$name', qty='$qty', price='$price' WHERE id='$id'";
    mysqli_query($conn, $sql);
    header("Location: index.php");
    
}   
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Item</title>
    <style>
        body {
            min-height: 100vh;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', 'Roboto', Arial, sans-serif;
            background: url('lbg.png') no-repeat center center fixed;
            background-size: cover;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .container {
            width: 420px;
            background: rgba(255,255,255,0.98);
            border-radius: 16px;
            padding: 36px 32px 26px 32px;
            box-shadow: 0 8px 32px rgba(33,55,109,0.13), 0 2px 8px rgba(33,55,109,0.07);
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .navbar {
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 18px;
        }
        .navbar a {
            background: linear-gradient(90deg, #0b38d6 80%, #274690 120%);
            color: #fff;
            padding: 7px 20px;
            border-radius: 7px;
            font-size: 1.01rem;
            text-decoration: none;
            font-weight: 500;
            box-shadow: 0 3px 10px rgba(39,70,144,0.09);
            margin-right: 0.5rem;
            transition: background 0.15s, box-shadow 0.15s, color 0.15s;
            border: none;
        }
        .navbar a:hover {
            background: linear-gradient(90deg, #274690 80%, #0b38d6 120%);
            color: #f7ca18;
            box-shadow: 0 6px 18px rgba(39,70,144,0.12);
        }
        h2 {
            text-align: center;
            color: #274690;
            font-size: 2rem;
            letter-spacing: 1px;
            font-family: 'Segoe UI Semibold', 'Segoe UI', Arial, sans-serif;
            margin-bottom: 20px;
            text-shadow: 0 1px 6px rgba(39,70,144,0.06);
        }
        .item-form {
            width: 100%;
            display: flex;
            flex-direction: column;
            gap: 14px;
            margin-bottom: 0;
        }
        .item-form input {
            padding: 10px;
            font-size: 1.07rem;
            border: 1.5px solid #b0b9c6;
            border-radius: 7px;
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
            background: linear-gradient(90deg, #007bff 80%, #0056b3 140%);
            color: #fff;
            font-size: 1.09rem;
            font-weight: 500;
            border-radius: 7px;
            border: none;
            cursor: pointer;
            margin-bottom: 4px;
            margin-top: 8px;
            transition: background 0.17s;
            box-shadow: 0 0.5px 6px rgba(0,0,0,0.09);
        }
        .item-form button:hover {
            background: linear-gradient(90deg, #0056b3 80%, #007bff 140%);
        }
        .item-form .cancel-btn {
            background: #dc3545;
            color: #fff;
            border-radius: 7px;
            padding: 10px 0;
            font-size: 1.08rem;
            font-weight: 500;
            border: none;
            display: block;
            text-align: center;
            text-decoration: none;
            transition: background 0.2s;
        }
        .item-form .cancel-btn:hover {
            background: #a71d2a;
        }
        @media (max-width: 600px) {
            .container {
                width: 94vw;
                padding: 18px 4vw 12px 4vw;
            }
            h2 {
                font-size: 1.25rem;
            }
        }
    </style>
</head>
<body>
<div class="container">
    <div class="navbar">
        <a href="index.php">← Back</a>
        <a href="logout.php" style="margin-left:auto;">Logout</a>
    </div>
    <h2>Edit Item</h2>
    <form method="post" class="item-form">
        <input type="hidden" name="id" value="<?php echo $item['id']; ?>">
        <input type="text" name="name"  value="<?php echo $item['name']; ?>">
        <input type="number" name="qty" value="<?php echo $item['qty']; ?>">
        <input type="number" step="0.01" name="price"s value="<?php echo $item['price']; ?>">
        <button type="submit" name="submit">Update</button>
        <a href="index.php" class="cancel-btn">Cancel</a>
    </form>
</div>
</body>
</html>