<?php

declare(strict_types=1);

namespace App\Security;

use App\Repository\UserRepository;
use App\Security\Credentials;
use App\Routing\Request;
use App\Exceptions\AuthentifiactionException;

class Authentification
{


    public const IN_MEMORY_USERS = [];

    public static function getInMemoryUsers(): array{

        return ['admin'=>new User('admin','$2y$10$qrszHBr6LYLnT4gw08f5mee8BQe738RwENlOPwX6TmjoOGstIiocC')];
    }

    private function extractCredentials(Request $request): Credentials
    {
        $username = $request->getFromEverywhere("username");
        $password = $request->getFromEverywhere("pwd");

        if ($username === null || $password === null) {
            throw new AuthentifiactionException('Credentials Not Found');
            
        }

        return new Credentials($username, $password);
    }

    private function findUserFromCredential(Credentials $credentials): User
    {

        $pdo = new UserRepository();
        $user = $pdo->get($credentials->username);

        if (!$user instanceof User) {
            throw new AuthentifiactionException('User Not Found');
        }

        return $user;
    }

    private function checkCredentials(User $user, Credentials $credentials): void
    {
        if (!password_verify($credentials->password, $user->password)) {
            throw new AuthentifiactionException('Credentials Mismatch');
        }
    }

    public function authentifier(Request $request): User
    {

        $credential = $this->extractCredentials($request);
        $user = $this->findUserFromCredential($credential);
        $this->checkCredentials($user, $credential);
        return $user;
    }
}
