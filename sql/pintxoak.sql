CREATE DATABASE `pintxoak`;
GRANT ALL PRIVILEGES ON `pintxoak`.* TO `pinadmin`@`localhost`;

SET PASSWORD FOR `pinadmin`@`localhost` = password("pinpass");

USE pintxoak;

CREATE TABLE `USER` (
       `username` VARCHAR(300),
       `password` VARCHAR(32),
       PRIMARY KEY(`username`)
);


CREATE TABLE `ORGANIZER` (
       `o_username` VARCHAR(300),
       PRIMARY KEY(`o_username`),
       FOREIGN KEY(`o_username`) REFERENCES USER(`username`) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE `JUDGE` (
       `j_username` VARCHAR(300),
       `j_name` VARCHAR(30),
       `j_profession` VARCHAR(50),
       `j_photo` VARCHAR(300), /* We are going to store the file path */
       PRIMARY KEY(`j_username`),
       FOREIGN KEY(`j_username`) REFERENCES USER(`username`) ON DELETE CASCADE ON UPDATE CASCADE
);


CREATE TABLE `ESTABLISHMENT` (
       `e_username` VARCHAR(300),
       `address` VARCHAR(100),
       `e_name` VARCHAR(20),
       `e_photo` VARCHAR(300), /* We are going to store the file path */
       PRIMARY KEY(`e_username`),
       FOREIGN KEY(`e_username`) REFERENCES USER(`username`) ON DELETE CASCADE ON UPDATE CASCADE
);


CREATE TABLE `PINCHO` (
       `p_id` INT AUTO_INCREMENT,
       `e_username` VARCHAR(300),
       `p_name` VARCHAR(200),
       `p_photo` VARCHAR(300),
       `p_price` FLOAT(3,2),
       `counter` INT,
       PRIMARY KEY(`p_id`),
       FOREIGN KEY(`e_username`) REFERENCES ESTABLISHMENT(`e_username`) ON DELETE CASCADE ON UPDATE CASCADE
);


CREATE TABLE `INGREDIENT` (
       `i_name` VARCHAR(20),
       `allergenic` TINYINT(1),
       PRIMARY KEY(`i_name`)
);


CREATE TABLE `CODE` (
       `p_id` INT,
       `code_num` INT,
       `used` TINYINT(1),
       `winner` TINYINT(1),
       `hash` VARCHAR(32),
       PRIMARY KEY(`p_id`, `code_num`),
       FOREIGN KEY(`p_id`) REFERENCES PINCHO(`p_id`) ON DELETE CASCADE ON UPDATE CASCADE
);


CREATE TABLE `REQUEST` (
       `r_id` INT AUTO_INCREMENT,
       `o_username` VARCHAR(300),
       `address` VARCHAR(100),
       `email` VARCHAR(300),
       `password` VARCHAR(32),
       `e_photo` VARCHAR(300),
       `p_name` VARCHAR(20),
       `p_photo` VARCHAR(300),
       `p_price` FLOAT(3,2),
       `ingredients` VARCHAR(500),
       `state` TINYINT(1),
       PRIMARY KEY(`r_id`),
       FOREIGN KEY(`o_username`) REFERENCES ORGANIZER(`o_username`) ON DELETE CASCADE ON UPDATE CASCADE
);


CREATE TABLE `VOTES` (
       `j_username` VARCHAR(300),
       `p_id` INT,
       `score` INT(5),
       PRIMARY KEY(`j_username`, `p_id`),
       FOREIGN KEY(`j_username`) REFERENCES JUDGE(`j_username`) ON DELETE CASCADE ON UPDATE CASCADE,
       FOREIGN KEY(`p_id`) REFERENCES PINCHO(`p_id`) ON DELETE CASCADE ON UPDATE CASCADE
);


CREATE TABLE `ASSIGNMENT` (
       `j_username` VARCHAR(300),
       `p_id` INT,
       PRIMARY KEY(`j_username`, `p_id`),
       FOREIGN KEY(`j_username`) REFERENCES JUDGE(`j_username`) ON DELETE CASCADE ON UPDATE CASCADE,
       FOREIGN KEY(`p_id`) REFERENCES PINCHO(`p_id`) ON DELETE CASCADE ON UPDATE CASCADE
);


CREATE TABLE `CONTAINS` (
       `p_id` INT,
       `i_name` VARCHAR(20),
       PRIMARY KEY(`p_id`, `i_name`),
       FOREIGN KEY(`p_id`) REFERENCES PINCHO(`p_id`) ON DELETE CASCADE ON UPDATE CASCADE,
       FOREIGN KEY(`i_name`) REFERENCES INGREDIENT(`i_name`) ON DELETE CASCADE ON UPDATE CASCADE
);
