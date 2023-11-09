<?php

declare(strict_types=1);

namespace App\Routing;

use App\Exceptions\RouteInvalidException;
use App\Routing\RouteHandleInterface;
use App\Pages\Error404;
use App\Routing\Operations\ControllerInterface;

class RouteMatcher implements RouteHandleInterface
{
    private array $routes = [];
    public function handle(Request $request): mixed
    {

        foreach ($this->routes as $route) {
            try {
                
                return $route->handle($request);
            } catch (RouteInvalidException $e) {
                // TODO write log
            }
        }

        return new Error404();
    }

    public function addRoute(Route $route): void
    {
        $this->routes[] = $route;
    }
}
