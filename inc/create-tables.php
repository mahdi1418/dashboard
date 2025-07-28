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
      `create_date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
      `sort` VARCHAR(50)  NOT NULL DEFAULT "`create_date` DESC"
    );';
  mysqli_query(db_conn(), $create_users);
  $create_products = 'CREATE TABLE IF NOT EXISTS `products` (
        `product_id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        `title` VARCHAR(100) NULL,
        `desc` VARCHAR(200) NULL,
        `price` FLOAT NULL,
        `create_date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
        `user_id` int UNSIGNED NULL,
        `category` VARCHAR(250) NULL
    );';
  mysqli_query(db_conn(), $create_products);
  $create_image_pro = 'CREATE TABLE IF NOT EXISTS `image_pro` (
        `image_pro_id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        `pro_image` VARCHAR(200) NULL,
        `create_date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
        `product_id` INT UNSIGNED NULL
    );';
  mysqli_query(db_conn(), $create_image_pro);
}
create_tables();
