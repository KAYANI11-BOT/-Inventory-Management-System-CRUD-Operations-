-- Create the database:
CREATE DATABASE IF NOT EXISTS inventory_db;
USE inventory_db;

-- Create the items table:
CREATE TABLE IF NOT EXISTS items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    qty INT NOT NULL,
    price DECIMAL(10,2) NOT NULL
);