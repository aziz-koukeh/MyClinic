-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 16, 2024 at 10:11 AM
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
-- Database: `myclinicapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `message` longtext NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `device_checks`
--

CREATE TABLE `device_checks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `userName` varchar(255) DEFAULT NULL,
  `ip` varchar(255) DEFAULT NULL,
  `userAgent` longtext DEFAULT NULL,
  `deviceType` varchar(255) DEFAULT NULL,
  `deviceFamily` varchar(255) DEFAULT NULL,
  `deviceModel` varchar(255) DEFAULT NULL,
  `platformName` varchar(255) DEFAULT NULL,
  `browserName` varchar(255) DEFAULT NULL,
  `browserEngine` varchar(255) DEFAULT NULL,
  `root` tinyint(3) UNSIGNED NOT NULL,
  `state` tinyint(3) UNSIGNED DEFAULT NULL,
  `browser_state` tinyint(3) UNSIGNED DEFAULT NULL,
  `doctor_id` int(10) UNSIGNED NOT NULL,
  `last_seen` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `doctor_infos`
--

CREATE TABLE `doctor_infos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `university` varchar(255) DEFAULT NULL,
  `med_specialty` longtext DEFAULT NULL,
  `bio` longtext DEFAULT NULL,
  `exp_work_year` varchar(255) DEFAULT NULL,
  `exp_about` varchar(255) DEFAULT NULL,
  `v_wages` bigint(20) DEFAULT NULL,
  `rev_wages` bigint(20) DEFAULT NULL,
  `em_wages` bigint(20) DEFAULT NULL,
  `facepage` longtext DEFAULT NULL,
  `whatsapp` longtext DEFAULT NULL,
  `telegram` longtext DEFAULT NULL,
  `instagram` longtext DEFAULT NULL,
  `youtube` longtext DEFAULT NULL,
  `twitter` longtext DEFAULT NULL,
  `linked_in` longtext DEFAULT NULL,
  `address` longtext DEFAULT NULL,
  `map_emb` longtext DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `lockWebSite` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `opentime` time DEFAULT NULL,
  `closetime` time DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `doctor_infos`
--

INSERT INTO `doctor_infos` (`id`, `user_id`, `university`, `med_specialty`, `bio`, `exp_work_year`, `exp_about`, `v_wages`, `rev_wages`, `em_wages`, `facepage`, `whatsapp`, `telegram`, `instagram`, `youtube`, `twitter`, `linked_in`, `address`, `map_emb`, `password`, `lockWebSite`, `opentime`, `closetime`, `created_at`, `updated_at`) VALUES
(1, 1, 'pgf', 'ئءؤرلاى', NULL, '1', 'سي', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$jnEWR.Bbp6vBWYsCV9HtDuFjNLP2jwUvBfVey9RoZdqTi8vTyPAQG', 0, NULL, NULL, '2024-02-18 18:49:11', '2024-05-16 16:03:05');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2023_11_03_081342_create_patients_table', 1),
(5, '2023_11_03_081422_create_patient_reviews_table', 1),
(6, '2023_11_03_081508_create_patient_review_media_table', 1),
(7, '2023_11_03_085421_create_doctor_infos_table', 1),
(8, '2023_11_29_062514_create_prevs_table', 1),
(9, '2023_11_29_173410_create_contact_us_table', 1),
(10, '2023_12_15_093047_create_notificates_table', 1),
(11, '2023_12_21_070512_create_tasks_table', 1),
(12, '2024_02_08_082021_create_device_checks_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notificates`
--

