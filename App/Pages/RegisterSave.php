<?php

declare(strict_types=1);

namespace App\Pages;

use App\Routing\Middleware\RequestMiddleware;
use App\Routing\Operations\Post;
use App\Routing\Operations\ControllerInterface;
use App\Security\User;
use Latte\Engine;
use App\Repository\UserRepository;

#[Post(path: '/register', name: 'Register')]
class RegisterSave implements ControllerInterface
{
    use RequestMiddleware;

    public function __invoke(): string
    {

        $login = ($this->request->getFromEverywhere('username'));
        $pwd = ($this->request->getFromEverywhere('pwd'));

        $parametres = [];

        try {
            assert(strlen($login) >= 1, 'Login trop court');
            assert(preg_match('/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$ %^&*-]).{8,}$/', $pwd) !== 0, 'Mot de passe invalide');

            $pawd = password_hash($pwd, PASSWORD_BCRYPT);

            $pdoRepository = new UserRepository;
            $pdoRepository->save(new User($login, $pawd));

        } catch (\AssertionError $error) {
            $parametres['error'] = $error->getMessage();
        }

        $latte = new Engine();
        $latte->setTempDirectory(path: PROJECT_DIR . '/var/cache');
        return $latte->renderToString(PROJECT_DIR . '/templates/register.latte', $parametres);
    }
}
