CREATE SCHEMA library;
USE library;

CREATE TABLE IF NOT EXISTS `books` (
 `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
 `name` VARCHAR(100) NOT NULL,
 `isbn` VARCHAR(100) NOT NULL,
 `category` VARCHAR(100) NOT NULL,
 PRIMARY KEY (`id`)
);

INSERT INTO `books` (`name`, `isbn`, `category`) VALUES
	('What Doctors Dont Get to Study in Medical School', '978-8181914194', 'Medics'),
	('The Arunachal Motorcycle Diaries', '978-1947429208', 'Motorcycles'),
	('The Swastika Killer', '978-9385152900', 'Politics'),
	('Think and Grow Rich', '978-8192910918', 'Personal Development'),
	('The C Programming Language', '978-8131704943', 'Programming'),
	('Music To Flame Lilies', '978-8183861625', 'Music');