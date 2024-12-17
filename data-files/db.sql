



CREATE DATABASE lwbase;

USE lwbase;


CREATE TABLE users(
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    FirstName varchar(250) NOT NULL,
    LastName  varchar(250) NOT NULL,
    DateOFBirth date NOT NULL,
    Date_joined date,
    city varchar(250),
    email varchar(250) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('client', 'lawyer', 'admin') NOT NULL,
    address TEXT,
    token_auth TEXT,
    phone_number INT,
    pfp TEXT
);