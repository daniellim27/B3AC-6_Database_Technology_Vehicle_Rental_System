-- 1. Retrieve All Available Vehicles
SELECT vehicle_id, brand, model, year, license_plate_number, rental_rate_per_day, vehicle_type
FROM Vehicles
WHERE status_code = 1;

-- 2. View Rentals by Customer
SELECT r.rental_id, r.rental_date, r.return_date, r.total_rental_cost, v.brand, v.model
FROM Rentals r
JOIN Vehicles v ON r.vehicle_id = v.vehicle_id
WHERE r.customer_id = 9001;

-- 3. Update Vehicle Status
UPDATE Vehicles
SET status_code = 2
WHERE vehicle_id = 1001;

-- 4. Create a New Rental
INSERT INTO Rentals (rental_id, customer_id, vehicle_id, employee_id, rental_status_code, rental_date, return_date, total_rental_cost) 
VALUES (4003, 9002, 1003, 8002, 3, '2024-12-02', '2024-12-09', 3850);

-- 5. Retrieve Payment Information
SELECT p.payment_id, p.payment_date, p.payment_amount, p.payment_method
FROM Payments p
WHERE p.rental_id = 4001;

-- 6. View Vehicle Maintenance Records
SELECT m.maintenance_id, m.maintenance_date, m.maintenance_description, m.maintenance_cost
FROM VehicleMaintenance m
WHERE m.vehicle_id = 1002;

-- 7. Delete a Customer
DELETE FROM Customers
WHERE customer_id = 9002;

-- 8. View Insurance Details for a Vehicle
SELECT i.insurance_company, i.insurance_policy_number, i.coverage_start_date, i.coverage_end_date, i.insurance_cost
FROM Insurance i
WHERE i.vehicle_id = 1001;

-- 9. Count Ongoing Rentals
SELECT COUNT(*) AS ongoing_rentals
FROM Rentals
WHERE rental_status_code = 3;

-- 10. Retrieve All Customers
SELECT customer_id, first_name, last_name, email, phone_number
FROM Customers;

-- 11. Retrieve All Reserved Rentals
SELECT r.rental_id, c.first_name, c.last_name, v.brand, v.model, r.rental_date, r.total_rental_cost
FROM Rentals r
JOIN Customers c ON r.customer_id = c.customer_id
JOIN Vehicles v ON r.vehicle_id = v.vehicle_id
WHERE r.rental_status_code = 1;

-- 12. Insert a New Rental
INSERT INTO Rentals (rental_id, customer_id, vehicle_id, employee_id, rental_status_code, rental_date, return_date, total_rental_cost) 
VALUES (4004, 9001, 1002, 8002, 1, '2024-12-10', '2024-12-17', 4200);

-- 13. Update Rental Status to Ongoing
UPDATE Rentals
SET rental_status_code = 2
WHERE rental_id = 4004;

-- 14. Delete a Rental
DELETE FROM Rentals
WHERE rental_id = 4004;

-- 15. Merge Rentals and Payments to View Completed Rentals
SELECT r.rental_id, c.first_name, c.last_name, v.brand, v.model, r.rental_date, r.return_date, p.payment_amount, p.payment_method
FROM Rentals r
JOIN Customers c ON r.customer_id = c.customer_id
JOIN Vehicles v ON r.vehicle_id = v.vehicle_id
LEFT JOIN Payments p ON r.rental_id = p.rental_id
WHERE r.rental_status_code = 3;

-- 16. Retrieve Overdue Rentals
SELECT r.rental_id, c.first_name, c.last_name, v.brand, v.model, r.rental_date, r.return_date
FROM Rentals r
JOIN Customers c ON r.customer_id = c.customer_id
JOIN Vehicles v ON r.vehicle_id = v.vehicle_id
WHERE r.rental_status_code = 2 AND r.return_date < CURDATE();

-- 17. Retrieve Vehicles Currently Rented
SELECT v.vehicle_id, v.brand, v.model, c.first_name, c.last_name, r.rental_date, r.return_date
FROM Rentals r
JOIN Vehicles v ON r.vehicle_id = v.vehicle_id
JOIN Customers c ON r.customer_id = c.customer_id
WHERE r.rental_status_code = 2;

-- 18. Calculate Total Revenue
SELECT SUM(r.total_rental_cost) AS total_revenue
FROM Rentals r
WHERE r.rental_status_code = 3;

-- 19. Check Vehicle Availability for a Date Range
SELECT v.vehicle_id, v.brand, v.model
FROM Vehicles v
WHERE v.vehicle_id = 1001 
  AND NOT EXISTS (
      SELECT 1
      FROM Rentals r
      WHERE r.vehicle_id = v.vehicle_id
        AND r.rental_status_code IN (1, 2) 
        AND (r.rental_date <= '2024-12-15' AND r.return_date >= '2024-12-10')
  );

-- 20. Update Rental Costs Dynamically
UPDATE Rentals
SET total_rental_cost = total_rental_cost + 500
WHERE rental_id = 4001;

-- 21. Retrieve Top Customers by Spending
SELECT c.customer_id, c.first_name, c.last_name, SUM(r.total_rental_cost) AS total_spent
FROM Rentals r
JOIN Customers c ON r.customer_id = c.customer_id
WHERE r.rental_status_code = 3
GROUP BY c.customer_id
ORDER BY total_spent DESC
LIMIT 5;

-- 22. Retrieve Rental History of a Vehicle
SELECT r.rental_id, c.first_name, c.last_name, r.rental_date, r.return_date, r.total_rental_cost
FROM Rentals r
JOIN Customers c ON r.customer_id = c.customer_id
WHERE r.vehicle_id = 1001;

-- 23. Retrieve Rental Status Distribution
SELECT rs.status, COUNT(*) AS rental_count
FROM Rentals r
JOIN RentalStatus rs ON r.rental_status_code = rs.status_code
GROUP BY rs.status;

-- 24. Retrieve Maintenance Costs by Vehicle
SELECT v.vehicle_id, v.brand, v.model, SUM(vm.maintenance_cost) AS total_maintenance_cost
FROM VehicleMaintenance vm
JOIN Vehicles v ON vm.vehicle_id = v.vehicle_id
GROUP BY v.vehicle_id, v.brand, v.model
ORDER BY total_maintenance_cost DESC;

-- 25. Retrieve Vehicles by Popularity
SELECT v.vehicle_id, v.brand, v.model, COUNT(r.rental_id) AS total_rentals
FROM Vehicles v
JOIN Rentals r ON v.vehicle_id = r.vehicle_id
GROUP BY v.vehicle_id, v.brand, v.model
ORDER BY total_rentals DESC
LIMIT 5;
