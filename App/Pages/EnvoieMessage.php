<?php

declare(strict_types=1);

namespace App\Pages;


use App\Repository\MessageRepository;
use App\Routing\Middleware\RequestMiddleware;
use App\Routing\Operations\ControllerInterface;
use App\Routing\Operations\Post;
use Latte\Engine;


#[Post('/envmessage', 'message')]


class EnvoieMessage implements ControllerInterface
{

    use RequestMiddleware;

    public function __invoke(): string
    {

        $messages = new MessageRepository();
        $messages->save($this->request);
        
        $latte = new Engine();
        $latte->setTempDirectory(path: PROJECT_DIR . '/var/cache');
        
        return $latte->renderToString(PROJECT_DIR . '/templates/tchat.latte', $this->request);
    }
}
