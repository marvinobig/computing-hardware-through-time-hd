ALTER DATABASE `chtt_db` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;


CREATE TABLE IF NOT EXISTS `admin_users` (
  `id` integer PRIMARY KEY AUTO_INCREMENT NOT NULL,
  `username` varchar(255) UNIQUE NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS `hardware` (
  `id` integer PRIMARY KEY AUTO_INCREMENT NOT NULL,
  `views` integer NOT NULL DEFAULT 0,
  `image_url` text NOT NULL,
  `name` varchar(255) UNIQUE NOT NULL,
  `type` varchar(255) NOT NULL,
  `manufacturer` varchar(255) NOT NULL,
  `summary` text NOT NULL,
  `details` text NOT NULL,
  `price_at_release` float NOT NULL,
  `status` varchar(255) NOT NULL,
  `user_id` integer NOT NULL,
  `release_date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS `user_activity` (
  `id` integer PRIMARY KEY AUTO_INCREMENT NOT NULL,
  `admin_username` varchar(255) NOT NULL,
  `action_type` varchar(255) COMMENT 'e.g. Create, Update, Delete' NOT NULL,
  `hardware_name` varchar(255) NOT NULL,
  `happened_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
);

ALTER TABLE `hardware` ADD FOREIGN KEY (`user_id`) REFERENCES `admin_users` (`id`);
