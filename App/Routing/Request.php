<?php

declare(strict_types=1);

namespace App\Routing;

use App\Security\User;

class Request
{

    public ?User $user = null;
    public readonly array $headers;
    public function __construct(public readonly string $path, public readonly string $verbe, private array $post = [], private array $get = [], private array $cookies = [])
    {
        $this->initHeaders() ;
    }

    public static function initFromGlobals(): Request
    {
        return new self($_SERVER['PATH_INFO'] ?? '/', $_SERVER['REQUEST_METHOD'], $_POST, $_GET, $_COOKIE);
    }

    private function initHeaders()
    {
        $headers = [];

        // pour chaque valeur commençant par HTTP_
        // stocke au format de la rfc.
        //ex: HTTP_ACCEPT-LANGUAGE -> Accept-Language
        foreach ($_SERVER as $serverInfoName => $serverInfo) {
            if (!str_starts_with($serverInfoName, 'HTTP')) {
                continue;
            }

            $name = strtolower(substr($serverInfoName, 5));
            $composedName = explode('_', $name);
            array_walk($composedName, function (&$elem) {
                $elem= ucfirst($elem);

            });

            $headers[implode('-', $composedName)] = $serverInfo;
        }
        
        $this->headers = $headers;
    }

    public function getFromEverywhere(string $name, $default = null)
    {

        return $this->post[$name] ?? $this->get[$name] ?? $default;
    }

    public function getCookie(string $name, $default = null)
    {

        return $this->cookies[$name] ?? $default;
    }
}
