-- phpMyAdmin SQL Dump
-- version 4.0.10.18
-- https://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 06, 2022 at 07:01 PM
-- Server version: 5.7.23-0ubuntu0.16.04.1
-- PHP Version: 5.6.40-1+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `yellowbananafood`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `desc` varchar(255) DEFAULT NULL,
  `parent_id` bigint(20) DEFAULT '0' COMMENT 'This field stores parent category for this category',
  `status` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE IF NOT EXISTS `company` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `manager_id` int(11) DEFAULT NULL,
  `location_id` int(11) DEFAULT NULL,
  `address` text,
  `state_id` int(11) DEFAULT NULL,
  `city_name` varchar(255) DEFAULT NULL,
  `pincode` varchar(10) DEFAULT NULL,
  `logo_name` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1:Active, 0: InActive',
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id`, `name`, `manager_id`, `location_id`, `address`, `state_id`, `city_name`, `pincode`, `logo_name`, `status`, `created_date`) VALUES
(1, 'POPTATES MALAD', 57, 1, 'Parth Business Plaza, 7th & 8th Floor, Near Uncle Kitchen, Mith Chowki, Malad Link Road, Malad (W), Mumbai - 400064', 53, 'Mumbai', '400064', 'images15.jpg', 1, '2019-08-26 02:44:03'),
(10, 'POPTATES MULUND', 58, 2, 'Shop No.17, 3rd Floor, R-Mall, Mulund Check Naka, Mulund (W), Mumbai - 400 080', 53, 'MUMBAI', '400080', 'ac6aef992.png', 1, '2019-08-26 02:47:32'),
(4, 'POPTATES KANDIVALI', 46, 1, 'Growels 101 Mall, Unit No S-02A, 2nd floor, Akurli Road, off Western Express Highway, Kandivali (E), Mumbai - 400101', 53, 'Mumbai', '400101', 'images8.jpg', 1, '2019-08-26 02:46:30'),
(17, 'POPTATES VERSOVA', 57, 1, 'Shop No. 7 & 8, Shiv Shopping Centre, Off J.P. Road, 7 Bunglows, Andheri (West), Mumbai - 400 061', 53, 'MUMBAI ', '400061', 'myw3schoolsimage.jpg', 1, '2019-08-26 02:38:54'),
(19, 'POPTATES SAKINAKA', 56, 1, '110 to 115, 118 to 122, Sagar Pallazio, 1st floor, Andheri Kurla Road, Sakinaka Junction, Andheri (E), Mumbai - 400 072', 53, 'Mumbai', '400072', 'Polling.png', 1, '2019-08-26 02:45:02'),
(20, 'POPTATES LOKHANDWALA', 57, 1, 'Unit No. G-2, 103 & 104, Morya Classic, Gr & 1st Floor, off New Link Road, Andheri (W), Mumbai - 400 053', 53, 'MUMBAI', '400053', 'logo-2.png', 1, '2019-08-26 02:41:52'),
(21, 'genies', 60, 3, 'mira road , dadar', 65, 'mumbai', '400000', '2308190848456993.png', 1, '2020-02-19 13:23:53');

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE IF NOT EXISTS `country` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(75) DEFAULT NULL,
  `code` varchar(5) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0' COMMENT '1:Active, 0: InActive',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=244 ;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`id`, `name`, `code`, `status`) VALUES
(1, 'United States', 'USA', 1),
(2, 'Afghanistan', 'AF', 1),
(4, 'Algeria', 'DZ', 1),
(5, 'American Samoa', 'AS', 1),
(6, 'Andorra', 'AD', 1),
(7, 'Angola', 'AO', 1),
(8, 'Anguilla', 'AI', 1),
(9, 'Antarctica', 'AQ', 1),
(10, 'Antigua And Barbuda', 'AG', 1),
(11, 'Argentina', 'AR', 1),
(12, 'Armenia', 'AM', 1),
(13, 'Aruba', 'AW', 1),
(14, 'Australia', 'AU', 1),
(15, 'Austria', 'AT', 1),
(16, 'Azerbaijan', 'AZ', 1),
(17, 'Bahamas', 'BS', 1),
(18, 'Bahrain', 'BH', 1),
(19, 'Bangladesh', 'BD', 1),
(20, 'Barbados', 'BB', 1),
(21, 'Belarus', 'BY', 1),
(22, 'Belgium', 'BE', 1),
(23, 'Belize', 'BZ', 1),
(24, 'Benin', 'BJ', 1),
(25, 'Bermuda', 'BM', 1),
(26, 'Bhutan', 'BT', 1),
(27, 'Bolivia', 'BO', 1),
(28, 'Bosnia And Herzegovina', 'BA', 1),
(29, 'Botswana', 'BW', 1),
(31, 'Brazil', 'BR', 1),
(32, 'British Indian Ocean Territory', 'IO', 1),
(33, 'Virgin Islands', 'VG', 1),
(34, 'Brunei Darussalam', 'BN', 1),
(36, 'Burkina Faso', 'BF', 1),
(37, 'Burundi', 'BI', 1),
(39, 'Cameroon', 'CM', 1),
(40, 'Canada', 'CA', 1),
(41, 'Cape Verde', 'CV', 1),
(42, 'Cayman Islands', 'KY', 1),
(43, 'Central African Republic', 'CF', 1),
(44, 'Chad', 'TD', 1),
(45, 'Chile', 'CL', 1),
(46, 'China', 'CN', 1),
(49, 'Colombia', 'CO', 1),
(50, 'Comoros', 'KM', 1),
(51, 'Congo', 'CG', 1),
(52, 'Cook Islands', 'CK', 1),
(53, 'Costa Rica', 'CR', 1),
(54, 'Cote D''Ivoire', 'CI', 1),
(55, 'Croatia', 'HR', 1),
(56, 'Cuba', 'CU', 1),
(57, 'Cyprus', 'CY', 1),
(58, 'Czech Republic', 'CZ', 1),
(59, 'Denmark', 'DK', 1),
(60, 'Djibouti', 'DJ', 1),
(61, 'Dominica', 'DM', 1),
(62, 'Dominican Republic', 'DO', 1),
(64, 'Ecuador', 'EC', 1),
(65, 'Egypt', 'EG', 1),
(66, 'El Salvador', 'SV', 1),
(67, 'Equatorial Guinea', 'GQ', 1),
(68, 'Eritrea', 'ER', 1),
(69, 'Estonia', 'EE', 1),
(70, 'Ethiopia', 'ET', 1),
(71, 'Falkland Islands (Malvinas)', 'FK', 1),
(72, 'Faroe Islands', 'FO', 1),
(73, 'Fiji', 'FJ', 1),
(74, 'Finland', 'FI', 1),
(75, 'France', 'FR', 1),
(77, 'French Guiana', 'GF', 1),
(78, 'French Polynesia', 'PF', 1),
(80, 'Gabon', 'GA', 1),
(81, 'Gambia', 'GM', 1),
(82, 'Georgia', 'GE', 1),
(83, 'Germany', 'DE', 1),
(84, 'Ghana', 'GH', 1),
(85, 'Gibraltar', 'GI', 1),
(86, 'Greece', 'GR', 1),
(87, 'Greenland', 'GL', 1),
(88, 'Grenada', 'GD', 1),
(89, 'Guadeloupe', 'GP', 1),
(90, 'Guam', 'GU', 1),
(91, 'Guatemala', 'GT', 1),
(92, 'Guinea', 'GN', 1),
(93, 'Guinea-Bissau', 'GW', 1),
(94, 'Guyana', 'GY', 1),
(95, 'Haiti', 'HT', 1),
(97, 'Honduras', 'HN', 1),
(98, 'Hong Kong', 'HK', 1),
(99, 'Hungary', 'HU', 1),
(100, 'Iceland', 'IS', 1),
(101, 'India', 'IN', 1),
(102, 'Indonesia', 'ID', 1),
(103, 'Iraq', 'IQ', 1),
(104, 'Ireland', 'IE', 1),
(105, 'Islamic Republic Of Iran', 'IR', 1),
(106, 'Israel', 'IL', 1),
(107, 'Italy', 'IT', 1),
(108, 'Jamaica', 'JM', 1),
(109, 'Japan', 'JP', 1),
(110, 'Jordan', 'JO', 1),
(111, 'Kazakhstan', 'KZ', 1),
(112, 'Kenya', 'KE', 1),
(113, 'Kiribati', 'KI', 1),
(115, 'Republic Of Korea', 'KR', 1),
(116, 'Kuwait', 'KW', 1),
(117, 'Kyrgyzstan', 'KG', 1),
(118, 'Lao People''S Democratic Republic', 'LA', 1),
(119, 'Latvia', 'LV', 1),
(120, 'Lebanon', 'LB', 1),
(121, 'Lesotho', 'LS', 1),
(122, 'Liberia', 'LR', 1),
(123, 'Libyan Arab Jamahiriya', 'LY', 1),
(124, 'Liechtenstein', 'LI', 1),
(125, 'Lithuania', 'LT', 1),
(126, 'Luxembourg', 'LU', 1),
(127, 'Macao', 'MO', 1),
(128, 'The Former Yugoslav Republic Of Macedonia', 'MK', 1),
(129, 'Madagascar', 'MG', 1),
(130, 'Malawi', 'MW', 1),
(131, 'Malaysia', 'MY', 1),
(132, 'Maldives', 'MV', 1),
(133, 'Mali', 'ML', 1),
(134, 'Malta', 'MT', 1),
(136, 'Martinique', 'MQ', 1),
(137, 'Mauritania', 'MR', 1),
(138, 'Mauritius', 'MU', 1),
(139, 'Mayotte', 'YT', 1),
(140, 'Mexico', 'MX', 1),
(141, 'Federated States Of Micronesia', 'FM', 1),
(142, 'Republic Of Moldova', 'MD', 1),
(143, 'Monaco', 'MC', 1),
(144, 'Mongolia', 'MN', 1),
(145, 'Montserrat', 'MS', 1),
(146, 'Morocco', 'MA', 1),
(147, 'Mozambique', 'MZ', 1),
(148, 'Myanmar', 'MM', 1),
(149, 'Namibia', 'NA', 1),
(150, 'Nauru', 'NR', 1),
(151, 'Nepal', 'NP', 1),
(152, 'Netherlands', 'NL', 1),
(153, 'Netherlands Antilles', 'AN', 1),
(154, 'New Caledonia', 'NC', 1),
(155, 'New Zealand', 'NZ', 1),
(156, 'Nicaragua', 'NI', 1),
(157, 'Niger', 'NE', 1),
(158, 'Nigeria', 'NG', 1),
(159, 'Niue', 'NU', 1),
(160, 'Norfolk Island', 'NF', 1),
(161, 'Northern Mariana Islands', 'MP', 1),
(162, 'Norway', 'NO', 1),
(163, 'Oman', 'OM', 1),
(164, 'Pakistan', 'PK', 1),
(165, 'Palau', 'PW', 1),
(166, 'Panama', 'PA', 1),
(167, 'Papua New Guinea', 'PG', 1),
(168, 'Paraguay', 'PY', 1),
(169, 'Peru', 'PE', 1),
(170, 'Philippines', 'PH', 1),
(172, 'Poland', 'PL', 1),
(173, 'Portugal', 'PT', 1),
(174, 'Puerto Rico', 'PR', 1),
(175, 'Qatar', 'QA', 1),
(176, 'Reunion', 'RE', 1),
(177, 'Romania', 'RO', 1),
(178, 'Russia', 'RU', 1),
(179, 'Rwanda', 'RW', 1),
(180, 'Saint Lucia', 'LC', 1),
(181, 'Samoa', 'WS', 1),
(182, 'San Marino', 'SM', 1),
(183, 'Sao Tome And Principe', 'ST', 1),
(184, 'Saudi Arabia', 'SA', 1),
(185, 'Senegal', 'SN', 1),
(186, 'Seychelles', 'SC', 1),
(187, 'Sierra Leone', 'SL', 1),
(188, 'Singapore', 'SG', 1),
(189, 'Slovakia', 'SK', 1),
(190, 'Slovenia', 'SI', 1),
(191, 'Solomon Islands', 'SB', 1),
(192, 'Somalia', 'SO', 1),
(193, 'South Africa', 'ZA', 1),
(194, 'Spain', 'ES', 1),
(195, 'Sri Lanka', 'LK', 1),
(197, 'Saint Kitts And Nevis', 'KN', 1),
(199, 'Saint Vincent And The Grenadines', 'VC', 1),
(200, 'Sudan', 'SD', 1),
(201, 'Suriname', 'SR', 1),
(203, 'Swaziland', 'SZ', 1),
(204, 'Sweden', 'SE', 1),
(205, 'Switzerland', 'CH', 1),
(206, 'Syrian Arab Republic', 'SY', 1),
(207, 'Taiwan', 'TW', 1),
(208, 'Tajikistan', 'TJ', 1),
(209, 'United Republic Of Tanzania', 'TZ', 1),
(210, 'Thailand', 'TH', 1),
(211, 'Togo', 'TG', 1),
(212, 'Tokelau', 'TK', 1),
(213, 'Tonga', 'TO', 1),
(214, 'Trinidad And Tobago', 'TT', 1),
(215, 'Tunisia', 'TN', 1),
(216, 'Turkey', 'TR', 1),
(217, 'Turkmenistan', 'TM', 1),
(219, 'Tuvalu', 'TV', 1),
(220, 'Uganda', 'UG', 1),
(221, 'Ukraine', 'UA', 1),
(222, 'United Arab Emirates', 'AE', 1),
(223, 'United Kingdom', 'GB', 1),
(224, 'Virgin Islands (U.S.)', 'VI', 1),
(225, 'Uruguay', 'UY', 1),
(226, 'Uzbekistan', 'UZ', 1),
(227, 'Vanuatu', 'VU', 1),
(228, 'Holy See (Vatican City State)', 'VA', 1),
(229, 'Venezuela', 'VE', 1),
(230, 'Vietnam', 'VN', 1),
(233, 'Yemen', 'YE', 1),
(236, 'Zambia', 'ZM', 1),
(237, 'Zimbabwe', 'ZW', 1),
(238, 'Palestinian Territory Occupied', 'PS', 1),
(239, 'Serbia And Montenegro', 'CS', 1),
(240, 'South Georgia And The South Sandwich Islands', 'GS', 1),
(241, 'The Democratic Republic Of The Congo', 'CD', 1),
(242, 'Timor-Leste', 'TL', 1),
(243, 'United States Minor Outlying Islands', 'UM', 1);

-- --------------------------------------------------------

--
-- Table structure for table `email_templates`
--

CREATE TABLE IF NOT EXISTS `email_templates` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `template_name` varchar(255) NOT NULL,
  `template_subject` varchar(255) NOT NULL,
  `template_content` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `email_templates`
--

INSERT INTO `email_templates` (`id`, `template_name`, `template_subject`, `template_content`) VALUES
(1, 'WELCOME_MAIL', 'Your account is successfully activated on  ##sitename##', '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">\n<html xmlns="http://www.w3.org/1999/xhtml">\n	<head>\n        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />               \n    </head>\n    <body leftmargin="0" marginwidth="0" topmargin="0" marginheight="0" offset="0">\n    	<center>\n        	<table width="604" bgcolor="#f0f0f0" align="center" valign="top" cellspacing="0" cellpadding="0" border="0" style="padding:10px; color:#000;" id="bodyTable">\n            	<tr>\n                	<td align="center" valign="top" id="bodyCell">                    	\n                    	<table border="0" cellpadding="0" cellspacing="0" id="templateContainer">                        	\n                        	<tr>\n                            	<td align="center" valign="top">                                	\n                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" id="templateHeader">\n                                        <tr>\n                                            <td valign="top" class="headerContent">\n                                            	<img src="{leftimage}" style="max-width:200px;" id="headerImage" mc:label="header_image" mc:edit="header_image" mc:allowdesigner mc:allowtext />\n												<img src="{rightimage}" style="max-width:400px;" id="headerImage" mc:label="header_image" mc:edit="header_image" mc:allowdesigner mc:allowtext />\n                                            </td>\n                                        </tr>\n                                    </table>                                    \n                                </td>\n                            </tr>\n                        	<tr>\n                            	<td align="center" valign="top">                                	\n                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" id="templateBody">\n                                        <tr>\n                                            <td valign="top" class="bodyContent" mc:edit="body_content">\n												<br>Hello {Username}, <br><br>\n												Congratulations. You are now a member of {sitename}.\n                                            </td>\n                                        </tr>\n																	\n										<tr>\n                                            <td valign="top" class="bodyContent" mc:edit="body_content">\n												<br>Your login details are: <br>\n												Username: {email}<br>\n												Password: {password}\n												<br><br>\n												<a href="{sitelink}" target="_blank">Click here</a> to login <br> \n                                            </td>\n                                        </tr>\n										\n										<tr>\n											<td class="bodyContent">\n												<br><br>Thanks,\n												<br>\n												{sitename} Team\n											</td>\n										</tr>\n                                    </table>                                \n                                </td>\n                            </tr>                        	\n                        </table>                        \n                    </td>\n                </tr>\n            </table>\n        </center>\n    </body>\n</html>'),
(2, 'FORGOT_PASSWORD', 'Forgot Password', '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">\n<html xmlns="http://www.w3.org/1999/xhtml">\n	<head>\n        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />               \n    </head>\n    <body leftmargin="0" marginwidth="0" topmargin="0" marginheight="0" offset="0">\n    	<center>\n        	<table width="604" bgcolor="#f0f0f0" align="center" valign="top" cellspacing="0" cellpadding="0" border="0" style="padding:10px; color:#000;" id="bodyTable">\n            	<tr>\n                	<td align="center" valign="top" id="bodyCell">                    	\n                    	<table width=''100%'' border="0" cellpadding="0" cellspacing="0" id="templateContainer">                        	\n                        	<tr>\n                            	<td align="center" valign="top">                                	\n                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" id="templateHeader">\n                                        <tr>\n                                            <td valign="top" class="headerContent">\n                                            	<img src="{leftimage}" style="max-width:200px;" id="headerImage" mc:label="header_image" mc:edit="header_image" mc:allowdesigner mc:allowtext />\n												<img src="{rightimage}" style="max-width:400px;" id="headerImage" mc:label="header_image" mc:edit="header_image" mc:allowdesigner mc:allowtext />\n                                            </td>\n                                        </tr>\n                                    </table>                                    \n                                </td>\n                            </tr>\n                        	<tr>\n                            	<td align="center" valign="top">                                	\n                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" id="templateBody">\n                                        <tr>\n                                            <td valign="top" class="bodyContent" mc:edit="body_content">\n												<br>Welcome {Username}, \n                                            </td>\n                                        </tr>\n										<tr>\n											<td valign="top" class="bodyContent" mc:edit="body_content">\n											<br><br>It looks like you forgot your password.<br><br>\n											\n											Your new password of {sitename} is as below:<br><br>\n											Password: {password}\n											\n											</td>\n										</tr>\n										\n										\n										<tr>\n											<td class="bodyContent">\n												<br><br><br>Thanks,\n												<br><br>\n												{sitename}\n											</td>\n										</tr>\n                                    </table>                                \n                                </td>\n                            </tr>                        	\n                        </table>                        \n                    </td>\n                </tr>\n            </table>\n        </center>\n    </body>\n</html>'),
(4, 'INVITE_EMAIL', 'Friend Invitation request from ##Username## on ##sitename##', 'Hello,\r\n\r\nYou have received friend request on ##sitename##.\r\n\r\nClick on below link to respond your friend request:\r\n##InviteFriendLink##\r\n\r\n##UserMessage##\r\n\r\nRegards,\r\n##sitename## Team'),
(5, 'ADD_FRIEND', 'Friend request from ##Username## on ##sitename##', 'Hello ##ReqUsername##,\r\n\r\nYou have received friend request on ##sitename## from ##Username##.\r\n\r\nClick on below link to respond your friend request:\r\n##InviteFriendLink##\r\n\r\n\r\nRegards,\r\n##sitename##'),
(6, 'GROUP_SHARE', 'Group sharing from ##Username## on ##sitename##', '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">\r\n<html xmlns="http://www.w3.org/1999/xhtml">\r\n	<head>\r\n        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />               \r\n    </head>\r\n    <body leftmargin="0" marginwidth="0" topmargin="0" marginheight="0" offset="0">\r\n    	<center>\r\n        	<table width="604" bgcolor="#f0f0f0" align="center" valign="top" cellspacing="0" cellpadding="0" border="0" style="padding:10px; color:#000;" id="bodyTable">\r\n            	<tr>\r\n                	<td align="center" valign="top" id="bodyCell">                    	\r\n                    	<table border="0" cellpadding="0" cellspacing="0" id="templateContainer">                        	\r\n                        	<tr>\r\n                            	<td align="center" valign="top">                                	\r\n                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" id="templateHeader">\r\n                                        <tr>\r\n                                            <td valign="top" class="headerContent">\r\n                                            	<img src="{leftimage}" style="max-width:200px;" id="headerImage" mc:label="header_image" mc:edit="header_image" mc:allowdesigner mc:allowtext />\r\n												<img src="{rightimage}" style="max-width:400px;" id="headerImage" mc:label="header_image" mc:edit="header_image" mc:allowdesigner mc:allowtext />\r\n                                            </td>\r\n                                        </tr>\r\n                                    </table>                                    \r\n                                </td>\r\n                            </tr>\r\n                        	<tr>\r\n                            	<td align="center" valign="top">                                	\r\n                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" id="templateBody">\r\n                                        <tr>\r\n                                            <td valign="top" class="bodyContent" mc:edit="body_content">\r\n												<br>Welcome, <br><br>\r\n												{msg} <br><br>\r\n												{Username} has invited you to view {groupname} of <a href="{sitelink}" target="_blank">{sitename}</a>. To view detail <a href="{grouplink}" target="_blank">click here</a>.\r\n                                            </td>\r\n                                        </tr>\r\n																	\r\n										\r\n										<tr>\r\n											<td class="bodyContent">\r\n												<br><br>Thanks,\r\n												<br>\r\n												{Username}\r\n											</td>\r\n										</tr>\r\n                                    </table>                                \r\n                                </td>\r\n                            </tr>                        	\r\n                        </table>                        \r\n                    </td>\r\n                </tr>\r\n            </table>\r\n        </center>\r\n    </body>\r\n</html>'),
(7, 'INVITE_FRIENDS', 'Invitation from ##Username## on ##sitename##', '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">\r\n<html xmlns="http://www.w3.org/1999/xhtml">\r\n	<head>\r\n        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />\r\n        <title></title>\r\n        <style type="text/css">\r\n			#outlook a{padding:0;} /* Force Outlook to provide a "view in browser" message */\r\n			.ReadMsgBody{width:100%;} .ExternalClass{width:100%;} /* Force Hotmail to display emails at full width */\r\n			.ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div {line-height: 100%;} /* Force Hotmail to display normal line spacing */\r\n			body, table, td, p, a, li, blockquote{-webkit-text-size-adjust:100%; -ms-text-size-adjust:100%;} /* Prevent WebKit and Windows mobile changing default text sizes */\r\n			table, td{mso-table-lspace:0pt; mso-table-rspace:0pt;} /* Remove spacing between tables in Outlook 2007 and up */\r\n			img{-ms-interpolation-mode:bicubic;} /* Allow smoother rendering of resized image in Internet Explorer */\r\n\r\n			\r\n			body{margin:0; padding:0;}\r\n			img{border:0; height:auto; line-height:100%; outline:none; text-decoration:none;}\r\n			table{border-collapse:collapse !important;}\r\n			body, #bodyTable, #bodyCell{height:100% !important; margin:0; padding:0; width:100% !important;}\r\n\r\n			#bodyCell{padding:20px;}\r\n			#templateContainer{width:600px;}\r\n\r\n			\r\n			body, #bodyTable{\r\n				/*@editable*/ background-color:#DEE0E2;\r\n			}\r\n					\r\n			#templateContainer{\r\n				/*@editable*/ border:1px solid #BBBBBB;\r\n			}\r\n\r\n			h2{\r\n				/*@editable*/ color:#404040 !important;\r\n				display:block;\r\n				/*@editable*/ font-family:Helvetica;\r\n				/*@editable*/ font-size:15px;\r\n				/*@editable*/ font-style:normal;\r\n				/*@editable*/ font-weight:bold;\r\n				/*@editable*/ line-height:100%;\r\n				/*@editable*/ letter-spacing:normal;							\r\n				margin:10px;	\r\n				margin-left:20px;	\r\n				/*@editable*/ text-align:left;\r\n			}\r\n			\r\n			h3{\r\n				/*@editable*/ color:#404040 !important;\r\n				display:block;\r\n				/*@editable*/ font-family:Helvetica;\r\n				/*@editable*/ font-size:13px;\r\n				/*@editable*/ font-style:normal;\r\n				/*@editable*/ font-weight:bold;\r\n				/*@editable*/ line-height:100%;\r\n				/*@editable*/ letter-spacing:normal;							\r\n				margin:10px;	\r\n				margin-left:20px;	\r\n				/*@editable*/ text-align:left;\r\n			}\r\n			\r\n			#templateHeader{\r\n				/*@editable*/ background-color:#F4F4F4;\r\n				/*@editable*/ border-top:1px solid #FFFFFF;\r\n				/*@editable*/ border-bottom:1px solid #CCCCCC;\r\n			}\r\n	\r\n			\r\n			.headerContent{\r\n				/*@editable*/ color:#505050;\r\n				/*@editable*/ font-family:Helvetica;\r\n				/*@editable*/ font-size:12px;\r\n				/*@editable*/ font-weight:bold;\r\n				/*@editable*/ line-height:100%;\r\n				/*@editable*/ padding-top:0;\r\n				/*@editable*/ padding-right:0;\r\n				/*@editable*/ padding-bottom:0;\r\n				/*@editable*/ padding-left:0;\r\n				/*@editable*/ text-align:left;\r\n				/*@editable*/ vertical-align:middle;\r\n			}\r\n			\r\n			.headerContent a:link, .headerContent a:visited, /* Yahoo! Mail Override */ .headerContent a .yshortcuts /* Yahoo! Mail Override */{\r\n				/*@editable*/ color:#EB4102;\r\n				/*@editable*/ font-weight:normal;\r\n				/*@editable*/ text-decoration:underline;\r\n			}\r\n\r\n			#headerImage{\r\n				height:auto;\r\n				max-width:600px;\r\n			}\r\n			\r\n\r\n			#templateBody{\r\n				/*@editable*/ background-color:#F4F4F4;\r\n				/*@editable*/ border-top:1px solid #FFFFFF;\r\n				/*@editable*/ border-bottom:1px solid #CCCCCC;\r\n			}\r\n\r\n			.bodyContent{\r\n				/*@editable*/ color:#505050;\r\n				/*@editable*/ font-family:Helvetica;\r\n				/*@editable*/ font-size:12px;\r\n				/*@editable*/ line-height:150%;\r\n				padding-top:20px;\r\n				padding-right:20px;\r\n				padding-bottom:20px;\r\n				padding-left:20px;\r\n				/*@editable*/ text-align:left;\r\n			}\r\n\r\n							\r\n\r\n            @media only screen and (max-width: 480px){\r\n				\r\n				body, table, td, p, a, li, blockquote{-webkit-text-size-adjust:none !important;} /* Prevent Webkit platforms from changing default text sizes */\r\n                body{width:100% !important; min-width:100% !important;} /* Prevent iOS Mail from adding padding to the body */\r\n\r\n				\r\n				#bodyCell{padding:10px !important;}\r\n\r\n			\r\n				#templateContainer{\r\n					max-width:600px !important;\r\n					/*@editable*/ width:100% !important;\r\n				}\r\n\r\n				h2{\r\n					/*@editable*/ font-size:20px !important;\r\n					/*@editable*/ line-height:100% !important;\r\n				}\r\n\r\n				h3{\r\n					/*@editable*/ font-size:14px !important;\r\n					/*@editable*/ line-height:100% !important;\r\n				}\r\n				\r\n				/* ======== Header Styles ======== */\r\n\r\n				#headerImage{\r\n					height:auto !important;\r\n					/*@editable*/ max-width:600px !important;\r\n					/*@editable*/ width:100% !important;\r\n				}\r\n\r\n				.headerContent{\r\n					/*@editable*/ font-size:12px !important;\r\n					/*@editable*/ line-height:125% !important;\r\n				}\r\n\r\n				.bodyContent{\r\n					/*@editable*/ font-size:12px !important;\r\n					/*@editable*/ line-height:125% !important;\r\n				}\r\n\r\n				\r\n							\r\n				\r\n			}\r\n		</style>\r\n    </head>\r\n    <body leftmargin="0" marginwidth="0" topmargin="0" marginheight="0" offset="0">\r\n    	<center>\r\n        	<table align="center"  bgcolor="#f0f0f0" border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" id="bodyTable" style="padding:10px; color:#000;">\r\n            	<tr>\r\n                	<td align="center" valign="top" id="bodyCell">                    	\r\n                    	<table border="0" cellpadding="0" cellspacing="0" id="templateContainer">                        	\r\n                        	<tr>\r\n                            	<td align="center" valign="top">                                	\r\n                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" id="templateHeader">\r\n                                        <tr>\r\n                                            <td valign="top" class="headerContent">\r\n                                            	<img src="{leftimage}" style="max-width:200px;" id="headerImage" mc:label="header_image" mc:edit="header_image" mc:allowdesigner mc:allowtext />\r\n												<img src="{rightimage}" style="max-width:400px;" id="headerImage" mc:label="header_image" mc:edit="header_image" mc:allowdesigner mc:allowtext />\r\n                                            </td>\r\n                                        </tr>\r\n                                    </table>                                    \r\n                                </td>\r\n                            </tr>\r\n                        	<tr>\r\n                            	<td align="center" valign="top">                                	\r\n                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" id="templateBody">\r\n                                        <tr>\r\n                                            <td valign="top" class="bodyContent" mc:edit="body_content">\r\n												Welcome, <br><br>\r\n												\r\n                                                {Username} has invited you to connect and be a part of the {sitename}.<br> To complete your registration, follow this link: <a href="{siteregisterlink}" target="_blank">Join and Accept Invitation</a>\r\n<br><br>\r\n{msg} <br>\r\n                                            </td>\r\n                                        </tr>\r\n																														\r\n										<tr>\r\n											<td class="bodyContent">\r\n												<br><br>\r\n                                                Thanks,\r\n												<br>\r\n												{Username}\r\n											</td>\r\n										</tr>\r\n                                    </table>                                \r\n                                </td>\r\n                            </tr>                        	\r\n                        </table>                        \r\n                    </td>\r\n                </tr>\r\n            </table>\r\n        </center>\r\n    </body>\r\n</html>'),
(8, 'EVENT_SHARE', 'Event sharing from ##Username## on ##sitename##', '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">\r\n<html xmlns="http://www.w3.org/1999/xhtml">\r\n	<head>\r\n        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />\r\n        <title></title>\r\n        <style type="text/css">\r\n			#outlook a{padding:0;} /* Force Outlook to provide a "view in browser" message */\r\n			.ReadMsgBody{width:100%;} .ExternalClass{width:100%;} /* Force Hotmail to display emails at full width */\r\n			.ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div {line-height: 100%;} /* Force Hotmail to display normal line spacing */\r\n			body, table, td, p, a, li, blockquote{-webkit-text-size-adjust:100%; -ms-text-size-adjust:100%;} /* Prevent WebKit and Windows mobile changing default text sizes */\r\n			table, td{mso-table-lspace:0pt; mso-table-rspace:0pt;} /* Remove spacing between tables in Outlook 2007 and up */\r\n			img{-ms-interpolation-mode:bicubic;} /* Allow smoother rendering of resized image in Internet Explorer */\r\n\r\n			\r\n			body{margin:0; padding:0;}\r\n			img{border:0; height:auto; line-height:100%; outline:none; text-decoration:none;}\r\n			table{border-collapse:collapse !important;}\r\n			body, #bodyTable, #bodyCell{height:100% !important; margin:0; padding:0; width:100% !important;}\r\n\r\n			#bodyCell{padding:20px;}\r\n			#templateContainer{width:600px;}\r\n\r\n			\r\n			body, #bodyTable{\r\n				/*@editable*/ background-color:#DEE0E2;\r\n			}\r\n					\r\n			#templateContainer{\r\n				/*@editable*/ border:1px solid #BBBBBB;\r\n			}\r\n\r\n			h2{\r\n				/*@editable*/ color:#404040 !important;\r\n				display:block;\r\n				/*@editable*/ font-family:Helvetica;\r\n				/*@editable*/ font-size:15px;\r\n				/*@editable*/ font-style:normal;\r\n				/*@editable*/ font-weight:bold;\r\n				/*@editable*/ line-height:100%;\r\n				/*@editable*/ letter-spacing:normal;							\r\n				margin:10px;	\r\n				margin-left:20px;	\r\n				/*@editable*/ text-align:left;\r\n			}\r\n			\r\n			h3{\r\n				/*@editable*/ color:#404040 !important;\r\n				display:block;\r\n				/*@editable*/ font-family:Helvetica;\r\n				/*@editable*/ font-size:13px;\r\n				/*@editable*/ font-style:normal;\r\n				/*@editable*/ font-weight:bold;\r\n				/*@editable*/ line-height:100%;\r\n				/*@editable*/ letter-spacing:normal;							\r\n				margin:10px;	\r\n				margin-left:20px;	\r\n				/*@editable*/ text-align:left;\r\n			}\r\n			\r\n			#templateHeader{\r\n				/*@editable*/ background-color:#F4F4F4;\r\n				/*@editable*/ border-top:1px solid #FFFFFF;\r\n				/*@editable*/ border-bottom:1px solid #CCCCCC;\r\n			}\r\n	\r\n			\r\n			.headerContent{\r\n				/*@editable*/ color:#505050;\r\n				/*@editable*/ font-family:Helvetica;\r\n				/*@editable*/ font-size:12px;\r\n				/*@editable*/ font-weight:bold;\r\n				/*@editable*/ line-height:100%;\r\n				/*@editable*/ padding-top:0;\r\n				/*@editable*/ padding-right:0;\r\n				/*@editable*/ padding-bottom:0;\r\n				/*@editable*/ padding-left:0;\r\n				/*@editable*/ text-align:left;\r\n				/*@editable*/ vertical-align:middle;\r\n			}\r\n			\r\n			.headerContent a:link, .headerContent a:visited, /* Yahoo! Mail Override */ .headerContent a .yshortcuts /* Yahoo! Mail Override */{\r\n				/*@editable*/ color:#EB4102;\r\n				/*@editable*/ font-weight:normal;\r\n				/*@editable*/ text-decoration:underline;\r\n			}\r\n\r\n			#headerImage{\r\n				height:auto;\r\n				max-width:600px;\r\n			}\r\n			\r\n\r\n			#templateBody{\r\n				/*@editable*/ background-color:#F4F4F4;\r\n				/*@editable*/ border-top:1px solid #FFFFFF;\r\n				/*@editable*/ border-bottom:1px solid #CCCCCC;\r\n			}\r\n\r\n			.bodyContent{\r\n				/*@editable*/ color:#505050;\r\n				/*@editable*/ font-family:Helvetica;\r\n				/*@editable*/ font-size:12px;\r\n				/*@editable*/ line-height:150%;\r\n				padding-top:20px;\r\n				padding-right:20px;\r\n				padding-bottom:20px;\r\n				padding-left:20px;\r\n				/*@editable*/ text-align:left;\r\n			}\r\n\r\n							\r\n\r\n            @media only screen and (max-width: 480px){\r\n				\r\n				body, table, td, p, a, li, blockquote{-webkit-text-size-adjust:none !important;} /* Prevent Webkit platforms from changing default text sizes */\r\n                body{width:100% !important; min-width:100% !important;} /* Prevent iOS Mail from adding padding to the body */\r\n\r\n				\r\n				#bodyCell{padding:10px !important;}\r\n\r\n			\r\n				#templateContainer{\r\n					max-width:600px !important;\r\n					/*@editable*/ width:100% !important;\r\n				}\r\n\r\n				h2{\r\n					/*@editable*/ font-size:20px !important;\r\n					/*@editable*/ line-height:100% !important;\r\n				}\r\n\r\n				h3{\r\n					/*@editable*/ font-size:14px !important;\r\n					/*@editable*/ line-height:100% !important;\r\n				}\r\n				\r\n				/* ======== Header Styles ======== */\r\n\r\n				#headerImage{\r\n					height:auto !important;\r\n					/*@editable*/ max-width:600px !important;\r\n					/*@editable*/ width:100% !important;\r\n				}\r\n\r\n				.headerContent{\r\n					/*@editable*/ font-size:12px !important;\r\n					/*@editable*/ line-height:125% !important;\r\n				}\r\n\r\n				.bodyContent{\r\n					/*@editable*/ font-size:12px !important;\r\n					/*@editable*/ line-height:125% !important;\r\n				}\r\n\r\n				\r\n							\r\n				\r\n			}\r\n		</style>\r\n    </head>\r\n    <body leftmargin="0" marginwidth="0" topmargin="0" marginheight="0" offset="0">\r\n    	<center>\r\n        	<table align="center" border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" id="bodyTable">\r\n            	<tr>\r\n                	<td align="center" valign="top" id="bodyCell">                    	\r\n                    	<table border="0" cellpadding="0" cellspacing="0" id="templateContainer">                        	\r\n                        	<tr>\r\n                            	<td align="center" valign="top">                                	\r\n                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" id="templateHeader">\r\n                                        <tr>\r\n                                            <td valign="top" class="headerContent">\r\n                                            	<img src="{leftimage}" style="max-width:200px;" id="headerImage" mc:label="header_image" mc:edit="header_image" mc:allowdesigner mc:allowtext />\r\n												<img src="{rightimage}" style="max-width:400px;" id="headerImage" mc:label="header_image" mc:edit="header_image" mc:allowdesigner mc:allowtext />\r\n                                            </td>\r\n                                        </tr>\r\n                                    </table>                                    \r\n                                </td>\r\n                            </tr>\r\n                        	<tr>\r\n                            	<td align="center" valign="top">                                	\r\n                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" id="templateBody">\r\n                                        <tr>\r\n                                            <td valign="top" class="bodyContent" mc:edit="body_content">\r\n												Welcome, <br><br>\r\n												{msg} <br>\r\n                                                {Username} has invited you to view {eventname} of {sitename}. To view detail <a href="{eventlink}" target="_blank">click here</a>.\r\n                                            </td>\r\n                                        </tr>\r\n										<tr>\r\n											<td class="bodyContent">\r\n												Thanks,\r\n												<br>\r\n												{Username}\r\n											</td>\r\n										</tr>\r\n                                    </table>                                \r\n                                </td>\r\n                            </tr>                        	\r\n                        </table>                        \r\n                    </td>\r\n                </tr>\r\n            </table>\r\n        </center>\r\n    </body>\r\n</html>'),
(9, 'THANKING_MAIL', 'Welcome to ##sitename##', '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">\r\n<html xmlns="http://www.w3.org/1999/xhtml">\r\n	<head>\r\n        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />               \r\n    </head>\r\n    <body leftmargin="0" marginwidth="0" topmargin="0" marginheight="0" offset="0">\r\n    	<center>\r\n        	<table width="604" bgcolor="#f0f0f0" align="center" valign="top" cellspacing="0" cellpadding="0" border="0" style="padding:10px; color:#000;" id="bodyTable">\r\n            	<tr>\r\n                	<td align="center" valign="top" id="bodyCell">                    	\r\n                    	<table border="0" cellpadding="0" cellspacing="0" id="templateContainer">                        	\r\n                        	<tr>\r\n                            	<td align="center" valign="top">                                	\r\n                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" id="templateHeader">\r\n                                        <tr>\r\n                                            <td valign="top" class="headerContent">\r\n                                            	<img src="{leftimage}" style="max-width:200px;" id="headerImage" mc:label="header_image" mc:edit="header_image" mc:allowdesigner mc:allowtext />\r\n												<img src="{rightimage}" style="max-width:400px;" id="headerImage" mc:label="header_image" mc:edit="header_image" mc:allowdesigner mc:allowtext />\r\n                                            </td>\r\n                                        </tr>\r\n                                    </table>                                    \r\n                                </td>\r\n                            </tr>\r\n                        	<tr>\r\n                            	<td align="center" valign="top">                                	\r\n                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" id="templateBody">\r\n                                        <tr>\r\n                                            <td valign="top" class="bodyContent" mc:edit="body_content">\r\n												<br>Hi {Username}, <br><br>												\r\n                                            </td>\r\n                                        </tr>\r\n																	\r\n										<tr>\r\n                                            <td valign="top" class="bodyContent" mc:edit="body_content">\r\n												Thank you for choosing {sitename}.	<br><br>\r\n												\r\n												<a href="{sitelink}" target="_blank">Click here</a> to login <br> \r\n                                            </td>\r\n                                        </tr>\r\n										\r\n										<tr>\r\n											<td class="bodyContent">\r\n												<br><br>Thanks,\r\n												<br>\r\n												{sitename} Team\r\n											</td>\r\n										</tr>\r\n                                    </table>                                \r\n                                </td>\r\n                            </tr>                        	\r\n                        </table>                        \r\n                    </td>\r\n                </tr>\r\n            </table>\r\n        </center>\r\n    </body>\r\n</html>'),
(10, 'CHANGE_PROFILE', 'Profile has been changed on ##sitename##', '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">\r\n<html xmlns="http://www.w3.org/1999/xhtml">\r\n	<head>\r\n        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />               \r\n    </head>\r\n    <body leftmargin="0" marginwidth="0" topmargin="0" marginheight="0" offset="0">\r\n    	<center>\r\n        	<table width="604" bgcolor="#f0f0f0" align="center" valign="top" cellspacing="0" cellpadding="0" border="0" style="padding:10px; color:#000;" id="bodyTable">\r\n            	<tr>\r\n                	<td align="center" valign="top" id="bodyCell">                    	\r\n                    	<table border="0" cellpadding="0" cellspacing="0" id="templateContainer">                        	\r\n                        	<tr>\r\n                            	<td align="center" valign="top">                                	\r\n                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" id="templateHeader">\r\n                                        <tr>\r\n                                            <td valign="top" class="headerContent">\r\n                                            	<img src="{leftimage}" style="max-width:200px;" id="headerImage" mc:label="header_image" mc:edit="header_image" mc:allowdesigner mc:allowtext />\r\n												<img src="{rightimage}" style="max-width:400px;" id="headerImage" mc:label="header_image" mc:edit="header_image" mc:allowdesigner mc:allowtext />\r\n                                            </td>\r\n                                        </tr>\r\n                                    </table>                                    \r\n                                </td>\r\n                            </tr>\r\n                        	<tr>\r\n                            	<td align="center" valign="top">                                	\r\n                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" id="templateBody">\r\n                                        <tr>\r\n                                            <td valign="top" class="bodyContent" mc:edit="body_content">\r\n												<br>Hi {Username}, <br><br>												\r\n                                            </td>\r\n                                        </tr>\r\n																	\r\n										<tr>\r\n                                            <td valign="top" class="bodyContent" mc:edit="body_content">\r\n												<br>Your profile has been changed successfully on {sitename}.\r\n												<br><br>\r\n												The {sitename} connects employees, departments and divisions across our enterprise. \r\n												<br>												\r\n                                            </td>\r\n                                        </tr>\r\n										\r\n										<tr>\r\n											<td class="bodyContent">\r\n												<br><br>Thanks,\r\n												<br>\r\n												{sitename} Team\r\n											</td>\r\n										</tr>\r\n                                    </table>                                \r\n                                </td>\r\n                            </tr>                        	\r\n                        </table>                        \r\n                    </td>\r\n                </tr>\r\n            </table>\r\n        </center>\r\n    </body>\r\n</html>'),
(11, 'CHANGE_PASSWORD', 'Reset password on ##sitename##', '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">\n<html xmlns="http://www.w3.org/1999/xhtml">\n	<head>\n        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />               \n    </head>\n    <body leftmargin="0" marginwidth="0" topmargin="0" marginheight="0" offset="0">\n    	<center>\n        	<table width="604" bgcolor="#f0f0f0" align="center" valign="top" cellspacing="0" cellpadding="0" border="0" style="padding:10px; color:#000;" id="bodyTable">\n            	<tr>\n                	<td align="center" valign="top" id="bodyCell">                    	\n                    	<table border="0" cellpadding="0" cellspacing="0" id="templateContainer">                        	\n                        	<tr>\n                            	<td align="center" valign="top">                                	\n                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" id="templateHeader">\n                                        <tr>\n                                            <td valign="top" class="headerContent">\n                                            	<img src="{leftimage}" style="max-width:200px;" id="headerImage" mc:label="header_image" mc:edit="header_image" mc:allowdesigner mc:allowtext />\n												<img src="{rightimage}" style="max-width:400px;" id="headerImage" mc:label="header_image" mc:edit="header_image" mc:allowdesigner mc:allowtext />\n                                            </td>\n                                        </tr>\n                                    </table>                                    \n                                </td>\n                            </tr>\n                        	<tr>\n                            	<td align="center" valign="top">                                	\n                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" id="templateBody">\n                                        <tr>\n                                            <td valign="top" class="bodyContent" mc:edit="body_content">\n												<br>Hi {Username}, <br><br>												\n                                            </td>\n                                        </tr>\n																	\n										<tr>\n                                            <td valign="top" class="bodyContent" mc:edit="body_content">\n												<br>You have changed your password successfully. Your new password is <strong>{password}</strong>\n												<br><br>												\n												<a href="{sitelink}" target="_blank">Click here</a> to login <br> \n												<br>\n											\n                                            </td>\n                                        </tr>\n										\n										<tr>\n											<td class="bodyContent">\n												<br><br>Thanks,\n												<br>\n												{sitename} Team\n											</td>\n										</tr>\n                                    </table>                                \n                                </td>\n                            </tr>                        	\n                        </table>                        \n                    </td>\n                </tr>\n            </table>\n        </center>\n    </body>\n</html>'),
(12, 'CONTACT_ENQUIRY', 'Enquiry from ##sitename##', '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">\r\n<html xmlns="http://www.w3.org/1999/xhtml">\r\n	<head>\r\n        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />               \r\n    </head>\r\n    <body leftmargin="0" marginwidth="0" topmargin="0" marginheight="0" offset="0">\r\n    	<center>\r\n        	<table width="604" bgcolor="#f0f0f0" align="center" valign="top" cellspacing="0" cellpadding="0" border="0" style="padding:10px; color:#000;" id="bodyTable">\r\n            	<tr>\r\n                	<td align="center" valign="top" id="bodyCell">                    	\r\n                    	<table border="0" cellpadding="0" cellspacing="0" id="templateContainer">                        	\r\n                        	<tr>\r\n                            	<td align="center" valign="top">                                	\r\n                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" id="templateHeader">\r\n                                        <tr>\r\n                                            <td valign="top" class="headerContent">\r\n                                            	<img src="{leftimage}" style="max-width:200px;" id="headerImage" mc:label="header_image" mc:edit="header_image" mc:allowdesigner mc:allowtext />\r\n												<img src="{rightimage}" style="max-width:400px;" id="headerImage" mc:label="header_image" mc:edit="header_image" mc:allowdesigner mc:allowtext />\r\n                                            </td>\r\n                                        </tr>\r\n                                    </table>                                    \r\n                                </td>\r\n                            </tr>\r\n                        	<tr>\r\n                            	<td align="center" valign="top">                                	\r\n                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" id="templateBody">\r\n                                        <tr>\r\n                                            <td valign="top" colspan="2" class="bodyContent" mc:edit="body_content">\r\n												<br>Hello , \r\n                                            </td>\r\n                                        </tr>\r\n										<tr>\r\n											<td valign="top" colspan="2" class="bodyContent" mc:edit="body_content">\r\n											<br><br>You have received a new message from enquiries form on your website.<br><br>\r\n											</td>\r\n										</tr>\r\n										<tr>\r\n											<td width="130px"><strong>Name :</strong></td>\r\n											<td>{contactName}</td>\r\n										</tr>\r\n										<tr>\r\n											<td><strong>Email Address :</strong></td>\r\n											<td>{contactEmail}</td>\r\n										</tr>\r\n										<tr>\r\n											<td><strong>Contact No :</strong></td>\r\n											<td>{contactPhone}</td>\r\n										</tr>\r\n										<tr>\r\n											<td><strong>Message :</strong></td>\r\n											<td>{contactMessage}</td>\r\n										</tr>\r\n										<tr>\r\n											<td class="bodyContent">\r\n												<br><br>\r\n												Thanks,\r\n												<br>\r\n												{sitename}\r\n											</td>\r\n										</tr>\r\n                                    </table>                                \r\n                                </td>\r\n                            </tr>                        	\r\n                        </table>                        \r\n                    </td>\r\n                </tr>\r\n            </table>\r\n        </center>\r\n    </body>\r\n</html>'),
(13, 'KNOWLEDGEBASE_SHARE', 'Knowledgebase sharing from ##Username## on ##sitename##', '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">\r\n<html xmlns="http://www.w3.org/1999/xhtml">\r\n	<head>\r\n        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />\r\n        <title></title>\r\n        <style type="text/css">\r\n			#outlook a{padding:0;} /* Force Outlook to provide a "view in browser" message */\r\n			.ReadMsgBody{width:100%;} .ExternalClass{width:100%;} /* Force Hotmail to display emails at full width */\r\n			.ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div {line-height: 100%;} /* Force Hotmail to display normal line spacing */\r\n			body, table, td, p, a, li, blockquote{-webkit-text-size-adjust:100%; -ms-text-size-adjust:100%;} /* Prevent WebKit and Windows mobile changing default text sizes */\r\n			table, td{mso-table-lspace:0pt; mso-table-rspace:0pt;} /* Remove spacing between tables in Outlook 2007 and up */\r\n			img{-ms-interpolation-mode:bicubic;} /* Allow smoother rendering of resized image in Internet Explorer */\r\n\r\n			\r\n			body{margin:0; padding:0;}\r\n			img{border:0; height:auto; line-height:100%; outline:none; text-decoration:none;}\r\n			table{border-collapse:collapse !important;}\r\n			body, #bodyTable, #bodyCell{height:100% !important; margin:0; padding:0; width:100% !important;}\r\n\r\n			#bodyCell{padding:20px;}\r\n			#templateContainer{width:600px;}\r\n\r\n			\r\n			body, #bodyTable{\r\n				/*@editable*/ background-color:#DEE0E2;\r\n			}\r\n					\r\n			#templateContainer{\r\n				/*@editable*/ border:1px solid #BBBBBB;\r\n			}\r\n\r\n			h2{\r\n				/*@editable*/ color:#404040 !important;\r\n				display:block;\r\n				/*@editable*/ font-family:Helvetica;\r\n				/*@editable*/ font-size:15px;\r\n				/*@editable*/ font-style:normal;\r\n				/*@editable*/ font-weight:bold;\r\n				/*@editable*/ line-height:100%;\r\n				/*@editable*/ letter-spacing:normal;							\r\n				margin:10px;	\r\n				margin-left:20px;	\r\n				/*@editable*/ text-align:left;\r\n			}\r\n			\r\n			h3{\r\n				/*@editable*/ color:#404040 !important;\r\n				display:block;\r\n				/*@editable*/ font-family:Helvetica;\r\n				/*@editable*/ font-size:13px;\r\n				/*@editable*/ font-style:normal;\r\n				/*@editable*/ font-weight:bold;\r\n				/*@editable*/ line-height:100%;\r\n				/*@editable*/ letter-spacing:normal;							\r\n				margin:10px;	\r\n				margin-left:20px;	\r\n				/*@editable*/ text-align:left;\r\n			}\r\n			\r\n			#templateHeader{\r\n				/*@editable*/ background-color:#F4F4F4;\r\n				/*@editable*/ border-top:1px solid #FFFFFF;\r\n				/*@editable*/ border-bottom:1px solid #CCCCCC;\r\n			}\r\n	\r\n			\r\n			.headerContent{\r\n				/*@editable*/ color:#505050;\r\n				/*@editable*/ font-family:Helvetica;\r\n				/*@editable*/ font-size:12px;\r\n				/*@editable*/ font-weight:bold;\r\n				/*@editable*/ line-height:100%;\r\n				/*@editable*/ padding-top:0;\r\n				/*@editable*/ padding-right:0;\r\n				/*@editable*/ padding-bottom:0;\r\n				/*@editable*/ padding-left:0;\r\n				/*@editable*/ text-align:left;\r\n				/*@editable*/ vertical-align:middle;\r\n			}\r\n			\r\n			.headerContent a:link, .headerContent a:visited, /* Yahoo! Mail Override */ .headerContent a .yshortcuts /* Yahoo! Mail Override */{\r\n				/*@editable*/ color:#EB4102;\r\n				/*@editable*/ font-weight:normal;\r\n				/*@editable*/ text-decoration:underline;\r\n			}\r\n\r\n			#headerImage{\r\n				height:auto;\r\n				max-width:600px;\r\n			}\r\n			\r\n\r\n			#templateBody{\r\n				/*@editable*/ background-color:#F4F4F4;\r\n				/*@editable*/ border-top:1px solid #FFFFFF;\r\n				/*@editable*/ border-bottom:1px solid #CCCCCC;\r\n			}\r\n\r\n			.bodyContent{\r\n				/*@editable*/ color:#505050;\r\n				/*@editable*/ font-family:Helvetica;\r\n				/*@editable*/ font-size:12px;\r\n				/*@editable*/ line-height:150%;\r\n				padding-top:20px;\r\n				padding-right:20px;\r\n				padding-bottom:20px;\r\n				padding-left:20px;\r\n				/*@editable*/ text-align:left;\r\n			}\r\n\r\n							\r\n\r\n            @media only screen and (max-width: 480px){\r\n				\r\n				body, table, td, p, a, li, blockquote{-webkit-text-size-adjust:none !important;} /* Prevent Webkit platforms from changing default text sizes */\r\n                body{width:100% !important; min-width:100% !important;} /* Prevent iOS Mail from adding padding to the body */\r\n\r\n				\r\n				#bodyCell{padding:10px !important;}\r\n\r\n			\r\n				#templateContainer{\r\n					max-width:600px !important;\r\n					/*@editable*/ width:100% !important;\r\n				}\r\n\r\n				h2{\r\n					/*@editable*/ font-size:20px !important;\r\n					/*@editable*/ line-height:100% !important;\r\n				}\r\n\r\n				h3{\r\n					/*@editable*/ font-size:14px !important;\r\n					/*@editable*/ line-height:100% !important;\r\n				}\r\n				\r\n				/* ======== Header Styles ======== */\r\n\r\n				#headerImage{\r\n					height:auto !important;\r\n					/*@editable*/ max-width:600px !important;\r\n					/*@editable*/ width:100% !important;\r\n				}\r\n\r\n				.headerContent{\r\n					/*@editable*/ font-size:12px !important;\r\n					/*@editable*/ line-height:125% !important;\r\n				}\r\n\r\n				.bodyContent{\r\n					/*@editable*/ font-size:12px !important;\r\n					/*@editable*/ line-height:125% !important;\r\n				}\r\n\r\n				\r\n							\r\n				\r\n			}\r\n		</style>\r\n    </head>\r\n    <body leftmargin="0" marginwidth="0" topmargin="0" marginheight="0" offset="0">\r\n    	<center>\r\n        	<table align="center" border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" id="bodyTable">\r\n            	<tr>\r\n                	<td align="center" valign="top" id="bodyCell">                    	\r\n                    	<table border="0" cellpadding="0" cellspacing="0" id="templateContainer">                        	\r\n                        	<tr>\r\n                            	<td align="center" valign="top">                                	\r\n                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" id="templateHeader">\r\n                                        <tr>\r\n                                            <td valign="top" class="headerContent">\r\n                                            	<img src="{leftimage}" style="max-width:200px;" id="headerImage" mc:label="header_image" mc:edit="header_image" mc:allowdesigner mc:allowtext />\r\n												<img src="{rightimage}" style="max-width:400px;" id="headerImage" mc:label="header_image" mc:edit="header_image" mc:allowdesigner mc:allowtext />\r\n                                            </td>\r\n                                        </tr>\r\n                                    </table>                                    \r\n                                </td>\r\n                            </tr>\r\n                        	<tr>\r\n                            	<td align="center" valign="top">                                	\r\n                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" id="templateBody">\r\n                                        <tr>\r\n                                            <td valign="top" class="bodyContent" mc:edit="body_content">\r\n												Welcome, <br><br>\r\n												{msg} <br>\r\n                                                {Username} has invited you to view {kname} of {sitename}. To view detail <a href="{klink}" target="_blank">click here</a>.\r\n                                            </td>\r\n                                        </tr>\r\n										<tr>\r\n											<td class="bodyContent">\r\n												Thanks,\r\n												<br>\r\n												{Username}\r\n											</td>\r\n										</tr>\r\n                                    </table>                                \r\n                                </td>\r\n                            </tr>                        	\r\n                        </table>                        \r\n                    </td>\r\n                </tr>\r\n            </table>\r\n        </center>\r\n    </body>\r\n</html>');

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE IF NOT EXISTS `locations` (
  `loc_id` int(11) NOT NULL AUTO_INCREMENT,
  `loc_name` varchar(255) DEFAULT NULL,
  `loc_status` smallint(1) DEFAULT NULL,
  `loc_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`loc_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`loc_id`, `loc_name`, `loc_status`, `loc_created`) VALUES
(1, 'Andheri', 1, '2019-01-09 07:08:44'),
(2, 'Thane West', 1, '2019-01-09 07:08:44'),
(3, 'Thane East', 1, '2019-01-13 10:24:48'),
(4, 'Vashi', 1, '2019-01-13 10:24:48');

-- --------------------------------------------------------

--
-- Table structure for table `multiple_order`
--

CREATE TABLE IF NOT EXISTS `multiple_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `discription` text NOT NULL,
  `hsn` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `unit_price` int(11) NOT NULL,
  `gross_total` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `multiple_order`