CREATE TABLE `notificates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `forUser_id` int(10) UNSIGNED DEFAULT NULL,
  `forGroup_id` int(10) UNSIGNED DEFAULT NULL,
  `notify_type` varchar(255) NOT NULL,
  `mainMassage` varchar(255) NOT NULL,
  `connect` varchar(255) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `patient_slug` varchar(255) NOT NULL,
  `patient_name` varchar(255) NOT NULL,
  `age` int(11) DEFAULT NULL,
  `blood_type` varchar(255) DEFAULT NULL,
  `gender` varchar(255) NOT NULL,
  `smoking` varchar(255) DEFAULT NULL,
  `relationship` varchar(255) DEFAULT NULL,
  `child_count` int(11) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `older_surgery` longtext DEFAULT 'لا يوجد',
  `older_sicky` longtext DEFAULT 'لا يوجد',
  `older_sensitive` longtext DEFAULT 'لا يوجد',
  `permanent_medic` longtext DEFAULT 'لا يوجد',
  `patient_state` longtext DEFAULT 'لا يوجد',
  `patient_address` varchar(255) DEFAULT NULL,
  `patient_job` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT 'uploads/home/3.jpg',
  `account` bigint(20) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`id`, `user_id`, `patient_slug`, `patient_name`, `age`, `blood_type`, `gender`, `smoking`, `relationship`, `child_count`, `phone`, `older_surgery`, `older_sicky`, `older_sensitive`, `permanent_medic`, `patient_state`, `patient_address`, `patient_job`, `photo`, `account`, `deleted_at`, `created_at`, `updated_at`) VALUES
(23, 1, '69704638-e7f7-401f-bede-3c43f2772921', 'محمد محمد', 1972, '', 'male', 'positive', 'married', 3, '0326598', 'صثقفغعتن -شسيبلا -سيبلاة ي-سيبلبللا- سيبلى- بل-يب- صسقلات', '', '', '', '', '', '', 'uploads/home/3.jpg', NULL, NULL, '2024-07-31 08:32:39', '2024-07-31 09:02:55'),
(26, 1, 'f7a13b98-28a9-417a-bb0e-53b070ef9832', 'عبد الله خالد', 1979, '', 'male', '', '', NULL, NULL, '', '', '', '', '', '', '', 'uploads/home/3.jpg', NULL, NULL, '2024-07-31 08:58:16', '2024-07-31 08:58:16'),
(27, 1, '6165d799-1f4e-47d3-aaf9-f8479696e455', 'مصطفى حريري', NULL, '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', 'uploads/home/3.jpg', NULL, NULL, '2024-07-31 09:54:21', '2024-07-31 09:54:21'),
(36, 1, '67a42d75-8815-482b-ad0e-d46e9589daf8', 'محمد', NULL, '', 'male', '', '', NULL, NULL, '', '', '', '', '', '', '', 'uploads/home/3.jpg', NULL, NULL, '2024-07-31 10:18:04', '2024-07-31 10:19:03');

-- --------------------------------------------------------

--
-- Table structure for table `patient_reviews`
--

CREATE TABLE `patient_reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `patient_id` bigint(20) UNSIGNED NOT NULL,
  `patient_review_id` int(10) UNSIGNED DEFAULT NULL,
  `doctor_id` int(10) UNSIGNED DEFAULT NULL,
  `done` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `special_with_star` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `leave_off` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `review_type` varchar(255) NOT NULL,
  `main_complaint` longtext DEFAULT NULL,
  `med_analysis_T` longtext DEFAULT NULL,
  `med_photo_T` longtext DEFAULT NULL,
  `pain_story` longtext DEFAULT NULL,
  `medical_report` longtext DEFAULT NULL,
  `treatment_plan` longtext DEFAULT NULL,
  `doctor_notes` longtext DEFAULT NULL,
  `date_expecting` timestamp NULL DEFAULT NULL,
  `review_forDay` timestamp NULL DEFAULT NULL,
  `wages` bigint(20) DEFAULT 0,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `patient_reviews`
--

INSERT INTO `patient_reviews` (`id`, `patient_id`, `patient_review_id`, `doctor_id`, `done`, `special_with_star`, `leave_off`, `review_type`, `main_complaint`, `med_analysis_T`, `med_photo_T`, `pain_story`, `medical_report`, `treatment_plan`, `doctor_notes`, `date_expecting`, `review_forDay`, `wages`, `deleted_at`, `created_at`, `updated_at`) VALUES
(34, 23, NULL, 1, 1, 0, 1, 'معاينة', 'معاينة جديدة', '', '', '', 'est', 'awertyu', NULL, NULL, NULL, NULL, NULL, '2024-07-31 08:32:39', '2024-07-31 09:12:53'),
(37, 26, NULL, 1, 1, 0, 1, 'معاينة', 'معاينة جديدة', '', '', '', 'qwerty', 'werty', NULL, NULL, NULL, NULL, NULL, '2024-07-31 08:58:17', '2024-07-31 09:11:11'),
(39, 27, NULL, 1, 1, 1, 1, 'معاينة', 'معاينة جديدة', '', '', '', 'ضصثق', 'ضصثقفغ', NULL, NULL, NULL, NULL, NULL, '2024-07-31 09:54:21', '2024-07-31 09:56:37'),
(50, 36, NULL, 1, 0, 0, 0, 'معاينة', 'معاينة جديدة', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-31 21:00:00', 0, NULL, '2024-07-31 10:18:04', '2024-07-31 10:23:58'),
(52, 36, NULL, 1, 1, 0, 1, 'معاينة', 'معاينة جديدة', '', '', '', 'صثقفغعه', 'صثقفغعهخ', NULL, NULL, NULL, NULL, NULL, '2024-07-31 10:21:19', '2024-07-31 10:21:33');

-- --------------------------------------------------------

--
-- Table structure for table `patient_review_media`
--

CREATE TABLE `patient_review_media` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `patient_reviews_id` bigint(20) UNSIGNED NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `file_type` varchar(255) DEFAULT NULL,
  `file_size` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `prevs`
--

CREATE TABLE `prevs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `addPatient` tinyint(3) UNSIGNED NOT NULL DEFAULT 1,
  `editPatient` tinyint(3) UNSIGNED NOT NULL DEFAULT 1,
  `deletePatient` tinyint(3) UNSIGNED NOT NULL DEFAULT 1,
  `destroyPatient` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `addReview` tinyint(3) UNSIGNED NOT NULL DEFAULT 1,
  `editReview` tinyint(3) UNSIGNED NOT NULL DEFAULT 1,
  `deleteReview` tinyint(3) UNSIGNED NOT NULL DEFAULT 1,
  `destroyReview` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `addUser` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `editUser` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `destroyUser` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `givePrev` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `changeClinicSettings` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `showPatientsAccounts` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `slug` char(36) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `forUser_id` int(10) UNSIGNED DEFAULT NULL,
  `forGroup_id` int(10) UNSIGNED DEFAULT NULL,
  `doneByUser_id` int(10) UNSIGNED DEFAULT NULL,
  `contant` longtext NOT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `forDay` timestamp NULL DEFAULT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `user_image` varchar(255) DEFAULT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `d_o_e` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `a_d` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `first_visit` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `receive_email` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `doctor_id` int(10) UNSIGNED DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `gender`, `email`, `mobile`, `email_verified_at`, `password`, `user_image`, `status`, `d_o_e`, `a_d`, `first_visit`, `receive_email`, `doctor_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'طارق دعاس', 'Dr_Tarek_Daas', 'male', '', '', '2024-02-18 18:49:10', '$2y$10$4zyWeyvcs6zJpxbA.25Sie3.ixNSYQO12C5STRXtTHJbcVHKT9Nmu', 'dr-tarek-daas.jpg', 1, 1, 1, 0, 0, 1, NULL, '2024-02-18 18:49:10', '2024-07-31 09:02:12'),
