<?php

namespace Modules\Users\Setup;

use Mars\Extensions\Setup\Module;

class Setup extends Module
{
    public function install()
    {
        $sql = "
        CREATE TABLE IF NOT EXISTS `users` 
        (
            `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
            `status` TINYINT UNSIGNED NOT NULL DEFAULT 0,
            `activated` TINYINT UNSIGNED NOT NULL DEFAULT 0,
            `username` VARCHAR(255) NOT NULL,
            `username_crc32` INT UNSIGNED NOT NULL,
            `password` VARCHAR(255) NOT NULL,
            `email` VARCHAR(255) NOT NULL,
            `email_crc32` INT UNSIGNED NOT NULL,
            `activation_code` VARCHAR(64) NOT NULL,
            `registration_timestamp` INT UNSIGNED NOT NULL,
            `registration_ip` VARBINARY(16) NOT NULL,
            PRIMARY KEY (`id`),
            INDEX username_idx (`username_crc32`),
            INDEX email_idx (`email_crc32`)
        )";

        $this->app->db->query($sql);
    }

    public function uninstall()
    {
        $sql = "DROP TABLE IF EXISTS `users`";
        
        $this->app->db->query($sql);
    }
}
