<?php
function create_tables()
{
    $create_users = 'CREATE TABLE IF NOT EXISTS `users`(
      `user_id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
      `name` VARCHAR(50) NULL,
      `last_name` VARCHAR(50) NULL,
      `email` VARCHAR(100) NULL,
      `password` TEXT NULL,
      `file` VARCHAR(200) NOT NULL DEFAULT "first.svg",
      `create_date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
    );';
    mysqli_query(db_conn(), $create_users);
    $create_products = 'CREATE TABLE IF NOT EXISTS `products` (
        `product_id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        `title` VARCHAR(100) NULL,
        `desc` VARCHAR(200) NULL,
        `price` FLOAT NULL,
        `create_date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
        `user_id` int UNSIGNED NULL
    );';
    mysqli_query(db_conn(), $create_products);
}
create_tables();
