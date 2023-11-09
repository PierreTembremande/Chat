<?php

declare(strict_types=1);

namespace App\Repository;

use App\Security\User;

class UserRepository extends PDORepository
{
    protected \PDO $pdo;
    public function __construct()
    {

        $this->pdo = new \PDO(DB_DSN);
    }

    public function find(array $criteria): iterable
    {
    }
    public function get($identifier): ?object
    {

        $statement = $this->pdo->prepare('SELECT * FROM `user` WHERE username = :username;');
        $statement->bindParam(':username', $identifier);

        $statement->execute();

        if (false === $result = $statement->fetch()) {
            return null;
        };


        return new User($result['username'], $result['password']);
    }
    public function save($object): void
    {
        try {
            $this->pdo->beginTransaction();

            $statement = $this->pdo->prepare('INSERT INTO `user` VALUES (:username, :password)');
            ['username' => $username, 'password' => $password] = (array) $object;
            $statement->bindParam(':username', $username);
            $statement->bindParam(':password', $password);

            $statement->execute();

            $this->pdo->commit();

            $statement=$this->pdo->prepare('INSERT INTO `usergroupe`(ug_user,ug_groupe) VALUES(:username,"All");');
            ['username' => $username] = (array) $object;
            $statement->bindParam(':username:',$username);

            $statement->execute();
            $this->pdo->commit();

            $statement=$this->pdo->prepare('INSERT INTO `usergroupe`(ug_user,ug_groupe) VALUES(:username,:groupename);');
            ['username' => $username] = (array) $object;
            $statement->bindParam(':username:',$username);
            $statement->bindParam(':groupename', $groupeName);

            $statement->execute();
            $this->pdo->commit();



        } catch (\PDOException $e) {
            $this->pdo->rollBack();
        }
    }
    public function remove($object): void
    {
    }
}
