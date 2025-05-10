-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 16, 2025 at 08:40 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `insider_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `Admin_id` int(4) NOT NULL,
  `F_Name` varchar(15) NOT NULL,
  `L_Name` varchar(15) NOT NULL,
  `Pass` varchar(20) NOT NULL,
  `Email` varchar(30) NOT NULL,
  `Role` varchar(5) NOT NULL DEFAULT 'Admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`Admin_id`, `F_Name`, `L_Name`, `Pass`, `Email`, `Role`) VALUES
(2, 'Nour', 'Ebrahim', 'Nour 123', 'nour@gmeil.com', 'admin'),
(3, 'Youssef', '7mdon', '7mdon 123', '7mdon@gmail.com', 'admin'),
(4, 'Mohamed', 'Mahdy', 'Mahdy 123', 'Mahdy@gmeil.com', 'admin'),
(5, 'yara ', 'Mohamed', 'yara 123', 'yara@gmail.com', 'admin'),
(6, 'youssef', 'sameh', 'youssef 123', 'youssef@gmail.com', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `Article_id` int(4) NOT NULL,
  `Title` varchar(50) NOT NULL,
  `Content` mediumtext NOT NULL,
  `Category_id` int(4) DEFAULT NULL,
  `Admin_id` int(4) DEFAULT NULL,
  `Image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`Article_id`, `Title`, `Content`, `Category_id`, `Admin_id`, `Image`) VALUES
(1, 'وصل القوى العالمية لاتفاق جديد بشأن التغير المناخي', 'أعلنت الأمم المتحدة اليوم عن توصل مجموعة من القوى العالمية إلى اتفاق جديد لمواجهة التغير المناخي، وذلك خلال القمة السنوية التي عقدت في جنيف. يهدف الاتفاق إلى تقليل انبعاثات الكربون بنسبة 40% بحلول عام 2030، مع التزام الدول الصناعية بتمويل مشاريع الطاقة النظيفة في الدول النامية.\n\nوقد صرح الأمين العام للأمم المتحدة قائلاً: \"هذا الاتفاق يمثل خطوة تاريخية نحو إنقاذ كوكبنا وضمان مستقبل مستدام للأجيال القادمة.\" فيما رحبت عدة دول بالاتفاق، مؤكدةً على ضرورة التعاون الدولي لمواجهة التحديات البيئية المتزايدة.\n\nيُذكر أن المفاوضات استمرت لأكثر من أسبوعين، وسط ضغوط من المنظمات البيئية والمجتمع الدولي لاتخاذ إجراءات صارمة ضد الاحتباس الحراري.', 1, NULL, NULL),
(2, 'ارتفاع أسعار الذهب عالميًا بسبب تقلبات الأسواق الم', 'شهدت أسعار الذهب ارتفاعًا ملحوظًا اليوم، حيث تجاوز سعر الأوقية 2,050 دولارًا، وذلك نتيجة التوترات الاقتصادية العالمية وضعف أداء بعض العملات الرئيسية.\r\n\r\nيعود هذا الارتفاع إلى تزايد الطلب على الذهب كملاذ آمن، خاصة بعد تصريحات البنوك المركزية حول احتمال رفع أسعار الفائدة لمواجهة التضخم. وأكد محللون اقتصاديون أن المستثمرين يتجهون نحو الذهب بسبب عدم استقرار الأسواق المالية وتراجع قيمة الدولار في بعض المناطق.\r\n\r\nمن المتوقع أن يستمر هذا الاتجاه في الأيام القادمة، خاصةً إذا استمرت التقلبات الاقتصادية وعدم وضوح سياسات البنوك المركزية بشأن التضخم وأسعار الفائدة.', 3, NULL, NULL),
(3, 'إطلاق أول هاتف ذكي يعمل بالذكاء الاصطناعي بالكامل', 'أعلنت شركة تكنولوجية رائدة اليوم عن إطلاق أول هاتف ذكي يعمل بالكامل بتقنيات الذكاء الاصطناعي، حيث يتمتع الهاتف بقدرة على تحليل سلوك المستخدم والتكيف معه لتحسين الأداء وتوفير تجربة استخدام أكثر ذكاءً.\r\n\r\nويتميز الهاتف الجديد بمساعد افتراضي متطور يمكنه إجراء المكالمات، وكتابة الرسائل، وضبط الإعدادات تلقائيًا بناءً على تفضيلات المستخدم. كما يدعم تقنيات التعلم العميق التي تساعد في تحسين جودة الصور، وإدارة الطاقة، وتعزيز الأمان.\r\n\r\nأكدت الشركة أن الهاتف سيكون متاحًا في الأسواق خلال الأشهر القادمة، وسط توقعات بأن يُحدث نقلة نوعية في عالم الهواتف الذكية ويؤثر على مستقبل التكنولوجيا المحمولة.', 4, NULL, NULL),
(4, 'نجم برشلونة يتصدر قائمة المرشحين للكرة الذهبية 202', 'رافينيا: الجناح البرازيلي يتصدر قائمة هدافي دوري أبطال أوروبا برصيد 11 هدفًا، وسجل لبرشلونة 27 هدفًا وصنع 19 في 41 مباراة بجميع البطولات منذ بداية الموسم. ​\r\n\r\nلامين يامال: اللاعب الشاب الذي فاز بجائزة كأس كوبا لأفضل لاعب تحت 21 عامًا في حفل الكرة الذهبية 2024، يواصل تألقه مع الفريق الأول لبرشلونة. ​\r\n\r\nداني أولمو: لاعب الوسط الإسباني الذي احتل المركز الثالث عشر في ترتيب الكرة الذهبية لعام 2024، يستمر في تقديم أداء قوي مع برشلونة. ​\r\n\r\nمن المتوقع أن تُعلن القائمة الرسمية للمرشحين لجائزة الكرة الذهبية لعام 2025 في وقت لاحق من هذا العام، بناءً على أداء اللاعبين في البطولات المحلية والدولية.​', 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `Category_id` int(4) NOT NULL,
  `Content` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`Category_id`, `Content`) VALUES
