-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 28, 2025 at 04:10 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `country_code` varchar(2) NOT NULL,
  `country_name` varchar(100) NOT NULL,
  `country_name_ar` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `country_code`, `country_name`, `country_name_ar`) VALUES
(1, 'US', 'United States', 'الولايات المتحدة'),
(2, 'CA', 'Canada', 'كندا'),
(3, 'AF', 'Afghanistan', 'افغانستان'),
(4, 'AL', 'Albania', 'البانيا'),
(5, 'DZ', 'Algeria', 'الجزائر'),
(6, 'DS', 'American Samoa', 'ساموا الأمريكية'),
(7, 'AD', 'Andorra', 'أندورا'),
(8, 'AO', 'Angola', 'انجولا'),
(9, 'AI', 'Anguilla', 'أنغيلا'),
(10, 'AQ', 'Antarctica', 'القارة القطبية الجنوبية'),
(11, 'AG', 'Antigua and/or Barbuda', 'أنتيغوا و / أو باربودا'),
(12, 'AR', 'Argentina', 'الارجنتين'),
(13, 'AM', 'Armenia', 'ارمينيا'),
(14, 'AW', 'Aruba', 'اوروبا'),
(15, 'AU', 'Australia', 'استراليا'),
(16, 'AT', 'Austria', 'النمسا'),
(17, 'AZ', 'Azerbaijan', 'ازريبيجان'),
(18, 'BS', 'Bahamas', 'جزر البهاما'),
(19, 'BH', 'Bahrain', 'البحرين'),
(20, 'BD', 'Bangladesh', 'بنجلاديش'),
(21, 'BB', 'Barbados', 'بربادوس'),
(22, 'BY', 'Belarus', 'بيلاروسيا'),
(23, 'BE', 'Belgium', 'بلجيكا'),
(24, 'BZ', 'Belize', 'بليز'),
(25, 'BJ', 'Benin', 'بنين'),
(26, 'BM', 'Bermuda', 'برمودا'),
(27, 'BT', 'Bhutan', 'بوتان'),
(28, 'BO', 'Bolivia', 'بوليفيا'),
(29, 'BA', 'Bosnia and Herzegovina', 'البوسنا والهارسيك'),
(30, 'BW', 'Botswana', 'بتسوانا'),
(31, 'BV', 'Bouvet Island', 'جزيرة بوفيت'),
(32, 'BR', 'Brazil', 'البرازيل'),
(33, 'IO', 'British lndian Ocean Territory', 'إقليم المحيط البريطاني الهندي'),
(34, 'BN', 'Brunei Darussalam', 'بروناي دار السلام '),
(35, 'BG', 'Bulgaria', 'بلغاريا'),
(36, 'BF', 'Burkina Faso', 'بوركينا فاسو'),
(37, 'BI', 'Burundi', 'بوروندي'),
(38, 'KH', 'Cambodia', 'كمبوديا'),
(39, 'CM', 'Cameroon', 'الكاميرون'),
(40, 'CV', 'Cape Verde', 'الرأس الأخضر'),
(41, 'KY', 'Cayman Islands', 'جزر كايمان'),
(42, 'CF', 'Central African Republic', 'جمهورية افريقيا الوسطى'),
(43, 'TD', 'Chad', 'تشاد'),
(44, 'CL', 'Chile', 'تشيلي'),
(45, 'CN', 'China', 'الصين'),
(46, 'CX', 'Christmas Island', 'جزيرة الكريسماس'),
(47, 'CC', 'Cocos (Keeling) Islands', 'جزر كوكوس (كيلينغ)'),
(48, 'CO', 'Colombia', 'كولومبيا'),
(49, 'KM', 'Comoros', 'جزر القمر'),
(50, 'CG', 'Congo', 'الكونغو'),
(51, 'CK', 'Cook Islands', 'جزر كوك جزر كوك'),
(52, 'CR', 'Costa Rica', 'كوستاريكا'),
(53, 'HR', 'Croatia (Hrvatska)', 'كرواتيا'),
(54, 'CU', 'Cuba', 'كوبا'),
(55, 'CY', 'Cyprus', 'قبرص'),
(56, 'CZ', 'Czech Republic', 'جمهورية التشيك'),
(57, 'DK', 'Denmark', 'الدنمارك'),
(58, 'DJ', 'Djibouti', 'جيبوتي'),
(59, 'DM', 'Dominica', 'دومينيكا'),
(60, 'DO', 'Dominican Republic', 'جمهورية الدومنيكان'),
(61, 'TP', 'East Timor', 'تيمور الشرقية'),
(62, 'EC', 'Ecudaor', 'الاكوادور'),
(63, 'EG', 'Egypt', 'مصر'),
(64, 'SV', 'El Salvador', 'السيلفادور'),
(65, 'GQ', 'Equatorial Guinea', 'غينيا الإستوائية'),
(66, 'ER', 'Eritrea', 'ارتريا'),
(67, 'EE', 'Estonia', 'استونيا'),
(68, 'ET', 'Ethiopia', 'اثيوبيا'),
(69, 'FK', 'Falkland Islands (Malvinas)', 'جزر فوكلاند (مالفيناس)'),
(70, 'FO', 'Faroe Islands', 'جزر فاروس'),
(71, 'FJ', 'Fiji', 'فيجي'),
(72, 'FI', 'Finland', 'فنلندا'),
(73, 'FR', 'France', 'فرنسا'),
(74, 'FX', 'France, Metropolitan', 'فرنسا ، متروبوليتان'),
(75, 'GF', 'French Guiana', 'غيانا الفرنسية'),
(76, 'PF', 'French Polynesia', 'بولينيزيا الفرنسية'),
(77, 'TF', 'French Southern Territories', 'المناطق الجنوبية لفرنسا'),
(78, 'GA', 'Gabon', 'الجابون'),
(79, 'GM', 'Gambia', 'جامبيا'),
(80, 'GE', 'Georgia', 'جورجيا'),
(81, 'DE', 'Germany', 'المانيا'),
(82, 'GH', 'Ghana', 'غانا'),
(83, 'GI', 'Gibraltar', 'جبل طارق'),
(84, 'GR', 'Greece', 'اليونان'),
(85, 'GL', 'Greenland', ''),
(86, 'GD', 'Grenada', 'غرينادا'),
(87, 'GP', 'Guadeloupe', 'جوادلوب'),
(88, 'GU', 'Guam', 'غوام'),
(89, 'GT', 'Guatemala', 'غواتيمالا'),
(90, 'GN', 'Guinea', 'غينيا'),
(91, 'GW', 'Guinea-Bissau', 'غينيا بيساو'),
(92, 'GY', 'Guyana', 'غانا'),
(93, 'HT', 'Haiti', 'هايتي'),
(94, 'HM', 'Heard and Mc Donald Islands', 'جزر هيرد وماكدونالد'),
(95, 'HN', 'Honduras', 'الهندرواس'),
(96, 'HK', 'Hong Kong', 'هونج كونج'),
(97, 'HU', 'Hungary', 'المجر'),
(98, 'IS', 'Iceland', 'ايسلندا'),
(99, 'IN', 'India', 'الهند'),
(100, 'ID', 'Indonesia', 'اندونيسيا'),
(101, 'IR', 'Iran (Islamic Republic of)', 'ايران'),
(102, 'IQ', 'Iraq', 'العراق'),
(103, 'IE', 'Ireland', 'ايرلندا'),
(104, 'Pa', 'Palestine', 'فلسطين'),
(105, 'IT', 'Italy', 'ايطاليا'),
(106, 'CI', 'Ivory Coast', 'كوتديفوار'),
(107, 'JM', 'Jamaica', 'جاميكا'),
(108, 'JP', 'Japan', 'اليابان'),
(109, 'JO', 'Jordan', 'الاردن'),
(110, 'KZ', 'Kazakhstan', 'كازخستان'),
(111, 'KE', 'Kenya', 'كينيا'),
(112, 'KI', 'Kiribati', 'كيريباتي'),
(113, 'KP', 'Korea, Democratic People\'s Republic of', ''),
(114, 'KR', 'Korea, Republic of', 'كوريا'),
(115, 'KW', 'Kuwait', 'الكويت'),
(116, 'KG', 'Kyrgyzstan', 'قيرغيزستان'),
(117, 'LA', 'Lao People\'s Democratic Republic', ''),
(118, 'LV', 'Latvia', 'لاتفيا'),
(119, 'LB', 'Lebanon', 'لبنان'),
(120, 'LS', 'Lesotho', 'ليسوتو'),
(121, 'LR', 'Liberia', 'ليبيريا'),
(122, 'LY', 'Libyan Arab Jamahiriya', 'ليبيا'),
(123, 'LI', 'Liechtenstein', 'ليختنشتاين'),
(124, 'LT', 'Lithuania', 'ليتوانيا'),
(125, 'LU', 'Luxembourg', ''),
(126, 'MO', 'Macau', ''),
(127, 'MK', 'Macedonia', ''),
(128, 'MG', 'Madagascar', ''),
(129, 'MW', 'Malawi', 'مالاوي'),
(130, 'MY', 'Malaysia', 'ماليزيا'),
(131, 'MV', 'Maldives', 'المالديف'),
(132, 'ML', 'Mali', 'مالي'),
(133, 'MT', 'Malta', 'مالطا'),
(134, 'MH', 'Marshall Islands', ''),
(135, 'MQ', 'Martinique', ''),
(136, 'MR', 'Mauritania', 'موريتانيا'),
(137, 'MU', 'Mauritius', ''),
(138, 'TY', 'Mayotte', ''),
(139, 'MX', 'Mexico', 'المكسيك'),
(140, 'FM', 'Micronesia, Federated States of', ''),
(141, 'MD', 'Moldova, Republic of', ''),
(142, 'MC', 'Monaco', 'موناكو'),
(143, 'MN', 'Mongolia', 'منغوليا'),
(144, 'MS', 'Montserrat', ''),
(145, 'MA', 'Morocco', 'المغرب'),
(146, 'MZ', 'Mozambique', 'الموزمبيق'),
(147, 'MM', 'Myanmar', 'مانيمار'),
(148, 'NA', 'Namibia', 'نامبيا'),
(149, 'NR', 'Nauru', ''),
(150, 'NP', 'Nepal', 'نيبال'),
(151, 'NL', 'Netherlands', ''),
(152, 'AN', 'Netherlands Antilles', ''),
(153, 'NC', 'New Caledonia', ''),
(154, 'NZ', 'New Zealand', ''),
(155, 'NI', 'Nicaragua', ''),
(156, 'NE', 'Niger', 'النيجر'),
(157, 'NG', 'Nigeria', 'نيجيريا'),
(158, 'NU', 'Niue', ''),
(159, 'NF', 'Norfork Island', ''),
(160, 'MP', 'Northern Mariana Islands', ''),
(161, 'NO', 'Norway', ''),
(162, 'OM', 'Oman', 'عمان'),
(163, 'PK', 'Pakistan', 'باكستان'),
(164, 'PW', 'Palau', ''),
(165, 'PA', 'Panama', 'بنما'),
(166, 'PG', 'Papua New Guinea', ''),
(167, 'PY', 'Paraguay', 'باراجوي'),
(168, 'PE', 'Peru', 'بيرو'),
(169, 'PH', 'Philippines', 'الفليبين'),
(170, 'PN', 'Pitcairn', ''),
(171, 'PL', 'Poland', 'بولندا'),
(172, 'PT', 'Portugal', 'البرتغال'),
(173, 'PR', 'Puerto Rico', ''),
(174, 'QA', 'Qatar', 'قطر'),
(175, 'RE', 'Reunion', ''),
(176, 'RO', 'Romania', 'رومانيا'),
(177, 'RU', 'Russian Federation', ''),
(178, 'RW', 'Rwanda', 'رواندا'),
(179, 'KN', 'Saint Kitts and Nevis', ''),
(180, 'LC', 'Saint Lucia', ''),
(181, 'VC', 'Saint Vincent and the Grenadines', ''),
(182, 'WS', 'Samoa', ''),
(183, 'SM', 'San Marino', ''),
(184, 'ST', 'Sao Tome and Principe', ''),
(185, 'SA', 'Saudi Arabia', 'السعودية'),
(186, 'SN', 'Senegal', 'السنغال'),
(187, 'SC', 'Seychelles', ''),
(188, 'SL', 'Sierra Leone', ''),
(189, 'SG', 'Singapore', ''),
(190, 'SK', 'Slovakia', 'سلوفاكيا'),
(191, 'SI', 'Slovenia', 'سلوفينيا'),
(192, 'SB', 'Solomon Islands', ''),
(193, 'SO', 'Somalia', ''),
(194, 'ZA', 'South Africa', 'جنوب افريقيا'),
(195, 'GS', 'South Georgia South Sandwich Islands', 'جزر ساندويتش جنوب جورجيا الجنوبية '),
(196, 'ES', 'Spain', 'اسبانيا'),
(197, 'LK', 'Sri Lanka', 'سيرلانكا'),
(198, 'SH', 'St. Helena', 'سانت هيلانة'),
(199, 'PM', 'St. Pierre and Miquelon', 'St. Pierre and Miquelon'),
(200, 'SD', 'Sudan', 'السودان'),
(201, 'SR', 'Suriname', 'سورينام'),
(202, 'SJ', 'Svalbarn and Jan Mayen Islands', 'جزر سفالبارد وجان ماين'),
(203, 'SZ', 'Swaziland', 'سوازيلاند'),
(204, 'SE', 'Sweden', 'السويد'),
(205, 'CH', 'Switzerland', 'سويسرا'),
(206, 'SY', 'Syrian Arab Republic', 'سوريا'),
(207, 'TW', 'Taiwan', 'تايوان'),
(208, 'TJ', 'Tajikistan', 'تاجستان'),
(209, 'TZ', 'Tanzania, United Republic of', 'تنزانيا'),
(210, 'TH', 'Thailand', 'تايلاند'),
(211, 'TG', 'Togo', 'توجو'),
(212, 'TK', 'Tokelau', 'توكيلاو'),
(213, 'TO', 'Tonga', 'تونغا'),
(214, 'TT', 'Trinidad and Tobago', 'ترينداد وتوباجو'),
(215, 'TN', 'Tunisia', 'تونس'),
(216, 'TR', 'Turkey', 'تركيا'),
(217, 'TM', 'Turkmenistan', 'تركمانستان'),
(218, 'TC', 'Turks and Caicos Islands', 'جزر تركس وكايكوس'),
(219, 'TV', 'Tuvalu', 'توفالو'),
(220, 'UG', 'Uganda', 'اوغندا'),
(221, 'UA', 'Ukraine', 'اوكرانيا'),
(222, 'AE', 'United Arab Emirates', 'الامارات العربية المتحدة'),
(223, 'GB', 'United Kingdom', 'انجلترا'),
(224, 'UM', 'United States minor outlying islands', ''),
(225, 'UY', 'Uruguay', ''),
(226, 'UZ', 'Uzbekistan', 'اوزبكستان'),
(227, 'VU', 'Vanuatu', ''),
(228, 'VA', 'Vatican City State', ''),
(229, 'VE', 'Venezuela', 'فنزويلا'),
(230, 'VN', 'Vietnam', 'فيتنام'),
(231, 'VG', 'Virigan Islands (British)', 'جزر العذراء البريطانية)'),
(232, 'VI', 'Virgin Islands (U.S.)', 'جزر فيرجن (الولايات المتحدة)'),
(233, 'WF', 'Wallis and Futuna Islands', 'جزر واليس وفوتونا'),
(234, 'EH', 'Western Sahara', ''),
(235, 'YE', 'Yemen', 'اليمن'),
(236, 'YU', 'Yugoslavia', 'يوغسلافيا'),
(237, 'ZR', 'Zaire', '.زئير'),
(238, 'ZM', 'Zambia', 'زامبيا'),
(239, 'ZW', 'Zimbabwe', 'زيمبابوي'),
(240, 'wo', 'without', 'بدون'),
(241, 'ot', 'other', 'اخرى');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=242;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