(2, 'العيادة', 'my_clinic', 'female', '', '', NULL, '$2y$10$tlSKuDhYWoc91aSKTJqYH.M1yOj.3ZugGbrxUv7qD7BDWBLhx5eJC', 'my-clinic.png', 0, 0, 0, 0, 0, 1, NULL, '2024-02-18 18:56:20', '2024-07-31 07:41:42');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contact_us_user_id_foreign` (`user_id`);

--
-- Indexes for table `device_checks`
--
ALTER TABLE `device_checks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctor_infos`
--
ALTER TABLE `doctor_infos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `doctor_infos_user_id_foreign` (`user_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notificates`
--
ALTER TABLE `notificates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notificates_user_id_foreign` (`user_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `patients_patient_slug_unique` (`patient_slug`),
  ADD UNIQUE KEY `patients_phone_unique` (`phone`),
  ADD KEY `patients_user_id_foreign` (`user_id`),
  ADD KEY `patients_patient_name_index` (`patient_name`),
  ADD KEY `patients_age_index` (`age`),
  ADD KEY `patients_gender_index` (`gender`);

--
-- Indexes for table `patient_reviews`
--
ALTER TABLE `patient_reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patient_reviews_patient_id_foreign` (`patient_id`),
  ADD KEY `patient_reviews_main_complaint_index` (`main_complaint`(768)),
  ADD KEY `patient_reviews_pain_story_index` (`pain_story`(768)),
  ADD KEY `patient_reviews_medical_report_index` (`medical_report`(768)),
  ADD KEY `patient_reviews_treatment_plan_index` (`treatment_plan`(768));

--
-- Indexes for table `patient_review_media`
--
ALTER TABLE `patient_review_media`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patient_review_media_patient_reviews_id_foreign` (`patient_reviews_id`);

--
-- Indexes for table `prevs`
--
ALTER TABLE `prevs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `prevs_user_id_foreign` (`user_id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tasks_slug_unique` (`slug`),
  ADD KEY `tasks_user_id_foreign` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `device_checks`
--
ALTER TABLE `device_checks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `doctor_infos`
--
ALTER TABLE `doctor_infos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `notificates`
--
ALTER TABLE `notificates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `patient_reviews`
--
ALTER TABLE `patient_reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `patient_review_media`
--
ALTER TABLE `patient_review_media`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `prevs`
--
ALTER TABLE `prevs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD CONSTRAINT `contact_us_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `doctor_infos`
--
ALTER TABLE `doctor_infos`
  ADD CONSTRAINT `doctor_infos_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `notificates`
--
ALTER TABLE `notificates`
  ADD CONSTRAINT `notificates_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `patients`
--
ALTER TABLE `patients`
  ADD CONSTRAINT `patients_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `patient_reviews`
--
ALTER TABLE `patient_reviews`
  ADD CONSTRAINT `patient_reviews_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `patient_review_media`
--
ALTER TABLE `patient_review_media`
  ADD CONSTRAINT `patient_review_media_patient_reviews_id_foreign` FOREIGN KEY (`patient_reviews_id`) REFERENCES `patient_reviews` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `prevs`
--
ALTER TABLE `prevs`
  ADD CONSTRAINT `prevs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
