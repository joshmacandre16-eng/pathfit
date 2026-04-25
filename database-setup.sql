-- PathFit Database Auto-Setup Script
-- Run this script to create tables and insert seed data

-- Use the pathfit database
USE pathfit;

-- ============================================
-- MIGRATION: Create users table
-- ============================================
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `fname` varchar(255) DEFAULT NULL,
  `mname` varchar(255) DEFAULT NULL,
  `lname` varchar(255) DEFAULT NULL,
  `course` varchar(255) DEFAULT NULL,
  `gender` enum('male','female','other') DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('Admin','Coach','Athlete') NOT NULL DEFAULT 'Athlete',
  `photo` varchar(255) DEFAULT NULL,
  `coach_id` bigint(20) unsigned DEFAULT NULL,
  `specialization` varchar(255) DEFAULT NULL,
  `experience` text DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_coach_id_foreign` (`coach_id`),
  CONSTRAINT `users_coach_id_foreign` FOREIGN KEY (`coach_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- MIGRATION: Create activity_reports table
-- ============================================
CREATE TABLE IF NOT EXISTS `activity_reports` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `activity_date` date NOT NULL,
  `activity_type` enum('training','competition','practice','recovery','other') NOT NULL,
  `duration` int(11) NOT NULL,
  `description` text NOT NULL,
  `performance_rating` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `activity_reports_user_id_foreign` (`user_id`),
  CONSTRAINT `activity_reports_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- SEED DATA: Users
-- ============================================
INSERT IGNORE INTO `users` (`id`, `name`, `fname`, `mname`, `lname`, `course`, `gender`, `email`, `password`, `role`, `created_at`, `updated_at`) VALUES
(1, 'Admin User', 'Admin', NULL, 'User', 'Administration', 'male', 'admin@pathfit.com', '$2y$12$LQv3c1yycaGdCgzgGrf7iuydReuFcm5mcFe.Cg5Lig9OoQfaS64bC', 'Admin', NOW(), NOW()),
(2, 'Coach Michael Johnson', 'Michael', 'James', 'Johnson', 'Sports Science', 'male', 'coach.johnson@pathfit.com', '$2y$12$LQv3c1yycaGdCgzgGrf7iuydReuFcm5mcFe.Cg5Lig9OoQfaS64bC', 'Coach', NOW(), NOW()),
(3, 'Coach Sarah Williams', 'Sarah', 'Marie', 'Williams', 'Physical Education', 'female', 'coach.williams@pathfit.com', '$2y$12$LQv3c1yycaGdCgzgGrf7iuydReuFcm5mcFe.Cg5Lig9OoQfaS64bC', 'Coach', NOW(), NOW()),
(4, 'John Doe Smith', 'John', 'Doe', 'Smith', 'Computer Science', 'male', 'john.smith@pathfit.com', '$2y$12$LQv3c1yycaGdCgzgGrf7iuydReuFcm5mcFe.Cg5Lig9OoQfaS64bC', 'Athlete', NOW(), NOW()),
(5, 'Emma Rose Davis', 'Emma', 'Rose', 'Davis', 'Business Administration', 'female', 'emma.davis@pathfit.com', '$2y$12$LQv3c1yycaGdCgzgGrf7iuydReuFcm5mcFe.Cg5Lig9OoQfaS64bC', 'Athlete', NOW(), NOW()),
(6, 'Alex Taylor Brown', 'Alex', 'Taylor', 'Brown', 'Engineering', 'male', 'alex.brown@pathfit.com', '$2y$12$LQv3c1yycaGdCgzgGrf7iuydReuFcm5mcFe.Cg5Lig9OoQfaS64bC', 'Athlete', NOW(), NOW()),
(7, 'Lisa Ann Wilson', 'Lisa', 'Ann', 'Wilson', 'Psychology', 'female', 'lisa.wilson@pathfit.com', '$2y$12$LQv3c1yycaGdCgzgGrf7iuydReuFcm5mcFe.Cg5Lig9OoQfaS64bC', 'Athlete', NOW(), NOW()),
(8, 'David Lee Garcia', 'David', 'Lee', 'Garcia', 'Marketing', 'male', 'david.garcia@pathfit.com', '$2y$12$LQv3c1yycaGdCgzgGrf7iuydReuFcm5mcFe.Cg5Lig9OoQfaS64bC', 'Athlete', NOW(), NOW()),
(9, 'Coach Robert Martinez', 'Robert', 'Carlos', 'Martinez', 'Kinesiology', 'male', 'coach.martinez@pathfit.com', '$2y$12$LQv3c1yycaGdCgzgGrf7iuydReuFcm5mcFe.Cg5Lig9OoQfaS64bC', 'Coach', NOW(), NOW()),
(10, 'Sophie Grace Anderson', 'Sophie', 'Grace', 'Anderson', 'Nursing', 'female', 'sophie.anderson@pathfit.com', '$2y$12$LQv3c1yycaGdCgzgGrf7iuydReuFcm5mcFe.Cg5Lig9OoQfaS64bC', 'Athlete', NOW(), NOW());

-- ============================================
-- SEED DATA: Activity Reports
-- ============================================
INSERT IGNORE INTO `activity_reports` (`user_id`, `activity_date`, `activity_type`, `duration`, `description`, `performance_rating`, `created_at`, `updated_at`) VALUES
(4, '2024-02-10', 'training', 120, 'Focused on shooting drills and defensive positioning. Improved free throw accuracy by 15%.', 8, NOW(), NOW()),
(5, '2024-02-11', 'practice', 90, 'Worked on freestyle technique and endurance. Completed 2000m without stopping.', 9, NOW(), NOW()),
(6, '2024-02-12', 'training', 150, 'Strength and agility training. Improved sprint times and ball control skills.', 7, NOW(), NOW()),
(7, '2024-02-13', 'competition', 180, 'Competitive match practice. Won 2 out of 3 sets with improved serve consistency.', 8, NOW(), NOW()),
(8, '2024-02-14', 'training', 75, 'Speed work and technique refinement. Personal best in 100m sprint.', 10, NOW(), NOW()),
(4, '2024-02-15', 'practice', 135, 'Team coordination drills and spiking practice. Excellent teamwork displayed.', 9, NOW(), NOW()),
(5, '2024-02-16', 'training', 100, 'Footwork and racket technique improvement. Better court coverage achieved.', 7, NOW(), NOW()),
(6, '2024-02-17', 'training', 110, 'Heavy bag training and sparring session. Improved punch combinations.', 8, NOW(), NOW()),
(7, '2024-02-18', 'practice', 95, 'Traditional forms practice and meditation. Excellent focus and technique.', 9, NOW(), NOW()),
(8, '2024-02-19', 'training', 160, 'Multi-discipline workout combining cardio, strength, and flexibility training.', 8, NOW(), NOW());

-- ============================================
-- Verification Queries
-- ============================================
SELECT 'Users Table' AS 'Table', COUNT(*) AS 'Records' FROM users
UNION ALL
SELECT 'Activity Reports Table', COUNT(*) FROM activity_reports;

-- Password for all users: password123
