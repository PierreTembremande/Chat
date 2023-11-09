<?php

declare(strict_types= 1);

namespace App\Routing\Middleware;
use App\Routing\Request;

trait RequestMiddleware{
    private Request $request;

    public function setRequest(Request $request): void{
        $this->request = $request;
    }
}