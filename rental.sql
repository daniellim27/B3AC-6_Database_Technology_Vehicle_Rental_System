-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.3.35-MariaDB-log - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table free_rental.customers
CREATE TABLE IF NOT EXISTS `customers` (
  `customer_id` int(4) NOT NULL CHECK (`customer_id` >= 9001),
  `first_name` varchar(35) NOT NULL,
  `last_name` varchar(35) NOT NULL,
  `email` varchar(320) NOT NULL,
  `phone_number` varchar(13) NOT NULL,
  `address` varchar(35) NOT NULL,
  `driver_license_number` varchar(14) NOT NULL DEFAULT '',
  `date_of_birth` date NOT NULL,
  PRIMARY KEY (`customer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table free_rental.customers: ~2 rows (approximately)
REPLACE INTO `customers` (`customer_id`, `first_name`, `last_name`, `email`, `phone_number`, `address`, `driver_license_number`, `date_of_birth`) VALUES
	(9001, 'Alice', 'Brown', 'alice.brown@example.com', '08123456789', 'Jakarta', '12345678901234', '1990-05-15'),
	(9002, 'Bob', 'Green', 'bob.green@example.com', '08198765432', 'Surabaya', '98765432109876', '1985-10-22');

-- Dumping structure for table free_rental.employees
CREATE TABLE IF NOT EXISTS `employees` (
  `employee_id` int(4) NOT NULL CHECK (`employee_id` >= 8001),
  `first_name` varchar(35) NOT NULL,
  `last_name` varchar(35) NOT NULL,
  `email` varchar(220) NOT NULL,
  `phone_number` varchar(13) NOT NULL,
  `role` varchar(35) NOT NULL,
  `salary` int(10) NOT NULL,
  PRIMARY KEY (`employee_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table free_rental.employees: ~2 rows (approximately)
REPLACE INTO `employees` (`employee_id`, `first_name`, `last_name`, `email`, `phone_number`, `role`, `salary`) VALUES
	(8001, 'Jane', 'Smith', 'jane.smith@example.com', '08123456789', 'Manager', 5000000),
	(8002, 'John', 'Doe', 'john.doe@example.com', '08198765432', 'Staff', 3000000);

-- Dumping structure for table free_rental.insurance
CREATE TABLE IF NOT EXISTS `insurance` (
  `insurance_id` int(4) NOT NULL CHECK (`insurance_id` >= 3001),
  `vehicle_id` int(4) DEFAULT NULL,
  `insurance_company` varchar(35) NOT NULL,
  `insurance_policy_number` int(20) NOT NULL,
  `coverage_start_date` date NOT NULL,
  `coverage_end_date` date NOT NULL,
  `insurance_cost` int(9) NOT NULL,
  PRIMARY KEY (`insurance_id`),
  KEY `vehicle_id` (`vehicle_id`),
  CONSTRAINT `insurance_ibfk_1` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`vehicle_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table free_rental.insurance: ~2 rows (approximately)
REPLACE INTO `insurance` (`insurance_id`, `vehicle_id`, `insurance_company`, `insurance_policy_number`, `coverage_start_date`, `coverage_end_date`, `insurance_cost`) VALUES
	(3001, 1001, 'ABC Insurance', 123456789, '2024-01-01', '2024-12-31', 1000),
	(3002, 1002, 'XYZ Insurance', 987654321, '2024-02-01', '2024-12-31', 1200),
	(3610, 1004, 'Turner, Lemke and Beahan', 13, '2024-02-11', '2025-09-13', 437);

-- Dumping structure for table free_rental.payments
CREATE TABLE IF NOT EXISTS `payments` (
  `payment_id` int(4) NOT NULL CHECK (`payment_id` >= 5001),
  `rental_id` int(4) DEFAULT NULL,
  `payment_date` date NOT NULL,
  `payment_amount` int(9) NOT NULL,
  `payment_method` varchar(35) NOT NULL,
  PRIMARY KEY (`payment_id`),
  KEY `rental_id` (`rental_id`),
  CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`rental_id`) REFERENCES `rentals` (`rental_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table free_rental.payments: ~1 rows (approximately)
REPLACE INTO `payments` (`payment_id`, `rental_id`, `payment_date`, `payment_amount`, `payment_method`) VALUES
	(5001, 4001, '2024-12-03', 3500, 'Credit Card'),
	(5034, 4003, '2025-09-22', 327, 'Debit Card');

-- Dumping structure for table free_rental.rentals
CREATE TABLE IF NOT EXISTS `rentals` (
  `rental_id` int(4) NOT NULL CHECK (`rental_id` >= 4001),
  `customer_id` int(4) DEFAULT NULL,
  `vehicle_id` int(4) DEFAULT NULL,
  `employee_id` int(4) DEFAULT NULL,
  `rental_status_code` int(1) DEFAULT NULL,
  `rental_date` date NOT NULL,
  `return_date` date DEFAULT NULL,
  `total_rental_cost` int(12) DEFAULT NULL,
  PRIMARY KEY (`rental_id`),
  KEY `customer_id` (`customer_id`),
  KEY `vehicle_id` (`vehicle_id`),
  KEY `employee_id` (`employee_id`),
  KEY `rental_status_code` (`rental_status_code`),
  CONSTRAINT `rentals_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`),
  CONSTRAINT `rentals_ibfk_2` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`vehicle_id`),
  CONSTRAINT `rentals_ibfk_3` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`employee_id`),
  CONSTRAINT `rentals_ibfk_4` FOREIGN KEY (`rental_status_code`) REFERENCES `rentalstatus` (`status_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table free_rental.rentals: ~2 rows (approximately)
REPLACE INTO `rentals` (`rental_id`, `customer_id`, `vehicle_id`, `employee_id`, `rental_status_code`, `rental_date`, `return_date`, `total_rental_cost`) VALUES
	(4001, 9001, 1001, 8001, 3, '2024-12-01', '2024-12-07', 3500),
	(4002, 9002, 1002, 8002, 1, '2024-12-02', NULL, NULL),
	(4003, 9002, 1003, 8002, 1, '2024-12-05', '2024-12-26', 200);

-- Dumping structure for table free_rental.rentalstatus
CREATE TABLE IF NOT EXISTS `rentalstatus` (
  `status_code` int(1) NOT NULL CHECK (`status_code` in (1,2,3)),
  `status` varchar(35) NOT NULL,
  PRIMARY KEY (`status_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table free_rental.rentalstatus: ~3 rows (approximately)
REPLACE INTO `rentalstatus` (`status_code`, `status`) VALUES
	(1, 'Reserved'),
	(2, 'Ongoing'),
	(3, 'Completed');

-- Dumping structure for table free_rental.vehiclemaintenance
CREATE TABLE IF NOT EXISTS `vehiclemaintenance` (
  `maintenance_id` int(4) NOT NULL CHECK (`maintenance_id` >= 2001),
  `vehicle_id` int(4) DEFAULT NULL,
  `maintenance_date` date NOT NULL,
  `maintenance_description` varchar(100) NOT NULL,
  `maintenance_cost` int(10) NOT NULL,
  PRIMARY KEY (`maintenance_id`),
  KEY `vehicle_id` (`vehicle_id`),
  CONSTRAINT `vehiclemaintenance_ibfk_1` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`vehicle_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table free_rental.vehiclemaintenance: ~2 rows (approximately)
REPLACE INTO `vehiclemaintenance` (`maintenance_id`, `vehicle_id`, `maintenance_date`, `maintenance_description`, `maintenance_cost`) VALUES
	(2001, 1002, '2024-11-01', 'Oil Change', 200),
	(2002, 1003, '2024-11-15', 'Brake Check', 300),
	(2066, 1002, '2024-11-14', 'Nulla ipsam minima sequi voluptatem.', 455);

-- Dumping structure for table free_rental.vehicles
CREATE TABLE IF NOT EXISTS `vehicles` (
  `vehicle_id` int(4) NOT NULL CHECK (`vehicle_id` >= 1001),
  `status_code` int(1) DEFAULT NULL,
  `brand` varchar(35) NOT NULL,
  `model` varchar(35) NOT NULL,
  `year` year(4) NOT NULL,
  `license_plate_number` varchar(10) NOT NULL,
  `rental_rate_per_day` int(9) NOT NULL,
  `vehicle_type` varchar(35) DEFAULT NULL,
  `vehicle_image` blob DEFAULT NULL,
  PRIMARY KEY (`vehicle_id`),
  KEY `status_code` (`status_code`),
  CONSTRAINT `vehicles_ibfk_1` FOREIGN KEY (`status_code`) REFERENCES `vehiclestatus` (`status_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table free_rental.vehicles: ~4 rows (approximately)
REPLACE INTO `vehicles` (`vehicle_id`, `status_code`, `brand`, `model`, `year`, `license_plate_number`, `rental_rate_per_day`, `vehicle_type`, `vehicle_image`) VALUES
	(1001, 1, 'Toyota', 'Corolla', '2022', 'AB1234CD', 500, 'Sedan', _binary 0x746f796f74612d636f726f6c6c612d616c7469732d636f6c6f722d3432323837322e6a7067),
	(1002, 2, 'Honda', 'Civic', '2021', 'EF5678GH', 600, 'SUV', _binary 0x686f6e64612d616c6c2d6e65772d63697669632e6a7067),
	(1003, 1, 'Ford', 'Focus', '2023', 'IJ9012KL', 550, 'Hatchback', _binary 0x666f72642d666f6375732e6a7067),
	(1004, 1, 'Toyota', 'Calya', '2021', 'B2123CS', 200, 'MVP', _binary 0x746f796f74612d63616c79612d636f6c6f722d3835383638352e6a7067);

-- Dumping structure for table free_rental.vehiclestatus
CREATE TABLE IF NOT EXISTS `vehiclestatus` (
  `status_code` int(1) NOT NULL CHECK (`status_code` in (1,2,3)),
  `status` varchar(35) NOT NULL,
  PRIMARY KEY (`status_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table free_rental.vehiclestatus: ~3 rows (approximately)
REPLACE INTO `vehiclestatus` (`status_code`, `status`) VALUES
	(1, 'Available'),
	(2, 'Unavailable'),
	(3, 'Under Maintenance');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
