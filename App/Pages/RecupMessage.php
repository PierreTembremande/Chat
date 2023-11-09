<?php

declare(strict_types=1);

namespace App\Pages;


use App\Routing\Middleware\RequestMiddleware;
use App\Routing\Operations\ControllerInterface;
use App\Routing\Operations\Get;
use Latte\Engine;


#[Get('/recmessage', 'message')]


class RecupMessage implements ControllerInterface
{

    use RequestMiddleware;

    public function __invoke(): string
    {


        
        $latte = new Engine();
        $latte->setTempDirectory(path: PROJECT_DIR . '/var/cache');

        return $latte->renderToString(PROJECT_DIR . '/templates/tchat.latte', $this->request);
    }
}
