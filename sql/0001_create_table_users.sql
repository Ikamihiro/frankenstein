CREATE TABLE IF NOT EXISTS `users` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `first_name` VARCHAR(250) NOT NULL,
    `last_name` VARCHAR(250) NOT NULL,
    `phone` VARCHAR(100) NOT NULL,
    `document` VARCHAR(12) NOT NULL,
    `birth_date` TIMESTAMP NOT NULL,
    `created_at` TIMESTAMP NOT NULL,
    `updated_at` TIMESTAMP NOT NULL,
    `deleted_at` TIMESTAMP NULL
    -- CONSTRAINT `uc_document` UNIQUE (`document`)
) ENGINE = InnoDB;