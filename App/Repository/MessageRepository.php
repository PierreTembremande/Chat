<?php

declare(strict_types=1);

namespace App\Repository;

use App\Security\User;

class MessageRepository extends PDORepository
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
        $statement = $this->pdo->prepare('SELECT * FROM `message`;');
        // $statement->bindParam(':username', $identifier);

        $statement->execute();

        if (false === $result = $statement->fetch()) {
            return null;
        };

        var_dump($result);
        return $result;
    }
    public function save($object): void

    {
        try {
            $this->pdo->beginTransaction();

            $statement = $this->pdo->prepare('INSERT INTO `message` (me_user, me_contenu, me_groupe) VALUES (:username,:contenu, "All");');
            ['user'=> $username, 'path' => $contenu] = (array) $object;
            $username= $username['username'];
            $contenu = $contenu['verbe'];
            
            var_dump($contenu);

            $statement->bindParam(':username', $username);
            $statement->bindParam(':contenu', $contenu);

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
