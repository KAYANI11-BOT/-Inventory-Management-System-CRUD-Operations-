<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: welcome.php");
    exit();
}
// Fetch all items
$conn = new mysqli("localhost","root","","inventory_db");
$query = "SELECT * FROM items";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Inventory Management</title>
    <style>
        body {
            background: linear-gradient(120deg, #e0eafc 0%, #cfdef3 100%);
            font-family: 'Segoe UI', Arial, sans-serif;
            min-height: 100vh;
            margin: 0;
        }
        .container {
            width: 670px;
            max-width: 96vw;
            margin: 48px auto;
            background: rgba(255,255,255,0.98);
            border-radius: 18px;
            padding: 38px 30px 28px 30px;
            box-shadow: 0 10px 40px rgba(33,55,109,0.13), 0 2px 8px rgba(33,55,109,0.07);
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .navbar {
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 26px;
        }
        .navbar span {
            font-size: 1.12rem;
            color: #25316D;
            font-weight: 600;
            letter-spacing: 0.2px;
        }
        .navbar a {
            background: linear-gradient(90deg, #0b38d6 80%, #274690 120%);
            color: #fff;
            padding: 8px 24px;
            border-radius: 7px;
            font-size: 1.09rem;
            text-decoration: none;
            font-weight: 500;
            box-shadow: 0 3px 10px rgba(39,70,144,0.09);
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
            font-size: 2.25rem;
            letter-spacing: 1.1px;
            font-family: 'Segoe UI Semibold', 'Segoe UI', Arial, sans-serif;
            margin-bottom: 24px;
            text-shadow: 0 1px 6px rgba(39,70,144,0.06);
        }
        .add-btn {
            display: inline-block;
            padding: 11px 38px;
            margin-bottom: 18px;
            background: linear-gradient(90deg, #3b5998 80%, #274690 120%);
            color: #fff;
            border-radius: 8px;
            border: none;
            font-size: 1.13rem;
            font-weight: 600;
            text-decoration: none;
            letter-spacing: 0.5px;
            box-shadow: 0 2px 10px rgba(39,70,144,0.07);
            transition: background 0.17s, color 0.16s, box-shadow 0.15s;
        }
        .add-btn:hover {
            background: linear-gradient(90deg, #274690 80%, #3b5998 120%);
            color: #f7ca18;
            box-shadow: 0 6px 24px rgba(39,70,144,0.15);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            background: #f7f9fc;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 1px 8px rgba(39,70,144,0.06);
        }
        table th, table td {
            border: none;
            padding: 13px 8px;
            text-align: center;
            font-size: 1.06rem;
        }
        table th {
            background: linear-gradient(90deg, #274690 85%, #3b5998 120%);
            color: #fff;
            font-weight: 700;
            font-size: 1.12rem;
            letter-spacing: 0.4px;
        }
        table td {
            color: #25316D;
            font-weight: 500;
        }
        table tr:nth-child(even){
            background: #e6ecfa;
        }
        table tr:hover {
            background: #d6e0fa;
        }
        .action-link {
            color: #fff;
            padding: 7px 17px;
            border-radius: 6px;
            text-decoration: none;
            margin: 0 5px;
            font-weight: 500;
            font-size: 1.01rem;
            transition: background 0.15s, color 0.12s;
            box-shadow: 0 1px 4px rgba(39,70,144,0.10);
            display: inline-block;
            border: none;
        }
        .action-link.edit {
            background: linear-gradient(90deg, #0b38d6 75%, #274690 120%);
        }
        .action-link.edit:hover {
            background: linear-gradient(90deg, #274690 75%, #0b38d6 120%);
            color: #f7ca18;
        }
        .action-link.delete {
            background: linear-gradient(90deg, #e74c3c 80%, #c0392b 120%);
        }
        .action-link.delete:hover {
            background: linear-gradient(90deg, #c0392b 80%, #e74c3c 120%);
            color: #fffde4;
        }
        @media (max-width: 720px) {
            .container {
                width: 98vw;
                padding: 9vw 2.7vw 6vw 2.7vw;
            }
            table th, table td {
                font-size: 0.99rem;
                padding: 8px 2.5px;
            }
        }
        @media (max-width: 480px) {
            .container {
                margin: 0;
                padding: 2vw 0 6vw 0;
                width: 100vw;
            }
            h2 {
                font-size: 1.25rem;
            }
        }
    </style>
</head>
<body style="
    min-height:100vh;
    margin:0;
    padding:0;
    font-family:'Segoe UI', 'Roboto', Arial, sans-serif;
    background: url('ibg.jpg') no-repeat center center fixed;
    background-size: cover;
    display: flex;
    align-items: center;
    justify-content: center;
"><div class="container">
    <div class="navbar">
        <span>Hello, <?php echo htmlspecialchars($_SESSION['username']); ?>!</span>
        <a href="logout.php">Logout</a>
    </div>
    <h2>Inventory Management</h2>
    <center>
        <a href="add.html" class="add-btn">+ Add Item</a>
    </center>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Actions</th>
        </tr>
        <?php while($row = $result->fetch_assoc()) {?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= htmlspecialchars($row['name']) ?></td>
            <td><?= $row['qty'] ?></td>
            <td><?= $row['price'] ?></td>
            <td>
                <a href="edit.php?id=<?= $row['id'] ?>" class="action-link edit">Edit</a>
                <a href="delete.php?id=<?= $row['id'] ?>" class="action-link delete" onclick="return confirm('Delete this item?')">Delete</a>
            </td>
        </tr>
        <?php } ?>
    </table>
</div>
</body>
</html>