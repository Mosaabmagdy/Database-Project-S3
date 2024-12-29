-- Create tables for the Car Rental System

CREATE TABLE cars (
    id INT PRIMARY KEY AUTO_INCREMENT,
    model VARCHAR(255) NOT NULL,
    brand varchar(255) NOT NULL,
    plate_id VARCHAR(255) UNIQUE NOT NULL,
    `status` ENUM ('active', 'out of service', 'rented') NOT NULL,
    image_url varchar(255),
    created_at timestamp not null DEFAULT CURRENT_TIMESTAMP,
    office_id INT,
    FOREIGN KEY (office_id) REFERENCES offices(office_id) ON DELETE SET NULL
);

CREATE TABLE customers (
    id INT PRIMARY KEY AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    `password` varchar(255),
    created_at timestamp not null DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE reservations (
    reservation_id INT PRIMARY KEY AUTO_INCREMENT,
    car_id INT NOT NULL,
    customer_id INT NOT NULL,
    total_amount decimal(10,2) not null,
    rent_start_date DATE NOT NULL,
    rent_end_date DATE NOT NULL,
    created_at timestamp not null DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (car_id) REFERENCES cars(id) ON DELETE CASCADE,
    FOREIGN KEY (customer_id) REFERENCES customers(id) ON DELETE CASCADE
);

CREATE TABLE payments (
    payment_id INT PRIMARY KEY AUTO_INCREMENT,
    reservation_id INT NOT NULL,
    amount DECIMAL(10, 2) NOT NULL,
    payment_date DATE NOT NULL,
    FOREIGN KEY (reservation_id) REFERENCES reservations(reservation_id) ON DELETE CASCADE
);

CREATE TABLE offices (
    office_id INT PRIMARY KEY AUTO_INCREMENT,
    office_location VARCHAR(255) ENUM('NorthAmerica_NewYork','Asia_Riyadh','SouthAmerica_Rio de Janeiro','Africa_Cairo','Europe_Munich','Australia_Sydney') NOT NULL
);


-- Insert Sample Data into Cars Table
INSERT INTO cars (model, brand, plate_id, `status`, image_url, office_id)
VALUES
('Model S', 'Tesla', 'ABC123', 'active', 'https://example.com/images/tesla-model-s.jpg', 1),
('Civic', 'Honda', 'XYZ789', 'rented', 'https://example.com/images/honda-civic.jpg', 2),
('Corolla', 'Toyota', 'TOY567', 'out of service', 'https://example.com/images/toyota-corolla.jpg', 3)


INSERT INTO customers (`name`, email, `password`)
VALUES
('John Doe', 'johndoe@example.com', 'password123'),
('Jane Smith', 'janesmith@example.com', 'securePass!'),
('Michael Brown', 'michael.brown@example.com', 'michael2024'),
('Emily Johnson', 'emily.johnson@example.com', 'passEmily2023'),
('David Lee', 'david.lee@example.com', NULL)


INSERT INTO reservations (car_id, customer_id, total_amount, rent_start_date, rent_end_date)
VALUES
(1, 1, 500.00, '2024-12-01', '2024-12-07'), -- Tesla rented by John Doe
(2, 2, 300.50, '2024-12-03', '2024-12-05'), -- Honda Civic rented by Jane Smith
(3, 3, 750.75, '2024-12-10', '2024-12-15') -- Toyota Corolla rented by Michael Brown


INSERT INTO payments (reservation_id, amount, payment_date)
VALUES
(1, 250.00, '2024-12-15'), -- Payment for reservation 1
(2, 500.50, '2024-12-16'), -- Payment for reservation 2
(3, 150.75, '2024-12-17') -- Payment for reservation 3

INSERT INTO offices (office_id, office_location) 
VALUES 
(1, 'Downtown Branch'),
(2, 'Airport Branch'),
(3, 'Suburban Branch');

