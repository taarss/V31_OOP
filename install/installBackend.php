<?php
    include_once '../classes/db.class.php';
    class Install extends Db{
        public function installBackend(){
            $this->decryptCredentials();
            $dbname = $this->DATABASE_NAME;
            $sql = "
            CREATE TABLE `accessLevel` (
            `id` int(11) NOT NULL,
            `manage_products` int(11) NOT NULL DEFAULT 0,
            `manage_categories` int(11) NOT NULL DEFAULT 0,
            `manage_api` int(11) NOT NULL DEFAULT 0,
            `manage_accessLevel` int(11) NOT NULL DEFAULT 0
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
            
            CREATE TABLE `accounts` (
            `id` int(11) NOT NULL,
            `username` varchar(50) NOT NULL,
            `password` varchar(255) NOT NULL,
            `email` varchar(100) NOT NULL,
            `activation_code` varchar(50) DEFAULT '',
            `bio` varchar(256) DEFAULT '',
            `profile_pic` varchar(256) DEFAULT 'uploads/DefaultPP.png',
            `rememberme` varchar(255) DEFAULT '',
            `reset` varchar(50) DEFAULT '',
            `date_created` varchar(256) DEFAULT current_timestamp(),
            `isBanned` tinyint(1) DEFAULT 0,
            `adminLevel` int(1) NOT NULL DEFAULT 4,
            `isOnline` tinyint(1) DEFAULT 0,
            `last_heartbeat` date DEFAULT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
            
            CREATE TABLE `apiKey` (
            `id` int(11) NOT NULL,
            `apiKey` varchar(255) NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
            
            CREATE TABLE `apiLock` (
            `id` int(11) NOT NULL,
            `isLocked` tinyint(4) NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
            
            CREATE TABLE `categories` (
            `id` int(11) NOT NULL,
            `name` varchar(255) NOT NULL,
            `icon` varchar(255) NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
            
            CREATE TABLE `logs` (
            `id` int(11) NOT NULL,
            `log` text NOT NULL,
            `logDate` datetime NOT NULL DEFAULT current_timestamp()
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
            
            CREATE TABLE `products` (
            `id` int(11) NOT NULL,
            `name` varchar(255) NOT NULL,
            `price` varchar(10) NOT NULL,
            `isOnSale` tinyint(4) DEFAULT 0,
            `img` varchar(300) DEFAULT NULL,
            `description` text NOT NULL,
            `dateCreated` date NOT NULL DEFAULT current_timestamp(),
            `manufactur` varchar(300) NOT NULL,
            `type` varchar(10) NOT NULL,
            `saleValue` varchar(11) DEFAULT '0',
            `sex` varchar(10) NOT NULL DEFAULT 'unisex',
            `createdBy` int(11) NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
            
            CREATE TABLE `product_showcase` (
            `id` int(11) NOT NULL,
            `productId` int(11) NOT NULL DEFAULT 8
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
            
            ALTER TABLE `accessLevel`
            ADD PRIMARY KEY (`id`);
            
            ALTER TABLE `accounts`
            ADD PRIMARY KEY (`id`);

            ALTER TABLE `apiKey`
            ADD PRIMARY KEY (`id`);
            
            ALTER TABLE `apiLock`
            ADD PRIMARY KEY (`id`);
            
            ALTER TABLE `categories`
            ADD PRIMARY KEY (`id`);

            ALTER TABLE `logs`
            ADD PRIMARY KEY (`id`);
            
            ALTER TABLE `products`
            ADD PRIMARY KEY (`id`);
            
            ALTER TABLE `product_showcase`
            ADD PRIMARY KEY (`id`);
            
            ALTER TABLE `accessLevel`
            MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
            
            ALTER TABLE `accounts`
            MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
            
            ALTER TABLE `apiKey`
            MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
            
            ALTER TABLE `apiLock`
            MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
            
            ALTER TABLE `categories`
            MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
            
            ALTER TABLE `logs`
            MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
            
            ALTER TABLE `products`
            MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
            
            ALTER TABLE `product_showcase`
            MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute(); 
        }     
    }
    