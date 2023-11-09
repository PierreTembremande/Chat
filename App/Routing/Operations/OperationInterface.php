<?php

declare(strict_types=1);

namespace App\Routing\Operations;

interface OperationInterface
{
    public function getControllerClass(): string;

    public function setControllerClass(string $controllerClass): void;
}