-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jul 22, 2022 at 07:15 PM
-- Server version: 5.7.34
-- PHP Version: 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `to_do`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(10) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `log` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `email`, `log`) VALUES
(2, 'admin', 'admin', 'admin@admin.com', '');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(10) NOT NULL,
  `url` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `url`) VALUES
(1, 'https://images.unsplash.com/photo-1542351567-cd7b06dc08d7?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxleHBsb3JlLWZlZWR8M3x8fGVufDB8fHx8&w=1000&q=80'),
(7, 'https://wallpaperaccess.com/full/959295.jpg'),
(8, 'https://wallpaperaccess.com/full/969802.jpg'),
(9, 'https://wallpaperaccess.com/full/969654.jpg'),
(10, 'https://wallpaperaccess.com/full/3734236.jpg'),
(11, 'https://wallpaperaccess.com/full/969778.jpg'),
(12, 'https://wallpaperaccess.com/full/969765.jpg'),
(13, 'https://wallpaperaccess.com/full/31189.jpg'),
(14, 'https://wallpaperaccess.com/full/31242.jpg'),
(15, 'https://wallpaperaccess.com/full/862994.jpg'),
(16, 'https://cutewallpaper.org/23/4k-resolution-wallpaper-nature/516224927.jpg'),
(17, 'https://wallpaperaccess.com/full/7300550.jpg'),
(18, 'https://cdn.wallpapersafari.com/58/76/BeYuP3.jpg'),
(19, 'https://wallpaperaccess.com/full/2180654.jpg'),
(20, 'https://cdn.wallpapersafari.com/39/71/oEmkIp.jpg'),
(21, 'https://4.bp.blogspot.com/-fG9D2IdRNpA/XGso0zV7vbI/AAAAAAAACns/Aia8BVOeWMY38ICj65UynR510iumuD3qQCKgBGAs/w0/mountain-lake-nature-forest-landscape-scenery-4K-157.jpg'),
(22, 'https://wallpaperaccess.com/full/1945852.jpg'),
(23, 'https://wallpaperaccess.com/full/8177137.jpg'),
(24, 'https://wallpaperaccess.com/full/8177137.jpg'),
(25, 'https://wallpapers-hub.art/wallpaper-images/112719.jpg'),
(26, 'https://wallpapers-hub.art/wallpaper-images/49865.jpg'),
(27, 'https://free4kwallpapers.com/uploads/originals/2021/09/20/beautiful-landscape.-wallpaper_.jpg'),
(28, 'https://wallpaper-mania.com/wp-content/uploads/2018/09/High_resolution_wallpaper_background_ID_77701301146.jpg'),
(29, 'https://wallpapers-hub.art/wallpaper-images/516842.jpg'),
(30, 'https://wallpaperaccess.com/full/959304.jpg'),
(31, 'https://wallpapercave.com/wp/wp7963274.jpg'),
(32, 'https://cutewallpaper.org/22/4k-spring-wallpapers/spring-landscape-4k-wallpapers-top-free-spring-landscape-4k-backgrounds--wallpaperaccess.jpg'),
(33, 'https://cdn.wallpapersafari.com/5/24/IvSYOt.jpg'),
(34, 'https://wallpaperaccess.com/full/5815860.jpg'),
(35, 'https://wallpaperaccess.com/full/196766.jpg'),
(36, 'https://cdn.wallpapersafari.com/88/66/Uowyg0.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `quotes`
--

CREATE TABLE `quotes` (
  `id` int(10) NOT NULL,
  `content` text NOT NULL,
  `author` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `quotes`
--

INSERT INTO `quotes` (`id`, `content`, `author`) VALUES
(2, 'The secret of your future is hidden in your daily routine.', 'Mike Murdock'),
(5, '“So many books, so little time.”', 'Frank Zappa'),
(6, '“A room without books is like a body without a soul.”', 'Marcus Tullius Cicero'),
(7, '“You only live once, but if you do it right, once is enough.”', 'Mae West'),
(8, '“Be the change that you wish to see in the world.”', 'Mahatma Gandhi'),
(9, '“There are only two ways to live your life. One is as though nothing is a miracle. The other is as though everything is a miracle.”', 'Albert Einstein'),
(10, '“The fool doth think he is wise, but the wise man knows himself to be a fool.”', 'William Shakespeare'),
(11, '“I am enough of an artist to draw freely upon my imagination. Imagination is more important than knowledge. Knowledge is limited. Imagination encircles the world.”', 'Albert Einstein'),
(12, '“Love all, trust a few, do wrong to none.”', 'William Shakespeare'),
(13, '\"The purpose of our lives is to be happy.\"', 'Dalai Lama'),
(14, '\"Life is what happens when you\'re busy making other plans.\"', 'John Lennon'),
(15, '\"You only live once, but if you do it right, once is enough.\"', 'Mae West'),
(16, '\"Your time is limited, so don’t waste it living someone else’s life. Don’t be trapped by dogma – which is living with the results of other people’s thinking.\"', 'Steve Jobs'),
(17, '“The whole secret of a successful life is to find out what is one’s destiny to do, and then do it.”', ' Henry Ford'),
(18, '“The best way to predict the future is to invent it.”', 'Alan Kay'),
(19, '“What you do makes a difference, and you have to decide what kind of difference you want to make.” ', 'Jane Goodall'),
(20, '“Strive not to be a success, but rather to be of value.”', 'Albert Einstein'),
(21, '“Stay afraid, but do it anyway. What’s important is the action. You don’t have to wait to be confident. Just do it and eventually the confidence will follow.”', 'Carrie Fisher'),
(22, '“One can choose to go back toward safety or forward toward growth. Growth must be chosen again and again; fear must be overcome again and again.”', 'Abraham Maslow'),
(23, ' “The swiftest way to triple your success is to double your investment in personal development.”', 'Robin Sharma'),
(24, '“Don’t go through life, grow through life.”', 'Eric Butterworth'),
(25, '“We can’t become what we need to be by remaining what we are.”', 'Oprah Winfrey'),
(26, ' “Life’s challenges are not supposed to paralyze you, they’re supposed to help you discover who you are.” ', 'Bernice Johnson Reagon'),
(27, ' “The most difficult thing is the decision to act, the rest is merely tenacity.”', 'Amelia Earhart'),
(28, '“People who are crazy enough to think they can change the world are the ones who do.” ', 'Rob Siltanen'),
(29, '“If there is no struggle, there is no progress.”', 'Frederick Douglass'),
(30, '“I would like to think that all of my successes in life are really just the fruit of my failures.”', 'Yvie Oddly'),
(31, '“Do the best you can until you know better. Then when you know better, do better.”', 'Maya Angelou'),
(32, '“I’ve got a theory that if you give 100 percent all the time, somehow things will work out in the end.”', 'Larry Bird'),
(33, '“By doing the work to love ourselves more, I believe we will love each other better.”', 'Laverne Cox'),
(34, 'Fasdfas', 'Asdfasdfasdfas');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `location` varchar(200) NOT NULL,
  `ip` varchar(50) NOT NULL,
  `user_key` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quotes`
--
ALTER TABLE `quotes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `quotes`
--
ALTER TABLE `quotes`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=127;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
