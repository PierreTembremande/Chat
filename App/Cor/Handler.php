<?php

declare(strict_types= 1);

namespace App\Cor;

use App\Routing\Request;

interface Handler
{
    public function setNext(Handler $handler): Handler;

    public function handle(Request $request): string;
}