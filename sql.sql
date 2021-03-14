-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               5.7.24 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             11.0.0.5919
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for evropat_test
CREATE DATABASE IF NOT EXISTS `evropat_test` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `evropat_test`;

-- Dumping structure for table evropat_test.employees
CREATE TABLE IF NOT EXISTS `employees` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_number` varchar(20) NOT NULL DEFAULT '',
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `office_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `user_number` (`user_number`) USING BTREE,
  KEY `FK_employees_offices` (`office_id`),
  CONSTRAINT `FK_employees_offices` FOREIGN KEY (`office_id`) REFERENCES `offices` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.

-- Dumping structure for procedure evropat_test.insert_Or_Update_Vehicle
DELIMITER //
CREATE PROCEDURE `insert_Or_Update_Vehicle`(
	IN `vehicle_id_In` INT(11),
	IN `brand_In` VARCHAR(255),
	IN `model_In` VARCHAR(255),
	IN `regnumber_In` VARCHAR(255),
	IN `fuelconsumption_In` DECIMAL(5,2),
	IN `office_id_In` INT(10),
	IN `employee_id_In` INT(10)
)
BEGIN
	IF vehicle_id_In IS NULL THEN
		INSERT INTO vehicles (brand, model, reg_number, fuel_consumption, office_id, employee_id)
		VALUES (brand_In, model_In, regnumber_In, fuelconsumption_In, office_id_In, employee_id_In);
        
        SELECT @id := LAST_INSERT_ID();
        
        INSERT INTO vehicles_employee_history (vehicle_id, employee_id, datetime_start, datetime_end)
		VALUES (@id, employee_id_In, NOW(), NULL);
	ELSE
	 SELECT @old_driver := employee_id
		  FROM vehicles_employee_history
		  WHERE vehicle_id = vehicle_id_In AND datetime_end IS NULL;
		  
		UPDATE vehicles
		SET brand = brand_In,
			model = model_In,
			reg_number = regnumber_In,
			fuel_consumption = fuelconsumption_In,
			office_id = office_id_In,
			employee_id = employee_id_In
		WHERE id = vehicle_id_In;
        		 
		  if (@old_driver != employee_id_In) then
		  
		  
	        UPDATE vehicles_employee_history
	        SET datetime_end = NOW()
	        WHERE vehicle_id = vehicle_id_In AND datetime_end IS NULL;
	        
	        INSERT INTO vehicles_employee_history (vehicle_id, employee_id, datetime_start, datetime_end)
	        VALUES (vehicle_id_In, employee_id_In, NOW(), NULL);
        
        END if;        
		
    end if;
END//
DELIMITER ;

-- Dumping structure for table evropat_test.offices
CREATE TABLE IF NOT EXISTS `offices` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `office_name` varchar(100) NOT NULL,
  `manager` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `working_hours` varchar(255) NOT NULL,
  `town_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_offices_towns` (`town_id`),
  CONSTRAINT `FK_offices_towns` FOREIGN KEY (`town_id`) REFERENCES `towns` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.

-- Dumping structure for table evropat_test.offices_towns
CREATE TABLE IF NOT EXISTS `offices_towns` (
  `office_id` int(11) unsigned NOT NULL,
  `town_id` int(11) unsigned NOT NULL,
  KEY `FK__towns` (`town_id`),
  KEY `FK__offices` (`office_id`),
  CONSTRAINT `FK__offices` FOREIGN KEY (`office_id`) REFERENCES `offices` (`id`),
  CONSTRAINT `FK__towns` FOREIGN KEY (`town_id`) REFERENCES `towns` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.

-- Dumping structure for view evropat_test.office_to_town
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `office_to_town` (
	`office_id` INT(11) UNSIGNED NOT NULL,
	`office_name` VARCHAR(100) NOT NULL COLLATE 'utf8_general_ci',
	`address` VARCHAR(202) NOT NULL COLLATE 'utf8_general_ci',
	`town_id` INT(11) UNSIGNED NOT NULL,
	`town_name` VARCHAR(100) NOT NULL COLLATE 'utf8_general_ci'
) ENGINE=MyISAM;

-- Dumping structure for table evropat_test.towns
CREATE TABLE IF NOT EXISTS `towns` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `province` varchar(100) NOT NULL,
  `municipality` varchar(100) NOT NULL,
  `postcode` varchar(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `post_code` (`postcode`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.

-- Dumping structure for table evropat_test.vehicles
CREATE TABLE IF NOT EXISTS `vehicles` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `brand` varchar(255) NOT NULL,
  `model` varchar(255) NOT NULL,
  `reg_number` varchar(255) NOT NULL,
  `fuel_consumption` decimal(5,2) NOT NULL,
  `office_id` int(10) unsigned NOT NULL,
  `employee_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `registration_number` (`reg_number`) USING BTREE,
  KEY `FK_vehicles_offices` (`office_id`),
  KEY `FK_vehicles_employees` (`employee_id`),
  CONSTRAINT `FK_vehicles_employees` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`),
  CONSTRAINT `FK_vehicles_offices` FOREIGN KEY (`office_id`) REFERENCES `offices` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.

-- Dumping structure for table evropat_test.vehicles_employee_history
CREATE TABLE IF NOT EXISTS `vehicles_employee_history` (
  `vehicle_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `datetime_start` datetime NOT NULL,
  `datetime_end` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.

-- Dumping structure for view evropat_test.office_to_town
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `office_to_town`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `office_to_town` AS SELECT 
        `o`.`id` AS `office_id`,
        `o`.`office_name` AS `office_name`,
        CONCAT(`t2`.`name`, ', ', `o`.`address`) AS `address`,
        `t`.`id` AS `town_id`,
        `t`.`name` AS `town_name`
    FROM
        (((`offices_towns` `s`
        JOIN `offices` `o` ON ((`s`.`office_id` = `o`.`id`)))
        JOIN `towns` `t2` ON ((`o`.`town_id` = `t2`.`id`)))
        JOIN `towns` `t` ON ((`s`.`town_id` = `t`.`id`))) ;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
