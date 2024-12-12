CREATE TABLE VehicleStatus (
    status_code INT(1) PRIMARY KEY CHECK (status_code IN (1, 2, 3)),
    status VARCHAR(35) NOT NULL
);

CREATE TABLE Vehicles (
    vehicle_id INT(4) PRIMARY KEY CHECK (vehicle_id >= 1001),
    status_code INT(1),
    brand VARCHAR(35) NOT NULL,
    model VARCHAR(35) NOT NULL,
    year YEAR NOT NULL,
    license_plate_number VARCHAR(10) NOT NULL,
    rental_rate_per_day INT(9) NOT NULL,
    vehicle_type VARCHAR(35),
    vehicle_image BLOB,
    FOREIGN KEY (status_code) REFERENCES VehicleStatus(status_code)
);

CREATE TABLE Insurance (
    insurance_id INT(4) PRIMARY KEY CHECK (insurance_id >= 3001),
    vehicle_id INT(4),
    insurance_company VARCHAR(35) NOT NULL,
    insurance_policy_number INT(20) NOT NULL,
    coverage_start_date DATE NOT NULL,
    coverage_end_date DATE NOT NULL,
    insurance_cost INT(9) NOT NULL,
    FOREIGN KEY (vehicle_id) REFERENCES Vehicles(vehicle_id)
);

CREATE TABLE VehicleMaintenance (
    maintenance_id INT(4) PRIMARY KEY CHECK (maintenance_id >= 2001),
    vehicle_id INT(4),
    maintenance_date DATE NOT NULL,
    maintenance_description VARCHAR(100) NOT NULL,
    maintenance_cost INT(10) NOT NULL,
    FOREIGN KEY (vehicle_id) REFERENCES Vehicles(vehicle_id)
);

CREATE TABLE Employees (
    employee_id INT(4) PRIMARY KEY CHECK (employee_id >= 8001),
    first_name VARCHAR(35) NOT NULL,
    last_name VARCHAR(35) NOT NULL,
    email VARCHAR(220) NOT NULL,
    phone_number VARCHAR(13) NOT NULL,
    role VARCHAR(35) NOT NULL,
    salary INT(10) NOT NULL
);

CREATE TABLE Customers (
    customer_id INT(4) PRIMARY KEY CHECK (customer_id >= 9001),
    first_name VARCHAR(35) NOT NULL,
    last_name VARCHAR(35) NOT NULL,
    email VARCHAR(320) NOT NULL,
    phone_number VARCHAR(13) NOT NULL,
    address VARCHAR(35) NOT NULL,
    driver_license_number INT(14) NOT NULL,
    date_of_birth DATE NOT NULL
);

CREATE TABLE RentalStatus (
    status_code INT(1) PRIMARY KEY CHECK (status_code IN (1, 2, 3)),
    status VARCHAR(35) NOT NULL
);

CREATE TABLE Rentals (
    rental_id INT(4) PRIMARY KEY CHECK (rental_id >= 4001),
    customer_id INT(4),
    vehicle_id INT(4),
    employee_id INT(4),
    rental_status_code INT(1),
    rental_date DATE NOT NULL,
    return_date DATE,
    total_rental_cost INT(12),
    FOREIGN KEY (customer_id) REFERENCES Customers(customer_id),
    FOREIGN KEY (vehicle_id) REFERENCES Vehicles(vehicle_id),
    FOREIGN KEY (employee_id) REFERENCES Employees(employee_id),
    FOREIGN KEY (rental_status_code) REFERENCES RentalStatus(status_code)
);

CREATE TABLE Payments (
    payment_id INT(4) PRIMARY KEY CHECK (payment_id >= 5001),
    rental_id INT(4),
    payment_date DATE NOT NULL,
    payment_amount INT(9) NOT NULL,
    payment_method VARCHAR(35) NOT NULL,
    FOREIGN KEY (rental_id) REFERENCES Rentals(rental_id)
);