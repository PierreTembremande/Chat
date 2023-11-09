<?php

declare(strict_types=1);

namespace App\Repository;

interface RepositoryInterface
{

    public function find(array $criteria): iterable;
    public function get($identifier): ?object;
    public function save($object);
    public function remove($object);
}
