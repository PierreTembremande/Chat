<?php

declare(strict_types=1);

namespace App\Pages;

use App\Routing\Operations\Get;
use App\Routing\Operations\ControllerInterface;
use Latte\Engine;

#[Get(path: '/register', name: 'Register')]
class Register implements ControllerInterface
{
    public function __invoke(): string
    {

        $latte = new Engine();
        $latte->setTempDirectory(path: PROJECT_DIR . '/var/cache');

        return $latte->renderToString(name: PROJECT_DIR . '/templates/register.latte');
    }
}
