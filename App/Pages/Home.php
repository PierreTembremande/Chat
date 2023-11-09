<?php

declare(strict_types=1);

namespace App\Pages;

use App\Routing\Middleware\RequestMiddleware;
use App\Routing\Operations\Get;
use App\Routing\Operations\ControllerInterface;
use Latte\Engine;
use App\Security\Authentification;
use App\Security\Authorisation;

#[Get(path: '/', name: 'Home')]
class Home implements ControllerInterface
{
    use RequestMiddleware;
    public function __invoke(): string
    {

        $authorisation = new Authorisation();
        // $authorisation->authorize($this->request);

        $latte = new Engine();
        $latte->setTempDirectory(path: PROJECT_DIR . '/var/cache');

        return $latte->renderToString(PROJECT_DIR . '/templates/home.latte', ['user' => $this->request->user]);
    }
}
