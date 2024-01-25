CREATE TABLE users (
    user_id int PRIMARY KEY NOT NULL AUTO_INCREMENT,
    name varchar(20) NOT NULL ,
    email varchar(30) NOT NULL ,
    password varchar(255) NOT NULL
);

CREATE TABLE clients (
    company_id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    company_name VARCHAR(30) NOT NULL,
    contact_person VARCHAR(30) NOT NULL,
    phone VARCHAR(15),
    address VARCHAR(30),
    created_by INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    edited_at TIMESTAMP,
    FOREIGN KEY (created_by) REFERENCES users(user_id)
);

INSERT INTO users (name, email, password)
VALUES ('Rijad', 'rb@cb.at', 'pass');

SELECT * FROM users;

INSERT INTO clients (company_name, contact_person, phone, address, created_by)
VALUES ('Fabasoft', 'Robin Schmeisser', '07352 88 22', 'Hauptstraße 33', 1);

SELECT * FROM clients;

UPDATE clients
SET phone = '07352 22 33', edited_at = CURRENT_TIMESTAMP
WHERE company_name = 'Fabasoft';