CREATE TABLE IF NOT EXISTS `addresses` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `post_code` VARCHAR(250) NOT NULL,
    `street` VARCHAR(250) NOT NULL,
    `neighborhood` VARCHAR(250) NOT NULL,
    `city` VARCHAR(250) NOT NULL,
    `state` VARCHAR(250) NOT NULL,
    `type` VARCHAR(250) NOT NULL,
    `user_id` INT UNSIGNED NOT NULL,
    `created_at` TIMESTAMP NOT NULL,
    `updated_at` TIMESTAMP NOT NULL,
    `deleted_at` TIMESTAMP NULL,
    CONSTRAINT `fk_address_user` FOREIGN KEY (`user_id`) REFERENCES `users`(`id`)
) ENGINE = InnoDB;