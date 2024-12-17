



CREATE DATABASE lwbase;

USE lwbase;


CREATE TABLE users(
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    FirstName varchar(250) NOT NULL,
    LastName  varchar(250) NOT NULL,
    DateOFBirth date NOT NULL,
    Date_joined DATE DEFAULT CURRENT_DATE,
    city varchar(250),
    email varchar(250) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('client', 'lawyer', 'admin') NOT NULL,
    address TEXT,
    token_auth TEXT,
    phone_number VARCHAR(30),
    pfp VARCHAR(255)
);

CREATE TABLE lawyerSub(

    lawyerSub_ID INT AUTO_INCREMENT PRIMARY KEY,
    speciality varchar(250) NOT NULL,
    lw_ID INT NOT NULL,
    res_price FLOAT NOT NULL,
    FOREIGN KEY (lw_ID) REFERENCES users(user_id)

);

CREATE TABLE n_Avaibility(

    n_av_ID INT AUTO_INCREMENT PRIMARY KEY,
    selected_date DATE NOT NULL,
    lw_ID INT NOT NULL,
    FOREIGN KEY (lw_ID) REFERENCES users(user_id)

);

CREATE TABLE reservations(
    resID INT AUTO_INCREMENT PRIMARY KEY,
    lw_ID INT NOT NULL,
    client_ID INT NOT NULL,
    res_date DATE NOT NULL,
    price FLOAT NOT NULL,
    status ENUM('pending', 'confirmed', 'canceled') DEFAULT 'pending',
    FOREIGN KEY (lw_ID) REFERENCES users(user_id),
    FOREIGN KEY (client_ID) REFERENCES users(user_id)
);


CREATE TABLE reviews (
    review_ID INT AUTO_INCREMENT PRIMARY KEY,
    lw_ID INT NOT NULL,
    client_ID INT NOT NULL,
    rating INT CHECK (rating >= 1 AND rating <= 5),
    comment TEXT,
    review_date DATE DEFAULT CURRENT_DATE,
    FOREIGN KEY (lw_ID) REFERENCES users(user_id) ON DELETE CASCADE,
    FOREIGN KEY (client_ID) REFERENCES users(user_id) ON DELETE CASCADE
);
