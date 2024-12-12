-- Insert Data into VehicleStatus Table
INSERT INTO VehicleStatus (status_code, status) VALUES 
(1, 'Available'), 
(2, 'Unavailable'), 
(3, 'Under Maintenance');

-- Insert Data into Vehicles Table
INSERT INTO Vehicles (vehicle_id, status_code, brand, model, year, license_plate_number, rental_rate_per_day, vehicle_type) 
VALUES 
(1001, 1, 'Toyota', 'Corolla', 2022, 'AB1234CD', 500, 'Sedan'),
(1002, 2, 'Honda', 'Civic', 2021, 'EF5678GH', 600, 'SUV'),
(1003, 1, 'Ford', 'Focus', 2023, 'IJ9012KL', 550, 'Hatchback');

-- Insert Data into Insurance Table
INSERT INTO Insurance (insurance_id, vehicle_id, insurance_company, insurance_policy_number, coverage_start_date, coverage_end_date, insurance_cost) 
VALUES 
(3001, 1001, 'ABC Insurance', 123456789, '2024-01-01', '2024-12-31', 1000),
(3002, 1002, 'XYZ Insurance', 987654321, '2024-02-01', '2024-12-31', 1200);

-- Insert Data into VehicleMaintenance Table
INSERT INTO VehicleMaintenance (maintenance_id, vehicle_id, maintenance_date, maintenance_description, maintenance_cost) 
VALUES 
(2001, 1002, '2024-11-01', 'Oil Change', 200),
(2002, 1003, '2024-11-15', 'Brake Check', 300);

-- Insert Data into Employees Table
INSERT INTO Employees (employee_id, first_name, last_name, email, phone_number, role, salary) 
VALUES 
(8001, 'Jane', 'Smith', 'jane.smith@example.com', '08123456789', 'Manager', 5000000),
(8002, 'John', 'Doe', 'john.doe@example.com', '08198765432', 'Staff', 3000000);

-- Insert Data into Customers Table
INSERT INTO Customers (customer_id, first_name, last_name, email, phone_number, address, driver_license_number, date_of_birth) 
VALUES 
(9001, 'Alice', 'Brown', 'alice.brown@example.com', '08123456789', 'Jakarta', 12345678901234, '1990-05-15'),
(9002, 'Bob', 'Green', 'bob.green@example.com', '08198765432', 'Surabaya', 98765432109876, '1985-10-22');

-- Insert Data into RentalStatus Table
INSERT INTO RentalStatus (status_code, status) VALUES 
(1, 'Reserved'), 
(2, 'Ongoing'), 
(3, 'Completed');

-- Insert Data into Rentals Table
INSERT INTO Rentals (rental_id, customer_id, vehicle_id, employee_id, rental_status_code, rental_date, return_date, total_rental_cost) 
VALUES 
(4001, 9001, 1001, 8001, 3, '2024-12-01', '2024-12-07', 3500),
(4002, 9002, 1002, 8002, 1, '2024-12-02', NULL, NULL);

-- Insert Data into Payments Table
INSERT INTO Payments (payment_id, rental_id, payment_date, payment_amount, payment_method) 
VALUES 
(5001, 4001, '2024-12-03', 3500, 'Credit Card');
