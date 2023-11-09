<?php

declare(strict_types=1);

namespace App\Pages;
use App\Routing\Operations\Get;
use App\Routing\Operations\ControllerInterface;

#[Get(path: '/Error', name: 'Error404')]
class Error404 implements ControllerInterface
{
    public function __invoke(): string
    {
        return 'Erreur 404';
    }
}