(1, 'اخبار سياسية'),
(2, 'اخبار رياضية'),
(3, 'اخبار اقتصادية'),
(4, 'اخبار اتكنولوجية');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `Comment_id` int(4) NOT NULL,
  `Content` varchar(10000) NOT NULL,
  `User_id` int(4) DEFAULT NULL,
  `Article_id` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`Comment_id`, `Content`, `User_id`, `Article_id`) VALUES
(1, 'ما نتائج الاجتماع ؟', 1, 1),
(2, 'الاسعار اليوم مرتفعه جدا', 4, 2),
(3, 'رائع جدا ', 2, 3),
(4, 'اتمني فوز لامين ', 3, 4);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `User_id` int(4) NOT NULL,
  `F_Name` varchar(15) NOT NULL,
  `L_Name` varchar(15) NOT NULL,
  `Pass` varchar(20) NOT NULL,
  `Email` varchar(20) NOT NULL,
  `Role` varchar(5) DEFAULT 'user',
  `Admin_id` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`User_id`, `F_Name`, `L_Name`, `Pass`, `Email`, `Role`, `Admin_id`) VALUES
(1, 'Haidy', 'Adel', 'Haidy 123', 'Haidy@gmail.com', 'user', NULL),
(2, 'Hager', 'Farag', 'Hager 234', 'Hager@gmail.com', 'user', NULL),
(3, 'Moaz', 'Essam', 'Moaz 123', 'Moaz@gmail.com', 'user', NULL),
(4, 'Mahmoud ', 'Ayman', 'Mahmoud 123', 'Mahmoud@gmail.com', 'user', NULL),
(6, 'Yasmin', 'Ahmed', 'Yasmin 123', 'Yasmin@gmail.com', 'user', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`Admin_id`);

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`Article_id`),
  ADD KEY `Category_id` (`Category_id`),
  ADD KEY `Admin_id` (`Admin_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`Category_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`Comment_id`),
  ADD KEY `User_id` (`User_id`),
  ADD KEY `Article_id` (`Article_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`User_id`),
  ADD KEY `Admin_id` (`Admin_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `Admin_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `Article_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `Category_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `Comment_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `User_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `articles_ibfk_1` FOREIGN KEY (`Admin_id`) REFERENCES `admins` (`Admin_id`),
  ADD CONSTRAINT `articles_ibfk_2` FOREIGN KEY (`Category_id`) REFERENCES `category` (`Category_id`);

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`User_id`) REFERENCES `users` (`User_id`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`Article_id`) REFERENCES `articles` (`Article_id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`Admin_id`) REFERENCES `admins` (`Admin_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
