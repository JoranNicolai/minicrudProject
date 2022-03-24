
CREATE TABLE `producten` (
  `id` int(8) NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `image` text NOT NULL,
  `price` double(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


INSERT INTO `producten` (`id`, `name`, `code`, `image`, `price`) VALUES
(1, 'Griekse Yoghurt', 'GY', '/pictures/griekse_yoghurt.jpg', 7.50),
(2, 'American Pancakes', 'AP', '/pictures/american Pancakes.jpg', 9.90),
(3, 'Monsieur', 'MR', '/pictures/monsieur.jpg', 7.90),
(4, 'Madame', 'ME', '/pictures/Madame.jpg', 8.50),
(5, 'Vega', 'VA', '/pictures/vega.jpg', 8.90),
(6, 'Tuna Melt', 'TT', '/pictures/tunamelt.jpg', 8.90),
(7, 'Pomodori Soep', 'PP', '/pictures/PomodoriSoep.jpg', 6.90),
(8, 'Franse Uiensoep', 'FP', '/pictures/FranseUiensoep.jpg', 6.90);


ALTER TABLE `producten`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_code` (`code`);


ALTER TABLE `producten`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;