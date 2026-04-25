<?php

namespace Modules\Users\Setup;

use Mars\Extensions\Setup\Module;

class Setup extends Module
{
    public function install()
    {
        $this->app->db->query("
        CREATE TABLE IF NOT EXISTS `users` 
        (
            `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
            `status` TINYINT UNSIGNED NOT NULL DEFAULT 0,
            `activated` TINYINT UNSIGNED NOT NULL DEFAULT 0,
            `code` VARCHAR(255) NOT NULL,
            `code_crc32` INT UNSIGNED NOT NULL,
            `username` VARCHAR(255) NOT NULL,
            `username_crc32` INT UNSIGNED NOT NULL,
            `password` VARCHAR(255) NOT NULL,
            `email` VARCHAR(255) NOT NULL,
            `email_crc32` INT UNSIGNED NOT NULL,
            `registration_timestamp` INT UNSIGNED NOT NULL,
            `registration_ip` VARBINARY(16) NOT NULL,
            PRIMARY KEY (`id`),
            INDEX code_idx (`code_crc32`),
            INDEX username_idx (`username_crc32`),
            INDEX email_idx (`email_crc32`)
        )");

        $this->app->db->query("
        CREATE TABLE IF NOT EXISTS `users_activation_tokens` 
        (
            `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
            `user_id` INT UNSIGNED NOT NULL,
            `token` VARCHAR(255) NOT NULL,
            `expires_at` INT UNSIGNED NOT NULL,
            PRIMARY KEY (`id`),
            INDEX user_idx (`user_id`)
        )");


        $this->app->db->query("
        CREATE TABLE IF NOT EXISTS `users_login_tokens` 
        (
            `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
            `user_id` INT UNSIGNED NOT NULL,
            `selector` VARCHAR(255) NOT NULL,
            `selector_crc32` INT UNSIGNED NOT NULL,
            `token` VARCHAR(255) NOT NULL,
            `created_at` INT UNSIGNED NOT NULL,
            `expires_at` INT UNSIGNED NOT NULL,
            `ip` VARBINARY(16) NOT NULL,
            `user_agent` TEXT NOT NULL,
            PRIMARY KEY (`id`),
            INDEX selector_idx (`selector_crc32`),
            INDEX expires_idx (`expires_at`)
        )");


    }

    public function uninstall()
    {
        $this->app->db->query("DROP TABLE IF EXISTS `users`");
        $this->app->db->query("DROP TABLE IF EXISTS `users_activation_tokens`");
        $this->app->db->query("DROP TABLE IF EXISTS `users_login_tokens`");
    }
}
