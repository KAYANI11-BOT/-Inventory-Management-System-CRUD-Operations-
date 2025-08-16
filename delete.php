<?php
$conn = mysqli_connect("localhost", "root", "", "inventory_db");
$id = $_GET['id'];
$query="DELETE FROM items WHERE id=$id";
mysqli_query($conn , $query);
header("Location: index.php");
?>
