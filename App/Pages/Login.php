<?php

declare(strict_types=1);

namespace App\Pages;

use App\Exceptions\AuthentifiactionException;
use App\Routing\Middleware\RequestMiddleware;
use App\Routing\Operations\ControllerInterface;
use App\Routing\Operations\Post;
use App\Security\Authentification;
use Lcobucci\JWT\Encoding\ChainedFormatter;
use Lcobucci\JWT\Encoding\JoseEncoder;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\Signer\Key\InMemory;
use Lcobucci\JWT\Token\Builder;

#[Post('/login', 'login')]

class Login implements ControllerInterface
{

    use RequestMiddleware;

    public function __invoke(): string
    {

        try {
            $authentification = new Authentification();
            $user = $authentification->authentifier($this->request);

            $tokenBuilder = new Builder(new JoseEncoder(), ChainedFormatter::default());
            $algo = new Sha256();
            $key = InMemory::plainText('macleSuperSecreteChutFautPasLeDire');
            $token = $tokenBuilder->expiresAt((new \DateTimeImmutable())->modify('+1 hour'))
            ->withClaim('username', $user->username)
            ->getToken($algo, $key);

            if(str_contains($this->request->headers['Accept'],'application/json')){
                header('HTTP/1.1 201');
                header('Content-Type: application/json');
                return json_encode(['token'=>$token->toString()]);
            }

            if(str_contains($this->request->headers['Accept'],'text/html')){
                header('HTTP/1.1 204 created');
                header('location: /');
                setcookie('tk', $token->toString());
                return '';
            }

            header('HTTP/1.1 405 method not accepted');
            return '';

         
        } catch (AuthentifiactionException) {
            header('HTTP/1.1 401 Non Authorisé');
            return 'Error 401 - Wrong credentials';
        }

    }
}
