SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT = @@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS = @@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION = @@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

CREATE TABLE IF NOT EXISTS `producten`
(
    `id`    int(11)       NOT NULL AUTO_INCREMENT,
    `name`  varchar(255)  NOT NULL,
    `image` varchar(255)  NOT NULL,
    `price` double(10, 2) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE = MyISAM
  DEFAULT CHARSET = latin1
  AUTO_INCREMENT = 10;



INSERT INTO `producten` (`id`, `name`, `image`, `price`)
VALUES (1, 'Sushi Zalm', 'eten1.jpg', 14.99),
       (2, 'Sushi Dragonball', 'eten2.jpg', 19.99),
       (3, 'Sushi Tonijn', 'eten3.jpg', 3.99),
       (4, 'Loempia 3x', 'eten4.jpg', 9.99);

/*!40101 SET CHARACTER_SET_CLIENT = @OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS = @OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION = @OLD_COLLATION_CONNECTION */;
