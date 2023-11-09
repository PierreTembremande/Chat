<?php

declare(strict_types= 1);

$pdo = new \PDO('sqlite:'.__DIR__.'/../var/db');


$pdo->exec('CREATE TABLE IF NOT EXISTS `user` (username VARCHAR(255) NOT NULL PRIMARY KEY, password VARCHAR(72) NOT NULL);');