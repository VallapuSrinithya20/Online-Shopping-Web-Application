INSERT INTO users (user_id, name, email, password, phone, address)
VALUES
(1, 'Ravi Kumar', 'ravi@gmail.com', 'ravi123', '9876543210', 'Hyderabad'),
(2, 'Anita Sharma', 'anita@gmail.com', 'anita123', '9123456780', 'Bangalore');
INSERT INTO categories (category_id, category_name)
VALUES
(1, 'Electronics'),
(2, 'Clothing');
INSERT INTO products (product_id, product_name, price, stock, category_id)
VALUES
(101, 'Smartphone', 15000, 20, 1),
(102, 'T-Shirt', 500, 50, 2);
INSERT INTO orders (order_id, order_date, total_amount, status, user_id)
VALUES
(1001, '2026-01-10', 15500, 'Placed', 1);
INSERT INTO order_items (order_item_id, quantity, price, order_id, product_id)
VALUES
(1, 1, 15000, 1001, 101),
(2, 1, 500, 1001, 102);
INSERT INTO payments (payment_id, payment_date, payment_mode, payment_status, order_id)
VALUES
(501, '2026-01-10', 'UPI', 'Success', 1001);
INSERT INTO delivery (delivery_id, delivery_date, delivery_status, order_id)
VALUES
(701, '2026-01-12', 'Delivered', 1001);