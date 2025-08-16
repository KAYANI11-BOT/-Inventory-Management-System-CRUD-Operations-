<?php
// add.php
$conn = mysqli_connect("localhost", "root", "", "inventory_db");

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $qty = $_POST['qty'];
    $price = $_POST['price'];   
    $sql="INSERT INTO items (name, qty, price) 
    VALUES ('$name', '$qty', '$price')";
    mysqli_query($conn, $sql);
    header("Location: index.php");
}

?>
