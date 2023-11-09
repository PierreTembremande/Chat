<?php

declare(strict_types=1);

namespace App\Routing;

use App\Pages\Error404;
use App\Routing\Operations\ControllerInterface;
use App\Routing\Operations\OperationInterface;

class Router
{
    private  RouteMatcher $routeMatcher;

    public function __construct()
    {
        $this->routeMatcher = new RouteMatcher();
        $this->initRoutes();
    }

    public function getController(Request $request): ControllerInterface
    {
        return $this->routeMatcher->handle($request);
    }

    public function initRoutes()
    {

        foreach (scandir(PROJECT_DIR . '/App/Pages') ?? [] as $file) {
            if (in_array($file, ['.', '..'])) {
                continue;
            };

            $className = substr($file, 0, -4);
            $controllerReflexion = new \ReflectionClass("App\\Pages\\$className");

            foreach ($controllerReflexion->getAttributes() as $attribute) {
                $operation = $attribute->newInstance();
                if (!$operation instanceof OperationInterface) {
                    continue;
                }

                $this->routeMatcher->addRoute(new Route(path: $operation->path, name: $operation->name, verbe: $operation->verbe, ControllerClass: "App\\Pages\\$className"));
            }
        }
    }
}
