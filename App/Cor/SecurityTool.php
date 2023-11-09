<?php

declare(strict_types= 1);

namespace App\Cor;

use App\Routing\Request;

abstract class SecurityTool implements Handler{

    private $nextHandler = null;

    public function setNext(Handler $handler): Handler
    {
        $this->nextHandler = $handler;
        return $handler;
    }

    public function handle(Request $request): string
    {
        if ($this->nextHandler) {
            return $this->nextHandler->handle($request);
        }

        header("HTTP/1.1 404 Not Found");
        return '';
    }

}