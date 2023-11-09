<?php

declare(strict_types= 1);

namespace App\Routing;

interface RouteHandleInterface{

    public function handle(Request $request): mixed;
}

