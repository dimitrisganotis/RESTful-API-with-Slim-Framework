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
	('PHP', 'bk001', 'Server Side'),
	('Javascript', 'bk002', 'Client Side'),
	('Python', 'bk003', 'Programing Language'),
	('Git', 'bk004', 'Version-Control System'),
	('XML', 'bk005', 'Markup Language'),
	('HTML', 'bk006', 'Markup Language');