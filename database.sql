-- MySQL dump 10.13  Distrib 8.0.36, for macos14 (arm64)
--
-- Host: 127.0.0.1    Database: archielite_riorelax
-- ------------------------------------------------------
-- Server version	8.0.36

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `activations`
--

DROP TABLE IF EXISTS `activations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `activations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `code` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `completed` tinyint(1) NOT NULL DEFAULT '0',
  `completed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `activations_user_id_index` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `activations`
--

LOCK TABLES `activations` WRITE;
/*!40000 ALTER TABLE `activations` DISABLE KEYS */;
INSERT INTO `activations` VALUES (1,1,'mK951lhht2SZvBglUJYRKsV2EaSS7eu3',1,'2024-09-18 03:10:23','2024-09-18 03:10:23','2024-09-18 03:10:23');
/*!40000 ALTER TABLE `activations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admin_notifications`
--

DROP TABLE IF EXISTS `admin_notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admin_notifications` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `action_label` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `action_url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `permission` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin_notifications`
--

LOCK TABLES `admin_notifications` WRITE;
/*!40000 ALTER TABLE `admin_notifications` DISABLE KEYS */;
/*!40000 ALTER TABLE `admin_notifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `audit_histories`
--

DROP TABLE IF EXISTS `audit_histories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `audit_histories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `module` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `request` longtext COLLATE utf8mb4_unicode_ci,
  `action` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reference_user` bigint unsigned NOT NULL,
  `reference_id` bigint unsigned NOT NULL,
  `reference_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `audit_histories_user_id_index` (`user_id`),
  KEY `audit_histories_module_index` (`module`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `audit_histories`
--

LOCK TABLES `audit_histories` WRITE;
/*!40000 ALTER TABLE `audit_histories` DISABLE KEYS */;
/*!40000 ALTER TABLE `audit_histories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` bigint unsigned NOT NULL DEFAULT '0',
  `description` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'published',
  `author_id` bigint unsigned DEFAULT NULL,
  `author_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Botble\\ACL\\Models\\User',
  `icon` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order` int unsigned NOT NULL DEFAULT '0',
  `is_featured` tinyint NOT NULL DEFAULT '0',
  `is_default` tinyint unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `categories_parent_id_index` (`parent_id`),
  KEY `categories_status_index` (`status`),
  KEY `categories_created_at_index` (`created_at`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'General',0,'Aut rerum ipsa dignissimos rem expedita velit. Qui minima voluptatem fugit. Natus minima non in asperiores nostrum. Unde delectus nobis rem ducimus corporis quas.','published',1,'Botble\\ACL\\Models\\User',NULL,0,0,1,'2024-09-18 03:10:12','2024-09-18 03:10:12'),(2,'Hotel',0,'Nemo dolorum sed tempore autem adipisci esse eligendi. Ut nihil alias quia libero nostrum. Aut ut omnis officia autem et. Sit qui vel nobis vel iste veritatis rerum.','published',1,'Botble\\ACL\\Models\\User',NULL,0,1,0,'2024-09-18 03:10:12','2024-09-18 03:10:12'),(3,'Booking',0,'Eum accusantium consequatur in non amet. Aut laborum qui qui. Dolore quasi tempore alias fugiat eum aspernatur eveniet. Labore est quibusdam quia cupiditate veritatis nobis cupiditate.','published',1,'Botble\\ACL\\Models\\User',NULL,0,1,0,'2024-09-18 03:10:12','2024-09-18 03:10:12'),(4,'Resort',0,'Illum veritatis rerum quam consequatur perspiciatis ab. Natus dolore accusamus asperiores deleniti ipsum. Natus sed ad dolorem nulla quia consequatur ex. Saepe deleniti ipsa perferendis.','published',1,'Botble\\ACL\\Models\\User',NULL,0,1,0,'2024-09-18 03:10:12','2024-09-18 03:10:12'),(5,'Travel',0,'Aut nesciunt deleniti sunt vitae nostrum corrupti. Corporis ratione alias placeat alias consequatur sunt labore. Temporibus et excepturi et ea consequuntur. Blanditiis consequuntur et eligendi quia.','published',1,'Botble\\ACL\\Models\\User',NULL,0,1,0,'2024-09-18 03:10:12','2024-09-18 03:10:12');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories_translations`
--

DROP TABLE IF EXISTS `categories_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories_translations` (
  `lang_code` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `categories_id` bigint unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`lang_code`,`categories_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories_translations`
--

LOCK TABLES `categories_translations` WRITE;
/*!40000 ALTER TABLE `categories_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `categories_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contact_custom_field_options`
--

DROP TABLE IF EXISTS `contact_custom_field_options`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `contact_custom_field_options` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `custom_field_id` bigint unsigned NOT NULL,
  `label` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order` int NOT NULL DEFAULT '999',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contact_custom_field_options`
--

LOCK TABLES `contact_custom_field_options` WRITE;
/*!40000 ALTER TABLE `contact_custom_field_options` DISABLE KEYS */;
/*!40000 ALTER TABLE `contact_custom_field_options` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contact_custom_field_options_translations`
--

DROP TABLE IF EXISTS `contact_custom_field_options_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `contact_custom_field_options_translations` (
  `contact_custom_field_options_id` bigint unsigned NOT NULL,
  `lang_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `label` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`lang_code`,`contact_custom_field_options_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contact_custom_field_options_translations`
--

LOCK TABLES `contact_custom_field_options_translations` WRITE;
/*!40000 ALTER TABLE `contact_custom_field_options_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `contact_custom_field_options_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contact_custom_fields`
--

DROP TABLE IF EXISTS `contact_custom_fields`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `contact_custom_fields` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `required` tinyint(1) NOT NULL DEFAULT '0',
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `placeholder` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order` int NOT NULL DEFAULT '999',
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'published',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contact_custom_fields`
--

LOCK TABLES `contact_custom_fields` WRITE;
/*!40000 ALTER TABLE `contact_custom_fields` DISABLE KEYS */;
/*!40000 ALTER TABLE `contact_custom_fields` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contact_custom_fields_translations`
--

DROP TABLE IF EXISTS `contact_custom_fields_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `contact_custom_fields_translations` (
  `contact_custom_fields_id` bigint unsigned NOT NULL,
  `lang_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `placeholder` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`lang_code`,`contact_custom_fields_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contact_custom_fields_translations`
--

LOCK TABLES `contact_custom_fields_translations` WRITE;
/*!40000 ALTER TABLE `contact_custom_fields_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `contact_custom_fields_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contact_replies`
--

DROP TABLE IF EXISTS `contact_replies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `contact_replies` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `message` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contact_replies`
--

LOCK TABLES `contact_replies` WRITE;
/*!40000 ALTER TABLE `contact_replies` DISABLE KEYS */;
/*!40000 ALTER TABLE `contact_replies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contacts`
--

DROP TABLE IF EXISTS `contacts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `contacts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `custom_fields` text COLLATE utf8mb4_unicode_ci,
  `status` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unread',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contacts`
--

LOCK TABLES `contacts` WRITE;
/*!40000 ALTER TABLE `contacts` DISABLE KEYS */;
/*!40000 ALTER TABLE `contacts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dashboard_widget_settings`
--

DROP TABLE IF EXISTS `dashboard_widget_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `dashboard_widget_settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `settings` text COLLATE utf8mb4_unicode_ci,
  `user_id` bigint unsigned NOT NULL,
  `widget_id` bigint unsigned NOT NULL,
  `order` tinyint unsigned NOT NULL DEFAULT '0',
  `status` tinyint unsigned NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `dashboard_widget_settings_user_id_index` (`user_id`),
  KEY `dashboard_widget_settings_widget_id_index` (`widget_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dashboard_widget_settings`
--

LOCK TABLES `dashboard_widget_settings` WRITE;
/*!40000 ALTER TABLE `dashboard_widget_settings` DISABLE KEYS */;
/*!40000 ALTER TABLE `dashboard_widget_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dashboard_widgets`
--

DROP TABLE IF EXISTS `dashboard_widgets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `dashboard_widgets` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dashboard_widgets`
--

LOCK TABLES `dashboard_widgets` WRITE;
/*!40000 ALTER TABLE `dashboard_widgets` DISABLE KEYS */;
/*!40000 ALTER TABLE `dashboard_widgets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `faq_categories`
--

DROP TABLE IF EXISTS `faq_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `faq_categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order` tinyint NOT NULL DEFAULT '0',
  `status` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'published',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `description` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `faq_categories`
--

LOCK TABLES `faq_categories` WRITE;
/*!40000 ALTER TABLE `faq_categories` DISABLE KEYS */;
INSERT INTO `faq_categories` VALUES (1,'GENERAL INFORMATION',0,'published','2024-09-18 03:10:25','2024-09-18 03:10:25',NULL),(2,'ACCOMMODATIONS AND AMENITIES',1,'published','2024-09-18 03:10:25','2024-09-18 03:10:25',NULL),(3,'SPECIAL EVENTS',2,'published','2024-09-18 03:10:25','2024-09-18 03:10:25',NULL),(4,'SAFETY AND HEALTH',3,'published','2024-09-18 03:10:25','2024-09-18 03:10:25',NULL),(5,'EXPLORING',4,'published','2024-09-18 03:10:25','2024-09-18 03:10:25',NULL);
/*!40000 ALTER TABLE `faq_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `faq_categories_translations`
--

DROP TABLE IF EXISTS `faq_categories_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `faq_categories_translations` (
  `lang_code` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `faq_categories_id` bigint unsigned NOT NULL,
  `name` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`lang_code`,`faq_categories_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `faq_categories_translations`
--

LOCK TABLES `faq_categories_translations` WRITE;
/*!40000 ALTER TABLE `faq_categories_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `faq_categories_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `faqs`
--

DROP TABLE IF EXISTS `faqs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `faqs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `question` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` bigint unsigned NOT NULL,
  `status` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'published',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `faqs`
--

LOCK TABLES `faqs` WRITE;
/*!40000 ALTER TABLE `faqs` DISABLE KEYS */;
INSERT INTO `faqs` VALUES (1,'What sets Luxury Hotel apart from others area?','Our hotel stands out with its prime coastal location, captivating design that harmonizes with nature, impeccable service dedicated to fulfilling every guest’s desire, and an array of world-class amenities that redefine opulence and sophistication.',1,'published','2024-09-18 03:10:25','2024-09-18 03:10:25'),(2,'Are pets allowed at your hotel?','Unfortunately, as we strive to maintain an environment of tranquility and luxury for all our guests, we regret to inform you that we do not permit pets in our elegantly appointed rooms and meticulously designed public spaces.',2,'published','2024-09-18 03:10:25','2024-09-18 03:10:25'),(3,'Is there a service from airport to hotel?','Absolutely! For your convenience, we offer an exclusive airport shuttle service that can be arranged in advance. Our dedicated concierge team will be delighted to provide you with detailed information and assist with reservations.',1,'published','2024-09-18 03:10:25','2024-09-18 03:10:25'),(4,'What dining options are available at hotel?','Indulge in a culinary journey at our resort with a range of exquisite dining options. From elegantly crafted local and international cuisines to delightful specialty restaurants and inviting bars, every dining experience promises to tantalize your taste buds and elevate your stay to new heights of gastronomic pleasure.',2,'published','2024-09-18 03:10:25','2024-09-18 03:10:25'),(5,'Is there a spa and wellness center on-site?','Embrace holistic well-being at our luxurious on-site spa and wellness center. Immerse yourself in a world of serenity and rejuvenation with a diverse selection of treatments, therapies, and state-of-the-art facilities that cater to your body, mind, and soul.',2,'published','2024-09-18 03:10:25','2024-09-18 03:10:25'),(6,'Do you have family-friendly activities?','Families are warmly welcomed to our resort, where we have thoughtfully curated a range of family-friendly amenities and activities. From a dedicated kids’ club to a family pool and a host of engaging recreational options, we ensure a harmonious and enjoyable stay for guests of all ages.',2,'published','2024-09-18 03:10:25','2024-09-18 03:10:25'),(7,'How can I arrange special at resort?','Celebrate life’s most precious moments in the epitome of luxury and elegance. Our skilled event planning team is committed to orchestrating seamless and memorable celebrations, ensuring every detail is tailored to your vision. Contact our dedicated events department to embark on a journey of crafting extraordinary moments.',3,'published','2024-09-18 03:10:25','2024-09-18 03:10:25'),(8,'What safety measures do you have for guests?','Your well-being is our paramount concern. We have implemented stringent health and safety protocols to ensure a secure and comfortable environment for all our guests. These measures encompass enhanced cleaning procedures, social distancing guidelines, and a commitment to maintaining the highest standards of hygiene throughout the resort.',4,'published','2024-09-18 03:10:25','2024-09-18 03:10:25'),(9,'Can I cancel or modify my reservation?','Our reservation policies vary based on the rate type and specific booking conditions. We kindly advise reviewing the terms and details of your reservation or reaching out to our dedicated reservations team for personalized assistance regarding cancellations or modifications. Your comfort and satisfaction remain our utmost priority.',1,'published','2024-09-18 03:10:25','2024-09-18 03:10:25'),(10,'What activities are near your hotel?','Our hotel’s prime location offers easy access to a plethora of attractions. Explore the captivating Adriatic coastline, immerse yourself in historical landmarks, indulge in vibrant local culture, and embark on memorable excursions that our concierge team can readily assist in arranging.',5,'published','2024-09-18 03:10:25','2024-09-18 03:10:25');
/*!40000 ALTER TABLE `faqs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `faqs_translations`
--

DROP TABLE IF EXISTS `faqs_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `faqs_translations` (
  `lang_code` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `faqs_id` bigint unsigned NOT NULL,
  `question` text COLLATE utf8mb4_unicode_ci,
  `answer` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`lang_code`,`faqs_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `faqs_translations`
--

LOCK TABLES `faqs_translations` WRITE;
/*!40000 ALTER TABLE `faqs_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `faqs_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `galleries`
--

DROP TABLE IF EXISTS `galleries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `galleries` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_featured` tinyint unsigned NOT NULL DEFAULT '0',
  `order` tinyint unsigned NOT NULL DEFAULT '0',
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `status` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'published',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `galleries_user_id_index` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `galleries`
--

LOCK TABLES `galleries` WRITE;
/*!40000 ALTER TABLE `galleries` DISABLE KEYS */;
INSERT INTO `galleries` VALUES (1,'Room','Immerse yourself in the epitome of comfort and luxury within our meticulously designed rooms. Each space is a sanctuary where sophistication meets functionality. From plush furnishings to panoramic views, every detail is crafted to ensure an unparalleled stay that leaves a lasting impression.',1,0,'galleries/1.png',1,'published','2024-09-18 03:10:23','2024-09-18 03:10:23'),(2,'Hall','Our event halls are more than spaces; they’re canvases for your imagination. With timeless design and versatile layouts, they’re perfect for weddings, conferences, and gatherings of all kinds. Equipped with state-of-the-art technology and impeccable service, our halls set the stage for unforgettable moments.',1,0,'galleries/2.png',1,'published','2024-09-18 03:10:23','2024-09-18 03:10:23'),(3,'Guardian','Our vigilant team takes your safety and comfort seriously. With unwavering dedication, our guardians ensure every corner of our hotel is secure, clean, and welcoming. From discreet housekeeping to attentive concierge services, their commitment ensures you experience nothing but the finest in hospitality. Your peace of mind is their top priority',1,0,'galleries/3.png',1,'published','2024-09-18 03:10:23','2024-09-18 03:10:23'),(4,'Hotel','Experience opulence redefined at Riorelax. Our meticulously designed rooms and suites offer breathtaking views, plush amenities, and a haven of tranquility. Immerse yourself in sumptuous comfort that sets the stage for an unforgettable stay.',1,0,'galleries/4.png',1,'published','2024-09-18 03:10:23','2024-09-18 03:10:23'),(5,'Event Hall','Celebrate life’s milestones in style with our exceptional event spaces. From weddings to corporate gatherings, our dedicated team crafts experiences that leave a lasting impression. Impeccable service, state-of-the-art facilities, and a picturesque backdrop ensure your event is nothing short of extraordinary.',1,0,'galleries/5.png',1,'published','2024-09-18 03:10:23','2024-09-18 03:10:23');
/*!40000 ALTER TABLE `galleries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `galleries_translations`
--

DROP TABLE IF EXISTS `galleries_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `galleries_translations` (
  `lang_code` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `galleries_id` bigint unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`lang_code`,`galleries_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `galleries_translations`
--

LOCK TABLES `galleries_translations` WRITE;
/*!40000 ALTER TABLE `galleries_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `galleries_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gallery_meta`
--

DROP TABLE IF EXISTS `gallery_meta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `gallery_meta` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `images` text COLLATE utf8mb4_unicode_ci,
  `reference_id` bigint unsigned NOT NULL,
  `reference_type` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `gallery_meta_reference_id_index` (`reference_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gallery_meta`
--

LOCK TABLES `gallery_meta` WRITE;
/*!40000 ALTER TABLE `gallery_meta` DISABLE KEYS */;
INSERT INTO `gallery_meta` VALUES (1,'[{\"img\":\"galleries\\/4.png\",\"description\":\"Aspernatur ipsa sed vel. Deserunt minima aliquam incidunt ut quibusdam. Ut qui explicabo nesciunt maiores ipsam veniam.\"},{\"img\":\"galleries\\/5.png\",\"description\":\"Error unde alias earum mollitia. Dolorem sequi natus commodi. In eligendi minima fuga sed debitis.\"},{\"img\":\"galleries\\/3.png\",\"description\":\"Eum fugiat dolorem aspernatur neque tenetur. Fuga ipsa illum sequi adipisci corrupti pariatur. Voluptas voluptatem quaerat quia vitae saepe fugit.\"},{\"img\":\"galleries\\/7.png\",\"description\":\"Voluptatibus quasi illum magni assumenda. Est et suscipit iste ipsam qui. Enim et ipsam libero laborum.\"},{\"img\":\"galleries\\/8.png\",\"description\":\"Aperiam est non eum rerum quos ullam. Dolor doloremque nulla suscipit eaque distinctio. Et qui libero fugit corporis.\"},{\"img\":\"galleries\\/10.png\",\"description\":\"Perspiciatis mollitia est eligendi beatae. Aut cumque maxime sunt et dolorem incidunt aut. Possimus error officiis quam.\"},{\"img\":\"galleries\\/6.png\",\"description\":\"Officiis dolor voluptatem est earum non. Id dolorem ipsam porro in ut mollitia. Modi nulla aut modi et saepe rerum ratione ad.\"},{\"img\":\"galleries\\/1.png\",\"description\":\"Quidem vitae officia placeat velit. Voluptates vero tempora cumque. Et ipsam molestias est minus. Ut et distinctio hic est sed illo iure.\"},{\"img\":\"galleries\\/2.png\",\"description\":\"Eveniet voluptatem modi hic voluptate. Dignissimos repellendus sed explicabo neque maxime voluptas ullam.\"},{\"img\":\"galleries\\/9.png\",\"description\":\"Voluptas ut vel perspiciatis dolores et. Placeat sint ut voluptatem quos quia. In illo ut laboriosam adipisci minus.\"}]',1,'Botble\\Gallery\\Models\\Gallery','2024-09-18 03:10:23','2024-09-18 03:10:23'),(2,'[{\"img\":\"galleries\\/3.png\",\"description\":\"Eum fugiat dolorem aspernatur neque tenetur. Fuga ipsa illum sequi adipisci corrupti pariatur. Voluptas voluptatem quaerat quia vitae saepe fugit.\"},{\"img\":\"galleries\\/4.png\",\"description\":\"Aspernatur ipsa sed vel. Deserunt minima aliquam incidunt ut quibusdam. Ut qui explicabo nesciunt maiores ipsam veniam.\"},{\"img\":\"galleries\\/8.png\",\"description\":\"Aperiam est non eum rerum quos ullam. Dolor doloremque nulla suscipit eaque distinctio. Et qui libero fugit corporis.\"},{\"img\":\"galleries\\/5.png\",\"description\":\"Error unde alias earum mollitia. Dolorem sequi natus commodi. In eligendi minima fuga sed debitis.\"},{\"img\":\"galleries\\/7.png\",\"description\":\"Voluptatibus quasi illum magni assumenda. Est et suscipit iste ipsam qui. Enim et ipsam libero laborum.\"},{\"img\":\"galleries\\/9.png\",\"description\":\"Voluptas ut vel perspiciatis dolores et. Placeat sint ut voluptatem quos quia. In illo ut laboriosam adipisci minus.\"},{\"img\":\"galleries\\/1.png\",\"description\":\"Quidem vitae officia placeat velit. Voluptates vero tempora cumque. Et ipsam molestias est minus. Ut et distinctio hic est sed illo iure.\"},{\"img\":\"galleries\\/10.png\",\"description\":\"Perspiciatis mollitia est eligendi beatae. Aut cumque maxime sunt et dolorem incidunt aut. Possimus error officiis quam.\"},{\"img\":\"galleries\\/6.png\",\"description\":\"Officiis dolor voluptatem est earum non. Id dolorem ipsam porro in ut mollitia. Modi nulla aut modi et saepe rerum ratione ad.\"},{\"img\":\"galleries\\/2.png\",\"description\":\"Eveniet voluptatem modi hic voluptate. Dignissimos repellendus sed explicabo neque maxime voluptas ullam.\"}]',2,'Botble\\Gallery\\Models\\Gallery','2024-09-18 03:10:23','2024-09-18 03:10:23'),(3,'[{\"img\":\"galleries\\/1.png\",\"description\":\"Quidem vitae officia placeat velit. Voluptates vero tempora cumque. Et ipsam molestias est minus. Ut et distinctio hic est sed illo iure.\"},{\"img\":\"galleries\\/9.png\",\"description\":\"Voluptas ut vel perspiciatis dolores et. Placeat sint ut voluptatem quos quia. In illo ut laboriosam adipisci minus.\"},{\"img\":\"galleries\\/10.png\",\"description\":\"Perspiciatis mollitia est eligendi beatae. Aut cumque maxime sunt et dolorem incidunt aut. Possimus error officiis quam.\"},{\"img\":\"galleries\\/4.png\",\"description\":\"Aspernatur ipsa sed vel. Deserunt minima aliquam incidunt ut quibusdam. Ut qui explicabo nesciunt maiores ipsam veniam.\"},{\"img\":\"galleries\\/2.png\",\"description\":\"Eveniet voluptatem modi hic voluptate. Dignissimos repellendus sed explicabo neque maxime voluptas ullam.\"},{\"img\":\"galleries\\/3.png\",\"description\":\"Eum fugiat dolorem aspernatur neque tenetur. Fuga ipsa illum sequi adipisci corrupti pariatur. Voluptas voluptatem quaerat quia vitae saepe fugit.\"},{\"img\":\"galleries\\/5.png\",\"description\":\"Error unde alias earum mollitia. Dolorem sequi natus commodi. In eligendi minima fuga sed debitis.\"},{\"img\":\"galleries\\/8.png\",\"description\":\"Aperiam est non eum rerum quos ullam. Dolor doloremque nulla suscipit eaque distinctio. Et qui libero fugit corporis.\"},{\"img\":\"galleries\\/6.png\",\"description\":\"Officiis dolor voluptatem est earum non. Id dolorem ipsam porro in ut mollitia. Modi nulla aut modi et saepe rerum ratione ad.\"},{\"img\":\"galleries\\/7.png\",\"description\":\"Voluptatibus quasi illum magni assumenda. Est et suscipit iste ipsam qui. Enim et ipsam libero laborum.\"}]',3,'Botble\\Gallery\\Models\\Gallery','2024-09-18 03:10:23','2024-09-18 03:10:23'),(4,'[{\"img\":\"galleries\\/8.png\",\"description\":\"Aperiam est non eum rerum quos ullam. Dolor doloremque nulla suscipit eaque distinctio. Et qui libero fugit corporis.\"},{\"img\":\"galleries\\/3.png\",\"description\":\"Eum fugiat dolorem aspernatur neque tenetur. Fuga ipsa illum sequi adipisci corrupti pariatur. Voluptas voluptatem quaerat quia vitae saepe fugit.\"},{\"img\":\"galleries\\/1.png\",\"description\":\"Quidem vitae officia placeat velit. Voluptates vero tempora cumque. Et ipsam molestias est minus. Ut et distinctio hic est sed illo iure.\"},{\"img\":\"galleries\\/6.png\",\"description\":\"Officiis dolor voluptatem est earum non. Id dolorem ipsam porro in ut mollitia. Modi nulla aut modi et saepe rerum ratione ad.\"},{\"img\":\"galleries\\/10.png\",\"description\":\"Perspiciatis mollitia est eligendi beatae. Aut cumque maxime sunt et dolorem incidunt aut. Possimus error officiis quam.\"},{\"img\":\"galleries\\/2.png\",\"description\":\"Eveniet voluptatem modi hic voluptate. Dignissimos repellendus sed explicabo neque maxime voluptas ullam.\"},{\"img\":\"galleries\\/7.png\",\"description\":\"Voluptatibus quasi illum magni assumenda. Est et suscipit iste ipsam qui. Enim et ipsam libero laborum.\"},{\"img\":\"galleries\\/4.png\",\"description\":\"Aspernatur ipsa sed vel. Deserunt minima aliquam incidunt ut quibusdam. Ut qui explicabo nesciunt maiores ipsam veniam.\"},{\"img\":\"galleries\\/9.png\",\"description\":\"Voluptas ut vel perspiciatis dolores et. Placeat sint ut voluptatem quos quia. In illo ut laboriosam adipisci minus.\"},{\"img\":\"galleries\\/5.png\",\"description\":\"Error unde alias earum mollitia. Dolorem sequi natus commodi. In eligendi minima fuga sed debitis.\"}]',4,'Botble\\Gallery\\Models\\Gallery','2024-09-18 03:10:23','2024-09-18 03:10:23'),(5,'[{\"img\":\"galleries\\/9.png\",\"description\":\"Voluptas ut vel perspiciatis dolores et. Placeat sint ut voluptatem quos quia. In illo ut laboriosam adipisci minus.\"},{\"img\":\"galleries\\/10.png\",\"description\":\"Perspiciatis mollitia est eligendi beatae. Aut cumque maxime sunt et dolorem incidunt aut. Possimus error officiis quam.\"},{\"img\":\"galleries\\/5.png\",\"description\":\"Error unde alias earum mollitia. Dolorem sequi natus commodi. In eligendi minima fuga sed debitis.\"},{\"img\":\"galleries\\/6.png\",\"description\":\"Officiis dolor voluptatem est earum non. Id dolorem ipsam porro in ut mollitia. Modi nulla aut modi et saepe rerum ratione ad.\"},{\"img\":\"galleries\\/4.png\",\"description\":\"Aspernatur ipsa sed vel. Deserunt minima aliquam incidunt ut quibusdam. Ut qui explicabo nesciunt maiores ipsam veniam.\"},{\"img\":\"galleries\\/7.png\",\"description\":\"Voluptatibus quasi illum magni assumenda. Est et suscipit iste ipsam qui. Enim et ipsam libero laborum.\"},{\"img\":\"galleries\\/8.png\",\"description\":\"Aperiam est non eum rerum quos ullam. Dolor doloremque nulla suscipit eaque distinctio. Et qui libero fugit corporis.\"},{\"img\":\"galleries\\/3.png\",\"description\":\"Eum fugiat dolorem aspernatur neque tenetur. Fuga ipsa illum sequi adipisci corrupti pariatur. Voluptas voluptatem quaerat quia vitae saepe fugit.\"},{\"img\":\"galleries\\/1.png\",\"description\":\"Quidem vitae officia placeat velit. Voluptates vero tempora cumque. Et ipsam molestias est minus. Ut et distinctio hic est sed illo iure.\"},{\"img\":\"galleries\\/2.png\",\"description\":\"Eveniet voluptatem modi hic voluptate. Dignissimos repellendus sed explicabo neque maxime voluptas ullam.\"}]',5,'Botble\\Gallery\\Models\\Gallery','2024-09-18 03:10:23','2024-09-18 03:10:23');
/*!40000 ALTER TABLE `gallery_meta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gallery_meta_translations`
--

DROP TABLE IF EXISTS `gallery_meta_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `gallery_meta_translations` (
  `lang_code` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gallery_meta_id` bigint unsigned NOT NULL,
  `images` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`lang_code`,`gallery_meta_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gallery_meta_translations`
--

LOCK TABLES `gallery_meta_translations` WRITE;
/*!40000 ALTER TABLE `gallery_meta_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `gallery_meta_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ht_amenities`
--

DROP TABLE IF EXISTS `ht_amenities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ht_amenities` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'published',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ht_amenities`
--

LOCK TABLES `ht_amenities` WRITE;
/*!40000 ALTER TABLE `ht_amenities` DISABLE KEYS */;
INSERT INTO `ht_amenities` VALUES (1,'Air conditioner','fal fa-bath','published','2024-09-18 03:10:13','2024-09-18 03:10:13'),(2,'High speed WiFi','fal fa-wifi','published','2024-09-18 03:10:13','2024-09-18 03:10:13'),(3,'Strong Locker','fal fa-key','published','2024-09-18 03:10:13','2024-09-18 03:10:13'),(4,'Breakfast','fal fa-cut','published','2024-09-18 03:10:13','2024-09-18 03:10:13'),(5,'Kitchen','fal fa-guitar','published','2024-09-18 03:10:13','2024-09-18 03:10:13'),(6,'Smart Security','fal fa-lock','published','2024-09-18 03:10:13','2024-09-18 03:10:13'),(7,'Cleaning','fal fa-broom','published','2024-09-18 03:10:13','2024-09-18 03:10:13'),(8,'Shower','fal fa-shower','published','2024-09-18 03:10:13','2024-09-18 03:10:13'),(9,'24/7 Online Support','fal fa-headphones-alt','published','2024-09-18 03:10:13','2024-09-18 03:10:13'),(10,'Grocery','fal fa-shopping-basket','published','2024-09-18 03:10:13','2024-09-18 03:10:13'),(11,'Single bed','fal fa-bed','published','2024-09-18 03:10:13','2024-09-18 03:10:13'),(12,'Expert Team','fal fa-users','published','2024-09-18 03:10:13','2024-09-18 03:10:13'),(13,'Shop near','fal fa-shopping-cart','published','2024-09-18 03:10:13','2024-09-18 03:10:13'),(14,'Towels','fal fa-bus','published','2024-09-18 03:10:13','2024-09-18 03:10:13');
/*!40000 ALTER TABLE `ht_amenities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ht_amenities_translations`
--

DROP TABLE IF EXISTS `ht_amenities_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ht_amenities_translations` (
  `lang_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ht_amenities_id` bigint unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`lang_code`,`ht_amenities_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ht_amenities_translations`
--

LOCK TABLES `ht_amenities_translations` WRITE;
/*!40000 ALTER TABLE `ht_amenities_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `ht_amenities_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ht_booking_addresses`
--

DROP TABLE IF EXISTS `ht_booking_addresses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ht_booking_addresses` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `booking_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ht_booking_addresses`
--

LOCK TABLES `ht_booking_addresses` WRITE;
/*!40000 ALTER TABLE `ht_booking_addresses` DISABLE KEYS */;
INSERT INTO `ht_booking_addresses` VALUES (1,'Savion','Heaney','+1-564-471-8331','gprohaska@example.net','Norway','Ramonabury','Lake Paul','71495-3791','718 Hand Fields\nWest Mathilde, IA 06293',1,'2024-09-18 03:10:26','2024-09-18 03:10:26'),(2,'Eino','Zemlak','+13612539120','smith.keely@example.org','British Virgin Islands','Schaefermouth','West Milan','68667-7127','3478 Floyd Court\nKuphalmouth, AL 11493-7146',2,'2024-09-18 03:10:26','2024-09-18 03:10:26'),(3,'Solon','Ebert','+1-707-681-2909','regan77@example.org','Grenada','Judyland','Dulcehaven','61964-9566','88751 Doyle Path Suite 318\nNorth Winnifredstad, ID 03137-4965',3,'2024-09-18 03:10:26','2024-09-18 03:10:26'),(4,'Loy','Rippin','+1-405-223-4812','abelardo81@example.org','Portugal','East Chadd','New Elisefort','26670-7170','261 Nathaniel Key\nSouth Scotport, UT 94740-5960',4,'2024-09-18 03:10:26','2024-09-18 03:10:26'),(5,'Selina','Bergstrom','1-407-816-7681','rweimann@example.net','Wallis and Futuna','Clarabelleburgh','Alejandrastad','01291','135 Murazik Land\nNorth Taryn, PA 63008-1351',5,'2024-09-18 03:10:26','2024-09-18 03:10:26'),(6,'Cordelia','Zieme','1-720-950-9127','aufderhar.lavina@example.net','Eritrea','Pollichland','Langworthside','16262','9170 Iva Coves Apt. 499\nPredovicville, CT 37017',6,'2024-09-18 03:10:26','2024-09-18 03:10:26'),(7,'Modesta','Gottlieb','1-830-415-8829','zieme.karianne@example.com','Guatemala','Kadenville','Spinkaland','52518-4352','179 Sabryna Isle\nKrystelshire, OK 27646',7,'2024-09-18 03:10:26','2024-09-18 03:10:26'),(8,'Josefa','Cormier','+1.320.412.1939','everett.luettgen@example.org','Martinique','West Roxannetown','North Oceanefort','35048','41399 Keshaun Point\nLake Ernestineburgh, VT 41994',8,'2024-09-18 03:10:27','2024-09-18 03:10:27'),(9,'Ebba','Ullrich','(239) 657-2814','gennaro.carter@example.com','Israel','Annabellhaven','Summershire','33509','279 Jamil Brooks\nChazside, MS 69735-0091',9,'2024-09-18 03:10:27','2024-09-18 03:10:27'),(10,'Hassan','Gleason','1-971-894-6710','sherwood70@example.net','Kyrgyz Republic','Elbertfurt','Libbieberg','63469-2141','2524 Boehm Lane Apt. 541\nWest Jaylonberg, AK 25332-1275',10,'2024-09-18 03:10:27','2024-09-18 03:10:27'),(11,'Maci','Dach','+18653442680','maci.monahan@example.com','Libyan Arab Jamahiriya','Port Jazlynshire','East Katlynnberg','16725','366 Schuppe Forest\nHoseahaven, OR 50140',11,'2024-09-18 03:10:27','2024-09-18 03:10:27'),(12,'Alessandro','Moen','+1-561-974-0030','cassin.emma@example.com','Spain','Kemmerville','Lake Margaretteburgh','49384-2810','679 Kaylie Cliffs\nKulasborough, OH 98011-4682',12,'2024-09-18 03:10:27','2024-09-18 03:10:27'),(13,'Gloria','Bauch','(308) 912-9630','vida.cremin@example.org','Netherlands','New Raven','Port Alisha','25750','309 Shanahan Forks Suite 497\nSouth Dorthy, NY 73350',13,'2024-09-18 03:10:27','2024-09-18 03:10:27'),(14,'Desmond','Breitenberg','386-398-4111','vdach@example.org','Dominica','Port Laurianne','South Esteban','67319-3655','975 Kuphal Lodge\nReinholdstad, NH 72220-1291',14,'2024-09-18 03:10:27','2024-09-18 03:10:27'),(15,'Gerardo','Botsford','850.396.8362','karli.emmerich@example.net','Cocos (Keeling) Islands','Lubowitzstad','North Arnulfoside','71366','74118 Roy Plaza Apt. 644\nPort Laura, MS 35422-2030',15,'2024-09-18 03:10:27','2024-09-18 03:10:27'),(16,'Janie','Brekke','1-410-389-7986','glover.kirsten@example.com','Brunei Darussalam','Eliseofort','Gulgowskihaven','68209','4974 Schowalter Valley Suite 416\nCreminside, MO 82230-4476',16,'2024-09-18 03:10:27','2024-09-18 03:10:27'),(17,'Jamir','Balistreri','240-753-9119','condricka@example.net','Mauritania','Lake Elise','West Jedidiahchester','40730','3459 Stoltenberg Pines Suite 500\nWest Patport, UT 00810-8640',17,'2024-09-18 03:10:27','2024-09-18 03:10:27'),(18,'Myles','Corwin','303-675-1380','cronin.mya@example.com','Guatemala','Danielland','Dakotaburgh','08300','251 Lubowitz Mission Suite 537\nNew Herminioside, RI 58687',18,'2024-09-18 03:10:27','2024-09-18 03:10:27'),(19,'Leanna','King','626.887.5166','osborne.tillman@example.net','Saint Helena','West Destin','Dachburgh','31397','1825 Queen Passage Apt. 420\nBashirianbury, OH 54936-3991',19,'2024-09-18 03:10:27','2024-09-18 03:10:27'),(20,'Corene','Ortiz','1-239-872-0254','mazie62@example.org','Albania','Krajcikport','Vonchester','26378','6803 Hintz Coves\nNorth Gladys, NY 47370-1308',20,'2024-09-18 03:10:27','2024-09-18 03:10:27'),(21,'London','Batz','361-747-0463','johnathan38@example.com','Armenia','Linabury','New Diana','45751','8930 Ali Prairie\nSouth Estefania, MT 19323-6374',21,'2024-09-18 03:10:27','2024-09-18 03:10:27'),(22,'Marcos','Herman','+1-743-703-2967','harber.madalyn@example.net','Russian Federation','Port Brandynstad','Port Vidal','35624-4446','7591 Emmitt Drive Suite 113\nNew Alta, MT 15203-3741',22,'2024-09-18 03:10:27','2024-09-18 03:10:27'),(23,'Thea','Durgan','(325) 442-6243','abelardo.bosco@example.org','Angola','Israelburgh','South Luigimouth','10009-4198','67008 Ila Manor Suite 966\nEast Mariano, MS 82952-9541',23,'2024-09-18 03:10:27','2024-09-18 03:10:27'),(24,'Lon','Rippin','(283) 505-0650','carlos.goyette@example.com','Portugal','Port Viviennemouth','Gleasonshire','42497-7564','37566 Kaelyn Ranch\nEast Reymundoburgh, AR 25437',24,'2024-09-18 03:10:27','2024-09-18 03:10:27'),(25,'Cullen','Beahan','+17275233773','esmith@example.com','Argentina','Lilamouth','Reyesberg','28334-9218','4862 Delfina Streets\nHaleyburgh, NC 94285',25,'2024-09-18 03:10:27','2024-09-18 03:10:27'),(26,'Brittany','Schoen','484-898-1642','alfonzo.will@example.org','Turkey','Doyleton','New Omerland','61263','142 Lilly Walks Suite 672\nSouth Lizeth, GA 21269-8180',26,'2024-09-18 03:10:27','2024-09-18 03:10:27'),(27,'Frederik','Ruecker','949.235.6087','ycollins@example.org','Senegal','McCulloughmouth','Port Bradfordburgh','57399','35916 Jaunita Lock\nPort Bernie, WY 01851',27,'2024-09-18 03:10:27','2024-09-18 03:10:27'),(28,'Norval','Turner','+1-551-489-2749','katrina69@example.org','Svalbard &amp; Jan Mayen Islands','Orvalmouth','Port Piper','85221-8268','7011 Quinn Locks Suite 413\nSouth Rigobertomouth, MA 97667',28,'2024-09-18 03:10:27','2024-09-18 03:10:27'),(29,'Dayana','Kris','+1-531-602-6200','mrau@example.com','Trinidad and Tobago','Janafort','South Sabrinashire','18804-1051','3854 Swaniawski Roads\nEast Hermina, IL 90159-5638',29,'2024-09-18 03:10:27','2024-09-18 03:10:27'),(30,'Torrey','Volkman','+1 (934) 245-9476','reichel.amber@example.com','Slovenia','North Laceyburgh','New Clotildehaven','24537','6373 Trey Greens\nNew Madaline, NH 42148',30,'2024-09-18 03:10:27','2024-09-18 03:10:27'),(31,'Roma','Hessel','+18508051365','tstehr@example.org','Greece','Hilpertburgh','Terrillfort','08315-3523','15661 Mac Row\nBruenport, MT 97598',31,'2024-09-18 03:10:28','2024-09-18 03:10:28'),(32,'Gertrude','Christiansen','+1-346-213-0230','augustine.mraz@example.com','Jordan','Lake Darrin','Collinsshire','12959','50145 Kyle Forest\nEast Elmer, MO 00901',32,'2024-09-18 03:10:28','2024-09-18 03:10:28'),(33,'Marilou','O\'Kon','904.536.3916','cremin.velva@example.com','San Marino','Furmanchester','Victorialand','45238-5302','49277 Ladarius Court\nStoltenbergfurt, NM 93053-7649',33,'2024-09-18 03:10:28','2024-09-18 03:10:28'),(34,'Meggie','Abernathy','+1.914.836.2693','cordie74@example.net','Kenya','Chynashire','Carleyfort','60187','21890 Hoppe Fords Suite 618\nWest Rebekahaven, WA 56918-6899',34,'2024-09-18 03:10:28','2024-09-18 03:10:28'),(35,'Elbert','Hill','+1-712-606-9491','thurman.leuschke@example.net','Sudan','East Naomie','Heaneytown','47237','6787 Morris Corners Apt. 446\nKulasmouth, MD 49492-8088',35,'2024-09-18 03:10:28','2024-09-18 03:10:28'),(36,'Earlene','Sawayn','1-847-270-3395','bernardo.weber@example.org','Brazil','North Helena','Bahringermouth','94675-7287','645 Heaney Parkways\nThompsontown, MS 46503-0852',36,'2024-09-18 03:10:28','2024-09-18 03:10:28'),(37,'Anna','Bergnaum','+1 (614) 821-2805','davis.darron@example.com','Somalia','Goodwinland','Bennieville','95978-0767','30222 Camille Square\nAdalbertotown, NE 12656-3874',37,'2024-09-18 03:10:28','2024-09-18 03:10:28'),(38,'Mikayla','Stracke','1-602-895-3796','tara88@example.net','Portugal','Dahliabury','South Maxwell','68214','142 Bosco Field Suite 675\nChristopheville, MD 26869',38,'2024-09-18 03:10:28','2024-09-18 03:10:28'),(39,'Roderick','Breitenberg','+1.838.376.2978','desiree39@example.org','Iraq','Lake Penelopefurt','Lake Trinitymouth','50716-7375','11634 Schuppe Extensions Suite 991\nCarolynchester, IA 53256-2078',39,'2024-09-18 03:10:28','2024-09-18 03:10:28'),(40,'Lourdes','Cronin','254-506-5297','adams.chelsey@example.org','Mayotte','Abernathytown','South Sharonbury','97127-0576','21657 Providenci Passage\nNew Rhiannon, AZ 44660',40,'2024-09-18 03:10:28','2024-09-18 03:10:28');
/*!40000 ALTER TABLE `ht_booking_addresses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ht_booking_rooms`
--

DROP TABLE IF EXISTS `ht_booking_rooms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ht_booking_rooms` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `booking_id` bigint unsigned NOT NULL,
  `room_id` bigint unsigned DEFAULT NULL,
  `room_image` text COLLATE utf8mb4_unicode_ci,
  `room_name` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(15,2) NOT NULL,
  `currency_id` bigint unsigned DEFAULT NULL,
  `number_of_rooms` int NOT NULL DEFAULT '1',
  `start_date` date NOT NULL,
  `end_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ht_booking_rooms`
--

LOCK TABLES `ht_booking_rooms` WRITE;
/*!40000 ALTER TABLE `ht_booking_rooms` DISABLE KEYS */;
INSERT INTO `ht_booking_rooms` VALUES (1,1,1,'rooms/01.jpg','Luxury Hall Of Fame',111.00,NULL,3,'2024-08-27','2024-08-30','2024-09-18 03:10:26','2024-09-18 03:10:26'),(2,2,4,'rooms/04.jpg','Junior Suite',188.00,NULL,2,'2024-08-28','2024-08-30','2024-09-18 03:10:26','2024-09-18 03:10:26'),(3,3,4,'rooms/04.jpg','Junior Suite',188.00,NULL,3,'2024-08-29','2024-08-31','2024-09-18 03:10:26','2024-09-18 03:10:26'),(4,4,8,'rooms/02.jpg','President Room',115.00,NULL,1,'2024-08-30','2024-09-01','2024-09-18 03:10:26','2024-09-18 03:10:26'),(5,5,1,'rooms/01.jpg','Luxury Hall Of Fame',111.00,NULL,2,'2024-08-31','2024-09-03','2024-09-18 03:10:26','2024-09-18 03:10:26'),(6,6,3,'rooms/03.jpg','Pacific Room',101.00,NULL,1,'2024-09-01','2024-09-03','2024-09-18 03:10:26','2024-09-18 03:10:26'),(7,7,7,'rooms/01.jpg','Luxury Suite',155.00,NULL,3,'2024-09-02','2024-09-06','2024-09-18 03:10:26','2024-09-18 03:10:26'),(8,8,6,'rooms/06.jpg','Relax Suite',130.00,NULL,3,'2024-09-03','2024-09-07','2024-09-18 03:10:27','2024-09-18 03:10:27'),(9,9,2,'rooms/02.jpg','Pendora Fame',186.00,NULL,3,'2024-09-04','2024-09-07','2024-09-18 03:10:27','2024-09-18 03:10:27'),(10,10,3,'rooms/03.jpg','Pacific Room',101.00,NULL,1,'2024-09-05','2024-09-08','2024-09-18 03:10:27','2024-09-18 03:10:27'),(11,11,6,'rooms/06.jpg','Relax Suite',130.00,NULL,2,'2024-09-06','2024-09-10','2024-09-18 03:10:27','2024-09-18 03:10:27'),(12,12,5,'rooms/05.jpg','Family Suite',178.00,NULL,1,'2024-09-07','2024-09-10','2024-09-18 03:10:27','2024-09-18 03:10:27'),(13,13,3,'rooms/03.jpg','Pacific Room',101.00,NULL,2,'2024-09-08','2024-09-11','2024-09-18 03:10:27','2024-09-18 03:10:27'),(14,14,6,'rooms/06.jpg','Relax Suite',130.00,NULL,1,'2024-09-09','2024-09-11','2024-09-18 03:10:27','2024-09-18 03:10:27'),(15,15,7,'rooms/01.jpg','Luxury Suite',155.00,NULL,1,'2024-09-10','2024-09-12','2024-09-18 03:10:27','2024-09-18 03:10:27'),(16,16,7,'rooms/01.jpg','Luxury Suite',155.00,NULL,3,'2024-09-11','2024-09-14','2024-09-18 03:10:27','2024-09-18 03:10:27'),(17,17,4,'rooms/04.jpg','Junior Suite',188.00,NULL,1,'2024-09-12','2024-09-16','2024-09-18 03:10:27','2024-09-18 03:10:27'),(18,18,7,'rooms/01.jpg','Luxury Suite',155.00,NULL,1,'2024-09-13','2024-09-16','2024-09-18 03:10:27','2024-09-18 03:10:27'),(19,19,5,'rooms/05.jpg','Family Suite',178.00,NULL,3,'2024-09-14','2024-09-16','2024-09-18 03:10:27','2024-09-18 03:10:27'),(20,20,3,'rooms/03.jpg','Pacific Room',101.00,NULL,3,'2024-09-15','2024-09-19','2024-09-18 03:10:27','2024-09-18 03:10:27'),(21,21,1,'rooms/01.jpg','Luxury Hall Of Fame',111.00,NULL,1,'2024-09-16','2024-09-18','2024-09-18 03:10:27','2024-09-18 03:10:27'),(22,22,8,'rooms/02.jpg','President Room',115.00,NULL,1,'2024-09-17','2024-09-21','2024-09-18 03:10:27','2024-09-18 03:10:27'),(23,23,3,'rooms/03.jpg','Pacific Room',101.00,NULL,1,'2024-09-18','2024-09-22','2024-09-18 03:10:27','2024-09-18 03:10:27'),(24,24,5,'rooms/05.jpg','Family Suite',178.00,NULL,1,'2024-09-19','2024-09-21','2024-09-18 03:10:27','2024-09-18 03:10:27'),(25,25,6,'rooms/06.jpg','Relax Suite',130.00,NULL,1,'2024-09-20','2024-09-23','2024-09-18 03:10:27','2024-09-18 03:10:27'),(26,26,4,'rooms/04.jpg','Junior Suite',188.00,NULL,2,'2024-09-21','2024-09-23','2024-09-18 03:10:27','2024-09-18 03:10:27'),(27,27,5,'rooms/05.jpg','Family Suite',178.00,NULL,1,'2024-09-22','2024-09-25','2024-09-18 03:10:27','2024-09-18 03:10:27'),(28,28,8,'rooms/02.jpg','President Room',115.00,NULL,3,'2024-09-23','2024-09-25','2024-09-18 03:10:27','2024-09-18 03:10:27'),(29,29,1,'rooms/01.jpg','Luxury Hall Of Fame',111.00,NULL,1,'2024-09-24','2024-09-28','2024-09-18 03:10:27','2024-09-18 03:10:27'),(30,30,7,'rooms/01.jpg','Luxury Suite',155.00,NULL,1,'2024-09-25','2024-09-27','2024-09-18 03:10:27','2024-09-18 03:10:27'),(31,31,6,'rooms/06.jpg','Relax Suite',130.00,NULL,1,'2024-09-26','2024-09-29','2024-09-18 03:10:28','2024-09-18 03:10:28'),(32,32,3,'rooms/03.jpg','Pacific Room',101.00,NULL,1,'2024-09-27','2024-09-30','2024-09-18 03:10:28','2024-09-18 03:10:28'),(33,33,2,'rooms/02.jpg','Pendora Fame',186.00,NULL,3,'2024-09-28','2024-10-02','2024-09-18 03:10:28','2024-09-18 03:10:28'),(34,34,4,'rooms/04.jpg','Junior Suite',188.00,NULL,1,'2024-09-29','2024-10-01','2024-09-18 03:10:28','2024-09-18 03:10:28'),(35,35,8,'rooms/02.jpg','President Room',115.00,NULL,1,'2024-09-30','2024-10-02','2024-09-18 03:10:28','2024-09-18 03:10:28'),(36,36,5,'rooms/05.jpg','Family Suite',178.00,NULL,1,'2024-10-01','2024-10-04','2024-09-18 03:10:28','2024-09-18 03:10:28'),(37,37,5,'rooms/05.jpg','Family Suite',178.00,NULL,1,'2024-10-02','2024-10-04','2024-09-18 03:10:28','2024-09-18 03:10:28'),(38,38,5,'rooms/05.jpg','Family Suite',178.00,NULL,1,'2024-10-03','2024-10-06','2024-09-18 03:10:28','2024-09-18 03:10:28'),(39,39,7,'rooms/01.jpg','Luxury Suite',155.00,NULL,3,'2024-10-04','2024-10-07','2024-09-18 03:10:28','2024-09-18 03:10:28'),(40,40,4,'rooms/04.jpg','Junior Suite',188.00,NULL,3,'2024-10-05','2024-10-08','2024-09-18 03:10:28','2024-09-18 03:10:28');
/*!40000 ALTER TABLE `ht_booking_rooms` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ht_booking_services`
--

DROP TABLE IF EXISTS `ht_booking_services`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ht_booking_services` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `booking_id` bigint unsigned NOT NULL,
  `service_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ht_booking_services`
--

LOCK TABLES `ht_booking_services` WRITE;
/*!40000 ALTER TABLE `ht_booking_services` DISABLE KEYS */;
INSERT INTO `ht_booking_services` VALUES (1,1,3),(2,2,4),(3,3,2),(4,4,6),(5,5,6),(6,6,1),(7,7,4),(8,8,6),(9,9,3),(10,10,6),(11,11,4),(12,12,3),(13,13,6),(14,14,6),(15,15,3),(16,16,3),(17,17,5),(18,18,5),(19,19,5),(20,20,6),(21,21,4),(22,22,5),(23,23,2),(24,24,6),(25,25,5),(26,26,4),(27,27,2),(28,28,1),(29,29,5),(30,30,1),(31,31,1),(32,32,2),(33,33,5),(34,34,3),(35,35,3),(36,36,4),(37,37,3),(38,38,1),(39,39,4),(40,40,6);
/*!40000 ALTER TABLE `ht_booking_services` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ht_bookings`
--

DROP TABLE IF EXISTS `ht_bookings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ht_bookings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `booking_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` decimal(15,2) NOT NULL,
  `sub_total` decimal(15,2) unsigned NOT NULL,
  `coupon_amount` decimal(15,2) unsigned NOT NULL DEFAULT '0.00',
  `coupon_code` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tax_amount` decimal(15,2) NOT NULL,
  `currency_id` bigint unsigned DEFAULT NULL,
  `requests` text COLLATE utf8mb4_unicode_ci,
  `arrival_time` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `number_of_guests` int DEFAULT NULL,
  `number_of_children` int NOT NULL DEFAULT '0',
  `payment_id` bigint unsigned DEFAULT NULL,
  `customer_id` bigint unsigned DEFAULT NULL,
  `transaction_id` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ht_bookings_booking_number_unique` (`booking_number`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ht_bookings`
--

LOCK TABLES `ht_bookings` WRITE;
/*!40000 ALTER TABLE `ht_bookings` DISABLE KEYS */;
INSERT INTO `ht_bookings` VALUES (1,NULL,333.00,333.00,0.00,NULL,0.00,NULL,'Aut sit corporis dolore placeat sit voluptatem.',NULL,6,0,1,3,'7di05WFSR4NVfaNof8O7','completed','2024-09-18 03:10:26','2024-09-18 03:10:26'),(2,NULL,376.00,376.00,0.00,NULL,0.00,NULL,'Reiciendis doloremque aut ullam aliquam.',NULL,6,0,2,8,'K4nxVW9ylpsNcL5KXfz0','cancelled','2024-09-18 03:10:26','2024-09-18 03:10:26'),(3,NULL,564.00,564.00,0.00,NULL,0.00,NULL,'Eum culpa est ullam quidem.',NULL,3,0,3,4,'RzP0VljWTrW2VREEp17r','pending','2024-09-18 03:10:26','2024-09-18 03:10:26'),(4,NULL,115.00,115.00,0.00,NULL,0.00,NULL,'Quisquam quas debitis aut id nihil.',NULL,3,0,4,3,'KyAHQeeWnFb8BUEMt6NL','completed','2024-09-18 03:10:26','2024-09-18 03:10:26'),(5,NULL,222.00,222.00,0.00,NULL,0.00,NULL,'Sequi exercitationem est nesciunt sequi.',NULL,2,0,5,7,'TWSIkFA1dPYTZdwCYdnU','cancelled','2024-09-18 03:10:26','2024-09-18 03:10:26'),(6,NULL,101.00,101.00,0.00,NULL,0.00,NULL,'Quia rem ratione ad soluta et sequi veniam ratione.',NULL,2,0,6,8,'FWigsnDW3Noqexzo3xno','cancelled','2024-09-18 03:10:26','2024-09-18 03:10:26'),(7,NULL,465.00,465.00,0.00,NULL,0.00,NULL,'Cupiditate ut facere eum quidem laborum.',NULL,3,0,7,4,'10FjQxaaA85qAad40S6E','cancelled','2024-09-18 03:10:26','2024-09-18 03:10:26'),(8,NULL,390.00,390.00,0.00,NULL,0.00,NULL,'Quis quaerat eius iure commodi labore.',NULL,3,0,8,9,'F8IsiyhynLeajqtymH6o','pending','2024-09-18 03:10:27','2024-09-18 03:10:27'),(9,NULL,558.00,558.00,0.00,NULL,0.00,NULL,'Est provident et eum nobis eos quibusdam.',NULL,6,0,9,10,'JyhJ4RuLZ6s2gFaVkNQV','processing','2024-09-18 03:10:27','2024-09-18 03:10:27'),(10,NULL,101.00,101.00,0.00,NULL,0.00,NULL,'Vel ut nesciunt molestiae a labore.',NULL,1,0,10,2,'pHzSNlnW1REXJeGNqpQ8','processing','2024-09-18 03:10:27','2024-09-18 03:10:27'),(11,NULL,260.00,260.00,0.00,NULL,0.00,NULL,'Beatae officiis est voluptatem et esse consequatur harum.',NULL,4,0,11,7,'O0zls7pqGrtB50qP7D3i','completed','2024-09-18 03:10:27','2024-09-18 03:10:27'),(12,NULL,178.00,178.00,0.00,NULL,0.00,NULL,'Sed quis omnis qui assumenda laboriosam a.',NULL,3,0,12,1,'yMBue0yZZi5L26wV69fu','cancelled','2024-09-18 03:10:27','2024-09-18 03:10:27'),(13,NULL,202.00,202.00,0.00,NULL,0.00,NULL,'Cupiditate ullam cum nulla inventore esse.',NULL,2,0,13,2,'5ltIwFMPvfnjnuhn0YlM','pending','2024-09-18 03:10:27','2024-09-18 03:10:27'),(14,NULL,130.00,130.00,0.00,NULL,0.00,NULL,'Consequatur nesciunt harum non aut.',NULL,1,0,14,2,'9Ybd28wFQAo8MJMokSvh','pending','2024-09-18 03:10:27','2024-09-18 03:10:27'),(15,NULL,155.00,155.00,0.00,NULL,0.00,NULL,'Harum mollitia eius aspernatur voluptas voluptatem distinctio ut.',NULL,1,0,15,11,'WvD0U8F6Idie3HoupAUO','pending','2024-09-18 03:10:27','2024-09-18 03:10:27'),(16,NULL,465.00,465.00,0.00,NULL,0.00,NULL,'Pariatur consequuntur nobis molestiae mollitia.',NULL,6,0,16,9,'hpvc6XpTjNItyeuEIeni','processing','2024-09-18 03:10:27','2024-09-18 03:10:27'),(17,NULL,188.00,188.00,0.00,NULL,0.00,NULL,'Illo aut nobis occaecati ab sint omnis.',NULL,2,0,17,1,'OI8RQP8AoQcV33BBolVJ','processing','2024-09-18 03:10:27','2024-09-18 03:10:27'),(18,NULL,155.00,155.00,0.00,NULL,0.00,NULL,'Eum soluta mollitia harum earum eos est.',NULL,2,0,18,8,'9cfs2xWH2XSJWIdaf88A','cancelled','2024-09-18 03:10:27','2024-09-18 03:10:27'),(19,NULL,534.00,534.00,0.00,NULL,0.00,NULL,'Non delectus molestias ullam est quia quidem similique.',NULL,9,0,19,9,'KkTaToSr8ygCldLLM8gs','cancelled','2024-09-18 03:10:27','2024-09-18 03:10:27'),(20,NULL,303.00,303.00,0.00,NULL,0.00,NULL,'Eveniet qui voluptatem et error molestias.',NULL,3,0,20,3,'kqfSoxsAY5v7WC5bbpri','pending','2024-09-18 03:10:27','2024-09-18 03:10:27'),(21,NULL,111.00,111.00,0.00,NULL,0.00,NULL,'Quam eveniet sequi ipsam illo ipsam vero.',NULL,2,0,21,3,'Bk7ZtX8SDigtWipEF9Nb','completed','2024-09-18 03:10:27','2024-09-18 03:10:27'),(22,NULL,115.00,115.00,0.00,NULL,0.00,NULL,'Accusantium voluptatibus beatae ipsum et voluptatem natus.',NULL,1,0,22,6,'rLFumYjviB9GpaOO0yDZ','processing','2024-09-18 03:10:27','2024-09-18 03:10:27'),(23,NULL,101.00,101.00,0.00,NULL,0.00,NULL,'Doloremque est provident deleniti.',NULL,3,0,23,10,'IMoVFXGleMmDJiKBR4Th','cancelled','2024-09-18 03:10:27','2024-09-18 03:10:27'),(24,NULL,178.00,178.00,0.00,NULL,0.00,NULL,'Qui quaerat accusamus quam architecto similique.',NULL,2,0,24,6,'O3eE5gEEy5gY16gXWG3n','completed','2024-09-18 03:10:27','2024-09-18 03:10:27'),(25,NULL,130.00,130.00,0.00,NULL,0.00,NULL,'Nisi reprehenderit dicta cum facere libero.',NULL,3,0,25,5,'Yc62w6IeTDK4KZ3lFbuH','processing','2024-09-18 03:10:27','2024-09-18 03:10:27'),(26,NULL,376.00,376.00,0.00,NULL,0.00,NULL,'Nobis sed perferendis rerum nemo odit.',NULL,4,0,26,6,'vAcvEWEiCxDz0TwIFhoc','cancelled','2024-09-18 03:10:27','2024-09-18 03:10:27'),(27,NULL,178.00,178.00,0.00,NULL,0.00,NULL,'Ea nostrum excepturi est esse unde quia et minus.',NULL,1,0,27,1,'GutSRe7cKJgVFLA2tB8g','processing','2024-09-18 03:10:27','2024-09-18 03:10:27'),(28,NULL,345.00,345.00,0.00,NULL,0.00,NULL,'In fuga illo cumque dolorum.',NULL,9,0,28,11,'MUUosGMYjwMChe7x9FmK','processing','2024-09-18 03:10:27','2024-09-18 03:10:27'),(29,NULL,111.00,111.00,0.00,NULL,0.00,NULL,'Fugiat tenetur temporibus ut dolor consequuntur.',NULL,1,0,29,3,'QYsSM7iGapKHGW3C8MTy','cancelled','2024-09-18 03:10:27','2024-09-18 03:10:27'),(30,NULL,155.00,155.00,0.00,NULL,0.00,NULL,'Inventore omnis dolores veritatis at voluptatem omnis in.',NULL,3,0,30,11,'aSistw3c9c6uY5fWRFfH','processing','2024-09-18 03:10:27','2024-09-18 03:10:28'),(31,NULL,130.00,130.00,0.00,NULL,0.00,NULL,'Omnis doloribus facere cumque ut.',NULL,2,0,31,2,'ic09RD5sNPoOdJPBAE9H','cancelled','2024-09-18 03:10:28','2024-09-18 03:10:28'),(32,NULL,101.00,101.00,0.00,NULL,0.00,NULL,'Reiciendis omnis eligendi ex porro id minus sit.',NULL,1,0,32,5,'7LqvzLvF9gx2VJdSJqJ7','processing','2024-09-18 03:10:28','2024-09-18 03:10:28'),(33,NULL,558.00,558.00,0.00,NULL,0.00,NULL,'Modi quod ipsam nobis veniam.',NULL,3,0,33,6,'llpreWN8rdP5Ctz7rmEt','completed','2024-09-18 03:10:28','2024-09-18 03:10:28'),(34,NULL,188.00,188.00,0.00,NULL,0.00,NULL,'Odit quia atque ut perspiciatis nihil.',NULL,2,0,34,8,'E099XmtM5veC3gv6Hq1E','processing','2024-09-18 03:10:28','2024-09-18 03:10:28'),(35,NULL,115.00,115.00,0.00,NULL,0.00,NULL,'Exercitationem maiores ab aut omnis voluptas molestias quo.',NULL,3,0,35,1,'zZt6yojGeTiWipMn5JGZ','completed','2024-09-18 03:10:28','2024-09-18 03:10:28'),(36,NULL,178.00,178.00,0.00,NULL,0.00,NULL,'Suscipit id quo qui quos animi ducimus quas.',NULL,1,0,36,9,'DmWSFIxpbEQihnPFBX4j','completed','2024-09-18 03:10:28','2024-09-18 03:10:28'),(37,NULL,178.00,178.00,0.00,NULL,0.00,NULL,'Et sed et quo molestiae et et.',NULL,2,0,37,2,'TSvc00DuunPqruh6Of30','processing','2024-09-18 03:10:28','2024-09-18 03:10:28'),(38,NULL,178.00,178.00,0.00,NULL,0.00,NULL,'Labore at laboriosam ut id est.',NULL,1,0,38,5,'DldcBf4PjBEborOgUvDN','completed','2024-09-18 03:10:28','2024-09-18 03:10:28'),(39,NULL,465.00,465.00,0.00,NULL,0.00,NULL,'Aut alias nam aut ut.',NULL,6,0,39,3,'i9kmzpFePM8E8glrvsS5','completed','2024-09-18 03:10:28','2024-09-18 03:10:28'),(40,NULL,564.00,564.00,0.00,NULL,0.00,NULL,'Et commodi ab aliquid possimus laboriosam.',NULL,9,0,40,1,'59aYnyXtojzMQ6sOR1ik','completed','2024-09-18 03:10:28','2024-09-18 03:10:28');
/*!40000 ALTER TABLE `ht_bookings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ht_coupons`
--

DROP TABLE IF EXISTS `ht_coupons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ht_coupons` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` decimal(8,2) NOT NULL,
  `quantity` int DEFAULT NULL,
  `total_used` int unsigned NOT NULL DEFAULT '0',
  `expires_date` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ht_coupons_code_unique` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ht_coupons`
--

LOCK TABLES `ht_coupons` WRITE;
/*!40000 ALTER TABLE `ht_coupons` DISABLE KEYS */;
/*!40000 ALTER TABLE `ht_coupons` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ht_currencies`
--

DROP TABLE IF EXISTS `ht_currencies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ht_currencies` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `symbol` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_prefix_symbol` tinyint unsigned NOT NULL DEFAULT '0',
  `decimals` tinyint unsigned NOT NULL DEFAULT '0',
  `order` int unsigned NOT NULL DEFAULT '0',
  `is_default` tinyint NOT NULL DEFAULT '0',
  `exchange_rate` double NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ht_currencies`
--

LOCK TABLES `ht_currencies` WRITE;
/*!40000 ALTER TABLE `ht_currencies` DISABLE KEYS */;
INSERT INTO `ht_currencies` VALUES (1,'USD','$',1,2,0,1,1,'2024-09-18 03:10:13','2024-09-18 03:10:13'),(2,'EUR','€',0,2,1,0,0.91,'2024-09-18 03:10:13','2024-09-18 03:10:13'),(3,'VND','₫',0,0,2,0,23717.5,'2024-09-18 03:10:13','2024-09-18 03:10:13');
/*!40000 ALTER TABLE `ht_currencies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ht_customer_password_resets`
--

DROP TABLE IF EXISTS `ht_customer_password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ht_customer_password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ht_customer_password_resets`
--

LOCK TABLES `ht_customer_password_resets` WRITE;
/*!40000 ALTER TABLE `ht_customer_password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `ht_customer_password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ht_customers`
--

DROP TABLE IF EXISTS `ht_customers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ht_customers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `phone` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `confirmed_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ht_customers_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ht_customers`
--

LOCK TABLES `ht_customers` WRITE;
/*!40000 ALTER TABLE `ht_customers` DISABLE KEYS */;
INSERT INTO `ht_customers` VALUES (1,'Lavinia','Block','rmiller@example.net','$2y$12$cYiMa6lv6JnYszC9dLlSm.zv0XRnSLPdZ4YCuiz.CZby6Q/KZCi7u','customers/1.jpg',NULL,'+12023126542',NULL,NULL,NULL,NULL,NULL,'2024-09-18 03:10:18','2024-09-18 03:10:18',NULL,NULL),(2,'Gregory','Nitzsche','candida65@example.org','$2y$12$rUPUPiJuNiB1aKWF6T66RekGNLFpml5ZWTUA46BsPtJY5.dSpKS1C','customers/2.jpg',NULL,'+12536673888',NULL,NULL,NULL,NULL,NULL,'2024-09-18 03:10:19','2024-09-18 03:10:19',NULL,NULL),(3,'Vella','Hudson','mann.syble@example.net','$2y$12$CYs8IstYmCDvVQyjlDzUhuXrBDtIXErz4TIXGCEKgq6J3JPFB37hi','customers/3.jpg',NULL,'+19478497391',NULL,NULL,NULL,NULL,NULL,'2024-09-18 03:10:19','2024-09-18 03:10:19',NULL,NULL),(4,'Hardy','Schmitt','manley55@example.com','$2y$12$4Q65z7qAUido/Nhv/mHEoebh5NCtBWckCpDYUUWb3Cofw7Urxki2a','customers/4.jpg',NULL,'+16829677863',NULL,NULL,NULL,NULL,NULL,'2024-09-18 03:10:19','2024-09-18 03:10:19',NULL,NULL),(5,'Woodrow','Johns','mariana.harris@example.org','$2y$12$d76GyUjwu4C1Q3Asis9cGuotyVla7JDH1xNBCnz1xRyoVkgaimDYa','customers/5.jpg',NULL,'+19868140590',NULL,NULL,NULL,NULL,NULL,'2024-09-18 03:10:19','2024-09-18 03:10:19',NULL,NULL),(6,'Jeramy','Rohan','xschaden@example.com','$2y$12$ILi3gsIiGLTHPw730f49oOFcYLw1QWU.T7TkeWw0zDPiIK9A4tjnm','customers/6.jpg',NULL,'+14244735044',NULL,NULL,NULL,NULL,NULL,'2024-09-18 03:10:19','2024-09-18 03:10:19',NULL,NULL),(7,'Hunter','Schroeder','josefina31@example.com','$2y$12$KQx8KyvTwPMSyqy8GTk.UeWv9Gti0jNZDSWekIgGGqnR5gzwA1WM.','customers/7.jpg',NULL,'+14583128970',NULL,NULL,NULL,NULL,NULL,'2024-09-18 03:10:19','2024-09-18 03:10:19',NULL,NULL),(8,'Daisha','Pollich','una.larson@example.net','$2y$12$4zbnFvFcJw5SSFLbHvnG7ej4jcvvpPTfnRHjyrgrB5rYJO71WIoce','customers/8.jpg',NULL,'+19493930205',NULL,NULL,NULL,NULL,NULL,'2024-09-18 03:10:19','2024-09-18 03:10:19',NULL,NULL),(9,'Zola','Mraz','elijah99@example.org','$2y$12$UlHGK/tr.THjYBh/0QzQheX6HuaDW1x4NntcnwW/Qm66M7vXErdeG','customers/9.jpg',NULL,'+13148851401',NULL,NULL,NULL,NULL,NULL,'2024-09-18 03:10:19','2024-09-18 03:10:19',NULL,NULL),(10,'Beaulah','Leuschke','kertzmann.dovie@example.com','$2y$12$w09ySPJNl3a3SSttVSzim.xQRBCQGanzlEHHmzQ/Pfc50qB8LdvMm','customers/10.jpg',NULL,'+13513971262',NULL,NULL,NULL,NULL,NULL,'2024-09-18 03:10:19','2024-09-18 03:10:19',NULL,NULL),(11,'Albertha','Bruen','customer@archielite.com','$2y$12$Ie1DOtVD4rNX70iuSmGXBOwJgUzz8o13yyjLRNRYa3qYDnV6gFf9i','customers/2.jpg',NULL,'+19016390386',NULL,NULL,NULL,NULL,NULL,'2024-09-18 03:10:19','2024-09-18 03:10:19',NULL,NULL);
/*!40000 ALTER TABLE `ht_customers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ht_features`
--

DROP TABLE IF EXISTS `ht_features`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ht_features` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `icon` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_featured` tinyint(1) NOT NULL DEFAULT '0',
  `status` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'published',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ht_features`
--

LOCK TABLES `ht_features` WRITE;
/*!40000 ALTER TABLE `ht_features` DISABLE KEYS */;
INSERT INTO `ht_features` VALUES (1,'Have High Rating','Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.','flaticon-rating',1,'published','2024-09-18 03:10:15','2024-09-18 03:10:15'),(2,'Quiet Hours','Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.','flaticon-clock',1,'published','2024-09-18 03:10:15','2024-09-18 03:10:15'),(3,'Best Locations','Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.','flaticon-location-pin',1,'published','2024-09-18 03:10:15','2024-09-18 03:10:15'),(4,'Free Cancellation','Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.','flaticon-clock-1',0,'published','2024-09-18 03:10:15','2024-09-18 03:10:15'),(5,'Payment Options','Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.','flaticon-credit-card',0,'published','2024-09-18 03:10:15','2024-09-18 03:10:15'),(6,'Special Offers','Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.','flaticon-discount',0,'published','2024-09-18 03:10:15','2024-09-18 03:10:15');
/*!40000 ALTER TABLE `ht_features` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ht_features_translations`
--

DROP TABLE IF EXISTS `ht_features_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ht_features_translations` (
  `lang_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ht_features_id` bigint unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`lang_code`,`ht_features_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ht_features_translations`
--

LOCK TABLES `ht_features_translations` WRITE;
/*!40000 ALTER TABLE `ht_features_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `ht_features_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ht_food_types`
--

DROP TABLE IF EXISTS `ht_food_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ht_food_types` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'published',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ht_food_types`
--

LOCK TABLES `ht_food_types` WRITE;
/*!40000 ALTER TABLE `ht_food_types` DISABLE KEYS */;
INSERT INTO `ht_food_types` VALUES (1,'Chicken','flaticon-boiled','published','2024-09-18 03:10:14','2024-09-18 03:10:14'),(2,'Italian','flaticon-pizza','published','2024-09-18 03:10:14','2024-09-18 03:10:14'),(3,'Coffee','flaticon-coffee','published','2024-09-18 03:10:14','2024-09-18 03:10:14'),(4,'Bake Cake','flaticon-cake','published','2024-09-18 03:10:14','2024-09-18 03:10:14'),(5,'Cookies','flaticon-cookie','published','2024-09-18 03:10:14','2024-09-18 03:10:14'),(6,'Cocktail','flaticon-cocktail','published','2024-09-18 03:10:14','2024-09-18 03:10:14');
/*!40000 ALTER TABLE `ht_food_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ht_food_types_translations`
--

DROP TABLE IF EXISTS `ht_food_types_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ht_food_types_translations` (
  `lang_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ht_food_types_id` bigint unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`lang_code`,`ht_food_types_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ht_food_types_translations`
--

LOCK TABLES `ht_food_types_translations` WRITE;
/*!40000 ALTER TABLE `ht_food_types_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `ht_food_types_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ht_foods`
--

DROP TABLE IF EXISTS `ht_foods`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ht_foods` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `price` decimal(15,0) unsigned DEFAULT NULL,
  `currency_id` bigint unsigned DEFAULT NULL,
  `food_type_id` bigint unsigned NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'published',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ht_foods`
--

LOCK TABLES `ht_foods` WRITE;
/*!40000 ALTER TABLE `ht_foods` DISABLE KEYS */;
INSERT INTO `ht_foods` VALUES (1,'Eggs &amp; Bacon','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer vel molestie nisl. Duis ac mi leo.',146,NULL,1,'foods/01.jpg','published','2024-09-18 03:10:15','2024-09-18 03:10:15'),(2,'Tea or Coffee','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer vel molestie nisl. Duis ac mi leo.',175,NULL,1,'foods/02.jpg','published','2024-09-18 03:10:15','2024-09-18 03:10:15'),(3,'Chia Oatmeal','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer vel molestie nisl. Duis ac mi leo.',109,NULL,1,'foods/03.jpg','published','2024-09-18 03:10:15','2024-09-18 03:10:15'),(4,'Juice','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer vel molestie nisl. Duis ac mi leo.',161,NULL,1,'foods/04.jpg','published','2024-09-18 03:10:15','2024-09-18 03:10:15'),(5,'Chia Oatmeal','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer vel molestie nisl. Duis ac mi leo.',197,NULL,2,'foods/05.jpg','published','2024-09-18 03:10:15','2024-09-18 03:10:15'),(6,'Fruit Parfait','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer vel molestie nisl. Duis ac mi leo.',111,NULL,2,'foods/06.jpg','published','2024-09-18 03:10:15','2024-09-18 03:10:15'),(7,'Marmalade Selection','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer vel molestie nisl. Duis ac mi leo.',130,NULL,3,'foods/07.jpg','published','2024-09-18 03:10:15','2024-09-18 03:10:15'),(8,'Cheese Platen','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer vel molestie nisl. Duis ac mi leo.',141,NULL,4,'foods/08.jpg','published','2024-09-18 03:10:15','2024-09-18 03:10:15'),(9,'Avocado Toast','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer vel molestie nisl. Duis ac mi leo.',166,NULL,5,'foods/09.jpg','published','2024-09-18 03:10:15','2024-09-18 03:10:15'),(10,'Avocado Toast','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer vel molestie nisl. Duis ac mi leo.',106,NULL,6,'foods/10.jpg','published','2024-09-18 03:10:15','2024-09-18 03:10:15');
/*!40000 ALTER TABLE `ht_foods` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ht_foods_translations`
--

DROP TABLE IF EXISTS `ht_foods_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ht_foods_translations` (
  `lang_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ht_foods_id` bigint unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`lang_code`,`ht_foods_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ht_foods_translations`
--

LOCK TABLES `ht_foods_translations` WRITE;
/*!40000 ALTER TABLE `ht_foods_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `ht_foods_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ht_invoice_items`
--

DROP TABLE IF EXISTS `ht_invoice_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ht_invoice_items` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `invoice_id` bigint unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `qty` int unsigned NOT NULL,
  `sub_total` decimal(15,2) unsigned NOT NULL,
  `tax_amount` decimal(15,2) unsigned NOT NULL DEFAULT '0.00',
  `discount_amount` decimal(15,2) unsigned NOT NULL DEFAULT '0.00',
  `amount` decimal(15,2) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ht_invoice_items`
--

LOCK TABLES `ht_invoice_items` WRITE;
/*!40000 ALTER TABLE `ht_invoice_items` DISABLE KEYS */;
INSERT INTO `ht_invoice_items` VALUES (1,1,'Luxury Hall Of Fame','',1,111.00,0.00,0.00,111.00,'2024-09-18 03:10:26','2024-09-18 03:10:26'),(2,1,'Best Accommodation (extra service)','',1,50.00,0.00,0.00,50.00,'2024-09-18 03:10:26','2024-09-18 03:10:26'),(3,2,'Junior Suite','',1,188.00,0.00,0.00,188.00,'2024-09-18 03:10:26','2024-09-18 03:10:26'),(4,2,'Wellness &amp; Spa (extra service)','',1,10.00,0.00,0.00,10.00,'2024-09-18 03:10:26','2024-09-18 03:10:26'),(5,3,'Junior Suite','',1,188.00,0.00,0.00,188.00,'2024-09-18 03:10:26','2024-09-18 03:10:26'),(6,3,'Privet Beach (extra service)','',1,30.00,0.00,0.00,30.00,'2024-09-18 03:10:26','2024-09-18 03:10:26'),(7,4,'President Room','',1,115.00,0.00,0.00,115.00,'2024-09-18 03:10:26','2024-09-18 03:10:26'),(8,4,'Special Offers (extra service)','',1,10.00,0.00,0.00,10.00,'2024-09-18 03:10:26','2024-09-18 03:10:26'),(9,5,'Luxury Hall Of Fame','',1,111.00,0.00,0.00,111.00,'2024-09-18 03:10:26','2024-09-18 03:10:26'),(10,5,'Special Offers (extra service)','',1,10.00,0.00,0.00,10.00,'2024-09-18 03:10:26','2024-09-18 03:10:26'),(11,6,'Pacific Room','',1,101.00,0.00,0.00,101.00,'2024-09-18 03:10:26','2024-09-18 03:10:26'),(12,6,'Quality Room (extra service)','',1,100.00,0.00,0.00,100.00,'2024-09-18 03:10:26','2024-09-18 03:10:26'),(13,7,'Luxury Suite','',1,155.00,0.00,0.00,155.00,'2024-09-18 03:10:27','2024-09-18 03:10:27'),(14,7,'Wellness &amp; Spa (extra service)','',1,10.00,0.00,0.00,10.00,'2024-09-18 03:10:27','2024-09-18 03:10:27'),(15,8,'Relax Suite','',1,130.00,0.00,0.00,130.00,'2024-09-18 03:10:27','2024-09-18 03:10:27'),(16,8,'Special Offers (extra service)','',1,10.00,0.00,0.00,10.00,'2024-09-18 03:10:27','2024-09-18 03:10:27'),(17,9,'Pendora Fame','',1,186.00,0.00,0.00,186.00,'2024-09-18 03:10:27','2024-09-18 03:10:27'),(18,9,'Best Accommodation (extra service)','',1,50.00,0.00,0.00,50.00,'2024-09-18 03:10:27','2024-09-18 03:10:27'),(19,10,'Pacific Room','',1,101.00,0.00,0.00,101.00,'2024-09-18 03:10:27','2024-09-18 03:10:27'),(20,10,'Special Offers (extra service)','',1,10.00,0.00,0.00,10.00,'2024-09-18 03:10:27','2024-09-18 03:10:27'),(21,11,'Relax Suite','',1,130.00,0.00,0.00,130.00,'2024-09-18 03:10:27','2024-09-18 03:10:27'),(22,11,'Wellness &amp; Spa (extra service)','',1,10.00,0.00,0.00,10.00,'2024-09-18 03:10:27','2024-09-18 03:10:27'),(23,12,'Family Suite','',1,178.00,0.00,0.00,178.00,'2024-09-18 03:10:27','2024-09-18 03:10:27'),(24,12,'Best Accommodation (extra service)','',1,50.00,0.00,0.00,50.00,'2024-09-18 03:10:27','2024-09-18 03:10:27'),(25,13,'Pacific Room','',1,101.00,0.00,0.00,101.00,'2024-09-18 03:10:27','2024-09-18 03:10:27'),(26,13,'Special Offers (extra service)','',1,10.00,0.00,0.00,10.00,'2024-09-18 03:10:27','2024-09-18 03:10:27'),(27,14,'Relax Suite','',1,130.00,0.00,0.00,130.00,'2024-09-18 03:10:27','2024-09-18 03:10:27'),(28,14,'Special Offers (extra service)','',1,10.00,0.00,0.00,10.00,'2024-09-18 03:10:27','2024-09-18 03:10:27'),(29,15,'Luxury Suite','',1,155.00,0.00,0.00,155.00,'2024-09-18 03:10:27','2024-09-18 03:10:27'),(30,15,'Best Accommodation (extra service)','',1,50.00,0.00,0.00,50.00,'2024-09-18 03:10:27','2024-09-18 03:10:27'),(31,16,'Luxury Suite','',1,155.00,0.00,0.00,155.00,'2024-09-18 03:10:27','2024-09-18 03:10:27'),(32,16,'Best Accommodation (extra service)','',1,50.00,0.00,0.00,50.00,'2024-09-18 03:10:27','2024-09-18 03:10:27'),(33,17,'Junior Suite','',1,188.00,0.00,0.00,188.00,'2024-09-18 03:10:27','2024-09-18 03:10:27'),(34,17,'Restaurants &amp; Bars (extra service)','',1,10.00,0.00,0.00,10.00,'2024-09-18 03:10:27','2024-09-18 03:10:27'),(35,18,'Luxury Suite','',1,155.00,0.00,0.00,155.00,'2024-09-18 03:10:27','2024-09-18 03:10:27'),(36,18,'Restaurants &amp; Bars (extra service)','',1,10.00,0.00,0.00,10.00,'2024-09-18 03:10:27','2024-09-18 03:10:27'),(37,19,'Family Suite','',1,178.00,0.00,0.00,178.00,'2024-09-18 03:10:27','2024-09-18 03:10:27'),(38,19,'Restaurants &amp; Bars (extra service)','',1,10.00,0.00,0.00,10.00,'2024-09-18 03:10:27','2024-09-18 03:10:27'),(39,20,'Pacific Room','',1,101.00,0.00,0.00,101.00,'2024-09-18 03:10:27','2024-09-18 03:10:27'),(40,20,'Special Offers (extra service)','',1,10.00,0.00,0.00,10.00,'2024-09-18 03:10:27','2024-09-18 03:10:27'),(41,21,'Luxury Hall Of Fame','',1,111.00,0.00,0.00,111.00,'2024-09-18 03:10:27','2024-09-18 03:10:27'),(42,21,'Wellness &amp; Spa (extra service)','',1,10.00,0.00,0.00,10.00,'2024-09-18 03:10:27','2024-09-18 03:10:27'),(43,22,'President Room','',1,115.00,0.00,0.00,115.00,'2024-09-18 03:10:27','2024-09-18 03:10:27'),(44,22,'Restaurants &amp; Bars (extra service)','',1,10.00,0.00,0.00,10.00,'2024-09-18 03:10:27','2024-09-18 03:10:27'),(45,23,'Pacific Room','',1,101.00,0.00,0.00,101.00,'2024-09-18 03:10:27','2024-09-18 03:10:27'),(46,23,'Privet Beach (extra service)','',1,30.00,0.00,0.00,30.00,'2024-09-18 03:10:27','2024-09-18 03:10:27'),(47,24,'Family Suite','',1,178.00,0.00,0.00,178.00,'2024-09-18 03:10:27','2024-09-18 03:10:27'),(48,24,'Special Offers (extra service)','',1,10.00,0.00,0.00,10.00,'2024-09-18 03:10:27','2024-09-18 03:10:27'),(49,25,'Relax Suite','',1,130.00,0.00,0.00,130.00,'2024-09-18 03:10:27','2024-09-18 03:10:27'),(50,25,'Restaurants &amp; Bars (extra service)','',1,10.00,0.00,0.00,10.00,'2024-09-18 03:10:27','2024-09-18 03:10:27'),(51,26,'Junior Suite','',1,188.00,0.00,0.00,188.00,'2024-09-18 03:10:27','2024-09-18 03:10:27'),(52,26,'Wellness &amp; Spa (extra service)','',1,10.00,0.00,0.00,10.00,'2024-09-18 03:10:27','2024-09-18 03:10:27'),(53,27,'Family Suite','',1,178.00,0.00,0.00,178.00,'2024-09-18 03:10:27','2024-09-18 03:10:27'),(54,27,'Privet Beach (extra service)','',1,30.00,0.00,0.00,30.00,'2024-09-18 03:10:27','2024-09-18 03:10:27'),(55,28,'President Room','',1,115.00,0.00,0.00,115.00,'2024-09-18 03:10:27','2024-09-18 03:10:27'),(56,28,'Quality Room (extra service)','',1,100.00,0.00,0.00,100.00,'2024-09-18 03:10:27','2024-09-18 03:10:27'),(57,29,'Luxury Hall Of Fame','',1,111.00,0.00,0.00,111.00,'2024-09-18 03:10:27','2024-09-18 03:10:27'),(58,29,'Restaurants &amp; Bars (extra service)','',1,10.00,0.00,0.00,10.00,'2024-09-18 03:10:27','2024-09-18 03:10:27'),(59,30,'Luxury Suite','',1,155.00,0.00,0.00,155.00,'2024-09-18 03:10:28','2024-09-18 03:10:28'),(60,30,'Quality Room (extra service)','',1,100.00,0.00,0.00,100.00,'2024-09-18 03:10:28','2024-09-18 03:10:28'),(61,31,'Relax Suite','',1,130.00,0.00,0.00,130.00,'2024-09-18 03:10:28','2024-09-18 03:10:28'),(62,31,'Quality Room (extra service)','',1,100.00,0.00,0.00,100.00,'2024-09-18 03:10:28','2024-09-18 03:10:28'),(63,32,'Pacific Room','',1,101.00,0.00,0.00,101.00,'2024-09-18 03:10:28','2024-09-18 03:10:28'),(64,32,'Privet Beach (extra service)','',1,30.00,0.00,0.00,30.00,'2024-09-18 03:10:28','2024-09-18 03:10:28'),(65,33,'Pendora Fame','',1,186.00,0.00,0.00,186.00,'2024-09-18 03:10:28','2024-09-18 03:10:28'),(66,33,'Restaurants &amp; Bars (extra service)','',1,10.00,0.00,0.00,10.00,'2024-09-18 03:10:28','2024-09-18 03:10:28'),(67,34,'Junior Suite','',1,188.00,0.00,0.00,188.00,'2024-09-18 03:10:28','2024-09-18 03:10:28'),(68,34,'Best Accommodation (extra service)','',1,50.00,0.00,0.00,50.00,'2024-09-18 03:10:28','2024-09-18 03:10:28'),(69,35,'President Room','',1,115.00,0.00,0.00,115.00,'2024-09-18 03:10:28','2024-09-18 03:10:28'),(70,35,'Best Accommodation (extra service)','',1,50.00,0.00,0.00,50.00,'2024-09-18 03:10:28','2024-09-18 03:10:28'),(71,36,'Family Suite','',1,178.00,0.00,0.00,178.00,'2024-09-18 03:10:28','2024-09-18 03:10:28'),(72,36,'Wellness &amp; Spa (extra service)','',1,10.00,0.00,0.00,10.00,'2024-09-18 03:10:28','2024-09-18 03:10:28'),(73,37,'Family Suite','',1,178.00,0.00,0.00,178.00,'2024-09-18 03:10:28','2024-09-18 03:10:28'),(74,37,'Best Accommodation (extra service)','',1,50.00,0.00,0.00,50.00,'2024-09-18 03:10:28','2024-09-18 03:10:28'),(75,38,'Family Suite','',1,178.00,0.00,0.00,178.00,'2024-09-18 03:10:28','2024-09-18 03:10:28'),(76,38,'Quality Room (extra service)','',1,100.00,0.00,0.00,100.00,'2024-09-18 03:10:28','2024-09-18 03:10:28'),(77,39,'Luxury Suite','',1,155.00,0.00,0.00,155.00,'2024-09-18 03:10:28','2024-09-18 03:10:28'),(78,39,'Wellness &amp; Spa (extra service)','',1,10.00,0.00,0.00,10.00,'2024-09-18 03:10:28','2024-09-18 03:10:28'),(79,40,'Junior Suite','',1,188.00,0.00,0.00,188.00,'2024-09-18 03:10:28','2024-09-18 03:10:28'),(80,40,'Special Offers (extra service)','',1,10.00,0.00,0.00,10.00,'2024-09-18 03:10:28','2024-09-18 03:10:28');
/*!40000 ALTER TABLE `ht_invoice_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ht_invoices`
--

DROP TABLE IF EXISTS `ht_invoices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ht_invoices` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` bigint unsigned DEFAULT NULL,
  `customer_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_id` bigint unsigned DEFAULT NULL,
  `reference_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reference_id` bigint unsigned NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sub_total` decimal(15,2) unsigned NOT NULL,
  `tax_amount` decimal(15,2) unsigned NOT NULL DEFAULT '0.00',
  `discount_amount` decimal(15,2) unsigned NOT NULL DEFAULT '0.00',
  `amount` decimal(15,2) unsigned NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `paid_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ht_invoices_code_unique` (`code`),
  KEY `ht_invoices_reference_type_reference_id_index` (`reference_type`,`reference_id`),
  KEY `ht_invoices_payment_id_index` (`payment_id`),
  KEY `ht_invoices_status_index` (`status`),
  KEY `ht_invoices_customer_id_index` (`customer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ht_invoices`
--

LOCK TABLES `ht_invoices` WRITE;
/*!40000 ALTER TABLE `ht_invoices` DISABLE KEYS */;
INSERT INTO `ht_invoices` VALUES (1,3,'SavionHeaney','gprohaska@example.net','+1-564-471-8331','718 Hand Fields\nWest Mathilde, IA 06293, Lake Paul, Ramonabury, Norway, 71495-3791, ','Aut sit corporis dolore placeat sit voluptatem.',1,'Botble\\Hotel\\Models\\Booking',1,'INV-1',333.00,0.00,0.00,333.00,'canceled',NULL,'2024-09-18 03:10:26','2024-09-18 03:10:26'),(2,8,'EinoZemlak','smith.keely@example.org','+13612539120','3478 Floyd Court\nKuphalmouth, AL 11493-7146, West Milan, Schaefermouth, British Virgin Islands, 68667-7127, ','Reiciendis doloremque aut ullam aliquam.',2,'Botble\\Hotel\\Models\\Booking',2,'INV-2',376.00,0.00,0.00,376.00,'canceled',NULL,'2024-09-18 03:10:26','2024-09-18 03:10:26'),(3,4,'SolonEbert','regan77@example.org','+1-707-681-2909','88751 Doyle Path Suite 318\nNorth Winnifredstad, ID 03137-4965, Dulcehaven, Judyland, Grenada, 61964-9566, ','Eum culpa est ullam quidem.',3,'Botble\\Hotel\\Models\\Booking',3,'INV-3',564.00,0.00,0.00,564.00,'pending',NULL,'2024-09-18 03:10:26','2024-09-18 03:10:26'),(4,3,'LoyRippin','abelardo81@example.org','+1-405-223-4812','261 Nathaniel Key\nSouth Scotport, UT 94740-5960, New Elisefort, East Chadd, Portugal, 26670-7170, ','Quisquam quas debitis aut id nihil.',4,'Botble\\Hotel\\Models\\Booking',4,'INV-4',115.00,0.00,0.00,115.00,'canceled',NULL,'2024-09-18 03:10:26','2024-09-18 03:10:26'),(5,7,'SelinaBergstrom','rweimann@example.net','1-407-816-7681','135 Murazik Land\nNorth Taryn, PA 63008-1351, Alejandrastad, Clarabelleburgh, Wallis and Futuna, 01291, ','Sequi exercitationem est nesciunt sequi.',5,'Botble\\Hotel\\Models\\Booking',5,'INV-5',222.00,0.00,0.00,222.00,'pending',NULL,'2024-09-18 03:10:26','2024-09-18 03:10:26'),(6,8,'CordeliaZieme','aufderhar.lavina@example.net','1-720-950-9127','9170 Iva Coves Apt. 499\nPredovicville, CT 37017, Langworthside, Pollichland, Eritrea, 16262, ','Quia rem ratione ad soluta et sequi veniam ratione.',6,'Botble\\Hotel\\Models\\Booking',6,'INV-6',101.00,0.00,0.00,101.00,'pending',NULL,'2024-09-18 03:10:26','2024-09-18 03:10:26'),(7,4,'ModestaGottlieb','zieme.karianne@example.com','1-830-415-8829','179 Sabryna Isle\nKrystelshire, OK 27646, Spinkaland, Kadenville, Guatemala, 52518-4352, ','Cupiditate ut facere eum quidem laborum.',7,'Botble\\Hotel\\Models\\Booking',7,'INV-7',465.00,0.00,0.00,465.00,'canceled',NULL,'2024-09-18 03:10:26','2024-09-18 03:10:27'),(8,9,'JosefaCormier','everett.luettgen@example.org','+1.320.412.1939','41399 Keshaun Point\nLake Ernestineburgh, VT 41994, North Oceanefort, West Roxannetown, Martinique, 35048, ','Quis quaerat eius iure commodi labore.',8,'Botble\\Hotel\\Models\\Booking',8,'INV-8',390.00,0.00,0.00,390.00,'completed','2024-09-18 03:10:27','2024-09-18 03:10:27','2024-09-18 03:10:27'),(9,10,'EbbaUllrich','gennaro.carter@example.com','(239) 657-2814','279 Jamil Brooks\nChazside, MS 69735-0091, Summershire, Annabellhaven, Israel, 33509, ','Est provident et eum nobis eos quibusdam.',9,'Botble\\Hotel\\Models\\Booking',9,'INV-9',558.00,0.00,0.00,558.00,'canceled',NULL,'2024-09-18 03:10:27','2024-09-18 03:10:27'),(10,2,'HassanGleason','sherwood70@example.net','1-971-894-6710','2524 Boehm Lane Apt. 541\nWest Jaylonberg, AK 25332-1275, Libbieberg, Elbertfurt, Kyrgyz Republic, 63469-2141, ','Vel ut nesciunt molestiae a labore.',10,'Botble\\Hotel\\Models\\Booking',10,'INV-10',101.00,0.00,0.00,101.00,'canceled',NULL,'2024-09-18 03:10:27','2024-09-18 03:10:27'),(11,7,'MaciDach','maci.monahan@example.com','+18653442680','366 Schuppe Forest\nHoseahaven, OR 50140, East Katlynnberg, Port Jazlynshire, Libyan Arab Jamahiriya, 16725, ','Beatae officiis est voluptatem et esse consequatur harum.',11,'Botble\\Hotel\\Models\\Booking',11,'INV-11',260.00,0.00,0.00,260.00,'completed','2024-09-18 03:10:27','2024-09-18 03:10:27','2024-09-18 03:10:27'),(12,1,'AlessandroMoen','cassin.emma@example.com','+1-561-974-0030','679 Kaylie Cliffs\nKulasborough, OH 98011-4682, Lake Margaretteburgh, Kemmerville, Spain, 49384-2810, ','Sed quis omnis qui assumenda laboriosam a.',12,'Botble\\Hotel\\Models\\Booking',12,'INV-12',178.00,0.00,0.00,178.00,'canceled',NULL,'2024-09-18 03:10:27','2024-09-18 03:10:27'),(13,2,'GloriaBauch','vida.cremin@example.org','(308) 912-9630','309 Shanahan Forks Suite 497\nSouth Dorthy, NY 73350, Port Alisha, New Raven, Netherlands, 25750, ','Cupiditate ullam cum nulla inventore esse.',13,'Botble\\Hotel\\Models\\Booking',13,'INV-13',202.00,0.00,0.00,202.00,'completed','2024-09-18 03:10:27','2024-09-18 03:10:27','2024-09-18 03:10:27'),(14,2,'DesmondBreitenberg','vdach@example.org','386-398-4111','975 Kuphal Lodge\nReinholdstad, NH 72220-1291, South Esteban, Port Laurianne, Dominica, 67319-3655, ','Consequatur nesciunt harum non aut.',14,'Botble\\Hotel\\Models\\Booking',14,'INV-14',130.00,0.00,0.00,130.00,'completed','2024-09-18 03:10:27','2024-09-18 03:10:27','2024-09-18 03:10:27'),(15,11,'GerardoBotsford','karli.emmerich@example.net','850.396.8362','74118 Roy Plaza Apt. 644\nPort Laura, MS 35422-2030, North Arnulfoside, Lubowitzstad, Cocos (Keeling) Islands, 71366, ','Harum mollitia eius aspernatur voluptas voluptatem distinctio ut.',15,'Botble\\Hotel\\Models\\Booking',15,'INV-15',155.00,0.00,0.00,155.00,'canceled',NULL,'2024-09-18 03:10:27','2024-09-18 03:10:27'),(16,9,'JanieBrekke','glover.kirsten@example.com','1-410-389-7986','4974 Schowalter Valley Suite 416\nCreminside, MO 82230-4476, Gulgowskihaven, Eliseofort, Brunei Darussalam, 68209, ','Pariatur consequuntur nobis molestiae mollitia.',16,'Botble\\Hotel\\Models\\Booking',16,'INV-16',465.00,0.00,0.00,465.00,'pending',NULL,'2024-09-18 03:10:27','2024-09-18 03:10:27'),(17,1,'JamirBalistreri','condricka@example.net','240-753-9119','3459 Stoltenberg Pines Suite 500\nWest Patport, UT 00810-8640, West Jedidiahchester, Lake Elise, Mauritania, 40730, ','Illo aut nobis occaecati ab sint omnis.',17,'Botble\\Hotel\\Models\\Booking',17,'INV-17',188.00,0.00,0.00,188.00,'canceled',NULL,'2024-09-18 03:10:27','2024-09-18 03:10:27'),(18,8,'MylesCorwin','cronin.mya@example.com','303-675-1380','251 Lubowitz Mission Suite 537\nNew Herminioside, RI 58687, Dakotaburgh, Danielland, Guatemala, 08300, ','Eum soluta mollitia harum earum eos est.',18,'Botble\\Hotel\\Models\\Booking',18,'INV-18',155.00,0.00,0.00,155.00,'canceled',NULL,'2024-09-18 03:10:27','2024-09-18 03:10:27'),(19,9,'LeannaKing','osborne.tillman@example.net','626.887.5166','1825 Queen Passage Apt. 420\nBashirianbury, OH 54936-3991, Dachburgh, West Destin, Saint Helena, 31397, ','Non delectus molestias ullam est quia quidem similique.',19,'Botble\\Hotel\\Models\\Booking',19,'INV-19',534.00,0.00,0.00,534.00,'canceled',NULL,'2024-09-18 03:10:27','2024-09-18 03:10:27'),(20,3,'CoreneOrtiz','mazie62@example.org','1-239-872-0254','6803 Hintz Coves\nNorth Gladys, NY 47370-1308, Vonchester, Krajcikport, Albania, 26378, ','Eveniet qui voluptatem et error molestias.',20,'Botble\\Hotel\\Models\\Booking',20,'INV-20',303.00,0.00,0.00,303.00,'completed','2024-09-18 03:10:27','2024-09-18 03:10:27','2024-09-18 03:10:27'),(21,3,'LondonBatz','johnathan38@example.com','361-747-0463','8930 Ali Prairie\nSouth Estefania, MT 19323-6374, New Diana, Linabury, Armenia, 45751, ','Quam eveniet sequi ipsam illo ipsam vero.',21,'Botble\\Hotel\\Models\\Booking',21,'INV-21',111.00,0.00,0.00,111.00,'completed','2024-09-18 03:10:27','2024-09-18 03:10:27','2024-09-18 03:10:27'),(22,6,'MarcosHerman','harber.madalyn@example.net','+1-743-703-2967','7591 Emmitt Drive Suite 113\nNew Alta, MT 15203-3741, Port Vidal, Port Brandynstad, Russian Federation, 35624-4446, ','Accusantium voluptatibus beatae ipsum et voluptatem natus.',22,'Botble\\Hotel\\Models\\Booking',22,'INV-22',115.00,0.00,0.00,115.00,'completed','2024-09-18 03:10:27','2024-09-18 03:10:27','2024-09-18 03:10:27'),(23,10,'TheaDurgan','abelardo.bosco@example.org','(325) 442-6243','67008 Ila Manor Suite 966\nEast Mariano, MS 82952-9541, South Luigimouth, Israelburgh, Angola, 10009-4198, ','Doloremque est provident deleniti.',23,'Botble\\Hotel\\Models\\Booking',23,'INV-23',101.00,0.00,0.00,101.00,'canceled',NULL,'2024-09-18 03:10:27','2024-09-18 03:10:27'),(24,6,'LonRippin','carlos.goyette@example.com','(283) 505-0650','37566 Kaelyn Ranch\nEast Reymundoburgh, AR 25437, Gleasonshire, Port Viviennemouth, Portugal, 42497-7564, ','Qui quaerat accusamus quam architecto similique.',24,'Botble\\Hotel\\Models\\Booking',24,'INV-24',178.00,0.00,0.00,178.00,'canceled',NULL,'2024-09-18 03:10:27','2024-09-18 03:10:27'),(25,5,'CullenBeahan','esmith@example.com','+17275233773','4862 Delfina Streets\nHaleyburgh, NC 94285, Reyesberg, Lilamouth, Argentina, 28334-9218, ','Nisi reprehenderit dicta cum facere libero.',25,'Botble\\Hotel\\Models\\Booking',25,'INV-25',130.00,0.00,0.00,130.00,'canceled',NULL,'2024-09-18 03:10:27','2024-09-18 03:10:27'),(26,6,'BrittanySchoen','alfonzo.will@example.org','484-898-1642','142 Lilly Walks Suite 672\nSouth Lizeth, GA 21269-8180, New Omerland, Doyleton, Turkey, 61263, ','Nobis sed perferendis rerum nemo odit.',26,'Botble\\Hotel\\Models\\Booking',26,'INV-26',376.00,0.00,0.00,376.00,'canceled',NULL,'2024-09-18 03:10:27','2024-09-18 03:10:27'),(27,1,'FrederikRuecker','ycollins@example.org','949.235.6087','35916 Jaunita Lock\nPort Bernie, WY 01851, Port Bradfordburgh, McCulloughmouth, Senegal, 57399, ','Ea nostrum excepturi est esse unde quia et minus.',27,'Botble\\Hotel\\Models\\Booking',27,'INV-27',178.00,0.00,0.00,178.00,'canceled',NULL,'2024-09-18 03:10:27','2024-09-18 03:10:27'),(28,11,'NorvalTurner','katrina69@example.org','+1-551-489-2749','7011 Quinn Locks Suite 413\nSouth Rigobertomouth, MA 97667, Port Piper, Orvalmouth, Svalbard &amp; Jan Mayen Islands, 85221-8268, ','In fuga illo cumque dolorum.',28,'Botble\\Hotel\\Models\\Booking',28,'INV-28',345.00,0.00,0.00,345.00,'canceled',NULL,'2024-09-18 03:10:27','2024-09-18 03:10:27'),(29,3,'DayanaKris','mrau@example.com','+1-531-602-6200','3854 Swaniawski Roads\nEast Hermina, IL 90159-5638, South Sabrinashire, Janafort, Trinidad and Tobago, 18804-1051, ','Fugiat tenetur temporibus ut dolor consequuntur.',29,'Botble\\Hotel\\Models\\Booking',29,'INV-29',111.00,0.00,0.00,111.00,'pending',NULL,'2024-09-18 03:10:27','2024-09-18 03:10:27'),(30,11,'TorreyVolkman','reichel.amber@example.com','+1 (934) 245-9476','6373 Trey Greens\nNew Madaline, NH 42148, New Clotildehaven, North Laceyburgh, Slovenia, 24537, ','Inventore omnis dolores veritatis at voluptatem omnis in.',30,'Botble\\Hotel\\Models\\Booking',30,'INV-30',155.00,0.00,0.00,155.00,'completed','2024-09-18 03:10:28','2024-09-18 03:10:27','2024-09-18 03:10:28'),(31,2,'RomaHessel','tstehr@example.org','+18508051365','15661 Mac Row\nBruenport, MT 97598, Terrillfort, Hilpertburgh, Greece, 08315-3523, ','Omnis doloribus facere cumque ut.',31,'Botble\\Hotel\\Models\\Booking',31,'INV-31',130.00,0.00,0.00,130.00,'canceled',NULL,'2024-09-18 03:10:28','2024-09-18 03:10:28'),(32,5,'GertrudeChristiansen','augustine.mraz@example.com','+1-346-213-0230','50145 Kyle Forest\nEast Elmer, MO 00901, Collinsshire, Lake Darrin, Jordan, 12959, ','Reiciendis omnis eligendi ex porro id minus sit.',32,'Botble\\Hotel\\Models\\Booking',32,'INV-32',101.00,0.00,0.00,101.00,'canceled',NULL,'2024-09-18 03:10:28','2024-09-18 03:10:28'),(33,6,'MarilouO\'Kon','cremin.velva@example.com','904.536.3916','49277 Ladarius Court\nStoltenbergfurt, NM 93053-7649, Victorialand, Furmanchester, San Marino, 45238-5302, ','Modi quod ipsam nobis veniam.',33,'Botble\\Hotel\\Models\\Booking',33,'INV-33',558.00,0.00,0.00,558.00,'pending',NULL,'2024-09-18 03:10:28','2024-09-18 03:10:28'),(34,8,'MeggieAbernathy','cordie74@example.net','+1.914.836.2693','21890 Hoppe Fords Suite 618\nWest Rebekahaven, WA 56918-6899, Carleyfort, Chynashire, Kenya, 60187, ','Odit quia atque ut perspiciatis nihil.',34,'Botble\\Hotel\\Models\\Booking',34,'INV-34',188.00,0.00,0.00,188.00,'completed','2024-09-18 03:10:28','2024-09-18 03:10:28','2024-09-18 03:10:28'),(35,1,'ElbertHill','thurman.leuschke@example.net','+1-712-606-9491','6787 Morris Corners Apt. 446\nKulasmouth, MD 49492-8088, Heaneytown, East Naomie, Sudan, 47237, ','Exercitationem maiores ab aut omnis voluptas molestias quo.',35,'Botble\\Hotel\\Models\\Booking',35,'INV-35',115.00,0.00,0.00,115.00,'canceled',NULL,'2024-09-18 03:10:28','2024-09-18 03:10:28'),(36,9,'EarleneSawayn','bernardo.weber@example.org','1-847-270-3395','645 Heaney Parkways\nThompsontown, MS 46503-0852, Bahringermouth, North Helena, Brazil, 94675-7287, ','Suscipit id quo qui quos animi ducimus quas.',36,'Botble\\Hotel\\Models\\Booking',36,'INV-36',178.00,0.00,0.00,178.00,'canceled',NULL,'2024-09-18 03:10:28','2024-09-18 03:10:28'),(37,2,'AnnaBergnaum','davis.darron@example.com','+1 (614) 821-2805','30222 Camille Square\nAdalbertotown, NE 12656-3874, Bennieville, Goodwinland, Somalia, 95978-0767, ','Et sed et quo molestiae et et.',37,'Botble\\Hotel\\Models\\Booking',37,'INV-37',178.00,0.00,0.00,178.00,'canceled',NULL,'2024-09-18 03:10:28','2024-09-18 03:10:28'),(38,5,'MikaylaStracke','tara88@example.net','1-602-895-3796','142 Bosco Field Suite 675\nChristopheville, MD 26869, South Maxwell, Dahliabury, Portugal, 68214, ','Labore at laboriosam ut id est.',38,'Botble\\Hotel\\Models\\Booking',38,'INV-38',178.00,0.00,0.00,178.00,'canceled',NULL,'2024-09-18 03:10:28','2024-09-18 03:10:28'),(39,3,'RoderickBreitenberg','desiree39@example.org','+1.838.376.2978','11634 Schuppe Extensions Suite 991\nCarolynchester, IA 53256-2078, Lake Trinitymouth, Lake Penelopefurt, Iraq, 50716-7375, ','Aut alias nam aut ut.',39,'Botble\\Hotel\\Models\\Booking',39,'INV-39',465.00,0.00,0.00,465.00,'pending',NULL,'2024-09-18 03:10:28','2024-09-18 03:10:28'),(40,1,'LourdesCronin','adams.chelsey@example.org','254-506-5297','21657 Providenci Passage\nNew Rhiannon, AZ 44660, South Sharonbury, Abernathytown, Mayotte, 97127-0576, ','Et commodi ab aliquid possimus laboriosam.',40,'Botble\\Hotel\\Models\\Booking',40,'INV-40',564.00,0.00,0.00,564.00,'canceled',NULL,'2024-09-18 03:10:28','2024-09-18 03:10:28');
/*!40000 ALTER TABLE `ht_invoices` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ht_places`
--

DROP TABLE IF EXISTS `ht_places`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ht_places` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `distance` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `content` longtext COLLATE utf8mb4_unicode_ci,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'published',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ht_places`
--

LOCK TABLES `ht_places` WRITE;
/*!40000 ALTER TABLE `ht_places` DISABLE KEYS */;
INSERT INTO `ht_places` VALUES (1,'Duplex Restaurant','1,500m | 21 min. Walk',NULL,'<div class=\"nearby-attractions\">\n    <div class=\"content-box\">\n        <h2>Explore the Nearby Attractions</h2>\n        <p>Indulge in the beauty and flavors of the local area, where breathtaking sights and delightful cuisine await you. Allow us to present an overview of the splendid attractions you can experience during your stay.</p>\n\n        <div class=\"two-column\">\n            <div class=\"row\">\n                <div class=\"image-column col-xl-6 col-lg-12 col-md-12\">\n                    <figure class=\"image\"><img src=\"http://localhost/storage/places/01.jpg\" alt=\"RioRelax\"></figure>\n                </div>\n                <div class=\"text-column col-xl-6 col-lg-12 col-md-12\">\n                    <figure class=\"image\"><img src=\"http://localhost/storage/places/02.jpg\" alt=\"RioRelax\"></figure>\n                </div>\n            </div>\n        </div>\n\n        <h3>Relax at the Beach</h3>\n\n        <p>Unwind and soak in the serenity of the pristine beach just steps away from our hotel. The soft sand, gentle waves, and stunning horizon create an idyllic setting for you to rejuvenate your senses. Whether you\'re lounging under the sun or taking a leisurely stroll, the beach offers a tranquil escape from the daily hustle and bustle.</p>\n\n        <h3>Dine at the Finest Restaurant</h3>\n\n        <p>Embark on a culinary journey at the finest local restaurant that is a true gem in our neighborhood. Savor a diverse array of mouthwatering dishes meticulously crafted by skilled chefs. From delectable appetizers to sumptuous main courses and decadent desserts, every bite is a celebration of flavor and creativity. The cozy ambiance and attentive service enhance the overall dining experience.</p>\n\n        <p>Whether you\'re a food enthusiast or a nature lover, our hotel\'s location provides you with the best of both worlds. Immerse yourself in the captivating beauty of the beach and treat your taste buds to an unforgettable dining experience. Your stay with us is bound to be filled with wonderful memories that you\'ll cherish for years to come.</p>\n\n        <div class=\"two-column\">\n            <div class=\"row\">\n                <div class=\"image-column col-xl-12 col-lg-12 col-md-12\">\n                    <figure class=\"image\"><img src=\"http://localhost/storage/places/03.jpg\" alt=\"RioRelax\"></figure>\n                </div>\n            </div>\n        </div>\n\n        <p>For those seeking more adventure, a nearby scenic spot offers breathtaking views that will leave you in awe. The harmonious blend of nature\'s grandeur and artistic beauty makes this spot a perfect place to capture stunning photographs and create lasting memories.</p>\n\n        <p>Immerse yourself in the local culture, indulge in the delights of the area, and let your senses guide you as you explore the wonders just beyond our doorstep.</p>\n    </div>\n</div>\n','places/01.jpg','published','2024-09-18 03:10:19','2024-09-18 03:10:19'),(2,'Overnight Bars','1,500m | 21 min. Walk',NULL,'<div class=\"nearby-attractions\">\n    <div class=\"content-box\">\n        <h2>Explore the Nearby Attractions</h2>\n        <p>Indulge in the beauty and flavors of the local area, where breathtaking sights and delightful cuisine await you. Allow us to present an overview of the splendid attractions you can experience during your stay.</p>\n\n        <div class=\"two-column\">\n            <div class=\"row\">\n                <div class=\"image-column col-xl-6 col-lg-12 col-md-12\">\n                    <figure class=\"image\"><img src=\"http://localhost/storage/places/01.jpg\" alt=\"RioRelax\"></figure>\n                </div>\n                <div class=\"text-column col-xl-6 col-lg-12 col-md-12\">\n                    <figure class=\"image\"><img src=\"http://localhost/storage/places/02.jpg\" alt=\"RioRelax\"></figure>\n                </div>\n            </div>\n        </div>\n\n        <h3>Relax at the Beach</h3>\n\n        <p>Unwind and soak in the serenity of the pristine beach just steps away from our hotel. The soft sand, gentle waves, and stunning horizon create an idyllic setting for you to rejuvenate your senses. Whether you\'re lounging under the sun or taking a leisurely stroll, the beach offers a tranquil escape from the daily hustle and bustle.</p>\n\n        <h3>Dine at the Finest Restaurant</h3>\n\n        <p>Embark on a culinary journey at the finest local restaurant that is a true gem in our neighborhood. Savor a diverse array of mouthwatering dishes meticulously crafted by skilled chefs. From delectable appetizers to sumptuous main courses and decadent desserts, every bite is a celebration of flavor and creativity. The cozy ambiance and attentive service enhance the overall dining experience.</p>\n\n        <p>Whether you\'re a food enthusiast or a nature lover, our hotel\'s location provides you with the best of both worlds. Immerse yourself in the captivating beauty of the beach and treat your taste buds to an unforgettable dining experience. Your stay with us is bound to be filled with wonderful memories that you\'ll cherish for years to come.</p>\n\n        <div class=\"two-column\">\n            <div class=\"row\">\n                <div class=\"image-column col-xl-12 col-lg-12 col-md-12\">\n                    <figure class=\"image\"><img src=\"http://localhost/storage/places/03.jpg\" alt=\"RioRelax\"></figure>\n                </div>\n            </div>\n        </div>\n\n        <p>For those seeking more adventure, a nearby scenic spot offers breathtaking views that will leave you in awe. The harmonious blend of nature\'s grandeur and artistic beauty makes this spot a perfect place to capture stunning photographs and create lasting memories.</p>\n\n        <p>Immerse yourself in the local culture, indulge in the delights of the area, and let your senses guide you as you explore the wonders just beyond our doorstep.</p>\n    </div>\n</div>\n','places/02.jpg','published','2024-09-18 03:10:19','2024-09-18 03:10:19'),(3,'Beautiful Beach','1,500m | 21 min. Walk',NULL,'<div class=\"nearby-attractions\">\n    <div class=\"content-box\">\n        <h2>Explore the Nearby Attractions</h2>\n        <p>Indulge in the beauty and flavors of the local area, where breathtaking sights and delightful cuisine await you. Allow us to present an overview of the splendid attractions you can experience during your stay.</p>\n\n        <div class=\"two-column\">\n            <div class=\"row\">\n                <div class=\"image-column col-xl-6 col-lg-12 col-md-12\">\n                    <figure class=\"image\"><img src=\"http://localhost/storage/places/01.jpg\" alt=\"RioRelax\"></figure>\n                </div>\n                <div class=\"text-column col-xl-6 col-lg-12 col-md-12\">\n                    <figure class=\"image\"><img src=\"http://localhost/storage/places/02.jpg\" alt=\"RioRelax\"></figure>\n                </div>\n            </div>\n        </div>\n\n        <h3>Relax at the Beach</h3>\n\n        <p>Unwind and soak in the serenity of the pristine beach just steps away from our hotel. The soft sand, gentle waves, and stunning horizon create an idyllic setting for you to rejuvenate your senses. Whether you\'re lounging under the sun or taking a leisurely stroll, the beach offers a tranquil escape from the daily hustle and bustle.</p>\n\n        <h3>Dine at the Finest Restaurant</h3>\n\n        <p>Embark on a culinary journey at the finest local restaurant that is a true gem in our neighborhood. Savor a diverse array of mouthwatering dishes meticulously crafted by skilled chefs. From delectable appetizers to sumptuous main courses and decadent desserts, every bite is a celebration of flavor and creativity. The cozy ambiance and attentive service enhance the overall dining experience.</p>\n\n        <p>Whether you\'re a food enthusiast or a nature lover, our hotel\'s location provides you with the best of both worlds. Immerse yourself in the captivating beauty of the beach and treat your taste buds to an unforgettable dining experience. Your stay with us is bound to be filled with wonderful memories that you\'ll cherish for years to come.</p>\n\n        <div class=\"two-column\">\n            <div class=\"row\">\n                <div class=\"image-column col-xl-12 col-lg-12 col-md-12\">\n                    <figure class=\"image\"><img src=\"http://localhost/storage/places/03.jpg\" alt=\"RioRelax\"></figure>\n                </div>\n            </div>\n        </div>\n\n        <p>For those seeking more adventure, a nearby scenic spot offers breathtaking views that will leave you in awe. The harmonious blend of nature\'s grandeur and artistic beauty makes this spot a perfect place to capture stunning photographs and create lasting memories.</p>\n\n        <p>Immerse yourself in the local culture, indulge in the delights of the area, and let your senses guide you as you explore the wonders just beyond our doorstep.</p>\n    </div>\n</div>\n','places/03.jpg','published','2024-09-18 03:10:19','2024-09-18 03:10:19'),(4,'Beautiful Spa','1,500m | 21 min. Walk',NULL,'<div class=\"nearby-attractions\">\n    <div class=\"content-box\">\n        <h2>Explore the Nearby Attractions</h2>\n        <p>Indulge in the beauty and flavors of the local area, where breathtaking sights and delightful cuisine await you. Allow us to present an overview of the splendid attractions you can experience during your stay.</p>\n\n        <div class=\"two-column\">\n            <div class=\"row\">\n                <div class=\"image-column col-xl-6 col-lg-12 col-md-12\">\n                    <figure class=\"image\"><img src=\"http://localhost/storage/places/01.jpg\" alt=\"RioRelax\"></figure>\n                </div>\n                <div class=\"text-column col-xl-6 col-lg-12 col-md-12\">\n                    <figure class=\"image\"><img src=\"http://localhost/storage/places/02.jpg\" alt=\"RioRelax\"></figure>\n                </div>\n            </div>\n        </div>\n\n        <h3>Relax at the Beach</h3>\n\n        <p>Unwind and soak in the serenity of the pristine beach just steps away from our hotel. The soft sand, gentle waves, and stunning horizon create an idyllic setting for you to rejuvenate your senses. Whether you\'re lounging under the sun or taking a leisurely stroll, the beach offers a tranquil escape from the daily hustle and bustle.</p>\n\n        <h3>Dine at the Finest Restaurant</h3>\n\n        <p>Embark on a culinary journey at the finest local restaurant that is a true gem in our neighborhood. Savor a diverse array of mouthwatering dishes meticulously crafted by skilled chefs. From delectable appetizers to sumptuous main courses and decadent desserts, every bite is a celebration of flavor and creativity. The cozy ambiance and attentive service enhance the overall dining experience.</p>\n\n        <p>Whether you\'re a food enthusiast or a nature lover, our hotel\'s location provides you with the best of both worlds. Immerse yourself in the captivating beauty of the beach and treat your taste buds to an unforgettable dining experience. Your stay with us is bound to be filled with wonderful memories that you\'ll cherish for years to come.</p>\n\n        <div class=\"two-column\">\n            <div class=\"row\">\n                <div class=\"image-column col-xl-12 col-lg-12 col-md-12\">\n                    <figure class=\"image\"><img src=\"http://localhost/storage/places/03.jpg\" alt=\"RioRelax\"></figure>\n                </div>\n            </div>\n        </div>\n\n        <p>For those seeking more adventure, a nearby scenic spot offers breathtaking views that will leave you in awe. The harmonious blend of nature\'s grandeur and artistic beauty makes this spot a perfect place to capture stunning photographs and create lasting memories.</p>\n\n        <p>Immerse yourself in the local culture, indulge in the delights of the area, and let your senses guide you as you explore the wonders just beyond our doorstep.</p>\n    </div>\n</div>\n','places/04.jpg','published','2024-09-18 03:10:19','2024-09-18 03:10:19'),(5,'Duplex Golf','1,500m | 21 min. Walk',NULL,'<div class=\"nearby-attractions\">\n    <div class=\"content-box\">\n        <h2>Explore the Nearby Attractions</h2>\n        <p>Indulge in the beauty and flavors of the local area, where breathtaking sights and delightful cuisine await you. Allow us to present an overview of the splendid attractions you can experience during your stay.</p>\n\n        <div class=\"two-column\">\n            <div class=\"row\">\n                <div class=\"image-column col-xl-6 col-lg-12 col-md-12\">\n                    <figure class=\"image\"><img src=\"http://localhost/storage/places/01.jpg\" alt=\"RioRelax\"></figure>\n                </div>\n                <div class=\"text-column col-xl-6 col-lg-12 col-md-12\">\n                    <figure class=\"image\"><img src=\"http://localhost/storage/places/02.jpg\" alt=\"RioRelax\"></figure>\n                </div>\n            </div>\n        </div>\n\n        <h3>Relax at the Beach</h3>\n\n        <p>Unwind and soak in the serenity of the pristine beach just steps away from our hotel. The soft sand, gentle waves, and stunning horizon create an idyllic setting for you to rejuvenate your senses. Whether you\'re lounging under the sun or taking a leisurely stroll, the beach offers a tranquil escape from the daily hustle and bustle.</p>\n\n        <h3>Dine at the Finest Restaurant</h3>\n\n        <p>Embark on a culinary journey at the finest local restaurant that is a true gem in our neighborhood. Savor a diverse array of mouthwatering dishes meticulously crafted by skilled chefs. From delectable appetizers to sumptuous main courses and decadent desserts, every bite is a celebration of flavor and creativity. The cozy ambiance and attentive service enhance the overall dining experience.</p>\n\n        <p>Whether you\'re a food enthusiast or a nature lover, our hotel\'s location provides you with the best of both worlds. Immerse yourself in the captivating beauty of the beach and treat your taste buds to an unforgettable dining experience. Your stay with us is bound to be filled with wonderful memories that you\'ll cherish for years to come.</p>\n\n        <div class=\"two-column\">\n            <div class=\"row\">\n                <div class=\"image-column col-xl-12 col-lg-12 col-md-12\">\n                    <figure class=\"image\"><img src=\"http://localhost/storage/places/03.jpg\" alt=\"RioRelax\"></figure>\n                </div>\n            </div>\n        </div>\n\n        <p>For those seeking more adventure, a nearby scenic spot offers breathtaking views that will leave you in awe. The harmonious blend of nature\'s grandeur and artistic beauty makes this spot a perfect place to capture stunning photographs and create lasting memories.</p>\n\n        <p>Immerse yourself in the local culture, indulge in the delights of the area, and let your senses guide you as you explore the wonders just beyond our doorstep.</p>\n    </div>\n</div>\n','places/05.jpg','published','2024-09-18 03:10:19','2024-09-18 03:10:19'),(6,'Luxury Restaurant','1,500m | 21 min. Walk',NULL,'<div class=\"nearby-attractions\">\n    <div class=\"content-box\">\n        <h2>Explore the Nearby Attractions</h2>\n        <p>Indulge in the beauty and flavors of the local area, where breathtaking sights and delightful cuisine await you. Allow us to present an overview of the splendid attractions you can experience during your stay.</p>\n\n        <div class=\"two-column\">\n            <div class=\"row\">\n                <div class=\"image-column col-xl-6 col-lg-12 col-md-12\">\n                    <figure class=\"image\"><img src=\"http://localhost/storage/places/01.jpg\" alt=\"RioRelax\"></figure>\n                </div>\n                <div class=\"text-column col-xl-6 col-lg-12 col-md-12\">\n                    <figure class=\"image\"><img src=\"http://localhost/storage/places/02.jpg\" alt=\"RioRelax\"></figure>\n                </div>\n            </div>\n        </div>\n\n        <h3>Relax at the Beach</h3>\n\n        <p>Unwind and soak in the serenity of the pristine beach just steps away from our hotel. The soft sand, gentle waves, and stunning horizon create an idyllic setting for you to rejuvenate your senses. Whether you\'re lounging under the sun or taking a leisurely stroll, the beach offers a tranquil escape from the daily hustle and bustle.</p>\n\n        <h3>Dine at the Finest Restaurant</h3>\n\n        <p>Embark on a culinary journey at the finest local restaurant that is a true gem in our neighborhood. Savor a diverse array of mouthwatering dishes meticulously crafted by skilled chefs. From delectable appetizers to sumptuous main courses and decadent desserts, every bite is a celebration of flavor and creativity. The cozy ambiance and attentive service enhance the overall dining experience.</p>\n\n        <p>Whether you\'re a food enthusiast or a nature lover, our hotel\'s location provides you with the best of both worlds. Immerse yourself in the captivating beauty of the beach and treat your taste buds to an unforgettable dining experience. Your stay with us is bound to be filled with wonderful memories that you\'ll cherish for years to come.</p>\n\n        <div class=\"two-column\">\n            <div class=\"row\">\n                <div class=\"image-column col-xl-12 col-lg-12 col-md-12\">\n                    <figure class=\"image\"><img src=\"http://localhost/storage/places/03.jpg\" alt=\"RioRelax\"></figure>\n                </div>\n            </div>\n        </div>\n\n        <p>For those seeking more adventure, a nearby scenic spot offers breathtaking views that will leave you in awe. The harmonious blend of nature\'s grandeur and artistic beauty makes this spot a perfect place to capture stunning photographs and create lasting memories.</p>\n\n        <p>Immerse yourself in the local culture, indulge in the delights of the area, and let your senses guide you as you explore the wonders just beyond our doorstep.</p>\n    </div>\n</div>\n','places/06.jpg','published','2024-09-18 03:10:19','2024-09-18 03:10:19');
/*!40000 ALTER TABLE `ht_places` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ht_places_translations`
--

DROP TABLE IF EXISTS `ht_places_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ht_places_translations` (
  `lang_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ht_places_id` bigint unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `distance` text COLLATE utf8mb4_unicode_ci,
  `description` text COLLATE utf8mb4_unicode_ci,
  `content` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`lang_code`,`ht_places_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ht_places_translations`
--

LOCK TABLES `ht_places_translations` WRITE;
/*!40000 ALTER TABLE `ht_places_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `ht_places_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ht_room_categories`
--

DROP TABLE IF EXISTS `ht_room_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ht_room_categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'published',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `order` tinyint NOT NULL DEFAULT '0',
  `is_featured` tinyint NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ht_room_categories`
--

LOCK TABLES `ht_room_categories` WRITE;
/*!40000 ALTER TABLE `ht_room_categories` DISABLE KEYS */;
INSERT INTO `ht_room_categories` VALUES (1,'Luxury','published','2024-09-18 03:10:13','2024-09-18 03:10:13',0,1),(2,'Family','published','2024-09-18 03:10:13','2024-09-18 03:10:13',0,1),(3,'Double Bed','published','2024-09-18 03:10:13','2024-09-18 03:10:13',0,1),(4,'Relax','published','2024-09-18 03:10:13','2024-09-18 03:10:13',0,1);
/*!40000 ALTER TABLE `ht_room_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ht_room_categories_translations`
--

DROP TABLE IF EXISTS `ht_room_categories_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ht_room_categories_translations` (
  `lang_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ht_room_categories_id` bigint unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`lang_code`,`ht_room_categories_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ht_room_categories_translations`
--

LOCK TABLES `ht_room_categories_translations` WRITE;
/*!40000 ALTER TABLE `ht_room_categories_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `ht_room_categories_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ht_room_dates`
--

DROP TABLE IF EXISTS `ht_room_dates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ht_room_dates` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `room_id` bigint unsigned DEFAULT NULL,
  `start_date` timestamp NULL DEFAULT NULL,
  `end_date` timestamp NULL DEFAULT NULL,
  `value` decimal(15,2) DEFAULT NULL,
  `value_type` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'fixed',
  `max_guests` tinyint DEFAULT NULL,
  `active` tinyint DEFAULT '0',
  `note_to_customer` text COLLATE utf8mb4_unicode_ci,
  `note_to_admin` text COLLATE utf8mb4_unicode_ci,
  `number_of_rooms` smallint DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ht_room_dates`
--

LOCK TABLES `ht_room_dates` WRITE;
/*!40000 ALTER TABLE `ht_room_dates` DISABLE KEYS */;
/*!40000 ALTER TABLE `ht_room_dates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ht_room_reviews`
--

DROP TABLE IF EXISTS `ht_room_reviews`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ht_room_reviews` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` bigint unsigned NOT NULL,
  `room_id` int NOT NULL,
  `star` tinyint NOT NULL,
  `content` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'approved',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ht_room_reviews`
--

LOCK TABLES `ht_room_reviews` WRITE;
/*!40000 ALTER TABLE `ht_room_reviews` DISABLE KEYS */;
INSERT INTO `ht_room_reviews` VALUES (1,4,5,5,'Absolutely loved my experience here! The room was not only clean and comfortable but also offered stunning views of the surrounding area. A perfect choice for a relaxing getaway.','approved','2024-09-18 03:10:28','2024-09-18 03:10:28'),(2,8,6,5,'I couldn’t have asked for a better place to stay. The room’s design was elegant, and the comfort level was off the charts. Staying here added a layer of luxury to my trip.','approved','2024-09-18 03:10:28','2024-09-18 03:10:28'),(3,7,2,5,'Absolutely loved my experience here! The room was not only clean and comfortable but also offered stunning views of the surrounding area. A perfect choice for a relaxing getaway.','approved','2024-09-18 03:10:28','2024-09-18 03:10:28'),(4,8,8,4,'Exceeded all my hopes! The room was not only comfortable but also surprisingly spacious. I loved the attention to cleanliness and the warm, inviting atmosphere.','approved','2024-09-18 03:10:28','2024-09-18 03:10:28'),(5,6,4,5,'I couldn’t have asked for a better place to stay. The room’s design was elegant, and the comfort level was off the charts. Staying here added a layer of luxury to my trip.','approved','2024-09-18 03:10:28','2024-09-18 03:10:28'),(6,5,2,4,'An incredible stay! The room was spacious and beautifully decorated. The amenities provided made me feel right at home. I can’t wait to come back.','approved','2024-09-18 03:10:28','2024-09-18 03:10:28'),(7,6,1,4,'I couldn’t have asked for a better place to stay. The room’s design was elegant, and the comfort level was off the charts. Staying here added a layer of luxury to my trip.','approved','2024-09-18 03:10:28','2024-09-18 03:10:28'),(8,7,1,4,'A hidden gem! The room was a haven of tranquility, providing a peaceful escape from the bustling city. I appreciated the little touches that made my stay truly special.','approved','2024-09-18 03:10:28','2024-09-18 03:10:28'),(9,7,4,5,'I couldn’t have asked for a better place to stay. The room’s design was elegant, and the comfort level was off the charts. Staying here added a layer of luxury to my trip.','approved','2024-09-18 03:10:28','2024-09-18 03:10:28'),(10,3,1,5,'I couldn’t have asked for a better place to stay. The room’s design was elegant, and the comfort level was off the charts. Staying here added a layer of luxury to my trip.','approved','2024-09-18 03:10:28','2024-09-18 03:10:28'),(11,7,5,5,'Five-star experience all the way. The room was meticulously maintained, and the staff was incredibly helpful throughout my stay. I’m already planning my next visit.','approved','2024-09-18 03:10:28','2024-09-18 03:10:28'),(12,10,5,5,'Absolutely loved my experience here! The room was not only clean and comfortable but also offered stunning views of the surrounding area. A perfect choice for a relaxing getaway.','approved','2024-09-18 03:10:28','2024-09-18 03:10:28'),(13,5,4,4,'A hidden gem! The room was a haven of tranquility, providing a peaceful escape from the bustling city. I appreciated the little touches that made my stay truly special.','approved','2024-09-18 03:10:28','2024-09-18 03:10:28'),(14,2,5,5,'Five-star experience all the way. The room was meticulously maintained, and the staff was incredibly helpful throughout my stay. I’m already planning my next visit.','approved','2024-09-18 03:10:28','2024-09-18 03:10:28'),(15,11,1,4,'Absolutely loved my experience here! The room was not only clean and comfortable but also offered stunning views of the surrounding area. A perfect choice for a relaxing getaway.','approved','2024-09-18 03:10:28','2024-09-18 03:10:28'),(16,9,1,4,'Exceeded all my hopes! The room was not only comfortable but also surprisingly spacious. I loved the attention to cleanliness and the warm, inviting atmosphere.','approved','2024-09-18 03:10:28','2024-09-18 03:10:28'),(17,3,8,4,'A hidden gem! The room was a haven of tranquility, providing a peaceful escape from the bustling city. I appreciated the little touches that made my stay truly special.','approved','2024-09-18 03:10:28','2024-09-18 03:10:28'),(18,4,7,4,'Top-notch accommodations! The room was well-appointed and had all the necessary amenities. The staff was incredibly friendly and made my stay even more enjoyable.','approved','2024-09-18 03:10:28','2024-09-18 03:10:28'),(19,9,5,5,'A hidden gem! The room was a haven of tranquility, providing a peaceful escape from the bustling city. I appreciated the little touches that made my stay truly special.','approved','2024-09-18 03:10:28','2024-09-18 03:10:28'),(20,4,7,5,'I couldn’t have asked for a better place to stay. The room’s design was elegant, and the comfort level was off the charts. Staying here added a layer of luxury to my trip.','approved','2024-09-18 03:10:28','2024-09-18 03:10:28'),(21,9,5,5,'I couldn’t have asked for a better place to stay. The room’s design was elegant, and the comfort level was off the charts. Staying here added a layer of luxury to my trip.','approved','2024-09-18 03:10:28','2024-09-18 03:10:28'),(22,2,8,5,'Exceeded all my hopes! The room was not only comfortable but also surprisingly spacious. I loved the attention to cleanliness and the warm, inviting atmosphere.','approved','2024-09-18 03:10:28','2024-09-18 03:10:28'),(23,7,7,5,'Exceeded all my hopes! The room was not only comfortable but also surprisingly spacious. I loved the attention to cleanliness and the warm, inviting atmosphere.','approved','2024-09-18 03:10:28','2024-09-18 03:10:28'),(24,6,4,4,'I couldn’t have asked for a better place to stay. The room’s design was elegant, and the comfort level was off the charts. Staying here added a layer of luxury to my trip.','approved','2024-09-18 03:10:28','2024-09-18 03:10:28'),(25,7,8,4,'I couldn’t have asked for a better place to stay. The room’s design was elegant, and the comfort level was off the charts. Staying here added a layer of luxury to my trip.','approved','2024-09-18 03:10:28','2024-09-18 03:10:28'),(26,3,3,4,'A hidden gem! The room was a haven of tranquility, providing a peaceful escape from the bustling city. I appreciated the little touches that made my stay truly special.','approved','2024-09-18 03:10:28','2024-09-18 03:10:28'),(27,5,5,4,'An incredible stay! The room was spacious and beautifully decorated. The amenities provided made me feel right at home. I can’t wait to come back.','approved','2024-09-18 03:10:28','2024-09-18 03:10:28'),(28,5,6,5,'I couldn’t have asked for a better place to stay. The room’s design was elegant, and the comfort level was off the charts. Staying here added a layer of luxury to my trip.','approved','2024-09-18 03:10:28','2024-09-18 03:10:28'),(29,4,8,4,'A hidden gem! The room was a haven of tranquility, providing a peaceful escape from the bustling city. I appreciated the little touches that made my stay truly special.','approved','2024-09-18 03:10:28','2024-09-18 03:10:28'),(30,4,4,5,'Absolutely loved my experience here! The room was not only clean and comfortable but also offered stunning views of the surrounding area. A perfect choice for a relaxing getaway.','approved','2024-09-18 03:10:28','2024-09-18 03:10:28'),(31,4,6,5,'Exceeded all my hopes! The room was not only comfortable but also surprisingly spacious. I loved the attention to cleanliness and the warm, inviting atmosphere.','approved','2024-09-18 03:10:28','2024-09-18 03:10:28'),(32,4,6,5,'Top-notch accommodations! The room was well-appointed and had all the necessary amenities. The staff was incredibly friendly and made my stay even more enjoyable.','approved','2024-09-18 03:10:28','2024-09-18 03:10:28'),(33,7,1,4,'Five-star experience all the way. The room was meticulously maintained, and the staff was incredibly helpful throughout my stay. I’m already planning my next visit.','approved','2024-09-18 03:10:28','2024-09-18 03:10:28'),(34,3,6,5,'I was thoroughly impressed with the attention to detail in the room. Everything from the cozy bed to the modern bathroom exceeded my expectations. Highly recommend!','approved','2024-09-18 03:10:28','2024-09-18 03:10:28'),(35,4,7,4,'Top-notch accommodations! The room was well-appointed and had all the necessary amenities. The staff was incredibly friendly and made my stay even more enjoyable.','approved','2024-09-18 03:10:28','2024-09-18 03:10:28'),(36,11,1,4,'Absolutely loved my experience here! The room was not only clean and comfortable but also offered stunning views of the surrounding area. A perfect choice for a relaxing getaway.','approved','2024-09-18 03:10:28','2024-09-18 03:10:28'),(37,10,7,5,'Absolutely loved my experience here! The room was not only clean and comfortable but also offered stunning views of the surrounding area. A perfect choice for a relaxing getaway.','approved','2024-09-18 03:10:28','2024-09-18 03:10:28'),(38,2,6,5,'Exceeded all my hopes! The room was not only comfortable but also surprisingly spacious. I loved the attention to cleanliness and the warm, inviting atmosphere.','approved','2024-09-18 03:10:28','2024-09-18 03:10:28'),(39,3,5,4,'I was thoroughly impressed with the attention to detail in the room. Everything from the cozy bed to the modern bathroom exceeded my expectations. Highly recommend!','approved','2024-09-18 03:10:28','2024-09-18 03:10:28'),(40,5,3,5,'I couldn’t have asked for a better place to stay. The room’s design was elegant, and the comfort level was off the charts. Staying here added a layer of luxury to my trip.','approved','2024-09-18 03:10:28','2024-09-18 03:10:28'),(41,8,2,4,'Absolutely loved my experience here! The room was not only clean and comfortable but also offered stunning views of the surrounding area. A perfect choice for a relaxing getaway.','approved','2024-09-18 03:10:28','2024-09-18 03:10:28'),(42,10,8,4,'I was thoroughly impressed with the attention to detail in the room. Everything from the cozy bed to the modern bathroom exceeded my expectations. Highly recommend!','approved','2024-09-18 03:10:28','2024-09-18 03:10:28'),(43,3,5,4,'Five-star experience all the way. The room was meticulously maintained, and the staff was incredibly helpful throughout my stay. I’m already planning my next visit.','approved','2024-09-18 03:10:28','2024-09-18 03:10:28'),(44,8,5,4,'I was thoroughly impressed with the attention to detail in the room. Everything from the cozy bed to the modern bathroom exceeded my expectations. Highly recommend!','approved','2024-09-18 03:10:28','2024-09-18 03:10:28'),(45,6,4,5,'Absolutely loved my experience here! The room was not only clean and comfortable but also offered stunning views of the surrounding area. A perfect choice for a relaxing getaway.','approved','2024-09-18 03:10:28','2024-09-18 03:10:28'),(46,8,2,5,'Exceeded all my hopes! The room was not only comfortable but also surprisingly spacious. I loved the attention to cleanliness and the warm, inviting atmosphere.','approved','2024-09-18 03:10:28','2024-09-18 03:10:28'),(47,3,7,5,'Top-notch accommodations! The room was well-appointed and had all the necessary amenities. The staff was incredibly friendly and made my stay even more enjoyable.','approved','2024-09-18 03:10:28','2024-09-18 03:10:28'),(48,3,6,5,'I was thoroughly impressed with the attention to detail in the room. Everything from the cozy bed to the modern bathroom exceeded my expectations. Highly recommend!','approved','2024-09-18 03:10:28','2024-09-18 03:10:28'),(49,3,4,5,'I was thoroughly impressed with the attention to detail in the room. Everything from the cozy bed to the modern bathroom exceeded my expectations. Highly recommend!','approved','2024-09-18 03:10:28','2024-09-18 03:10:28'),(50,6,6,5,'I was thoroughly impressed with the attention to detail in the room. Everything from the cozy bed to the modern bathroom exceeded my expectations. Highly recommend!','approved','2024-09-18 03:10:28','2024-09-18 03:10:28');
/*!40000 ALTER TABLE `ht_room_reviews` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ht_rooms`
--

DROP TABLE IF EXISTS `ht_rooms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ht_rooms` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `content` longtext COLLATE utf8mb4_unicode_ci,
  `is_featured` tinyint unsigned NOT NULL DEFAULT '0',
  `images` text COLLATE utf8mb4_unicode_ci,
  `price` decimal(15,0) unsigned DEFAULT NULL,
  `currency_id` bigint unsigned DEFAULT NULL,
  `number_of_rooms` int unsigned DEFAULT '0',
  `number_of_beds` int unsigned DEFAULT '0',
  `size` int unsigned DEFAULT '0',
  `max_adults` int DEFAULT '0',
  `max_children` int DEFAULT '0',
  `room_category_id` bigint unsigned DEFAULT NULL,
  `tax_id` bigint unsigned DEFAULT NULL,
  `status` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'published',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `order` int unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ht_rooms`
--

LOCK TABLES `ht_rooms` WRITE;
/*!40000 ALTER TABLE `ht_rooms` DISABLE KEYS */;
INSERT INTO `ht_rooms` VALUES (1,'Luxury Hall Of Fame','Our spacious room offers a cozy ambiance, modern amenities, and stunning city views.','<p>Understated seaside elegance, traditional grace, complemented by warm homely touches and pops of modern flair, Rest Detail Hotel Hua Hin\n    invites you to discover our exquisitely designed resort set in a peaceful enclave just out of Hua Hin town. A charming setting, spacious yet incredibly cozy rooms, luxurious two – four bedroom Pavilions with private swimming pools. Recreational facilities to help you relax, delicious local and European dishes delicately plated for you to taste, meticulously put together for you to have the perfect break.</p>\n<p>Experience tranquility by the shore. Our room offers a private balcony for mesmerizing sunsets, a king-sized bed with luxurious linens, a spa-inspired bathroom, and coastal-themed decor. Unwind to the sound of waves and relish in the ultimate seaside escape.</p>\n',1,'[\"rooms\\/01.jpg\",\"rooms\\/02.jpg\",\"rooms\\/03.jpg\",\"rooms\\/04.jpg\",\"rooms\\/05.jpg\",\"rooms\\/06.jpg\"]',111,NULL,8,3,186,2,3,1,1,'published','2024-09-18 03:10:14','2024-09-18 03:10:14',0),(2,'Pendora Fame','Indulge in comfort with plush furnishings, a private balcony, and personalized service.','<p>Understated seaside elegance, traditional grace, complemented by warm homely touches and pops of modern flair, Rest Detail Hotel Hua Hin\n    invites you to discover our exquisitely designed resort set in a peaceful enclave just out of Hua Hin town. A charming setting, spacious yet incredibly cozy rooms, luxurious two – four bedroom Pavilions with private swimming pools. Recreational facilities to help you relax, delicious local and European dishes delicately plated for you to taste, meticulously put together for you to have the perfect break.</p>\n<p>Experience tranquility by the shore. Our room offers a private balcony for mesmerizing sunsets, a king-sized bed with luxurious linens, a spa-inspired bathroom, and coastal-themed decor. Unwind to the sound of waves and relish in the ultimate seaside escape.</p>\n',1,'[\"rooms\\/02.jpg\",\"rooms\\/01.jpg\",\"rooms\\/03.jpg\",\"rooms\\/04.jpg\",\"rooms\\/05.jpg\",\"rooms\\/06.jpg\"]',186,NULL,9,1,126,4,3,1,1,'published','2024-09-18 03:10:14','2024-09-18 03:10:14',0),(3,'Pacific Room','Unwind in style amid soothing decor, a king-sized bed, and a rejuvenating rain shower.','<p>Understated seaside elegance, traditional grace, complemented by warm homely touches and pops of modern flair, Rest Detail Hotel Hua Hin\n    invites you to discover our exquisitely designed resort set in a peaceful enclave just out of Hua Hin town. A charming setting, spacious yet incredibly cozy rooms, luxurious two – four bedroom Pavilions with private swimming pools. Recreational facilities to help you relax, delicious local and European dishes delicately plated for you to taste, meticulously put together for you to have the perfect break.</p>\n<p>Experience tranquility by the shore. Our room offers a private balcony for mesmerizing sunsets, a king-sized bed with luxurious linens, a spa-inspired bathroom, and coastal-themed decor. Unwind to the sound of waves and relish in the ultimate seaside escape.</p>\n',1,'[\"rooms\\/03.jpg\",\"rooms\\/02.jpg\",\"rooms\\/01.jpg\",\"rooms\\/04.jpg\",\"rooms\\/05.jpg\",\"rooms\\/06.jpg\"]',101,NULL,3,4,134,2,3,1,1,'published','2024-09-18 03:10:14','2024-09-18 03:10:14',0),(4,'Junior Suite','Experience coastal charm in a room that overlooks the beach, complete with beach-inspired decor.','<p>Understated seaside elegance, traditional grace, complemented by warm homely touches and pops of modern flair, Rest Detail Hotel Hua Hin\n    invites you to discover our exquisitely designed resort set in a peaceful enclave just out of Hua Hin town. A charming setting, spacious yet incredibly cozy rooms, luxurious two – four bedroom Pavilions with private swimming pools. Recreational facilities to help you relax, delicious local and European dishes delicately plated for you to taste, meticulously put together for you to have the perfect break.</p>\n<p>Experience tranquility by the shore. Our room offers a private balcony for mesmerizing sunsets, a king-sized bed with luxurious linens, a spa-inspired bathroom, and coastal-themed decor. Unwind to the sound of waves and relish in the ultimate seaside escape.</p>\n',1,'[\"rooms\\/04.jpg\",\"rooms\\/02.jpg\",\"rooms\\/01.jpg\",\"rooms\\/04.jpg\",\"rooms\\/05.jpg\",\"rooms\\/06.jpg\"]',188,NULL,2,3,106,6,1,1,1,'published','2024-09-18 03:10:14','2024-09-18 03:10:14',0),(5,'Family Suite','Enjoy city living at its finest with contemporary design, high-end comforts, and easy access to attractions.','<p>Understated seaside elegance, traditional grace, complemented by warm homely touches and pops of modern flair, Rest Detail Hotel Hua Hin\n    invites you to discover our exquisitely designed resort set in a peaceful enclave just out of Hua Hin town. A charming setting, spacious yet incredibly cozy rooms, luxurious two – four bedroom Pavilions with private swimming pools. Recreational facilities to help you relax, delicious local and European dishes delicately plated for you to taste, meticulously put together for you to have the perfect break.</p>\n<p>Experience tranquility by the shore. Our room offers a private balcony for mesmerizing sunsets, a king-sized bed with luxurious linens, a spa-inspired bathroom, and coastal-themed decor. Unwind to the sound of waves and relish in the ultimate seaside escape.</p>\n',1,'[\"rooms\\/05.jpg\"]',178,NULL,5,3,138,5,3,1,1,'published','2024-09-18 03:10:14','2024-09-18 03:10:14',0),(6,'Relax Suite','A rustic escape featuring wooden accents, a fireplace, and large windows for panoramic views.','<p>Understated seaside elegance, traditional grace, complemented by warm homely touches and pops of modern flair, Rest Detail Hotel Hua Hin\n    invites you to discover our exquisitely designed resort set in a peaceful enclave just out of Hua Hin town. A charming setting, spacious yet incredibly cozy rooms, luxurious two – four bedroom Pavilions with private swimming pools. Recreational facilities to help you relax, delicious local and European dishes delicately plated for you to taste, meticulously put together for you to have the perfect break.</p>\n<p>Experience tranquility by the shore. Our room offers a private balcony for mesmerizing sunsets, a king-sized bed with luxurious linens, a spa-inspired bathroom, and coastal-themed decor. Unwind to the sound of waves and relish in the ultimate seaside escape.</p>\n',1,'[\"rooms\\/06.jpg\",\"rooms\\/02.jpg\",\"rooms\\/03.jpg\",\"rooms\\/04.jpg\",\"rooms\\/05.jpg\",\"rooms\\/01.jpg\"]',130,NULL,4,4,102,6,3,4,1,'published','2024-09-18 03:10:14','2024-09-18 03:10:14',0),(7,'Luxury Suite','Ideal for families, this room boasts interconnected spaces, playful decor, and modern conveniences.','<p>Understated seaside elegance, traditional grace, complemented by warm homely touches and pops of modern flair, Rest Detail Hotel Hua Hin\n    invites you to discover our exquisitely designed resort set in a peaceful enclave just out of Hua Hin town. A charming setting, spacious yet incredibly cozy rooms, luxurious two – four bedroom Pavilions with private swimming pools. Recreational facilities to help you relax, delicious local and European dishes delicately plated for you to taste, meticulously put together for you to have the perfect break.</p>\n<p>Experience tranquility by the shore. Our room offers a private balcony for mesmerizing sunsets, a king-sized bed with luxurious linens, a spa-inspired bathroom, and coastal-themed decor. Unwind to the sound of waves and relish in the ultimate seaside escape.</p>\n',1,'[\"rooms\\/01.jpg\",\"rooms\\/02.jpg\",\"rooms\\/03.jpg\",\"rooms\\/04.jpg\",\"rooms\\/05.jpg\",\"rooms\\/06.jpg\"]',155,NULL,8,2,177,4,1,1,1,'published','2024-09-18 03:10:14','2024-09-18 03:10:14',0),(8,'President Room','Ignite romance with a room designed for couples, featuring a four-poster bed and intimate lighting.','<p>Understated seaside elegance, traditional grace, complemented by warm homely touches and pops of modern flair, Rest Detail Hotel Hua Hin\n    invites you to discover our exquisitely designed resort set in a peaceful enclave just out of Hua Hin town. A charming setting, spacious yet incredibly cozy rooms, luxurious two – four bedroom Pavilions with private swimming pools. Recreational facilities to help you relax, delicious local and European dishes delicately plated for you to taste, meticulously put together for you to have the perfect break.</p>\n<p>Experience tranquility by the shore. Our room offers a private balcony for mesmerizing sunsets, a king-sized bed with luxurious linens, a spa-inspired bathroom, and coastal-themed decor. Unwind to the sound of waves and relish in the ultimate seaside escape.</p>\n',0,'[\"rooms\\/02.jpg\",\"rooms\\/01.jpg\",\"rooms\\/03.jpg\",\"rooms\\/04.jpg\",\"rooms\\/05.jpg\",\"rooms\\/06.jpg\"]',115,NULL,6,1,152,3,1,4,1,'published','2024-09-18 03:10:14','2024-09-18 03:10:14',0);
/*!40000 ALTER TABLE `ht_rooms` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ht_rooms_amenities`
--

DROP TABLE IF EXISTS `ht_rooms_amenities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ht_rooms_amenities` (
  `amenity_id` bigint unsigned NOT NULL,
  `room_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`amenity_id`,`room_id`),
  KEY `ht_rooms_amenities_amenity_id_index` (`amenity_id`),
  KEY `ht_rooms_amenities_room_id_index` (`room_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ht_rooms_amenities`
--

LOCK TABLES `ht_rooms_amenities` WRITE;
/*!40000 ALTER TABLE `ht_rooms_amenities` DISABLE KEYS */;
INSERT INTO `ht_rooms_amenities` VALUES (1,2,NULL,NULL),(1,3,NULL,NULL),(1,4,NULL,NULL),(1,5,NULL,NULL),(1,7,NULL,NULL),(1,8,NULL,NULL),(2,3,NULL,NULL),(2,4,NULL,NULL),(2,5,NULL,NULL),(2,6,NULL,NULL),(2,7,NULL,NULL),(3,2,NULL,NULL),(3,3,NULL,NULL),(3,4,NULL,NULL),(3,5,NULL,NULL),(3,6,NULL,NULL),(3,7,NULL,NULL),(4,3,NULL,NULL),(4,4,NULL,NULL),(4,5,NULL,NULL),(4,7,NULL,NULL),(5,1,NULL,NULL),(5,2,NULL,NULL),(5,3,NULL,NULL),(5,4,NULL,NULL),(5,6,NULL,NULL),(5,7,NULL,NULL),(6,1,NULL,NULL),(6,3,NULL,NULL),(6,4,NULL,NULL),(6,5,NULL,NULL),(6,6,NULL,NULL),(6,7,NULL,NULL),(6,8,NULL,NULL),(7,2,NULL,NULL),(7,3,NULL,NULL),(7,4,NULL,NULL),(7,7,NULL,NULL),(8,1,NULL,NULL),(8,4,NULL,NULL),(8,6,NULL,NULL),(8,7,NULL,NULL),(8,8,NULL,NULL),(9,2,NULL,NULL),(9,3,NULL,NULL),(9,4,NULL,NULL),(9,5,NULL,NULL),(9,6,NULL,NULL),(9,7,NULL,NULL),(10,2,NULL,NULL),(10,3,NULL,NULL),(10,4,NULL,NULL),(10,7,NULL,NULL),(10,8,NULL,NULL),(11,2,NULL,NULL),(11,3,NULL,NULL),(11,4,NULL,NULL),(11,5,NULL,NULL),(11,7,NULL,NULL),(12,1,NULL,NULL),(12,3,NULL,NULL),(12,4,NULL,NULL),(12,5,NULL,NULL),(13,2,NULL,NULL),(13,3,NULL,NULL),(13,4,NULL,NULL),(13,6,NULL,NULL),(13,7,NULL,NULL),(13,8,NULL,NULL),(14,1,NULL,NULL),(14,3,NULL,NULL),(14,4,NULL,NULL),(14,5,NULL,NULL),(14,6,NULL,NULL),(14,7,NULL,NULL);
/*!40000 ALTER TABLE `ht_rooms_amenities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ht_rooms_translations`
--

DROP TABLE IF EXISTS `ht_rooms_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ht_rooms_translations` (
  `lang_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ht_rooms_id` bigint unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `content` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`lang_code`,`ht_rooms_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ht_rooms_translations`
--

LOCK TABLES `ht_rooms_translations` WRITE;
/*!40000 ALTER TABLE `ht_rooms_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `ht_rooms_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ht_services`
--

DROP TABLE IF EXISTS `ht_services`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ht_services` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `content` longtext COLLATE utf8mb4_unicode_ci,
  `price` decimal(15,0) unsigned DEFAULT NULL,
  `price_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'once',
  `currency_id` bigint unsigned DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'published',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ht_services`
--

LOCK TABLES `ht_services` WRITE;
/*!40000 ALTER TABLE `ht_services` DISABLE KEYS */;
INSERT INTO `ht_services` VALUES (1,'Quality Room','Indulge in the epitome of comfort and style with our Quality Room. Immerse yourself in elegant furnishings, unwind in a plush bed, and enjoy modern amenities. From the private ensuite bathroom to the high-speed Wi-Fi, every detail is designed for your relaxation. Choose between city, garden, or pool views, and experience a retreat that embodies luxury and convenience.','<div class=\"service-detail\">\n    <div class=\"content-box\">\n        <h2> We give the best Services </h2>\n        <p>Pleasure and praising pain was born and I will give you a complete account of the systems, and expound the actually teachings of the great explorer of the truth, the master-builder of human uts happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally Nor who loves or pursues or desires to obtain pain of itself.</p>\n\n        <div class=\"two-column\">\n            <div class=\"row\">\n                <div class=\"image-column col-xl-6 col-lg-12 col-md-12\">\n                    <figure class=\"image\"><img src=\"http://localhost/storage/general/portfolio-3.png\" alt=\"Riorelax\"></figure>\n                </div>\n                <div class=\"text-column col-xl-6 col-lg-12 col-md-12\">\n                    <figure class=\"image\"><img src=\"http://localhost/storage/general/portfolio-2.png\" alt=\"Riorelax\"></figure>\n                </div>\n            </div>\n        </div>\n\n        <h3>Why Choose This Service</h3>\n\n        <p>Complete account of the systems and expound the actually teachings of the great explorer of the truth, the master-builder of human uts happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely.</p>\n\n        <p>Complete account of the systems and expound the actually teachings of the great explorer of the truth, the master-builder of human uts happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally.</p>\n        <h3>We guarantee to deliver</h3>\n        <p>Quam parturient mi amet curae augue varius laoreet vehicula non sem aliquet lectus justo litora fames estab phasellus risus ad sollicitudin magna Viverra diam pretium cursus curabitur parturient convallis hymenaeos suspendisse nibh facilisi purus penatibus habitasse mus orcine muscle adipiscing sapien aliquam nulla. Erat parturient auctor facilisis. Nisi cum fringilla hymenaeos ridiculus habitasses augue nullam fringilla. Taciti convallis. Vitae sapien nisi enim vis metus cras fusce lectus sed luctus quis Clas nisl blandit parturient molestie praesent nec</p>\n        <div class=\"two-column\">\n            <div class=\"row\">\n                <div class=\"image-column col-xl-12 col-lg-12 col-md-12\">\n                    <figure class=\"image\"><img src=\"http://localhost/storage/general/portfolio-1.png\" alt=\"Riorelax\"></figure>\n                </div>\n            </div>\n        </div>\n        <p>Phasellus hac phasellus consequat malesuada veler aliquam dictumst amet a phasellus lacinia integer curabitur duis. Urna taciti nisl torquent varius libero dui. Tempus magnis libero pulvinar purus pharetra justo sem curae duis eget tempus erat ornare. Consequat litora a blandit fermentum. Quam taciti site nascetur nunc litora quis tempor metus adipiscing ac quis sodales ultrices cubilia. Arcu in penatibus vestibulum diam. Curabitur platea quam fusce molestie venenatis platea ligula in aenean gravida dolor aptent nostra luctus rutrum morbi porttitor cursus</p>\n    </div>\n</div>\n',100,'once',NULL,'amenities/icon-1.png','published','2024-09-18 03:10:15','2024-09-18 03:10:15'),(2,'Privet Beach','Discover a world of exclusivity with our Private Beach Access service. Step onto a pristine shore reserved for our guests, where sun, sand, and waves meet ultimate tranquility. Lounge in comfortable beachside seating, enjoy dedicated service, and bask in the beauty of a secluded paradise.','<div class=\"service-detail\">\n    <div class=\"content-box\">\n        <h2> We give the best Services </h2>\n        <p>Pleasure and praising pain was born and I will give you a complete account of the systems, and expound the actually teachings of the great explorer of the truth, the master-builder of human uts happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally Nor who loves or pursues or desires to obtain pain of itself.</p>\n\n        <div class=\"two-column\">\n            <div class=\"row\">\n                <div class=\"image-column col-xl-6 col-lg-12 col-md-12\">\n                    <figure class=\"image\"><img src=\"http://localhost/storage/general/portfolio-3.png\" alt=\"Riorelax\"></figure>\n                </div>\n                <div class=\"text-column col-xl-6 col-lg-12 col-md-12\">\n                    <figure class=\"image\"><img src=\"http://localhost/storage/general/portfolio-2.png\" alt=\"Riorelax\"></figure>\n                </div>\n            </div>\n        </div>\n\n        <h3>Why Choose This Service</h3>\n\n        <p>Complete account of the systems and expound the actually teachings of the great explorer of the truth, the master-builder of human uts happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely.</p>\n\n        <p>Complete account of the systems and expound the actually teachings of the great explorer of the truth, the master-builder of human uts happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally.</p>\n        <h3>We guarantee to deliver</h3>\n        <p>Quam parturient mi amet curae augue varius laoreet vehicula non sem aliquet lectus justo litora fames estab phasellus risus ad sollicitudin magna Viverra diam pretium cursus curabitur parturient convallis hymenaeos suspendisse nibh facilisi purus penatibus habitasse mus orcine muscle adipiscing sapien aliquam nulla. Erat parturient auctor facilisis. Nisi cum fringilla hymenaeos ridiculus habitasses augue nullam fringilla. Taciti convallis. Vitae sapien nisi enim vis metus cras fusce lectus sed luctus quis Clas nisl blandit parturient molestie praesent nec</p>\n        <div class=\"two-column\">\n            <div class=\"row\">\n                <div class=\"image-column col-xl-12 col-lg-12 col-md-12\">\n                    <figure class=\"image\"><img src=\"http://localhost/storage/general/portfolio-1.png\" alt=\"Riorelax\"></figure>\n                </div>\n            </div>\n        </div>\n        <p>Phasellus hac phasellus consequat malesuada veler aliquam dictumst amet a phasellus lacinia integer curabitur duis. Urna taciti nisl torquent varius libero dui. Tempus magnis libero pulvinar purus pharetra justo sem curae duis eget tempus erat ornare. Consequat litora a blandit fermentum. Quam taciti site nascetur nunc litora quis tempor metus adipiscing ac quis sodales ultrices cubilia. Arcu in penatibus vestibulum diam. Curabitur platea quam fusce molestie venenatis platea ligula in aenean gravida dolor aptent nostra luctus rutrum morbi porttitor cursus</p>\n    </div>\n</div>\n',30,'once',NULL,'amenities/icon-2.png','published','2024-09-18 03:10:15','2024-09-18 03:10:15'),(3,'Best Accommodation','Experience the pinnacle of luxury with our Best Accommodation service. Immerse yourself in meticulously designed spaces that combine opulence and comfort. From elegant furnishings to cutting-edge amenities, every detail is curated to exceed your expectations.','<div class=\"service-detail\">\n    <div class=\"content-box\">\n        <h2> We give the best Services </h2>\n        <p>Pleasure and praising pain was born and I will give you a complete account of the systems, and expound the actually teachings of the great explorer of the truth, the master-builder of human uts happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally Nor who loves or pursues or desires to obtain pain of itself.</p>\n\n        <div class=\"two-column\">\n            <div class=\"row\">\n                <div class=\"image-column col-xl-6 col-lg-12 col-md-12\">\n                    <figure class=\"image\"><img src=\"http://localhost/storage/general/portfolio-3.png\" alt=\"Riorelax\"></figure>\n                </div>\n                <div class=\"text-column col-xl-6 col-lg-12 col-md-12\">\n                    <figure class=\"image\"><img src=\"http://localhost/storage/general/portfolio-2.png\" alt=\"Riorelax\"></figure>\n                </div>\n            </div>\n        </div>\n\n        <h3>Why Choose This Service</h3>\n\n        <p>Complete account of the systems and expound the actually teachings of the great explorer of the truth, the master-builder of human uts happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely.</p>\n\n        <p>Complete account of the systems and expound the actually teachings of the great explorer of the truth, the master-builder of human uts happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally.</p>\n        <h3>We guarantee to deliver</h3>\n        <p>Quam parturient mi amet curae augue varius laoreet vehicula non sem aliquet lectus justo litora fames estab phasellus risus ad sollicitudin magna Viverra diam pretium cursus curabitur parturient convallis hymenaeos suspendisse nibh facilisi purus penatibus habitasse mus orcine muscle adipiscing sapien aliquam nulla. Erat parturient auctor facilisis. Nisi cum fringilla hymenaeos ridiculus habitasses augue nullam fringilla. Taciti convallis. Vitae sapien nisi enim vis metus cras fusce lectus sed luctus quis Clas nisl blandit parturient molestie praesent nec</p>\n        <div class=\"two-column\">\n            <div class=\"row\">\n                <div class=\"image-column col-xl-12 col-lg-12 col-md-12\">\n                    <figure class=\"image\"><img src=\"http://localhost/storage/general/portfolio-1.png\" alt=\"Riorelax\"></figure>\n                </div>\n            </div>\n        </div>\n        <p>Phasellus hac phasellus consequat malesuada veler aliquam dictumst amet a phasellus lacinia integer curabitur duis. Urna taciti nisl torquent varius libero dui. Tempus magnis libero pulvinar purus pharetra justo sem curae duis eget tempus erat ornare. Consequat litora a blandit fermentum. Quam taciti site nascetur nunc litora quis tempor metus adipiscing ac quis sodales ultrices cubilia. Arcu in penatibus vestibulum diam. Curabitur platea quam fusce molestie venenatis platea ligula in aenean gravida dolor aptent nostra luctus rutrum morbi porttitor cursus</p>\n    </div>\n</div>\n',50,'once',NULL,'amenities/icon-3.png','published','2024-09-18 03:10:15','2024-09-18 03:10:15'),(4,'Wellness &amp; Spa','Embark on a journey of rejuvenation and self-care with our Wellness &amp; Spa service. Immerse yourself in a sanctuary of relaxation, where skilled therapists pamper you with a range of invigorating treatments.','<div class=\"service-detail\">\n    <div class=\"content-box\">\n        <h2> We give the best Services </h2>\n        <p>Pleasure and praising pain was born and I will give you a complete account of the systems, and expound the actually teachings of the great explorer of the truth, the master-builder of human uts happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally Nor who loves or pursues or desires to obtain pain of itself.</p>\n\n        <div class=\"two-column\">\n            <div class=\"row\">\n                <div class=\"image-column col-xl-6 col-lg-12 col-md-12\">\n                    <figure class=\"image\"><img src=\"http://localhost/storage/general/portfolio-3.png\" alt=\"Riorelax\"></figure>\n                </div>\n                <div class=\"text-column col-xl-6 col-lg-12 col-md-12\">\n                    <figure class=\"image\"><img src=\"http://localhost/storage/general/portfolio-2.png\" alt=\"Riorelax\"></figure>\n                </div>\n            </div>\n        </div>\n\n        <h3>Why Choose This Service</h3>\n\n        <p>Complete account of the systems and expound the actually teachings of the great explorer of the truth, the master-builder of human uts happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely.</p>\n\n        <p>Complete account of the systems and expound the actually teachings of the great explorer of the truth, the master-builder of human uts happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally.</p>\n        <h3>We guarantee to deliver</h3>\n        <p>Quam parturient mi amet curae augue varius laoreet vehicula non sem aliquet lectus justo litora fames estab phasellus risus ad sollicitudin magna Viverra diam pretium cursus curabitur parturient convallis hymenaeos suspendisse nibh facilisi purus penatibus habitasse mus orcine muscle adipiscing sapien aliquam nulla. Erat parturient auctor facilisis. Nisi cum fringilla hymenaeos ridiculus habitasses augue nullam fringilla. Taciti convallis. Vitae sapien nisi enim vis metus cras fusce lectus sed luctus quis Clas nisl blandit parturient molestie praesent nec</p>\n        <div class=\"two-column\">\n            <div class=\"row\">\n                <div class=\"image-column col-xl-12 col-lg-12 col-md-12\">\n                    <figure class=\"image\"><img src=\"http://localhost/storage/general/portfolio-1.png\" alt=\"Riorelax\"></figure>\n                </div>\n            </div>\n        </div>\n        <p>Phasellus hac phasellus consequat malesuada veler aliquam dictumst amet a phasellus lacinia integer curabitur duis. Urna taciti nisl torquent varius libero dui. Tempus magnis libero pulvinar purus pharetra justo sem curae duis eget tempus erat ornare. Consequat litora a blandit fermentum. Quam taciti site nascetur nunc litora quis tempor metus adipiscing ac quis sodales ultrices cubilia. Arcu in penatibus vestibulum diam. Curabitur platea quam fusce molestie venenatis platea ligula in aenean gravida dolor aptent nostra luctus rutrum morbi porttitor cursus</p>\n    </div>\n</div>\n',10,'once',NULL,'amenities/icon-4.png','published','2024-09-18 03:10:15','2024-09-18 03:10:15'),(5,'Restaurants &amp; Bars','Savor a world of flavors at our Restaurants &amp; Bars. Indulge in culinary delights crafted by talented chefs, offering a diverse range of cuisines to tantalize your taste buds. From elegant dining to vibrant social hubs, our venues provide a gastronomic journey paired with a selection of beverages that cater to every palate. .','<div class=\"service-detail\">\n    <div class=\"content-box\">\n        <h2> We give the best Services </h2>\n        <p>Pleasure and praising pain was born and I will give you a complete account of the systems, and expound the actually teachings of the great explorer of the truth, the master-builder of human uts happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally Nor who loves or pursues or desires to obtain pain of itself.</p>\n\n        <div class=\"two-column\">\n            <div class=\"row\">\n                <div class=\"image-column col-xl-6 col-lg-12 col-md-12\">\n                    <figure class=\"image\"><img src=\"http://localhost/storage/general/portfolio-3.png\" alt=\"Riorelax\"></figure>\n                </div>\n                <div class=\"text-column col-xl-6 col-lg-12 col-md-12\">\n                    <figure class=\"image\"><img src=\"http://localhost/storage/general/portfolio-2.png\" alt=\"Riorelax\"></figure>\n                </div>\n            </div>\n        </div>\n\n        <h3>Why Choose This Service</h3>\n\n        <p>Complete account of the systems and expound the actually teachings of the great explorer of the truth, the master-builder of human uts happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely.</p>\n\n        <p>Complete account of the systems and expound the actually teachings of the great explorer of the truth, the master-builder of human uts happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally.</p>\n        <h3>We guarantee to deliver</h3>\n        <p>Quam parturient mi amet curae augue varius laoreet vehicula non sem aliquet lectus justo litora fames estab phasellus risus ad sollicitudin magna Viverra diam pretium cursus curabitur parturient convallis hymenaeos suspendisse nibh facilisi purus penatibus habitasse mus orcine muscle adipiscing sapien aliquam nulla. Erat parturient auctor facilisis. Nisi cum fringilla hymenaeos ridiculus habitasses augue nullam fringilla. Taciti convallis. Vitae sapien nisi enim vis metus cras fusce lectus sed luctus quis Clas nisl blandit parturient molestie praesent nec</p>\n        <div class=\"two-column\">\n            <div class=\"row\">\n                <div class=\"image-column col-xl-12 col-lg-12 col-md-12\">\n                    <figure class=\"image\"><img src=\"http://localhost/storage/general/portfolio-1.png\" alt=\"Riorelax\"></figure>\n                </div>\n            </div>\n        </div>\n        <p>Phasellus hac phasellus consequat malesuada veler aliquam dictumst amet a phasellus lacinia integer curabitur duis. Urna taciti nisl torquent varius libero dui. Tempus magnis libero pulvinar purus pharetra justo sem curae duis eget tempus erat ornare. Consequat litora a blandit fermentum. Quam taciti site nascetur nunc litora quis tempor metus adipiscing ac quis sodales ultrices cubilia. Arcu in penatibus vestibulum diam. Curabitur platea quam fusce molestie venenatis platea ligula in aenean gravida dolor aptent nostra luctus rutrum morbi porttitor cursus</p>\n    </div>\n</div>\n',10,'once',NULL,'amenities/icon-5.png','published','2024-09-18 03:10:15','2024-09-18 03:10:15'),(6,'Special Offers','Unlock unbeatable value with our Special Offers. Experience the luxury of Hotel at exceptional rates, whether you\'re planning a romantic getaway, a family vacation, or a business retreat. Our exclusive packages cater to every traveler\'s needs, providing an unforgettable stay enriched with added perks.','<div class=\"service-detail\">\n    <div class=\"content-box\">\n        <h2> We give the best Services </h2>\n        <p>Pleasure and praising pain was born and I will give you a complete account of the systems, and expound the actually teachings of the great explorer of the truth, the master-builder of human uts happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally Nor who loves or pursues or desires to obtain pain of itself.</p>\n\n        <div class=\"two-column\">\n            <div class=\"row\">\n                <div class=\"image-column col-xl-6 col-lg-12 col-md-12\">\n                    <figure class=\"image\"><img src=\"http://localhost/storage/general/portfolio-3.png\" alt=\"Riorelax\"></figure>\n                </div>\n                <div class=\"text-column col-xl-6 col-lg-12 col-md-12\">\n                    <figure class=\"image\"><img src=\"http://localhost/storage/general/portfolio-2.png\" alt=\"Riorelax\"></figure>\n                </div>\n            </div>\n        </div>\n\n        <h3>Why Choose This Service</h3>\n\n        <p>Complete account of the systems and expound the actually teachings of the great explorer of the truth, the master-builder of human uts happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely.</p>\n\n        <p>Complete account of the systems and expound the actually teachings of the great explorer of the truth, the master-builder of human uts happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally.</p>\n        <h3>We guarantee to deliver</h3>\n        <p>Quam parturient mi amet curae augue varius laoreet vehicula non sem aliquet lectus justo litora fames estab phasellus risus ad sollicitudin magna Viverra diam pretium cursus curabitur parturient convallis hymenaeos suspendisse nibh facilisi purus penatibus habitasse mus orcine muscle adipiscing sapien aliquam nulla. Erat parturient auctor facilisis. Nisi cum fringilla hymenaeos ridiculus habitasses augue nullam fringilla. Taciti convallis. Vitae sapien nisi enim vis metus cras fusce lectus sed luctus quis Clas nisl blandit parturient molestie praesent nec</p>\n        <div class=\"two-column\">\n            <div class=\"row\">\n                <div class=\"image-column col-xl-12 col-lg-12 col-md-12\">\n                    <figure class=\"image\"><img src=\"http://localhost/storage/general/portfolio-1.png\" alt=\"Riorelax\"></figure>\n                </div>\n            </div>\n        </div>\n        <p>Phasellus hac phasellus consequat malesuada veler aliquam dictumst amet a phasellus lacinia integer curabitur duis. Urna taciti nisl torquent varius libero dui. Tempus magnis libero pulvinar purus pharetra justo sem curae duis eget tempus erat ornare. Consequat litora a blandit fermentum. Quam taciti site nascetur nunc litora quis tempor metus adipiscing ac quis sodales ultrices cubilia. Arcu in penatibus vestibulum diam. Curabitur platea quam fusce molestie venenatis platea ligula in aenean gravida dolor aptent nostra luctus rutrum morbi porttitor cursus</p>\n    </div>\n</div>\n',10,'once',NULL,'amenities/icon-6.png','published','2024-09-18 03:10:15','2024-09-18 03:10:15');
/*!40000 ALTER TABLE `ht_services` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ht_services_translations`
--

DROP TABLE IF EXISTS `ht_services_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ht_services_translations` (
  `lang_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ht_services_id` bigint unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `content` longtext COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`lang_code`,`ht_services_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ht_services_translations`
--

LOCK TABLES `ht_services_translations` WRITE;
/*!40000 ALTER TABLE `ht_services_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `ht_services_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ht_taxes`
--

DROP TABLE IF EXISTS `ht_taxes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ht_taxes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `percentage` double(8,6) DEFAULT NULL,
  `priority` int DEFAULT NULL,
  `status` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'published',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ht_taxes`
--

LOCK TABLES `ht_taxes` WRITE;
/*!40000 ALTER TABLE `ht_taxes` DISABLE KEYS */;
INSERT INTO `ht_taxes` VALUES (1,'VAT',10.000000,1,'published','2024-09-18 03:10:19','2024-09-18 03:10:19'),(2,'None',0.000000,2,'published','2024-09-18 03:10:19','2024-09-18 03:10:19');
/*!40000 ALTER TABLE `ht_taxes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `language_meta`
--

DROP TABLE IF EXISTS `language_meta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `language_meta` (
  `lang_meta_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `lang_meta_code` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lang_meta_origin` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reference_id` bigint unsigned NOT NULL,
  `reference_type` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`lang_meta_id`),
  KEY `language_meta_reference_id_index` (`reference_id`),
  KEY `meta_code_index` (`lang_meta_code`),
  KEY `meta_origin_index` (`lang_meta_origin`),
  KEY `meta_reference_type_index` (`reference_type`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `language_meta`
--

LOCK TABLES `language_meta` WRITE;
/*!40000 ALTER TABLE `language_meta` DISABLE KEYS */;
INSERT INTO `language_meta` VALUES (1,'en_US','8dd0d784336ab1af83343c3dd4c81819',1,'Botble\\Testimonial\\Models\\Testimonial'),(2,'en_US','6d074b888785df3381131c92f5be3761',2,'Botble\\Testimonial\\Models\\Testimonial'),(3,'en_US','565e90ea7ea2d81d9303fd47c9636162',3,'Botble\\Testimonial\\Models\\Testimonial'),(4,'en_US','97282df10c6d8b3065b3a34d9eecd41b',4,'Botble\\Testimonial\\Models\\Testimonial'),(5,'en_US','818f14d1cce429933a7705f10465d249',5,'Botble\\Testimonial\\Models\\Testimonial'),(6,'en_US','690e0877c8fc0170be10e196b45bf735',6,'Botble\\Testimonial\\Models\\Testimonial'),(7,'en_US','7e304beb719314e48062dbee0ee709c4',1,'Botble\\SimpleSlider\\Models\\SimpleSlider'),(8,'en_US','88ce102ae2a8375814f0ed198ff5bdde',1,'Botble\\Menu\\Models\\MenuLocation'),(9,'en_US','6bda98fdc8293a81a969d1f772beaea9',1,'Botble\\Menu\\Models\\Menu'),(10,'en_US','b2d77e730c38a0b22b9f455d5c166791',2,'Botble\\Menu\\Models\\Menu'),(11,'en_US','6a8630b1a571e81f4da7e8a6dfd46570',3,'Botble\\Menu\\Models\\Menu'),(12,'en_US','c88386086c5d605f5e4b88b664b23331',2,'Botble\\Menu\\Models\\MenuLocation'),(13,'en_US','4760a2114e1464d204c627dec901bc45',4,'Botble\\Menu\\Models\\Menu');
/*!40000 ALTER TABLE `language_meta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `languages`
--

DROP TABLE IF EXISTS `languages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `languages` (
  `lang_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `lang_name` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lang_locale` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lang_code` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lang_flag` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lang_is_default` tinyint unsigned NOT NULL DEFAULT '0',
  `lang_order` int NOT NULL DEFAULT '0',
  `lang_is_rtl` tinyint unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`lang_id`),
  KEY `lang_locale_index` (`lang_locale`),
  KEY `lang_code_index` (`lang_code`),
  KEY `lang_is_default_index` (`lang_is_default`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `languages`
--

LOCK TABLES `languages` WRITE;
/*!40000 ALTER TABLE `languages` DISABLE KEYS */;
INSERT INTO `languages` VALUES (1,'English','en','en_US','us',1,0,0);
/*!40000 ALTER TABLE `languages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `media_files`
--

DROP TABLE IF EXISTS `media_files`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `media_files` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alt` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `folder_id` bigint unsigned NOT NULL DEFAULT '0',
  `mime_type` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `size` int NOT NULL,
  `url` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `visibility` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'public',
  PRIMARY KEY (`id`),
  KEY `media_files_user_id_index` (`user_id`),
  KEY `media_files_index` (`folder_id`,`user_id`,`created_at`)
) ENGINE=InnoDB AUTO_INCREMENT=111 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `media_files`
--

LOCK TABLES `media_files` WRITE;
/*!40000 ALTER TABLE `media_files` DISABLE KEYS */;
INSERT INTO `media_files` VALUES (1,0,'1','1',1,'image/jpeg',9803,'news/1.jpg','[]','2024-09-18 03:10:12','2024-09-18 03:10:12',NULL,'public'),(2,0,'2','2',1,'image/jpeg',9803,'news/2.jpg','[]','2024-09-18 03:10:12','2024-09-18 03:10:12',NULL,'public'),(3,0,'3','3',1,'image/jpeg',9803,'news/3.jpg','[]','2024-09-18 03:10:12','2024-09-18 03:10:12',NULL,'public'),(4,0,'4','4',1,'image/jpeg',9803,'news/4.jpg','[]','2024-09-18 03:10:12','2024-09-18 03:10:12',NULL,'public'),(5,0,'5','5',1,'image/jpeg',9803,'news/5.jpg','[]','2024-09-18 03:10:12','2024-09-18 03:10:12',NULL,'public'),(6,0,'6','6',1,'image/jpeg',9803,'news/6.jpg','[]','2024-09-18 03:10:12','2024-09-18 03:10:12',NULL,'public'),(7,0,'7','7',1,'image/jpeg',9803,'news/7.jpg','[]','2024-09-18 03:10:12','2024-09-18 03:10:12',NULL,'public'),(8,0,'8','8',1,'image/jpeg',9803,'news/8.jpg','[]','2024-09-18 03:10:12','2024-09-18 03:10:12',NULL,'public'),(9,0,'icon-1','icon-1',2,'image/png',4963,'amenities/icon-1.png','[]','2024-09-18 03:10:13','2024-09-18 03:10:13',NULL,'public'),(10,0,'icon-2','icon-2',2,'image/png',7875,'amenities/icon-2.png','[]','2024-09-18 03:10:13','2024-09-18 03:10:13',NULL,'public'),(11,0,'icon-3','icon-3',2,'image/png',3358,'amenities/icon-3.png','[]','2024-09-18 03:10:13','2024-09-18 03:10:13',NULL,'public'),(12,0,'icon-4','icon-4',2,'image/png',9266,'amenities/icon-4.png','[]','2024-09-18 03:10:13','2024-09-18 03:10:13',NULL,'public'),(13,0,'icon-5','icon-5',2,'image/png',6771,'amenities/icon-5.png','[]','2024-09-18 03:10:13','2024-09-18 03:10:13',NULL,'public'),(14,0,'icon-6','icon-6',2,'image/png',10671,'amenities/icon-6.png','[]','2024-09-18 03:10:13','2024-09-18 03:10:13',NULL,'public'),(15,0,'01','01',3,'image/jpeg',9803,'rooms/01.jpg','[]','2024-09-18 03:10:13','2024-09-18 03:10:13',NULL,'public'),(16,0,'02','02',3,'image/jpeg',9803,'rooms/02.jpg','[]','2024-09-18 03:10:13','2024-09-18 03:10:13',NULL,'public'),(17,0,'03','03',3,'image/jpeg',9803,'rooms/03.jpg','[]','2024-09-18 03:10:13','2024-09-18 03:10:13',NULL,'public'),(18,0,'04','04',3,'image/jpeg',9803,'rooms/04.jpg','[]','2024-09-18 03:10:14','2024-09-18 03:10:14',NULL,'public'),(19,0,'05','05',3,'image/jpeg',9803,'rooms/05.jpg','[]','2024-09-18 03:10:14','2024-09-18 03:10:14',NULL,'public'),(20,0,'06','06',3,'image/jpeg',9803,'rooms/06.jpg','[]','2024-09-18 03:10:14','2024-09-18 03:10:14',NULL,'public'),(21,0,'01','01',4,'image/jpeg',2100,'foods/01.jpg','[]','2024-09-18 03:10:14','2024-09-18 03:10:14',NULL,'public'),(22,0,'02','02',4,'image/jpeg',2100,'foods/02.jpg','[]','2024-09-18 03:10:14','2024-09-18 03:10:14',NULL,'public'),(23,0,'03','03',4,'image/jpeg',2100,'foods/03.jpg','[]','2024-09-18 03:10:14','2024-09-18 03:10:14',NULL,'public'),(24,0,'04','04',4,'image/jpeg',2100,'foods/04.jpg','[]','2024-09-18 03:10:14','2024-09-18 03:10:14',NULL,'public'),(25,0,'05','05',4,'image/jpeg',2100,'foods/05.jpg','[]','2024-09-18 03:10:14','2024-09-18 03:10:14',NULL,'public'),(26,0,'06','06',4,'image/jpeg',2100,'foods/06.jpg','[]','2024-09-18 03:10:14','2024-09-18 03:10:14',NULL,'public'),(27,0,'07','07',4,'image/jpeg',2100,'foods/07.jpg','[]','2024-09-18 03:10:15','2024-09-18 03:10:15',NULL,'public'),(28,0,'08','08',4,'image/jpeg',2100,'foods/08.jpg','[]','2024-09-18 03:10:15','2024-09-18 03:10:15',NULL,'public'),(29,0,'09','09',4,'image/jpeg',2100,'foods/09.jpg','[]','2024-09-18 03:10:15','2024-09-18 03:10:15',NULL,'public'),(30,0,'10','10',4,'image/jpeg',2100,'foods/10.jpg','[]','2024-09-18 03:10:15','2024-09-18 03:10:15',NULL,'public'),(31,0,'1','1',5,'image/jpeg',8581,'customers/1.jpg','[]','2024-09-18 03:10:15','2024-09-18 03:10:15',NULL,'public'),(32,0,'10','10',5,'image/jpeg',20004,'customers/10.jpg','[]','2024-09-18 03:10:15','2024-09-18 03:10:15',NULL,'public'),(33,0,'2','2',5,'image/jpeg',14257,'customers/2.jpg','[]','2024-09-18 03:10:15','2024-09-18 03:10:15',NULL,'public'),(34,0,'3','3',5,'image/jpeg',14702,'customers/3.jpg','[]','2024-09-18 03:10:15','2024-09-18 03:10:15',NULL,'public'),(35,0,'4','4',5,'image/jpeg',19699,'customers/4.jpg','[]','2024-09-18 03:10:15','2024-09-18 03:10:15',NULL,'public'),(36,0,'5','5',5,'image/jpeg',10260,'customers/5.jpg','[]','2024-09-18 03:10:15','2024-09-18 03:10:15',NULL,'public'),(37,0,'6','6',5,'image/jpeg',8476,'customers/6.jpg','[]','2024-09-18 03:10:15','2024-09-18 03:10:15',NULL,'public'),(38,0,'7','7',5,'image/jpeg',14388,'customers/7.jpg','[]','2024-09-18 03:10:15','2024-09-18 03:10:15',NULL,'public'),(39,0,'8','8',5,'image/jpeg',14340,'customers/8.jpg','[]','2024-09-18 03:10:15','2024-09-18 03:10:15',NULL,'public'),(40,0,'9','9',5,'image/jpeg',4396,'customers/9.jpg','[]','2024-09-18 03:10:15','2024-09-18 03:10:15',NULL,'public'),(41,0,'01','01',6,'image/jpeg',9803,'places/01.jpg','[]','2024-09-18 03:10:19','2024-09-18 03:10:19',NULL,'public'),(42,0,'02','02',6,'image/jpeg',9803,'places/02.jpg','[]','2024-09-18 03:10:19','2024-09-18 03:10:19',NULL,'public'),(43,0,'03','03',6,'image/jpeg',9803,'places/03.jpg','[]','2024-09-18 03:10:19','2024-09-18 03:10:19',NULL,'public'),(44,0,'04','04',6,'image/jpeg',9803,'places/04.jpg','[]','2024-09-18 03:10:19','2024-09-18 03:10:19',NULL,'public'),(45,0,'05','05',6,'image/jpeg',9803,'places/05.jpg','[]','2024-09-18 03:10:19','2024-09-18 03:10:19',NULL,'public'),(46,0,'06','06',6,'image/jpeg',9803,'places/06.jpg','[]','2024-09-18 03:10:19','2024-09-18 03:10:19',NULL,'public'),(47,0,'an-img-01','an-img-01',7,'image/png',20779,'backgrounds/an-img-01.png','[]','2024-09-18 03:10:19','2024-09-18 03:10:19',NULL,'public'),(48,0,'an-img-02','an-img-02',7,'image/png',6874,'backgrounds/an-img-02.png','[]','2024-09-18 03:10:19','2024-09-18 03:10:19',NULL,'public'),(49,0,'an-img-05','an-img-05',7,'image/png',10437,'backgrounds/an-img-05.png','[]','2024-09-18 03:10:19','2024-09-18 03:10:19',NULL,'public'),(50,0,'an-img-07','an-img-07',7,'image/png',7951,'backgrounds/an-img-07.png','[]','2024-09-18 03:10:19','2024-09-18 03:10:19',NULL,'public'),(51,0,'footer-bg','footer-bg',7,'image/png',179660,'backgrounds/footer-bg.png','[]','2024-09-18 03:10:20','2024-09-18 03:10:20',NULL,'public'),(52,0,'testimonial-bg','testimonial-bg',7,'image/png',422738,'backgrounds/testimonial-bg.png','[]','2024-09-18 03:10:20','2024-09-18 03:10:20',NULL,'public'),(53,0,'about_img_02','about_img_02',8,'image/png',10047,'services/about-img-02.png','[]','2024-09-18 03:10:20','2024-09-18 03:10:20',NULL,'public'),(54,0,'about_img_03','about_img_03',8,'image/png',7034,'services/about-img-03.png','[]','2024-09-18 03:10:20','2024-09-18 03:10:20',NULL,'public'),(55,0,'feature','feature',8,'image/png',15928,'services/feature.png','[]','2024-09-18 03:10:21','2024-09-18 03:10:21',NULL,'public'),(56,0,'icon-1','icon-1',8,'image/png',1169,'services/icon-1.png','[]','2024-09-18 03:10:21','2024-09-18 03:10:21',NULL,'public'),(57,0,'icon-2','icon-2',8,'image/png',1874,'services/icon-2.png','[]','2024-09-18 03:10:21','2024-09-18 03:10:21',NULL,'public'),(58,0,'icon-3','icon-3',8,'image/png',1972,'services/icon-3.png','[]','2024-09-18 03:10:21','2024-09-18 03:10:21',NULL,'public'),(59,0,'icon-4','icon-4',8,'image/png',1913,'services/icon-4.png','[]','2024-09-18 03:10:21','2024-09-18 03:10:21',NULL,'public'),(60,0,'icon-5','icon-5',8,'image/png',2893,'services/icon-5.png','[]','2024-09-18 03:10:21','2024-09-18 03:10:21',NULL,'public'),(61,0,'icon-6','icon-6',8,'image/png',2504,'services/icon-6.png','[]','2024-09-18 03:10:21','2024-09-18 03:10:21',NULL,'public'),(62,0,'skills-img','skills-img',8,'image/png',16333,'services/skills-img.png','[]','2024-09-18 03:10:21','2024-09-18 03:10:21',NULL,'public'),(63,0,'logo-1','logo-1',9,'image/png',757,'brands/logo-1.png','[]','2024-09-18 03:10:21','2024-09-18 03:10:21',NULL,'public'),(64,0,'logo-2','logo-2',9,'image/png',757,'brands/logo-2.png','[]','2024-09-18 03:10:21','2024-09-18 03:10:21',NULL,'public'),(65,0,'logo-3','logo-3',9,'image/png',757,'brands/logo-3.png','[]','2024-09-18 03:10:21','2024-09-18 03:10:21',NULL,'public'),(66,0,'logo-4','logo-4',9,'image/png',757,'brands/logo-4.png','[]','2024-09-18 03:10:21','2024-09-18 03:10:21',NULL,'public'),(67,0,'logo-5','logo-5',9,'image/png',757,'brands/logo-5.png','[]','2024-09-18 03:10:21','2024-09-18 03:10:21',NULL,'public'),(68,0,'logo-6','logo-6',9,'image/png',757,'brands/logo-6.png','[]','2024-09-18 03:10:21','2024-09-18 03:10:21',NULL,'public'),(69,0,'01','01',10,'image/png',2100,'testimonials/01.png','[]','2024-09-18 03:10:22','2024-09-18 03:10:22',NULL,'public'),(70,0,'02','02',10,'image/png',2100,'testimonials/02.png','[]','2024-09-18 03:10:22','2024-09-18 03:10:22',NULL,'public'),(71,0,'03','03',10,'image/png',2100,'testimonials/03.png','[]','2024-09-18 03:10:22','2024-09-18 03:10:22',NULL,'public'),(72,0,'04','04',10,'image/png',2100,'testimonials/04.png','[]','2024-09-18 03:10:22','2024-09-18 03:10:22',NULL,'public'),(73,0,'05','05',10,'image/png',2100,'testimonials/05.png','[]','2024-09-18 03:10:22','2024-09-18 03:10:22',NULL,'public'),(74,0,'06','06',10,'image/png',2100,'testimonials/06.png','[]','2024-09-18 03:10:22','2024-09-18 03:10:22',NULL,'public'),(75,0,'1','1',11,'image/png',7235,'galleries/1.png','[]','2024-09-18 03:10:22','2024-09-18 03:10:22',NULL,'public'),(76,0,'10','10',11,'image/png',7235,'galleries/10.png','[]','2024-09-18 03:10:22','2024-09-18 03:10:22',NULL,'public'),(77,0,'2','2',11,'image/png',7235,'galleries/2.png','[]','2024-09-18 03:10:22','2024-09-18 03:10:22',NULL,'public'),(78,0,'3','3',11,'image/png',7235,'galleries/3.png','[]','2024-09-18 03:10:22','2024-09-18 03:10:22',NULL,'public'),(79,0,'4','4',11,'image/png',7235,'galleries/4.png','[]','2024-09-18 03:10:22','2024-09-18 03:10:22',NULL,'public'),(80,0,'5','5',11,'image/png',7235,'galleries/5.png','[]','2024-09-18 03:10:23','2024-09-18 03:10:23',NULL,'public'),(81,0,'6','6',11,'image/png',7235,'galleries/6.png','[]','2024-09-18 03:10:23','2024-09-18 03:10:23',NULL,'public'),(82,0,'7','7',11,'image/png',7235,'galleries/7.png','[]','2024-09-18 03:10:23','2024-09-18 03:10:23',NULL,'public'),(83,0,'8','8',11,'image/png',7235,'galleries/8.png','[]','2024-09-18 03:10:23','2024-09-18 03:10:23',NULL,'public'),(84,0,'9','9',11,'image/png',7235,'galleries/9.png','[]','2024-09-18 03:10:23','2024-09-18 03:10:23',NULL,'public'),(85,0,'404','404',12,'image/png',7719,'general/404.png','[]','2024-09-18 03:10:23','2024-09-18 03:10:23',NULL,'public'),(86,0,'booking-img','booking-img',12,'image/png',10558,'general/booking-img.png','[]','2024-09-18 03:10:23','2024-09-18 03:10:23',NULL,'public'),(87,0,'favicon','favicon',12,'image/png',6096,'general/favicon.png','[]','2024-09-18 03:10:24','2024-09-18 03:10:24',NULL,'public'),(88,0,'feature','feature',12,'image/png',15928,'general/feature.png','[]','2024-09-18 03:10:24','2024-09-18 03:10:24',NULL,'public'),(89,0,'logo-dark','logo-dark',12,'image/png',6494,'general/logo-dark.png','[]','2024-09-18 03:10:24','2024-09-18 03:10:24',NULL,'public'),(90,0,'logo','logo',12,'image/png',7533,'general/logo.png','[]','2024-09-18 03:10:24','2024-09-18 03:10:24',NULL,'public'),(91,0,'place-1','place-1',12,'image/jpeg',5575,'general/place-1.jpg','[]','2024-09-18 03:10:24','2024-09-18 03:10:24',NULL,'public'),(92,0,'place-2','place-2',12,'image/jpeg',5575,'general/place-2.jpg','[]','2024-09-18 03:10:24','2024-09-18 03:10:24',NULL,'public'),(93,0,'place-3','place-3',12,'image/jpeg',5575,'general/place-3.jpg','[]','2024-09-18 03:10:24','2024-09-18 03:10:24',NULL,'public'),(94,0,'portfolio-1','portfolio-1',12,'image/png',12879,'general/portfolio-1.png','[]','2024-09-18 03:10:24','2024-09-18 03:10:24',NULL,'public'),(95,0,'portfolio-2','portfolio-2',12,'image/png',6248,'general/portfolio-2.png','[]','2024-09-18 03:10:24','2024-09-18 03:10:24',NULL,'public'),(96,0,'portfolio-3','portfolio-3',12,'image/png',6248,'general/portfolio-3.png','[]','2024-09-18 03:10:24','2024-09-18 03:10:24',NULL,'public'),(97,0,'signature','signature',12,'image/png',825,'general/signature.png','[]','2024-09-18 03:10:24','2024-09-18 03:10:24',NULL,'public'),(98,0,'video-bg','video-bg',12,'image/png',18212,'general/video-bg.png','[]','2024-09-18 03:10:24','2024-09-18 03:10:24',NULL,'public'),(99,0,'slider-1','slider-1',13,'image/png',27228,'banners/slider-1.png','[]','2024-09-18 03:10:25','2024-09-18 03:10:25',NULL,'public'),(100,0,'slider-2','slider-2',13,'image/png',27228,'banners/slider-2.png','[]','2024-09-18 03:10:25','2024-09-18 03:10:25',NULL,'public'),(101,0,'1','1',14,'image/png',9086,'teams/1.png','[]','2024-09-18 03:10:25','2024-09-18 03:10:25',NULL,'public'),(102,0,'2','2',14,'image/png',9086,'teams/2.png','[]','2024-09-18 03:10:25','2024-09-18 03:10:25',NULL,'public'),(103,0,'3','3',14,'image/png',9086,'teams/3.png','[]','2024-09-18 03:10:25','2024-09-18 03:10:25',NULL,'public'),(104,0,'4','4',14,'image/png',9086,'teams/4.png','[]','2024-09-18 03:10:26','2024-09-18 03:10:26',NULL,'public'),(105,0,'5','5',14,'image/png',9086,'teams/5.png','[]','2024-09-18 03:10:26','2024-09-18 03:10:26',NULL,'public'),(106,0,'6','6',14,'image/png',9086,'teams/6.png','[]','2024-09-18 03:10:26','2024-09-18 03:10:26',NULL,'public'),(107,0,'7','7',14,'image/png',9086,'teams/7.png','[]','2024-09-18 03:10:26','2024-09-18 03:10:26',NULL,'public'),(108,0,'8','8',14,'image/png',9086,'teams/8.png','[]','2024-09-18 03:10:26','2024-09-18 03:10:26',NULL,'public'),(109,0,'img1','img1',14,'image/png',9086,'teams/img1.png','[]','2024-09-18 03:10:26','2024-09-18 03:10:26',NULL,'public'),(110,0,'img2','img2',14,'image/png',9086,'teams/img2.png','[]','2024-09-18 03:10:26','2024-09-18 03:10:26',NULL,'public');
/*!40000 ALTER TABLE `media_files` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `media_folders`
--

DROP TABLE IF EXISTS `media_folders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `media_folders` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` bigint unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `media_folders_user_id_index` (`user_id`),
  KEY `media_folders_index` (`parent_id`,`user_id`,`created_at`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `media_folders`
--

LOCK TABLES `media_folders` WRITE;
/*!40000 ALTER TABLE `media_folders` DISABLE KEYS */;
INSERT INTO `media_folders` VALUES (1,0,'news',NULL,'news',0,'2024-09-18 03:10:12','2024-09-18 03:10:12',NULL),(2,0,'amenities',NULL,'amenities',0,'2024-09-18 03:10:13','2024-09-18 03:10:13',NULL),(3,0,'rooms',NULL,'rooms',0,'2024-09-18 03:10:13','2024-09-18 03:10:13',NULL),(4,0,'foods',NULL,'foods',0,'2024-09-18 03:10:14','2024-09-18 03:10:14',NULL),(5,0,'customers',NULL,'customers',0,'2024-09-18 03:10:15','2024-09-18 03:10:15',NULL),(6,0,'places',NULL,'places',0,'2024-09-18 03:10:19','2024-09-18 03:10:19',NULL),(7,0,'backgrounds',NULL,'backgrounds',0,'2024-09-18 03:10:19','2024-09-18 03:10:19',NULL),(8,0,'services',NULL,'services',0,'2024-09-18 03:10:20','2024-09-18 03:10:20',NULL),(9,0,'brands',NULL,'brands',0,'2024-09-18 03:10:21','2024-09-18 03:10:21',NULL),(10,0,'testimonials',NULL,'testimonials',0,'2024-09-18 03:10:22','2024-09-18 03:10:22',NULL),(11,0,'galleries',NULL,'galleries',0,'2024-09-18 03:10:22','2024-09-18 03:10:22',NULL),(12,0,'general',NULL,'general',0,'2024-09-18 03:10:23','2024-09-18 03:10:23',NULL),(13,0,'banners',NULL,'banners',0,'2024-09-18 03:10:25','2024-09-18 03:10:25',NULL),(14,0,'teams',NULL,'teams',0,'2024-09-18 03:10:25','2024-09-18 03:10:25',NULL);
/*!40000 ALTER TABLE `media_folders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `media_settings`
--

DROP TABLE IF EXISTS `media_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `media_settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci,
  `media_id` bigint unsigned DEFAULT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `media_settings`
--

LOCK TABLES `media_settings` WRITE;
/*!40000 ALTER TABLE `media_settings` DISABLE KEYS */;
/*!40000 ALTER TABLE `media_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu_locations`
--

DROP TABLE IF EXISTS `menu_locations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `menu_locations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `menu_id` bigint unsigned NOT NULL,
  `location` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `menu_locations_menu_id_created_at_index` (`menu_id`,`created_at`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu_locations`
--

LOCK TABLES `menu_locations` WRITE;
/*!40000 ALTER TABLE `menu_locations` DISABLE KEYS */;
INSERT INTO `menu_locations` VALUES (1,1,'main-menu','2024-09-18 03:10:26','2024-09-18 03:10:26'),(2,4,'sidebar-menu','2024-09-18 03:10:26','2024-09-18 03:10:26');
/*!40000 ALTER TABLE `menu_locations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu_nodes`
--

DROP TABLE IF EXISTS `menu_nodes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `menu_nodes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `menu_id` bigint unsigned NOT NULL,
  `parent_id` bigint unsigned NOT NULL DEFAULT '0',
  `reference_id` bigint unsigned DEFAULT NULL,
  `reference_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon_font` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `position` tinyint unsigned NOT NULL DEFAULT '0',
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `css_class` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `target` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '_self',
  `has_child` tinyint unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `menu_nodes_menu_id_index` (`menu_id`),
  KEY `menu_nodes_parent_id_index` (`parent_id`),
  KEY `reference_id` (`reference_id`),
  KEY `reference_type` (`reference_type`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu_nodes`
--

LOCK TABLES `menu_nodes` WRITE;
/*!40000 ALTER TABLE `menu_nodes` DISABLE KEYS */;
INSERT INTO `menu_nodes` VALUES (1,1,0,1,'Botble\\Page\\Models\\Page','/',NULL,0,'Home',NULL,'_self',1,'2024-09-18 03:10:26','2024-09-18 03:10:26'),(2,1,1,1,'Botble\\Page\\Models\\Page','/',NULL,0,'Home Page 01',NULL,'_self',0,'2024-09-18 03:10:26','2024-09-18 03:10:26'),(3,1,1,2,'Botble\\Page\\Models\\Page','/home-page-02',NULL,1,'Home Page 02',NULL,'_self',0,'2024-09-18 03:10:26','2024-09-18 03:10:26'),(4,1,1,3,'Botble\\Page\\Models\\Page','/home-page-side-menu',NULL,2,'Home Page Side Menu',NULL,'_self',0,'2024-09-18 03:10:26','2024-09-18 03:10:26'),(5,1,1,4,'Botble\\Page\\Models\\Page','/home-page-full-menu',NULL,3,'Home Page Full Menu',NULL,'_self',0,'2024-09-18 03:10:26','2024-09-18 03:10:26'),(6,1,0,NULL,NULL,'/rooms',NULL,1,'Our Rooms',NULL,'_self',1,'2024-09-18 03:10:26','2024-09-18 03:10:26'),(7,1,6,NULL,NULL,'/rooms',NULL,0,'Our Rooms',NULL,'_self',0,'2024-09-18 03:10:26','2024-09-18 03:10:26'),(8,1,6,NULL,NULL,'',NULL,1,'Room Details',NULL,'_self',0,'2024-09-18 03:10:26','2024-09-18 03:10:26'),(9,1,0,NULL,NULL,'',NULL,2,'Pages',NULL,'_self',1,'2024-09-18 03:10:26','2024-09-18 03:10:26'),(10,1,9,NULL,NULL,'/galleries',NULL,0,'Gallery',NULL,'_self',0,'2024-09-18 03:10:26','2024-09-18 03:10:26'),(11,1,9,8,'Botble\\Page\\Models\\Page','/faq',NULL,1,'FAQ',NULL,'_self',0,'2024-09-18 03:10:26','2024-09-18 03:10:26'),(12,1,9,9,'Botble\\Page\\Models\\Page','/team',NULL,2,'Team',NULL,'_self',0,'2024-09-18 03:10:26','2024-09-18 03:10:26'),(13,1,9,NULL,NULL,'',NULL,3,'Team Details',NULL,'_self',0,'2024-09-18 03:10:26','2024-09-18 03:10:26'),(14,1,9,6,'Botble\\Page\\Models\\Page','/services',NULL,4,'Services',NULL,'_self',0,'2024-09-18 03:10:26','2024-09-18 03:10:26'),(15,1,9,NULL,NULL,'',NULL,5,'Service Details',NULL,'_self',0,'2024-09-18 03:10:26','2024-09-18 03:10:26'),(16,1,9,0,'Botble\\Page\\Models\\Page',NULL,NULL,6,'Places',NULL,'_self',0,'2024-09-18 03:10:26','2024-09-18 03:10:26'),(17,1,9,NULL,NULL,'',NULL,7,'Place Details',NULL,'_self',0,'2024-09-18 03:10:26','2024-09-18 03:10:26'),(18,1,9,5,'Botble\\Page\\Models\\Page','/about-us',NULL,8,'About Us',NULL,'_self',0,'2024-09-18 03:10:26','2024-09-18 03:10:26'),(19,1,9,11,'Botble\\Page\\Models\\Page','/contact-us',NULL,9,'Contact Us',NULL,'_self',0,'2024-09-18 03:10:26','2024-09-18 03:10:26'),(20,1,0,10,'Botble\\Page\\Models\\Page','/blog',NULL,3,'Blog',NULL,'_self',1,'2024-09-18 03:10:26','2024-09-18 03:10:26'),(21,1,20,10,'Botble\\Page\\Models\\Page','/blog',NULL,0,'Blog',NULL,'_self',0,'2024-09-18 03:10:26','2024-09-18 03:10:26'),(22,1,20,NULL,NULL,'',NULL,1,'Blog Details',NULL,'_self',0,'2024-09-18 03:10:26','2024-09-18 03:10:26'),(23,2,0,NULL,NULL,'/',NULL,0,'Home',NULL,'_self',0,'2024-09-18 03:10:26','2024-09-18 03:10:26'),(24,2,0,NULL,NULL,'/about-us',NULL,1,'About Us',NULL,'_self',0,'2024-09-18 03:10:26','2024-09-18 03:10:26'),(25,2,0,6,'Botble\\Page\\Models\\Page','/services',NULL,2,'Services',NULL,'_self',0,'2024-09-18 03:10:26','2024-09-18 03:10:26'),(26,2,0,11,'Botble\\Page\\Models\\Page','/contact-us',NULL,3,'Contact Us',NULL,'_self',0,'2024-09-18 03:10:26','2024-09-18 03:10:26'),(27,2,0,10,'Botble\\Page\\Models\\Page','/blog',NULL,4,'Blog',NULL,'_self',0,'2024-09-18 03:10:26','2024-09-18 03:10:26'),(28,3,0,8,'Botble\\Page\\Models\\Page','/faq',NULL,0,'FAQ',NULL,'_self',0,'2024-09-18 03:10:26','2024-09-18 03:10:26'),(29,3,0,0,'Botble\\Page\\Models\\Page',NULL,NULL,1,'Support',NULL,'_self',0,'2024-09-18 03:10:26','2024-09-18 03:10:26'),(30,3,0,12,'Botble\\Page\\Models\\Page','/privacy',NULL,2,'Privacy',NULL,'_self',0,'2024-09-18 03:10:26','2024-09-18 03:10:26'),(31,3,0,13,'Botble\\Page\\Models\\Page','/term-and-conditions',NULL,3,'Term & Conditions',NULL,'_self',0,'2024-09-18 03:10:26','2024-09-18 03:10:26'),(32,4,0,NULL,NULL,'/home',NULL,0,'Home',NULL,'_self',0,'2024-09-18 03:10:26','2024-09-18 03:10:26'),(33,4,0,NULL,NULL,'/about-us',NULL,1,'About Us',NULL,'_self',0,'2024-09-18 03:10:26','2024-09-18 03:10:26'),(34,4,0,NULL,NULL,'/services',NULL,2,'Services',NULL,'_self',0,'2024-09-18 03:10:26','2024-09-18 03:10:26'),(35,4,0,NULL,NULL,'/pricing',NULL,3,'Pricing',NULL,'_self',0,'2024-09-18 03:10:26','2024-09-18 03:10:26'),(36,4,0,NULL,NULL,'/team',NULL,4,'Team',NULL,'_self',0,'2024-09-18 03:10:26','2024-09-18 03:10:26'),(37,4,0,NULL,NULL,'/gallery',NULL,5,'Gallery Study',NULL,'_self',0,'2024-09-18 03:10:26','2024-09-18 03:10:26'),(38,4,0,NULL,NULL,'/blog',NULL,6,'Blog',NULL,'_self',0,'2024-09-18 03:10:26','2024-09-18 03:10:26'),(39,4,0,NULL,NULL,'/contact-us',NULL,7,'Contact',NULL,'_self',0,'2024-09-18 03:10:26','2024-09-18 03:10:26');
/*!40000 ALTER TABLE `menu_nodes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menus`
--

DROP TABLE IF EXISTS `menus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `menus` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'published',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `menus_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menus`
--

LOCK TABLES `menus` WRITE;
/*!40000 ALTER TABLE `menus` DISABLE KEYS */;
INSERT INTO `menus` VALUES (1,'Main menu','main-menu','published','2024-09-18 03:10:26','2024-09-18 03:10:26'),(2,'Our Links','our-links','published','2024-09-18 03:10:26','2024-09-18 03:10:26'),(3,'Our Services','our-services','published','2024-09-18 03:10:26','2024-09-18 03:10:26'),(4,'Sidebar Menu','sidebar-menu','published','2024-09-18 03:10:26','2024-09-18 03:10:26');
/*!40000 ALTER TABLE `menus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `meta_boxes`
--

DROP TABLE IF EXISTS `meta_boxes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `meta_boxes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `meta_key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_value` text COLLATE utf8mb4_unicode_ci,
  `reference_id` bigint unsigned NOT NULL,
  `reference_type` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `meta_boxes_reference_id_index` (`reference_id`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `meta_boxes`
--

LOCK TABLES `meta_boxes` WRITE;
/*!40000 ALTER TABLE `meta_boxes` DISABLE KEYS */;
INSERT INTO `meta_boxes` VALUES (1,'icon_image','[\"amenities\\/icon-2.png\"]',1,'Botble\\Hotel\\Models\\Amenity','2024-09-18 03:10:13','2024-09-18 03:10:13'),(2,'description','[\"Rerum expedita alias voluptatem dolores quis sed sint. Et doloribus sed est architecto quos.\"]',1,'Botble\\Hotel\\Models\\Amenity','2024-09-18 03:10:13','2024-09-18 03:10:13'),(3,'icon_image','[\"amenities\\/icon-1.png\"]',2,'Botble\\Hotel\\Models\\Amenity','2024-09-18 03:10:13','2024-09-18 03:10:13'),(4,'description','[\"Qui est iure nostrum. Dicta necessitatibus deserunt culpa. Laboriosam vitae totam id nesciunt.\"]',2,'Botble\\Hotel\\Models\\Amenity','2024-09-18 03:10:13','2024-09-18 03:10:13'),(5,'icon_image','[\"amenities\\/icon-3.png\"]',3,'Botble\\Hotel\\Models\\Amenity','2024-09-18 03:10:13','2024-09-18 03:10:13'),(6,'description','[\"Quo quae velit ut nisi quia et eum. Est aut asperiores explicabo sit qui. Eaque nobis aut architecto.\"]',3,'Botble\\Hotel\\Models\\Amenity','2024-09-18 03:10:13','2024-09-18 03:10:13'),(7,'icon_image','[\"amenities\\/icon-2.png\"]',4,'Botble\\Hotel\\Models\\Amenity','2024-09-18 03:10:13','2024-09-18 03:10:13'),(8,'description','[\"Facere similique facere quidem eligendi culpa neque. Id quia possimus sit facilis hic quos.\"]',4,'Botble\\Hotel\\Models\\Amenity','2024-09-18 03:10:13','2024-09-18 03:10:13'),(9,'icon_image','[\"amenities\\/icon-6.png\"]',5,'Botble\\Hotel\\Models\\Amenity','2024-09-18 03:10:13','2024-09-18 03:10:13'),(10,'description','[\"Doloribus dolorem at optio. Unde harum doloribus ex quis.\"]',5,'Botble\\Hotel\\Models\\Amenity','2024-09-18 03:10:13','2024-09-18 03:10:13'),(11,'icon_image','[\"amenities\\/icon-6.png\"]',6,'Botble\\Hotel\\Models\\Amenity','2024-09-18 03:10:13','2024-09-18 03:10:13'),(12,'description','[\"Soluta aut qui facere officia. Ipsum quia praesentium eos itaque. Est omnis rem ipsam dolorum nesciunt.\"]',6,'Botble\\Hotel\\Models\\Amenity','2024-09-18 03:10:13','2024-09-18 03:10:13'),(13,'icon_image','[\"amenities\\/icon-4.png\"]',7,'Botble\\Hotel\\Models\\Amenity','2024-09-18 03:10:13','2024-09-18 03:10:13'),(14,'description','[\"Distinctio atque numquam assumenda voluptas quo. Ut eaque blanditiis voluptatem dolore. Ipsum quae et dolores natus.\"]',7,'Botble\\Hotel\\Models\\Amenity','2024-09-18 03:10:13','2024-09-18 03:10:13'),(15,'icon_image','[\"amenities\\/icon-5.png\"]',8,'Botble\\Hotel\\Models\\Amenity','2024-09-18 03:10:13','2024-09-18 03:10:13'),(16,'description','[\"Ab dolorum ullam accusamus magni. Dolorum est est eum reiciendis blanditiis.\"]',8,'Botble\\Hotel\\Models\\Amenity','2024-09-18 03:10:13','2024-09-18 03:10:13'),(17,'icon_image','[\"amenities\\/icon-5.png\"]',9,'Botble\\Hotel\\Models\\Amenity','2024-09-18 03:10:13','2024-09-18 03:10:13'),(18,'description','[\"Aut et iusto dolore. Odit voluptas sunt et doloremque. Ut exercitationem aut asperiores expedita repellendus.\"]',9,'Botble\\Hotel\\Models\\Amenity','2024-09-18 03:10:13','2024-09-18 03:10:13'),(19,'icon_image','[\"amenities\\/icon-5.png\"]',10,'Botble\\Hotel\\Models\\Amenity','2024-09-18 03:10:13','2024-09-18 03:10:13'),(20,'description','[\"Qui adipisci tempore quis vero. Voluptas veniam distinctio labore architecto rem quia repudiandae distinctio.\"]',10,'Botble\\Hotel\\Models\\Amenity','2024-09-18 03:10:13','2024-09-18 03:10:13'),(21,'icon_image','[\"amenities\\/icon-3.png\"]',11,'Botble\\Hotel\\Models\\Amenity','2024-09-18 03:10:13','2024-09-18 03:10:13'),(22,'description','[\"Quasi dolores ipsum non nesciunt numquam. Nesciunt placeat magnam laudantium magni dolor aut dolores.\"]',11,'Botble\\Hotel\\Models\\Amenity','2024-09-18 03:10:13','2024-09-18 03:10:13'),(23,'icon_image','[\"amenities\\/icon-4.png\"]',12,'Botble\\Hotel\\Models\\Amenity','2024-09-18 03:10:13','2024-09-18 03:10:13'),(24,'description','[\"Consectetur autem maiores aut. Rerum doloremque rerum illo aut modi corporis vel. Et eum unde ipsa labore.\"]',12,'Botble\\Hotel\\Models\\Amenity','2024-09-18 03:10:13','2024-09-18 03:10:13'),(25,'icon_image','[\"amenities\\/icon-4.png\"]',13,'Botble\\Hotel\\Models\\Amenity','2024-09-18 03:10:13','2024-09-18 03:10:13'),(26,'description','[\"Aliquid rerum esse nulla omnis aut eius. Sed et facilis et minima mollitia magni itaque.\"]',13,'Botble\\Hotel\\Models\\Amenity','2024-09-18 03:10:13','2024-09-18 03:10:13'),(27,'icon_image','[\"amenities\\/icon-2.png\"]',14,'Botble\\Hotel\\Models\\Amenity','2024-09-18 03:10:13','2024-09-18 03:10:13'),(28,'description','[\"Et ipsam voluptates pariatur. At inventore molestiae et cumque beatae. Magni aut sed tenetur est.\"]',14,'Botble\\Hotel\\Models\\Amenity','2024-09-18 03:10:13','2024-09-18 03:10:13'),(29,'breadcrumb','[0]',1,'Botble\\Page\\Models\\Page','2024-09-18 03:10:22','2024-09-18 03:10:22'),(30,'breadcrumb','[0]',2,'Botble\\Page\\Models\\Page','2024-09-18 03:10:22','2024-09-18 03:10:22'),(31,'breadcrumb','[0]',3,'Botble\\Page\\Models\\Page','2024-09-18 03:10:22','2024-09-18 03:10:22'),(32,'breadcrumb','[0]',4,'Botble\\Page\\Models\\Page','2024-09-18 03:10:22','2024-09-18 03:10:22'),(33,'breadcrumb','[1]',5,'Botble\\Page\\Models\\Page','2024-09-18 03:10:22','2024-09-18 03:10:22'),(34,'breadcrumb','[1]',6,'Botble\\Page\\Models\\Page','2024-09-18 03:10:22','2024-09-18 03:10:22'),(35,'breadcrumb','[1]',7,'Botble\\Page\\Models\\Page','2024-09-18 03:10:22','2024-09-18 03:10:22'),(36,'breadcrumb','[1]',8,'Botble\\Page\\Models\\Page','2024-09-18 03:10:22','2024-09-18 03:10:22'),(37,'breadcrumb','[1]',9,'Botble\\Page\\Models\\Page','2024-09-18 03:10:22','2024-09-18 03:10:22'),(38,'breadcrumb','[1]',10,'Botble\\Page\\Models\\Page','2024-09-18 03:10:22','2024-09-18 03:10:22'),(39,'breadcrumb','[1]',11,'Botble\\Page\\Models\\Page','2024-09-18 03:10:22','2024-09-18 03:10:22'),(40,'breadcrumb','[1]',12,'Botble\\Page\\Models\\Page','2024-09-18 03:10:22','2024-09-18 03:10:22'),(41,'breadcrumb','[1]',13,'Botble\\Page\\Models\\Page','2024-09-18 03:10:22','2024-09-18 03:10:22'),(42,'display_name','[\"Rosalina William\"]',1,'Botble\\ACL\\Models\\User','2024-09-18 03:10:23','2024-09-18 03:10:23'),(43,'bio','[\"\\ud83d\\udd8b\\ufe0f Dedicated blog writer \\ud83d\\udcda | Crafting engaging content through the art of words. \\ud83c\\udf0d Passionate about exploring diverse topics and sharing insightful perspectives. \\ud83d\\ude80 Turning ideas into captivating stories. \\u2615 Coffee addict and creativity enthusiast. \\ud83c\\udfa8 Let\\u2019s embark on a journey of discovery through the magic of writing!\"]',1,'Botble\\ACL\\Models\\User','2024-09-18 03:10:23','2024-09-18 03:10:23'),(44,'facebook','[\"https:\\/\\/www.facebook.com\"]',1,'Botble\\ACL\\Models\\User','2024-09-18 03:10:23','2024-09-18 03:10:23'),(45,'twitter','[\"https:\\/\\/twitter.com\"]',1,'Botble\\ACL\\Models\\User','2024-09-18 03:10:23','2024-09-18 03:10:23'),(46,'instagram','[\"https:\\/\\/www.instagram.com\"]',1,'Botble\\ACL\\Models\\User','2024-09-18 03:10:23','2024-09-18 03:10:23'),(47,'behance','[\"https:\\/\\/www.behance.net\"]',1,'Botble\\ACL\\Models\\User','2024-09-18 03:10:23','2024-09-18 03:10:23'),(48,'linkedin','[\"https:\\/\\/www.linkedin.com\"]',1,'Botble\\ACL\\Models\\User','2024-09-18 03:10:23','2024-09-18 03:10:23'),(49,'button_primary_label','[\"Discover More \"]',1,'Botble\\SimpleSlider\\Models\\SimpleSliderItem','2024-09-18 03:10:25','2024-09-18 03:10:25'),(50,'button_primary_url','[\"\\/contact-us\"]',1,'Botble\\SimpleSlider\\Models\\SimpleSliderItem','2024-09-18 03:10:25','2024-09-18 03:10:25'),(51,'button_play_label','[\"Intro video\"]',1,'Botble\\SimpleSlider\\Models\\SimpleSliderItem','2024-09-18 03:10:25','2024-09-18 03:10:25'),(52,'youtube_url','[\"https:\\/\\/www.youtube.com\\/watch?v=v2qeqkKgw7U\"]',1,'Botble\\SimpleSlider\\Models\\SimpleSliderItem','2024-09-18 03:10:25','2024-09-18 03:10:25'),(53,'button_primary_label','[\"Discover More \"]',2,'Botble\\SimpleSlider\\Models\\SimpleSliderItem','2024-09-18 03:10:25','2024-09-18 03:10:25'),(54,'button_primary_url','[\"\\/contact-us\"]',2,'Botble\\SimpleSlider\\Models\\SimpleSliderItem','2024-09-18 03:10:25','2024-09-18 03:10:25'),(55,'button_play_label','[\"Intro video\"]',2,'Botble\\SimpleSlider\\Models\\SimpleSliderItem','2024-09-18 03:10:25','2024-09-18 03:10:25'),(56,'youtube_url','[\"https:\\/\\/www.youtube.com\\/watch?v=v2qeqkKgw7U\"]',2,'Botble\\SimpleSlider\\Models\\SimpleSliderItem','2024-09-18 03:10:25','2024-09-18 03:10:25');
/*!40000 ALTER TABLE `meta_boxes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=106 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2013_04_09_032329_create_base_tables',1),(2,'2013_04_09_062329_create_revisions_table',1),(3,'2014_10_12_000000_create_users_table',1),(4,'2014_10_12_100000_create_password_reset_tokens_table',1),(5,'2016_06_10_230148_create_acl_tables',1),(6,'2016_06_14_230857_create_menus_table',1),(7,'2016_06_28_221418_create_pages_table',1),(8,'2016_10_05_074239_create_setting_table',1),(9,'2016_11_28_032840_create_dashboard_widget_tables',1),(10,'2016_12_16_084601_create_widgets_table',1),(11,'2017_05_09_070343_create_media_tables',1),(12,'2017_11_03_070450_create_slug_table',1),(13,'2019_01_05_053554_create_jobs_table',1),(14,'2019_08_19_000000_create_failed_jobs_table',1),(15,'2019_12_14_000001_create_personal_access_tokens_table',1),(16,'2021_08_05_134214_fix_social_link_theme_options',1),(17,'2022_04_20_100851_add_index_to_media_table',1),(18,'2022_04_20_101046_add_index_to_menu_table',1),(19,'2022_07_10_034813_move_lang_folder_to_root',1),(20,'2022_08_04_051940_add_missing_column_expires_at',1),(21,'2022_09_01_000001_create_admin_notifications_tables',1),(22,'2022_10_14_024629_drop_column_is_featured',1),(23,'2022_11_18_063357_add_missing_timestamp_in_table_settings',1),(24,'2022_12_02_093615_update_slug_index_columns',1),(25,'2023_01_30_024431_add_alt_to_media_table',1),(26,'2023_02_16_042611_drop_table_password_resets',1),(27,'2023_04_23_005903_add_column_permissions_to_admin_notifications',1),(28,'2023_05_10_075124_drop_column_id_in_role_users_table',1),(29,'2023_08_21_090810_make_page_content_nullable',1),(30,'2023_09_14_021936_update_index_for_slugs_table',1),(31,'2023_12_07_095130_add_color_column_to_media_folders_table',1),(32,'2023_12_17_162208_make_sure_column_color_in_media_folders_nullable',1),(33,'2024_04_04_110758_update_value_column_in_user_meta_table',1),(34,'2024_05_12_091229_add_column_visibility_to_table_media_files',1),(35,'2024_07_07_091316_fix_column_url_in_menu_nodes_table',1),(36,'2024_07_12_100000_change_random_hash_for_media',1),(37,'2024_04_27_100730_improve_analytics_setting',2),(38,'2015_06_29_025744_create_audit_history',3),(39,'2023_11_14_033417_change_request_column_in_table_audit_histories',3),(40,'2015_06_18_033822_create_blog_table',4),(41,'2021_02_16_092633_remove_default_value_for_author_type',4),(42,'2021_12_03_030600_create_blog_translations',4),(43,'2022_04_19_113923_add_index_to_table_posts',4),(44,'2023_08_29_074620_make_column_author_id_nullable',4),(45,'2024_07_30_091615_fix_order_column_in_categories_table',4),(46,'2016_06_17_091537_create_contacts_table',5),(47,'2023_11_10_080225_migrate_contact_blacklist_email_domains_to_core',5),(48,'2024_03_20_080001_migrate_change_attribute_email_to_nullable_form_contacts_table',5),(49,'2024_03_25_000001_update_captcha_settings_for_contact',5),(50,'2024_04_19_063914_create_custom_fields_table',5),(51,'2018_07_09_221238_create_faq_table',6),(52,'2021_12_03_082134_create_faq_translations',6),(53,'2023_11_17_063408_add_description_column_to_faq_categories_table',6),(54,'2016_10_13_150201_create_galleries_table',7),(55,'2021_12_03_082953_create_gallery_translations',7),(56,'2022_04_30_034048_create_gallery_meta_translations_table',7),(57,'2023_08_29_075308_make_column_user_id_nullable',7),(58,'2020_09_02_033611_hotel_create_table',8),(59,'2021_06_25_084734_fix_theme_options',8),(60,'2021_08_18_011425_add_column_order_into_rooms',8),(61,'2021_08_25_153801_update_table_ht_room_categories',8),(62,'2021_08_29_031421_add_translations_tables_for_hotel',8),(63,'2023_04_09_083713_update_hotel_customers_table',8),(64,'2023_04_17_033111_add_booking_number_of_guests',8),(65,'2023_08_11_090349_add_column_password_customers_table',8),(66,'2023_08_14_090449_create_reset_password_table',8),(67,'2023_08_16_063152_update_ht_booking_room_table',8),(68,'2023_08_18_022454_add_new_field_to_ht_customers_table',8),(69,'2023_08_23_022361_create_ht_invoices_table',8),(70,'2023_08_23_041912_create_hotel_review_table',8),(71,'2023_08_23_443543_add_sub_total_to_booking_table',8),(72,'2023_08_23_904382_update_field_customer_id_to_invoice_table',8),(73,'2023_08_24_534892_add_fields_to_invoice_table',8),(74,'2023_08_24_745332_add_field_description_to_invoice_table',8),(75,'2023_08_25_061510_add_adjust_type_and_amount_column',8),(76,'2023_09_05_083354_create_ht_coupons_table',8),(77,'2023_09_06_062315_add_coupon_columns_to_booking_table',8),(78,'2023_10_18_024658_add_price_type_column_to_services_table',8),(79,'2023_10_24_014726_drop_unique_in_room_name',8),(80,'2024_06_10_000000_add_content_ht_services_translations',8),(81,'2024_07_11_052139_add_number_of_children_column_to_ht_bookings_table',8),(82,'2024_07_16_234051_add_booking_number_into_table_ht_bookings',8),(83,'2016_10_03_032336_create_languages_table',9),(84,'2023_09_14_022423_add_index_for_language_table',9),(85,'2021_10_25_021023_fix-priority-load-for-language-advanced',10),(86,'2021_12_03_075608_create_page_translations',10),(87,'2023_07_06_011444_create_slug_translations_table',10),(88,'2017_10_24_154832_create_newsletter_table',11),(89,'2024_03_25_000001_update_captcha_settings_for_newsletter',11),(90,'2017_05_18_080441_create_payment_tables',12),(91,'2021_03_27_144913_add_customer_type_into_table_payments',12),(92,'2021_05_24_034720_make_column_currency_nullable',12),(93,'2021_08_09_161302_add_metadata_column_to_payments_table',12),(94,'2021_10_19_020859_update_metadata_field',12),(95,'2022_06_28_151901_activate_paypal_stripe_plugin',12),(96,'2022_07_07_153354_update_charge_id_in_table_payments',12),(97,'2024_07_04_083133_create_payment_logs_table',12),(98,'2017_07_11_140018_create_simple_slider_table',13),(99,'2022_11_02_092723_team_create_team_table',14),(100,'2023_08_11_094574_update_team_table',14),(101,'2023_11_30_085354_add_missing_description_to_team',14),(102,'2018_07_09_214610_create_testimonial_table',15),(103,'2021_12_03_083642_create_testimonials_translations',15),(104,'2016_10_07_193005_create_translations_table',16),(105,'2023_12_12_105220_drop_translations_table',16);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `newsletters`
--

DROP TABLE IF EXISTS `newsletters`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `newsletters` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'subscribed',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `newsletters`
--

LOCK TABLES `newsletters` WRITE;
/*!40000 ALTER TABLE `newsletters` DISABLE KEYS */;
/*!40000 ALTER TABLE `newsletters` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pages`
--

DROP TABLE IF EXISTS `pages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci,
  `user_id` bigint unsigned DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `template` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'published',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pages_user_id_index` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pages`
--

LOCK TABLES `pages` WRITE;
/*!40000 ALTER TABLE `pages` DISABLE KEYS */;
INSERT INTO `pages` VALUES (1,'Home Page 01','[simple-slider key=\"home-slider\"][/simple-slider][check-availability-form][/check-availability-form][about-us title=&quot;Most Safe &amp; Rated Hotel In London.&quot; subtitle=&quot;About Us&quot; description=&quot;At About Us, we take pride in offering the most secure and top-rated hotels in London. Your safety and comfort are our priorities, which is why our meticulous selection process ensures each hotel meets stringent quality standards. Whether you&rsquo;re visiting for business or leisure, trust us to provide you with a stay that combines the utmost security and exceptional service.&lt;br&gt; &lt;br&gt;Experience London like never before with our curated list of accommodations that boast prime locations and unmatched safety measures. From charming boutique hotels to Luxuryous city-center options, we&rsquo;ve done the groundwork to present you with a variety of choices that guarantee a worry-free stay. Choose About Us for a memorable trip enriched with both the allure of London.&quot; highlights=&quot;Discover the epitome of safe haven in our top-rated London hotels.; Immerse yourself in the heart of London&rsquo;s charm.; Experience the perfect blend of luxury and comfort.&quot; style=&quot;style-1&quot; button_label=&quot;DISCOVER MORE&quot; button_url=&quot;/about-us&quot; signature_image=&quot;general/signature.png&quot; signature_author=&quot;Vincent Smith&quot; top_left_image=&quot;services/about-img-02.png&quot; bottom_right_image=&quot;services/about-img-03.png&quot; floating_right_image=&quot;backgrounds/an-img-02.png&quot;][/about-us][featured-amenities title=\"The Hotel\" subtitle=\"Explore\" description=\"Proin consectetur non dolor vitae pulvinar. Pellentesque sollicitudin dolor eget neque viverra, sed interdum metus interdum. Cras lobortis pulvinar dolor, sit amet ullamcorper dolor iaculis vel\" background_color=\"#F7F5F1\" background_image=\"/backgrounds/an-img-01.png\" amenity_ids=\"1,2,3,4,5,6\"][/featured-amenities][featured-rooms title=\"Rooms & Suites\" subtitle=\"The Pleasure Of Luxury\" description=\"Proin consectetur non dolor vitae pulvinar. Pellentesque sollicitudin dolor eget neque viverra, sed interdum metus interdum. Cras lobortis pulvinar dolor, sit amet ullamcorper dolor iaculis vel\" room_ids=\"2,3,4,6,7\"][/featured-rooms][feature-area title=\"Pearl Of The Adriatic.\" subtitle=\"Luxury Hotel & Resort\" description=\"Vestibulum non ornare nunc. Maecenas a metus in est iaculis pretium. Aliquam ullamcorper nibh lacus, ac suscipit ipsum consequat porttitor.Aenean vehicula ligula eu rhoncus porttitor. Duis vel lacinia quam. Nunc rutrum porta ex, in imperdiet tortor feugiat at. Cras finibus laoreet felis et hendrerit. Integer ligula lorem, finibus vitae lorem at, egestas consectetur urna. Integer id ultricies elit. Maecenas sodales nibh, quis posuere felis. In commodo mi lectus venenatis metus eget fringilla. Suspendisse varius ante eget.\" image=\"general/feature.png\" background_image=\"backgrounds/an-img-02.png\" button_primary_label=\"Discover More\" button_primary_url=\"/contact-us\" background_color=\"#F7F5F1\"][/feature-area][pricing title=\"Extra Services\" subtitle=\"Best Prices\" description=\"Proin consectetur non dolor vitae pulvinar. Pellentesque sollicitudin dolor eget neque viverra, sed interdum metus interdum. Cras lobortis pulvinar dolor, sit amet ullamcorper dolor iaculis vel Cras finibus laoreet felis et hendrerit. Integer ligula lorem, finibus vitae lorem at, egestas consectetur urna. Integer id ultricies elit. Maecenas sodales nibh, quis posuere felis. In commodo mi lectus venenatis metus eget fringilla. Suspendisse varius ante eget.\" background_image_1=\"backgrounds/an-img-01.png\" background_image_2=\"backgrounds/an-img-02.png\" quantity=\"2\" title_1=\"Room cleaning\" description_1=\"Perfect for early-stage startups\" price_1=\"$39.99\" duration_1=\"Monthly\" feature_list_1=\"Hotel quis justo at lorem, Fusce sodales urna et tempus, Vestibulum blandit lorem quis\" button_label_1=\"Get Started\" button_url_1=\"/contact-us\" title_2=\"Drinks included\" description_2=\"Perfect for early-stage startups\" price_2=\"$59.99\" duration_2=\"Monthly\" feature_list_2=\"Hotel quis justo at lorem, Fusce sodales urna et tempus, Vestibulum blandit lorem quis\" button_label_2=\"Get Started \" button_url_2=\"/contact-us\"][/pricing][testimonials title=\"What Our Clients Says\" subtitle=\"Testimonial\" description=\"Proin consectetur non dolor vitae pulvinar. Pellentesque sollicitudin dolor eget neque viverra, sed interdum metus interdum. Cras lobortis pulvinar dolor, sit amet ullamcorper dolor iaculis vel\" background_image=\"/backgrounds/testimonial-bg.png\" testimonial_ids=\"1,2,3,5,6,4\"][/testimonials][booking-form title=\"Book A Room\" subtitle=\"Make Reservation\" image=\"general/booking-img.png\" background_image=\"backgrounds/an-img-01.png\" button_primary_label=\"Book Table Now\" button_primary_url=\"/contact-us\" style=\"style-2\"][/booking-form][intro-video title=\"Take A Tour Of Luxury\" youtube_url=\"https://www.youtube.com/watch?v=ldusxyoq0Y8\" background_image=\"general/video-bg.png\"][/intro-video][news title=\"Latest Blog & News\" subtitle=\"Our Blog\" description=\"Proin consectetur non dolor vitae pulvinar. Pellentesque sollicitudin dolor eget neque viverra, sed interdum metus interdum. Cras lobortis pulvinar dolor, sit amet ullamcorper dolor iaculis vel\" background_image=\"backgrounds/an-img-07.png\" type=\"featured\" limit=\"3\"][/news][brands background_color=\"#F7F5F1\" quantity=\"6\" name_1=\"Ersintat\" image_1=\"brands/logo-1.png\" link_1=\"https://ersintat.com\" name_2=\"Techradar\" image_2=\"brands/logo-2.png\" link_2=\"https://techradar.com\" name_3=\"Turbologo\" image_3=\"brands/logo-3.png\" link_3=\"https://turbologo.com\" name_4=\"Thepeer\" image_4=\"brands/logo-4.png\" link_4=\"https://thepeer.com\" name_5=\"Techi\" image_5=\"brands/logo-5.png\" link_5=\"http://techi.com\" name_6=\"Grapik\" image_6=\"brands/logo-6.png\" link_6=\"https://grapk.com\"][/brands]',1,NULL,'full-width',NULL,'published','2024-09-18 03:10:22','2024-09-18 03:10:22'),(2,'Home Page 02','[hero-banner-with-booking-form title=\"Enjoy A Luxury Experience\" description=\"Donec vitae libero non enim placerat eleifend aliquam erat volutpat. Curabitur diam ex, dapibus purus sapien, cursus sed nisl tristique, commodo gravida lectus non.\" background_image=\"banners/slider-2.png\" background_color=\"#101010\" button_label=\"VISIT OUR SHOP\" button_url=\"/rooms\" form_title=\"Book A Room\" form_button_label=\"Check Availability\" form_button_url=\"/contact-us\"][/hero-banner-with-booking-form][about-us title=&quot;Most Safe &amp; Rated Hotel In London.&quot; subtitle=&quot;About Us&quot; description=&quot;At About Us, we take pride in offering the most secure and top-rated hotels in London. Your safety and comfort are our priorities, which is why our meticulous selection process ensures each hotel meets stringent quality standards. Whether you&rsquo;re visiting for business or leisure, trust us to provide you with a stay that combines the utmost security and exceptional service.&lt;br&gt; &lt;br&gt;Experience London like never before with our curated list of accommodations that boast prime locations and unmatched safety measures. From charming boutique hotels to Luxuryous city-center options, we&rsquo;ve done the groundwork to present you with a variety of choices that guarantee a worry-free stay. Choose About Us for a memorable trip enriched with both the allure of London.&quot; highlights=&quot;Discover the epitome of safe haven in our top-rated London hotels.; Immerse yourself in the heart of London&rsquo;s charm.; Experience the perfect blend of luxury and comfort.&quot; style=&quot;style-1&quot; button_label=&quot;DISCOVER MORE&quot; button_url=&quot;/about-us&quot; signature_image=&quot;general/signature.png&quot; signature_author=&quot;Vincent Smith&quot; top_left_image=&quot;services/about-img-02.png&quot; bottom_right_image=&quot;services/about-img-03.png&quot; floating_right_image=&quot;backgrounds/an-img-02.png&quot;][/about-us][featured-amenities title=\"The Hotel\" subtitle=\"Explore\" description=\"Proin consectetur non dolor vitae pulvinar. Pellentesque sollicitudin dolor eget neque viverra, sed interdum metus interdum. Cras lobortis pulvinar dolor, sit amet ullamcorper dolor iaculis vel\" background_color=\"#F7F5F1\" background_image=\"/backgrounds/an-img-01.png\" amenity_ids=\"1,2,3,4,5,6\"][/featured-amenities][featured-rooms title=\"Rooms & Suites\" subtitle=\"The Pleasure Of Luxury\" description=\"Proin consectetur non dolor vitae pulvinar. Pellentesque sollicitudin dolor eget neque viverra, sed interdum metus interdum. Cras lobortis pulvinar dolor, sit amet ullamcorper dolor iaculis vel\" room_ids=\"2,3,4,6,7\"][/featured-rooms][feature-area title=\"Pearl Of The Adriatic.\" subtitle=\"Luxury Hotel & Resort\" description=\"Vestibulum non ornare nunc. Maecenas a metus in est iaculis pretium. Aliquam ullamcorper nibh lacus, ac suscipit ipsum consequat porttitor.Aenean vehicula ligula eu rhoncus porttitor. Duis vel lacinia quam. Nunc rutrum porta ex, in imperdiet tortor feugiat at. Cras finibus laoreet felis et hendrerit. Integer ligula lorem, finibus vitae lorem at, egestas consectetur urna. Integer id ultricies elit. Maecenas sodales nibh, quis posuere felis. In commodo mi lectus venenatis metus eget fringilla. Suspendisse varius ante eget.\" image=\"general/feature.png\" background_image=\"backgrounds/an-img-02.png\" button_primary_label=\"Discover More\" button_primary_url=\"/contact-us\" background_color=\"#F7F5F1\"][/feature-area][pricing title=\"Extra Services\" subtitle=\"Best Prices\" description=\"Proin consectetur non dolor vitae pulvinar. Pellentesque sollicitudin dolor eget neque viverra, sed interdum metus interdum. Cras lobortis pulvinar dolor, sit amet ullamcorper dolor iaculis vel Cras finibus laoreet felis et hendrerit. Integer ligula lorem, finibus vitae lorem at, egestas consectetur urna. Integer id ultricies elit. Maecenas sodales nibh, quis posuere felis. In commodo mi lectus venenatis metus eget fringilla. Suspendisse varius ante eget.\" background_image_1=\"backgrounds/an-img-01.png\" background_image_2=\"backgrounds/an-img-02.png\" quantity=\"2\" title_1=\"Room cleaning\" description_1=\"Perfect for early-stage startups\" price_1=\"$39.99\" duration_1=\"Monthly\" feature_list_1=\"Hotel quis justo at lorem, Fusce sodales urna et tempus, Vestibulum blandit lorem quis\" button_label_1=\"Get Started\" button_url_1=\"/contact-us\" title_2=\"Drinks included\" description_2=\"Perfect for early-stage startups\" price_2=\"$59.99\" duration_2=\"Monthly\" feature_list_2=\"Hotel quis justo at lorem, Fusce sodales urna et tempus, Vestibulum blandit lorem quis\" button_label_2=\"Get Started \" button_url_2=\"/contact-us\"][/pricing][testimonials title=\"What Our Clients Says\" subtitle=\"Testimonial\" description=\"Proin consectetur non dolor vitae pulvinar. Pellentesque sollicitudin dolor eget neque viverra, sed interdum metus interdum. Cras lobortis pulvinar dolor, sit amet ullamcorper dolor iaculis vel\" background_image=\"/backgrounds/testimonial-bg.png\" testimonial_ids=\"1,2,3,5,6,4\"][/testimonials][booking-form title=\"Book A Room\" subtitle=\"Make Reservation\" image=\"general/booking-img.png\" background_image=\"backgrounds/an-img-01.png\" button_primary_label=\"Book Table Now\" button_primary_url=\"/contact-us\" style=\"style-2\"][/booking-form][intro-video title=\"Take A Tour Of Luxury\" youtube_url=\"https://www.youtube.com/watch?v=ldusxyoq0Y8\" background_image=\"general/video-bg.png\"][/intro-video][news title=\"Latest Blog & News\" subtitle=\"Our Blog\" description=\"Proin consectetur non dolor vitae pulvinar. Pellentesque sollicitudin dolor eget neque viverra, sed interdum metus interdum. Cras lobortis pulvinar dolor, sit amet ullamcorper dolor iaculis vel\" background_image=\"backgrounds/an-img-07.png\" type=\"featured\" limit=\"3\"][/news][brands background_color=\"#F7F5F1\" quantity=\"6\" name_1=\"Ersintat\" image_1=\"brands/logo-1.png\" link_1=\"https://ersintat.com\" name_2=\"Techradar\" image_2=\"brands/logo-2.png\" link_2=\"https://techradar.com\" name_3=\"Turbologo\" image_3=\"brands/logo-3.png\" link_3=\"https://turbologo.com\" name_4=\"Thepeer\" image_4=\"brands/logo-4.png\" link_4=\"https://thepeer.com\" name_5=\"Techi\" image_5=\"brands/logo-5.png\" link_5=\"http://techi.com\" name_6=\"Grapik\" image_6=\"brands/logo-6.png\" link_6=\"https://grapk.com\"][/brands]',1,NULL,'full-width',NULL,'published','2024-09-18 03:10:22','2024-09-18 03:10:22'),(3,'Home Page Side Menu','[simple-slider key=\"home-slider\"][/simple-slider][check-availability-form][/check-availability-form][about-us title=&quot;Most Safe &amp; Rated Hotel In London.&quot; subtitle=&quot;About Us&quot; description=&quot;At About Us, we take pride in offering the most secure and top-rated hotels in London. Your safety and comfort are our priorities, which is why our meticulous selection process ensures each hotel meets stringent quality standards. Whether you&rsquo;re visiting for business or leisure, trust us to provide you with a stay that combines the utmost security and exceptional service.&lt;br&gt; &lt;br&gt;Experience London like never before with our curated list of accommodations that boast prime locations and unmatched safety measures. From charming boutique hotels to Luxuryous city-center options, we&rsquo;ve done the groundwork to present you with a variety of choices that guarantee a worry-free stay. Choose About Us for a memorable trip enriched with both the allure of London.&quot; highlights=&quot;Discover the epitome of safe haven in our top-rated London hotels.; Immerse yourself in the heart of London&rsquo;s charm.; Experience the perfect blend of luxury and comfort.&quot; style=&quot;style-1&quot; button_label=&quot;DISCOVER MORE&quot; button_url=&quot;/about-us&quot; signature_image=&quot;general/signature.png&quot; signature_author=&quot;Vincent Smith&quot; top_left_image=&quot;services/about-img-02.png&quot; bottom_right_image=&quot;services/about-img-03.png&quot; floating_right_image=&quot;backgrounds/an-img-02.png&quot;][/about-us][featured-amenities title=\"The Hotel\" subtitle=\"Explore\" description=\"Proin consectetur non dolor vitae pulvinar. Pellentesque sollicitudin dolor eget neque viverra, sed interdum metus interdum. Cras lobortis pulvinar dolor, sit amet ullamcorper dolor iaculis vel\" background_color=\"#F7F5F1\" background_image=\"/backgrounds/an-img-01.png\" amenity_ids=\"1,2,3,4,5,6\"][/featured-amenities][featured-rooms title=\"Rooms & Suites\" subtitle=\"The Pleasure Of Luxury\" description=\"Proin consectetur non dolor vitae pulvinar. Pellentesque sollicitudin dolor eget neque viverra, sed interdum metus interdum. Cras lobortis pulvinar dolor, sit amet ullamcorper dolor iaculis vel\" room_ids=\"2,3,4,6,7\"][/featured-rooms][feature-area title=\"Pearl Of The Adriatic.\" subtitle=\"Luxury Hotel & Resort\" description=\"Vestibulum non ornare nunc. Maecenas a metus in est iaculis pretium. Aliquam ullamcorper nibh lacus, ac suscipit ipsum consequat porttitor.Aenean vehicula ligula eu rhoncus porttitor. Duis vel lacinia quam. Nunc rutrum porta ex, in imperdiet tortor feugiat at. Cras finibus laoreet felis et hendrerit. Integer ligula lorem, finibus vitae lorem at, egestas consectetur urna. Integer id ultricies elit. Maecenas sodales nibh, quis posuere felis. In commodo mi lectus venenatis metus eget fringilla. Suspendisse varius ante eget.\" image=\"general/feature.png\" background_image=\"backgrounds/an-img-02.png\" button_primary_label=\"Discover More\" button_primary_url=\"/contact-us\" background_color=\"#F7F5F1\"][/feature-area][pricing title=\"Extra Services\" subtitle=\"Best Prices\" description=\"Proin consectetur non dolor vitae pulvinar. Pellentesque sollicitudin dolor eget neque viverra, sed interdum metus interdum. Cras lobortis pulvinar dolor, sit amet ullamcorper dolor iaculis vel Cras finibus laoreet felis et hendrerit. Integer ligula lorem, finibus vitae lorem at, egestas consectetur urna. Integer id ultricies elit. Maecenas sodales nibh, quis posuere felis. In commodo mi lectus venenatis metus eget fringilla. Suspendisse varius ante eget.\" background_image_1=\"backgrounds/an-img-01.png\" background_image_2=\"backgrounds/an-img-02.png\" quantity=\"2\" title_1=\"Room cleaning\" description_1=\"Perfect for early-stage startups\" price_1=\"$39.99\" duration_1=\"Monthly\" feature_list_1=\"Hotel quis justo at lorem, Fusce sodales urna et tempus, Vestibulum blandit lorem quis\" button_label_1=\"Get Started\" button_url_1=\"/contact-us\" title_2=\"Drinks included\" description_2=\"Perfect for early-stage startups\" price_2=\"$59.99\" duration_2=\"Monthly\" feature_list_2=\"Hotel quis justo at lorem, Fusce sodales urna et tempus, Vestibulum blandit lorem quis\" button_label_2=\"Get Started \" button_url_2=\"/contact-us\"][/pricing][testimonials title=\"What Our Clients Says\" subtitle=\"Testimonial\" description=\"Proin consectetur non dolor vitae pulvinar. Pellentesque sollicitudin dolor eget neque viverra, sed interdum metus interdum. Cras lobortis pulvinar dolor, sit amet ullamcorper dolor iaculis vel\" background_image=\"/backgrounds/testimonial-bg.png\" testimonial_ids=\"1,2,3,5,6,4\"][/testimonials][booking-form title=\"Book A Room\" subtitle=\"Make Reservation\" image=\"general/booking-img.png\" background_image=\"backgrounds/an-img-01.png\" button_primary_label=\"Book Table Now\" button_primary_url=\"/contact-us\" style=\"style-2\"][/booking-form][intro-video title=\"Take A Tour Of Luxury\" youtube_url=\"https://www.youtube.com/watch?v=ldusxyoq0Y8\" background_image=\"general/video-bg.png\"][/intro-video][news title=\"Latest Blog & News\" subtitle=\"Our Blog\" description=\"Proin consectetur non dolor vitae pulvinar. Pellentesque sollicitudin dolor eget neque viverra, sed interdum metus interdum. Cras lobortis pulvinar dolor, sit amet ullamcorper dolor iaculis vel\" background_image=\"backgrounds/an-img-07.png\" type=\"featured\" limit=\"3\"][/news][brands background_color=\"#F7F5F1\" quantity=\"6\" name_1=\"Ersintat\" image_1=\"brands/logo-1.png\" link_1=\"https://ersintat.com\" name_2=\"Techradar\" image_2=\"brands/logo-2.png\" link_2=\"https://techradar.com\" name_3=\"Turbologo\" image_3=\"brands/logo-3.png\" link_3=\"https://turbologo.com\" name_4=\"Thepeer\" image_4=\"brands/logo-4.png\" link_4=\"https://thepeer.com\" name_5=\"Techi\" image_5=\"brands/logo-5.png\" link_5=\"http://techi.com\" name_6=\"Grapik\" image_6=\"brands/logo-6.png\" link_6=\"https://grapk.com\"][/brands]',1,NULL,'side-menu',NULL,'published','2024-09-18 03:10:22','2024-09-18 03:10:22'),(4,'Home Page Full Menu','[simple-slider key=\"home-slider\"][/simple-slider][check-availability-form][/check-availability-form][featured-rooms title=\"Rooms & Suites\" subtitle=\"The Pleasure Of Luxury\" description=\"Proin consectetur non dolor vitae pulvinar. Pellentesque sollicitudin dolor eget neque viverra, sed interdum metus interdum. Cras lobortis pulvinar dolor, sit amet ullamcorper dolor iaculis vel\" room_ids=\"2,3,4,6,7\"][/featured-rooms][feature-area title=\"Pearl Of The Adriatic.\" subtitle=\"Luxury Hotel & Resort\" description=\"Vestibulum non ornare nunc. Maecenas a metus in est iaculis pretium. Aliquam ullamcorper nibh lacus, ac suscipit ipsum consequat porttitor.Aenean vehicula ligula eu rhoncus porttitor. Duis vel lacinia quam. Nunc rutrum porta ex, in imperdiet tortor feugiat at. Cras finibus laoreet felis et hendrerit. Integer ligula lorem, finibus vitae lorem at, egestas consectetur urna. Integer id ultricies elit. Maecenas sodales nibh, quis posuere felis. In commodo mi lectus venenatis metus eget fringilla. Suspendisse varius ante eget.\" image=\"general/feature.png\" background_image=\"backgrounds/an-img-02.png\" button_primary_label=\"Discover More\" button_primary_url=\"/contact-us\" background_color=\"#F7F5F1\"][/feature-area][about-us title=&quot;Most Safe &amp; Rated Hotel In London.&quot; subtitle=&quot;About Us&quot; description=&quot;At About Us, we take pride in offering the most secure and top-rated hotels in London. Your safety and comfort are our priorities, which is why our meticulous selection process ensures each hotel meets stringent quality standards. Whether you&rsquo;re visiting for business or leisure, trust us to provide you with a stay that combines the utmost security and exceptional service.&lt;br&gt; &lt;br&gt;Experience London like never before with our curated list of accommodations that boast prime locations and unmatched safety measures. From charming boutique hotels to Luxuryous city-center options, we&rsquo;ve done the groundwork to present you with a variety of choices that guarantee a worry-free stay. Choose About Us for a memorable trip enriched with both the allure of London.&quot; highlights=&quot;Discover the epitome of safe haven in our top-rated London hotels.; Immerse yourself in the heart of London&rsquo;s charm.; Experience the perfect blend of luxury and comfort.&quot; style=&quot;style-1&quot; button_label=&quot;DISCOVER MORE&quot; button_url=&quot;/about-us&quot; signature_image=&quot;general/signature.png&quot; signature_author=&quot;Vincent Smith&quot; top_left_image=&quot;services/about-img-02.png&quot; bottom_right_image=&quot;services/about-img-03.png&quot; floating_right_image=&quot;backgrounds/an-img-02.png&quot;][/about-us][featured-amenities title=\"The Hotel\" subtitle=\"Explore\" description=\"Proin consectetur non dolor vitae pulvinar. Pellentesque sollicitudin dolor eget neque viverra, sed interdum metus interdum. Cras lobortis pulvinar dolor, sit amet ullamcorper dolor iaculis vel\" background_color=\"#F7F5F1\" background_image=\"/backgrounds/an-img-01.png\" amenity_ids=\"1,2,3,4,5,6\"][/featured-amenities][pricing title=\"Extra Services\" subtitle=\"Best Prices\" description=\"Proin consectetur non dolor vitae pulvinar. Pellentesque sollicitudin dolor eget neque viverra, sed interdum metus interdum. Cras lobortis pulvinar dolor, sit amet ullamcorper dolor iaculis vel Cras finibus laoreet felis et hendrerit. Integer ligula lorem, finibus vitae lorem at, egestas consectetur urna. Integer id ultricies elit. Maecenas sodales nibh, quis posuere felis. In commodo mi lectus venenatis metus eget fringilla. Suspendisse varius ante eget.\" background_image_1=\"backgrounds/an-img-01.png\" background_image_2=\"backgrounds/an-img-02.png\" quantity=\"2\" title_1=\"Room cleaning\" description_1=\"Perfect for early-stage startups\" price_1=\"$39.99\" duration_1=\"Monthly\" feature_list_1=\"Hotel quis justo at lorem, Fusce sodales urna et tempus, Vestibulum blandit lorem quis\" button_label_1=\"Get Started\" button_url_1=\"/contact-us\" title_2=\"Drinks included\" description_2=\"Perfect for early-stage startups\" price_2=\"$59.99\" duration_2=\"Monthly\" feature_list_2=\"Hotel quis justo at lorem, Fusce sodales urna et tempus, Vestibulum blandit lorem quis\" button_label_2=\"Get Started \" button_url_2=\"/contact-us\"][/pricing][testimonials title=\"What Our Clients Says\" subtitle=\"Testimonial\" description=\"Proin consectetur non dolor vitae pulvinar. Pellentesque sollicitudin dolor eget neque viverra, sed interdum metus interdum. Cras lobortis pulvinar dolor, sit amet ullamcorper dolor iaculis vel\" background_image=\"/backgrounds/testimonial-bg.png\" testimonial_ids=\"1,2,3,5,6,4\"][/testimonials][booking-form title=\"Book A Room\" subtitle=\"Make Reservation\" image=\"general/booking-img.png\" background_image=\"backgrounds/an-img-01.png\" button_primary_label=\"Book Table Now\" button_primary_url=\"/contact-us\" style=\"style-2\"][/booking-form][intro-video title=\"Take A Tour Of Luxury\" youtube_url=\"https://www.youtube.com/watch?v=ldusxyoq0Y8\" background_image=\"general/video-bg.png\"][/intro-video][news title=\"Latest Blog & News\" subtitle=\"Our Blog\" description=\"Proin consectetur non dolor vitae pulvinar. Pellentesque sollicitudin dolor eget neque viverra, sed interdum metus interdum. Cras lobortis pulvinar dolor, sit amet ullamcorper dolor iaculis vel\" background_image=\"backgrounds/an-img-07.png\" type=\"featured\" limit=\"3\"][/news][brands background_color=\"#F7F5F1\" quantity=\"6\" name_1=\"Ersintat\" image_1=\"brands/logo-1.png\" link_1=\"https://ersintat.com\" name_2=\"Techradar\" image_2=\"brands/logo-2.png\" link_2=\"https://techradar.com\" name_3=\"Turbologo\" image_3=\"brands/logo-3.png\" link_3=\"https://turbologo.com\" name_4=\"Thepeer\" image_4=\"brands/logo-4.png\" link_4=\"https://thepeer.com\" name_5=\"Techi\" image_5=\"brands/logo-5.png\" link_5=\"http://techi.com\" name_6=\"Grapik\" image_6=\"brands/logo-6.png\" link_6=\"https://grapk.com\"][/brands]',1,NULL,'full-menu',NULL,'published','2024-09-18 03:10:22','2024-09-18 03:10:22'),(5,'About Us','[about-us title=&quot;Most Safe &amp; Rated Hotel In London.&quot; subtitle=&quot;About Us&quot; description=&quot;At About Us, we take pride in offering the most secure and top-rated hotels in London. Your safety and comfort are our priorities, which is why our meticulous selection process ensures each hotel meets stringent quality standards. Whether you&rsquo;re visiting for business or leisure, trust us to provide you with a stay that combines the utmost security and exceptional service.&lt;br&gt; &lt;br&gt;Experience London like never before with our curated list of accommodations that boast prime locations and unmatched safety measures. From charming boutique hotels to Luxuryous city-center options, we&rsquo;ve done the groundwork to present you with a variety of choices that guarantee a worry-free stay. Choose About Us for a memorable trip enriched with both the allure of London.&quot; highlights=&quot;Discover the epitome of safe haven in our top-rated London hotels.; Immerse yourself in the heart of London&rsquo;s charm.; Experience the perfect blend of luxury and comfort.&quot; style=&quot;style-2&quot; button_label=&quot;DISCOVER MORE&quot; button_url=&quot;/about-us&quot; signature_image=&quot;general/signature.png&quot; signature_author=&quot;Vincent Smith&quot; top_left_image=&quot;services/about-img-02.png&quot; bottom_right_image=&quot;services/about-img-03.png&quot; floating_right_image=&quot;backgrounds/an-img-02.png&quot;][/about-us][why-choose-us title=\"We Offer Wide Selection of Hotel\" subtitle=\"Rio We Use\" description=\"Explore a variety of handpicked hotels with Rio We Use. Your ideal stay is just a click away. Book now for an unforgettable experience.\" right_image=\"services/skills-img.png\" background_color=\"#291D16\" background_image=\"backgrounds/an-img-05.png\" quantity=\"3\" title_1=\"Quality Production\" percentage_1=\"80\" title_2=\"Maintenance Services\" percentage_2=\"90\" title_3=\"Product Management\" percentage_3=\"70\"][/why-choose-us][services title=&quot;Pearl Of The Adriatic.&quot; subtitle=&quot;Luxury Hotel &amp; Resort&quot; description=&quot;Indulge in the ultimate lavish escape at our Luxury Hotel &amp; Resort, renowned as the Pearl of the Adriatic. Immerse yourself in unparalleled elegance and breathtaking coastal beauty for an unforgettable retreat. &lt;br&gt;&lt;br&gt;Nestled along the stunning Adriatic coast, our Luxury Hotel &amp; Resort stands as a beacon of opulence and tranquility. With panoramic views of the sparkling waters and world-class amenities at your fingertips, every moment becomes a precious gem. Experience unrivaled hospitality and immerse yourself in the allure of the Pearl of the Adriatic.&quot; left_image=&quot;services/feature.png&quot; right_floating_image=&quot;backgrounds/an-img-02.png&quot; button_label=&quot;DISCOVER MORE&quot; button_url=&quot;/about-us&quot;][/services][news title=\"Latest Blog & News\" subtitle=\"Our Blog\" description=\"Proin consectetur non dolor vitae pulvinar. Pellentesque sollicitudin dolor eget neque viverra, sed interdum metus interdum. Cras lobortis pulvinar dolor, sit amet ullamcorper dolor iaculis vel\" background_image=\"backgrounds/an-img-07.png\" type=\"featured\" limit=\"3\"][/news][newsletter title=\"Get Best Offers On The Hotel\" subtitle=\"Newsletter\" description=\"With the subscription, enjoy your favourite Hotels without having to think about it\" background_color=\"#F7F5F1\" left_floating_image=\"backgrounds/an-img-07.png\"][/newsletter]',1,NULL,'full-width',NULL,'published','2024-09-18 03:10:22','2024-09-18 03:10:22'),(6,'Services','[service-list background_image=\"backgrounds/an-img-01.png\" limit=\"6\"][/service-list][feature-area title=\"Pearl Of The Adriatic.\" subtitle=\"Luxury Hotel & Resort\" description=\"Vestibulum non ornare nunc. Maecenas a metus in est iaculis pretium. Aliquam ullamcorper nibh lacus, ac suscipit ipsum consequat porttitor.Aenean vehicula ligula eu rhoncus porttitor. Duis vel lacinia quam. Nunc rutrum porta ex, in imperdiet tortor feugiat at. Cras finibus laoreet felis et hendrerit. Integer ligula lorem, finibus vitae lorem at, egestas consectetur urna. Integer id ultricies elit. Maecenas sodales nibh, quis posuere felis. In commodo mi lectus venenatis metus eget fringilla. Suspendisse varius ante eget.\" image=\"general/feature.png\" background_image=\"backgrounds/an-img-02.png\" button_primary_label=\"Discover More\" button_primary_url=\"/contact-us\" background_color=\"#F7F5F1\"][/feature-area][booking-form title=\"Book A Room\" subtitle=\"Make Reservation\" image=\"general/booking-img.png\" background_image=\"backgrounds/an-img-01.png\" button_primary_label=\"Book Table Now\" button_primary_url=\"/contact-us\" style=\"style-2\"][/booking-form][testimonials title=\"What Our Clients Says\" subtitle=\"Testimonial\" description=\"Proin consectetur non dolor vitae pulvinar. Pellentesque sollicitudin dolor eget neque viverra, sed interdum metus interdum. Cras lobortis pulvinar dolor, sit amet ullamcorper dolor iaculis vel\" background_image=\"/backgrounds/testimonial-bg.png\" testimonial_ids=\"1,2,3,5,6,4\"][/testimonials]',1,NULL,'full-width',NULL,'published','2024-09-18 03:10:22','2024-09-18 03:10:22'),(7,'Galleries','[galleries limit=\"10\"][/galleries]',1,NULL,'full-width',NULL,'published','2024-09-18 03:10:22','2024-09-18 03:10:22'),(8,'FAQ','[faqs category_ids=\"1,2,3,4,5\"][/faqs][newsletter title=\"Get Best Offers On The Hotel\" subtitle=\"Newsletter\" description=\"With the subscription, enjoy your favourite Hotels without having to think about it\" background_color=\"#F7F5F1\" left_floating_image=\"backgrounds/an-img-07.png\"][/newsletter][teams title=\"Best Expert Hotel\" subtitle=\"Our Team\" description=\"As a united team, we passionately craft your perfect stay, ensuring every detail reflects our commitment to exceptional hospitality.\" team_ids=\"1,2,3,4,5,6\"][/teams]',1,NULL,'full-width',NULL,'published','2024-09-18 03:10:22','2024-09-18 03:10:22'),(9,'Team','[teams team_ids=\"1,2,3,4,5,6,7,8\" style=\"style-2\"][/teams][why-choose-us title=\"We Offer Wide Selection of Hotel\" subtitle=\"Rio We Use\" description=\"Explore a variety of handpicked hotels with Rio We Use. Your ideal stay is just a click away. Book now for an unforgettable experience.\" right_image=\"services/skills-img.png\" background_color=\"#291D16\" background_image=\"backgrounds/an-img-05.png\" quantity=\"3\" title_1=\"Quality Production\" percentage_1=\"80\" title_2=\"Maintenance Services\" percentage_2=\"90\" title_3=\"Product Management\" percentage_3=\"70\"][/why-choose-us][newsletter title=\"Get Best Offers On The Hotel\" subtitle=\"Newsletter\" description=\"With the subscription, enjoy your favourite Hotels without having to think about it\" background_color=\"#F7F5F1\" left_floating_image=\"backgrounds/an-img-07.png\"][/newsletter]',1,NULL,'full-width',NULL,'published','2024-09-18 03:10:22','2024-09-18 03:10:22'),(10,'Blog','[blog-posts paginate=\"12\"][/blog-posts]',1,NULL,'blog-sidebar',NULL,'published','2024-09-18 03:10:22','2024-09-18 03:10:22'),(11,'Contact Us','[contact-form title=&quot;Get In Touch&quot; title_button=&quot;SUBMIT NOW&quot; address_icon=&quot;far fa-map&quot; address_label=&quot;Office Address&quot; address_detail=&quot;380 St Kilda Road, Melbourne &lt;br&gt;VIC 3004, Australia&quot; email_icon=&quot;far fa-envelope-open&quot; email_label=&quot;Message Us&quot; email_detail=&quot;support@example.com &lt;br&gt;info@example.com&quot; work_time_icon=&quot;far fa-clock&quot; work_time_label=&quot;Working Hours&quot; work_time_detail=&quot;Monday to Friday 09:00 to 18:30 &lt;br&gt;Saturday 15:30&quot; phone_icon=&quot;fa fa-phone&quot; phone_label=&quot;(+1) 123 456 78&quot; phone_detail=&quot; 24/7 Customer Service And Returns Support.&quot;][/contact-form][newsletter title=\"Get Best Offers On The Hotel\" subtitle=\"Newsletter\" description=\"With the subscription, enjoy your favourite Hotels without having to think about it\" background_color=\"#F7F5F1\" left_floating_image=\"backgrounds/an-img-07.png\"][/newsletter]',1,NULL,'full-width',NULL,'published','2024-09-18 03:10:22','2024-09-18 03:10:22'),(12,'Privacy','<div class=\"about-area5 about-p p-relative\">\n    <div class=\"container pt-60 pb-90\">\n        <div class=\"service-detail\">\n            <div class=\"content-box\">\n                <h2> Privacy Statement </h2>\n                <p>First things first – your privacy is important to us. That might be the kind of thing all these notices say, but we mean it. You place your trust in us by using us services and we value that trust. That means we’re committed to protecting and safeguarding your personal data. We act in our customers’ best interest and we are transparent about the processing of your personal data.</p>\n                <p>If you’ve used us before, you know that us services offers online travel-related services through our own websites and mobile apps, as well as other online platforms such as partners’ websites and social media. We’d like to point out that all the information you are about to read, generally applies to not one, not two, but all of these platforms.</p>\n                <p>If you’ve used us before, you know that us services offers online travel-related services through our own websites and mobile apps, as well as other online platforms such as partners’ websites and social media. We’d like to point out that all the information you are about to read, generally applies to not one, not two, but all of these platforms.</p>\n\n                <h2>Terms we use in this Privacy Statement</h2>\n                <p>\'Trip\' means the various different travel products and services that can be ordered, acquired, purchased, bought, paid, rented, provided, reserved, combined, or consummated by you from the Trip Provider.</p>\n                <p>\'Trip Provider\' means the provider of accommodation (e.g. hotel, motel, apartment, bed & breakfast, landlord), attractions (e.g. (theme) parks, museums, sightseeing tours), transportation provider (e.g. car rentals, cruises, rail, airport rides, coach tours, transfers), tour operators, travel insurances and any other travel or related product or service as from time to time available for Trip Reservation on the platform.</p>\n            </div>\n        </div>\n    </div>\n</div>\n',1,NULL,'full-width',NULL,'published','2024-09-18 03:10:22','2024-09-18 03:10:22'),(13,'Term and Conditions','<div class=\"about-area5 about-p p-relative\">\n    <div class=\"container pt-60 pb-90\">\n        <div class=\"service-detail\">\n            <div class=\"content-box\">\n                <h3>Definitions</h3>\n                <p>Some of the words you’ll see have very specific meanings, so please check out the ‘RioRelax dictionary’ at the end of these Terms.</p>\n\n                <h3>About these terms</h3>\n                <p>When you complete your Booking, you accept these Terms and any other terms that you’re provided with during the booking process.</p>\n                <p>The English version of these Terms is the original. If there’s any dispute about the Terms, or any mismatch between the Terms in English and in another language, the Terms as they appear in English will apply. (You can change the language at the top of this page.</p>\n\n                <h3>Our Platform</h3>\n                <p> We take reasonable care in providing our Platform, but we can’t guarantee that everything on it is accurate (we get information from the Service Providers). To the extent permitted by law, we can’t be held responsible for any errors, any interruptions, or any missing bits of information - although we will do everything we can to correct/fix them as soon as we can.</p>\n                <P>We will show you the offers that are available to you, in (what we think is) the right language for you. You can change to another language whenever you like.</P>\n\n                <h3>Prices</h3>\n                <p> When you make a Booking, you agree to pay the cost of the Travel Experience, including any charges and taxes that may apply.</p>\n                <p> Some of the prices you see may have been rounded to the nearest whole number. The price you pay will be based on the original, \'non-rounded\' price (although the actual difference will be tiny anyway).</p>\n            </div>\n        </div>\n    </div>\n</div>\n',1,NULL,'full-width',NULL,'published','2024-09-18 03:10:22','2024-09-18 03:10:22');
/*!40000 ALTER TABLE `pages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pages_translations`
--

DROP TABLE IF EXISTS `pages_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pages_translations` (
  `lang_code` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pages_id` bigint unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`lang_code`,`pages_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pages_translations`
--

LOCK TABLES `pages_translations` WRITE;
/*!40000 ALTER TABLE `pages_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `pages_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payment_logs`
--

DROP TABLE IF EXISTS `payment_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `payment_logs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `payment_method` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `request` longtext COLLATE utf8mb4_unicode_ci,
  `response` longtext COLLATE utf8mb4_unicode_ci,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payment_logs`
--

LOCK TABLES `payment_logs` WRITE;
/*!40000 ALTER TABLE `payment_logs` DISABLE KEYS */;
/*!40000 ALTER TABLE `payment_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payments`
--

DROP TABLE IF EXISTS `payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `payments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `currency` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint unsigned NOT NULL DEFAULT '0',
  `charge_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_channel` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` decimal(15,2) unsigned NOT NULL,
  `order_id` bigint unsigned DEFAULT NULL,
  `status` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT 'pending',
  `payment_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT 'confirm',
  `customer_id` bigint unsigned DEFAULT NULL,
  `refunded_amount` decimal(15,2) unsigned DEFAULT NULL,
  `refund_note` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `customer_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `metadata` mediumtext COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payments`
--

LOCK TABLES `payments` WRITE;
/*!40000 ALTER TABLE `payments` DISABLE KEYS */;
INSERT INTO `payments` VALUES (1,'USD',3,'fF7M1s2neQKRtKRKCfiQ','bank_transfer',NULL,333.00,1,'refunding','direct',3,NULL,NULL,'2024-09-18 03:10:26','2024-09-18 03:10:26','Botble\\Hotel\\Models\\Customer',NULL),(2,'USD',8,'aHxyDPn2WEEtuH2Ud1Zi','paypal',NULL,376.00,2,'refunding','direct',8,NULL,NULL,'2024-09-18 03:10:26','2024-09-18 03:10:26','Botble\\Hotel\\Models\\Customer',NULL),(3,'USD',4,'cnhuSaDqF0pHXco85K7A','razorpay',NULL,564.00,3,'pending','direct',4,NULL,NULL,'2024-09-18 03:10:26','2024-09-18 03:10:26','Botble\\Hotel\\Models\\Customer',NULL),(4,'USD',3,'ICKVF6rd8hT0g4s5SnRn','sslcommerz',NULL,115.00,4,'fraud','direct',3,NULL,NULL,'2024-09-18 03:10:26','2024-09-18 03:10:26','Botble\\Hotel\\Models\\Customer',NULL),(5,'USD',7,'lIXJuV6z162UYihpR3X3','cod',NULL,222.00,5,'pending','direct',7,NULL,NULL,'2024-09-18 03:10:26','2024-09-18 03:10:26','Botble\\Hotel\\Models\\Customer',NULL),(6,'USD',8,'HJrj9Hxt6QVX7j6cuohi','stripe',NULL,101.00,6,'pending','direct',8,NULL,NULL,'2024-09-18 03:10:26','2024-09-18 03:10:26','Botble\\Hotel\\Models\\Customer',NULL),(7,'USD',4,'zh43DzEjbsS9pVtPsylk','razorpay',NULL,465.00,7,'fraud','direct',4,NULL,NULL,'2024-09-18 03:10:26','2024-09-18 03:10:26','Botble\\Hotel\\Models\\Customer',NULL),(8,'USD',9,'GmW2E8fefDEgvC4GJ7CB','razorpay',NULL,390.00,8,'completed','direct',9,NULL,NULL,'2024-09-18 03:10:27','2024-09-18 03:10:27','Botble\\Hotel\\Models\\Customer',NULL),(9,'USD',10,'o97Wr9pNa5LK2t15FZIK','razorpay',NULL,558.00,9,'fraud','direct',10,NULL,NULL,'2024-09-18 03:10:27','2024-09-18 03:10:27','Botble\\Hotel\\Models\\Customer',NULL),(10,'USD',2,'BBQrxGNCQEnpdOxIGzLm','sslcommerz',NULL,101.00,10,'fraud','direct',2,NULL,NULL,'2024-09-18 03:10:27','2024-09-18 03:10:27','Botble\\Hotel\\Models\\Customer',NULL),(11,'USD',7,'L3kK2YaKVn6IBL5zC1JJ','paystack',NULL,260.00,11,'completed','direct',7,NULL,NULL,'2024-09-18 03:10:27','2024-09-18 03:10:27','Botble\\Hotel\\Models\\Customer',NULL),(12,'USD',1,'lsHRAlCijo2iBxPXqh0L','stripe',NULL,178.00,12,'failed','direct',1,NULL,NULL,'2024-09-18 03:10:27','2024-09-18 03:10:27','Botble\\Hotel\\Models\\Customer',NULL),(13,'USD',2,'cbpFyirMp68Kmbcfb4xH','paypal',NULL,202.00,13,'completed','direct',2,NULL,NULL,'2024-09-18 03:10:27','2024-09-18 03:10:27','Botble\\Hotel\\Models\\Customer',NULL),(14,'USD',2,'5Pegvy7ZoQ56n8Mmthrw','stripe',NULL,130.00,14,'completed','direct',2,NULL,NULL,'2024-09-18 03:10:27','2024-09-18 03:10:27','Botble\\Hotel\\Models\\Customer',NULL),(15,'USD',11,'XBxlQxBrVFtxK3kakU2A','bank_transfer',NULL,155.00,15,'refunded','direct',11,NULL,NULL,'2024-09-18 03:10:27','2024-09-18 03:10:27','Botble\\Hotel\\Models\\Customer',NULL),(16,'USD',9,'kuxQ2YyfSllVrZTIraOh','sslcommerz',NULL,465.00,16,'pending','direct',9,NULL,NULL,'2024-09-18 03:10:27','2024-09-18 03:10:27','Botble\\Hotel\\Models\\Customer',NULL),(17,'USD',1,'CTyXMUPY43xxDec2Mil8','paystack',NULL,188.00,17,'refunding','direct',1,NULL,NULL,'2024-09-18 03:10:27','2024-09-18 03:10:27','Botble\\Hotel\\Models\\Customer',NULL),(18,'USD',8,'jPga07Zxv4Xyzfl8FWRb','paypal',NULL,155.00,18,'refunded','direct',8,NULL,NULL,'2024-09-18 03:10:27','2024-09-18 03:10:27','Botble\\Hotel\\Models\\Customer',NULL),(19,'USD',9,'GP9FLnUc3zYfZfSxSqQ8','paypal',NULL,534.00,19,'refunding','direct',9,NULL,NULL,'2024-09-18 03:10:27','2024-09-18 03:10:27','Botble\\Hotel\\Models\\Customer',NULL),(20,'USD',3,'zUzIMYXwLeSBH4X0YY6m','sslcommerz',NULL,303.00,20,'completed','direct',3,NULL,NULL,'2024-09-18 03:10:27','2024-09-18 03:10:27','Botble\\Hotel\\Models\\Customer',NULL),(21,'USD',3,'G5D70JyOB47OiHNjU5yb','razorpay',NULL,111.00,21,'completed','direct',3,NULL,NULL,'2024-09-18 03:10:27','2024-09-18 03:10:27','Botble\\Hotel\\Models\\Customer',NULL),(22,'USD',6,'glpXZx5kuCIQNqI57uF8','bank_transfer',NULL,115.00,22,'completed','direct',6,NULL,NULL,'2024-09-18 03:10:27','2024-09-18 03:10:27','Botble\\Hotel\\Models\\Customer',NULL),(23,'USD',10,'Bs7Lhk5s6Fr83CSH3MKd','cod',NULL,101.00,23,'refunded','direct',10,NULL,NULL,'2024-09-18 03:10:27','2024-09-18 03:10:27','Botble\\Hotel\\Models\\Customer',NULL),(24,'USD',6,'6dWX9JAGcYtz5Vhh7HJx','paystack',NULL,178.00,24,'refunding','direct',6,NULL,NULL,'2024-09-18 03:10:27','2024-09-18 03:10:27','Botble\\Hotel\\Models\\Customer',NULL),(25,'USD',5,'x4sQOhLkIcQTr0EV8Zta','paypal',NULL,130.00,25,'failed','direct',5,NULL,NULL,'2024-09-18 03:10:27','2024-09-18 03:10:27','Botble\\Hotel\\Models\\Customer',NULL),(26,'USD',6,'c0X7AybQl5S4Y3ZlZMGk','sslcommerz',NULL,376.00,26,'refunding','direct',6,NULL,NULL,'2024-09-18 03:10:27','2024-09-18 03:10:27','Botble\\Hotel\\Models\\Customer',NULL),(27,'USD',1,'nD3FqKpQPjSyIcR1B8S6','bank_transfer',NULL,178.00,27,'refunded','direct',1,NULL,NULL,'2024-09-18 03:10:27','2024-09-18 03:10:27','Botble\\Hotel\\Models\\Customer',NULL),(28,'USD',11,'F8vY4eV8kwkalrlu4LQy','cod',NULL,345.00,28,'fraud','direct',11,NULL,NULL,'2024-09-18 03:10:27','2024-09-18 03:10:27','Botble\\Hotel\\Models\\Customer',NULL),(29,'USD',3,'7G2iKp7TvEaeJmvjbb5T','paystack',NULL,111.00,29,'pending','direct',3,NULL,NULL,'2024-09-18 03:10:27','2024-09-18 03:10:27','Botble\\Hotel\\Models\\Customer',NULL),(30,'USD',11,'XwSNNR4faRXP5ahoBFdp','sslcommerz',NULL,155.00,30,'completed','direct',11,NULL,NULL,'2024-09-18 03:10:27','2024-09-18 03:10:27','Botble\\Hotel\\Models\\Customer',NULL),(31,'USD',2,'M52uwRRIeIpnGEoybkQe','paypal',NULL,130.00,31,'fraud','direct',2,NULL,NULL,'2024-09-18 03:10:28','2024-09-18 03:10:28','Botble\\Hotel\\Models\\Customer',NULL),(32,'USD',5,'t4nAS0PMKe4eF5dgRn5Q','razorpay',NULL,101.00,32,'refunding','direct',5,NULL,NULL,'2024-09-18 03:10:28','2024-09-18 03:10:28','Botble\\Hotel\\Models\\Customer',NULL),(33,'USD',6,'ahxAk6j7oxY1L12w18oB','stripe',NULL,558.00,33,'pending','direct',6,NULL,NULL,'2024-09-18 03:10:28','2024-09-18 03:10:28','Botble\\Hotel\\Models\\Customer',NULL),(34,'USD',8,'TuALLkReXeEEzSRPqJph','bank_transfer',NULL,188.00,34,'completed','direct',8,NULL,NULL,'2024-09-18 03:10:28','2024-09-18 03:10:28','Botble\\Hotel\\Models\\Customer',NULL),(35,'USD',1,'QYCMUAwmOS3O6HdyYSE0','stripe',NULL,115.00,35,'refunded','direct',1,NULL,NULL,'2024-09-18 03:10:28','2024-09-18 03:10:28','Botble\\Hotel\\Models\\Customer',NULL),(36,'USD',9,'0FT6I8OWmAlFUwinyQee','razorpay',NULL,178.00,36,'refunding','direct',9,NULL,NULL,'2024-09-18 03:10:28','2024-09-18 03:10:28','Botble\\Hotel\\Models\\Customer',NULL),(37,'USD',2,'sap1jNDX0dFMYuAIyRv7','razorpay',NULL,178.00,37,'fraud','direct',2,NULL,NULL,'2024-09-18 03:10:28','2024-09-18 03:10:28','Botble\\Hotel\\Models\\Customer',NULL),(38,'USD',5,'VwKPgjUFVbwwn6DjEQpI','cod',NULL,178.00,38,'refunded','direct',5,NULL,NULL,'2024-09-18 03:10:28','2024-09-18 03:10:28','Botble\\Hotel\\Models\\Customer',NULL),(39,'USD',3,'R9nrIrhqtO1oV5JUDNGN','paypal',NULL,465.00,39,'pending','direct',3,NULL,NULL,'2024-09-18 03:10:28','2024-09-18 03:10:28','Botble\\Hotel\\Models\\Customer',NULL),(40,'USD',1,'239zmn8h9vlXQjIreOhQ','bank_transfer',NULL,564.00,40,'refunding','direct',1,NULL,NULL,'2024-09-18 03:10:28','2024-09-18 03:10:28','Botble\\Hotel\\Models\\Customer',NULL);
/*!40000 ALTER TABLE `payments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `post_categories`
--

DROP TABLE IF EXISTS `post_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `post_categories` (
  `category_id` bigint unsigned NOT NULL,
  `post_id` bigint unsigned NOT NULL,
  KEY `post_categories_category_id_index` (`category_id`),
  KEY `post_categories_post_id_index` (`post_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `post_categories`
--

LOCK TABLES `post_categories` WRITE;
/*!40000 ALTER TABLE `post_categories` DISABLE KEYS */;
INSERT INTO `post_categories` VALUES (1,1),(3,1),(2,2),(4,2),(1,3),(4,3),(1,4),(4,4),(2,5),(4,5),(2,6),(3,6);
/*!40000 ALTER TABLE `post_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `post_tags`
--

DROP TABLE IF EXISTS `post_tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `post_tags` (
  `tag_id` bigint unsigned NOT NULL,
  `post_id` bigint unsigned NOT NULL,
  KEY `post_tags_tag_id_index` (`tag_id`),
  KEY `post_tags_post_id_index` (`post_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `post_tags`
--

LOCK TABLES `post_tags` WRITE;
/*!40000 ALTER TABLE `post_tags` DISABLE KEYS */;
INSERT INTO `post_tags` VALUES (1,1),(2,1),(3,1),(4,1),(5,1),(1,2),(2,2),(3,2),(4,2),(5,2),(1,3),(2,3),(3,3),(4,3),(5,3),(1,4),(2,4),(3,4),(4,4),(5,4),(1,5),(2,5),(3,5),(4,5),(5,5),(1,6),(2,6),(3,6),(4,6),(5,6);
/*!40000 ALTER TABLE `post_tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `posts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci,
  `status` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'published',
  `author_id` bigint unsigned DEFAULT NULL,
  `author_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Botble\\ACL\\Models\\User',
  `is_featured` tinyint unsigned NOT NULL DEFAULT '0',
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `views` int unsigned NOT NULL DEFAULT '0',
  `format_type` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `posts_status_index` (`status`),
  KEY `posts_author_id_index` (`author_id`),
  KEY `posts_author_type_index` (`author_type`),
  KEY `posts_created_at_index` (`created_at`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts`
--

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` VALUES (1,'Each of our 8 double rooms has its own distinct.','Discover a world of unique comfort in our collection of 8 double rooms, each boasting its own distinct charm and character. Immerse yourself in a stay that caters to your individual preferences','<p>\n    At Riorelax, we believe in crafting memories that last a lifetime. Our blog series will unveil the array of experiences we offer, tailored to every kind of traveler. Whether you seek adventure, relaxation, romance, or exploration, our personalized activities and excursions ensure that your stay transcends the ordinary. Join us as we share stories of guests who\'ve embraced the luxury of choice and embarked on journeys that become cherished tales, all within the embrace of our extraordinary hotel.\n</p>\n<p>\n    Unlock the Gateway to Opulent Tranquility: Introducing Riorelax\n    Embark on a journey to unparalleled luxury and coastal elegance. Nestled along the Adriatic\'s pristine shoreline, Riorelax stands as a beacon of refined indulgence. Join us as we delve into the enchanting world of bespoke experiences, exquisite accommodations, and personalized service that defines our exceptional hotel. From captivating sea-view rooms to tantalizing gastronomic delights, spa sanctuaries, and curated adventures, our blog takes you behind the scenes of a retreat where every moment is a masterpiece. Uncover the essence of opulence, where your desires are our command and the Adriatic becomes your playground. Stay tuned for a symphony of elegance, artistry, and inspiration in our upcoming series.\n</p>\n<blockquote>\n    <footer>By Rosalina Pong</footer>\n    <h3>Viral dreamcatcher keytar typewriter, aest hetic offal umami. Aesthetic polaroid pug pitchfork post-ironic.</h3>\n</blockquote>\n<p>\n    Step into a realm where luxury is not just a word, but a way of life. Riorelax invites you to explore a world where opulence meets comfort in seamless harmony. Our blog series will unveil the heart and soul of our hotel, from the intricacies of our meticulous design to the intuitive service that anticipates your every need. Join us on a virtual tour that captures the essence of sophistication, a prelude to the unforgettable experience that awaits you at our shores.\n</p>\n<div class=\"details__content-img\">\n    <img src=\"http://localhost/storage/news/1.jpg\" alt=\"\" />\n</div>\n<p>\n    Prepare to tantalize your taste buds as we delve into the culinary symphony orchestrated by our skilled chefs. From gourmet creations that blend local flavors with international finesse to the art of crafting the perfect cocktail, our blog will be your guide to the exceptional dining journey that awaits. Join us in savoring the stories behind each dish, the dedication that goes into every creation, and the joy of experiencing food as an art form within our culinary haven.\n</p>\n<figure>\n    <img src=\"http://localhost/storage/news/2.jpg\" alt=\"\" />\n    <p>\n        At Riorelax, we believe in crafting memories that last a lifetime. Our blog series will unveil the array of experiences we offer, tailored to every kind of traveler. Whether you seek adventure, relaxation, romance, or exploration, our personalized activities and excursions ensure that your stay transcends the ordinary. Join us as we share stories of guests who\'ve embraced the luxury of choice and embarked on journeys that become cherished tales, all within the embrace of our extraordinary hotel.\n    </p>\n</figure>\n','published',1,'Botble\\ACL\\Models\\User',1,'news/1.jpg',232,NULL,'2024-09-18 03:10:12','2024-09-18 03:10:12'),(2,'Essential Qualities of Highly Successful Music','Delve into the secrets behind the music that resonates deeply with audiences worldwide. Uncover the essential qualities that elevate music from ordinary to extraordinary, as we explore.','<p>\n    At Riorelax, we believe in crafting memories that last a lifetime. Our blog series will unveil the array of experiences we offer, tailored to every kind of traveler. Whether you seek adventure, relaxation, romance, or exploration, our personalized activities and excursions ensure that your stay transcends the ordinary. Join us as we share stories of guests who\'ve embraced the luxury of choice and embarked on journeys that become cherished tales, all within the embrace of our extraordinary hotel.\n</p>\n<p>\n    Unlock the Gateway to Opulent Tranquility: Introducing Riorelax\n    Embark on a journey to unparalleled luxury and coastal elegance. Nestled along the Adriatic\'s pristine shoreline, Riorelax stands as a beacon of refined indulgence. Join us as we delve into the enchanting world of bespoke experiences, exquisite accommodations, and personalized service that defines our exceptional hotel. From captivating sea-view rooms to tantalizing gastronomic delights, spa sanctuaries, and curated adventures, our blog takes you behind the scenes of a retreat where every moment is a masterpiece. Uncover the essence of opulence, where your desires are our command and the Adriatic becomes your playground. Stay tuned for a symphony of elegance, artistry, and inspiration in our upcoming series.\n</p>\n<blockquote>\n    <footer>By Rosalina Pong</footer>\n    <h3>Viral dreamcatcher keytar typewriter, aest hetic offal umami. Aesthetic polaroid pug pitchfork post-ironic.</h3>\n</blockquote>\n<p>\n    Step into a realm where luxury is not just a word, but a way of life. Riorelax invites you to explore a world where opulence meets comfort in seamless harmony. Our blog series will unveil the heart and soul of our hotel, from the intricacies of our meticulous design to the intuitive service that anticipates your every need. Join us on a virtual tour that captures the essence of sophistication, a prelude to the unforgettable experience that awaits you at our shores.\n</p>\n<div class=\"details__content-img\">\n    <img src=\"http://localhost/storage/news/1.jpg\" alt=\"\" />\n</div>\n<p>\n    Prepare to tantalize your taste buds as we delve into the culinary symphony orchestrated by our skilled chefs. From gourmet creations that blend local flavors with international finesse to the art of crafting the perfect cocktail, our blog will be your guide to the exceptional dining journey that awaits. Join us in savoring the stories behind each dish, the dedication that goes into every creation, and the joy of experiencing food as an art form within our culinary haven.\n</p>\n<figure>\n    <img src=\"http://localhost/storage/news/2.jpg\" alt=\"\" />\n    <p>\n        At Riorelax, we believe in crafting memories that last a lifetime. Our blog series will unveil the array of experiences we offer, tailored to every kind of traveler. Whether you seek adventure, relaxation, romance, or exploration, our personalized activities and excursions ensure that your stay transcends the ordinary. Join us as we share stories of guests who\'ve embraced the luxury of choice and embarked on journeys that become cherished tales, all within the embrace of our extraordinary hotel.\n    </p>\n</figure>\n','published',1,'Botble\\ACL\\Models\\User',1,'news/2.jpg',1506,NULL,'2024-09-18 03:10:13','2024-09-18 03:10:13'),(3,'9 Things I Love About Shaving My Head','Embark on a personal journey of self-discovery and empowerment as we delve into the unique experience of embracing a bald look. From newfound confidence to a simplified routine, explore the 9 things','<p>\n    At Riorelax, we believe in crafting memories that last a lifetime. Our blog series will unveil the array of experiences we offer, tailored to every kind of traveler. Whether you seek adventure, relaxation, romance, or exploration, our personalized activities and excursions ensure that your stay transcends the ordinary. Join us as we share stories of guests who\'ve embraced the luxury of choice and embarked on journeys that become cherished tales, all within the embrace of our extraordinary hotel.\n</p>\n<p>\n    Unlock the Gateway to Opulent Tranquility: Introducing Riorelax\n    Embark on a journey to unparalleled luxury and coastal elegance. Nestled along the Adriatic\'s pristine shoreline, Riorelax stands as a beacon of refined indulgence. Join us as we delve into the enchanting world of bespoke experiences, exquisite accommodations, and personalized service that defines our exceptional hotel. From captivating sea-view rooms to tantalizing gastronomic delights, spa sanctuaries, and curated adventures, our blog takes you behind the scenes of a retreat where every moment is a masterpiece. Uncover the essence of opulence, where your desires are our command and the Adriatic becomes your playground. Stay tuned for a symphony of elegance, artistry, and inspiration in our upcoming series.\n</p>\n<blockquote>\n    <footer>By Rosalina Pong</footer>\n    <h3>Viral dreamcatcher keytar typewriter, aest hetic offal umami. Aesthetic polaroid pug pitchfork post-ironic.</h3>\n</blockquote>\n<p>\n    Step into a realm where luxury is not just a word, but a way of life. Riorelax invites you to explore a world where opulence meets comfort in seamless harmony. Our blog series will unveil the heart and soul of our hotel, from the intricacies of our meticulous design to the intuitive service that anticipates your every need. Join us on a virtual tour that captures the essence of sophistication, a prelude to the unforgettable experience that awaits you at our shores.\n</p>\n<div class=\"details__content-img\">\n    <img src=\"http://localhost/storage/news/1.jpg\" alt=\"\" />\n</div>\n<p>\n    Prepare to tantalize your taste buds as we delve into the culinary symphony orchestrated by our skilled chefs. From gourmet creations that blend local flavors with international finesse to the art of crafting the perfect cocktail, our blog will be your guide to the exceptional dining journey that awaits. Join us in savoring the stories behind each dish, the dedication that goes into every creation, and the joy of experiencing food as an art form within our culinary haven.\n</p>\n<figure>\n    <img src=\"http://localhost/storage/news/2.jpg\" alt=\"\" />\n    <p>\n        At Riorelax, we believe in crafting memories that last a lifetime. Our blog series will unveil the array of experiences we offer, tailored to every kind of traveler. Whether you seek adventure, relaxation, romance, or exploration, our personalized activities and excursions ensure that your stay transcends the ordinary. Join us as we share stories of guests who\'ve embraced the luxury of choice and embarked on journeys that become cherished tales, all within the embrace of our extraordinary hotel.\n    </p>\n</figure>\n','published',1,'Botble\\ACL\\Models\\User',1,'news/3.jpg',867,NULL,'2024-09-18 03:10:13','2024-09-18 03:10:13'),(4,'Why Teamwork Really Makes The Dream Work','Unlock the power of collaboration and synergy in achieving your goals. In this exploration of the importance of teamwork, we delve into real-world examples and insights and how combining diverse skills.','<p>\n    At Riorelax, we believe in crafting memories that last a lifetime. Our blog series will unveil the array of experiences we offer, tailored to every kind of traveler. Whether you seek adventure, relaxation, romance, or exploration, our personalized activities and excursions ensure that your stay transcends the ordinary. Join us as we share stories of guests who\'ve embraced the luxury of choice and embarked on journeys that become cherished tales, all within the embrace of our extraordinary hotel.\n</p>\n<p>\n    Unlock the Gateway to Opulent Tranquility: Introducing Riorelax\n    Embark on a journey to unparalleled luxury and coastal elegance. Nestled along the Adriatic\'s pristine shoreline, Riorelax stands as a beacon of refined indulgence. Join us as we delve into the enchanting world of bespoke experiences, exquisite accommodations, and personalized service that defines our exceptional hotel. From captivating sea-view rooms to tantalizing gastronomic delights, spa sanctuaries, and curated adventures, our blog takes you behind the scenes of a retreat where every moment is a masterpiece. Uncover the essence of opulence, where your desires are our command and the Adriatic becomes your playground. Stay tuned for a symphony of elegance, artistry, and inspiration in our upcoming series.\n</p>\n<blockquote>\n    <footer>By Rosalina Pong</footer>\n    <h3>Viral dreamcatcher keytar typewriter, aest hetic offal umami. Aesthetic polaroid pug pitchfork post-ironic.</h3>\n</blockquote>\n<p>\n    Step into a realm where luxury is not just a word, but a way of life. Riorelax invites you to explore a world where opulence meets comfort in seamless harmony. Our blog series will unveil the heart and soul of our hotel, from the intricacies of our meticulous design to the intuitive service that anticipates your every need. Join us on a virtual tour that captures the essence of sophistication, a prelude to the unforgettable experience that awaits you at our shores.\n</p>\n<div class=\"details__content-img\">\n    <img src=\"http://localhost/storage/news/1.jpg\" alt=\"\" />\n</div>\n<p>\n    Prepare to tantalize your taste buds as we delve into the culinary symphony orchestrated by our skilled chefs. From gourmet creations that blend local flavors with international finesse to the art of crafting the perfect cocktail, our blog will be your guide to the exceptional dining journey that awaits. Join us in savoring the stories behind each dish, the dedication that goes into every creation, and the joy of experiencing food as an art form within our culinary haven.\n</p>\n<figure>\n    <img src=\"http://localhost/storage/news/2.jpg\" alt=\"\" />\n    <p>\n        At Riorelax, we believe in crafting memories that last a lifetime. Our blog series will unveil the array of experiences we offer, tailored to every kind of traveler. Whether you seek adventure, relaxation, romance, or exploration, our personalized activities and excursions ensure that your stay transcends the ordinary. Join us as we share stories of guests who\'ve embraced the luxury of choice and embarked on journeys that become cherished tales, all within the embrace of our extraordinary hotel.\n    </p>\n</figure>\n','published',1,'Botble\\ACL\\Models\\User',1,'news/4.jpg',548,NULL,'2024-09-18 03:10:13','2024-09-18 03:10:13'),(5,'The World Caters to Average People','Unveil the hidden truths behind success in a world that often values conformity. In a thought-provoking analysis, we examine why societal norms tend to cater to the average and breaking boundaries.','<p>\n    At Riorelax, we believe in crafting memories that last a lifetime. Our blog series will unveil the array of experiences we offer, tailored to every kind of traveler. Whether you seek adventure, relaxation, romance, or exploration, our personalized activities and excursions ensure that your stay transcends the ordinary. Join us as we share stories of guests who\'ve embraced the luxury of choice and embarked on journeys that become cherished tales, all within the embrace of our extraordinary hotel.\n</p>\n<p>\n    Unlock the Gateway to Opulent Tranquility: Introducing Riorelax\n    Embark on a journey to unparalleled luxury and coastal elegance. Nestled along the Adriatic\'s pristine shoreline, Riorelax stands as a beacon of refined indulgence. Join us as we delve into the enchanting world of bespoke experiences, exquisite accommodations, and personalized service that defines our exceptional hotel. From captivating sea-view rooms to tantalizing gastronomic delights, spa sanctuaries, and curated adventures, our blog takes you behind the scenes of a retreat where every moment is a masterpiece. Uncover the essence of opulence, where your desires are our command and the Adriatic becomes your playground. Stay tuned for a symphony of elegance, artistry, and inspiration in our upcoming series.\n</p>\n<blockquote>\n    <footer>By Rosalina Pong</footer>\n    <h3>Viral dreamcatcher keytar typewriter, aest hetic offal umami. Aesthetic polaroid pug pitchfork post-ironic.</h3>\n</blockquote>\n<p>\n    Step into a realm where luxury is not just a word, but a way of life. Riorelax invites you to explore a world where opulence meets comfort in seamless harmony. Our blog series will unveil the heart and soul of our hotel, from the intricacies of our meticulous design to the intuitive service that anticipates your every need. Join us on a virtual tour that captures the essence of sophistication, a prelude to the unforgettable experience that awaits you at our shores.\n</p>\n<div class=\"details__content-img\">\n    <img src=\"http://localhost/storage/news/1.jpg\" alt=\"\" />\n</div>\n<p>\n    Prepare to tantalize your taste buds as we delve into the culinary symphony orchestrated by our skilled chefs. From gourmet creations that blend local flavors with international finesse to the art of crafting the perfect cocktail, our blog will be your guide to the exceptional dining journey that awaits. Join us in savoring the stories behind each dish, the dedication that goes into every creation, and the joy of experiencing food as an art form within our culinary haven.\n</p>\n<figure>\n    <img src=\"http://localhost/storage/news/2.jpg\" alt=\"\" />\n    <p>\n        At Riorelax, we believe in crafting memories that last a lifetime. Our blog series will unveil the array of experiences we offer, tailored to every kind of traveler. Whether you seek adventure, relaxation, romance, or exploration, our personalized activities and excursions ensure that your stay transcends the ordinary. Join us as we share stories of guests who\'ve embraced the luxury of choice and embarked on journeys that become cherished tales, all within the embrace of our extraordinary hotel.\n    </p>\n</figure>\n','published',1,'Botble\\ACL\\Models\\User',1,'news/5.jpg',739,NULL,'2024-09-18 03:10:13','2024-09-18 03:10:13'),(6,'The litigants on the screen are not actors','Take a behind-the-scenes look at the reality of courtroom dramas. Contrary to common assumptions, the litigants you see on the screen are not mere actors, but real people with compelling stories.','<p>\n    At Riorelax, we believe in crafting memories that last a lifetime. Our blog series will unveil the array of experiences we offer, tailored to every kind of traveler. Whether you seek adventure, relaxation, romance, or exploration, our personalized activities and excursions ensure that your stay transcends the ordinary. Join us as we share stories of guests who\'ve embraced the luxury of choice and embarked on journeys that become cherished tales, all within the embrace of our extraordinary hotel.\n</p>\n<p>\n    Unlock the Gateway to Opulent Tranquility: Introducing Riorelax\n    Embark on a journey to unparalleled luxury and coastal elegance. Nestled along the Adriatic\'s pristine shoreline, Riorelax stands as a beacon of refined indulgence. Join us as we delve into the enchanting world of bespoke experiences, exquisite accommodations, and personalized service that defines our exceptional hotel. From captivating sea-view rooms to tantalizing gastronomic delights, spa sanctuaries, and curated adventures, our blog takes you behind the scenes of a retreat where every moment is a masterpiece. Uncover the essence of opulence, where your desires are our command and the Adriatic becomes your playground. Stay tuned for a symphony of elegance, artistry, and inspiration in our upcoming series.\n</p>\n<blockquote>\n    <footer>By Rosalina Pong</footer>\n    <h3>Viral dreamcatcher keytar typewriter, aest hetic offal umami. Aesthetic polaroid pug pitchfork post-ironic.</h3>\n</blockquote>\n<p>\n    Step into a realm where luxury is not just a word, but a way of life. Riorelax invites you to explore a world where opulence meets comfort in seamless harmony. Our blog series will unveil the heart and soul of our hotel, from the intricacies of our meticulous design to the intuitive service that anticipates your every need. Join us on a virtual tour that captures the essence of sophistication, a prelude to the unforgettable experience that awaits you at our shores.\n</p>\n<div class=\"details__content-img\">\n    <img src=\"http://localhost/storage/news/1.jpg\" alt=\"\" />\n</div>\n<p>\n    Prepare to tantalize your taste buds as we delve into the culinary symphony orchestrated by our skilled chefs. From gourmet creations that blend local flavors with international finesse to the art of crafting the perfect cocktail, our blog will be your guide to the exceptional dining journey that awaits. Join us in savoring the stories behind each dish, the dedication that goes into every creation, and the joy of experiencing food as an art form within our culinary haven.\n</p>\n<figure>\n    <img src=\"http://localhost/storage/news/2.jpg\" alt=\"\" />\n    <p>\n        At Riorelax, we believe in crafting memories that last a lifetime. Our blog series will unveil the array of experiences we offer, tailored to every kind of traveler. Whether you seek adventure, relaxation, romance, or exploration, our personalized activities and excursions ensure that your stay transcends the ordinary. Join us as we share stories of guests who\'ve embraced the luxury of choice and embarked on journeys that become cherished tales, all within the embrace of our extraordinary hotel.\n    </p>\n</figure>\n','published',1,'Botble\\ACL\\Models\\User',1,'news/6.jpg',2286,NULL,'2024-09-18 03:10:13','2024-09-18 03:10:13');
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `posts_translations`
--

DROP TABLE IF EXISTS `posts_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `posts_translations` (
  `lang_code` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `posts_id` bigint unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`lang_code`,`posts_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts_translations`
--

LOCK TABLES `posts_translations` WRITE;
/*!40000 ALTER TABLE `posts_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `posts_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `revisions`
--

DROP TABLE IF EXISTS `revisions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `revisions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `revisionable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revisionable_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `key` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `old_value` text COLLATE utf8mb4_unicode_ci,
  `new_value` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `revisions_revisionable_id_revisionable_type_index` (`revisionable_id`,`revisionable_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `revisions`
--

LOCK TABLES `revisions` WRITE;
/*!40000 ALTER TABLE `revisions` DISABLE KEYS */;
/*!40000 ALTER TABLE `revisions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_users`
--

DROP TABLE IF EXISTS `role_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `role_users` (
  `user_id` bigint unsigned NOT NULL,
  `role_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`user_id`,`role_id`),
  KEY `role_users_user_id_index` (`user_id`),
  KEY `role_users_role_id_index` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_users`
--

LOCK TABLES `role_users` WRITE;
/*!40000 ALTER TABLE `role_users` DISABLE KEYS */;
/*!40000 ALTER TABLE `role_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `permissions` text COLLATE utf8mb4_unicode_ci,
  `description` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_default` tinyint unsigned NOT NULL DEFAULT '0',
  `created_by` bigint unsigned NOT NULL,
  `updated_by` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_slug_unique` (`slug`),
  KEY `roles_created_by_index` (`created_by`),
  KEY `roles_updated_by_index` (`updated_by`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'admin','Admin','{\"users.index\":true,\"users.create\":true,\"users.edit\":true,\"users.destroy\":true,\"roles.index\":true,\"roles.create\":true,\"roles.edit\":true,\"roles.destroy\":true,\"core.system\":true,\"core.cms\":true,\"core.manage.license\":true,\"systems.cronjob\":true,\"core.tools\":true,\"tools.data-synchronize\":true,\"media.index\":true,\"files.index\":true,\"files.create\":true,\"files.edit\":true,\"files.trash\":true,\"files.destroy\":true,\"folders.index\":true,\"folders.create\":true,\"folders.edit\":true,\"folders.trash\":true,\"folders.destroy\":true,\"settings.index\":true,\"settings.common\":true,\"settings.options\":true,\"settings.email\":true,\"settings.media\":true,\"settings.admin-appearance\":true,\"settings.cache\":true,\"settings.datatables\":true,\"settings.email.rules\":true,\"settings.others\":true,\"menus.index\":true,\"menus.create\":true,\"menus.edit\":true,\"menus.destroy\":true,\"optimize.settings\":true,\"pages.index\":true,\"pages.create\":true,\"pages.edit\":true,\"pages.destroy\":true,\"plugins.index\":true,\"plugins.edit\":true,\"plugins.remove\":true,\"plugins.marketplace\":true,\"core.appearance\":true,\"theme.index\":true,\"theme.activate\":true,\"theme.remove\":true,\"theme.options\":true,\"theme.custom-css\":true,\"theme.custom-js\":true,\"theme.custom-html\":true,\"theme.robots-txt\":true,\"settings.website-tracking\":true,\"widgets.index\":true,\"analytics.general\":true,\"analytics.page\":true,\"analytics.browser\":true,\"analytics.referrer\":true,\"analytics.settings\":true,\"audit-log.index\":true,\"audit-log.destroy\":true,\"backups.index\":true,\"backups.create\":true,\"backups.restore\":true,\"backups.destroy\":true,\"plugins.blog\":true,\"posts.index\":true,\"posts.create\":true,\"posts.edit\":true,\"posts.destroy\":true,\"categories.index\":true,\"categories.create\":true,\"categories.edit\":true,\"categories.destroy\":true,\"tags.index\":true,\"tags.create\":true,\"tags.edit\":true,\"tags.destroy\":true,\"blog.settings\":true,\"posts.export\":true,\"posts.import\":true,\"captcha.settings\":true,\"contacts.index\":true,\"contacts.edit\":true,\"contacts.destroy\":true,\"contact.settings\":true,\"plugin.faq\":true,\"faq.index\":true,\"faq.create\":true,\"faq.edit\":true,\"faq.destroy\":true,\"faq_category.index\":true,\"faq_category.create\":true,\"faq_category.edit\":true,\"faq_category.destroy\":true,\"faqs.settings\":true,\"galleries.index\":true,\"galleries.create\":true,\"galleries.edit\":true,\"galleries.destroy\":true,\"room.index\":true,\"room.create\":true,\"room.edit\":true,\"room.destroy\":true,\"amenity.index\":true,\"amenity.create\":true,\"amenity.edit\":true,\"amenity.destroy\":true,\"food.index\":true,\"food.create\":true,\"food.edit\":true,\"food.destroy\":true,\"food-type.index\":true,\"food-type.create\":true,\"food-type.edit\":true,\"food-type.destroy\":true,\"booking.index\":true,\"booking.edit\":true,\"booking.destroy\":true,\"booking.reports.index\":true,\"booking.calendar.index\":true,\"booking-address.index\":true,\"booking-address.create\":true,\"booking-address.edit\":true,\"booking-address.destroy\":true,\"booking-room.index\":true,\"booking-room.create\":true,\"booking-room.edit\":true,\"booking-room.destroy\":true,\"customer.index\":true,\"customer.create\":true,\"customer.edit\":true,\"customer.destroy\":true,\"room-category.index\":true,\"room-category.create\":true,\"room-category.edit\":true,\"room-category.destroy\":true,\"feature.index\":true,\"feature.create\":true,\"feature.edit\":true,\"feature.destroy\":true,\"service.index\":true,\"service.create\":true,\"service.edit\":true,\"service.destroy\":true,\"place.index\":true,\"place.create\":true,\"place.edit\":true,\"place.destroy\":true,\"tax.index\":true,\"tax.create\":true,\"tax.edit\":true,\"tax.destroy\":true,\"invoice.template\":true,\"coupons.index\":true,\"coupons.create\":true,\"coupons.edit\":true,\"coupons.destroy\":true,\"hotel.settings\":true,\"languages.index\":true,\"languages.create\":true,\"languages.edit\":true,\"languages.destroy\":true,\"newsletter.index\":true,\"newsletter.destroy\":true,\"newsletter.settings\":true,\"payment.index\":true,\"payments.settings\":true,\"payment.destroy\":true,\"payments.logs\":true,\"payments.logs.show\":true,\"payments.logs.destroy\":true,\"simple-slider.index\":true,\"simple-slider.create\":true,\"simple-slider.edit\":true,\"simple-slider.destroy\":true,\"simple-slider-item.index\":true,\"simple-slider-item.create\":true,\"simple-slider-item.edit\":true,\"simple-slider-item.destroy\":true,\"simple-slider.settings\":true,\"social-login.settings\":true,\"team.index\":true,\"team.create\":true,\"team.edit\":true,\"team.destroy\":true,\"testimonial.index\":true,\"testimonial.create\":true,\"testimonial.edit\":true,\"testimonial.destroy\":true,\"plugins.translation\":true,\"translations.locales\":true,\"translations.theme-translations\":true,\"translations.index\":true,\"theme-translations.export\":true,\"other-translations.export\":true,\"theme-translations.import\":true,\"other-translations.import\":true}','Admin users role',1,1,1,'2024-09-18 03:10:23','2024-09-18 03:10:23');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `settings_key_unique` (`key`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` VALUES (1,'media_random_hash','4cf7d63d34b1e3ac0215f32e0c7ba9ad',NULL,'2024-09-18 03:10:25'),(2,'api_enabled','0',NULL,'2024-09-18 03:10:25'),(3,'analytics_dashboard_widgets','0','2024-09-18 03:10:10','2024-09-18 03:10:10'),(4,'activated_plugins','[\"language\",\"language-advanced\",\"analytics\",\"audit-log\",\"backup\",\"blog\",\"captcha\",\"contact\",\"cookie-consent\",\"faq\",\"gallery\",\"hotel\",\"newsletter\",\"payment\",\"paypal\",\"paystack\",\"razorpay\",\"simple-slider\",\"social-login\",\"sslcommerz\",\"stripe\",\"team\",\"testimonial\",\"translation\"]',NULL,'2024-09-18 03:10:25'),(5,'enable_recaptcha_botble_contact_forms_fronts_contact_form','1','2024-09-18 03:10:10','2024-09-18 03:10:10'),(6,'enable_recaptcha_botble_newsletter_forms_fronts_newsletter_form','1','2024-09-18 03:10:11','2024-09-18 03:10:11'),(7,'theme','riorelax',NULL,'2024-09-18 03:10:25'),(8,'show_admin_bar','1',NULL,'2024-09-18 03:10:25'),(9,'language_hide_default','1',NULL,'2024-09-18 03:10:25'),(11,'language_display','all',NULL,'2024-09-18 03:10:25'),(12,'language_hide_languages','[]',NULL,'2024-09-18 03:10:25'),(13,'language_switcher_display','dropdown',NULL,'2024-09-18 03:10:25'),(14,'admin_logo','general/logo.png',NULL,'2024-09-18 03:10:25'),(15,'admin_favicon','general/favicon.png',NULL,'2024-09-18 03:10:25'),(16,'permalink-botble-blog-models-post','news',NULL,'2024-09-18 03:10:25'),(17,'permalink-botble-blog-models-category','news',NULL,'2024-09-18 03:10:25'),(18,'payment_cod_status','1',NULL,'2024-09-18 03:10:25'),(19,'payment_cod_description','Please pay money directly to the postman, if you choose cash on delivery method (COD).',NULL,'2024-09-18 03:10:25'),(20,'payment_bank_transfer_status','1',NULL,'2024-09-18 03:10:25'),(21,'payment_bank_transfer_description','Please send money to our bank account: ACB - 69270 213 19.',NULL,'2024-09-18 03:10:25'),(22,'payment_stripe_payment_type','stripe_checkout',NULL,'2024-09-18 03:10:25'),(23,'hotel_company_logo_for_invoicing','general/logo-dark.png',NULL,'2024-09-18 03:10:25'),(24,'hotel_company_address_for_invoicing','123, My Street, Kingston, New York',NULL,'2024-09-18 03:10:25'),(25,'hotel_company_email_for_invoicing','contact@archielite.com',NULL,'2024-09-18 03:10:25'),(26,'hotel_company_phone_for_invoicing','123456789',NULL,'2024-09-18 03:10:25'),(27,'hotel_enable_review_room','1',NULL,'2024-09-18 03:10:25'),(28,'hotel_reviews_per_page','10',NULL,'2024-09-18 03:10:25'),(29,'theme-riorelax-site_title','Hotel Riorelax',NULL,'2024-09-18 03:10:25'),(30,'theme-riorelax-copyright','©2024 Archi Elite JSC. All right reserved.',NULL,'2024-09-18 03:10:25'),(31,'theme-riorelax-primary_color','#644222',NULL,'2024-09-18 03:10:25'),(32,'theme-riorelax-secondary_color','#be9874',NULL,'2024-09-18 03:10:25'),(33,'theme-riorelax-input_border_color','#d7cfc8',NULL,'2024-09-18 03:10:25'),(34,'theme-riorelax-primary_color_hover','#2e1913',NULL,'2024-09-18 03:10:25'),(35,'theme-riorelax-button_text_color_hover','#101010',NULL,'2024-09-18 03:10:25'),(36,'theme-riorelax-primary_font','Roboto',NULL,'2024-09-18 03:10:25'),(37,'theme-riorelax-heading_font','Jost',NULL,'2024-09-18 03:10:25'),(38,'theme-riorelax-cookie_consent_message','Your experience on this site will be improved by allowing cookies ',NULL,'2024-09-18 03:10:25'),(39,'theme-riorelax-cookie_consent_learn_more_url','/cookie-policy',NULL,'2024-09-18 03:10:25'),(40,'theme-riorelax-cookie_consent_learn_more_text','Cookie Policy',NULL,'2024-09-18 03:10:25'),(41,'theme-riorelax-homepage_id','1',NULL,'2024-09-18 03:10:25'),(42,'theme-riorelax-blog_page_id','10',NULL,'2024-09-18 03:10:25'),(43,'theme-riorelax-logo','general/logo.png',NULL,'2024-09-18 03:10:25'),(44,'theme-riorelax-favicon','general/favicon.png',NULL,'2024-09-18 03:10:25'),(45,'theme-riorelax-email','info@webmail.com',NULL,'2024-09-18 03:10:25'),(46,'theme-riorelax-address','14/A, Riorelax City, NYC',NULL,'2024-09-18 03:10:25'),(47,'theme-riorelax-hotline','+908 987 877 09',NULL,'2024-09-18 03:10:25'),(48,'theme-riorelax-preloader_enabled','no',NULL,'2024-09-18 03:10:25'),(49,'theme-riorelax-opening_hours','Mon - Fri: 9:00 - 19:00/ Closed on Weekends',NULL,'2024-09-18 03:10:25'),(50,'theme-riorelax-header_button_url','/contact-us',NULL,'2024-09-18 03:10:25'),(51,'theme-riorelax-header_button_label','Reservation',NULL,'2024-09-18 03:10:25'),(52,'theme-riorelax-background_footer','backgrounds/footer-bg.png',NULL,'2024-09-18 03:10:25'),(53,'theme-riorelax-galleries_limit_images','3',NULL,'2024-09-18 03:10:25'),(54,'theme-riorelax-hotel_rules','<ul><li>No smoking, parties or events.</li><li>Check-in time from 2 PM, check-out by 10 AM.</li><li>Time to time car parking</li><li>Download Our minimal app</li><li>Browse regular our website</li></ul>',NULL,'2024-09-18 03:10:25'),(55,'theme-riorelax-cancellation','<p>We’re pleased to offer a full refund of the booking amount for cancellations made <strong>14 days or more</strong> before the scheduled check-in date. This generous window provides you with the flexibility to adjust your plans without any financial repercussions.<p>',NULL,'2024-09-18 03:10:25'),(56,'theme-riorelax-authentication_login_background_image','general/booking-img.png',NULL,'2024-09-18 03:10:25'),(57,'theme-riorelax-authentication_register_background_image','general/booking-img.png',NULL,'2024-09-18 03:10:25'),(58,'theme-riorelax-authentication_forgot_password_background_image','general/booking-img.png',NULL,'2024-09-18 03:10:25'),(59,'theme-riorelax-authentication_reset_password_background_image','general/booking-img.png',NULL,'2024-09-18 03:10:25'),(60,'theme-riorelax-404_page_image','general/404.png',NULL,'2024-09-18 03:10:25'),(61,'theme-riorelax-social_links','[[{\"key\":\"name\",\"value\":\"Facebook\"},{\"key\":\"social-icon\",\"value\":\"fab fa-facebook-f\"},{\"key\":\"url\",\"value\":\"https:\\/\\/www.facebook.com\\/\"}],[{\"key\":\"name\",\"value\":\"Instagram\"},{\"key\":\"social-icon\",\"value\":\"fab fa-instagram\"},{\"key\":\"url\",\"value\":\"https:\\/\\/www.instagram.com\\/\"}],[{\"key\":\"name\",\"value\":\"Twitter\"},{\"key\":\"social-icon\",\"value\":\"fab fa-twitter\"},{\"key\":\"url\",\"value\":\"https:\\/\\/www.twitter.com\\/\"}],[{\"key\":\"name\",\"value\":\"YouTube\"},{\"key\":\"social-icon\",\"value\":\"fab fa-youtube\"},{\"key\":\"url\",\"value\":\"https:\\/\\/www.youtube.com\\/\"}]]',NULL,'2024-09-18 03:10:25'),(62,'simple_slider_using_assets','0',NULL,NULL);
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `simple_slider_items`
--

DROP TABLE IF EXISTS `simple_slider_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `simple_slider_items` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `simple_slider_id` bigint unsigned NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `order` int unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `simple_slider_items`
--

LOCK TABLES `simple_slider_items` WRITE;
/*!40000 ALTER TABLE `simple_slider_items` DISABLE KEYS */;
INSERT INTO `simple_slider_items` VALUES (1,1,'Enjoy A Luxury Experience','banners/slider-1.png','/contact-us','Donec vitae libero non enim placerat eleifend aliquam erat volutpat. Curabitur diam ex, dapibus purus sapien, cursus sed nisl tristique, commodo gravida lectus non.',1,'2024-09-18 03:10:25','2024-09-18 03:10:25'),(2,1,'Enjoy A Luxury Experience','banners/slider-2.png','/contact-us','Donec vitae libero non enim placerat eleifend aliquam erat volutpat. Curabitur diam ex, dapibus purus sapien, cursus sed nisl tristique, commodo gravida lectus non.',2,'2024-09-18 03:10:25','2024-09-18 03:10:25');
/*!40000 ALTER TABLE `simple_slider_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `simple_sliders`
--

DROP TABLE IF EXISTS `simple_sliders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `simple_sliders` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `key` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'published',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `simple_sliders`
--

LOCK TABLES `simple_sliders` WRITE;
/*!40000 ALTER TABLE `simple_sliders` DISABLE KEYS */;
INSERT INTO `simple_sliders` VALUES (1,'Home slider','home-slider','The main slider on homepage','published','2024-09-18 03:10:25','2024-09-18 03:10:25');
/*!40000 ALTER TABLE `simple_sliders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `slugs`
--

DROP TABLE IF EXISTS `slugs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `slugs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reference_id` bigint unsigned NOT NULL,
  `reference_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prefix` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `slugs_reference_id_index` (`reference_id`),
  KEY `slugs_key_index` (`key`),
  KEY `slugs_prefix_index` (`prefix`),
  KEY `slugs_reference_index` (`reference_id`,`reference_type`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `slugs`
--

LOCK TABLES `slugs` WRITE;
/*!40000 ALTER TABLE `slugs` DISABLE KEYS */;
INSERT INTO `slugs` VALUES (1,'general',1,'Botble\\Blog\\Models\\Category','news','2024-09-18 03:10:12','2024-09-18 03:10:23'),(2,'hotel',2,'Botble\\Blog\\Models\\Category','news','2024-09-18 03:10:12','2024-09-18 03:10:23'),(3,'booking',3,'Botble\\Blog\\Models\\Category','news','2024-09-18 03:10:12','2024-09-18 03:10:23'),(4,'resort',4,'Botble\\Blog\\Models\\Category','news','2024-09-18 03:10:12','2024-09-18 03:10:23'),(5,'travel',5,'Botble\\Blog\\Models\\Category','news','2024-09-18 03:10:12','2024-09-18 03:10:23'),(6,'general',1,'Botble\\Blog\\Models\\Tag','tag','2024-09-18 03:10:12','2024-09-18 03:10:12'),(7,'hotel',2,'Botble\\Blog\\Models\\Tag','tag','2024-09-18 03:10:12','2024-09-18 03:10:12'),(8,'booking',3,'Botble\\Blog\\Models\\Tag','tag','2024-09-18 03:10:12','2024-09-18 03:10:12'),(9,'resort',4,'Botble\\Blog\\Models\\Tag','tag','2024-09-18 03:10:12','2024-09-18 03:10:12'),(10,'travel',5,'Botble\\Blog\\Models\\Tag','tag','2024-09-18 03:10:12','2024-09-18 03:10:12'),(11,'each-of-our-8-double-rooms-has-its-own-distinct',1,'Botble\\Blog\\Models\\Post','news','2024-09-18 03:10:13','2024-09-18 03:10:23'),(12,'essential-qualities-of-highly-successful-music',2,'Botble\\Blog\\Models\\Post','news','2024-09-18 03:10:13','2024-09-18 03:10:23'),(13,'9-things-i-love-about-shaving-my-head',3,'Botble\\Blog\\Models\\Post','news','2024-09-18 03:10:13','2024-09-18 03:10:23'),(14,'why-teamwork-really-makes-the-dream-work',4,'Botble\\Blog\\Models\\Post','news','2024-09-18 03:10:13','2024-09-18 03:10:23'),(15,'the-world-caters-to-average-people',5,'Botble\\Blog\\Models\\Post','news','2024-09-18 03:10:13','2024-09-18 03:10:23'),(16,'the-litigants-on-the-screen-are-not-actors',6,'Botble\\Blog\\Models\\Post','news','2024-09-18 03:10:13','2024-09-18 03:10:23'),(17,'luxury-hall-of-fame',1,'Botble\\Hotel\\Models\\Room','rooms','2024-09-18 03:10:14','2024-09-18 03:10:14'),(18,'pendora-fame',2,'Botble\\Hotel\\Models\\Room','rooms','2024-09-18 03:10:14','2024-09-18 03:10:14'),(19,'pacific-room',3,'Botble\\Hotel\\Models\\Room','rooms','2024-09-18 03:10:14','2024-09-18 03:10:14'),(20,'junior-suite',4,'Botble\\Hotel\\Models\\Room','rooms','2024-09-18 03:10:14','2024-09-18 03:10:14'),(21,'family-suite',5,'Botble\\Hotel\\Models\\Room','rooms','2024-09-18 03:10:14','2024-09-18 03:10:14'),(22,'relax-suite',6,'Botble\\Hotel\\Models\\Room','rooms','2024-09-18 03:10:14','2024-09-18 03:10:14'),(23,'luxury-suite',7,'Botble\\Hotel\\Models\\Room','rooms','2024-09-18 03:10:14','2024-09-18 03:10:14'),(24,'president-room',8,'Botble\\Hotel\\Models\\Room','rooms','2024-09-18 03:10:14','2024-09-18 03:10:14'),(25,'quality-room',1,'Botble\\Hotel\\Models\\Service','services','2024-09-18 03:10:15','2024-09-18 03:10:15'),(26,'privet-beach',2,'Botble\\Hotel\\Models\\Service','services','2024-09-18 03:10:15','2024-09-18 03:10:15'),(27,'best-accommodation',3,'Botble\\Hotel\\Models\\Service','services','2024-09-18 03:10:15','2024-09-18 03:10:15'),(28,'wellness-spa',4,'Botble\\Hotel\\Models\\Service','services','2024-09-18 03:10:15','2024-09-18 03:10:15'),(29,'restaurants-bars',5,'Botble\\Hotel\\Models\\Service','services','2024-09-18 03:10:15','2024-09-18 03:10:15'),(30,'special-offers',6,'Botble\\Hotel\\Models\\Service','services','2024-09-18 03:10:15','2024-09-18 03:10:15'),(31,'duplex-restaurant',1,'Botble\\Hotel\\Models\\Place','places','2024-09-18 03:10:19','2024-09-18 03:10:19'),(32,'overnight-bars',2,'Botble\\Hotel\\Models\\Place','places','2024-09-18 03:10:19','2024-09-18 03:10:19'),(33,'beautiful-beach',3,'Botble\\Hotel\\Models\\Place','places','2024-09-18 03:10:19','2024-09-18 03:10:19'),(34,'beautiful-spa',4,'Botble\\Hotel\\Models\\Place','places','2024-09-18 03:10:19','2024-09-18 03:10:19'),(35,'duplex-golf',5,'Botble\\Hotel\\Models\\Place','places','2024-09-18 03:10:19','2024-09-18 03:10:19'),(36,'luxury-restaurant',6,'Botble\\Hotel\\Models\\Place','places','2024-09-18 03:10:19','2024-09-18 03:10:19'),(37,'home-page-01',1,'Botble\\Page\\Models\\Page','','2024-09-18 03:10:22','2024-09-18 03:10:22'),(38,'home-page-02',2,'Botble\\Page\\Models\\Page','','2024-09-18 03:10:22','2024-09-18 03:10:22'),(39,'home-page-side-menu',3,'Botble\\Page\\Models\\Page','','2024-09-18 03:10:22','2024-09-18 03:10:22'),(40,'home-page-full-menu',4,'Botble\\Page\\Models\\Page','','2024-09-18 03:10:22','2024-09-18 03:10:22'),(41,'about-us',5,'Botble\\Page\\Models\\Page','','2024-09-18 03:10:22','2024-09-18 03:10:22'),(42,'services',6,'Botble\\Page\\Models\\Page','','2024-09-18 03:10:22','2024-09-18 03:10:22'),(43,'galleries',7,'Botble\\Page\\Models\\Page','','2024-09-18 03:10:22','2024-09-18 03:10:22'),(44,'faq',8,'Botble\\Page\\Models\\Page','','2024-09-18 03:10:22','2024-09-18 03:10:22'),(45,'team',9,'Botble\\Page\\Models\\Page','','2024-09-18 03:10:22','2024-09-18 03:10:22'),(46,'blog',10,'Botble\\Page\\Models\\Page','','2024-09-18 03:10:22','2024-09-18 03:10:22'),(47,'contact-us',11,'Botble\\Page\\Models\\Page','','2024-09-18 03:10:22','2024-09-18 03:10:22'),(48,'privacy',12,'Botble\\Page\\Models\\Page','','2024-09-18 03:10:22','2024-09-18 03:10:22'),(49,'term-and-conditions',13,'Botble\\Page\\Models\\Page','','2024-09-18 03:10:22','2024-09-18 03:10:22'),(50,'room',1,'Botble\\Gallery\\Models\\Gallery','galleries','2024-09-18 03:10:23','2024-09-18 03:10:23'),(51,'hall',2,'Botble\\Gallery\\Models\\Gallery','galleries','2024-09-18 03:10:23','2024-09-18 03:10:23'),(52,'guardian',3,'Botble\\Gallery\\Models\\Gallery','galleries','2024-09-18 03:10:23','2024-09-18 03:10:23'),(53,'hotel',4,'Botble\\Gallery\\Models\\Gallery','galleries','2024-09-18 03:10:23','2024-09-18 03:10:23'),(54,'event-hall',5,'Botble\\Gallery\\Models\\Gallery','galleries','2024-09-18 03:10:23','2024-09-18 03:10:23'),(55,'howard-holmes',1,'Botble\\Team\\Models\\Team','teams','2024-09-18 03:10:26','2024-09-18 03:10:26'),(56,'ella-thompson',2,'Botble\\Team\\Models\\Team','teams','2024-09-18 03:10:26','2024-09-18 03:10:26'),(57,'devon-lane',3,'Botble\\Team\\Models\\Team','teams','2024-09-18 03:10:26','2024-09-18 03:10:26'),(58,'kate-beckham',4,'Botble\\Team\\Models\\Team','teams','2024-09-18 03:10:26','2024-09-18 03:10:26'),(59,'vincent-cooper',5,'Botble\\Team\\Models\\Team','teams','2024-09-18 03:10:26','2024-09-18 03:10:26'),(60,'danielle-bryant',6,'Botble\\Team\\Models\\Team','teams','2024-09-18 03:10:26','2024-09-18 03:10:26'),(61,'kami-hope',7,'Botble\\Team\\Models\\Team','teams','2024-09-18 03:10:26','2024-09-18 03:10:26'),(62,'frankie-musk',8,'Botble\\Team\\Models\\Team','teams','2024-09-18 03:10:26','2024-09-18 03:10:26');
/*!40000 ALTER TABLE `slugs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `slugs_translations`
--

DROP TABLE IF EXISTS `slugs_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `slugs_translations` (
  `lang_code` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slugs_id` bigint unsigned NOT NULL,
  `key` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prefix` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT '',
  PRIMARY KEY (`lang_code`,`slugs_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `slugs_translations`
--

LOCK TABLES `slugs_translations` WRITE;
/*!40000 ALTER TABLE `slugs_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `slugs_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tags`
--

DROP TABLE IF EXISTS `tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tags` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `author_id` bigint unsigned DEFAULT NULL,
  `author_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Botble\\ACL\\Models\\User',
  `description` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'published',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tags`
--

LOCK TABLES `tags` WRITE;
/*!40000 ALTER TABLE `tags` DISABLE KEYS */;
INSERT INTO `tags` VALUES (1,'General',1,'Botble\\ACL\\Models\\User',NULL,'published','2024-09-18 03:10:12','2024-09-18 03:10:12'),(2,'Hotel',1,'Botble\\ACL\\Models\\User',NULL,'published','2024-09-18 03:10:12','2024-09-18 03:10:12'),(3,'Booking',1,'Botble\\ACL\\Models\\User',NULL,'published','2024-09-18 03:10:12','2024-09-18 03:10:12'),(4,'Resort',1,'Botble\\ACL\\Models\\User',NULL,'published','2024-09-18 03:10:12','2024-09-18 03:10:12'),(5,'Travel',1,'Botble\\ACL\\Models\\User',NULL,'published','2024-09-18 03:10:12','2024-09-18 03:10:12');
/*!40000 ALTER TABLE `tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tags_translations`
--

DROP TABLE IF EXISTS `tags_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tags_translations` (
  `lang_code` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tags_id` bigint unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`lang_code`,`tags_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tags_translations`
--

LOCK TABLES `tags_translations` WRITE;
/*!40000 ALTER TABLE `tags_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `tags_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `teams`
--

DROP TABLE IF EXISTS `teams`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `teams` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `socials` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'published',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci,
  `phone` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `teams`
--

LOCK TABLES `teams` WRITE;
/*!40000 ALTER TABLE `teams` DISABLE KEYS */;
INSERT INTO `teams` VALUES (1,'Howard Holmes','teams/1.png','General Manager','USA','{\"facebook\":\"https:\\/\\/www.facebook.com\\/\",\"twitter\":\"https:\\/\\/twitter.com\\/\",\"instagram\":\"https:\\/\\/www.instagram.com\\/\"}','published','2024-09-18 03:10:26','2024-09-18 03:10:26','<p>Pleasure and praising pain was born and I will give you a complete account of the systems, and expound the actually teachings of the great explorer of the truth, the master-builder of human uts happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally Nor who loves or pursues or desires to obtain pain of itself.</p><p>Tempor nonummy metus lobortis. Sociis velit etiam, dapibus lectus vehicula pele llentesque cras pat fusce pharetra felis sapien varius Integer dis ads se purus sollicitudin dapibus et vivamus pharetra sit integer dictum in dise natoque an mus quis in. Facilisis inceptos nec, potenti nostra aenean lacinia varius semper ant nullam nulla primis placerat facilisis. Netus lorem rutrum arcu dignissim at sit morbi phasellus nascetur eget urna potenti cum vestibulum cras.</p><div>[user-profile image_1=\"teams/img1.png\" image_2=\"teams/img2.png\" quantity=\"3\" title_1=\"Design\" percentage_1=\"80\" title_2=\"Easy Manage\" percentage_2=\"90\" title_3=\"Project Organize\" percentage_3=\"70\"][/user-profile]</div>','12345678','howard@gmail.com','Cecilia Chapman711-2880 Nulla St.','https://example.com',NULL),(2,'Ella Thompson','teams/2.png','Bell Captain','Qatar','{\"facebook\":\"https:\\/\\/www.facebook.com\\/\",\"twitter\":\"https:\\/\\/twitter.com\\/\",\"instagram\":\"https:\\/\\/www.instagram.com\\/\"}','published','2024-09-18 03:10:26','2024-09-18 03:10:26','<p>Pleasure and praising pain was born and I will give you a complete account of the systems, and expound the actually teachings of the great explorer of the truth, the master-builder of human uts happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally Nor who loves or pursues or desires to obtain pain of itself.</p><p>Tempor nonummy metus lobortis. Sociis velit etiam, dapibus lectus vehicula pele llentesque cras pat fusce pharetra felis sapien varius Integer dis ads se purus sollicitudin dapibus et vivamus pharetra sit integer dictum in dise natoque an mus quis in. Facilisis inceptos nec, potenti nostra aenean lacinia varius semper ant nullam nulla primis placerat facilisis. Netus lorem rutrum arcu dignissim at sit morbi phasellus nascetur eget urna potenti cum vestibulum cras.</p><div>[user-profile image_1=\"teams/img1.png\" image_2=\"teams/img2.png\" quantity=\"3\" title_1=\"Design\" percentage_1=\"80\" title_2=\"Easy Manage\" percentage_2=\"90\" title_3=\"Project Organize\" percentage_3=\"70\"][/user-profile]</div>','234324232','thompson@gmail.com','Cecilia Chapman711-2880 Nulla St.','https://example.com',NULL),(3,'Devon Lane','teams/3.png','Executive Chef','India','{\"facebook\":\"https:\\/\\/www.facebook.com\\/\",\"twitter\":\"https:\\/\\/twitter.com\\/\",\"instagram\":\"https:\\/\\/www.instagram.com\\/\"}','published','2024-09-18 03:10:26','2024-09-18 03:10:26','<p>Pleasure and praising pain was born and I will give you a complete account of the systems, and expound the actually teachings of the great explorer of the truth, the master-builder of human uts happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally Nor who loves or pursues or desires to obtain pain of itself.</p><p>Tempor nonummy metus lobortis. Sociis velit etiam, dapibus lectus vehicula pele llentesque cras pat fusce pharetra felis sapien varius Integer dis ads se purus sollicitudin dapibus et vivamus pharetra sit integer dictum in dise natoque an mus quis in. Facilisis inceptos nec, potenti nostra aenean lacinia varius semper ant nullam nulla primis placerat facilisis. Netus lorem rutrum arcu dignissim at sit morbi phasellus nascetur eget urna potenti cum vestibulum cras.</p><div>[user-profile image_1=\"teams/img1.png\" image_2=\"teams/img2.png\" quantity=\"3\" title_1=\"Design\" percentage_1=\"80\" title_2=\"Easy Manage\" percentage_2=\"90\" title_3=\"Project Organize\" percentage_3=\"70\"][/user-profile]</div>','543324322','devon@gmail.com','Cecilia Chapman711-2880 Nulla St.','https://example.com',NULL),(4,'Kate Beckham','teams/4.png','Bartender','Thailand','{\"facebook\":\"https:\\/\\/www.facebook.com\\/\",\"twitter\":\"https:\\/\\/twitter.com\\/\",\"instagram\":\"https:\\/\\/www.instagram.com\\/\"}','published','2024-09-18 03:10:26','2024-09-18 03:10:26','<p>Pleasure and praising pain was born and I will give you a complete account of the systems, and expound the actually teachings of the great explorer of the truth, the master-builder of human uts happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally Nor who loves or pursues or desires to obtain pain of itself.</p><p>Tempor nonummy metus lobortis. Sociis velit etiam, dapibus lectus vehicula pele llentesque cras pat fusce pharetra felis sapien varius Integer dis ads se purus sollicitudin dapibus et vivamus pharetra sit integer dictum in dise natoque an mus quis in. Facilisis inceptos nec, potenti nostra aenean lacinia varius semper ant nullam nulla primis placerat facilisis. Netus lorem rutrum arcu dignissim at sit morbi phasellus nascetur eget urna potenti cum vestibulum cras.</p><div>[user-profile image_1=\"teams/img1.png\" image_2=\"teams/img2.png\" quantity=\"3\" title_1=\"Design\" percentage_1=\"80\" title_2=\"Easy Manage\" percentage_2=\"90\" title_3=\"Project Organize\" percentage_3=\"70\"][/user-profile]</div>','234345432','beckham@gmail.com','Cecilia Chapman711-2880 Nulla St.','https://example.com',NULL),(5,'Vincent Cooper','teams/5.png','Driver','Poland','{\"facebook\":\"https:\\/\\/www.facebook.com\\/\",\"twitter\":\"https:\\/\\/twitter.com\\/\",\"instagram\":\"https:\\/\\/www.instagram.com\\/\"}','published','2024-09-18 03:10:26','2024-09-18 03:10:26','<p>Pleasure and praising pain was born and I will give you a complete account of the systems, and expound the actually teachings of the great explorer of the truth, the master-builder of human uts happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally Nor who loves or pursues or desires to obtain pain of itself.</p><p>Tempor nonummy metus lobortis. Sociis velit etiam, dapibus lectus vehicula pele llentesque cras pat fusce pharetra felis sapien varius Integer dis ads se purus sollicitudin dapibus et vivamus pharetra sit integer dictum in dise natoque an mus quis in. Facilisis inceptos nec, potenti nostra aenean lacinia varius semper ant nullam nulla primis placerat facilisis. Netus lorem rutrum arcu dignissim at sit morbi phasellus nascetur eget urna potenti cum vestibulum cras.</p><div>[user-profile image_1=\"teams/img1.png\" image_2=\"teams/img2.png\" quantity=\"3\" title_1=\"Design\" percentage_1=\"80\" title_2=\"Easy Manage\" percentage_2=\"90\" title_3=\"Project Organize\" percentage_3=\"70\"][/user-profile]</div>','4324234221','cooper@gmail.com','Cecilia Chapman711-2880 Nulla St.','https://example.com',NULL),(6,'Danielle Bryant','teams/6.png','Event Coordinator','Finland','{\"facebook\":\"https:\\/\\/www.facebook.com\\/\",\"twitter\":\"https:\\/\\/twitter.com\\/\",\"instagram\":\"https:\\/\\/www.instagram.com\\/\"}','published','2024-09-18 03:10:26','2024-09-18 03:10:26','<p>Pleasure and praising pain was born and I will give you a complete account of the systems, and expound the actually teachings of the great explorer of the truth, the master-builder of human uts happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally Nor who loves or pursues or desires to obtain pain of itself.</p><p>Tempor nonummy metus lobortis. Sociis velit etiam, dapibus lectus vehicula pele llentesque cras pat fusce pharetra felis sapien varius Integer dis ads se purus sollicitudin dapibus et vivamus pharetra sit integer dictum in dise natoque an mus quis in. Facilisis inceptos nec, potenti nostra aenean lacinia varius semper ant nullam nulla primis placerat facilisis. Netus lorem rutrum arcu dignissim at sit morbi phasellus nascetur eget urna potenti cum vestibulum cras.</p><div>[user-profile image_1=\"teams/img1.png\" image_2=\"teams/img2.png\" quantity=\"3\" title_1=\"Design\" percentage_1=\"80\" title_2=\"Easy Manage\" percentage_2=\"90\" title_3=\"Project Organize\" percentage_3=\"70\"][/user-profile]</div>','4234232321','danielle@gmail.com','Cecilia Chapman711-2880 Nulla St.','https://example.com',NULL),(7,'Kami Hope','teams/7.png','Event Coordinator','Thailand','{\"facebook\":\"https:\\/\\/www.facebook.com\\/\",\"twitter\":\"https:\\/\\/twitter.com\\/\",\"instagram\":\"https:\\/\\/www.instagram.com\\/\"}','published','2024-09-18 03:10:26','2024-09-18 03:10:26','<p>Pleasure and praising pain was born and I will give you a complete account of the systems, and expound the actually teachings of the great explorer of the truth, the master-builder of human uts happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally Nor who loves or pursues or desires to obtain pain of itself.</p><p>Tempor nonummy metus lobortis. Sociis velit etiam, dapibus lectus vehicula pele llentesque cras pat fusce pharetra felis sapien varius Integer dis ads se purus sollicitudin dapibus et vivamus pharetra sit integer dictum in dise natoque an mus quis in. Facilisis inceptos nec, potenti nostra aenean lacinia varius semper ant nullam nulla primis placerat facilisis. Netus lorem rutrum arcu dignissim at sit morbi phasellus nascetur eget urna potenti cum vestibulum cras.</p><div>[user-profile image_1=\"teams/img1.png\" image_2=\"teams/img2.png\" quantity=\"3\" title_1=\"Design\" percentage_1=\"80\" title_2=\"Easy Manage\" percentage_2=\"90\" title_3=\"Project Organize\" percentage_3=\"70\"][/user-profile]</div>','123456781','hope@gmail.com','Cecilia Chapman711-2880 Bangkok St.','https://example.com',NULL),(8,'Frankie Musk','teams/8.png','Driver','USA','{\"facebook\":\"https:\\/\\/www.facebook.com\\/\",\"twitter\":\"https:\\/\\/twitter.com\\/\",\"instagram\":\"https:\\/\\/www.instagram.com\\/\"}','published','2024-09-18 03:10:26','2024-09-18 03:10:26','<p>Pleasure and praising pain was born and I will give you a complete account of the systems, and expound the actually teachings of the great explorer of the truth, the master-builder of human uts happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally Nor who loves or pursues or desires to obtain pain of itself.</p><p>Tempor nonummy metus lobortis. Sociis velit etiam, dapibus lectus vehicula pele llentesque cras pat fusce pharetra felis sapien varius Integer dis ads se purus sollicitudin dapibus et vivamus pharetra sit integer dictum in dise natoque an mus quis in. Facilisis inceptos nec, potenti nostra aenean lacinia varius semper ant nullam nulla primis placerat facilisis. Netus lorem rutrum arcu dignissim at sit morbi phasellus nascetur eget urna potenti cum vestibulum cras.</p><div>[user-profile image_1=\"teams/img1.png\" image_2=\"teams/img2.png\" quantity=\"3\" title_1=\"Design\" percentage_1=\"80\" title_2=\"Easy Manage\" percentage_2=\"90\" title_3=\"Project Organize\" percentage_3=\"70\"][/user-profile]</div>','1323243242','frankie@gmail.com','Cecilia Chapman711-2880 Nulla St.','https://example.com',NULL);
/*!40000 ALTER TABLE `teams` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `teams_translations`
--

DROP TABLE IF EXISTS `teams_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `teams_translations` (
  `lang_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `teams_id` int NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`lang_code`,`teams_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `teams_translations`
--

LOCK TABLES `teams_translations` WRITE;
/*!40000 ALTER TABLE `teams_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `teams_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `testimonials`
--

DROP TABLE IF EXISTS `testimonials`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `testimonials` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'published',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `testimonials`
--

LOCK TABLES `testimonials` WRITE;
/*!40000 ALTER TABLE `testimonials` DISABLE KEYS */;
INSERT INTO `testimonials` VALUES (1,'Adam Williams','A true gem! Impeccable service, stunning views, and utmost comfort. Our stay was pure perfection. Planning our return!','testimonials/01.png','CEO Of Microsoft','published','2024-09-18 03:10:22','2024-09-18 03:10:22'),(2,'Retha Deowalim','Exceeded expectations in every way. Elegant rooms, delectable dining. Our stay was pure perfection. 5 stars!\"','testimonials/02.png','CEO Of Apple','published','2024-09-18 03:10:22','2024-09-18 03:10:22'),(3,'Sam J. Wasim','Paradise found. Serene ambiance, exceptional amenities, and warm hospitality. Already planning our return!','testimonials/03.png','Pio Founder','published','2024-09-18 03:10:22','2024-09-18 03:10:22'),(4,'Daniel Rodriguez','An exceptional experience from start to finish. The attention to detail, combined with breathtaking surroundings.','testimonials/04.png','VP Of Google','published','2024-09-18 03:10:22','2024-09-18 03:10:22'),(5,'Daniel Chang','A true haven for relaxation. Every aspect of our stay, from the luxurious rooms to the exquisite dining, was exceptional.','testimonials/05.png','Founder Of SpaceX','published','2024-09-18 03:10:22','2024-09-18 03:10:22'),(6,'Isabella Russo','Indulgence at its finest. The blend of modern luxury and natural beauty exceeded our expectations, was exceptional.','testimonials/06.png','Fashion Designer','published','2024-09-18 03:10:22','2024-09-18 03:10:22');
/*!40000 ALTER TABLE `testimonials` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `testimonials_translations`
--

DROP TABLE IF EXISTS `testimonials_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `testimonials_translations` (
  `lang_code` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `testimonials_id` bigint unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci,
  `company` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`lang_code`,`testimonials_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `testimonials_translations`
--

LOCK TABLES `testimonials_translations` WRITE;
/*!40000 ALTER TABLE `testimonials_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `testimonials_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_meta`
--

DROP TABLE IF EXISTS `user_meta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_meta` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value` text COLLATE utf8mb4_unicode_ci,
  `user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_meta_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_meta`
--

LOCK TABLES `user_meta` WRITE;
/*!40000 ALTER TABLE `user_meta` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_meta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `first_name` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar_id` bigint unsigned DEFAULT NULL,
  `super_user` tinyint(1) NOT NULL DEFAULT '0',
  `manage_supers` tinyint(1) NOT NULL DEFAULT '0',
  `permissions` text COLLATE utf8mb4_unicode_ci,
  `last_login` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_username_unique` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'cecelia.oreilly@skiles.biz',NULL,'$2y$12$z9jiVaNX//QPYrjkJ7048eEPSX5X3TMf46UFWtZllQQtZmcvQQ8Um',NULL,'2024-09-18 03:10:23','2024-09-18 03:10:23','Amaya','Kulas','admin',NULL,1,1,NULL,NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `widgets`
--

DROP TABLE IF EXISTS `widgets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `widgets` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `widget_id` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sidebar_id` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `theme` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `position` tinyint unsigned NOT NULL DEFAULT '0',
  `data` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `widgets`
--

LOCK TABLES `widgets` WRITE;
/*!40000 ALTER TABLE `widgets` DISABLE KEYS */;
INSERT INTO `widgets` VALUES (1,'ContactInformationMenuWidget','footer_sidebar','riorelax',0,'{\"phone_number\":\"1800-121-3637\",\"email\":\"info@example.com\",\"address\":\"1247\\/Plot No. 39, 15th Phase,\\nLHB Colony, Kanpur\"}','2024-09-18 03:10:25','2024-09-18 03:10:25'),(2,'CustomMenuWidget','footer_sidebar','riorelax',1,'{\"id\":\"CustomMenuWidget\",\"name\":\"Our Links\",\"menu_id\":\"our-links\"}','2024-09-18 03:10:25','2024-09-18 03:10:25'),(3,'CustomMenuWidget','footer_sidebar','riorelax',2,'{\"id\":\"CustomMenuWidget\",\"name\":\"Our Services\",\"menu_id\":\"our-services\"}','2024-09-18 03:10:25','2024-09-18 03:10:25'),(4,'NewsletterWidget','footer_sidebar','riorelax',3,'{\"id\":\"NewsletterWidget\",\"title\":\"Subscribe To Our Newsletter\"}','2024-09-18 03:10:25','2024-09-18 03:10:25'),(5,'BlogSearchWidget','blog_sidebar','riorelax',1,'{\"id\":\"BlogSearchWidget\",\"name\":\"Blog Search\"}','2024-09-18 03:10:25','2024-09-18 03:10:25'),(6,'BlogSocialsWidget','blog_sidebar','riorelax',2,'{\"id\":\"BlogSocialsWidget\",\"name\":\"Blog Socials\"}','2024-09-18 03:10:25','2024-09-18 03:10:25'),(7,'BlogCategoriesWidget','blog_sidebar','riorelax',3,'{\"id\":\"BlogCategoriesWidget\",\"name\":\"Blog Categories\"}','2024-09-18 03:10:25','2024-09-18 03:10:25'),(8,'BlogPostsWidget','blog_sidebar','riorelax',4,'{\"id\":\"BlogPostsWidget\",\"name\":\"Blog Posts\",\"type\":\"recent\",\"limit\":5}','2024-09-18 03:10:25','2024-09-18 03:10:25'),(9,'BlogTagsWidget','blog_sidebar','riorelax',5,'{\"id\":\"BlogTagsWidget\",\"name\":\"Blog Tags\"}','2024-09-18 03:10:25','2024-09-18 03:10:25'),(10,'RoomContactWidget','room_sidebar','riorelax',0,'{\"id\":\"RoomContactWidget\",\"title\":\"If You Need Any Help Contact Us\",\"phone\":\"917052101786\"}','2024-09-18 03:10:25','2024-09-18 03:10:25'),(11,'RoomContactWidget','service_sidebar','riorelax',0,'{\"id\":\"RoomContactWidget\",\"title\":\"If You Need Any Help Contact Us\",\"phone\":\"917052101786\"}','2024-09-18 03:10:25','2024-09-18 03:10:25'),(12,'CheckAvailabilityForm','rooms_sidebar','riorelax',0,'{\"title\":\"Booking form\",\"id\":\"CheckAvailabilityForm\"}','2024-09-18 03:10:25','2024-09-18 03:10:25');
/*!40000 ALTER TABLE `widgets` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-09-18 17:10:29