--

INSERT INTO `multiple_order` (`id`, `order_id`, `discription`, `hsn`, `quantity`, `unit_price`, `gross_total`, `total`) VALUES
(1, 1, '2 TAP FITTING ', '123', 2, 300, 600, 600),
(2, 2, 'TEst Description', '1', 10, 9, 108, 90),
(3, 2, 'Test 2', '121', 3, 6, 108, 18),
(4, 3, 'Test', '12', 2, 20, 290, 40),
(5, 3, 'Test2', '21', 5, 50, 290, 250);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE IF NOT EXISTS `notifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `to_user_id` int(11) NOT NULL,
  `display_text` text NOT NULL,
  `status` float NOT NULL COMMENT '0-unread 1-read',
  `view_status` float NOT NULL COMMENT '0-seen 1-unseen',
  `type` int(2) NOT NULL,
  `notes` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `to_user_id`, `display_text`, `status`, `view_status`, `type`, `notes`) VALUES
(1, 2, 'Welcome to Ashling Team.', 1, 0, 1, NULL),
(2, 3, 'Welcome to Ashling Team.', 1, 0, 1, NULL),
(3, 1, 'You liked your own update', 1, 0, 1, NULL),
(4, 4, 'Welcome to Ashling Team.', 0, 1, 1, NULL),
(5, 5, 'Welcome to Ashling Team.', 1, 0, 1, NULL),
(6, 6, 'Welcome to Ashling Team.', 1, 0, 1, NULL),
(7, 7, 'Welcome to Ashling Team.', 0, 1, 1, NULL),
(8, 8, 'Welcome toCannaboish', 0, 1, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) DEFAULT NULL,
  `createdby_id` int(11) DEFAULT NULL,
  `gm_id` int(11) DEFAULT NULL,
  `director_id` int(11) DEFAULT NULL,
  `accountant_id` int(11) DEFAULT NULL,
  `party_name` varchar(255) DEFAULT NULL,
  `task_details` text NOT NULL,
  `amount` double(11,2) NOT NULL,
  `paid_amount` decimal(10,2) DEFAULT NULL,
  `description` text,
  `tax_id` int(11) NOT NULL,
  `document_name` varchar(255) DEFAULT NULL,
  `order_priority` enum('low','medium','high') DEFAULT 'low',
  `gm_status` enum('pending','inprocess','cancel','approved','completed') DEFAULT NULL,
  `gm_comment` text,
  `gm_status_date` datetime DEFAULT NULL,
  `director_status` enum('pending','inprocess','cancel','approved','completed') DEFAULT NULL,
  `director_comment` text,
  `director_status_date` datetime DEFAULT NULL,
  `accountant_status` enum('pending','inprocess','cancel','approved','completed') DEFAULT NULL,
  `accountant_comment` text,
  `accountant_status_date` datetime DEFAULT NULL,
  `task_status` varchar(100) DEFAULT NULL,
  `order_status` enum('pending','inprocess','cancel','approved','completed') DEFAULT NULL,
  `status_date` datetime DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `company_id`, `createdby_id`, `gm_id`, `director_id`, `accountant_id`, `party_name`, `task_details`, `amount`, `paid_amount`, `description`, `tax_id`, `document_name`, `order_priority`, `gm_status`, `gm_comment`, `gm_status_date`, `director_status`, `director_comment`, `director_status_date`, `accountant_status`, `accountant_comment`, `accountant_status_date`, `task_status`, `order_status`, `status_date`, `created_date`) VALUES
(1, 20, 78, 54, 1, 51, '2', 'PLUMBING FOR  PTLO', 708.00, '554.00', '', 6, '', 'high', 'approved', '50% Adavnce on high priority', '2019-10-18 10:36:03', 'approved', 'Approved', '2019-10-18 10:36:53', 'pending', 'PAyment 2', '2019-10-18 11:14:55', 'pending', 'approved', '2019-10-18 11:14:55', '2019-10-18 05:44:55'),
(2, 10, 57, 49, NULL, NULL, '7', 'Test Task 1', 113.00, NULL, NULL, 1, '', 'medium', 'cancel', 'Test Reason', '2020-02-17 15:28:00', NULL, NULL, NULL, NULL, NULL, NULL, 'pending', 'cancel', NULL, '2020-02-17 09:58:00'),
(3, 4, 79, 49, 1, 51, '1', 'Test', 305.00, '305.00', NULL, 1, 'chat_document_(4).pdf', 'medium', 'approved', 'Test', '2020-02-17 15:28:24', 'approved', 'Approved', '2020-02-17 15:30:38', 'approved', 'sdfsgf', '2020-02-17 15:33:31', 'pending', 'approved', '2020-02-17 15:33:31', '2020-02-17 10:03:31');

-- --------------------------------------------------------

--
-- Table structure for table `order_status_history`
--

CREATE TABLE IF NOT EXISTS `order_status_history` (
  `status_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) DEFAULT NULL,
  `changed_by_id` int(11) DEFAULT NULL,
  `order_status` varchar(200) DEFAULT NULL,
  `order_comment` text,
  `Changed_date` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`status_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `order_status_history`
--

INSERT INTO `order_status_history` (`status_id`, `order_id`, `changed_by_id`, `order_status`, `order_comment`, `Changed_date`) VALUES
(1, 1, 78, 'pending', '', '2019-10-18 10:20:10'),
(2, 1, 54, 'inprocess', '50% Adavnce on high priority', '2019-10-18 10:36:03'),
(3, 1, 1, 'approved', 'Approved', '2019-10-18 10:36:53'),
(4, 1, 51, 'approved', 'hjsagdmm', '2019-10-18 10:39:38'),
(5, 1, 51, 'pending', 'PAyment 2', '2019-10-18 11:14:55'),
(6, 2, 57, 'pending', '', '2020-02-17 09:51:52'),
(7, 3, 79, 'pending', '', '2020-02-17 09:55:37'),
(8, 2, 49, 'cancel', 'Test Reason', '2020-02-17 09:58:00'),
(9, 3, 49, 'inprocess', 'Test', '2020-02-17 09:58:24'),
(10, 3, 1, 'approved', 'Approved', '2020-02-17 10:00:39'),
(11, 3, 51, 'approved', 'Test', '2020-02-17 10:02:42'),
(12, 3, 51, 'approved', 'sdfsgf', '2020-02-17 10:03:31');

-- --------------------------------------------------------

--
-- Table structure for table `payment_transactions`
--

CREATE TABLE IF NOT EXISTS `payment_transactions` (
  `payment_id` int(11) NOT NULL AUTO_INCREMENT,
  `payby_user_id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `payment_method` enum('cheque','cash','online') DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL,
  `payment_type` enum('dr','cr') NOT NULL DEFAULT 'cr',
  `description` text,
  `total_amount` double(11,2) DEFAULT NULL,
  `transaction_date` datetime DEFAULT NULL,
  `status` varchar(200) DEFAULT NULL COMMENT '0-pending,1-cancelled,2-completed,3-failed,4-invalid',
  PRIMARY KEY (`payment_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `payment_transactions`
--

INSERT INTO `payment_transactions` (`payment_id`, `payby_user_id`, `vendor_id`, `payment_method`, `order_id`, `payment_type`, `description`, `total_amount`, `transaction_date`, `status`) VALUES
(1, 51, 2, 'online', 1, 'dr', 'hjsagdmm', 354.00, '2019-10-18 10:39:38', 'approved'),
(2, 51, 2, 'cheque', 1, 'dr', 'PAyment 2', 200.00, '2019-10-18 11:14:55', 'pending'),
(3, 51, 1, 'cheque', 3, 'dr', 'Test', 200.00, '2020-02-17 15:32:42', 'approved'),
(4, 51, 1, 'cash', 3, 'dr', 'sdfsgf', 105.00, '2020-02-17 15:33:31', 'approved');

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE IF NOT EXISTS `setting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `setting_key` varchar(255) DEFAULT NULL,
  `setting_value` text,
  `setting_status` smallint(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=69 ;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`id`, `setting_key`, `setting_value`, `setting_status`) VALUES
(1, 'SITE_NAME', 'Yellow Banana Food Pvt Ltd', 1),
(2, 'SITE_LOGO', '20739103805a83f44dcc2005.38501841_logo.png', 1),
(3, 'ADMIN_THEME', 'sb-admin_blue', 1),
(4, 'ROWS_PER_PAGE', '20', 1),
(5, 'FACEBOOK_URL', 'facebook.com', 1),
(6, 'TWITTER_URL', 'twitter.com', 1),
(7, 'GOOGLE_URL', 'google.com', 1),
(8, 'CONTACT_PHONE', '88888888888888', 1),
(11, 'CONTACT_EMAIL', 'contact@gmail.com', 1),
(12, 'LEFTPANEL', '1', 1),
(26, 'UPDATE_THUMB_WIDTH', '559', 1),
(27, 'UPDATE_THUMB_HEIGHT', '315', 1),
(28, 'PER_PAGE_RECORD', '10', 1),
(40, 'ADMIN_SITE_LOGO', 'admin_logo.png', 1),
(46, 'TIME_ZONE_FOR_DB', 'America/New_York', 1),
(64, 'SMTP_EMAIL', 'atulyadav.genie@gmail.com', 1),
(65, 'SMTP_EMAIL_PASSWORD', 'genie@123', 1),
(67, 'SMTP_EMAIL_HOST', 'localhost', 1),
(68, 'SMTP_EMAIL_PORT', '25', 1);

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

CREATE TABLE IF NOT EXISTS `state` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `country_id` int(11) NOT NULL,
  `name` varchar(75) NOT NULL,
  `code` varchar(5) NOT NULL,
  `status` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=396 ;

--
-- Dumping data for table `state`
--

INSERT INTO `state` (`id`, `country_id`, `name`, `code`, `status`) VALUES
(1, 1, 'New York', 'NY', 1),
(2, 1, 'Virgin Islands', 'VI', 1),
(3, 1, 'Massachusetts', 'MA', 1),
(4, 1, 'Rhode Island', 'RI', 1),
(5, 1, 'New Hampshire', 'NH', 1),
(6, 1, 'Maine', 'ME', 1),
(7, 1, 'Vermont', 'VT', 1),
(8, 1, 'Connecticut', 'CT', 1),
(9, 1, 'New Jersey', 'NJ', 1),
(10, 1, 'Pennsylvania', 'PA', 1),
(11, 1, 'Delaware', 'DE', 1),
(12, 1, 'District Of Columbia', 'DC', 1),
(13, 1, 'Maryland', 'MD', 1),
(14, 1, 'West Virginia', 'WV', 1),
(15, 1, 'Texas', 'TX', 1),
(16, 1, 'South Carolina', 'SC', 1),
(17, 1, 'Georgia', 'GA', 1),
(18, 1, 'Florida', 'FL', 1),
(19, 1, 'North Carolina', 'NC', 1),
(20, 1, 'Tennessee', 'TN', 1),
(21, 1, 'Mississippi', 'MS', 1),
(22, 1, 'Kentucky', 'KY', 1),
(23, 1, 'Ohio', 'OH', 1),
(24, 1, 'Indiana', 'IN', 1),
(25, 1, 'Michigan', 'MI', 1),
(26, 1, 'Iowa', 'IA', 1),
(27, 1, 'Wisconsin', 'WI', 1),
(28, 1, 'Minnesota', 'MN', 1),
(29, 1, 'South Dakota', 'SD', 1),
(30, 1, 'North Dakota', 'ND', 1),
(31, 1, 'Montana', 'MT', 1),
(32, 1, 'Illinois', 'IL', 1),
(33, 1, 'Missouri', 'MO', 1),
(34, 1, 'Kansas', 'KS', 1),
(35, 1, 'Nebraska', 'NE', 1),
(36, 1, 'Louisiana', 'LA', 1),
(37, 1, 'Arkansas', 'AR', 1),
(38, 1, 'Oklahoma', 'OK', 1),
(39, 1, 'Colorado', 'CO', 1),
(40, 1, 'Wyoming', 'WY', 1),
(41, 1, 'Idaho', 'ID', 1),
(42, 1, 'Utah', 'UT', 1),
(43, 1, 'Arizona', 'AZ', 1),
(44, 1, 'New Mexico', 'NM', 1),
(45, 1, 'Nevada', 'NV', 1),
(46, 1, 'California', 'CA', 1),
(47, 1, 'Hawaii', 'HI', 1),
(48, 1, 'Oregon', 'OR', 1),
(49, 1, 'Washington', 'WA', 1),
(50, 1, 'Alaska', 'AK', 1),
(51, 1, 'Alabama', 'AL', 1),
(52, 1, 'Virginia', 'VA', 1),
(53, 101, 'Maharastra', 'MH', 1),
(54, 101, 'West Bengal', 'WB', 1),
(55, 101, 'Gujarat', 'GJ', 1),
(56, 162, 'North', '', 1),
(57, 101, 'New Delhi', '', 1),
(64, 101, 'Rajasthan', '', 1),
(65, 101, 'Punjab', '', 1),
(67, 101, 'Karnataka', '', 1),
(68, 101, 'Madhya Pradesh', '', 1),
(69, 2, 'Kabul', '', 1),
(70, 101, 'Kerala', '', 1),
(71, 101, 'Himachal Pradesh', '', 1),
(72, 101, 'Uttar Pradesh', '', 1),
(73, 101, 'Tamil Nadu', '', 1),
(74, 101, 'Orissa', '', 1),
(75, 101, 'Goa', '', 1),
(77, 101, 'Bihar', '', 1),
(78, 101, 'Haryana', '', 1),
(79, 101, 'Jharkhand', '', 1),
(80, 101, 'Manipur', '', 1),
(81, 101, 'Meghalaya', '', 1),
(82, 101, 'Maharashtra', '', 1),
(83, 101, 'Arunachal Pradesh', '', 1),
(86, 101, 'Gujarat', 'GJ', 1),
(87, 101, 'Assam', '', 1),
(88, 223, 'Brent', '', 1),
(89, 223, 'Bexley', '', 1),
(90, 223, 'Belfast', '', 1),
(91, 223, 'Bridgend', '', 1),
(92, 223, 'Blaenau Gwent', '', 1),
(93, 223, 'Birmingham', '', 1),
(94, 223, 'Buckinghamshire', '', 1),
(95, 223, 'Ballymena', '', 1),
(96, 223, 'Ballymoney', '', 1),
(97, 223, 'Bournemouth', '', 1),
(98, 223, 'Banbridge', '', 1),
(99, 223, 'Barnet', '', 1),
(100, 223, 'Brighton And Hove', '', 1),
(101, 223, 'Barnsley', '', 1),
(102, 223, 'Bolton', '', 1),
(103, 223, 'Blackpool', '', 1),
(104, 223, 'Bracknell Forest', '', 1),
(105, 223, 'Bradford', '', 1),
(106, 223, 'Bromley', '', 1),
(107, 223, 'Bristol', '', 1),
(108, 223, 'Bury', '', 1),
(109, 223, 'Cambridgeshire', '', 1),
(110, 223, 'Caerphilly', '', 1),
(111, 223, 'Ceredigion', '', 1),
(112, 223, 'Craigavon', '', 1),
(113, 223, 'Cheshire', '', 1),
(114, 223, 'Carrickfergus', '', 1),
(115, 223, 'Cookstown', '', 1),
(116, 223, 'Calderdale', '', 1),
(117, 223, 'Clackmannanshire', '', 1),
(118, 223, 'Coleraine', '', 1),
(119, 223, 'Cumbria', '', 1),
(120, 223, 'Camden', '', 1),
(121, 223, 'Carmarthenshire', '', 1),
(122, 223, 'Cornwall', '', 1),
(123, 223, 'Coventry', '', 1),
(124, 223, 'Cardiff', '', 1),
(125, 223, 'Croydon', '', 1),
(126, 223, 'Castlereagh', '', 1),
(127, 223, 'Conwy', '', 1),
(128, 223, 'Darlington', '', 1),
(129, 223, 'Derbyshire', '', 1),
(130, 223, 'Denbighshire', '', 1),
(131, 223, 'Derby', '', 1),
(132, 223, 'Devon', '', 1),
(133, 223, 'Dungannon And South Tyrone', '', 1),
(134, 223, 'Dumfries And Galloway', '', 1),
(135, 223, 'Doncaster', '', 1),
(136, 223, 'Dundee', '', 1),
(137, 223, 'Dorset', '', 1),
(138, 223, 'Down', '', 1),
(139, 223, 'Derry', '', 1),
(140, 223, 'Dudley', '', 1),
(141, 223, 'Durham', '', 1),
(142, 223, 'Ealing', '', 1),
(143, 223, 'East Ayrshire', '', 1),
(144, 223, 'Edinburgh', '', 1),
(145, 223, 'East Dunbartonshire', '', 1),
(146, 223, 'East Lothian', '', 1),
(147, 223, 'Eilean Siar', '', 1),
(148, 223, 'Enfield', '', 1),
(149, 223, 'East Renfrewshire', '', 1),
(150, 223, 'East Riding Of Yorkshire', '', 1),
(151, 223, 'Essex', '', 1),
(152, 223, 'East Sussex', '', 1),
(153, 223, 'Falkirk', '', 1),
(154, 223, 'Fermanagh', '', 1),
(155, 223, 'Fife', '', 1),
(156, 223, 'Flintshire', '', 1),
(157, 223, 'Gateshead', '', 1),
(158, 223, 'Glasgow', '', 1),
(159, 223, 'Gloucestershire', '', 1),
(160, 223, 'Greenwich', '', 1),
(161, 223, 'Guernsey', '', 1),
(162, 223, 'Gwynedd', '', 1),
(163, 223, 'Halton', '', 1),
(164, 223, 'Hampshire', '', 1),
(165, 223, 'Havering', '', 1),
(166, 223, 'Hackney', '', 1),
(167, 223, 'Herefordshire', '', 1),
(168, 223, 'Hillingdon', '', 1),
(169, 223, 'Highland', '', 1),
(170, 223, 'Hammersmith And Fulham', '', 1),
(171, 223, 'Hounslow', '', 1),
(172, 223, 'Hartlepool', '', 1),
(173, 223, 'Hertfordshire', '', 1),
(174, 223, 'Harrow', '', 1),
(175, 223, 'Haringey', '', 1),
(176, 223, 'Isles Of Scilly', '', 1),
(177, 223, 'Isle Of Wight', '', 1),
(178, 223, 'Islington', '', 1),
(179, 223, 'Inverclyde', '', 1),
(180, 223, 'Jersey', '', 1),
(181, 223, 'Kensington And Chelsea', '', 1),
(182, 223, 'Kent', '', 1),
(183, 223, 'Kingston Upon Hull', '', 1),
(184, 223, 'Kirklees', '', 1),
(185, 223, 'Kingston Upon Thames', '', 1),
(186, 223, 'Knowsley', '', 1),
(187, 223, 'Lancashire', '', 1),
(188, 223, 'Lambeth', '', 1),
(189, 223, 'Leicester', '', 1),
(190, 223, 'Leeds', '', 1),
(191, 223, 'Leicestershire', '', 1),
(192, 223, 'Lewisham', '', 1),
(193, 223, 'Lincolnshire', '', 1),
(194, 223, 'Liverpool', '', 1),
(195, 223, 'Limavady', '', 1),
(196, 223, 'London', '', 1),
(197, 223, 'Larne', '', 1),
(198, 223, 'Lisburn', '', 1),
(199, 223, 'Luton', '', 1),
(200, 223, 'Manchester', '', 1),
(201, 223, 'Middlesbrough', '', 1),
(202, 223, 'Medway', '', 1),
(203, 223, 'Magherafelt', '', 1),
(204, 223, 'Milton Keynes', '', 1),
(205, 223, 'Midlothian', '', 1),
(206, 223, 'Monmouthshire', '', 1),
(207, 223, 'Merton', '', 1),
(208, 223, 'Moray', '', 1),
(209, 223, 'Merthyr Tydfil', '', 1),
(210, 223, 'Moyle', '', 1),
(211, 223, 'North Ayrshire', '', 1),
(212, 223, 'Northumberland', '', 1),
(213, 223, 'North Down', '', 1),
(214, 223, 'North East Lincolnshire', '', 1),
(215, 223, 'Newcastle Upon Tyne', '', 1),
(216, 223, 'Norfolk', '', 1),
(217, 223, 'Nottingham', '', 1),
(218, 223, 'North Lanarkshire', '', 1),
(219, 223, 'North Lincolnshire', '', 1),
(220, 223, 'North Somerset', '', 1),
(221, 223, 'Newtownabbey', '', 1),
(222, 223, 'Northamptonshire', '', 1),
(223, 223, 'Neath Port Talbot', '', 1),
(224, 223, 'Nottinghamshire', '', 1),
(225, 223, 'North Tyneside', '', 1),
(226, 223, 'Newham', '', 1),
(227, 223, 'Newport', '', 1),
(228, 223, 'North Yorkshire', '', 1),
(229, 223, 'Newry And Mourne', '', 1),
(230, 223, 'Oldham', '', 1),
(231, 223, 'Omagh', '', 1),
(232, 223, 'Orkney Islands', '', 1),
(233, 223, 'Oxfordshire', '', 1),
(234, 223, 'Pembrokeshire', '', 1),
(235, 223, 'Perth And Kinross', '', 1),
(236, 223, 'Plymouth', '', 1),
(237, 223, 'Poole', '', 1),
(238, 223, 'Portsmouth', '', 1),
(239, 223, 'Powys', '', 1),
(240, 223, 'Peterborough', '', 1),
(241, 223, 'Redcar And Cleveland', '', 1),
(242, 223, 'Rochdale', '', 1),
(243, 223, 'Rhondda Cynon Taf', '', 1),
(244, 223, 'Redbridge', '', 1),
(245, 223, 'Reading', '', 1),
(246, 223, 'Renfrewshire', '', 1),
(247, 223, 'Richmond Upon Thames', '', 1),
(248, 223, 'Rotherham', '', 1),
(249, 223, 'Rutland', '', 1),
(250, 223, 'Sandwell', '', 1),
(251, 223, 'South Ayrshire', '', 1),
(252, 223, 'Scottish Borders', '', 1),
(253, 223, 'Suffolk', '', 1),
(254, 223, 'Sefton', '', 1),
(255, 223, 'South Gloucestershire', '', 1),
(256, 223, 'Sheffield', '', 1),
(257, 223, 'St Helens', '', 1),
(258, 223, 'Shropshire', '', 1),
(259, 223, 'Stockport', '', 1),
(260, 223, 'Salford', '', 1),
(261, 223, 'Slough', '', 1),
(262, 223, 'South Lanarkshire', '', 1),
(263, 223, 'Sunderland', '', 1),
(264, 223, 'Solihull', '', 1),
(265, 223, 'Somerset', '', 1),
(266, 223, 'Southend-on-sea', '', 1),
(267, 223, 'Surrey', '', 1),
(268, 223, 'Strabane', '', 1),
(269, 223, 'Stoke-on-trent', '', 1),
(270, 223, 'Stirling', '', 1),
(271, 223, 'Southampton', '', 1),
(272, 223, 'Sutton', '', 1),
(273, 223, 'Staffordshire', '', 1),
(274, 223, 'Stockton-on-tees', '', 1),
(275, 223, 'South Tyneside', '', 1),
(276, 223, 'Swansea', '', 1),
(277, 223, 'Swindon', '', 1),
(278, 223, 'Southwark', '', 1),
(279, 223, 'Tameside', '', 1),
(280, 223, 'Telford And Wrekin', '', 1),
(281, 223, 'Thurrock', '', 1),
(282, 223, 'Torbay', '', 1),
(283, 223, 'Torfaen', '', 1),
(284, 223, 'Trafford', '', 1),
(285, 223, 'Tower Hamlets', '', 1),
(286, 223, 'Vale Of Glamorgan', '', 1),
(287, 223, 'Warwickshire', '', 1),
(288, 223, 'West Berkshire', '', 1),
(289, 223, 'West Dunbartonshire', '', 1),
(290, 223, 'Waltham Forest', '', 1),
(291, 223, 'Wigan', '', 1),
(292, 223, 'Wiltshire', '', 1),
(293, 223, 'Wakefield', '', 1),
(294, 223, 'Walsall', '', 1),
(295, 223, 'West Lothian', '', 1),
(296, 223, 'Wolverhampton', '', 1),
(297, 223, 'Wandsworth', '', 1),
(298, 223, 'Windsor And Maidenhead', '', 1),
(299, 223, 'Wokingham', '', 1),
(300, 223, 'Worcestershire', '', 1),
(301, 223, 'Wirral', '', 1),
(302, 223, 'Warrington', '', 1),
(303, 223, 'Wrexham', '', 1),
(304, 223, 'Westminster', '', 1),
(305, 223, 'West Sussex', '', 1),
(306, 223, 'York', '', 1),
(307, 223, 'Shetland Islands', '', 1),
(308, 104, 'Cork', '', 1),
(309, 104, 'Clare', '', 1),
(310, 104, 'Cavan', '', 1),
(311, 104, 'Carlow', '', 1),
(312, 104, 'Dublin', '', 1),
(313, 104, 'Donegal', '', 1),
(314, 104, 'Galway', '', 1),
(315, 104, 'Kildare', '', 1),
(316, 104, 'Kilkenny', '', 1),
(317, 104, 'Kerry', '', 1),
(318, 104, 'Longford', '', 1),
(319, 104, 'Louth', '', 1),
(320, 104, 'Limerick', '', 1),
(321, 104, 'Leitrim', '', 1),
(322, 104, 'Laois', '', 1),
(323, 104, 'Meath', '', 1),
(324, 104, 'Monaghan', '', 1),
(325, 104, 'Mayo', '', 1),
(326, 104, 'Offaly', '', 1),
(327, 104, 'Roscommon', '', 1),
(328, 104, 'Sligo', '', 1),
(329, 104, 'Tipperary', '', 1),
(330, 104, 'Waterford', '', 1),
(331, 104, 'Westmeath', '', 1),
(332, 104, 'Wicklow', '', 1),
(333, 104, 'Wexford', '', 1),
(350, 14, 'Australian Capital Territory', '', 1),
(351, 14, 'New South Wales', '', 1),
(352, 14, 'Northern Territory', '', 1),
(353, 14, 'Queensland', '', 1),
(354, 14, 'South Australia', '', 1),
(355, 14, 'Tasmania', '', 1),
(356, 14, 'Victoria', '', 1),
(357, 14, 'Western Australia', '', 1),
(358, 155, 'Auckland', '', 1),
(359, 155, 'Bay Of Plenty', '', 1),
(360, 155, 'Canterbury', '', 1),
(361, 155, 'Gisborne', '', 1),
(362, 155, 'Hawke''s Bay', '', 1),
(363, 155, 'Marlborough', '', 1),
(364, 155, 'Manawatu-wanganui', '', 1),
(365, 155, 'Nelson', '', 1),
(366, 155, 'Northland', '', 1),
(367, 155, 'Otago', '', 1),
(368, 155, 'Southland', '', 1),
(369, 155, 'Tasman', '', 1),
(370, 155, 'Taranaki', '', 1),
(371, 155, 'Wellington', '', 1),
(372, 155, 'Waikato', '', 1),
(373, 155, 'West Coast', '', 1),
(374, 83, 'Berlin', '', 1),
(375, 83, 'Brandenburg', '', 1),
(376, 83, 'Baden-wÃƒÆ’Ã†â€™Ãƒâ€ Ã¢â‚¬â„¢ÃƒÆ’Ã¢â‚¬Â ÃƒÂ¢Ã¢â€šÂ¬Ã¢â€žÂ¢ÃƒÆ’Ã†â€™ÃƒÂ¢Ã¢â€', '', 1),
(377, 83, 'Bavaria', '', 1),
(378, 83, 'Bremen', '', 1),
(379, 83, 'Hesse', '', 1),
(380, 83, 'Hamburg', '', 1),
(381, 83, 'Mecklenburg-western Pomerania', '', 1),
(382, 83, 'Lower Saxony', '', 1),
(383, 83, 'North Rhine-westphalia', '', 1),
(384, 83, 'Rhineland-palatinate', '', 1),
(385, 83, 'Schleswig-holstein', '', 1),
(386, 83, 'Saarland', '', 1),
(387, 83, 'Saxony', '', 1),
(388, 83, 'Saxony-anhalt', '', 1),
(389, 83, 'Thuringia', '', 1),
(395, 92, 'Maharashtra', 'MH', 1);

-- --------------------------------------------------------

--
-- Table structure for table `taxes`
--

CREATE TABLE IF NOT EXISTS `taxes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `taxname` varchar(200) NOT NULL,
  `tax_value` int(10) NOT NULL,
  `tax_status` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `taxes`
--

INSERT INTO `taxes` (`id`, `taxname`, `tax_value`, `tax_status`) VALUES
(1, '5%', 5, 1),
(2, '7%', 7, 1),
(3, '9%', 9, 1),
(4, '12%', 12, 1),
(5, '14%', 14, 1),
(6, '18%', 18, 1),
(7, '22%', 22, 1),
(8, '26%', 26, 1),
(9, '28%', 28, 1),
(10, 'NIL / EXEMPT', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fname` varchar(255) DEFAULT NULL,
  `lname` varchar(255) DEFAULT NULL,
  `usertype` varchar(30) NOT NULL,
  `region_id` varchar(11) DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `state_id` varchar(11) DEFAULT NULL,
  `company_id` varchar(100) DEFAULT '',
  `city` varchar(100) DEFAULT NULL,
  `gender` varchar(20) DEFAULT NULL,
  `dob` varchar(200) DEFAULT NULL,
  `zipcode` varchar(150) DEFAULT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `type_account` varchar(255) DEFAULT NULL,
  `site_admin` int(11) DEFAULT '0',
  `status` tinyint(2) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=80 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `parent_id`, `email`, `mobile`, `password`, `fname`, `lname`, `usertype`, `region_id`, `country_id`, `state_id`, `company_id`, `city`, `gender`, `dob`, `zipcode`, `profile_picture`, `created_date`, `last_login`, `type_account`, `site_admin`, `status`) VALUES
