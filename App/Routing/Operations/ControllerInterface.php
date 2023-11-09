<?php

declare(strict_types=1);

namespace App\Routing\Operations;

interface ControllerInterface
{
    public function __invoke(): String;
}
