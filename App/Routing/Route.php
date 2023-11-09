<?php

declare(strict_types=1);

namespace App\Routing;

use App\Exceptions\RouteInvalidException;
use App\Routing\Middleware\RequestMiddleware;
use App\Routing\RouteHandleInterface;
use App\Routing\Request;

class Route implements RouteHandleInterface
{
    public function __construct(private string $path, private string $name, private string $verbe, private string $ControllerClass)
    {

    }
    public function handle(Request $request): mixed
    {   

        if ($this->path === ($request->path) && $this->verbe === $request->verbe) {

            $className = $this->ControllerClass;
            $class= new $className();

            $reflection = new \ReflectionClass($className);
            if(in_array(RequestMiddleware::class, $reflection->getTraitNames())) {
                $class->setRequest($request);
            }
            return $class;
        }

        throw new RouteInvalidException("Route" . $this->name . "ne correspond pas à " . $request->path . "avec la methode" . $request->verbe);
    }
}