(1, NULL, 'admin@gmail.com', '9854478956', 'CGVWM1QzAz0APg==', 'Subedar', 'Yadav', 'admin', '2', 1, '53', '', 'Mumbai', NULL, NULL, '401107', '', '2019-08-09 08:52:13', NULL, NULL, 1, 1),
(56, 0, 'ganesh.garje@yellowbananafood.com', '9819223315', 'DjMKOQI7CmkEYVM+', 'GANESH', 'GARJE', 'area_manager', '2', NULL, '53', '', 'Mumbai', NULL, NULL, '40118', '', '2019-08-26 11:51:31', NULL, NULL, 1, 1),
(51, 1, 'audit@yellowbananfood.com', '9702631978', 'AD0FNgQ9UTIEYVo3', 'RAKESH', 'VERMA', 'accountant', '1', NULL, '82', '', 'MUMBAI', NULL, NULL, '400058', '', '2019-08-26 12:36:15', NULL, NULL, 0, 1),
(49, 1, 'dr@yellowbananafood.com', '8828105812', 'ATwKOVBpAGNVMFI/', 'DHARMENDRA ', 'RANA', 'operational_general_manager', '1', NULL, '53', '', '', NULL, NULL, '', '', '2019-08-26 11:53:52', NULL, NULL, 0, 1),
(46, 0, 'mukesh.prajapati@yellowbananafood.com', '9769989882', 'DDEDMAM6AmFRNAVo', 'MUKESH', 'PRAJAPTI', 'area_manager', '1', NULL, '53', '', 'MUMBAI', NULL, NULL, '400101', '', '2019-08-26 12:31:28', NULL, NULL, 0, 1),
(45, 0, 'marketingmgr@yellowbananafood.com', '9833361904', 'WGUFNgA5AmFVMFQ5', 'MARKETING', 'MANAGER', 'area_manager', '1', NULL, '82', '', 'MUMBAI', NULL, NULL, '400058', '', '2019-08-26 12:44:11', NULL, NULL, 0, 1),
(48, 1, 'pa@yellowbananafood.com', '8657598226', 'W2YCMQQ9BWYCZ1I/', 'ROMOLA ', 'ARTE', 'operational_general_manager', '1', NULL, '53', '', '', NULL, NULL, '', '', '2019-08-26 12:00:12', NULL, NULL, 0, 1),
(54, 1, 'ss@yellowbananafood.com', '8828105809', 'XGEAM1RtC2hQNQ==', 'SANJAY', 'SINGH', 'project_general_manager', '1', NULL, '53', '', 'Mumbai', NULL, NULL, '400053', '', '2019-08-26 11:55:21', NULL, NULL, 0, 1),
(57, 0, 'naresh.more@yellowbananafood.com', '8291823529', 'AD0BMgY/C2hSNwVo', 'NARESH ', 'MORE', 'area_manager', '4', NULL, '53', '', 'Mumbai', NULL, NULL, '932123', '', '2019-08-26 11:49:52', NULL, NULL, 0, 1),
(60, 48, 'rohit.bhatia@yellowbananafood.com', '8828105810', 'CTQKOQE4UTIFYFM+', 'ROHIT', 'BHATIA', 'area_manager', '1', NULL, '82', '', 'MUMBAI', NULL, NULL, '400067', '', '2019-10-18 10:09:41', NULL, NULL, 0, 1),
(58, 0, 'hr@yellowbananafood.com', '8291823507', 'XWBQYwc+C2gFYAJv', 'JATINDER', 'KAPOOR', 'area_manager', '1', NULL, '53', '', 'MUMBAI', NULL, NULL, '400053', '', '2019-10-15 17:28:41', NULL, NULL, 0, 1),
(59, 1, 'am@yellowbananfood.com', '7506703434', 'DDEBMlFoC2hRNFs2', 'ANAND', 'MAHESHWARI', 'accountant', '1', NULL, '53', '', 'MUMBAI', NULL, NULL, '400058', '', '2019-08-26 12:34:15', NULL, NULL, 0, 1),
(72, 0, 'itsupport@yellowbananafood.com', '7045848428', 'XGFVZgM6VjUHYlo3', 'RAGHWENDRA', 'RAO', 'area_manager', '1', NULL, '53', '', 'MUMBAI', NULL, NULL, '400053', '', '2019-10-15 17:29:12', NULL, NULL, 0, 1),
(74, 1, 'genie11@gmail.com', '1234567844', 'XyUFbVAxUGwEIQZsX2gHZg==', 'genie11', 'genie', 'general_manager', '2', NULL, '54', '', 'delhi', NULL, NULL, '400000', '', '2019-09-28 12:24:12', NULL, NULL, 0, 1),
(77, 0, 'maintenance@yellowbananafood.com', '9890433234', 'W2YKOQQ9VTYKb1c6', 'NILESH', 'SAWANT', 'area_manager', '1', NULL, '53', '', 'MUMBAI', NULL, NULL, '400053', '', '2019-10-15 17:30:21', NULL, NULL, 0, 1),
(78, 54, 'jd@yellowbananafood.com', '9769973348', 'XGFXZFRtBmUAZVc6', 'JOAQUIM', 'DSOUZA', 'area_manager', '1', NULL, '53', '', 'MUMBAI', NULL, NULL, '400053', '', '2019-10-15 18:10:20', NULL, NULL, 0, 1),
(79, 49, 'sp@yellowbananafood.com', '7045032873', 'DjMEN1ZvB2RRNFc6', 'SHASHANK ', 'PATIL', 'area_manager', '1', NULL, '53', '', 'MUMBAI', NULL, NULL, '400053', '', '2019-10-15 17:35:07', NULL, NULL, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE IF NOT EXISTS `vendors` (
  `vendor_id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL,
  `vendor_name` varchar(100) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `mobile_no` varchar(15) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `address` text,
  `city` varchar(100) DEFAULT NULL,
  `pincode` varchar(11) DEFAULT NULL,
  `state` varchar(11) DEFAULT NULL,
  `country` int(11) DEFAULT '101',
  `pan` varchar(15) DEFAULT NULL,
  `gst_no` varchar(30) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`vendor_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `vendors`
--

INSERT INTO `vendors` (`vendor_id`, `parent_id`, `vendor_name`, `email`, `mobile_no`, `company`, `address`, `city`, `pincode`, `state`, `country`, `pan`, `gst_no`, `status`, `created_at`) VALUES
(1, 0, 'BEBI SUTHAR', 'malaramsuthar8@gmail.com', '9930908607', 'MALARAM SUTHAR', '304 SHIV TRIPATI NEAR ORANGE HOSPITAL INDRALOK PHASE III BHAYANDER EAST MUMBAI', 'MUMBAI', '401105', '53', 101, '', '', 1, '2019-10-15 18:30:02'),
(2, 0, 'ABC', 'askj2008@gmail.com', '9769973348', 'ABC Enterprises', 'Bandhutha CHS , Charkop, KANDIVALI', 'MUMBAI', '400067', '82', 101, 'AAACY2431N', '27AAACY2431N1Z4', 1, '2019-10-18 10:17:53');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
