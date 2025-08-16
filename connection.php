<?php
$conn = mysqli_connect("localhost", "root", "", "inventory_db");

if (!$conn)
 {
    echo "not connected";
}
else
{
    echo "connected";
}
?>