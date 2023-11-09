<?php

declare(strict_types= 1);

namespace App\Cor;

use App\Routing\Request;

class RequestHandler extends SecurityTool{

    public function __construct(){
        $this
            ->setNext(new SecurityHandler())
            ->setNext(new RouterHandler());
    }
}