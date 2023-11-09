<?php

declare(strict_types=1);

namespace App\Security;

use App\Repository\UserRepository;
use App\Routing\Request;
use App\Exceptions\AuthorisationException;
use Lcobucci\JWT\Token;
use Lcobucci\JWT\Token\Parser;
use Lcobucci\JWT\Validation\Validator;
use Lcobucci\JWT\Encoding\JoseEncoder;
use Lcobucci\JWT\Validation\Constraint\ValidAt;
use Lcobucci\Clock\Clock;
use Lcobucci\JWT\Validation\Constraint\SignedWith;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\Signer\Key\InMemory;
use Lcobucci\JWT\Validation\RequiredConstraintsViolated;

class Authorisation
{

    public function extractCredentials(Request $request): Token
    {

        $token = $request->getCookie('tk');

        if ($token === null) {
            throw new AuthorisationException();
        }

        $parser = new Parser(new JoseEncoder());
        $token = $parser->parse($token);


        return $token;
    }

    public function validateCredentials(Token $token)
    {

        $date = new class implements Clock
        {
            public function now(): \DateTimeImmutable
            {
                return new \DateTimeImmutable();
            }
        };

        $algo = new Sha256();
        $key = InMemory::plainText('macleSuperSecreteChutFautPasLeDire');

        $validator = new Validator();
        $validator->assert($token, new ValidAt($date), new SignedWith($algo, $key));
    }

    public function authorize(Request $request): void
    {
        try {
            $token = $this->extractCredentials($request);
            $this->validateCredentials($token);

            $pdo = new UserRepository();
            $user = $pdo->get($token->claims()->get('username'));

            $request->user = $user;
        } catch (RequiredConstraintsViolated $e) {
            throw new AuthorisationException('Token Invalide', 0, $e);
        }
    }
}
