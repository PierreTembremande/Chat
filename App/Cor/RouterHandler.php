<?php

declare(strict_types=1);

namespace App\Cor;

use App\Routing\Middleware\RequestMiddleware;
use App\Routing\Request;

class RouterHandler extends SecurityTool
{

    public function handle(Request $request): string
    {
        $router = new \App\Routing\Router();
        $controller = $router->getController($request);

        return $controller();
    }
}
