<?php

declare(strict_types=1);

namespace App\Repository;

use App\Repository\RepositoryInterface;
use App\Security\User;

class PDORepository implements RepositoryInterface
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
    }
    public function save($object): void
    {
    }
    public function remove($object): void
    {
    }
}
