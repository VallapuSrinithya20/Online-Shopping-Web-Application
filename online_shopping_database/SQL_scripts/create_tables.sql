CREATE DATABASE online_shopping;
USE online_shopping;
CREATE TABLE Users (
    user_id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50),
    email VARCHAR(100) UNIQUE,
    password VARCHAR(100),
    phone VARCHAR(15),
    address TEXT
);
CREATE TABLE Categories (
    category_id INT PRIMARY KEY AUTO_INCREMENT,
    category_name VARCHAR(50)
);
CREATE TABLE Products (
    product_id INT PRIMARY KEY AUTO_INCREMENT,
    product_name VARCHAR(100),
    price DECIMAL(10,2),
    stock INT,
    category_id INT,
    FOREIGN KEY (category_id) REFERENCES Categories(category_id)
);
CREATE TABLE Orders (
    order_id INT PRIMARY KEY AUTO_INCREMENT,
    order_date DATE,
    total_amount DECIMAL(10,2),
    status VARCHAR(20),
    user_id INT,
    FOREIGN KEY (user_id) REFERENCES Users(user_id)
);
CREATE TABLE Payments (
    payment_id INT PRIMARY KEY AUTO_INCREMENT,
    payment_date DATE,
    payment_mode VARCHAR(20),
    payment_status VARCHAR(20),
    order_id INT UNIQUE,
    FOREIGN KEY (order_id) REFERENCES Orders(order_id)
);
CREATE TABLE Delivery (
    delivery_id INT PRIMARY KEY AUTO_INCREMENT,
    delivery_date DATE,
    delivery_status VARCHAR(20),
    order_id INT UNIQUE,
    FOREIGN KEY (order_id) REFERENCES Orders(order_id)
);
CREATE TABLE Order_Items (
    order_item_id INT PRIMARY KEY AUTO_INCREMENT,
    quantity INT,
    price DECIMAL(10,2),
    order_id INT,
    product_id INT,
    FOREIGN KEY (order_id) REFERENCES Orders(order_id),
    FOREIGN KEY (product_id) REFERENCES Products(product_id)
);
SHOW TABLES;







