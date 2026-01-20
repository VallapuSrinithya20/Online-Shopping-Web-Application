USE online_shopping15;
DELIMITER $$

CREATE PROCEDURE get_orders_by_user(IN uid INT)
BEGIN
    SELECT order_id, order_date, total_amount, status
    FROM orders
    WHERE user_id = uid;
END $$

DELIMITER ;
DELIMITER $$

CREATE PROCEDURE add_product(
    IN pname VARCHAR(100),
    IN pprice DECIMAL(10,2),
    IN pstock INT,
    IN cid INT
)
BEGIN
    INSERT INTO products (product_name, price, stock, category_id)
    VALUES (pname, pprice, pstock, cid);
END $$

DELIMITER ;
CALL get_orders_by_user(1);
CALL add_product('Laptop', 55000, 10, 1);
SELECT * FROM products;
SHOW PROCEDURE STATUS WHERE Db = 'online_shopping15';
