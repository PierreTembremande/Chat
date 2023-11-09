<?php

declare(strict_types= 1);

namespace App\Security;

class User{

    public function __construct(public readonly string $username, public readonly string $password){

    }
}