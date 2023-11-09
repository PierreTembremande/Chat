<?php

declare(strict_types=1);

$pdo = new \PDO('sqlite:' . __DIR__ . '/../var/db');


$pdo->exec('CREATE TABLE IF NOT EXISTS `user` (username VARCHAR(255) NOT NULL PRIMARY KEY, password VARCHAR(72) NOT NULL);');
$pdo->exec('CREATE TABLE IF NOT EXISTS `groupe` ( gr_id INTEGER NOT NULL PRIMARY KEY, gr_name VARCHAR(255) NOT NULL);');
$pdo->exec('CREATE TABLE IF NOT EXISTS `message` (me_id INTEGER NOT NULL PRIMARY KEY, me_user VARCHAR(255) NOT NULL, me_contenu VARCHAR(255) NOT NULL, me_groupe INTEGER NOT NULL,FOREIGN KEY (me_user) REFERENCES user(username),FOREIGN KEY (me_groupe) REFERENCES groupe(gr_id)) ;');
$pdo->exec('CREATE TABLE IF NOT EXISTS `usergroupe` (ug_id INTEGER NOT NULL  PRIMARY KEY, ug_user VARCHAR(255) NOT NULL, ug_groupe INTEGER NOT NULL,FOREIGN KEY (ug_user)REFERENCES user(username),FOREIGN KEY (ug_groupe) REFERENCES groupe(gr_id));');
