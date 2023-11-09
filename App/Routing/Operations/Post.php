<?php

declare(strict_types=1);

namespace App\Routing\Operations;

#[\Attribute(\Attribute::TARGET_CLASS)]

class Post implements OperationInterface
{


    private string $controllerClass;
    public function __construct(
        public readonly string $path,
        public readonly string $name,
        public readonly string $verbe = 'POST',
    ) {
    }

    public function getControllerClass(): string{
        return $this->controllerClass;
    }

    public function setControllerClass(string $controllerClass): void{
        $this->controllerClass = $controllerClass;
    }
}

